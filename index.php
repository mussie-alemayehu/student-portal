<?php
session_start();

// send the user to the login screen if there is no session info
if (!isset($_SESSION["user_id"])) {
    header("Location: auth/index.php");
    exit();
}

// get our database connection
require_once "connection.php";

// prepare a SQL statement to fetch information about a student with the session id
$sql = "SELECT * FROM students WHERE id = ? LIMIT 1";
$id = $_SESSION["user_id"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profile_added = ($row["profile_added"] != 0);

    // if the "profile_added" value is true, proceed with page
    // otherwise, go to the details page because it means that the student has
    // not provided the necessary information
    if (!$profile_added) {
        header("Location: auth/details.php");
        exit();
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="side-nav-styles.css">
    <link rel="stylesheet" href="dashboard/main-contents-styles.css">
    <link rel="stylesheet" href="courses/main-contents-styles.css">
    <link rel="stylesheet" href="results/tables-style.css">
    <link rel="stylesheet" href="registration/registration-styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/13dd5a24f4.js" crossorigin="anonymous"></script>
    <style>
        /* internal style required to overwrite the web styles of the icons */
        .nav-icon {
            display: inline-block;
            width: 25px;
            text-align: left;
            color: rgb(227, 223, 223);
        }
    </style>
    <script src="navigation.js"></script>
</head>

<body>
    <?php include("header.php"); ?>
    <?php include("side-nav.php"); ?>
    <!-- this is where the container where the main contents of the page will be placed -->
    <div id="main-contents">
        <?php
        // include('dashboard/dashboard.php');
        include('courses/courses.php');
        ?>
    </div>

</body>

</html>