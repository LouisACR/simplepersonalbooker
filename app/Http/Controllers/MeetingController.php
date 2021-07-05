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

        if($request->name!=null&&$request->name!=""){

        $meeting = new Meeting;

        $meeting->uuid = Str::random(20);
        $meeting->booker = $request->booker;
        $meeting->booker_img = $request->booker_img;
        $meeting->name = $request->name;
        $meeting->description = $request->description;
        $meeting->duration = $request->duration;
        $meeting->spacing = $request->spacing;
        $meeting->recurring_off = "{}";
        $meeting->onetime_off = "{}";

        $meeting->save();

        return
        }
    }
}
