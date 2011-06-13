-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2011 at 01:06 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.3-7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cronus`
--
CREATE DATABASE `cronus` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cronus`;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `deployment_queue`
--

INSERT INTO `deployment_queue` (`id`, `job_id`, `category`, `rest_url`, `rest_array`, `status`, `priority_id`) VALUES
(7, 2, 'webapp', 'http://173.236.117.132/api/tenants/action/tenant/create', '{"port":"8875", "diskquota":"8", "token":"7cb138643857846996ce7eae750e33ce "}', '3', 1),
(8, 1, 'webapp', 'https://173.236.117.132/api/tenants/action/sp/create', '{"port":"8805", "domain":"kasun.thinkcube.net", "token":"5590534824a21f1f91d8eba8c78d8aed ", "idphost":"idp.thinkcube.net", "idpcert":"fdfasdfasdfadsfdsaf"}', '0', 0),
(9, 1, 'infra', 'https://173.236.117.140/api/proxy/action/vhost/create', '{"domain":"kasun.thinkcube.net", "port":"8805", "webappip":"173.236.117.132", "token":"eba4fffd13562b39b6b94bb59711f211 "}', '0', 1),
(10, 1, 'dns', 'https://173.236.117.131/api/dns/action/domain/add', '{"subdomain":"kasun", "infraip":"173.236.117.140", "webappip":"173.236.117.132", "token":"79affcbc7394ad4215ca61da91a4b52e "}', '0', 1),
(11, 1, 'idp', 'https://idp.thinkcube.net/api/idp/action/sp/add', '{"domain":"kasun.thinkcube.net", "token":"9e1e7af6cbb6cf8b38a454abd1e29a13 "}', '0', 1),
(12, 1, 'idp', 'https://idp.thinkcube.net/api/idp/action/user/add', '{"username":"kasun@kasun.thinkcube.net", "password":"kasun", "token":"676750a1d22e5a0f798de68a4a8a61f1 "}', '0', 1),
(13, 3, 'webapp', 'https://74.125.235.16/api/tenants/action/tenant/create', '{"port":"8805", "diskquota":"20", "token":"5b78433322c5328622f5361c7ec75235 "}', '2', 1),
(14, 3, 'webapp', 'https://74.125.235.16/api/tenants/action/sp/create', '{"port":"8805", "domain":"bbb.think.com", "token":"df686143b4234ffeda85115aaa9c0d93 ", "idphost":"idp.thinkcube.net", "idpcert":"fdfasdfasdfadsfdsaf"}', '4', 0),
(15, 3, 'infra', 'https://74.125.235.16/api/proxy/action/vhost/create', '{"domain":"bbb.think.com", "port":"8805", "webappip":"74.125.235.16", "token":"f6edec1843437cdbba8ed59dc8e61873 "}', '2', 1),
(16, 3, 'dns', 'https://74.125.235.16/api/dns/action/domain/add', '{"subdomain":"bbb", "infraip":"74.125.235.16", "webappip":"74.125.235.16", "token":"0db0c79986f65eaf627c4e7ae0906cd7 "}', '4', 1),
(17, 3, 'idp', 'https://idp.thinkcube.net/api/idp/action/sp/add', '{"domain":"bbb.think.com", "token":"9e1e7af6cbb6cf8b38a454abd1e29a13 "}', '4', 1),
(18, 3, 'idp', 'https://idp.thinkcube.net/api/idp/action/user/add', '{"username":"kasun@bbb.think.com", "password":"kasun", "subdomain":"bbb", "last_name":"herath", "token":"676750a1d22e5a0f798de68a4a8a61f1 "}', '4', 1),
(19, 4, 'webapp', 'https://74.125.235.16/api/tenants/action/tenant/create', '{"port":"8806", "diskquota":"20", "token":"5b78433322c5328622f5361c7ec75235 "}', '2', 1),
(20, 4, 'webapp', 'https://74.125.235.16/api/tenants/action/sp/create', '{"port":"8806", "domain":"nhy.think.com", "token":"df686143b4234ffeda85115aaa9c0d93 ", "idphost":"idp.thinkcube.net", "idpcert":"fdfasdfasdfadsfdsaf"}', '4', 0),
(21, 4, 'infra', 'https://74.125.235.16/api/proxy/action/vhost/create', '{"domain":"nhy.think.com", "port":"8806", "webappip":"74.125.235.16", "token":"f6edec1843437cdbba8ed59dc8e61873 "}', '2', 1),
(22, 4, 'dns', 'https://74.125.235.16/api/dns/action/domain/add', '{"subdomain":"nhy", "infraip":"74.125.235.16", "webappip":"74.125.235.16", "token":"0db0c79986f65eaf627c4e7ae0906cd7 "}', '4', 1),
(23, 4, 'idp', 'https://idp.thinkcube.net/api/idp/action/sp/add', '{"domain":"nhy.think.com", "token":"9e1e7af6cbb6cf8b38a454abd1e29a13 "}', '4', 1),
(24, 4, 'idp', 'https://idp.thinkcube.net/api/idp/action/user/add', '{"username":"kasun@nhy.think.com", "password":"kasun", "subdomain":"nhy", "last_name":"herath", "token":"676750a1d22e5a0f798de68a4a8a61f1 "}', '4', 1),
(25, 5, 'webapp', 'https://74.125.235.16/api/tenants/action/tenant/create', '{"port":"8807", "diskquota":"20", "token":"5b78433322c5328622f5361c7ec75235 "}', '2', 1),
(26, 5, 'webapp', 'https://74.125.235.16/api/tenants/action/sp/create', '{"port":"8807", "domain":"uio.think.com", "token":"df686143b4234ffeda85115aaa9c0d93 ", "idphost":"idp.thinkcube.net", "idpcert":"fdfasdfasdfadsfdsaf"}', '4', 0),
(27, 5, 'infra', 'https://74.125.235.16/api/proxy/action/vhost/create', '{"domain":"uio.think.com", "port":"8807", "webappip":"74.125.235.16", "token":"f6edec1843437cdbba8ed59dc8e61873 "}', '2', 1),
(28, 5, 'dns', 'https://74.125.235.16/api/dns/action/domain/add', '{"subdomain":"uio", "infraip":"74.125.235.16", "webappip":"74.125.235.16", "token":"0db0c79986f65eaf627c4e7ae0906cd7 "}', '4', 1),
(29, 5, 'idp', 'https://idp.thinkcube.net/api/idp/action/sp/add', '{"domain":"uio.think.com", "token":"9e1e7af6cbb6cf8b38a454abd1e29a13 "}', '4', 1),
(30, 5, 'idp', 'https://idp.thinkcube.net/api/idp/action/user/add', '{"username":"kasun@uio.think.com", "password":"kasun", "subdomain":"uio", "last_name":"kasun", "token":"676750a1d22e5a0f798de68a4a8a61f1 "}', '4', 1),
(31, 6, 'webapp', 'http://localhost/dummys.html', NULL, '3', 1),
(32, 6, 'infra', 'http://localhost/dummyf.html', NULL, '2', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `job_queue`
--

INSERT INTO `job_queue` (`id`, `job_type`, `status`, `tenant_id`) VALUES
(2, 1, 3, 1),
(3, 1, 2, 2),
(4, 1, 2, 3),
(5, 1, 2, 4),
(6, 1, 2, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`id`, `server_ip`, `server_type`, `server_dns`, `server_capacity`, `remaining_capacity`, `status`, `server_allocation_status`, `cluster_id`) VALUES
(5, '74.125.235.16', 'infra', NULL, 1000, 997, '1', 1, 1),
(6, '74.125.235.16', 'infra', NULL, 1000, 1000, '1', 1, 2),
(7, '74.125.235.16', 'webapp', NULL, 1000, 997, '1', 1, 1),
(8, '74.125.235.16', 'idp', 'idp.thinkcube.net', 1000, 1000, '1', 1, 0),
(9, '74.125.235.16', 'dns', '', 1000, 1000, '1', 1, 0),
(10, '74.125.235.16', 'dns', 'test.com', 1000, 1000, '1', 1, 0);

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

--
-- Dumping data for table `tenant_ports`
--

INSERT INTO `tenant_ports` (`id`, `webapp_id`, `tenant_id`, `profile_id`) VALUES
(8805, 4, 1, 0),
(8805, 7, 2, 0),
(8806, 7, 3, 0),
(8807, 7, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tenant_users`
--

CREATE TABLE IF NOT EXISTS `tenant_users` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `tenant_id` int(16) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tenant_users`
--

INSERT INTO `tenant_users` (`id`, `tenant_id`, `username`, `password`, `firstname`, `lastname`) VALUES
(1, 3, 'kasun', 'kasun', 'kasun', 'herath'),
(2, 4, 'kasun', 'kasun', 'kasun', 'kasun');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `domain`, `subdomain`, `status`, `cluster_id`) VALUES
(1, 'kasun.thinkcube.net', 'kasun', 1, 1),
(2, 'bbb.think.com', 'bbb', 1, 1),
(3, 'nhy.think.com', 'nhy', 1, 1),
(4, 'uio.think.com', 'uio', 2, 1);
