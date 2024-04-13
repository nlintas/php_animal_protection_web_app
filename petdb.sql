-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2020 at 09:19 PM
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
-- Database: `petdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE `breed` (
  `breedID` int(4) UNSIGNED NOT NULL,
  `name` char(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `speciesID` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`breedID`, `name`, `speciesID`) VALUES
(1, 'German Shepard', 1),
(2, 'Canary', 2),
(3, 'Persian', 3),
(4, 'Holland Lop', 4),
(5, 'Golden Retriever', 1),
(6, 'Pitbull', 1),
(7, 'Chihuahua', 1),
(8, 'Labrador', 1),
(9, 'Husky', 1),
(10, 'Bulldog', 1),
(11, 'Bengal', 3),
(12, 'Pomeranian Spitz', 1),
(13, 'Siamese', 3),
(14, 'Ragdoll', 3),
(15, 'Sphynx', 3),
(16, 'Red factor', 2),
(17, 'Harz Roller', 2),
(18, 'Java chicken', 2),
(19, 'Dutch Rabbit', 4),
(20, 'English Lop', 4),
(21, 'Flemish Giant', 4),
(22, 'Oranda', 5),
(23, 'Koi', 5),
(24, 'Lionhead', 5),
(25, 'Sea turtle', 10),
(26, 'Arabian horse', 8),
(27, 'Mustang', 8);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(10) UNSIGNED NOT NULL,
  `description` varchar(600) NOT NULL,
  `likes` int(4) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `eventID` int(10) UNSIGNED NOT NULL,
  `userID` int(6) UNSIGNED NOT NULL,
  `notificationID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `description`, `likes`, `date_created`, `eventID`, `userID`, `notificationID`) VALUES
(2, 'I like youu', 2, '2020-05-24 11:20:47', 1, 3, 1234),
(3, 'I hope i find my pet very soon', 3, '2020-05-25 16:50:30', 1, 7, 1),
(4, 'Help me find it ', 8, '2020-05-19 16:50:30', 7, 8, 1234),
(7, 'I have not seen it but if i see it ill contact it.', 3, '2020-05-17 16:52:27', 7, 6, 2),
(9, 'He is so cute! i hope he will be home soon ', 8, '2020-05-24 16:53:08', 5, 8, 1234),
(10, 'I hope you find it soon. He is very cute', 5, '2020-05-25 16:53:08', 6, 5, 1234);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` int(10) UNSIGNED NOT NULL,
  `country_short` char(2) NOT NULL,
  `country_long` varchar(50) NOT NULL,
  `street` varchar(90) NOT NULL,
  `postcode` varchar(25) NOT NULL,
  `description` varchar(600) NOT NULL,
  `radius` int(2) UNSIGNED NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `event_typeID` int(3) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `country_short`, `country_long`, `street`, `postcode`, `description`, `radius`, `date_created`, `event_typeID`, `userID`) VALUES
(1, 'Al', 'Albania', 'Sali Butka', '1234', 'Waww its amazing', 10, '2020-05-24', 2, 4),
(3, 'GR', 'Greece', 'Leoforos Vouliagmenis', '172 37', 'You can find poisonous food here ', 5, '2020-05-25', 2, 4),
(4, 'GR', 'Greece', 'Parodos Aftokinitodromos PATHE', '351 00', '', 10, '2020-05-25', 1, 5),
(5, 'GR', 'Greece', 'Eparchiaki Odos Artas - Ioanninon', '455 00', '', 20, '2020-05-25', 1, 5),
(6, 'BG', 'Bulgaria', '565', '4138', '', 10, '2020-05-25', 1, 5),
(7, 'GR', 'Greece', 'Eparchiaki Odos Verias-Kipselis', '590 31', 'i have not seen him in 3 days. Please if you see him contact me. ', 0, '2020-05-25', 1, 5),
(8, 'GR', 'Greece', 'Eparchiaki Odos Lagkadias - Theoktistou', '220 03', 'There is some poisonous food in this area. Please do something ', 10, '2020-05-25', 2, 5),
(9, 'GR', 'Greece', 'Egnatia Odos', '564 29', 'I need help to move this poisonous food from here. It is very dangerous!', 15, '2020-05-25', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `event_typeID` int(3) UNSIGNED NOT NULL,
  `type` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`event_typeID`, `type`) VALUES
(1, 'Lost Pet'),
(2, 'Poison');

-- --------------------------------------------------------

--
-- Table structure for table `lost_pet`
--

CREATE TABLE `lost_pet` (
  `lostPetID` int(10) UNSIGNED NOT NULL,
  `petID` int(10) UNSIGNED NOT NULL,
  `eventID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lost_pet`
--

INSERT INTO `lost_pet` (`lostPetID`, `petID`, `eventID`) VALUES
(2, 9, 4),
(3, 10, 5),
(4, 11, 6),
(5, 12, 7);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notificationID` int(10) UNSIGNED NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `type` char(20) NOT NULL,
  `status` char(11) NOT NULL,
  `userID` int(6) UNSIGNED NOT NULL,
  `templateID` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notificationID`, `date_created`, `type`, `status`, `userID`, `templateID`) VALUES
(1, '2020-05-25', 'comment', 'read', 5, 1),
(2, '2020-05-19', 'comment', 'unread', 6, 1),
(4, '2020-05-24', 'like', 'unread', 7, 2),
(5, '2020-05-19', 'like', 'unread', 8, 2),
(1234, '2020-05-24', 'comment', 'read', 3, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `replyID` int(10) UNSIGNED NOT NULL,
  `replyCommentID` int(10) UNSIGNED NOT NULL,
  `toCommentID` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `notificationID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`replyID`, `replyCommentID`, `toCommentID`, `date_created`, `notificationID`) VALUES
(1, 7, 4, '2020-05-18 16:54:50', 1234),
(2, 10, 3, '2020-05-24 16:55:13', 1),
(3, 7, 9, '2020-05-13 16:55:13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sessionID` int(5) UNSIGNED NOT NULL,
  `sessionCode` char(32) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `userID` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sessionID`, `sessionCode`, `date_created`, `userID`) VALUES
(2, '73s3p2jjdjfaamflnng3fjt265', '2020-05-22', 4),
(5, 'g7jvl8rhei71hvlf3l81dbfvf4', '2020-05-25', 5);

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

CREATE TABLE `species` (
  `speciesID` int(4) UNSIGNED NOT NULL,
  `name` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `species`
--

INSERT INTO `species` (`speciesID`, `name`) VALUES
(1, 'Dog'),
(2, 'Bird'),
(3, 'cat'),
(4, 'Rabbit'),
(5, 'fish'),
(6, 'bear'),
(7, 'Hamster'),
(8, 'Horse'),
(9, 'Sheep'),
(10, 'Turtle');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `templateID` int(3) UNSIGNED NOT NULL,
  `description` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`templateID`, `description`) VALUES
(1, 'commented on your post'),
(2, 'liked your comment.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` tinyint(3) UNSIGNED NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `country_short` char(2) NOT NULL,
  `country_long` varchar(50) NOT NULL,
  `postcode` varchar(25) NOT NULL,
  `street` varchar(90) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `username_metaphone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `email`, `gender`, `age`, `photo`, `country_short`, `country_long`, `postcode`, `street`, `date_created`, `username_metaphone`) VALUES
(3, 'Katerina', 'Katerina123', 'kate@gmail.com', 'f', 19, NULL, 'Al', '', '234677', 'Salios Butka', '2020-05-23', 'akataak'),
(4, 'SuperBugx', '3milyRoom', 'pkalatzis@citycollege.sheffield.eu', 'Male', 0, 'User_Images/Profile_Images/5ec7f76f7c095.jpg', 'AW', 'Aruba', '21352', 'kassandras 3', '2020-05-22', 'SPRBKKS'),
(5, 'kataMa', '$2y$10$ZNDRSxhwDl88vXOf8jN5jee1rE9nTSDOdCWToc4H1Iuhp2DYvNt.W', 'katerina@gmail.com', 'Female', 1, 'images\\profile\\user-no-image.png', 'AL', 'Albania', '1234', 'Sali ktagr 2', '2020-05-25', 'KTM'),
(6, 'EmilyJany', '$2y$10$.MbesG7SnqtzlzHc5SQdI.Kmlk7r5tXgGZ.fr.w2JPnpPi6sgM6.C', 'Emily@gmail.com', 'Female', 22, 'images\\profile\\user-no-image.png', 'BS', 'Bahamas', '63200', 'Maluos Grnados 14', '2020-05-25', 'EMLJN'),
(7, 'Mateo13', '$2y$10$mjzEynN.ThcOPfL9CIKW.ukdWGXOFL2EXCa9Rko4WVC3U53TOIURC', 'MateoM@gmail.com', 'Male', 21, 'images\\profile\\user-no-image.png', 'IT', 'Italy', '5633', 'Bedricuis Grnade 5', '2020-05-25', 'MT'),
(8, 'StellaS', '$2y$10$xv9KWG7DwSvmCR/meK6HNeuiAENvzp7i2pkH3EsoXMAE4QLCIOgnS', 'Stella@gmail.com', 'Female', 22, 'images\\profile\\user-no-image.png', 'GR', 'Greece', '1347', 'Agios Pavlos 13', '2020-05-25', 'STLS');

-- --------------------------------------------------------

--
-- Table structure for table `user_likes`
--

CREATE TABLE `user_likes` (
  `userLikesID` int(3) UNSIGNED NOT NULL,
  `userID` int(6) UNSIGNED NOT NULL,
  `commentID` int(10) UNSIGNED NOT NULL,
  `notificationID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_likes`
--

INSERT INTO `user_likes` (`userLikesID`, `userID`, `commentID`, `notificationID`) VALUES
(1, 5, 9, 4),
(2, 8, 7, 4),
(3, 7, 9, 5);

--
-- Triggers `user_likes`
--
DELIMITER $$
CREATE TRIGGER `deleteLikes` AFTER DELETE ON `user_likes` FOR EACH ROW UPDATE comment
SET likes = likes - 1
WHERE commentID = OLD.commentID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateLikes` AFTER INSERT ON `user_likes` FOR EACH ROW UPDATE comment
SET likes = likes + 1
WHERE commentID = NEW.commentID
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`breedID`),
  ADD KEY `speciesID` (`speciesID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `eventID` (`eventID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `notificationID` (`notificationID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `event_typeID` (`event_typeID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`event_typeID`);

--
-- Indexes for table `lost_pet`
--
ALTER TABLE `lost_pet`
  ADD PRIMARY KEY (`lostPetID`),
  ADD KEY `petID` (`petID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `templateID` (`templateID`);

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
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`replyID`),
  ADD KEY `newCommentID` (`replyCommentID`),
  ADD KEY `atCommentID` (`toCommentID`),
  ADD KEY `notificationID` (`notificationID`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sessionID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`speciesID`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`templateID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`userLikesID`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `notificationID` (`notificationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breed`
--
ALTER TABLE `breed`
  MODIFY `breedID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `event_typeID` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lost_pet`
--
ALTER TABLE `lost_pet`
  MODIFY `lostPetID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `petID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `replyID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `sessionID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `species`
--
ALTER TABLE `species`
  MODIFY `speciesID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_likes`
--
ALTER TABLE `user_likes`
  MODIFY `userLikesID` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `breed`
--
ALTER TABLE `breed`
  ADD CONSTRAINT `breed_ibfk_1` FOREIGN KEY (`speciesID`) REFERENCES `species` (`speciesID`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`notificationID`) REFERENCES `notification` (`notificationID`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`event_typeID`) REFERENCES `event_type` (`event_typeID`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `lost_pet`
--
ALTER TABLE `lost_pet`
  ADD CONSTRAINT `lost_pet_ibfk_1` FOREIGN KEY (`petID`) REFERENCES `pet` (`petID`),
  ADD CONSTRAINT `lost_pet_ibfk_2` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`templateID`) REFERENCES `template` (`templateID`),
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `pet_ibfk_2` FOREIGN KEY (`breedID`) REFERENCES `breed` (`breedID`);

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`replyCommentID`) REFERENCES `comment` (`commentID`),
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`toCommentID`) REFERENCES `comment` (`commentID`),
  ADD CONSTRAINT `reply_ibfk_3` FOREIGN KEY (`notificationID`) REFERENCES `notification` (`notificationID`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD CONSTRAINT `user_likes_ibfk_1` FOREIGN KEY (`commentID`) REFERENCES `comment` (`commentID`),
  ADD CONSTRAINT `user_likes_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `user_likes_ibfk_3` FOREIGN KEY (`notificationID`) REFERENCES `notification` (`notificationID`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `SessionDeletion` ON SCHEDULE EVERY 10 MINUTE STARTS '2020-05-08 18:25:40' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Delete sessions after 1 hour from first being created' DO DELETE FROM session WHERE date_created < (NOW() - INTERVAL 1 HOUR)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
