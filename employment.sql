CREATE DATABASE employment;

-------------------------------------------------------------------------------------------


      CREATE TABLE post (
      `post_id` INT NOT NULL PRIMARY KEY,
      `poster_id` INT NOT NULL,
      `job_name` varchar(200) NOT NULL,
      `company_name` varchar(255) ,
      `logo` LONGBLOB,
      `category` varchar(200) ,
      `location` varchar(500) ,
      `employment_type` varchar(200) NOT NULL,
      `description` varchar(9999) ,
      `salary` INT NOT NULL,
      `created_at` timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
  );
  
      CREATE TABLE drafts (
      `draft_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `poster_id` INT NOT NULL,
      `job_name` varchar(200) NOT NULL,
      `company_name` varchar(255) ,
      `logo` LONGBLOB,
      `category` varchar(200) ,
      `location` varchar(500) ,
      `employment_type` varchar(200) NOT NULL,
      `description` varchar(9999) ,
      `salary` INT NOT NULL,
      `created_at` timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
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
    `admin_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `admin_fname` varchar(500) NOT NULL ,
    `admin_lname` varchar(500) NOT NULL ,
    `admin_password` varchar(500) NOT NULL ,
    `admin_email` varchar(255) NOT NULL,
    `superadmin` tinyint(1)
  );

  INSERT INTO admin(admin_id,admin_fname, admin_lname, admin_email,admin_password,superadmin) 
  VALUES ( '100001', 'Vincent','Tay Yong Jun','jun892004@gmail.com','$2y$10$m6QE2naEwSese7DP8AyLE.dtm3pEeHTwEmG6zS3qv0uBiU1JKfrwe','1');

  CREATE TABLE contact (
    `contact_id` int(11) NOT NULL PRIMARY KEY  AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `subject` varchar(255) NOT NULL,
    `message` text NOT NULL
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

  CREATE TABLE package 
  (
    `package_id` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `package_name` varchar(255) NOT NULL,
    `package_price` decimal(10, 2) NOT NULL,
    `package_description` TEXT,
    `package_post_quota` int(10) NOT NULL,
    `package_sale_status` tinyint(1)
  );

  INSERT INTO package(package_id, package_name, package_price, package_description, package_post_quota, package_sale_status) 
  VALUES ( '200001', 'Single Post Quota Package','49.99',"With this package, you'll gain an additional single job posting opportunity, 
  allowing you to showcas1y, or seeking specialized talent, this extra posting opportunity ensures your job listing receives the attention it deserves.",'1','1');

  INSERT INTO package(package_id, package_name, package_price, package_description, package_post_quota, package_sale_status) 
  VALUES ( '200002', 'Triple Post Quota Package','129.99',"This package offers three additional job posting opportunities, providing you with the flexibility to 
  advertise and fill multiple roles effectively. Whether it's expanding your recruitment efforts, launching new hiring initiatives, or targeting diverse talent 
  pools, these extra job postings increase your visibility and candidate outreach.",'3','1');

  INSERT INTO package(package_id, package_name, package_price, package_description, package_post_quota, package_sale_status) 
  VALUES ( '200003', 'Quintuple Post Quota Package','199.99',"With five additional job posting opportunities, this package empowers you to diversify your recruitment 
  strategies and reach a wider audience. Whether you're scaling up your hiring efforts, targeting specific demographics, or promoting various job openings, these 
  extra postings enhance your employer brand visibility and attract qualified candidates.",'5','1');

  INSERT INTO package(package_id, package_name, package_price, package_description, package_post_quota, package_sale_status) 
  VALUES ( '200004', 'Decuple Post Quota Package','359.99',"This package provides ten additional job posting opportunities, enabling you to maximize your recruitment 
  efforts and fill multiple positions efficiently. Whether you're launching extensive hiring campaigns, expanding your workforce rapidly, or seeking talent across multiple 
  departments, these extra postings offer unparalleled exposure and candidate engagement.",'10','1');

  CREATE TABLE sale
  (
    `sale_id` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `purchase_amount` decimal(10, 2) NOT NULL,
    `purchase_time` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `payment_status` varchar(10) NOT NULL,
    `employer_id` int NOT NULL,
    `package_id` int(6) NOT NULL
  );

  INSERT INTO sale (sale_id, purchase_amount, payment_status, employer_id, package_id) VALUES (300001, 49.99, 'Successful', 1, 1);