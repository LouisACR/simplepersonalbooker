<?php
$meeting = App\Models\Meeting::where('uuid', $uuid)->first();
?>
<html>

<head>
    <title>Simple Personal Booker</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
<body>
    <div class="container">
        <div class="box">
            <!-- Box START -->
            <div class="box-header">
                <div class="avatar">
                    <img src="<?php echo $meeting->booker_img; ?>">
                    <h2><?php echo $meeting->booker; ?></h2>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-12">
                        <h1>You have been invited.</h1>
                        <h1><?php echo $meeting->name; ?></h1>
                    </div>
                    <div class="col-12">
                        <p><?php echo $meeting->description; ?></p>
                    </div>
                    <div class="col-12">
                        <h2 class="small-title">Book your slot now</h2>
                    </div>
                    <div class="calendar">
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
                            <a href="javascript:void(0);">3</a>
                            <a href="javascript:void(0);">4</a>
                            <a href="javascript:void(0);">5</a>
                            <a href="javascript:void(0);">6</a>
                            <a href="javascript:void(0);">7</a>
                            <a href="javascript:void(0);">8</a>
                            <a href="javascript:void(0);">9</a>
                            <a href="javascript:void(0);">10</a>
                            <a href="javascript:void(0);">11</a>
                            <a href="javascript:void(0);">12</a>
                            <a href="javascript:void(0);">13</a>
                            <a href="javascript:void(0);">14</a>
                            <a href="javascript:void(0);">15</a>
                            <a href="javascript:void(0);">16</a>
                            <a href="javascript:void(0);">17</a>
                            <a href="javascript:void(0);">18</a>
                            <a href="javascript:void(0);">19</a>
                            <a class="selected">20</a>
                            <a href="javascript:void(0);">21</a>
                            <a href="javascript:void(0);">22</a>
                            <a href="javascript:void(0);">23</a>
                            <a href="javascript:void(0);">24</a>
                            <a href="javascript:void(0);">25</a>
                            <a href="javascript:void(0);">26</a>
                            <a href="javascript:void(0);">27</a>
                            <a href="javascript:void(0);">28</a>
                            <a href="javascript:void(0);">29</a>
                            <a href="javascript:void(0);">30</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Box END -->
    </div>
</body>
<script src="{{ asset('js/dayjs.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

</html>
