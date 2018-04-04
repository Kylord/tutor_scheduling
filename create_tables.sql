


--Table for course info --

DROP TABLE IF EXISTS USER_T; 
CREATE TABLE USER_T(
	HAWKID VARCHAR(45) NOT NULL, 
	HASHED_PSSWRD VARCHAR(45) NOT NULL, 
	IS_ADMIN BOOLEAN NOT NULL, 
	FIRST_NAME VARCHAR(45), 
	LAST_NAME VARCHAR(45), 
	EMAIL VARCHAR(45)
	PRIMARY KEY(HAWKID)
); 



DROP TABLE IF EXISTS course;
CREATE TABLE course (
    course_id VARCHAR(45) NOT NULL,
    department VARCHAR(45) NOT NULL,
    course_num INT NOT NULL,
    PRIMARY KEY (course_id)
);

/* course table */
INSERT INTO course (course_id, department, course_num) VALUES ("CS1120", "Computer Science", "1120");
INSERT INTO course (course_id, department, course_num) VALUES ("MATH1340", "Math", "1340");
INSERT INTO course (course_id, department, course_num) VALUES ("PHYS1440", "Physics", "1440");


DROP TABLE IF EXISTS ROLE; 
CREATE TABLE ROLE(
	DESCRIPTION VARCHAR(45) NOT NULL, 
	PRIMARY KEY (HAWKID, course_id), 
	FOREIGN KEY (HAWKID) REFERENCES USER_T(HAWKID), 
	FOREIGN KEY(course_id) REFERENCES course(course_id)


);


DROP TABLE IF EXISTS probset;

--Table for probset info --
CREATE TABLE probset (
    PROBSET_ID INT  NOT NULL AUTO_INCREMENT, 
	TEXT VARCHAR(100000) NOT NULL,
	PRIMARY KEY (PROBSET_ID)
	FOREIGN KEY (course_course_id) REFERENCES course(course_id)
);

/* problem sets table */