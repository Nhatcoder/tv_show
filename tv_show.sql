-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2024 at 04:26 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tv_show`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `google_id`, `role`) VALUES
(11, 'Trần Văn Nhật PH 3 3 5 7 2 FPL HN', 'https://lh3.googleusercontent.com/a/ACg8ocKxoTsqb80gNqPWINy5wDfIV6ovGs-Xr8OrjAP8XM2FvRKxOCqK=s96-c', 'nhattvph33572@fpt.edu.vn', NULL, '$2y$12$hjQO7JkyJfknKdt4AZ21m./FPrie3qZdIn/S.LgirzHZJqPQ9UqbO', NULL, '2024-04-22 21:14:55', '2024-04-22 21:16:25', '107430092281701089295', 1),
(12, 'Trần Nhật', 'https://lh3.googleusercontent.com/a/ACg8ocJ0DSz_GDjnfix_87kgjKwDdGpjB_yHFo8f1eDDIy60h2xlaZg=s96-c', 'nhatcaca2004@gmail.com', NULL, '$2y$12$hvtXJoJ7zBesGSk3XS/Dfe9/HKjCke1.rTlUm1sHd7gCqtCPmYyyG', NULL, '2024-04-22 21:18:04', '2024-04-22 21:18:59', '117622144869182708438', 1),
(13, 'Nhật Trần', 'https://lh3.googleusercontent.com/a/ACg8ocKZPX44ljVMbLMEh2TPa176fzECSQZKruAHnNCNwkYwAWuDKA=s96-c', 'nhattvph33572@gmail.com', NULL, '$2y$12$jQgxTmqV.L6hUqLWzfunFuCguEYXE8i3RCdA9rITwkfZXvmeD1/zW', NULL, '2024-04-22 21:18:31', '2024-04-22 21:18:31', '116845221357187125171', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
