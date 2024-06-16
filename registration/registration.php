<div id="semester-selectors">
    <select name="year" class="selector left">
        <option value="">Select your year...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <!-- <div class="divider"></div> -->
    <select name="semester" class="selector right">
        <option value="">Select your semester</option>
    </select>
</div>

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$stud_id = $_SESSION["user_id"];

if (file_exists("connection.php")) {
    require_once("connection.php");
} else {
    require_once("../connection.php");
}

// fetch student information to use for fetching data
$sql = "SELECT department_id, semesters_completed
        FROM student_info WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $stud_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$department_id = $result["department_id"];
$semesters_completed = $result["semesters_completed"];
$stmt->close();

// fetch the courses for the particular semester the student is registering for
$sql = "SELECT course_code, course_name, credit_hours FROM 
        courses INNER JOIN course_offerings ON course_id = course_code
        AND semester = ? AND department_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $semesters_completed, $department_id);
$stmt->execute();

// here is the result of the semester courses the student is registering for
$result = $stmt->get_result()->fetch_all();

?>

<div class="registering-courses">
    <table>
        <thead>
            <td>No. </td>
            <td>Course code</td>
            <td>Name</td>
            <td>Credit hours</td>
        </thead>
        <?php
        $counter = 1;

        foreach ($result as $course) :
        ?>
            <tr>
                <td><?php echo $counter; $counter++; ?></td>
                <td><?php echo $course[0]; ?></td>
                <td><?php echo $course[1]; ?></td>
                <td><?php echo $course[2]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="btn-container">
    <button action="index.php" class="btn">Register for courses</button>
</div>