<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($conn)) {
    require_once "../connection.php";
}

$student_id = $_SESSION["user_id"];

// select the courses that the student is currently taking
// determine the status of the courses based on the grade 
// if there is no grade, it means the student is taking that course currently
$sql = "SELECT student_id, register_courses.offering_id, course_name, credit_hours, course_id
        FROM register_courses INNER JOIN course_offerings 
        ON register_courses.offering_id = course_offerings.offering_id 
        INNER JOIN courses ON course_id = course_code
        WHERE grade = 'NA' AND student_id = ?;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="current-courses">
    <p class="section-header">You are currently taking the following courses:</p>

    <?php if ($result->num_rows > 0) : ?>
        <?php foreach ($result as $course) : ?>
            <div class="course-item">
                <div>
                    <p class="course-name"><?php echo $course["course_name"]; ?></p>
                    <p class="subtitles">Credit Hour: <?php echo $course["credit_hours"]; ?></p>
                    <p class="subtitles">Course Code: <?php echo $course["course_id"]; ?></p>
                </div>
                <img src="education-hat.png" alt="course-icon">
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>You are not registered to courses at the moment.</p>
    <?php endif; ?>
</div>
<div class="previous-courses">
    <p class="section-header">Previous courses</p>
    <?php
    // obtain how many semesters the student has currently completed to fetch completed courses later
    $sql = "SELECT semesters_completed FROM student_info WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $semesters_completed = $stmt->get_result()->fetch_assoc()["semesters_completed"];
    $stmt->close();

    // fetch the completed courses and display them
    // we will display a message if there are no courses that are completed currently
    $sql = "SELECT course_name, course_id, grade
            FROM register_courses INNER JOIN course_offerings 
            ON register_courses.offering_id = course_offerings.offering_id 
            INNER JOIN courses ON course_id = course_code
            WHERE student_id = ? AND semester < ?;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $student_id, $semesters_completed);
    $stmt->execute();
    $previous_courses = $stmt->get_result();

    if ($previous_courses->num_rows > 0) :
    ?>
        <?php foreach ($previous_courses as $course) : ?>
            <div class="previous-course-item">
                <span class="course-id"><?php echo $course["course_id"]; ?></span>
                <span class="course-name"><?php echo $course["course_name"]; ?></span>
                <span class="grade"><?php echo $course["grade"]; ?></span>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Once you have completed courses, they will appear here.</p>
    <?php endif; ?>
</div>