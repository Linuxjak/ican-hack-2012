-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2012 at 09:59 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_korupsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `word` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=101 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `word`) VALUES
(99, 1350007697, '8MXR2'),
(100, 1350010574, 'KE1BZ');

-- --------------------------------------------------------

--
-- Table structure for table `jabatanakses`
--

CREATE TABLE IF NOT EXISTS `jabatanakses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_departemen` int(10) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `nama_jabatan` varchar(40) NOT NULL,
  `register` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `jabatanakses`
--

INSERT INTO `jabatanakses` (`id`, `id_departemen`, `jabatan`, `nama_jabatan`, `register`) VALUES
(1, 0, 'admin', 'Administrator', 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_support`
--

CREATE TABLE IF NOT EXISTS `online_support` (
  `id_online_support` int(10) NOT NULL AUTO_INCREMENT,
  `online_support` varchar(100) NOT NULL,
  PRIMARY KEY (`id_online_support`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `online_support`
--

INSERT INTO `online_support` (`id_online_support`, `online_support`) VALUES
(1, 'online_support'),
(2, 'online_support'),
(3, 'online_support'),
(4, 'online_support');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berita`
--

CREATE TABLE IF NOT EXISTS `tbl_berita` (
  `id_berita` int(20) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `tgl_post` date NOT NULL,
  `jam_post` time NOT NULL,
  `isi` text NOT NULL,
  `gbr` varchar(100) NOT NULL,
  PRIMARY KEY (`id_berita`),
  FULLTEXT KEY `judul` (`judul`,`isi`),
  FULLTEXT KEY `judul_2` (`judul`),
  FULLTEXT KEY `isi` (`isi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_berita`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_report_admin` (
  `kode_report` int(50) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `isi_report` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`kode_report`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_report_admin`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_sekilas_info`
--

CREATE TABLE IF NOT EXISTS `tbl_sekilas_info` (
  `kode_sekilas_info` int(10) NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `isi_info` text NOT NULL,
  PRIMARY KEY (`kode_sekilas_info`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `tbl_sekilas_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birth` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `first_name`, `last_name`, `gender`, `birth`, `address`, `occupation`, `organization`, `email`, `phone_number`, `password`) VALUES
(1, 'xsx', 'xssxs', 'male', 'xs', 'xsx', 'xsxs', 'xsx', 'xsx@fdf.fdf', '21221', '1c1b6219dd15fe0d15ba07eac649bf5e');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_akses` int(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `stts` int(5) NOT NULL,
  `login_limit_time` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_akses`, `user`, `pass`, `nama`, `stts`, `login_limit_time`) VALUES
(1, 1, 'admin', 'b8ed12b79059a299f9cd4165a918d1b3', 'admin', 1, 0);
