
<?php
session_start();

if (isset($_SESSION["user_id"]) && isset($_SESSION["id"])) {
  header("Location: ../index.php");
  exit();
}

include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = htmlspecialchars($_POST["id"]);
  $password = $_POST["password"];

  require_once "connection.php";

  if (!empty($id) && !empty($password)) {

    $sql = "SELECT * FROM students WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $stored_password = $row["password"];

      if (password_verify($password, $stored_password)) {
        // Login successful
        $_SESSION["user_id"] = $row["id"];

        // check whether or not the user has added profile information
        $profile_added = ($row["profile_added"] != 0);
        
        // if profile is not added, go to the details page
        if (!$profile_added) {
          header("Location: details.php");
          exit();
        }

        // redirect the user to the dashboard page if profile is added
        header("Location: ../index.php");
        exit();
      } else {
        $error = "Incorrect password";
      }
    } else {
      $error = "Invalid id or password";
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
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input class="input-field" type="text" placeholder="id" name="id"><br>
      <input class="input-field" type="password" placeholder="Password" name="password"><br>
      <?php if (!empty($error)) : ?>
        <div class="error_message">
          <?php
          echo $error;
          ?>
        </div>
      <?php endif; ?>
      <a class="forgot-password" href="">Forgot password?</a><br>
      <input type="submit" name="submit" value="login" class="btn"><br>
    </form>
    <p class="left">Don't have an account?</p>
    <div style="display: inline-block; width: 15px"></div>
    <a href="signup.php"><button class="signup">Signup</button></a>
  </div>
</div>

<?php include 'right.php' ?>