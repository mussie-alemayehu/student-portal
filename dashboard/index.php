<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../side-nav-styles.css">
    <link rel="stylesheet" href="styles/main-contents-styles.css">
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
        // include the side navigation bar 
        include("../side-nav.php"); 
    ?>
    <div class="main-contents">
        <div class="profile">
            <p>username</p>
        </div>
        <div class="welcome-banner">
            <p class="date-time">May 14, 2024</p>
            <p class="welcome-message">Welcome back, Mussie</p>
            <img src="education.png" alt="education icon">
        </div>
        <div class="profile-info">
            <img src="user.png" alt="Student Image">
            <div class="header">
                <p class="title">Student Basic Info</p>
                <p class="subtitle">Addis Ababa University</p>
            </div>
            <p>
                <span class="title">Name: </span>
                <span class="info">Mussie Alemayehu</span>
            </p>
            <p>
                <span class="title">Department: </span>
                <span class="info">Computer Science</span>
            </p>
            <p>
                <span class="title">ID: </span>
                <span class="info">UGR/0067/14</span>
            </p>
            <p>
                <span class="title">College: </span>
                <span class="info">CNCS</span>
            </p>
            <p>
                <span class="title">Year: </span>
                <span class="info">III</span>
            </p>
        </div>
    </div>
</body>

</html>