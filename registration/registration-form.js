$(document).ready(function() {
    var yearSelector = document.getElementById("yearSelector");
    var semesterSelector = document.getElementById("semesterSelector");
    var fetchCoursesButton = document.getElementById("fetch-courses-button");
    var registerCoursesButton = document.getElementById("register-courses-button");

    function loadDefaultContent() {
        var tableContainer = document.getElementById("registering-courses");
        tableContainer.innerHTML = "Please choose a year and semester to view courses.";

        registerCoursesButton.style.display = "none";
        fetchCoursesButton.style.display = "none";
    }

    yearSelector.addEventListener('change', function() {
        if (this.value) {
            semesterSelector.disabled = false;
            loadDefaultContent();
            if (semesterSelector.value) {
                fetchCoursesButton.style.display = "block";
            }
        } else {
            semesterSelector.disabled = true;
            semesterSelector.value = "";

            loadDefaultContent();
        }
    });

    semesterSelector.addEventListener('change', function () {
        if (this.value != "") {
            loadDefaultContent();
            fetchCoursesButton.style.display = "block";
        } else {
            loadDefaultContent();
        }
    });

    alert("listeners added successfully");

    fetchCoursesButton.addEventListener('click', function() {
        var year = yearSelector.value;
        var semester = semesterSelector.value;

        $("#registering-courses").load("registration/table.php?year=" + year + "&semester=" + semester);

        this.style.display = "none";
        registerCoursesButton.style.display = "block";
    });
});
