-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: Localhost
-- Generation Time: Feb 17, 2013 at 07:04 ÉÏÎç
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopdemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `address_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `street` varchar(80) NOT NULL,
  `suburb` varchar(20) NOT NULL,
  `state_n` varchar(30) NOT NULL,
  `postcode` char(4) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `customer_id`, `street`, `suburb`, `state_n`, `postcode`) VALUES
(1, 1, 'asdf', 'asdf', 'asdf', '2193');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(60) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Phones'),
(2, 'Tablets'),
(3, 'Cameras'),
(4, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_name` varchar(60) NOT NULL,
  `l_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` char(40) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `email` (`email`),
  KEY `login` (`email`,`pass`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `f_name`, `l_name`, `email`, `pass`) VALUES
(1, 'Richard', 'Ho', 'sfree2005@163.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Bill', 'Smith', 'sfree2006@163.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `total` decimal(10,2) unsigned NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `address_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `address_id` (`address_id`),
  KEY `order_date` (`order_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `total`, `order_date`, `address_id`) VALUES
(1, 1, '2695.00', '2013-02-15 15:23:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_content`
--

CREATE TABLE IF NOT EXISTS `order_content` (
  `oc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `product_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(6,2) unsigned NOT NULL,
  `quantity` tinyint(4) NOT NULL DEFAULT '1',
  `ship_date` datetime DEFAULT NULL,
  PRIMARY KEY (`oc_id`),
  KEY `order_id` (`order_id`),
  KEY `customer_id` (`customer_id`),
  KEY `product_id` (`product_id`),
  KEY `ship_date` (`ship_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `order_content`
--

INSERT INTO `order_content` (`oc_id`, `order_id`, `customer_id`, `product_id`, `product_name`, `price`, `quantity`, `ship_date`) VALUES
(1, 1, 1, 3, 'Samsung Galaxy Note 10.1 N8000 (16GB, 3G, Grey)', '549.00', 2, '0000-00-00 00:00:00'),
(2, 1, 1, 2, 'Samsung Galaxy S3 I9300 (16GB, Blue)', '599.00', 3, '0000-00-00 00:00:00'),
(3, 1, 1, 1, 'Samsung Galaxy Nexus I9250 (16GB, Silver)', '399.00', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(60) NOT NULL,
  `old_price` decimal(6,2) unsigned DEFAULT NULL,
  `price` decimal(6,2) unsigned NOT NULL,
  `description` varchar(60) NOT NULL,
  `image` varchar(60) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `on_sale` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `price` (`price`),
  KEY `product_name` (`product_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `old_price`, `price`, `description`, `image`, `category_id`, `on_sale`) VALUES
(1, 'Samsung Galaxy Nexus I9250 (16GB, Silver)', '499.00', '399.00', 'products/descriptions/1.html', 'products/images/1/', 1, 1),
(2, 'Samsung Galaxy S3 I9300 (16GB, Blue)', '699.00', '599.00', 'products/descriptions/2.html', 'products/images/2/', 1, 1),
(3, 'Samsung Galaxy Note 10.1 N8000 (16GB, 3G, Grey)', '688.00', '549.00', 'products/descriptions/3.html', 'products/images/3/', 2, 1),
(4, 'Nikon Coolpix AW100 Digital Camera (Orange)', '299.00', '229.00', 'products/descriptions/4.html', 'products/images/4/', 3, 1),
(5, '42" 3D LED TV (Full HD)', '599.00', '429.00', 'products/descriptions/5.html', 'products/images/5/', 4, 1),
(6, '16" LED TV (HD)', '129.00', '96.00', 'products/descriptions/6.html', 'products/images/6/', 4, 1);
