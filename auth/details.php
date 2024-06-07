
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // extract all the data we are going to send to the database into variables
    $stud_id = $_SESSION["user_id"];
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $department = htmlspecialchars($_POST['department']);
    $college = htmlspecialchars($_POST['college']);
    $batch = date("Y");
    $year = 1;
    $semesters_completed = 0;

    // get our database connection
    require_once "connection.php";

    // prepare and execute the data insertion query
    $stmt = $conn->prepare("INSERT INTO student_info (student_id, full_name, email, department, college, batch, year, semesters_completed) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiis", $stud_id, $fullname, $email, $department, $college, $batch, $year, $semesters_completed);

    if ($stmt->execute()) {
        // update the "profile_added" flag to indicate the user has provided the required information
        $user_id = $_SESSION["user_id"];
        $stateUpdateStmt = $conn->prepare("UPDATE students SET profile_added = 1 WHERE id = ?;");
        $stateUpdateStmt->bind_param("i", $user_id);
        if($stateUpdateStmt->execute()) {
            // go to the dashboard upon successful completion of the queries
            header("Location: ../index.php");
            $stmt->close();
            $stateUpdateStmt->close();
            exit();
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include('header.php'); ?>

<div class="left-container">
    <div class="inner-fields">
        <h1>Almost there</h1>
        <p class="description">Fill the following information to proceed,</p>
        <p class="description">Once completed, you will not be asked again.</p>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input class="input-field" type="text" placeholder="Full Name" required name="fullname"><br>
            <input class="input-field" type="email" placeholder="Email" required name="email"><br>
            <select class="input-field" required name="department">
                <option value="">Select Department</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Physics">Physics</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Information Science">Information Science</option>
                <option value="Biology">Biology</option>
                <option value="Business Administration">Business Administration</option>
                <option value="Economics">Economics</option>
                <option value="English">English</option>
            </select><br>
            <select class="input-field" required name="college">
                <option value="">Select College</option>
                <option value="CSS">CSS</option>
                <option value="CNCS">CNCS</option>
                <option value="CoBE">CoBE</option>
                <option value="AAiT">AAiT</option>
            </select><br>
            <br>
            <input type="submit" class="btn" name="submit" value="Finish">
        </form>
    </div>
</div>

<?php include('right.php'); ?>