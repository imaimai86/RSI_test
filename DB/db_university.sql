-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2015 at 05:52 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_university`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_fname` varchar(100) NOT NULL,
  `admin_lname` varchar(100) NOT NULL,
  `admin_email_address` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_created_date` datetime NOT NULL,
  `admin_status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email_address`, `admin_password`, `admin_created_date`, `admin_status`) VALUES
(1, 'Super', 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', '2011-10-05 12:40:52', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

CREATE TABLE IF NOT EXISTS `tbl_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_date_time` datetime NOT NULL,
  `updated_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `combined` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`id`, `country_id`, `title`, `is_active`, `is_deleted`, `created_date_time`, `updated_date_time`) VALUES
(9, 225, 'Abu Dhabi', '1', '0', '0000-00-00 00:00:00', '2015-11-11 17:43:04'),
(10, 225, 'Ajman', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 225, 'Dubai', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 225, 'Fujairah', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 225, 'Ras al Khaimah', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 225, 'Sharjah', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 225, 'Umm Al Quwain', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 225, 'Al Ain', '1', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 225, 'Banglore', '1', '1', '2015-11-04 16:20:09', '0000-00-00 00:00:00'),
(18, 225, 'Qusais', '1', '1', '2015-11-04 16:59:56', '2015-11-04 17:02:03'),
(19, 98, 'Banglore', '1', '1', '2015-11-11 17:43:46', '2015-11-11 17:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE IF NOT EXISTS `tbl_countries` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=243 ;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `name`, `is_active`, `is_deleted`) VALUES
(1, 'Afghanistan', '1', '0'),
(2, 'Albania', '1', '0'),
(3, 'Algeria', '1', '0'),
(4, 'American Samoa', '1', '0'),
(5, 'Andorra', '1', '0'),
(6, 'Angola', '1', '0'),
(7, 'Anguilla', '1', '0'),
(8, 'Antarctica', '1', '0'),
(9, 'Antigua and Barbuda', '1', '0'),
(10, 'Argentina', '1', '0'),
(11, 'Armenia', '1', '0'),
(12, 'Aruba', '1', '0'),
(13, 'Australia', '1', '0'),
(14, 'Austria', '1', '0'),
(15, 'Azerbaijan', '1', '0'),
(16, 'Bahamas', '1', '0'),
(17, 'Bahrain', '1', '0'),
(18, 'Bangladesh', '1', '0'),
(19, 'Barbados', '1', '0'),
(20, 'Belarus', '1', '0'),
(21, 'Belgium', '1', '0'),
(22, 'Belize', '1', '0'),
(23, 'Benin', '1', '0'),
(24, 'Bermuda', '1', '0'),
(25, 'Bhutan', '1', '0'),
(26, 'Bolivia', '1', '0'),
(27, 'Bosnia and Herzegovina', '1', '0'),
(28, 'Botswana', '1', '0'),
(29, 'Bouvet Island', '1', '0'),
(30, 'Brazil', '1', '0'),
(31, 'British Indian Ocean Territory', '1', '0'),
(32, 'British Virgin Islands', '1', '0'),
(33, 'Brunei', '1', '0'),
(34, 'Bulgaria', '1', '0'),
(35, 'Burkina Faso', '1', '0'),
(36, 'Burundi', '1', '0'),
(37, 'Cambodia', '1', '0'),
(38, 'Cameroon', '1', '0'),
(39, 'Canada', '1', '0'),
(40, 'Cape Verde', '1', '0'),
(41, 'Cayman Islands', '1', '0'),
(42, 'Central African Republic', '1', '0'),
(43, 'Chad', '1', '0'),
(44, 'Chile', '1', '0'),
(45, 'China', '1', '0'),
(46, 'Christmas Island', '1', '0'),
(47, 'Cocos Islands', '1', '0'),
(48, 'Colombia', '1', '0'),
(49, 'Comoros', '1', '0'),
(50, 'Cook Islands', '1', '0'),
(51, 'Costa Rica', '1', '0'),
(52, 'Croatia', '1', '0'),
(53, 'Cuba', '1', '0'),
(54, 'Cyprus', '1', '0'),
(55, 'Czech Republic', '1', '0'),
(56, 'Democratic Republic of the Congo', '1', '0'),
(57, 'Denmark', '1', '0'),
(58, 'Djibouti', '1', '0'),
(59, 'Dominica', '1', '0'),
(60, 'Dominican Republic', '1', '0'),
(61, 'East Timor', '1', '0'),
(62, 'Ecuador', '1', '0'),
(63, 'Egypt', '1', '0'),
(64, 'El Salvador', '1', '0'),
(65, 'Equatorial Guinea', '1', '0'),
(66, 'Eritrea', '1', '0'),
(67, 'Estonia', '1', '0'),
(68, 'Ethiopia', '1', '0'),
(69, 'Falkland Islands', '1', '0'),
(70, 'Faroe Islands', '1', '0'),
(71, 'Fiji', '1', '0'),
(72, 'Finland', '1', '0'),
(73, 'France', '1', '0'),
(74, 'French Guiana', '1', '0'),
(75, 'French Polynesia', '1', '0'),
(76, 'French Southern Territories', '1', '0'),
(77, 'Gabon', '1', '0'),
(78, 'Gambia', '1', '0'),
(79, 'Georgia', '1', '0'),
(80, 'Germany', '1', '0'),
(81, 'Ghana', '1', '0'),
(82, 'Gibraltar', '1', '0'),
(83, 'Greece', '1', '0'),
(84, 'Greenland', '1', '0'),
(85, 'Grenada', '1', '0'),
(86, 'Guadeloupe', '1', '0'),
(87, 'Guam', '1', '0'),
(88, 'Guatemala', '1', '0'),
(89, 'Guinea', '1', '0'),
(90, 'Guinea-Bissau', '1', '0'),
(91, 'Guyana', '1', '0'),
(92, 'Haiti', '1', '0'),
(93, 'Heard Island and McDonald Islands', '1', '0'),
(94, 'Honduras', '1', '0'),
(95, 'Hong Kong', '1', '0'),
(96, 'Hungary', '1', '0'),
(97, 'Iceland', '1', '0'),
(98, 'India', '1', '0'),
(99, 'Indonesia', '1', '0'),
(100, 'Iran', '1', '0'),
(101, 'Iraq', '1', '0'),
(102, 'Ireland', '1', '0'),
(103, 'Israel', '1', '0'),
(104, 'Italy', '1', '0'),
(105, 'Ivory Coast', '1', '0'),
(106, 'Jamaica', '1', '0'),
(107, 'Japan', '1', '0'),
(108, 'Jordan', '1', '0'),
(109, 'Kazakhstan', '1', '0'),
(110, 'Kenya', '1', '0'),
(111, 'Kiribati', '1', '0'),
(112, 'Kuwait', '1', '0'),
(113, 'Kyrgyzstan', '1', '0'),
(114, 'Laos', '1', '0'),
(115, 'Latvia', '1', '0'),
(116, 'Lebanon', '1', '0'),
(117, 'Lesotho', '1', '0'),
(118, 'Liberia', '1', '0'),
(119, 'Libya', '1', '0'),
(120, 'Liechtenstein', '1', '0'),
(121, 'Lithuania', '1', '0'),
(122, 'Luxembourg', '1', '0'),
(123, 'Macao', '1', '0'),
(124, 'Macedonia', '1', '0'),
(125, 'Madagascar', '1', '0'),
(126, 'Malawi', '1', '0'),
(127, 'Malaysia', '1', '0'),
(128, 'Maldives', '1', '0'),
(129, 'Mali', '1', '0'),
(130, 'Malta', '1', '0'),
(131, 'Marshall Islands', '1', '0'),
(132, 'Martinique', '1', '0'),
(133, 'Mauritania', '1', '0'),
(134, 'Mauritius', '1', '0'),
(135, 'Mayotte', '1', '0'),
(136, 'Mexico', '1', '0'),
(137, 'Micronesia', '1', '0'),
(138, 'Moldova', '1', '0'),
(139, 'Monaco', '1', '0'),
(140, 'Mongolia', '1', '0'),
(141, 'Montserrat', '1', '0'),
(142, 'Morocco', '1', '0'),
(143, 'Mozambique', '1', '0'),
(144, 'Myanmar', '1', '0'),
(145, 'Namibia', '1', '0'),
(146, 'Nauru', '1', '0'),
(147, 'Nepal', '1', '0'),
(148, 'Netherlands', '1', '0'),
(149, 'Netherlands Antilles', '1', '0'),
(150, 'New Caledonia', '1', '0'),
(151, 'New Zealand', '1', '0'),
(152, 'Nicaragua', '1', '0'),
(153, 'Niger', '1', '0'),
(154, 'Nigeria', '1', '0'),
(155, 'Niue', '1', '0'),
(156, 'Norfolk Island', '1', '0'),
(157, 'North Korea', '1', '0'),
(158, 'Northern Mariana Islands', '1', '0'),
(159, 'Norway', '1', '0'),
(160, 'Oman', '1', '0'),
(161, 'Pakistan', '1', '0'),
(162, 'Palau', '1', '0'),
(163, 'Palestinian Territory', '1', '0'),
(164, 'Panama', '1', '0'),
(165, 'Papua New Guinea', '1', '0'),
(166, 'Paraguay', '1', '0'),
(167, 'Peru', '1', '0'),
(168, 'Philippines', '1', '0'),
(169, 'Pitcairn', '1', '0'),
(170, 'Poland', '1', '0'),
(171, 'Portugal', '1', '0'),
(172, 'Puerto Rico', '1', '0'),
(173, 'Qatar', '1', '0'),
(174, 'Republic of the Congo', '1', '0'),
(175, 'Reunion', '1', '0'),
(176, 'Romania', '1', '0'),
(177, 'Russia', '1', '0'),
(178, 'Rwanda', '1', '0'),
(179, 'Saint Helena', '1', '0'),
(180, 'Saint Kitts and Nevis', '1', '0'),
(181, 'Saint Lucia', '1', '0'),
(182, 'Saint Pierre and Miquelon', '1', '0'),
(183, 'Saint Vincent and the Grenadines', '1', '0'),
(184, 'Samoa', '1', '0'),
(185, 'San Marino', '1', '0'),
(186, 'Sao Tome and Principe', '1', '0'),
(187, 'Saudi Arabia', '1', '0'),
(188, 'Senegal', '1', '0'),
(189, 'Serbia and Montenegro', '1', '0'),
(190, 'Seychelles', '1', '0'),
(191, 'Sierra Leone', '1', '0'),
(192, 'Singapore', '1', '0'),
(193, 'Slovakia', '1', '0'),
(194, 'Slovenia', '1', '0'),
(195, 'Solomon Islands', '1', '0'),
(196, 'Somalia', '1', '0'),
(197, 'South Africa', '1', '0'),
(198, 'South Georgia and the South Sandwich Islands', '1', '0'),
(199, 'South Korea', '1', '0'),
(200, 'Spain', '1', '0'),
(201, 'Sri Lanka', '1', '0'),
(202, 'Sudan', '1', '0'),
(203, 'Suriname', '1', '0'),
(204, 'Svalbard and Jan Mayen', '1', '0'),
(205, 'Swaziland', '1', '0'),
(206, 'Sweden', '1', '0'),
(207, 'Switzerland', '1', '0'),
(208, 'Syria', '1', '0'),
(209, 'Taiwan', '1', '0'),
(210, 'Tajikistan', '1', '0'),
(211, 'Tanzania', '1', '0'),
(212, 'Thailand', '1', '0'),
(213, 'Togo', '1', '0'),
(214, 'Tokelau', '1', '0'),
(215, 'Tonga', '1', '0'),
(216, 'Trinidad and Tobago', '1', '0'),
(217, 'Tunisia', '1', '0'),
(218, 'Turkey', '1', '0'),
(219, 'Turkmenistan', '1', '0'),
(220, 'Turks and Caicos Islands', '1', '0'),
(221, 'Tuvalu', '1', '0'),
(222, 'U.S. Virgin Islands', '1', '0'),
(223, 'Uganda', '1', '0'),
(224, 'Ukraine', '1', '0'),
(225, 'United Arab Emirates', '1', '0'),
(226, 'United Kingdom', '1', '0'),
(227, 'Unites States Of America', '1', '0'),
(228, 'United States Minor Outlying Islands', '1', '0'),
(229, 'Uruguay', '1', '0'),
(230, 'Uzbekistan', '1', '0'),
(231, 'Vanuatu', '1', '0'),
(232, 'Vatican', '1', '0'),
(233, 'Venezuela', '1', '0'),
(234, 'Vietnam', '1', '0'),
(235, 'Wallis and Futuna', '1', '0'),
(236, 'Western Sahara', '1', '0'),
(237, 'Yemen', '1', '0'),
(238, 'Zambia', '1', '0'),
(239, 'Zimbabwe', '1', '0'),
(240, 'Unknown', '1', '0'),
(242, 'xxX', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE IF NOT EXISTS `tbl_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `title`, `created_by`, `created_date_time`, `updated_date_time`, `is_active`, `is_deleted`) VALUES
(1, 'Course 1', 1, '2015-11-11 08:59:24', '2015-11-11 16:54:34', '1', '1'),
(2, 'Course 2', 1, '2015-11-11 08:59:24', '2015-11-11 17:15:38', '1', '0'),
(3, 'Course 3', 1, '2015-11-11 08:59:24', '2015-11-11 08:59:35', '1', '0'),
(4, 'Course 4', 1, '2015-11-11 08:59:24', '2015-11-11 08:59:35', '1', '0'),
(5, 'Course 5', 1, '2015-11-11 17:18:07', '2015-11-11 17:17:43', '1', '0'),
(6, 'Course 6', 1, '2015-11-11 17:18:23', '2015-11-11 17:17:59', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE IF NOT EXISTS `tbl_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('1','2') NOT NULL COMMENT '1- Male, 2- Female',
  `telephone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nationality` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `name`, `dob`, `gender`, `telephone`, `email`, `nationality`, `city`, `image`, `created_by`, `created_date_time`, `updated_date_time`, `is_active`, `is_deleted`) VALUES
(1, 'Anas1', '2015-11-11', '1', 99999999, 'anas.muhammed@gmail.com', 225, 10, '20151110222803_image_.jpg', 0, '2015-11-10 21:56:07', '2015-11-11 09:25:03', '1', '0'),
(2, 'Ansar', '2015-11-11', '1', 99999999, 'anas.muhammed@gmail.com', 225, 10, '20151110222819_image_.jpg', 0, '2015-11-10 21:56:27', '2015-11-10 22:27:55', '1', '0'),
(3, 'Sanilal', '2015-11-11', '1', 99999999, 'anas.muhammed@gmail.com', 225, 10, '20151110215635_image_.jpg', 0, '2015-11-10 21:56:35', '2015-11-10 21:56:11', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_course_map`
--

CREATE TABLE IF NOT EXISTS `tbl_student_course_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_student_course_map`
--

INSERT INTO `tbl_student_course_map` (`id`, `student_id`, `course_id`, `created_by`, `created_date_time`, `updated_date_time`, `is_active`, `is_deleted`) VALUES
(1, 1, 1, 1, '2015-11-11 09:33:05', '2015-11-11 09:33:40', '1', '0'),
(2, 1, 2, 1, '2015-11-11 09:33:05', '2015-11-11 09:33:40', '1', '0'),
(3, 2, 3, 1, '2015-11-11 09:34:39', '2015-11-11 09:34:15', '1', '0'),
(4, 2, 4, 1, '2015-11-11 09:34:39', '2015-11-11 09:34:15', '1', '0'),
(5, 3, 4, 1, '2015-11-11 09:34:44', '2015-11-11 09:34:20', '1', '0'),
(6, 3, 1, 1, '2015-11-11 09:34:52', '2015-11-11 09:34:28', '1', '0'),
(7, 3, 2, 1, '2015-11-11 09:34:52', '2015-11-11 09:34:28', '1', '0'),
(8, 3, 3, 1, '2015-11-11 09:34:52', '2015-11-11 09:34:28', '1', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
