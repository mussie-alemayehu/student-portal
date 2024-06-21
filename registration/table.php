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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $year = $_GET["year"];
    $semester = $_GET["semester"];

    if ($semester == "one") {
        $semester_count = 0;
    } else {
        $semester_count = 1;
    }

    // we need to find the completed semesters so we can use them to fetch
    // courses associated with that specific semester
    $selected_semesters_completed = ($year - 1) * 2 + $semester_count;
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
$stmt->bind_param("is", $selected_semesters_completed, $department_id);
$stmt->execute();

// here is the result of the semester courses the student is registering for
$courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$sample_offering = $courses[0]["offering_id"];
$sql = "SELECT offering_id FROM register_courses WHERE student_id = ? AND offering_id = $sample_offering";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $stud_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) :
?>
    <p>You have already registered for this semester.</p>
<?php elseif ($selected_semesters_completed == $semesters_completed) : ?>
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

    <form action="registration/register-student.php" method="POST">
        <?php
        $count = 1;
        foreach ($courses as $course) :
        ?>

            <!-- create hidden input fields to submit values-->
            <input type="hidden" name="<?php echo $count; ?>" value="<?php echo $course["offering_id"]; ?>">

        <?php $count++;
        endforeach; ?>
        <button type="submit" id="register-courses-button" class="btn">
            Register for courses
        </button>
    </form>
<?php else : ?>
    <p>You have not reached this semester yet, please choose a semester you have already reached.</p>
<?php endif; ?>