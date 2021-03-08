-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 23, 2021 at 10:33 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opus`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `about` text NOT NULL,
  `mission` text NOT NULL,
  `vision` text NOT NULL,
  `services` text NOT NULL,
  `more` text NOT NULL,
  `existence` int(11) NOT NULL,
  `aboutimage` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `about`, `mission`, `vision`, `services`, `more`, `existence`, `aboutimage`, `created_date`) VALUES
(5, 'We Train and Equip African To Study, Practice and Teach God\'s Word Accurately', 'To bring training to untrained pastors in order to deepen the church and advance the Gospel through healthy churches.', 'All pastors in all African communities trained and equipped for the cause of the Gospel.', '<li>We train, equip, educate and resource pastors.</li>\r\n<li>We empower pastors spouses.</li>\r\n<li>We rescue pastors and their families in emergencies.</li>\r\n<li>We provide pastoral care and counseling support for pastors</li>\r\n<li>We provide researched data to help pastors make informed decisions</li>', 'PDN is a registered nonprofit (501c3) organization established in 2009. During the past 10 years, we have provided high quality theological, leadership and ministry training to over 6,000 pastors in Africa across 18 denominations. Additionally, we have provided special business training program to pastors in business to more than 2,200 pastors and their spouses in partnership with Baylor University of Waco Texas.', 67, 'We_Train_and_Equip_African_To_Study,_Practice_and_Teach_Gods_Word_Accurately1.jpg', '2021-02-20 06:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int(25) NOT NULL AUTO_INCREMENT,
  `artist_id` int(100) NOT NULL,
  `album_title` varchar(100) NOT NULL,
  `release_year` year(4) NOT NULL,
  `added_date` timestamp NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `artist_id`, `album_title`, `release_year`, `added_date`) VALUES
(2, 3, 'Dongo January', 2018, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(25) NOT NULL,
  `reg_no` int(25) NOT NULL,
  `artist_name` varchar(100) NOT NULL,
  `biography` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(25) NOT NULL,
  `designation` int(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `nationality` varchar(25) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `genre_id`, `reg_no`, `artist_name`, `biography`, `email`, `address`, `contact`, `designation`, `gender`, `dob`, `nationality`, `photo`, `created_date`) VALUES
(7, 3, 4029716, 'Andrea Preson', 'To take place at Bombo we offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others', 'andreapreson@gmail.com', 'Gayaza', '0750346756', 4, 'Female', '1999-08-06', 'Uganda', 'Andrea_Preson.jpg', '2021-02-21 08:00:00'),
(8, 2, 8903275, 'Dong Kenishio', 'To take place at Bombo we offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others', 'dongo@gmail.com', 'Nansana', '0788346788', 4, 'Male', '1996-11-12', 'Uganda', 'Dong_Kenishio.jpg', '2021-02-21 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(500) NOT NULL,
  `blog_content` text NOT NULL,
  `blog_file` varchar(25) NOT NULL,
  `created_at` varchar(25) NOT NULL,
  `updated_at` varchar(25) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_title`, `blog_content`, `blog_file`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Blog Title Name', '<p>Blog Content Message</p>\r\n', '1590666932751.jpg', '2020-05-28 01:28:20 PM', '2020-05-28 02:55:32 PM', 'Admin'),
(3, 'WHAT IS PCOS?', '<h1>WHAT IS PCOS?</h1>\r\n\r\n<p>By Teen Health Source</p>\r\n\r\n<p>Polycystic Ovary Syndrome (PCOS/Polycystic Ovarian Disease) is a hormonal disorder that affects 6-10% of people with ovaries.</p>\r\n\r\n<p>PCOS causes ovaries to produce higher amounts of androgens. This causes eggs in the ovaries to develop into cysts (small liquid-filled sacs). The cysts contribute to hormone imbalances, as well as build up and enlarge the ovaries. If left untreated, PCOS can potentially lead to diabetes or heart disease. </p>\r\n\r\n<h1><strong>WHAT CAUSES PCOS?</strong></h1>\r\n\r\n<p>It is not 100% clear how people get PCOS. Research does indicate that PCOS seems to be genetic, since your chance of having it is higher if other people in your family have PCOS or have irregular periods or diabetes (It can be passed down from either parent’s side). Some researchers think that it may be caused by high insulin production. When too much insulin is produced, the body releases extra androgens.</p>\r\n\r\n<h2><strong>What are symptoms of PCOS?</strong></h2>\r\n\r\n<p>PCOS symptoms often appear in a person’s early teens, around when you’d start getting your period, but it’s also possible that symptoms don’t start appearing until your 20s or 30s.</p>\r\n\r\n<p>Common symptoms of PCOS can include:</p>\r\n\r\n<h3><strong>Period Problems.</strong></h3>\r\n\r\n<p>This can be a wide range of problems, from having few or no periods all the way to heavy and irregular bleeding.</p>\r\n\r\n<h3><strong>Insulin Resistance.</strong></h3>\r\n\r\n<p>This can cause an increase in blood sugar and lead to diabetes. This can also cause skin tags, weight gain or difficulty losing weight, breathing problems/obstructive sleep apnea.</p>\r\n\r\n<h3><strong>Hair Conditions.</strong></h3>\r\n\r\n<p>This includes experiencing hair loss from your scalp, and/or growing hair on your face, chest, back, stomach, thumbs, or toes.</p>\r\n\r\n<h3><strong>Mental Health.</strong></h3>\r\n\r\n<p>It is common to experience anxiety or depression if you have PCOS. This can be a symptom of the hormonal imbalance, or from the stress of managing other symptoms.</p>\r\n\r\n<h3><strong>Skin Conditions.</strong></h3>\r\n\r\n<p>There are a number of possible skin conditions you may experience, including developing:</p>\r\n\r\n<ul>\r\n	<li>Acne or having oily skin</li>\r\n	<li>Skin tags (teardrop-shaped pieces of skin typically found in the armpits or neck area)</li>\r\n	<li>Darkening and thickening of the skin on the neck, groin, underarms or skin folds</li>\r\n</ul>\r\n\r\n<h3><strong>Fertility Problems.</strong></h3>\r\n\r\n<p>This can include not ovulating (not releasing an egg), getting pregnant but having repeated miscarriages, or permanent infertility.</p>\r\n\r\n<p>If you are experiencing any of the above symptoms, it’s generally recommended that you check in with a clinician. These symptoms overlap with symptoms for other conditions, and the only way to diagnose or rule out PCOS is to see a clinician.</p>\r\n\r\n<h2><strong>How do they diagnose PCOS?</strong></h2>\r\n\r\n<p>No single test can show that you have PCOS. To diagnose it, a clinician will:</p>\r\n\r\n<ul>\r\n	<li>Ask questions about your past health, family history, symptoms, and menstrual cycles.</li>\r\n	<li>Do a physical examination to look for signs of PCOS. They may look for physical symptoms, like acne, hair growth and darkened skin. They may check your weight and blood pressure.</li>\r\n	<li>Do lab tests to check your blood sugar, insulin, and other hormone levels. Hormone tests can help rule out thyroid or other gland problems that could cause similar symptoms.</li>\r\n	<li>You may also have a pelvic ultrasound to look for cysts on your ovaries. It’s possible to diagnose PCOS without an ultrasound, but this can help them rule out other problems that can cause similar symptoms.</li>\r\n</ul>\r\n\r\n<h2><strong>How do you treat PCOS?</strong></h2>\r\n\r\n<p>There is no cure for PCOS. Some treatments will involve medications or medical procedures that you will need to see a clinician for, and some treatments will be lifestyle changes that you’re able to manage on your own. The treatments you explore will depend on your symptoms.</p>\r\n\r\n<p>It’s common for clinicians to prescribe birth control pills to reduce symptoms and help you have a more predictable menstrual cycle. They may prescribe fertility medicines or procedures if you are having trouble getting pregnant. Other options could include hormone therapy, or potentially even surgery.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><em><strong>Managing Symptoms!</strong></em></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Birth control pills in this case are being prescribed to regulate your menstrual cycle. Symptoms of PCOS will come back if you stop taking the pill. Birth control pills being used to treat PCOS do still prevent pregnancy.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Hormonal treatments don’t address symptoms, like blood pressure, cholesterol, and diabetes risks. To treat those, you and your clinician might explore lifestyle changes like:</p>\r\n\r\n<h3><strong>Physical Activity.</strong></h3>\r\n\r\n<p>Regular exercise, whether it’s going for a walk, playing a sport, or going to the gym.</p>\r\n\r\n<h3><strong>A Balanced Diet.</strong></h3>\r\n\r\n<p>Eating lots of heart-healthy foods (vegetables, fruits, nuts, beans, whole grains, etc.), Limiting high saturated fats (meat, cheese, fried foods) or processed foods with high sugar.</p>\r\n\r\n<h3><strong>Avoiding Smoking.</strong></h3>\r\n\r\n<p>Smokers have higher levels of androgens</p>\r\n\r\n<p>For some people, losing a bit of weight can help with hormone balance, as well as address risk factors for things like diabetes or heart disease. A healthy weight management plan would balance things like a healthy diet, exercise, medications, etc. How you pursue this strategy might depend on whether or not you have a body-positive clinician or dietician.</p>\r\n\r\n<p>If you are concerned about acne or hair conditions, those can be managed using non-prescription methods. Sometimes acne is treated as a side-effect of going on birth control. Unwanted hair can be removed by shaving, waxing, plucking, or electrolysis. </p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><em><strong>Your Body, Your Choice!</strong></em></td>\r\n		</tr>\r\n		<tr>\r\n			<td>You don’t have to get rid of acne or treat you hair conditions if you aren’t bothered by them! For more on navigating body feelings, please see our Body Positivity page.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h2><strong>Seeing Clinicians for PCOS</strong></h2>\r\n\r\n<p>It’s generally recommended to check in with a clinician if you are experiencing symptoms of PCOS. While PCOS cannot be prevented, early diagnosis and treatment helps prevent long-term complications. </p>\r\n\r\n<p>Regular checkups are important for catching PCOS complications, such as high blood pressure, high cholesterol, uterine cancer, heart disease, and diabetes.</p>\r\n\r\n<p>Your family doctor can diagnose and treat PCOS, but you may also get referred to other specialists.</p>\r\n\r\n<p>If you are experiencing severe vaginal bleeding (passing clots of blood and soaking through your usual pads or tampons every hour for 2 or more hours), you should check in with a clinician immediately.</p>\r\n', '1591011549380.jpg', '2020-05-28 02:59:44 PM', '2020-06-01 02:39:09 PM', 'Admin'),
(4, 'Sample Blog Demo', '<p>Sample Blog</p>\r\n', '1613939503001.jpg', '2020-06-01 07:43:33 AM', '2021-02-21 11:31:42 PM', 'Admin'),
(5, 'Sample Challenge Blog Demo', '<p>Sample Challenge Blog</p>\r\n', '1590986669587.jpg', '2020-06-01 07:44:29 AM', '2020-06-01 07:51:44 AM', 'Admin'),
(6, 'Covid-19', '<p>Covid-19</p>\r\n', '1590987336599.jpg', '2020-06-01 07:55:36 AM', '2021-02-22 08:32:34 AM', 'Admin'),
(7, 'Come Home with Tomath', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt voluptate, quibusdam sunt iste dolores consequatur\r\n\r\nBecome an Opus Partner\r\nFar far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt voluptate, quibusdam sunt iste dolores consequatur', '1613920223448.jpg', '2021-02-21 06:10:23 PM', '', 'Admin'),
(8, 'We are to discuss about school fee', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt voluptate, quibusdam sunt iste dolores consequatur\r\n\r\nBecome an Opus Partner\r\nFar far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt voluptate, quibusdam sunt iste dolores consequatur', '1613971892777.jpg', '2021-02-21 06:16:42 PM', '2021-02-22 08:31:32 AM', 'Admin'),
(9, 'where they abused her for their.', 'The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word \"and\" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.', '1613928925085.jpg', '2021-02-21 08:35:25 PM', '2021-02-22 09:37:21 AM', 'Admin'),
(10, 'where they abused her for their.', 'The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word \"and\" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.', '1613934090973.jpg', '2021-02-21 10:01:30 PM', '2021-02-22 09:35:54 AM', 'Admin'),
(11, '2021 is going to be tough', '<p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word \"and\" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>', '1613973556117.jpg', '2021-02-22 08:59:16 AM', '', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `display`
--

DROP TABLE IF EXISTS `display`;
CREATE TABLE IF NOT EXISTS `display` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `info` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `btn_text` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `display`
--

INSERT INTO `display` (`id`, `slide`, `photo`, `info`, `created_date`, `btn_text`) VALUES
(12, 'slide1', 'slide12.jpg', '', '2021-02-20 08:00:00', ''),
(13, 'slide2', 'slide23.jpg', '', '2021-02-20 08:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `emp_role` int(11) NOT NULL,
  `nok_name` varchar(100) NOT NULL,
  `nok_contact` varchar(25) NOT NULL,
  `facebook_link` varchar(100) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `youtube_link` varchar(100) NOT NULL,
  `emp_rname` varchar(60) NOT NULL,
  `photo` varchar(25) NOT NULL,
  `reg_date` date NOT NULL,
  `reg_at` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_name`, `email`, `gender`, `contact`, `dob`, `nationality`, `address`, `emp_role`, `nok_name`, `nok_contact`, `facebook_link`, `twitter_link`, `youtube_link`, `emp_rname`, `photo`, `reg_date`, `reg_at`) VALUES
(5, 'Daniel', 'dan@gmail.com', 'Male', '+256751603010', '2012-02-17', 'Ugandan', 'Soroti', 6, 'Junior', '+256789654321', '', '', '', 'Manager', 'Daniel.jpg', '2019-12-10', '05:27:18pm'),
(6, 'Dongo Hamuza', 'dongoamuza@gmail.com', 'Male', '+256750346788', '2019-12-02', 'Ugandan', 'Nansa', 3, 'David', '+256750346788', '', '', '', 'Accountant', 'Dongo_Hamuza1.jpg', '2019-12-19', '02:35:19pm'),
(7, 'Danfodio', 'daniondanfodio@gmail.com', 'Male', '+256706551841', '2020-03-03', 'Ugandan', 'Mengo', 7, 'Daniel', '+256706551841', 'https://www.facebook.com/PDNAfrica/', '', '', 'Chief Executive Officer', 'Danfodio2.jpg', '2020-03-11', '08:54:15pm'),
(8, 'Naigaga Aisha', 'naigagaaisha@gmail.com', 'Female', '+25677872618', '2000-01-24', 'Ugandan', 'Nansana', 4, 'Dongo Amuza', '+256788346788', '', '', '', 'Presenters', 'Naigaga_Aisha.jpg', '2020-09-03', '12:51:26pm'),
(9, 'Mpagi Tony', 'mpagitonnymasembe@gmail.com', 'Male', '+256785318663', '1997-09-12', 'Ugandan', 'Ntinda', 4, 'Dong', '+256788346788', '', '', '', 'Presenter', 'Mpagi_Tony2.jpg', '2020-09-08', '11:53:05am'),
(10, 'Mpagi Tony', 'mpagitonny@gmail.com', 'Male', '+256785318663', '1997-09-12', 'Ugandan', 'Ntinda', 4, 'Dong', '+256788346788', '', '', '', 'Presenter', 'Mpagi_Tony1.jpg', '2020-09-08', '11:51:13am');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_name` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `event_date` datetime NOT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` int(10) NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(25) NOT NULL,
  `genre_type` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`, `genre_type`, `created_at`) VALUES
(2, 'Rock', 'system', '2021-02-21 08:00:00'),
(3, 'Drum and bass', '', '2021-02-21 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role_type` varchar(100) NOT NULL DEFAULT 'custom',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `name`, `role_type`) VALUES
(1, 1, 'Administrator', 'system'),
(4, 4, 'Artist', 'system'),
(5, 5, 'Super Administrator', 'system'),
(6, 6, 'Manager', 'custom'),
(7, 7, 'Chief Executive Officer', 'custom');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `info` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `info`, `created_date`) VALUES
(1, 'Motivate Uganda', 'Hello Men of God\r\nPdn Is A Registered Nonprofit (501c3) Organization', '2021-02-20 06:53:53'),
(2, 'Understanding Love #10MinsLD', 'Welcome To Our Sunday Service We Offer Recovery And Support', '2021-02-20 06:53:53'),
(3, 'Understanding Love #10MinsLD.', 'Hello Men of God Pdn Is A Registered Nonprofit', '2021-02-20 06:53:53'),
(4, 'Messege of Hope_With Tonny', 'Hello Men of God Pdn Is A Registered Nonprofit ', '2021-02-20 08:00:00'),
(5, 'The Paid Price #10MinsLD', 'Long Jinja High Way We Offer Recovery And Support Services ', '2021-02-28 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(60) NOT NULL,
  `spname` varchar(60) NOT NULL,
  `smotto` varchar(60) NOT NULL,
  `semail` varchar(60) NOT NULL,
  `sphone` varchar(60) NOT NULL,
  `saddress` varchar(250) NOT NULL,
  `swurl` varchar(250) NOT NULL,
  `sphoto` varchar(60) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '100',
  `sbackgphoto` varchar(60) NOT NULL,
  `eventbgimg` varchar(100) NOT NULL,
  `radiobgimg` varchar(100) NOT NULL,
  `sosname` varchar(60) NOT NULL,
  `sversion` varchar(10) NOT NULL,
  `subscribe_date` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ug_address` text NOT NULL,
  `ug_email` varchar(50) NOT NULL,
  `ug_contact` varchar(20) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sid`, `sname`, `spname`, `smotto`, `semail`, `sphone`, `saddress`, `swurl`, `sphoto`, `status`, `sbackgphoto`, `eventbgimg`, `radiobgimg`, `sosname`, `sversion`, `subscribe_date`, `ug_address`, `ug_email`, `ug_contact`) VALUES
(1, 'Opus Music', 'Opus Music', 'We Change your mind set from failure to success', 'admin@opusmusic.com', '0788346788', 'Kampala', 'www.opusmusic.com', '1613807386159.jpg', 100, '1576745516598.jpg', '1602331738926.jpg', '1602247385132.jpg', 'Web', '1.0.0', '‚pÛÓR·\0©f', 'Plot 2312 and 67 Bweyogerere, Kazinga, Kira, Wakiso District, Uganda', 'opusmusic@gmail.com', '+256 392 176713');

--
-- Triggers `settings`
--
DROP TRIGGER IF EXISTS `encodesdate`;
DELIMITER $$
CREATE TRIGGER `encodesdate` BEFORE INSERT ON `settings` FOR EACH ROW SET NEW.subscribe_date = ENCODE(NEW.subscribe_date,'subcrdate')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

DROP TABLE IF EXISTS `subscriber`;
CREATE TABLE IF NOT EXISTS `subscriber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'active',
  `message` varchar(25) NOT NULL DEFAULT 'pending',
  `subscribe_date` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `system_id` int(11) NOT NULL,
  `amount_paid` double(10,2) NOT NULL,
  `expiry_date` varchar(60) NOT NULL,
  `subscribe_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscribe_id`, `system_id`, `amount_paid`, `expiry_date`, `subscribe_date`) VALUES
(1, 1, 0.00, '‚pÛÓRš„®', '2021-02-20 06:53:53'),
(2, 1, 0.00, '‚pÛÓRˆ«d', '2021-02-20 06:53:53'),
(3, 1, 500000.00, '‚pÛÓR·\0©f', '2021-02-20 06:53:53');

--
-- Triggers `subscription`
--
DROP TRIGGER IF EXISTS `encodesedate`;
DELIMITER $$
CREATE TRIGGER `encodesedate` BEFORE INSERT ON `subscription` FOR EACH ROW SET NEW.expiry_date = ENCODE(NEW.expiry_date,'subcrdate')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

DROP TABLE IF EXISTS `tracks`;
CREATE TABLE IF NOT EXISTS `tracks` (
  `track_id` int(25) NOT NULL AUTO_INCREMENT,
  `track_title` varchar(100) NOT NULL,
  `genre_id` int(25) NOT NULL,
  `track` varchar(255) NOT NULL,
  `artist_id` int(25) NOT NULL,
  `release_year` varchar(25) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL,
  PRIMARY KEY (`track_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`track_id`, `track_title`, `genre_id`, `track`, `artist_id`, `release_year`, `photo`, `created_date`) VALUES
(2, 'Come Home', 3, 'Come_Home.mp3', 7, '2020', 'Come_Home.jpg', '0000-00-00 00:00:00'),
(3, 'Kampa', 3, 'Kampa.mp3', 7, '2021', 'Kampa.jpg', '0000-00-00 00:00:00'),
(4, 'Kwagala', 2, 'Kwagala.mp3', 6, '2020', 'Kwagala1.jpg', '0000-00-00 00:00:00'),
(5, 'Love is great', 3, 'Love_is_great.mp3', 7, '2021', 'Love_is_great1.jpg', '0000-00-00 00:00:00'),
(6, 'Bayambe', 3, 'Bayambe.mp3', 7, '2018', 'Bayambe1.jpg', '0000-00-00 00:00:00'),
(7, 'Will you do this', 3, 'Will_you_do_this.mp3', 7, '2017', 'Will_you_do_this.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'inactive',
  `name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `jdate` date NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`, `status`, `name`, `phone`, `photo`, `jdate`, `created_at`, `user_id`) VALUES
(1, 5, 'other@opus.com', 'Ü(8„¼NYôv', 'active', 'Other', '+256750346788', 'Other.jpg', '2019-12-19', '12:34 PM', 0),
(2, 1, 'admin@opus.com', 'Ü\r³°a«Ñ', 'active', 'Admin', '+256750346788', 'Admin3.jpg', '2019-12-19', '12:48:14pm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

DROP TABLE IF EXISTS `works`;
CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `title`, `description`, `photo`, `added_date`) VALUES
(2, 'Come one', 'To take place at Bombo\r\nwe offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others', 'Come_one.jpg', '2020-11-08 00:00:00'),
(3, 'Come Sunday ', 'On this Sunday are u ready for this!\r\nwe offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others\r\nOn this Sunday are u ready for this! we offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others\r\n\r\n\r\nOh my God We are here\r\nDo not mind we are to make it we offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others', 'Come_Sunday_1.jpg', '2020-11-14 00:00:00'),
(4, 'Oh my God We are here', 'Do not mind we are to make it\r\nwe offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others', 'Oh_my_God_We_are_here.jpg', '2020-09-03 00:00:00'),
(5, 'We Shyall', 'Long Jinja High way\r\nwe offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others', 'We_Shyall.jpg', '2020-11-12 00:00:00'),
(6, 'Sunday Service', 'Welcome to our Sunday Service\r\nwe offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others', 'Sunday_Service.jpg', '2020-10-30 00:00:00'),
(8, 'oooohj ', 'klkhnloh[', 'Sunday_Service.jpg', '2020-11-26 00:00:00'),
(9, '-9y=8-[k\'[k[k[ik', 'programs to those that have gone through trauma, depression addiction among others Oh my God We are here Do not mind we are to make it we offer recovery and support services through different programs to those that have gone through trauma, depression addiction among others', 'Sunday_Service.jpg', '2020-11-13 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
