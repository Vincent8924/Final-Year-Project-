  CREATE DATABASE employment;

-------------------------------------------------------------------------------------------


  CREATE TABLE `post` (
        `post_id` int(11) NOT NULL,
        `poster_id` int(11) NOT NULL,
        `job_name` varchar(255) NOT NULL,
        `company_name` varchar(255) DEFAULT NULL,
        `logo` longblob DEFAULT NULL,
        `category` varchar(255) DEFAULT NULL,
        `location` varchar(500) DEFAULT NULL,
        `employment_type` varchar(255) NOT NULL,
        `description` text DEFAULT NULL,
        `salary` int(11) NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp()
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
        `website` varchar(500),
        `industry` varchar(500),
        `company_size` varchar(500),
        `primary_location` text,
        `description` text
  );

  CREATE TABLE admin (
        `admin_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `admin_fname` varchar(500) NOT NULL ,
        `admin_lname` varchar(500) NOT NULL ,
        `admin_password` varchar(500) NOT NULL ,
        `admin_email` varchar(255) NOT NULL,
        `superadmin` tinyint(1)
  );

  CREATE TABLE contact (
        `contact_id` int(11) NOT NULL PRIMARY KEY  AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `subject` varchar(255) NOT NULL,
        `message` text NOT NULL,
        `status` tinyint(1) DEFAULT 0,
        `request_time` datetime NOT NULL DEFAULT current_timestamp()
  );
  
  CREATE TABLE jobseeker 
  (
        `jobseeker_id` INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `jobseeker_firstname` varchar(100) NOT NULL,
        `jobseeker_lastname` varchar(100) NOT NULL,
        `jobseeker_email` varchar(60) NOT NULL,
        `jobseeker_password` varchar(500) NOT NULL
  );

  CREATE TABLE `applications` 
  (
        `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `post_id` INT DEFAULT NULL,
        `poster_id` INT DEFAULT NULL,
        `jobseeker_id` INT NULL,
        `resume` varchar(255) DEFAULT NULL,
        `cover_letter` varchar(255) DEFAULT NULL,
        `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
        `status` enum('Pending','Successful','Failed') DEFAULT 'Pending'
  );


  CREATE TABLE package 
  (
        `package_id` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `package_name` varchar(255) NOT NULL,
        `package_price` decimal(10, 2) NOT NULL,
        `package_description` TEXT,
        `package_post_quota` int(10) NOT NULL,
        `package_sale_status` tinyint(1) 
  );

   CREATE TABLE `sale` 
   (
        `sale_id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
        `purchase_amount` decimal(10,2) NOT NULL,
        `purchase_time` datetime NOT NULL DEFAULT current_timestamp(),
        `payment_status` varchar(10) NOT NULL,
        `employer_id` int(11) NOT NULL,
        `package_id` int(6) NOT NULL,
        `bank` varchar(100) DEFAULT NULL,
        `card_name` varchar(200) DEFAULT NULL,
        `card_number` varchar(16) NULL,
        `card_expire_year` int(11) DEFAULT NULL,
        `card_expire_month` int(11) DEFAULT NULL,
        `card_cvv` int(11) DEFAULT NULL
   );

  CREATE TABLE jobseekerprofile 
  (
        `ProfileID` int(11) NOT NULL,
        `photo_name` varchar(500) DEFAULT NULL,
        `photo_data` longblob DEFAULT NULL,
        `PersonalSummary` text DEFAULT NULL, 
        `Skills` varchar(100) DEFAULT NULL,
        `work_experience` text DEFAULT NULL,
        `Education` text DEFAULT NULL,
        `language` varchar(255) DEFAULT NULL,
        `jobseeker_email` varchar(255) DEFAULT NULL,
        `Resume` varchar(255) DEFAULT NULL,
        `jobseeker_id` int(11) NOT NULL
   );

  CREATE TABLE wishlist 
   (
        `wishlist_id` int(11) NOT NULL,
        `jobseeker_id` int(11) NOT NULL,
        `post_id` int(11) NOT NULL,
        `date_added` timestamp NOT NULL DEFAULT current_timestamp
   );
---------------------------------------------------------------------------------------------------
INSERT INTO `sale` (`sale_id`, `purchase_amount`, `purchase_time`, `payment_status`, `employer_id`, `package_id`, `bank`, `card_name`, `card_number`, `card_expire_year`, `card_expire_month`, `card_cvv`) VALUES
(300002, 49.99, '2024-05-28 17:03:20', 'Successful', 1000002, 200001, 'CIMB', 'Vincent',2147483647123568, 2024, 6, 123),
(300003, 49.99, '2024-05-28 17:05:38', 'Successful', 1000002, 200001, 'MASTER CARD', 'Vincent',1234567887654321, 2, 2, 213),
(300004, 129.99, '2024-05-28 17:40:07', 'Successful', 1000002, 200002, 'Ambank', 'Vincent',1234567812345678, 2, 2, 133);


  INSERT INTO admin(admin_id,admin_fname, admin_lname, admin_email,admin_password,superadmin)    
  VALUES ( '100001', 'Vincent','Tay Yong Jun','jun892004@gmail.com','$2y$10$m6QE2naEwSese7DP8AyLE.dtm3pEeHTwEmG6zS3qv0uBiU1JKfrwe','1');

  INSERT INTO admin(admin_id,admin_fname, admin_lname, admin_email,admin_password,superadmin) 
  VALUES ( '100002', 'Jin Kai','Lo','lo@gmail.com','$2y$10$m6QE2naEwSese7DP8AyLE.dtm3pEeHTwEmG6zS3qv0uBiU1JKfrwe','0');

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

  INSERT INTO `jobseeker` (`jobseeker_id`, `jobseeker_firstname`, `jobseeker_lastname`, `jobseeker_email`, `jobseeker_password`) VALUES
  (2, 'goh', 'hong', 'guo0618@gmail.com', '$2y$10$OyFqsNvouksGYDNNT1k9Teeibp15wvMvk2DL/aC6t1S.l/cpQJLMi'),
  (4, 'goh', 'chengh', 'gohchenghong533@gmail.com', '$2y$10$wgfwuVb3um38d4IWAWnbs.O8gPz9iZo42etJvULnfGyHvVtfi6cMK'),
  (5, 'jason', 'hong', 'jason0316@gmail.com', '$2y$10$ttUi0Bkmhwxp6h3US62ZnOEXrEANGaZtRWY2/Rmx5ssdxr2xvduRS'),
  (6, 'Goh', 'Xin Ying', 'gxying0922@gmail.com', '$2y$10$/NcTY4dJ.jQl093ONzHHxe306m/4o.hX3TJZO7DnYBxXVKZU98xRe'),
  (7, 'Vincent', 'Tay Yogn Jun', 'jun892004@gmail.com', '$2y$10$m6QE2naEwSese7DP8AyLE.dtm3pEeHTwEmG6zS3qv0uBiU1JKfrwe');


  INSERT INTO `employer` (`id`, `employer_email`, `employer_name`, `password`, `balance`) VALUES
  (1000001, 'lojinkai@gmail.com', 'lojinkai', '$2y$10$/WP5uqKhGm26cb9ETyzmu.FZDk8qH0Bn2gSBMbaM1NV90YbrCZCom', 0),
  (1000002, 'jun892004@gmail.com', 'Vincent Tay', '$2y$10$m6QE2naEwSese7DP8AyLE.dtm3pEeHTwEmG6zS3qv0uBiU1JKfrwe', 0),
  (1000003, 'gch@gmail.com', 'goh goh', '$2y$10$bOP6ECIvoDwlP8vqe1IHVetEEakTNepr4bR8cuH6lE0JJh1T7/BoG', 0);



  INSERT INTO `employer_profile` (`profile_id`, `employer_email`, `name`, `photo_name`, `photo_data`, `website`, `industry`, `company_size`, `primary_location`, `description`) VALUES
  (1000001, 'lojinkai@gmail.com', 'lojinkai', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (1000002, 'jun892004@gmail.com', 'Vincent Tay', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (1000003, 'gch@gmail.com', 'goh goh', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

  INSERT INTO `drafts` (`draft_id`, `poster_id`, `job_name`, `company_name`, `logo`, `category`, `location`, `employment_type`, `description`, `salary`,`created_at`) VALUES
  (1, 1000001, 'software development', 'mihoyo', NULL, 'Accounting', 'china', 'full time', 'looking for a talent with familiar Java programming language', 3000,'2024-06-19 10:53:17'),
  (2, 1000003, 'Three Monkey Shop', 'goh goh', NULL, 'Education & Traning', 'melaka', 'part time', 'help me to teach some student in class', 2000, '2024-06-19 10:53:17');
  
  INSERT INTO `post` (`post_id`, `poster_id`, `job_name`, `company_name`, `logo`, `category`, `location`, `employment_type`, `description`, `salary`) VALUES
  (1, 1000001, 'software development', 'mihoyo', NULL, 'Accounting', 'china', 'full time', 'looking for a talent with familiar Java programming language', 3000); 

  INSERT INTO `jobseekerprofile` (`ProfileID`, `photo_name`, `photo_data`, `PersonalSummary`, `Skills`, `work_experience`, `Education`, `language`, `jobseeker_email`, `Resume`, `jobseeker_id`) VALUES
(6, 'd.jpg', 0x0000001c667479706176696600000000617669666d6966316d696166000000ea6d657461000000000000002168646c72000000000000000070696374000000000000000000000000000000000e7069746d00000000000100000022696c6f630000000044400001000100000000010e000100000000000004320000002369696e6600000000000100000015696e6665020000000001000061763031000000006a697072700000004b6970636f00000013636f6c726e636c780001000d0006800000000c6176314381040c000000001469737065000000000000027200000272000000107069786900000000030808080000001769706d610000000000000001000104018203040000043a6d64617412000a0a19266719c782021a0d0832a10811400104104100f4bf5d9cae0328a8ed9b9ac0063437f04d2abdb8c019f4cd5ddc742cb884b7a15b7c66851a23cb1c4f97d2dedf09795e779cc821f4d6338ef5e4c6458bbf3c77d1294489cef72d97f6ee32e38b2975e281efe175df96c178efb43c767055c6ee26beab89405c58f3b967c07a7995ba9286488b2fdf8be380688f9de45f03afcca99074c47412240afa257f90c80be096efe0b310896a074f877393ecc7c8b62859bf492f8c7d78889c7844b2b14a873e6267baee9e5e3f161351ea7013ebf4e82c3580d4db2024671ee0c08640dff0b18da73681409471439bc54fc0c895825f3f1a54c708e82899bb68ba582abd1504e314c739af530843d6bec8b4560cb533b28d539c2849a36feb013cac2acd41c95cd5d15a58cfbfa35027cb9fe3824d63bd3b2d0ceb62c96a0505c9f87320eb0e04526b6db93130ff0b6e17efc61d5f45812dac54cbc380f6e4266c3da42c9eda6c0c34ed5a61e46cd0dff37d697d318cecfbc6556feae5b81eb338dc2fcf087e78809ccf02c802b9f7634e52ab4b8258f0f4e47f5b06d782ec24bb60dd32d5a3a95f803439aec7f1646590f0beeba02e43e39780f73fbe921958c7bc410ba2ef7095fa80bc9a06e0fa0d36e53bf35e315eba495bcb21f693dbd9bf12349c4616e55fcab28640301102d0c79addc220863c012b29683e17a599d4b4597e388b13cd4d6b09e92dedbf58a2d63ca691292b6d4a5d8f1f12a4d35c41f140f9bf6e406e6b2a459878dc8a85a790a353dac29f7fbde8e3aff603dc867aea0f0887da4dbea741f0b72fe331752345f076b9f68aa660cca82340d9c894ecf9d19b86e0df59b25b9be41d003623f0a98888400d9609fae93bb27b34d8b547d2a5efd277b3061b68152c8dcf803e9e8b0642f1d580f41d3db5911e1c0b488b0e2479c0e02ada01f47fb837c7dd084223e6243dd39aca48210bb1ba54ae0322081b033e3e0b191314bc52ec5333dc38625aee20c1b40a9b0bc70d41732a81af4bb97b8a99bdb605151e4a7230915f2aeb79a0bfdfbf3b1b7a63ec740be422418583d2cd878d4d90eb295bd4875d14f92dade738182dc4dbeb6d27d1dd2efe75b8cf9de950b330e3b114af013363eeac971caf86cd62c2d1d4c923ed5e46a334275b0c834a4d48ac707e217afd707b45f4f8f2e039c6eea544e31b3aecbdeb0cfb68d27b98f92f94e546f90bc0c1b3b4083fc5240c0d37a2157fe81ca4ef22d692097d0d841fa5852e0697bedabeb4b200db0c6b5376e6ae60272df5f3bbe7c1a38c7f65cdc3db03246e0ace64de51fc37dd9bbf69603080b250476d8344f79a44e6979d6529fc9b45e072275c3847309418b2f95cf80496b3ec72e24c08863623ca42df7192afa84bb5deb05a4e711a1b7ead177da8bab3f947c8652c2381278f6994d29cf2b92bddeba3748ecd6420b7ebd9eff7e200592e24c5614bd95076696feab96eb97d4d68d1be0dc1f53020, 'gagagaag', 'sbsss', 'sbsss', 'sbsss', 'sbsss', NULL, 'resume/result slip (1) (1).pdf', 4);