<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$stud_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $year = $_GET["year"];
    $semester = $_GET["semester"];

    if ($semester == "one") {
        $semester_count = 0;
    } else {
        $semester_count = 1;
    }

    $semesters_completed = ($year - 1) * 2 + $semester_count;
}

if (file_exists("connection.php")) {
    require_once("connection.php");
} else {
    require_once("../connection.php");
}

// fetch student information to use for fetching data
$sql = "SELECT department_id
        FROM student_info WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $stud_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$department_id = $result["department_id"];
// $semesters_completed = $result["semesters_completed"];
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
            <td><?php echo $counter;
                $counter++; ?></td>
            <td><?php echo $course['course_code']; ?></td>
            <td><?php echo $course['course_name']; ?></td>
            <td><?php echo $course['credit_hours']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
// include the function to register students to courses based on the
// location of the "register-student.php" file
if (file_exists("register-student.php")) {
    include "register-student.php";
} else {
    include "registration/register-student.php";
}
?>
<button action="<?php register_student($conn, $courses); ?>" id="register-courses-button" class="btn">
    Register for courses
</button>