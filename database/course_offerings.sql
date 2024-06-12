
CREATE TABLE course_offerings (
    offering_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id  VARCHAR(255)  NOT NULL,
    department_id  VARCHAR(10)  NOT NULL,
    course_type VARCHAR(255),
    semester INT,
    FOREIGN KEY (course_id) REFERENCES courses(course_code),
    FOREIGN KEY (department_id) REFERENCES departments(department_code)
);