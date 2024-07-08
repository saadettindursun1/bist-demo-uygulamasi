-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 08 Tem 2024, 21:00:15
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
(53, 'ASTOR', '91', '-0,44'),
(54, 'BIMAS', '544', '-0,27'),
(55, 'ENJSA', '65,75', '-1,72'),
(56, 'KCHOL', '233,8', '-0,51'),
(57, 'KOZAL', '21,82', '5'),
(58, 'MAVI', '123,9', '-0,56'),
(59, 'SAHOL', '101,8', '-0,39'),
(60, 'SISE', '51,3', '0'),
(61, 'SOKM', '60,25', '-0,74'),
(62, 'THYAO', '310', '-0,32'),
(63, 'TOASO', '341,25', '-2,64'),
(64, 'TUPRS', '173', '-0,63'),
(65, 'YKBNK', '34,22', '-0,41');

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
  `stock_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `demobist_stock_wallet`
--

INSERT INTO `demobist_stock_wallet` (`wallet_id`, `user_id`, `stock_id`, `stock_quantity`, `total_amount`, `stock_status`, `created_at`, `updated_at`) VALUES
(1, 82, 61, 10, 500, 1, '2024-07-03 16:29:03', '2024-07-03 17:05:57'),
(2, 82, 56, 20, 4000, 1, '2024-07-03 16:29:21', '2024-07-03 17:06:18'),
(3, 88, 55, 55, 3641, 0, '2024-07-04 16:19:54', '2024-07-04 16:19:54'),
(4, 88, 57, 80, 1627, 0, '2024-07-04 16:19:54', '2024-07-04 16:19:54'),
(5, 88, 55, 55, 3641, 1, '2024-07-04 16:20:18', '2024-07-04 16:20:18'),
(6, 88, 57, 80, 1627, 1, '2024-07-04 16:20:18', '2024-07-04 16:20:18');

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
(3, 82, 500000, '2024-07-02 17:05:10', '2024-07-02 17:05:10'),
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
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `demobist_tokens`
--
ALTER TABLE `demobist_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Tablo kısıtlamaları `demobist_wallet`
--
ALTER TABLE `demobist_wallet`
  ADD CONSTRAINT `demobist_wallet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `demobist_users` (`user_id`),
  ADD CONSTRAINT `demobist_wallet_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `demobist_users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
