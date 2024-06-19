<?php

// start a new session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// create a connection if not already created
if (!isset($conn)) {
    require_once "../connection.php";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_SESSION['user_id'];

    // create an empty array to hold all the "offering_id"s and extract them from the provided post method
    $offering_id_collection = [];
    $offering_id_collection[] = $_POST["1"];
    $offering_id_collection[] = $_POST["2"];
    $offering_id_collection[] = $_POST["3"];
    $offering_id_collection[] = $_POST["4"];
    $offering_id_collection[] = $_POST["5"];

    print_r($offering_id_collection);

    $date = date("Y-m-d");
    $grade = "NA";

    // prepare a statement to insert the registration attributes to the database
    $sql = "INSERT INTO register_courses (student_id, offering_id, registration_date, grade)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($offering_id_collection as $offering_id) {
        $stmt->bind_param("siss", $student_id, $offering_id, $date, $grade);
        $stmt->execute();
    }

    // go to the main page after the data insertion is completed
    header("Location: ../index.php");
}
?>