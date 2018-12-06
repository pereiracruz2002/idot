-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 06-Dez-2018 às 11:24
-- Versão do servidor: 10.3.11-MariaDB-1:10.3.11+maria~bionic-log
-- versão do PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letswork_app`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `last_login` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`admin_id`, `login`, `senha`, `last_login`) VALUES
(1, 'denis', '$2y$10$xM/wyQeR9R5Hp5hKsQbcHOsrDNOLCcsHMPBnnv9n74KJYfcSW.MN6', '2018-11-27 09:59:21'),
(2, 'tiago', '$2y$10$CpK0H95UDV/3jqFPGvRWFuxJl5mkR.pHINN20Njg4rGyM4GeEunfO', '2018-11-27 10:05:18'),
(3, 'cynthia', '$2y$10$lIw9x/sf2JrHecanXLqWo.RknaznQlZsxO/2ySBtIsb4iGJSTZGCu', '2018-08-28 15:35:19'),
(4, 'akao', '$2y$10$3L3V8p2rbI/ivQsofMzW/ecFfS3ts/YAw.tyBcWuMv8LIKYE2kCRW', NULL),
(6, 'flavio', '$2y$10$gvUe27njyCTKRxvtWNlqbOCRhI4aEp.HnbD.mpwVw4qNDjmy0/F0e', '2017-09-01 12:02:37'),
(8, 'kauan', '$2y$10$fUvaYCTzJjK1eetZSutnjuzcK36c1FtlxI4aRVfivnXTlBZQ1j7E2', '2018-12-06 10:56:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `index2` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
