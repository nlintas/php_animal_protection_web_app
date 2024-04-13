-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2020 at 06:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petdb_v8`
--

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `petID` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `gender` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` tinyint(3) UNSIGNED NOT NULL,
  `for_adoption` tinyint(1) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `name_metaphone` varchar(50) NOT NULL,
  `colour1` varchar(10) NOT NULL,
  `colour2` varchar(10) DEFAULT NULL,
  `colour3` varchar(10) DEFAULT NULL,
  `userID` int(6) UNSIGNED NOT NULL,
  `breedID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`petID`, `name`, `gender`, `description`, `health_status`, `age`, `for_adoption`, `photo`, `date_created`, `name_metaphone`, `colour1`, `colour2`, `colour3`, `userID`, `breedID`) VALUES
(9, 'Jackie', 'Male', '', 'Healthy', 2, 0, '', '2020-05-25', 'JK', 'Green', NULL, NULL, 5, 5),
(10, 'Sasha', 'Female', '', 'In Recover', 4, 0, '', '2020-05-25', 'SX', 'Green', NULL, NULL, 5, 6),
(11, 'Fasti', 'Male', '', 'Injured', 1, 0, '', '2020-05-25', 'FST', 'Green', NULL, NULL, 5, 19),
(12, 'Lucky', 'Male', 'i have not seen him in 3 days. Please if you see him contact me. ', 'Healthy', 5, 0, '', '2020-05-25', 'LK', 'Blue', NULL, NULL, 5, 12),
(13, 'kata', 'Female', 'Ajnsnjdkmsw', 'In Recover', 3, 0, '', '2020-05-25', 'KT', 'Green', NULL, NULL, 5, 2),
(14, 'katar', 'Female', 'kakjddjjd', 'Healthy', 2, 0, '', '2020-05-25', 'KTR', 'Blue', NULL, NULL, 5, 17),
(15, 'kata', 'Female', 'aqwerthgvdsca', 'In Recover', 4, 0, '', '2020-05-25', 'KT', 'Green', NULL, NULL, 5, 3),
(16, 'katerrr', 'Other', 'wertyujgrfdesca', 'In Recover', 5, 0, '', '2020-05-25', 'KTR', 'Brown', NULL, NULL, 5, 16),
(17, 'Arat', 'Female', 'kaJSBHDNKL;ADSFK', 'In Recover', 1, 0, '', '2020-05-25', 'ART', 'Brown', NULL, NULL, 5, 14),
(18, 'kata', 'Female', 'dsfghygfdsdf', 'In Recover', 3, 0, '', '2020-05-25', 'KT', 'White', NULL, NULL, 5, 3),
(20, 'Rex', 'Male', 'Meet Rex. He is a friend to everyone and an amazing athlete. This big boy can share his home with other pets too.', 'Healthy', 3, 1, 'User_Images/Adoption_Images/5ecbf55b9377c.jpg', '2020-05-25', 'RKS', 'Black', NULL, NULL, 5, 1),
(21, 'Cindy', 'Female', 'If your family loves going on adventures and wants a best friend to join in on the fun, from hiking to drive-in movies to Frisbee tournaments, you might be the perfect match for sweet, silly Cindy!', 'Healthy', 2, 1, 'User_Images/Adoption_Images/5ecbf5b4e63ee.jpg', '2020-05-25', 'SNT', 'Orange', NULL, NULL, 5, 5),
(22, 'Sasha', 'Female', 'Meet Sasha! She is a ball-catching superstar who loves sports and spending time with friends of all ages. A perfect day for Sasha includes going for a jog or playing ball, then snuggling up for a nap.', 'In Recover', 2, 1, 'User_Images/Adoption_Images/5ecbf5fbad5f4.jpg', '2020-05-25', 'SX', 'White', NULL, NULL, 5, 6),
(23, 'Sunny', 'Male', 'Meet your new friend Sunny. He likes to fly outdoors and does not leave home. He is friendly and very cute! You will love his beautiful voice.', 'Injured', 1, 1, 'User_Images/Adoption_Images/5ecbf660d58d6.jpg', '2020-05-25', 'SN', 'White', NULL, NULL, 5, 2),
(25, 'Snowball', 'Male', 'If your family enjoys quiet time then you might be the perfect match for Snowball. He is an adorable, quirky looking white Persian who really wants to be by your side. He gets along well with other cats.', 'Healthy', 1, 1, 'User_Images/Adoption_Images/5ecbf70c92d0b.jpg', '2020-05-25', 'SNBL', 'White', NULL, NULL, 5, 3),
(26, 'Garfield', 'Male', 'Meet Garfield! He is the cutest Persian cat you will see! Same as Garfield from the movie, our Garfield also likes to eat a lot, and is friendly with other pets especially dogs. He is pretty funny too.', 'In Recover', 1, 1, 'User_Images/Adoption_Images/5ecbf73967564.jpg', '2020-05-25', 'KRFLT', 'Orange', NULL, NULL, 5, 3),
(27, 'Bella', 'Female', 'Bella is 1 year old Holland Lop Rabbit. This adorable bun is searching to find a wonderful forever home where she will have the love, space and attention she deserves.', 'Healthy', 1, 1, 'User_Images/Adoption_Images/5ecbf768285ac.jpg', '2020-05-25', 'BL', 'White', NULL, NULL, 5, 4),
(28, 'Chloe', 'Female', 'Chloe is a 3 year old Pomeranian Spitz who loves walking outdoors, sleeping and cuddling. If you are searching for a quiet and lovely friend than here it is.', 'Healthy', 3, 1, 'User_Images/Adoption_Images/5ecbf79ac2ad1.jpg', '2020-05-25', 'XL', 'Brown', NULL, NULL, 5, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`petID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `breedID` (`breedID`),
  ADD KEY `colourID1` (`colour1`),
  ADD KEY `colourID2` (`colour2`),
  ADD KEY `colourID3` (`colour3`);
ALTER TABLE `pet` ADD FULLTEXT KEY `description` (`description`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `petID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `pet_ibfk_2` FOREIGN KEY (`breedID`) REFERENCES `breed` (`breedID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
