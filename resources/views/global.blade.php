<?php
$meeting = App\Models\Meeting::whereRaw('BINARY `uuid`= ?', $uuid)->first()->fresh();
?>
<html>

<head>
    <title>Simple Personal Booker</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div id="box" class="box">
            <!-- Box START -->
            <div class="box-header">
                <div class="avatar">
                    <img src="{{ $meeting->booker_img; }}">
                    <h2>{{ $meeting->booker; }}</h2>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div id="meetingDiv" class="meeting">
                        <h1>{{ $meeting->name; }}</h1>
                        <p>{{ $meeting->description; }}</p>
                    </div>
                    <div id="maindiv" class="col-12">
                        <h2 class="small-title">Book your slot now.</h2>
                    </div>
                    <div id="svg-green" style="display:none;" class="svg-box">
                        <svg style="width: 150px" class="circular green-stroke">
                            <circle class="path" cx="75" cy="75" r="50" fill="none" stroke-width="5" stroke-miterlimit="10"/>
                        </svg>
                        <svg class="checkmark green-stroke">
                            <g transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-489.57,-205.679)">
                                <path class="checkmark__check" fill="none" d="M616.306,283.025L634.087,300.805L673.361,261.53"/>
                            </g>
                        </svg>
                    </div>
                    <div id="svg-red" class="svg-box" style="display:none;">
                        <svg style="width: 150px" class="circular red-stroke">
                            <circle class="path" cx="75" cy="75" r="50" fill="none" stroke-width="5" stroke-miterlimit="10"/>
                        </svg>
                        <svg class="cross red-stroke">
                            <g transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-502.652,-204.518)">
                                <path class="first-line" d="M634.087,300.805L673.361,261.53" fill="none"/>
                            </g>
                            <g transform="matrix(-1.28587e-16,-0.79961,0.79961,-1.28587e-16,-204.752,543.031)">
                                <path class="second-line" d="M634.087,300.805L673.361,261.53"/>
                            </g>
                        </svg>
                    </div>
                    <div id="message" class="meeting" style="display:none">
                    <h1 id="messageH1"></h1>
                    <p id="messageP">You have booked successfully for <b>{{ $meeting->name; }}</b><br><br><span style="font-size: 20px; color:rgb(59, 142, 250);font-weight: bold;" id="finalDate"></span></p>
                    </div>
                    <div id="helpdiv" class="col-12">
                        <p id="help" class="pick">Please enter your full name and email.</p>
                    </div>
                    <form class="col-10-center" id="iden" method="POST" autocomplete="on">
                        @csrf
                        <input required id="name" type="text" name="name" class="big-input"
                            placeholder="Please enter your full name">
                        <input required id="email" type="email" name="email" class="big-input"
                            placeholder="Please enter your email">
                        <button type="submit" class="btn">Next</button>
                    </form>
                    <div id="calendar" class="calendar" style="display:none">
                        <h3 id="calendarTitle" class="title">NaN 2021<span style="float:right;"><a id="btn-before"
                                    class="arrow-btn" href="javascript:void();">&lt;</a><a id="btn-after"
                                    class="arrow-btn" href="javascript:void();">&gt;</a></span></h3>
                        <div class="daytags">
                            <span>Mon</span>
                            <span>Tue</span>
                            <span>Wed</span>
                            <span>Thu</span>
                            <span>Fri</span>
                            <span>Sat</span>
                            <span>Sun</span>
                        </div>
                        <div id="calendarDays" class="days">
                        </div>
                    </div>
                    <div style="display:none;margin-bottom:10px" id="nextCalen" class="col-10-center">
                        <button onclick="nextCalendar()" class="btn">Confirm</button>
                    </div>
                    <div id="chooseTime" class="col-10-center" style="display:none">
                        <a onclick="backToCalendar();"
                            style="float: left;text-decoration: none;color: rgb(90, 90, 90);margin-top: 20px;font-size: 16px;font-weight:bold"
                            href="javascript:void(0);">Back</a>
                        <h3 id="dateSelected" style="color: rgb(34, 127, 248);float: right;margin-bottom:10px">01 April
                            2000</h3>
                        <p style="display:table;width:100%;margin-bottom:20px;">Times are in the
                            <b><?php echo explode("/", $meeting->timezone)[1]; ?></b> timezone</p>
                        <div id="timeDiv" class="times"></div>
                        <div style="margin-top: 10px"><a onclick="showLess()" href="javascript:void(0);"
                                class="pagination-btn">Back</a> Page <span id="current_page">1</span>/<span
                                id="page_limit">1</span> <a onclick="showMore()" href="javascript:void(0);"
                                class="pagination-btn">Next</a></div>
                    </div>
                    <div style="display:none;margin-bottom:10px" id="finishCalen" class="col-10-center">
                        <button onclick="finishCalendar()" id="booknow" class="btn" disabled>Book now</button>
                    </div>
                </div>
            </div>
        </div> <!-- Box END -->
    </div>
</body>
<script src="{{ asset('js/dayjs.min.js') }}"></script>
<script src="{{ asset('js/utc.js') }}"></script>
<script src="{{ asset('js/timezone.js') }}"></script>
<script>
    dayjs.extend(window.dayjs_plugin_utc);
dayjs.extend(window.dayjs_plugin_timezone);
</script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script>
    var uuid = '{{ $uuid }}';
var times = [];
var recurring_off = JSON.parse("{{ $meeting->recurring_off }}");
</script>
<script src="{{ asset('js/main.js') }}"></script>

</html>
