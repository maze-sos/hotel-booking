-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 03:43 AM
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
-- Database: `hotel-booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `adminname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `adminname`, `email`, `mypassword`, `create_at`) VALUES
(1, 'new', 'new@gmail.com', '$2y$10$PIMTwzyXJciBcpDOWdeWB.ZUWvRjL5xAZSitKJhRFGJ6mljW62fgy', '2024-01-26 09:28:52'),
(2, 'admin', 'admin@gmail.com', '$2y$10$iIxZqJp4GkTAUYYUpplbXeV0MQZUXiMEPRv3DPfMtVe26NtmIgYFK', '2024-01-29 10:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `check_in` varchar(255) NOT NULL,
  `check_out` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `image`, `description`, `location`, `status`, `created_at`) VALUES
(1, 'Sheraton', 'services-1.jpg', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'Abuja', 1, '2024-01-24 09:51:34'),
(2, 'The Plaza', '6.jpg', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 'Lagos', 1, '2024-01-24 09:51:34'),
(3, 'The Ritz', 'image_4.jpg', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.', 'Abuja', 0, '2024-01-24 09:51:34'),
(4, 'Awotelo', 'fernando-alvarez-rodriguez-M7GddPqJowg-unsplash.jpg', 'Awotelo is a world class hotel that has all the features you can imagine.', 'Abuja', 1, '2024-02-01 11:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `num_persons` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `view` varchar(255) NOT NULL,
  `num_beds` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `uti_description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `image`, `description`, `price`, `num_persons`, `size`, `view`, `num_beds`, `hotel_id`, `hotel_name`, `uti_description`, `status`, `created_at`) VALUES
(1, 'Suite Room', 'room-1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 7000, 3, 45, 'Sea View', 1, 1, 'Sheraton', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 1, '2024-01-24 10:22:55'),
(2, 'Standard Room', 'room-2.jpg', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 8000, 4, 60, 'Sea View', 1, 2, 'The Plaza Hotel', 'Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.', 1, '2024-01-24 10:22:55'),
(3, 'Family Room', 'room-3.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.', 5000, 5, 45, 'Sea View', 2, 3, 'The Ritz', 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 1, '2024-01-24 10:22:55'),
(4, 'Deluxe Room', 'room-4.jpg', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur', 10000, 5, 80, 'Beach View', 3, 3, 'The Ritz', 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 1, '2024-01-24 10:22:55'),
(5, 'Telo Suite', 'visualsofdana-T5pL6ciEn-I-unsplash.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 50000, 3, 45, 'Beach View', 3, 4, 'Awotelo', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 1, '2024-02-01 12:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mypassword` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `email`, `mypassword`, `status`, `created_at`) VALUES
(1, 'Test', '12345678912', 'Test@gmail.com', '$2y$10$P9LVexWEK5tQ6//Z9vmiU.e.33LTy6rACaO9X0KHNIT74zK0qSzEa', 1, '2024-01-24 09:09:12'),
(3, 'Maze_SOS', '98765432112', 'themazesos@gmail.com', '$2y$10$4CqgM8bbqohywXiFHwd4Y.y6v5HfAzSnw9GHprilt3ee8LVxwxaRK', 0, '2024-01-30 13:44:56'),
(4, 'Adesola23', '34125678998', 'adesolaoni2001@gmail.com', '$2y$10$aMRqsnnf9vNpRxYBOuHfxuW4M9UDrQurDjMqLwavVv/hzKWH1.PvS', 1, '2024-01-30 13:47:16'),
(5, 'testttt', '9876543121', 'testt@gmail.com', '$2y$10$dI0jbdtQWSpA2/4PvEQZxuCsxNULyvKW8HYyy8QsvFbnufMLTPf2S', 1, '2024-02-01 09:52:54'),
(6, 'asdf', '123456789', 'asdf@gmail.com', '$2y$10$KtFFEsPHkIwa9zXu8mwk/.U8KaYde7eENqlEoXV5/nFWDqRUO9LOi', 1, '2024-08-22 07:37:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
