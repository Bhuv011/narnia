-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 08, 2021 at 11:39 AM
-- Server version: 10.4.14-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xhacks`
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
(1, 'admin@jaypee.com', '$2y$10$pRyhCMwVh92R7lGpZCKBGOiUZ3qFQMn/U41LwIfyEk7LEyfuSn9wy', 'Jaypee Hospital, Noida', 10, '2021-06-02'),
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
(31, 35, 1, '2021-07-28', 'accepted', 'dispatched', '28.494207399999997', '77.3884812'),
(32, 35, 2, '2021-07-28', 'failed', '', '28.494207399999997', '77.3884812'),
(33, 35, 3, '2021-07-28', 'failed', '', '28.494207399999997', '77.3884812'),
(928, 39, 1, '2021-07-28', 'accepted', 'dispatched', '28.4939249', '77.3881'),
(929, 39, 2, '2021-07-28', 'failed', '', '28.4939249', '77.3881'),
(930, 39, 3, '2021-07-28', 'failed', '', '28.4939249', '77.3881'),
(931, 40, 1, '2021-07-28', 'accepted', 'dispatched', '32.27483435587866', '75.67236137405237'),
(932, 40, 2, '2021-07-28', 'failed', '', '32.27483435587866', '75.67236137405237'),
(933, 40, 3, '2021-07-28', 'failed', '', '32.27483435587866', '75.67236137405237'),
(934, 41, 1, '2021-07-29', 'accepted', 'dispatched', '28.4942025', '77.38890719999999'),
(935, 41, 2, '2021-07-29', 'failed', '', '28.4942025', '77.38890719999999'),
(936, 41, 3, '2021-07-29', 'failed', '', '28.4942025', '77.38890719999999'),
(937, 42, 1, '2021-07-29', 'accepted', 'dispatched', '28.5046231', '77.3802953'),
(938, 42, 2, '2021-07-29', 'failed', '', '28.5046231', '77.3802953'),
(939, 42, 3, '2021-07-29', 'failed', '', '28.5046231', '77.3802953'),
(946, 43, 1, '2021-08-02', 'pending', '', '20.0063', '77.006'),
(947, 43, 2, '2021-08-02', 'pending', '', '20.0063', '77.006'),
(948, 43, 3, '2021-08-02', 'pending', '', '20.0063', '77.006');

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
  `ph_1` int(11) DEFAULT NULL,
  `ph_2` int(11) DEFAULT NULL,
  `ph_3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`, `age`, `health_problems`, `address`, `ph_1`, `ph_2`, `ph_3`) VALUES
(22, 'Kavin Valli', 'kavinvalli@gmail.com', '9311719311', '$2y$10$pRyhCMwVh92R7lGpZCKBGOiUZ3qFQMn/U41LwIfyEk7LEyfuSn9wy', '35', 'Asthma, Subaortic Stenosis', 'Lorem Ipsum Dolor Sit amet Constectuer init', 2, 1, 3),
(29, '', 'namanchandok1@gmail.com', '8750627282', '$2y$10$tNVm3UyvfMI4ib7auqAS/ena3ewX7AS/3IetwRITkNEaq5ebxnskO', '', '', '', NULL, NULL, NULL),
(31, '', 'newacc@email.com', '9876543210', '$2y$10$Oh4ENdFlfcQmwC30uWc9iOqBIxqdBJTabERG/Pm9tIE7aEX0iE1wu', '', '', '', NULL, NULL, NULL),
(32, '', 'bhawna@tagoreint.com', '9818877654', '$2y$10$0Kg2MacAEAjFTiUlM5nUG.vNfq1lv6ulOQgyVha6Vhf.a6YLBa3Vm', '', '', '', NULL, NULL, NULL),
(34, '', 'samiktuteja2008@gmail.com', '9899064358', '$2y$10$vShjf31HdZf9jOdgJgCHP.Fe74xsHPPYJtUtaxUxf1v3qo3yrcERO', '', '', '', NULL, NULL, NULL),
(35, 'MEHUL SRIVASTAVA', 'test@gmail.com', '9811679046', '$2y$10$UmjjNwi0X0dxtg2G42Cph.TZxhZdNCFD4Lk3RixynTBvhEoL0kJ8K', '', 'Asthama, basic problems', 'noida, delhi, india', 1, 2, 3),
(36, '', 'e12171atharva@gmail.com', '1129921832', '$2y$10$RVFw1FgmxiHIweAyAGjs0OrG8LwWTDnZXd3WrBTHHH3eyjP3JLHuG', '', '', '', NULL, NULL, NULL),
(37, 'Atharva None', 'e12171atharva@dpsrkp.net', '7042745223', '$2y$10$2eCv1QLlx2k0lGYeNeuMfeO4qGLO5gjesBB8a1xf7heoNLEENU2IW', '', 'Asthama', 'Jxjxjxkdkckcj\r\nDjdjdjdkkd', 2, 3, 1),
(38, '', 'agrawalharshikaa@gmail.com', '8882630339', '$2y$10$ubqoginCwOdesD.mSBxAvOA.U/EHG5nM1iATGrC5JrCb6CnanGOi2', '', '', '', NULL, NULL, NULL),
(39, 'Harsh Man', 'test@harshika.com', '9898989898', '$2y$10$Vj4/y0W7dexXOEGYfhLQiegPaE/5768S0HMnr.q4U07UwNBbsnTcK', '', 'ASTHAMA, TERA BAAP', 'USA', 1, 2, 3),
(40, 'Darsh Sikka', 'darsh7349@gmail.com', '9953577477', '$2y$10$g3qcoZ4vNmnm8vXiZkCcMuEhA4OC3fCA4huwaqPpUdWuFs6EiYpji', '', 'Asthma, Cancer', 'D2, Tower 7, Type 5, East Kidwai Nagar, New Delhi, 110023, Delhi, India', 1, 2, 3),
(41, 'pwensh', 'kesehopwensh@gmail.com', '9811779046', '$2y$10$2FKx2TOx2zDLFxS7ThMkAeY.0NcWty6jJudBiss68eiz.sZs3/15W', '', 'asthma, tera baap', 'noida, delhi, india', 1, 2, 3),
(42, 'HEMELO', 'test@gmail1.com', '9311793117', '$2y$10$20AfltHTbAAwO0GuMHfd9um7m9thlbJLZYO/9mJD9O/b9aKDPNZqe', '', 'Asthma', 'B3, 1406, Noida', 1, 2, 3),
(43, 'Garv Jain', 'garvj03@gmail.com', '9625902617', '$2y$10$5PEQq1un/PhRJ8k8WTw50ORCOUCRT7I5VzanrzqMzlk43zl5e2HYa', '', 'Asthma', 'Mumbai, India', 1, 2, 3),
(44, '', 'kanishka18verma@gmail.com', '4448319192', '$2y$10$xsygi5ZOfW15tsOttKiAIuXjS2/.51VZuOep89kDZjMGf.c/Q.JYa', '', '', '', NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=949;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
