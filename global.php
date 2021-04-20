<html>

<head>
    <title>Simple Personal Booker</title>
    <link href="css/style.css" rel="stylesheet">
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
                        <h2 class="small-title">Book your slot now</h2>
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
                        <h3 class="title">April 2021</h3>
                        <div class="daytags">
                            <span>Mon</span>
                            <span>Tue</span>
                            <span>Wed</span>
                            <span>Thu</span>
                            <span>Fri</span>
                            <span>Sat</span>
                            <span>Sun</span>
                        </div>
                        <div class="days">
                            <a href="javascript:void(0);" class="disabled">29</a>
                            <a href="javascript:void(0);" class="disabled">30</a>
                            <a href="javascript:void(0);" class="disabled">31</a>
                            <a href="javascript:void(0);">1</a>
                            <a href="javascript:void(0);">2</a>
                            <a href="javascript:void(0);" class="disabled">3</a>
                            <a href="javascript:void(0);" class="disabled">4</a>
                            <a href="javascript:void(0);">5</a>
                            <a href="javascript:void(0);">6</a>
                            <a class="selected" href="javascript:void(0);">7</a>
                            <a href="javascript:void(0);">8</a>
                            <a href="javascript:void(0);">9</a>
                            <a href="javascript:void(0);" class="disabled">10</a>
                            <a href="javascript:void(0);" class="disabled">11</a>
                            <a href="javascript:void(0);">12</a>
                            <a href="javascript:void(0);">13</a>
                            <a href="javascript:void(0);">14</a>
                            <a href="javascript:void(0);">15</a>
                            <a href="javascript:void(0);">16</a>
                            <a href="javascript:void(0);" class="disabled">17</a>
                            <a href="javascript:void(0);" class="disabled">18</a>
                            <a href="javascript:void(0);">19</a>
                            <a class="selected">20</a>
                            <a href="javascript:void(0);">21</a>
                            <a href="javascript:void(0);">22</a>
                            <a href="javascript:void(0);">23</a>
                            <a href="javascript:void(0);" class="disabled">24</a>
                            <a href="javascript:void(0);" class="disabled">25</a>
                            <a href="javascript:void(0);">26</a>
                            <a href="javascript:void(0);">27</a>
                            <a href="javascript:void(0);">28</a>
                            <a href="javascript:void(0);">29</a>
                            <a href="javascript:void(0);">30</a>
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
<script src="js/dayjs.min.js"></script>
<script src="js/main.js"></script>

</html>