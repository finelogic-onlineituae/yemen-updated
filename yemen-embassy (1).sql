-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2025 at 08:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yemen-embassy`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_family_members`
--

CREATE TABLE `application_family_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `emirates_id` varchar(255) NOT NULL,
  `information_provided` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `residance_permit` text NOT NULL,
  `passport_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_family_members`
--

INSERT INTO `application_family_members` (`id`, `name`, `emirates_id`, `information_provided`, `phone_number`, `residance_permit`, `passport_id`, `created_at`, `updated_at`) VALUES
(1, '', '45245245', 'test', '4564564565', 'uploads/user_30/eEisOXy5lS1yBo0QkGb36i4ZCMjwlfJ2tlzx8MtW.pdf', 149, '2025-05-08 10:18:45', '2025-05-08 10:18:45'),
(2, '', '45245245', 'test', '4564564565', 'uploads/user_30/vciqVcDNVzDt3YtZTe6fil6R8lQ660z3MrTQ6lxf.pdf', 150, '2025-05-08 10:24:10', '2025-05-08 10:24:10'),
(3, '', '45245245', 'test', '4564564565', 'uploads/user_30/ljnLN2j0W6xup6i37LEk65ZvHE0knoYXjjskXr2y.pdf', 151, '2025-05-08 10:25:57', '2025-05-08 10:25:57'),
(4, '', '45245245', 'test', '4564564565', 'uploads/user_30/J9RPdTx7dgiv2Kxljt3jIblgSmHWn4J2g5GFR361.pdf', 152, '2025-05-08 10:27:10', '2025-05-08 10:27:10'),
(5, '', '45245245', 'test', '4564564565', 'uploads/user_30/4IFGKs1LMLnyEf9NjyGDgnK8Kn1YmA1Ew7692VeN.pdf', 154, '2025-05-08 10:28:36', '2025-05-08 10:28:36'),
(6, 'Vinay4524', '45245245455', 'test54545', '4564565455445', 'uploads/user_30/f5TS85loaxi0uYkdhuMMwEJChe43QjY9FsYQQJeY.pdf', 156, '2025-05-08 10:29:39', '2025-05-08 12:07:26'),
(7, 'Vinay', '45245245', 'test', '4564564565', 'uploads/user_30/BP5Hge4cubEB7eFK7U2gpJr5ZC3AqxTOyNa4sJRC.pdf', 268, '2025-05-08 14:02:29', '2025-05-08 14:02:29'),
(8, 'Vinay', '45245245', 'test', '4564564565', 'uploads/user_30/8f9H7uA9UFWEYUy4nCoNsklwEnXrHuo34HqbYcv1.pdf', 271, '2025-05-08 14:07:29', '2025-05-08 14:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `application_family_memberspassports`
--

CREATE TABLE `application_family_memberspassports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `residance_permit` text DEFAULT NULL,
  `birth_certificiate` text DEFAULT NULL,
  `passport_id` bigint(20) UNSIGNED NOT NULL,
  `family_member_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_family_memberspassports`
--

INSERT INTO `application_family_memberspassports` (`id`, `name`, `residance_permit`, `birth_certificiate`, `passport_id`, `family_member_id`, `created_at`, `updated_at`) VALUES
(106, 'tyest1111jhk', 'uploads/user_30/rHwCgYX4i0wUKvV1iW9c094d7aqi9dJlzvafI0OF.pdf', NULL, 264, 6, '2025-05-08 12:19:28', '2025-05-08 13:13:05'),
(109, 'hjk', 'uploads/user_30/uLvsu1OJfYdP3oHWgeq809j7yYfWPEjs9rreuplQ.pdf', 'uploads/user_30/IcOpO32tKv56NIYyiWkLXJlJOs92sOGMUiC6XRXx.pdf', 267, 6, '2025-05-08 13:13:05', '2025-05-08 13:13:05'),
(110, 'tyest1111dasef', 'uploads/user_30/KJxbYfxFHGffRA7qe0emsRaGKBYZAbDCHOrwsqv7.pdf', 'uploads/user_30/JG1Nw9arUQvQQRzNgHk7zWJWwpbYtPhvhoI7pvHM.pdf', 269, 7, '2025-05-08 14:02:29', '2025-05-08 14:03:59'),
(111, 'member2', 'uploads/user_30/fqsuguUGx80axX8lbu6D6oJ9PXtqFiiUfce18oYw.pdf', 'uploads/user_30/TKdkkBewipbAS2E20MnjO6htPu8NOlHNeaa5rHLL.pdf', 270, 7, '2025-05-08 14:02:29', '2025-05-08 14:02:29'),
(112, 'tyest1111', 'uploads/user_30/x4kjnf1eHf90nFhBT0o2oSqhFtDcAK9yytkl8gZu.pdf', 'uploads/user_30/y5GV5vUrd73recC6wQvptTXuPizQ2eVUrSVjj6wS.pdf', 272, 8, '2025-05-08 14:07:29', '2025-05-08 14:07:29'),
(113, 'member2', NULL, NULL, 273, 8, '2025-05-08 14:07:29', '2025-05-08 14:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `birth_certificates`
--

CREATE TABLE `birth_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `passport_id` bigint(20) UNSIGNED NOT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `emirates_id` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `marital_status` varchar(255) NOT NULL,
  `fathers_name` varchar(255) DEFAULT NULL,
  `fathers_issued_on` date DEFAULT NULL,
  `fathers_passport_number` varchar(255) DEFAULT NULL,
  `fathers_nationality` varchar(255) DEFAULT NULL,
  `mothers_name` varchar(255) DEFAULT NULL,
  `mothers_issued_on` date DEFAULT NULL,
  `mothers_passport_number` varchar(255) DEFAULT NULL,
  `mothers_nationality` varchar(255) DEFAULT NULL,
  `residance_permit` text NOT NULL,
  `fathers_passport` text DEFAULT NULL,
  `mothers_passport` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `birth_certificates`
--

INSERT INTO `birth_certificates` (`id`, `created_at`, `updated_at`, `name`, `phone_number`, `passport_id`, `place_of_birth`, `emirates_id`, `date_of_birth`, `marital_status`, `fathers_name`, `fathers_issued_on`, `fathers_passport_number`, `fathers_nationality`, `mothers_name`, `mothers_issued_on`, `mothers_passport_number`, `mothers_nationality`, `residance_permit`, `fathers_passport`, `mothers_passport`) VALUES
(66, '2025-05-03 09:22:27', '2025-05-03 09:22:44', 'Vinod Haridas', '98765432136', 121, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(67, '2025-05-05 10:58:15', '2025-05-05 10:58:15', 'vinay', '456645645', 125, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(68, '2025-05-05 12:20:25', '2025-05-05 12:50:45', 'vinay', '4564564565', 126, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(69, '2025-05-05 13:57:28', '2025-05-05 13:57:28', 'vinay', '4564564565', 127, 'india', '45245245', '2025-05-07', 'Single', 'vinay father', '2025-04-23', '13521354156', '10', 'vinay mother', '2025-04-11', '4654321345', '5', 'uploads/user_30/6zyBSFYHyfxyscmmxwzhh1ogEvCSgp6JSIk5m3wN.pdf', 'uploads/user_30/AWOgjUDoja0uzJWJZGmJ5yUunwbhD8FZc5rsmA8p.pdf', 'uploads/user_30/6MU205YtGXHzwmnYAVbWGcmDTU0QLGdtis3viPDG.pdf'),
(70, '2025-05-05 15:33:23', '2025-05-05 15:33:23', 'vinay', '4564564565', 128, 'india', '45245245', '2025-05-21', 'Single', 'vinay father', '2025-04-10', '13521354156', '15', 'vinay mother', '2025-04-16', '4654321345', '9', 'uploads/user_30/w1FVnJzFRNtdJXBI6PKfVojyVsXjUbEp7f6PiUVH.pdf', 'uploads/user_30/lztW6cgzBXJ18R8DVBalF6fn9CVC1U6a8VObod3r.pdf', 'uploads/user_30/MRQfl6dpbR0d54mhGdR9TuTbux5cB0oLtY7LchZi.pdf'),
(71, '2025-05-06 07:42:09', '2025-05-06 07:42:09', 'vinay', '4564564565', 129, 'india', '45245245', '2025-05-07', 'Single', 'vinay father', '2025-04-09', '13521354156', '10', 'vinay mother', '2025-04-08', '4654321345', '14', 'uploads/user_30/OaLUgPTTCHbAFFkoGtzDhK2w4KiHXdB2TZ9koa6q.pdf', 'uploads/user_30/irWQngU4WX6X5cmL9CLSUvwnLNdcbTf0Tj1CzcLk.pdf', 'uploads/user_30/624UnAxeR22nXybbtpWsHE43FfM37To8EEe3qcXv.pdf'),
(72, '2025-05-06 11:45:14', '2025-05-06 12:19:12', 'vinay', '4564564565', 136, 'indiajkhjkfhjkjh', '45245245kjhkghj', '2025-05-08', 'Married', 'vinay father', '2025-04-17', '13521354156', '5', 'vinay mother', '2025-05-02', '4654321345', '10', 'uploads/user_30/Ti1cNbkXERFoIDKG7SKOZnaCUEUF5iatKxVJTHHG.pdf', 'uploads/user_30/SnqHNBOOxsQDDQ1ySomFFjiMCx34vQxTsVRQTMBy.pdf', 'uploads/user_30/vHcoZ7nrdgdrJZR8eNHRSnObxdTFJtiLUz9LF2pU.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('22d200f8670dbdb3e253a90eee5098477c95c23d', 'i:3;', 1746717768),
('22d200f8670dbdb3e253a90eee5098477c95c23d:timer', 'i:1746717768;', 1746717768),
('test@gmail.com|127.0.0.1', 'i:5;', 1746770645),
('test@gmail.com|127.0.0.1:timer', 'i:1746770645;', 1746770645);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Relationship Certificates', NULL, NULL),
(2, 'Attestations', NULL, NULL),
(3, 'Passport Services', NULL, NULL),
(4, 'Visa Services', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'AS', 'American Samoa'),
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
(61, 'TL', 'East Timor'),
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
(84, 'GG', 'Guernsey'),
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
(142, 'YT', 'Mayotte'),
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
(211, 'SZ', 'Eswatini'),
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
-- Table structure for table `driving_licences`
--

CREATE TABLE `driving_licences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `emirates_id` varchar(255) NOT NULL,
  `driving_licence_number` varchar(255) NOT NULL,
  `driving_licence_center_id` bigint(20) UNSIGNED NOT NULL,
  `issued_on` date NOT NULL,
  `expire_on` date NOT NULL,
  `vehicle_category_id` bigint(20) UNSIGNED NOT NULL,
  `passport_id` bigint(20) UNSIGNED NOT NULL,
  `licence_attachment` text DEFAULT NULL,
  `residance_permit` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driving_licence_centers`
--

CREATE TABLE `driving_licence_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driving_licence_centers`
--

INSERT INTO `driving_licence_centers` (`id`, `center_name`, `created_at`, `updated_at`) VALUES
(1, 'Sana’a Governorate', NULL, NULL),
(2, 'Taiz Governorate', NULL, NULL),
(3, 'Ibb Governorate', NULL, NULL),
(4, 'Hodeidah Governorate', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Applied','Viewed by Embassy','Approved','Rejected','Initiated') DEFAULT NULL,
  `reason_for_rejection` text DEFAULT NULL,
  `formable_id` bigint(20) UNSIGNED NOT NULL,
  `formable_type` varchar(255) NOT NULL,
  `form_type_id` bigint(20) DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `applied_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verified_by_staff` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_by_counsillor` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_by_ambassador` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_by_cashier` bigint(20) UNSIGNED DEFAULT NULL,
  `current_position` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `user_id`, `status`, `reason_for_rejection`, `formable_id`, `formable_type`, `form_type_id`, `signature`, `applied_on`, `created_at`, `updated_at`, `verified_by_staff`, `verified_by_counsillor`, `verified_by_ambassador`, `verified_by_cashier`, `current_position`) VALUES
(75, 27, 'Initiated', NULL, 3, 'App\\Models\\NoIdCard', 3, NULL, NULL, '2025-05-02 09:49:44', '2025-05-02 09:49:44', NULL, NULL, NULL, NULL, NULL),
(76, 27, 'Initiated', NULL, 4, 'App\\Models\\NoIdCard', 3, NULL, NULL, '2025-05-02 10:14:55', '2025-05-02 10:14:55', NULL, NULL, NULL, NULL, NULL),
(77, 27, 'Applied', NULL, 66, 'App\\Models\\BirthCertificate', 1, 'user-signature/27-51500894-6738-4556-ad6c-de7415d0726b.jpeg', '2025-05-03 14:53:00', '2025-05-03 09:22:27', '2025-05-03 09:23:00', NULL, NULL, NULL, NULL, NULL),
(78, 27, 'Applied', NULL, 5, 'App\\Models\\NoIdCard', 3, 'user-signature/27-6fb20018-9840-4adf-bd99-6109d62b8e83.jpeg', '2025-05-03 18:11:07', '2025-05-03 12:40:42', '2025-05-03 12:41:07', NULL, NULL, NULL, NULL, NULL),
(79, 30, 'Applied', NULL, 67, 'App\\Models\\BirthCertificate', 1, 'user-signature/30-1d33d6d5-7424-4ef0-849f-f9730d0fe0a1.jpg', '2025-05-05 16:15:08', '2025-05-05 10:58:15', '2025-05-05 12:15:08', NULL, NULL, NULL, NULL, NULL),
(80, 30, 'Applied', NULL, 68, 'App\\Models\\BirthCertificate', 1, 'user-signature/30-b7409ae0-c787-4abb-ad52-450bd643eed3.jpg', '2025-05-05 16:55:41', '2025-05-05 12:20:25', '2025-05-05 12:55:41', NULL, NULL, NULL, NULL, NULL),
(81, 30, 'Applied', NULL, 69, 'App\\Models\\BirthCertificate', 1, 'user-signature/30-9764db88-16b7-49f9-8067-4c80a2c83a46.jpg', '2025-05-05 17:58:00', '2025-05-05 13:57:28', '2025-05-05 13:58:00', NULL, NULL, NULL, NULL, NULL),
(82, 30, 'Initiated', NULL, 70, 'App\\Models\\BirthCertificate', 1, NULL, NULL, '2025-05-05 15:33:23', '2025-05-05 15:33:23', NULL, NULL, NULL, NULL, NULL),
(83, 30, 'Initiated', NULL, 71, 'App\\Models\\BirthCertificate', 1, NULL, NULL, '2025-05-06 07:42:09', '2025-05-06 07:42:09', NULL, NULL, NULL, NULL, NULL),
(84, 30, 'Initiated', NULL, 1, 'App\\Models\\no_objection_certificate', 1, NULL, NULL, '2025-05-06 09:31:19', '2025-05-06 09:31:19', NULL, NULL, NULL, NULL, NULL),
(85, 30, 'Applied', NULL, 2, 'App\\Models\\no_objection_certificate', 1, 'user-signature/30-f78bfca2-a376-46eb-8a56-39a4a156833d.jpg', '2025-05-06 13:43:13', '2025-05-06 09:34:06', '2025-05-06 09:43:13', NULL, NULL, NULL, NULL, NULL),
(86, 30, 'Applied', NULL, 3, 'App\\Models\\no_objection_certificate', 1, 'user-signature/30-a25c7497-1818-4a72-9672-567f2e8a7215.jpg', '2025-05-06 14:38:49', '2025-05-06 10:37:07', '2025-05-06 10:38:49', NULL, NULL, NULL, NULL, NULL),
(87, 30, 'Applied', NULL, 4, 'App\\Models\\no_objection_certificate', 1, 'user-signature/30-9cb34804-c052-45a4-b9e5-844b86434c9b.jpg', '2025-05-06 15:37:34', '2025-05-06 11:34:17', '2025-05-06 11:37:34', NULL, NULL, NULL, NULL, NULL),
(88, 30, 'Initiated', NULL, 72, 'App\\Models\\BirthCertificate', 1, NULL, NULL, '2025-05-06 11:45:14', '2025-05-06 11:45:14', NULL, NULL, NULL, NULL, NULL),
(89, 30, 'Applied', NULL, 5, 'App\\Models\\no_objection_certificate', 1, 'user-signature/30-fefd92a0-4f88-4cbd-a829-1f6d7ec433c1.png', '2025-05-06 17:02:13', '2025-05-06 12:24:46', '2025-05-06 13:02:13', NULL, NULL, NULL, NULL, NULL),
(90, 30, 'Applied', NULL, 6, 'App\\Models\\NoObjectionCertificate', 1, 'user-signature/30-21679295-f038-4c13-bcf2-62a3263e3ee7.png', '2025-05-06 17:12:45', '2025-05-06 13:12:33', '2025-05-06 13:12:45', NULL, NULL, NULL, NULL, NULL),
(91, 30, 'Applied', NULL, 1, 'App\\Models\\SupportStatement', 1, 'user-signature/30-d754e05e-22af-4c0c-a1d1-74d4056ab373.png', '2025-05-06 19:32:19', '2025-05-06 15:19:40', '2025-05-06 15:32:19', NULL, NULL, NULL, NULL, NULL),
(92, 30, 'Applied', NULL, 1, 'App\\Models\\MarriageCertificate', 6, 'user-signature/30-170da954-fd8d-4d93-afdb-bda28338b569.png', '2025-05-07 13:25:32', '2025-05-07 08:39:56', '2025-05-07 09:25:32', NULL, NULL, NULL, NULL, NULL),
(93, 30, 'Applied', NULL, 2, 'App\\Models\\MarriageCertificate', 6, 'user-signature/30-6e2def39-bcd5-48f8-a4fd-fb658fd70514.png', '2025-05-07 13:29:50', '2025-05-07 09:29:03', '2025-05-07 09:29:50', NULL, NULL, NULL, NULL, NULL),
(94, 30, 'Applied', NULL, 6, 'App\\Models\\ApplicationFamilyMembers', 8, 'user-signature/30-a6135759-0244-437a-a031-161ce00f3585.png', '2025-05-08 18:01:00', '2025-05-08 10:29:39', '2025-05-08 14:01:00', NULL, NULL, NULL, NULL, NULL),
(95, 30, 'Applied', NULL, 7, 'App\\Models\\ApplicationFamilyMembers', 8, 'user-signature/30-d366cfc7-775f-4f11-b25c-9efea5b1e284.png', '2025-05-08 18:06:03', '2025-05-08 14:02:29', '2025-05-08 14:06:03', NULL, NULL, NULL, NULL, NULL),
(96, 30, 'Applied', NULL, 8, 'App\\Models\\ApplicationFamilyMembers', 8, 'user-signature/30-7116bf1c-2eab-459f-af36-081d7f5f4aad.png', '2025-05-08 18:09:26', '2025-05-08 14:07:29', '2025-05-08 14:09:26', NULL, NULL, NULL, NULL, NULL),
(97, 30, 'Applied', NULL, 1, 'App\\Models\\RenewPassportAbove', 7, 'user-signature/30-07b4a0d7-1018-42d6-b71b-7fe945609d48.png', '2025-05-08 20:43:16', '2025-05-08 16:26:01', '2025-05-08 16:43:16', NULL, NULL, NULL, NULL, NULL),
(98, 30, 'Initiated', NULL, 2, 'App\\Models\\RenewPassportAbove', 7, NULL, NULL, '2025-05-08 16:51:59', '2025-05-08 16:51:59', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_types`
--

CREATE TABLE `form_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_types`
--

INSERT INTO `form_types` (`id`, `application_name`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Birth Certificate', NULL, NULL, 1),
(2, 'Driving License', NULL, NULL, 1),
(3, 'Certificate of No ID Card', NULL, NULL, 1),
(4, 'Power of Attorney', NULL, NULL, 2),
(5, 'No objection certificate', NULL, NULL, 3),
(6, 'Marriage Certificate', NULL, NULL, 1),
(7, 'Support Statement', NULL, NULL, 1),
(8, 'Application for family members (No ID)', NULL, NULL, 2),
(9, 'Renew Passport (Above 18) ', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marriage_certificates`
--

CREATE TABLE `marriage_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `husband_emirates_id` varchar(255) NOT NULL,
  `wife_emirates_id` varchar(255) NOT NULL,
  `husband_name` varchar(255) NOT NULL,
  `wife_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `contract_issued_by` varchar(255) NOT NULL,
  `contract_issued_on` date NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `husband_residance_permit` text NOT NULL,
  `wife_residance_permit` text NOT NULL,
  `marriage_document` text NOT NULL,
  `husband_passport_id` bigint(20) UNSIGNED NOT NULL,
  `wife_passport_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marriage_certificates`
--

INSERT INTO `marriage_certificates` (`id`, `husband_emirates_id`, `wife_emirates_id`, `husband_name`, `wife_name`, `phone_number`, `contract_issued_by`, `contract_issued_on`, `registration_number`, `husband_residance_permit`, `wife_residance_permit`, `marriage_document`, `husband_passport_id`, `wife_passport_id`, `created_at`, `updated_at`) VALUES
(1, '4563456345fghfg', '455642452dsfgsd', 'Husbandhkhj', 'Wife145245', '4564564565dfg', 'test13513', '2025-04-01', '52561335', 'uploads/user_30/ex6IrzgeuajECndp7BVSD3h9Tx0PnQWbYMJ0BEKg.pdf', 'uploads/user_30/LlMXLNtFTNqChBzv0lwD7Bx6aqWOnhwCvRs4IhOY.pdf', 'uploads/user_30/v9AyJtZnagLW0hzq6Y4s7yQ5hclREobjpH1avsYR.pdf', 142, 143, '2025-05-07 08:39:56', '2025-05-07 09:24:52'),
(2, '784-1234-1234567-1', '220-1234-1234567-1', 'Husband-test', 'Wife-test', '4564564565', 'test', '2025-04-11', '52561335', 'uploads/user_30/L1aTmUMJd8y0uCTBtkfJRCnA3eYe5yv2wMiRQr4y.pdf', 'uploads/user_30/rbrtgl2QG0IQHXYOCtYP8HnSDph1UVqCpHHZ99xv.pdf', 'uploads/user_30/ILyRKABq0fpcdTrOsnjGBnNe5sTYG0wVBh9AnU2Y.pdf', 144, 145, '2025-05-07 09:29:03', '2025-05-07 09:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_22_071439_create_passports_table', 2),
(5, '2025_03_22_071440_create_birth_certificates_table', 2),
(6, '2025_03_22_093011_create_forms_table', 2),
(7, '2025_04_01_115754_create_visa_applications_table', 3),
(8, '2025_04_01_125911_create_previous_visits_table', 4),
(9, '2025_04_02_102644_add_columns_in_birth_certificates_table', 5),
(10, '2025_04_10_104455_add_nationality_column_in_users_table', 6),
(11, '2025_04_10_121903_create_passport_centers_table', 7),
(13, '2025_04_29_150010_create_driving_licence_centers_table', 8),
(14, '2025_04_29_150031_create_vehicle_categories_table', 8),
(15, '2025_04_29_155242_create_driving_licences_table', 8),
(16, '2025_04_30_143906_create_no_id_cards_table', 9),
(17, '2025_04_30_165323_create_power_of_attorneys_table', 10),
(18, '2025_05_02_042824_create_roles_table', 11),
(19, '2026_01_01_000000_create_users_table', 12),
(20, '2025_05_02_052100_create_officers_table', 13),
(21, '2025_05_02_052101_update_officers_table ', 14),
(22, '2025_05_03_065947_create_form_types_table', 15),
(23, '2025_05_03_070330_create_categories_table', 16),
(24, '2025_05_05_133142_add_birth_certifcate_details_table', 17),
(25, '2025_05_05_135341_add_birth_certifcate_details_table', 18),
(26, '2025_05_05_172612_add_birth_certifcate_details_table', 19),
(27, '2025_05_05_180740_create_no_objection_certificates_table', 20),
(28, '2025_05_05_182459_create_no_objection_certificates_table', 21),
(29, '2025_05_05_183449_add_residence_permit_table', 22),
(30, '2025_05_06_132724_add_residence_permit_table', 23),
(31, '2025_05_06_142712_add_phone_number_table', 24),
(32, '2025_05_06_172343_create_support_statements_table', 25),
(33, '2025_05_06_200709_create_marriage_certificates_table', 26),
(34, '2025_05_07_174405_create_application_family_members_table', 27),
(35, '2025_05_07_174624_create_application_family_memberspassports_table', 28),
(36, '2025_05_07_181619_create_application_family_members_table', 29),
(37, '2025_05_07_181625_create_application_family_memberspassports_table', 29),
(38, '2025_05_08_184630_create_renew_passport_aboves_table', 30);

-- --------------------------------------------------------

--
-- Table structure for table `no_id_cards`
--

CREATE TABLE `no_id_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(75) DEFAULT NULL,
  `submitted_to` varchar(255) NOT NULL,
  `emirates_id` varchar(255) NOT NULL,
  `residance_permit` varchar(255) NOT NULL,
  `passport_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `no_id_cards`
--

INSERT INTO `no_id_cards` (`id`, `name`, `phone_number`, `submitted_to`, `emirates_id`, `residance_permit`, `passport_id`, `created_at`, `updated_at`) VALUES
(3, 'Kunjamma Karuppan', '98765432136', 'The Embassy of Yemen Abu Dhabi', 'KSS9887-34223-99094', 'uploads/user_27/yEcEkE1In0ZmoyiXn1JpEgxEMQGTPTCGnWikm1WV.pdf', 119, '2025-05-02 09:49:44', '2025-05-02 09:49:44'),
(4, 'Kunjamma Karuppan', '987979809', 'The Embassy of Yemen Abu Dhabi', 'KSS9887-34223-99094', 'uploads/user_27/BV5pn3iNLRsab1YLu0zG6SkNdCPG13fVJR0ZC4Ek.pdf', 120, '2025-05-02 10:14:55', '2025-05-02 10:14:55'),
(5, 'Kishnakumar V S', '987979809', 'The Embassy of Yemen Abu Dhabi', 'KSS9887-34223-99094', 'uploads/user_27/BNk8sGETe8Pscd2MD3RCfneHPcZL5fJsLp2SNtCa.pdf', 122, '2025-05-03 12:40:42', '2025-05-03 12:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `no_objection_certificates`
--

CREATE TABLE `no_objection_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `emirates_id` varchar(255) NOT NULL,
  `birth_certifcate_no` varchar(255) NOT NULL,
  `birth_certifcate_issuing_authority` varchar(255) NOT NULL,
  `modified_name` varchar(255) NOT NULL,
  `amendment_or_correction` text NOT NULL,
  `modified_issued_by` varchar(255) NOT NULL,
  `modified_issued_on` date DEFAULT NULL,
  `birth_certifcate` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `residance_permit` text NOT NULL,
  `passport_id` bigint(20) UNSIGNED NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `no_objection_certificates`
--

INSERT INTO `no_objection_certificates` (`id`, `name`, `emirates_id`, `birth_certifcate_no`, `birth_certifcate_issuing_authority`, `modified_name`, `amendment_or_correction`, `modified_issued_by`, `modified_issued_on`, `birth_certifcate`, `created_at`, `updated_at`, `residance_permit`, `passport_id`, `phone_number`) VALUES
(1, 'vinay', '45245245', '3564564564', 'test', 'test', 'uploads/user_30/iS4EfGHtoJoobVNG30WBOs2JSEGsoaq2ybdQiKHL.pdf', 'test', '2025-05-01', 'uploads/user_30/PuZiSK8UDeojoeY5a60qaj3Qhx8QsBag164v8VHk.jpg', '2025-05-06 09:31:19', '2025-05-06 09:31:19', 'uploads/user_30/r2wPfnBvMOLoOPjQ3XONBzmtYgfAOG0rM2efjvoJ.pdf', 132, ''),
(2, 'vinayydrty', '45245245tyrfy', '3564564564tryfg', 'testtry', 'test', 'uploads/user_30/VAS0iVMt61kPWTM6QPWSSJnMxq2mIBqQm7Gvyd0d.pdf', 'test', '2025-05-01', 'uploads/user_30/EEawLHElGcOCG6AG4cTZmSNSaz633Z72ca2UkiKc.jpg', '2025-05-06 09:34:06', '2025-05-06 09:42:03', 'uploads/user_30/jUrHzjgkNEt8pdmMjEo649XEtNvnyMMSfplMrIlf.pdf', 133, ''),
(3, 'vinay', '45245245', '3564564564', 'test', 'test', 'uploads/user_30/G79eeqHH4BEhW4fpWS2qxD6hhZkHFwLoqP70d4PG.pdf', 'test', '2025-04-16', 'uploads/user_30/CNcMM2WmpFOwkXi95MDpYPb1UtCQGomQhjlU4JR1.pdf', '2025-05-06 10:37:07', '2025-05-06 10:37:07', 'uploads/user_30/wgwFl7L6a2cc0D5SOhPc9o7C3gDfVqJXsAoNjR9e.pdf', 134, '4564564565'),
(4, 'vinay', '45245245', '3564564564', 'test', 'test', 'uploads/user_30/P1LQxRiBxLTOz8P1OjiXlW5P6D5nAUuvS3OoY8gJ.pdf', 'test', '2025-05-01', 'uploads/user_30/dLxYQ0LlqAJDCYIsbwvzhK3Qwtv2cPYH9mLvV0jr.pdf', '2025-05-06 11:34:17', '2025-05-06 11:34:17', 'uploads/user_30/ZEUoxFmt0zbyQkPKQxMptROIWk9IpZL2G6LqIfcE.pdf', 135, '4564564565'),
(5, 'vinaygbgb', '45245245cgb', '35gbg64564564', 'testvcb', 'testncgncg', 'uploads/user_30/VsGnkRR2CRof3qC7Svo8iBgPqBQYDUDLLx7P0B65.pdf', 'testcng', '2025-05-02', 'uploads/user_30/OrmBwpfxlLGniCAfh7N5MtAwZPHyjx9tDInXBTOm.pdf', '2025-05-06 12:24:46', '2025-05-06 12:38:54', 'uploads/user_30/DrOge9rpHUoZLtZIQ9H1O0uA2PnQzutfC1kOeIFF.pdf', 137, '4564564565cb'),
(6, 'vinay', '45245245', '3564564564', 'test', 'test', 'uploads/user_30/83MdEWfmUjDcgn0SRTEIi1lfdQbLdoCbTFapdDEJ.pdf', 'test', '2025-05-01', 'uploads/user_30/7mE9qAjZ8oFwhtNkv8ABnWaIPAevvB2bZ0AegpEc.pdf', '2025-05-06 13:12:33', '2025-05-06 13:12:33', 'uploads/user_30/4pcHoHVj81S0WjfNuRUMYdPCx9l7lHqrq6Trzp4c.pdf', 138, '4564564565');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`id`, `employee_id`, `role_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'GKM-7789879', 5, '2025-05-02 02:24:58', '2025-05-02 02:24:58', 22),
(3, 'GKM-7789879', 5, '2025-05-02 02:27:10', '2025-05-02 02:27:10', 24),
(4, 'GKM-7789879', 5, '2025-05-02 02:29:49', '2025-05-02 02:29:49', 25),
(5, 'KJR-9876541', 1, '2025-05-02 02:41:55', '2025-05-02 02:41:55', 26),
(6, 'KJR-9876541', 1, '2025-05-02 23:33:43', '2025-05-02 23:33:43', 28);

-- --------------------------------------------------------

--
-- Table structure for table `passports`
--

CREATE TABLE `passports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `passport_number` varchar(255) NOT NULL,
  `issued_by` varchar(255) DEFAULT NULL,
  `passport_center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `issued_on` date DEFAULT NULL,
  `expires_on` date DEFAULT NULL,
  `used_from` datetime DEFAULT NULL,
  `used_to` datetime DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passports`
--

INSERT INTO `passports` (`id`, `user_id`, `passport_number`, `issued_by`, `passport_center_id`, `issued_on`, `expires_on`, `used_from`, `used_to`, `attachment`, `created_at`, `updated_at`) VALUES
(119, 27, 'LKJLK09098098', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_27/5KH62p00Tl6x7VZ3xOe97FjWuiOI7GVJYh0fBj8S.pdf', '2025-05-02 09:49:44', '2025-05-02 09:49:44'),
(120, 27, 'LKJLK09098098', 'YE', 2, '2025-05-02', NULL, NULL, NULL, 'uploads/user_27/qwEM2vSNMYguAc2C61mcvztr5GNHzQknVAKoZvqk.pdf', '2025-05-02 10:14:55', '2025-05-02 10:14:55'),
(121, 27, 'LKJLK09098098', 'YE', 1, '2025-05-01', NULL, NULL, NULL, 'uploads/user_27/vG9VFlQ04j2H9Ek0tL5fyYnTMvQ5AtIcsTUcuZJe.pdf', '2025-05-03 09:22:27', '2025-05-03 09:22:27'),
(122, 27, 'LKJLK09098098', 'YE', 4, '2025-05-01', NULL, NULL, NULL, 'uploads/user_27/fbrqdJN625GIDdmF1sscXfA8MIgyjT5F5h5QBJyR.pdf', '2025-05-03 12:40:42', '2025-05-03 12:40:42'),
(123, 30, '212341545', 'YE', 5, '2025-04-09', NULL, NULL, NULL, 'uploads/user_30/cbQTlpSFJRUdIYCHMcurnDcz98NiuAH4hUx8p38z.pdf', '2025-05-05 10:45:18', '2025-05-05 10:45:18'),
(124, 30, '45453132132', 'YE', 5, '2025-04-11', NULL, NULL, NULL, 'uploads/user_30/iJjdiQf7kyWSlUdHkiix5KWqzRbPUjOsD2kzh5i8.pdf', '2025-05-05 10:54:19', '2025-05-05 10:54:19'),
(125, 30, '45453132132', 'YE', 5, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/wjOgmF0fFjNMH5llEVb7iV8eD2ZhkXvWbn9e03lj.pdf', '2025-05-05 10:58:15', '2025-05-05 10:58:15'),
(126, 30, '45453132132', 'YE', 5, '2025-04-17', NULL, NULL, NULL, 'uploads/user_30/2Y3ygjfhCx0c3PH0cXxDwWYwPH8jk772287FuoM7.pdf', '2025-05-05 12:20:25', '2025-05-05 12:20:25'),
(127, 30, '45453132132', 'YE', 4, '2025-04-16', NULL, NULL, NULL, 'uploads/user_30/7uLi6qUpTZjVzA839KIoopkmMybcmtXd94aZxDdV.pdf', '2025-05-05 13:57:28', '2025-05-05 13:57:28'),
(128, 30, '45453132132', 'YE', 4, '2025-04-09', NULL, NULL, NULL, 'uploads/user_30/bAlVXSh7sXitCeEuvlDHfQvJl1N06igK7w5Oj1Kh.pdf', '2025-05-05 15:33:23', '2025-05-05 15:33:23'),
(129, 30, '45453132132', 'YE', 4, '2025-04-16', NULL, NULL, NULL, 'uploads/user_30/t6Oxw7948jXTgdnZPhzzyrIGijfE6Tqvj07iewyR.pdf', '2025-05-06 07:42:09', '2025-05-06 07:42:09'),
(130, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/bXxUOKC7spH1kC6zJvuuynUhW58e211oWCeLwDEX.pdf', '2025-05-06 09:25:03', '2025-05-06 09:25:03'),
(131, 30, '45453132132', 'YE', 4, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/zS8IK9ocKKakMpYZaa71orXvboNvTQTf3Mh0EuYJ.pdf', '2025-05-06 09:28:53', '2025-05-06 09:28:53'),
(132, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/jF7hqaLM8dw3q6xEBZN7X9kicvrR87fNpJU33Qeq.pdf', '2025-05-06 09:31:19', '2025-05-06 09:31:19'),
(133, 30, '454531321324545', 'YE', 1, '2025-04-10', NULL, NULL, NULL, 'uploads/user_30/tms9WPuI7Nf94WhntUpNQa2oe4x0mGEZdxN5RUno.pdf', '2025-05-06 09:34:06', '2025-05-06 09:42:03'),
(134, 30, '45453132132', 'YE', 2, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/keuHAru0gw0jTVDWLCv5ybng0nPFKWH6CGPGYaeQ.pdf', '2025-05-06 10:37:07', '2025-05-06 10:37:07'),
(135, 30, '45453132132', 'YE', 2, '2025-04-29', NULL, NULL, NULL, 'uploads/user_30/McUdK01CteujoRyyXB62PR40ANO9snfJithcQTbR.pdf', '2025-05-06 11:34:17', '2025-05-06 11:34:17'),
(136, 30, '45453132132', 'YE', 4, '2025-04-04', NULL, NULL, NULL, 'uploads/user_30/4BsAKEppH6K9KukHfvD4BsLlJdnO0rgB9tmNPGT5.pdf', '2025-05-06 11:45:14', '2025-05-06 11:45:14'),
(137, 30, '45453132132', 'YE', 4, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/Oa6XyVbQ1R94d3I2LRaRSepoDMSaItNIMPF1svEw.pdf', '2025-05-06 12:24:46', '2025-05-06 12:24:46'),
(138, 30, '45453132132', 'YE', 4, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/N67Wkqu5839JPQpgRftbyfDIogAnrsBmLbpBOJYp.pdf', '2025-05-06 13:12:33', '2025-05-06 13:12:33'),
(139, 30, '45453132132ddddf', 'YE', 6, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/luvCqjzGXc4cW4NLIBPZMXh5IJXgA1reWVJ8DCUi.pdf', '2025-05-06 15:19:40', '2025-05-06 15:31:56'),
(140, 30, '4534545', 'YE', 4, '2025-05-02', NULL, NULL, NULL, 'uploads/user_30/fVeIAdld86ovMwpdMB4GTSL8IoTAf0shYbmKLCKf.pdf', '2025-05-07 08:33:27', '2025-05-07 08:33:27'),
(141, 30, '45345', 'YE', 4, '2025-05-02', NULL, NULL, NULL, 'uploads/user_30/sSLz3vwrC6hAMXvvHI3xL8Ie7iGIovFhky8Nfpk4.pdf', '2025-05-07 08:33:27', '2025-05-07 08:33:27'),
(142, 30, '4534545fgh', 'YE', 1, '2025-04-01', NULL, NULL, NULL, 'uploads/user_30/DIaWQPiBp37WsjyrIDfMCHdJgV6NedqqrybOATHT.pdf', '2025-05-07 08:39:56', '2025-05-07 09:24:52'),
(143, 30, '45345dfgdfg', 'YE', 3, '2025-04-01', NULL, NULL, NULL, 'uploads/user_30/CyxsZnek9up5mdufq46S2HoG402Uo5G0w7Stvfg2.pdf', '2025-05-07 08:39:56', '2025-05-07 09:24:52'),
(144, 30, 'A1234567', 'YE', 1, '2025-04-03', NULL, NULL, NULL, 'uploads/user_30/ZDbjpBx8LaNS4NtSZktGHNmgNwCCn9nGAHXjGj6B.pdf', '2025-05-07 09:29:03', '2025-05-07 09:29:03'),
(145, 30, 'B1234567', 'YE', 3, '2025-04-10', NULL, NULL, NULL, 'uploads/user_30/XY1zCxfMkz37te21TjzIYDFoP7xIjiBuptWK5dDU.pdf', '2025-05-07 09:29:03', '2025-05-07 09:29:03'),
(146, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/QBGg9zloSr05c0dmGIkA5DKVuXHSzzkowul6WMzb.pdf', '2025-05-08 10:11:00', '2025-05-08 10:11:00'),
(147, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/IstvotCIGDjCFM8AMGIUqKJtJZ2w5V8AL5P82DNQ.pdf', '2025-05-08 10:13:13', '2025-05-08 10:13:13'),
(148, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/h43Vo5OrRnYfKZY0QKXH0zvZpM4SfkdCPfi3oD4i.pdf', '2025-05-08 10:14:48', '2025-05-08 10:14:48'),
(149, 30, '45453132132', 'YE', 6, '2025-05-06', NULL, NULL, NULL, 'uploads/user_30/aAixs305blblKQzOxMufxowj4jxZpbzBQjACXkdM.pdf', '2025-05-08 10:18:45', '2025-05-08 10:18:45'),
(150, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/gYT48FKPvQll0GL6OQna1r0VPCuCIkoerRvhTlg1.pdf', '2025-05-08 10:24:10', '2025-05-08 10:24:10'),
(151, 30, '45453132132', 'YE', 2, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/QaVTmVDTWb6Y1Gsu5I7JkZWA8rTOoPLAD4JOsYy7.pdf', '2025-05-08 10:25:57', '2025-05-08 10:25:57'),
(152, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/dh86IafNJvpbkr26hngXt3Raav6uoyLKLYMeGBuu.pdf', '2025-05-08 10:27:10', '2025-05-08 10:27:10'),
(153, 30, '3513132', 'YE', 2, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/VUuAb6MoPPAz3vzXOjEfIHwREhtiA9Trh4xbtDpr.pdf', '2025-05-08 10:27:10', '2025-05-08 10:27:10'),
(154, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/gEwSsPQcZfVCou2CY3MHgcFp4efzXVg8nnjKO0QC.pdf', '2025-05-08 10:28:36', '2025-05-08 10:28:36'),
(155, 30, '3513132', 'YE', 3, '2025-05-02', NULL, NULL, NULL, 'uploads/user_30/o5QNhnf7PTnzZqPgMvKok8ASssScikAWiHaR3kJX.pdf', '2025-05-08 10:28:36', '2025-05-08 10:28:36'),
(156, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/3Uv7VwfHP2yPsQizfhNT1FsBGiOScAjaj6aCtrbM.pdf', '2025-05-08 10:29:39', '2025-05-08 10:29:39'),
(159, 30, '3513132', 'YE', 2, '2025-05-01', NULL, NULL, NULL, NULL, '2025-05-08 11:52:42', '2025-05-08 11:52:42'),
(160, 30, '3513132', 'YE', 2, '2025-05-01', NULL, NULL, NULL, NULL, '2025-05-08 11:56:20', '2025-05-08 11:56:20'),
(264, 30, '3513132kkk', 'YE', 1, '2025-04-01', NULL, NULL, NULL, NULL, '2025-05-08 12:19:28', '2025-05-08 12:19:28'),
(265, 30, '15151', 'YE', 4, '2025-05-02', NULL, NULL, NULL, NULL, '2025-05-08 12:19:28', '2025-05-08 12:19:28'),
(266, 30, '15151', 'YE', 4, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/H4nM1PKQ48CTo188bBsbUjTzfT2bn7B3yqIYMEYb.pdf', '2025-05-08 12:52:54', '2025-05-08 12:52:54'),
(267, 30, '15151', 'YE', 2, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/9xwByx5EKLog4gzbcEI5FKlDVvzE35GEMVlH6s4w.pdf', '2025-05-08 13:13:05', '2025-05-08 13:13:05'),
(268, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/7DNEbeVCKn3ofqly2ZgT8nUp95S2rXHUsPstv9oa.pdf', '2025-05-08 14:02:29', '2025-05-08 14:02:29'),
(269, 30, '3513132kkkasdf', 'YE', 2, '2025-04-28', NULL, NULL, NULL, 'uploads/user_30/GHDqRlpgHponROk43qa1IKfKxOdxvnnIlmgQt679.pdf', '2025-05-08 14:02:29', '2025-05-08 14:03:59'),
(270, 30, '15151', 'YE', 4, '2025-04-03', NULL, NULL, NULL, 'uploads/user_30/AXZaUouga53pZAtQNoQE2yn1MQXWKnkj3hn9RNch.pdf', '2025-05-08 14:02:29', '2025-05-08 14:03:59'),
(271, 30, '45453132132', 'YE', 3, '2025-05-02', NULL, NULL, NULL, 'uploads/user_30/WFdM75DG6vNPjUvjeGG52pECkLGIDX8Ogoz2TlEb.pdf', '2025-05-08 14:07:29', '2025-05-08 14:07:29'),
(272, 30, '3513132kkk', 'YE', 2, '2025-04-10', NULL, NULL, NULL, 'uploads/user_30/cfCL7LxerkPG7npIH5CRTWuwRHS1Rj4omtjTjv3P.pdf', '2025-05-08 14:07:29', '2025-05-08 14:07:29'),
(273, 30, '15151', 'YE', 2, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/ie5opUtfS27hMzqJ8Z563xQqnzd7kGHQoRrm9oVt.pdf', '2025-05-08 14:07:29', '2025-05-08 14:07:29'),
(274, 30, '45453132132', 'YE', 3, '2025-05-02', NULL, NULL, NULL, 'uploads/user_30/GZyODX3EmA884dKKikZCFVL59b3qVfDe5PHYZVIv.pdf', '2025-05-08 16:21:35', '2025-05-08 16:21:35'),
(275, 30, '45453132132', 'YE', 2, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/h3r390EGWk5gn0ETcuapCwR1TdyLXyKCuCOAWuQZ.pdf', '2025-05-08 16:24:21', '2025-05-08 16:24:21'),
(276, 30, '45453132132', 'YE', 4, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/BH9F3qXxIisFKD3QKCEewWDwoRI0nuQx6ejKvVEc.pdf', '2025-05-08 16:25:11', '2025-05-08 16:25:11'),
(277, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/tEUiS4C6NLBMFGdzpBruCWgfIpxlWPTmjPosCRsy.pdf', '2025-05-08 16:26:01', '2025-05-08 16:26:01'),
(278, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/8O1FPpASMs85hRYyCNyPv5nyGz852WWfAi52Jjau.pdf', '2025-05-08 16:49:18', '2025-05-08 16:49:18'),
(279, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/T3Dg5PQq7XCOoelKDvSUhjjnqUcfXxBDXajNIIY8.pdf', '2025-05-08 16:50:31', '2025-05-08 16:50:31'),
(280, 30, '45453132132', 'YE', 3, '2025-05-01', NULL, NULL, NULL, 'uploads/user_30/nYGlxTKcRnr3QuDeimJF1BafpCLmm2nLFb5cTST6.pdf', '2025-05-08 16:51:59', '2025-05-08 16:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `passport_centers`
--

CREATE TABLE `passport_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passport_centers`
--

INSERT INTO `passport_centers` (`id`, `center_name`) VALUES
(1, 'Aden'),
(2, 'Marib'),
(3, 'Taiz'),
(4, 'Hadramout'),
(5, 'Shabwa'),
(6, 'Al-Mahrah'),
(7, 'Seiyun'),
(8, 'Embassy in Abu Dhabi');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `power_of_attorneys`
--

CREATE TABLE `power_of_attorneys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `emirate_id` varchar(255) NOT NULL,
  `residance_permit` text NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `poa_document` text NOT NULL,
  `purpose` text NOT NULL,
  `client_passport_id` bigint(20) UNSIGNED NOT NULL,
  `agent_passport_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `previous_visits`
--

CREATE TABLE `previous_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visa_application_id` bigint(20) UNSIGNED NOT NULL,
  `visit_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renew_passport_aboves`
--

CREATE TABLE `renew_passport_aboves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `emirates_id` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `left_thumb` text NOT NULL,
  `right_thumb` text DEFAULT NULL,
  `present_passholder` varchar(255) NOT NULL,
  `passport_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `renew_passport_aboves`
--

INSERT INTO `renew_passport_aboves` (`id`, `name`, `phone_number`, `emirates_id`, `photo`, `left_thumb`, `right_thumb`, `present_passholder`, `passport_id`, `created_at`, `updated_at`) VALUES
(1, 'vinay', '4564564565', '45245245', 'uploads/user_30/cPOSLiEdIlVPyPjqOuOHifxrDL3T1GSshjjWkueq.png', 'uploads/user_30/V7sbO96GoAo6y5WgckivufA8nbgpivfu5CLmd40F.pdf', 'uploads/user_30/jlatfr1HGE7TZNjQN8AKOYEPD3ALJ5bfkuElPf6m.pdf', 'test', 277, '2025-05-08 16:26:01', '2025-05-08 16:34:57'),
(2, 'vinay', '4564564565', '45245245', 'uploads/user_30/nT4y0XHHiAXcM9zHW4DzzHydXbvlFeBsf4ySE7vP.png', 'uploads/user_30/PwztHoMQdPl5v1uNluTRWYXxMynyrXGe7VgAHTSd.pdf', NULL, 'test', 280, '2025-05-08 16:51:59', '2025-05-08 16:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Staff', NULL, NULL),
(2, 'Cashier', NULL, NULL),
(3, 'Counselor', NULL, NULL),
(4, 'Ambassador', NULL, NULL),
(5, 'Administrator', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('haWxpfBjLHY89J0YtOywYbRIHB5jwJP1ivzDmS7R', 30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiUVBrWFllbnppNVVNdnI3ZWtyY3pQZ3JoQlJRYXVuWktxWXhpM3hjYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjYxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBwbGljYXRpb25zL2VkaXQtcmVuZXctcGFzc3BvcnQtYWJvdmUvZXlKcGRpSTZJbU5wZWpNelpsRjBjamh2VjB4Q1RsZENSbUpPV1VFOVBTSXNJblpoYkhWbElqb2lZVXR1VnpseVlrVXJiM0ZPVTI1MVdsUkhOa0pUVVQwOUlpd2liV0ZqSWpvaU5HUmlNbU5tWXpobE5qazFObVV5TlRJMk5EWTJNemhqTnpZNE5UQTVOVEV3TkRBellXRXpaREU0TnpRellXUXpNelkwWmpRd09XUmtPR0V4T1RNeVpTSXNJblJoWnlJNklpSjkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6ImNhcHRjaGEiO3M6NToiTkoxd0IiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjMwO3M6MzoiYXBwIjtzOjIwOiJyZW5ld19wYXNzcG9ydF9hYm92ZSI7czo4OiJjYXRlZ29yeSI7czo3OiJteS1hcHBzIjtzOjE0OiJhcHBsaWNhdGlvbl9pZCI7aTo5ODtzOjE2OiJlZGl0X2FwcGxpY2F0aW9uIjtzOjIwOiJyZW5ldy1wYXNzcG9ydC1hYm92ZSI7fQ==', 1746717722),
('Uvy1B8sbfzFq0eBWzKfvgpKL4zg9zXcW3wDQ3nHW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZngxUEVOeXZUdzZSanVtWTJzU3k1d1JOZDNocm5GRW4zSWNXTVVaSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoiY2FwdGNoYSI7czo1OiJYQ1ZWTiI7fQ==', 1746770589);

-- --------------------------------------------------------

--
-- Table structure for table `support_statements`
--

CREATE TABLE `support_statements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `passport_id` bigint(20) UNSIGNED NOT NULL,
  `emirates_id` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `relation_to_beneficiary` varchar(255) NOT NULL,
  `information_provided` varchar(255) NOT NULL,
  `beneficiary_name` varchar(255) NOT NULL,
  `beneficiary_passport_number` varchar(255) NOT NULL,
  `beneficiary_issued_by` varchar(255) NOT NULL,
  `beneficiary_issued_on` date NOT NULL,
  `breadwinner_passport` text NOT NULL,
  `beneficiary_passport` text NOT NULL,
  `birth_certificate` text NOT NULL,
  `registration_summary` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_statements`
--

INSERT INTO `support_statements` (`id`, `name`, `passport_id`, `emirates_id`, `phone_number`, `relation_to_beneficiary`, `information_provided`, `beneficiary_name`, `beneficiary_passport_number`, `beneficiary_issued_by`, `beneficiary_issued_on`, `breadwinner_passport`, `beneficiary_passport`, `birth_certificate`, `registration_summary`, `created_at`, `updated_at`) VALUES
(1, 'vinay', 139, '45245245', '4564564565', 'test', 'test', 'test', '1531354135', 'test', '2025-05-01', 'uploads/user_30/0pmkttSmfHgDNSR9fo3a49JPRR7owj5nBBgquxXD.pdf', 'uploads/user_30/O6hYMKwTmJb8mFLvs5AIkeCKpsf0bT1bLB0NcEC8.pdf', 'uploads/user_30/l7O8fZLSW4awCDWT7T7VMlaRvzdgVwtSYeIbVdGE.pdf', 'uploads/user_30/njqEYJnkTSPb8cCU8WCi6bsEqzJntUWJGn9Qzblv.pdf', '2025-05-06 15:19:40', '2025-05-06 15:31:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nationality` varchar(5) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `address`, `signature`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `nationality`, `is_admin`) VALUES
(26, 'Deekshith Harikumar', 'deekshith@gmail.com', '986543212', NULL, NULL, NULL, '$2y$12$MQ54te23TTbWkAJZ3CuF7e0UvV9AJq7NL6P.btceINCjOKJ80s7uq', NULL, '2025-05-02 02:41:55', '2025-05-02 02:41:55', NULL, 1),
(27, 'Mr. Kunjamma Karuppan', 'goded74340@exitings.com', '9765454987', NULL, NULL, '2025-05-02 09:49:01', '$2y$12$m5JWcj2cfddn0LZ6macIWedq9MykbanIYV2A3BEsSSj7tC3jcwWRO', NULL, '2025-05-02 09:46:56', '2025-05-02 09:49:01', NULL, 0),
(28, 'Vinod Haridas', 'vinodharidas.dev24@gmail.com', '9876543216', NULL, NULL, NULL, '$2y$12$rLqCrfIZRdy4sx8j6bBqw.75rE9Bt/C6zKOmFWc0PQ/5JV4uArIEC', NULL, '2025-05-02 23:33:43', '2025-05-02 23:33:43', NULL, 1),
(29, 'Mr. Testuser', 'vinaypaulkarimathy@gmail.com', '1234567891', NULL, NULL, '2025-05-05 08:44:26', '$2y$12$TAMNagGThEXEVh.WJLos4.gnDuRY/5v7Sk2nG8lb.nK456Mtr6md.', NULL, '2025-05-05 08:40:01', '2025-05-05 08:44:26', NULL, 0),
(30, 'Mr. Testvinay', 'test@gmail.com', '1234567893', NULL, NULL, '2025-05-05 08:49:46', '$2y$12$Jv22si7AlNAqm6.ZvFpaFeAn.dAmABmTyM4YKApS9ej8M7DIzCJuq', NULL, '2025-05-05 08:48:47', '2025-05-05 08:49:46', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_categories`
--

CREATE TABLE `vehicle_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_categories`
--

INSERT INTO `vehicle_categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Category A – Motorcycles', NULL, NULL),
(2, 'Category B – Private Vehicles', NULL, NULL),
(3, 'Category C – Light Commercial Vehicles', NULL, NULL),
(4, 'Category D – Heavy Trucks', NULL, NULL),
(5, 'Category E – Passenger Transport\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visa_accompaniments`
--

CREATE TABLE `visa_accompaniments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visa_application_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `passport_number` varchar(255) NOT NULL,
  `issued_on` date NOT NULL,
  `expires_on` date NOT NULL,
  `passport` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visa_applications`
--

CREATE TABLE `visa_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `permanent_address` text NOT NULL,
  `address_uae` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `proffession` varchar(255) NOT NULL,
  `place_of_work` varchar(255) NOT NULL,
  `purpose_of_travel` text NOT NULL,
  `period_required` int(11) NOT NULL,
  `address_in_roy` text NOT NULL,
  `sponsor_1_name` varchar(255) NOT NULL,
  `sponsor_1_address` text NOT NULL,
  `sponsor_2_name` varchar(255) DEFAULT NULL,
  `sponsor_2_address` text DEFAULT NULL,
  `passport_id` bigint(20) UNSIGNED NOT NULL,
  `id_card` text NOT NULL,
  `sponsor_pass` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visa_applications`
--

INSERT INTO `visa_applications` (`id`, `name`, `nationality`, `religion`, `permanent_address`, `address_uae`, `date_of_birth`, `place_of_birth`, `proffession`, `place_of_work`, `purpose_of_travel`, `period_required`, `address_in_roy`, `sponsor_1_name`, `sponsor_1_address`, `sponsor_2_name`, `sponsor_2_address`, `passport_id`, `id_card`, `sponsor_pass`, `created_at`, `updated_at`) VALUES
(1, 'Mr. Rajeev Kumar', 'IN', 'Hindu', 'Ayckattu Pushpakam \nPeechanikkad \nAngamaly\nUAE', 'Ayckattu Pushpakam \nPeechanikkad \nAngamaly\nUAE', '2002-06-05', 'Kilimanoor', 'Software Engineer', 'Chalakudi', 'Tour', 30, 'some place\nYemen', 'sponsor 1', 'sponsor 1 address', 'sponsor 2', 'sponsor 2 address', 37, '', NULL, '2025-04-04 05:37:29', '2025-04-04 05:37:29'),
(2, 'Mr. Rajeev Kumar', 'AM', 'Hindu', 'Some Address\nAbu dabhi UAE', 'Some Address\nAbu dabhi UAE', '2005-05-04', 'Thrissur', 'Engineer', 'Chalakudy', 'Tourism', 60, 'Some Address\nYemen', 'kljsljda', 'kjhkjhkjh', 'kjh', 'lkkjlkjlk', 37, '', NULL, '2025-04-04 05:41:19', '2025-04-04 05:41:19'),
(3, 'Mr. Rajeev Kumar', 'AE', 'Musilm', 'Dalaal Street\nAbu Dabhi', 'Dalaal Street\nAbu Dabhi', '1965-06-05', 'Abu Dhabi', 'Engineer', 'Dubai', 'Tourism', 10, 'Some Street \nSome Address\nYemen', 'Sponsor Name 1', 'Sponsor Address 2', 'Sponsor Name 1', 'Sponsor Address 2', 39, '', NULL, '2025-04-04 07:49:47', '2025-04-04 07:49:47'),
(4, 'Mr. Rajeev Kumar', 'AO', 'no rel', 'some address\nin \nUAE', 'some address\nin \nUAE', '2024-01-08', 'angola', 'carpenter', 'some where', 'casual', 10, 'some address \nin\nYemen', 'apodi', 'oioipip poi', 'poiopi', 'poipoioipi', 39, 'id-card/10-5374e28d-0d3f-48eb-84ec-87c38016c794.pdf', 'sponsor-pass/10-a117ad80-f801-4072-ac44-bb20216aeb27.pdf', '2025-04-05 02:12:53', '2025-04-05 02:12:53'),
(5, 'Mr. Rajeev Kumar', 'AS', 'sikh', 'This is \nsome address in \nUAE', 'This is \nsome address in \nUAE', '2002-07-09', 'Okhlahoma', 'teacher', 'singapore', 'Tour', 10, 'some address\nin Yemen', 'test name 1', 'test address\nYemen', 'test name 2', 'Test address 2 \nYemen', 39, 'id-card/10-35e38b78-ad71-4bb5-b859-769f0e635f71.pdf', NULL, '2025-04-05 03:05:21', '2025-04-05 03:05:21'),
(6, 'Mr. Rajeev Kumar', 'AR', 'Christian', 'some address\nin the UAE\n changed UAE address', 'some address\nin the UAE\n changed UAE address', '2003-06-05', 'some place', 'Engineer', 'UAE', 'tour', 15, 'some address\nin Yemen', 'ppodop', 'opipoiopi', 'poipoip', 'poipoipoi', 41, 'id-card/10-228e27ff-cb58-4588-a4e9-89ab197df592.pdf', 'sponsor-pass/10-6c107e79-8583-447e-8c8c-509e6ff062d6.pdf', '2025-04-05 04:14:45', '2025-04-05 04:14:45'),
(7, 'Mr. Vinod Haridas', 'AR', 'Christian', 'Some Address\nin \nUAE', 'Some Address\nin \nUAE', '1994-11-12', 'India', 'Engineer', 'UAE', 'Tour', 10, 'Address Yemen', 'sponsor 1', 'Sponsor Address', 'sponsor 2', 'Sponsor Address', 44, 'id-card/11-baa507d8-72f6-4c24-bcd7-c17fd73be409.pdf', 'sponsor-pass/11-5fbe0de4-9831-411e-9d76-5ce6cae8cafd.pdf', '2025-04-05 11:44:19', '2025-04-05 11:44:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_family_members`
--
ALTER TABLE `application_family_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_family_memberspassports`
--
ALTER TABLE `application_family_memberspassports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_family_memberspassports_passport_id_foreign` (`passport_id`),
  ADD KEY `application_family_memberspassports_family_member_id_foreign` (`family_member_id`);

--
-- Indexes for table `birth_certificates`
--
ALTER TABLE `birth_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passport_id` (`passport_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_code` (`country_code`);

--
-- Indexes for table `driving_licences`
--
ALTER TABLE `driving_licences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driving_licence_centers`
--
ALTER TABLE `driving_licence_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forms_user_id_foreign` (`user_id`),
  ADD KEY `forms_verified_by_staff_foreign` (`verified_by_staff`),
  ADD KEY `forms_verified_by_counsillor_foreign` (`verified_by_counsillor`),
  ADD KEY `forms_verified_by_ambassador_foreign` (`verified_by_ambassador`),
  ADD KEY `forms_verified_by_cashier_foreign` (`verified_by_cashier`),
  ADD KEY `forms_current_position_foreign` (`current_position`);

--
-- Indexes for table `form_types`
--
ALTER TABLE `form_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marriage_certificates`
--
ALTER TABLE `marriage_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marriage_certificates_husband_passport_id_foreign` (`husband_passport_id`),
  ADD KEY `marriage_certificates_wife_passport_id_foreign` (`wife_passport_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_id_cards`
--
ALTER TABLE `no_id_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_objection_certificates`
--
ALTER TABLE `no_objection_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passports`
--
ALTER TABLE `passports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passports_user_id_foreign` (`user_id`),
  ADD KEY `issued_by_country_code_foreign` (`issued_by`) USING BTREE;

--
-- Indexes for table `passport_centers`
--
ALTER TABLE `passport_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `power_of_attorneys`
--
ALTER TABLE `power_of_attorneys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `power_of_attorneys_client_passport_id_foreign` (`client_passport_id`),
  ADD KEY `power_of_attorneys_agent_passport_id_foreign` (`agent_passport_id`);

--
-- Indexes for table `previous_visits`
--
ALTER TABLE `previous_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `previous_visits_visa_application_id_foreign` (`visa_application_id`);

--
-- Indexes for table `renew_passport_aboves`
--
ALTER TABLE `renew_passport_aboves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `support_statements`
--
ALTER TABLE `support_statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicle_categories`
--
ALTER TABLE `vehicle_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visa_accompaniments`
--
ALTER TABLE `visa_accompaniments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visa_accompaniments_visa_application_id_foreign` (`visa_application_id`);

--
-- Indexes for table `visa_applications`
--
ALTER TABLE `visa_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passport_id` (`passport_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_family_members`
--
ALTER TABLE `application_family_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `application_family_memberspassports`
--
ALTER TABLE `application_family_memberspassports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `birth_certificates`
--
ALTER TABLE `birth_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `driving_licences`
--
ALTER TABLE `driving_licences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `driving_licence_centers`
--
ALTER TABLE `driving_licence_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `form_types`
--
ALTER TABLE `form_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marriage_certificates`
--
ALTER TABLE `marriage_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `no_id_cards`
--
ALTER TABLE `no_id_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `no_objection_certificates`
--
ALTER TABLE `no_objection_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `passports`
--
ALTER TABLE `passports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `passport_centers`
--
ALTER TABLE `passport_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `power_of_attorneys`
--
ALTER TABLE `power_of_attorneys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `previous_visits`
--
ALTER TABLE `previous_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `renew_passport_aboves`
--
ALTER TABLE `renew_passport_aboves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `support_statements`
--
ALTER TABLE `support_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vehicle_categories`
--
ALTER TABLE `vehicle_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visa_accompaniments`
--
ALTER TABLE `visa_accompaniments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visa_applications`
--
ALTER TABLE `visa_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_family_memberspassports`
--
ALTER TABLE `application_family_memberspassports`
  ADD CONSTRAINT `application_family_memberspassports_family_member_id_foreign` FOREIGN KEY (`family_member_id`) REFERENCES `application_family_members` (`id`),
  ADD CONSTRAINT `application_family_memberspassports_passport_id_foreign` FOREIGN KEY (`passport_id`) REFERENCES `passports` (`id`);

--
-- Constraints for table `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `forms_current_position_foreign` FOREIGN KEY (`current_position`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `forms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `forms_verified_by_ambassador_foreign` FOREIGN KEY (`verified_by_ambassador`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `forms_verified_by_cashier_foreign` FOREIGN KEY (`verified_by_cashier`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `forms_verified_by_counsillor_foreign` FOREIGN KEY (`verified_by_counsillor`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `forms_verified_by_staff_foreign` FOREIGN KEY (`verified_by_staff`) REFERENCES `users` (`id`);

--
-- Constraints for table `marriage_certificates`
--
ALTER TABLE `marriage_certificates`
  ADD CONSTRAINT `marriage_certificates_husband_passport_id_foreign` FOREIGN KEY (`husband_passport_id`) REFERENCES `passports` (`id`),
  ADD CONSTRAINT `marriage_certificates_wife_passport_id_foreign` FOREIGN KEY (`wife_passport_id`) REFERENCES `passports` (`id`);

--
-- Constraints for table `passports`
--
ALTER TABLE `passports`
  ADD CONSTRAINT `passports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `power_of_attorneys`
--
ALTER TABLE `power_of_attorneys`
  ADD CONSTRAINT `power_of_attorneys_agent_passport_id_foreign` FOREIGN KEY (`agent_passport_id`) REFERENCES `passports` (`id`),
  ADD CONSTRAINT `power_of_attorneys_client_passport_id_foreign` FOREIGN KEY (`client_passport_id`) REFERENCES `passports` (`id`);

--
-- Constraints for table `previous_visits`
--
ALTER TABLE `previous_visits`
  ADD CONSTRAINT `previous_visits_visa_application_id_foreign` FOREIGN KEY (`visa_application_id`) REFERENCES `visa_applications` (`id`);

--
-- Constraints for table `visa_accompaniments`
--
ALTER TABLE `visa_accompaniments`
  ADD CONSTRAINT `visa_accompaniments_visa_application_id_foreign` FOREIGN KEY (`visa_application_id`) REFERENCES `visa_applications` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
