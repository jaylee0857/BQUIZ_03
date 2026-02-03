-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2026-02-03 02:49:02
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db03_1`
--

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `level` int(1) NOT NULL,
  `long_time` int(10) NOT NULL,
  `date` date NOT NULL,
  `pub` text NOT NULL,
  `dir` text NOT NULL,
  `pre` text NOT NULL,
  `poster` text NOT NULL,
  `rank` int(10) NOT NULL,
  `sh` int(1) NOT NULL,
  `intro` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `movie`
--

INSERT INTO `movie` (`id`, `name`, `level`, `long_time`, `date`, `pub`, `dir`, `pre`, `poster`, `rank`, `sh`, `intro`) VALUES
(2, '院線片02', 3, 105, '2026-01-30', '院線片02的發行商', '院線片02的導演', '03B02v.mp4', '03B02.png', 2, 1, '  院線片02的劇情簡介'),
(3, '院線片03', 4, 100, '2026-01-30', '院線片03的發行商', '院線片03的導演', '03B03v.mp4', '03B03.png', 3, 1, '      院線片03的劇情劇情劇情劇情劇情'),
(5, '院線片04', 4, 101, '2026-01-30', '院線片04', '院線片04', '03B04v.mp4', '03B04.png', 4, 1, '         院線片04'),
(6, '院線片05', 1, 200, '2026-01-30', '院線片05', '院線片05', '03B05v.mp4', '03B05.png', 5, 1, '   院線片05'),
(7, '院線片06', 1, 100, '2026-01-22', '院線片06', '院線片06', '03B06v.mp4', '03B06.png', 6, 1, '    院線片06'),
(8, '院線片07', 1, 0, '2026-01-01', '院線片07', '院線片07', '03B07v.mp4', '03B07.png', 7, 1, '院線片07');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `no` text NOT NULL,
  `movie` text NOT NULL,
  `date` date NOT NULL,
  `session` text NOT NULL,
  `qt` int(10) NOT NULL,
  `seats` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `no`, `movie`, `date`, `session`, `qt`, `seats`) VALUES
(2, '202601260002', '院線片01', '2026-01-28', '18:00 ~ 20:00', 4, '5,6,7,8'),
(3, '202601260003', '院線片01', '2026-01-26', '16:00 ~ 18:00', 4, '0,1,2,3'),
(6, '202601300004', '院線片02', '2026-01-30', '14:00 ~ 16:00', 1, '0'),
(7, '202601300007', '院線片02', '2026-01-30', '14:00 ~ 16:00', 1, '0'),
(8, '202601300008', '院線片02', '2026-01-30', '14:00 ~ 16:00', 1, '0'),
(9, '202601300009', '院線片02', '2026-01-30', '14:00 ~ 16:00', 1, '0'),
(10, '202601300010', '院線片02', '2026-01-30', '14:00 ~ 16:00', 4, '0,1,2,3'),
(11, '202601300011', '院線片02', '2026-01-30', '14:00 ~ 16:00', 1, '0');

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `rank` int(10) UNSIGNED NOT NULL,
  `sh` int(1) UNSIGNED NOT NULL,
  `ani` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `poster`
--

INSERT INTO `poster` (`id`, `name`, `img`, `rank`, `sh`, `ani`) VALUES
(1, '預告片01', '03A01.jpg', 1, 1, 1),
(2, '預告片02', '03A02.jpg', 2, 1, 2),
(3, '預告片03', '03A03.jpg', 3, 1, 3),
(4, '預告片04', '03A04.jpg', 4, 1, 1),
(5, '預告片05', '03A05.jpg', 5, 1, 2),
(6, '預告片06', '03A06.jpg', 6, 1, 3),
(7, '預告片07', '03A07.jpg', 7, 1, 1),
(8, '預告片08', '03A08.jpg', 8, 1, 2),
(9, '預告片09', '03A09.jpg', 9, 1, 3);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
