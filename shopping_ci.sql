-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2017 at 07:16 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `ac_admin`
--

CREATE TABLE `ac_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `user_pic` text NOT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ac_admin`
--

INSERT INTO `ac_admin` (`id_admin`, `username`, `password`, `id_kota`, `alamat`, `user_pic`, `ip_address`, `user_agent`) VALUES
(1, 'administrator', '428b2172fca47620933071e63b2eea6b', 1, 'Sektor V', 'file_1504786312.PNG', '', ''),
(4, 'userio', 'e2565763b4c81f50b745f1e65fff0aa3', 3, '', 'file_1504784722.png', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:44.0) Gecko/20100101 Firefox/44.0');

-- --------------------------------------------------------

--
-- Table structure for table `ac_brand`
--

CREATE TABLE `ac_brand` (
  `id_brand` int(11) NOT NULL,
  `name_brand` varchar(10) NOT NULL,
  `slug_brand` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ac_brand`
--

INSERT INTO `ac_brand` (`id_brand`, `name_brand`, `slug_brand`) VALUES
(1, 'Samsung', 'samsung'),
(2, 'Lenovo', 'lenovo'),
(3, 'Xiaomi', 'xiaomi'),
(4, 'Others', 'others');

-- --------------------------------------------------------

--
-- Table structure for table `ac_captcha`
--

CREATE TABLE `ac_captcha` (
  `captcha_id` bigint(13) NOT NULL,
  `captcha_time` int(10) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ac_captcha`
--

INSERT INTO `ac_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(39, 1504788707, '::1', 'ErfTuand');

-- --------------------------------------------------------

--
-- Table structure for table `ac_product`
--

CREATE TABLE `ac_product` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(50) NOT NULL,
  `slug_product` text NOT NULL,
  `price_product` varchar(50) NOT NULL,
  `discount` int(3) NOT NULL,
  `after_price_discount` double NOT NULL,
  `quantity_product` int(5) NOT NULL,
  `picture_product` text NOT NULL,
  `description_product` text NOT NULL,
  `id_brand` int(2) NOT NULL,
  `dibeli` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ac_product`
--

INSERT INTO `ac_product` (`id_product`, `name_product`, `slug_product`, `price_product`, `discount`, `after_price_discount`, `quantity_product`, `picture_product`, `description_product`, `id_brand`, `dibeli`, `created_at`) VALUES
(1, 'Samsung S7', 'samsung-s7', '400000', 20, 320000, 7, 'file_1504712359.PNG', '<ol><li>Jaringan3G, HSPA, EDGE, 4G LTE</li><li>4G LTE Cat 4</li><li>SIMDual SIM, Nano SIM</li><li>Dimensi142.4 x 69.6 x 7.9 mm</li><li>Fitur1P68 ( tahan air )</li><li>LayarLayar 5.1 Super AMOLED capacitive</li><li>Resolusi 1440 x 2560 pixels</li><li>Kerapatan &nbsp;~577 ppi</li><li>2.5 D Gorilla Glass 4</li><li>Sistem OperasiOS Android v 6.0 Marshmallow</li><li>ChipsetChipset&nbsp;Exynos 8890</li><li>CPU Octa-core (4&times;2.3 GHz Mongoose &amp; 4&times;1.6 GHz Cortex-A53)</li><li>GPU Mali T880 MP12</li><li>MemoriRAM 4 GB</li><li>Memori Internal 32 /64 GB</li><li>Memori Eksternal up to 256 GB</li><li>KameraKamera Utama 12 MP, f/1.7, PD Autofocus, OIS, LED flash</li><li>Kamera Depan 5 MP</li><li>KonektifitasWIFI, 802 .11 a/ b/g/n/ac</li><li>WI-FI hotspot</li><li>Bluetooth v4.2 ,A2DP</li><li>GPS &ndash; A GPS</li><li>Micro USB v 2.0</li><li>USB OTG</li><li>SensorFingerprint</li><li>BateraiLi-Ion 3000 mAh</li><li>Non-Removable</li><li>Fast Charging</li></ol>', 1, 11, '2017-09-06 23:42:22'),
(7, 'Samsung S6', 'samsung-s6', '2000', 20, 1600, 1, 'file_1504714423.png', '<ol><li>Jaringan3G, HSPA, EDGE, 4G LTE</li><li>4G LTE Cat 4</li><li>SIMDual SIM, Nano SIM</li><li>Dimensi142.4 x 69.6 x 7.9 mm</li><li>Fitur1P68 ( tahan air )</li><li>LayarLayar 5.1 Super AMOLED capacitive</li><li>Resolusi 1440 x 2560 pixels</li><li>Kerapatan &nbsp;~577 ppi</li><li>2.5 D Gorilla Glass 4</li><li>Sistem OperasiOS Android v 6.0 Marshmallow</li><li>ChipsetChipset&nbsp;Exynos 8890</li><li>CPU Octa-core (4&times;2.3 GHz Mongoose &amp; 4&times;1.6 GHz Cortex-A53)</li><li>GPU Mali T880 MP12</li><li>MemoriRAM 4 GB</li><li>Memori Internal 32 /64 GB</li><li>Memori Eksternal up to 256 GB</li><li>KameraKamera Utama 12 MP, f/1.7, PD Autofocus, OIS, LED flash</li><li>Kamera Depan 5 MP</li><li>KonektifitasWIFI, 802 .11 a/ b/g/n/ac</li><li>WI-FI hotspot</li><li>Bluetooth v4.2 ,A2DP</li><li>GPS &ndash; A GPS</li><li>Micro USB v 2.0</li><li>USB OTG</li><li>SensorFingerprint</li><li>BateraiLi-Ion 3000 mAh</li><li>Non-Removable</li><li>Fast Charging</li></ol>', 1, 0, '2017-09-07 19:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `ac_shipping`
--

CREATE TABLE `ac_shipping` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(20) NOT NULL,
  `ongkos_kirim` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ac_shipping`
--

INSERT INTO `ac_shipping` (`id_kota`, `nama_kota`, `ongkos_kirim`) VALUES
(1, 'Bekasi', 9000),
(2, 'Jakarta', 3000),
(3, 'Tanggerang', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(16) NOT NULL,
  `data` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `date_confirm` datetime NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` varchar(12) NOT NULL,
  `totalbayar` int(20) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `data`, `due_date`, `date_confirm`, `user_id`, `status`, `totalbayar`, `id_kota`, `alamat`) VALUES
(33, '2017-06-13 02:11:04', '2017-06-14 02:11:04', '2017-06-29 00:00:00', 1, 'paid', 329000, 1, 'Bekasi'),
(34, '2017-06-13 02:11:40', '2017-06-14 02:11:40', '2017-06-28 00:00:00', 1, 'expired', 117000, 1, 'pup'),
(35, '2017-07-25 22:48:13', '2017-07-26 22:48:13', '2017-07-25 22:55:39', 1, 'paid', 428300, 1, 'Sektor V'),
(36, '2017-08-15 11:26:17', '2017-08-16 11:26:17', '0000-00-00 00:00:00', 1, 'unpaid', 329000, 1, 'Sektor V'),
(37, '2017-09-07 19:26:41', '2017-09-08 19:26:41', '0000-00-00 00:00:00', 1, 'unpaid', 329000, 1, ''),
(38, '2017-09-07 19:29:45', '2017-09-08 19:29:45', '0000-00-00 00:00:00', 1, 'unpaid', 329000, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(16) NOT NULL,
  `invoice_id` int(16) NOT NULL,
  `product_id` int(16) NOT NULL,
  `product_type` varchar(60) NOT NULL,
  `qty` int(3) NOT NULL,
  `price` int(9) NOT NULL,
  `options` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_id`, `product_id`, `product_type`, `qty`, `price`, `options`) VALUES
(10, 33, 1, 'Samsung S7', 1, 320000, ''),
(11, 34, 2, 'Lenovo A7010', 1, 108000, ''),
(12, 35, 3, 'Samsung S6', 1, 310400, ''),
(13, 35, 5, 'Xiaomi M3', 1, 108900, ''),
(14, 36, 1, 'Samsung S7', 1, 320000, ''),
(15, 37, 1, 'Samsung S7', 1, 320000, ''),
(16, 38, 1, 'Samsung S7', 1, 320000, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ac_admin`
--
ALTER TABLE `ac_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ac_brand`
--
ALTER TABLE `ac_brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `ac_captcha`
--
ALTER TABLE `ac_captcha`
  ADD PRIMARY KEY (`captcha_id`);

--
-- Indexes for table `ac_product`
--
ALTER TABLE `ac_product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `ac_shipping`
--
ALTER TABLE `ac_shipping`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ac_admin`
--
ALTER TABLE `ac_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ac_brand`
--
ALTER TABLE `ac_brand`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ac_captcha`
--
ALTER TABLE `ac_captcha`
  MODIFY `captcha_id` bigint(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `ac_product`
--
ALTER TABLE `ac_product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ac_shipping`
--
ALTER TABLE `ac_shipping`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
