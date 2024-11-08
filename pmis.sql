-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 12:32 PM
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
(91, 'agness', 'zimba', 'Female', NULL, NULL, 90, 'theft', 77, 5, '2024-11-10', 'yes', 'bit/030/22', 'uploads/IMG-20240814-WA0001.jpg', '2024-11-05 16:36:34'),
(93, 'lackson', 'lungu', 'Male', NULL, NULL, 34, 'rape', 4, 3, '2024-11-12', '1', 'bit/030/21', 'uploads/inmate.jpg', '2024-11-07 01:42:24'),
(94, 'viper', 'zimba', 'Male', NULL, NULL, 45, 'rape', 4, 3, '2024-11-17', '0', 'bit/030/21', 'uploads/IMG-20240729-WA0000.jpg', '2024-11-07 01:43:29');

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
(12, 'wnayamcizi', 'xyz', '23', '73', 'xyz', '2024-11-02 21:04:42', 'uploads/smag.jpg'),
(13, 'wnayamcizi', 'yewye', '23', '73', 'hdehed', '2024-11-02 21:12:24', 'uploads/female-pris.jpg'),
(14, 'frankson', 'smuggling', '12', '45', 'violence and xyz reasons', '2024-11-02 21:13:52', 'uploads/IMG-20240707-WA0008.jpg'),
(15, 'dickson', 'smuggling', '12', '490', 'violence and xyz reasons', '2024-11-02 21:21:40', 'uploads/inmate.jpg'),
(17, 'dickson', 'zxy', '12', '55', 'yzx', '2024-11-07 22:53:39', 'uploads/IMG-20240824-WA0012.jpg'),
(18, 'AUSTIN', 'xyz', '23', '45', '49', '2024-11-08 10:25:23', 'uploads/female-pris.jpg');

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
(214, 'admin@thezdev.com', '2024-11-08 10:40:14', 'success', '::1'),
(215, 'visit@manager.com', '2024-11-08 10:48:43', 'success', '::1'),
(216, 'admin@thezdev.com', '2024-11-08 10:53:05', 'success', '::1'),
(217, 'visit@manager.com', '2024-11-08 10:54:40', 'success', '::1'),
(218, 'newuser@pmsi.com', '2024-11-08 11:10:01', 'success', '::1'),
(219, 'visit@manager.com', '2024-11-08 11:25:35', 'success', '::1'),
(220, 'adminmachine@loop.com', '2024-11-08 11:28:40', 'success', '::1');

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
(19, NULL, 'Thedzengwa', 'Visitation Manager', 56, 'Male', '0997141793', 'thedzengwaaustin@gmail.com', '2024-11-28', NULL, '2024-10-31 11:00:31', 'Austin', 'uploads/IMG-20240825-WA0003.jpg'),
(21, NULL, 'teamsSister', 'Visitation Manager', 28, 'Female', '0997141793', 'lenzotech@gmail.com', '2024-11-29', NULL, '2024-11-01 06:46:45', 'sister', 'uploads/team-sis.jpg'),
(22, NULL, 'belekesi', 'Warder', 27, 'Male', '0997141743', 'lenzotech@gmail.com', '2024-11-19', NULL, '2024-11-01 06:52:06', 'lenz0', 'uploads/ceo.jpg'),
(24, NULL, 'Mlelemba', 'Warder', 20, 'Male', '0997141793', 'maya@pmis.com', '2024-11-29', NULL, '2024-11-01 07:01:36', 'mayamiko', 'uploads/maya.jfif'),
(25, NULL, 'dev', 'Warder', 12, 'Male', '0986876211', 'thezdev0@gmail.com', '2024-11-20', NULL, '2024-11-03 06:52:28', 'thez', 'uploads/IMG-20240814-WA0001.jpg'),
(26, NULL, 'dev', 'Warder', 89, 'Male', '0986876211', 'thezdev0@gmail.com', '2024-11-28', NULL, '2024-11-03 23:15:08', 'thez', 'uploads/inmate.jpg'),
(28, NULL, 'zimba', '', 78, 'Female', '0886430247', 'chimxy@jahma.com', '2024-11-18', NULL, '2024-11-07 22:46:10', 'agness', 'uploads/cor2.jpg');

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
(17, 'bit-028-22@must.ac.mw', '$2y$10$5E16f7RUwTM5VwMirzq.B.ax/JRZEXz0R/.sYrNxyD52Ag1pxJ0Di', 'visitation_manager', 'Austin', 'Thedzengwa', '', NULL, NULL, NULL),
(18, 'admin@thezdev.com', '$2y$10$TROEyVtjwlQutZTizL7wFerpsscFzGGD8Y9cWVViYCEiVbDoOF/rm', 'user', 'admin', '@dev', '', 'Images/IMG-20240707-WA0008.jpg', 'Images/smag.jpg', NULL),
(20, 'upendo@gmail.com', '$2y$10$zEwD6HwRRdGirpmBW5ir1uuAvmDj.SOjJmJ.IM1wZghYerdV7rX/q', 'user', 'upendo', 'mzumala', '', NULL, NULL, NULL),
(22, 'user@pmis.com', '$2y$10$ccia07dzhQnfVO8.jjABE.xs0PaxGTsfsyroVz/Yl6DQQ75YGmez.', 'user', 'austin', 'Thedzengwar', '', NULL, 'Images/IMG-20240824-WA0007.jpg', NULL),
(26, 'chipo@pmis.com', '$2y$10$QQxKZE37zeiSZuyn0Ej.zugvgPApn9b.DpYdQAJ/au0jUhinfOlnW', 'user', 'chiposa', 'chiomba', '', NULL, 'Images/IMG-20240729-WA0000.jpg', NULL),
(28, 'austin@gmail.com', '$2y$10$NODR5vHbRcRTh5UFV1MZcO7I6b5QMZTZPMLLVq2/sDdeZSafuZTJO', 'admin', 'Austin', 'Thedzengwa', '', NULL, 'Images/IMG-20240825-WA0003.jpg', NULL),
(29, 'admin@this.com', '$2y$10$k.eOFms0K87YHqgowBHv0.A6tAk5iXogZuCJuhp5U9xZdy1sxZ.dC', 'user', 'moses', 'ngoma', '', 'Images/female-pris.jpg', NULL, 'Images/IMG-20240707-WA0008.jpg'),
(30, 'newuser@pmsi.com', '$2y$10$quEk2wm1ZyUp247GE32ctODTp2r8f/xAMeNHnmrupYwjtxPv3h3ZC', 'main_admin', 'new', 'user', '', 'Images/IMG-20240814-WA0001.jpg', 'Images/side.png', NULL),
(31, 'visit@manager.com', '$2y$10$O/YGdxjOjJrb0dSSE98ijeiAl6OOzOHBpnbVNlz/fXx/nbifCXlBO', 'visitation_manager', 'visit', 'manager', '', NULL, NULL, NULL),
(32, 'adminmachine@loop.com', '$2y$10$/J9ltJ2E84hreKwq0jGn.OqxpRwvNhce2JJv8G00emvFcLNoJ3QMu', 'admin', 'adminx', 'machine', '', NULL, NULL, 'Images/IMG-20240707-WA0008.jpg');

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
(1, 'AUSTIN1', 'chiposa chiomba', '2024-11-25', '18:23:00', 'rejected', 'we wil be coming to u soon', '2024-11-06 14:23:46', NULL, NULL, 'chipo@pmis.com'),
(2, 'AUSTIN1', 'chiposa chiomba', '2024-11-05', '15:47:00', 'pending', NULL, '2024-11-08 10:48:08', NULL, NULL, 'admin@thezdev.com');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inmate`
--
ALTER TABLE `inmate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `inmatemanagement`
--
ALTER TABLE `inmatemanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `inmate_addition_logs`
--
ALTER TABLE `inmate_addition_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `inmate_update_log`
--
ALTER TABLE `inmate_update_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `staffmanagement`
--
ALTER TABLE `staffmanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
