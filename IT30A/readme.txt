D:\Dev\it30a\backups

CREATE DATABASE lib_db;
show databases;
CONNECT lib_db;
CREATE TABLE students (student_id, student_first_name,student_last_name,student_course);
INSERT INTO students ( (student_first_name,student_last_name,student_course) VALUES ("Shiela Pearl","Kinoyog", "BSIT");)
    (columns)
    VALUES(values);

Utility commands
\!cls
mysqldump -u root -p --databases lib_db > C:\Users\Admin\Documents\kinoyog dev\IT30A\Backups\08182026_lib_db.sql

mysqldump -u root -p --databases lib_db > "D:\Users\Admin\Documents\kinoyog dev\IT30A\Backups\%date:~-4%_%date:~4,2%_%date:~7,2%_%time:~0,2%_%time:~3,2%_%time:~6,2%_library_db.sql"
%date:~-4%_
%date:~4,2%_
%date:~7,2%_
%time:~0,2%_
%time:~3,2%_
%time:~6,2%_
library_db.sql"
mysqldump -u root -p --databases lib_db > "D:\kinoyog dev\IT30A\backups\%date:~-4%_%date:~4,2%_%date:~7,2%_%time:~0,2%_%time:~6,2%_lib_db.sql"

Laboratory 2

ALTER TABLE students ADD COLUMN student_created_at TIMESTAMP NULL DEFAULT NULL;
UPDATE students SET student_created_at = CURRENT_TIMESTAMP WHERE student_created_at IS NULL;
ALTER TABLE students MODIFY COLUMN student_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;


for /f "tokens=1-3 delims=/" %a in ("%date%") do set "dt=%c_%a_%b"
for /f "tokens=1-3 delims=:." %a in ("%time%") do set "tm=%a_%b_%c"
mysqldump -u root -p --databases library_db > "D:\kinoyog dev\IT30A\backups\%dt%_%tm%_library_db.sql"