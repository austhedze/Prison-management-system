-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 06:21 PM
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
-- Database: `pmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `deletion_logs`
--

CREATE TABLE `deletion_logs` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(255) DEFAULT NULL,
  `inmate_id` int(11) DEFAULT NULL,
  `deletion_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deletion_logs`
--

INSERT INTO `deletion_logs` (`id`, `admin_username`, `inmate_id`, `deletion_time`, `ip_address`) VALUES
(22, 'reen', 95, '2024-11-08 20:44:40', '::1'),
(23, 'reen', 96, '2024-11-08 20:44:43', '::1'),
(24, 'reen', 97, '2024-11-08 20:44:47', '::1'),
(25, 'reen', 99, '2024-11-08 20:50:06', '::1'),
(26, 'reen', 98, '2024-11-08 20:50:09', '::1'),
(27, 'reen', 101, '2024-11-10 13:38:38', '::1'),
(28, 'reen', 102, '2024-11-10 13:54:01', '::1'),
(29, 'reen', 112, '2024-11-10 14:18:58', '::1'),
(30, 'reen', 115, '2024-11-10 14:33:31', '::1'),
(31, 'reen', 140, '2024-11-10 15:14:19', '::1'),
(32, 'reen', 139, '2024-11-10 15:14:32', '::1'),
(33, 'reen', 108, '2024-11-10 16:54:20', '::1'),
(34, 'reen', 129, '2024-11-10 16:54:42', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inmate`
--

CREATE TABLE `inmate` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `offense` varchar(100) DEFAULT NULL,
  `sentence_years` int(11) DEFAULT NULL,
  `court_appearances` int(11) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `pleaded_guilty` varchar(3) DEFAULT NULL,
  `reg_number` varchar(100) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inmate`
--

INSERT INTO `inmate` (`id`, `first_name`, `last_name`, `sex`, `age`, `offense`, `sentence_years`, `court_appearances`, `release_date`, `pleaded_guilty`, `reg_number`, `image_path`, `date_added`) VALUES
(103, 'Hamid', 'Juma', 'Male', 20, 'Rape', 15, 3, '2039-11-21', '1', 'bit-018-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.52_52ffd172.jpg', '2024-11-10 15:52:12'),
(104, 'smile', 'minyaliwa', 'Male', 52, 'murder', 50, 4, '2074-11-30', '1', 'bit-020-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.59_7d4f10b4.jpg', '2024-11-10 15:54:53'),
(105, 'John', 'phiri', 'Male', 22, 'hacking', 4, 2, '2028-11-30', '0', 'bit-027-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.03_22335647.jpg', '2024-11-10 15:58:15'),
(106, 'Zaithwa', 'Nyirenda', 'Male', 20, 'hacking', 4, 2, '2028-11-22', '1', 'bit-026-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.51_bc32890b.jpg', '2024-11-10 16:00:32'),
(107, 'pemphero', 'Elliot', 'Male', 22, 'rape', 15, 1, '2039-11-26', '1', 'bit-015-22', 'uploads/WhatsApp Image 2024-11-10 at 15.40.24_f6d7ab4b.jpg', '2024-11-10 16:02:09'),
(109, 'Mayamiko', 'Mackford', 'Male', 22, 'rape', 10, 2, '2034-11-30', '1', 'bit-019-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.55_21bd79a5.jpg', '2024-11-10 16:07:12'),
(110, 'Wisdom', 'Chinyamu', 'Male', 20, 'rape', 10, 2, '2024-11-30', '0', 'bit-019-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.53_9fd0b851.jpg', '2024-11-10 16:09:12'),
(111, 'Chiposa', 'Chiomba', 'Female', 20, 'murder', 50, 2, '2049-11-28', '1', 'bit-019-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.05_1ae1c050.jpg', '2024-11-10 16:10:37'),
(113, 'Jane', 'Ngwale', 'Female', 21, 'phishing', 10, 2, '2024-11-30', '1', 'bit-031-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.06_bd1918fe.jpg', '2024-11-10 16:14:23'),
(114, 'Khalidwe', 'Chidzanja', 'Male', 20, 'rape', 6, 2, '2027-11-15', '1', 'bit-002-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.06_0a49e49a.jpg', '2024-11-10 16:18:37'),
(116, 'Tasleema ', 'Abdullah', 'Female', 20, 'phishing', 20, 2, '2034-11-30', '0', 'bit-001-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.56_e13c5017.jpg', '2024-11-10 16:21:45'),
(117, 'Shameel', 'Sharif', 'Male', 22, 'murder', 40, 2, '2064-11-30', '1', 'dgi-100-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.03_066bc246.jpg', '2024-11-10 16:23:09'),
(118, 'Vivien', 'Kadammanja', 'Female', 20, 'hacking', 5, 2, '2027-05-30', '1', 'bit-007-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.05_f65e726a.jpg', '2024-11-10 16:26:07'),
(119, 'Anita', 'Gwede', 'Male', 20, 'rape', 20, 2, '2034-11-22', '1', 'bit-006-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.08_9ed2c00b.jpg', '2024-11-10 16:27:17'),
(120, 'Mirrium ', 'Mbedza', 'Female', 20, 'murder', 20, 2, '2034-11-30', '1', 'bit-009-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.02_35d83ed6.jpg', '2024-11-10 16:34:49'),
(121, 'Tamara', 'Gondwe', 'Male', 23, 'phishing', 20, 2, '2034-11-22', '1', 'bit-005-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.06_0a49e49a.jpg', '2024-11-10 16:36:02'),
(122, 'Omega misomali', 'Misomali', 'Female', 22, 'murder', 20, 2, '2034-11-14', '1', 'bit-011-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.05_f65e726a.jpg', '2024-11-10 16:39:20'),
(123, 'Nyasha', 'Chinthu', 'Female', 20, 'hacking', 20, 2, '2034-11-29', '1', 'bit-003-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.05_1ae1c050.jpg', '2024-11-10 16:40:44'),
(124, 'Natasha', 'Mbamba', 'Female', 20, 'phishing', 10, 2, '2029-11-22', '1', 'bit-008-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.53_f467c09a.jpg', '2024-11-10 16:42:13'),
(125, 'Shane', 'Kamwanja', 'Male', 20, 'murder', 10, 2, '2044-11-21', '0', 'css-105-21', 'uploads/WhatsApp Image 2024-11-10 at 13.56.59_7d4f10b4.jpg', '2024-11-10 16:43:18'),
(126, 'Mussa', 'Manyamba', 'Male', 20, 'murder', 40, 2, '2064-11-22', '1', 'Gis-023-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.04_3367acd1.jpg', '2024-11-10 16:44:36'),
(127, 'Kennedy', 'Kachitanda', 'Male', 20, 'rape', 100, 2, '2124-11-22', '0', 'Gis-023-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.01_8c85955a.jpg', '2024-11-10 16:46:14'),
(128, 'Lameck', 'Nsomba', 'Male', 20, 'phishing', 15, 2, '2039-11-14', '0', 'bit-025-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.57_38c10f62.jpg', '2024-11-10 16:48:10'),
(130, 'Adrian', 'Masiano', 'Male', 23, 'phishing', 15, 2, '2039-11-13', '0', 'sed-015-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.09_0a9bc42d.jpg', '2024-11-10 16:52:52'),
(131, 'Prosper', 'Black', 'Male', 21, 'hacking', 10, 2, '2034-11-27', '1', 'bit-013-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.03_22335647.jpg', '2024-11-10 16:54:03'),
(132, 'Kelvin', 'Chima', 'Male', 20, 'murder', 30, 3, '2054-11-22', '0', 'bit-103-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.55_21bd79a5.jpg', '2024-11-10 16:56:09'),
(133, 'pex', 'Julius', 'Male', 21, 'hacking', 10, 2, '2034-11-22', '1', 'bit-017-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.55_21bd79a5.jpg', '2024-11-10 16:58:47'),
(134, 'Ulemu', 'Mkwaila', 'Male', 21, 'murder', 15, 45, '2039-11-14', '0', 'bit-021-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.50_b8a40862.jpg', '2024-11-10 17:00:12'),
(135, 'Benjamin', 'Mwambakulu', 'Male', 21, 'phishing', 20, 2, '2044-11-07', '0', 'bit-023-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.00_e62001ac.jpg', '2024-11-10 17:01:46'),
(136, 'Prince', 'Jobo', 'Male', 20, 'Hacking', 20, 2, '2044-11-15', '1', 'bme-015-21', 'uploads/WhatsApp Image 2024-11-10 at 13.57.03_066bc246.jpg', '2024-11-10 17:03:12'),
(137, 'Moses', 'Thomas', 'Male', 21, 'hacking', 10, 2, '2034-11-13', '0', 'bit-029-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.54_5c2c8db0.jpg', '2024-11-10 17:05:35'),
(138, 'John ', 'Malizani', 'Male', 23, 'murder', 100, 2, '2124-11-22', '1', 'bit-102-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.55_a4027ef8.jpg', '2024-11-10 17:06:56'),
(141, 'Nokotelha', 'Sawasawa', 'Female', 22, 'murder', 50, 2, '2049-11-10', '0', 'css-011-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.06_bd1918fe.jpg', '2024-11-10 17:14:07'),
(142, 'Ullanda', 'masuku', 'Female', 22, 'murder', 50, 2, '2049-11-30', 'no', 'css-100-21', 'uploads/WhatsApp Image 2024-11-10 at 13.56.53_f467c09a.jpg', '2024-11-10 17:15:31'),
(143, 'Ireen', 'Munthali', 'Male', 22, 'hacking', 20, 2, '2034-11-28', '0', 'css-008-22', 'uploads/team-2.jpg', '2024-11-10 17:18:32'),
(144, 'Gift', 'Nyangu', 'Male', 22, 'phishing', 20, 2, '2044-11-22', '0', 'css-029-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.08_0fe1b592.jpg', '2024-11-10 17:19:40'),
(145, 'Jacqueline', 'Zimba', 'Male', 22, 'murder', 40, 2, '2044-11-23', '0', 'css-012-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.08_9ed2c00b.jpg', '2024-11-10 17:20:45'),
(146, 'Stella', 'Kambewa', 'Female', 21, 'hacking', 10, 2, '2029-11-10', '0', 'css-004-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.06_0a49e49a.jpg', '2024-11-10 17:22:25'),
(147, 'precious', 'mpanga', 'Female', 4, 'phishing', 20, 2, '2034-11-16', '0', 'css-007-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.06_0a49e49a.jpg', '2024-11-10 17:25:00'),
(148, 'patience', 'kasambala', 'Female', 21, 'hacking', 10, 2, '2029-11-16', '0', 'css-005-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.06_0a49e49a.jpg', '2024-11-10 17:26:12'),
(149, 'Jesse', 'Mbekeani', 'Male', 22, 'murder', 50, 2, '2074-11-10', '1', '3232011', 'uploads/WhatsApp Image 2024-11-10 at 13.57.04_3367acd1.jpg', '2024-11-10 17:28:01'),
(150, 'George', 'Kalua', 'Male', 32, 'phishing', 10, 1, '2034-11-10', '0', 'Css-022-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.54_3c9294fe.jpg', '2024-11-10 17:29:22'),
(151, 'Blessings', 'Mteteka', 'Male', 24, 'murder', 40, 2, '2064-11-10', '0', 'css/015/22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.55_21bd79a5.jpg', '2024-11-10 17:30:31'),
(152, 'Prince', 'naphambo', 'Male', 55, 'murder', 50, 2, '2074-11-30', '1', 'css-3232008', 'uploads/WhatsApp Image 2024-11-10 at 13.56.54_5c2c8db0.jpg', '2024-11-10 17:34:29'),
(153, 'Thumbiko', 'Banda', 'Male', 25, 'phishing', 20, 3, '2034-11-10', '0', 'css-014-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.07_12bf4e56.jpg', '2024-11-10 17:35:53'),
(154, 'Mzati', 'Tembo', 'Male', 25, 'phishing', 10, 2, '2034-11-10', '1', 'css-108-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.09_0a9bc42d.jpg', '2024-11-10 17:37:34'),
(155, 'Andrew', 'Chiweza', 'Male', 66, 'hacking', 30, 3, '2039-11-10', '1', 'css-020-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.00_e62001ac.jpg', '2024-11-10 17:39:26'),
(156, 'Alexis', 'Masonga', 'Male', 70, 'murder', 100, 2, '2124-11-10', '0', 'Txe-010-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.54_5c2c8db0.jpg', '2024-11-10 17:42:02'),
(157, 'Moses', 'Chazama', 'Male', 52, 'rape', 30, 2, '2054-11-10', '0', 'css-016-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.53_9fd0b851.jpg', '2024-11-10 17:43:18'),
(158, 'Ecram', 'Munthali', 'Male', 67, 'phishing', 14, 3, '2038-11-10', '0', 'css-025-22', 'uploads/WhatsApp Image 2024-11-10 at 13.57.04_3367acd1.jpg', '2024-11-10 17:45:17'),
(159, 'gift', 'mangulenje', 'Male', 24, 'hacking', 12, 2, '2036-11-10', '1', 'css-023-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.52_66384bda.jpg', '2024-11-10 17:46:39'),
(160, 'Tamani', 'Chinyengo', 'Male', 51, 'murder', 100, 2, '2124-11-10', '1', 'css-018-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.57_38c10f62.jpg', '2024-11-10 17:48:17'),
(161, 'mphatso', 'mnyenyembe', 'Male', 32, 'murder', 66, 4, '2100-11-10', '1', 'css-026-22', 'uploads/team-1.jpg', '2024-11-10 17:50:09'),
(162, 'Wiskes', 'munyapa', 'Male', 24, 'hacking', 50, 2, '2024-11-10', 'no', 'css-028-22', 'uploads/WhatsApp Image 2024-11-10 at 15.40.25_d67b6c3c.jpg', '2024-11-10 17:51:45'),
(163, 'Davie ', 'Chikfumbwa', 'Male', 30, 'phishing', 30, 2, '2054-11-10', '1', 'css-017-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.54_5c2c8db0.jpg', '2024-11-10 17:54:23'),
(164, 'Joshu', 'Mhone', 'Male', 55, 'hacking', 100, 3, '2074-11-10', '0', 'fst-014-21', 'uploads/WhatsApp Image 2024-11-10 at 13.56.58_15c0ab0f.jpg', '2024-11-10 17:56:48'),
(165, 'Calvin', 'mbaula', 'Male', 55, 'murder', 100, 3, '2124-11-10', '0', 'css-024-22', 'uploads/WhatsApp Image 2024-11-10 at 15.40.25_7f9a5a74.jpg', '2024-11-10 17:58:36'),
(166, 'Hope', 'Abasi', 'Male', 24, 'rape', 10, 2, '2034-11-10', '0', 'css-013-22', 'uploads/WhatsApp Image 2024-11-10 at 13.56.57_64fae88e.jpg', '2024-11-10 18:00:09'),
(167, 'Sylvester', 'Mawecha', 'Male', 55, 'hacking', 20, 3, '2034-11-10', '0', 'cis-021-21', 'uploads/WhatsApp Image 2024-11-10 at 13.56.55_a4027ef8.jpg', '2024-11-10 18:01:45'),
(168, 'Lewis', 'Mandala', 'Male', 30, 'murder', 40, 45, '2064-11-10', '0', '3232010', 'uploads/WhatsApp Image 2024-11-10 at 13.57.09_0a9bc42d.jpg', '2024-11-10 18:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `inmatemanagement`
--

CREATE TABLE `inmatemanagement` (
  `id` int(11) NOT NULL,
  `inmate_name` varchar(100) NOT NULL,
  `disciplinary_records` text DEFAULT NULL,
  `previous_cell` varchar(50) NOT NULL,
  `new_cell` varchar(50) NOT NULL,
  `transfer_reason` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `inmate_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inmatemanagement`
--

INSERT INTO `inmatemanagement` (`id`, `inmate_name`, `disciplinary_records`, `previous_cell`, `new_cell`, `transfer_reason`, `created_at`, `inmate_image`) VALUES
(20, 'Gift Nyangu', 'possession of unauthorized items', '15', '102', 'The inmate was found with unauthorized items including drugs', '2024-11-10 16:36:31', 'uploads/WhatsApp Image 2024-11-10 at 13.57.08_0fe1b592.jpg'),
(21, 'smile minyaliwa', 'Threatening behavior', '7', '62', 'The inmate has been involved in a fight with another inmate', '2024-11-10 16:39:53', 'uploads/WhatsApp Image 2024-11-10 at 13.56.59_7d4f10b4.jpg'),
(22, 'gift Mangulenje', 'Medical condition requiring isolation', '1', '50', 'The inmate requires a more secure environment for medical treatment', '2024-11-10 16:52:26', 'uploads/WhatsApp Image 2024-11-10 at 13.56.52_66384bda.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inmate_addition_logs`
--

CREATE TABLE `inmate_addition_logs` (
  `log_id` int(11) NOT NULL,
  `reg_number` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `added_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inmate_addition_logs`
--

INSERT INTO `inmate_addition_logs` (`log_id`, `reg_number`, `first_name`, `last_name`, `date_added`, `added_by`) VALUES
(23, 'css/015/22', 'leonard', 'Bekelesi', '2024-11-08 21:36:15', 'reen'),
(24, 'css/015/22', 'leonard', 'Bekelesi', '2024-11-08 21:36:38', 'reen'),
(25, 'css/015/22', 'leonard', 'Bekelesi', '2024-11-08 21:41:36', 'reen'),
(26, 'css/015/22', 'leonard', 'Bekelesi', '2024-11-08 22:48:09', 'reen'),
(27, 'css/015/22', 'leonard', 'Bekelesi', '2024-11-08 22:49:41', 'reen'),
(28, 'css/015/22', 'leonard', 'Bekelesi', '2024-11-10 14:07:50', 'reen'),
(29, 'css/015/22', 'leonard', 'Bekelesi', '2024-11-10 14:17:29', 'reen'),
(30, 'bit-018-22', 'smile', 'minyaliwa', '2024-11-10 15:47:12', 'reen'),
(31, 'bit-018-22', 'Hamid', 'Juma', '2024-11-10 15:52:12', 'reen'),
(32, 'bit-020-22', 'smile', 'minyaliwa', '2024-11-10 15:54:53', 'reen'),
(33, 'bit-027-22', 'John', 'phiri', '2024-11-10 15:58:15', 'reen'),
(34, 'bit-026-22', 'Zaithwa', 'Nyirenda', '2024-11-10 16:00:32', 'reen'),
(35, 'bit-015-22', 'pemphero', 'Elliot', '2024-11-10 16:02:09', 'reen'),
(36, 'bit-030-22', 'Aubrey', 'Zimba', '2024-11-10 16:05:03', 'reen'),
(37, 'bit-019-22', 'Mayamiko', 'Mackford', '2024-11-10 16:07:12', 'reen'),
(38, 'bit-019-22', 'Wisdom', 'Chinyamu', '2024-11-10 16:09:12', 'reen'),
(39, 'bit-019-22', 'Chiposa', 'Chiomba', '2024-11-10 16:10:37', 'reen'),
(40, 'bit-019-22', 'Mirrium', 'Mbedza', '2024-11-10 16:12:24', 'reen'),
(41, 'bit-031-22', 'Jane', 'Ngwale', '2024-11-10 16:14:23', 'reen'),
(42, 'bit-002-22', 'Khalidwe', 'Chidzanja', '2024-11-10 16:18:37', 'reen'),
(43, 'bit-002-22', 'Mirrium', 'Mbedza', '2024-11-10 16:20:16', 'reen'),
(44, 'bit-001-22', 'Tasleema ', 'Abdullah', '2024-11-10 16:21:45', 'reen'),
(45, 'dgi-100-22', 'Shameel', 'Sharif', '2024-11-10 16:23:09', 'reen'),
(46, 'bit-007-22', 'Vivien', 'Kadammanja', '2024-11-10 16:26:07', 'reen'),
(47, 'bit-006-22', 'Anita', 'Gwede', '2024-11-10 16:27:17', 'reen'),
(48, 'bit-009-22', 'Mirrium ', 'Mbedza', '2024-11-10 16:34:49', 'reen'),
(49, 'bit-005-22', 'Tamara', 'Gondwe', '2024-11-10 16:36:02', 'reen'),
(50, 'bit-011-22', 'Omega misomali', 'Misomali', '2024-11-10 16:39:20', 'reen'),
(51, 'bit-003-22', 'Nyasha', 'Chinthu', '2024-11-10 16:40:44', 'reen'),
(52, 'bit-008-22', 'Natasha', 'Mbamba', '2024-11-10 16:42:13', 'reen'),
(53, 'css-105-21', 'Shane', 'Kamwanja', '2024-11-10 16:43:18', 'reen'),
(54, 'Gis-023-22', 'Mussa', 'Manyamba', '2024-11-10 16:44:36', 'reen'),
(55, 'Gis-023-22', 'Kennedy', 'Kachitanda', '2024-11-10 16:46:14', 'reen'),
(56, 'bit-025-22', 'Lameck', 'Nsomba', '2024-11-10 16:48:10', 'reen'),
(57, 'bit-016-22', 'John', 'Gambi', '2024-11-10 16:49:55', 'reen'),
(58, 'sed-015-22', 'Adrian', 'Masiano', '2024-11-10 16:52:52', 'reen'),
(59, 'bit-013-22', 'Prosper', 'Black', '2024-11-10 16:54:03', 'reen'),
(60, 'bit-103-22', 'Kelvin', 'Chima', '2024-11-10 16:56:09', 'reen'),
(61, 'bit-017-22', 'pex', 'Julius', '2024-11-10 16:58:47', 'reen'),
(62, 'bit-021-22', 'Ulemu', 'Mkwaila', '2024-11-10 17:00:12', 'reen'),
(63, 'bit-023-22', 'Benjamin', 'Mwambakulu', '2024-11-10 17:01:46', 'reen'),
(64, 'bme-015-21', 'Prince', 'Jobo', '2024-11-10 17:03:12', 'reen'),
(65, 'bit-029-22', 'Moses', 'Thomas', '2024-11-10 17:05:35', 'reen'),
(66, 'bit-102-22', 'John ', 'Malizani', '2024-11-10 17:06:56', 'reen'),
(67, 'css-100-21', 'Ullanda', 'masuku', '2024-11-10 17:10:53', 'reen'),
(68, 'css-008-22', 'Ireen', 'Munthali', '2024-11-10 17:12:33', 'reen'),
(69, 'css-011-22', 'Nokotelha', 'Sawasawa', '2024-11-10 17:14:07', 'reen'),
(70, 'css-100-21', 'Ullanda', 'masuku', '2024-11-10 17:15:31', 'reen'),
(71, 'css-008-22', 'Ireen', 'Munthali', '2024-11-10 17:18:32', 'reen'),
(72, 'css-029-22', 'Gift', 'Nyangu', '2024-11-10 17:19:40', 'reen'),
(73, 'css-012-22', 'Jacqueline', 'Zimba', '2024-11-10 17:20:45', 'reen'),
(74, 'css-004-22', 'Stella', 'Kambewa', '2024-11-10 17:22:25', 'reen'),
(75, 'css-007-22', 'precious', 'mpanga', '2024-11-10 17:25:00', 'reen'),
(76, 'css-005-22', 'patience', 'kasambala', '2024-11-10 17:26:12', 'reen'),
(77, '3232011', 'Jesse', 'Mbekeani', '2024-11-10 17:28:01', 'reen'),
(78, 'Css-022-22', 'George', 'Kalua', '2024-11-10 17:29:22', 'reen'),
(79, 'css/015/22', 'Blessings', 'Mteteka', '2024-11-10 17:30:31', 'reen'),
(80, 'css-3232008', 'Prince', 'naphambo', '2024-11-10 17:34:29', 'reen'),
(81, 'css-014-22', 'Thumbiko', 'Banda', '2024-11-10 17:35:53', 'reen'),
(82, 'css-108-22', 'Mzati', 'Tembo', '2024-11-10 17:37:34', 'reen'),
(83, 'css-020-22', 'Andrew', 'Chiweza', '2024-11-10 17:39:26', 'reen'),
(84, 'Txe-010-22', 'Alexis', 'Masonga', '2024-11-10 17:42:02', 'reen'),
(85, 'css-016-22', 'Moses', 'Chazama', '2024-11-10 17:43:18', 'reen'),
(86, 'css-025-22', 'Ecram', 'Munthali', '2024-11-10 17:45:17', 'reen'),
(87, 'css-023-22', 'gift', 'mangulenje', '2024-11-10 17:46:39', 'reen'),
(88, 'css-018-22', 'Tamani', 'Chinyengo', '2024-11-10 17:48:17', 'reen'),
(89, 'css-026-22', 'mphatso', 'mnyenyembe', '2024-11-10 17:50:09', 'reen'),
(90, 'css-028-22', 'Wiskes', 'munyapa', '2024-11-10 17:51:45', 'reen'),
(91, 'css-017-22', 'Davie ', 'Chikfumbwa', '2024-11-10 17:54:23', 'reen'),
(92, 'fst-014-21', 'Joshu', 'Mhone', '2024-11-10 17:56:48', 'reen'),
(93, 'css-024-22', 'Calvin', 'mbaula', '2024-11-10 17:58:36', 'reen'),
(94, 'css-013-22', 'Hope', 'Abasi', '2024-11-10 18:00:09', 'reen'),
(95, 'cis-021-21', 'Sylvester', 'Mawecha', '2024-11-10 18:01:45', 'reen'),
(96, '3232010', 'Lewis', 'Mandala', '2024-11-10 18:03:05', 'reen');

-- --------------------------------------------------------

--
-- Table structure for table `inmate_update_log`
--

CREATE TABLE `inmate_update_log` (
  `log_id` int(11) NOT NULL,
  `inmate_id` int(11) NOT NULL,
  `field_updated` varchar(50) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) DEFAULT NULL,
  `log_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inmate_update_log`
--

INSERT INTO `inmate_update_log` (`log_id`, `inmate_id`, `field_updated`, `old_value`, `new_value`, `updated_at`, `updated_by`, `log_date`) VALUES
(134, 102, 'release_date', '2074-11-10', '2074-11-29', '2024-11-10 13:53:42', 'reen', '2024-11-10 15:53:42'),
(135, 102, 'pleaded_guilty', '1', 'yes', '2024-11-10 13:53:42', 'reen', '2024-11-10 15:53:42'),
(136, 142, 'sex', 'Male', 'Female', '2024-11-10 15:17:00', 'reen', '2024-11-10 17:17:00'),
(137, 142, 'sentence_years', '20', '50', '2024-11-10 15:17:00', 'reen', '2024-11-10 17:17:00'),
(138, 142, 'release_date', '2034-11-10', '2049-11-30', '2024-11-10 15:17:00', 'reen', '2024-11-10 17:17:00'),
(139, 142, 'pleaded_guilty', '0', 'no', '2024-11-10 15:17:00', 'reen', '2024-11-10 17:17:00'),
(140, 162, 'offense', 'hcking', 'hacking', '2024-11-10 15:52:41', 'reen', '2024-11-10 17:52:41'),
(141, 162, 'sentence_years', '5', '50', '2024-11-10 15:52:41', 'reen', '2024-11-10 17:52:41'),
(142, 162, 'court_appearances', '3', '2', '2024-11-10 15:52:41', 'reen', '2024-11-10 17:52:41'),
(143, 162, 'release_date', '2029-11-10', '2024-11-10', '2024-11-10 15:52:41', 'reen', '2024-11-10 17:52:41'),
(144, 162, 'pleaded_guilty', '0', 'no', '2024-11-10 15:52:41', 'reen', '2024-11-10 17:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `attempt_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('success','failed') DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `username`, `attempt_time`, `status`, `ip_address`) VALUES
(251, 'reen', '2024-11-10 13:37:57', 'success', '::1'),
(252, 'lenzo', '2024-11-10 13:38:08', 'success', '::1'),
(253, 'reen', '2024-11-10 13:38:34', 'success', '::1'),
(254, 'padre', '2024-11-10 14:27:46', 'success', '::1'),
(255, 'reen', '2024-11-10 14:28:14', 'success', '::1'),
(256, 'lenzo', '2024-11-10 16:09:09', 'success', '::1'),
(257, 'reen', '2024-11-10 16:10:35', 'success', '::1'),
(258, 'lenzo', '2024-11-10 16:53:47', 'success', '::1'),
(259, 'reen', '2024-11-10 16:54:08', 'success', '::1'),
(260, 'padre', '2024-11-10 16:57:51', 'success', '::1'),
(261, 'lenzo', '2024-11-10 17:00:14', 'success', '::1'),
(262, 'reen', '2024-11-10 17:03:34', 'success', '::1'),
(263, 'lenzo', '2024-11-10 17:05:19', 'success', '::1'),
(264, 'reen', '2024-11-10 17:05:52', 'success', '::1'),
(265, 'lenzo', '2024-11-10 17:09:11', 'success', '::1'),
(266, 'padre', '2024-11-10 17:10:44', 'success', '::1'),
(267, 'padre', '2024-11-10 17:11:43', 'success', '::1'),
(268, 'reen', '2024-11-10 17:12:11', 'success', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `staffmanagement`
--

CREATE TABLE `staffmanagement` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `hire_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffmanagement`
--

INSERT INTO `staffmanagement` (`id`, `first_name`, `last_name`, `role`, `age`, `gender`, `phone`, `email`, `hire_date`, `created_at`, `image_path`) VALUES
(41, 'leonard', 'Bekelesi', 'Admin', 30, 'Male', '0983859180', 'css-015-22@must.ac.mw', '2000-11-10', '2024-11-10 16:06:42', 'uploads/ceo.jpg'),
(42, 'Austin', 'Thedzengwa', 'Chief Administrator', 32, 'Male', '0993476552', 'austthezdev@gmail.com', '1995-11-10', '2024-11-10 16:08:56', 'uploads/Screenshot_20240422-160034_1.jpg'),
(43, 'Mayamiko', 'Mlelemba', 'Visitation Manager', 31, 'Male', '0993476667', 'maya@gmail.com', '2001-11-10', '2024-11-10 16:14:10', 'uploads/maya.jfif'),
(44, 'Upendo', 'Mzumara', 'Admin', 31, 'Female', '0993476600', 'upendo@gmail.com', '2001-11-10', '2024-11-10 16:16:10', 'uploads/m5.jpg'),
(45, 'Moses', 'Ngoma', 'Admin', 35, 'Male', '0993424567', 'mose@gmail.com', '2005-11-10', '2024-11-10 16:57:23', 'uploads/moses.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `update_logs`
--

CREATE TABLE `update_logs` (
  `id` int(11) NOT NULL,
  `updater_username` varchar(50) NOT NULL,
  `updated_username` varchar(50) NOT NULL,
  `updated_fields` text NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','main_admin','admin','visitation_manager') NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `confirmPassword` varchar(50) NOT NULL,
  `main_admin_profile_picture` varchar(255) DEFAULT NULL,
  `user_profile_picture` varchar(255) DEFAULT NULL,
  `admin_profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `firstname`, `lastname`, `confirmPassword`, `main_admin_profile_picture`, `user_profile_picture`, `admin_profile_picture`) VALUES
(34, 'padre', '$2y$10$rIJIHkgxR1taLtWMQiQSCOQwQuFNbyq005JplvJhHLWZSWMDaqIIC', 'user', 'joshua', 'muhone', '', NULL, NULL, NULL),
(36, 'lenzo', '$2y$10$u3J0JFv3ZZyMHdhn//6R7.qVFAi.da4Z0kWRiofja9YUIgQSST5DK', 'main_admin', 'leonard', 'Bekelesi', '', 'Images/team-3.jpg', NULL, NULL),
(37, 'mayamiko', '$2y$10$0fO5o9QA9uV8yMgk0kMLsu3PnwnPsXrIeEwQ9f442QbtA.iozUMSa', 'visitation_manager', 'mayamiko', 'mlelemba', '', NULL, NULL, NULL),
(38, 'austin', '$2y$10$8hJDUnG.z3PnuuLzV3UXz.qPsaIIlCS282yLPXCqZhyMIDFtQ/Jhq', 'admin', 'Austin', 'Thedzengwa', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `inmate_name` varchar(255) NOT NULL,
  `visitor_name` varchar(255) NOT NULL,
  `visit_date` date NOT NULL,
  `visit_time` time NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `inmate_name`, `visitor_name`, `visit_date`, `visit_time`, `status`, `reason`, `created_at`, `username`) VALUES
(3, 'Leonard Bekelesi', 'joshua muhone', '2024-11-30', '10:10:00', 'approved', NULL, '2024-11-08 20:39:38', 'padre'),
(4, 'Leonard Bekelesi', 'joshua muhone', '2024-11-30', '12:23:00', 'rejected', 'mmiuuilmk', '2024-11-10 12:23:04', 'padre');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deletion_logs`
--
ALTER TABLE `deletion_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inmate`
--
ALTER TABLE `inmate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inmatemanagement`
--
ALTER TABLE `inmatemanagement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inmate_addition_logs`
--
ALTER TABLE `inmate_addition_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `inmate_update_log`
--
ALTER TABLE `inmate_update_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffmanagement`
--
ALTER TABLE `staffmanagement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_logs`
--
ALTER TABLE `update_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deletion_logs`
--
ALTER TABLE `deletion_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inmate`
--
ALTER TABLE `inmate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `inmatemanagement`
--
ALTER TABLE `inmatemanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `inmate_addition_logs`
--
ALTER TABLE `inmate_addition_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `inmate_update_log`
--
ALTER TABLE `inmate_update_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `staffmanagement`
--
ALTER TABLE `staffmanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
