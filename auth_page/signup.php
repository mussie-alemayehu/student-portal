<?php include 'header.php'
?>

<?php
session_start();

require_once "connection.php";

if (isset($_POST["submit"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // check if the form fields are not empty
    if (!empty($username) && !empty($password) && !empty($confirm_password)) {
        // check if the username already exists
        $student_id_query = "SELECT * FROM students WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $student_id_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            $error = "The user with this username already exists. Please try again with a different username.";
        } elseif ($password !== $confirm_password) {
            $error = "The password didn't match, please try again.";
        } else {
            // Prepare and execute the query with prepared statements
            $sql = "INSERT INTO students (username, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            $stmt->bind_param("ss", $username, $password_hash);
            if ($stmt->execute()) {
                echo "<script>alert('Signup successfully')</script>";
                header("Location: index.php");
                exit();
            } else {
                $error = "Something went wrong";
            }
        }
    } else {
        $error = "All fields are required";
    }

    $stmt->close();
    $conn->close();
}
?>


<div class="left-container">
    <div class="inner-fields">
        <h1>Signup</h1>
        <p class="description">Create a new account</p>
        <br />
        <form action="" method="post">
            <input class="input-field" type="text" placeholder="Username" required name="username" /><br />
            <input class="input-field" type="password" placeholder="Password" required name="password" /><br />
            <input class="input-field" type="password" placeholder="Confirm Password" required name="confirm_password" /><br /><br />
            <?php if (!empty($error)) : ?>
                <div class="error_message">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <button class="btn" name="submit">Signup</button><br />
        </form>
        <p class="left">Already have an account?</p>
        <a href="index.php"><button class="signup">Login</button></a>
    </div>
</div>


<?php include 'right.php' ?>