-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2020 at 10:52 AM
-- Server version: 10.3.23-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codtufbi_ojarh`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountdetails`
--

CREATE TABLE `accountdetails` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `accountname` text NOT NULL,
  `accountnumber` text NOT NULL,
  `bankname` text NOT NULL,
  `accounttype` text NOT NULL,
  `status` text NOT NULL,
  `create_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountdetails`
--

INSERT INTO `accountdetails` (`id`, `userid`, `accountname`, `accountnumber`, `bankname`, `accounttype`, `status`, `create_on`) VALUES
(1, '967815', 'Josimar Akpomudia', '3330000408', 'ecobank', 'Current', 'Active', '2020-02-24 17:57:10'),
(2, '825974', 'james', '123456789', 'chase', 'savings', 'Active', '2020-03-25 19:28:04'),
(3, '889140', 'John Doe', '00123141', 'diamond', 'Current', 'Active', '2020-04-02 15:26:44'),
(4, '20200513110550', 'Elijah okokon', '1232323', 'access', 'Current', 'Active', '2020-05-17 07:53:00'),
(5, '20200513100557', 'test', '11111', 'access', 'Current', 'Active', '2020-05-19 09:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `account_info`
--

CREATE TABLE `account_info` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `account_type` text NOT NULL,
  `durate` text DEFAULT NULL,
  `startDate` text DEFAULT NULL,
  `endDate` text DEFAULT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_info`
--

INSERT INTO `account_info` (`id`, `userid`, `account_type`, `durate`, `startDate`, `endDate`, `dated`) VALUES
(1, '967815', 'Premium', '1', '2020-03-06', '2020-04-05', '2020-02-24 17:32:54'),
(16, '536361', 'Buyer', NULL, NULL, NULL, '2020-03-26 09:22:18'),
(14, '825974', 'Premium', '1', '2020-03-24', '2020-04-23', '2020-03-24 16:23:38'),
(17, '889140', 'Premium', '12', '2020-04-13', '2021-04-13', '2020-03-27 12:51:10'),
(20, '20200423010418', 'Starter', NULL, NULL, NULL, '2020-04-23 12:02:18'),
(21, '20200423010437', 'Starter', NULL, NULL, NULL, '2020-04-23 12:11:37'),
(22, '20200423010446', 'Premium', '12', '2020-04-23', '2021-04-23', '2020-04-23 12:44:47'),
(23, '20200428120412', 'Starter', NULL, NULL, NULL, '2020-04-27 23:22:13'),
(24, '20200511050557', 'Starter', NULL, NULL, NULL, '2020-05-11 16:40:57'),
(25, '20200511050555', 'Starter', NULL, NULL, NULL, '2020-05-11 16:49:56'),
(26, '20200511050501', 'Buyer', NULL, NULL, NULL, '2020-05-11 16:52:01'),
(27, '20200511050535', 'Starter', NULL, NULL, NULL, '2020-05-11 16:53:35'),
(28, '20200511050502', 'Starter', NULL, NULL, NULL, '2020-05-11 16:59:02'),
(29, '20200513020551', 'Premium', '6', '2020-05-16', '2020-11-12', '2020-05-13 01:03:52'),
(30, '20200513100557', 'Premium', '12', '2020-05-19', '2021-05-19', '2020-05-13 09:06:09'),
(31, '20200513110550', 'Premium', '12', '2020-05-13', '2021-05-13', '2020-05-13 10:12:52'),
(32, '20200526060528', 'Buyer', NULL, NULL, NULL, '2020-05-26 17:31:28'),
(33, '20200530030551', 'Buyer', NULL, NULL, NULL, '2020-05-30 14:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `ad`
--

CREATE TABLE `ad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `ads_location` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `end_date` datetime DEFAULT current_timestamp(),
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad`
--

INSERT INTO `ad` (`id`, `userid`, `link`, `ads_location`, `img`, `status`, `end_date`, `created`, `updated`) VALUES
(2, 889140, 'facebook.com', 'Body', '169489-01.jpg', 1, '2020-04-27 00:00:00', '2020-04-13 12:23:27', '2020-05-11 14:25:32'),
(3, 967815, 'contact.php', 'Body', '577688-IMG_20191212_073721.jpg', 1, '2020-05-21 00:00:00', '2020-04-21 10:25:29', '2020-05-11 14:25:27'),
(4, 536361, 'index.php', 'Body', '348097-390.jpg', 1, '2020-05-13 00:00:00', '2020-04-29 19:46:05', '2020-05-11 14:25:22'),
(5, 1111, 'klkjsdklsakdjl', 'sidebar', '145329-partners.jpg', 1, '2020-06-10 00:00:00', '2020-05-11 14:24:47', NULL),
(8, 20200513110550, 'this is new ', 'body', '237160-4.jpeg', 0, '2020-05-31 00:00:00', '2020-05-24 20:39:59', NULL),
(9, 967815, 'https://dmatrix.me', 'top', '998423-728x90.png', 0, '2020-06-02 00:00:00', '2020-05-26 12:35:44', NULL),
(10, 20200513020551, 'sqtwebsolutions.com', 'body', '869791-logo_120x@3x.png', 0, '2020-06-14 00:00:00', '2020-05-30 19:32:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `agentid` text NOT NULL,
  `agentfname` text NOT NULL,
  `agentlname` text NOT NULL,
  `agentphone` text NOT NULL,
  `agentemail` text NOT NULL,
  `agentaddress` text NOT NULL,
  `agentstate` text NOT NULL,
  `agentcountry` text NOT NULL,
  `agentstatus` text NOT NULL,
  `agentfile_name` text NOT NULL,
  `agentpic_name` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `agentid`, `agentfname`, `agentlname`, `agentphone`, `agentemail`, `agentaddress`, `agentstate`, `agentcountry`, `agentstatus`, `agentfile_name`, `agentpic_name`, `created_at`) VALUES
(1, '32961679', 'Sandra', 'Akpomudia', '08048485858', 'renownjosimar@gmail.com', 'abuja', 'abuja', 'Nigeria', 'Activate', '32961679-EMMANUEL OVOME ACCOUNT STATEMENT.xlsx', '23764862-390.jpg', '2020-02-28 12:12:54'),
(2, '49981658', 'Dafe ', 'George', '2938993939', 'dafegeorge19@gmail.com', 'Maitama', 'Abuja', 'Nigeria', 'Activate', '49981658-COURSE OUTLINES FOR WEB DESIGNING.docx', '49981658-18_270x270_crop_center.webp', '2020-03-06 13:41:54'),
(3, '85402031', 'Peter', 'Donnelly', '08123123', 'peterdonnelly@email.com', 'Some Where', 'FCT', 'Nigeria', 'Activate', '85402031-4_446623c8-2b13-4ce1-8e53-b29267baf3bb_270x.webp', '85402031-4_446623c8-2b13-4ce1-8e53-b29267baf3bb_500x500_crop_center.jpg', '2020-04-03 11:49:57'),
(4, '18653047', 'agent', 'gea', '112456', 'u@gmail.com', 'cv dfbnm', 'zss', 'Nigeria', 'Inactive', '18653047-afang-soup.jpg', '18653047-afang-soup.jpg', '2020-05-27 00:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `apps_countries`
--

CREATE TABLE `apps_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apps_countries`
--

INSERT INTO `apps_countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CD', 'Democratic Republic of the Congo'),
(50, 'CG', 'Republic of Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GK', 'Guernsey'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-Bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard and Mc Donald Islands'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'IM', 'Isle of Man'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran (Islamic Republic of)'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'CI', 'Ivory Coast'),
(109, 'JE', 'Jersey'),
(110, 'JM', 'Jamaica'),
(111, 'JP', 'Japan'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea, Democratic People\'s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Lao People\'s Democratic Republic'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libyan Arab Jamahiriya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macau'),
(131, 'MK', 'North Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'TY', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia, Federated States of'),
(145, 'MD', 'Moldova, Republic of'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestine'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'VC', 'Saint Vincent and the Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'SB', 'Solomon Islands'),
(200, 'SO', 'Somalia'),
(201, 'ZA', 'South Africa'),
(202, 'GS', 'South Georgia South Sandwich Islands'),
(203, 'SS', 'South Sudan'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SH', 'St. Helena'),
(207, 'PM', 'St. Pierre and Miquelon'),
(208, 'SD', 'Sudan'),
(209, 'SR', 'Suriname'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands'),
(211, 'SZ', 'Swaziland'),
(212, 'SE', 'Sweden'),
(213, 'CH', 'Switzerland'),
(214, 'SY', 'Syrian Arab Republic'),
(215, 'TW', 'Taiwan'),
(216, 'TJ', 'Tajikistan'),
(217, 'TZ', 'Tanzania, United Republic of'),
(218, 'TH', 'Thailand'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States minor outlying islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VA', 'Vatican City State'),
(238, 'VE', 'Venezuela'),
(239, 'VN', 'Vietnam'),
(240, 'VG', 'Virgin Islands (British)'),
(241, 'VI', 'Virgin Islands (U.S.)'),
(242, 'WF', 'Wallis and Futuna Islands'),
(243, 'EH', 'Western Sahara'),
(244, 'YE', 'Yemen'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `title`, `img`, `created`) VALUES
(4, 'envato', '984183-br-2_170x100.png', '2020-03-30 23:11:14'),
(5, 'SoundWave', '416886-br-5_170x100.png', '2020-03-30 23:11:39'),
(6, 'Brand', '151025-br-4_170x100.png', '2020-03-30 23:15:52'),
(7, 'Amazon', '189910-l3.png', '2020-05-21 11:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `bizname` text NOT NULL,
  `bizphone` text NOT NULL,
  `bizemail` text NOT NULL,
  `bizstate` text NOT NULL,
  `bizmarket` text NOT NULL,
  `privacy` varchar(45) DEFAULT 'public',
  `bizaddress` text NOT NULL,
  `bizwebsite` text NOT NULL,
  `service` varchar(45) DEFAULT NULL,
  `bizregdate` text NOT NULL,
  `returnpolicy` text DEFAULT NULL,
  `disclaimer` text DEFAULT NULL,
  `timedelivery` text DEFAULT NULL,
  `cardsettings` text DEFAULT NULL,
  `storeimage` text DEFAULT NULL,
  `videolink` text DEFAULT NULL,
  `status` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `userid`, `bizname`, `bizphone`, `bizemail`, `bizstate`, `bizmarket`, `privacy`, `bizaddress`, `bizwebsite`, `service`, `bizregdate`, `returnpolicy`, `disclaimer`, `timedelivery`, `cardsettings`, `storeimage`, `videolink`, `status`, `created_date`) VALUES
(1, '967815', 'Fairmountains Inc.', '08048584848', 'info@fairmountains.com', '[\"Abuja\",\"Lagos\"]', '[\"\",\"\",\"131294\",\"985258\"]', 'private', 'Abuja', 'www.fairmountains.com', 'Testing my work', '02/06/2020', 'this is my Terms and conditions of return policy', 'This is my disclaimer', 'This is my time and delivery.\n\nOk', '1', '{\"picture0\":\"967815-207439ads3.png\",\"picture1\":\"967815-639598images - 2020-04-08T041131.093.jpeg\",\"picture2\":\"967815-635845b3.jpg\",\"picture3\":\"967815-312027g1.jpeg\",\"picture4\":\"\"}', NULL, 'Updateable', '2020-02-24 17:38:36'),
(2, '825974', 'lakjfk', '38383888', 'info@asokd.com', 'skafjs', 'Antarctica', 'public', 'lkfjaslf kals fl ', 'www.google.com', NULL, '03/28/2020', NULL, NULL, NULL, '1', NULL, NULL, 'Updateable', '2020-03-25 20:54:48'),
(3, '889140', 'Tech Start', '08123123123', 'info@techstar@.com', '[\"Abuja\"]', '[\"131294\",\"985258\",\"323474\"]', 'public', 'Mu House', 'techstar.com', NULL, '03/03/2020', 'No Return Policy', 'No DIsclaimer', NULL, '1', NULL, NULL, 'Updateable', '2020-04-02 16:02:58'),
(4, '20200423010446', 'Abbey Inc.', '090383838', 'info@abbeyinc.com', '[\"Abuja\",\"Lagos\"]', '[\"131294\",\"985258\"]', 'public', 'Wuse 2, Abuja', 'www.abbeyinc.com', NULL, '04/21/2020', NULL, NULL, NULL, '1', NULL, NULL, 'Updateable', '2020-04-23 16:15:59'),
(5, '20200513110550', 'Dmatrixnews', '090000000', 'okoelijah@gmail.com', '[\"Katsina\"]', '[\"454373\"]', 'private', 'Plot 2, house 39, Owode Estate Extension, Apata,', 'Dmatrixng.com', NULL, '05/12/2020', 'this is my Terms and conditions of return policy2', 'test', 'test time/ delivery', '1', '{\"picture0\":\"20200513110550-410756ads3.png\",\"picture1\":\"20200513110550-82091ads1.jpg\",\"picture2\":\"20200513110550-406945d.jpg\",\"picture3\":\"20200513110550-805989i.jpg\",\"picture4\":\"\"}', 'https://www.youtube.com/embed/SfjSy6T4iE4', 'Updateable', '2020-05-23 14:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `business_access`
--

CREATE TABLE `business_access` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `business_id` bigint(20) NOT NULL,
  `access` varchar(45) NOT NULL DEFAULT 'pending',
  `date` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `catid` text NOT NULL,
  `catname` text NOT NULL,
  `catdescription` text DEFAULT NULL,
  `catImage` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catid`, `catname`, `catdescription`, `catImage`, `created_at`) VALUES
(1, '229936', 'Automobile and Spare Parts', 'This contain the sales of automobile and its spare parts', '544753-4_446623c8-2b13-4ce1-8e53-b29267baf3bb_500x500_crop_center.jpg', '2020-02-24 17:10:18'),
(2, '193357', 'Electrical Appliances', 'This contain the sales of home and outdoor appliances', '544753-4_446623c8-2b13-4ce1-8e53-b29267baf3bb_500x500_crop_center.jpg', '2020-02-24 17:10:55'),
(3, '544753', 'Fashion and Jewery', 'Men, women, children fashion', '-partners.jpg', '2020-03-03 15:17:45'),
(11, '358307', 'test', 'test', '358307-twitter-logo.PNG', '2020-05-26 19:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(45) DEFAULT 'pending',
  `date` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disputeresponse`
--

CREATE TABLE `disputeresponse` (
  `id` int(11) NOT NULL,
  `disputeid` text NOT NULL,
  `senderid` text NOT NULL,
  `againstid` text NOT NULL,
  `messageby` text NOT NULL,
  `responsemessage` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disputeresponse`
--

INSERT INTO `disputeresponse` (`id`, `disputeid`, `senderid`, `againstid`, `messageby`, `responsemessage`, `created_at`) VALUES
(1, '171441', '1111', '20200428120412', '1111', 'just to check if its working ', '2020-05-11 13:31:43'),
(2, '171441', '1111', '20200428120412', '1111', 'check', '2020-05-11 13:33:00'),
(3, '171441', '1111', '20200428120412', '1111', 'nice', '2020-05-15 07:57:11'),
(4, '331402', '1111', '967815', '1111', 'hey from admin', '2020-05-15 08:02:28'),
(5, '331402', '1111', '967815', '1111', 'waht uo', '2020-05-15 08:05:19'),
(6, '331402', '1111', '967815', '1111', 'gea', '2020-05-15 08:06:25'),
(7, '331402', '1111', '967815', '1111', 'must work', '2020-05-15 08:08:29'),
(8, '331402', '1111', '967815', '1111', 'hey', '2020-05-15 08:28:32'),
(9, '331402', '1111', '967815', '1111', 'ok', '2020-05-15 08:31:26'),
(10, '283056', '1111', '889140', '1111', 'cull', '2020-05-15 09:02:40'),
(11, '331402', '967815', '967815', '967815', 'Sorry', '2020-05-30 23:56:13'),
(12, '331402', '967815', '967815', '967815', 'Sorry', '2020-05-30 23:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `disputetbl`
--

CREATE TABLE `disputetbl` (
  `id` int(11) NOT NULL,
  `disputeid` text NOT NULL,
  `senderid` text NOT NULL,
  `againstid` text NOT NULL,
  `subject` text NOT NULL,
  `priority` text NOT NULL,
  `details_priority` text NOT NULL,
  `file_name` text DEFAULT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disputetbl`
--

INSERT INTO `disputetbl` (`id`, `disputeid`, `senderid`, `againstid`, `subject`, `priority`, `details_priority`, `file_name`, `status`, `created_at`) VALUES
(1, '331402', '536361', '967815', 'Failed Payment', 'High', 'asdjklfj', '', 'In Progress', '2020-04-29 16:28:02'),
(2, '283056', '536361', '889140', 'Refund', 'Medium', 'This is to check if this is working or not.', '283056-IMG_20190629_165200.jpg', 'In Progress', '2020-04-29 18:06:14'),
(3, '500057', '967815', '536361', 'Failed Payment', 'High', 'Failure to make payment', '', 'Pending', '2020-04-29 18:11:55'),
(4, '588243', '967815', '825974', 'Failed Payment', 'Medium', 'kdkdk', '588243-IMG_20191212_073721.jpg', 'Pending', '2020-04-29 18:16:22'),
(5, '978856', '825974', '20200428120412', 'Service Failure', 'High', 'askdfjka', '978856-IMG_20191212_073721.jpg', 'Pending', '2020-05-04 15:37:45'),
(6, '171441', '825974', '20200428120412', 'Service Failure', 'High', 'kjlkjj', '171441-TombRaider.log', 'In Progress', '2020-05-04 15:39:52'),
(7, '555512', '20200513020551', '20200513020551', 'Service Failure', 'Low', 'hey', '', 'Pending', '2020-05-13 03:30:05'),
(8, '375309', '20200513020551', '20200513100557', 'Refund', 'High', 'i need my money', '', 'Pending', '2020-05-23 17:36:04'),
(9, '785924', '20200513020551', '', 'Refund', 'Medium', 'jgghjn', '785924-afang-soup.jpg', 'Pending', '2020-05-27 00:40:33'),
(10, '964248', '20200513020551', '20200513020551', 'Refund', 'Medium', 'test', '964248-b.jpg', 'Pending', '2020-05-27 19:37:32'),
(11, '613732', '20200513020551', '', 'Failed Payment', 'Medium', 'hhh', '', 'Pending', '2020-05-27 19:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `productid` text NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id`, `userid`, `productid`, `added_date`) VALUES
(8, '536361', '330596', '2020-04-29 19:16:00'),
(11, '20200513020551', '571663', '2020-05-27 16:54:41'),
(13, '20200513020551', '979079', '2020-05-30 16:08:29'),
(14, '20200513020551', '330596', '2020-05-30 23:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `local_governments`
--

CREATE TABLE `local_governments` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='Local governments in Nigeria.';

--
-- Dumping data for table `local_governments`
--

INSERT INTO `local_governments` (`id`, `state_id`, `name`) VALUES
(1, 1, 'Aba North'),
(2, 1, 'Aba South'),
(3, 1, 'Arochukwu'),
(4, 1, 'Bende'),
(5, 1, 'Ikwuano'),
(6, 1, 'Isiala Ngwa North'),
(7, 1, 'Isiala Ngwa South'),
(8, 1, 'Isuikwuato'),
(9, 1, 'Obi Ngwa'),
(10, 1, 'Ohafia'),
(11, 1, 'Osisioma'),
(12, 1, 'Ugwunagbo'),
(13, 1, 'Ukwa East'),
(14, 1, 'Ukwa West'),
(15, 1, 'Umuahia North'),
(16, 1, 'Umuahia South'),
(17, 1, 'Umu Nneochi'),
(18, 2, 'Demsa'),
(19, 2, 'Fufure'),
(20, 2, 'Ganye'),
(21, 2, 'Gayuk'),
(22, 2, 'Gombi'),
(23, 2, 'Grie'),
(24, 2, 'Hong'),
(25, 2, 'Jada'),
(26, 2, 'Larmurde'),
(27, 2, 'Madagali'),
(28, 2, 'Maiha'),
(29, 2, 'Mayo Belwa'),
(30, 2, 'Michika'),
(31, 2, 'Mubi North'),
(32, 2, 'Mubi South'),
(33, 2, 'Numan'),
(34, 2, 'Shelleng'),
(35, 2, 'Song'),
(36, 2, 'Toungo'),
(37, 2, 'Yola North'),
(38, 2, 'Yola South'),
(39, 3, 'Abak'),
(40, 3, 'Eastern Obolo'),
(41, 3, 'Eket'),
(42, 3, 'Esit Eket'),
(43, 3, 'Essien Udim'),
(44, 3, 'Etim Ekpo'),
(45, 3, 'Etinan'),
(46, 3, 'Ibeno'),
(47, 3, 'Ibesikpo Asutan'),
(48, 3, 'Ibiono-Ibom'),
(49, 3, 'Ika'),
(50, 3, 'Ikono'),
(51, 3, 'Ikot Abasi'),
(52, 3, 'Ikot Ekpene'),
(53, 3, 'Ini'),
(54, 3, 'Itu'),
(55, 3, 'Mbo'),
(56, 3, 'Mkpat-Enin'),
(57, 3, 'Nsit-Atai'),
(58, 3, 'Nsit-Ibom'),
(59, 3, 'Nsit-Ubium'),
(60, 3, 'Obot Akara'),
(61, 3, 'Okobo'),
(62, 3, 'Onna'),
(63, 3, 'Oron'),
(64, 3, 'Oruk Anam'),
(65, 3, 'Udung-Uko'),
(66, 3, 'Ukanafun'),
(67, 3, 'Uruan'),
(68, 3, 'Urue-Offong/Oruko'),
(69, 3, 'Uyo'),
(70, 4, 'Aguata'),
(71, 4, 'Anambra East'),
(72, 4, 'Anambra West'),
(73, 4, 'Anaocha'),
(74, 4, 'Awka North'),
(75, 4, 'Awka South'),
(76, 4, 'Ayamelum'),
(77, 4, 'Dunukofia'),
(78, 4, 'Ekwusigo'),
(79, 4, 'Idemili North'),
(80, 4, 'Idemili South'),
(81, 4, 'Ihiala'),
(82, 4, 'Njikoka'),
(83, 4, 'Nnewi North'),
(84, 4, 'Nnewi South'),
(85, 4, 'Ogbaru'),
(86, 4, 'Onitsha North'),
(87, 4, 'Onitsha South'),
(88, 4, 'Orumba North'),
(89, 4, 'Orumba South'),
(90, 4, 'Oyi'),
(91, 5, 'Alkaleri'),
(92, 5, 'Bauchi'),
(93, 5, 'Bogoro'),
(94, 5, 'Damban'),
(95, 5, 'Darazo'),
(96, 5, 'Dass'),
(97, 5, 'Gamawa'),
(98, 5, 'Ganjuwa'),
(99, 5, 'Giade'),
(100, 5, 'Itas/Gadau'),
(101, 5, 'Jama\'are'),
(102, 5, 'Katagum'),
(103, 5, 'Kirfi'),
(104, 5, 'Misau'),
(105, 5, 'Ningi'),
(106, 5, 'Shira'),
(107, 5, 'Tafawa Balewa'),
(108, 5, 'Toro'),
(109, 5, 'Warji'),
(110, 5, 'Zaki'),
(111, 6, 'Brass'),
(112, 6, 'Ekeremor'),
(113, 6, 'Kolokuma/Opokuma'),
(114, 6, 'Nembe'),
(115, 6, 'Ogbia'),
(116, 6, 'Sagbama'),
(117, 6, 'Southern Ijaw'),
(118, 6, 'Yenagoa'),
(119, 7, 'Agatu'),
(120, 7, 'Apa'),
(121, 7, 'Ado'),
(122, 7, 'Buruku'),
(123, 7, 'Gboko'),
(124, 7, 'Guma'),
(125, 7, 'Gwer East'),
(126, 7, 'Gwer West'),
(127, 7, 'Katsina-Ala'),
(128, 7, 'Konshisha'),
(129, 7, 'Kwande'),
(130, 7, 'Logo'),
(131, 7, 'Makurdi'),
(132, 7, 'Obi'),
(133, 7, 'Ogbadibo'),
(134, 7, 'Ohimini'),
(135, 7, 'Oju'),
(136, 7, 'Okpokwu'),
(137, 7, 'Oturkpo'),
(138, 7, 'Tarka'),
(139, 7, 'Ukum'),
(140, 7, 'Ushongo'),
(141, 7, 'Vandeikya'),
(142, 8, 'Abadam'),
(143, 8, 'Askira/Uba'),
(144, 8, 'Bama'),
(145, 8, 'Bayo'),
(146, 8, 'Biu'),
(147, 8, 'Chibok'),
(148, 8, 'Damboa'),
(149, 8, 'Dikwa'),
(150, 8, 'Gubio'),
(151, 8, 'Guzamala'),
(152, 8, 'Gwoza'),
(153, 8, 'Hawul'),
(154, 8, 'Jere'),
(155, 8, 'Kaga'),
(156, 8, 'Kala/Balge'),
(157, 8, 'Konduga'),
(158, 8, 'Kukawa'),
(159, 8, 'Kwaya Kusar'),
(160, 8, 'Mafa'),
(161, 8, 'Magumeri'),
(162, 8, 'Maiduguri'),
(163, 8, 'Marte'),
(164, 8, 'Mobbar'),
(165, 8, 'Monguno'),
(166, 8, 'Ngala'),
(167, 8, 'Nganzai'),
(168, 8, 'Shani'),
(169, 9, 'Abi'),
(170, 9, 'Akamkpa'),
(171, 9, 'Akpabuyo'),
(172, 9, 'Bakassi'),
(173, 9, 'Bekwarra'),
(174, 9, 'Biase'),
(175, 9, 'Boki'),
(176, 9, 'Calabar Municipal'),
(177, 9, 'Calabar South'),
(178, 9, 'Etung'),
(179, 9, 'Ikom'),
(180, 9, 'Obanliku'),
(181, 9, 'Obubra'),
(182, 9, 'Obudu'),
(183, 9, 'Odukpani'),
(184, 9, 'Ogoja'),
(185, 9, 'Yakuur'),
(186, 9, 'Yala'),
(187, 10, 'Aniocha North'),
(188, 10, 'Aniocha South'),
(189, 10, 'Bomadi'),
(190, 10, 'Burutu'),
(191, 10, 'Ethiope East'),
(192, 10, 'Ethiope West'),
(193, 10, 'Ika North East'),
(194, 10, 'Ika South'),
(195, 10, 'Isoko North'),
(196, 10, 'Isoko South'),
(197, 10, 'Ndokwa East'),
(198, 10, 'Ndokwa West'),
(199, 10, 'Okpe'),
(200, 10, 'Oshimili North'),
(201, 10, 'Oshimili South'),
(202, 10, 'Patani'),
(203, 10, 'Sapele, Delta'),
(204, 10, 'Udu'),
(205, 10, 'Ughelli North'),
(206, 10, 'Ughelli South'),
(207, 10, 'Ukwuani'),
(208, 10, 'Uvwie'),
(209, 10, 'Warri North'),
(210, 10, 'Warri South'),
(211, 10, 'Warri South West'),
(212, 11, 'Abakaliki'),
(213, 11, 'Afikpo North'),
(214, 11, 'Afikpo South'),
(215, 11, 'Ebonyi'),
(216, 11, 'Ezza North'),
(217, 11, 'Ezza South'),
(218, 11, 'Ikwo'),
(219, 11, 'Ishielu'),
(220, 11, 'Ivo'),
(221, 11, 'Izzi'),
(222, 11, 'Ohaozara'),
(223, 11, 'Ohaukwu'),
(224, 11, 'Onicha'),
(225, 12, 'Akoko-Edo'),
(226, 12, 'Egor'),
(227, 12, 'Esan Central'),
(228, 12, 'Esan North-East'),
(229, 12, 'Esan South-East'),
(230, 12, 'Esan West'),
(231, 12, 'Etsako Central'),
(232, 12, 'Etsako East'),
(233, 12, 'Etsako West'),
(234, 12, 'Igueben'),
(235, 12, 'Ikpoba Okha'),
(236, 12, 'Orhionmwon'),
(237, 12, 'Oredo'),
(238, 12, 'Ovia North-East'),
(239, 12, 'Ovia South-West'),
(240, 12, 'Owan East'),
(241, 12, 'Owan West'),
(242, 12, 'Uhunmwonde'),
(243, 13, 'Ado Ekiti'),
(244, 13, 'Efon'),
(245, 13, 'Ekiti East'),
(246, 13, 'Ekiti South-West'),
(247, 13, 'Ekiti West'),
(248, 13, 'Emure'),
(249, 13, 'Gbonyin'),
(250, 13, 'Ido Osi'),
(251, 13, 'Ijero'),
(252, 13, 'Ikere'),
(253, 13, 'Ikole'),
(254, 13, 'Ilejemeje'),
(255, 13, 'Irepodun/Ifelodun'),
(256, 13, 'Ise/Orun'),
(257, 13, 'Moba'),
(258, 13, 'Oye'),
(259, 14, 'Aninri'),
(260, 14, 'Awgu'),
(261, 14, 'Enugu East'),
(262, 14, 'Enugu North'),
(263, 14, 'Enugu South'),
(264, 14, 'Ezeagu'),
(265, 14, 'Igbo Etiti'),
(266, 14, 'Igbo Eze North'),
(267, 14, 'Igbo Eze South'),
(268, 14, 'Isi Uzo'),
(269, 14, 'Nkanu East'),
(270, 14, 'Nkanu West'),
(271, 14, 'Nsukka'),
(272, 14, 'Oji River'),
(273, 14, 'Udenu'),
(274, 14, 'Udi'),
(275, 14, 'Uzo Uwani'),
(276, 15, 'Abaji'),
(277, 15, 'Bwari'),
(278, 15, 'Gwagwalada'),
(279, 15, 'Kuje'),
(280, 15, 'Kwali'),
(281, 15, 'Municipal Area Council'),
(282, 16, 'Akko'),
(283, 16, 'Balanga'),
(284, 16, 'Billiri'),
(285, 16, 'Dukku'),
(286, 16, 'Funakaye'),
(287, 16, 'Gombe'),
(288, 16, 'Kaltungo'),
(289, 16, 'Kwami'),
(290, 16, 'Nafada'),
(291, 16, 'Shongom'),
(292, 16, 'Yamaltu/Deba'),
(293, 17, 'Aboh Mbaise'),
(294, 17, 'Ahiazu Mbaise'),
(295, 17, 'Ehime Mbano'),
(296, 17, 'Ezinihitte'),
(297, 17, 'Ideato North'),
(298, 17, 'Ideato South'),
(299, 17, 'Ihitte/Uboma'),
(300, 17, 'Ikeduru'),
(301, 17, 'Isiala Mbano'),
(302, 17, 'Isu'),
(303, 17, 'Mbaitoli'),
(304, 17, 'Ngor Okpala'),
(305, 17, 'Njaba'),
(306, 17, 'Nkwerre'),
(307, 17, 'Nwangele'),
(308, 17, 'Obowo'),
(309, 17, 'Oguta'),
(310, 17, 'Ohaji/Egbema'),
(311, 17, 'Okigwe'),
(312, 17, 'Orlu'),
(313, 17, 'Orsu'),
(314, 17, 'Oru East'),
(315, 17, 'Oru West'),
(316, 17, 'Owerri Municipal'),
(317, 17, 'Owerri North'),
(318, 17, 'Owerri West'),
(319, 17, 'Unuimo'),
(320, 18, 'Auyo'),
(321, 18, 'Babura'),
(322, 18, 'Biriniwa'),
(323, 18, 'Birnin Kudu'),
(324, 18, 'Buji'),
(325, 18, 'Dutse'),
(326, 18, 'Gagarawa'),
(327, 18, 'Garki'),
(328, 18, 'Gumel'),
(329, 18, 'Guri'),
(330, 18, 'Gwaram'),
(331, 18, 'Gwiwa'),
(332, 18, 'Hadejia'),
(333, 18, 'Jahun'),
(334, 18, 'Kafin Hausa'),
(335, 18, 'Kazaure'),
(336, 18, 'Kiri Kasama'),
(337, 18, 'Kiyawa'),
(338, 18, 'Kaugama'),
(339, 18, 'Maigatari'),
(340, 18, 'Malam Madori'),
(341, 18, 'Miga'),
(342, 18, 'Ringim'),
(343, 18, 'Roni'),
(344, 18, 'Sule Tankarkar'),
(345, 18, 'Taura'),
(346, 18, 'Yankwashi'),
(347, 19, 'Birnin Gwari'),
(348, 19, 'Chikun'),
(349, 19, 'Giwa'),
(350, 19, 'Igabi'),
(351, 19, 'Ikara'),
(352, 19, 'Jaba'),
(353, 19, 'Jema\'a'),
(354, 19, 'Kachia'),
(355, 19, 'Kaduna North'),
(356, 19, 'Kaduna South'),
(357, 19, 'Kagarko'),
(358, 19, 'Kajuru'),
(359, 19, 'Kaura'),
(360, 19, 'Kauru'),
(361, 19, 'Kubau'),
(362, 19, 'Kudan'),
(363, 19, 'Lere'),
(364, 19, 'Makarfi'),
(365, 19, 'Sabon Gari'),
(366, 19, 'Sanga'),
(367, 19, 'Soba'),
(368, 19, 'Zangon Kataf'),
(369, 19, 'Zaria'),
(370, 20, 'Ajingi'),
(371, 20, 'Albasu'),
(372, 20, 'Bagwai'),
(373, 20, 'Bebeji'),
(374, 20, 'Bichi'),
(375, 20, 'Bunkure'),
(376, 20, 'Dala'),
(377, 20, 'Dambatta'),
(378, 20, 'Dawakin Kudu'),
(379, 20, 'Dawakin Tofa'),
(380, 20, 'Doguwa'),
(381, 20, 'Fagge'),
(382, 20, 'Gabasawa'),
(383, 20, 'Garko'),
(384, 20, 'Garun Mallam'),
(385, 20, 'Gaya'),
(386, 20, 'Gezawa'),
(387, 20, 'Gwale'),
(388, 20, 'Gwarzo'),
(389, 20, 'Kabo'),
(390, 20, 'Kano Municipal'),
(391, 20, 'Karaye'),
(392, 20, 'Kibiya'),
(393, 20, 'Kiru'),
(394, 20, 'Kumbotso'),
(395, 20, 'Kunchi'),
(396, 20, 'Kura'),
(397, 20, 'Madobi'),
(398, 20, 'Makoda'),
(399, 20, 'Minjibir'),
(400, 20, 'Nasarawa'),
(401, 20, 'Rano'),
(402, 20, 'Rimin Gado'),
(403, 20, 'Rogo'),
(404, 20, 'Shanono'),
(405, 20, 'Sumaila'),
(406, 20, 'Takai'),
(407, 20, 'Tarauni'),
(408, 20, 'Tofa'),
(409, 20, 'Tsanyawa'),
(410, 20, 'Tudun Wada'),
(411, 20, 'Ungogo'),
(412, 20, 'Warawa'),
(413, 20, 'Wudil'),
(414, 21, 'Bakori'),
(415, 21, 'Batagarawa'),
(416, 21, 'Batsari'),
(417, 21, 'Baure'),
(418, 21, 'Bindawa'),
(419, 21, 'Charanchi'),
(420, 21, 'Dandume'),
(421, 21, 'Danja'),
(422, 21, 'Dan Musa'),
(423, 21, 'Daura'),
(424, 21, 'Dutsi'),
(425, 21, 'Dutsin Ma'),
(426, 21, 'Faskari'),
(427, 21, 'Funtua'),
(428, 21, 'Ingawa'),
(429, 21, 'Jibia'),
(430, 21, 'Kafur'),
(431, 21, 'Kaita'),
(432, 21, 'Kankara'),
(433, 21, 'Kankia'),
(434, 21, 'Katsina'),
(435, 21, 'Kurfi'),
(436, 21, 'Kusada'),
(437, 21, 'Mai\'Adua'),
(438, 21, 'Malumfashi'),
(439, 21, 'Mani'),
(440, 21, 'Mashi'),
(441, 21, 'Matazu'),
(442, 21, 'Musawa'),
(443, 21, 'Rimi'),
(444, 21, 'Sabuwa'),
(445, 21, 'Safana'),
(446, 21, 'Sandamu'),
(447, 21, 'Zango'),
(448, 22, 'Aleiro'),
(449, 22, 'Arewa Dandi'),
(450, 22, 'Argungu'),
(451, 22, 'Augie'),
(452, 22, 'Bagudo'),
(453, 22, 'Birnin Kebbi'),
(454, 22, 'Bunza'),
(455, 22, 'Dandi'),
(456, 22, 'Fakai'),
(457, 22, 'Gwandu'),
(458, 22, 'Jega'),
(459, 22, 'Kalgo'),
(460, 22, 'Koko/Besse'),
(461, 22, 'Maiyama'),
(462, 22, 'Ngaski'),
(463, 22, 'Sakaba'),
(464, 22, 'Shanga'),
(465, 22, 'Suru'),
(466, 22, 'Wasagu/Danko'),
(467, 22, 'Yauri'),
(468, 22, 'Zuru'),
(469, 23, 'Adavi'),
(470, 23, 'Ajaokuta'),
(471, 23, 'Ankpa'),
(472, 23, 'Bassa'),
(473, 23, 'Dekina'),
(474, 23, 'Ibaji'),
(475, 23, 'Idah'),
(476, 23, 'Igalamela Odolu'),
(477, 23, 'Ijumu'),
(478, 23, 'Kabba/Bunu'),
(479, 23, 'Kogi'),
(480, 23, 'Lokoja'),
(481, 23, 'Mopa Muro'),
(482, 23, 'Ofu'),
(483, 23, 'Ogori/Magongo'),
(484, 23, 'Okehi'),
(485, 23, 'Okene'),
(486, 23, 'Olamaboro'),
(487, 23, 'Omala'),
(488, 23, 'Yagba East'),
(489, 23, 'Yagba West'),
(490, 24, 'Asa'),
(491, 24, 'Baruten'),
(492, 24, 'Edu'),
(493, 24, 'Ekiti, Kwara State'),
(494, 24, 'Ifelodun'),
(495, 24, 'Ilorin East'),
(496, 24, 'Ilorin South'),
(497, 24, 'Ilorin West'),
(498, 24, 'Irepodun'),
(499, 24, 'Isin'),
(500, 24, 'Kaiama'),
(501, 24, 'Moro'),
(502, 24, 'Offa'),
(503, 24, 'Oke Ero'),
(504, 24, 'Oyun'),
(505, 24, 'Pategi'),
(506, 25, 'Agege'),
(507, 25, 'Ajeromi-Ifelodun'),
(508, 25, 'Alimosho'),
(509, 25, 'Amuwo-Odofin'),
(510, 25, 'Apapa'),
(511, 25, 'Badagry'),
(512, 25, 'Epe'),
(513, 25, 'Eti Osa'),
(514, 25, 'Ibeju-Lekki'),
(515, 25, 'Ifako-Ijaiye'),
(516, 25, 'Ikeja'),
(517, 25, 'Ikorodu'),
(518, 25, 'Kosofe'),
(519, 25, 'Lagos Island'),
(520, 25, 'Lagos Mainland'),
(521, 25, 'Mushin'),
(522, 25, 'Ojo'),
(523, 25, 'Oshodi-Isolo'),
(524, 25, 'Shomolu'),
(525, 25, 'Surulere, Lagos State'),
(526, 26, 'Akwanga'),
(527, 26, 'Awe'),
(528, 26, 'Doma'),
(529, 26, 'Karu'),
(530, 26, 'Keana'),
(531, 26, 'Keffi'),
(532, 26, 'Kokona'),
(533, 26, 'Lafia'),
(534, 26, 'Nasarawa'),
(535, 26, 'Nasarawa Egon'),
(536, 26, 'Obi'),
(537, 26, 'Toto'),
(538, 26, 'Wamba'),
(539, 27, 'Agaie'),
(540, 27, 'Agwara'),
(541, 27, 'Bida'),
(542, 27, 'Borgu'),
(543, 27, 'Bosso'),
(544, 27, 'Chanchaga'),
(545, 27, 'Edati'),
(546, 27, 'Gbako'),
(547, 27, 'Gurara'),
(548, 27, 'Katcha'),
(549, 27, 'Kontagora'),
(550, 27, 'Lapai'),
(551, 27, 'Lavun'),
(552, 27, 'Magama'),
(553, 27, 'Mariga'),
(554, 27, 'Mashegu'),
(555, 27, 'Mokwa'),
(556, 27, 'Moya'),
(557, 27, 'Paikoro'),
(558, 27, 'Rafi'),
(559, 27, 'Rijau'),
(560, 27, 'Shiroro'),
(561, 27, 'Suleja'),
(562, 27, 'Tafa'),
(563, 27, 'Wushishi'),
(564, 28, 'Abeokuta North'),
(565, 28, 'Abeokuta South'),
(566, 28, 'Ado-Odo/Ota'),
(567, 28, 'Egbado North'),
(568, 28, 'Egbado South'),
(569, 28, 'Ewekoro'),
(570, 28, 'Ifo'),
(571, 28, 'Ijebu East'),
(572, 28, 'Ijebu North'),
(573, 28, 'Ijebu North East'),
(574, 28, 'Ijebu Ode'),
(575, 28, 'Ikenne'),
(576, 28, 'Imeko Afon'),
(577, 28, 'Ipokia'),
(578, 28, 'Obafemi Owode'),
(579, 28, 'Odeda'),
(580, 28, 'Odogbolu'),
(581, 28, 'Ogun Waterside'),
(582, 28, 'Remo North'),
(583, 28, 'Shagamu'),
(584, 29, 'Akoko North-East'),
(585, 29, 'Akoko North-West'),
(586, 29, 'Akoko South-West'),
(587, 29, 'Akoko South-East'),
(588, 29, 'Akure North'),
(589, 29, 'Akure South'),
(590, 29, 'Ese Odo'),
(591, 29, 'Idanre'),
(592, 29, 'Ifedore'),
(593, 29, 'Ilaje'),
(594, 29, 'Ile Oluji/Okeigbo'),
(595, 29, 'Irele'),
(596, 29, 'Odigbo'),
(597, 29, 'Okitipupa'),
(598, 29, 'Ondo East'),
(599, 29, 'Ondo West'),
(600, 29, 'Ose'),
(601, 29, 'Owo'),
(602, 30, 'Atakunmosa East'),
(603, 30, 'Atakunmosa West'),
(604, 30, 'Aiyedaade'),
(605, 30, 'Aiyedire'),
(606, 30, 'Boluwaduro'),
(607, 30, 'Boripe'),
(608, 30, 'Ede North'),
(609, 30, 'Ede South'),
(610, 30, 'Ife Central'),
(611, 30, 'Ife East'),
(612, 30, 'Ife North'),
(613, 30, 'Ife South'),
(614, 30, 'Egbedore'),
(615, 30, 'Ejigbo'),
(616, 30, 'Ifedayo'),
(617, 30, 'Ifelodun'),
(618, 30, 'Ila'),
(619, 30, 'Ilesa East'),
(620, 30, 'Ilesa West'),
(621, 30, 'Irepodun'),
(622, 30, 'Irewole'),
(623, 30, 'Isokan'),
(624, 30, 'Iwo'),
(625, 30, 'Obokun'),
(626, 30, 'Odo Otin'),
(627, 30, 'Ola Oluwa'),
(628, 30, 'Olorunda'),
(629, 30, 'Oriade'),
(630, 30, 'Orolu'),
(631, 30, 'Osogbo'),
(632, 31, 'Afijio'),
(633, 31, 'Akinyele'),
(634, 31, 'Atiba'),
(635, 31, 'Atisbo'),
(636, 31, 'Egbeda'),
(637, 31, 'Ibadan North'),
(638, 31, 'Ibadan North-East'),
(639, 31, 'Ibadan North-West'),
(640, 31, 'Ibadan South-East'),
(641, 31, 'Ibadan South-West'),
(642, 31, 'Ibarapa Central'),
(643, 31, 'Ibarapa East'),
(644, 31, 'Ibarapa North'),
(645, 31, 'Ido'),
(646, 31, 'Irepo'),
(647, 31, 'Iseyin'),
(648, 31, 'Itesiwaju'),
(649, 31, 'Iwajowa'),
(650, 31, 'Kajola'),
(651, 31, 'Lagelu'),
(652, 31, 'Ogbomosho North'),
(653, 31, 'Ogbomosho South'),
(654, 31, 'Ogo Oluwa'),
(655, 31, 'Olorunsogo'),
(656, 31, 'Oluyole'),
(657, 31, 'Ona Ara'),
(658, 31, 'Orelope'),
(659, 31, 'Ori Ire'),
(660, 31, 'Oyo'),
(661, 31, 'Oyo East'),
(662, 31, 'Saki East'),
(663, 31, 'Saki West'),
(664, 31, 'Surulere, Oyo State'),
(665, 32, 'Bokkos'),
(666, 32, 'Barkin Ladi'),
(667, 32, 'Bassa'),
(668, 32, 'Jos East'),
(669, 32, 'Jos North'),
(670, 32, 'Jos South'),
(671, 32, 'Kanam'),
(672, 32, 'Kanke'),
(673, 32, 'Langtang South'),
(674, 32, 'Langtang North'),
(675, 32, 'Mangu'),
(676, 32, 'Mikang'),
(677, 32, 'Pankshin'),
(678, 32, 'Qua\'an Pan'),
(679, 32, 'Riyom'),
(680, 32, 'Shendam'),
(681, 32, 'Wase'),
(682, 33, 'Abua/Odual'),
(683, 33, 'Ahoada East'),
(684, 33, 'Ahoada West'),
(685, 33, 'Akuku-Toru'),
(686, 33, 'Andoni'),
(687, 33, 'Asari-Toru'),
(688, 33, 'Bonny'),
(689, 33, 'Degema'),
(690, 33, 'Eleme'),
(691, 33, 'Emuoha'),
(692, 33, 'Etche'),
(693, 33, 'Gokana'),
(694, 33, 'Ikwerre'),
(695, 33, 'Khana'),
(696, 33, 'Obio/Akpor'),
(697, 33, 'Ogba/Egbema/Ndoni'),
(698, 33, 'Ogu/Bolo'),
(699, 33, 'Okrika'),
(700, 33, 'Omuma'),
(701, 33, 'Opobo/Nkoro'),
(702, 33, 'Oyigbo'),
(703, 33, 'Port Harcourt'),
(704, 33, 'Tai'),
(705, 34, 'Binji'),
(706, 34, 'Bodinga'),
(707, 34, 'Dange Shuni'),
(708, 34, 'Gada'),
(709, 34, 'Goronyo'),
(710, 34, 'Gudu'),
(711, 34, 'Gwadabawa'),
(712, 34, 'Illela'),
(713, 34, 'Isa'),
(714, 34, 'Kebbe'),
(715, 34, 'Kware'),
(716, 34, 'Rabah'),
(717, 34, 'Sabon Birni'),
(718, 34, 'Shagari'),
(719, 34, 'Silame'),
(720, 34, 'Sokoto North'),
(721, 34, 'Sokoto South'),
(722, 34, 'Tambuwal'),
(723, 34, 'Tangaza'),
(724, 34, 'Tureta'),
(725, 34, 'Wamako'),
(726, 34, 'Wurno'),
(727, 34, 'Yabo'),
(728, 35, 'Ardo Kola'),
(729, 35, 'Bali'),
(730, 35, 'Donga'),
(731, 35, 'Gashaka'),
(732, 35, 'Gassol'),
(733, 35, 'Ibi'),
(734, 35, 'Jalingo'),
(735, 35, 'Karim Lamido'),
(736, 35, 'Kumi'),
(737, 35, 'Lau'),
(738, 35, 'Sardauna'),
(739, 35, 'Takum'),
(740, 35, 'Ussa'),
(741, 35, 'Wukari'),
(742, 35, 'Yorro'),
(743, 35, 'Zing'),
(744, 36, 'Bade'),
(745, 36, 'Bursari'),
(746, 36, 'Damaturu'),
(747, 36, 'Fika'),
(748, 36, 'Fune'),
(749, 36, 'Geidam'),
(750, 36, 'Gujba'),
(751, 36, 'Gulani'),
(752, 36, 'Jakusko'),
(753, 36, 'Karasuwa'),
(754, 36, 'Machina'),
(755, 36, 'Nangere'),
(756, 36, 'Nguru'),
(757, 36, 'Potiskum'),
(758, 36, 'Tarmuwa'),
(759, 36, 'Yunusari'),
(760, 36, 'Yusufari'),
(761, 37, 'Anka'),
(762, 37, 'Bakura'),
(763, 37, 'Birnin Magaji/Kiyaw'),
(764, 37, 'Bukkuyum'),
(765, 37, 'Bungudu'),
(766, 37, 'Gummi'),
(767, 37, 'Gusau'),
(768, 37, 'Kaura Namoda'),
(769, 37, 'Maradun'),
(770, 37, 'Maru'),
(771, 37, 'Shinkafi'),
(772, 37, 'Talata Mafara'),
(773, 37, 'Chafe'),
(774, 37, 'Zurmi');

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `id` int(11) NOT NULL,
  `marketid` text NOT NULL,
  `marketname` text NOT NULL,
  `marketstate` text NOT NULL,
  `marketaddress` text NOT NULL,
  `marketchairman` text NOT NULL,
  `marketimg` text NOT NULL,
  `marketstatus` text NOT NULL,
  `created_by` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`id`, `marketid`, `marketname`, `marketstate`, `marketaddress`, `marketchairman`, `marketimg`, `marketstatus`, `created_by`, `created_date`) VALUES
(1, '323474', 'Utako Market', 'Abuja', 'Jabi Utako, abuja', 'Utako Market', '323474-AVI.png', 'Active', 'SuperAdmin', '2020-02-24 17:11:46'),
(2, '985258', 'Wuse Market', 'Abuja', 'Wuse zone 2', 'aminu', '985258-avatar.png', 'Active', 'SuperAdmin', '2020-02-24 17:12:21'),
(3, '454373', 'Ojoo Market', 'Lagos', 'lagos', 'james', '454373-avatar.png', 'Active', 'SuperAdmin', '2020-02-24 17:12:52'),
(4, '131294', 'Okota Market', 'Lagos', 'lagos', 'Okota Market', '131294-avatar.png', 'Active', 'SuperAdmin', '2020-02-24 17:13:47'),
(9, '778294', 'NEW', 'Akwa Ibom', 'TEST', 'NEW', '778294-p2.jpg', 'Active', 'SuperAdmin', '2020-05-16 16:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `marketproductid`
--

CREATE TABLE `marketproductid` (
  `id` int(11) NOT NULL,
  `marketid` text NOT NULL,
  `marketstate` text NOT NULL,
  `categoryid` text NOT NULL,
  `categoryname` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marketproductid`
--

INSERT INTO `marketproductid` (`id`, `marketid`, `marketstate`, `categoryid`, `categoryname`) VALUES
(23, '323474', 'Abuja', '193357', 'Electrical Appliances'),
(3, '985258', 'Abuja', '229936', 'Automobile &amp; Spare Parts'),
(4, '454373', 'Lagos', '229936', 'Automobile &amp; Spare Parts'),
(5, '454373', 'Lagos', '193357', 'Electrical Appliances'),
(6, '131294', 'Lagos', '544753', 'Fashion and Jewery'),
(7, '507230', 'Abuja', '229936', 'Automobile and Spare Parts'),
(8, '507230', 'Abuja', '193357', 'Electrical Appliances'),
(9, '507230', 'Abuja', '544753', 'Fashion and Jewery'),
(10, '507230', 'Abuja', '147195', 'Computers and Appliances'),
(11, '999695', 'Abuja', '229936', 'Automobile and Spare Parts'),
(12, '999695', 'Abuja', '193357', 'Electrical Appliances'),
(13, '776183', 'Abuja', '229936', 'Automobile and Spare Parts'),
(14, '776183', 'Abuja', '193357', 'Electrical Appliances'),
(15, '776183', 'Abuja', '544753', 'Fashion and Jewery'),
(16, '707739', 'Abuja', '229936', 'Automobile and Spare Parts'),
(17, '707739', 'Abuja', '193357', 'Electrical Appliances'),
(18, '707739', 'Abuja', '544753', 'Fashion and Jewery'),
(24, '323474', 'Abuja', '544753', 'Fashion and Jewery'),
(22, '323474', 'Abuja', '229936', 'Automobile and Spare Parts'),
(26, '778294', 'Akwa Ibom', '358307', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `messageid` text NOT NULL,
  `senderid` text NOT NULL,
  `receiverid` text NOT NULL,
  `msg` text NOT NULL,
  `status` text NOT NULL,
  `date_messaged` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `messageid`, `senderid`, `receiverid`, `msg`, `status`, `date_messaged`) VALUES
(1, '200508060525', '536361', '967815', 'klasjlaskdfkl', '0', '2020-05-08 17:00:25'),
(2, '674744', '20200513020551', 'buyer-20200513020551', 'Error, field(s) cannot be empty!', 'Pending', '2020-05-13 03:20:59'),
(3, '577466', '20200513020551', 'buyer-20200513020551', 'Error, field(s) cannot be empty!', 'Pending', '2020-05-13 03:21:58'),
(4, '611569', '20200513020551', 'buyer-20200513020551', 'for u', 'Pending', '2020-05-13 03:23:28'),
(5, '814261', '20200513020551', 'buyer-20200513020551', 'ok', 'Pending', '2020-05-13 03:37:19'),
(6, '759697', '20200513020551', 'buyer-20200513020551', 'hey\n', 'Pending', '2020-05-13 03:44:30'),
(7, '292796', '20200513020551', '', '', 'Pending', '2020-05-13 03:54:40'),
(8, '193011', '20200513020551', '', '', 'Pending', '2020-05-13 03:55:05'),
(9, '739389', '20200513020551', '', '', 'Pending', '2020-05-13 03:56:15'),
(10, '430389', '20200513020551', '', '', 'Pending', '2020-05-13 03:58:36'),
(11, '163477', '20200513020551', '', 'het', 'Pending', '2020-05-13 04:00:11'),
(12, '354472', '20200513020551', '', 'het', 'Pending', '2020-05-13 04:00:21'),
(13, '319539', '20200513020551', '', 'het', 'Pending', '2020-05-13 04:00:22'),
(14, '634410', '20200513020551', 'admin-1111', 'hey test ', 'Pending', '2020-05-13 22:10:34'),
(15, '934981', '20200513110550', '', 'hey', 'Pending', '2020-05-13 23:20:38'),
(16, '858221', '20200513110550', '', '', 'Pending', '2020-05-15 01:14:06'),
(17, '646318', '20200513110550', '', '', 'Pending', '2020-05-15 01:15:41'),
(18, '790246', '20200513110550', '', 'hello', 'Pending', '2020-05-15 01:29:20'),
(19, '540726', '20200513110550', '', 'this should work\n', 'Pending', '2020-05-15 01:38:10'),
(20, '975954', '20200513110550', '', '', 'Pending', '2020-05-15 01:39:12'),
(21, '375693', '20200513110550', '', '', 'Pending', '2020-05-15 01:41:36'),
(22, '116474', '20200513110550', '', '', 'Pending', '2020-05-15 01:41:40'),
(23, '234695', '20200513110550', '', '', 'Pending', '2020-05-15 01:41:45'),
(24, '284646', '20200513110550', '', 'hey\n', 'Pending', '2020-05-15 01:44:40'),
(25, '383698', '20200513110550', '', 'hey', 'Pending', '2020-05-15 01:46:09'),
(26, '593887', '20200513110550', '', 'hey\n', 'Pending', '2020-05-15 01:46:27'),
(27, '725063', '20200513110550', '', 'hey', 'Pending', '2020-05-15 01:47:04'),
(28, '481008', '20200513110550', '', 'het', 'Pending', '2020-05-15 01:47:09'),
(29, '353661', '20200513110550', '', 'hey', 'Pending', '2020-05-15 01:47:28'),
(30, '246658', '20200513110550', '', 'hey', 'Pending', '2020-05-15 01:47:31'),
(31, '334276', '20200513110550', '', 'hey', 'Pending', '2020-05-15 01:49:34'),
(32, '836379', '20200513110550', '', 'the', 'Pending', '2020-05-15 01:50:05'),
(33, '587731', '20200513110550', '', 'hey', 'Pending', '2020-05-15 01:58:37'),
(34, '484848', '20200513110550', '', 'hey', 'Pending', '2020-05-15 01:58:40'),
(35, '890357', '20200513110550', '', 'hey', 'Pending', '2020-05-15 02:03:14'),
(36, '909299', '20200513110550', '', 'this', 'Pending', '2020-05-15 02:03:18'),
(37, '626591', '20200513110550', '', '', 'Pending', '2020-05-15 02:03:37'),
(38, '279637', '20200513110550', '', '', 'Pending', '2020-05-15 02:04:15'),
(39, '887697', '20200513110550', '', 'hey', 'Pending', '2020-05-15 02:07:40'),
(40, '591009', '20200513110550', '', 'hey', 'Pending', '2020-05-15 02:07:45'),
(41, '623678', '20200513110550', 'Error, field(s) cannot be empty!', 'he', 'Pending', '2020-05-15 02:15:52'),
(42, '675206', '20200513110550', '', 'e', 'Pending', '2020-05-15 02:16:58'),
(43, '793261', '20200513110550', '', '', 'Pending', '2020-05-15 02:18:21'),
(44, '610343', '20200513110550', '20200423010446', '', 'Pending', '2020-05-15 02:19:45'),
(45, '433576', '20200513110550', '20200511050557', 'hr', 'Pending', '2020-05-15 02:22:21'),
(46, '625681', '20200513110550', '20200511050557', 'ss', 'Pending', '2020-05-15 02:24:59'),
(47, '262561', '20200513110550', '20200511050557', '', 'Pending', '2020-05-15 02:33:11'),
(48, '388991', '20200513110550', '20200511050557', 'ok', 'Pending', '2020-05-15 02:43:46'),
(49, '944388', '20200513110550', '', 'hi', 'Pending', '2020-05-16 13:40:41'),
(50, '523094', '20200513110550', '', 'why no fetching', 'Pending', '2020-05-16 13:53:08'),
(51, '529967', '20200513110550', '', 'hey', 'Pending', '2020-05-16 13:59:04'),
(52, '532734', '20200513110550', '', 'hey ', 'Pending', '2020-05-16 13:59:38'),
(53, '573587', '20200513110550', '403720', 'hey', 'Pending', '2020-05-16 14:00:48'),
(54, '933457', '20200513110550', '', 'sello', 'Pending', '2020-05-16 14:08:48'),
(55, '654503', '20200513110550', '967815', 'okok', 'Pending', '2020-05-16 14:12:44'),
(56, '593604', '20200513110550', '967815', 'hi', 'Pending', '2020-05-16 14:15:27'),
(57, '776928', '20200513110550', '967815', 'hi', 'Pending', '2020-05-16 14:29:40'),
(58, '112420', '20200513110550', '967815', 'ok', 'Pending', '2020-05-16 14:36:19'),
(59, '321916', '20200513110550', '967815', 'ok\n', 'Pending', '2020-05-16 14:37:37'),
(60, '641345', '1111', '20200513110550', 'ok', 'Pending', '2020-05-17 14:02:21'),
(61, '243951', '1111', '20200513100557', 'hi', 'Pending', '2020-05-21 18:09:09'),
(62, '683773', '20200513020551', '825974', 'hi', 'Pending', '2020-05-30 16:06:04'),
(63, '259229', '20200513020551', '20200513100557', 'Hi', 'Pending', '2020-05-30 23:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `message_seller_pd`
--

CREATE TABLE `message_seller_pd` (
  `id` int(11) NOT NULL,
  `messid` text NOT NULL,
  `userid` text NOT NULL,
  `receiverid` text NOT NULL,
  `productid` text NOT NULL,
  `b_name` text NOT NULL,
  `b_phone` text NOT NULL,
  `b_email` text NOT NULL,
  `b_message` text NOT NULL,
  `status` text NOT NULL,
  `date_submited` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_seller_pd`
--

INSERT INTO `message_seller_pd` (`id`, `messid`, `userid`, `receiverid`, `productid`, `b_name`, `b_phone`, `b_email`, `b_message`, `status`, `date_submited`) VALUES
(1, '20200510060557', '536361', 'klsdjf', '', 'vivian onome', '', '', 'kasjdfkl', 'Pending', '2020-05-10 17:54:57'),
(2, '20200510060517', '536361', 'kasjfkl', '', 'vivian onome', '', '', 'klsdlfasjklasjdflk', 'Pending', '2020-05-10 17:55:17'),
(3, '20200510070503', '967815', 'laksdjf', '', 'josimar akpomudia', '', '', 'ajksdfj', 'Pending', '2020-05-10 18:05:03'),
(4, '20200510070542', '536361', '20200428120412', '', 'vivian onome', '', '', 'josimar', 'Pending', '2020-05-10 18:14:42'),
(5, '20200510070559', '536361', '20200428120412', '', 'vivian onome', '', '', 'hello', 'Pending', '2020-05-10 18:14:59'),
(6, '20200515010542', '20200513110550', '967815', '', 'Elijah1 Okokon', '+2348150685555', 'okoelijah@gmail.com', 'you', 'Pending', '2020-05-15 00:42:42'),
(7, '20200515010501', '20200513110550', '20200423010446', '', 'Elijah1 Okokon', '', '', '', 'Pending', '2020-05-15 00:43:01'),
(8, '20200515010532', '20200513110550', '889140', '', 'Elijah1 Okokon', '', '', '', 'Pending', '2020-05-15 00:54:32'),
(9, '20200515010500', '20200513110550', '889140', '', 'Elijah1 Okokon', '', '', '', 'Pending', '2020-05-15 00:57:00'),
(10, '20200515020523', '20200513110550', '20200423010446', '', 'Elijah1 Okokon', '', '', '', 'Pending', '2020-05-15 01:30:23'),
(11, '20200515020509', '20200513110550', '889140', '', 'Elijah1 Okokon', '+2348150685555', 'okoelijah@gmail.com', 'hey to u', 'Pending', '2020-05-15 01:36:09'),
(12, '20200516050519', '20200513110550', '20200513110550', '', 'Elijah1 Okokon', '', '', 'ok ', 'Pending', '2020-05-16 16:10:19'),
(13, '20200517030531', '1111', '20200513110550', '283850', 'Ojarh Admin', '+2348150685555', 'okoelijah@gmail.com', 'ehy', 'Pending', '2020-05-17 14:02:31'),
(14, '20200521070533', '1111', '20200513100557', '', 'Ojarh Admin', '', '', '', 'Pending', '2020-05-21 18:05:33'),
(15, '20200523070510', '20200513020551', 'international-20200513100557', '', 'Elijah2 Okokon2', '', '', 'hope it works', 'Pending', '2020-05-23 18:58:10'),
(16, '20200523070539', '20200513020551', 'international-20200513100557', '', 'Elijah2 Okokon2', '', '', '', 'Pending', '2020-05-23 18:58:39'),
(17, '20200523070544', '20200513020551', 'international-20200513100557', '', 'Elijah2 Okokon2', '', '', '', 'Pending', '2020-05-23 18:58:44'),
(18, '20200523080525', '20200513020551', 'testadmin-20200513110550', '', 'Elijah2 Okokon2', '', '', 'to u', 'Pending', '2020-05-23 19:18:25'),
(19, '20200527010513', '20200513020551', 'josimar', '', 'Elijah2 Okokon2', '', '', 'test', 'Pending', '2020-05-27 00:42:13'),
(20, '20200530050547', '20200513020551', '825974', '', 'Elijah2 Okokon2', '2345678', 'u@gmail.com', 'okay', 'Pending', '2020-05-30 16:05:47'),
(21, '20200530050545', '20200513020551', '20200513100557', '', 'Elijah2 Okokon2', '23456', 'u@gmail.com', 'ok', 'Pending', '2020-05-30 16:06:45'),
(22, '20200531120507', '20200513020551', 'Seller', '', 'Elijah2 Okokon2', '', '', 'Testing', 'Pending', '2020-05-30 23:13:07'),
(23, '20200531120556', '20200513020551', '20200513020551', '', 'Elijah2 Okokon2', '', '', 'Ok', 'Pending', '2020-05-30 23:13:56'),
(24, '20200531120551', '20200513020551', '20200513020551', '', 'Elijah2 Okokon2', '', '', 'test', 'Pending', '2020-05-30 23:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `naija_states`
--

CREATE TABLE `naija_states` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COMMENT='States in Nigeria.';

--
-- Dumping data for table `naija_states`
--

INSERT INTO `naija_states` (`id`, `name`) VALUES
(1, 'Abia'),
(2, 'Adamawa'),
(3, 'Akwa Ibom'),
(4, 'Anambra'),
(5, 'Bauchi'),
(6, 'Bayelsa'),
(7, 'Benue'),
(8, 'Borno'),
(9, 'Cross River'),
(10, 'Delta'),
(11, 'Ebonyi'),
(12, 'Edo'),
(13, 'Ekiti'),
(14, 'Enugu'),
(15, 'Abuja'),
(16, 'Gombe'),
(17, 'Imo'),
(18, 'Jigawa'),
(19, 'Kaduna'),
(20, 'Kano'),
(21, 'Katsina'),
(22, 'Kebbi'),
(23, 'Kogi'),
(24, 'Kwara'),
(25, 'Lagos'),
(26, 'Nasarawa'),
(27, 'Niger'),
(28, 'Ogun'),
(29, 'Ondo'),
(30, 'Osun'),
(31, 'Oyo'),
(32, 'Plateau'),
(33, 'Rivers'),
(34, 'Sokoto'),
(35, 'Taraba'),
(36, 'Yobe'),
(37, 'Zamfara');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `generatedlink` text NOT NULL,
  `status` text NOT NULL,
  `happen_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `userid`, `title`, `body`, `generatedlink`, `status`, `happen_at`) VALUES
(1, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=229936', '', '2020-02-24 17:10:18'),
(2, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=193357', '', '2020-02-24 17:10:55'),
(3, 'all', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=323474', '', '2020-02-24 17:11:46'),
(4, 'all', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=985258', '', '2020-02-24 17:12:21'),
(5, 'all', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=454373', '', '2020-02-24 17:12:52'),
(6, 'all', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=131294', '', '2020-02-24 17:13:47'),
(7, '849871', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-24 18:14:27', 'seller_details.php?sellerid=849871', '', '2020-02-24 17:14:27'),
(8, '610008', 'New Seller Registration', 'This Seller Just Registered - josimar', 'seller_details.php?sellerid=610008', '', '2020-02-24 17:16:40'),
(9, '610008', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-24 18:17:56', 'seller_details.php?sellerid=610008', '', '2020-02-24 17:17:56'),
(10, '610008', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-24 18:18:38', 'seller_details.php?sellerid=610008', '', '2020-02-24 17:18:38'),
(11, '610008', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-24 18:24:22', 'seller_details.php?sellerid=610008', '', '2020-02-24 17:24:22'),
(12, '967815', 'New Seller Registration', 'This Seller Just Registered - josimar', 'seller_details.php?sellerid=967815', '', '2020-02-24 17:32:54'),
(13, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-24 18:33:32', 'seller_details.php?sellerid=967815', '', '2020-02-24 17:33:32'),
(14, '967815', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=967815', '', '2020-02-24 17:35:04'),
(15, '967815', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=967815', '', '2020-02-24 17:35:59'),
(16, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-24 18:36:16', 'seller_details.php?sellerid=967815', '', '2020-02-24 17:36:16'),
(17, '967815', 'New Business Information Created', 'A new business information has been created!', 'seller_details.php?sellerid=967815', '', '2020-02-24 17:38:36'),
(18, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-02-24 18:43:34', 'seller_details.php?sellerid=1111', '', '2020-02-24 17:43:34'),
(19, '967815', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'seller_details.php?sellerid=967815', '', '2020-02-24 17:56:21'),
(20, '967815', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'seller_details.php?sellerid=967815', '', '2020-02-24 17:56:36'),
(21, '967815', 'Seller Added Account Details', 'A seller just updated his/her account details', 'seller_details.php?userid=967815', '', '2020-02-24 17:57:10'),
(22, '967815', 'New Product Created!', 'A new product has been created by the !967815', 'product_details.php?productid=275995', '', '2020-02-24 18:00:47'),
(23, '967815', 'Product Approved', 'Your product has been approved!', 'product_details.php?productid=275995', '', '2020-02-24 18:02:34'),
(24, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-02-26 13:24:37', 'seller_details.php?sellerid=1111', '', '2020-02-26 12:24:37'),
(25, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-27 17:41:57', 'seller_details.php?sellerid=967815', '', '2020-02-27 16:41:57'),
(26, '967815', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=967815', '', '2020-02-27 16:44:36'),
(27, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-27 17:45:34', 'seller_details.php?sellerid=967815', '', '2020-02-27 16:45:34'),
(28, '967815', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=967815', '', '2020-02-27 16:46:59'),
(29, '967815', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=967815', '', '2020-02-27 16:48:37'),
(30, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-27 17:48:57', 'seller_details.php?sellerid=967815', '', '2020-02-27 16:48:57'),
(31, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-02-28 13:10:22', 'seller_details.php?sellerid=1111', '', '2020-02-28 12:10:22'),
(32, '', 'New Agent Created', 'A new agent has been created!', 'agent_details.php?sellerid=32961679', '', '2020-02-28 12:12:54'),
(33, '32961679', 'Agent Activated', 'Your account has been activated!', 'agent_details.php?agentid=32961679', '', '2020-02-28 12:18:18'),
(34, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-02-28 14:36:48', 'seller_details.php?sellerid=1111', '', '2020-02-28 13:36:48'),
(35, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-02-29 20:16:03', 'seller_details.php?sellerid=967815', '', '2020-02-29 19:16:03'),
(36, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-01 13:41:18', 'seller_details.php?sellerid=1111', '', '2020-03-01 12:41:18'),
(37, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-01 20:26:41', 'seller_details.php?sellerid=967815', '', '2020-03-01 19:26:41'),
(38, '967815', 'Seller Verification', 'A seller just submitted a ticket for verification!', 'seller_details.php?sellerid=967815', '', '2020-03-01 19:28:56'),
(39, '967815', 'Seller Verification', 'Your account has been verified!', 'seller_details.php?sellerid=967815', '', '2020-03-01 19:34:55'),
(40, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-02 19:21:13', 'seller_details.php?sellerid=967815', '', '2020-03-02 18:21:13'),
(41, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-02 19:24:49', 'seller_details.php?sellerid=1111', '', '2020-03-02 18:24:49'),
(42, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-02 19:26:58', 'seller_details.php?sellerid=967815', '', '2020-03-02 18:26:58'),
(43, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-02 19:29:13', 'seller_details.php?sellerid=1111', '', '2020-03-02 18:29:13'),
(44, '967815', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=967815', '', '2020-03-02 18:37:08'),
(45, '967815', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=967815', '', '2020-03-02 18:37:33'),
(46, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-02 19:49:15', 'seller_details.php?sellerid=1111', '', '2020-03-02 18:49:15'),
(47, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-02 20:10:21', 'seller_details.php?sellerid=1111', '', '2020-03-02 19:10:21'),
(48, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-02 20:10:35', 'seller_details.php?sellerid=967815', '', '2020-03-02 19:10:35'),
(49, '967815', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Basic', 'seller_details.php?sellerid=967815', '', '2020-03-02 19:10:57'),
(50, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-02 20:29:22', 'seller_details.php?sellerid=967815', '', '2020-03-02 19:29:22'),
(51, '967815', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Basic', 'seller_details.php?sellerid=967815', '', '2020-03-02 19:33:02'),
(52, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-02 20:34:30', 'seller_details.php?sellerid=967815', '', '2020-03-02 19:34:30'),
(53, '967815', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Basic', 'seller_details.php?sellerid=967815', '', '2020-03-02 19:34:44'),
(54, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-03 10:08:03', 'seller_details.php?sellerid=1111', '', '2020-03-03 09:08:03'),
(55, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-03 15:53:44', 'seller_details.php?sellerid=1111', '', '2020-03-03 14:53:44'),
(56, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=544753', '', '2020-03-03 15:17:46'),
(57, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-03 18:18:27', 'seller_details.php?sellerid=967815', '', '2020-03-03 17:18:27'),
(58, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-04 13:07:58', 'seller_details.php?sellerid=967815', '', '2020-03-04 12:07:58'),
(59, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-04 15:27:08', 'seller_details.php?sellerid=1111', '', '2020-03-04 14:27:08'),
(60, '', 'New Agent Created', 'A new agent has been created!', 'agent_details.php?sellerid=49981658', '', '2020-03-06 13:41:54'),
(61, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-06 14:42:13', 'seller_details.php?sellerid=1111', '', '2020-03-06 13:42:13'),
(62, '49981658', 'Agent Activated', 'Your account has been activated!', 'agent_details.php?agentid=49981658', '', '2020-03-06 13:43:31'),
(63, '861411', 'New Seller Registration', 'This Seller Just Registered - vicky', 'seller_details.php?sellerid=861411', '', '2020-03-06 13:46:26'),
(64, '464123', 'New Seller Registration', 'This Seller Just Registered - vicky1', 'seller_details.php?sellerid=464123', '', '2020-03-06 13:51:22'),
(65, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-06 15:04:30', 'seller_details.php?sellerid=967815', '', '2020-03-06 14:04:30'),
(66, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-06 15:13:25', 'seller_details.php?sellerid=1111', '', '2020-03-06 14:13:25'),
(67, '464123', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=464123', '', '2020-03-06 14:14:55'),
(68, '464123', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=464123', '', '2020-03-06 14:14:57'),
(69, '464123', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=464123', '', '2020-03-06 14:14:58'),
(70, '464123', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=464123', '', '2020-03-06 14:14:58'),
(71, '861411', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=861411', '', '2020-03-06 14:15:00'),
(72, '861411', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=861411', '', '2020-03-06 14:15:00'),
(73, '861411', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=861411', '', '2020-03-06 14:15:01'),
(74, '861411', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=861411', '', '2020-03-06 14:15:01'),
(75, '861411', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=861411', '', '2020-03-06 14:15:01'),
(76, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-06 15:18:15', 'seller_details.php?sellerid=1111', '', '2020-03-06 14:18:15'),
(77, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-06 15:29:02', 'seller_details.php?sellerid=967815', '', '2020-03-06 14:29:02'),
(78, '967815', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=967815', '', '2020-03-06 14:33:06'),
(79, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-06 15:35:53', 'seller_details.php?sellerid=1111', '', '2020-03-06 14:35:53'),
(80, '224633', 'New Seller Registration', 'This Seller Just Registered - dafy', 'seller_details.php?sellerid=224633', '', '2020-03-06 14:47:59'),
(81, '820977', 'New Seller Registration', 'This Seller Just Registered - ddd', 'seller_details.php?sellerid=820977', '', '2020-03-06 14:50:33'),
(82, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-09 10:43:01', 'seller_details.php?sellerid=1111', '', '2020-03-09 09:43:01'),
(83, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-09 10:43:55', 'seller_details.php?sellerid=967815', '', '2020-03-09 09:43:55'),
(84, '967815', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=967815', '', '2020-03-09 09:44:40'),
(85, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-09 10:57:32', 'seller_details.php?sellerid=967815', '', '2020-03-09 09:57:32'),
(86, '', 'Subscription Created', 'A new subscription has been created!', '', '', '2020-03-09 11:54:02'),
(87, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-11 14:10:32', 'seller_details.php?sellerid=1111', '', '2020-03-11 13:10:32'),
(88, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-11 14:15:50', 'seller_details.php?sellerid=967815', '', '2020-03-11 13:15:50'),
(89, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-11 14:27:51', 'seller_details.php?sellerid=967815', '', '2020-03-11 13:27:51'),
(90, '422099', 'New Seller Registration', 'This Seller Just Registered - josie', 'seller_details.php?sellerid=422099', '', '2020-03-12 15:24:12'),
(91, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-12 16:31:50', 'seller_details.php?sellerid=1111', '', '2020-03-12 15:31:50'),
(92, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-24 14:11:45', 'seller_details.php?sellerid=967815', '', '2020-03-24 13:11:45'),
(93, '967815', 'New Product Created!', 'A new product has been created by the !967815', 'product_details.php?productid=886071', '', '2020-03-24 13:51:41'),
(94, '779727', 'New Seller Registration', 'This Seller Just Registered - josie', 'seller_details.php?sellerid=779727', '', '2020-03-24 13:59:47'),
(95, '133157', 'New Seller Registration', 'This Seller Just Registered - sandra', 'seller_details.php?sellerid=133157', '', '2020-03-24 15:28:10'),
(96, '133157', 'sandra just logged in!', 'A Seller Logged in at  - 2020-03-24 16:30:18', 'seller_details.php?sellerid=133157', '', '2020-03-24 15:30:18'),
(97, '133157', 'sandra just logged in!', 'A Seller Logged in at  - 2020-03-24 16:30:44', 'seller_details.php?sellerid=133157', '', '2020-03-24 15:30:44'),
(98, '744996', 'New Seller Registration', 'This Seller Just Registered - nelson', 'seller_details.php?sellerid=744996', '', '2020-03-24 15:50:24'),
(99, '432542', 'New Seller Registration', 'This Seller Just Registered - kasjf', 'seller_details.php?sellerid=432542', '', '2020-03-24 15:55:01'),
(100, '463641', 'New Seller Registration', 'This Seller Just Registered - slfja', 'seller_details.php?sellerid=463641', '', '2020-03-24 15:56:20'),
(101, '524153', 'New Seller Registration', 'This Seller Just Registered - afsja', 'seller_details.php?sellerid=524153', '', '2020-03-24 15:59:13'),
(102, '365207', 'New Seller Registration', 'This Seller Just Registered - sandra', 'seller_details.php?sellerid=365207', '', '2020-03-24 16:02:38'),
(103, '102694', 'New Seller Registration', 'This Seller Just Registered - vivian', 'seller_details.php?sellerid=102694', '', '2020-03-24 16:12:12'),
(104, '365342', 'New Seller Registration', 'This Seller Just Registered - klafkk', 'seller_details.php?sellerid=365342', '', '2020-03-24 16:20:53'),
(105, '466526', 'New Seller Registration', 'This Seller Just Registered - klafklajklf', 'seller_details.php?sellerid=466526', '', '2020-03-24 16:21:27'),
(106, '825974', 'New Seller Registration', 'This Seller Just Registered - sandra', 'seller_details.php?sellerid=825974', '', '2020-03-24 16:23:38'),
(107, '825974', 'sandra just logged in!', 'A Seller Logged in at  - 2020-03-24 17:24:39', 'seller_details.php?sellerid=825974', '', '2020-03-24 16:24:39'),
(108, '825974', 'sandra just logged in!', 'A Seller Logged in at  - 2020-03-24 17:25:09', 'seller_details.php?sellerid=825974', '', '2020-03-24 16:25:09'),
(109, '825974', 'sandra just logged in!', 'A Seller Logged in at  - 2020-03-24 17:29:43', 'seller_details.php?sellerid=825974', '', '2020-03-24 16:29:43'),
(110, '1111', 'admin just logged in!', 'A Seller Logged in at  - 2020-03-24 17:38:29', 'seller_details.php?sellerid=1111', '', '2020-03-24 16:38:29'),
(111, '825974', 'sandra just logged in!', 'A Seller Logged in at  - 2020-03-24 17:38:47', 'seller_details.php?sellerid=825974', '', '2020-03-24 16:38:47'),
(112, '825974', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=825974', '', '2020-03-24 16:55:57'),
(113, '825974', 'sandra just logged in!', 'A Seller Logged in at  - 2020-03-24 17:56:17', 'seller_details.php?sellerid=825974', '', '2020-03-24 16:56:17'),
(114, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-24 18:06:29', 'seller_details.php?sellerid=967815', '', '2020-03-24 17:06:29'),
(115, '825974', 'sandra just logged in!', 'A Seller Logged in at  - 2020-03-24 18:10:54', 'seller_details.php?sellerid=825974', '', '2020-03-24 17:10:54'),
(116, '825974', 'Seller Added Account Details', 'A seller just updated his/her account details', 'seller_details.php?userid=825974', '', '2020-03-25 19:28:04'),
(117, '825974', 'New International Business Information Created', 'A new business information has been created!', 'seller_details.php?sellerid=825974', '', '2020-03-25 20:54:48'),
(118, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-25 22:48:27', 'seller_details.php?sellerid=967815', '', '2020-03-25 21:48:27'),
(119, '955308', 'New Seller Registration', 'This Seller Just Registered - vivian', 'seller_details.php?sellerid=955308', '', '2020-03-26 07:34:19'),
(120, '837838', 'New Seller Registration', 'This Seller Just Registered - vivian', 'seller_details.php?sellerid=837838', '', '2020-03-26 07:36:55'),
(121, '815094', 'New Seller Registration', 'This Seller Just Registered - vivian', 'seller_details.php?sellerid=815094', '', '2020-03-26 08:24:44'),
(122, '345363', 'New Buyer Registration', 'This Seller Just Registered - vivian', 'seller_details.php?sellerid=345363', '', '2020-03-26 08:29:29'),
(123, '345363', 'vivian just logged in!', 'A Seller Logged in at  - 2020-03-26 09:30:35', 'seller_details.php?sellerid=345363', '', '2020-03-26 08:30:35'),
(124, '536361', 'New Buyer Registration', 'This Seller Just Registered - vivian', 'seller_details.php?sellerid=536361', '', '2020-03-26 09:22:18'),
(125, '536361', 'vivian just logged in!', 'A Seller Logged in at  - 2020-03-26 10:22:57', 'seller_details.php?sellerid=536361', '', '2020-03-26 09:22:57'),
(126, '536361', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=536361', '', '2020-03-26 09:50:29'),
(127, '536361', 'vivian just logged in!', 'A Seller Logged in at  - 2020-03-26 10:50:42', 'seller_details.php?sellerid=536361', '', '2020-03-26 09:50:42'),
(128, '536361', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=536361', '', '2020-03-26 10:08:41'),
(129, '536361', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=536361', '', '2020-03-26 10:09:24'),
(130, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-26 11:50:32', 'seller_details.php?sellerid=967815', '', '2020-03-26 10:50:32'),
(131, '967815', 'josimar just logged in!', 'A Seller Logged in at  - 2020-03-26 12:13:03', 'seller_details.php?sellerid=967815', '', '2020-03-26 11:13:03'),
(132, '825974', 'sandra just logged in!', 'A Seller Logged in at  - 2020-03-26 12:14:54', 'seller_details.php?sellerid=825974', '', '2020-03-26 11:14:54'),
(133, '889140', 'New International Registration', 'This Seller Just Registered - dsthedragon', 'seller_details.php?sellerid=889140', '', '2020-03-27 12:51:10'),
(134, '889140', 'dsthedragon just logged in!', 'A Seller Logged in at  - 2020-03-27 13:53:24', 'seller_details.php?sellerid=889140', '', '2020-03-27 12:53:24'),
(135, '889140', 'dsthedragon just logged in!', 'A Seller Logged in at  - 2020-03-28 22:26:31', 'seller_details.php?sellerid=889140', '', '2020-03-28 21:26:31'),
(136, '889140', 'dsthedragon just logged in!', 'A Seller Logged in at  - 2020-03-28 22:27:15', 'seller_details.php?sellerid=889140', '', '2020-03-28 21:27:15'),
(137, '889140', 'dsthedragon just logged in!', 'A Seller Logged in at  - 2020-03-28 22:36:21', 'seller_details.php?sellerid=889140', '', '2020-03-28 21:36:21'),
(138, '889140', 'dsthedragon just logged in!', 'A Seller Logged in at  - 2020-03-30 22:01:24', 'seller_details.php?sellerid=889140', '', '2020-03-30 21:01:24'),
(139, 'all', 'New Brand Created!', 'A new brand has been added by the Admin. Explore!', 'brands.php', '', '2020-03-30 21:47:32'),
(140, 'all', 'New Brand Created!', 'A new brand has been added by the Admin. Explore!', 'brands.php', '', '2020-03-30 21:52:16'),
(141, '536361', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=536361', '', '2020-03-31 21:03:17'),
(142, '536361', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=536361', '', '2020-03-31 21:10:13'),
(143, '536361', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=536361', '', '2020-03-31 21:20:11'),
(144, '536361', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=536361', '', '2020-03-31 21:22:26'),
(145, '463156', 'New Sub Admin Registration', 'This Seller Just Registered - peterdon', 'seller_details.php?sellerid=463156', '', '2020-04-01 08:36:31'),
(146, '736324', 'New Sub Admin Registration', 'This Seller Just Registered - jameshaden', 'seller_details.php?sellerid=736324', '', '2020-04-01 08:44:43'),
(147, '749777', 'New Sub Admin Registration', 'This Seller Just Registered - johnwick', 'seller_details.php?sellerid=749777', '', '2020-04-01 08:52:56'),
(148, '715714', 'New Sub Admin Registration', 'This Seller Just Registered - sub@admin.com', 'seller_details.php?sellerid=715714', '', '2020-04-01 09:07:51'),
(149, '493061', 'New Sub Admin Registration', 'This Seller Just Registered - jameshaden', 'seller_details.php?sellerid=493061', '', '2020-04-01 09:10:48'),
(150, '568779', 'New Sub Admin Registration', 'This Seller Just Registered - johnwick', 'seller_details.php?sellerid=568779', '', '2020-04-01 09:13:06'),
(151, '403720', 'New Sub Admin Registration', 'This Seller Just Registered - johnwick', 'seller_details.php?sellerid=403720', '', '2020-04-01 09:14:05'),
(152, '403720', 'johnwick just logged in!', 'A Seller Logged in at  - 2020-04-01 10:20:34', 'seller_details.php?sellerid=403720', '', '2020-04-01 09:20:34'),
(153, '403720', 'johnwick just logged in!', 'A Seller Logged in at  - 2020-04-01 10:24:22', 'seller_details.php?sellerid=403720', '', '2020-04-01 09:24:22'),
(154, '403720', 'johnwick just logged in!', 'A Seller Logged in at  - 2020-04-01 10:25:15', 'seller_details.php?sellerid=403720', '', '2020-04-01 09:25:15'),
(155, '403720', 'johnwick just logged in!', 'A User Logged in at  - 2020-04-01 10:29:06', 'seller_details.php?sellerid=403720', '', '2020-04-01 09:29:06'),
(156, '403720', 'johnwick just logged in!', 'A User Logged in at  - 2020-04-01 10:30:48', 'seller_details.php?sellerid=403720', '', '2020-04-01 09:30:48'),
(157, '889140', 'dsthedragon just logged in!', 'A User Logged in at  - 2020-04-02 11:01:13', 'seller_details.php?sellerid=889140', '', '2020-04-02 10:01:13'),
(158, '889140', 'dsthedragon just logged in!', 'A User Logged in at  - 2020-04-02 16:07:52', 'seller_details.php?sellerid=889140', '', '2020-04-02 15:07:52'),
(159, '889140', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Basic', 'seller_details.php?sellerid=889140', '', '2020-04-02 15:25:11'),
(160, '889140', 'dsthedragon just logged in!', 'A User Logged in at  - 2020-04-02 16:25:47', 'seller_details.php?sellerid=889140', '', '2020-04-02 15:25:47'),
(161, '889140', 'Seller Added Account Details', 'A seller just updated his/her account details', 'seller_details.php?userid=889140', '', '2020-04-02 15:26:44'),
(162, '889140', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'seller_details.php?sellerid=889140', '', '2020-04-02 15:27:04'),
(163, '889140', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'seller_details.php?sellerid=889140', '', '2020-04-02 15:27:09'),
(164, '889140', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'seller_details.php?sellerid=889140', '', '2020-04-02 15:27:19'),
(165, '889140', 'New Product Created!', 'A new product has been created by the !889140', 'product_details.php?productid=330596', '', '2020-04-02 15:58:40'),
(166, '889140', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=889140', '', '2020-04-02 16:00:55'),
(167, '889140', 'dsthedragon just logged in!', 'A User Logged in at  - 2020-04-02 17:01:23', 'seller_details.php?sellerid=889140', '', '2020-04-02 16:01:23'),
(168, '889140', 'New Business Information Created', 'A new business information has been created!', 'seller_details.php?sellerid=889140', '', '2020-04-02 16:02:59'),
(169, '', 'New Agent Created', 'A new agent has been created!', 'agent_details.php?sellerid=85402031', '', '2020-04-03 11:49:58'),
(170, '403720', 'johnwick just logged in!', 'A User Logged in at  - 2020-04-03 12:50:33', 'seller_details.php?sellerid=403720', '', '2020-04-03 11:50:33'),
(171, '889140', 'dsthedragon just logged in!', 'A User Logged in at  - 2020-04-11 13:33:03', 'seller_details.php?sellerid=889140', '', '2020-04-11 12:33:03'),
(172, '889140', 'dsthedragon just logged in!', 'A User Logged in at  - 2020-04-13 11:11:40', 'seller_details.php?sellerid=889140', '', '2020-04-13 10:11:40'),
(173, '889140', 'dsthedragon just logged in!', 'A User Logged in at  - 2020-04-13 12:03:32', 'seller_details.php?sellerid=889140', '', '2020-04-13 11:03:32'),
(174, '889140', 'dsthedragon just logged in!', 'A User Logged in at  - 2020-04-13 12:05:39', 'seller_details.php?sellerid=889140', '', '2020-04-13 11:05:39'),
(175, '889140', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=889140', '', '2020-04-13 11:06:21'),
(176, '889140', 'dsthedragon just logged in!', 'A User Logged in at  - 2020-04-13 12:06:34', 'seller_details.php?sellerid=889140', '', '2020-04-13 11:06:34'),
(177, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-04-21 10:23:41', 'seller_details.php?sellerid=967815', '', '2020-04-21 09:23:41'),
(178, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-04-21 11:17:40', 'seller_details.php?sellerid=1111', '', '2020-04-21 10:17:40'),
(179, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-04-21 11:30:37', 'seller_details.php?sellerid=967815', '', '2020-04-21 10:30:37'),
(180, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-04-21 11:35:29', 'seller_details.php?sellerid=967815', '', '2020-04-21 10:35:29'),
(181, '124406', 'New International Registration', 'This Seller Just Registered - abbey', 'seller_details.php?sellerid=124406', '', '2020-04-23 08:54:37'),
(182, '20200423110415', 'New International Registration', 'This Seller Just Registered - abey', 'seller_details.php?sellerid=20200423110415', '', '2020-04-23 10:50:15'),
(183, '20200423010418', 'New International Registration', 'This Seller Just Registered - abbey', 'seller_details.php?sellerid=20200423010418', '', '2020-04-23 12:02:18'),
(184, '20200423010437', 'New International Registration', 'This Seller Just Registered - abey', 'seller_details.php?sellerid=20200423010437', '', '2020-04-23 12:11:37'),
(185, '20200423010446', 'New International Registration', 'This Seller Just Registered - abey', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 12:44:47'),
(186, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 14:18:16', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 13:18:16'),
(187, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 14:20:05', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 13:20:05'),
(188, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 14:25:26', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 13:25:26'),
(189, '20200423010446', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 13:36:03'),
(190, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 14:36:15', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 13:36:15'),
(191, '20200423010446', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=20200423010446', '', '2020-04-23 13:36:41'),
(192, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 14:36:50', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 13:36:50'),
(193, '20200423010446', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=20200423010446', '', '2020-04-23 13:39:27'),
(194, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 14:46:21', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 13:46:21'),
(195, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 14:48:14', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 13:48:14'),
(196, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 14:51:06', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 13:51:06'),
(197, '20200423010446', 'abey just logged in!', 'A Seller Logged in at  - 2020-04-23 17:12:49', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 16:12:49'),
(198, '20200423010446', 'New Business Information Created', 'A new business information has been created!', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 16:15:59'),
(199, '20200423010446', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=20200423010446', '', '2020-04-23 16:26:07'),
(200, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 20:27:57', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 19:27:57'),
(201, '20200423010446', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=20200423010446', '', '2020-04-23 19:32:54'),
(202, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-23 20:33:08', 'seller_details.php?sellerid=20200423010446', '', '2020-04-23 19:33:08'),
(203, '20200428120412', 'New International Registration', 'This Seller Just Registered - nelson', 'seller_details.php?sellerid=20200428120412', '', '2020-04-27 23:22:13'),
(204, '20200428120412', 'nelson just logged in!', 'A User Logged in at  - 2020-04-28 00:37:25', 'seller_details.php?sellerid=20200428120412', '', '2020-04-27 23:37:25'),
(205, '20200428120412', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=20200428120412', '', '2020-04-27 23:39:01'),
(206, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-28 00:59:32', 'seller_details.php?sellerid=20200423010446', '', '2020-04-27 23:59:32'),
(207, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-04-28 11:18:42', 'seller_details.php?sellerid=536361', '0', '2020-04-28 10:18:42'),
(208, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-04-28 12:55:03', 'seller_details.php?sellerid=536361', '0', '2020-04-28 11:55:03'),
(209, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-28 17:11:57', 'seller_details.php?sellerid=20200423010446', '0', '2020-04-28 16:11:57'),
(210, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-04-28 17:15:22', 'seller_details.php?sellerid=20200423010446', '0', '2020-04-28 16:15:22'),
(211, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-04-28 17:15:53', 'seller_details.php?sellerid=536361', '0', '2020-04-28 16:15:53'),
(212, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-04-28 17:16:09', 'seller_details.php?sellerid=536361', '0', '2020-04-28 16:16:09'),
(213, 'All', 'Public Dispute Submitted!', 'Able Concept just submitted a dispute request.', 'dispute_details.php?disputeid=200428080430', '0', '2020-04-28 19:05:30'),
(214, 'All', 'Public Dispute Submitted!', 'Able Concept just submitted a dispute request.', 'dispute_details.php?disputeid=200428080403', '0', '2020-04-28 19:23:03'),
(215, 'All', 'Public Dispute Submitted!', 'Able Concept just submitted a dispute request.', 'dispute_details.php?disputeid=200428080445', '0', '2020-04-28 19:24:45'),
(216, 'All', 'Public Dispute Submitted!', 'Able Concept just submitted a dispute request.', 'dispute_details.php?disputeid=200428080407', '0', '2020-04-28 19:54:07'),
(217, 'All', 'Public Dispute Submitted!', 'Able Concept just submitted a dispute request.', 'dispute_details.php?disputeid=200428090437', '0', '2020-04-28 20:04:37'),
(218, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-04-29 14:42:35', 'seller_details.php?sellerid=536361', '0', '2020-04-29 13:42:35'),
(219, '536361', 'New Dispute Created!', 'A new dispute has been created!', 'dispute_details.php?disputeid=331402', '0', '2020-04-29 16:28:02'),
(220, 'josimar [967815]', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'dispute_details.php?disputeid=331402', '0', '2020-04-29 16:28:02'),
(221, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-04-29 18:30:37', 'seller_details.php?sellerid=967815', '0', '2020-04-29 17:30:37'),
(222, '536361', 'New Dispute Created!', 'A new dispute has been created!', 'dispute_details.php?disputeid=283056', '0', '2020-04-29 18:06:14'),
(223, '889140', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'dispute_details.php?disputeid=283056', '0', '2020-04-29 18:06:14'),
(224, '967815', 'New Dispute Created!', 'A new dispute has been created!', 'dispute_details.php?disputeid=500057', '0', '2020-04-29 18:11:55'),
(225, '536361', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'dispute_details.php?disputeid=500057', '0', '2020-04-29 18:11:55'),
(226, '967815', 'New Dispute Created!', 'A new dispute has been created!', 'dispute_details.php?disputeid=588243', '0', '2020-04-29 18:16:22'),
(227, '825974', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'dispute_details.php?disputeid=588243', '0', '2020-04-29 18:16:22'),
(228, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-04-29 19:46:17', 'seller_details.php?sellerid=536361', '0', '2020-04-29 18:46:17'),
(229, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-04-29 19:46:50', 'seller_details.php?sellerid=536361', '0', '2020-04-29 18:46:50'),
(230, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-04-29 19:51:18', 'seller_details.php?sellerid=536361', '0', '2020-04-29 18:51:18'),
(231, '889140', 'New Message', 'jjosimar just sent you a message.', 'message_details.php?messid=20200430020443', '0', '2020-04-30 13:47:43'),
(232, '889140', 'New Message', 'jsoimar just sent you a message.', 'message_details.php?messid=20200430020404', '0', '2020-04-30 13:50:05'),
(233, '889140', 'New Message', 'josimar just sent you a message.', 'message_details.php?messid=20200430020423', '0', '2020-04-30 13:52:23'),
(234, '889140', 'New Review', 'dkksjaskflj just sent a review.', 'review_details.php?reviewid=20200430070432', '0', '2020-04-30 18:08:32'),
(235, '889140', 'New Review', 'Josimar Akpomudia just sent a review.', 'review_details.php?reviewid=20200430080434', '0', '2020-04-30 19:01:34'),
(236, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-04-30 20:36:22', 'seller_details.php?sellerid=967815', '0', '2020-04-30 19:36:22'),
(237, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-04-30 23:30:21', 'seller_details.php?sellerid=536361', '0', '2020-04-30 22:30:21'),
(238, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-01 12:56:57', 'seller_details.php?sellerid=967815', '0', '2020-05-01 11:56:57'),
(239, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-02 10:12:27', 'seller_details.php?sellerid=967815', '0', '2020-05-02 09:12:27'),
(240, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-02 22:01:35', 'seller_details.php?sellerid=967815', '0', '2020-05-02 21:01:35'),
(241, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-05-02 22:49:12', 'seller_details.php?sellerid=536361', '0', '2020-05-02 21:49:12'),
(242, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-03 11:14:29', 'seller_details.php?sellerid=967815', '0', '2020-05-03 10:14:29'),
(243, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-03 16:24:03', 'seller_details.php?sellerid=967815', '0', '2020-05-03 15:24:03'),
(244, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-03 16:32:14', 'seller_details.php?sellerid=967815', '0', '2020-05-03 15:32:14'),
(245, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-05-04 13:16:27', 'seller_details.php?sellerid=20200423010446', '0', '2020-05-04 12:16:27'),
(246, '967815', 'New Review', 'dafe just sent a review.', 'review_details.php?reviewid=20200504010512', '0', '2020-05-04 12:18:12'),
(247, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-04 13:19:10', 'seller_details.php?sellerid=1111', '0', '2020-05-04 12:19:10'),
(248, '20200428120412', 'nelson just logged in!', 'A User Logged in at  - 2020-05-04 16:05:57', 'seller_details.php?sellerid=20200428120412', '0', '2020-05-04 15:05:57'),
(249, '825974', 'sandra just logged in!', 'A User Logged in at  - 2020-05-04 16:07:01', 'seller_details.php?sellerid=825974', '0', '2020-05-04 15:07:01'),
(250, '20200423010446', 'abey just logged in!', 'A User Logged in at  - 2020-05-04 16:11:04', 'seller_details.php?sellerid=20200423010446', '0', '2020-05-04 15:11:04'),
(251, '825974', 'sandra just logged in!', 'A User Logged in at  - 2020-05-04 16:16:09', 'seller_details.php?sellerid=825974', '0', '2020-05-04 15:16:09'),
(252, '825974', 'sandra just logged in!', 'A User Logged in at  - 2020-05-04 16:20:18', 'seller_details.php?sellerid=825974', '0', '2020-05-04 15:20:18'),
(253, '825974', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'seller_details.php?sellerid=825974', '0', '2020-05-04 15:28:18'),
(254, '825974', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=825974', '0', '2020-05-04 15:35:33'),
(255, '825974', 'New Dispute Created!', 'A new dispute has been created!', 'dispute_details.php?disputeid=978856', '0', '2020-05-04 15:37:45'),
(256, '', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'dispute_details.php?disputeid=978856', '0', '2020-05-04 15:37:45'),
(257, '825974', 'New Dispute Created!', 'A new dispute has been created!', 'dispute_details.php?disputeid=171441', '0', '2020-05-04 15:39:52'),
(258, '20200428120412', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'dispute_details.php?disputeid=171441', '0', '2020-05-04 15:39:52'),
(259, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-06 18:39:12', 'seller_details.php?sellerid=967815', '0', '2020-05-06 17:39:12'),
(260, '967815', 'New Product Created!', 'A new product has been created by the !967815', 'product_details.php?productid=638605', '0', '2020-05-06 17:50:39'),
(261, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-05-06 19:56:36', 'seller_details.php?sellerid=536361', '0', '2020-05-06 18:56:36'),
(262, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-05-07 15:31:33', 'seller_details.php?sellerid=536361', '0', '2020-05-07 14:31:33'),
(263, '200508102305', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=', '0', '2020-05-08 09:29:23'),
(264, '200508100605', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=', '0', '2020-05-08 09:34:06'),
(265, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-05-08 14:30:11', 'seller_details.php?sellerid=536361', '0', '2020-05-08 13:30:11'),
(266, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-05-08 15:44:16', 'seller_details.php?sellerid=536361', '0', '2020-05-08 14:44:16'),
(267, '536361', 'New Message', 'vivian onome just sent you a message.', 'message_details.php?messid=20200510060557', '0', '2020-05-10 17:54:57'),
(268, '536361', 'New Message', 'vivian onome just sent you a message.', 'message_details.php?messid=20200510060517', '0', '2020-05-10 17:55:17'),
(269, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-10 19:04:38', 'seller_details.php?sellerid=967815', '0', '2020-05-10 18:04:38'),
(270, '967815', 'New Message', 'josimar akpomudia just sent you a message.', 'message_details.php?messid=20200510070503', '0', '2020-05-10 18:05:03'),
(271, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-05-10 19:12:23', 'seller_details.php?sellerid=536361', '0', '2020-05-10 18:12:23'),
(272, '536361', 'New Message', 'vivian onome just sent you a message.', 'message_details.php?messid=20200510070542', '0', '2020-05-10 18:14:42'),
(273, '536361', 'New Message', 'vivian onome just sent you a message.', 'message_details.php?messid=20200510070559', '0', '2020-05-10 18:14:59'),
(274, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-05-10 23:17:37', 'seller_details.php?sellerid=536361', '0', '2020-05-10 22:17:37'),
(275, '967815', 'New Review', 'sldfjlk just sent a review.', 'review_details.php?reviewid=20200511110543', '0', '2020-05-11 10:19:43'),
(276, '967815', 'New Review', 'sdfklasjd just sent a review.', 'review_details.php?reviewid=20200511110559', '0', '2020-05-11 10:21:59'),
(277, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-11 12:17:09', 'seller_details.php?sellerid=1111', '0', '2020-05-11 11:17:09'),
(278, '1111', 'New Review', 'Ojarh Admin just sent a review.', 'review_details.php?reviewid=20200511120531', '0', '2020-05-11 11:51:31'),
(279, '1111', 'New Review', 'Ojarh Admin just sent a review.', 'review_details.php?reviewid=20200511120520', '0', '2020-05-11 11:52:20'),
(280, '403720', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:15:34'),
(281, '403720', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:15:35'),
(282, '403720', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:15:36'),
(283, '403720', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:15:36'),
(284, '403720', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:15:37'),
(285, '403720', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:15:37'),
(286, '403720', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:15:59'),
(287, '403720', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:16:00'),
(288, '20200428120412', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=20200428120412', '0', '2020-05-11 12:16:13'),
(289, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=147195', '0', '2020-05-11 12:17:45'),
(290, '20200511010521', 'New Sub Admin Registration', 'This Seller Just Registered - sqt', 'seller_details.php?sellerid=20200511010521', '0', '2020-05-11 12:19:21'),
(291, '20200511010521', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=20200511010521', '0', '2020-05-11 12:19:36'),
(292, '20200511010521', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=20200511010521', '0', '2020-05-11 12:19:42'),
(293, '967815', 'Product Disapproved', 'Your product was not approved!', 'product_details.php?productid=275995', '0', '2020-05-11 12:20:29'),
(294, '967815', 'Product Approved', 'Your product has been approved!', 'product_details.php?productid=275995', '0', '2020-05-11 12:20:50'),
(295, 'all', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=507230', '0', '2020-05-11 12:30:29'),
(296, '889140', 'New Product Created!', 'A new product has been created by the !889140', 'product_details.php?productid=137864', '0', '2020-05-11 12:35:52'),
(297, '967815', 'Product Disapproved', 'Your product was not approved!', 'product_details.php?productid=638605', '0', '2020-05-11 12:38:34'),
(298, '967815', 'Product Approved', 'Your product has been approved!', 'product_details.php?productid=638605', '0', '2020-05-11 12:43:36'),
(299, '889140', 'Product Approved', 'Your product has been approved!', 'product_details.php?productid=137864', '0', '2020-05-11 12:43:39'),
(300, '20200423010446', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=20200423010446', '0', '2020-05-11 12:46:47'),
(301, '20200423010446', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=20200423010446', '0', '2020-05-11 12:46:52'),
(302, '20200428120412', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=20200428120412', '0', '2020-05-11 12:46:57'),
(303, '403720', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:53:54'),
(304, '403720', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:54:00'),
(305, '403720', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=403720', '0', '2020-05-11 12:54:02'),
(306, '536361', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=536361', '0', '2020-05-11 12:55:41'),
(307, '536361', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=536361', '0', '2020-05-11 12:55:42'),
(308, '536361', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=536361', '0', '2020-05-11 12:55:47'),
(309, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-05-11 14:01:06', 'seller_details.php?sellerid=536361', '0', '2020-05-11 13:01:06'),
(310, '825974', 'sandra just logged in!', 'A User Logged in at  - 2020-05-11 14:02:58', 'seller_details.php?sellerid=825974', '0', '2020-05-11 13:02:58'),
(311, '536361', 'vivian just logged in!', 'A User Logged in at  - 2020-05-11 14:09:28', 'seller_details.php?sellerid=536361', '0', '2020-05-11 13:09:28'),
(312, '967815', 'Seller Verification', 'We counld not verify your details, please re-submit the application!', 'seller_details.php?sellerid=967815', '0', '2020-05-11 13:27:23'),
(313, '967815', 'Seller Verification', 'Your account has been verified!', 'seller_details.php?sellerid=967815', '0', '2020-05-11 13:27:31'),
(314, '967815', 'Seller Verification', 'We counld not verify your details, please re-submit the application!', 'seller_details.php?sellerid=967815', '0', '2020-05-11 13:27:42'),
(315, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=171441', '0', '2020-05-11 13:31:43'),
(316, '20200428120412', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=171441', '0', '2020-05-11 13:31:43'),
(317, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=171441', '0', '2020-05-11 13:33:00'),
(318, '20200428120412', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=171441', '0', '2020-05-11 13:33:00'),
(319, '825974', 'RE: Dispute Resolved.', 'The dispute you raised has been resolved!', 'dispute_details.php?disputeid=171441', '0', '2020-05-11 13:35:57'),
(320, '20200428120412', 'RE: Dispute Resolved', 'The dispute against you has been resolved!', 'dispute_details.php?disputeid=171441', '0', '2020-05-11 13:35:57'),
(321, '85402031', 'Agent Activated', 'Your account has been activated!', 'agent_details.php?agentid=85402031', '0', '2020-05-11 13:40:25'),
(322, '889140', 'Product Disapproved', 'Your product was not approved!', 'product_details.php?productid=137864', '0', '2020-05-11 15:30:15'),
(323, '889140', 'Product Approved', 'Your product has been approved!', 'product_details.php?productid=137864', '0', '2020-05-11 15:30:23'),
(324, '20200511050557', 'New Seller Registration', 'This Seller Just Registered - jjj', 'seller_details.php?sellerid=20200511050557', '0', '2020-05-11 16:40:57'),
(325, '20200511050555', 'New International Registration', 'This Seller Just Registered - kjkfaj', 'seller_details.php?sellerid=20200511050555', '0', '2020-05-11 16:49:56');
INSERT INTO `notifications` (`id`, `userid`, `title`, `body`, `generatedlink`, `status`, `happen_at`) VALUES
(326, '20200511050501', 'New Buyer Registration', 'This Seller Just Registered - kjsfkldj', 'seller_details.php?sellerid=20200511050501', '0', '2020-05-11 16:52:01'),
(327, '20200511050535', 'New Seller Registration', 'This Seller Just Registered - kfajsdlf', 'seller_details.php?sellerid=20200511050535', '0', '2020-05-11 16:53:35'),
(328, '20200511050502', 'New International Registration', 'This Seller Just Registered - asdfakj', 'seller_details.php?sellerid=20200511050502', '0', '2020-05-11 16:59:02'),
(329, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=837101', '0', '2020-05-11 17:55:29'),
(330, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=305472', '0', '2020-05-11 17:56:11'),
(331, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=117125', '0', '2020-05-11 17:57:18'),
(332, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=353620', '0', '2020-05-11 17:58:59'),
(333, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=393775', '0', '2020-05-11 17:59:45'),
(334, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=335183', '0', '2020-05-11 18:01:07'),
(335, 'all', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=999695', '0', '2020-05-11 19:36:51'),
(336, 'all', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=776183', '0', '2020-05-11 19:38:15'),
(337, 'all', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=707739', '0', '2020-05-11 19:39:33'),
(338, '20200511010521', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=20200511010521', '0', '2020-05-11 22:07:43'),
(339, '889140', 'Product Disapproved', 'Your product was not approved!', 'product_details.php?productid=137864', '0', '2020-05-11 22:12:05'),
(340, '889140', 'Product Approved', 'Your product has been approved!', 'product_details.php?productid=137864', '0', '2020-05-11 22:12:10'),
(341, '20200511050501', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=20200511050501', '0', '2020-05-11 22:17:11'),
(342, '20200511050502', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=20200511050502', '0', '2020-05-11 22:17:22'),
(343, '20200511050557', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=20200511050557', '0', '2020-05-11 22:17:35'),
(344, '20200511050555', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=20200511050555', '0', '2020-05-11 22:17:36'),
(345, '20200511050535', 'Account Disapproved', 'Your account has been Disapproved!', 'seller_details.php?sellerid=20200511050535', '0', '2020-05-11 22:17:37'),
(346, '20200511010521', 'New Sub Admin Registration', 'A user\'s details has been updated', 'user_details.php?userid=20200511010521', '0', '2020-05-12 08:57:02'),
(347, '20200511050535', 'Account Approved', 'Your account has been activate!', 'seller_details.php?sellerid=20200511050535', '0', '2020-05-12 09:41:32'),
(348, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-12 11:39:14', 'seller_details.php?sellerid=1111', '0', '2020-05-12 10:39:14'),
(349, '889140', 'Product Disapproved', 'Your product was not approved!', 'product_details.php?productid=137864', '0', '2020-05-12 10:43:23'),
(350, '20200513020551', 'New Buyer Registration', 'This Seller Just Registered - buyer', 'seller_details.php?sellerid=20200513020551', '0', '2020-05-13 01:03:52'),
(351, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-13 02:05:14', 'seller_details.php?sellerid=20200513020551', '0', '2020-05-13 01:05:14'),
(352, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=674744', '0', '2020-05-13 03:20:59'),
(353, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=577466', '0', '2020-05-13 03:21:58'),
(354, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=611569', '0', '2020-05-13 03:23:28'),
(355, '20200513020551', 'New Dispute Created!', 'A new dispute has been created!', 'dispute_details.php?disputeid=555512', '0', '2020-05-13 03:30:05'),
(356, '20200513020551', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'dispute_details.php?disputeid=555512', '0', '2020-05-13 03:30:05'),
(357, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=814261', '0', '2020-05-13 03:37:19'),
(358, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=759697', '0', '2020-05-13 03:44:30'),
(359, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=292796', '0', '2020-05-13 03:54:41'),
(360, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=193011', '0', '2020-05-13 03:55:05'),
(361, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=739389', '0', '2020-05-13 03:56:15'),
(362, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=430389', '0', '2020-05-13 03:58:36'),
(363, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=163477', '0', '2020-05-13 04:00:11'),
(364, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=354472', '0', '2020-05-13 04:00:21'),
(365, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=319539', '0', '2020-05-13 04:00:22'),
(366, '20200513100557', 'New International Registration', 'This Seller Just Registered - international', 'seller_details.php?sellerid=20200513100557', '0', '2020-05-13 09:06:08'),
(367, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-13 10:17:06', 'seller_details.php?sellerid=20200513100557', '0', '2020-05-13 09:17:06'),
(368, '20200513110550', 'New Seller Registration', 'This Seller Just Registered - testadmin', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 10:12:52'),
(369, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-13 11:13:42', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 10:13:42'),
(370, '20200513110550', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 10:14:34'),
(371, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-13 11:14:53', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 10:14:53'),
(372, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-13 12:13:58', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 11:13:58'),
(373, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-13 15:45:34', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 14:45:34'),
(374, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-13 22:31:09', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 21:31:09'),
(375, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-13 22:34:45', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 21:34:45'),
(376, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-13 22:38:28', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 21:38:28'),
(377, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-13 23:06:59', 'seller_details.php?sellerid=20200513020551', '0', '2020-05-13 22:06:59'),
(378, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'messageing.php?messid=634410', '0', '2020-05-13 22:10:34'),
(379, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-13 23:28:53', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 22:28:53'),
(380, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-14 00:13:26', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 23:13:26'),
(381, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-14 00:18:25', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-13 23:18:25'),
(382, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=934981', '0', '2020-05-13 23:20:38'),
(383, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-14 21:03:12', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-14 20:03:12'),
(384, '20200513110550', 'New Message', 'Elijah1 Okokon just sent you a message.', 'message_details.php?messid=20200515010542', '0', '2020-05-15 00:42:42'),
(385, '20200513110550', 'New Message', 'Elijah1 Okokon just sent you a message.', 'message_details.php?messid=20200515010501', '0', '2020-05-15 00:43:01'),
(386, '20200513110550', 'New Message', 'Elijah1 Okokon just sent you a message.', 'message_details.php?messid=20200515010532', '0', '2020-05-15 00:54:32'),
(387, '20200513110550', 'New Message', 'Elijah1 Okokon just sent you a message.', 'message_details.php?messid=20200515010500', '0', '2020-05-15 00:57:00'),
(388, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=858221', '0', '2020-05-15 01:14:06'),
(389, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=646318', '0', '2020-05-15 01:15:41'),
(390, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=790246', '0', '2020-05-15 01:29:20'),
(391, '20200513110550', 'New Message', 'Elijah1 Okokon just sent you a message.', 'message_details.php?messid=20200515020523', '0', '2020-05-15 01:30:23'),
(392, '20200513110550', 'New Message', 'Elijah1 Okokon just sent you a message.', 'message_details.php?messid=20200515020509', '0', '2020-05-15 01:36:09'),
(393, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=540726', '0', '2020-05-15 01:38:10'),
(394, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=975954', '0', '2020-05-15 01:39:12'),
(395, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=375693', '0', '2020-05-15 01:41:36'),
(396, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=116474', '0', '2020-05-15 01:41:40'),
(397, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=234695', '0', '2020-05-15 01:41:45'),
(398, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=284646', '0', '2020-05-15 01:44:40'),
(399, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=383698', '0', '2020-05-15 01:46:09'),
(400, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=593887', '0', '2020-05-15 01:46:27'),
(401, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=725063', '0', '2020-05-15 01:47:04'),
(402, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=481008', '0', '2020-05-15 01:47:09'),
(403, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=353661', '0', '2020-05-15 01:47:28'),
(404, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=246658', '0', '2020-05-15 01:47:31'),
(405, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=334276', '0', '2020-05-15 01:49:34'),
(406, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=836379', '0', '2020-05-15 01:50:05'),
(407, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=587731', '0', '2020-05-15 01:58:37'),
(408, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=484848', '0', '2020-05-15 01:58:41'),
(409, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=890357', '0', '2020-05-15 02:03:14'),
(410, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=909299', '0', '2020-05-15 02:03:18'),
(411, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=626591', '0', '2020-05-15 02:03:37'),
(412, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=279637', '0', '2020-05-15 02:04:15'),
(413, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=887697', '0', '2020-05-15 02:07:40'),
(414, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=591009', '0', '2020-05-15 02:07:45'),
(415, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=623678', '0', '2020-05-15 02:15:52'),
(416, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=675206', '0', '2020-05-15 02:16:58'),
(417, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=793261', '0', '2020-05-15 02:18:21'),
(418, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=610343', '0', '2020-05-15 02:19:45'),
(419, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=433576', '0', '2020-05-15 02:22:21'),
(420, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=625681', '0', '2020-05-15 02:24:59'),
(421, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=262561', '0', '2020-05-15 02:33:11'),
(422, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=388991', '0', '2020-05-15 02:43:47'),
(423, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-15 08:43:31', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-15 07:43:31'),
(424, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-15 08:56:23', 'seller_details.php?sellerid=1111', '0', '2020-05-15 07:56:23'),
(425, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=171441', '0', '2020-05-15 07:57:11'),
(426, '20200428120412', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=171441', '0', '2020-05-15 07:57:11'),
(427, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-15 09:01:35', 'seller_details.php?sellerid=1111', '0', '2020-05-15 08:01:35'),
(428, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:02:28'),
(429, '967815', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:02:28'),
(430, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:05:19'),
(431, '967815', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:05:19'),
(432, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:06:25'),
(433, '967815', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:06:25'),
(434, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:08:29'),
(435, '967815', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:08:29'),
(436, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:28:32'),
(437, '967815', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:28:32'),
(438, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:31:26'),
(439, '967815', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=331402', '0', '2020-05-15 08:31:26'),
(440, '1111', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'dispute_details.php?disputeid=283056', '0', '2020-05-15 09:02:40'),
(441, '889140', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'dispute_details.php?disputeid=283056', '0', '2020-05-15 09:02:40'),
(442, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-15 10:59:37', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-15 09:59:37'),
(443, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-15 11:13:53', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-15 10:13:53'),
(444, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-15 17:24:08', 'seller_details.php?sellerid=20200513020551', '0', '2020-05-15 16:24:08'),
(445, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-16 06:51:30', 'seller_details.php?sellerid=20200513020551', '0', '2020-05-16 05:51:30'),
(446, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-16 10:26:26', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-16 09:26:26'),
(447, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-16 10:28:55', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-16 09:28:55'),
(448, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-16 10:54:18', 'seller_details.php?sellerid=20200513020551', '0', '2020-05-16 09:54:18'),
(449, '20200513020551', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'seller_details.php?sellerid=20200513020551', '0', '2020-05-16 09:56:07'),
(450, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-16 10:56:28', 'seller_details.php?sellerid=20200513020551', '0', '2020-05-16 09:56:28'),
(451, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-16 11:27:13', 'seller_details.php?sellerid=20200513020551', '0', '2020-05-16 10:27:13'),
(452, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-16 11:57:52', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-16 10:57:52'),
(453, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-16 14:33:43', 'seller_details.php?sellerid=20200513110550', '0', '2020-05-16 13:33:43'),
(454, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=944388', '0', '2020-05-16 13:40:41'),
(455, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=523094', '0', '2020-05-16 13:53:08'),
(456, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=529967', '0', '2020-05-16 13:59:04'),
(457, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=532734', '0', '2020-05-16 13:59:38'),
(458, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=573587', '0', '2020-05-16 14:00:48'),
(459, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=933457', '0', '2020-05-16 14:08:48'),
(460, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=654503', '0', '2020-05-16 14:12:44'),
(461, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=593604', '0', '2020-05-16 14:15:27'),
(462, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=776928', '0', '2020-05-16 14:29:40'),
(463, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=112420', '0', '2020-05-16 14:36:19'),
(464, '20200513110550', 'New Message', 'Elijah1 Okokonjust sent you a message.', 'messageing.php?messid=321916', '0', '2020-05-16 14:37:37'),
(465, '20200513110550', 'New Message', 'Elijah1 Okokon just sent you a message.', 'http://localhost:3000/message_details.php?messid=20200516050519', '0', '2020-05-16 16:10:19'),
(466, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-16 17:11:27', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-16 16:11:27'),
(467, '967815', 'New Product Created!', 'A new product has been created by the !967815', '\'.BASE_URL.\'product_details.php?productid=140685', '0', '2020-05-16 16:18:14'),
(468, 'all', 'New Market Created!', 'A new market has been created by the Admin. Explore!', 'market_setting.php?marketid=778294', '0', '2020-05-16 16:40:02'),
(469, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-17 08:10:33', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-17 07:10:33'),
(470, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-17 08:52:14', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-17 07:52:14'),
(471, '20200513110550', 'Seller Added Account Details', 'A seller just updated his/her account details', 'http://localhost:3000/seller_details.php?userid=20200513110550', '0', '2020-05-17 07:53:00'),
(472, '20200513110550', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-17 07:54:11'),
(473, '20200513110550', 'New Product Created!', 'A new product has been created by the !20200513110550', 'http://localhost:3000/product_details.php?productid=283850', '0', '2020-05-17 07:55:28'),
(474, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-17 09:01:03', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-17 08:01:03'),
(475, '20200513110550', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-17 08:55:48'),
(476, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-17 14:06:55', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-17 13:06:55'),
(477, '20200513110550', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-17 13:36:57'),
(478, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-17 14:40:53', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-17 13:40:53'),
(479, '20200513110550', 'Product Approved', 'Your product has been approved!', 'http://localhost:3000/product_details.php?productid=283850', '0', '2020-05-17 13:46:29'),
(480, '1111', 'New Message', 'Ojarh Adminjust sent you a message.', 'http://localhost:3000/messaging.php?messid=641345', '0', '2020-05-17 14:02:21'),
(481, '1111', 'New Message', 'Ojarh Admin just sent you a message.', 'http://localhost:3000/message_details.php?messid=20200517030531', '0', '2020-05-17 14:02:31'),
(482, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-18 17:24:24', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-18 16:24:24'),
(483, '20200513110550', 'New Review', 'Elijah Okokon just sent a review.', 'http://localhost:3000/review_details.php?reviewid=20200518050509', '0', '2020-05-18 16:27:09'),
(484, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-19 10:42:38', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-19 09:42:38'),
(485, '20200513100557', 'Seller Account Upgraded', 'A Seller just upgraded his/her account to: Premium', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-19 09:43:16'),
(486, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-19 10:43:46', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-19 09:43:46'),
(487, '20200513100557', 'Seller Added Account Details', 'A seller just updated his/her account details', 'http://localhost:3000/seller_details.php?userid=20200513100557', '0', '2020-05-19 09:46:43'),
(488, '20200513100557', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-19 09:50:19'),
(489, '20200513100557', 'New Product Created!', 'A new product has been created by the !20200513100557', 'http://localhost:3000/product_details.php?productid=979079', '0', '2020-05-19 09:53:17'),
(490, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-19 11:10:52', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-19 10:10:52'),
(491, '20200513100557', 'New Product Created!', 'A new product has been created by the !20200513100557', 'http://localhost:3000/product_details.php?productid=571663', '0', '2020-05-19 10:22:05'),
(492, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-19 11:35:03', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-19 10:35:03'),
(493, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-20 04:28:17', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-20 03:28:17'),
(494, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-20 11:12:34', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-20 10:12:34'),
(495, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-20 13:11:47', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-20 12:11:47'),
(496, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-20 13:26:20', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-20 12:26:20'),
(497, '20200513100557', 'Product Approved', 'Your product has been approved!', 'http://localhost:3000/product_details.php?productid=571663', '0', '2020-05-20 12:27:15'),
(498, '20200513100557', 'Product Approved', 'Your product has been approved!', 'http://localhost:3000/product_details.php?productid=979079', '0', '2020-05-20 12:28:07'),
(499, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-20 17:11:30', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-20 16:11:30'),
(500, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-20 17:40:07', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-20 16:40:07'),
(501, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-20 21:05:16', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-20 20:05:16'),
(502, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-21 01:07:43', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-21 00:07:43'),
(503, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-21 07:07:00', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-21 06:07:00'),
(504, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-21 07:15:29', 'http://localhost:3000/seller_details.php?sellerid=20200513020551', '0', '2020-05-21 06:15:29'),
(505, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-21 09:34:40', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-21 08:34:40'),
(506, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-21 09:55:52', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-21 08:55:52'),
(507, '1111', 'New Message', 'Ojarh Admin just sent you a message.', 'http://localhost:3000/message_details.php?messid=20200521070533', '0', '2020-05-21 18:05:33'),
(508, '1111', 'New Message', 'Ojarh Adminjust sent you a message.', 'http://localhost:3000/messaging.php?messid=243951', '0', '2020-05-21 18:09:09'),
(509, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-22 20:10:33', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-22 19:10:33'),
(510, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-23 01:57:22', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-23 00:57:22'),
(511, '967815', 'New Review', 'Elijah Okokon just sent a review.', 'http://localhost:3000/review_details.php?reviewid=20200523030508', '0', '2020-05-23 14:22:10'),
(512, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-23 15:27:55', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-23 14:27:55'),
(513, '20200513110550', 'New Business Information Created', 'A new business information has been created!', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-23 14:29:15'),
(514, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-23 18:33:34', 'http://localhost:3000/seller_details.php?sellerid=20200513020551', '0', '2020-05-23 17:33:34'),
(515, '20200513020551', 'New Dispute Created!', 'A new dispute has been created!', 'http://localhost:3000/dispute_details.php?disputeid=375309', '0', '2020-05-23 17:36:04'),
(516, '20200513100557', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'http://localhost:3000/dispute_details.php?disputeid=375309', '0', '2020-05-23 17:36:04'),
(517, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-23 18:55:32', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-23 17:55:32'),
(518, '20200513110550', 'New Review', 'Elijah Okokon just sent a review.', 'http://localhost:3000/review_details.php?reviewid=20200523070537', '0', '2020-05-23 18:42:37'),
(519, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'http://localhost:3000/message_details.php?messid=20200523070510', '0', '2020-05-23 18:58:10'),
(520, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'http://localhost:3000/message_details.php?messid=20200523070539', '0', '2020-05-23 18:58:39'),
(521, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'http://localhost:3000/message_details.php?messid=20200523070544', '0', '2020-05-23 18:58:44'),
(522, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'http://localhost:3000/message_details.php?messid=20200523080525', '0', '2020-05-23 19:18:25'),
(523, '20200513020551', 'New Profile Picture Update', 'A user just update his/her profile picture!', 'user_details?userid=20200513020551', '0', '2020-05-23 19:50:33'),
(524, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-23 21:03:09', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-23 20:03:09'),
(525, '20200513110550', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-23 20:09:10'),
(526, '20200513110550', 'New Product Created!', 'A new product has been created by the !20200513110550', 'http://localhost:3000/product_details.php?productid=310258', '0', '2020-05-23 21:53:55'),
(527, '20200513110550', 'New Product Created!', 'A new product has been created by the !20200513110550', 'http://localhost:3000/product_details.php?productid=370481', '0', '2020-05-24 08:42:13'),
(528, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-24 10:33:03', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-24 09:33:03'),
(529, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-24 10:44:55', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-24 09:44:55'),
(530, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-24 13:42:33', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-24 12:42:33'),
(531, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-24 13:46:14', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-24 12:46:14'),
(532, '20200513110550', 'New Review', 'Elijah1 Okokon just sent a review.', 'http://localhost:3000/review_details.php?reviewid=20200524010559', '0', '2020-05-24 12:46:59'),
(533, '20200513110550', 'New Review', 'Elijah1 Okokon just sent a review.', 'http://localhost:3000/review_details.php?reviewid=20200524010528', '0', '2020-05-24 12:47:29'),
(534, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-24 13:48:18', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-24 12:48:18'),
(535, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-24 16:45:38', 'http://localhost:3000/seller_details.php?sellerid=20200513100557', '0', '2020-05-24 15:45:38'),
(536, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-24 16:52:47', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-24 15:52:47'),
(537, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-26 03:26:06', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-26 02:26:06'),
(538, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-26 03:29:41', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-26 02:29:41'),
(539, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-26 04:29:37', 'http://localhost:3000/seller_details.php?sellerid=1111', '0', '2020-05-26 03:29:37'),
(540, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-26 11:00:51', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-26 10:00:51'),
(541, '20200513110550', 'testadmin just logged in!', 'A User Logged in at  - 2020-05-26 12:28:55', 'http://localhost:3000/seller_details.php?sellerid=20200513110550', '0', '2020-05-26 11:28:55'),
(542, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-26 17:31:03', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-26 16:31:03'),
(543, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-26 17:46:22', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=1111', '0', '2020-05-26 16:46:22'),
(544, '20200526060528', 'New Buyer Registration', 'This Seller Just Registered - buyer3', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200526060528', '0', '2020-05-26 17:31:28'),
(545, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-26 18:32:35', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-26 17:32:35'),
(546, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-26 18:33:17', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-26 17:33:17'),
(547, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-26 18:41:15', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-26 17:41:15'),
(548, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-26 18:47:09', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-26 17:47:09'),
(549, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-26 20:18:47', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-26 19:18:47'),
(550, '967815', 'New Review', 'Elijah Okokon just sent a review.', 'https://ui.codtrix.com/ojarh_new/review_details.php?reviewid=20200526080512', '0', '2020-05-26 19:22:12'),
(551, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-26 20:41:02', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-26 19:41:02'),
(552, '20200513100557', 'A Seller Create a Catalogue', 'A seller just created a Catalogue!', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-26 19:48:51'),
(553, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-05-26 20:54:24', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=1111', '0', '2020-05-26 19:54:24'),
(554, 'all', 'New Category Created!', 'A new category has been created by the Admin. Explore!', 'product_category.php?catid=358307', '0', '2020-05-26 19:58:22'),
(555, '20200513110550', 'Product Approved', 'Your product has been approved!', 'https://ui.codtrix.com/ojarh_new/product_details.php?productid=310258', '0', '2020-05-26 20:29:01'),
(556, '20200513110550', 'Product Approved', 'Your product has been approved!', 'https://ui.codtrix.com/ojarh_new/product_details.php?productid=370481', '0', '2020-05-26 20:29:10'),
(557, '20200513100557', 'New Review', 'Elijah Okokon just sent a review.', 'https://ui.codtrix.com/ojarh_new/review_details.php?reviewid=20200526090552', '0', '2020-05-26 20:48:52'),
(558, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-26 21:50:51', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-26 20:50:51'),
(559, '20200513100557', 'New Review', 'Elijah3 Okokon just sent a review.', 'https://ui.codtrix.com/ojarh_new/review_details.php?reviewid=20200526090522', '0', '2020-05-26 20:53:22'),
(560, 'All', 'Public Dispute Submitted!', 'h just submitted a dispute request.', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=200527010513', '0', '2020-05-27 00:01:13'),
(561, 'All', 'Public Dispute Submitted!', 'h just submitted a dispute request.', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=200527010540', '0', '2020-05-27 00:02:40'),
(562, '', 'New Agent Created', 'A new agent has been created!', 'agent_details.php?sellerid=18653047', '0', '2020-05-27 00:13:26'),
(563, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-27 01:27:52', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-27 00:27:52'),
(564, '20200513020551', 'New Dispute Created!', 'A new dispute has been created!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=785924', '0', '2020-05-27 00:40:33'),
(565, '', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=785924', '0', '2020-05-27 00:40:33'),
(566, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'https://ui.codtrix.com/ojarh_new/message_details.php?messid=20200527010513', '0', '2020-05-27 00:42:13'),
(567, 'All', 'Public Dispute Submitted!', 'Elijah Okokon just submitted a dispute request.', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=200527110559', '0', '2020-05-27 10:29:59'),
(568, 'All', 'Public Dispute Submitted!', 'Elijah Okokon just submitted a dispute request.', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=200527110502', '0', '2020-05-27 10:42:02'),
(569, 'All', 'Public Dispute Submitted!', 'Elijah Okokon just submitted a dispute request.', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=200527110550', '0', '2020-05-27 10:45:50'),
(570, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-27 17:52:33', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-27 16:52:33'),
(571, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-27 20:35:03', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-27 19:35:03'),
(572, '20200513020551', 'New Dispute Created!', 'A new dispute has been created!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=964248', '0', '2020-05-27 19:37:32'),
(573, '20200513020551', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=964248', '0', '2020-05-27 19:37:32'),
(574, '20200513020551', 'New Dispute Created!', 'A new dispute has been created!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=613732', '0', '2020-05-27 19:38:01'),
(575, '', 'A Dispute Ticket Against You!', 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=613732', '0', '2020-05-27 19:38:01'),
(576, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-27 21:15:33', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-27 20:15:33'),
(577, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-27 21:52:49', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-27 20:52:49'),
(578, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-28 12:29:52', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-28 11:29:52'),
(579, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-28 16:18:24', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-28 15:18:24'),
(580, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-28 16:19:05', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-28 15:19:05'),
(581, '20200513100557', 'New Product Created!', 'A new product has been created by the !20200513100557', 'https://ui.codtrix.com/ojarh_new/product_details.php?productid=722464', '0', '2020-05-28 15:24:44'),
(582, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-28 16:46:20', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-28 15:46:20'),
(583, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-28 17:17:40', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-28 16:17:40'),
(584, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-28 18:33:40', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-28 17:33:40'),
(585, '20200513100557', 'New Review', 'Elijah3 Okokon just sent a review.', 'https://ui.codtrix.com/ojarh_new/review_details.php?reviewid=20200528060514', '0', '2020-05-28 17:38:14'),
(586, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-30 12:57:42', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-30 11:57:42'),
(587, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-30 14:59:34', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-30 13:59:34'),
(588, '20200530030551', 'New Buyer Registration', 'This Seller Just Registered - tester', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200530030551', '0', '2020-05-30 14:05:52'),
(589, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-30 15:11:33', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-30 14:11:33'),
(590, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-30 15:28:27', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-30 14:28:27'),
(591, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-30 16:30:36', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-30 15:30:36'),
(592, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-30 16:31:00', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-30 15:31:00'),
(593, '967815', 'New Product Created!', 'A new product has been created by the !967815', 'https://ui.codtrix.com/ojarh_new/product_details.php?productid=907819', '0', '2020-05-30 15:37:02'),
(594, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-30 16:47:13', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-30 15:47:13'),
(595, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-30 16:51:25', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-30 15:51:25'),
(596, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-30 17:05:02', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-30 16:05:02'),
(597, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'https://ui.codtrix.com/ojarh_new/message_details.php?messid=20200530050547', '0', '2020-05-30 16:05:47'),
(598, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'https://ui.codtrix.com/ojarh_new/message.php?messid=683773', '0', '2020-05-30 16:06:04'),
(599, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'https://ui.codtrix.com/ojarh_new/message_details.php?messid=20200530050545', '0', '2020-05-30 16:06:45'),
(600, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-05-30 17:24:21', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-05-30 16:24:21'),
(601, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-31 00:07:47', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-30 23:07:47'),
(602, '20200513020551', 'New Message', 'Elijah2 Okokon2just sent you a message.', 'https://ui.codtrix.com/ojarh_new/message.php?messid=259229', '0', '2020-05-30 23:08:07'),
(603, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-31 00:11:09', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-30 23:11:09'),
(604, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'https://ui.codtrix.com/ojarh_new/message_details.php?messid=20200531120507', '0', '2020-05-30 23:13:07'),
(605, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'https://ui.codtrix.com/ojarh_new/message_details.php?messid=20200531120556', '0', '2020-05-30 23:13:56'),
(606, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-31 00:17:41', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-30 23:17:41'),
(607, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-05-31 00:19:28', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-05-30 23:19:28'),
(608, '20200513020551', 'New Message', 'Elijah2 Okokon2 just sent you a message.', 'https://ui.codtrix.com/ojarh_new/message_details.php?messid=20200531120551', '0', '2020-05-30 23:20:51'),
(609, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-31 00:40:12', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-30 23:40:12'),
(610, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-31 00:43:15', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-30 23:43:15'),
(611, '967815', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=331402', '0', '2020-05-30 23:56:13'),
(612, '967815', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=331402', '0', '2020-05-30 23:56:13'),
(613, '967815', 'RE: Your Dispute Ticket Response', 'You got a response from the dispute ticket u created!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=331402', '0', '2020-05-30 23:56:25');
INSERT INTO `notifications` (`id`, `userid`, `title`, `body`, `generatedlink`, `status`, `happen_at`) VALUES
(614, '967815', 'RE: Dispute Response Against You', 'A dispute ticket has been opened against you!', 'https://ui.codtrix.com/ojarh_new/dispute_details.php?disputeid=331402', '0', '2020-05-30 23:56:25'),
(615, '967815', 'New Business Information Updated', 'A new business information has been created!', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-30 23:57:58'),
(616, '967815', 'New Business Information Updated', 'A new business information has been created!', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-30 23:58:11'),
(617, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-05-31 18:16:33', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-05-31 17:16:33'),
(618, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-06-25 11:02:44', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-06-25 10:02:44'),
(619, '20200513020551', 'Order Status', 'Your Order status has been changed to Delivered', '#', '0', '2020-06-25 10:35:53'),
(620, '20200513020551', 'buyer just logged in!', 'A User Logged in at  - 2020-06-25 12:01:55', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513020551', '0', '2020-06-25 11:01:55'),
(621, '967815', 'josimar just logged in!', 'A User Logged in at  - 2020-06-25 12:26:28', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=967815', '0', '2020-06-25 11:26:28'),
(622, '1111', 'admin just logged in!', 'A User Logged in at  - 2020-06-30 16:53:46', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=1111', '0', '2020-06-30 15:53:46'),
(623, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-06-30 16:54:29', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-06-30 15:54:29'),
(624, '20200513100557', 'Seller Verification', 'A seller just submitted a ticket for verification!', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-06-30 15:55:22'),
(625, '20200513100557', 'international just logged in!', 'A User Logged in at  - 2020-06-30 17:02:46', 'https://ui.codtrix.com/ojarh_new/seller_details.php?sellerid=20200513100557', '0', '2020-06-30 16:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL,
  `orderid` text NOT NULL,
  `userid` text NOT NULL,
  `sellerid` text NOT NULL,
  `orders` text NOT NULL,
  `currency` text NOT NULL,
  `location` text NOT NULL,
  `cost` text NOT NULL,
  `pay_status` text NOT NULL,
  `status` varchar(20) DEFAULT 'awaiting approval',
  `pickup_code` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `orderid`, `userid`, `sellerid`, `orders`, `currency`, `location`, `cost`, `pay_status`, `status`, `pickup_code`, `order_date`) VALUES
(1, '200512010522', '536361', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'abudabi, Dubai, Albania, 8933939', '0', 'Pay on delivery', 'awaiting approval', '173892', '2020-05-12 12:52:22'),
(2, '200512010545', '536361', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'abudabi, Dubai, Albania, 8933939', '0', 'Pay on delivery', 'awaiting approval', '585491', '2020-05-12 12:52:45'),
(3, '200512010511', '536361', '967815', '{\"886071\":{\"qty\":\"1\",\"pack_type\":\"1@3883838@8\",\"total_price\":\"3573130.96\"},\"275995\":{\"qty\":\"1\",\"pack_type\":\"3@100000@5\",\"total_price\":\"95000\"},\"638605\":{\"qty\":\"1\",\"pack_type\":\"9@123456@1\",\"total_price\":\"122221.44\"}}', 'N', 'abudabi, Dubai, Austria, 232233', '3668130.96', 'Pay on delivery', 'awaiting approval', '635976', '2020-05-12 12:58:11'),
(4, '200512020522', '536361', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'abudabi, Dubai, Aruba, fdldl', '0', 'Pay on delivery', 'awaiting approval', '458631', '2020-05-12 13:43:22'),
(5, '200518050550', '1111', '20200513110550', '{\"283850\":{\"qty\":\"7\",\"pack_type\":\"6@20@022\",\"total_price\":\"109.2\"}}', 'N', 'Utako, Abuja, Unknown, ', '109.2', 'Pay with Card', 'awaiting approval', '876408', '2020-05-18 16:11:50'),
(6, '200518060504', '20200513110550', '20200513110550', '{\"283850\":{\"qty\":\"24\",\"pack_type\":\"6@20@022\",\"total_price\":\"374.4\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Unknown, ', '374.4', 'Pay with Card', 'awaiting approval', '35428', '2020-05-18 17:29:04'),
(7, '200520020502', '1111', '20200513100557', '{\"979079\":{\"qty\":\"1\",\"pack_type\":\"5@300@3\",\"total_price\":\"291\"}}', '$', 'Utako, Abuja, Unknown, ', '291', 'Pay with Card', 'awaiting approval', '193996', '2020-05-20 13:06:02'),
(8, '200520040540', '1111', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'Utako, Abuja, Unknown, ', '28', 'Pay with Card', 'awaiting approval', '350728', '2020-05-20 15:11:40'),
(9, '200520040520', '1111', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'Utako, Abuja, Unknown, ', '28', 'Pay with Card', 'awaiting approval', '922150', '2020-05-20 15:46:20'),
(10, '200520040555', '1111', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'Utako, Abuja, Unknown, ', '28', 'Pay with Card', 'awaiting approval', '217664', '2020-05-20 15:47:55'),
(11, '200520040557', '1111', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'Utako, Abuja, Unknown, ', '28', 'Pay with Card', 'awaiting approval', '977045', '2020-05-20 15:51:57'),
(12, '200520040527', '1111', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'Utako, Abuja, Unknown, ', '28', 'Pay with Card', 'awaiting approval', '218322', '2020-05-20 15:52:27'),
(13, '200520040545', '1111', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'Utako, Abuja, Unknown, ', '28', 'Pay with Card', 'awaiting approval', '556529', '2020-05-20 15:53:45'),
(14, '200520050555', '1111', '889140', '{\"330596\":{\"qty\":\"3\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"84\"}}', '$', 'Utako, Abuja, Unknown, ', '84', 'Pay with Card', 'awaiting approval', '979460', '2020-05-20 16:12:55'),
(15, '200520050546', '1111', '889140', '{\"330596\":{\"qty\":\"3\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"84\"}}', '$', 'Utako, Abuja, Unknown, ', '84', 'Pay with Card', 'awaiting approval', '9985', '2020-05-20 16:17:46'),
(16, '200520050520', '1111', '889140', '{\"330596\":{\"qty\":\"3\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"84\"}}', '$', 'Utako, Abuja, Unknown, ', '84', 'Pay with Card', 'awaiting approval', '734349', '2020-05-20 16:20:20'),
(17, '200520050542', '1111', '889140', '{\"330596\":{\"qty\":\"3\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"84\"}}', '$', 'Utako, Abuja, Unknown, ', '84', 'Pay with Card', 'awaiting approval', '56546', '2020-05-20 16:22:42'),
(18, '200520050502', '1111', '889140', '{\"330596\":{\"qty\":\"3\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"84\"}}', '$', 'Utako, Abuja, Unknown, ', '84', 'Pay with Card', 'awaiting approval', '842039', '2020-05-20 16:24:02'),
(19, '200520050506', '1111', '889140', '{\"330596\":{\"qty\":\"3\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"84\"}}', '$', 'Utako, Abuja, Unknown, ', '84', 'Pay with Card', 'awaiting approval', '791122', '2020-05-20 16:26:06'),
(20, '200520050552', '1111', '889140', '{\"330596\":{\"qty\":\"3\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"84\"}}', '$', 'Utako, Abuja, Unknown, ', '84', 'Pay with Card', 'awaiting approval', '686967', '2020-05-20 16:28:52'),
(21, '200521110516', '1111', '967815', '{\"638605\":{\"qty\":\"1\",\"pack_type\":0,\"total_price\":\"123456\"}}', 'N', 'Utako, Abuja, Unknown, ', '123456', 'Pay with Card', 'awaiting approval', '295944', '2020-05-21 10:38:16'),
(22, '200526040558', '20200513110550', '20200513110550', '{\"283850\":{\"qty\":\"4\",\"pack_type\":\"6@20@022\",\"total_price\":\"62.4\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Unknown, ', '62.4', 'Pay with Card', 'awaiting approval', '90503', '2020-05-26 03:01:58'),
(23, '200528050550', '20200513020551', '20200513100557', '{\"979079\":{\"qty\":\"3\",\"pack_type\":\"5@300@3\",\"total_price\":\"873\"}}', '$', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '873', 'Pay on delivery', 'awaiting approval', '514022', '2020-05-28 16:26:50'),
(24, '200528050500', '20200513020551', '20200513100557', '{\"979079\":{\"qty\":\"3\",\"pack_type\":\"5@300@3\",\"total_price\":\"873\"}}', '$', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '873', 'Pay on delivery', 'awaiting approval', '680731', '2020-05-28 16:27:00'),
(25, '200528050500', '20200513100557', '967815', '{\"886071\":{\"qty\":\"2\",\"pack_type\":\"3@899898@8\",\"total_price\":\"1655812.32\"},\"638605\":{\"qty\":\"3\",\"pack_type\":\"9@123456@1\",\"total_price\":\"366664.32\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '2022476.64', 'Pay on delivery', 'awaiting approval', '673970', '2020-05-28 16:36:00'),
(26, '200530040529', '20200513020551', '967815', '{\"886071\":{\"qty\":\"2\",\"pack_type\":\"3@899898@8\",\"total_price\":\"1655812.32\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '1655812.32', 'Pay on delivery', 'awaiting approval', '768548', '2020-05-30 15:18:29'),
(27, '200530040533', '20200513020551', '967815', '{\"886071\":{\"qty\":\"2\",\"pack_type\":\"3@899898@8\",\"total_price\":\"1655812.32\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '1655812.32', 'Pay on delivery', 'awaiting approval', '686104', '2020-05-30 15:18:33'),
(28, '200530040536', '20200513020551', '967815', '{\"886071\":{\"qty\":\"2\",\"pack_type\":\"3@899898@8\",\"total_price\":\"1655812.32\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '1655812.32', 'Pay on delivery', 'awaiting approval', '27354', '2020-05-30 15:18:36'),
(29, '200530040542', '20200513020551', '967815', '{\"886071\":{\"qty\":\"2\",\"pack_type\":\"3@899898@8\",\"total_price\":\"1655812.32\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '1655812.32', 'Pay on delivery', 'awaiting approval', '740508', '2020-05-30 15:18:42'),
(30, '200530040544', '20200513020551', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"1@@0\",\"total_price\":\"40\"}}', '$', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '40', 'Pay on delivery', 'awaiting approval', '618906', '2020-05-30 15:18:44'),
(31, '200530050559', '20200513020551', '967815', '{\"275995\":{\"qty\":\"0\",\"pack_type\":\"Choose...@@\",\"total_price\":\"0\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '0', 'Pay on delivery', 'awaiting approval', '961747', '2020-05-30 16:26:59'),
(32, '200530050503', '20200513020551', '967815', '{\"275995\":{\"qty\":\"0\",\"pack_type\":\"Choose...@@\",\"total_price\":\"0\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '0', 'Pay on delivery', 'awaiting approval', '100024', '2020-05-30 16:27:03'),
(33, '200530050533', '20200513100557', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '28', 'Pay on delivery', 'awaiting approval', '77034', '2020-05-30 16:27:33'),
(34, '200530060559', '', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Pack@40@30\",\"total_price\":\"28\"}}', '$', 'Plot 2, house 39, Owode Estate Extension, Apata,, Ibadan, Nigeria, +23401', '28', 'Pay on delivery', 'awaiting approval', '430545', '2020-05-30 17:03:59'),
(35, '200530060527', '', '967815', '{\"638605\":{\"qty\":\"2\",\"pack_type\":\"9@123456@1\",\"total_price\":\"244442.88\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Ibadan, Nigeria, +23401', '244442.88', 'Pay on delivery', 'awaiting approval', '135495', '2020-05-30 17:04:27'),
(36, '200531120527', '20200513020551', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Choose...@@\",\"total_price\":\"0\"}}', '$', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '0', 'Pay on delivery', 'awaiting approval', '696308', '2020-05-30 23:18:27'),
(37, '200531120535', '20200513020551', '889140', '{\"330596\":{\"qty\":\"1\",\"pack_type\":\"Choose...@@\",\"total_price\":\"0\"}}', '$', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '0', 'Pay on delivery', 'awaiting approval', '735198', '2020-05-30 23:18:35'),
(38, '200531120535', '20200513020551', '20200513110550', '{\"310258\":{\"qty\":\"1\",\"pack_type\":\"1@@0\",\"total_price\":\"7\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '7', 'Pay on delivery', 'awaiting approval', '911711', '2020-05-30 23:24:35'),
(39, '200531120532', '20200513020551', '967815', '{\"140685\":{\"qty\":\"0\",\"pack_type\":\"Choose...@@\",\"total_price\":\"0\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '0', 'Pay on delivery', 'delivered', '727625', '2020-05-30 23:38:32'),
(40, '200531120501', '20200513020551', '20200513110550', '{\"310258\":{\"qty\":\"1\",\"pack_type\":\"1@@0\",\"total_price\":\"7\"}}', 'N', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '7', 'Pay with Card', 'awaiting approval', '71334', '2020-05-30 23:39:01');

-- --------------------------------------------------------

--
-- Table structure for table `order_temp`
--

CREATE TABLE `order_temp` (
  `id` int(10) NOT NULL,
  `orderid` text NOT NULL,
  `sellerid` text NOT NULL,
  `productid` text NOT NULL,
  `packaging` text NOT NULL,
  `qty` text NOT NULL,
  `subtotal` text NOT NULL,
  `status` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `transid` text NOT NULL,
  `userid` text NOT NULL,
  `task` text NOT NULL,
  `paymentto` text NOT NULL,
  `startDate` text NOT NULL,
  `endDate` text NOT NULL,
  `ugraded_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `transid`, `userid`, `task`, `paymentto`, `startDate`, `endDate`, `ugraded_on`) VALUES
(4, '607883', '967815', 'Account Upgrade', 'Admin', '2020-03-02', '2020-04-01', '2020-03-02 19:33:02'),
(5, '451858', '967815', 'Account Upgrade', 'Admin', '2020-03-02', '2020-04-01', '2020-03-02 19:34:44'),
(6, '371931', '967815', 'Account Upgrade', 'Admin', '2020-03-06', '2020-04-05', '2020-03-06 14:33:06'),
(7, '354431', '825974', 'Account Upgrade', 'Admin', '2020-03-24', '2020-04-23', '2020-03-24 16:55:57'),
(8, '935796', '889140', 'Account Upgrade', 'Admin', '2020-04-02', '2020-05-02', '2020-04-02 15:25:11'),
(9, '146835', '889140', 'Account Upgrade', 'Admin', '2020-04-02', '2020-09-29', '2020-04-02 16:00:55'),
(10, '638376', '889140', 'Account Upgrade', 'Admin', '2020-04-13', '2021-04-13', '2020-04-13 11:06:21'),
(11, '837324', '20200423010446', 'Account Upgrade', 'Admin', '2020-04-23', '2021-04-23', '2020-04-23 13:36:03'),
(12, '269897', '20200513110550', 'Account Upgrade', 'Admin', '2020-05-13', '2021-05-13', '2020-05-13 10:14:34'),
(13, '887620', '20200513020551', 'Account Upgrade', 'Admin', '2020-05-16', '2020-11-12', '2020-05-16 09:56:07'),
(14, '506723', '20200513100557', 'Account Upgrade', 'Admin', '2020-05-19', '2021-05-19', '2020-05-19 09:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `payout_request`
--

CREATE TABLE `payout_request` (
  `id` int(11) NOT NULL,
  `userid` bigint(20) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `accountname` varchar(45) NOT NULL,
  `accountnumber` varchar(45) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payout_request`
--

INSERT INTO `payout_request` (`id`, `userid`, `amount`, `status`, `accountname`, `accountnumber`, `description`) VALUES
(1, 20200513100557, 70, 'Approved', '', '', NULL),
(2, 20200513100557, 70, 'Disapproved', '', '', NULL),
(3, 967815, 100, 'Pending', 'Canj', '00000', 'Test'),
(4, 967815, 100, 'Pending', 'Canj', '00000', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `productid` text NOT NULL,
  `userid` text NOT NULL,
  `product_title` text NOT NULL,
  `market` text NOT NULL,
  `countryorigin` text NOT NULL,
  `expiration` text NOT NULL,
  `performance` text NOT NULL,
  `size` text DEFAULT NULL,
  `color` text DEFAULT NULL,
  `product_category` text NOT NULL,
  `product_catalogue` text NOT NULL,
  `product_type` varchar(45) DEFAULT NULL,
  `product_description` text NOT NULL,
  `pack0` text DEFAULT NULL,
  `pack1` text DEFAULT NULL,
  `pack2` text DEFAULT NULL,
  `pack3` text DEFAULT NULL,
  `pack4` text DEFAULT NULL,
  `pack5` text DEFAULT NULL,
  `pack6` text DEFAULT NULL,
  `pack7` text DEFAULT NULL,
  `pack8` text DEFAULT NULL,
  `img0` text DEFAULT NULL,
  `img1` text DEFAULT NULL,
  `img2` text DEFAULT NULL,
  `img3` text DEFAULT NULL,
  `img4` text DEFAULT NULL,
  `img5` text DEFAULT NULL,
  `img6` text DEFAULT NULL,
  `status` text NOT NULL,
  `productavailability` text NOT NULL,
  `topCatSetting` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `productid`, `userid`, `product_title`, `market`, `countryorigin`, `expiration`, `performance`, `size`, `color`, `product_category`, `product_catalogue`, `product_type`, `product_description`, `pack0`, `pack1`, `pack2`, `pack3`, `pack4`, `pack5`, `pack6`, `pack7`, `pack8`, `img0`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `status`, `productavailability`, `topCatSetting`, `created_at`) VALUES
(1, '275995', '967815', '41inch Television', '323474', '[\"[\"]', '12', 'Excellent', '41inch', 'black, grey', 'Electrical Appliances', '', NULL, '&lt;p&gt;&lt;strong&gt;We are here just to provide more&lt;/strong&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;resources to all undergraduates, postgraduates and all tertiary students.We are here just to provide more resources to all undergraduates, postgraduates and all tertiary students.We are here just to provide more resources to all undergraduates, postgraduates and all tertiary students.We are here just to provide more resources to all undergraduates, postgraduates and all tertiary students.We are here just to provide more resources to all undergraduates, postgraduates and all tertiary students.We are here just to provide more resources to all undergraduates, postgraduates and all tertiary students.We are here just to provide more resources to all undergraduates, postgraduates and all tertiary students.&lt;/p&gt;', '3@100000@5', '5@210000@0', '6@350000@2', '0', '0', '0', '0', '0', '0', '275995-ads1.jpg', '', '', '', '', '', '', 'Active', 'In Stock', 0, '2020-02-24 18:00:47'),
(2, '886071', '967815', 'ajsfkj', '985258', '[\"Albania\"]', '3', 'High', '8', 'red', 'Automobile and Spare Parts', '', NULL, '&lt;p&gt;Just checking&lt;/p&gt;', '1@3883838@8', '3@899898@8', '5@8989898989@8', '6@89898989@8', NULL, NULL, NULL, NULL, NULL, '886071-120X60.jpg', '886071-171270200X200.jpg', '886071-42865300X100.jpg', '886071-470326300X250.jpg', NULL, NULL, NULL, 'Active', 'In Stock', 1, '2020-03-24 13:51:41'),
(3, '330596', '889140', 'Engine Block', '454373', '[\"Nigeria\"]', '100', 'High', '20,30,40', 'red,blue,orange', 'Automobile and Spare Parts', '', NULL, '&lt;p&gt;descriptions&lt;/p&gt;', 'Pack@40@30', '3@432323@2', '3@432323@2', NULL, NULL, NULL, NULL, NULL, NULL, '330596-2_1a342131-dbfd-4a82-bfc5-fa47bbc68416_500x500_crop_center.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'In Stock', 1, '2020-04-02 15:58:39'),
(4, '638605', '967815', 'kjfaskf', '985258', '[\"Albania\"]', '2', 'Medium', '12,13,14,15', 'red,blue,yellow', 'Automobile &amp; Spare Parts', '850413', NULL, '&lt;p&gt;This is to check if its working?&lt;/p&gt;&lt;p&gt;Hope it does&lt;/p&gt;', '9@123456@1', '3@432323@2', '5@232323@2', NULL, NULL, NULL, NULL, NULL, NULL, '638605-IMG_20191127_081134.jpg', '638605-494307IMG_20191127_081134.jpg', NULL, NULL, NULL, NULL, NULL, 'Active', 'Out of Stock', 1, '2020-05-06 17:50:39'),
(5, '137864', '889140', 'askdfja', '131294', '[\"Afghanistan\"]', '10', 'High', '8, 9, 10, 11, 12', 'Red, Black', 'Electrical Appliances', '', NULL, 'This product is just to test if this is working\r\n', 'Pack@20000@5', '3@432323@2', '03@432323@2', '0', '0', '0', '0', '0', '0', '137864-iot.jpeg', '137864-470079AVI.png', '', '', '', '', '', 'Inactive', 'Out of Stock', 1, '2020-05-11 12:35:52'),
(6, '140685', '967815', 'Car', '131294', '[\"Algeria\"]', '78', 'Low', '12', 'red', 'Fashion and Jewery', '850413', '', '&lt;p&gt;pro&lt;/p&gt;', '6@78@78', '0', '0', '0', '0', '0', '0', '0', '0', '', '140685-604031lexus-es350-1.jpg', '', '', '', '', '', 'Active', 'In Stock', 0, '2020-05-16 16:18:14'),
(7, '283850', '20200513110550', '41inch Television2 hey2', '131294', '[\"\",\"Algeria\"]', '12', 'Medium', '12', 'red', 'Fashion and Jewery', '993067', 'Wears', '&lt;p&gt;this product&lt;/p&gt;', '6@20@022', '0', '0', '0', '0', '0', '0', '0', '0', '283850-5.jpg', '283850-450100ads2.jpg', '283850-878999slide1.jpg', '283850-682805b2.jpg', '283850-199496bag.png', '', '', 'Active', 'In Stock', 0, '2020-05-17 07:55:28'),
(8, '979079', '20200513100557', 'international product', '131294', '[\"Armenia\"]', '12', 'High', '33,22,44', 'red', 'Fashion and Jewery', '949198', NULL, '&lt;p&gt;test&lt;/p&gt;', '5@300@3', '0', '0', '0', '0', '0', '0', '0', '0', '979079-bag.png', '', '', '', '', '', '', 'Active', 'In Stock', 0, '2020-05-19 09:53:17'),
(9, '571663', '20200513100557', '41inch Television2', '131294', '[\"[\"]', '11', 'Medium', '11', 'red', 'Fashion and Jewery', '949198', NULL, '&lt;p&gt;te&lt;/p&gt;', '3@22@110', '0', '0', '0', '0', '0', '0', '0', '0', '', '571663-3651856.jpg', '', '', '', '', '', 'Active', 'In Stock', 0, '2020-05-19 10:22:05'),
(10, '310258', '20200513110550', 'new product', '985258', '[\"Albania\",\"American Samoa\"]', '23', 'High', '23', 'red', 'Automobile &amp; Spare Parts', '105949', 'Wears', '&lt;p&gt;new&lt;/p&gt;', 'Pack@7@7', '0', '0', '0', '0', '0', '0', '0', '0', '310258-6.jpg', '', '', '', '', '', '', 'Active', 'In Stock', 0, '2020-05-23 21:53:55'),
(11, '370481', '20200513110550', 'new product ', '778294', '[\"Algeria\"]', '12', 'Very High', '12', 'red', 'Electrical Appliances', '993067', 'Things', '&lt;p&gt;test&lt;/p&gt;', '9+800+10', '0', '0', '0', '0', '0', '0', '0', '0', '370481-e.png', '', '', '', '', '', '', 'Active', 'In Stock', 0, '2020-05-24 08:42:13'),
(12, '722464', '20200513100557', 'new pages', '985258', '[\"American Samoa\"]', '23', 'Very High', '22', 'red', 'Automobile &amp; Spare Parts', '949198', 'Wears', '&lt;p&gt;a new product&lt;/p&gt;', '5+233+5', '0', '0', '0', '0', '0', '0', '0', '0', '722464-1.jpeg', '722464-8041086.jpg', '722464-462338bag.png', '', '', '', '', 'Pending', 'In Stock', 0, '2020-05-28 15:24:44'),
(13, '907819', '967815', 'test', '454373', '[\"Nigeria\"]', '12', 'Very High', '200', 'Black', 'Automobile &amp; Spare Parts', '850413', 'Car', '&lt;p&gt;A very sleek car&lt;/p&gt;', '1+500000+2', '0', '0', '0', '0', '0', '0', '0', '0', '907819-lexus-es350-front.jpg', '', '', '', '', '', '', 'Pending', 'In Stock', 0, '2020-05-30 15:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `profilepic`
--

CREATE TABLE `profilepic` (
  `id` int(11) NOT NULL,
  `userid` text NOT NULL,
  `file_name` text NOT NULL,
  `status` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profilepic`
--

INSERT INTO `profilepic` (`id`, `userid`, `file_name`, `status`, `created_on`) VALUES
(6, '825264', '825264-390.jpg', '1', '2020-02-08 16:42:52'),
(5, '590768', '590768-anna.jpg', '1', '2020-02-07 16:31:43'),
(4, '849871', '849871-anna.jpg', '1', '2020-02-06 12:19:57'),
(7, '644448', '644448-anna.jpg', '1', '2020-02-11 17:44:30'),
(8, '967815', '967815-IMG_20191125_181418_691.jpg', '1', '2020-02-24 17:35:04'),
(9, '536361', '536361-390.jpg', '1', '2020-03-26 09:50:29'),
(10, '20200423010446', '20200423010446-390.jpg', '1', '2020-04-23 13:36:41'),
(11, '20200428120412', '20200428120412-IMG_20191125_181418_691.jpg', '1', '2020-04-27 23:39:01'),
(12, '825974', '825974-IMG_20191125_181418_691.jpg', '1', '2020-05-04 15:35:33'),
(13, '20200513020551', '20200513020551-glasses.png', '1', '2020-05-23 19:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `public_dispute`
--

CREATE TABLE `public_dispute` (
  `id` int(11) NOT NULL,
  `disputeid` text NOT NULL,
  `complainer_fullname` text NOT NULL,
  `complainer_email` text NOT NULL,
  `complainer_phone` text NOT NULL,
  `against` text NOT NULL,
  `subject_request` text NOT NULL,
  `message_inform` text NOT NULL,
  `status` text NOT NULL,
  `evidencefile` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `public_dispute`
--

INSERT INTO `public_dispute` (`id`, `disputeid`, `complainer_fullname`, `complainer_email`, `complainer_phone`, `against`, `subject_request`, `message_inform`, `status`, `evidencefile`, `date_created`) VALUES
(1, '200428080407', 'Able Concept', 'info@ableconceptestate.com', '08033261238', 'josimar-967815', 'askdfj', 'kljlkjkl', 'Pending', '', '2020-04-28 19:54:07'),
(2, '200428090437', 'Able Concept', 'info@ableconceptestate.com', '08033261238', 'josimar-967815', 'alksdjf', 'aksdjfl', 'Pending', '200428090437-IMG_20190388_122658.JPG', '2020-04-28 20:04:37'),
(3, '200527010513', 'h', 'ug@gmail.com', '0812345678', 'h', 'test', 'test', 'Pending', '200527010513-', '2020-05-27 00:01:13'),
(4, '200527010540', 'h', 'ug@gmail.com', '0812345678', 'h', 'test', 'test', 'Pending', '200527010540-afang-soup.jpg', '2020-05-27 00:02:40'),
(5, '200527110559', 'Elijah Okokon', 'okoelijah@gmail.com', '2348150685555', 'international-20200513100557', 'i have a compalon', 'test', 'Pending', '200527110559-', '2020-05-27 10:29:59'),
(6, '200527110502', 'Elijah Okokon', 'okoelijah@gmail.com', '2348150685555', 'international-20200513100557', 'i have a compalon', 'test', 'Pending', '200527110502-', '2020-05-27 10:42:02'),
(7, '200527110550', 'Elijah Okokon', 'okoelijah@gmail.com', '2348150685555', 'international-20200513100557', 'i have a compalon', 'test', 'Pending', '200527110550-', '2020-05-27 10:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `quick_ordertbl`
--

CREATE TABLE `quick_ordertbl` (
  `id` int(11) NOT NULL,
  `orderid` text NOT NULL,
  `sellerid` text NOT NULL,
  `productcategory` text NOT NULL,
  `productid` text NOT NULL,
  `quantity` text NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `delivery_address` text NOT NULL,
  `order_description` text NOT NULL,
  `date_ordered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quick_ordertbl`
--

INSERT INTO `quick_ordertbl` (`id`, `orderid`, `sellerid`, `productcategory`, `productid`, `quantity`, `fullname`, `email`, `phone`, `delivery_address`, `order_description`, `date_ordered`) VALUES
(1, '200508102305', '967815', 'Electrical Appliances', '275995', '3', 'josimar', 'skldfj@gmail.com', '939393939', 'laksjdfkalfj', 'klfjaskldfj asdfkl asjdlfkas jd', '2020-05-08 09:29:23'),
(2, '200508100605', '967815', 'Electrical Appliances', '275995', '2', 'klajdfklaj', 'klasdjf@mail.com', '338383', 'lkasjdfkl', 'jfkalsdfjakl', '2020-05-08 09:34:06'),
(3, '200521011005', '20200513110550', 'Fashion and Jewery', '41inch Television2 hey2', '1', 'Elijah Okokon', 'okoelijah@gmail.com', '', 'Plot 2, house 39, Owode Estate Extension, Apata,', 'test', '2020-05-21 12:20:10'),
(4, '200527015705', '20200511050535', '', '', '2', 'ghbvn ', 'hbn@gmail.com', '1111', 'f', '  h', '2020-05-27 00:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `sn` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `store_name` text NOT NULL,
  `store_description` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `title` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` text NOT NULL,
  `state` text NOT NULL,
  `market` text NOT NULL,
  `address` text NOT NULL,
  `status` text NOT NULL,
  `confCode` text NOT NULL,
  `role` text NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`sn`, `storeid`, `store_name`, `store_description`, `email`, `password`, `title`, `fname`, `lname`, `phone`, `state`, `market`, `address`, `status`, `confCode`, `role`, `date_reg`) VALUES
(3, 688669, 'Josimar Stores', 'Sales of Phones, Computers and Gadgets', 'renownjosimar@gmail.com', '663bdd99acd39fbcc56c7b329eac1a482b3268c663d6acb49847a18f6745932a', 'Mr', 'josimar', 'akpomudia', '08070814814', '1', 'Ojoo Market', 'shop 445, ojoo market', '1', '483203', 'Seller', '2020-01-03 23:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `video_link` varchar(255) NOT NULL,
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `video_link`, `updated`) VALUES
(0, 'https://www.youtube.com/embed/7HgGiCK33ow', '2020-05-26 12:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `submit_review_db`
--

CREATE TABLE `submit_review_db` (
  `id` int(11) NOT NULL,
  `reviewid` text NOT NULL,
  `productid` text NOT NULL,
  `userid` text NOT NULL,
  `reply` text DEFAULT NULL,
  `r_name` text NOT NULL,
  `r_email` text NOT NULL,
  `rating` text NOT NULL,
  `r_title` text NOT NULL,
  `r_body` text NOT NULL,
  `status` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submit_review_db`
--

INSERT INTO `submit_review_db` (`id`, `reviewid`, `productid`, `userid`, `reply`, `r_name`, `r_email`, `rating`, `r_title`, `r_body`, `status`, `date_created`) VALUES
(1, '20200430080434', '330596', '889140', NULL, 'Josimar Akpomudia', 'josimar@gmail.com', '2', 'Great Product', 'This is a great product', 'Approved', '2020-04-30 19:01:34'),
(2, '20200504010512', '275995', '967815', NULL, 'dafe', 'dafe@gmail.com', '3', 'testing', 'This is just to test if this is working fine', 'Approved', '2020-05-04 12:18:12'),
(3, '20200511110543', '886071', '967815', NULL, 'sldfjlk', 'lskdfj@Gklasdjf.com', '5', 'klasjdflk', 'jflkajsdflkj', 'Approved', '2020-05-11 10:19:43'),
(4, '20200511110559', '886071', '967815', NULL, 'sdfklasjd', 'lkfjasdlf', '3', 'kasljdflk', 'jfalksdfj', 'Approved', '2020-05-11 10:21:59'),
(5, '20200511120531', '886071', '1111', '3', 'Ojarh Admin', 'admin@ojarh.com', '', 'Admin', 'this is to test', 'Approved', '2020-05-11 11:51:31'),
(6, '20200511120520', '275995', '1111', '2', 'Ojarh Admin', 'admin@ojarh.com', '', 'Admin', 'This is confirmed', 'Approved', '2020-05-11 11:52:20'),
(7, '20200518050509', '283850', '20200513110550', NULL, 'Elijah Okokon', 'okoelijah@gmail.com', '2', 'i love this', 'nice', 'Approved', '2020-05-18 16:27:09'),
(8, '20200523030508', '638605', '967815', NULL, 'Elijah Okokon', 'okoelijah@gmail.com', '2', 'nice', 'thanks', 'Approved', '2020-05-23 14:22:08'),
(9, '20200523070537', '283850', '20200513110550', NULL, 'Elijah Okokon', 'okoelijah@gmail.com', '2', 'nice but try better', 'test', 'Approved', '2020-05-23 18:42:37'),
(10, '20200524010559', '283850', '20200513110550', '20200523070537', 'Elijah1 Okokon', 'okoelijah2@gmail.com', 'Error, field(s) cannot be empty!', 'Seller', 'thanks now', 'Approved', '2020-05-24 12:46:59'),
(11, '20200524010528', '283850', '20200513110550', '20200518050509', 'Elijah1 Okokon', 'okoelijah2@gmail.com', 'Error, field(s) cannot be empty!', 'Seller', 'also a good work thanks', 'Approved', '2020-05-24 12:47:28'),
(12, '20200526080512', '886071', '967815', NULL, 'Elijah Okokon', 'okoelijah@gmail.com', '3', 'TEST', 'GOOD', 'Pending', '2020-05-26 19:22:12'),
(13, '20200526090552', '979079', '20200513100557', NULL, 'Elijah Okokon', 'okoelijah@gmail.com', '5', 'nice bag, i love it', 'its nice and okay. thanks', 'Approved', '2020-05-26 20:48:52'),
(14, '20200526090522', '979079', '20200513100557', '20200526090552', 'Elijah3 Okokon', 'okoelijah4@gmail.com', 'Error, field(s) cannot be empty!', 'Seller', 'nice thanks', 'Pending', '2020-05-26 20:53:22'),
(15, '20200528060514', '979079', '20200513100557', '20200526090552', 'Elijah3 Okokon', 'okoelijah4@gmail.com', 'Error, field(s) cannot be empty!', 'Seller', 'Thanks ', 'Pending', '2020-05-28 17:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `email`) VALUES
(1, 'fklasdjf@gmail.com'),
(2, 'dzle@gmail.com'),
(3, 'hey@gmail.com'),
(4, 'me@gmail.com'),
(5, 'faaa@gmail.com'),
(6, 'ju@gmail.com'),
(7, 'ty@gmail.com'),
(8, 'd@gmail.com'),
(9, 'fklasdjf@gmail.com'),
(10, 'fklasdjf@gmail.com'),
(11, 'angella@gmail.com'),
(15, 'jjj@gmail.com'),
(14, ''),
(16, ''),
(17, 'renownjosimar2@gmail.com'),
(18, 'renownjosimar2@gmail.com'),
(19, 'lkajfs@gmail.com'),
(20, 'lkajfs@gmail.com'),
(21, 'info@ojarh.com'),
(22, 'dafegeorge@gmail.com'),
(23, 'askljsdf@gmail.com'),
(24, 'kfdkalsdjf@gm.com'),
(25, 'alksdfj@gmail.com'),
(26, 'klajdfl@gm.com'),
(27, 'hjhjhjh@gmail.com'),
(28, 'U@GMAIL.COM'),
(29, 'uglory');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `payer` varchar(45) DEFAULT NULL,
  `payee` varchar(45) DEFAULT NULL,
  `productid` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `payer`, `payee`, `productid`, `amount`, `status`, `details`) VALUES
(1, NULL, NULL, '330596', NULL, 'COMPLETED', '{\"create_time\":\"2020-05-20T16:25:16Z\",\"update_time\":\"2020-05-20T16:26:03Z\",\"id\":\"2H447882SS637331P\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-b0sfw1835607@personal.example.com\",\"payer_id\":\"3AU87TRZBG36L\",\"address\":{\"country_code\":\"US\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"reference_id\":\"default\",\"custom_id\":\"889140\",\"amount\":{\"value\":\"84.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-ufl0j1838988@business.example.com\",\"merchant_id\":\"HLV3UJL8X9UZG\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"9U271059GV433812J\",\"final_capture\":\"true\",\"create_time\":\"2020-05-20T16:26:03Z\",\"update_time\":\"2020-05-20T16:26:03Z\",\"amount\":{\"value\":\"84.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/9U271059GV433812J\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/9U271059GV433812J\\/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/2H447882SS637331P\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/2H447882SS637331P\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sn` int(11) NOT NULL,
  `userid` text NOT NULL,
  `agentid` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `phone` text NOT NULL,
  `country` text NOT NULL,
  `state` text NOT NULL,
  `address` text NOT NULL,
  `currency` text NOT NULL,
  `status` text NOT NULL,
  `role` text NOT NULL,
  `confirmationCode` text NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastlogin` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sn`, `userid`, `agentid`, `username`, `email`, `password`, `fname`, `lname`, `phone`, `country`, `state`, `address`, `currency`, `status`, `role`, `confirmationCode`, `date_reg`, `lastlogin`) VALUES
(1, '967815', '', 'josimar', 'renownjosimar@gmail.com', '$2y$12$ojGaG.4oK71qHDQO2zID7efcLJBjvGhqTzAMS1z6UyV7wvM7Ur32K', 'josimar', 'akpomudia', '08070838484', 'Nigeria', 'Abuja', 'Apo resettlement', 'N', '1', 'Seller', '0', '2020-02-24 17:32:54', '2020-06-25 12:26:28'),
(2, '1111', '', 'admin', 'admin@ojarh.com', '$2y$12$ojGaG.4oK71qHDQO2zID7efcLJBjvGhqTzAMS1z6UyV7wvM7Ur32K', 'Ojarh', 'Admin', '+1934839', 'Nigeria', 'Abuja', 'Utako', 'N', '1', 'Admin', '0', '2020-02-24 17:43:06', '2020-06-30 16:53:46'),
(18, '825974', '', 'sandra', 'sandra@gmail.com', '$2y$12$aC7nhYvWX7GHnPVzq5Vd.e4AWJHM.iYWY1Tid6WN9EGfgoVdlnsNq', 'sandra', 'akpomudia', '399383838', 'Jamaica', 'Delta', 'lkajf', '$', '1', 'International', '0', '2020-03-24 16:23:38', '2020-05-11 14:02:58'),
(23, '536361', '', 'vivian', 'vivian@gmail.com', '$2y$12$tOu6kefqJ3yA3qAxXbvKTOr1yMgZRYpyB2E2k./HQszz8pE43SLei', 'vivian', 'onome', '08038438482', 'United Arab Emirates', 'Dubai', 'abudabi', '$', '1', 'Seller', '0', '2020-03-26 09:22:18', '2020-05-11 14:09:28'),
(24, '889140', '', 'dsthedragon', 'arinzeaguolu@yahoo.com', '$2y$12$L/6uwGNzT33fC/qJJHo2Bu20EJS5Czmc96kpvEcrliksTV.UEWmB2', 'Arinze', 'Aguolu', '08119339239', 'Nigeria', 'FCT', 'No 16 Dodoma Street, Zone 6, Wuse', '$', '1', 'Seller', '0', '2020-03-27 12:51:10', '2020-04-13 12:06:34'),
(31, '403720', '', 'johnwick', 'johnwick@email.com', '$2y$12$fqEdY5BAm0gkAU9UA/kvpOtxYWSRbUrbBECwpzS1tz4SLCC/M9HW2', 'John', 'Wick', '09213213', 'Nigeria', 'FCT', 'Some Where', '$', '1', 'International', '0', '2020-04-01 09:14:05', '2020-04-03 12:50:33'),
(37, '20200428120412', '123456', 'nelson', 'nelson@gmail.com', '$2y$12$YVqDe9QF3vch5QNFi76TLuRy7K5nQbboSgejNVoOGevwS0yLr6EZu', 'Nelson', 'Akpomudia', '08099338844', 'Nigeria', 'abuja', 'apo', '$', '1', 'International', '0', '2020-04-27 23:22:13', '2020-05-04 16:05:57'),
(36, '20200423010446', '1111', 'abey', 'abey@gmail.com', '$2y$12$mTlRvEGAgUSnghYltRVY.uo9gjnGYXJ5TD6RQAzq3KNsK8eJiD1pi', 'abey', 'abiodun', '09038484848', 'Afghanistan', 'kasdj', 'kasdjfk', '$', '1', 'Seller', '526688', '2020-04-23 12:44:47', '2020-05-04 16:11:04'),
(38, '20200511010521', '1111', 'sqt', 'sqt@sqtwebsolutions.com', '$2y$12$qysnyllUCw0bDIVcriN/u.QDeQuPVigdYW6DHBrVPIw1lp3TLuRLy', 'john', 'Freedom', '08038383883', 'Nigeria', 'Abuja', 'apo', '$', '1', 'Sub Admin', '155236', '2020-05-11 12:19:21', NULL),
(39, '20200511050557', '1111', 'jjj', 'jjj@gmail.com', '$2y$12$LDYzdt778o7cYHtO9Jacru0h8fRit3CIlAddpR2qvKU9LI9GeIYIu', 'jjj', 'jjj', '93939', '', 'jjj', 'jjj', '$', '2', 'Seller', '355549', '2020-05-11 16:40:57', NULL),
(40, '20200511050555', '1111', 'kjkfaj', 'klajd@mg.com', '$2y$12$gkGXuAYycEGxFAzUUboz8eWX3B3.5Fs8VuOTNzoKu.a8vsFQzHdLO', 'jlkajf', 'klafjsd', '939339', 'Kazakhstan', 'aklsjfl', 'lakjfalksfj', '$', '2', 'International', '633548', '2020-05-11 16:49:56', NULL),
(41, '20200511050501', '1111', 'kjsfkldj', 'klfjasdfkl@gma.com', '$2y$12$r2d.aZsge6ctLNE3tDi7IeUbxMiUBriLuHUDNFetzyd4DPvOMnMVi', 'klfajsdfklj', 'aklsdfjkl', '9393939', 'Lao People\'s Democratic Republic', 'alkdfl', 'klajsdflk', '$', '2', 'Buyer', '939007', '2020-05-11 16:52:01', NULL),
(42, '20200511050535', '1111', 'kfajsdlf', 'lkfajsdfkl@glc.com', '$2y$12$AzovE1E791x3r1lKXcl1OeyHPHGM9jT63qLHJQv00g216SO08I45m', 'lkajf', 'lkfja', '939393', 'Uganda', 'klasjdf', 'klasfjfklj', '$', '1', 'Seller', '499465', '2020-05-11 16:53:35', NULL),
(43, '20200511050502', '1111', 'asdfakj', 'klajsdfkl@gma.com', '$2y$12$6T4CHRr5AzywhBgYIZx91eT7jQORRJzCShEZwGRY67eEhKVLUs59u', 'kajsdf', 'klfajdsf', '393939', 'Albania', 'alksdjf', 'lfaskjdf', '$', '2', 'International', '378350', '2020-05-11 16:59:02', NULL),
(44, '20200513020551', '0001', 'buyer', 'testadmin@xxxx.com', '$2y$12$PB7tS4JdgvG.KhDQZcsA9OgQBJ.50DNAHckJsG7.vnFpgVo3SMPeC', 'Elijah2', 'Okokon2', '08150685555', 'Nigeria', 'Oyo', 'Plot 2, house 39, Owode Estate Extension, Apata,', '#', '1', 'Buyer', '410121', '2020-05-13 01:03:51', '2020-06-25 12:01:55'),
(45, '20200513100557', '0001', 'international', 'okoelijah4@gmail.com', '$2y$12$PB7tS4JdgvG.KhDQZcsA9OgQBJ.50DNAHckJsG7.vnFpgVo3SMPeC', 'Elijah3', 'Okokon', '08150685555', 'Nigeria', 'Oyo', 'Plot 2, house 39, Owode Estate Extension, Apata,', '$', '1', 'International', '863595', '2020-05-13 09:05:58', '2020-06-30 17:02:46'),
(46, '20200513110550', '85402031', 'testadmin', 'okoelijah2@gmail.com', '$2y$12$ywqGyVqTD6jyoDRzON6s/.tC0W3iqdZkzIRcFqi8uLYz.MG2PO7gi', 'Elijah1', 'Okokon', '0010101001', 'Nigeria', 'Oyo', 'Plot 2, house 39, Owode Estate Extension, Apata,', 'N', '1', 'Seller', '799131', '2020-05-13 10:12:51', '2020-05-26 12:28:54'),
(47, '20200526060528', '0001', 'buyer3', 'okoelijah@gmail1.com', '$2y$12$rtm6BmsLgwkm5ttLMc9AiuQGte01Ep.ldJn3B94bO/w3qGxCN1Wb2', 'Buyer', 'Okokon', '08150685555', 'Nigeria', 'Oyo', 'Plot 2, house 39, Owode Estate Extension, Apata,', '#', '0', 'Buyer', '313641', '2020-05-26 17:31:28', NULL),
(48, '20200530030551', '0001', 'tester', 'kosivib275@lywenw.com', '$2y$12$rn4ra6dL47JWLz473NDyqeFfU1u6k9TrCZSuLv6cnihbJIi5Oy9Uu', 'John ', 'Doe', '08090001234', 'Nigeria', 'Oyo', 'Test Address', '#', '0', 'Buyer', '908056', '2020-05-30 14:05:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `id` int(11) NOT NULL,
  `catid` text NOT NULL,
  `userid` text NOT NULL,
  `catname_u` text NOT NULL,
  `catdescription_u` text NOT NULL,
  `t_product` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`id`, `catid`, `userid`, `catname_u`, `catdescription_u`, `t_product`, `created_at`) VALUES
(1, '850413', '967815', 'Automobile and Spare Parts', 'spare parts sales', 0, '2020-02-24 17:56:21'),
(2, '375413', '967815', 'Electrical Appliances', 'Electrical sales', 0, '2020-02-24 17:56:36'),
(3, '854429', '889140', 'Fashion and Jewery', '', 0, '2020-04-02 15:27:04'),
(4, '292352', '889140', 'Electrical Appliances', '', 0, '2020-04-02 15:27:09'),
(5, '108771', '889140', 'Automobile and Spare Parts', '', 0, '2020-04-02 15:27:19'),
(6, '747368', '825974', 'Electrical Appliances', 'this is where i sell all', 0, '2020-05-04 15:28:18'),
(10, '949198', '20200513100557', 'Electrical Appliances', '', 0, '2020-05-19 09:50:19'),
(8, '993067', '20200513110550', 'Fashion and Jewery', 'new', 0, '2020-05-17 08:55:48'),
(11, '105949', '20200513110550', 'Big Product', 'mine ', 0, '2020-05-23 20:09:10'),
(12, '397316', '20200513100557', 'new catalogue', 'test new', 0, '2020-05-26 19:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `verifyid` text NOT NULL,
  `userid` text NOT NULL,
  `documenttype` text NOT NULL,
  `verifyfile` text NOT NULL,
  `verifystatus` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `verifyid`, `userid`, `documenttype`, `verifyfile`, `verifystatus`, `created_at`) VALUES
(1, '944204', '967815', 'International Passport', '944204-header uba 2.jpg', 'Deactivate', '2020-03-01 19:28:56'),
(2, '294144', '20200513100557', 'CAC', '294144-E6A5F7D6-80C5-470F-A279-3F49947EC17D.jpeg', 'Pending', '2020-06-30 15:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `productid` varchar(45) NOT NULL,
  `buyer_name` varchar(45) NOT NULL,
  `billing_address` text NOT NULL,
  `sellerid` varchar(45) NOT NULL,
  `qty` varchar(45) NOT NULL,
  `product_price` float NOT NULL,
  `total` float NOT NULL,
  `location` text NOT NULL,
  `payment_method` varchar(45) NOT NULL,
  `paid_date` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `productid`, `buyer_name`, `billing_address`, `sellerid`, `qty`, `product_price`, `total`, `location`, `payment_method`, `paid_date`, `payment_status`) VALUES
(1, '', 'Ojarh Admin', 'Utako, Abuja, Unknown, ', '889140', '1', 28, 28, 'Utako, Abuja, Unknown, ', 'Pay with Card', '2020-05-20 15:53:46', 'COMPLETED'),
(2, '', 'Ojarh Admin', 'Utako, Abuja, Unknown, ', '889140', '3', 28, 84, 'Utako, Abuja, Unknown, ', 'Pay with Card', '2020-05-20 16:20:20', 'COMPLETED'),
(3, '', 'Ojarh Admin', 'Utako, Abuja, Unknown, ', '889140', '3', 28, 84, 'Array', 'Pay with Card', '2020-05-20 16:22:42', 'COMPLETED'),
(4, '', 'Ojarh Admin', 'Utako, Abuja, Unknown, ', '889140', '3', 28, 84, '{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}', 'Pay with Card', '2020-05-20 16:24:02', 'COMPLETED'),
(5, '', 'Ojarh Admin', 'Utako, Abuja, Unknown, ', '889140', '3', 28, 84, '{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}', 'Pay with Card', '2020-05-20 16:26:06', 'COMPLETED'),
(6, '', 'Ojarh Admin', 'Utako, Abuja, Unknown, ', '889140', '3', 28, 84, '{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}', 'Pay with Card', '2020-05-20 16:28:52', 'COMPLETED'),
(7, '979079', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '20200513100557', '3', 291, 873, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-28 21:26:50', 'ON DELIVERY'),
(8, '979079', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '20200513100557', '3', 291, 873, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-28 21:27:00', 'ON DELIVERY'),
(9, '638605', 'Elijah3 Okokon', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '967815', '3', 674159, 2022480, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-28 21:36:00', 'ON DELIVERY'),
(10, '886071', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '967815', '2', 827906, 1655810, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, \"', 'Pay on delivery', '2020-05-30 20:18:29', 'ON DELIVERY'),
(11, '886071', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '967815', '2', 827906, 1655810, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, \"', 'Pay on delivery', '2020-05-30 20:18:33', 'ON DELIVERY'),
(12, '886071', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '967815', '2', 827906, 1655810, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, \"', 'Pay on delivery', '2020-05-30 20:18:36', 'ON DELIVERY'),
(13, '886071', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '967815', '2', 827906, 1655810, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, \"', 'Pay on delivery', '2020-05-30 20:18:42', 'ON DELIVERY'),
(14, '330596', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, ', '889140', '1', 40, 40, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, United States, \"', 'Pay on delivery', '2020-05-30 20:18:44', 'ON DELIVERY'),
(15, '275995', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '967815', '0', 0, 0, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-30 21:26:59', 'ON DELIVERY'),
(16, '275995', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '967815', '0', 0, 0, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-30 21:27:03', 'ON DELIVERY'),
(17, '330596', 'Elijah3 Okokon', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '889140', '1', 28, 28, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-30 21:27:33', 'ON DELIVERY'),
(18, '330596', 'Elijah Okokon', 'Plot 2, house 39, Owode Estate Extension, Apata,, Ibadan, Nigeria, +23401', '889140', '1', 28, 28, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Ibadan, Nigeria, +23401\"', 'Pay on delivery', '2020-05-30 22:03:59', 'ON DELIVERY'),
(19, '638605', 'Elijah Okokon', 'Plot 2, house 39, Owode Estate Extension, Apata,, Ibadan, Nigeria, +23401', '967815', '2', 122221, 244443, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Ibadan, Nigeria, +23401\"', 'Pay on delivery', '2020-05-30 22:04:27', 'ON DELIVERY'),
(20, '330596', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '889140', '1', 0, 0, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-31 04:18:27', 'ON DELIVERY'),
(21, '330596', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '889140', '1', 0, 0, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-31 04:18:35', 'ON DELIVERY'),
(22, '310258', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '20200513110550', '1', 7, 7, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-31 04:24:35', 'ON DELIVERY'),
(23, '140685', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '967815', '0', 0, 0, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay on delivery', '2020-05-31 04:38:32', 'ON DELIVERY'),
(24, '310258', 'Elijah2 Okokon2', 'Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, ', '20200513110550', '1', 7, 7, '\"Plot 2, house 39, Owode Estate Extension, Apata,, Oyo, Nigeria, \"', 'Pay with Card', '2020-05-31 04:39:01', 'COMPLETED');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_details`
--

CREATE TABLE `wallet_details` (
  `id` int(11) NOT NULL,
  `sellerid` bigint(20) DEFAULT NULL,
  `total_payout` float DEFAULT NULL,
  `total_balance` float DEFAULT NULL,
  `total_income` float DEFAULT 0,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet_details`
--

INSERT INTO `wallet_details` (`id`, `sellerid`, `total_payout`, `total_balance`, `total_income`, `status`) VALUES
(1, 20200513100557, 1696, 2116, 210, NULL),
(3, 1111, 8892020, 8892020, 0, NULL),
(4, 967815, 8890170, 8890170, 0, NULL),
(5, 889140, 96, 96, 0, NULL),
(6, 20200513110550, 14, 14, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountdetails`
--
ALTER TABLE `accountdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps_countries`
--
ALTER TABLE `apps_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_access`
--
ALTER TABLE `business_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disputeresponse`
--
ALTER TABLE `disputeresponse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disputetbl`
--
ALTER TABLE `disputetbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local_governments`
--
ALTER TABLE `local_governments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketproductid`
--
ALTER TABLE `marketproductid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_seller_pd`
--
ALTER TABLE `message_seller_pd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `naija_states`
--
ALTER TABLE `naija_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_temp`
--
ALTER TABLE `order_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payout_request`
--
ALTER TABLE `payout_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profilepic`
--
ALTER TABLE `profilepic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_dispute`
--
ALTER TABLE `public_dispute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quick_ordertbl`
--
ALTER TABLE `quick_ordertbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submit_review_db`
--
ALTER TABLE `submit_review_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_details`
--
ALTER TABLE `wallet_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountdetails`
--
ALTER TABLE `accountdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_info`
--
ALTER TABLE `account_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ad`
--
ALTER TABLE `ad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `apps_countries`
--
ALTER TABLE `apps_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `business_access`
--
ALTER TABLE `business_access`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disputeresponse`
--
ALTER TABLE `disputeresponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `disputetbl`
--
ALTER TABLE `disputetbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `local_governments`
--
ALTER TABLE `local_governments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=775;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `marketproductid`
--
ALTER TABLE `marketproductid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `message_seller_pd`
--
ALTER TABLE `message_seller_pd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=626;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `order_temp`
--
ALTER TABLE `order_temp`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payout_request`
--
ALTER TABLE `payout_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `profilepic`
--
ALTER TABLE `profilepic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `public_dispute`
--
ALTER TABLE `public_dispute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quick_ordertbl`
--
ALTER TABLE `quick_ordertbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `submit_review_db`
--
ALTER TABLE `submit_review_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `wallet_details`
--
ALTER TABLE `wallet_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
