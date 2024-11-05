-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 04:47 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, 'Who are you', 'I am PMIS chat bot to give any assistance regarding frequently asked questions'),
(2, 'hi', 'Yes, Hello how would i help you?'),
(3, 'Who made you ', 'I was built by web d Group 3 members including: Upendo, Mirrium, Eliot, and Lenzo and Austin '),
(4, 'How can I contact an inmate?', 'Inmates can be contacted through written letters or during visitation hours. Phone calls may be available for certain inmates.'),
(5, 'which days can we visit inmates', 'anyday is convient but weekends are generally of limited access'),
(6, 'how can i contact', 'you can conatact of the PMIS staff members'),
(7, 'how many accounts can i have for this system', 'you can basically have one account for this system'),
(8, 'hello', 'Hy, lets talk'),
(9, 'how do i visit an inmate or prisoner', 'you will have to send a vistation request to visitaion manager'),
(10, 'when can i not visit an inmate', 'Visits on holidays may vary, so please check with the visitation office close to the holiday date.'),
(11, 'Can I send packages to an inmate?', 'Packages are only allowed during approved dates and must contain items on the allowed list.'),
(12, 'how are you?', 'am good what about you.thaks');

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
  `image_path` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inmate`
--

INSERT INTO `inmate` (`id`, `first_name`, `last_name`, `sex`, `cases_committed`, `photo_path`, `age`, `offense`, `sentence_years`, `court_appearances`, `release_date`, `pleaded_guilty`, `reg_number`, `image_path`, `date_added`) VALUES
(78, 'Austin', 'Thedzengwa', 'Male', NULL, NULL, 60, 'murder', 34, 5, '2024-11-11', '1', 'bit/030/22', 'uploads/IMG-20240825-WA0003.jpg', '2024-11-05 14:39:48'),
(79, 'usher', 'lasten', 'Male', NULL, NULL, 60, 'murder', 34, 5, '2024-11-22', '1', 'bit/030/22', 'uploads/smag.jpg', '2024-11-05 14:39:48'),
(81, 'aron', 'phiri', 'Female', NULL, NULL, 20, 'murder', 34, 5, '2024-11-13', '1', 'bit/030/22', 'uploads/IMG-20240707-WA0008.jpg', '2024-11-05 14:39:48'),
(82, 'tas', 'viper', 'Male', NULL, NULL, 34, 'theft', 45, 4, '2024-11-27', '1', 'bit/028/22', 'uploads/IMG-20240729-WA0000.jpg', '2024-11-05 14:39:48'),
(83, 'thez', 'dev', 'Male', NULL, NULL, 24, 'theft', 45, 4, '2024-11-13', '0', 'bit/028/22', 'uploads/smag.jpg', '2024-11-05 14:39:48'),
(84, 'Scott', 'Davins', 'Male', NULL, NULL, 24, 'smuggle', 45, 4, '2024-11-15', '1', 'bit/030/22', 'uploads/maya.jfif', '2024-11-05 14:39:48'),
(85, 'Austin', 'Thedzengwa', 'Male', NULL, NULL, 34, 'robery', 45, 4, '2024-11-20', '1', 'bit/034/22', 'uploads/IMG-20240729-WA0000.jpg', '2024-11-05 14:39:48'),
(86, 'john', 'phiri', 'Male', NULL, NULL, 34, 'phishing', 45, 4, '2024-11-20', '1', 'bit/034/22', 'uploads/IMG-20240824-WA0012.jpg', '2024-11-05 14:39:48'),
(87, 'drugman', 'jones', 'Female', NULL, NULL, 45, 'murder', 78, 5, '2024-12-06', '1', 'cis/031/22', 'uploads/female-pris.jpg', '2024-11-05 16:06:05'),
(88, 'xavier', 'viper', 'Male', NULL, NULL, 24, 'theft', 2, 2, '2024-11-27', '0', 'cis/031/22', 'uploads/IMG-20240814-WA0001.jpg', '2024-11-05 16:07:39'),
(89, 'xazap', 'deaor', 'Female', NULL, NULL, 34, 'robery', 7, 4, '2024-11-28', '1', 'bit/029/22', 'uploads/logo.jpg', '2024-11-05 16:11:17'),
(90, 'lameck', 'nsomba', 'Male', NULL, NULL, 23, 'robery', 23, 3, '2024-11-21', '1', 'bit/028/22', 'uploads/IMG-20240707-WA0008.jpg', '2024-11-05 16:12:21'),
(91, 'lackson', 'lungu', 'Male', NULL, NULL, 34, 'theft', 4, 3, '2024-11-13', '1', 'bit/030/22', 'uploads/IMG-20240814-WA0001.jpg', '2024-11-05 16:36:34');

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
(10, 'dickson', 'ty', '12', '490', '7uhhhh', '2024-10-31 10:57:57', NULL),
(11, 'drugman jones', 'drugs and theft', '23', '78', 'violence and xyz reasons', '2024-11-02 21:03:23', 'uploads/IMG-20240814-WA0001.jpg'),
(12, 'wnayamcizi', 'xyz', '23', '73', 'xyz', '2024-11-02 21:04:42', 'uploads/smag.jpg'),
(13, 'wnayamcizi', 'yewye', '23', '73', 'hdehed', '2024-11-02 21:12:24', 'uploads/female-pris.jpg'),
(14, 'frankson', 'smuggling', '12', '45', 'violence and xyz reasons', '2024-11-02 21:13:52', 'uploads/IMG-20240707-WA0008.jpg'),
(15, 'dickson', 'smuggling', '12', '490', 'violence and xyz reasons', '2024-11-02 21:21:40', 'uploads/inmate.jpg');

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
(7, 'bit/030/22', 'usher', 'lasten', '2024-11-04 23:51:48', 'may@gmail.com'),
(8, 'bit/030/22', 'usherx', 'lasten', '2024-11-05 00:01:11', 'may@gmail.com'),
(9, 'bit/030/22', 'aron', 'phiri', '2024-11-05 12:44:19', 'may@gmail.com'),
(10, 'bit/028/22', 'tas', 'viper', '2024-11-05 12:45:41', 'may@gmail.com'),
(11, 'bit/028/22', 'thez', 'dev', '2024-11-05 12:46:50', 'may@gmail.com'),
(12, 'bit/030/22', 'Scott', 'Davins', '2024-11-05 12:47:42', 'may@gmail.com'),
(13, 'bit/034/22', 'Austin', 'Thedzengwa', '2024-11-05 13:06:15', 'may@gmail.com'),
(14, 'bit/034/22', 'john', 'phiri', '2024-11-05 13:08:03', 'may@gmail.com'),
(15, 'cis/031/22', 'drugman', 'jones', '2024-11-05 16:06:05', 'may@gmail.com'),
(16, 'cis/031/22', 'xavier', 'viper', '2024-11-05 16:07:39', 'may@gmail.com'),
(17, 'bit/029/22', 'xazap', 'deaor', '2024-11-05 16:11:18', 'may@gmail.com'),
(18, 'bit/028/22', 'lameck', 'nsomba', '2024-11-05 16:12:21', 'may@gmail.com'),
(19, 'bit/030/22', 'lackson', 'lungu', '2024-11-05 16:36:34', 'may@gmail.com');

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
(100, 'admin@this.com', '2024-11-05 15:33:07', 'success', '::1');

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
(24, NULL, 'Mlelemba', 'Warder', 20, 'Male', '0997141793', 'maya@pmis.com', '2024-11-29', NULL, '2024-11-01 07:01:36', 'mayamiko', 'uploads/maya.jfif'),
(25, NULL, 'dev', 'Warder', 12, 'Male', '0986876211', 'thezdev0@gmail.com', '2024-11-20', NULL, '2024-11-03 06:52:28', 'thez', 'uploads/IMG-20240814-WA0001.jpg'),
(26, NULL, 'dev', 'Warder', 89, 'Male', '0986876211', 'thezdev0@gmail.com', '2024-11-28', NULL, '2024-11-03 23:15:08', 'thez', 'uploads/inmate.jpg');

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
  `role` enum('user','admin','warder','visitation_manager') NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `confirmPassword` varchar(50) NOT NULL,
  `admin_profile_picture` varchar(255) DEFAULT NULL,
  `user_profile_picture` varchar(255) DEFAULT NULL,
  `warder_profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `firstname`, `lastname`, `confirmPassword`, `admin_profile_picture`, `user_profile_picture`, `warder_profile_picture`) VALUES
(17, 'bit-028-22@must.ac.mw', '$2y$10$5E16f7RUwTM5VwMirzq.B.ax/JRZEXz0R/.sYrNxyD52Ag1pxJ0Di', 'user', 'Austin', 'Thedzengwa', '', NULL, NULL, NULL),
(18, 'admin@thezdev.com', '$2y$10$TROEyVtjwlQutZTizL7wFerpsscFzGGD8Y9cWVViYCEiVbDoOF/rm', 'admin', 'admin', '@dev', '', 'Images/IMG-20240707-WA0008.jpg', NULL, NULL),
(19, 'chipo@dev.com', '$2y$10$leLsKDyBNB1lNX/k/dylSOnsiCOx/GNXjDD1Edt36yhnUwUO5f.wW', '', 'chiposa', 'chiomba', '', NULL, NULL, NULL),
(20, 'upendo@gmail.com', '$2y$10$zEwD6HwRRdGirpmBW5ir1uuAvmDj.SOjJmJ.IM1wZghYerdV7rX/q', 'user', 'upendo', 'mzumala', '', NULL, NULL, NULL),
(21, 'getu@me.com', 'password', 'warder', 'getrude', 'Thedzengwa', '', NULL, NULL, NULL),
(22, 'user@pmis.com', '$2y$10$ccia07dzhQnfVO8.jjABE.xs0PaxGTsfsyroVz/Yl6DQQ75YGmez.', 'user', 'austin', 'Thedzengwar', '', NULL, 'Images/IMG-20240824-WA0007.jpg', NULL),
(23, 'pemphero@gmail.com', '$2y$10$zy.MfSLDzIaW0EzJ1DEQrucf..vKsaW9/C.vuTEvwO2Dsl.pveUsS', 'admin', 'ya1', 'y', '', 'Images/IMG-20240814-WA0001.jpg', NULL, NULL),
(24, 'visit@pmis.com', '$2y$10$hFZgKc5woRD8KUefIbX7Ye3NRc6gItOfN7AiC.0A6XtDYC.wxzFlW', 'visitation_manager', 'visit', 'pmis', '', NULL, NULL, NULL),
(25, 'may@gmail.com', '$2y$10$LFAPqByDC9033YnBVhypOuO9XxlpDJYAO6q77vjbYMohyIhN.RFla', 'warder', '<br /><b>Warning</b>:  Undefined variable $warder ', '<br /><b>Warning</b>:  Undefined variable $warder ', '', NULL, 'Images/smag.jpg', 'Images/female-pris.jpg'),
(26, 'chipo@pmis.com', '$2y$10$QQxKZE37zeiSZuyn0Ej.zugvgPApn9b.DpYdQAJ/au0jUhinfOlnW', 'user', 'chiposa', 'chiomba', '', NULL, 'Images/IMG-20240729-WA0000.jpg', NULL),
(27, 'mvalo@gmail.com', '$2y$10$2In2hKgYGs2I..dhWMD7VOQS7mH9Bc1/Y9c5FKexdU.nFPou.N2U2', 'user', 'beatrice', 'mvalo', '', NULL, NULL, NULL),
(28, 'austin@gmail.com', '$2y$10$NODR5vHbRcRTh5UFV1MZcO7I6b5QMZTZPMLLVq2/sDdeZSafuZTJO', 'warder', 'Austin', 'Thedzengwa', '', NULL, 'Images/IMG-20240825-WA0003.jpg', NULL),
(29, 'admin@this.com', '$2y$10$k.eOFms0K87YHqgowBHv0.A6tAk5iXogZuCJuhp5U9xZdy1sxZ.dC', 'admin', 'moses', 'ngoma', '', 'Images/IMG-20240824-WA0007.jpg', NULL, 'Images/IMG-20240707-WA0008.jpg');

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
(30, 'wnayamcizi', 'getrude', '2024-10-04', '13:56:00', 'rejected', 'sorry agness zimba, we are not currently available', '2024-10-31 20:53:02', NULL, NULL, 'user@pmis.com'),
(31, 'AUSTIN', 'jones', '2024-11-14', '11:37:00', 'rejected', 'no are not avialbale this time ', '2024-11-02 09:33:45', NULL, NULL, 'user@pmis.com'),
(32, 'AUSTIN', 'mayamiko', '2024-11-22', '12:29:00', 'rejected', 'we are not available for now', '2024-11-02 10:27:01', NULL, NULL, 'may@gmail.com'),
(33, 'AUSTIN', 'chiposa chiomba', '2024-11-15', '19:40:00', 'rejected', 'sorry sorry chipo, we are not currently available', '2024-11-05 13:40:53', NULL, NULL, 'chipo@pmis.com'),
(34, 'AUSTIN1', 'chiposa chiomba', '2024-11-08', '15:46:00', 'pending', NULL, '2024-11-05 13:42:23', NULL, NULL, 'chipo@pmis.com');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inmate`
--
ALTER TABLE `inmate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `inmatemanagement`
--
ALTER TABLE `inmatemanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `inmate_addition_logs`
--
ALTER TABLE `inmate_addition_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `staffmanagement`
--
ALTER TABLE `staffmanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
