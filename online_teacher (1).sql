-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2020 at 06:31 PM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_teacher`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user_name` varchar(255) DEFAULT NULL,
  `admin_pass` varchar(255) DEFAULT NULL,
  `admin_role` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `admin_status` int(11) NOT NULL DEFAULT '1',
  `admin_ceated` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_duration` int(11) DEFAULT NULL,
  `appoint_teacher` int(11) DEFAULT NULL,
  `course_type` varchar(150) DEFAULT NULL,
  `course_actual_price` varchar(150) DEFAULT NULL,
  `course_offer` varchar(150) DEFAULT NULL,
  `course_offer_per` varchar(150) DEFAULT NULL,
  `start_date` varchar(150) DEFAULT NULL,
  `number_slots` varchar(150) DEFAULT NULL,
  `course_status` int(11) DEFAULT '1',
  `course_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `course_modify` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_duration`, `appoint_teacher`, `course_type`, `course_actual_price`, `course_offer`, `course_offer_per`, `start_date`, `number_slots`, `course_status`, `course_created`, `course_modify`) VALUES
(1, 'BSC123', 2, 1, 'Recorded', '100', '20', '40%', '12', '2', 1, '2020-05-20 18:17:48', '2020-05-20 18:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_unique_id` varchar(255) DEFAULT NULL,
  `student_name` varchar(150) DEFAULT NULL,
  `student_class` int(11) DEFAULT NULL,
  `student_subject` int(11) DEFAULT NULL,
  `student_mobile_no` varchar(15) DEFAULT NULL,
  `student_email` varchar(150) DEFAULT NULL,
  `student_prefernce` varchar(150) DEFAULT NULL,
  `student_profile` varchar(255) DEFAULT NULL,
  `student_password` varchar(255) DEFAULT NULL,
  `student_status` int(11) DEFAULT '1',
  `student_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `student_modify` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_unique_id`, `student_name`, `student_class`, `student_subject`, `student_mobile_no`, `student_email`, `student_prefernce`, `student_profile`, `student_password`, `student_status`, `student_created`, `student_modify`) VALUES
(1, 'OT03642871', 'nazir', 1, 2, '8750931463', 'abc@gmail.com', 'Documents', 'uploads/students/979561688096.jpg', 'abc123', 1, '2020-05-20 15:13:26', '2020-05-20 15:13:44'),
(2, 'OT31495683', 'ABC', 3, 2, '8750931432', 'abc@gmail.com', NULL, 'uploads/students/796892758511.jpg', 'abc123', 1, '2020-05-20 15:29:12', '2020-05-20 15:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `teacher_unique_id` varchar(255) DEFAULT NULL,
  `teacher_name` varchar(150) DEFAULT NULL,
  `teacher_class` int(11) DEFAULT NULL,
  `teacher_subject` int(11) DEFAULT NULL,
  `teacher_mobile_no` varchar(15) DEFAULT NULL,
  `teacher_email` varchar(150) DEFAULT NULL,
  `teacher_prefernce` varchar(150) DEFAULT NULL,
  `teacher_profile` varchar(255) DEFAULT NULL,
  `teacher_password` varchar(255) DEFAULT NULL,
  `teacher_status` int(11) DEFAULT '1',
  `teacher_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `teacher_modify` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_unique_id`, `teacher_name`, `teacher_class`, `teacher_subject`, `teacher_mobile_no`, `teacher_email`, `teacher_prefernce`, `teacher_profile`, `teacher_password`, `teacher_status`, `teacher_created`, `teacher_modify`) VALUES
(1, 'OT61510699', 'Nazir', 1, 2, '8750931463', 'hussainnazir80@gmail.com', 'Live', 'uploads/teachers/469479818551.jpg', 'abc123', 1, '2020-05-20 12:24:44', NULL),
(2, 'OT90778286', 'anc', 1, 2, '3234324324', 'abc@gmail.com', 'Documents', 'uploads/teachers/969856616693.jpg', 'abc123', 1, '2020-05-20 14:54:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
