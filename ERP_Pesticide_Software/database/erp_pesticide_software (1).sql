-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 12:44 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp_pesticide_software`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy_policies`
--

CREATE TABLE `buy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_tenure_data` date NOT NULL,
  `end_tenure_data` date NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `post_sale_incentive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cash_incentive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `policy_incentives_status` int(11) DEFAULT 0,
  `cash_deposited` int(11) DEFAULT 0,
  `remaining_amount` int(11) DEFAULT 0,
  `credit_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buy_policies`
--

INSERT INTO `buy_policies` (`id`, `customer_id`, `customer_phone_no`, `address`, `policy_id`, `policy_code`, `start_tenure_data`, `end_tenure_data`, `discount`, `post_sale_incentive`, `cash_incentive`, `policy_incentives_status`, `cash_deposited`, `remaining_amount`, `credit_note`, `created_at`, `updated_at`) VALUES
(1, '1', '0388-3888909', 'xyz', '1', '0032', '2022-11-01', '2023-12-31', '10', '10', '16', 0, 50000, 0, '26', '2022-11-19 06:59:20', '2022-11-21 21:16:03'),
(2, '2', '0837-3778292', 'xyz', '2', '009', '2022-11-01', '2023-11-30', '7', '10', '15', 0, 180000, 0, '25', '2022-11-19 07:00:01', '2022-11-20 10:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `customer_registerations`
--

CREATE TABLE `customer_registerations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CNIC` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone_number_one` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone_number_two` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advance_payment` bigint(20) DEFAULT NULL,
  `panding_bill` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_registerations`
--

INSERT INTO `customer_registerations` (`id`, `customer_name`, `father_name`, `CNIC`, `phone_number_one`, `phone_number_two`, `adress`, `advance_payment`, `panding_bill`, `created_at`, `updated_at`) VALUES
(1, 'Muhi', 'Abdul ganii', '31033-3338992-3', '0388-3888909', NULL, 'xyz', 270000, 0, '2022-11-19 06:34:02', '2022-11-21 21:16:50'),
(2, 'Ali Akbar', 'Akbar Ali', '3032-33772838-3', '0837-3778292', NULL, 'xyz', 0, 0, '2022-11-19 06:37:09', '2022-11-21 21:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `employees_registrations`
--

CREATE TABLE `employees_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employe_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CNIC` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone_number_one` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone_number_two` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `territory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_exprince` bigint(20) DEFAULT NULL,
  `monthly_salary` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees_registrations`
--

INSERT INTO `employees_registrations` (`id`, `employe_name`, `father_name`, `CNIC`, `phone_number_one`, `phone_number_two`, `address`, `territory`, `designation`, `monthly_exprince`, `monthly_salary`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Mozhan', 'Ali', '3031-49093309-9', '0389-9239990', NULL, 'hxj', 'jdjjks', 'Djjj', 1233, 12233, 1, NULL, '2022-11-19 06:39:37', '2022-11-19 06:39:45'),
(2, 'Amjad Ali', 'Akbar ali', '30829-3889288-3', '0329-3829390', NULL, 'sadiqabad', 'sadiqabad', 'Md', 1000, 10000, 1, NULL, '2022-11-19 06:42:20', '2022-11-19 06:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `purchase_expense` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `sale_expense` int(11) NOT NULL,
  `packing_expense` int(11) NOT NULL,
  `total_expense` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `product_id`, `product_code`, `purchase_price`, `purchase_expense`, `product_quantity`, `sale_expense`, `packing_expense`, `total_expense`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1000, 1200, 170, 120, 140, 1460, NULL, '2022-11-19 06:45:10', '2022-11-19 06:45:10'),
(2, 2, 2, 1600, 1200, 150, 150, 170, 1520, NULL, '2022-11-19 06:45:35', '2022-11-19 06:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(27, '2014_10_12_000000_create_users_table', 1),
(28, '2014_10_12_100000_create_password_resets_table', 1),
(29, '2019_08_19_000000_create_failed_jobs_table', 1),
(30, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(31, '2022_10_08_070917_create_products_table', 1),
(32, '2022_10_11_173633_create_customer_registerations_table', 1),
(33, '2022_10_12_042111_create_employees_registrations_table', 1),
(34, '2022_10_14_065754_create_purchases_table', 1),
(36, '2022_10_14_153806_create_returned_products_table', 1),
(37, '2022_10_18_081604_create_expenses_table', 1),
(38, '2022_10_19_065300_create_salary_pays_table', 1),
(39, '2022_11_13_074916_create_policies_table', 1),
(40, '2022_11_14_075038_create_buy_policies_table', 1),
(49, '2022_10_14_103128_create_Sales_table', 2);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_tenure_data` date NOT NULL,
  `end_tenure_data` date NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `policy_name`, `policy_code`, `start_tenure_data`, `end_tenure_data`, `discount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SS23', '0032', '2022-11-01', '2023-12-31', NULL, NULL, '2022-11-19 06:48:34', '2022-11-19 06:48:34'),
(2, 'SW03', '009', '2022-11-01', '2023-11-30', NULL, NULL, '2022-11-19 06:49:44', '2022-11-19 06:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_code`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'BOP', '001', NULL, '2022-11-19 06:29:22', '2022-11-19 06:29:22'),
(2, 'Triple Action', '002', NULL, '2022-11-19 06:30:40', '2022-11-19 06:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `purchasing_price` int(11) NOT NULL,
  `Saleing_price` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `purchasing_expense` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `product_id`, `product_code`, `purchasing_price`, `Saleing_price`, `expiry_date`, `purchasing_expense`, `product_quantity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '001', 1000, 2000, '2022-12-10', 1200, 170, NULL, '2022-11-19 06:43:26', '2022-11-20 07:56:02'),
(2, 2, '002', 1600, 2400, '2022-12-10', 1200, 150, NULL, '2022-11-19 06:44:15', '2022-11-20 07:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `returned_products`
--

CREATE TABLE `returned_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `customer_phone_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `customer_CNiC` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `product_id` bigint(20) NOT NULL,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `product_Sale_price` bigint(20) NOT NULL,
  `delivery_charges` bigint(20) DEFAULT NULL,
  `charges_amount` bigint(20) DEFAULT NULL,
  `product_quantity` bigint(20) NOT NULL,
  `return_date_and_time` datetime NOT NULL,
  `total_bill` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `returned_products`
--

INSERT INTO `returned_products` (`id`, `customer_id`, `customer_phone_no`, `customer_CNiC`, `product_id`, `product_code`, `product_Sale_price`, `delivery_charges`, `charges_amount`, `product_quantity`, `return_date_and_time`, `total_bill`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, '0388-3888909', '31033-3338992-3', 1, '001', 2000, NULL, 0, 0, '2022-11-19 16:56:00', 0, NULL, '2022-11-19 06:57:05', '2022-11-20 12:12:28'),
(5, 1, '0388-3888909', '31033-3338992-3', 2, '002', 2400, NULL, 0, 0, '2022-11-22 07:06:00', 0, NULL, '2022-11-21 21:06:31', '2022-11-21 21:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `salary_pays`
--

CREATE TABLE `salary_pays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `so_of` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CNIC` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_salary` int(11) NOT NULL,
  `total_monthly_expence` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_pays`
--

INSERT INTO `salary_pays` (`id`, `employee_id`, `so_of`, `CNIC`, `designation`, `monthly_salary`, `total_monthly_expence`, `total_amount`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ali', '3031-49093309-9', 'Djjj', 12233, 1000, 13233, 1, NULL, '2022-11-19 06:46:34', '2022-11-19 06:46:34'),
(2, 2, 'Akbar ali', '30829-3889288-3', 'Md', 10000, 19000, 29000, 1, NULL, '2022-11-19 06:47:09', '2022-11-19 06:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `Sales`
--

CREATE TABLE `Sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `customer_phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_CNiC` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_Sale_price` bigint(20) NOT NULL,
  `policy_id` bigint(20) NOT NULL,
  `policy_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy_discount` bigint(20) NOT NULL,
  `credit_note` bigint(20) NOT NULL,
  `delivery_charges` bigint(20) DEFAULT NULL,
  `charges_amount` bigint(20) DEFAULT NULL,
  `recive_amount` bigint(20) DEFAULT NULL,
  `product_quantity` bigint(20) NOT NULL,
  `total_bill` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Sales`
--

INSERT INTO `Sales` (`id`, `customer_id`, `customer_phone_no`, `customer_CNiC`, `product_id`, `product_code`, `product_Sale_price`, `policy_id`, `policy_code`, `policy_discount`, `credit_note`, `delivery_charges`, `charges_amount`, `recive_amount`, `product_quantity`, `total_bill`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '0388-3888909', '31033-3338992-3', 1, '001', 2000, 1, '0032', 10, 26, 10, 10, 0, 140, 777778, NULL, '2022-11-20 09:50:20', '2022-11-21 21:13:55'),
(2, 1, '0388-3888909', '31033-3338992-3', 2, '002', 2400, 1, '0032', 10, 26, 1200, 1200, 120000, 120, 800000, NULL, '2022-11-21 21:05:14', '2022-11-21 21:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
(3, 'Admin', 'Admin@gmail.com', NULL, '$2y$10$yAptKYir4HWcUnciqsjpE.EMapiXHwEs0Q9J52BFR7vhZtM/MLjae', 'I1FEEeNt97E8WO1wYqahiF48PNz0u58xd24Ag7Mo6THIMSAjExmbbD75VtYT', '2022-11-19 08:12:54', '2022-11-19 08:14:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy_policies`
--
ALTER TABLE `buy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_registerations`
--
ALTER TABLE `customer_registerations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees_registrations`
--
ALTER TABLE `employees_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returned_products`
--
ALTER TABLE `returned_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_pays`
--
ALTER TABLE `salary_pays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Sales`
--
ALTER TABLE `Sales`
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
-- AUTO_INCREMENT for table `buy_policies`
--
ALTER TABLE `buy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_registerations`
--
ALTER TABLE `customer_registerations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees_registrations`
--
ALTER TABLE `employees_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `returned_products`
--
ALTER TABLE `returned_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salary_pays`
--
ALTER TABLE `salary_pays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Sales`
--
ALTER TABLE `Sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
