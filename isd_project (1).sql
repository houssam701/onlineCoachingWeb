-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 05:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isd_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseId` int(255) NOT NULL,
  `coach_id` int(255) NOT NULL,
  `video_id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `instructions` mediumtext NOT NULL,
  `muscle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseId`, `coach_id`, `video_id`, `name`, `instructions`, `muscle`) VALUES
(11, 43, 55, 'Leg extension', '1-Sit on the leg extension machine and adjust the pad to rest on your shins just above your ankles.\r\n-2-Hold the side handles and keep your back against the seat.\r\n-3-Extend your legs upward until they are fully straight.\r\n-4-Lower the weight back down slowly to the starting position.', 'Legs'),
(12, 43, 56, 'Leg curl', '1-Lie face down on the leg curl machine and position your legs under the padded lever.\r\n-2-Grasp the side handles for support.\r\n-3-Curl your legs upward, bringing your heels as close to your glutes as possible.\r\n-4-Slowly lower the weight back to the starting position.', 'Legs'),
(13, 43, 57, 'Squat', '1-Stand with feet shoulder-width apart, toes slightly pointed out.\r\n-2-Hold the barbell across your upper back or use your body weight.\r\n-3-Lower your body by bending your knees and hips, keeping your back straight.\r\n-4-Push through your heels to return to the starting position.', 'Legs'),
(14, 43, 58, 'Bench press', '1-Lie flat on the bench with your feet on the ground.\r\n-2-Grip the barbell slightly wider than shoulder-width apart.\r\n-3-Lower the barbell to your chest, keeping your elbows at a 45-degree angle.\r\n-4-Push the barbell back up to the starting position.', 'Chest'),
(17, 43, 61, 'Dumbell curl', '1-Stand with feet shoulder-width apart, holding a dumbbell in each hand.\r\n-2-Keep your elbows close to your torso and palms facing forward.\r\n-3-Curl the dumbbells up to shoulder height by bending your elbows.\r\n-4-Lower the dumbbells back to the starting position.', 'arms'),
(21, 43, 65, 'Lat pull down', '1-Sit at the lat pull-down machine and grip the bar with a wide, overhand grip.\r\n-2-Lean back slightly and pull the bar down to your chest.\r\n-3-Squeeze your shoulder blades together at the bottom of the movement.\r\n-4-Slowly return the bar to the starting position.', 'back'),
(22, 43, 66, 'Crunches', '1-Lie on your back with your knees bent and feet flat on the floor.\r\n-2-Place your hands behind your head or crossed on your chest.\r\n-3-Lift your shoulders off the floor by contracting your abs.\r\n-4-Lower back down to the starting position.', 'Abs'),
(23, 43, 67, 'leg extension 2', 'Instructions for the exercise...', 'legs'),
(24, 43, 68, 'bench press', 'testing injections', 'chest');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `requestId` int(255) NOT NULL,
  `coach_id` int(255) NOT NULL,
  `status_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`requestId`, `coach_id`, `status_id`, `user_id`, `date`) VALUES
(23, 43, 2, 39, '2024-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `class_id` int(50) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `start_time` varchar(15) NOT NULL,
  `end_time` varchar(15) NOT NULL,
  `day` varchar(15) NOT NULL,
  `class` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`class_id`, `admin_id`, `start_time`, `end_time`, `day`, `class`) VALUES
(9, 30, '07:00', '08:00', 'Monday', 'YOGA'),
(10, 30, '09:00', '10:30', 'Tuesday', 'Dancing'),
(11, 30, '20:00', '22:00', 'Wednesday', 'Crossfit'),
(12, 30, '10:00', '11:15', 'Thursday', 'kick boxing'),
(13, 30, '17:00', '19:00', 'Friday', 'Crossfit'),
(14, 30, '11:00', '00:00', 'Saturday', 'kick boxing'),
(15, 30, '11:49', '01:49', 'Saturday', 'robotics');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusId` int(10) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusId`, `status`) VALUES
(1, 'Pending'),
(2, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(255) NOT NULL,
  `role_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` mediumtext NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` mediumtext NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `role_id`, `name`, `email`, `phone`, `password`, `image`) VALUES
(30, 1, 'admin', 'admin@123', '0', '$2y$10$WZYYe0zzdKoOC1TVeRx9RuWWNF2wjwpO7whIoCGll0TzQX8rI2ane', ''),
(34, 3, 'ibrahim', 'alidaher@gmail.com', '+961 70 000 766', '$2y$10$BfY1olj4KPXBBbkYM7iSTenfH2ZDWv51J7aF9Y3H4eJ.UVg8ijPx.', ''),
(36, 3, 'mohamad ali', 'mohamadali@gmail.com', '+961 70 999 766', '$2y$10$zl4GAOKsQggzIMbJ7t86cuU8yzT5mN7MZ2wlDEtgtRO.3/FSQtitS', ''),
(37, 3, 'ibrahim smail', 'ibrahimsamil@gmail.com', '+961 70 515 963', '$2y$10$98fZt47IyKjZQmahXTxJ/.xkPLbOYvcHkNXxmM4QD/H1rlD42i/iq', ''),
(38, 3, 'Hadi berchali', 'hadiberchali@gmail.com', '+961 70 004 234', '$2y$10$GtbA8kufJWgMDTqHgJbe/uUV4C4PyFZLx6e3ckCc7hKYTaLXvshcS', ''),
(39, 3, 'ahmad dia ', 'ahmaddia@gmail.com', '+961 78 500 766', '$2y$10$jXZ2ECw.FQHzUI6qzZbe6u1BIfr/dHRpuNDcjzkIt5fkmJptFdEIq', ''),
(40, 2, 'Abed hamawi', 'abedhamawi@gmail.com', '+961 70 223 111', '$2y$10$BwB2w/BdxwmzeUiExoeVd.bU61YGv9Lh9bhsm3ByhkxVPklo8zb8C', 'coach-images/coach_ABED.png'),
(41, 2, 'ahmad kreik', 'ahmadkreik@gmail.com', '+961 70 999 766', '$2y$10$1WoBpu/WL9QD84eGXXXUOubFyitDYYowp7iJ3bix1QAjEUG/0Pc4y', 'coach-images/coach_ahmad.png'),
(43, 2, 'Moro matar', 'moromatar@gmail.com', '+961 70 224 766', '$2y$10$VTldJLErIqUBqK3CX.q6j.lV6bV.0y3Qux8F8D0wXLsCGgi0zoxmy', 'coach-images/coach_moro.png'),
(44, 3, 'houssam al kassem', 'houss2002@outlook.com', '123650', '$2y$10$QIaT3XhHx/Ufqdb2t9ohI.d6oOzlh.eyfXN6lAQU5p1z0KMX5gjYO', ''),
(45, 2, 'husam', 'smak23@gmail.com', '+961 70 515 766', '$2y$10$L24wrxrtzpjx/KyPYhrnH.UXEGw6M08sIpUhU0ZRSmFLOosMYXqca', 'coach-images/coach_ABED.png'),
(47, 2, 'rami', 'rami@gmail.com', '+961 70 515 766', '$2y$10$XzgZUmeNYxFrVLs1euI2E.suq/lKQfpJhK6I8D1ecuTxElm2z4Ah6', 'coach-images/coach_ABED.png'),
(48, 3, 'husam', 'ram2i@gmail.com', '+961 70 515 766', '$2y$10$UsRVT1ssYfcVZdiLnauvQOSEZ8OG6/JusXRoKI.I8JN4fWwsXQ3ry', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `roleId` int(255) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`roleId`, `role_name`) VALUES
(1, 'admin'),
(2, 'coach'),
(3, 'client');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `videoId` int(255) NOT NULL,
  `content` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`videoId`, `content`) VALUES
(51, 'coach-videos/4438080-hd_1920_1080_25fps.mp4'),
(52, 'coach-videos/4438080-hd_1920_1080_25fps.mp4'),
(53, 'coach-videos/4438094-hd_1920_1080_25fps.mp4'),
(54, 'coach-videos/4438080-hd_1920_1080_25fps.mp4'),
(55, 'coach-videos/How To Do A Leg Extension.mp4'),
(56, 'coach-videos/Leg Curl Tutorial.mp4'),
(57, 'coach-videos/Exercise Tutorial - Squat.mp4'),
(58, 'coach-videos/The Bench Press.mp4'),
(61, 'coach-videos/How To_ Alternating Dumbbell Curl.mp4'),
(65, 'coach-videos/How To Do A Lat Pulldown.mp4'),
(66, 'coach-videos/Exercise Tutorial - V-Up.mp4'),
(67, 'coach-videos/4117854-uhd_2160_3840_25fps.mp4'),
(68, 'coach-videos/4438094-hd_1920_1080_25fps.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseId`),
  ADD KEY `courses_ibfk_1` (`coach_id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`requestId`),
  ADD KEY `requests_ibfk_1` (`coach_id`),
  ADD KEY `requests_ibfk_2` (`user_id`),
  ADD KEY `requests_ibfk_3` (`status_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `user_ibfk_1` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`videoId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `requestId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `class_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `videoId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`videoId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`statusId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `user` (`userId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`roleId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
