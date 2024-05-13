CREATE TABLE `post` (
    `post_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `employer_email` varchar(200) NOT NULL,
    `job_name` varchar(200) NOT NULL,
    `job_type` varchar(200) NOT NULL,
    `location` varchar(500) NOT NULL,
    `employment_type` varchar(200) NOT NULL,
    `description` varchar(9999) ,
    `salary` varchar(200) NOT NULL
) 

CREATE TABLE `drafts` (
    `drafts_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `employer_email` varchar(200) NOT NULL,
    `job_name` varchar(200) NOT NULL,
    `job_type` varchar(200) NOT NULL,
    `location` varchar(500) NOT NULL,
    `employment_type` varchar(200) NOT NULL,
    `description` varchar(9999) ,
    `salary` varchar(200) NOT NULL
) 

CREATE TABLE photos (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `employer_email` varchar(500) NOT NULL ,
    `photo_name` VARCHAR(500),
    `photo_data` LONGBLOB
);

CREATE TABLE website_file (
    `file_name` varchar(500) NOT NULL PRIMARY KEY ,
    `text_data` varchar(5000) ,
    `photo_data` LONGBLOB
);

CREATE TABLE employer (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `employer_email` varchar(200) NOT NULL,
    `employer_name` varchar(500) NOT NULL,
    `password` varchar(500) NOT NULL,
    `balance` int NOT NULL
);

CREATE TABLE employer_profile (
    `profile_id` INT NOT NULL PRIMARY KEY ,
    `employer_email` varchar(200) NOT NULL ,
    `name` varchar(500),
    `photo_name` VARCHAR(500),
    `photo_data` LONGBLOB,
    `website` varchar(1000),
    `industry` varchar(1000),
    `company_size` varchar(500),
    `primary_location` varchar(1000),
    `description` varchar(9999)
);

CREATE TABLE admin (
  `admin_id` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `admin_fname` varchar(500) NOT NULL ,
  `admin_lname` varchar(500) NOT NULL ,
  `admin_password` varchar(500) NOT NULL ,
  `admin_email` varchar(255) NOT NULL
);