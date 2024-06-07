<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="side-nav-styles.css">
    <link rel="stylesheet" href="dashboard/main-contents-styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <script>
        $(document).ready(function() {
            $('#dashboard-link').click(function(event) {
                event.preventDefault();
                $('#main-contents').load('dashboard/index.php');
            });
        });
    </script>
</head>

<body>

    <?php
    session_start();

    // send the user to the login screen if there is no session info
    if (!isset($_SESSION["user_id"]) || !isset($_SESSION["username"])) {
        header("Location: auth/index.php");
        exit();
    }
    include("side-nav.php");
    ?>

    <div id="main-contents"></div>

</body>

</html>