-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Tem 2024, 10:57:33
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `demobist`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `demobist_bist_data`
--

CREATE TABLE `demobist_bist_data` (
  `stock_id` int(11) NOT NULL,
  `stock_name` varchar(255) NOT NULL,
  `stock_value` varchar(10) NOT NULL,
  `stock_percentage` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `demobist_bist_data`
--

INSERT INTO `demobist_bist_data` (`stock_id`, `stock_name`, `stock_value`, `stock_percentage`) VALUES
(53, 'ASTOR', '93,25', '-0,85'),
(54, 'BIMAS', '575', '0,88'),
(55, 'ENJSA', '65,45', '-0,08'),
(56, 'KCHOL', '230,3', '-0,26'),
(57, 'KOZAL', '22,68', '1,25'),
(58, 'MAVI', '130,6', '-0,68'),
(59, 'SAHOL', '106,2', '-0,19'),
(60, 'SISE', '49,82', '-1,35'),
(61, 'SOKM', '65,3', '1,48'),
(62, 'THYAO', '309', '-0,32'),
(63, 'TOASO', '315,25', '0,24'),
(64, 'TUPRS', '169', '-0,94'),
(65, 'YKBNK', '32,04', '0,82');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `demobist_stock_wallet`
--

CREATE TABLE `demobist_stock_wallet` (
  `wallet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `demobist_stock_wallet`
--

INSERT INTO `demobist_stock_wallet` (`wallet_id`, `user_id`, `stock_id`, `stock_quantity`, `total_amount`, `created_at`, `updated_at`) VALUES
(8, 82, 60, 1, 50, '2024-07-11 21:28:01', '2024-07-11 22:38:36'),
(11, 82, 63, 55, 17325, '2024-07-12 13:16:36', '2024-07-12 13:16:36'),
(12, 82, 55, 12, 780, '2024-07-12 13:44:35', '2024-07-12 13:44:35'),
(13, 82, 56, 16, 3680, '2024-07-12 13:45:22', '2024-07-12 13:46:10'),
(14, 82, 53, 1, 93, '2024-07-12 13:46:45', '2024-07-12 13:46:45'),
(15, 82, 58, 13, 1690, '2024-07-12 13:48:05', '2024-07-12 13:48:17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `demobist_tokens`
--

CREATE TABLE `demobist_tokens` (
  `id` int(11) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `demobist_tokens`
--

INSERT INTO `demobist_tokens` (`id`, `user_mail`, `token`, `token_status`) VALUES
(9, 'Extzmu8DqlPIbr7LWI4VXVYShjaQP7fpuGEQ', '69d7a6d02b65cb93c04a3d8cb21d43893df0a7a492121337448e9e19031678b9', 0),
(12, 'DRVgjeURqlnJLa7MapoNUg4+zzieOw==', '2d333c75f0d3f9aec7e779a6d94554a97f4770c24c5895151b652fbcb7d7de50', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `demobist_transaction_list`
--

CREATE TABLE `demobist_transaction_list` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `demobist_transaction_list`
--

INSERT INTO `demobist_transaction_list` (`transaction_id`, `user_id`, `stock_id`, `stock_quantity`, `total_amount`, `status`, `created_at`) VALUES
(2, 82, 53, 1, 93, 1, '2024-07-12 13:46:45'),
(3, 82, 58, 25, 3250, 1, '2024-07-12 13:48:05'),
(4, 82, 58, 12, 1560, 0, '2024-07-12 13:48:17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `demobist_users`
--

CREATE TABLE `demobist_users` (
  `user_id` int(11) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_register_date` datetime NOT NULL,
  `user_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `demobist_users`
--

INSERT INTO `demobist_users` (`user_id`, `user_mail`, `user_pass`, `user_register_date`, `user_status`) VALUES
(82, 'Extzmu8DqlPIbr7LWI4VXVYShjaQP7fpuGEQ', 'UUsgzLlE', '2024-07-02 00:00:00', 1),
(88, 'DRVgjeURqlnJLa7MapoNUg4+zzieOw==', 'UUsgzLlE', '2024-07-04 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `demobist_wallet`
--

CREATE TABLE `demobist_wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` double DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `demobist_wallet`
--

INSERT INTO `demobist_wallet` (`id`, `user_id`, `total`, `created_at`, `updated_at`) VALUES
(3, 82, 477332, '2024-07-02 17:05:10', '2024-07-12 13:48:17'),
(6, 88, 300000, '2024-07-04 16:17:18', '2024-07-04 16:20:55');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `demobist_bist_data`
--
ALTER TABLE `demobist_bist_data`
  ADD PRIMARY KEY (`stock_id`);

--
-- Tablo için indeksler `demobist_stock_wallet`
--
ALTER TABLE `demobist_stock_wallet`
  ADD PRIMARY KEY (`wallet_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Tablo için indeksler `demobist_tokens`
--
ALTER TABLE `demobist_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_mail` (`user_mail`);

--
-- Tablo için indeksler `demobist_transaction_list`
--
ALTER TABLE `demobist_transaction_list`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Tablo için indeksler `demobist_users`
--
ALTER TABLE `demobist_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`);

--
-- Tablo için indeksler `demobist_wallet`
--
ALTER TABLE `demobist_wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `demobist_bist_data`
--
ALTER TABLE `demobist_bist_data`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Tablo için AUTO_INCREMENT değeri `demobist_stock_wallet`
--
ALTER TABLE `demobist_stock_wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `demobist_tokens`
--
ALTER TABLE `demobist_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `demobist_transaction_list`
--
ALTER TABLE `demobist_transaction_list`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `demobist_users`
--
ALTER TABLE `demobist_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Tablo için AUTO_INCREMENT değeri `demobist_wallet`
--
ALTER TABLE `demobist_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `demobist_stock_wallet`
--
ALTER TABLE `demobist_stock_wallet`
  ADD CONSTRAINT `demobist_stock_wallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `demobist_users` (`user_id`),
  ADD CONSTRAINT `demobist_stock_wallet_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `demobist_bist_data` (`stock_id`);

--
-- Tablo kısıtlamaları `demobist_tokens`
--
ALTER TABLE `demobist_tokens`
  ADD CONSTRAINT `demobist_tokens_ibfk_1` FOREIGN KEY (`user_mail`) REFERENCES `demobist_users` (`user_mail`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `demobist_transaction_list`
--
ALTER TABLE `demobist_transaction_list`
  ADD CONSTRAINT `demobist_transaction_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `demobist_users` (`user_id`),
  ADD CONSTRAINT `demobist_transaction_list_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `demobist_bist_data` (`stock_id`);

--
-- Tablo kısıtlamaları `demobist_wallet`
--
ALTER TABLE `demobist_wallet`
  ADD CONSTRAINT `demobist_wallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `demobist_users` (`user_id`),
  ADD CONSTRAINT `demobist_wallet_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `demobist_users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
