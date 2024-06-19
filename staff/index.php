<?php
require_once "../connection.php";

$departments = [
    ["code"=>"BIO", "name"=>"Biology"],
    ["code"=>"CHEM", "name"=>"Chemistry"],
    ["code"=>"CS", "name"=>"Computer Science"],
    ["code"=>"ENG", "name"=>"English"],
    ["code"=>"IS", "name"=>"Information Science"],
    ["code"=>"MATH", "name"=>"Mathematics"],
    ["code"=>"PHY", "name"=>"Physics"]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff</title>
    <link rel="stylesheet" href="staff-styles.css">
</head>
<body>
    <div class="selectors">
        <form action="index.php" method="get">
            <select name="department" required>
                <option value="">Select students department...</option>
                <?php foreach($departments as $department) : ?>
                    <option value="<?php echo $department["code"] ?>"><?php echo $department["name"] ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <select name="year" required>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
                <option value="4">Four</option>
            </select>

            <input type="submit" name="submit" value="Get students">
        </form>
    </div>
</body>
</html>