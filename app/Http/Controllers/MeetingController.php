<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use Illuminate\Support\Str;

class MeetingController extends Controller
{

    public function create(Request $request)
    {
        // Validate the request...

        if ($request->name != null && $request->name != "") {
            $meeting = new Meeting;
            $meeting->uuid = Str::random(20);
            $meeting->booker = $request->booker;
            $meeting->booker_img = $request->booker_img;
            $meeting->name = $request->name;
            $meeting->description = $request->description;
            $meeting->duration = $request->duration;
            $meeting->spacing = $request->spacing;
            $meeting->time_min = 8;
            $meeting->time_max = 18;
            $meeting->recurring_off = json_encode(array(0, 0, 0, 0, 0, 0, 0));
            $meeting->onetime_off = "[]";
            $meeting->save();
            return response()->json(['success' => 'success'], 200);
        } else {
            return response()->json(['error' => 'request invalid'], 400);
        }
    }

    public function getTimes(Request $request)
    {
        $date = $request->date;
        $uuid = $request->uuid;

        if ($date != null && $date != "" && $uuid != null && $uuid != "") {
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
            if($year < $yearTODAY){
                return response()->json(['error' => 'no times for this date (past year)'], 400);
            } else
            if($year <= $yearTODAY && $month < $monthTODAY){
                return response()->json(['error' => 'no times for this date (past month)'], 400);
            } else
            if($year <= $yearTODAY && $month <= $monthTODAY && $day < $dayTODAY){
                return response()->json(['error' => 'no times for this date (past day)'], 400);
            }

            if(json_decode($meeting->recurring_off)[date('w', strtotime($date))]==1){
                return response()->json(['error' => 'no times for this date (booker recurring_off)'], 400);
            }

            // TODO: Check for already booked and google agenda in future

            $time_min = $meeting->time_min; // 8
            if($year == $yearTODAY && $month == $monthTODAY && $day == $dayTODAY){
            $time_min = round(date('H', time())+((date('i', time()) + $meeting->spacing)/60));
            }
            $time_max = $meeting->time_max; // 18
            $spacing = $meeting->spacing; // 8
            $hourInDay = $time_max - $time_min; // 10
            $slotsPerHour = round(60/$spacing, 2); // 4
            $time_arr = array();
            $startingTimeHour = $time_min;
            $startingTimeMin = 0;
            for ($i=0; $i<$hourInDay; $i++) {
                for ($is=0; $is<$slotsPerHour; $is++) {
                    if($startingTimeHour<$time_max){
                    array_push($time_arr, ['hour' => $startingTimeHour,'minute' => $startingTimeMin]);
                    }
                    $startingTimeMin = $startingTimeMin + $spacing;
                    if($startingTimeMin >= 60){
                    $startingTimeMin = $startingTimeMin-60;
                    }

                }
                $startingTimeHour = $startingTimeHour+1;
            }

            // 8:00 , 8:15 , 8:30, 8:45 , 9:00

             return response()->json($time_arr, 200);
        } else {
            return response()->json(['error' => 'request invalid'], 400);
        }
    }
}
