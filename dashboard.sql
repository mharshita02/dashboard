-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 26, 2025 at 08:40 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved_coogs_data`
--

CREATE TABLE `approved_coogs_data` (
  `ASIN` varchar(100) NOT NULL,
  `Gross Ship GMS` decimal(65,0) NOT NULL,
  `Net Ship GMS` decimal(65,0) NOT NULL,
  `Order Date` date NOT NULL,
  `Net Ship Units` int(100) NOT NULL,
  `Duration` varchar(100) NOT NULL,
  `Net/Net` decimal(65,0) NOT NULL,
  `Net Served` decimal(65,0) NOT NULL,
  `COOP` int(65) NOT NULL,
  `Final COOP` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coogs_data`
--

CREATE TABLE `coogs_data` (
  `Invoice ID` int(65) NOT NULL,
  `Invoice date` date NOT NULL,
  `Agreement ID` int(65) NOT NULL,
  `Agreement title` varchar(65) NOT NULL,
  `Funding Type` varchar(65) NOT NULL,
  `Original balance` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `df_invoice_data`
--

CREATE TABLE `df_invoice_data` (
  `Date` date NOT NULL,
  `Sale Order Number` varchar(100) NOT NULL,
  `Invoice number` varchar(100) NOT NULL,
  `Channel entry` varchar(100) NOT NULL,
  `Product Name` varchar(100) NOT NULL,
  `Product SKU Code` varchar(100) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Unit Price` decimal(10,0) NOT NULL,
  `Currency` varchar(100) NOT NULL,
  `Total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `po_invoice_data`
--

CREATE TABLE `po_invoice_data` (
  `Date` date NOT NULL,
  `Sale Order Number` varchar(100) NOT NULL,
  `Invoice number` varchar(100) NOT NULL,
  `Channel entry` decimal(65,0) NOT NULL,
  `Product Name` varchar(100) NOT NULL,
  `Product SKU Code` int(100) NOT NULL,
  `Qty` int(100) NOT NULL,
  `Unit Price` decimal(65,0) NOT NULL,
  `Currency` varchar(100) NOT NULL,
  `Total` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `remittance_data`
--

CREATE TABLE `remittance_data` (
  `Payment Number` int(100) NOT NULL,
  `Invoice Number` varchar(65) NOT NULL,
  `Invoice Date` date NOT NULL,
  `Transaction type` varchar(65) NOT NULL,
  `Transaction Description` varchar(65) NOT NULL,
  `Invoice Amount` decimal(65,0) NOT NULL,
  `Amount Paid` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `return_data`
--

CREATE TABLE `return_data` (
  `Return date` date NOT NULL,
  `Shipment Request ID` varchar(65) NOT NULL,
  `Return ID` varchar(65) NOT NULL,
  `Marketplace` varchar(65) NOT NULL,
  `Authorization ID` varchar(65) NOT NULL,
  `Vendor code` varchar(65) NOT NULL,
  `Invoice number` int(65) NOT NULL,
  `Warehouse` varchar(65) NOT NULL,
  `Total cost` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
