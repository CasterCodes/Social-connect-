-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 05:32 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectt`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `commentBody` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dlikes`
--

CREATE TABLE `dlikes` (
  `likeId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `educationId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `school` varchar(256) NOT NULL,
  `schoolLevel` varchar(256) NOT NULL,
  `schoolField` varchar(256) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `currentEducation` varchar(256) DEFAULT 'no',
  `educationDesc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`educationId`, `userId`, `school`, `schoolLevel`, `schoolField`, `fromDate`, `toDate`, `currentEducation`, `educationDesc`) VALUES
(1, 1, 'University of Nairobi', 'Degree', 'Technology', '2018-05-01', '2018-10-01', 'no', 'Please use a comma separated values (eg HTML, Javascript) but not more than four,Please use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than four,Please use a comma separated values (eg HTML, Javascript) but not more than four,');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `experienceId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `jobTitle` varchar(256) NOT NULL,
  `companyName` varchar(256) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `currentJob` varchar(256) DEFAULT 'no',
  `jobDesc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`experienceId`, `userId`, `jobTitle`, `companyName`, `fromDate`, `toDate`, `currentJob`, `jobDesc`) VALUES
(1, 1, 'Frontend Developer', 'CasterCodes', '2018-12-01', '0000-00-00', 'yes', 'Please use a comma separated values (eg HTML, Javascript) but not more than four,Please use a comma separated values (eg HTML, Javascript) but not more than four,Please use a comma separated values (eg HTML, Javascript) but not more than four,Please use a comma separated values (eg HTML, Javascript) but not more than four'),
(2, 2, 'Fullstack Developer', 'Traversy Media', '2006-01-01', '0000-00-00', 'no', 'If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your usernameIf you want your latest repos and Github link, include your username');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postBody` longtext NOT NULL,
  `likes` int(11) DEFAULT 1,
  `dislikes` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `userId`, `postBody`, `likes`, `dislikes`) VALUES
(1, 1, 'Please use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than four', 1, 1),
(2, 2, 'If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `profileId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userProfession` varchar(256) NOT NULL,
  `userCompany` varchar(256) NOT NULL,
  `userWebsite` varchar(256) NOT NULL,
  `userLocation` varchar(256) NOT NULL,
  `userSkills` varchar(256) NOT NULL,
  `userGithub` varchar(256) NOT NULL,
  `userBio` longtext NOT NULL,
  `userFacebook` varchar(256) NOT NULL,
  `userTwitter` varchar(256) NOT NULL,
  `userInsta` varchar(256) NOT NULL,
  `userYoutube` varchar(256) NOT NULL,
  `userImage` varchar(256) NOT NULL,
  `uploaded` varchar(256) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`profileId`, `userId`, `userProfession`, `userCompany`, `userWebsite`, `userLocation`, `userSkills`, `userGithub`, `userBio`, `userFacebook`, `userTwitter`, `userInsta`, `userYoutube`, `userImage`, `uploaded`) VALUES
(1, 1, 'Senior', 'CasterCodes', 'https://www.w3schools.com', 'Nairobi', 'php, html, python,java', 'CasterCodes', 'Please use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than fourPlease use a comma separated values (eg HTML, Javascript) but not more than four', 'http://facebook.com', 'http://twitter.com', 'http://instagram.com/', 'http://youtube.com', '', 'no'),
(2, 2, 'Junior', 'Traversy Media', 'https://www.traversymedia.com/', 'Boston,Us', 'php, html, python,java', 'bradtraversy', 'If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username,If you want your latest repos and Github link, include your username', 'http://www.facebook.com/traversymedia', 'http://www.twitter.com/traversymedia', 'http://www.instagram.com/traversymedia', 'http://www.youtube.com/traversymedia', 'profile2.jpg', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(256) NOT NULL,
  `userEmail` varchar(256) NOT NULL,
  `userPassword` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`) VALUES
(1, 'Kevin Caster', 'nyagucha.otwori@gmail.com', '$2y$10$W9MvVV2GcmlZjlaFkA/7terMnSuNziHd0WQdgdS1Osm3L2.k1wiMO'),
(2, 'Brad Traversy', 'brad@gmail.com', '$2y$10$iuelhnBJbKOfuNIG8VZsguncaaBTsaeaqChCTLy7Hr4IEST.QGUia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `dlikes`
--
ALTER TABLE `dlikes`
  ADD PRIMARY KEY (`likeId`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`educationId`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`experienceId`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`profileId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dlikes`
--
ALTER TABLE `dlikes`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `educationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `experienceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `profileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
