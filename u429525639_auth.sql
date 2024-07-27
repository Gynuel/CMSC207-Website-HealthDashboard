-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2024 at 09:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u429525639_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `indx` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`indx`, `user_id`, `first_name`, `last_name`, `email`, `password`, `create_date`, `update_date`) VALUES
(1, 'DOH_0000000001', 'Emanuel', 'Gloria', 'emangloria@gmail.com', '123', '2024-04-04 02:06:47', '2024-04-04 02:06:47'),
(2, 'DOH_0000000002', 'Test', 'Test2', 'test@gmail.com', '$2y$10$o6vgx09QUGFDxwEINMmuA.WLWKuLtn63fFLiPFMseQ6.Y027szxwu', '2024-04-04 13:47:17', '2024-04-04 13:47:17'),
(3, 'DOH_0000000003', 'TT', 'YY', 'test2@gmail.com', '$2y$10$hUzosCBdq8ukpuFLQMy.1uklCffHLvYkMqTq385OgZCj0EE5kPqbG', '2024-04-04 15:09:35', '2024-04-04 15:09:35'),
(4, 'DOH_0000000004', '123', '123', '123@gmail.com', '$2y$10$5Gc4MHVZVgOK3i2O.kK/V.5hj7R8clc1Z8ZC43I0Cfo0f8t6I/3Ly', '2024-04-04 15:12:19', '2024-04-04 15:12:19'),
(5, 'DOH_0000000005', '1234', '1234', '1234@gmail.com', '$2y$10$APsXO33wTg8gfO7xVhFMKOo.nMPC5KQwNO91g7j6rxmRoBR8FyHLe', '2024-04-04 15:15:46', '2024-04-04 15:15:46'),
(6, 'DOH_0000000006', 'Viel', 'Test', 'viel@gmail.com', '$2y$10$FYiW1GDbv8rsJMvq.EzFyuaBuY394ZPLfjhE.yEjTE8ivS6ywF586', '2024-04-06 01:53:11', '2024-04-06 01:53:11'),
(7, 'DOH_0000000007', 'Rest', 'Rest', 'rest@gmail.com', '$2y$10$iYwyt3yFGZn6DL0ZsDd.SeyLc1JT16MwFt8oeTrxPngzBI9DbdeuW', '2024-04-14 08:24:28', '2024-04-14 08:24:28'),
(8, 'DOH_0000000008', 'Emanuel', 'Gloria', 'test@doh.gov.ph', '$2y$10$fiNwEouKUUREIlad390I5.mEDCFj99wVUrI7U3gFonf07X9ORFAAW', '2024-04-16 16:21:20', '2024-04-16 16:21:20');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `getID` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
	INSERT INTO id_value_tb VALUES (NULL);
    SET NEW.user_id = CONCAT("DOH_",LPAD(LAST_INSERT_ID(),10,"0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `indx` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `doh_employee` varchar(100) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`indx`, `client_id`, `name`, `email`, `gender`, `birthday`, `doh_employee`, `create_date`, `update_date`) VALUES
(1, 'Client_0000000001', 'Emanuel Gloria', 'emangloria@gmail.com', 'male', '2024-04-21', 'no', '2024-04-21 09:10:18', '2024-04-21 14:44:33'),
(2, 'Client_0000000002', 'hnfgj', 'test@doh.gov.ph', 'female', '2024-04-19', 'no', '2024-04-21 10:16:18', '2024-04-21 10:16:18'),
(3, 'Client_0000000003', '', 'test@gmail.com', 'female', '2024-04-10', 'no', '2024-04-21 10:20:56', '2024-04-21 10:20:56'),
(4, 'Client_0000000004', '', 'nicole@gmail.com', 'others', '2024-05-03', 'no', '2024-04-21 11:27:46', '2024-04-21 11:27:46'),
(5, 'Client_0000000005', 'Eman', 'gloria@gmail.com', 'male', '2024-04-17', 'no', '2024-04-21 12:09:31', '2024-04-21 12:09:31'),
(6, 'Client_0000000006', 'hnfgj', '123@gmail.com', 'female', '2024-04-04', 'no', '2024-04-21 12:12:36', '2024-04-21 12:12:36'),
(7, 'Client_0000000007', 'Eman', 'man@gmail.com', 'others', '2024-04-18', 'no', '2024-04-21 12:15:13', '2024-04-21 12:15:13'),
(8, 'Client_0000000008', 'Eman', 'ED123@gmail.com', 'others', '2024-05-02', 'no', '2024-04-21 12:20:03', '2024-04-21 12:20:03'),
(9, 'Client_0000000009', 'CGDFSGDS', 'DSFSDFDSF@GMAIL.COM', 'others', '2024-04-25', 'no', '2024-04-21 12:22:24', '2024-04-21 12:22:24'),
(10, 'Client_0000000010', 'DSFSDFDSF', '1234@gmail.com', 'female', '2024-04-19', 'no', '2024-04-21 12:25:14', '2024-04-21 12:25:14'),
(11, 'Client_0000000011', 'DSFGSD', 'SFDS@GMAIL.COM', 'female', '2024-05-04', 'no', '2024-04-21 12:26:50', '2024-04-21 12:26:50'),
(12, 'Client_0000000012', 'FDGDF', 'GF@GMAIL.COM', 'female', '2024-04-13', 'yes', '2024-04-21 12:28:13', '2024-04-24 15:40:16'),
(13, 'Client_0000000013', 'DFGDF', 'FG@GMAIL.COM', 'female', '2024-04-10', 'yes', '2024-04-21 12:29:00', '2024-04-24 15:40:27'),
(14, 'Client_0000000014', 'fg', 'f@gmail.com', 'female', '2024-04-25', 'yes', '2024-04-21 12:38:58', '2024-04-24 15:40:36'),
(15, 'Client_0000000015', 'Eman', 'test2@gmail.com', 'female', '2024-04-03', 'no', '2024-04-21 14:02:43', '2024-04-21 14:02:43'),
(16, 'Client_0000000016', 'dsf', 'emang@gmail.com', 'male', '2024-04-17', 'no', '2024-04-21 14:06:46', '2024-04-21 14:06:46'),
(17, 'Client_0000000017', 'Emanuel Gloria', 'gloria@up.edu.ph', 'male', '2024-04-04', 'no', '2024-04-23 11:07:07', '2024-04-23 11:07:07');

--
-- Triggers `client`
--
DELIMITER $$
CREATE TRIGGER `getClientID` BEFORE INSERT ON `client` FOR EACH ROW BEGIN
	INSERT INTO id_client_tb VALUES (NULL);
    SET NEW.client_id = CONCAT("Client_",LPAD(LAST_INSERT_ID(),10,"0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `form1_survey`
--

CREATE TABLE `form1_survey` (
  `indx` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `service_code` varchar(50) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isactivate` tinyint(1) DEFAULT 0,
  `activation_date` datetime DEFAULT NULL,
  `service_id` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `provider_name` varchar(255) DEFAULT NULL,
  `iscompletepage_one` tinyint(1) DEFAULT 0,
  `expectation_rating` int(11) DEFAULT NULL,
  `q1_rating` int(11) DEFAULT NULL,
  `q2_rating` int(11) DEFAULT NULL,
  `q3_rating` int(11) DEFAULT NULL,
  `q4_rating` int(11) DEFAULT NULL,
  `q5_rating` int(11) DEFAULT NULL,
  `q6_rating` int(11) DEFAULT NULL,
  `iscompletepage_two` tinyint(1) DEFAULT 0,
  `overall_rating` int(11) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `surveycomplete` tinyint(1) DEFAULT 0,
  `completion_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form1_survey`
--

INSERT INTO `form1_survey` (`indx`, `transaction_id`, `service_code`, `create_date`, `update_date`, `isactivate`, `activation_date`, `service_id`, `client_id`, `provider_id`, `provider_name`, `iscompletepage_one`, `expectation_rating`, `q1_rating`, `q2_rating`, `q3_rating`, `q4_rating`, `q5_rating`, `q6_rating`, `iscompletepage_two`, `overall_rating`, `comments`, `surveycomplete`, `completion_date`) VALUES
(3, 'Survey_0000000004', 'ASDF', '2024-04-21 08:00:22', '2024-04-26 17:26:20', 1, '2024-04-21 01:22:01', 'S3', 'Client_0000000003', 'BOQ', NULL, 1, 6, 5, 6, 7, 1, 3, 4, 1, 3, 'Absolutely outstanding service! The staff went above and beyond to make me feel comfortable and cared for.', 1, '2024-04-21 01:22:01'),
(4, 'Survey_0000000005', 'A001A', '2024-04-21 08:49:10', '2024-04-26 17:27:16', 1, '2024-04-21 01:26:29', 'S2', 'Client_0000000002', 'BLHSD', NULL, 1, 4, 3, 4, 4, 5, 5, 2, 1, 1, 'I couldn\'t have asked for better care. The doctors were knowledgeable and empathetic.', 1, '2024-04-21 01:26:29'),
(5, 'Survey_0000000006', 'A002A', '2024-04-21 08:51:04', '2024-04-26 17:27:40', 1, '2024-04-21 01:27:20', 'S4', 'Client_0000000002', 'HPCS', NULL, 1, 6, 3, 4, 2, 5, 5, 1, 1, 4, 'The healthcare service provided exceeded my expectations. I felt like my well-being was their top priority.', 1, '2024-04-21 01:27:20'),
(6, 'Survey_0000000007', 'A003A', '2024-04-21 09:09:52', '2024-04-26 17:28:07', 1, '2024-04-21 01:27:44', 'S1', 'Client_0000000005', 'AS', NULL, 1, 3, 5, 6, 3, 4, 5, 3, 1, 3, 'I\'m grateful for the compassionate and attentive care I received from the healthcare team.', 1, '2024-04-21 01:27:44'),
(7, 'Survey_0000000008', 'A004A', '2024-04-21 09:13:28', '2024-04-26 17:28:40', 1, '2024-04-21 01:28:12', 'S1', 'Client_0000000006', 'BLHSD', NULL, 1, 6, 3, 3, 3, 3, 3, 3, 1, 4, 'The professionalism of the staff was impressive. They made sure I understood every step of the process.', 1, '2024-04-21 01:28:12'),
(8, 'Survey_0000000009', 'A005A', '2024-04-21 09:26:47', '2024-04-26 17:29:09', 1, '2024-04-21 01:28:44', 'S2', 'Client_0000000001', 'AS', 'John', 1, 6, 5, 5, 5, 5, 5, 5, 1, 2, 'The healthcare service was efficient and thorough. I appreciated how smoothly everything went.', 1, '2024-04-21 01:28:44'),
(9, 'Survey_0000000010', 'A006A', '2024-04-21 09:27:56', '2024-04-26 17:29:36', 1, '2024-04-21 01:29:12', 'S2', 'Client_0000000006', 'BIHC', NULL, 1, 5, 2, 2, 4, 4, 3, 3, 1, 1, 'I felt respected and listened to throughout my entire experience with this healthcare provider.', 1, '2024-04-21 01:29:12'),
(10, 'Survey_0000000011', 'A007A', '2024-04-21 09:33:57', '2024-04-26 17:30:06', 1, '2024-04-21 01:29:42', 'S3', 'Client_0000000001', 'FMS', 'John', 1, 4, 3, 5, 6, 3, 2, 1, 1, 4, 'The facilities were clean and modern, which added to the overall positive experience.', 1, '2024-04-21 01:29:42'),
(11, 'Survey_0000000012', 'A008A', '2024-04-21 09:37:36', '2024-04-26 17:30:35', 1, '2024-04-21 01:30:13', 'S2', 'Client_0000000013', 'BLHSD', NULL, 1, 2, 4, 6, 3, 2, 4, 4, 1, 4, 'I would highly recommend this healthcare service to anyone in need. They truly care about their patients.', 1, '2024-04-21 01:30:13'),
(12, 'Survey_0000000013', 'A009A', '2024-04-21 09:40:24', '2024-04-26 17:31:02', 1, '2024-04-21 01:30:41', 'S6', 'Client_0000000007', 'HEMB', NULL, 1, 4, 3, 4, 3, 1, 2, 3, 1, 4, 'From scheduling to discharge, every aspect of the service was top-notch.', 1, '2024-04-21 01:30:41'),
(13, 'Survey_0000000014', '', '2024-04-21 09:47:06', '2024-04-26 17:31:26', 1, '2024-04-21 01:31:08', 'S8', 'Client_0000000001', 'FMS', '', 1, 3, 4, 4, 4, 3, 4, 5, 1, 1, 'I\'m impressed by the level of expertise demonstrated by the healthcare professionals.', 1, '2024-04-21 01:31:08'),
(14, 'Survey_0000000015', 'A010A', '2024-04-21 10:10:39', '2024-04-26 17:31:56', 1, '2024-04-21 01:31:33', 'S2', 'Client_0000000001', 'FMS', '', 1, 6, 3, 4, 5, 4, 4, 2, 1, 3, 'The personalized attention I received made me feel like more than just a patient.', 1, '2024-04-21 01:31:33'),
(15, 'Survey_0000000016', 'A011A', '2024-04-21 10:15:51', '2024-04-26 17:32:28', 1, '2024-04-21 01:32:06', 'S7', 'Client_0000000012', 'KMITS', NULL, 1, 7, 4, 5, 6, 4, 3, 4, 1, 4, 'The staff\'s kindness and patience made a difficult situation much easier to handle.', 1, '2024-04-21 01:32:06'),
(16, 'Survey_0000000017', 'A012A', '2024-04-21 10:20:13', '2024-04-26 17:33:02', 1, '2024-04-24 01:32:34', 'S3', 'Client_0000000002', 'HHRDB', '', 1, 4, 3, 4, 3, 4, 4, 3, 1, 3, 'I feel confident in the care I received and am grateful for the support provided.', 1, '2024-04-24 01:32:34'),
(17, 'Survey_0000000018', 'A013A', '2024-04-21 10:20:39', '2024-04-26 17:33:58', 1, '2024-04-24 01:33:29', 'S6', 'Client_0000000003', 'HHRDB', '', 1, 3, 3, 3, 3, 3, 3, 3, 1, 3, 'This healthcare service sets a high standard for quality and patient satisfaction.', 1, '2024-04-24 01:33:29'),
(18, 'Survey_0000000019', 'A013A', '2024-04-21 10:48:11', '2024-04-26 17:34:32', 1, '2024-04-24 01:34:07', 'S3', 'Client_0000000009', 'BLHSD', NULL, 1, 7, 4, 6, 3, 4, 3, 5, 1, 4, 'I appreciate the efficiency and effectiveness of the treatment I received.', 1, '2024-04-24 01:34:07'),
(19, 'Survey_0000000020', 'A014A', '2024-04-21 11:27:00', '2024-04-26 17:35:03', 1, '2024-04-24 01:34:37', 'S3', 'Client_0000000004', 'AS', 'Jr', 1, 5, 3, 7, 4, 5, 5, 3, 1, 2, 'The staff\'s dedication to their work and patients is evident in every interaction.', 1, '2024-04-24 01:34:37'),
(20, 'Survey_0000000021', 'A015A', '2024-04-21 12:08:50', '2024-04-26 17:35:33', 1, '2024-04-24 01:35:11', 'S3', 'Client_0000000005', 'FMS', 'N/A', 1, 6, 3, 6, 3, 6, 6, 6, 1, 2, 'The healthcare service provided a seamless experience from start to finish.', 1, '2024-04-24 01:35:11'),
(21, 'Survey_0000000022', 'A016A', '2024-04-21 12:12:20', '2024-04-26 17:36:08', 1, '2024-04-24 01:35:42', 'S3', 'Client_0000000006', 'FMS', 'fdfd', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'I\'m thankful for the accessibility of this healthcare provider. They made it easy to get the care I needed.', 1, '2024-04-24 01:35:42'),
(22, 'Survey_0000000023', 'A017A', '2024-04-21 12:14:38', '2024-04-26 17:36:45', 1, '2024-04-24 01:36:16', 'S4', 'Client_0000000008', 'FDA', 'FDSFSDF', 1, 5, 1, 1, 2, 3, 2, 2, 1, 6, 'The attention to detail and thoroughness of the care provided were impressive', 1, '2024-04-24 01:36:16'),
(23, 'Survey_0000000024', 'A018A', '2024-04-21 12:22:08', '2024-04-26 17:37:11', 1, '2024-04-24 01:36:51', 'S3', 'Client_0000000009', 'FMS', 'HJGMGHJM', 1, 5, 4, 4, 4, 4, 4, 4, 1, 4, 'I felt like I was in good hands throughout my entire visit.', 1, '2024-04-24 01:36:51'),
(24, 'Survey_0000000025', 'A019A', '2024-04-21 12:24:43', '2024-04-26 17:38:05', 1, '2024-04-21 01:37:31', 'S2', 'Client_0000000010', 'AS', 'FDSFDSF', 1, 4, 2, 5, 3, 4, 4, 4, 1, 1, 'The professionalism and compassion of the staff made a stressful situation much more manageable.', 1, '2024-04-21 01:37:31'),
(25, 'Survey_0000000026', 'A020A', '2024-04-21 12:26:35', '2024-04-26 17:38:43', 1, '2024-04-21 01:38:22', 'S4', 'Client_0000000011', 'CHD_11', 'FGHFGHF', 1, 4, 3, 5, 4, 4, 3, 5, 1, 4, 'I was pleasantly surprised by how quickly I was seen and treated.', 1, '2024-04-21 01:38:22'),
(26, 'Survey_0000000027', 'A021A', '2024-04-21 12:27:51', '2024-04-26 17:39:13', 1, '2024-04-21 01:38:51', 'S3', 'Client_0000000013', 'MPO', 'DSF', 1, 4, 4, 3, 3, 6, 4, 5, 1, 4, 'The healthcare service demonstrated a commitment to excellence in every aspect.', 1, '2024-04-21 01:38:51'),
(27, 'Survey_0000000028', 'A022A', '2024-04-21 12:38:38', '2024-04-26 17:39:44', 1, '2024-04-21 01:39:20', 'S6', 'Client_0000000014', 'FMS', 'fdghdf', 1, 3, 4, 3, 3, 3, 5, 3, 1, 4, 'The staff\'s dedication to patient care is truly commendable.', 1, '2024-04-21 01:39:20'),
(28, 'Survey_0000000029', 'A023A', '2024-04-21 14:02:29', '2024-04-26 17:40:24', 1, '2024-04-24 01:39:50', 'S3', 'Client_0000000015', 'MPO', 'gfdgdf', 1, 4, 4, 4, 4, 4, 4, 4, 1, 2, 'I left feeling confident in the treatment plan provided by the healthcare team.', 1, '2024-04-24 01:39:50'),
(29, 'Survey_0000000030', 'A024A', '2024-04-21 14:06:14', '2024-04-26 17:40:50', 1, '2024-04-24 01:40:32', 'S3', 'Client_0000000016', 'FDA', 'hjgjgh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 4, 'The facilities were welcoming and comfortable, which helped alleviate any anxiety I had.', 1, '2024-04-24 01:40:32'),
(30, 'Survey_0000000031', 'A025A', '2024-04-21 14:19:54', '2024-04-26 17:41:17', 1, '2024-04-24 01:40:56', 'S3', 'Client_0000000001', 'MPO', 'FDSFSDF', 1, 4, 5, 6, 4, 3, 5, 6, 1, 3, 'I appreciate the thoroughness of the follow-up care provided by the healthcare team.', 1, '2024-04-24 01:40:56'),
(31, 'Survey_0000000032', 'A026A', '2024-04-21 14:30:03', '2024-04-26 17:41:43', 1, '2024-04-21 01:41:25', 'S3', 'Client_0000000001', 'FMS', 'N/A', 1, 5, 7, 7, 7, 7, 7, 7, 1, 4, 'The healthcare service provided peace of mind during a difficult time.', 1, '2024-04-21 01:41:25'),
(32, 'Survey_0000000033', 'A027A', '2024-04-23 11:06:42', '2024-04-26 17:42:18', 1, '2024-04-23 01:41:53', 'S3', 'Client_0000000017', 'FMS', 'N/A', 1, 5, 7, 7, 7, 7, 7, 7, 1, 4, 'Overall, I\'m extremely satisfied with the care I received from this healthcare provider.', 1, '2024-04-23 01:41:53'),
(33, 'Survey_0000000035', 'BASD001', '2024-04-26 17:47:05', '2024-04-26 17:52:44', 0, NULL, 'S2', NULL, 'BLHSD', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(34, 'Survey_0000000036', 'BASD002', '2024-04-26 17:48:12', '2024-04-26 17:53:20', 0, NULL, 'S4', NULL, 'BOQ', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(35, 'Survey_0000000037', 'BASD003', '2024-04-26 17:54:26', '2024-04-26 17:54:26', 0, NULL, 'S1', NULL, 'AS', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(36, 'Survey_0000000038', 'BASD004', '2024-04-26 17:54:26', '2024-04-26 17:54:26', 0, NULL, 'S2', NULL, 'BLHSD', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(37, 'Survey_0000000039', 'BASD005', '2024-04-26 17:55:37', '2024-04-26 17:55:37', 0, NULL, 'S5', NULL, 'BIHC', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(38, 'Survey_0000000040', 'BASD006', '2024-04-26 17:55:37', '2024-04-26 17:55:37', 0, NULL, 'S6', NULL, 'CHD_2', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(39, 'Survey_0000000041', 'BASD007', '2024-04-26 17:56:54', '2024-04-26 17:56:54', 0, NULL, 'S2', NULL, 'AS', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(40, 'Survey_0000000042', 'BASD008', '2024-04-26 17:56:54', '2024-04-26 17:56:54', 0, NULL, 'S3', NULL, 'BIHC', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(41, 'Survey_0000000043', 'BASD009', '2024-04-26 17:57:33', '2024-04-26 17:57:33', 0, NULL, 'S1', NULL, 'BOQ', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(42, 'Survey_0000000044', 'BASD010', '2024-04-26 17:57:33', '2024-04-26 17:57:33', 0, NULL, 'S1', NULL, 'BOQ', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL);

--
-- Triggers `form1_survey`
--
DELIMITER $$
CREATE TRIGGER `getTransactionID` BEFORE INSERT ON `form1_survey` FOR EACH ROW BEGIN
	INSERT INTO id_transaction_tb VALUES (NULL);
    SET NEW.transaction_id = CONCAT("Survey_",LPAD(LAST_INSERT_ID(),10,"0"));
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `id_client_tb`
--

CREATE TABLE `id_client_tb` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_client_tb`
--

INSERT INTO `id_client_tb` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17);

-- --------------------------------------------------------

--
-- Table structure for table `id_transaction_tb`
--

CREATE TABLE `id_transaction_tb` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_transaction_tb`
--

INSERT INTO `id_transaction_tb` (`id`) VALUES
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44);

-- --------------------------------------------------------

--
-- Table structure for table `id_value_tb`
--

CREATE TABLE `id_value_tb` (
  `id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_value_tb`
--

INSERT INTO `id_value_tb` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8);

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `indx` int(11) NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  `office` varchar(255) DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`indx`, `provider_id`, `office`, `team`, `create_date`, `update_date`) VALUES
(1, 'AS', 'Administrative Service', 'Administration and Financial Management Team', '2024-04-14 13:43:40', '2024-04-14 13:43:40'),
(24, 'BIHC', 'Bureau of International Health Cooperation', 'Health Policy and Systems Development Team', '2024-04-14 14:00:16', '2024-04-14 14:02:40'),
(25, 'BLHSD', 'Bureau of Local Health Systems and Development', 'Health Policy and Systems Development Team', '2024-04-14 14:01:21', '2024-04-14 14:03:25'),
(28, 'BOQ', 'Bureau of Quarantine', 'Health Regulation Team', '2024-04-14 14:06:31', '2024-04-14 14:06:31'),
(5, 'CHD_1', 'Center for Health Development I', 'Field Implementation and Coordination Team', '2024-04-14 13:50:31', '2024-04-14 13:50:31'),
(15, 'CHD_10', 'Center for Health Development X', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(16, 'CHD_11', 'Center for Health Development XI', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(17, 'CHD_12', 'Center for Health Development XII', 'Field Implementation and Coordination Team', '2024-04-14 13:58:09', '2024-04-14 13:58:09'),
(6, 'CHD_2', 'Center for Health Development II', 'Field Implementation and Coordination Team', '2024-04-14 13:50:55', '2024-04-14 13:50:55'),
(7, 'CHD_3', 'Center for Health Development III', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(8, 'CHD_4A', 'Center for Health Development IV-A', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(9, 'CHD_4B', 'Center for Health Development IV-B', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(10, 'CHD_5', 'Center for Health Development V', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(11, 'CHD_6', 'Center for Health Development VI', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(12, 'CHD_7', 'Center for Health Development VII', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(13, 'CHD_8', 'Center for Health Development VIII', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(14, 'CHD_9', 'Center for Health Development IX', 'Field Implementation and Coordination Team', '2024-04-14 13:55:32', '2024-04-14 13:55:32'),
(21, 'CHD_BARMM', 'Center for Health Development BARMM', 'Field Implementation and Coordination Team', '2024-04-14 13:58:33', '2024-04-14 13:58:33'),
(19, 'CHD_CAR', 'Center for Health Development CAR', 'Field Implementation and Coordination Team', '2024-04-14 13:58:09', '2024-04-14 13:58:09'),
(20, 'CHD_CARAGA', 'Center for Health Development CARAGA', 'Field Implementation and Coordination Team', '2024-04-14 13:58:09', '2024-04-14 13:58:09'),
(18, 'CHD_NCR', 'Center for Health Development NCR', 'Field Implementation and Coordination Team', '2024-04-14 13:58:09', '2024-04-14 13:58:09'),
(33, 'DPCB', 'Disease Prevention and Control Bureau', 'Public Health Service Team', '2024-04-14 14:13:01', '2024-04-14 14:13:01'),
(34, 'EB', 'Epidemiology Bureau', 'Public Health Service Team', '2024-04-14 14:13:01', '2024-04-14 14:13:01'),
(29, 'FDA', 'Food and Drug Administration', 'Health Regulation Team', '2024-04-14 14:06:31', '2024-04-14 14:06:31'),
(2, 'FMS', 'Financial Management Service', 'Administration and Financial Management Team', '2024-04-14 13:44:12', '2024-04-14 13:44:12'),
(35, 'HEMB', 'Health Emergency Management Bureau', 'Public Health Service Team', '2024-04-14 14:13:47', '2024-04-14 14:13:47'),
(22, 'HFDB', 'Health Facilities Development Bureau', 'Health Facilities and Infrastructure Development Team', '2024-04-14 14:00:00', '2024-04-14 14:00:00'),
(30, 'HFSRB', 'Health Facilities Services and Regulatory Bureau', 'Health Regulation Team', '2024-04-14 14:06:56', '2024-04-14 14:06:56'),
(26, 'HHRDB', 'Health Human Resource Development Bureau', 'Health Policy and Systems Development Team', '2024-04-14 14:01:21', '2024-04-14 14:03:52'),
(36, 'HPCS', 'Health Promotion and Communication Services', 'Public Health Service Team', '2024-04-14 14:13:47', '2024-04-14 14:13:47'),
(27, 'HPDPB', 'Health Policy Development and Planning Bureau', 'Health Policy and Systems Development Team', '2024-04-14 14:04:50', '2024-04-14 14:04:50'),
(23, 'KMITS', 'Knowledge Management and Information Technology Service', 'Health Facilities and Infrastructure Development Team', '2024-04-14 14:00:00', '2024-04-14 14:00:00'),
(3, 'MPO', 'Malasakit Program Office', 'Administration and Financial Management Team', '2024-04-14 13:44:41', '2024-04-14 13:44:41'),
(4, 'PAD', 'Personnel Administrative Division', 'Administration and Financial Management Team', '2024-04-14 13:45:25', '2024-04-14 13:45:25'),
(31, 'PS', 'Procurement Service', 'Procurement and Sytems Development Team', '2024-04-14 14:12:22', '2024-04-14 14:12:22'),
(32, 'SCMO', 'Supply Chain Management Management Office', 'Procurement and Sytems Development Team', '2024-04-14 14:12:22', '2024-04-14 14:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `indx` int(11) NOT NULL,
  `service_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`indx`, `service_id`, `name`, `description`, `create_date`, `update_date`) VALUES
(17, 'Others', 'Others', NULL, '2024-04-14 13:40:03', '2024-04-14 13:40:03'),
(1, 'S1', 'Accreditation', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(10, 'S10', 'Medical Assistance', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(11, 'S11', 'Meetings', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(12, 'S12', 'Policy Review', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(13, 'S13', 'Registration', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(14, 'S14', 'Secretariat', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(15, 'S15', 'Submission', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(16, 'S16', 'Technical Assistance', NULL, '2024-04-14 13:40:03', '2024-04-14 13:40:03'),
(2, 'S2', 'Authentication', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(3, 'S3', 'Certification', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(4, 'S4', 'Data Request', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(5, 'S5', 'Financial Assistance', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(6, 'S6', 'Follow-up', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(7, 'S7', 'Interview/Research', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(8, 'S8', 'Legal Assistance', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22'),
(9, 'S9', 'Licensing', NULL, '2024-04-14 13:39:22', '2024-04-14 13:39:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `index` (`indx`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `indx` (`indx`);

--
-- Indexes for table `form1_survey`
--
ALTER TABLE `form1_survey`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `indx` (`indx`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `id_client_tb`
--
ALTER TABLE `id_client_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_transaction_tb`
--
ALTER TABLE `id_transaction_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_value_tb`
--
ALTER TABLE `id_value_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`provider_id`),
  ADD UNIQUE KEY `indx` (`indx`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`service_id`),
  ADD UNIQUE KEY `indx_2` (`indx`),
  ADD KEY `indx` (`indx`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `form1_survey`
--
ALTER TABLE `form1_survey`
  MODIFY `indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `id_client_tb`
--
ALTER TABLE `id_client_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `id_transaction_tb`
--
ALTER TABLE `id_transaction_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `id_value_tb`
--
ALTER TABLE `id_value_tb`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `indx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form1_survey`
--
ALTER TABLE `form1_survey`
  ADD CONSTRAINT `form1_survey_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`),
  ADD CONSTRAINT `form1_survey_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service_list` (`service_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `form1_survey_ibfk_4` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
