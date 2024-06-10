
<?php
session_start();

// get our database connection
require_once "../connection.php";

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

    // prepare and execute the data insertion query
    $query = "INSERT INTO student_info (student_id, full_name, email, department, college, batch, year, semesters_completed) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
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
}

// prepare a new statement to fetch the list of available departments
$stmt = $conn->prepare("SELECT * FROM departments;");
$departments = [];

if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
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
                <!-- display the departments fetched above as options -->
                <?php foreach ($departments as $department): ?>
                    <option value="<?php echo htmlspecialchars($department["department_code"]); ?>">
                        <?php echo htmlspecialchars($department["department_name"]); ?>
                    </option>
                <?php endforeach ?>
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

<?php 
include('right.php');

$stmt->close();
$conn->close();
?>