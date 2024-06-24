# Student Portal

The student portal is a comprehensive web-based platform designed to streamline the academic management process for educational institutions. This portal allows students to register, view their status, enroll in courses and track their academic progress seamlessly.

Developed using only HTML, CSS, JavaScript, and PHP, we made it as a Web Development project where we were not allowed to use any frameworks. Leave a star if you find this helpful.

## Table of Contents
- [Key Features](#key-features)
- [Installation](#installation)

## Key features
- **Student Registration**: Easy and secure student registration process.
- **Student Status Display**: Real-time updates on student enrollment status and academic standing.
- **Course Enrollment**: Simple course registration system with a user-friendly interface.
- **Grade Entry**: Authorized users will be able to enter grades for existing students in the system.
- **Grade Tracking**: Detailed records of student grades, providing a transparent view of academic performance.

## Installation
1. Setup a local server environment (such as XAMPP, WAMP, or MAMP)
    You can find XAMPP [here](https://www.google.com/url?sa=t&source=web&rct=j&opi=89978449&url=https://www.apachefriends.org/download.html&ved=2ahUKEwjXufqht_KGAxWta_EDHVC2ATEQFnoECAYQAQ&usg=AOvVaw0FJaxz5J9FUgyQIdXelZ6c)

2. Clone the repository in your "htdocs" folder:
    ```sh
    git clone https://github.com/mussie-alemayehu/student-portal.git
    ```

3. Create a "student_portal" database in your local MySQL server

4. Open the "connection.php" file and create your own connection to the local MySQL server

5. Create the tables required in the database. This can be done by running the SQL query found in "database/tables.sql". The tables should be created in the order they appear in the "tables.sql" file, otherwise foreign keys might become a problem.

6. Add the required data to the tables created on the previous step. Execute the queries found in "departments.sql", "courses.sql" and "course_offerings.sql" respectively.

7. Your student portal is now ready to go.

## Usage

To use the Student Portal, follow these steps:

1. **Start the Server**:
    - Ensure you have a local server environment set up (such as XAMPP, WAMP, or MAMP) to run PHP scripts.
    - Place the project files in the `htdocs` directory (or equivalent) of your server setup.
    - Start the Apache and MySQL servers from your local server control panel.

2. **Database Setup**:
    - Create a new database in your local MySQL server

3. **Configuration**:
    - Open the `connection.php` file and update the database connection settings to match your local environment:
        ```php
        <?php
        $hostname = "localhost";
        $userName = "your_username";
        $password = "your_password";
        $dbName = "your_database_name";
        ?>
        ```

4. **Access the Portal**:
    - Open your web browser and navigate to `http://localhost/your_project_directory`.
    - You should see the login or registration page of the Student Portal.

5. **Using the Features**:
    - **Register as a New Student**: Click on the registration link and fill in the required details to create a new student account.
    - **Login**: Use your credentials to log in to the portal.
    - **View Status**: Check your current enrollment status and academic standing on the dashboard page.
    - **Enroll in Courses**: Navigate to the courses section and select the semester you wish to register for.
    - **Grade Tracking**: View your grades in the results section.
    - **Enter Grades (Authorized Users)**: Go to `http://localhost/your_project_directory/staff`, and provide username and password. After that, you will be able to enter grades for students who are registerd for courses.

6. **Logout**:
    - Click the logout button to securely log out of the portal.

Feel free to explore the various features and functionalities of the Student Portal.
