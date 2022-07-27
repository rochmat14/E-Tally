-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 27, 2022 at 11:43 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `published_on` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kk_blogs`
--

INSERT INTO `kk_blogs` (`id`, `id_category`, `tags`, `published_on`, `slug`, `meta_keyword`, `meta_description`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'kemantapan menteri kelautan', '2022-07-29 00:00:00', 'kemantapan-menteri-kelautan', 'menteri kelautan ibu susi puja astuti memiliki prestasi besar dalam menangani dan mengelola sumber daya maritim indonesia', 'menteri kelautan ibu susi puja astuti memiliki prestasi besar dalam menangani dan mengelola sumber daya maritim indonesia', 1, 'kelautan.jpg', NULL, NULL),
(6, 4, 'jangan pakai narkoba', '2022-05-12 00:00:00', 'jangan-pakai-narkoba', '12:30', 'januhi narkoba dekati ibadah', 1, NULL, '2022-07-27 09:16:53', '2022-07-27 09:16:53'),
(7, 4, 'pahlawan tanpa tanda jasa', '2005-05-05 00:00:00', 'pahlawan-tanpa-tanda-jasa', 'guru adalalh pahlawan tanpa tanda jasa', 'tahukan kalian siapa saja yang termasuk kategori pahlawah selain pejuang kemerdekaan. yang benar itu adalah guru, guru adalah pahlawan tanpa tanda jasa', 1, NULL, '2022-07-27 09:21:10', '2022-07-27 09:46:49'),
(8, 4, 'pahlawan tanpa tanda jasa', '2005-05-05 00:00:00', 'pahlawan-tanpa-tanda-jasa', 'guru adalalh pahlawan tanpa tanda jasa', 'tahukan kalian siapa saja yang termasuk kategori pahlawah selain pejuang kemerdekaan. yang benar itu adalah guru, guru adalah pahlawan tanpa tanda jasa', 1, NULL, '2022-07-27 10:08:05', '2022-07-27 10:08:05'),
(9, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2022-07-27 10:10:28', '2022-07-27 10:10:28'),
(10, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2022-07-27 10:14:20', '2022-07-27 10:14:20');

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
(1, 'E - Telly Sistem Management | Maritime Bussines Connected', 'http://127.0.0.1:8000/login', '1657733456.png', 'on', NULL, '2022-07-13 17:30:56', NULL, 3);

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
-- Table structure for table `kk_ms_from_to`
--

CREATE TABLE `kk_ms_from_to` (
  `id` int(11) NOT NULL,
  `location` varchar(250) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kk_ms_from_to`
--

INSERT INTO `kk_ms_from_to` (`id`, `location`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Kapal', 'Kapal', NULL, NULL, NULL, NULL, 1),
(2, 'Dermaga', 'Dermaga', NULL, NULL, NULL, NULL, 1),
(3, 'Terminal', 'Terminal', NULL, NULL, NULL, NULL, 1),
(4, 'Jetty 1', 'Jetty 1', NULL, NULL, NULL, NULL, 1),
(5, 'XXX edited', 'ssss ddd', '2022-07-19 08:55:14', '2022-07-19 08:55:25', 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kk_ms_product`
--

CREATE TABLE `kk_ms_product` (
  `id` bigint(20) NOT NULL,
  `product_code` char(20) DEFAULT NULL,
  `product_name` varchar(500) DEFAULT NULL,
  `bill_of_lading_id` int(11) DEFAULT NULL,
  `product_satuan` int(11) DEFAULT NULL,
  `product_category` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status_product` enum('watlist','proses','finish') DEFAULT 'proses',
  `from_moving` varchar(200) DEFAULT NULL,
  `to_moving` varchar(200) DEFAULT NULL,
  `description_moving` varchar(500) DEFAULT NULL,
  `image_moving` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kk_ms_product`
--

INSERT INTO `kk_ms_product` (`id`, `product_code`, `product_name`, `bill_of_lading_id`, `product_satuan`, `product_category`, `total`, `status_product`, `from_moving`, `to_moving`, `description_moving`, `image_moving`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'PR-00001', 'Suzuki Pickup', 1, 1, 1, 200, 'finish', 'Ship Priok', 'Dermaga 01', 'Barang Good Moving', '1657871683.png', NULL, '2022-07-15 07:54:43', NULL, NULL, 1),
(3, 'PR-00002', 'Toyota Yaris', 1, 1, 1, 200, 'proses', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, '2', 'Truk Skania', 1, 1, 2, NULL, 'proses', NULL, NULL, NULL, NULL, '2022-07-15 19:11:06', '2022-07-15 19:11:06', 3, NULL, 1),
(5, '1508381314', 'Truk 3', 1, 2, 2, NULL, 'proses', NULL, NULL, NULL, NULL, '2022-07-15 19:12:34', '2022-07-15 19:12:34', 3, NULL, 1),
(7, 'SM0023', 'MITSHUBISI L300', 8, 2, 2, 500, 'proses', 'ship bau bau', 'degmage', 'good condition object', '/tmp/phpFvKqEx', '2022-07-27 03:51:19', '2022-07-27 03:51:19', NULL, NULL, 1),
(8, 'SM0023', 'MITSHUBISI L300', 8, 2, 2, 500, 'proses', 'ship bau bau', 'degmage', 'good condition object', '/tmp/phpLVYSAo', '2022-07-27 03:52:36', '2022-07-27 03:52:36', NULL, NULL, 1),
(9, 'SM02983', 'MITSHUBISI SPANDER', 8, 2, 2, 500, 'finish', 'ship bau bau', 'degmage', 'good condition object', '/tmp/phpfwTdY3', '2022-07-27 03:53:27', '2022-07-27 03:53:27', NULL, NULL, 1),
(10, 'SM0023451', 'HINO TRUCK1', 8, 21, 4, 12001, 'finish', 'japan1', 'tg. priok1', 'good condition object1', '134208-mac7.jpg', '2022-07-27 04:57:58', '2022-07-27 06:42:58', NULL, NULL, 1),
(11, 'SAM90837', 'TOYOTA AGYA DELUX', 8, 3, 2, 400, 'proses', 'japan', 'tg. priok', 'good condition object', '120238-apple_gradient.png', '2022-07-27 05:02:38', '2022-07-27 05:02:38', NULL, NULL, 1),
(12, 'SM002345', 'HINO TRUCK', 8, 2, 2, 200, 'proses', 'japan', 'tg. priok', 'good condition object', '132424-apple_grey.png', '2022-07-27 06:24:24', '2022-07-27 06:24:24', NULL, NULL, 1),
(13, 'SM002345', 'HINO TRUCK', 8, 2, 2, 200, 'proses', 'japan 1', 'tg. priok', 'good condition', '132558-da.jpg', '2022-07-27 06:25:58', '2022-07-27 06:40:04', NULL, NULL, 1),
(14, 'SM002345', 'HINO TRUCK', 8, 2, 2, 200, 'proses', 'japan', 'tg. priok', 'good condition object', '132726-linux-mint-logo.svg', '2022-07-27 06:27:26', '2022-07-27 06:27:26', NULL, NULL, 1),
(15, 'SM002345', 'HINO TRUCK', 8, 2, 2, 200, 'proses', 'japan', 'tg. priok', 'good condition object', '132917-da.jpg', '2022-07-27 06:29:17', '2022-07-27 06:29:17', NULL, NULL, 1),
(16, 'SM002345', 'HINO TRUCK', 8, 2, 2, 200, 'proses', 'japan', 'tg. priok', 'good condition', '133002-da.jpg', '2022-07-27 06:30:02', '2022-07-27 06:30:02', NULL, NULL, 1),
(17, 'AB707090', 'IZUZU FORKLIP DELUX', 1, 3, 4, 200, 'proses', 'KAIRO', 'MALAYSIA', 'keep safety myself DEFENCE', '155540-da.jpg', '2022-07-27 08:55:40', '2022-07-27 09:01:37', NULL, NULL, 1),
(18, 'AB0009', 'daihatsu ayla delux', 1, 2, 3, 90, 'proses', 'japan2', 'indonesia2', 'good condition2', '040455-cepot.jpg', '2022-07-27 21:02:57', '2022-07-27 21:04:55', NULL, NULL, 1),
(19, 'AB00001', 'honde pcx', 9, 3, 2, 30, 'proses', 'srilanka', 'priok', 'object safety right', '041302-mac11.jpg', '2022-07-27 21:11:08', '2022-07-27 21:13:02', NULL, NULL, 1);

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
-- Table structure for table `kk_tr_bill_of_lading`
--

CREATE TABLE `kk_tr_bill_of_lading` (
  `id` int(11) NOT NULL,
  `id_manfest` int(11) NOT NULL,
  `kode_bill_of_lading` varchar(20) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `transfer_to` varchar(200) DEFAULT NULL,
  `ship_name` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `date_of_bill` date DEFAULT NULL,
  `telly_man` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kk_tr_bill_of_lading`
--

INSERT INTO `kk_tr_bill_of_lading` (`id`, `id_manfest`, `kode_bill_of_lading`, `customer_id`, `transfer_to`, `ship_name`, `country`, `date_of_bill`, `telly_man`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'BL-0000001', 1, 'Dermaga1', 'Ship Container1', 'Panama1', '2001-01-01', 'Mr. Shuhaimin1', NULL, '2022-07-27 21:08:41', 1),
(2, 1, 'BL-00000029', 39, 'Port Belawan9', 'Ship Hopper9', 'Italia9', '2022-09-25', 'Mr. Amin9', NULL, '2022-07-26 04:34:01', 1),
(3, 1, 'BL-0000003', 1, 'Dermaga', 'Ship Tangker', 'Belanda', '2022-07-30', 'Mr. Amin', NULL, NULL, 1),
(5, 1, 'BL-0000004', 4, 'pelabuhan', 'ship container', 'boulivia', '2022-07-29', 'Mr. Amir', '2022-07-26 03:48:32', '2022-07-26 03:48:32', 1),
(6, 2, 'BL-00000012', 22, 'Dermaga2', 'Ship Container2', 'saudi arabian', '2022-07-30', 'Mr. Amin2', '2022-07-26 04:32:31', '2022-07-26 22:34:15', 1),
(7, 1, 'BL-00000022', 23, 'Dermaga2', 'Ship Hopper9', 'brazil', '2022-07-21', 'Mr. Amin3', '2022-07-26 09:36:06', '2022-07-26 09:36:06', 1),
(8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-26 21:26:21', '2022-07-26 21:26:21', 1),
(9, 1, 'm3', 3, 'palabuhan3', 'ship3', 'Panama3', '2003-03-03', 'Mr. Amin3', '2022-07-27 10:31:41', '2022-07-27 10:32:10', 1),
(10, 1, 'BL-00000017', 2, 'Dermaga', 'ship container', 'japan', '2022-07-31', 'Mr.Sudin', '2022-07-27 20:41:47', '2022-07-27 20:41:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kk_tr_manifest`
--

CREATE TABLE `kk_tr_manifest` (
  `id` int(11) NOT NULL,
  `kode_manifest` varchar(20) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `date_of` date DEFAULT NULL,
  `port_name` varchar(45) DEFAULT NULL,
  `vassel_id` int(10) NOT NULL,
  `ship_agent_id` int(10) NOT NULL,
  `stevedoring_id` int(10) NOT NULL,
  `voy` varchar(225) NOT NULL,
  `berth_no` varchar(225) NOT NULL,
  `berthed_on` varchar(225) NOT NULL,
  `berthed_on_hours` time NOT NULL,
  `departed_on` date NOT NULL,
  `departed_on_hours` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kk_tr_manifest`
--

INSERT INTO `kk_tr_manifest` (`id`, `kode_manifest`, `country`, `id_customer`, `date_of`, `port_name`, `vassel_id`, `ship_agent_id`, `stevedoring_id`, `voy`, `berth_no`, `berthed_on`, `berthed_on_hours`, `departed_on`, `departed_on_hours`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'MNFS00001', 'Arab Saudi', 1, '2022-05-22', 'Tanjung Priok', 0, 0, 0, '', '', '', '00:00:00', '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL, 1),
(2, 'MNFS00002', 'Inggris', 2, '2022-07-01', 'Ciwandan Banten', 14, 6, 4, 'bread ship', 'saudi arabia', 'bau bau', '00:00:00', '2022-07-30', '00:00:00', NULL, '2022-07-26 21:07:29', NULL, NULL, 1),
(4, 'NMY000031', 'japan1', 31, '2022-07-31', 'blinyu1', 16, 3, 3, 'distric1', 'japan dermage1', 'blinyu1', '01:34:00', '2022-07-31', '14:30:00', '2022-07-26 01:28:16', '2022-07-26 02:43:23', NULL, NULL, 1),
(5, 'MSI0012', 'brazil2', 52, '2022-02-02', 'buton2', 16, 3, 3, 'meratus2', 'dermage braze2', 'bau bau2', '02:39:00', '2022-03-31', '02:46:00', '2022-07-26 02:46:55', '2022-07-26 02:50:03', NULL, NULL, 1),
(6, 'MNSF00003', 'japan', 31, '2022-07-29', 'buton', 13, 5, 2, 'meratus', 'dermage braze', 'blinyu', '02:02:00', '2022-07-30', '01:00:00', '2022-07-26 09:01:43', '2022-07-26 09:01:43', NULL, NULL, 1),
(7, 'MNSF000039', 'saudi arabia9', 2, '2009-09-09', 'blinyu9', 18, 6, 7, 'derstac9', 'dermage braze9', 'bau bau9', '09:00:00', '2008-09-09', '09:00:00', '2022-07-27 10:27:43', '2022-07-27 10:30:33', NULL, NULL, 1),
(8, 'MNS00002', 'carabia2', 3, '2002-02-02', 'blinyu2', 18, 6, 7, 'meratus2', 'dermage priok2', 'bau bau2', '02:02:00', '2012-02-02', '14:02:00', '2022-07-27 20:23:21', '2022-07-27 20:28:52', NULL, NULL, 1);

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
(2, 'Mandiri Syariah', '00000001', 'PT Angin', '1657184935.png', '2021-07-29 18:11:05', '2022-07-13 17:34:39', 3, 3, 1),
(3, 'BTN', '0102010928019', 'Gunawan LC', '1628367345.png', '2021-08-07 20:15:45', '2022-01-27 17:49:44', 3, 3, 0),
(4, 'BCA', '1019028190', 'Gunawan LC', '1628367396.jpg', '2021-08-07 20:16:36', '2022-01-27 17:49:41', 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ms_customer`
--

CREATE TABLE `ms_customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ms_customer`
--

INSERT INTO `ms_customer` (`id`, `customer_name`, `phone`, `address`, `email`, `logo`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'PT Indo Istime Samudra', '021020102', 'Tanjung Priok, Jakarta, Indonesia', 'istimewa@gmail.com', 'logo.png', NULL, NULL, NULL, NULL, 1),
(2, 'PT Multi Samudra Lautan', '0210200102', 'Bekasi, jawa Barat, Indonesia', 'multi@gmail.com', 'logo.png', NULL, NULL, NULL, NULL, 1),
(3, 'PT JNE Indonesia', '02219120890', 'Bandung, Jawa Barat, Indonesia', 'bandung@gmail.com', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_product_category`
--

CREATE TABLE `ms_product_category` (
  `id` int(11) NOT NULL,
  `category_product` varchar(150) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ms_product_category`
--

INSERT INTO `ms_product_category` (`id`, `category_product`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'Cair', 'Cair', NULL, '2022-07-15 10:15:58', NULL, 3, 1),
(2, 'Padat', 'Padat', NULL, '2022-07-15 10:16:25', NULL, 3, 1),
(3, 'Gas', 'Gas', NULL, '2022-07-15 10:16:40', NULL, 3, 1),
(4, 'Danger Goods', 'Danger Goods', NULL, '2022-07-15 10:16:34', NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_satuan`
--

CREATE TABLE `ms_satuan` (
  `id` int(11) NOT NULL,
  `satuan_name` varchar(150) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ms_satuan`
--

INSERT INTO `ms_satuan` (`id`, `satuan_name`, `description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`) VALUES
(1, 'PCS', 'PCS', NULL, '2022-07-15 08:54:35', NULL, 3, 1),
(2, 'LUSIN', 'Lusin', NULL, '2022-07-15 08:54:21', NULL, 3, 1),
(3, 'GROS', 'Gros', NULL, '2022-07-15 08:54:00', NULL, 3, 1),
(4, 'KODI', 'Kodi', NULL, '2022-07-15 08:54:08', NULL, 3, 1),
(5, 'Liter', 'Liter', '2022-07-15 08:49:06', '2022-07-15 08:49:06', 3, NULL, 1),
(6, 'BOX', 'Box', '2022-07-15 08:54:29', '2022-07-15 08:54:29', 3, NULL, 1);

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
-- Table structure for table `ms_volume`
--

CREATE TABLE `ms_volume` (
  `id` int(11) NOT NULL,
  `jenis_volume` varchar(150) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(229, 'infobox-update', 'web', '2022-06-27 09:16:54', '2022-06-27 09:16:54', 3, NULL),
(230, 'satuan-index', 'web', '2022-07-15 08:28:55', '2022-07-15 08:28:55', 3, NULL),
(231, 'satuan-create', 'web', '2022-07-15 08:28:59', '2022-07-15 08:28:59', 3, NULL),
(232, 'satuan-update', 'web', '2022-07-15 08:29:04', '2022-07-15 08:29:04', 3, NULL),
(233, 'satuan-delete', 'web', '2022-07-15 08:29:09', '2022-07-15 08:29:09', 3, NULL),
(234, 'product_category-index', 'web', '2022-07-15 08:56:03', '2022-07-15 08:56:03', 3, NULL),
(235, 'product_category-create', 'web', '2022-07-15 08:56:08', '2022-07-15 08:56:08', 3, NULL),
(236, 'product_category-update', 'web', '2022-07-15 08:56:13', '2022-07-15 08:56:13', 3, NULL),
(237, 'product_category-delete', 'web', '2022-07-15 08:56:18', '2022-07-15 08:56:18', 3, NULL),
(238, 'location-index', 'web', '2022-07-19 08:38:03', '2022-07-19 08:38:03', 3, NULL),
(239, 'location-create', 'web', '2022-07-19 08:38:09', '2022-07-19 08:38:09', 3, NULL),
(240, 'location-update', 'web', '2022-07-19 08:38:14', '2022-07-19 08:38:14', 3, NULL),
(241, 'location-delete', 'web', '2022-07-19 08:38:20', '2022-07-19 08:38:20', 3, NULL),
(243, 'ship_agent-index', 'web', '2022-07-25 16:11:36', '2022-07-26 05:47:42', 1, 3),
(244, 'vassel-index', 'web', '2022-07-26 01:11:17', '2022-07-26 01:11:17', 3, NULL),
(245, 'manifest-create', 'web', '2022-07-26 01:42:14', '2022-07-26 01:42:14', 3, NULL),
(246, 'stevedoring-index', 'web', '2022-07-26 18:34:28', '2022-07-26 18:37:12', 3, 3);

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
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(1, 1),
(194, 1),
(195, 1),
(228, 1),
(229, 1),
(238, 1),
(239, 1),
(240, 1),
(241, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(234, 1),
(235, 1),
(236, 1),
(237, 1),
(16, 1),
(17, 1),
(6, 1),
(7, 1),
(8, 1),
(230, 1),
(231, 1),
(232, 1),
(233, 1),
(18, 1),
(19, 1),
(243, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(246, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(14, 1),
(15, 1),
(244, 1),
(192, 1),
(190, 1),
(191, 1),
(193, 1);

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
(2, 'general', 'app_name', 'E - Telly Sistem Management | Maritime Bussines Connected', 'Application Name', NULL, '2022-07-13 17:28:02', NULL, 3, 1),
(3, 'general', 'app_desc', 'E - Telly Sistem Management | Maritime Bussines Connected', 'web description', NULL, '2022-07-13 17:28:07', NULL, 3, 1),
(4, 'general', 'office_name', 'Tanjung Priok - Jakarta Utara - Indonesia', 'Office name', NULL, '2022-07-13 17:28:22', NULL, 3, 1),
(5, 'general', 'office_address', 'Tanjung Priok - Jakarta Utara - Indonesia', 'Address', NULL, '2022-07-13 17:28:32', NULL, 3, 1),
(8, 'system', 'logo', '1657733158_telly.png', 'Untuk Logo System', NULL, '2022-07-13 17:25:58', NULL, 3, 1),
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
(23, 'general', 'footer_text', 'Hak Cipta © 2022 E-Telly Indonesia', 'footer_text', NULL, '2022-07-13 17:29:12', NULL, 3, 1),
(25, 'general', 'front_app_title', 'E - Telly Sistem Management | Maritime Bussines Connected', 'front_app_title', NULL, '2022-07-13 17:29:32', NULL, 3, 1),
(26, 'general', 'embed_maps', '#', NULL, NULL, '2022-01-27 17:38:08', NULL, 3, 1),
(30, 'system', 'meta_keywords', 'E - Telly Sistem Management | Maritime Bussines Connected', 'meta_keywords', NULL, '2022-07-13 17:27:01', NULL, 3, 1),
(31, 'system', 'meta_description', 'E - Telly Sistem Management | Maritime Bussines Connected', 'meta_description', NULL, '2022-07-13 17:27:11', NULL, 3, 1),
(32, 'system', 'meta_title', 'E - Telly Sistem Management | Maritime Bussines Connected', 'meta title for default', NULL, '2022-07-13 17:27:22', NULL, 3, 1),
(33, 'system', 'future_image', '1657733255_telly.png', 'Untuk Future image Default', NULL, '2022-07-13 17:27:35', NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ship_agents`
--

CREATE TABLE `ship_agents` (
  `id` bigint(20) NOT NULL,
  `nama_perusahaan` varchar(225) NOT NULL,
  `telp` bigint(14) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ship_agents`
--

INSERT INTO `ship_agents` (`id`, `nama_perusahaan`, `telp`, `alamat`, `email`, `created_at`, `updated_at`) VALUES
(5, 'pt mekar jaya', 8178781716, 'jl. kayu waringin jaya', 'mekar_jaya@yahoo.com', '2022-07-26 07:25:03', '2022-07-26 07:25:03'),
(6, 'pt. berjaya niaga sakti', 812739283, 'jl. ahmad sukarjo', 'berjaya_niaga_sakti@gmail.com', '2022-07-26 07:26:25', '2022-07-26 07:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `stevedoring`
--

CREATE TABLE `stevedoring` (
  `id` bigint(20) NOT NULL,
  `nama_perusahaan` varchar(225) NOT NULL,
  `telp` bigint(14) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stevedoring`
--

INSERT INTO `stevedoring` (`id`, `nama_perusahaan`, `telp`, `alamat`, `email`, `created_at`, `updated_at`, `status`) VALUES
(2, 'jaya setia', 8080, 'jl. rengas bandung', 'jayasetia@yahoo.com', '2022-07-25 15:33:02', '2022-07-25 15:33:02', 0),
(3, 'media tama artamajaya', 812783927, 'jl. sukai harjo', 'media.tama.artamajaya@gmail.com', '2022-07-25 23:58:01', '2022-07-25 23:58:01', 0),
(4, 'pt. maju jaya', 9082738, 'jl. siliwangi', 'maju_jaya@gmail.com', '2022-07-26 08:51:03', '2022-07-26 08:51:03', 0),
(5, 'pt. aditya sejahtra', 8918273829, 'jl. cibitung', 'aditya_sejahtra@gmaii.com', '2022-07-26 08:51:06', '2022-07-26 08:51:06', 0),
(6, 'pt. akina saya', 89208379, 'jl. dua dua', 'akina_saya@gmail.com', '2022-07-26 08:44:57', '2022-07-26 08:44:57', 1),
(7, 'pt. sampurna mild', 8121212, 'jl. blitar', 'sampurna@yahoo.com', '2022-07-27 10:26:02', '2022-07-27 10:26:02', 1),
(8, 'pt. perkasa utama', 81234, 'jl. teuku umar', 'perkasa.utama@gmail.com', '2022-07-27 21:38:43', '2022-07-27 21:38:43', 0);

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
(3, 'admin', 'admin@gmail.com', NULL, NULL, 1, '$2y$10$PZd/pUGE19mcaO0G.WXIJO5Ab2aP.77ezShX0lXQU/o7UJJI27DJG', 'telly.png', 'Hidup Adalah Pilihan', 'ZmVkMrcJZrPbVF1D2ftCEAH1JTAVJaRYnBM9HBqLMxvyMhQiiJsevjwj38sK', '2020-02-01 02:05:32', '2022-07-13 17:30:16', 1, NULL, NULL),
(37, 'jadir', 'jadirullah1@gmail.com', NULL, '2021-08-10 04:51:53', 1, '$2y$10$ew3Pma4BWf10XxSfv2eToOGNEemUU/RTST9mZwKBJssdU504Sa.s2', 'default.png', NULL, 'sq2jQwvenGcHT4901ZapQ1D8yxBgQFlNyyHjNufMdlj0F1VvVK2j5I9yZzgZ', '2021-08-10 04:51:21', '2022-01-27 17:48:49', 2, NULL, NULL),
(38, 'Mr bara', 'bara@gmail.com', 'nuaALOJCdeI9ehoYfUhX3o1WfTZS1duJwQP1KevFo8DzozXigH01OJkf9ujXbara@gmail.com', NULL, 0, '$2y$10$LWoYGFF1UwtkzhHWgfFEGuhHyeH4wnbGTmnGS6if9ozpDL149euUm', 'default.png', NULL, NULL, '2022-01-16 14:35:43', '2022-01-27 17:48:54', 2, NULL, NULL),
(39, 'fathur', 'sahrie36@gmail.com', '6t9OeyGXpdbWWLc9b1UQvR1wd3hNMAMPyLdpxtvJxF9NNwLplGUvesjmlpONsahrie36@gmail.com', NULL, 0, '$2y$10$8/TwvWddyLqsbtVLACDOAe8z5A2Y8x/yk4CoQKG/5CBsFOlYa3gPW', 'default.png', NULL, NULL, '2022-01-18 06:10:30', '2022-01-27 17:48:34', 2, NULL, NULL),
(40, 'jadir', 'jadirullah@gmail.com', NULL, '2022-01-25 02:51:23', 1, '$2y$10$2N90rEBZu5pzJXkB/y1qS.RQToD51FVAyL0LMQ4fjEaRCa12.o3/e', 'default.png', NULL, NULL, '2022-01-25 02:48:52', '2022-01-27 17:48:42', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vassels`
--

CREATE TABLE `vassels` (
  `id` bigint(20) NOT NULL,
  `nama_kapal` varchar(225) NOT NULL,
  `gt` varchar(225) NOT NULL,
  `loa` varchar(225) NOT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vassels`
--

INSERT INTO `vassels` (`id`, `nama_kapal`, `gt`, `loa`, `photo`, `created_at`, `updated_at`, `status`) VALUES
(13, 'siguntang', '9000', '12000', '050511-apple_gradient.png', '2022-07-25 22:05:11', '2022-07-25 22:05:11', 0),
(14, 'kelud', '9000', '12000', '044717-linux-mint-logo.svg', '2022-07-25 21:47:17', '2022-07-25 21:47:17', 0),
(15, 'juru semeru', '100', '2000', '064745-apple_grey.png', '2022-07-25 23:49:43', '2022-07-25 23:49:43', 0),
(16, 'serimau', '100', '200', '065020-cepot.jpg', '2022-07-26 07:55:45', '2022-07-26 07:55:45', 0),
(17, 'km. bukit raya', '5200', '900', '145831-apple_grey.png', '2022-07-26 07:58:31', '2022-07-26 07:58:31', 1),
(18, 'km. bukit raya', '200000', '9000', '150412-cepot.jpg', '2022-07-26 08:04:27', '2022-07-26 08:04:27', 0),
(19, 'km. situ baruang', '21', '22', '043054-cepot.jpg', '2022-07-27 21:30:54', '2022-07-27 21:30:54', 1),
(20, 'km. bukir raya', '100', '110', '043144-apple_gradient.png', '2022-07-27 21:31:48', '2022-07-27 21:31:48', 0);

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
-- Indexes for table `kk_ms_from_to`
--
ALTER TABLE `kk_ms_from_to`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_ms_product`
--
ALTER TABLE `kk_ms_product`
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
-- Indexes for table `kk_tr_bill_of_lading`
--
ALTER TABLE `kk_tr_bill_of_lading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kk_tr_manifest`
--
ALTER TABLE `kk_tr_manifest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ship_agents`
--
ALTER TABLE `ship_agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stevedoring`
--
ALTER TABLE `stevedoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vassels`
--
ALTER TABLE `vassels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kk_blogs`
--
ALTER TABLE `kk_blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kk_ms_product`
--
ALTER TABLE `kk_ms_product`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kk_tr_bill_of_lading`
--
ALTER TABLE `kk_tr_bill_of_lading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kk_tr_manifest`
--
ALTER TABLE `kk_tr_manifest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `ship_agents`
--
ALTER TABLE `ship_agents`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stevedoring`
--
ALTER TABLE `stevedoring`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vassels`
--
ALTER TABLE `vassels`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
