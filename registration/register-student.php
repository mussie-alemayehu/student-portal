<?php

function register_student($conn, $courses) {
    $student_id = $_SESSION['user_id'];

    $date = date("Y-m-d");
    $grade = "NA";

    $sql = "INSERT INTO register_courses (student_id, offering_id, registration_date, grade)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($courses as $course) {
        $offering_id = $course['offering_id'];

        $stmt->bind_param("siss", $student_id, $offering_id, $date, $grade);
        $stmt->execute();
    }
}
