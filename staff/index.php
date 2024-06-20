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

$year = "";
$code = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit"])) {
    $year = $_GET["year"];
    $code = $_GET["department"];
}

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
                    <option value="<?php echo $department["code"] ?>" <?php if ($department["code"] == $code) echo "selected"; ?>>
                        <?php echo $department["name"] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <select name="year" required>
                <option value="">Select students year....</option>
                <option value="1" <?php if ($year == 1) echo "selected"; ?>>One</option>
                <option value="2" <?php if ($year == 2) echo "selected"; ?>>Two</option>
                <option value="3" <?php if ($year == 3) echo "selected"; ?>>Three</option>
                <option value="4" <?php if ($year == 4) echo "selected"; ?>>Four</option>
            </select>

            <input type="submit" name="submit" value="Get students">
        </form>
    </div>

    <div class="students">
        <?php if ($year != "" && $code != "") : ?>
            <?php 
            $sql = "SELECT student_id, full_name FROM student_info WHERE department_id = ? AND year = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $code, $year);
            $stmt->execute();
            $result = $stmt->get_result();

            foreach ($result as $student) :
            ?>
                <div class="student">
                    <p class="name"><?php echo $student["full_name"]; ?></p>
                    <p class="id"><?php echo $student["student_id"]; ?></p>
                    <p class="goto">></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="message">Select which class students you want to view.</p>
        <?php endif; ?>
    </div>
</body>
</html>