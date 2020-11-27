-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2018 at 09:49 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `country_insert` (IN `cname` VARCHAR(50))  BEGIN
INSERT INTO country set name = cname;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `addiagnostic`
--

CREATE TABLE `addiagnostic` (
  `admissionid` int(10) UNSIGNED NOT NULL,
  `diagnosticid` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addiagnostic`
--

INSERT INTO `addiagnostic` (`admissionid`, `diagnosticid`) VALUES
(6, 2),
(7, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `admedicine`
--

CREATE TABLE `admedicine` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL,
  `admissionid` int(10) UNSIGNED NOT NULL,
  `medicineid` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admedicine`
--

INSERT INTO `admedicine` (`id`, `quantity`, `admissionid`, `medicineid`) VALUES
(4, 53, 8, 2),
(5, 12, 7, 3),
(6, 10, 7, 4),
(13, 1, 6, 4),
(14, 1, 6, 3),
(15, 3, 6, 4),
(16, 2, 6, 3),
(17, 4, 6, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `admfees`
-- (See below for the actual view)
--
CREATE TABLE `admfees` (
`total` double(19,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `id` int(10) UNSIGNED NOT NULL,
  `admissiondate` datetime NOT NULL,
  `releasedate` datetime NOT NULL,
  `admissionfees` double(7,2) UNSIGNED NOT NULL,
  `relativecontact` varchar(16) NOT NULL,
  `disease` varchar(100) NOT NULL,
  `patientid` int(10) UNSIGNED NOT NULL,
  `doctorid` smallint(5) UNSIGNED NOT NULL,
  `seatid` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`id`, `admissiondate`, `releasedate`, `admissionfees`, `relativecontact`, `disease`, `patientid`, `doctorid`, `seatid`) VALUES
(6, '2018-05-16 10:00:00', '2018-05-19 23:39:13', 5000.00, '453456456', 'fever', 62, 3, 6),
(7, '2018-05-14 00:00:00', '2018-05-19 23:40:41', 100000.00, '12312321', 'xdfgfgfhh', 59, 3, 1),
(8, '2018-05-16 00:00:00', '2018-05-17 00:00:00', 754.00, '02156496', 'fever', 63, 2, 7),
(10, '2018-05-15 00:00:00', '1970-01-01 00:00:00', 4544.00, '564646', 'fdgfdg', 60, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `ambulance`
--

CREATE TABLE `ambulance` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `contactnumber` varchar(14) NOT NULL,
  `fees` float(7,2) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `distance` smallint(5) UNSIGNED NOT NULL,
  `minimumfees` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ambulance`
--

INSERT INTO `ambulance` (`id`, `contactnumber`, `fees`, `type`, `distance`, `minimumfees`) VALUES
(1, '636+4', 2500.00, 0, 0, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `ambulencecharge`
--

CREATE TABLE `ambulencecharge` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `amount` double(8,3) UNSIGNED NOT NULL,
  `contact` varchar(16) NOT NULL,
  `ambulanceid` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apointment`
--

CREATE TABLE `apointment` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `slot` smallint(5) UNSIGNED NOT NULL,
  `ap_date` date DEFAULT NULL,
  `patientid` int(10) UNSIGNED NOT NULL,
  `doctorid` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apointment`
--

INSERT INTO `apointment` (`id`, `slot`, `ap_date`, `patientid`, `doctorid`) VALUES
(1, 0, '2018-05-17', 45, 2),
(2, 100, '2018-05-17', 62, 2),
(3, 140, '2018-05-17', 60, 2),
(4, 7, '2018-05-17', 62, 2),
(7, 20, '2018-05-17', 46, 2),
(8, 20, '2018-05-17', 46, 2),
(9, 40, '2018-05-19', 46, 2);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `countryid` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `countryid`) VALUES
(1, 'kabulll', 1),
(2, 'Dhaka', 18),
(5, 'Khulna', 18),
(6, 'Madaripur', 18),
(7, 'Rajshahi', 18),
(8, 'Panjab', 20),
(9, 'Mumbai', 20),
(12, 'Laxmipur', 18),
(14, 'a', 18);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(2, 'beximco'),
(1, 'squre');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(18, 'BD', 'Bangladesh'),
(20, '', 'India'),
(21, '', 'Pakistan'),
(22, '', 'USA'),
(23, '', 'Canada'),
(24, '', 'UK'),
(25, '', 'Australia'),
(26, '', 'Brazil'),
(27, '', 'aaaaa'),
(29, '', 'aaaaaaaaaaaaaaaaaaaa'),
(30, '', 'aa'),
(31, '', 'mmmmmmmmmm'),
(32, '', 'aaaaaaaa'),
(33, '', 'aaaaaaaaaaa'),
(34, '', 'a'),
(37, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`) VALUES
(1, 'Basir Uddin Hridoy'),
(2, 'Uzzol Talukder'),
(4, 'Tarique Hasan');

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`id`, `name`) VALUES
(6, 'DGO'),
(15, 'DSH'),
(8, 'FACC'),
(11, 'FACP'),
(7, 'FCCP'),
(2, 'FCPS'),
(9, 'FESC'),
(14, 'FICS'),
(10, 'FRCP'),
(3, 'FRCS'),
(12, 'FSGC'),
(1, 'MBBS'),
(16, 'MRCS'),
(5, 'PGT');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Cardiology'),
(3, 'Urology'),
(4, 'Skin / Dermatology'),
(5, 'Heamatology'),
(6, 'Medicine'),
(7, 'Chest Medicine'),
(8, 'Oncology'),
(9, 'Neurology'),
(10, 'Nephrology / Kidney Medicine'),
(11, 'Diabetologist'),
(12, 'General Surgery'),
(13, 'Neurosurgery'),
(14, 'Gynaecology'),
(15, 'Pain Management'),
(16, 'ENT, Head &amp; Neck Surgery'),
(17, 'Urology Surgery'),
(18, 'Orthopaedic Surgery'),
(19, 'Physiotherapy Department');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `name`) VALUES
(9, 'Assistant Professor'),
(8, 'Associate professor'),
(7, 'professor');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic`
--

CREATE TABLE `diagnostic` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `amount` double(8,2) UNSIGNED NOT NULL,
  `discount` double(4,2) UNSIGNED NOT NULL,
  `doctorid` smallint(5) UNSIGNED NOT NULL,
  `dr_com` float(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnostic`
--

INSERT INTO `diagnostic` (`id`, `name`, `date`, `amount`, `discount`, `doctorid`, `dr_com`) VALUES
(2, 'Blood group test', '2018-05-07 00:00:00', 150.00, 10.00, 8, 0.00),
(3, 'ECG', '2018-05-03 00:00:00', 3000.00, 10.00, 3, 0.00),
(4, 'Urine R/M/E &amp; CS', '0000-00-00 00:00:00', 300.00, 0.00, 7, 0.00),
(5, 'CBC, S,PSA', '0000-00-00 00:00:00', 350.00, 0.00, 5, 0.00),
(6, 'Creatinine, Urea', '0000-00-00 00:00:00', 400.00, 0.00, 3, 0.00),
(7, 'RBS/FBS/2HABF', '0000-00-00 00:00:00', 250.00, 0.00, 8, 0.00),
(8, 'USG of KUB and Prostate and MCC PVR', '0000-00-00 00:00:00', 1000.00, 0.00, 6, 0.00),
(9, 'X-ray KUB/CXR', '0000-00-00 00:00:00', 600.00, 0.00, 3, 0.00),
(10, 'Endoscopy', '0000-00-00 00:00:00', 2000.00, 0.00, 2, 0.00),
(11, 'Echo-Cardiogram', '0000-00-00 00:00:00', 1500.00, 0.00, 5, 0.00),
(12, 'Ultrasonogram', '0000-00-00 00:00:00', 1000.00, 0.00, 2, 0.00),
(13, 'Medical Check-up', '0000-00-00 00:00:00', 6000.00, 0.00, 2, 0.00),
(14, 'Spiral C.T. scan', '0000-00-00 00:00:00', 5000.00, 0.00, 8, 0.00),
(15, 'Dental OPG', '0000-00-00 00:00:00', 1500.00, 0.00, 6, 0.00),
(16, 'MRI', '0000-00-00 00:00:00', 12000.00, 0.00, 8, 0.00),
(17, 'Digital X-ray', '0000-00-00 00:00:00', 600.00, 0.00, 2, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` smallint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `fees` float(7,3) NOT NULL,
  `contact` varchar(14) NOT NULL,
  `picture` varchar(4) NOT NULL,
  `institute` varchar(100) DEFAULT NULL,
  `designationid` tinyint(3) UNSIGNED NOT NULL,
  `departmentid` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `email`, `password`, `fees`, `contact`, `picture`, `institute`, `designationid`, `departmentid`, `status`) VALUES
(2, 'Dr. MR khan', 'mr@gmail.com', '', 1200.000, '01820937110', 'jpg', 'Dhaka medical college hospital', 8, 1, 2),
(3, 'Dr. Rifat Hossain', 'r@gmail.com', '', 1000.000, '01820937110', 'jpg', 'Dhaka central medical college hospital', 9, 1, 2),
(5, 'Dr. Azad Hossain', 'a@gmail.com', '123', 800.000, '01820937110', 'jpg', 'Dhaka medical college hospital', 8, 1, 1),
(6, 'Dr. Abul Kalam', 'ak@gmail.com', '123', 1000.000, '01820937110', 'jpg', 'Bangubandhu Sheikh Mujib Medical University', 8, 9, 1),
(7, 'Dr. Poly Akter', 'p@gmail.com', '123', 1000.000, '01820937110', 'jpg', 'Bangubandhu Sheikh Mujib Medical University', 7, 14, 0),
(8, 'Dr. Uzzol Talukder', 'u@gmail.com', '123', 1000.000, '01820937110', 'jpg', 'Dhaka medical college hospital', 8, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctordegree`
--

CREATE TABLE `doctordegree` (
  `doctorid` smallint(5) UNSIGNED NOT NULL,
  `degreesid` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctordegree`
--

INSERT INTO `doctordegree` (`doctorid`, `degreesid`) VALUES
(5, 2),
(5, 3),
(5, 1),
(6, 2),
(6, 3),
(6, 1),
(7, 10),
(7, 3),
(7, 1),
(8, 10),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorserial`
--

CREATE TABLE `doctorserial` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL,
  `patientid` int(10) UNSIGNED NOT NULL,
  `doctorid` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecialist`
--

CREATE TABLE `doctorspecialist` (
  `doctorid` smallint(5) UNSIGNED NOT NULL,
  `specialistid` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorspecialist`
--

INSERT INTO `doctorspecialist` (`doctorid`, `specialistid`) VALUES
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 3),
(8, 1),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `salary` float(8,3) NOT NULL,
  `contact` varchar(14) NOT NULL,
  `type` varchar(20) NOT NULL,
  `joiningdata` date NOT NULL,
  `picture` varchar(4) NOT NULL,
  `designationid` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `password`, `salary`, `contact`, `type`, `joiningdata`, `picture`, `designationid`, `status`) VALUES
(1, 'Tarique', '', '', 0.000, '', '', '0000-00-00', '', 7, 0),
(3, 'Uzzol Talukder', 'u@gmail.com', '202cb962ac59075b964b07152d234b70', 12000.000, '01820937110', '2', '2018-05-18', 'jpg', 8, 0),
(4, 'Mohasin Hossain', 'mh030213@gmail.com', '202cb962ac59075b964b07152d234b70', 100000.000, '01820937110', '3', '2018-05-18', 'jpg', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(25) NOT NULL,
  `amount` double(10,2) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `title`, `amount`, `date`) VALUES
(3, 'Laptop', 120000.00, '2018-02-01'),
(4, 'Decorations', 450000.00, '2017-12-31'),
(5, 'Equepments', 5000000.00, '2018-01-05'),
(6, 'computer', 500000.00, '2018-01-10'),
(7, 'Others', 100000.00, '2018-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `generic`
--

CREATE TABLE `generic` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generic`
--

INSERT INTO `generic` (`id`, `name`) VALUES
(11, 'Loratidin'),
(10, 'Metronidazol'),
(5, 'Neproxen'),
(13, 'Pentroprazol');

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `amount` double(8,2) UNSIGNED NOT NULL,
  `admissionid` int(10) UNSIGNED NOT NULL,
  `paymentid` tinyint(3) UNSIGNED NOT NULL,
  `employeeid` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`id`, `date`, `amount`, `admissionid`, `paymentid`, `employeeid`) VALUES
(1, '1970-01-01 00:00:00', 564.00, 8, 1, 1),
(2, '2018-05-16 00:00:00', 5000.00, 6, 1, 3),
(3, '2018-05-18 03:00:00', 3000.00, 6, 1, 1),
(4, '2018-05-20 00:00:00', 3930.00, 6, 1, 2),
(5, '2018-05-19 00:00:00', 109560.00, 7, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` double(8,2) UNSIGNED NOT NULL,
  `purchaseprice` double(8,2) UNSIGNED NOT NULL,
  `stock` smallint(200) NOT NULL,
  `genericid` smallint(5) UNSIGNED NOT NULL,
  `companyid` smallint(5) UNSIGNED NOT NULL,
  `picture1` varchar(4) NOT NULL,
  `picture2` varchar(4) NOT NULL,
  `picture3` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `price`, `purchaseprice`, `stock`, `genericid`, `companyid`, `picture1`, `picture2`, `picture3`) VALUES
(2, 'seclo', 50.00, 0.00, 0, 5, 2, '', '', ''),
(3, 'beklo', 80.00, 0.00, 0, 10, 1, '', '', ''),
(4, 'napa', 10.00, 0.00, 0, 10, 1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `outdoor`
--

CREATE TABLE `outdoor` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `amount` double(8,3) UNSIGNED NOT NULL,
  `disease` varchar(100) NOT NULL,
  `patientid` int(10) UNSIGNED NOT NULL,
  `doctorid` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `outdoordiagnostic`
--

CREATE TABLE `outdoordiagnostic` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `amount` double(8,2) UNSIGNED NOT NULL,
  `diagnosticid` tinyint(3) UNSIGNED NOT NULL,
  `patientid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outdoordiagnostic`
--

INSERT INTO `outdoordiagnostic` (`id`, `amount`, `diagnosticid`, `patientid`) VALUES
(1, 500.00, 12, 58),
(3, 12000.00, 16, 58);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gender` tinyint(3) UNSIGNED NOT NULL,
  `age` tinyint(3) UNSIGNED NOT NULL,
  `contact` varchar(16) NOT NULL,
  `maritalstatus` varchar(20) NOT NULL,
  `picture` varchar(4) NOT NULL,
  `cityid` smallint(5) UNSIGNED NOT NULL,
  `country` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `code` varchar(5) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `email`, `password`, `address`, `gender`, `age`, `contact`, `maritalstatus`, `picture`, `cityid`, `country`, `date`, `status`, `type`, `code`, `time`) VALUES
(45, 'mohasin', 'e@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dhaka', 0, 0, '', '', 'jpg', 1, 0, '0000-00-00', '', 2, '', ''),
(46, 'mohasin', 'a@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dhaka', 0, 0, '', '', 'jpg', 1, 0, '0000-00-00', '', 3, NULL, NULL),
(56, 'mohasin', 'c@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dhaka', 0, 0, '', '', 'jpg', 1, 0, '0000-00-00', '', 1, NULL, NULL),
(57, 'mohasin', 'b@gmail.com', '6de54cc8c5070245d1003e136f311159', 'dhaka', 0, 0, '', '', 'jpg', 1, 0, '0000-00-00', '', 1, '', ''),
(58, 'mohasin', 's@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dhaka', 0, 0, '', '', 'jpg', 1, 0, '0000-00-00', '', 1, '', ''),
(59, 'mohasin', 'p@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dhaka', 0, 0, '', '', 'jpg', 1, 0, '0000-00-00', '', 1, NULL, NULL),
(60, 'mh', 'k@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'aaaaaaaaaa', 0, 0, '', '', 'jpg', 2, 0, '0000-00-00', '', 1, '', ''),
(61, 'a', 'l@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 's', 0, 0, '', '', 'jpg', 2, 0, '0000-00-00', '', 1, '', ''),
(62, 'abc', 'lm@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'llll', 1, 0, '123', '1', 'jpg', 5, 0, '0000-00-00', '', 1, '', ''),
(63, 'mohasin', 'mm@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'dhaka', 1, 0, '123', '1', 'jpg', 2, 0, '0000-00-00', '', 1, '82698', '1521398228'),
(64, '', 'admin@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, 0, '', '', 'jpg', 0, 0, '0000-00-00', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`) VALUES
(1, 'bkas'),
(2, 'paypal');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `amount` double(8,2) UNSIGNED NOT NULL,
  `others` varchar(200) NOT NULL,
  `employeeid` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `discount` double(4,2) UNSIGNED NOT NULL,
  `employeeid` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesdetails`
--

CREATE TABLE `salesdetails` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL,
  `medicineid` smallint(5) UNSIGNED NOT NULL,
  `salesid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `amount` double(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id`, `name`, `amount`) VALUES
(1, 'R105', 100.00),
(2, 'K303', 100.00),
(5, 'R109', 100.00),
(6, 'K313', 100.00),
(7, 'R209', 100.00),
(8, 'K333', 100.00),
(9, 'k100', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `specialist`
--

CREATE TABLE `specialist` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialist`
--

INSERT INTO `specialist` (`id`, `name`) VALUES
(3, 'Gynae'),
(1, 'Head'),
(2, 'Neck'),
(4, 'Nose');

-- --------------------------------------------------------

--
-- Table structure for table `visitingdays`
--

CREATE TABLE `visitingdays` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `doctorid` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitingdays`
--

INSERT INTO `visitingdays` (`id`, `name`, `starttime`, `endtime`, `doctorid`) VALUES
(1, 'Thu', '16:00:00', '20:00:00', 2),
(2, 'Thu', '18:00:00', '20:00:00', 3);

-- --------------------------------------------------------

--
-- Structure for view `admfees`
--
DROP TABLE IF EXISTS `admfees`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `admfees`  AS  select sum((`admedicine`.`quantity` * `medicine`.`price`)) AS `total` from ((`admedicine` join `medicine`) join `admission`) where ((`admedicine`.`medicineid` = `medicine`.`id`) and (`admedicine`.`admissionid` = `admission`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addiagnostic`
--
ALTER TABLE `addiagnostic`
  ADD KEY `admissionid` (`admissionid`),
  ADD KEY `diagnosticid` (`diagnosticid`);

--
-- Indexes for table `admedicine`
--
ALTER TABLE `admedicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admissionid` (`admissionid`),
  ADD KEY `medicineid` (`medicineid`);

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `doctorid` (`doctorid`),
  ADD KEY `seatid` (`seatid`);

--
-- Indexes for table `ambulance`
--
ALTER TABLE `ambulance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contactnumber` (`contactnumber`);

--
-- Indexes for table `ambulencecharge`
--
ALTER TABLE `ambulencecharge`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`contact`),
  ADD KEY `ambulanceid` (`ambulanceid`);

--
-- Indexes for table `apointment`
--
ALTER TABLE `apointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `doctorid` (`doctorid`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Countryid` (`countryid`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `diagnostic`
--
ALTER TABLE `diagnostic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `doctorid` (`doctorid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `designationid` (`designationid`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `doctordegree`
--
ALTER TABLE `doctordegree`
  ADD KEY `doctorid` (`doctorid`),
  ADD KEY `degreesid` (`degreesid`);

--
-- Indexes for table `doctorserial`
--
ALTER TABLE `doctorserial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `doctorid` (`doctorid`);

--
-- Indexes for table `doctorspecialist`
--
ALTER TABLE `doctorspecialist`
  ADD UNIQUE KEY `doctorid` (`doctorid`,`specialistid`),
  ADD KEY `specialistid` (`specialistid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`contact`),
  ADD KEY `designationid` (`designationid`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generic`
--
ALTER TABLE `generic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admissionid` (`admissionid`),
  ADD KEY `paymentid` (`paymentid`),
  ADD KEY `employeeid` (`employeeid`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `genericid` (`genericid`),
  ADD KEY `companyid` (`companyid`);

--
-- Indexes for table `outdoor`
--
ALTER TABLE `outdoor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `doctorid` (`doctorid`);

--
-- Indexes for table `outdoordiagnostic`
--
ALTER TABLE `outdoordiagnostic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `diagnosticid` (`diagnosticid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `cityid` (`cityid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employeeid` (`employeeid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employeeid` (`employeeid`);

--
-- Indexes for table `salesdetails`
--
ALTER TABLE `salesdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salesid` (`salesid`),
  ADD KEY `medicineid` (`medicineid`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `visitingdays`
--
ALTER TABLE `visitingdays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctorid` (`doctorid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admedicine`
--
ALTER TABLE `admedicine`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ambulance`
--
ALTER TABLE `ambulance`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ambulencecharge`
--
ALTER TABLE `ambulencecharge`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `apointment`
--
ALTER TABLE `apointment`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `diagnostic`
--
ALTER TABLE `diagnostic`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `doctorserial`
--
ALTER TABLE `doctorserial`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `generic`
--
ALTER TABLE `generic`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `outdoor`
--
ALTER TABLE `outdoor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `outdoordiagnostic`
--
ALTER TABLE `outdoordiagnostic`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `salesdetails`
--
ALTER TABLE `salesdetails`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `specialist`
--
ALTER TABLE `specialist`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `visitingdays`
--
ALTER TABLE `visitingdays`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `addiagnostic`
--
ALTER TABLE `addiagnostic`
  ADD CONSTRAINT `addiagnostic_ibfk_1` FOREIGN KEY (`admissionid`) REFERENCES `admission` (`id`),
  ADD CONSTRAINT `addiagnostic_ibfk_2` FOREIGN KEY (`diagnosticid`) REFERENCES `diagnostic` (`id`);

--
-- Constraints for table `admedicine`
--
ALTER TABLE `admedicine`
  ADD CONSTRAINT `admedicine_ibfk_1` FOREIGN KEY (`admissionid`) REFERENCES `admission` (`id`),
  ADD CONSTRAINT `admedicine_ibfk_2` FOREIGN KEY (`medicineid`) REFERENCES `medicine` (`id`);

--
-- Constraints for table `admission`
--
ALTER TABLE `admission`
  ADD CONSTRAINT `admission_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `admission_ibfk_3` FOREIGN KEY (`seatid`) REFERENCES `seat` (`id`),
  ADD CONSTRAINT `admission_ibfk_4` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`id`);

--
-- Constraints for table `ambulencecharge`
--
ALTER TABLE `ambulencecharge`
  ADD CONSTRAINT `ambulencecharge_ibfk_1` FOREIGN KEY (`ambulanceid`) REFERENCES `ambulance` (`id`);

--
-- Constraints for table `apointment`
--
ALTER TABLE `apointment`
  ADD CONSTRAINT `apointment_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patient` (`id`),
  ADD CONSTRAINT `apointment_ibfk_2` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`countryid`) REFERENCES `country` (`id`);

--
-- Constraints for table `diagnostic`
--
ALTER TABLE `diagnostic`
  ADD CONSTRAINT `diagnostic_ibfk_1` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`id`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`designationid`) REFERENCES `designation` (`id`),
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`departmentid`) REFERENCES `department` (`id`);

--
-- Constraints for table `doctordegree`
--
ALTER TABLE `doctordegree`
  ADD CONSTRAINT `doctordegree_ibfk_1` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `doctordegree_ibfk_2` FOREIGN KEY (`degreesid`) REFERENCES `degrees` (`id`);

--
-- Constraints for table `installment`
--
ALTER TABLE `installment`
  ADD CONSTRAINT `installment_ibfk_1` FOREIGN KEY (`admissionid`) REFERENCES `admission` (`id`),
  ADD CONSTRAINT `installment_ibfk_2` FOREIGN KEY (`paymentid`) REFERENCES `payment` (`id`);

--
-- Constraints for table `visitingdays`
--
ALTER TABLE `visitingdays`
  ADD CONSTRAINT `visitingdays_ibfk_1` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
