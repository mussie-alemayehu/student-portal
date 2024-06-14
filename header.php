<?php $user_id = $_SESSION["user_id"]; ?>

<header>
    <div class="content">
        <img src="education.png" alt="">
        <p>Portal</p>
    </div>
    <div class="links">
        <a href="#">Dashboard</a>
        <a href="#">Registration</a>
        <a href="#">Courses</a>
        <a href="#">Results</a>
    </div>
    <div class="profile">
        <p><?php echo $user_id; ?></p>
    </div>
</header>