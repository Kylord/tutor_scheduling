-- Document each column name
-- Make sure you are using names consistently
-- Think about maybe making Tables capitalized not all caps, SQL KEYWORDS all caps and columns lower case
-- Add some more test data (maybe all at end of file?)
-- Use consistent indenting

DROP TABLE IF EXISTS TUTOR_SCHEDULE;
DROP TABLE IF EXISTS TIME_SLOT;
DROP TABLE IF EXISTS PROBSET;
DROP TABLE IF EXISTS ROLE_T; 
DROP TABLE IF EXISTS COURSE;
DROP TABLE IF EXISTS USER_T; 

CREATE TABLE USER_T(
	HAWKID VARCHAR(45) NOT NULL, 
	HASHED_PSSWRD VARCHAR(45) NOT NULL, 
	IS_ADMIN BOOLEAN NOT NULL, 
	FIRST_NAME VARCHAR(45), 
	LAST_NAME VARCHAR(45), 
	EMAIL VARCHAR(45),
	PRIMARY KEY(HAWKID)
); 

CREATE TABLE COURSE (
    COURSE_ID VARCHAR(45) NOT NULL,
    DEPARTMENT VARCHAR(45) NOT NULL,
    COURSE_NUM INT NOT NULL,
    PRIMARY KEY (COURSE_ID)
);

CREATE TABLE ROLE_T (
	DESCRIPTION VARCHAR(45) NOT NULL, 
	HAWKID VARCHAR(45) NOT NULL, 
	COURSE_ID VARCHAR(45) NOT NULL,
	PRIMARY KEY (HAWKID, COURSE_ID), 
	FOREIGN KEY (HAWKID) REFERENCES USER_T(HAWKID), 
	FOREIGN KEY (COURSE_ID) REFERENCES COURSE(COURSE_ID)
);

--Table for probset info --
CREATE TABLE PROBSET (
    PROBSET_ID INT  NOT NULL AUTO_INCREMENT, 
	TEXT VARCHAR(100000) NOT NULL,
	COURSE_ID VARCHAR(45) NOT NULL,
	PRIMARY KEY (PROBSET_ID),
	FOREIGN KEY (COURSE_ID) REFERENCES COURSE(COURSE_ID)
);

/* problem sets table */
CREATE TABLE TIME_SLOT (
	DATE_TIME TIMESTAMP,
	TUTOR_NAME VARCHAR(45),
	STUDENT_NAME VARCHAR(45),
	CANCELLED_BY_STUD BOOLEAN,
	CANCELLED_BY_TUTOR BOOLEAN,
	LOCATION VARCHAR(45),
	COURSE_ID VARCHAR(45) NOT NULL,
	HAWKID VARCHAR(45) NOT NULL, 
	PRIMARY KEY (DATE_TIME),
	FOREIGN KEY (HAWKID) REFERENCES ROLE_T (HAWKID),
	FOREIGN KEY (COURSE_ID) REFERENCES ROLE_T (COURSE_ID)
);

CREATE TABLE TUTOR_SCHEDULE (
       TS_ID INT AUTO_INCREMENT,
       WEEK_DAY VARCHAR(45),
	NUM_TIME_SLOTS INT,
	HAWKID VARCHAR(45) NOT NULL, 
	COURSE_ID VARCHAR(45) NOT NULL,
	FOREIGN KEY (HAWKID) REFERENCES ROLE_T (HAWKID),
	FOREIGN KEY (COURSE_ID) REFERENCES ROLE_T (COURSE_ID),
	PRIMARY KEY (TS_ID)
);


-- TEST DATA FOLLOWS
/* course table */
INSERT INTO COURSE (COURSE_ID, DEPARTMENT, COURSE_NUM) VALUES ("CS1120", "Computer Science", "1120");
INSERT INTO COURSE (COURSE_ID, DEPARTMENT, COURSE_NUM) VALUES ("MATH1340", "Math", "1340");
INSERT INTO COURSE (COURSE_ID, DEPARTMENT, COURSE_NUM) VALUES ("PHYS1440", "Physics", "1440");

INSERT INTO USER_T (HAWKID, HASHED_PSSWRD, IS_ADMIN, FIRST_NAME, LAST_NAME, EMAIL) VALUES ("jsmith", "password", "true", "John", "Smith", "jsmith@uiowa.edu");
INSERT INTO USER_T (HAWKID, HASHED_PSSWRD, IS_ADMIN, FIRST_NAME, LAST_NAME, EMAIL) VALUES ("awolmutt", "password", "false", "Aaron", "Wolmutt", "awolmutt@uiowa.edu");
INSERT INTO USER_T (HAWKID, HASHED_PSSWRD, IS_ADMIN, FIRST_NAME, LAST_NAME, EMAIL) VALUES ("jdoe", "password", "false", "John", "Doe", "jdoe@uiowa.edu");
INSERT INTO USER_T (HAWKID, HASHED_PSSWRD, IS_ADMIN, FIRST_NAME, LAST_NAME, EMAIL) VALUES ("atutor", "password", "false", "A", "Tutor", "atutor@uiowa.edu");

INSERT INTO ROLE_T (DESCRIPTION, HAWKID, COURSE_ID) VALUES ("tutor", "atutor", "CS1120");
INSERT INTO ROLE_T (DESCRIPTION, HAWKID, COURSE_ID) VALUES ("student", "awolmutt", "CS1120");
INSERT INTO ROLE_T (DESCRIPTION, HAWKID, COURSE_ID) VALUES ("admin", "jsmith", "CS1120");
INSERT INTO ROLE_T (DESCRIPTION, HAWKID, COURSE_ID) VALUES ("student", "jdoe", "CS1120");