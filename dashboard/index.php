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

    <?php
    // obtain the student information data from the database and initialize
    $data = [
        ['title' => 'Name', 'info' => 'Mussie Alemayehu'],
        ['title' => 'Department', 'info' => 'Computer Science'],
        ['title' => 'ID', 'info' => 'UGR/0067/14'],
        ['title' => 'College', 'info' => 'CNCS'],
        ['title' => 'Year', 'info' => 'III'],
    ];

    // display the information obtained
    foreach ($data as ['title' => $title, 'info' => $info]) {
        echo "
                    <p>
                        <span class=\"title\">$title: </span>
                        <span class=\"info\">$info</span>
                    </p>
                    ";
    }
    ?>

</div>