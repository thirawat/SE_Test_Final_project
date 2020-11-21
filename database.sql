-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ACCOUNT`;
CREATE TABLE `ACCOUNT` (
  `no` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pin` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `balance` int(10) NOT NULL,
  `waterCharge` int(10) NOT NULL,
  `electricCharge` int(10) NOT NULL,
  `phoneCharge` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ACCOUNT` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`) VALUES
('1234567890',	'1234',	'Thirawat Sutalungka',	1000000,	0,	0,	0);
INSERT INTO `ACCOUNT` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`) VALUES
('1234567891',	'1234',	'Phenphitcha Patthanajitsilp',	2000000,	0,	0,	0);
INSERT INTO `ACCOUNT` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`) VALUES
('1234567892',	'1234',	'Chonnathai Chanthakul',	3000000,	0,	0,	0);
INSERT INTO `ACCOUNT` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`) VALUES
('1234567893',	'1234',	'Phornhathai thanomwong',	4000000,	0,	0,	0);
INSERT INTO `ACCOUNT` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`) VALUES
('1234567894',	'1234',	'Pitiwat Arunruviwat',	5000000,	0,	0,	0);
INSERT INTO `ACCOUNT` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`) VALUES
('1234567895',	'1234',	'Narongsak Yooyen',	6000000,	0,	0,	0);
INSERT INTO `ACCOUNT` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`) VALUES
('1234567896',	'1234',	'Pakinwet Saksamerprom',	7000000,	0,	0,	0);

-- 2020-11-12 14:40:55