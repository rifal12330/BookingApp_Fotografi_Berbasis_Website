-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 05:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `18web`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingform`
--

CREATE TABLE `bookingform` (
  `booking_id` int(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `paket` varchar(50) NOT NULL,
  `nomor` int(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `product_name` varchar(50) NOT NULL,
  `product_price` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`product_name`, `product_price`) VALUES
('bronze_companyprofile', 5000000),
('bronze_engagement', 5000000),
('bronze_prewedding', 5000000),
('bronze_wedding', 5000000),
('gold_companyprofile', 15000000),
('gold_engagement', 15000000),
('gold_prewedding', 15000000),
('gold_wedding', 15000000),
('silver_companyprofile', 10000000),
('silver_engagement', 10000000),
('silver_prewedding', 10000000),
('silver_wedding', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `email` varchar(25) NOT NULL,
  `ulasan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`email`, `ulasan`) VALUES
('', ''),
('rifalmuhamad12330@gmail.c', 'wahhh seruuu bangettt foto bareng kaka kakanya, ga kapok dehhh'),
('', ''),
('totochiboedaxbekasi@gmail', 'terbaikkk lahhh mantap betul suka sama hasilnyaaaa'),
('', ''),
('', ''),
('raditmugithea@gmail.com', 'aku imoet gaa difotonyaa?? gasabar pengen buru buru liat hasilnya '),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('tititberayun@gmail.com', 'leleleeee'),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('pitahuta@gmail.com', 'woww aku sangat senang bekerja bersama delapan belas '),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('raditiavscode@gmail.com', 'cawwwww gessss'),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', ''),
('', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
