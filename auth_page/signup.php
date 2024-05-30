<?php include 'header.php'
?>

<?php
session_start();

// Database connection
require_once "connection.php";

// Handle form submission
if (isset($_POST["submit"])) {
    // Input validation
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Password hashing and salting
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Check if the form fields are not empty
    if (!empty($username) && !empty($password) && !empty($confirm_password)) {
        // Check if the username already exists
        $student_id_query = "SELECT * FROM user WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $student_id_query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error = "The user with this username already exists. Please try again with a different username.";
        } elseif ($password !== $confirm_password) {
            $error = "The password didn't match, please try again.";
        } else {
            // Prepare and execute the query with prepared statements
            $sql = "INSERT INTO user(username, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $password_hash);
            if (mysqli_stmt_execute($stmt)) {
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

    // Close the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
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
                <?php if(!empty($error)): ?>
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
