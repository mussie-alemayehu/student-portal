<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$student_id = $_SESSION["user_id"];

if (!isset($conn)) {
    require_once "../connection.php";
}

// get the number of completed semesters to display the results for those semesters
$sql = "SELECT semesters_completed FROM student_info WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$semesters_completed = $stmt->get_result()->fetch_assoc()["semesters_completed"];

$sql = "SELECT course_name, credit_hours, course_id, grade, semester
        FROM register_courses INNER JOIN course_offerings 
        ON register_courses.offering_id = course_offerings.offering_id 
        INNER JOIN courses ON course_id = course_code
        WHERE semester < ? AND student_id = ? ORDER BY semester; ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $semesters_completed, $student_id);
$stmt->execute();
$result = $stmt->get_result();

// define a value for all available grades
$grade_values = [
    "A+" => 4,
    "A" => 4,
    "A-" => 3.75,
    "B+" => 3.5,
    "B" => 3,
    "B-" => 2.75,
    "C+" => 2.5,
    "C" => 2,
    "C-" => 1.75,
    "D" => 1,
    "F" => 0
];

if ($result->num_rows > 0) :
    // a list to keep the semester results separately
    $semester_results = [];

    // filter the results into 
    foreach ($result as $row) {
        $semester_results[$row["semester"]][] = $row;
    }
    
    // to keep track of previous gpa, will be used to calculate cgpa
    $gpa_list = [];

    // display a table for each semester
    foreach ($semester_results as $semester_result) :
        $semester = $semester_result[0]["semester"];
        $year = intdiv($semester, 2) + 1;
        $semester = $semester % 2 + 1;

        $status = "Promoted";
?>

        <div class="results">
            <p>Year <?php echo $year; ?>, Semester <?php echo $semester; ?></p>
            <table cell-spacing="0">
                <thead>
                    <td class="code">Course code</td>
                    <td class="title">Course title</td>
                    <td class="credit">Credit</td>
                    <td class="grade">Grade</td>
                    <td class="point">Grade Point</td>
                </thead>
                <tbody>

                    <?php
                    $total_credit = 0;
                    $total_gp = 0;

                    // display the results for individual courses
                    foreach ($semester_result as $row) : ?>
                        <tr>
                            <td class="code"><?php echo $row["course_id"]; ?></td>
                            <td class="title"><?php echo $row["course_name"]; ?></td>
                            <td class="credit"><?php echo $row["credit_hours"]; ?></td>
                            <td class="grade"><?php echo $row["grade"]; ?></td>
                            <td class="point"><?php echo $grade_values[$row["grade"]]; ?></td>
                        </tr>
                    <?php

                    $total_credit += $row["credit_hours"];
                    $total_gp += ($grade_values[$row["grade"]] * $row["credit_hours"]);

                    if ($row["grade"] == "F") {
                        $status = "Not Promoted";
                    }
                    
                    endforeach; 
                    
                    // calculate the semester gpa
                    $sgpa = $total_gp / $total_credit;
                    // add the semester gpa to the gpa list
                    $gpa_list[] = $sgpa;
                    
                    // calculate the cummulative gpa from the gpa list
                    $cgpa = array_sum($gpa_list) / count($gpa_list);
                    ?>

                    <tr class="footer">
                        <td colspan="2">Status: <?php echo $status; ?></td>
                        <td>Total credits: <?php echo $total_credit; ?></td>
                        <td>SGPA: <?php echo number_format($sgpa, 2); ?></td>
                        <td>CGPA: <?php echo number_format($cgpa, 2) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p class="no-completed-courses">
        There are no courses that you have completed, come back again when you have completed courses.
    </p>
<?php endif; ?>