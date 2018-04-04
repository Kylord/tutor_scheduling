//This is the table for problem sets
DROP TABLE IF EXISTS probset;

--Table for probset info --
CREATE TABLE probset (
    course_course_id VARCHAR(45) NOT NULL AUTO_INCREMENT,
    problems VARCHAR(100000) NOT NULL,
    FOREIGN KEY (course_course_id)
);

/* problem sets table */
