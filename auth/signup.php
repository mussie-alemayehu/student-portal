<?php include 'header.php'
?>

<?php
session_start();

require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = strtoupper(htmlspecialchars($_POST["id"]));
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if (!preg_match("/^(UGR|NSE)\/[0-9]{4}\/[0-9]{2}$/", $id)) {
        $error = "Invalid ID format.";
    } 
    // check if the form fields are not empty
    else if (!empty($id) && !empty($password) && !empty($confirm_password)) {
        // check if the id already exists
        $student_id_query = "SELECT * FROM students WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $student_id_query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            $error = "The user with this ID already exists. Please try again with a different ID.";
        } elseif ($password !== $confirm_password) {
            $error = "The password didn't match, please try again.";
        } else {
            // Prepare and execute the query with prepared statements
            $sql = "INSERT INTO students (id, password, profile_added) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            $profile = 0;
            $stmt->bind_param("ssi", $id, $password_hash, $profile);
            if ($stmt->execute()) {
                $_SESSION["user_id"] = $id;
                header("Location: details.php");
                exit();
            } else {
                $error = "Something went wrong";
            }
        }

        $stmt->close();
        $conn->close();
    } else {
        $error = "All fields are required";
    }
}
?>


<div class="left-container">
    <div class="inner-fields">
        <h1>Signup</h1>
        <p class="description">Create a new account</p>
        <br>
        <form action="" method="post" autocomplete="off">
            <input class="input-field" type="text" placeholder="ID" required name="id"><br>
            <input class="input-field" type="password" placeholder="Password" required name="password"><br>
            <input class="input-field" type="password" placeholder="Confirm Password" required name="confirm_password"><br><br>
            <?php if (!empty($error)) : ?>
                <div class="error_message">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <button class="btn" name="submit">Signup</button><br>
        </form>
        <p class="left">Already have an account?</p>
        <div style="display: inline-block; width: 15px"></div>
        <a href="index.php"><button class="signup">Login</button></a>
    </div>
</div>


<?php include 'right.php' ?>