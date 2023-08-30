CREATE DATABASE bkap_test;


CREATE TABLE province 
(
	id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(100) NOT NULL
);

CREATE TABLE people
(
	id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    province_id int(11) DEFAULT 1,
    avatar varchar(200),
    birthday date,
    gender tinyint DEFAULT 1,
    about text,
    FOREIGN KEY (province_id) REFERENCES province(id)
);