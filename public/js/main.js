var daySelected = null;
var timeSelected = null;
var dayjs = dayjs();
var fixed_dayjs = dayjs.clone();
var dayjsSelected = fixed_dayjs.clone();


document.querySelector("#iden").addEventListener("submit", function (e) {
    e.preventDefault(); //stop form from submitting
    document.getElementById("iden").style.display = "none";
    document.getElementById("calendar").style.display = "block";
    document.getElementById("nextCalen").style.display = "block";
    document.getElementById("nextCalen").children[0].innerHTML =
        'Next: <i style="font-size: 14px;font-weight: normal;">' +
        dayjsSelected.get("date") +
        " " +
        getMonthName(dayjsSelected.get("month") + 1) +
        " " +
        dayjsSelected.get("year") +
        "</i>";
    document.getElementById("help").innerHTML =
        "Please select a date that suits you.";

    /*var x = window.matchMedia("(max-width: 600px)")
        if(x.matches){
        document.getElementById("box").style.height = '800px';
        } else {
        document.getElementById("box").style.height = '750px';
        }*/
});

function backToCalendar() {
    time_offset = 1;
    document.getElementById("current_page").innerHTML = time_offset;
    document.getElementById("chooseTime").style.display = "none";
    document.getElementById("finishCalen").style.display = "none";
    document.getElementById("calendar").style.display = "block";
    document.getElementById("nextCalen").style.display = "block";
    document.getElementById("nextCalen").children[0].innerHTML =
        'Next: <i style="font-size: 14px;font-weight: normal;">' +
        dayjsSelected.get("date") +
        " " +
        getMonthName(dayjsSelected.get("month") + 1) +
        " " +
        dayjsSelected.get("year") +
        "</i>";
    document.getElementById("help").innerHTML =
        "Please select a date that suits you.";
    if (timeSelected != null) {
        timeSelected.classList.remove("select");
        timeSelected = null;
    }
}

function getMonthName(month) {
    var month_name =
        month == 1
            ? "January"
            : month == 2
            ? "February"
            : month == 3
            ? "March"
            : month == 4
            ? "April"
            : month == 5
            ? "May"
            : month == 6
            ? "June"
            : month == 7
            ? "July"
            : month == 8
            ? "August"
            : month == 9
            ? "September"
            : month == 10
            ? "October"
            : month == 11
            ? "November"
            : "December";
    return month_name;
}

function before() {
    if (
        dayjs.get("year") == fixed_dayjs.get("year") &&
        dayjs.get("month") == fixed_dayjs.get("month")
    ) {
    } else {
        dayjs = dayjs.subtract(1, "month");
        updateCalendar(dayjs);
    }
}

function after() {
    dayjs = dayjs.add(1, "month");
    updateCalendar(dayjs);
}

function updateCalendar(day) {
    var this_month = day.get("month") + 1;
    var month_name = getMonthName(this_month);
    document.getElementById("calendarTitle").innerHTML =
        month_name +
        " " +
        day.get("year") +
        '<span style="float:right;">' +
        '<a id="btn-before" class="arrow-btn" onclick="before();"' +
        ' href="javascript:void(0)">&lt;</a><a id="btn-after" class="arrow-btn" onclick="after();" href="javascript:void(0)">&gt;</a></span>';
    var days_in_last_month = day.subtract(1, "month").daysInMonth();
    var month_start = day.date(1).$W - 1;
    if (month_start == -1) {
        month_start = 6;
    }
    var month_count = days_in_last_month - month_start;
    var calendarDays = document.getElementById("calendarDays");
    calendarDays.innerHTML = "";
    var year = dayjs.get("year");
    if (dayjs.get("year") == fixed_dayjs.get("year")) {
        if (dayjs.get("month") == fixed_dayjs.get("month")) {
            for (let i = month_start; i > 0; i--) {
                month_count = month_count + 1;
                calendarDays.insertAdjacentHTML(
                    "beforeend",
                    '<a class="disabled">' + month_count + "</a>"
                );
            }
            for (let i = 1; i <= day.daysInMonth(); i++) {
                day = day.date(i);
                if (i >= fixed_dayjs.get("date")) {
                    if (
                        dayjsSelected.get("month") == day.get("month") &&
                        dayjsSelected.get("year") == year &&
                        dayjsSelected.get("date") == i
                    ) {
                        calendarDays.insertAdjacentHTML(
                            "beforeend",
                            '<a class="selected" href="javascript:void(0);" onclick="select(this,' +
                                i +
                                "," +
                                this_month +
                                "," +
                                year +
                                ');">' +
                                i +
                                "</a>"
                        );
                        daySelected = calendarDays.lastChild;
                    } else {
                        if (recurring_off[day.day()] == 0) {
                            calendarDays.insertAdjacentHTML(
                                "beforeend",
                                '<a onclick="select(this,' +
                                    i +
                                    "," +
                                    this_month +
                                    "," +
                                    year +
                                    ');" href="javascript:void(0);">' +
                                    i +
                                    "</a>"
                            );
                        } else {
                            calendarDays.insertAdjacentHTML(
                                "beforeend",
                                '<a class="disabled">' + i + "</a>"
                            );
                        }
                    }
                } else {
                    calendarDays.insertAdjacentHTML(
                        "beforeend",
                        '<a class="disabled">' + i + "</a>"
                    );
                }
            }
        } else if (dayjs.get("month") > fixed_dayjs.get("month")) {
            updateDays(day, calendarDays, this_month, month_count, month_start);
        } else {
            for (let i = month_start; i > 0; i--) {
                month_count = month_count + 1;
                calendarDays.insertAdjacentHTML(
                    "beforeend",
                    '<a class="disabled">' + month_count + "</a>"
                );
            }
            for (let i = 1; i <= day.daysInMonth(); i++) {
                calendarDays.insertAdjacentHTML(
                    "beforeend",
                    '<a class="disabled">' + i + "</a>"
                );
            }
        }
    } else if (dayjs.get("year") > fixed_dayjs.get("year")) {
        updateDays(day, calendarDays, this_month, month_count, month_start);
    } else {
        for (let i = month_start; i > 0; i--) {
            month_count = month_count + 1;
            calendarDays.insertAdjacentHTML(
                "beforeend",
                '<a class="disabled">' + month_count + "</a>"
            );
        }
        for (let i = 1; i <= day.daysInMonth(); i++) {
            calendarDays.insertAdjacentHTML(
                "beforeend",
                '<a class="disabled">' + i + "</a>"
            );
        }
    }
}

updateCalendar(dayjs);

function updateDays(day, calendarDays, this_month, month_count, month_start) {
    var year = dayjs.get("year");
    for (let i = month_start; i > 0; i--) {
        month_count = month_count + 1;
        calendarDays.insertAdjacentHTML(
            "beforeend",
            '<a class="disabled">' + month_count + "</a>"
        );
    }
    for (let i = 1; i <= day.daysInMonth(); i++) {
        day = day.date(i);
        if (
            dayjsSelected.get("month") == day.get("month") &&
            dayjsSelected.get("year") == year &&
            dayjsSelected.get("date") == i
        ) {
            calendarDays.insertAdjacentHTML(
                "beforeend",
                '<a class="selected" href="javascript:void(0);">' + i + "</a>"
            );
            daySelected = calendarDays.lastChild;
        } else {
            if (recurring_off[day.day()] == 0) {
                calendarDays.insertAdjacentHTML(
                    "beforeend",
                    '<a onclick="select(this,' +
                        i +
                        "," +
                        this_month +
                        "," +
                        year +
                        ');" href="javascript:void(0);">' +
                        i +
                        "</a>"
                );
            } else {
                calendarDays.insertAdjacentHTML(
                    "beforeend",
                    '<a class="disabled">' + i + "</a>"
                );
            }
        }
    }
}

function select(btn, day, month, year) {
    if (daySelected != null) {
        daySelected.classList.remove("selected");
    }
    dayjsSelected = dayjsSelected.set("year", year);
    dayjsSelected = dayjsSelected.set("month", month - 1);
    dayjsSelected = dayjsSelected.set("date", day);
    btn.classList.add("selected");
    daySelected = btn;
    document.getElementById("nextCalen").children[0].innerHTML =
        'Next: <i style="font-size: 14px;font-weight: normal">' +
        dayjsSelected.get("date") +
        " " +
        getMonthName(dayjsSelected.get("month") + 1) +
        " " +
        dayjsSelected.get("year") +
        "</i>";
}

function selectTime(btn, hour, minute) {
    if (timeSelected != null) {
        timeSelected.classList.remove("select");
    }
    dayjsSelected = dayjsSelected.set("hour", hour);
    dayjsSelected = dayjsSelected.set("minute", minute);
    btn.classList.add("select");
    timeSelected = btn;
    var displayMinute = minute;
    if (minute < 10) {
        displayMinute = "0" + minute;
    }
    console.log(hour + ":" + displayMinute);
    document.getElementById("dateSelected").innerHTML =
        dayjsSelected.get("date") +
        " " +
        getMonthName(dayjsSelected.get("month") + 1) +
        " " +
        dayjsSelected.get("year") +
        " at " +
        hour +
        ":" +
        displayMinute;
}

function updateTimes(startNumber = 0) {
    var timeDiv = document.getElementById("timeDiv");
    timeDiv.innerHTML = "";
    if (timeSelected != null) {
        timeSelected.classList.remove("select");
        timeSelected = null;
    }
    for (let i = startNumber; i < startNumber + 6; i++) {
        if (i + 1 <= times.length) {
            var timeI = times[i];
            var hour = timeI.hour;
            var minute = timeI.minute;
            var displayMinute = minute;
            if (minute < 10) {
                displayMinute = "0" + minute;
            }
            if(hour==0&&minute==0){
                timeDiv.insertAdjacentHTML(
                    "beforeend",
                    '<a class="time_button loading" disabled></a>'
                );
            } else {

            timeDiv.insertAdjacentHTML(
                "beforeend",
                '<a class="time_button" onclick="selectTime(this, ' +
                    hour +
                    "," +
                    displayMinute +
                    ');" href="javascript:void(0);">' +
                    hour +
                    ":" +
                    displayMinute +
                    "</a>"
            );
            }
        }
    }
    document.getElementById("page_limit").innerHTML = Math.ceil(times.length/6);
}
