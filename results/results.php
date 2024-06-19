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

$sql = "SELECT course_name, credit_hours, course_id, grade
        FROM register_courses INNER JOIN course_offerings 
        ON register_courses.offering_id = course_offerings.offering_id 
        INNER JOIN courses ON course_id = course_code
        WHERE semester < ?; ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $semesters_completed);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) :
?>

<div class="results">
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
            for ($i = 0; $i < 6; $i++) : ?>
                <tr>
                    <td class="code">CS101</td>
                    <td class="title">Intro to Programming</td>
                    <td class="credit">3</td>
                    <td class="grade">A+</td>
                    <td class="point">4</td>
                </tr>
            <?php endfor; ?>

            <tr class="footer">
                <td colspan="2">Status: promoted</td>
                <td>Total credits: 12</td>
                <td>SGPA: 4</td>
                <td>CGPA: 3.8</td>
            </tr>
        </tbody>
    </table>
</div>
<?php else : ?>
    <p class="no-completed-courses">
        There are no courses that you have completed, come back again when you have completed courses.
    </p>
<?php endif; ?>