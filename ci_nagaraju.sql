-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 06:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_nagaraju`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created`, `modified`, `status`) VALUES
(1, 'IT', '2025-04-25 21:30:48', '2025-04-25 21:30:48', 1),
(2, 'HR', '2025-04-25 21:30:48', '2025-04-25 21:30:48', 1),
(3, 'Finance', '2025-04-25 21:31:01', '2025-04-25 21:31:01', 1),
(4, 'Marketing', '2025-04-25 21:31:01', '2025-04-25 21:31:01', 1),
(5, 'Civil', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation` varchar(25) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `employee_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Employee, 1 = Admin',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `department_id`, `designation`, `salary`, `employee_type`, `created`, `modified`, `status`) VALUES
(2, 'Suryanarayana', 'Danala', 'suryanarayana@gmail.com', '$2y$10$T/d8EkugXALlGkiuyMqLPe7TRULfHFbLXIdjcHX.Cog3noUi/XGqy', '8897704004', 2, 'HR Manager', 8899, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$aMShCZGfoRkisxA7RXoAV.n3335kL7OeVhsx.EAmHyI08.yYuuVmm', '9030199519', 2, 'Admin', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'Suryanarayana', 'Danala', 'nagarjudanala@gmail.com', '$2y$10$sMns4CijYvr2sZtTZaymc.aLe6HbeIKyfpafn7rLbbKWN0S7ghlvC', '09030199519', 1, 'sss', 55, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 'Suryanarayana', 'Danala', 'nagarjudanala@gmail.com', '$2y$10$bKUS7KrsD6Sb5jsbWr0O3uF3QRK8XOJalOXmlIo5fUQuRbY2Z5fAe', '09030199519', 1, 'sss', 555, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 'Suryanarayana', 'Danala', 'nagarjudanala@gmail.com', '$2y$10$ll6IAWal2inw6T65SdgHauueEEsMxlE8rv5QmB6a0lQGr8f2swrhW', '9030199519', 2, 'sss', 56, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 'dgd', 'gsdgsd', 'sdggsdg@gmail.com', '$2y$10$VGhUSUjeDxfpumHx2YXhKeU..RQjtRx3DBe/eIZlO8orM.WzVvaNm', '985432100', 2, 'xzv', 567, 0, NULL, NULL, 1),
(8, 'Suryanarayana', 'Danala', 'nagarjudanala88888@gmail.com', '$2y$10$ErtrXuOY0f6GvQ.88oJlbuAHeC33OZFikCqALVqGYIuOI60X7OQ6q', '8889997778', 3, 'CID', 56, 0, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
