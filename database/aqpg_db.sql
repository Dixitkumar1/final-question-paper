-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 01:41 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aqpg_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `choice_list`
--

CREATE TABLE `choice_list` (
  `question_id` int(30) NOT NULL,
  `choice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `choice_list`
--

INSERT INTO `choice_list` (`question_id`, `choice`) VALUES
(1, 'Nullam eu dui scelerisque'),
(1, 'viverra nisi sit amet'),
(1, 'volutpat ipsum'),
(1, 'Aenean odio nunc'),
(2, 'Choice 1'),
(2, 'Choice 2'),
(2, 'Choice 2'),
(2, 'Choice 4'),
(2, 'Choice 5'),
(5, 'Choice 1'),
(5, 'Choice 2'),
(5, 'Choice 3'),
(6, 'Option 1'),
(6, 'Option 2'),
(6, 'Option 3'),
(7, 'Choice 101'),
(7, 'Choice 102'),
(7, 'Choice 103'),
(9, 'Option 101'),
(9, 'Option 102'),
(9, 'Option 103'),
(9, 'Option 104'),
(9, 'Option 105'),
(8, 'option 101'),
(8, 'option 102'),
(8, 'option 103'),
(8, 'option 104'),
(8, 'option 105');

-- --------------------------------------------------------

--
-- Table structure for table `class_list`
--

CREATE TABLE `class_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_list`
--

INSERT INTO `class_list` (`id`, `user_id`, `course_id`, `name`, `description`, `delete_flag`, `status`, `date_created`, `date_updated`) VALUES
(1, 1, 3, 'BSIS 1A - Test101', 'Sample Class only', 0, 1, '2022-02-23 13:16:28', NULL),
(2, 1, 2, 'BSIT 1B - Test102', 'Sample Class for Test 102 Subject.', 0, 1, '2022-02-23 13:17:58', NULL),
(3, 1, 3, 'BSIS', 'Bachelor of Science in Information Systems', 1, 1, '2022-02-23 13:19:14', '2022-02-23 13:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`id`, `user_id`, `name`, `description`, `delete_flag`, `status`, `date_created`, `date_updated`) VALUES
(2, 1, 'BSIT', 'Bachelor of Science in Information Technology', 0, 1, '2022-02-23 12:07:00', NULL),
(3, 1, 'BSIS', 'Bachelor of Science in Information Systems', 0, 1, '2022-02-23 13:00:12', '2022-02-23 13:00:27'),
(4, 1, 'test', 'test', 1, 1, '2022-02-23 13:18:11', '2022-02-23 13:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `question_list`
--

CREATE TABLE `question_list` (
  `id` int(30) NOT NULL,
  `question_paper_id` int(30) NOT NULL,
  `question` text NOT NULL,
  `mark` double NOT NULL DEFAULT 0,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = single answer, \r\n2= multi-answer,\r\n3 = text answer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_list`
--

INSERT INTO `question_list` (`id`, `question_paper_id`, `question`, `mark`, `type`) VALUES
(1, 2, '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Vestibulum non turpis dui. Aliquam rutrum semper neque id faucibus. Praesent et interdum tortor. Nulla tortor magna, tincidunt in elementum et, laoreet vitae mi. Curabitur ultrices sapien vitae fringilla scelerisque. Phasellus feugiat ac nisl quis aliquet. Nulla facilisi. Duis eget justo laoreet quam pretium varius.</span><br></p>', 5, 1),
(2, 2, '<p>Question 101</p>', 5, 2),
(3, 2, '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Nam in condimentum augue. Morbi efficitur facilisis dolor eu molestie. Suspendisse faucibus lorem et finibus ultricies. Maecenas feugiat ultrices metus, id pellentesque elit. Maecenas eros nunc, accumsan a augue ac, scelerisque ullamcorper dolor. Curabitur aliquet dapibus quam. Sed est ipsum, egestas vel odio vel, varius rutrum mauris. In tempor mi a eleifend imperdiet. Donec nec laoreet lectus, quis viverra neque. Donec a consectetur diam.</span><br></p>', 15, 3),
(5, 2, '<p>Question 102</p>', 1, 1),
(6, 2, '<p>Question 103</p>', 1, 1),
(7, 2, '<p>Multiple 102</p>', 5, 2),
(8, 2, '<p>Multiple 103</p>', 10, 2),
(9, 2, '<p>Multiple 103</p>', 10, 2),
(10, 2, '<p>Sample Question only</p>', 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `question_paper_list`
--

CREATE TABLE `question_paper_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_paper_list`
--

INSERT INTO `question_paper_list` (`id`, `user_id`, `class_id`, `title`, `description`, `delete_flag`, `status`, `date_created`, `date_updated`) VALUES
(1, 1, 1, 'Sample Exam 101', 'Nam in condimentum augue. Morbi efficitur facilisis dolor eu molestie. Suspendisse faucibus lorem et finibus ultricies. Maecenas feugiat ultrices metus, id pellentesque elit. Maecenas eros nunc, accumsan a augue ac, scelerisque ullamcorper dolor. Curabitur aliquet dapibus quam. Sed est ipsum, egestas vel odio vel, varius rutrum mauris. In tempor mi a eleifend imperdiet. Donec nec laoreet lectus, quis viverra neque. Donec a consectetur diam.', 0, 1, '2022-02-23 13:37:01', NULL),
(2, 1, 2, 'Sample Exam 2', 'Vestibulum non turpis dui. Aliquam rutrum semper neque id faucibus. Praesent et interdum tortor. Nulla tortor magna, tincidunt in elementum et, laoreet vitae mi. Curabitur ultrices sapien vitae fringilla scelerisque. Phasellus feugiat ac nisl quis aliquet. Nulla facilisi. Duis eget justo laoreet quam pretium varius.', 0, 1, '2022-02-23 13:42:57', NULL),
(3, 1, 1, 'test', 'test', 1, 0, '2022-02-23 13:55:24', '2022-02-23 13:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `registered_user_list`
--

CREATE TABLE `registered_user_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `gender` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_user_list`
--

INSERT INTO `registered_user_list` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `dob`, `contact`, `email`, `password`, `avatar`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Claire', 'D', 'Blake', 'Female', '1997-10-14', '09456789123', 'cblake@sample.com', '4744ddea876b11dcb1d169fadf494418', 'uploads/rusers/1.jpg?v=1645586877', 1, 0, '2022-02-23 11:27:57', '2022-02-24 08:17:57'),
(2, 'Mark', 'C', 'Cooper', 'Male', '1997-07-15', '0912456789', 'mcooper@sample.com', 'c7162ff89c647f444fcaa5c635dac8c3', 'uploads/rusers/2.png?v=1645586987', 1, 0, '2022-02-23 11:29:47', '2022-02-23 11:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Automatic Question Paper Generator'),
(6, 'short_name', 'AQPG - PHP'),
(11, 'logo', 'uploads/logo-1645579488.png?v=1645579488'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1645577488.jpg?v=1645577488'),
(15, 'company_name', 'TechSoft Solutions'),
(16, 'company_tel_no', '+456 789 1234'),
(17, 'company_mobile', '+639 102 456 7896'),
(18, 'company_email', 'info@sample.com'),
(19, 'company_address', 'Block 23 Lot 6, 14th St., Here Subd., There City, Anywhere, 2306, Philippines'),
(20, 'company_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fermentum quam nulla, eu ultricies odio aliquet sit amet. Pellentesque ullamcorper magna vitae feugiat tempor. Phasellus efficitur, ligula non accumsan vulputate, felis lacus lobortis sem, commodo rutrum elit ligula vitae dolor. Cras tristique turpis nunc, vel porttitor ligula maximus ac. Quisque a vehicula felis. Aenean condimentum lectus et purus vulputate egestas. Duis quis scelerisque orci. Sed urna ligula, cursus quis turpis vitae, porta rhoncus arcu. Suspendisse gravida vulputate laoreet.'),
(21, 'company_name', 'TechSoft Solutions'),
(22, 'company_tel_no', '+456 789 1234'),
(23, 'company_mobile', '+639 102 456 7896'),
(24, 'company_email', 'info@sample.com'),
(25, 'company_address', 'Block 23 Lot 6, 14th St., Here Subd., There City, Anywhere, 2306, Philippines'),
(26, 'company_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fermentum quam nulla, eu ultricies odio aliquet sit amet. Pellentesque ullamcorper magna vitae feugiat tempor. Phasellus efficitur, ligula non accumsan vulputate, felis lacus lobortis sem, commodo rutrum elit ligula vitae dolor. Cras tristique turpis nunc, vel porttitor ligula maximus ac. Quisque a vehicula felis. Aenean condimentum lectus et purus vulputate egestas. Duis quis scelerisque orci. Sed urna ligula, cursus quis turpis vitae, porta rhoncus arcu. Suspendisse gravida vulputate laoreet.'),
(27, 'company_name', 'TechSoft Solutions'),
(28, 'company_tel_no', '+456 789 1234'),
(29, 'company_mobile', '+639 102 456 7896'),
(30, 'company_email', 'info@sample.com'),
(31, 'company_address', 'Block 23 Lot 6, 14th St., Here Subd., There City, Anywhere, 2306, Philippines'),
(32, 'company_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fermentum quam nulla, eu ultricies odio aliquet sit amet. Pellentesque ullamcorper magna vitae feugiat tempor. Phasellus efficitur, ligula non accumsan vulputate, felis lacus lobortis sem, commodo rutrum elit ligula vitae dolor. Cras tristique turpis nunc, vel porttitor ligula maximus ac. Quisque a vehicula felis. Aenean condimentum lectus et purus vulputate egestas. Duis quis scelerisque orci. Sed urna ligula, cursus quis turpis vitae, porta rhoncus arcu. Suspendisse gravida vulputate laoreet.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1645064505', NULL, 1, '2021-01-20 14:02:37', '2022-02-17 10:21:45'),
(5, 'John', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatars/5.png?v=1645514943', NULL, 2, '2022-02-22 15:29:03', '2022-02-22 15:34:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choice_list`
--
ALTER TABLE `choice_list`
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `question_list`
--
ALTER TABLE `question_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_paper_id` (`question_paper_id`);

--
-- Indexes for table `question_paper_list`
--
ALTER TABLE `question_paper_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`class_id`);

--
-- Indexes for table `registered_user_list`
--
ALTER TABLE `registered_user_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_list`
--
ALTER TABLE `class_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question_list`
--
ALTER TABLE `question_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `question_paper_list`
--
ALTER TABLE `question_paper_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registered_user_list`
--
ALTER TABLE `registered_user_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choice_list`
--
ALTER TABLE `choice_list`
  ADD CONSTRAINT `choice_question_id_FK` FOREIGN KEY (`question_id`) REFERENCES `question_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `class_list`
--
ALTER TABLE `class_list`
  ADD CONSTRAINT `class_course_id_FK` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `class_user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `registered_user_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `course_list`
--
ALTER TABLE `course_list`
  ADD CONSTRAINT `course_user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `registered_user_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `question_paper_list`
--
ALTER TABLE `question_paper_list`
  ADD CONSTRAINT `qp_class_id_FK` FOREIGN KEY (`class_id`) REFERENCES `class_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `qp_user_id FK` FOREIGN KEY (`user_id`) REFERENCES `registered_user_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
