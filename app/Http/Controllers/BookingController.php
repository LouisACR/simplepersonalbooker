<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Meeting;
use Illuminate\Support\Str;
use App\Http\Controllers\MeetingController;


class BookingController extends Controller
{
    public function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'uuid' => 'required|size:20',
            'booked_for' => 'required|date'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->failed(), 400);
        }
        $meeting = Meeting::whereRaw('BINARY `uuid`= ?', $request->uuid);
        if ($meeting->doesntExist()) {
            return response()->json(['error' => 'uuid invalid'], 400);
        }
        $meeting = $meeting->first();
        $timeRequest = new Request([
            'uuid'   => $meeting->uuid,
            'date' => $request->booked_for,
            'array' => 1
        ]);
        $times = app('App\Http\Controllers\MeetingController')->getTimes($timeRequest);
        $validated = 0;
        $hour = date('H', strtotime($request->booked_for));
        $minute = date('i', strtotime($request->booked_for));
        for ($i = 0; $i < count($times); $i++) {
            if ($times[$i]['hour'] == $hour && $times[$i]['minute'] == $minute) {
                $validated = 1;
            }
        }
        if ($validated == 0) {
            return response()->json(['error' => 'time not available'], 400);
        }

        $booking = new Booking;
        $booking->uuid = Str::random(20);
        $booking->meeting_id = $meeting->id;
        $booking->fullname = $request->name;
        $booking->email = $request->email;
        $booking->booked_for = $request->booked_for;
        $booking->save();

        return response()->json(['success' => 'success'], 200);
    }
}
