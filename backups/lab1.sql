CREATE DATABASE lib_db;
show databases;
CONNECT lib_db;
CREATE TABLE students (student_id, student_first_name,student_last_name,student_course);
INSERT INTO students ( (student_first_name,student_last_name,student_course)
 VALUES ("Shiela Pearl","Kinoyog", "BSIT");)