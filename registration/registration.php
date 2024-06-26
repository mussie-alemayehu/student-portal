<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (file_exists("connection.php")) {
    require_once("connection.php");
} else {
    require_once("../connection.php");
}

$stud_id = $_SESSION["user_id"];

$sql = "SELECT year, semesters_completed FROM student_info WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $stud_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$year = $result["year"];
$semesters_completed = $result["semesters_completed"];
$stmt->close();

if ($semesters_completed < 8) :
?>
    <div id="semester-selectors">
        <select id="yearSelector" name="year" class="selector left">
            <option value="">Select your year...</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
        <select id="semesterSelector" name="semester" class="selector right" disabled>
            <option value="">Select your semester</option>
            <option value="one">One</option>
            <option value="two">Two</option>
        </select>
    </div>

    <!-- this container will be used to display the appropriate information based
 on the values of the selected year and semester -->
    <div id="registering-courses">
        <p>Please choose a year and semester to view courses.</p>
    </div>

    <button action="" id="fetch-courses-button" class="btn">Fetch courses</button>

    <script>
        $(document).ready(function() {
            var yearSelector = document.getElementById("yearSelector");
            var semesterSelector = document.getElementById("semesterSelector");
            var fetchCoursesButton = document.getElementById("fetch-courses-button");

            function loadDefaultContent() {
                var tableContainer = document.getElementById("registering-courses");
                tableContainer.innerHTML = "<p>Please choose a year and semester to view courses.</p>";

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

            semesterSelector.addEventListener('change', function() {
                if (this.value != "") {
                    loadDefaultContent();
                    fetchCoursesButton.style.display = "block";
                } else {
                    loadDefaultContent();
                }
            });

            fetchCoursesButton.addEventListener('click', function() {
                var year = yearSelector.value;
                var semester = semesterSelector.value;

                $("#registering-courses").load("registration/table.php?year=" + year + "&semester=" + semester);

                this.style.display = "none";
            });
        });
    </script>
<?php else : ?>
    <p class="congra-message">You have completed your program, Congrats!!!</p>
<?php endif; ?>