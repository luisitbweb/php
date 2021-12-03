CREATE SCHEMA contactinfo;

USE contactinfo;

CREATE TABLE contacts (ID INT AUTO_INCREMENT PRIMARY KEY,
NAME VARCHAR(200) DEFAULT '' NOT NULL,
EMAIL VARCHAR(300) DEFAULT '' NOT NULL,
PHONENUMBER VARCHAR(10) DEFAULT '' NOT NULL,
SUBJECT VARCHAR(200) DEFAULT '' NOT NULL,
MESSAGE TEXT);