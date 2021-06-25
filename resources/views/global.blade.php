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
                    <img src="https://feedback.upvoty.com/images/avatar/39263/04f7f73267502fa37faa/">
                    <h2>John A. SMITH</h2>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="meeting">
                        <h1>Business Virtual Classroom</h1>
                        <p>30 minute meeting by John A. SMITH</p>
                    </div>
                    <div class="col-12">
                        <h2 class="small-title">Book your slot now.</h2>
                    </div>

                    <div class="col-12">
                        <p id="help" class="pick">Please enter your full name and email.</p>
                    </div>
                    <form class="col-10-center" id="iden" method="POST">
                        <input required type="text" class="big-input" placeholder="Please enter your full name">
                        <input required type="email" class="big-input" placeholder="Please enter your email">
                        <button type="submit" class="btn">Next</button>
                    </form>
                    <div id="calendar" class="calendar" style="display:none">
                        <h3 id="calendarTitle" class="title">NaN 2021<span style="float:right;"><a id="btn-before" class="arrow-btn" href="javascript:void();">&lt;</a><a id="btn-after" class="arrow-btn" href="javascript:void();">&gt;</a></span></h3>
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
                        <button onclick="nextCalendar()" class="btn" disabled>Next</button>
                    </div>
                </div>
            </div>
        </div> <!-- Box END -->
    </div>
</body>
<script src="{{ asset('js/dayjs.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>

var daySelected = dayjs().format();
var dayjs = dayjs();

updateCalendar(dayjs);

function before(){
    dayjs = dayjs.subtract(1, "month");
    updateCalendar(dayjs);

}

function after(){
    dayjs = dayjs.add(1, "month");
    updateCalendar(dayjs);
}

function updateCalendar(day){
var this_month = day.get('month')+1;
var month_name = (this_month == 1) ? "January" :
(this_month == 2) ? "February" :
(this_month == 3) ? "March" :
(this_month == 4) ? "April" :
(this_month == 5) ? "May" :
(this_month == 6) ? "June" :
(this_month == 7) ? "July" :
(this_month == 8) ? "August" :
(this_month == 9) ? "September" :
(this_month == 10) ? "October" :
(this_month == 11) ? "November" : "December";
document.getElementById("calendarTitle").innerHTML = month_name + " " + day.get('year')+'<span style="float:right;"><a id="btn-before" class="arrow-btn" onclick="before();" href="javascript:void(0)">&lt;</a><a id="btn-after" class="arrow-btn" onclick="after();" href="javascript:void(0)">&gt;</a></span>';
var days_in_last_month = day.subtract(1, "month").daysInMonth();
var month_start = day.date(1).$W - 1;
var month_count = days_in_last_month - month_start;
var calendarDays = document.getElementById("calendarDays");
calendarDays.innerHTML = "";
for (let i = month_start; i > 0; i--) {
    month_count = month_count + 1;
    calendarDays.insertAdjacentHTML('beforeend', '<a class="disabled">'+month_count+'</a>');
}
for (let i = 1; i <= day.daysInMonth(); i++) {
    calendarDays.insertAdjacentHTML('beforeend', '<a href="javascript:void(0);">'+i+'</a>');
}
}
</script>
</html>
