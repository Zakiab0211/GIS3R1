CREATE DATABASE giseri;
USE giseri;


CREATE TABLE `centre__points` (
  `id` bigint UNSIGNED NOT NULL,
  `coordinates` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `irrigation`
--

CREATE TABLE `irrigation` (
  `curah_hujan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `liquid_volume` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `flow_rate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jarak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `irrigation`
--

INSERT INTO `irrigation` (`curah_hujan`, `liquid_volume`, `timestamp`, `longitude`, `latitude`, `flow_rate`, `jarak`) VALUES
('4.03', '21', 'Selasa 25/02/2025', '112.7946243', '-7.276136875', '5', '35'),
('5.12', '18', 'Rabu 26/02/2025', '112.7955000', '-7.277000000', '6', '40'),
('3.45', '25', 'Kamis 27/02/2025', '112.7938000', '-7.275500000', '4', '30'),
('4.78', '20', 'Jumat 28/02/2025', '112.7946243', '-7.276136875', '7', '45'),
('5.90', '23', 'Sabtu 29/02/2025', '112.7955000', '-7.277000000', '8', '38'),
('4.32', '19', 'Minggu 1/03/2025', '112.7938000', '-7.275500000', '5', '33'),
('4.56', '22', 'Senin 2/03/2025', '112.7946243', '-7.276136875', '6', '37'),
('3.89', '24', 'Selasa 3/03/2025', '112.7955000', '-7.277000000', '5', '42'),
('4.67', '26', 'Rabu 4/03/2025', '112.7938000', '-7.275500000', '7', '36'),
('5.10', '27', 'kamis 5/03/2025', '112.7946243', '-7.276136875', '6', '39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_10_081912_create_centre__points_table', 2),
(7, '2023_07_10_081935_create_spots_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soil`
--

CREATE TABLE `soil` (
  `moisture` varchar(255) NOT NULL,
  `conductivity` varchar(255) NOT NULL,
  `fosfor` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `ph` varchar(255) NOT NULL,
  `kalium` varchar(255) NOT NULL,
  `nitrogen` varchar(255) NOT NULL,
  `temperature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `soil`
--

INSERT INTO `soil` (`moisture`, `conductivity`, `fosfor`, `longitude`, `latitude`, `ph`, `kalium`, `nitrogen`, `temperature`) VALUES
('42.27000427', '1600', '728', '112.5551682', '-7.23756361', '8.289999008', '726', '296', '29.16999245'),
('38.12000381', '1400', '680', '112.5582001', '-7.23980021', '7.950000000', '710', '290', '28.56000137'),
('45.30000233', '1700', '750', '112.5609823', '-7.24156234', '8.100000381', '740', '305', '30.25000191'),
('41.55999756', '1550', '720', '112.5536721', '-7.23589123', '8.200000763', '720', '285', '29.70000076'),
('39.98000336', '1450', '700', '112.5513029', '-7.23250012', '7.980000019', '700', '275', '28.90000153'),
('43.22000122', '1620', '735', '112.5598711', '-7.23810021', '8.250000000', '730', '295', '29.98000145'),
('37.60000229', '1380', '670', '112.5549322', '-7.23087456', '7.900000000', '690', '270', '28.30000114'),
('46.10000229', '1750', '765', '112.5619212', '-7.24392312', '8.400000572', '750', '310', '30.80000114'),
('40.45999908', '1500', '710', '112.5567123', '-7.23659234', '8.050000000', '715', '280', '29.20000076'),
('38.88999939', '1430', '690', '112.5521119', '-7.23178124', '7.970000267', '705', '265', '28.70000076'),
('44.55000305', '1680', '740', '112.5587612', '-7.24010032', '8.300000191', '735', '300', '30.10000038'),
('39.15000153', '1470', '705', '112.5508934', '-7.23319231', '8.010000610', '710', '278', '28.85000038');

-- --------------------------------------------------------

--
-- Table structure for table `spots`
--

CREATE TABLE `spots` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinates` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'zaki', 'zakiabdullahfaiq@gmail.com', NULL, '$2y$10$WHebJCowwJJxfN/E.qQmreiizEBMlg./xjajpCzDXlqCaYMndzK9m', NULL, '2025-02-22 08:14:53', '2025-02-22 08:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `TimeStamp` varchar(255) NOT NULL,
  `Humidity` varchar(255) NOT NULL,
  `Latitude` varchar(255) NOT NULL,
  `Longitude` varchar(255) NOT NULL,
  `Pressure` varchar(255) NOT NULL,
  `Rainfall` varchar(255) NOT NULL,
  `Temperature` varchar(255) NOT NULL,
  `UV` varchar(255) NOT NULL,
  `WindDirection` varchar(255) NOT NULL,
  `WindSpeed` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`TimeStamp`, `Humidity`, `Latitude`, `Longitude`, `Pressure`, `Rainfall`, `Temperature`, `UV`, `WindDirection`, `WindSpeed`) VALUES
('Kamis 27/02/2025', '36.57', '-7.233379', '112.553753', '1009.28', '0', '37.54', '17258', '30', 37),
('Jumat 28/02/2025', '38.12', '-7.237819', '112.553038', '1010.15', '0', '36.98', '16234', '45', 32),
('Sabtu 29/02/2025', '37.45', '-7.233379', '112.553753', '1008.75', '0', '38.21', '18240', '60', 29),
('Minggu 1/03/2025', '35.80', '-7.237819', '112.553038', '1009.50', '0', '37.00', '17000', '35', 35),
('Senin 2/03/2025', '39.20', '7.233379', '112.553753', '1007.80', '0', '36.45', '18050', '50', 32),
('Selasa 3/03/2025', '36.90', '-7.234765', '112.550614', '1008.20', '0', '38.00', '17560', '40', 30),
('Rabu 4/03/2025', '34.75', '-7.233379', '112.553753', '1011.00', '0', '35.90', '16020', '25', 30),
('Kamis 5/03/2025', '37.60', '-7.234765', '112.550614', '1009.35', '0', '37.20', '17400', '55', 35),
('Jumat 6/03/2025', '38.50', '-7.234765', '112.550614', '1012.10', '0', '39.10', '18500', '65', 34),
('Sabtu 7/03/2025', '36.10', '-7.234765', '112.550614', '1008.90', '0', '36.80', '17100', '30', 38);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centre__points`
--
ALTER TABLE `centre__points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `spots`
--
ALTER TABLE `spots`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `centre__points`
--
ALTER TABLE `centre__points`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spots`
--
ALTER TABLE `spots`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

