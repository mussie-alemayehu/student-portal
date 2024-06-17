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
<?php

if (file_exists('registration-form.js')) {
    echo 'together';
} else {
    $js = "registration/registration-form.js";
}
?>
<script src="<?php echo $js; ?>"></script>
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
$sql = "SELECT course_code, course_name, credit_hours, offering_id FROM 
        courses INNER JOIN course_offerings ON course_id = course_code
        AND semester = ? AND department_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $semesters_completed, $department_id);
$stmt->execute();

// here is the result of the semester courses the student is registering for
$courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

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

        foreach ($courses as $course) :
        ?>
            <tr>
                <td><?php echo $counter; $counter++; ?></td>
                <td><?php echo $course['course_code']; ?></td>
                <td><?php echo $course['course_name']; ?></td>
                <td><?php echo $course['credit_hours']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="btn-container">
    <?php include "register-student.php"; ?>
    <button action="<?php register_student($conn, $courses); ?>" id="register-courses-button" class="btn">Register for courses</button>
</div>