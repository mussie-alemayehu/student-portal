<div id="semester-selectors">
    <select id="yearSelector" name="year" class="selector left">
        <option value="">Select your year...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <select id="semesterSelector" name="semester" class="selector right" disabled>
        <option value="">Select your semester</option>
        <option value="one">One</option>
        <option value="two">Two</option>
    </select>
</div>

<?php
// include the registration form javascript file by first checking its location
if (file_exists('registration-form.js')) {
    $js = "registration-form.php";
} else {
    $js = "registration/registration-form.js";
}
?>
<script src="<?php echo $js; ?>"></script>

<!-- this container will be used to display the appropriate information based
 on the values of the selected year and semester -->
<div id="registering-courses">
    <p>Please choose a year and semester to view courses.</p>
</div>

<div class="btn-container">
    <?php
    // include the function to register students to courses based on the
    // location of the "register-student.php" file
    if (file_exists("register-student.php")) {
        include "register-student.php";
    } else {
        include "registration/register-student.php";
    }
    ?>
    <button action="<?php register_student($conn, $courses); ?>" id="register-courses-button" class="btn">
        Register for courses
    </button>

    <button action="" id="fetch-courses-button" class="btn">Fetch courses</button>
</div>