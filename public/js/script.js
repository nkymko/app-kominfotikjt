document.getElementById("shift-form").addEventListener("keyup", function () {
    var hourInput = document.getElementById("hour_in").value;
    var minuteInput = document.getElementById("minute_in").value;
    var hourOut = document.getElementById("hour_out").value;
    var minuteOut = document.getElementById("minute_out").value;
    if (hourInput !== "" && minuteInput !== "" && hourOut !== "" && minuteOut !== "") {
        document.getElementById("shift-button").removeAttribute("disabled");
    } else {
        document.getElementById("shift-button").setAttribute("disabled", null);
    }
});
