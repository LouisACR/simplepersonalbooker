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
                    <div class="meeting">
                        <h1>{{ $meeting->name; }}</h1>
                        <p>{{ $meeting->description; }}</p>
                    </div>
                    <div class="col-12">
                        <h2 class="small-title">Book your slot now.</h2>
                    </div>

                    <div class="col-12">
                        <p id="help" class="pick">Please enter your full name and email.</p>
                    </div>
                    <form class="col-10-center" id="iden" method="POST">
                        @csrf
                        <input required type="text" class="big-input" placeholder="Please enter your full name">
                        <input required type="email" class="big-input" placeholder="Please enter your email">
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
                        <button onclick="nextCalendar()" class="btn">Next</button>
                    </div>
                    <div id="chooseTime" class="col-10-center" style="display:none">
                        <a onclick="backToCalendar();"
                            style="float: left;text-decoration: none;color: rgb(90, 90, 90);margin-top: 20px;"
                            href="javascript:void(0);">🠔Back</a>
                        <h3 id="dateSelected" style="color: rgb(34, 127, 248);float: right">01 April 2000</h3>
                        <div id="timeDiv" class="times"></div>
                        <div style="margin-top: 10px"><a onclick="showLess()" href="javascript:void(0);" style="margin-right: 10px;text-decoration: none; color:rgb(46, 46, 46)">Back</a> Page <span id="current_page">1</span>/<span id="page_limit"></span> <a onclick="showMore()" href="javascript:void(0);" style="margin-left: 10px;text-decoration: none; color:rgb(46, 46, 46)">More</a></div>
                    </div>
                    <div style="display:none;margin-bottom:10px" id="finishCalen" class="col-10-center">
                        <button onclick="finishCalendar()" class="btn" disabled>Book now</button>
                    </div>
                </div>
            </div>
        </div> <!-- Box END -->
    </div>
</body>
<script src="{{ asset('js/dayjs.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script>
var times = [{hour:0,minute:0},{hour:0,minute:0},{hour:0,minute:0},{hour:0,minute:0},{hour:0,minute:0},{hour:0,minute:0}];
var recurring_off = JSON.parse("<?php echo $meeting->recurring_off; ?>");
</script>
<script src="{{ asset('js/main.js') }}"></script>
<script>

var time_offset = 1;
function showMore(){
    var limit = Math.ceil(times.length/6);
    if(time_offset<limit){
    time_offset = time_offset+1;
    document.getElementById("current_page").innerHTML = time_offset;
    updateTimes((time_offset-1)*6);
    }
}
function showLess(){
    var limit = Math.ceil(times.length/6);
    if((time_offset-1)>0){
    time_offset = time_offset-1;
    document.getElementById("current_page").innerHTML = time_offset;
    updateTimes((time_offset-1)*6);
    }
}

    function nextCalendar() {
    document.getElementById("chooseTime").style.display = "block";
    document.getElementById("finishCalen").style.display = "block";
    document.getElementById("calendar").style.display = "none";
    document.getElementById("nextCalen").style.display = "none";
    document.getElementById("dateSelected").innerHTML =
        dayjsSelected.get("date") +
        " " +
        getMonthName(dayjsSelected.get("month") + 1) +
        " " +
        dayjsSelected.get("year");
    document.getElementById("help").innerHTML =
        "Please select a time that suits you.";
        $.ajax({
            type: 'GET',
            url: "/api/meeting/times",
            data: {date: dayjsSelected.format(),uuid: '{{ $uuid }}'},
            beforeSend: function(data){
                times = [{hour:0,minute:0},{hour:0,minute:0},{hour:0,minute:0},{hour:0,minute:0},{hour:0,minute:0},{hour:0,minute:0}];
                updateTimes();
            },
            success: function(data){
                console.log(data);
                times = data;
                updateTimes();
            }
            });
}
</script>

</html>
