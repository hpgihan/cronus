-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2011 at 11:31 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.3-7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `platform`
--
CREATE DATABASE `platform` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `platform`;

-- --------------------------------------------------------

--
-- Table structure for table `deployment_queue`
--

CREATE TABLE IF NOT EXISTS `deployment_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) NOT NULL DEFAULT '0',
  `category` varchar(100) DEFAULT NULL,
  `rest_url` text NOT NULL,
  `rest_array` text,
  `status` char(1) NOT NULL DEFAULT '0' COMMENT '0 - Waiting, 1 - Acknoledged, 2 - Failed, 3 - Success',
  `priority_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;


-- --------------------------------------------------------

--
-- Table structure for table `job_queue`
--

CREATE TABLE IF NOT EXISTS `job_queue` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `job_type` int(16) NOT NULL,
  `status` int(16) NOT NULL DEFAULT '0',
  `tenant_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_ip` varchar(45) NOT NULL,
  `server_type` varchar(45) NOT NULL,
  `server_dns` varchar(45) DEFAULT NULL,
  `server_capacity` int(11) NOT NULL,
  `remaining_capacity` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '1 - server up, 0 - server down',
  `server_allocation_status` int(6) NOT NULL DEFAULT '1',
  `cluster_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


-- --------------------------------------------------------

--
-- Table structure for table `tenant_ports`
--

CREATE TABLE IF NOT EXISTS `tenant_ports` (
  `id` bigint(20) NOT NULL,
  `webapp_id` int(11) NOT NULL,
  `tenant_id` bigint(20) DEFAULT '0',
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `tenant_users`
--

CREATE TABLE IF NOT EXISTS `tenant_users` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `tenant_id` int(16) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tenant_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE IF NOT EXISTS `tenants` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `domain` varchar(80) NOT NULL,
  `subdomain` varchar(30) NOT NULL,
  `status` int(6) NOT NULL,
  `cluster_id` int(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tenants`
--
