<?php
$valid_username = "Admin";
$valid_password = "grader123";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == $valid_username && $password == $valid_password) {
        header("Location: staff.php");
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login as Staff</title>
    <link rel="stylesheet" href="auth-style.css">
</head>
<body>
    <div class="login-container">
        <form action="index.php" method="post" class="login-form">
            <input type="text" placeholder="Username" id="username" name="username" required>
            <input type="password" placeholder="Password" id="password" name="password" required>
            <p class="error"><?php echo $error; ?></p>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>