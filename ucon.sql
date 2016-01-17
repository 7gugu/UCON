-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 12 月 27 日 20:23
-- 服务器版本: 5.5.40
-- PHP 版本: 5.4.33

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ucon`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `inser`
--

CREATE TABLE IF NOT EXISTS `inser` (
  `dtime` text NOT NULL,
  `inser` text NOT NULL,
  `max` text NOT NULL,
  `sport` text NOT NULL,
  `port` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `op`
--

CREATE TABLE IF NOT EXISTS `op` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `port` text NOT NULL,
  `sename` text NOT NULL,
  `map` text NOT NULL,
  `max` text NOT NULL,
  `pw` text NOT NULL,
  `sport` text NOT NULL,
  `mode` text NOT NULL,
  `Perspective` text NOT NULL,
  `pvpe` text NOT NULL,
  `welcome` text CHARACTER SET big5 NOT NULL,
  `dtime` text NOT NULL,
  `email` text NOT NULL,
  `rtime` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
