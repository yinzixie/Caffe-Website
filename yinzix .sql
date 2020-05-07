-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2019-03-21 15:57:05
-- 服务器版本： 5.5.60-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yinzix`
--

-- --------------------------------------------------------

--
-- 表的结构 `business_time`
--

CREATE TABLE IF NOT EXISTS `business_time` (
  `Open_time` varchar(7) NOT NULL,
  `Close_time` varchar(7) NOT NULL,
  `Cafe` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `business_time`
--

INSERT INTO `business_time` (`Open_time`, `Close_time`, `Cafe`) VALUES
('9:00AM', '9:00PM', 'Grove'),
('4:15AM', '7:45PM', 'Lazenbys'),
('1:15AM', '3:00PM', 'Ref'),
('0:00AM', '12:00PM', 'Trade_Table '),
('9:00AM', '9:00PM', 'Walk');

-- --------------------------------------------------------

--
-- 表的结构 `discount_information`
--

CREATE TABLE IF NOT EXISTS `discount_information` (
  `Type` varchar(20) NOT NULL,
  `Discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `discount_information`
--

INSERT INTO `discount_information` (`Type`, `Discount`) VALUES
('CAMPUS_EMPLOYEE', 0),
('CAMPUS_STUDENT', 0.07),
('CAFE_MANAGER', 0.15),
('CAMPUS_MANAGER', 0.8),
('DIRECTOR_BOARD', 1);

-- --------------------------------------------------------

--
-- 表的结构 `grove_cafe_cart_list`
--

CREATE TABLE IF NOT EXISTS `grove_cafe_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `grove_cafe_cart_list`
--

INSERT INTO `grove_cafe_cart_list` (`ID`, `Cart_id`, `Iteam_id`, `Amount`, `Description`) VALUES
(1, 'CM333318052201054242', 'Cake', 1, ''),
(2, 'CM333318052201054242', 'Sandwich', 2, '');

-- --------------------------------------------------------

--
-- 表的结构 `grove_cafe_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `grove_cafe_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Cost` float NOT NULL,
  `Collection_time` time NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `grove_cafe_head_cart_list`
--

INSERT INTO `grove_cafe_head_cart_list` (`ID`, `Cart_id`, `Cost`, `Collection_time`, `Date`) VALUES
('CM3333', 'CM333318052201054242', 16.57, '09:30:00', '2018-05-22');

-- --------------------------------------------------------

--
-- 表的结构 `grove_cafe_iteam`
--

CREATE TABLE IF NOT EXISTS `grove_cafe_iteam` (
  `Iteam_id` varchar(100) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `grove_cafe_iteam`
--

INSERT INTO `grove_cafe_iteam` (`Iteam_id`, `Type`) VALUES
('Cake', 'MASTER_FOOD'),
('Cappuccino', 'BEVERAGE'),
('Ice Cream', 'BEVERAGE'),
('Sandwich', 'MASTER_FOOD');

-- --------------------------------------------------------

--
-- 表的结构 `grove_cafe_temp_cart_list`
--

CREATE TABLE IF NOT EXISTS `grove_cafe_temp_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `grove_cafe_temp_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `grove_cafe_temp_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `grove_cafe_temp_head_cart_list`
--

INSERT INTO `grove_cafe_temp_head_cart_list` (`ID`, `Cart_id`) VALUES
('', ''),
('CM0000', 'CM0000'),
('CM1111', 'CM1111'),
('CM3333', 'CM3333'),
('UE1234', 'UE1234');

-- --------------------------------------------------------

--
-- 表的结构 `iteam`
--

CREATE TABLE IF NOT EXISTS `iteam` (
  `Iteam_id` varchar(20) NOT NULL,
  `Description` text NOT NULL,
  `Price` float NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Href` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `iteam`
--

INSERT INTO `iteam` (`Iteam_id`, `Description`, `Price`, `Type`, `Href`) VALUES
('1', 'test', 12, 'MASTER_FOOD', ''),
('Cake', 'A kink of cake', 100, 'MASTER_FOOD', '../img/menu/Cake.jpg'),
('Cappuccino', 'jjjjjjjjjj', 8.8, 'BEVERAGE', '../img/menu/Cappuccino.jpg'),
('Cola', 'hhhhhhhh', 5.5, 'BEVERAGE', '../img/menu/Cola.jpg'),
('Cookie', 'very good', 18, 'MASTER_FOOD', '../img/menu/Cookie.jpg'),
('Ice Cream', 'cool!!!!!', 7.5, 'BEVERAGE', '../img/menu/Ice Cream.jpg'),
('Latte', 'nnnnnnn', 7.7, 'BEVERAGE', '../img/menu/Latte.jpg'),
('Pasta', 'WOW!!!!!!', 1522, 'MASTER_FOOD', '../img/menu/Pasta.jpg'),
('Sandwich', 'asdasd asd..', 5.5, 'MASTER_FOOD', '../img/menu/Sandwich.jpg'),
('Steak', 'hohohohhohohhgggg', 2.5, 'MASTER_FOOD', '../img/menu/Steak.jpg'),
('Suda', 'hehehheheh', 3, 'BEVERAGE', '../img/menu/Suda.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `lazenbys_cafe_cart_list`
--

CREATE TABLE IF NOT EXISTS `lazenbys_cafe_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `lazenbys_cafe_cart_list`
--

INSERT INTO `lazenbys_cafe_cart_list` (`ID`, `Cart_id`, `Iteam_id`, `Amount`, `Description`) VALUES
(11, 'DB000018051509054299', 'Cake', 2, 'SDSDSDS'),
(12, 'DB000018051509054299', 'Sandwich', 4, 'AA'),
(13, 'DB000018051510054623', 'Cake', 2, ''),
(14, 'UE123418051807055574', 'Cake', 2, 'dfdf'),
(15, 'UE123418051807055574', 'Sandwich', 3, 'dfdf'),
(16, 'CM000018051807050486', 'Cola', 2, ''),
(17, 'CM000018051807050486', 'Latte', 2, ''),
(18, 'CM000018051807054472', 'Cake', 2, ''),
(19, 'CM000018051807054472', 'Cookie', 2, ''),
(20, 'UE343418052201054011', 'Cake', 2, 'fsd'),
(21, 'UE343418052201054011', 'Pasta', 2, 'dsfsdf'),
(22, 'UE343418052201054011', 'Cola', 3, 'fff'),
(23, 'UE343418052201054011', 'Suda', 3, '');

-- --------------------------------------------------------

--
-- 表的结构 `lazenbys_cafe_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `lazenbys_cafe_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Cost` float NOT NULL,
  `Collection_time` time NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `lazenbys_cafe_head_cart_list`
--

INSERT INTO `lazenbys_cafe_head_cart_list` (`ID`, `Cart_id`, `Cost`, `Collection_time`, `Date`) VALUES
('CM0000', 'CM000018051807050486', 22, '10:00:00', '2018-05-18'),
('CM0000', 'CM000018051807054472', 45.05, '10:00:00', '2018-05-18'),
('DB0000', 'DB000018051509054299', 0, '11:00:00', '2018-05-15'),
('DB0000', 'DB000018051510054623', 0, '11:00:00', '2018-05-15'),
('UE1234', 'UE123418051807055574', 34, '13:45:00', '2018-05-18'),
('UE3434', 'UE343418052201054011', 3086.5, '04:45:00', '2018-05-22');

-- --------------------------------------------------------

--
-- 表的结构 `lazenbys_cafe_iteam`
--

CREATE TABLE IF NOT EXISTS `lazenbys_cafe_iteam` (
  `Iteam_id` varchar(100) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `lazenbys_cafe_iteam`
--

INSERT INTO `lazenbys_cafe_iteam` (`Iteam_id`, `Type`) VALUES
('Cake', 'MASTER_FOOD'),
('Cappuccino', 'BEVERAGE'),
('Cola', 'BEVERAGE'),
('Cookie', 'MASTER_FOOD'),
('Ice Cream', 'BEVERAGE'),
('Latte', 'BEVERAGE'),
('Pasta', 'MASTER_FOOD'),
('Sandwich', 'MASTER_FOOD'),
('Steak', 'MASTER_FOOD'),
('Suda', 'BEVERAGE');

-- --------------------------------------------------------

--
-- 表的结构 `lazenbys_cafe_temp_cart_list`
--

CREATE TABLE IF NOT EXISTS `lazenbys_cafe_temp_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `lazenbys_cafe_temp_cart_list`
--

INSERT INTO `lazenbys_cafe_temp_cart_list` (`ID`, `Cart_id`, `Iteam_id`, `Amount`, `Description`) VALUES
(14, 'UE1234', 'Sandwich', 2, '');

-- --------------------------------------------------------

--
-- 表的结构 `lazenbys_cafe_temp_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `lazenbys_cafe_temp_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `lazenbys_cafe_temp_head_cart_list`
--

INSERT INTO `lazenbys_cafe_temp_head_cart_list` (`ID`, `Cart_id`) VALUES
('', ''),
('CA0000', 'CA0000'),
('CM0000', 'CM0000'),
('CM1111', 'CM1111'),
('DB0000', 'DB0000'),
('UE1234', 'UE1234'),
('UE3434', 'UE3434');

-- --------------------------------------------------------

--
-- 表的结构 `menu_apply_date`
--

CREATE TABLE IF NOT EXISTS `menu_apply_date` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `menu_apply_date`
--

INSERT INTO `menu_apply_date` (`ID`, `Date`) VALUES
(0, '2018-05-31');

-- --------------------------------------------------------

--
-- 表的结构 `ref_cafe_cart_list`
--

CREATE TABLE IF NOT EXISTS `ref_cafe_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `ref_cafe_cart_list`
--

INSERT INTO `ref_cafe_cart_list` (`ID`, `Cart_id`, `Iteam_id`, `Amount`, `Description`) VALUES
(11, 'DB000018051509054299', 'Cake', 2, 'SDSDSDS'),
(12, 'DB000018051509054299', 'Sandwich', 4, 'AA'),
(13, 'DB000018051510054623', 'Cake', 2, ''),
(14, 'CM11111805170205555', 'Cake', 4, ''),
(15, 'CM111118051702054541', 'Cake', 1, ''),
(16, 'CM111118051702054541', 'Sandwich', 1, ''),
(17, 'CM111118051702055827', 'Cake', 1, ''),
(18, 'CM111118051702051574', 'Cake', 1, ''),
(19, 'CM111118051702052937', 'Cake', 1, ''),
(20, 'CM111118051702053686', 'Cake', 1, ''),
(21, 'CM111118051702052516', 'Sandwich', 2, ''),
(22, 'CM111118051702054327', 'Cake', 1, ''),
(23, 'CM111118051702054327', 'Sandwich', 1, ''),
(24, 'UE112318051704054752', 'Cake', 1, 'dfdfdff'),
(25, 'UE112318051704054752', 'Sandwich', 6, 'wqerwer"""///'''''''''),
(26, 'UE112318051704051394', 'Cake', 3, ''),
(27, 'UE112318051704051394', 'Sandwich', 2, ''),
(28, 'UE123418051709054620', 'Cake', 1, 'ss'),
(29, 'CM111118051709055153', 'Cake', 1, ''),
(30, 'CM111118051709053099', 'Cake', 1, ''),
(31, 'CM11111805170905119', 'Sandwich', 2, 'SD'),
(32, 'CM111118051712051044', 'Latte', 1, ''),
(33, 'CM111118051712051044', 'Ice Cream', 3, ''),
(34, 'CM111118051805055188', 'Cookie', 4, 'qweqweqwe2323232'),
(35, 'CM111118051805055188', 'Sandwich', 7, 'qweqwe1233333333213'),
(36, 'CM111118051807055681', 'Cake', 1, ''),
(37, 'CM111118051807055090', 'Cake', 1, 'sdsd'),
(38, 'CM111118051807055090', 'Cookie', 1, 'sdsdd'),
(39, 'CM111118051807050852', 'Cake', 1, ''),
(40, 'CM11111805180705367', 'Cake', 3, 'sss'),
(41, 'CM111118051807051372', 'Cola', 6, 'ggggg'),
(42, 'CM111118051807051372', 'Latte', 2, 'asd'),
(43, 'CM111118051807051372', 'Suda', 1, 'asd'),
(44, 'CM111118051807051372', 'Cappuccino', 1, ''),
(45, 'CM111118051807051372', 'Cake', 4, ''),
(46, 'CM111118051807051372', 'Cookie', 1, 'fg'),
(47, 'CM111118051807051372', 'Steak', 1, 'fg'),
(48, 'CM111118051807051372', 'Sandwich', 1, ''),
(49, 'CM111118051807051372', 'Pasta', 1, ''),
(50, 'US111118061203064774', 'Cookie', 1, 'dsddss'),
(51, 'US123218062012062943', 'Cookie', 2, 'JHGJH'),
(52, 'US123218062012062028', 'Cookie', 2, ''),
(53, 'US123218062012062028', 'Pasta', 3, ''),
(54, 'US123218062012062028', 'Steak', 1, ''),
(55, 'US123218062012062028', 'Sandwich', 2, '');

-- --------------------------------------------------------

--
-- 表的结构 `ref_cafe_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `ref_cafe_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Cost` float NOT NULL,
  `Collection_time` time NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `ref_cafe_head_cart_list`
--

INSERT INTO `ref_cafe_head_cart_list` (`ID`, `Cart_id`, `Cost`, `Collection_time`, `Date`) VALUES
('CM1111', 'CM11111805170905119', 9, '08:15:00', '2018-05-17'),
('CM1111', 'CM111118051709053099', 7, '15:00:00', '2018-05-17'),
('CM1111', 'CM111118051712051044', 26, '07:30:00', '2018-05-17'),
('CM1111', 'CM111118051805055188', 94, '07:30:00', '2018-05-18'),
('CM1111', 'CM111118051807050852', 7, '11:45:00', '2018-05-18'),
('CM1111', 'CM111118051807051372', 1413, '14:15:00', '2018-05-18'),
('CM1111', 'CM11111805180705367', 22, '13:30:00', '2018-05-18'),
('CM1111', 'CM111118051807055090', 23, '12:15:00', '2018-05-18'),
('CM1111', 'CM111118051807055681', 7, '08:15:00', '2018-05-18'),
('US1111', 'US111118061203064774', 18, '10:00:00', '2018-06-12'),
('US1232', 'US123218062012062028', 4615.5, '01:45:00', '2018-06-20'),
('US1232', 'US123218062012062943', 36, '01:45:00', '2018-06-20');

-- --------------------------------------------------------

--
-- 表的结构 `ref_cafe_iteam`
--

CREATE TABLE IF NOT EXISTS `ref_cafe_iteam` (
  `Iteam_id` varchar(100) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `ref_cafe_iteam`
--

INSERT INTO `ref_cafe_iteam` (`Iteam_id`, `Type`) VALUES
('Cake', 'MASTER_FOOD'),
('Cappuccino', 'BEVERAGE'),
('Cola', 'BEVERAGE'),
('Cookie', 'MASTER_FOOD'),
('Ice Cream', 'BEVERAGE'),
('Latte', 'BEVERAGE'),
('Pasta', 'MASTER_FOOD'),
('Sandwich', 'MASTER_FOOD'),
('Steak', 'MASTER_FOOD'),
('Suda', 'BEVERAGE');

-- --------------------------------------------------------

--
-- 表的结构 `ref_cafe_temp_cart_list`
--

CREATE TABLE IF NOT EXISTS `ref_cafe_temp_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `ref_cafe_temp_cart_list`
--

INSERT INTO `ref_cafe_temp_cart_list` (`ID`, `Cart_id`, `Iteam_id`, `Amount`, `Description`) VALUES
(4, 'US1111', 'Cake', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `ref_cafe_temp_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `ref_cafe_temp_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `ref_cafe_temp_head_cart_list`
--

INSERT INTO `ref_cafe_temp_head_cart_list` (`ID`, `Cart_id`) VALUES
('', ''),
('CA0000', 'CA0000'),
('CM0000', 'CM0000'),
('CM1111', 'CM1111'),
('DB0000', 'DB0000'),
('UE1123', 'UE1123'),
('US1111', 'US1111'),
('US1232', 'US1232');

-- --------------------------------------------------------

--
-- 表的结构 `trade_table_cafe_cart_list`
--

CREATE TABLE IF NOT EXISTS `trade_table_cafe_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `trade_table_cafe_cart_list`
--

INSERT INTO `trade_table_cafe_cart_list` (`ID`, `Cart_id`, `Iteam_id`, `Amount`, `Description`) VALUES
(1, 'CM555518052201052549', 'Cake', 1, ''),
(2, 'CM555518052201052549', 'Sandwich', 1, ''),
(3, 'CM555518052202053215', 'Cake', 2, '444'),
(4, 'CM555518052202053215', 'Pasta', 3, 'RRRRRR');

-- --------------------------------------------------------

--
-- 表的结构 `trade_table_cafe_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `trade_table_cafe_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Cost` float NOT NULL,
  `Collection_time` time NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `trade_table_cafe_head_cart_list`
--

INSERT INTO `trade_table_cafe_head_cart_list` (`ID`, `Cart_id`, `Cost`, `Collection_time`, `Date`) VALUES
('CM5555', 'CM555518052201052549', 11.9, '09:30:00', '2018-05-22'),
('CM5555', 'CM555518052202053215', 3895.55, '00:30:00', '2018-05-22');

-- --------------------------------------------------------

--
-- 表的结构 `trade_table_cafe_iteam`
--

CREATE TABLE IF NOT EXISTS `trade_table_cafe_iteam` (
  `Iteam_id` varchar(100) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `trade_table_cafe_iteam`
--

INSERT INTO `trade_table_cafe_iteam` (`Iteam_id`, `Type`) VALUES
('Cake', 'MASTER_FOOD'),
('Cookie', 'MASTER_FOOD'),
('Latte', 'BEVERAGE'),
('Pasta', 'MASTER_FOOD'),
('Steak', 'MASTER_FOOD'),
('Suda', 'BEVERAGE');

-- --------------------------------------------------------

--
-- 表的结构 `trade_table_cafe_temp_cart_list`
--

CREATE TABLE IF NOT EXISTS `trade_table_cafe_temp_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `trade_table_cafe_temp_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `trade_table_cafe_temp_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `trade_table_cafe_temp_head_cart_list`
--

INSERT INTO `trade_table_cafe_temp_head_cart_list` (`ID`, `Cart_id`) VALUES
('', ''),
('CA0000', 'CA0000'),
('CA1111', 'CA1111'),
('CM0000', 'CM0000'),
('CM1111', 'CM1111'),
('CM5555', 'CM5555'),
('DB0000', 'DB0000'),
('UE1234', 'UE1234');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` varchar(6) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Credit_Card` varchar(20) NOT NULL,
  `Balance` double NOT NULL,
  `Head_photo_href` varchar(100) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Campus` varchar(20) NOT NULL,
  `Cafe` text NOT NULL,
  `Verification_code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`ID`, `Password`, `Fullname`, `Email`, `Mobile`, `Credit_Card`, `Balance`, `Head_photo_href`, `Type`, `Campus`, `Cafe`, `Verification_code`) VALUES
('CA0000', 'e10adc3949ba59abbe56e057f20f883e', 'Yinzi Xie(campus manager)', '123@123.123', '123123', '123123', 999999, '', 'CAMPUS_MANAGER', 'SANDY_BAY', '', ''),
('CA1111', 'e10adc3949ba59abbe56e057f20f883e', 'qwe', '234@QWE.QWE', '123123', '123123', 999999, '', 'CAMPUS_MANAGER', 'LANUNCESTON', '', ''),
('CM0000', 'e10adc3949ba59abbe56e057f20f883e', 'fgfggf', '123@QWEQWE.QWE', '222', '123123', 99932.51, './upload/CM0000.jpg', 'CAFE_MANAGER', 'SANDY_BAY', 'Ref', ''),
('CM1111', 'e10adc3949ba59abbe56e057f20f883e', 'ert', '123@123123.123', '123', '123123', 99486.8, './upload/CM1111.jpg', 'CAFE_MANAGER', 'SANDY_BAY', 'Ref', '18051702055971'),
('CM2222', 'e10adc3949ba59abbe56e057f20f883e', 'hhhhh', '123@123123.dsf', '123123', '333323', 99999, '', 'CAFE_MANAGER', 'LANUNCESTON', 'Walk', ''),
('CM3333', 'e10adc3949ba59abbe56e057f20f883e', 'jjjjjj', '123@123.123', '123123', '122', 106.43, '', 'CAFE_MANAGER', 'LANUNCESTON', 'Grove', ''),
('CM5555', 'e10adc3949ba59abbe56e057f20f883e', 'ggggg', 'dfdfdff@sdf.df', '77777', '45454545', 324231559.55, '', 'CAFE_MANAGER', 'SANDY_BAY', 'Trade_Table ', ''),
('DB0000', 'e10adc3949ba59abbe56e057f20f883e', 'Yinzi Xie', '123@123.123', '3333', '88888888', 37899, './upload/DB0000.jpg', 'DIRECTOR_BOARD', '', '', '123'),
('US1111', 'b2a6ee946986ad0791ae96e2a52da9e4', 'Test', 'test@test.com', '1111', '11', 32, '../img/headphoto.jpg', '', '', '', '18061203061265'),
('US1232', '2830435b9a206172a49c294acdee8d91', 'rtrt', 'qwe@qwe.qwe', '12342', '123', 99995348.5, '../img/headphoto.jpg', '', '', '', '1806201206309');

-- --------------------------------------------------------

--
-- 表的结构 `walk_cafe_cart_list`
--

CREATE TABLE IF NOT EXISTS `walk_cafe_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `walk_cafe_cart_list`
--

INSERT INTO `walk_cafe_cart_list` (`ID`, `Cart_id`, `Iteam_id`, `Amount`, `Description`) VALUES
(1, 'CM111118052802052434', 'Cake', 3, '');

-- --------------------------------------------------------

--
-- 表的结构 `walk_cafe_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `walk_cafe_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Cost` float NOT NULL,
  `Collection_time` time NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `walk_cafe_head_cart_list`
--

INSERT INTO `walk_cafe_head_cart_list` (`ID`, `Cart_id`, `Cost`, `Collection_time`, `Date`) VALUES
('CM1111', 'CM111118052802052434', 21.68, '09:30:00', '2018-05-28');

-- --------------------------------------------------------

--
-- 表的结构 `walk_cafe_iteam`
--

CREATE TABLE IF NOT EXISTS `walk_cafe_iteam` (
  `Iteam_id` varchar(100) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `walk_cafe_iteam`
--

INSERT INTO `walk_cafe_iteam` (`Iteam_id`, `Type`) VALUES
('Cake', 'MASTER_FOOD'),
('Sandwich', 'MASTER_FOOD');

-- --------------------------------------------------------

--
-- 表的结构 `walk_cafe_temp_cart_list`
--

CREATE TABLE IF NOT EXISTS `walk_cafe_temp_cart_list` (
  `ID` int(11) NOT NULL,
  `Cart_id` varchar(20) NOT NULL,
  `Iteam_id` varchar(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `walk_cafe_temp_head_cart_list`
--

CREATE TABLE IF NOT EXISTS `walk_cafe_temp_head_cart_list` (
  `ID` varchar(6) NOT NULL,
  `Cart_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `walk_cafe_temp_head_cart_list`
--

INSERT INTO `walk_cafe_temp_head_cart_list` (`ID`, `Cart_id`) VALUES
('', ''),
('CM0000', 'CM0000'),
('CM1111', 'CM1111'),
('CM5555', 'CM5555'),
('UE1234', 'UE1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_time`
--
ALTER TABLE `business_time`
  ADD PRIMARY KEY (`Cafe`);

--
-- Indexes for table `discount_information`
--
ALTER TABLE `discount_information`
  ADD PRIMARY KEY (`Discount`);

--
-- Indexes for table `grove_cafe_cart_list`
--
ALTER TABLE `grove_cafe_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `grove_cafe_head_cart_list`
--
ALTER TABLE `grove_cafe_head_cart_list`
  ADD PRIMARY KEY (`Cart_id`);

--
-- Indexes for table `grove_cafe_iteam`
--
ALTER TABLE `grove_cafe_iteam`
  ADD PRIMARY KEY (`Iteam_id`);

--
-- Indexes for table `grove_cafe_temp_cart_list`
--
ALTER TABLE `grove_cafe_temp_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `grove_cafe_temp_head_cart_list`
--
ALTER TABLE `grove_cafe_temp_head_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `iteam`
--
ALTER TABLE `iteam`
  ADD PRIMARY KEY (`Iteam_id`);

--
-- Indexes for table `lazenbys_cafe_cart_list`
--
ALTER TABLE `lazenbys_cafe_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lazenbys_cafe_head_cart_list`
--
ALTER TABLE `lazenbys_cafe_head_cart_list`
  ADD PRIMARY KEY (`Cart_id`);

--
-- Indexes for table `lazenbys_cafe_iteam`
--
ALTER TABLE `lazenbys_cafe_iteam`
  ADD PRIMARY KEY (`Iteam_id`);

--
-- Indexes for table `lazenbys_cafe_temp_cart_list`
--
ALTER TABLE `lazenbys_cafe_temp_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lazenbys_cafe_temp_head_cart_list`
--
ALTER TABLE `lazenbys_cafe_temp_head_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `menu_apply_date`
--
ALTER TABLE `menu_apply_date`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ref_cafe_cart_list`
--
ALTER TABLE `ref_cafe_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ref_cafe_head_cart_list`
--
ALTER TABLE `ref_cafe_head_cart_list`
  ADD PRIMARY KEY (`Cart_id`);

--
-- Indexes for table `ref_cafe_iteam`
--
ALTER TABLE `ref_cafe_iteam`
  ADD PRIMARY KEY (`Iteam_id`);

--
-- Indexes for table `ref_cafe_temp_cart_list`
--
ALTER TABLE `ref_cafe_temp_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ref_cafe_temp_head_cart_list`
--
ALTER TABLE `ref_cafe_temp_head_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trade_table_cafe_cart_list`
--
ALTER TABLE `trade_table_cafe_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trade_table_cafe_head_cart_list`
--
ALTER TABLE `trade_table_cafe_head_cart_list`
  ADD PRIMARY KEY (`Cart_id`);

--
-- Indexes for table `trade_table_cafe_iteam`
--
ALTER TABLE `trade_table_cafe_iteam`
  ADD PRIMARY KEY (`Iteam_id`);

--
-- Indexes for table `trade_table_cafe_temp_cart_list`
--
ALTER TABLE `trade_table_cafe_temp_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trade_table_cafe_temp_head_cart_list`
--
ALTER TABLE `trade_table_cafe_temp_head_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `walk_cafe_cart_list`
--
ALTER TABLE `walk_cafe_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `walk_cafe_head_cart_list`
--
ALTER TABLE `walk_cafe_head_cart_list`
  ADD PRIMARY KEY (`Cart_id`);

--
-- Indexes for table `walk_cafe_iteam`
--
ALTER TABLE `walk_cafe_iteam`
  ADD PRIMARY KEY (`Iteam_id`);

--
-- Indexes for table `walk_cafe_temp_cart_list`
--
ALTER TABLE `walk_cafe_temp_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `walk_cafe_temp_head_cart_list`
--
ALTER TABLE `walk_cafe_temp_head_cart_list`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grove_cafe_cart_list`
--
ALTER TABLE `grove_cafe_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grove_cafe_temp_cart_list`
--
ALTER TABLE `grove_cafe_temp_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lazenbys_cafe_cart_list`
--
ALTER TABLE `lazenbys_cafe_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `lazenbys_cafe_temp_cart_list`
--
ALTER TABLE `lazenbys_cafe_temp_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ref_cafe_cart_list`
--
ALTER TABLE `ref_cafe_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `ref_cafe_temp_cart_list`
--
ALTER TABLE `ref_cafe_temp_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trade_table_cafe_cart_list`
--
ALTER TABLE `trade_table_cafe_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trade_table_cafe_temp_cart_list`
--
ALTER TABLE `trade_table_cafe_temp_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `walk_cafe_cart_list`
--
ALTER TABLE `walk_cafe_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `walk_cafe_temp_cart_list`
--
ALTER TABLE `walk_cafe_temp_cart_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
