-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2024 at 10:33 AM
-- Server version: 10.11.4-MariaDB-1~deb12u1
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `help_with_homework`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`content`, `homework_id`, `user_id`, `posted_at`) VALUES
('Here are some tips for solving derivatives.', 1, 3, '2024-04-10 09:15:00'),
('Have you considered the social impact of the French Revolution?', 2, 5, '2024-04-11 15:00:00'),
('For a physics experiment, you could explore pendulum motion.', 3, 4, '2024-04-12 12:00:00'),
('I recommend analyzing the poem''s use of imagery.', 4, 2, '2024-04-13 17:00:00'),
('You can use the power rule to find the derivative.', 1, 6, '2024-04-10 10:00:00'),
('The French Revolution led to significant political changes.', 2, 8, '2024-04-11 15:30:00'),
('Consider conducting an experiment on projectile motion.', 3, 7, '2024-04-12 12:30:00'),
('Emily Dickinson often uses nature symbolism in her poems.', 4, 9, '2024-04-13 17:30:00'),
('Feel free to ask if you need more help with calculus.', 1, 10, '2024-04-10 11:00:00'),
('You could compare the French Revolution to other revolutions.', 2, 11, '2024-04-11 16:00:00'),
('Try to relate the experiment to real-life applications of physics.', 3, 12, '2024-04-12 13:00:00');

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`user_id`, `title`, `content`, `posted_at`) VALUES
(1, 'Need Math Help!', 'Struggling with calculus, need assistance with derivatives.', '2024-04-10 09:00:00'),
(2, 'History Essay Help', 'Looking for guidance on writing a history essay about the French Revolution.', '2024-04-11 14:30:00'),
(3, 'Science Project Advice', 'Seeking suggestions for a science experiment related to physics.', '2024-04-12 11:45:00'),
(1, 'Literature Analysis Assistance', 'Require help analyzing a poem by Emily Dickinson for my English class.', '2024-04-13 16:20:00');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'john_doe', 'john.doe@example.com', 'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f'), -- password123
(2, 'jane_smith', 'jane.smith@example.com', 'b59717793d432dd2c4edf0c960948ef581d8499393aaef6214a5fbd4cb1c2e3d'), -- letmein456
(3, 'mike_jones', 'mike.jones@example.com', 'b0b9ab00009472932990029b678b3ab3d932f69e7b028067915ae7f0106577f8'); -- securepass789
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
