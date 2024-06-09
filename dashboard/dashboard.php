<?php
$user_id = $_SESSION["user_id"];

// check if session is already started and start a new one if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// check if connection exists and create one if it doesn't
if (!$conn) {
    require_once "../connection.php";
}

// prepare a sql statement to get full information about the logged in user
$query = "SELECT * FROM student_info WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_id);

if ($stmt->execute()) {
    $result = $stmt->get_result()->fetch_assoc();
    $full_name = $result["full_name"];
    $department = $result["department"];
    $college = $result["college"];
    $year = $result["year"];
}

$stmt->close();
$conn->close();
?>

<div class="profile">
    <p><?php echo $user_id; ?></p>
</div>
<div class="welcome-banner">
    <p class="date-time"><?php echo date('F j, Y') ?></p>
    <p class="welcome-message">Welcome back, <?php echo $full_name; ?></p>
    <img src="education.png" alt="education icon">
</div>
<div class="profile-info">

    <img src="user.png" alt="Student Image">

    <div class="header">
        <p class="title">Student Basic Info</p>
        <p class="subtitle">Addis Ababa University</p>
    </div>

    <?php
    // obtain the student information data from the database and initialize
    $data = [
        ['title' => 'Name', 'info' => $full_name],
        ['title' => 'Department', 'info' => $department],
        ['title' => 'ID', 'info' => $user_id],
        ['title' => 'College', 'info' => $college],
        ['title' => 'Year', 'info' => $year],
    ];

    // display the information obtained
    foreach ($data as ['title' => $title, 'info' => $info]) {
        ?>
        <p>
            <span class="title"><?php echo $title ?>: </span>
            <span class="info"><?php echo $info ?></span>
        </p>
        <?php
    }
    ?>

</div>