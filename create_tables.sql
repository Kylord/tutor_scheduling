//This is the table for courses
DROP TABLE IF EXISTS course;

--Table for course info --
CREATE TABLE course (
    course_id VARCHAR(45) NOT NULL AUTO_INCREMENT,
    department VARCHAR(45) NOT NULL,
    course_num INT NOT NULL,
    PRIMARY KEY (course_id)
);

/* course table */
INSERT INTO course (course_id, department, course_num) VALUES ("1120", "Computer Science", "1120");
INSERT INTO course (course_id, department, course_num) VALUES ("1340", "Math", "1340");
INSERT INTO course (course_id, department, course_num) VALUES ("1440", "Physics", "1440");



//This is the table for problem sets
DROP TABLE IF EXISTS probset;

--Table for probset info --
CREATE TABLE probset (
    course_course_id VARCHAR(45) NOT NULL AUTO_INCREMENT,
    problems VARCHAR(100000) NOT NULL,
    FOREIGN KEY (course_course_id)
);

/* problem sets table */