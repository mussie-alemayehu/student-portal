CREATE TABLE students (
    id VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255),
    profile_added TINYINT(4)
);


CREATE TABLE student_info (
    student_id VARCHAR(255) PRIMARY KEY,
    full_name VARCHAR(255),
    email VARCHAR(255),
    department_id VARCHAR(255),
    college VARCHAR(255),
    semesters_completed INT(11),
    year INT(11),
    batch INT(11)
);


CREATE TABLE department (
    department_code VARCHAR(10) PRIMARY KEY,
    department_name VARCHAR(255)
);


CREATE TABLE courses (
    course_code VARCHAR(255)  PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    credit_hours INT NOT NULL,
);


CREATE TABLE course_offerings (
    offering_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id  VARCHAR(255)  NOT NULL,
    department_id  VARCHAR(10)  NOT NULL,
    course_type VARCHAR(255),
    semester INT,
    FOREIGN KEY (course_id) REFERENCES courses(course_code),
    FOREIGN KEY (department_id) REFERENCES departments(department_code)
);

CREATE TABLE register_courses (
    registration_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(255) NOT NULL,
    offering_id INT NOT NULL,
    registration_date DATE,
    grade VARCHAR(2),
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (offering_id) REFERENCES course_offerings(offering_id)
);
