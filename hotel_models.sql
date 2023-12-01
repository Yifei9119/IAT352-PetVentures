-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2023 at 05:13 AM
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
-- Database: `hotel_models`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `member_id` varchar(50) NOT NULL,
  `rating` varchar(5) NOT NULL,
  `text` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `services` varchar(2000) DEFAULT NULL,
  `rooms` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `policies` mediumtext DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `avg_rating` varchar(5) DEFAULT NULL,
  `province` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `name`, `details`, `services`, `rooms`, `location`, `policies`, `contact`, `avg_rating`, `province`) VALUES
('0', 'Super 8 by Wyndham Lethbridge', 'Super 8 is conveniently located less than a mile from Henderson Lake Park and approximately four miles from Lethbridge Airport. The property provides 56 nicely furnished guest rooms situated on two stories. While staying at the inn one can enjoy the complimentary continental breakfast while reading the daily newspaper. There is a heated indoor swimming pool and an exercise gym to suit the customers preferences. The hotel is close to restaurants and various attractions. One can come relax and enjoy the value at the Super 8. All rooms have air-conditioning in-room coffee clock radios modem lines irons and cable TV. Refrigerators and microwaves are available upon request.\r\n', 'Pet Friendly, Fitness Center, Internet Available, Free WiFi, Business Center, Meeting Rooms, Air Conditioning, Television, Breakfast Available, Free Breakfast, Parking Available, Free Parking, Laundry Room, Dry Cleaning', 'King Room, Queen Room, Double Room', '1030 Mayor Magrath Dr S, Lethbridge, AB T1K 2P8', 'Safe Stay: Super 8 by Wyndham Lethbridge has enhanced cleaning and safety measures in place, and follows the Count on Us (Wyndham) cleanliness and sanitization policy. Masks and hand sanitizer are provided to guests, and rooms are disinfected between each stay. Social distancing measures are in place, as well as physical barriers between staff and guests. Cashless payment is available. Each room has a 24-hour gap period between stays, and hotel staff are required to wear masks.', NULL, NULL, 'Alberta');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(50) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `amount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registered_member`
--

CREATE TABLE `registered_member` (
  `member_id` varchar(20) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `booking_history` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` varchar(50) NOT NULL,
  `amenities` varchar(1000) NOT NULL,
  `bed` varchar(50) NOT NULL,
  `view` varchar(1000) NOT NULL,
  `accommodation` varchar(1000) NOT NULL,
  `capabilities` varchar(1000) NOT NULL,
  `price` varchar(25) NOT NULL,
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`),
  ADD UNIQUE KEY `hotel_id` (`hotel_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `registered_member`
--
ALTER TABLE `registered_member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `member_id` (`member_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_id` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
