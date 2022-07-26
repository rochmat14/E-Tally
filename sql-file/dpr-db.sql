-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 07, 2022 at 10:04 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dpr-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kk_blogs`
--

CREATE TABLE `kk_blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `tags` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_on` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk_blogs`
--

INSERT INTO `kk_blogs` (`id`, `id_category`, `tags`, `published_on`, `slug`, `meta_keyword`, `meta_description`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 10, 'a:1:{i:0;s:6:\"hastag\";}', '2022-07-07 16:15:50', 'news-sampling', 'News Sampling', 'News Sampling', 1, 'slide2.png', '2022-07-07 09:16:59', '2022-07-07 09:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `kk_blog_descriptions`
--

CREATE TABLE `kk_blog_descriptions` (
  `blog_id` int(10) UNSIGNED NOT NULL,
  `language_id` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk_blog_descriptions`
--

INSERT INTO `kk_blog_descriptions` (`blog_id`, `language_id`, `title`, `description`) VALUES
(1, 'id', 'Berita Sampling', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'),
(1, 'en', 'News Sampling', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `kk_category`
--

CREATE TABLE `kk_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` smallint(2) DEFAULT NULL,
  `additional` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kk_category`
--

INSERT INTO `kk_category` (`id`, `slug`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`, `additional`) VALUES
(1, 'history', 'History', 15, 15, '2019-06-08 02:39:27', '2019-06-08 02:40:02', 1, NULL),
(2, 'training', 'Training', 15, 3, '2019-06-08 02:39:34', '2021-07-11 16:32:46', 0, NULL),
(3, 'commitment', 'Commitment', 15, NULL, '2019-06-08 02:39:49', '2019-06-08 02:39:49', 1, NULL),
(4, 'service', 'Service', 15, NULL, '2021-06-17 08:17:41', '2021-06-17 08:17:41', 1, NULL),
(5, 'un-category', 'un category', 3, 3, '2021-07-11 16:42:19', '2021-07-11 16:43:43', 1, NULL),
(6, 'why-choose', 'why-choose', 3, NULL, '2021-12-12 07:05:18', '2021-12-12 07:05:18', 1, NULL),
(7, 'delivery-service', 'Delivery Service', 3, 3, '2021-12-21 10:05:58', '2022-01-27 17:55:42', 0, NULL),
(8, 'faq-keunggulan-kami', 'faq-keunggulan-kami', 3, NULL, '2022-01-28 03:05:56', '2022-01-28 03:05:56', 1, NULL),
(9, 'tips-and-trick', 'Tips And Trick', 3, NULL, '2022-02-03 00:07:36', '2022-02-03 00:07:36', 1, NULL),
(10, 'article', 'Article', 3, NULL, '2022-02-03 18:14:32', '2022-02-03 18:14:32', 1, NULL),
(11, 'menu', 'Menu', 3, NULL, '2022-06-25 12:12:07', '2022-06-25 12:12:07', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kk_client`
--

CREATE TABLE `kk_client` (
  `id` int(11) NOT NULL,
  `nama_client` varchar(200) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kk_client`
--

INSERT INTO `kk_client` (`id`, `nama_client`, `logo`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'BPJS', '1656488891.jpg', '2022-06-29 07:48:11', '2022-06-29 07:48:11', 3, NULL, 1),
(2, 'Alianz', '1656488901.jpg', '2022-06-29 07:48:21', '2022-06-29 07:48:21', 3, NULL, 1),
(3, 'Bank BNI', '1656488913.jpg', '2022-06-29 07:48:33', '2022-06-29 07:48:33', 3, NULL, 1),
(4, 'Manulife', '1656488923.jpg', '2022-06-29 07:48:43', '2022-06-29 07:48:43', 3, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kk_infobox`
--

CREATE TABLE `kk_infobox` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kk_infobox`
--

INSERT INTO `kk_infobox` (`id`, `title`, `link`, `image`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Selamat Datang Di Perisai Sistem Management', 'http://127.0.0.1:8000/login', '1657185522.png', 'on', NULL, '2022-07-07 09:18:42', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kk_ms_contact`
--

CREATE TABLE `kk_ms_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `date_contact` datetime NOT NULL,
  `status_read` enum('Y','N') NOT NULL,
  `id_address` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kk_ms_contact`
--

INSERT INTO `kk_ms_contact` (`id`, `name`, `email`, `phone`, `subject`, `message`, `date_contact`, `status_read`, `id_address`, `created_at`, `updated_at`, `updated_by`) VALUES
(5, 'jadir ullah', 'jadirullah@gmail.com', '+6287770164', 'test aja', 'dwdwdwd', '2022-02-15 18:33:26', 'Y', '127.0.0.1', '2022-02-15 11:33:26', '2022-06-26 05:46:48', 3),
(6, 'jadir ullah', 'jadirullah@gmail.com', '+6287770164', 'test aja', 'dw', '2022-02-15 18:34:55', 'Y', '127.0.0.1', '2022-02-15 11:34:55', '2022-06-26 05:46:44', 3),
(7, 'jadir ullah', 'jadirullah@gmail.com', '+6287770164', 'dsdsds', 'retertet', '2022-06-24 13:21:57', 'Y', '127.0.0.1', '2022-06-24 06:21:57', '2022-06-26 05:46:41', 3),
(8, 'jadir ullah', 'jadirullah@gmail.com', '+6287770164', 'tyrty', '4r34r', '2022-06-24 13:22:11', 'Y', '127.0.0.1', '2022-06-24 06:22:11', '2022-06-26 05:46:35', 3),
(9, 'udin', 'udin@mail.com', '+6287770164', 'tanya jadwal dokter', 'jadwal dokter kapan ya ?', '2022-06-26 12:57:06', 'Y', '127.0.0.1', '2022-06-26 05:57:06', '2022-06-26 05:57:39', 3),
(10, 'udin', 'udin@mail.com', '+6287770164', 'ssws', '3jirhqwjkebjqw', '2022-06-26 12:58:04', 'N', '127.0.0.1', '2022-06-26 05:58:04', '2022-06-26 05:58:04', NULL),
(11, 'jadir', 'jadirullah@gmail.com', '0210020', 'test aja', 'dwdwdwdwd', '2022-06-26 13:01:33', 'N', '127.0.0.1', '2022-06-26 06:01:33', '2022-06-26 06:01:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kk_notification`
--

CREATE TABLE `kk_notification` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `status` enum('read','un_read') NOT NULL DEFAULT 'un_read',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kk_notification`
--

INSERT INTO `kk_notification` (`id`, `id_user`, `judul`, `text`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 37, 'Informasi Booking', 'Anda Berhasil Melakukan Booking 100821115618_611206f2ae894. Silahkan lakukan bukti pembayaran lewat sistem untuk proses selanjutnya. Terimakasih', 'read', '2021-08-10 04:56:18', '2021-12-12 10:39:05', 37, 37),
(2, 37, 'Informasi Pembayaran', 'Selamat Anda Telah Berhasil Melakukan Pembayaran Terkait Kode Booking 100821115618_611206f2ae894 Berdasarkan Nama Training Kebocoran Data Nasabah, Bagaimana Hukumnya ? Silahkan Cek Menu My Orders. Terimakasih', 'read', '2021-08-13 03:56:44', '2021-12-12 10:38:59', 37, 37),
(3, 37, 'Informasi Pembayaran', 'Selamat Anda Telah Berhasil Melakukan Pembayaran Terkait Kode Booking 100821115618_611206f2ae894 Berdasarkan Nama Training Kebocoran Data Nasabah, Bagaimana Hukumnya ? Silahkan Cek Menu My Orders. Terimakasih', 'read', '2021-08-13 03:57:03', '2021-12-12 10:39:02', 37, 37),
(4, 37, 'Informasi Pembayaran', 'Selamat Anda Telah Berhasil Melakukan Pembayaran Terkait Kode Booking 100821115618_611206f2ae894 Berdasarkan Nama Training Kebocoran Data Nasabah, Bagaimana Hukumnya ? Silahkan Cek Menu My Orders. Terimakasih', 'read', '2021-08-13 04:04:18', '2021-08-13 09:47:32', 37, 37),
(5, 37, 'Informasi Booking', 'Anda Berhasil Melakukan Booking Training Belajar Javascript Berdasarkan nomor orders  = 130821044502_61163f1e5ce4b. Silahkan lakukan bukti pembayaran lewat sistem untuk proses selanjutnya. Terimakasih', 'read', '2021-08-13 09:45:02', '2021-08-13 09:47:08', 37, 37);

-- --------------------------------------------------------

--
-- Table structure for table `kk_pages`
--

CREATE TABLE `kk_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `tags` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=menu, 2=text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk_pages`
--

INSERT INTO `kk_pages` (`id`, `parent_id`, `lft`, `rgt`, `depth`, `slug`, `status`, `id_category`, `tags`, `image`, `sort_order`, `created_at`, `updated_at`, `jenis`) VALUES
(1, NULL, 1, 2, 0, 'home', 1, 11, NULL, '', 1, '2022-07-07 09:14:53', '2022-07-07 09:14:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kk_page_descriptions`
--

CREATE TABLE `kk_page_descriptions` (
  `page_id` int(10) UNSIGNED NOT NULL,
  `language_id` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk_page_descriptions`
--

INSERT INTO `kk_page_descriptions` (`page_id`, `language_id`, `name`, `description`) VALUES
(1, 'id', 'Branda', NULL),
(1, 'en', 'Home', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kk_slideshows`
--

CREATE TABLE `kk_slideshows` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort_order` mediumint(9) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk_slideshows`
--

INSERT INTO `kk_slideshows` (`id`, `status`, `sort_order`, `image`, `created_at`, `updated_at`, `url`, `target`) VALUES
(1, 1, 1, 'slide-official.png', '2022-06-27 06:16:56', '2022-06-27 06:16:57', '#', 1),
(2, 1, 2, 'ambulance-slide.png', '2022-06-27 08:28:51', '2022-06-27 08:28:52', '#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kk_slideshow_descriptions`
--

CREATE TABLE `kk_slideshow_descriptions` (
  `slideshow_id` int(10) UNSIGNED NOT NULL,
  `language_id` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk_slideshow_descriptions`
--

INSERT INTO `kk_slideshow_descriptions` (`slideshow_id`, `language_id`, `title`, `subtitle`, `button_text`) VALUES
(1, 'id', ' ', NULL, '#'),
(2, 'id', ' ', NULL, ' ');

-- --------------------------------------------------------

--
-- Table structure for table `kk_subscribe`
--

CREATE TABLE `kk_subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kk_tags`
--

CREATE TABLE `kk_tags` (
  `id` int(11) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` smallint(2) DEFAULT NULL,
  `additional` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kk_tags`
--

INSERT INTO `kk_tags` (`id`, `slug`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `status`, `additional`) VALUES
(1, 'tagline-edit', 'Tagline edit', 15, 3, '2019-06-08 02:40:23', '2021-07-11 16:54:17', 0, NULL),
(2, 'hastag', 'hastag', 3, 3, '2021-07-11 16:54:07', '2021-07-30 06:18:42', 1, NULL),
(3, 'coding', 'Coding', 3, NULL, '2022-02-03 16:46:35', '2022-02-03 16:46:35', 1, NULL),
(4, 'service', 'Service', 3, NULL, '2022-02-03 16:46:40', '2022-02-03 16:46:40', 1, NULL),
(5, 'idetechno', 'Idetechno', 3, NULL, '2022-02-03 16:47:06', '2022-02-03 16:47:06', 1, NULL),
(6, 'branding', 'Branding', 3, NULL, '2022-02-03 16:47:19', '2022-02-03 16:47:19', 1, NULL),
(7, 'digital', 'Digital', 3, NULL, '2022-02-03 16:47:24', '2022-02-03 16:47:24', 1, NULL),
(8, 'seo', 'SEO', 3, NULL, '2022-02-03 16:47:28', '2022-02-03 16:47:28', 1, NULL),
(9, 'article', 'Article', 3, NULL, '2022-02-03 18:12:29', '2022-02-03 18:12:29', 1, NULL),
(10, 'analisis', 'Analisis', 3, NULL, '2022-02-03 18:12:41', '2022-02-03 18:12:41', 1, NULL),
(11, 'research', 'Research', 3, NULL, '2022-02-03 18:12:50', '2022-02-03 18:12:50', 1, NULL),
(12, 'digital-marketing', 'Digital Marketing', 3, NULL, '2022-02-03 18:13:02', '2022-02-03 18:13:02', 1, NULL),
(13, 'bisnis', 'Bisnis', 3, NULL, '2022-02-03 18:13:10', '2022-02-03 18:13:10', 1, NULL),
(14, 'umkm', 'UMKM', 3, NULL, '2022-02-03 18:13:14', '2022-02-03 18:13:14', 1, NULL),
(15, 'konsultan', 'KONSULTAN', 3, NULL, '2022-02-03 18:13:22', '2022-02-03 18:13:22', 1, NULL),
(16, 'jasa-web-cikarang', 'Jasa Web Cikarang', 3, NULL, '2022-02-03 18:13:39', '2022-02-03 18:13:39', 1, NULL),
(17, 'jasa-web-bekasi', 'Jasa Web Bekasi', 3, NULL, '2022-02-03 18:13:45', '2022-02-03 18:13:45', 1, NULL),
(18, 'jasa-web-jakarta', 'Jasa Web Jakarta', 3, NULL, '2022-02-03 18:13:53', '2022-02-03 18:13:53', 1, NULL),
(19, 'jasa-web-karawang', 'Jasa Web Karawang', 3, NULL, '2022-02-03 18:14:09', '2022-02-03 18:14:09', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kk_testimonial`
--

CREATE TABLE `kk_testimonial` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `text` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kk_testimonial`
--

INSERT INTO `kk_testimonial` (`id`, `name`, `subtitle`, `photo`, `text`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Jadir', 'CEO Idetechno', '1656503846.png', 'Rs. Bhakti Husada CIkarang, Top Pelayananya, greatfull , pertahankan .', '2022-06-29 11:57:26', '2022-06-29 11:57:26', 3, NULL, 1),
(2, 'Udin', 'Direktur Samsung', '1656511869.png', 'Keren euy, pertahankan', '2022-06-29 14:11:09', '2022-06-29 14:11:09', 3, NULL, 1),
(3, 'Sutiono', 'Direktour Honda', '1656511960.jpg', 'Mantap... Layanan Joss', '2022-06-29 14:12:40', '2022-06-29 14:12:40', 3, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_01_30_183352_create_permission_tables', 2),
(5, '2020_02_02_082257_create_setting', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 3),
(3, 'App\\User', 5),
(3, 'App\\User', 6),
(3, 'App\\User', 7),
(3, 'App\\User', 8),
(3, 'App\\User', 9),
(3, 'App\\User', 10),
(3, 'App\\User', 11),
(3, 'App\\User', 12),
(3, 'App\\User', 13),
(3, 'App\\User', 14),
(3, 'App\\User', 15),
(3, 'App\\User', 16),
(3, 'App\\User', 17),
(3, 'App\\User', 18),
(3, 'App\\User', 19),
(3, 'App\\User', 20),
(3, 'App\\User', 21),
(3, 'App\\User', 25),
(3, 'App\\User', 26),
(3, 'App\\User', 27),
(3, 'App\\User', 28),
(3, 'App\\User', 33),
(3, 'App\\User', 35),
(3, 'App\\User', 36),
(3, 'App\\User', 37),
(3, 'App\\User', 38),
(3, 'App\\User', 39),
(3, 'App\\User', 40);

-- --------------------------------------------------------

--
-- Table structure for table `ms_agama`
--

CREATE TABLE `ms_agama` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ms_agama`
--

INSERT INTO `ms_agama` (`id`, `nama`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Islam', '2020-07-30 05:16:17', '2020-07-30 05:16:17', 3, NULL, 1),
(2, 'Protestan', '2020-07-30 05:16:45', '2020-07-30 05:16:45', 3, NULL, 1),
(3, 'Katolik', '2020-07-30 05:16:52', '2020-07-30 05:16:52', 3, NULL, 1),
(4, 'Hindu', '2020-07-30 05:16:59', '2020-07-30 05:16:59', 3, NULL, 1),
(5, 'Buddha', '2020-07-30 05:17:06', '2020-07-30 05:17:06', 3, NULL, 1),
(6, 'Khonghucu', '2020-07-30 05:17:17', '2020-07-30 05:17:17', 3, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_bank`
--

CREATE TABLE `ms_bank` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_rekening` varchar(100) DEFAULT NULL,
  `atas_nama` varchar(200) DEFAULT NULL,
  `bank_logo` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ms_bank`
--

INSERT INTO `ms_bank` (`id`, `bank_name`, `bank_rekening`, `atas_nama`, `bank_logo`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'BRI Syariah', '8888888', 'Gunawan LC', '1627582961.jpg', NULL, '2022-01-27 17:49:39', NULL, 3, 0),
(2, 'Mandiri Syariah', '00000001', 'Jadirullah', '1657184935.png', '2021-07-29 18:11:05', '2022-07-07 09:08:55', 3, 3, 1),
(3, 'BTN', '0102010928019', 'Gunawan LC', '1628367345.png', '2021-08-07 20:15:45', '2022-01-27 17:49:44', 3, 3, 0),
(4, 'BCA', '1019028190', 'Gunawan LC', '1628367396.jpg', '2021-08-07 20:16:36', '2022-01-27 17:49:41', 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_users_description`
--

CREATE TABLE `ms_users_description` (
  `id` bigint(20) NOT NULL,
  `users_id` bigint(20) NOT NULL,
  `type_user` enum('perusahaan','perorangan') DEFAULT NULL,
  `nama_depan` varchar(45) DEFAULT NULL,
  `nama_belakang` varchar(45) DEFAULT NULL,
  `gelar` char(20) DEFAULT NULL,
  `jenis_kelamin` enum('pria','wanita') DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `alamat_rumah` varchar(150) DEFAULT NULL,
  `alamat_surat` varchar(150) DEFAULT NULL,
  `pendidikan_terakhir` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(200) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `doc_ktp` varchar(150) DEFAULT NULL,
  `doc_ijazah` varchar(150) DEFAULT NULL,
  `nama_instansi` varchar(200) DEFAULT NULL,
  `alamat_instansi` varchar(200) DEFAULT NULL,
  `telp_instansi` varchar(45) DEFAULT NULL,
  `email_instansi` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ms_users_description`
--

INSERT INTO `ms_users_description` (`id`, `users_id`, `type_user`, `nama_depan`, `nama_belakang`, `gelar`, `jenis_kelamin`, `phone`, `alamat_rumah`, `alamat_surat`, `pendidikan_terakhir`, `tempat_lahir`, `tanggal_lahir`, `tanggal_masuk`, `doc_ktp`, `doc_ijazah`, `nama_instansi`, `alamat_instansi`, `telp_instansi`, `email_instansi`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(3, 3, NULL, 'admin', 'official', NULL, 'pria', '087887177736', 'Bekasi, Jawa Barat', NULL, NULL, 'Bekasi', '1990-01-01', '2019-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-26 17:15:34', NULL, 3, 1),
(31, 37, NULL, 'jadir', 'udin', 'D3', 'pria', '+6287770164', 'Sukatani, Kab.Bekasi', 'Sukatani, Kab.Bekasi', 'SMA', 'Bekasi', '1993-07-21', NULL, 'code-snapshot.png', '1628571320.png', 'umkm', 'Bekasi, Jawa Barat', '+62 878-8717-7736', 'hello@idetechno.com', '2021-08-10 04:51:22', '2021-08-14 17:42:20', 37, 37, 1),
(32, 38, 'perusahaan', 'Mr bara', NULL, NULL, NULL, '02010201002', 'Priok Jakut', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PT Export Indonesia', NULL, NULL, NULL, '2022-01-16 14:35:43', '2022-01-16 14:35:43', 38, NULL, 1),
(33, 39, 'perusahaan', 'fathur', NULL, NULL, NULL, '+6287770164', 'Medan, Sumatera Itara', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Shorum Maju Terus', NULL, NULL, NULL, '2022-01-18 06:10:30', '2022-01-18 06:10:30', 39, NULL, 1),
(34, 40, NULL, 'jadir', 'ullah', NULL, 'pria', '+6287887177736', 'Bekasi, Jawa Barat', NULL, NULL, 'bekasi', '1990-01-01', NULL, NULL, NULL, 'PT Maju Mundur', 'bekasi, jawa barat', '021012901290', 'majumundur@mail.com', '2022-01-25 02:48:52', '2022-01-25 03:09:10', 40, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'dashboard-index', 'web', NULL, '2020-01-31 22:08:26', NULL, 1),
(2, 'permissions-index', 'web', NULL, NULL, NULL, NULL),
(3, 'permissions-create', 'web', NULL, NULL, NULL, NULL),
(4, 'permissions-update', 'web', NULL, NULL, NULL, NULL),
(5, 'permissions-delete', 'web', NULL, NULL, NULL, NULL),
(6, 'roles-index', 'web', NULL, NULL, NULL, NULL),
(7, 'roles-create', 'web', NULL, NULL, NULL, NULL),
(8, 'roles-update', 'web', NULL, NULL, NULL, NULL),
(9, 'users_pengguna-index', 'web', NULL, '2020-07-21 02:43:48', NULL, 3),
(10, 'users_pengguna-create', 'web', NULL, '2020-07-21 02:43:39', NULL, 3),
(11, 'users_pengguna-update', 'web', NULL, '2020-07-21 02:43:58', NULL, 3),
(12, 'users_pengguna-delete', 'web', NULL, '2020-07-21 02:43:43', NULL, 3),
(14, 'users_pengguna-activated', 'web', '2020-02-01 00:07:37', '2020-07-21 02:43:33', 1, 3),
(15, 'users_pengguna-show', 'web', '2020-02-01 00:10:17', '2020-07-21 02:43:54', 1, 3),
(16, 'profile-index', 'web', '2020-02-01 22:29:50', '2020-02-01 22:29:50', 3, NULL),
(17, 'profile-update', 'web', '2020-02-01 22:30:03', '2020-02-01 22:30:03', 3, NULL),
(18, 'setting_general-index', 'web', '2020-02-02 01:02:33', '2020-02-02 01:02:33', 3, NULL),
(19, 'setting_general-update', 'web', '2020-02-02 01:02:39', '2020-02-02 01:02:39', 3, NULL),
(105, 'slider-index', 'web', '2021-07-09 08:41:12', '2021-07-09 08:41:12', 3, NULL),
(106, 'slider-create', 'web', '2021-07-09 08:41:20', '2021-07-09 08:41:20', 3, NULL),
(107, 'slider-update', 'web', '2021-07-09 08:41:31', '2021-07-09 08:41:31', 3, NULL),
(108, 'slider-delete', 'web', '2021-07-09 08:41:40', '2021-07-09 08:41:40', 3, NULL),
(109, 'news-index', 'web', '2021-07-09 08:42:06', '2021-07-09 08:42:06', 3, NULL),
(110, 'news-create', 'web', '2021-07-09 08:42:15', '2021-07-09 08:42:15', 3, NULL),
(111, 'news-update', 'web', '2021-07-09 08:42:23', '2021-07-09 08:42:23', 3, NULL),
(112, 'news-delete', 'web', '2021-07-09 08:42:33', '2021-07-09 08:42:33', 3, NULL),
(113, 'pages-index', 'web', '2021-07-09 08:43:01', '2021-07-09 08:43:01', 3, NULL),
(114, 'pages-create', 'web', '2021-07-09 08:43:08', '2021-07-09 08:43:08', 3, NULL),
(115, 'pages-update', 'web', '2021-07-09 08:43:15', '2021-07-09 08:43:15', 3, NULL),
(116, 'pages-delete', 'web', '2021-07-09 08:43:22', '2021-07-09 08:43:22', 3, NULL),
(117, 'category-index', 'web', '2021-07-11 16:21:53', '2021-07-11 16:21:53', 3, NULL),
(118, 'category-create', 'web', '2021-07-11 16:22:01', '2021-07-11 16:22:01', 3, NULL),
(119, 'category-update', 'web', '2021-07-11 16:22:09', '2021-07-11 16:22:09', 3, NULL),
(120, 'category-delete', 'web', '2021-07-11 16:22:17', '2021-07-11 16:22:17', 3, NULL),
(121, 'tags-index', 'web', '2021-07-11 16:48:25', '2021-07-11 16:48:25', 3, NULL),
(122, 'tags-create', 'web', '2021-07-11 16:48:32', '2021-07-11 16:48:32', 3, NULL),
(123, 'tags-update', 'web', '2021-07-11 16:48:38', '2021-07-11 16:48:38', 3, NULL),
(124, 'tags-delete', 'web', '2021-07-11 16:48:45', '2021-07-11 16:48:45', 3, NULL),
(145, 'users_members-index', 'web', '2021-07-25 13:07:36', '2021-07-25 13:07:36', 3, NULL),
(146, 'users_members-create', 'web', '2021-07-25 13:07:41', '2021-07-25 13:07:41', 3, NULL),
(147, 'users_members-update', 'web', '2021-07-25 13:07:47', '2021-07-25 13:07:47', 3, NULL),
(148, 'users_members-delete', 'web', '2021-07-25 13:07:59', '2021-07-25 13:07:59', 3, NULL),
(149, 'users_members-activated', 'web', '2021-07-26 04:30:06', '2021-07-26 04:30:06', 3, NULL),
(150, 'bank-create', 'web', '2021-07-29 17:06:32', '2021-07-29 17:06:32', 3, NULL),
(151, 'bank-index', 'web', '2021-07-29 17:06:47', '2021-07-29 17:06:47', 3, NULL),
(152, 'bank-update', 'web', '2021-07-29 17:06:57', '2021-07-29 17:06:57', 3, NULL),
(153, 'bank-delete', 'web', '2021-07-29 17:07:05', '2021-07-29 17:07:05', 3, NULL),
(170, 'client-index', 'web', '2021-08-09 05:08:59', '2021-08-09 05:08:59', 3, NULL),
(171, 'client-create', 'web', '2021-08-09 05:09:06', '2021-08-09 05:09:06', 3, NULL),
(172, 'client-update', 'web', '2021-08-09 05:09:12', '2021-08-09 05:09:12', 3, NULL),
(173, 'client-delete', 'web', '2021-08-09 05:09:19', '2021-08-09 05:09:19', 3, NULL),
(174, 'testimonial-index', 'web', '2021-08-09 05:48:40', '2021-08-09 05:48:40', 3, NULL),
(175, 'testimonial-create', 'web', '2021-08-09 05:48:47', '2021-08-09 05:48:47', 3, NULL),
(176, 'testimonial-update', 'web', '2021-08-09 05:48:53', '2021-08-09 05:48:53', 3, NULL),
(177, 'testimonial-delete', 'web', '2021-08-09 05:48:59', '2021-08-09 05:48:59', 3, NULL),
(190, 'wilayah_provinsi-index', 'web', '2022-01-10 05:13:30', '2022-01-10 05:15:49', 3, 3),
(191, 'wilayah_regencies-index', 'web', '2022-01-10 05:14:17', '2022-01-10 05:16:01', 3, 3),
(192, 'wilayah_districts-index', 'web', '2022-01-10 05:14:24', '2022-01-10 05:16:12', 3, 3),
(193, 'wilayah_villages-index', 'web', '2022-01-10 05:14:32', '2022-01-10 05:16:24', 3, 3),
(194, 'inbox-index', 'web', '2022-01-10 16:54:09', '2022-01-10 16:54:09', 3, NULL),
(195, 'inbox-show', 'web', '2022-01-10 17:14:27', '2022-01-10 17:14:27', 3, NULL),
(228, 'infobox-index', 'web', '2022-06-27 09:16:46', '2022-06-27 09:16:46', 3, NULL),
(229, 'infobox-update', 'web', '2022-06-27 09:16:54', '2022-06-27 09:16:54', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persentasi_penghasilan` int(11) DEFAULT '0',
  `deskripsi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `persentasi_penghasilan`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'superadministrator', 'web', 0, 'Super administrator', NULL, '2020-08-27 03:28:56'),
(3, 'admin-konten', 'web', 0, 'for admin konten', '2020-08-27 03:10:44', '2022-05-26 17:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(228, 1),
(229, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_setting` enum('general','system') COLLATE utf8mb4_unicode_ci DEFAULT 'general',
  `name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `type_setting`, `name`, `value`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(2, 'general', 'app_name', 'DPR - Perisai Management Sistem', 'Application Name', NULL, '2022-07-07 08:51:00', NULL, 3, 1),
(3, 'general', 'app_desc', 'Perisai Management Sistem - DRPRI', 'web description', NULL, '2022-07-07 08:51:17', NULL, 3, 1),
(4, 'general', 'office_name', 'DPRRI - Indonesia', 'Office name', NULL, '2022-07-07 08:51:36', NULL, 3, 1),
(5, 'general', 'office_address', 'Jakarta Pusat, DKI Jakarta, Indonesia', 'Address', NULL, '2022-07-07 08:52:13', NULL, 3, 1),
(8, 'system', 'logo', '1657183721_perisai-logo.png', 'Untuk Logo System', NULL, '2022-07-07 08:48:41', NULL, 3, 1),
(12, 'system', 'dashboard_mode', 'light-mode', 'Untuk Tema Dashboard', NULL, '2022-06-05 05:56:10', NULL, 3, 1),
(13, 'system', 'sidebar_mode', 'dark-sidebar', 'Untuk Mengganti Template Sidebar', NULL, '2022-05-11 16:42:07', NULL, 3, 1),
(14, 'system', 'dashboard_boxed', 'n', 'Untuk Bentuk Aplikasi (Mini / Full)', NULL, '2021-02-02 15:32:47', NULL, 3, 1),
(15, 'general', 'twitter_link', '#', 'twitter_link', NULL, '2022-07-07 08:52:21', NULL, 3, 1),
(16, 'general', 'facebook_link', '#', 'facebook_link', NULL, '2022-07-07 08:52:27', NULL, 3, 1),
(17, 'general', 'whatsapp_link', 'https://wa.me/+6287887177736', 'whatsapp_link', NULL, '2022-06-01 03:37:31', NULL, 3, 1),
(18, 'general', 'instagram_link', '#', 'instagram_link', NULL, '2022-07-07 08:52:40', NULL, 3, 1),
(19, 'general', 'address_link', '#', 'address_link', NULL, '2021-12-11 08:16:06', NULL, 3, 1),
(20, 'general', 'email_link', '#', 'address_link', NULL, '2022-07-07 08:52:46', NULL, 3, 1),
(21, 'general', 'linkedin_link', '#', 'linkedin_link', NULL, '2022-07-07 08:52:55', NULL, 3, 1),
(22, 'general', 'phone_link', '+6287887177736', 'phone_link', NULL, '2022-01-27 17:43:06', NULL, 3, 1),
(23, 'general', 'footer_text', 'Hak Cipta © 2021 Bidang Sistem Informasi dan Infrastruktur Teknologi Informasi - Pusat Teknologi Informasi', 'footer_text', NULL, '2022-07-07 08:53:16', NULL, 3, 1),
(25, 'general', 'front_app_title', 'Perisai Management Sistem - DRPRI', 'front_app_title', NULL, '2022-07-07 08:53:37', NULL, 3, 1),
(26, 'general', 'embed_maps', '#', NULL, NULL, '2022-01-27 17:38:08', NULL, 3, 1),
(30, 'system', 'meta_keywords', 'DPR - Perisai Management Sistem', 'meta_keywords', NULL, '2022-07-07 08:49:24', NULL, 3, 1),
(31, 'system', 'meta_description', 'DPR - Perisai Management Sistem', 'meta_description', NULL, '2022-07-07 08:49:36', NULL, 3, 1),
(32, 'system', 'meta_title', 'DPR - Perisai Management Sistem', 'meta title for default', NULL, '2022-07-07 08:49:49', NULL, 3, 1),
(33, 'system', 'future_image', '1657183819_perisai-logo.png', 'Untuk Future image Default', NULL, '2022-07-07 08:50:19', NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_code` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verified_status` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `moto` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1',
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `activation_code`, `email_verified_at`, `verified_status`, `password`, `images`, `moto`, `remember_token`, `created_at`, `updated_at`, `status`, `created_by`, `updated_by`) VALUES
(3, 'admin', 'admin@gmail.com', NULL, NULL, 1, '$2y$10$PZd/pUGE19mcaO0G.WXIJO5Ab2aP.77ezShX0lXQU/o7UJJI27DJG', 'perisai-logo.png', 'Hidup Adalah Pilihan', 'LgDeaYapQfshnhFdd5WTAwHihavuA0HsqsC9OlU7TTApslcnQr9K2qR82q9k', '2020-02-01 02:05:32', '2022-07-07 08:55:41', 1, NULL, NULL),
(37, 'jadir', 'jadirullah1@gmail.com', NULL, '2021-08-10 04:51:53', 1, '$2y$10$ew3Pma4BWf10XxSfv2eToOGNEemUU/RTST9mZwKBJssdU504Sa.s2', 'default.png', NULL, 'sq2jQwvenGcHT4901ZapQ1D8yxBgQFlNyyHjNufMdlj0F1VvVK2j5I9yZzgZ', '2021-08-10 04:51:21', '2022-01-27 17:48:49', 2, NULL, NULL),
(38, 'Mr bara', 'bara@gmail.com', 'nuaALOJCdeI9ehoYfUhX3o1WfTZS1duJwQP1KevFo8DzozXigH01OJkf9ujXbara@gmail.com', NULL, 0, '$2y$10$LWoYGFF1UwtkzhHWgfFEGuhHyeH4wnbGTmnGS6if9ozpDL149euUm', 'default.png', NULL, NULL, '2022-01-16 14:35:43', '2022-01-27 17:48:54', 2, NULL, NULL),
(39, 'fathur', 'sahrie36@gmail.com', '6t9OeyGXpdbWWLc9b1UQvR1wd3hNMAMPyLdpxtvJxF9NNwLplGUvesjmlpONsahrie36@gmail.com', NULL, 0, '$2y$10$8/TwvWddyLqsbtVLACDOAe8z5A2Y8x/yk4CoQKG/5CBsFOlYa3gPW', 'default.png', NULL, NULL, '2022-01-18 06:10:30', '2022-01-27 17:48:34', 2, NULL, NULL),
(40, 'jadir', 'jadirullah@gmail.com', NULL, '2022-01-25 02:51:23', 1, '$2y$10$2N90rEBZu5pzJXkB/y1qS.RQToD51FVAyL0LMQ4fjEaRCa12.o3/e', 'default.png', NULL, NULL, '2022-01-25 02:48:52', '2022-01-27 17:48:42', 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_blogs`
--
ALTER TABLE `kk_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_blog_descriptions`
--
ALTER TABLE `kk_blog_descriptions`
  ADD KEY `blog_descriptions_blog_id_index` (`blog_id`);

--
-- Indexes for table `kk_category`
--
ALTER TABLE `kk_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_client`
--
ALTER TABLE `kk_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_infobox`
--
ALTER TABLE `kk_infobox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_ms_contact`
--
ALTER TABLE `kk_ms_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_notification`
--
ALTER TABLE `kk_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_pages`
--
ALTER TABLE `kk_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_parent_id_index` (`parent_id`),
  ADD KEY `pages_lft_index` (`lft`),
  ADD KEY `pages_rgt_index` (`rgt`);

--
-- Indexes for table `kk_page_descriptions`
--
ALTER TABLE `kk_page_descriptions`
  ADD KEY `page_descriptions_page_id_index` (`page_id`);

--
-- Indexes for table `kk_slideshows`
--
ALTER TABLE `kk_slideshows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_slideshow_descriptions`
--
ALTER TABLE `kk_slideshow_descriptions`
  ADD KEY `slideshow_descriptions_slideshow_id_index` (`slideshow_id`);

--
-- Indexes for table `kk_subscribe`
--
ALTER TABLE `kk_subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_tags`
--
ALTER TABLE `kk_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_testimonial`
--
ALTER TABLE `kk_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `ms_agama`
--
ALTER TABLE `ms_agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_bank`
--
ALTER TABLE `ms_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_users_description`
--
ALTER TABLE `ms_users_description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kk_blogs`
--
ALTER TABLE `kk_blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kk_category`
--
ALTER TABLE `kk_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kk_client`
--
ALTER TABLE `kk_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kk_infobox`
--
ALTER TABLE `kk_infobox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kk_ms_contact`
--
ALTER TABLE `kk_ms_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kk_notification`
--
ALTER TABLE `kk_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kk_pages`
--
ALTER TABLE `kk_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kk_slideshows`
--
ALTER TABLE `kk_slideshows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kk_subscribe`
--
ALTER TABLE `kk_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kk_tags`
--
ALTER TABLE `kk_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kk_testimonial`
--
ALTER TABLE `kk_testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ms_agama`
--
ALTER TABLE `ms_agama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_bank`
--
ALTER TABLE `ms_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ms_users_description`
--
ALTER TABLE `ms_users_description`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kk_blog_descriptions`
--
ALTER TABLE `kk_blog_descriptions`
  ADD CONSTRAINT `blog_descriptions_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `kk_blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kk_page_descriptions`
--
ALTER TABLE `kk_page_descriptions`
  ADD CONSTRAINT `page_descriptions_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `kk_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kk_slideshow_descriptions`
--
ALTER TABLE `kk_slideshow_descriptions`
  ADD CONSTRAINT `slideshow_descriptions_slideshow_id_foreign` FOREIGN KEY (`slideshow_id`) REFERENCES `kk_slideshows` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
