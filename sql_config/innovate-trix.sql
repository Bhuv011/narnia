-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2021 at 05:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `innovate-trix`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambulance`
--

CREATE TABLE `ambulance` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `associated_hospital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ambulance`
--

INSERT INTO `ambulance` (`id`, `email`, `password`, `associated_hospital`) VALUES
(1, 'ambulance@jaypee.com', '$2y$10$pRyhCMwVh92R7lGpZCKBGOiUZ3qFQMn/U41LwIfyEk7LEyfuSn9wy', 1),
(2, 'ambulance@fortis.com', '$2y$10$pRyhCMwVh92R7lGpZCKBGOiUZ3qFQMn/U41LwIfyEk7LEyfuSn9wy', 2),
(3, 'ambulance@maxhealthcare.in', '$2y$10$pRyhCMwVh92R7lGpZCKBGOiUZ3qFQMn/U41LwIfyEk7LEyfuSn9wy', 3);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `beds` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `email`, `password`, `name`, `beds`, `date`) VALUES
(1, 'admin@jaypee.com', '$2y$10$pRyhCMwVh92R7lGpZCKBGOiUZ3qFQMn/U41LwIfyEk7LEyfuSn9wy', 'Jaypee Hospital, Noida', 0, '2021-06-02'),
(2, 'admin@fortis.com', '$2y$10$pRyhCMwVh92R7lGpZCKBGOiUZ3qFQMn/U41LwIfyEk7LEyfuSn9wy', 'Fortis Hospital, Delhi', 0, '2021-06-01'),
(3, 'admin@maxhealthcare.in', '$2y$10$pRyhCMwVh92R7lGpZCKBGOiUZ3qFQMn/U41LwIfyEk7LEyfuSn9wy', 'Max Healthcare, Greater Noida', 19, '2021-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `request_sent_on` date DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `dispatch_status` varchar(20) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `user_id`, `hospital_id`, `request_sent_on`, `status`, `dispatch_status`, `latitude`, `longitude`) VALUES
(1, 11, 1, '2021-06-26', 'accepted', 'not_dispatched', '28.511294', '77.3686346'),
(2, 11, 2, '2021-06-26', 'failed', '', '28.511294', '77.3686346'),
(3, 11, 3, '2021-06-26', 'rejected', '', '28.511294', '77.3686346');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` varchar(3) NOT NULL,
  `health_problems` mediumtext NOT NULL,
  `address` text NOT NULL,
  `ph_1` int(11) NOT NULL,
  `ph_2` int(11) NOT NULL,
  `ph_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `age`, `health_problems`, `address`, `ph_1`, `ph_2`, `ph_3`) VALUES
(11, 'Mehula', 'mehul@gmail.com', '9910796478', '$2y$10$pRyhCMwVh92R7lGpZCKBGOiUZ3qFQMn/U41LwIfyEk7LEyfuSn9wy', '67', 'ASTHAMA, TERA BAAP', '', 1, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulance`
--
ALTER TABLE `ambulance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospitalId` (`associated_hospital`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`user_id`),
  ADD KEY `HospId` (`hospital_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ph1` (`ph_1`),
  ADD KEY `ph2` (`ph_2`),
  ADD KEY `ph3` (`ph_3`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambulance`
--
ALTER TABLE `ambulance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ambulance`
--
ALTER TABLE `ambulance`
  ADD CONSTRAINT `hospitalId` FOREIGN KEY (`associated_hospital`) REFERENCES `hospital` (`id`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `HospId` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `userId` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `ph1` FOREIGN KEY (`ph_1`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `ph2` FOREIGN KEY (`ph_2`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `ph3` FOREIGN KEY (`ph_3`) REFERENCES `hospital` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
