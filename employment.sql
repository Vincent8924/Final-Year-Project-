  CREATE DATABASE employment;

-------------------------------------------------------------------------------------------


  CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `job_name` varchar(200) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `logo` longblob DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `employment_type` varchar(200) NOT NULL,
  `description` varchar(9999) DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `favourite` enum('yes','no') DEFAULT 'no')
  
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

  CREATE TABLE `userprofile` (
      `UserID` int(11) NOT NULL,
      `ProfilePic` varchar(255) DEFAULT NULL,
      `PersonalSummary` text DEFAULT NULL,
      `Skills` varchar(100) DEFAULT NULL,
      `work_experience` text DEFAULT NULL,
      `Education` text DEFAULT NULL,
      `language` varchar(255) DEFAULT NULL,
      `jobseeker_email` varchar(255) DEFAULT NULL
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

  CREATE TABLE sale
  (
      `sale_id` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
      `purchase_amount` decimal(10, 2) NOT NULL,
      `purchase_time` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
      `payment_status` varchar(10) NOT NULL,
      `employer_id` int NOT NULL,
      `package_id` int(6) NOT NULL,
      `bank` VARCHAR(100),
      `card_name` varchar(200),
      `card_number` INT,
      `card_expire_year` INT,
      `card_expire_month` INT,
      `card_cvv` INT
  );

---------------------------------------------------------------------------------------------------

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
  (1, 'mihoyo@gmail.com', 'mihoyo', '$2y$10$/WP5uqKhGm26cb9ETyzmu.FZDk8qH0Bn2gSBMbaM1NV90YbrCZCom', 0),
  (2, 'jun892004@gmail.com', 'Vincent Tay', '$2y$10$m6QE2naEwSese7DP8AyLE.dtm3pEeHTwEmG6zS3qv0uBiU1JKfrwe', 0);

  INSERT INTO `drafts` (`draft_id`, `poster_id`, `job_name`, `company_name`, `logo`, `category`, `location`, `employment_type`, `description`, `salary`) VALUES
  (1, 1, 'software development', 'mihoyo', NULL, 'Accounting', 'china', 'full time', 'looking for a talent with familiar Java programming language', 3000);

  INSERT INTO `post` (`post_id`, `poster_id`, `job_name`, `company_name`, `logo`, `category`, `location`, `employment_type`, `description`, `salary`) VALUES
  (1, 1, 'software development', 'mihoyo', NULL, 'Accounting', 'china', 'full time', 'looking for a talent with familiar Java programming language', 3000); 

  INSERT INTO sale (sale_id, purchase_amount, payment_status, employer_id, package_id,bank,card_name,card_number,card_expire_year,card_expire_month,card_cvv) VALUES (300001, 49.99, 'Successful', 1, 200001,'CIMB',"Vincent's Card",1111000011110000,2028,05,123);

  INSERT INTO `website_file` (`file_name`, `text_data`, `photo_data`) VALUES
  ('default_profile_photo', 'none', 0x89504e470d0a1a0a0000000d49484452000000e1000000e108060000003eb3d27a000000017352474200aece1ce90000000467414d410000b18f0bfc61050000000970485973000012740000127401de661f78000022a749444154785eeddd7b9b2b55d1c6e1f7fb7f26ff1214cfa2208202a2a0a0a088073c6ef2ce9dd9cfa676bb66924cd2e9245d735dbfab8fc974d7aa6755ad4377feefcb2fbfdc344db31c2dc2a659981661d32c4c8bb06916a645d8340bd3226c9a85691136cdc2b4089b66615a844db3302dc2a659981661d32c4c8bb06916a645d8340bd3226c9a85691136cdc2b4089b66615a844db3302dc2a659981661d32c4c8bb06916a645d8340bd3226c9a85691136cdc2b4089b66615a8433f3d7bffe75f3b7bffd6df38f7ffc63f3af7ffd6bf3ef7fff7bbbb49dfdcefbfbdfffbe3d373866df3ffff9cfed39d6bff8e28bcd9ffef4a7cda79f7ebaf9e4934f361f7ffcf1e60f7ff8c376fb8f7ffce3e6cf7ffef3f6b3becfe7fc1f7fcf9e3ddbaefb8ebffce52f2f91ff93ebf3399fb7dff1dc47331f2dc299211ccbfffce73f9bfffef7bf2f0418a7272ac2b1fed5575f6d0543083ef7d9679f6d7ef9cb5f6e7ef18b5f6cde7efbedcdcf7ef6b3cd1b6fbcb179fdf5d7373ffef18f373ffad18f36dffbdef736dffffef7373ffce10fb7fb7ef2939f6ccf79f3cd37b7e7ffea57bfda7cf8e1875bb1e65a7c7f15b77db9a690eb6fe6a7453833d3e892a843940497284588bffffdefb7a279ebadb7b682222e10da77bffbddcd77bef39dcd6bafbdb6f9f6b7bfbdf9d6b7beb52522c40f7ef083ad1841a0f019c708d7f7befffefb9bdffdee775b818b9c119c6b4b04b6ed9a45eddc47331f2dc2992136cba47e9c3ba293421204e1895c0445588446388448582102abd4e311a3ef8970ab78ab204549d1d5ff172509d275a6d2505924b56de6a5453833892c9c3b82d4867bf7dd77373ffde94f5f882711cd36f139469811568e457c8974558cf99e080ff63b8ff0a4aab0edbc1c17213ffae8a36dbaea3a4184495f9b7969119e8174c6887cc49708470cd609a4b6f38829d12b512d228d1803b182b8ea778038f3b9fa19e4bb72dcf96943aa245cb736ecf45e9ad3d3229c1991f0f3cf3fdf461a918db8a49c1c5f074a52c630155c22dd434c3f9f08187c87fdda91afbefaeaf67fdbf6d94447a2b4ff95575ed91efbf9cf7fbe4d533b129e8716e1cc10df3befbcf322c225d5b4b44d008ed568681f01114ec4562358848a1caf241222db111cfc0ffbf3ff43fd8e30baa7e6b4b40877201a681fd52efd6c4bd7745e64cccd71a9a7e82792185a1839f63521426a33ea4d4d8f697a54d3c904fb93763bce063dceb81f2dc23de0541cce3ad1a5d790d349358932e38011a09e47d167e4d8d786c82945fded6f7fbbbd77f71a31a652aaf6c243fb9bffa545b883d4f4a9dd4546353c07b3df7aa2a2e306c6b5f5d2161b39f5354180696b4aa3a5d7b96736b19e8a29b08363ec33b269f3322dc21dc4d922407034fb12119ca7e7d34038a7ad9d2223c7be260830b81f42749f7a505544ec9288673d428c7daa2d9b312dc21dc4b1aa00ed57cb73322235d82dfde4a48615e2b00f75765c13993860ddfde80c52d1984e273d4dd45319b145ecc546a9a09ac76911ee804349b9c0c1ece36c96b64da2d601c341f5667252bd91b68971ead4d7887b21c4542cee8f10b5794544b651294574b153a7a3fbd1223c00e28b63e99031d733c30d5347b57c6808e19a48e752ee2d431fd6a5dc2a201d512aab5a3959b608f7a345b883b4fb90754ee65122b34ba46b44c7593967c6f792b64d9dfa1a89f0acd70ac6d236211ac2488f688bf0305a843be0544949e36452305df6c6d0a60ebb36543e2a224b6d63d130e97b77ccec478b700f082feb7a41df7befbd17d3bd468eb926882f69aa5ed38c9beaac41b56333a645b8038ea4769786aadda5a09c4f3a468853a75c1b6c90362241fefad7bfdea6a3ec552bafe6615a843bc8781721ea09e574d2506dbf5b69f31d43e6a2ea0966134f62682f271a8e6cdabc4c8b70079c490783344b3b50fb2703f1b73204710ca29fb49c2dd21bcc4e7a8ed35bda3c4e8b7007522b4f9d7ff0c1075b67d3f399b6607dca61ad484523c0a4a5d60de69bdc30b269f3322dc21d68079a0f2aed8ab3116147c27b6207369196da962db0d76f7ef39ba14d9b976911ee406d6e4a1ac74a6d6fc9f1ac8f1c734db005ac2712a672d23e1cd9b47999d58bd0dbceb4fbb45f742418829082da6fbb3a5c73387a938db3b2b1b43e76d6c6ce1cd3b5b37a11eaf9ac22cc5bc774b17394916335fb238b309b864d2346b6b6ec36e33dab1721e171084bdba22027e130da3423c76af6473b51a7167bb2b125fbaae45a84f7ac5e8404886c73109882e5b50e23c76af6477b51278da97eb28ecc2bb5dee9e83dab17611c21425443dba72dd31d2fc7a393c6500e7bb26db20ccb641f6ba7455844c829388a5a5bcf5ec6039ba743845ea5e8758fd24ff64df64188d3f25823ab17a1f488f8d21684f98f04d891f078cc2eca708e3636fb262d4d6aba76ba4df83c024684d6cdf6c8e33923c76af6472a9a39b6a6b3b1b93f764f4ff4da59bd08919a59ba64868c5a3b9392a74ed51c4e06f4d953aacfd6e6e37624bca723e15d8dcc21d24ed12bca715a84a7c10c1aa93d115af772a8d8bc7b47ef6911de3944961cc30fb6709a3cac3a72ac667f5464b54293eab3b7d45fd651cb62adb408efc497b48808394c44d8bda3c7a363862d454269be1763a5fddd83f5f7749bf08ed4c8966aecee193d1d79f8994d2d65177e225c075877ccdcb37a117206e21311bdba2f22ec54f434b023546a605fed4276ef4878cfea4598b68914c964e3388f1abcd3d1d390e70bad4b4bb5bb5b845fb37a11a6978e08a54b9c458dcd715a84c7c3a67e9c545b903d61bc3019c8a84cd6c6ea45487cc609bd1385c3a42b9db3f875a5916335fba332b34cc70cbbb2b3a1a0fe39ee7b5a84cf45e80d619c84b3a4c6567b4f9daa390c69bd6515a1a54a8fdd4765b2365a84772234a9d8eb0ce32c1161da31cdd321c2546e96e9f052e9b1fba84cd6c6ea45a8579433e8b1233ccec249388bb4a93a5473387a43a7226467959e4eb15199ac8d16e1f39932dea8c6411067b11c3956b33fc4a73263cf6c5b57e98dca638dac5e8450237bcc260e526beca9533587c18e750aa0c8c8ce2a3d4d815179ac8d16e11d44e819420ec2595273c7719aa7a3229b8a102abd9ec07dcfea4568bc0a5e46d4223c3d5311eaa8814aafc709ef59bd0845414c452865c2d4a99ac32042e3ad8417db1a3bf4c3a2dd31734f47c2bb28a863a6a6a3e9cd6b111e0f111a6f2542eb11a1479a5a84f7b4089f8b70da3193f5916335fbc386c65b557044689f756f5f6b11ded322bc13a171c28f3efa68eb30897e1d054f033b26bdb7cdc6d03bcaf6d3f25823ab17214c9ff218939a9ab364d9e384c723ea65c8c7d2b6fd66ccb408ef59bd080dd613e174da1aa7d1ab571daa399cb40591f62031fae19d16e13d2dc23b119acd6f42716d0ba2e78e1e4f7a45ad13a15720aadcfaa9faaf69111611a6edd2223c1d225f527bf6f57bffecda63845fd31d33772911f4d4711a8ea24b9d0839cfd4a99ac320be6f7ef39b2fb20c4b3f3190578a8cca646db4089fb74b88d013dfc4275d4abb70e458cdfeb0637edb3ff6344698578a4ccb638dac5e84e00c446866bf368cda1a1ca83a5473387a4393e2679fe1a0bc5264541e6ba3db84772911871011d5ce7566478bf078d8932d3354613d3f49de22bca745f85c849666ce64b2718bf03410219b26c3f0c3abb177b709efe974f40e3532c73073e6bdf7de7bd181d0223c1e11508596173e99281fbbf738e13ddd31f3dc11f20e4cbf1a448404d81d33c7c38e1009d9d35bd644c0f448d7b2582b2dc23b6780c1e37416a423c172e458cdfec828d891082dd9998dd95cfa3f2a93b5d16dc2e7b532c750335baf3f129a9a3c913170a87388b4feff7a0df9fff59a468cbef39ca4630679f3b6c911a9f04665b236562fc2d4ca1121a63f973d12015a84bbc91085091026c98b7e6c4c84ec3e2a93b5b17a117206cb44449d33da85667570fa38d34808e770f2fa7febffbe16118a84b20a4fd2b33511aaf0d8bbd3d17b5a8445849644689f874e1309c3480cf5f81cd4ff59ffefb58830734745414fabb033fbb27377ccdcd36dc23ba788009194542f9e312d427c4c8c75ff1cd4ff85882b22dcc5e83bcf0911b2a38910da8299b8fdecd9b36e133e67f52294821261da27691baaadbdf222227c488875df1c5401e2da44c86ea6a9493d612888ad45c50872edac5e844991088f73e43937e9d2e79f7fbeedd57b4c88757b0e768950c7c7638cbef39cf8cd47bfcc9bf65f320f955c47c27b562f4269511561e635da6f3bddeb0f09716eae5d847a9a092e9946dadcfd64fdd7ac5e84bbe02cda34da364460ec90f3a7c361e47887308aae9588ed2122b6ba2f42dd87fabf9f42c652eb35d8f6e0ee3befbc33b4e99a50d184ba3f19810abf45b80346d2a631ce15078f704ee1c453aa007d7f1cfb219616215bf81ed76bdbb5a8a00cf17899d3c8a66b6224c2083019588b700769337a451f47f3802ac79be30744abf84215d788a545887c0fbb18178489f01c6c64d335f19800e1588b7007da30da877af5743270304e3f4d238f65244054718d585a84dacb96f5fbbca1c08407761bd974ad54f1c9b0c0af5a843b602842d4bb27bd12014543295775c6a712f11d1a01c3d222d4f65321e53a54549f7df6d9ff4480b5331220f4c6b70877602c8be18890d1f4f671be74d44c9df250a602ac62da874b10a1a5ff6bddcc18955626698f6cba26aaf8aa00d926b408f780f152b31bf37afffdf7b70e770a114e4511218dc435626911260a4a4b4d6ee0602aac8e82f7ec12a04abe45b8031d331c8af118d23e42f4b8d3a9455885742d22f4ffa4e76fbef9e636b54a04d4d6b13eb5e7da980a702a4243602dc21dec3262049094d2b6ce9b8821e96688f34730c792ef7b8891709e42bd76dbc607b58fa5e52a24a29386b29975b6c92c995b2615b38a3a133eec13e16287507d287ea5fddc22dc418c8591088d87253585f4acf618667f88238f04f514f27d0f5185f4147c47fe8f7b233c240d2540bfe3c12e44c74e69474794b78cfbb47c4884b01eaaef8416e10e18b43215a2d7e7a78d18a71725c0518f1561ce7f2a53511d4aaec1b5bb1ff7e55e0327630fcec75eb18bed16e117dbf9c790aa23c20c3d587f0023218211d35923024acfa4a31cb846c86b16a1ebcebae8e73e0dc6ab80088d0dd82836b11ea7ac36bc457689906f54a6a2747e8bf0004642644430a8d7f971d6575f7d752bc65344c2e9e7a754c18da8827a2abe27d7231212a00e852a3ed1af0a30f68aed6e95dca37b1e89909d3012229cd322dc414496ed883030a4e37a0239a171448e2a62e021d154a13dc6f4f353f27d0f3112d521887af92e13d9b5ff088e2ddc2f27e2702301e6bc5bc67d5abaef5d9130c24b1444f78eee01a386ec8b00c1d096d2b2cc3335b3c613041cf821d18c043762faf929f9be871809eb10dc838e181d30d24ff79f619b2a3e0e582323d82236bb55728fec3112e15478f6551c6b11ee200244ddcfd0203e0ec7e80ac11f27f57a0c2f377a483423c18d1809a352053762f4994370cd04a8268fd0e278d6ddbf2cc03cd1cc2a8a38a736bb457689702a3cfb2bb28516e1cc10a397464951b5130d6c475cda8c79ea20e96b1560841401e73310a13015cc948c593aee1a32c4a0d3c8f6f4b339ef8d37ded80ebf8ceea9d91f224bc4ab69a97d49d75b8433a36654e3995399df3f24444bce4e501cdf76151f41d48e1de75401fa6c441541e57cdf11719bc9925e5a95805fcaf5ff234e9fcbb1742689e0524fd73dbaa7667f088d1d45c488d07aa2a0735a84332345919e4adb18de6f2012236727b6f4a45a8fc012e188c33e64db79899a11d263f8ee9ce7b355ccc83e62d68ef5dca4ce82a4daa37b6af6475a9e6858db85f639e69c16e1cc303487d65ed276e2d80ac27086948fb08820d82618c24964aa228c102332e721a96cbe2f9f8bf8ac13b7a56ddf2d2aba066d3e919a7388dc70ddb647f7d4ec8fb2674b15307bc27afcc2392dc299a98d74b55f9cdc3ea989a843007ea74134221a02490423185471255a4a2523de2ad20815be2f51d3d231e9a9e10691cfdc456d14d713a7c875275d6a9e8eb2b68c1023c07aac4538331cbc8a4f01d8e6e4996b695b74f434baf7d9102491885284960846408444a0da752259156ca26115aea5cf6a1bfa5ee930f1bbb64e37e7a7f6982afb4440fb1c734e8b706688cb522a0a868f102dab488922ddfc84a26795283da7a78755daa83d59c529aa89a044e6984e1562338d4eca9b4897ffe1fb5d43c42f42fb7ff9ffb906d7ec9c7a2fcde1c4ded6d93336b52f766e11ce4cc60d199fb3dba700523b2a08eb8e4955221682f5e7dc9c8f7c6f0ad4f9f0f914b0f3f2b9e9f7d794289fcf7afd7cbe23ffaf791a2ab5945f6c1cdb2613691136cdc2b4089b66615a844db3302dc2a659981661d32c4c8bb06916a645d8340bd3226c9a856911ce4c06c3a783e919b0ad647f2503bc4f2533603273c377ba861cdff5ffebbd34f3d0229c992a80a9a3d7f3ea7ee4fc2aa8a7301520fcbf1ccf76f6a92c320bc7cc9a1c6be6a345383371f66c4f4596475b309d7e56cf7f2af9ff89c61158c875549156721dcd7cb40867a63a7c841061200210ada48ee699e69d2d5f7df5d5501887e03bf3bd23721db95e9fa9c2acf7d2cc438b7066387204917d558411661567cef3997aee5318893fdf5dbf3fe7a4c24874ceb534f3d1229c99eaf404398d7653914e459188f4546a14ceb5e498e8eb1a5c8b6b4adb31d7e133d69b796911ce4cc41422b208a20a20912991487bd10b978e61dad6ac9501721dc8b1a4c6c8b1663e5a843343649c9ab37bb896303ca8eb215daf93f720aea7e8f356b4bc0326afa4c8eb2a9e4a9eb0f7fa8bbc12c343c01e0cf63f5d836bf182272f2df6ba8da4a1898acdbcac46844450b12f91c732b57f8d4acee188392fa95d3ee3983f1d283ee39827d9bd33c6ebf039777d07cc351291aa383ce92f3abb77954bee3b624db48fdd52f9d4edd1f9d59ef5187b5abf756e5e8449abc2b490e3145564d531ac3bdf7a9cc87acef71a09af93f05a09114d941171441fef7b1939f6359148ea9e44cfbc428338dd3b1b541155fbb09df56aefd8d3b9cac379b1af7df98e948b63b7cecd8b30859cc2b5ac22ca39d5491c77aea8089fb15f9493b6bdfdf6dbdbb48ec842d2c7bc78c98b983072ec6b222f90aa2f914aaa0bfba5d0c429fa7b59957436361431892d36674758b7cf31e759af659173528eb7cccd8b30050a22ab709688731a291d977aa9edbd604994d366e398111daa434e1df816100103b1851caf6f7b2350e7696b7a9da20c413bb8be4c8a7d5311b273d61d4f675448dbf4d6b97911a68d673dc24384a85d537fcc24d18e03a9dd39568d78c4260a4acdfc564375d82ac8508f5f23f5ded9a2e2fed8211d4ace21c6a0924a0aab5de967d5885284233e955e2ac8e0d85a2260584dc74c486d4c7450e3129ef7716ae724e271aa88c87a8d061c909325dd8ce0e29cd571ab435f2335d24558c8fde5772ddcf7d44e3e9fcfb00fbb8a90d2563db1ec4e70ca649a8dd8af921c95e1ad71f322d4e54e68d615b40256e3aa91b55f4433b5b5e8c66922a408d06f4570348e94fd111a078b00737ee08471c45ba2de2fd8813d1ccbfdda661b76734eec05db449a77a5ea494e3b32d131659472bb756e5e84c4a64053d3aa5d453d118f43e42dd67190385a1c873839976d424ccd1ee74b94a822753e478bb0af196211c16207fb621bf79ca8e7be633ffb7c46e566bbdac3d2be7c9eedfc0f2f2af6c26302d4845056ca6c54a6b7c6c58bb0b6156cd7c6bd42222ac76b4a6369db6714a8e306c9b5f3e2181c09d69be58880958575ed4795a432d3564f7b5dd947a0750244962269f503e7c6672e9dab1321aa102342c7ada757cd390a4c278b4e0185ab264e8127628d1ca3391fd3c8685d1341fb5cd9294fe5abac95a9f5b41555b8a96cedb3b49df3f2130497cec58b90612bd91f63337e7a3ced570b2a00918ff8a63d77493d15f62da48bd74e15a1f281f554929a0d3a72342b0851f9467811a4b21f89f05ada9457d326ac42ac38c6e8a929195e0d2aed54a069cb887e6adab4ddaa0334cb416c986e2ba39499f2d3abaa475599cb709437a1551c8b2f84a91f5d22172f4246cd3a23c7e06a3ea48de0b8b684c89768a7c15f3b036ae14e0bbf5986443debca096926d8affcaa18b5ebf5a62a6f652f2545151c9f11311dcfbe4be62a44182146844941443dc637de64568b42525835ddb4fe1871866619a695226c2b1b651961e65cc70d6dc876f4a61220b181f0f849a262f5a34be6e2454864558411a046777e765aa128308884b609d2f043448914780a1853a768cecb547895ec739e0a15f90c616a724851b517f9487ac6e32798fad3257215224caa11e38a8004c8f8afbcf2cab6b0329ea5d032b89e5ab4a2109defb836639ca159869a7a2a174bfb94a5325566f62b2b65e6b8f3edd3ec708e0e38be201a1ad22046fe2222565fba54161761da7815fb092fc644d252e2f3cbb50a49a4ab05daac0f95b065da8a2aeaf4a0f2a59a454d7d2be9ebd22c2e4246aa692662ac1c4b34d40650eba9fda685d1ac135133d1333da8fc87bff01f7e956d91d2327e16812ecde2224c6dc428d2cca9082d6deb7c3180cbd8e9fd4c7ad9ac97cc804aba6a3b83fca21dd1f19f44c888504675296dc6c5459894339130912f06b3dfd083ce16c24bbb409b208df666bda8945319ab9c4db8b76e809f3ff9e347e947881855f08e4ffd71092e261226fa11659d1be8dd26a631e96c91ff139e5e32c6ef8e9546654c84fa0854cefa09f80a1f316c95612ca2b3cecff8173a123e8781882d113079bbde2e0f813226e3129c9a2e91b0d680cd7ae107967c0259e72f04a902d76153c7112d918a7f692e42849644a8b6820e18ed3f22634cb51de3a65b1a0cdd1d340d11ca8ef849fa0954dcd6a5a67c8510bd298eafa5f923151519ab2f2ec545a4a3844784b6a5085250c6fdc637bef14280b6ab0893864c0ba55917c4061912f845cd94ec1311a5ab1ef0368e984c4b653ff5c725985d846a1c2273e3c23f6c5b32426a23e9827d5eac4464696037cd3110219112a79e539d7c7c519b901fa69d9828691f9f150cac4ffd790e6617611abf6ed2d20da70d681df6bb711190a152bb25c76f9aa7427c898e22a377a67acc8ddfa5f32ffe597d143723c2e94dda4e2d233548cd636c27e98354221d3223c336cd21f0a32a466d449d7e7c8f10f9a5f50407fe7a2e01e22c6d4237e646d3289602b8497f8e31880898eee534ae196d64d4a6d997f425a8dc75def02f599688a8d7343da5fc52701001f96af69d83b38990e86ace6d9fbcdc4c18d38d62a0082fb5d7d4a84d732804a89fc1326254d1f3bbda439ab6200126609c83b38a30b58edac6cd9bc190a188d450b5e6ea74b43905115efa1952c15b6a06f1437e4a808458b3b67370b63621727304a9bbd8d422a2ab46b18cb11c1b19b5690e61ea572a7d4bc2341d52470d9f4c70e0ab372b42379a990b064ffdb04a8622f22c601d03c4d4a04d7328fc4885cebf906d11d2b65e790182af4ee797565f9e8bb38830d876b36a1b6928238c8cd634e742856fe9195591503aca4f45c2a4a97373b636a165525151d07b40d54253a334cd3949aaaab734a28bbf663937671161ba7dfd029275b362d20133324cd39c0b22140c0c89f95d0c69289f1511cfd52e3c9b08dd10119aaa664c50db8f014686699a73418011a2218b040c22d47f31f2e753731611220d5d8d6037ddef87692e01c140474d9a465e8fc14fa5a2c438f2e55373968e190274436628e81175c33a657a08a2591a22cc14493ee941e08c15de4c9b50783733c60d690bba59b8f116617309c427f551784635f34a6f46846621a44326afa920bebca0776494a63917c6a70dda676c9a4f7aa31f01decc38616e448837309f9e2837de226c9626a9a875e9a8be0a01c29ce69b12213478e5df11a1650f51344b23102418f049c14174ccc3bf239f3e356713a1ee5fa28b08ddb81b9e1aa569ce49fc31eb9622a30e9a8c19cecdec22847661726e376aa9b61119ab419ae6dcf0c1bc308c8fa6a9c43f6fa66306a6a9690f4684a2a01b6f11364ba3a390e06aef28bfb4ed499f913f9f9ab388d0d0849b75d344981ac7726a94a63927042728101df8a50e1aeb7e766fe4cfa7e62c224c4d4380c8d31322e3d4284d734ee2933520f055be697ae5c89f4fcd5944e826d30624404b37ed26ab419ae6dc105cfc5144b44c9f85f5913f9f9aa345e8d9400d58ddb97a41ad67db04585dbd6e2ee9a8f569cdd334978aa1357eccb74d38e1f319c8afefa73986a34568107e2442eb9e9cf00e8f9108d540d31b6e9a4b4310c9c307172b42c30fb928dbd673b184690a909b11f27363a2608bb0b906bc07896f836fc7c7f9b600141d1cc3d122cc85d56d22b4842796094e5b5014746311600bb1b9740cda0b34d5d72d8930c1e6588e16618d80c1c5e5f571266d8b7c20c208afae37cda5c27ffd784c0498882845cdbe63395a84355f4e04b42440efec30ee923660159e1ea8ee9c692e1d7e6a3237bfae6969de9734d2c4a11c2dc25c4ca25f44a8d1ea55164447846e880813117bb0beb906f86e7e40662a4229e948138772b408d37d4b805584a2a01a445b30edc144bf1661732d98476a98e2a245984828f2251a4a51f1eebbef0e6fac69ae0581c31340fc996fc7ef09f0628628a622840b76917a464737d634d702117a2f127f2642beceef6d5fcc10454498417b227481f6b9f8d18d35cdb540846fbdf5d6d6d79392f273cb1a198fe16811a6773417e40289d005ebde1ddd58d35c0bfa2fbcee22591edf8e082da77a780a2713612ed03edb22a349b0a31b6b9a6b821fa7b9c5df2df938a67a780a478b30a9672e30fbf58eaa454637d534d742c6b70dd8f371cdaf647dd5df8fe16422149ad33eb43f6384a31b6b9a6b810f833fc7c72342eb550b4f655611f6386073edf06178d5051f372e9e5ed153fd56c5d1224caf28010acfd6d5147e732237f018a9699ae612e1a32696987892f4938ff3fb049c63395a842e088988f6599aea9359318f31baf1a6b914f8a8610a2f2b4bc6173f7ff6ecd94b5a782a478b301756c5284cab39f6e91dd5e86d9a4b851089d0d435fe9d9e51be7f3122840b7381d689506aeaa2d52223e135cdb590870ffc484cf5f3b40b4fc1d1227461a91d0810f6fb0d70eff577134d73ad782d8b0710f471f073becdd78d1b9e4a8827ed9821c0846cefe648287f8c510ad0349742da86fc995f27d38b204fc1d122d413aa66f01b8496a91dd414decfe1454f8f216236cda522027a79b521b7f87c460192f51dcbd12274312e8a086d9b29635ba33569ea634cbfaf692e09bfad29b0a4a9c5a7f9fc45b5099b7951d8a9b0e200d221386e699f9a5a373aeaec0e4bd4efec4af0b268115e380414c14450755b738050a5ffb210a4d3c0b17c06f9ce7c1ef57f35cbd022bc706abb23a289f044c6a9e8a6a2ac221c0931dbcd72b4082f9ccc4f24a08886b8ccea27b62a38fb508549a84963a7426c2e8316e18593761d21d9b64e68da7d11da3e226c215e2e2dc22b8080a49959125984468c557855908e25451d09b1c57819b4082f9c4434428ac822ac91e8a6a2ccb9180971f43f9bf3d222bc703cc7468488b8222022d34e243013e6cd6f8475fb726c2ac22ac4d1ff6cce4b8b706632c81ba6bd9226364418f61346221be15826125afff4d34fb722b3cff7112931e63b2258dfe378bd96e6fcd40ab0567ad50f5a84333312608c9fe396894c0a2b2926315591659b0813059d171caf855d0bbd598694eb4328b716e1cc3c26c0907d6a4c42ca32914f411117ac6bf759a696cd3ec2f43d11b6f3f33f9a65a8654e74ca24e5a68c955b8b70665208b530909a50a144a48980b58044be2aba7cc676da8b35723a9eff65bd5e4b737e6a25ac3c52b62933cb16e1cc4410759fc2080a25c7a7224c2a6a9988a840b523edf70a91b41909d3f759c2f739affedfe6fc4480d6958bb24d392b3bcb16e199a902ac82b19d1a328524022a34cb4ccc76ae82752e612a48e7e4fbad43c1679277b32cb5bc954d2d67156c8bf08ca43052201160849302222c824b948b2061ddbe5a90d67d57bedb77126147c2e5a9653b4299b608cfc44880209608ca760a26a968151d518a7e690b8a883e93cffb6c22a063a3eb68ce4b2a4a28276594b2e70bb65b84334314317644550b84a8144804e67c24f2a5d07c478408fb9d37fa9fcdf9502e962937ebca26d98b25ec4bc5aa3c95b57d5f7ef9e5e6ff014239eea7d6c20fa00000000049454e44ae426082); 