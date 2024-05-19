CREATE DATABASE employment;

-------------------------------------------------------------------------------------------

  CREATE TABLE post (
      `post_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `employer_email` varchar(200) NOT NULL,
      `job_name` varchar(200) NOT NULL,
      `job_type` varchar(200) NOT NULL,
      `location` varchar(500) NOT NULL,
      `employment_type` varchar(200) NOT NULL,
      `description` varchar(9999) ,
      `salary` varchar(200) NOT NULL
  );

  CREATE TABLE drafts (
      `drafts_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `employer_email` varchar(200) NOT NULL,
      `job_name` varchar(200) NOT NULL,
      `job_type` varchar(200) NOT NULL,
      `location` varchar(500) NOT NULL,
      `employment_type` varchar(200) NOT NULL,
      `description` varchar(9999) ,
      `salary` varchar(200) NOT NULL
  );

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
    `admin_email` varchar(255) NOT NULL,
    `superadmin` tinyint(1)
  );

  INSERT INTO admin(admin_fname, admin_lname, admin_email,admin_password,superadmin) 
  VALUES ('Vincent','Tay Yong Jun','jun892004@gmail.com','$2y$10$m6QE2naEwSese7DP8AyLE.dtm3pEeHTwEmG6zS3qv0uBiU1JKfrwe','1');

  CREATE TABLE contact (
    `contact_id` int(11) NOT NULL PRIMARY KEY  AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `subject` varchar(255) NOT NULL,
    `message` text NOT NULL
  );

  CREATE TABLE homepage 
  (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `company_name` varchar(255) NOT NULL,
    `logo_url` varchar(255) DEFAULT NULL,
    `salary_range` varchar(100) DEFAULT NULL,
    `job_description` text DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `category` varchar(50) DEFAULT NULL
  );
  
  CREATE TABLE jobseeker 
  (
    `jobseeker_id` INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `jobseeker_firstname` varchar(100) NOT NULL,
    `jobseeker_lastname` varchar(100) NOT NULL,
    `jobseeker_email` varchar(60) NOT NULL,
    `jobseeker_password` varchar(500) NOT NULL
  );
  CREATE TABLE userprofile
  (
    `UserID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `ProfilePic` varchar(255) DEFAULT NULL,
    `FullName` varchar(100) DEFAULT NULL,
    `Email` varchar(100) DEFAULT NULL,
    `PersonalSummary` text DEFAULT NULL,
    `Skill` varchar(100) DEFAULT NULL,
    `WorkExperience` text DEFAULT NULL,
    `Education` text DEFAULT NULL,
    `Language` varchar(50) DEFAULT NULL
  ) ;

  CREATE TABLE packages
  (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `description` varchar(500) NOT NULL,
    `price` INT NOT NULL
  ) ;

INSERT INTO `packages` (`name`, `description`, `price`) VALUES
('1 post package','without time limit',8),
('5 post package','without time limit',35),
('10 post package','without time limit',60)