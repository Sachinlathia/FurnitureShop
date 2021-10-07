-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 07:23 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grujovic`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `prod_images` text NOT NULL,
  `prod_proizID` int(100) NOT NULL,
  `cena` float NOT NULL,
  `kolicina` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `opis` varchar(500) DEFAULT NULL,
  `tip` varchar(25) NOT NULL,
  `kategorija` varchar(50) NOT NULL,
  `cr_proizvod` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `prod_images`, `prod_proizID`, `cena`, `kolicina`, `naziv`, `opis`, `tip`, `kategorija`, `cr_proizvod`) VALUES
(1, 'stolica.jpg', 4, 250, 10, 'Stolica', 'Stoca', 'New', 'Stolice', '2021-06-30 13:21:53'),
(4, 'Proizvod1.png', 4, 350, 10, 'Krevet Aron', 'Krevet', 'Regular', 'Kreveti', '2021-06-30 12:37:41'),
(5, 'ugaona-marsej.jpg', 4, 5000, 2, 'Marsej', 'Garnitura ugaona', 'Popular', 'Garniture', '2021-06-30 10:18:26'),
(6, 'Claudia stolica.jpg', 4, 1000, 10, 'Claudia Stolica', 'Testirano za: \n110 kg\nŠirina: \n60 cm\nDubina: \n67 cm\nVisina: \n96 cm\nŠirina sedišta: \n42 cm\nDubina sedišta: \n47 cm\nVisina sedišta: \n52 cm', 'Popular', 'Stolice', '2021-07-01 15:21:35'),
(7, 'Forma stolica.jpg', 4, 1299, 10, 'Forma Stolica', 'Testirano za: \r\n110 kg\r\nŠirina: \r\n48 cm\r\nDubina: \r\n50 cm\r\nVisina: \r\n96 cm\r\nŠirina sedišta: \r\n48 cm\r\nDubina sedišta: \r\n37 cm\r\nVisina sedišta: \r\n47 cm', 'New', 'Stolice', '2021-07-01 15:22:54'),
(8, 'RadStolica.jpg', 4, 999, 5, 'Rad Stolica', 'Testirano za: \r\n110 kg\r\nŠirina: \r\n48 cm\r\nDubina: \r\n50 cm\r\nVisina: \r\n96 cm\r\nŠirina sedišta: \r\n48 cm\r\nDubina sedišta: \r\n37 cm\r\nVisina sedišta: \r\n47 cm', 'Regular', 'Stolice', '2021-07-01 15:23:32'),
(9, 'royal stolica.jpg', 4, 1500, 15, 'Royal Stolica', 'Testirano za: \r\n110 kg\r\nŠirina: \r\n48 cm\r\nDubina: \r\n50 cm\r\nVisina: \r\n96 cm\r\nŠirina sedišta: \r\n48 cm\r\nDubina sedišta: \r\n37 cm\r\nVisina sedišta: \r\n47 cm', 'Popular', 'Stolice', '2021-07-01 15:24:13'),
(10, 'OVIEDO TROSED.jpg', 12, 15000, 5, 'Oviedo Trosed', 'Širina: \r\n228 cm\r\nDubina: \r\n95 cm\r\nVisina: \r\n83 cm\r\nŠirina sedišta: \r\n180 cm\r\nDubina sedišta: \r\n60 cm\r\nVisina sedišta: \r\n45 cm', 'Popular', 'Garniture', '2021-07-01 15:25:54'),
(11, 'Spring trosed.jpg', 12, 39000, 2, 'Spring Trosed', 'Širina: \r\n228 cm\r\nDubina: \r\n95 cm\r\nVisina: \r\n83 cm\r\nŠirina sedišta: \r\n180 cm\r\nDubina sedišta: \r\n60 cm\r\nVisina sedišta: \r\n45 cm', 'New', 'Garniture', '2021-07-01 15:26:38'),
(12, 'Italia trosed.jpg', 12, 39999, 1, 'Italia trosed', 'Širina: \r\n228 cm\r\nDubina: \r\n95 cm\r\nVisina: \r\n83 cm\r\nŠirina sedišta: \r\n180 cm\r\nDubina sedišta: \r\n60 cm\r\nVisina sedišta: \r\n45 cm', 'Regular', 'Garniture', '2021-07-01 15:27:11'),
(13, 'Damhale trosed.jpg', 4, 12000, 7, 'Damhele Trosed', 'Širina: \r\n228 cm\r\nDubina: \r\n95 cm\r\nVisina: \r\n83 cm\r\nŠirina sedišta: \r\n180 cm\r\nDubina sedišta: \r\n60 cm\r\nVisina sedišta: \r\n45 cm', 'Regular', 'Garniture', '2021-07-01 15:27:41'),
(14, 'SardiniaKrevet.jpg', 4, 20120, 4, 'Sardinia Krevet', 'Dužina: \r\n208 cm\r\nŠirina: \r\n167 cm\r\nVisina uznožja: \r\n43 cm\r\nVisina uzglavlja: \r\n77 cm\r\nDužina dušeka: \r\n200 cm\r\nŠirina dušeka: \r\n160 cm', 'Popular', 'Kreveti', '2021-07-01 15:29:06'),
(15, 'KanKrevet.jpg', 12, 56000, 5, 'Kan Krevet', 'Dužina: \r\n208 cm\r\nŠirina: \r\n167 cm\r\nVisina uznožja: \r\n43 cm\r\nVisina uzglavlja: \r\n77 cm\r\nDužina dušeka: \r\n200 cm\r\nŠirina dušeka: \r\n160 cm', 'New', 'Kreveti', '2021-07-01 15:29:39'),
(17, 'FormaKrevet.jpg', 4, 10000, 4, 'Forma Krevet', 'Dužina: \r\n208 cm\r\nŠirina: \r\n167 cm\r\nVisina uznožja: \r\n43 cm\r\nVisina uzglavlja: \r\n77 cm\r\nDužina dušeka: \r\n200 cm\r\nŠirina dušeka: \r\n160 cm', 'Regular', 'Kreveti', '2021-07-01 15:31:03'),
(18, 'BonKrevet.jpg', 12, 25000, 2, 'Bon Krevet', 'Dužina: \r\n208 cm\r\nŠirina: \r\n167 cm\r\nVisina uznožja: \r\n43 cm\r\nVisina uzglavlja: \r\n77 cm\r\nDužina dušeka: \r\n200 cm\r\nŠirina dušeka: \r\n160 cm', 'Regular', 'Kreveti', '2021-07-01 15:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodjaci`
--

CREATE TABLE `proizvodjaci` (
  `ID` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `cr_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proizvodjaci`
--

INSERT INTO `proizvodjaci` (`ID`, `naziv`, `cr_date`) VALUES
(4, 'Dalas', '2021-06-02 16:38:56'),
(12, 'Numanovic', '2021-06-27 12:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(10) NOT NULL,
  `error_count` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created`, `role`, `error_count`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '2021-07-01 16:52:45', 'admin', 0),
(2, 'Nikola', 'nikola@gmail.com', '12345', '2021-06-24 19:53:41', 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `proizvodjaci`
--
ALTER TABLE `proizvodjaci`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `proizvodjaci`
--
ALTER TABLE `proizvodjaci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
