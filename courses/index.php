<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Courses</title>
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
        <div class="current-courses">
            <p class="section-header">You are currently taking the following courses:</p>

            <?php
            for ($i = 0; $i < 6; $i++) {
                echo '
                <div class="course-item">
                    <div>
                        <p class="course-name">Object-Oriented Programming</p>
                        <p class="credit">Credit Hour: 3</p>
                    </div>
                    <img src="../education-hat.png" alt="course-icon">
                </div>
                ';
            }
            ?>
        </div>
        <div class="previous-courses">
            <p class="section-header">Previous courses</p>
            <div class="previous-course-item">
                <p class="course-name">
                    <span>OOP </span><span class="grade">A+</span>
                </p>
            </div>
        </div>
    </div>
</body>

</html>