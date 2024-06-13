
CREATE TABLE course_offerings (
    offering_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id  VARCHAR(255)  NOT NULL,
    department_id  VARCHAR(10)  NOT NULL,
    course_type VARCHAR(255),
    semester INT,
    FOREIGN KEY (course_id) REFERENCES courses(course_code),
    FOREIGN KEY (department_id) REFERENCES departments(department_code)
);


# for the cs department
INSERT INTO course_offerings (course_id, department_id, course_type, semester) VALUES
('CS101', 'CS', 'Major', 0),
('CS102', 'CS', 'Major', 0),
('MATH101', 'CS', 'Supportive', 0),
('ENG101', 'CS', 'Common', 0),
('PHYS101', 'CS', 'Supportive', 0),

('CS103', 'CS', 'Major', 1),
('CS104', 'CS', 'Major', 1),
('MATH102', 'CS', 'Supportive', 1),
('ENG102', 'CS', 'Common', 1),
('PHYS102', 'CS', 'Supportive', 1),

('CS201', 'CS', 'Major', 2),
('CS202', 'CS', 'Major', 2),
('MATH201', 'CS', 'Supportive', 2),
('STAT201', 'CS', 'Supportive', 2),
('ECON101', 'CS', 'Common', 2),

('CS203', 'CS', 'Major', 3),
('CS204', 'CS', 'Major', 3),
('MATH202', 'CS', 'Supportive', 3),
('STAT202', 'CS', 'Supportive', 3),
('ECON102', 'CS', 'Common', 3),

('CS301', 'CS', 'Major', 4),
('CS302', 'CS', 'Major', 4),
('CS303', 'CS', 'Major', 4),
('MATH301', 'CS', 'Supportive', 4),
('CS307', 'CS', 'Major', 4),

('CS304', 'CS', 'Major', 5),
('CS305', 'CS', 'Major', 5),
('CS306', 'CS', 'Major', 5),
('CS308', 'CS', 'Major', 5),
('CS309', 'CS', 'Major', 5),

('CS401', 'CS', 'Major', 6),
('CS402', 'CS', 'Major', 6),
('CS403', 'CS', 'Major', 6),
('CS404', 'CS', 'Major', 6),
('CpArch', 'CS', 'Major', 6),

('CS407', 'CS', 'Major', 7),
('CS405', 'CS', 'Major', 7),
('CS406', 'CS', 'Major', 7),
('HIS401', 'CS', 'Common', 7),
('LIT101', 'CS', 'Common', 7);


# for the is department
INSERT INTO course_offerings (course_id, department_id, course_type, semester) VALUES
('IS101', 'IS', 'Major', 0),
('CS101', 'IS', 'Supportive', 0),
('MATH101', 'IS', 'Supportive', 0),
('ENG101', 'IS', 'Common', 0),
('BUS101', 'IS', 'Common', 0),

('IS102', 'IS', 'Major', 1),
('CS102', 'IS', 'Supportive', 1),
('MATH102', 'IS', 'Supportive', 1),
('ENG102', 'IS', 'Common', 1),
('BUS102', 'IS', 'Common', 1),

('IS201', 'IS', 'Major', 2),
('IS202', 'IS', 'Major', 2),
('CS201', 'IS', 'Supportive', 2),
('BUS201', 'IS', 'Common', 2),
('BUS202', 'IS', 'Common', 2),

('IS203', 'IS', 'Major', 3),
('IS204', 'IS', 'Major', 3),
('CS202', 'IS', 'Supportive', 3),
('BUS203', 'IS', 'Common', 3),
('BUS204', 'IS', 'Common', 3),

('IS301', 'IS', 'Major', 4),
('IS302', 'IS', 'Major', 4),
('IS303', 'IS', 'Major', 4),
('DATA301', 'IS', 'Supportive', 4),
('COMP301', 'IS', 'Supportive', 4),

('IS304', 'IS', 'Major', 5),
('IS305', 'IS', 'Major', 5),
('IS306', 'IS', 'Major', 5),
('COMP302', 'IS', 'Supportive', 5),
('PHIL301', 'IS', 'Common', 5),

('IS401', 'IS', 'Major', 6),
('IS402', 'IS', 'Major', 6),
('IS403', 'IS', 'Major', 6),
('PHIL302', 'IS', 'Common', 6),
('FIN301', 'IS', 'Common', 6),

('IS404', 'IS', 'Major', 7),
('ECON301', 'IS', 'Common', 7),
('MKT301', 'IS', 'Common', 7),
('HRM301', 'IS', 'Common', 7),
('ENT301', 'IS', 'Common', 7);


# for the mathematics department
INSERT INTO course_offerings (course_id, department_id, course_type, semester) VALUES
('MATH101', 'MATH', 'Major', 0),
('MATH102', 'MATH', 'Major', 0),
('STAT101', 'MATH', 'Supportive', 0),
('ENG101', 'MATH', 'Common', 0),
('CS101', 'MATH', 'Supportive', 0),

('MATH103', 'MATH', 'Major', 1),
('MATH104', 'MATH', 'Major', 1),
('STAT102', 'MATH', 'Supportive', 1),
('ENG102', 'MATH', 'Common', 1),
('CS102', 'MATH', 'Supportive', 1),

('MATH201', 'MATH', 'Major', 2),
('MATH202', 'MATH', 'Major', 2),
('MATH203', 'MATH', 'Major', 2),
('STAT201', 'MATH', 'Supportive', 2),
('MATH204', 'MATH', 'Major', 2),

('MATH205', 'MATH', 'Major', 3),
('MATH206', 'MATH', 'Major', 3),
('MATH207', 'MATH', 'Major', 3),
('STAT202', 'MATH', 'Supportive', 3),
('MATH208', 'MATH', 'Major', 3),

('MATH301', 'MATH', 'Major', 4),
('MATH302', 'MATH', 'Major', 4),
('MATH303', 'MATH', 'Major', 4),
('STAT301', 'MATH', 'Supportive', 4),
('DATA301', 'MATH', 'Supportive', 4),

('MATH304', 'MATH', 'Major', 5),
('MATH305', 'MATH', 'Major', 5),
('MATH306', 'MATH', 'Major', 5),
('COMP301', 'MATH', 'Supportive', 5),
('COMP302', 'MATH', 'Supportive', 5),

('MATH401', 'MATH', 'Major', 6),
('MATH402', 'MATH', 'Major', 6),
('MATH403', 'MATH', 'Major', 6),
('PHIL301', 'MATH', 'Common', 6),
('PHIL302', 'MATH', 'Common', 6),

('MATH404', 'MATH', 'Major', 7),
('FIN301', 'MATH', 'Common', 7),
('ECON301', 'MATH', 'Common', 7),
('BIOSTAT301', 'MATH', 'Supportive', 7),
('CRYPTO301', 'MATH', 'Supportive', 7);


# for the physics department
INSERT INTO course_offerings (course_id, department_id, course_type, semester) VALUES
('PHYS101', 'PHY', 'Major', 0),
('MATH101', 'PHY', 'Supportive', 0),
('CHEM101', 'PHY', 'Supportive', 0),
('ENG101', 'PHY', 'Common', 0),
('CS101', 'PHY', 'Supportive', 0),

('PHYS102', 'PHY', 'Major', 1),
('MATH102', 'PHY', 'Supportive', 1),
('ENG102', 'PHY', 'Common', 1),
('CS102', 'PHY', 'Supportive', 1),
('PHYS103', 'PHY', 'Major', 1),

('PHYS201', 'PHY', 'Major', 2),
('PHYS202', 'PHY', 'Major', 2),
('MATH201', 'PHY', 'Supportive', 2),
('STAT201', 'PHY', 'Supportive', 2),
('PHYS204', 'PHY', 'Major', 2),

('PHYS203', 'PHY', 'Major', 3),
('PHYS205', 'PHY', 'Major', 3),
('MATH202', 'PHY', 'Supportive', 3),
('PHYS206', 'PHY', 'Major', 3),
('PHYS207', 'PHY', 'Major', 3),

('PHYS301', 'PHY', 'Major', 4),
('PHYS302', 'PHY', 'Major', 4),
('PHYS303', 'PHY', 'Major', 4),
('PHYS304', 'PHY', 'Major', 4),
('ASTR301', 'PHY', 'Supportive', 4),

('PHYS305', 'PHY', 'Major', 5),
('PHYS306', 'PHY', 'Major', 5),
('PHYS307', 'PHY', 'Major', 5),
('ASTR302', 'PHY', 'Supportive', 5),
('ASTR303', 'PHY', 'Supportive', 5),

('PHYS401', 'PHY', 'Major', 6),
('PHYS402', 'PHY', 'Major', 6),
('PHYS407', 'PHY', 'Major', 6),
('ASTR401', 'PHY', 'Supportive', 6),
('ASTR402', 'PHY', 'Supportive', 6),

('PHYS404', 'PHY', 'Major', 7),
('ASTR403', 'PHY', 'Supportive', 7),
('ASTR404', 'PHY', 'Supportive', 7),
('ASTR405', 'PHY', 'Supportive', 7),
('ASTR406', 'PHY', 'Supportive', 7);


