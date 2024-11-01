-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2024 at 01:42 PM
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
-- Table structure for table `inmate`
--

CREATE TABLE `inmate` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `sex` enum('Male','Female','Other') DEFAULT NULL,
  `cases_committed` text DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `offense` varchar(100) DEFAULT NULL,
  `sentence_years` int(11) DEFAULT NULL,
  `court_appearances` int(11) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `pleaded_guilty` varchar(3) DEFAULT NULL,
  `reg_number` varchar(100) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inmate`
--

INSERT INTO `inmate` (`id`, `first_name`, `last_name`, `sex`, `cases_committed`, `photo_path`, `age`, `offense`, `sentence_years`, `court_appearances`, `release_date`, `pleaded_guilty`, `reg_number`, `image_path`) VALUES
(50, 'kapalamula', 'Scott', 'Male', NULL, NULL, 22, 'smuggle', 44, 4, '2024-10-17', '1', 'bit/029/22', 'uploads/smag.jpg'),
(51, 'drugman', 'jones', 'Male', NULL, NULL, 34, 'drug abuse', 12, 9, '2024-10-15', '1', 'bit/029/22', 'uploads/female-pris.jpg'),
(52, 'Austin', 'Thedzengwa', 'Male', NULL, NULL, 22, 'theft& drugs ', 56, 6, '2024-10-16', '1', 'bit/028/22', 'uploads/IMG-20240825-WA0003.jpg');

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
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inmatemanagement`
--

INSERT INTO `inmatemanagement` (`id`, `inmate_name`, `disciplinary_records`, `previous_cell`, `new_cell`, `transfer_reason`, `created_at`, `image_path`) VALUES
(10, 'AUSTIN', 'fighting and violence', '12', '45', 'whatever reasn', '2024-10-31 10:57:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staffmanagement`
--

CREATE TABLE `staffmanagement` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` enum('Warder','Visitation Manager') NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `hire_date` date NOT NULL,
  `disciplinary_records` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `staff_first_name` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffmanagement`
--

INSERT INTO `staffmanagement` (`id`, `first_name`, `last_name`, `role`, `age`, `gender`, `phone`, `email`, `hire_date`, `disciplinary_records`, `created_at`, `staff_first_name`, `image_path`) VALUES
(18, NULL, 'abdul', 'Warder', 45, 'Male', '0988353336', 'upendo@gmail.com', '2024-10-23', NULL, '2024-10-31 09:43:48', 'tas', 'uploads/IMG-20240729-WA0000.jpg'),
(19, NULL, 'Thedzengwa', 'Visitation Manager', 22, 'Male', '0997141793', 'lenzotech@gmail.com', '2024-10-30', NULL, '2024-10-31 11:00:31', 'Austin', 'uploads/IMG-20240825-WA0003.jpg'),
(21, NULL, 'teamsSister', 'Visitation Manager', 28, 'Female', '0997141793', 'lenzotech@gmail.com', '2024-11-29', NULL, '2024-11-01 06:46:45', 'sister', 'uploads/team-sis.jpg'),
(22, NULL, 'belekesi', 'Warder', 27, 'Male', '0997141743', 'lenzotech@gmail.com', '2024-11-19', NULL, '2024-11-01 06:52:06', 'lenz0', 'uploads/ceo.jpg'),
(23, NULL, 'Davins', 'Warder', 20, 'Male', '0997141795', 'davis@webstarr.com', '2024-11-27', NULL, '2024-11-01 06:58:42', 'Scott', 'uploads/graphic-design.png'),
(24, NULL, 'Mlelemba', 'Warder', 20, 'Male', '0997141793', 'maya@pmis.com', '2024-11-29', NULL, '2024-11-01 07:01:36', 'mayamiko', 'uploads/maya.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin','warder','visitation_manager') NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `confirmPassword` varchar(50) NOT NULL,
  `admin_profile_picture` varchar(255) DEFAULT NULL,
  `user_profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `firstname`, `lastname`, `confirmPassword`, `admin_profile_picture`, `user_profile_picture`) VALUES
(17, 'bit-028-22@must.ac.mw', '$2y$10$5E16f7RUwTM5VwMirzq.B.ax/JRZEXz0R/.sYrNxyD52Ag1pxJ0Di', 'user', 'Austin', 'Thedzengwa', '', NULL, NULL),
(18, 'admin@thezdev.com', '$2y$10$TROEyVtjwlQutZTizL7wFerpsscFzGGD8Y9cWVViYCEiVbDoOF/rm', 'admin', 'admin', '@dev', '', 'Images/IMG-20240807-WA0003.jpg', NULL),
(19, 'chipo@dev.com', '$2y$10$leLsKDyBNB1lNX/k/dylSOnsiCOx/GNXjDD1Edt36yhnUwUO5f.wW', '', 'chiposa', 'chiomba', '', NULL, NULL),
(20, 'upendo@gmail.com', '$2y$10$zEwD6HwRRdGirpmBW5ir1uuAvmDj.SOjJmJ.IM1wZghYerdV7rX/q', 'user', 'upendo', 'mzumala', '', NULL, NULL),
(21, 'getu@me.com', '$2y$10$MbA5knlV5q1U/znD83OQ9ONckjZndtq1H.qbjetZaezB1q./ApfV.', 'visitation_manager', 'getrude', 'Thedzengwa', '', NULL, NULL),
(22, 'user@pmis.com', '$2y$10$ccia07dzhQnfVO8.jjABE.xs0PaxGTsfsyroVz/Yl6DQQ75YGmez.', 'user', 'tas', 'abdul', '', NULL, 'Images/IMG-20240824-WA0012.jpg'),
(23, 'pemphero@gmail.com', '$2y$10$zy.MfSLDzIaW0EzJ1DEQrucf..vKsaW9/C.vuTEvwO2Dsl.pveUsS', 'admin', 'eliot', 'pemphero', '', 'Images/IMG-20240814-WA0001.jpg', NULL),
(24, 'visit@pmis.com', '$2y$10$hFZgKc5woRD8KUefIbX7Ye3NRc6gItOfN7AiC.0A6XtDYC.wxzFlW', 'visitation_manager', 'visit', 'pmis', '', NULL, NULL),
(25, 'may@gmail.com', '$2y$10$LFAPqByDC9033YnBVhypOuO9XxlpDJYAO6q77vjbYMohyIhN.RFla', 'user', 'mayamiko', 'mlelemba', '', NULL, 'Images/maya.jfif'),
(26, 'chipo@pmis.com', '$2y$10$QQxKZE37zeiSZuyn0Ej.zugvgPApn9b.DpYdQAJ/au0jUhinfOlnW', 'user', 'chiposa', 'chiomba', '', NULL, NULL);

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
  `visitor_username` varchar(255) DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `inmate_name`, `visitor_name`, `visit_date`, `visit_time`, `status`, `reason`, `created_at`, `visitor_username`, `user_id`, `username`) VALUES
(29, 'BLESSINGS THEDZENGWA', 'austin', '2024-10-11', '18:48:00', 'approved', NULL, '2024-10-24 12:44:44', NULL, NULL, 'bit-028-22@must.ac.mw'),
(30, 'wnayamcizi', 'getrude', '2024-10-04', '13:56:00', 'pending', NULL, '2024-10-31 20:53:02', NULL, NULL, 'user@pmis.com');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `staffmanagement`
--
ALTER TABLE `staffmanagement`
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
-- AUTO_INCREMENT for table `inmate`
--
ALTER TABLE `inmate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `inmatemanagement`
--
ALTER TABLE `inmatemanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staffmanagement`
--
ALTER TABLE `staffmanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
