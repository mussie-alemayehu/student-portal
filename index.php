<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="side-nav-styles.css">
    <link rel="stylesheet" href="dashboard/main-contents-styles.css">
    <link rel="stylesheet" href="courses/main-contents-styles.css">
    <link rel="stylesheet" href="results/tables-style.css">
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

            // define the link id and the assciated content in a list of maps
            // the individual maps will hold the id of the anchor tags as 'link_id' and
            // the path to the php files containing the respective content as 'content'
            var navigation = [
                new Map([
                    ['link_id', '#dashboard-link'],
                    ['content', 'dashboard/dashboard.php'],
                ]),
                new Map([
                    ['link_id', '#courses-link'],
                    ['content', 'courses/courses.php'],
                ]),
                new Map([
                    ['link_id', '#results-link'],
                    ['content', 'results/results.php'],
                ]),
            ];

            // register click events for all the navigation items defined in the list
            for (let item of navigation) {
                $(item.get('link_id')).click(function(event) {
                    event.preventDefault();
                    $('.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $('#main-contents').load(item.get('content'));
                });
            }

            // register a click event for the logout link
            $('#logout-link').click(function(event) {
                event.preventDefault();
                $.post('logout.php', function() {
                    window.location.href = 'auth/index.php';
                });
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
    <!-- this is where the container where the main contents of the page will be placed -->
    <div id="main-contents">
        <?php
        include('dashboard/dashboard.php');
        ?>
    </div>

</body>

</html>