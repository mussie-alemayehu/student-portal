<?php include 'header.php'; ?>

<?php
// Start the session
session_start();

// Handle form submission
if (isset($_POST["submit"])) {
  // Sanitize and validate user input
  $username = htmlspecialchars($_POST["username"]);
  $password = $_POST["password"];

  require_once "connection.php";

  if (!empty($username) && !empty($password)) {

    $sql = "SELECT * FROM students WHERE username = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $stored_password = $row["password"];

      if (password_verify($password, $stored_password)) {
        // Login successful
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["username"] = $row["username"];

        // Redirect the user to the dashboard page and exit the script
        echo "<script>alert('Login successfully')</script>";
        header("Location: ../dashboard/index.php");
        exit(); // Prevent the default form submission behavior
      } else {
        $error = "Incorrect password";
      }
    } else {
      $error = "Invalid username or password";
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
    <h1>Login</h1>
    <p class="description">Enter your account details</p>
    <br />
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input class="input-field" type="text" placeholder="Username" name="username" /><br />
      <input class="input-field" type="password" placeholder="Password" name="password" /><br />
      <a class="forgot-password" href="">Forgot password?</a><br />
      <?php if (!empty($error)) : ?>
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