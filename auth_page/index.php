<?php include 'header.php';?>

<?php
// Start the session
session_start();

// Handle form submission
if (isset($_POST["submit"])) {
    // Sanitize and validate user input
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = $_POST["password"];

    // Connect to the database
    require_once "connection.php";

    // Check if the form fields are not empty
    if (!empty($username) && !empty($password)) {
        // Prepare and execute the query using prepared statements
        $sql = "SELECT * FROM user WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row["password"];

            // Verify the password using the secure password_verify() function
            if (password_verify($password, $stored_password)) {
                // Login successful
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];

                // Redirect the user to the dashboard page and exit the script
                echo "<script>alert('Login successfully')</script>";
                header("Location: ../dashboard/index.php");
                exit(); // Prevent the default form submission behavior
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid username or password";
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
        <h1>Login</h1>
        <p class="description">Enter your account details</p>
        <br />
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <input
            class="input-field"
            type="text"
            placeholder="Username"
            name="username"
          /><br />
          <input
            class="input-field"
            type="password"
            placeholder="Password"
            name="password"
          /><br />
          <a class="forgot-password" href="">Forgot password?</a><br />
          <?php if(!empty($error)): ?>
                            <div class="error_message">
                                <?php 
                                    echo $error; 
                                ?>
                            </div>
                        <?php endif; ?>
          <input type="submit" name="submit" value="login" class="btn"><br />
        </form>
        <p class="left">Don't have an account?</p>
        <div style="display: inline-block; width: 15px"></div>
        <a href="signup.php"><button class="signup">Signup</button></a>
      </div>
    </div>

  <?php include 'right.php' ?>
