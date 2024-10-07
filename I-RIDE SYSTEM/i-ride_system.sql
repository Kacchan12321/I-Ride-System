-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 12:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `i-ride system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `rider_id` int(11) DEFAULT NULL,
  `rider_name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `dropoff_location` varchar(255) NOT NULL,
  `booking_time` datetime NOT NULL,
  `status` enum('pending','confirmed','completed','canceled') DEFAULT 'pending',
  `fare` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `booking_detail` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `SameDayHatid` tinyint(1) DEFAULT 0,
  `SameDayDelivery` tinyint(1) DEFAULT 0,
  `PetTransport` tinyint(1) DEFAULT 0,
  `booking_type` enum('SAME-DAY-DELIVERY','SAME-DAY-HATID','PET-TRANSPORTATION') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `rider_id`, `rider_name`, `user_id`, `pickup_location`, `dropoff_location`, `booking_time`, `status`, `fare`, `created_at`, `booking_detail`, `comment`, `SameDayHatid`, `SameDayDelivery`, `PetTransport`, `booking_type`) VALUES
(4, 7, NULL, NULL, '', '', '0000-00-00 00:00:00', 'completed', 189.00, '2024-10-03 00:34:49', 'vjhklpppppppppp', 'wfasf', 0, 0, 0, 'SAME-DAY-HATID'),
(5, 7, NULL, NULL, '', '', '0000-00-00 00:00:00', 'completed', 123.00, '2024-10-03 00:39:02', 'PAULO', 'dfsdgsdgs', 0, 0, 0, 'PET-TRANSPORTATION'),
(6, 7, NULL, NULL, '', '', '0000-00-00 00:00:00', 'completed', 12345.00, '2024-10-03 00:41:28', 'ssgsg', 'dfwgsg', 0, 0, 0, 'SAME-DAY-DELIVERY'),
(7, NULL, NULL, NULL, '', '', '0000-00-00 00:00:00', 'pending', 204.00, '2024-10-07 07:21:23', 'san miguel / san ildefoso', 'fast', 0, 0, 0, 'SAME-DAY-DELIVERY'),
(8, 7, NULL, NULL, '', '', '0000-00-00 00:00:00', 'confirmed', 1234.00, '2024-10-07 07:28:54', 'paulo', 'kach', 0, 0, 0, 'SAME-DAY-DELIVERY');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `rider_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by_user_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`rider_id`, `fullname`, `mobile`, `email`, `created_at`, `created_by_user_id`, `photo`, `username`, `address`, `status`, `deleted_at`, `password`) VALUES
(6, 'John Paulo Venturina', '09914261177', 'pauloventurina22@gmail.com', '2024-10-02 16:59:44', NULL, NULL, 'Paulo05', '9044 isidro Veneracion street', 'active', NULL, '$2y$10$6imydgahLig2KPRjErYDmex0reP9ERNrQeDNDJqiBTVm8r15oPG32'),
(7, 'robertq dssd', '09992491294', 'Yman192@gmail.com', '2024-10-07 01:10:13', NULL, NULL, 'John05', 'asfafasfsaf', 'active', NULL, '$2y$10$0TRhdzI4Qg/UKy2gPbq87u9IvEsLEqeZmHNuKoXywTL2Fub96Q6JC');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `transaction_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useractions`
--

CREATE TABLE `useractions` (
  `action_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_description` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','generaladmin','csr') DEFAULT NULL,
  `action_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `address` varchar(255) DEFAULT NULL,
  `role` enum('SUPER ADMIN','GENERAL ADMIN','CSR') DEFAULT 'CSR',
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `mobile`, `fullname`, `status`, `address`, `role`, `photo`, `created_at`, `deleted_at`, `password`) VALUES
(3, 'Kacchan', 'pauloventurina22@gmail.com', '09914261177', 'John Paulo Venturina', 'active', '9044 isidro Veneracion street', 'SUPER ADMIN', NULL, '2024-10-01 08:02:09', NULL, '$2y$10$IZuVxis5iJJJ9dRVpeMEguGqsift/RaOe3q5NMNRQBpdXt3pPLzc6'),
(4, 'Mary', 'MaryAnn22@gmail.com', '09912312131', 'Mary Ann Matias', 'active', '9044 isidro Veneracion street', 'GENERAL ADMIN', NULL, '2024-10-02 03:36:02', '2024-10-02 11:40:20', '$2y$10$/ndMLH4iLuWeJTpKlXK6e.ZBt3tIFx6x8dPPCDT28g./EEv.pV/cu'),
(5, 'MaryV', 'MaryAnn22@gmail.com', '09912312122', 'Mary Ann Matias', 'active', '9044 isidro Veneracion street', 'GENERAL ADMIN', NULL, '2024-10-02 03:36:39', NULL, '$2y$10$YjV0LVkCaW5Ehvp/XsPjE.H.2fu3TIjVDrCXrNC7b.GLAP7U7JJOW');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `rider_id` int(11) DEFAULT NULL,
  `model` varchar(100) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `rider_id` (`rider_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`rider_id`),
  ADD KEY `created_by_user_id` (`created_by_user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `useractions`
--
ALTER TABLE `useractions`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD UNIQUE KEY `license_plate` (`license_plate`),
  ADD KEY `rider_id` (`rider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `rider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useractions`
--
ALTER TABLE `useractions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`rider_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `riders`
--
ALTER TABLE `riders`
  ADD CONSTRAINT `riders_ibfk_1` FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);

--
-- Constraints for table `useractions`
--
ALTER TABLE `useractions`
  ADD CONSTRAINT `useractions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`rider_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
