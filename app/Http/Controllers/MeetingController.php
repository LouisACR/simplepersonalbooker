<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Booking;
use Illuminate\Support\Str;

class MeetingController extends Controller
{

    public function create(Request $request)
    {
        // Validate the request...

        $validated = Validator::make($request->all(), [
            'booker' => 'required|string',
            'booker_img' => 'required|string',
            'booker_img' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|description',
            'duration' => 'required|integer|min:5',
            'spacing' => 'required|integer|min:15',
            'time_min' => 'required|integer|min:0,max:24',
            'time_max' => 'required|integer|min:0,max:24',
            'recurring_off' => 'required|string',
            'onetime_off' => 'required|string'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->failed(), 400);
        }

        $meeting = new Meeting;
        $meeting->uuid = Str::random(20);
        $meeting->booker = $request->booker;
        $meeting->booker_img = $request->booker_img;
        $meeting->name = $request->name;
        $meeting->description = $request->description;
        $meeting->duration = $request->duration;
        $meeting->spacing = $request->spacing;
        $meeting->time_min = $request->time_min;
        $meeting->time_max = $request->time_max;
        $meeting->recurring_off = $request->recurring_off;
        $meeting->onetime_off = $request->onetime_off;
        $meeting->save();
        return response()->json(['success' => 'success'], 200);
    }

    public static function getTimes(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'uuid' => 'required|size:20',
            'date' => 'required|date'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->failed(), 400);
        }

        $date = $request->date;
        $uuid = $request->uuid;

        $meeting = Meeting::whereRaw('BINARY `uuid`= ?', $uuid);
        if ($meeting->doesntExist()) {
            return response()->json(['error' => 'uuid invalid'], 400);
        }
        $meeting = $meeting->first();
        date_default_timezone_set($meeting->timezone);
        $dayTODAY = date('d', time());
        $monthTODAY = date('m', time());
        $yearTODAY = date('Y', time());

        $day = date('d', strtotime($date));
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        // CHECK IF DATE HAS TIMES
        if ($year < $yearTODAY) {
            return response()->json(['error' => 'no times for this date (past year)'], 400);
        } else
            if ($year <= $yearTODAY && $month < $monthTODAY) {
            return response()->json(['error' => 'no times for this date (past month)'], 400);
        } else
            if ($year <= $yearTODAY && $month <= $monthTODAY && $day < $dayTODAY) {
            return response()->json(['error' => 'no times for this date (past day)'], 400);
        }

        if (json_decode($meeting->recurring_off)[date('w', strtotime($date))] == 1) {
            return response()->json(['error' => 'no times for this date (booker recurring_off)'], 400);
        }

        // TODO: Check for already booked and google agenda in future

        $offTimes = [];

        $bookings = Booking::where('meeting_id', $meeting->id)->get();
        foreach ($bookings as $booking) {
            $bookedDate = $booking->booked_for;
            $Oday = date('d', strtotime($bookedDate));
            $Omonth = date('m', strtotime($bookedDate));
            $Oyear = date('Y', strtotime($bookedDate));
            if ($year == $Oyear && $month == $Omonth && $day == $Oday) {
                $offHour = date('H', strtotime($bookedDate));
                $offMinute = date('i', strtotime($bookedDate));
                array_push($offTimes, ['hour' => $offHour, 'minute' => $offMinute]);
            }
        }

        $time_min = $meeting->time_min; // 8
        if ($year == $yearTODAY && $month == $monthTODAY && $day == $dayTODAY) {
            $time_min = round(date('H', time()) + ((date('i', time()) + $meeting->spacing) / 60));
        }
        $time_max = $meeting->time_max; // 18
        $spacing = $meeting->spacing; // 8
        $hourInDay = $time_max - $time_min; // 10
        $slotsPerHour = round(60 / $spacing, 2); // 4
        $time_arr = array();
        $startingTimeHour = $time_min;
        $startingTimeMin = 0;
        for ($i = 0; $i < $hourInDay; $i++) {
            for ($is = 0; $is < $slotsPerHour; $is++) {
                if ($startingTimeHour < $time_max) {
                    $outputA = ['hour' => $startingTimeHour, 'minute' => $startingTimeMin];
                    if (!in_array($outputA, $offTimes)) {
                        array_push($time_arr, $outputA);
                    }
                }
                $startingTimeMin = $startingTimeMin + $spacing;
                if ($startingTimeMin >= 60) {
                    $startingTimeMin = $startingTimeMin - 60;
                }
            }
            $startingTimeHour = $startingTimeHour + 1;
        }

        // 8:00 , 8:15 , 8:30, 8:45 , 9:00
        if ($request->array == 1) {
            return $time_arr;
        } else {
            return response()->json($time_arr, 200);
        }
    }
}
