<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../side-nav-styles.css">
    <link rel="stylesheet" href="tables-style.css">
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

    <div class="results">
        <table cell-spacing="0">
            <thead>
                <td class="code">Course code</td>
                <td class="title">Course title</td>
                <td class="credit">Credit</td>
                <td class="grade">Grade</td>
                <td class="point">Grade Point</td>
            </thead>
            <tbody>
                
                <?php
                for ($i = 0; $i < 6; $i++) {
                    echo '
                    <tr>
                        <td class="code">CS101</td>
                        <td class="title">Intro to Programming</td>
                        <td class="credit">3</td>
                        <td class="grade">A+</td>
                        <td class="point">4</td>
                    </tr>';
                }
                ?>
                
            </tbody>
        </table>
    </div>

</body>

</html>