-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2023 at 06:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0
use lingbook;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lingbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `LANGUAGES`
--

CREATE TABLE `LANGUAGES` (
  `id_language` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `MESSAGES`
--

CREATE TABLE `MESSAGES` (
  `id_message` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ROOM`
--

CREATE TABLE `ROOM` (
  `id_room` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `description` varchar(255) DEFAULT NULL,
  `DATA` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `id_user` int(11) NOT NULL,
  `type` enum('admin','alumn','teacher') NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USERS_LANGUAGES`
--

CREATE TABLE `USERS_LANGUAGES` (
  `id_users` int(11) NOT NULL,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USERS_ROOM_LANGUAGES`
--

CREATE TABLE `USERS_ROOM_LANGUAGES` (
  `id_user` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `USERS_VIDEOS_MESSAGES`
--

CREATE TABLE `USERS_VIDEOS_MESSAGES` (
  `id_video` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_message` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `VIDEOS`
--

CREATE TABLE `VIDEOS` (
  `id_video` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `LANGUAGES`
--
ALTER TABLE `LANGUAGES`
  ADD PRIMARY KEY (`id_language`);

--
-- Indexes for table `MESSAGES`
--
ALTER TABLE `MESSAGES`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `ROOM`
--
ALTER TABLE `ROOM`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `USERS_LANGUAGES`
--
ALTER TABLE `USERS_LANGUAGES`
  ADD UNIQUE KEY `id_users` (`id_users`,`id_language`),
  ADD KEY `id_language` (`id_language`);

--
-- Indexes for table `USERS_ROOM_LANGUAGES`
--
ALTER TABLE `USERS_ROOM_LANGUAGES`
  ADD UNIQUE KEY `id_user` (`id_user`,`id_room`,`id_language`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_language` (`id_language`);

--
-- Indexes for table `USERS_VIDEOS_MESSAGES`
--
ALTER TABLE `USERS_VIDEOS_MESSAGES`
  ADD UNIQUE KEY `id_video` (`id_video`,`id_user`,`id_message`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_message` (`id_message`);

--
-- Indexes for table `VIDEOS`
--
ALTER TABLE `VIDEOS`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `LANGUAGES`
--
ALTER TABLE `LANGUAGES`
  MODIFY `id_language` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `MESSAGES`
--
ALTER TABLE `MESSAGES`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ROOM`
--
ALTER TABLE `ROOM`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VIDEOS`
--
ALTER TABLE `VIDEOS`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `USERS_LANGUAGES`
--
ALTER TABLE `USERS_LANGUAGES`
  ADD CONSTRAINT `USERS_LANGUAGES_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `USERS` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USERS_LANGUAGES_ibfk_2` FOREIGN KEY (`id_language`) REFERENCES `LANGUAGES` (`id_language`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `USERS_ROOM_LANGUAGES`
--
ALTER TABLE `USERS_ROOM_LANGUAGES`
  ADD CONSTRAINT `USERS_ROOM_LANGUAGES_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USERS` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USERS_ROOM_LANGUAGES_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `ROOM` (`id_room`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USERS_ROOM_LANGUAGES_ibfk_3` FOREIGN KEY (`id_language`) REFERENCES `LANGUAGES` (`id_language`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `USERS_VIDEOS_MESSAGES`
--
ALTER TABLE `USERS_VIDEOS_MESSAGES`
  ADD CONSTRAINT `USERS_VIDEOS_MESSAGES_ibfk_1` FOREIGN KEY (`id_video`) REFERENCES `VIDEOS` (`id_video`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USERS_VIDEOS_MESSAGES_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `USERS` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USERS_VIDEOS_MESSAGES_ibfk_3` FOREIGN KEY (`id_message`) REFERENCES `MESSAGES` (`id_message`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
