<?php include('header.php'); ?>

<div class="left-container">
    <div class="inner-fields">
        <h1>Almost there</h1>
        <p class="description">Fill the following information to proceed,</p>
        <p class="description">Once completed, you will not be asked again.</p>
        <br>
        <form action="" method="post">
            <input class="input-field" type="text" placeholder="Full Name" required name="fullname"><br>
            <input class="input-field" type="email" placeholder="Email" required name="email"><br>
            <select class="input-field" required name="department">
                <option value="">Select Department</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Physics">Physics</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Information Science">Information Science</option>
                <option value="Biology">Biology</option>
                <option value="Business Administration">Business Administration</option>
                <option value="Economics">Economics</option>
                <option value="English">English</option>
            </select><br>
            <select class="input-field" required name="college">
                <option value="">Select College</option>
                <option value="CSS">CSS</option>
                <option value="CNCS">CNCS</option>
                <option value="CoBE">CoBE</option>
                <option value="AAiT">AAiT</option>
            </select><br>
            <br>
            <button class="btn">Finish</button>
        </form>
    </div>
</div>

<?php include('right.php'); ?>