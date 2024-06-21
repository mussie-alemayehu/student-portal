<?php
require_once "../connection.php";

$grades = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach (array_keys($_POST) as $key) {
        $grades[] = ["offering_id" => $key, "grade" => $_POST[$key]];
    }

    $student_id = $_POST["student_id"];

    $sql = "SELECT semesters_completed, year FROM student_info WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // handle semester transition for the student here
    $semesters_completed = $result["semesters_completed"] + 1;
    $newyear = $result["year"];
    if ($semesters_completed % 2 == 0 && $newyear < 4) $newyear++;

    // create an array that will hold the success or failure of the update queries
    $success = [];

    $sql = "UPDATE register_courses SET grade = ? WHERE offering_id = ? AND student_id = ?";
    $stmt = $conn->prepare($sql);
    foreach ($grades as $item) {
        $stmt->bind_param("sis", $item["grade"], $item["offering_id"], $student_id);
        $success[] = $stmt->execute();
    }
    $stmt->close();

    if (in_array(false, $success)) {
        echo "An error occured.";
    } else {
        echo $newyear . $semesters_completed;
        $sql = "UPDATE student_info SET year = ?, semesters_completed = ? WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $newyear, $semesters_completed, $student_id);
        if ($stmt->execute());
        header("Location: index.php");
    }
}
?>