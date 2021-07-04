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
                        <button onclick="nextCalendar()" class="btn">Next</button>
                    </div>
                    <div id="chooseTime" class="col-10-center" style="display:none">
                        <a onclick="backToCalendar();" style="float: left;text-decoration: none;color: rgb(90, 90, 90);margin-top: 20px;" href="javascript:void(0);">🠔Back</a>
                        <h3 id="dateSelected" style="color: rgb(34, 127, 248);float: right">01 April 2000</h3>
                        <div class="times">
                            <a class="time_button" onclick="selectTime(this, 13,00);" href="javascript:void(0);">13:00</a>
                            <a class="time_button" onclick="selectTime(this, 14,00);" href="javascript:void(0);">14:00</a>
                            <a class="time_button" onclick="selectTime(this, 15,00);" href="javascript:void(0);">15:00</a>
                            <a class="time_button" onclick="selectTime(this, 16,00);" href="javascript:void(0);">16:00</a>
                            <a class="time_button" onclick="selectTime(this, 17,00);" href="javascript:void(0);">17:00</a>
                            <a class="time_button" onclick="selectTime(this, 18,00);" href="javascript:void(0);">18:00</a>
                        </div>
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
<script src="{{ asset('js/main.js') }}"></script>
</html>