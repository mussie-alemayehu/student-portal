# Student Portal

The student portal is a comprehensive web-based platform designed to streamline the academic management process for educational institutions. This portal allows students to register, view their status, enroll in courses and track their academic progress seamlessly.

Developed using only HTML, CSS, JavaScript, and PHP, we made it as a Web Development project where we were not allowed to use any frameworks. Lleave a star if you find this helpful.

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
1. Install XAMPP server
    You can find it [here](https://www.google.com/url?sa=t&source=web&rct=j&opi=89978449&url=https://www.apachefriends.org/download.html&ved=2ahUKEwjXufqht_KGAxWta_EDHVC2ATEQFnoECAYQAQ&usg=AOvVaw0FJaxz5J9FUgyQIdXelZ6c)

2. Clone the repository in your "htdocs" folder:
    ```sh
    git clone https://github.com/mussie-alemayehu/student-portal.git
    ```

3. Create a "student_portal" database in your XAMPP database server

4. Open the "connection.php" file and create your own connection to the XAMPP database server

5. Create the tables required in the database. This can be done by running the SQL query found in "database/tables.sql". The tables should be created in the order they appear in the "tables.sql" file, otherwise foreign keys might become a problem.

6. Add the required data to the tables created on the previous step. Execute the queries found in "departments.sql", "courses.sql" and "course_offerings.sql" respectively.

7. Your student portal is now ready to go.