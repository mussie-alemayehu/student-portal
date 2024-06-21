<?php $user_id = $_SESSION["user_id"]; ?>

<header>
    <div class="content">
        <img src="education.png" alt="">
        <p>Portal</p>
    </div>
    <div class="links">
        <a id="top-dashboard-link" href="#">Dashboard</a>
        <a id="top-registration-link" href="#">Registration</a>
        <a id="top-courses-link" href="#">Courses</a>
        <a id="top-results-link" href="#">Results</a>
    </div>
    <div class="profile">
        <p><?php echo $user_id; ?></p>
    </div>
</header>