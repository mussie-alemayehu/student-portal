
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

    <?php foreach($result as $course): ?>
        <div class="course-item">
            <div>
                <p class="course-name"><?php echo $course["course_name"]; ?></p>
                <p class="subtitles">Credit Hour: <?php echo $course["credit_hours"]; ?></p>
                <p class="subtitles">Course Code: <?php echo $course["course_id"]; ?></p>
            </div>
            <img src="education-hat.png" alt="course-icon">
        </div>
    <?php endforeach; ?>
</div>
<div class="previous-courses">
    <p class="section-header">Previous courses</p>
    <div class="previous-course-item">
        <p class="course-name">
            <span>OOP </span><span class="grade">A+</span>
        </p>
    </div>
</div>