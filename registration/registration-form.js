document.addEventListener("DOMContentLoaded", function () {
    var yearSelector = document.getElementById("yearSelector");
    var semesterSelector = document.getElementById("semesterSelector");
    var fetchCoursesButton = document.getElementById("fetch-courses-button");
    var registerCoursesButton = document.getElementById("register-courses-button");

    yearSelector.addEventListener('change', function() {
        if (this.value) {
            semesterSelector.disabled = false;
        } else {
            fetchCoursesButton.style.display = "none";
            semesterSelector.disabled = true;
            semesterSelector.value = "";
        }
    });

    semesterSelector.addEventListener('change', function () {
        if (this.value != "") {
            fetchCoursesButton.style.display = "block";
            // load the courses table
            // $('#registering-courses').load
        } else {
            fetchCoursesButton.style.display = "none";
            // load empty message
        }
    });
});