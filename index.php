<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="side-nav-styles.css">
    <link rel="stylesheet" href="dashboard/main-contents-styles.css">
    <script src="https://kit.fontawesome.com/13dd5a24f4.js" crossorigin="anonymous"></script>
    <style>
        /* internal style required to overwrite the web styles of the icons */
        .nav-icon {
            display: inline-block;
            width: 25px;
            text-align: left;
            color: rgb(227, 223, 223);
        }
    </style>
</head>

<body>

    <?php
    session_start();

    // send the user to the login screen if there is no session info
    if (!isset($_SESSION["user_id"]) || !isset($_SESSION["username"])) {
        // header("Location: auth/index.php");
        echo("no registered student found");
    }
    include("side-nav.php");
    ?>

    <div class="main-contents">
        <?php
        include("dashboard/index.php");
        ?>
    </div>

</body>

</html>