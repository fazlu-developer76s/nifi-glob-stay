-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 02:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glob_stay`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_facilities_propery`
--

CREATE TABLE `add_facilities_propery` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL COMMENT 'properties.id',
  `facilities_id` int(11) NOT NULL COMMENT 'facilities.id',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_facilities_propery`
--

INSERT INTO `add_facilities_propery` (`id`, `property_id`, `facilities_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(2, 1, 2, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(3, 1, 3, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(4, 1, 4, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(5, 1, 5, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(6, 1, 6, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(7, 2, 1, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(8, 2, 2, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(9, 2, 3, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(10, 2, 4, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(11, 2, 8, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1),
(12, 2, 7, '2024-11-29 11:59:04', '2024-11-29 11:59:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `add_package_service`
--

CREATE TABLE `add_package_service` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL COMMENT 'packages.id',
  `service_id` int(11) NOT NULL COMMENT 'services.id',
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_package_service`
--

INSERT INTO `add_package_service` (`id`, `package_id`, `service_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, '2024-11-19 09:51:44', '2024-11-19 09:51:44'),
(2, 3, 2, 1, '2024-11-19 09:51:45', '2024-11-19 09:51:45'),
(3, 3, 4, 1, '2024-11-19 09:51:45', '2024-11-19 09:51:45'),
(4, 4, 1, 1, '2024-11-19 09:51:47', '2024-11-19 09:51:47'),
(5, 4, 2, 1, '2024-11-19 09:51:47', '2024-11-19 09:51:47'),
(6, 6, 1, 1, '2024-11-19 09:51:49', '2024-11-19 09:51:49'),
(7, 3, 12, 1, '2024-11-30 07:37:27', '2024-11-30 07:37:27'),
(8, 3, 11, 1, '2024-11-30 07:37:27', '2024-11-30 07:37:27'),
(9, 3, 10, 1, '2024-11-30 07:37:28', '2024-11-30 07:37:28'),
(10, 3, 9, 1, '2024-11-30 07:37:28', '2024-11-30 07:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `assignroutes`
--

CREATE TABLE `assignroutes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignroutes`
--

INSERT INTO `assignroutes` (`id`, `route_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 2, 1, '2024-10-29 09:35:02', '2024-10-29 09:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `used_for` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Collection, 2-Disbursement',
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Account, 2-UPI',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Deactive,3-delete,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `account_name`, `account_no`, `ifsc_code`, `bank_name`, `used_for`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Amit Kumar', '158222817455', 'INDB0000053', 'Indusland', 2, 2, 1, '2024-10-15 09:55:11', '2024-10-15 10:00:06'),
(2, 'amit Kumar', '158222817455', 'INDB0000053', 'Indusland', 2, 2, 1, '2024-10-15 09:55:11', '2024-10-15 10:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `type`, `image`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'home', 'banner/62LRCVTC1fUG35ddxli4CykKhp6II7LCTY0CV34X.png', 'Home', NULL, 1, '2024-11-27 10:29:48', '2024-12-01 11:05:47'),
(2, 'home', 'banner/9inXtWC3MjFThyJETWelb2TBzjbRviQpuvUgqJta.jpg', 'Home', NULL, 1, '2024-11-27 10:29:48', '2024-12-01 11:06:02'),
(3, 'home', 'banner/home_banner.png', 'Home', NULL, 1, '2024-11-27 10:29:48', '2024-11-27 10:29:52'),
(4, 'project', 'banner/home_banner.png', 'Projects', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development.', 1, '2024-11-27 10:29:48', '2024-11-27 10:29:52'),
(5, 'about ', 'banner/home_banner.png', 'About Us', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development.', 1, '2024-11-27 10:29:48', '2024-11-27 10:29:52'),
(6, 'contact', 'banner/home_banner.png', 'Contact Us', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development.', 1, '2024-11-27 10:29:48', '2024-12-01 11:04:21'),
(7, 'testimonial', 'banner/home_banner.png', 'Testimonials', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development.', 1, '2024-11-27 10:29:48', '2024-11-27 10:29:52'),
(8, 'blog', 'banner/UMqdukyctSPuth1x9THHQt89sCxfbiy6OAwqsbSb.jpg', 'Blogs', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development.', 1, '2024-11-27 10:29:48', '2024-12-01 11:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `posted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `short_content` text NOT NULL,
  `long_content` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `image`, `posted_at`, `short_content`, `long_content`, `status`, `created_at`, `updated_at`) VALUES
(1, '20 Way To Sell Your Product Faster', 'blog/blog.png', '2024-11-27 08:03:23', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that do not yet have content.', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that do not yet have content.', 1, '2024-11-27 08:03:23', '2024-11-27 08:03:26'),
(2, '20 Way To Sell Your Product Faster', 'blog/blog.png', '2024-11-27 08:03:23', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that do not yet have content.', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that do not yet have content.', 1, '2024-11-27 08:03:23', '2024-11-27 08:03:26'),
(3, '20 Way To Sell Your Product Faster', 'blog/blog.png', '2024-11-27 08:03:23', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that do not yet have content.', 'Lorem ipsum is a dummy or placeholder text commonly used in graphic design, publishing, and web development to fill empty spaces in a layout that do not yet have content.', 1, '2024-11-27 08:03:23', '2024-11-27 08:03:26'),
(4, 'First', 'blog/zPo1c9FKUaDvzn2RGCVfH5MIL021OZE3Cjf3WF4Z.jpg', '2024-12-03 10:44:00', 'first', 'second', 1, '2024-12-01 10:43:05', '2024-12-01 11:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,2-Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'For Sale', NULL, 1, '2024-11-27 07:18:02', '2024-11-30 07:34:30'),
(2, 'For Rent', NULL, 1, '2024-11-27 07:18:02', '2024-11-27 07:18:06'),
(3, 'Projects', NULL, 1, '2024-11-27 07:18:02', '2024-11-27 07:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `cms_settings`
--

CREATE TABLE `cms_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `map_link` text DEFAULT NULL,
  `footer_script` text DEFAULT NULL,
  `header_script` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms_settings`
--

INSERT INTO `cms_settings` (`id`, `name`, `logo`, `favicon`, `address`, `email`, `mobile`, `facebook`, `twitter`, `instagram`, `linkedin`, `map_link`, `footer_script`, `header_script`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Globstay', 'logos/RQ7NLVVELnjm7OKPwyZGECtMio4RMUrTBPP4mTKh.png', 'favicons/XRFjSjPapgQpcJxBWtDgDHSUt08dFIIAseKWsR9h.png', 'Assotech Business Cresterra, Tower-1, Office No-705, 7th Floor, Noida Uttar Pradesh 201304', 'fazlu.developer@gmail.com', '9266355086', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.google.com/maps/embed/v1/place?key=API_KEY&q=Space+Needle,Seattle+WA', 'klsdfkls', 'jjsdlksdfkl', '2024-10-16 10:32:37', '2024-12-02 07:01:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_url`
--

CREATE TABLE `dynamic_url` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynamic_url`
--

INSERT INTO `dynamic_url` (`id`, `url`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'lead.create', 'Add Lead', '2024-10-11 12:00:11', '2024-10-11 12:00:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emi_collections`
--

CREATE TABLE `emi_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` int(11) NOT NULL COMMENT 'loans.id',
  `agent_id` int(11) NOT NULL COMMENT 'users.id',
  `emi_amount` int(11) NOT NULL,
  `payment_mode` int(11) NOT NULL COMMENT 'payment modes.id',
  `reference_no` varchar(255) DEFAULT NULL,
  `emi_status` varchar(255) NOT NULL DEFAULT '1' COMMENT '1-Pending,2-Paid',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Deactive,3-delete,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `mobile_no`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'website fazlu', 'website.fazlu@gmail.com', '7428059960', 'Test Eqnuiry', 1, '2024-11-27 11:01:44', '2024-11-27 11:01:44'),
(2, 'website fazlu', 'website.fazlu@gmail.com', '7428059960', 'Test Eqnuiry', 1, '2024-11-28 12:08:14', '2024-11-28 12:08:14'),
(3, 'website fazlu', 'website.fazlu@gmail.com', '7428059960', 'Test Eqnuiry', 1, '2024-11-28 14:28:45', '2024-11-28 14:28:45'),
(4, 'website fazlu', 'website.fazlu@gmail.com', '7428059960', 'Test Eqnuiry', 1, '2024-11-28 14:29:16', '2024-11-28 14:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Free Wi-Fi', 'facilities/1fEzCLzTz0M6YnJYPQJsUerblOmkdtHx3imRA982.png', 1, '2024-11-29 11:57:34', '2024-12-02 11:56:55'),
(2, 'Bath', 'facilities/GDZiFQANcKo5L0qCjMI6Sd8nybaKrsGcDs92yEkY.png', 1, '2024-11-29 11:57:34', '2024-12-02 12:03:26'),
(3, 'Resturant', 'facilities/V8SdRovyfb0Apd5AjIYeREiOJeFzMGvJhkBbYQpI.png', 1, '2024-11-29 11:57:41', '2024-12-02 11:57:11'),
(4, 'Airport Transfer', 'facilities/4c8NElzPCpWN7VV1HW3G2hLTDyCZVouN1NYFL87X.png', 1, '2024-11-29 11:57:41', '2024-12-02 11:58:35'),
(5, 'Family Room', 'facilities/7jdvKIVBmJsBsLVK34ulBXlOJ69iVyIJvt3bkLVT.png', 1, '2024-11-29 11:57:42', '2024-12-02 11:57:47'),
(6, 'Kitchen', 'facilities/KiYI9CknkcK8Kgj3o5WV943cR9AxxLlKu0DFJmMJ.png', 1, '2024-11-29 11:57:42', '2024-12-02 11:57:36'),
(7, 'Luggage storage', 'facilities/sjuWn4G8lG5kMnGxKZ1z2LAweLkUZG5RukV8o465.png', 1, '2024-11-29 11:57:42', '2024-12-02 12:01:44'),
(8, 'Breakfast', 'facilities/OGVNvuix3bj5qZwzeP5D0jlk5wliuipEylGernZb.png', 1, '2024-11-29 11:57:42', '2024-12-02 11:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallaries`
--

CREATE TABLE `gallaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-InActive,3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallaries`
--

INSERT INTO `gallaries` (`id`, `image`, `created_at`, `updated_at`, `status`) VALUES
(1, 'gallary/wZYri1FKCFjqfsqz29tIKDMEEozIcni7DRKmw0Sv.png', '2024-12-02 08:04:32', '2024-12-02 08:04:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kycdatas`
--

CREATE TABLE `kycdatas` (
  `id` int(11) NOT NULL,
  `type` varchar(250) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `response` longtext DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kycdatas`
--

INSERT INTO `kycdatas` (`id`, `type`, `number`, `name`, `mobile`, `state`, `response`, `user_id`, `created_at`) VALUES
(1, 'aadhar', '889050479435', 'Amit Kumar', '8222817455', '7f7c99390ea5e0b62e075f8245b1463b', '{\"status\":\"success\",\"data\":{\"client_id\":\"aadhaar_v2_gjuvwdzApflyIizIMyHS\",\"full_name\":\"Amit Kumar\",\"aadhaar_number\":\"889050479435\",\"dob\":\"1997-06-27\",\"gender\":\"M\",\"address\":{\"country\":\"India\",\"dist\":\"Jhajjar\",\"state\":\"Haryana\",\"po\":\"Baghpur\",\"loc\":\"\",\"vtc\":\"Baghpur(129)\",\"subdist\":\"Beri\",\"street\":\"\",\"house\":\"\",\"landmark\":\"\"},\"face_status\":false,\"face_score\":-1,\"zip\":\"124201\",\"profile_image\":\"\\/9j\\/4AAQSkZJRgABAgAAAQABAAD\\/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL\\/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL\\/wAARCADIAKADASIAAhEBAxEB\\/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL\\/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6\\/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL\\/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6\\/9oADAMBAAIRAxEAPwDpwKCvFPxSkcVRI0LSbeakxSAUrgMIo2mpMZ600igBmKa2CcUrMqoTuHy9c9qwNV8TW9g7xgb5APunii4G8oyM0rEAc1iHxHa2tik1zIv7z7uzndxn\\/PasO88cKS4t4gFHIMxwT9AB\\/WncDs1IJqQjivPE8YXDgv5gVv7ojGP1zWlaeMvlCTxYI6vu4pXCx1hHNKBWZpuu2upvsi3bv904\\/OtcDimIgcVHtqdl5pAnFAEJGBmmd6nkX5aYEyaAK7qN9JipJF+akZKpCNgCl2mpAmBS4qCyPbRtqbyzSbcUgIgtUNT1G20y1ae4cKoOAO5PoK0mU4ry3x1qMk+oG2DfJCSuPU9z\\/n0oAqax4lubiZjC5WMnIHf9KwLi9muJS0+9j3JFV1kZchhvDcUiPLE4O7BB6EVNx2HfamHHJ9OajluXcg4+laMbJcRN5sA8zPDdMfhSyabG65jzwO3NLmQ7GYLllG0n34qwlwWRV4GOuasxaHLO3AKp\\/eNNm0OaL5o\\/mFL2kb2HyM6zwrLEZkZGVJFJDID9\\/pg+3U\\/X8K7yKcOMcbhXi1leT6bcbmQjjpkgV1mk+KEjkUyAjceSxyv59a0TIaO+bk9KcoyM1XtpxdKpRlIK53A5B+lXCAvA6VRJXk6GkU8CpHXIpmMCgCJhl6GGKk2800iqQmbm2gKM08ClwakobQVqQD2oIyOlAGXrGoxaTpst3LyFHC92J6CvHLn7RquoTzyg+ZK24nsM11\\/j6\\/abUI7GNjthG4j\\/AGj3\\/AfzNY9pAIoR\\/ePUmsak+VFwjdkdjp8duoO0bvpWjHYwynLQoT7rSxLk1ft0HTjNcM5ts64RRXXS7c4\\/cR8dPkFTCxRV+WNQPpWvBDGQMmpjbp1FZ3ZpZHPNbdtv6VVktsjFdLJAoz\\/Ws64iweBTWgNXOVvbFGUqyg5rGgYaTd\\/voRPbOMMp9Pb0NdZdoCOhNYt5b+YjKRXVSqPqc84Gzol\\/JplwoRzNZOAwPUrk9R+JAP8Avd8V3yncoIIIPIIrzTwqWmeW1aIyupX5M\\/eTIz\\/Q\\/hXpkETrCnmH59o3Y6ZxzXWtTlYhFMIqZl5qJxTsAzFNan5prVSYjdDZ96fxjkVGg4GakHSpKF4pCaWkOKBHl\\/jC3MfiQyN0kAI\\/lUEa8AHpW748jButOcdSWH6r\\/jWFM\\/kpkDJPSuaubUiwuFq7bjcRisiEXU+CIwPrV\\/7FqwjykcbDr8hzj865eTzOhTaOgt7V2TcCDT5LWePkA1i2N3qUGd+zGMYrp7O+EkYDgbj61EopGkZXM3ypnHQ1TuIGUYati61MISqqAa5jUby+kfCRjb\\/s96Iq4SlYrXCMpPpWXOoJJqxNLflDm2fnv0rLN4wl2TIyn3GK3hCxhKVzZ8HRBfE8hC\\/8sGPX3FejVwXhIY12RscG3I\\/8eWu7z713Q+E5ZbgwGajfGKeSO5qNzxVEkGcEimmntjNRmkhnQCnAj1puPeo2i3SK24jHYHrSYycU0kUtZ2tPLHpU7QyFJMABh16j+lDdlcLXOe8YoJ5rADqrsePw\\/wAKxJbfgSEZxTzNM22OcuWQnq2R9RU+DJHtA61w1ql9UddOnbRmSt7Kk6xRplz0FSf8JNqVpO9sYUDK\\/lmMk7s+ucdOP5VfXT3LjA\\/StWDR18smWOIseckDNZwlHqXKMuhVlluoLsQ30PlzHjAOQfp+dWILpYpzkZI4xUE9usGfLVc54OOBUEEYV+TkmonZ7FwTW5I03mXexskntUF3qv2O1NzFYtLErbfMYgLn\\/Io1BcAMOtSWttFdQlQFAYYZCMg04WvdkzvsjGHiGS988iyIWIZdkbIAzjNUXnivQQV57Gt+fSWtkdIVVI3+8qcA\\/UVlx2S28hITArS8ehnaVtTU8LKIriQk\\/NsA\\/DNdmpyK89Ny9sWaJmUldvydT7V1+hPcyaapumBcEgc5OPf3rrozurHNUjbU0jUbdac7YpjVsZjGFMNPOaaTQM36OlJS4J70hi1n6yVXTZGbOBjp9av7f0rM15DJpEw9NrfkwP8ASlJXTHHRnFXYMTQZx8ybqtWWOCaxr6RkvIAc7dpUfpWraHKL9K86a91HbB+8bcGzsOauR20kvVsL7VnWuAea37V02EHAOK5+p0X0MPVYBbRbifoPU1S061aZ9zjrVzWzM7o0IVimflNZEU+pwTBt0E0J5KxqVdfw5z+daJaaENpPU19S05Ejx14rO0uBmd488qc4qO81a9uFPkwZ6AtIdoH9aj0ma7TUYzK8Zxku0YKjp0568\\/yp8rsJyTehpyh0O1+R71RnEe05Fat3gsWzwR0rCu2IJFJBIzScXahe2Tj6c12ejhVsPMG7MjFjn16f0rg5G\\/0+FRyST\\/Ku\\/siBp9uB3jU\\/mK76K1ucVV6WJydzUrEfjQi4OaRvvfjXQYCHAFMp7dKZQB0Bx6UopgJzS55pFAzVQ1I7rOVOPmUjP4VebpkVRvxmE9uKAPNtcTY0EuW3I+CMcfnV6xlDqMGk1iIywSqBlhyPwrP06YlVIPI7VyVado6HRCep1du+MZ61Zm1AW0RJbnHQVlwT8DmlnjFwvJ5HSuNLU629NCN7xrlgFBy2eBTY0dH3CSMP6Fv8iqGy73FQVVeny9SKuW9pGV3STEEdt1apGS1JNQSSWPaxCA+rAGsqO5ktJFEinHqTWhPaR7SVnbPsc1lutx9zCunQZ4xTsJ6am8L8TRKQwPH5Vn3bZqOCDyOS3UdAeKjupcKfWo5ddB811qZ6Lv1RABnANeg2SbbSJCc7UC59cCuF0eMy3jSc9cV39qm2EZ9K9GnGyOKo7knQ03rT+Caa3ArQgY3OaYc07HHNMIoA3+tOxRzmlB4pFCVTvhmA1bbPaq9yhaIigDh7wfvmrnJydOu9x\\/1chJHtXWahbssrHFctq2Ln93HhthIJB79x+FZzStqXFmha3SuuQfpVkzE9G5rkba9ksm2ODgGti31COTBLD8a4pQs7o6Yz0sbUSl87TUkmnSygAHbmq1rcKD2xWkdUjhiyBuI7VC3NHaxmR6fNEx3uNw7Cop18ur7aqlwSxULnnArPu5VIJ3cU5Eq1iBp9q8mqE91ltq8sxwBVW6vkDlVOQO9Q6dFPqGrRBXEYHOWIAPtW1OGt2YSmdRo0flyKuc+prtIR+6Fczp9m0UwOcg9\\/fuD711CDCCu1HPIUjFMOKUk005JpiGmmGnMKYaQHQjFLxUggPqv50vkN6r+dMoipjYOc06eSK2AMsiqT0UcsfoByfwrKvtQkxJFBb3PQ7pUjLFAOrYHHTJ5PbHGRSbQFfUkV5FghGbiRsLngKO7Z9B6\\/X+6RXH67BFa6hHDHIJG+YswyQegHJ9l\\/nXU+HI4r2a5nuJ5XQLt8iRiHCZ6kNnaoPUg54z3rI8deZDqlrEoVIljOVjGATubGfUgHr71hOXQqO5zk9hFdIdww3ZhWJcWFxavwCV9RXSQt0qd4w68gGuZTcWdPKmccmoXUBwrnHcGpH1q6I6Ct6XSoJSTtGaqP4fiJ6sPxq1OLIcWjJXV7gDBAHPU019UnlQoTgH0rQfQEB4dqlg0eGNgx+Yj1p88RcrMy0sZrhgzAhPX1rt\\/C1jaxuJtpEiTxRs45wrEnpz3T0NZDqEXCjAFafhy6eKcoNxV5EZlzgEg\\/L78c\\/nQpNsmUbI6LxIv9lavDdqpSG6TqSgXzfTnGSR7jk5p8WrW7Qq75XIyQFJx+Qz+OMV0V5ajX9Ga0uUIaeNWhiMb7kfoGLDoPwGBXN6fZMbkK8uyQ5b50ywfJDY5ABG09jxyfStoTaWpk0W0nhnGYpUcf7LA04mpZINL+VZ4xbSbsFlyFAHckdB9T\\/jUcmmXMccb2lxHcQMud7njHruHb04xwckVopoViM0w1TXUSgU3dtLbKxwjuMq3GSc1dTbKgZGVgeRg1VwOja4jWTyly8uM+WnLfj6D3OB705IZLqPcz+XGxwBGecHHVjxyD\\/D3H3qx3J0\\/7Iib4led1cjjaitg\\/1OTz3JJp013ZQsbe7m\\/eI7lDPK0hKlsgEZbbwB+XfOKycn0KLc1nHbuZIlMUu7DPHw0gHAzknPPr145FUjYG6e1tUXEk5EhLsH8qPrkHHGcZ7ZAXjJNUpNXsWJkuL8OgLbYvljAA46uOcnjHJ2k9DkV0HhQz3U9zd3I3TXB3eYVZP3fUYDAnBIwCTyF46VDYDNSsY9yi3keCW0CiCRhlo\\/TcTnch555289RuC8J4mmN9PbOYhG0cZjkRRgI4dsjHbHH4Yr1XWI0FvgBmnIYQgDJ7ZBz1TpnPHQ8EKR5hrPmT6k3mspZQ5lHzZQqUTknqeVHvgHvWbd0VHRnPxZQ7T2q7G2RTZIMEHFKFZMEdK53qdUR7IKaUYZwxxU6gEcimsvoaVyrFV4znk0xlCirZjyailQ9hSuKxTMe881raBYTNdoI5jAZXwsgTfgKV39PZhzx1qskO1dzcVuWTTWGoaSJleGN3eMEJ98SAYz\\/wIJ+Xsa2p3uY1NEdhpnh2wms0uJLZjIg+VmmcMT0ySpx69Aaxtbu10nWVlDiP7SRJsjztEhHP8IDbgAc8fxDqa723VI7ZVBwiKM47AYrh\\/G7zWtr9ntFlmWO3j\\/dxysv8WAcDOSDj889q0g23qYMe9xaapAX8jeDxt2+ZnjuFzxWZYRKiLZRQtE3mKjvbnaFUuOSOhPL81ztprUAERurWW3m\\/5aSFSqqw6bcHOfyAH0FdHEJbiPzop5ZYiQhZGMmRgjlgMcbunPP141QHQ\\/2bZouxY2j6BimBvGAMNgcg45z6\\/TFC90mAGNbVSjBWJaMhSxHQYxt6Z5xnjqKmk1y3EUcnnxs74zFGPMbPdeDgHPHJqG61QeSZksr+Py\\/mLtbjCjuevpnmkmwMLVtVury9RJMbbeEszpeRgk45wcEc8cCl0mytpJebBZvLjVGBvUG5hnLcdcjB4\\/8A1XhpVjNqGpXGyRI0mSEjznx8zhS3X2JroLDTxYWsj29xIjGVlYKq4cqdgJyCeig9e5ptiOZvdFtLnzmWyKRC2lkUKwcgrt4BbqOeo\\/M1P4TvbbQrBoLeAxXM5LsbhxsI5C5I6dDj15yRwR0V7b7LSRhgBbOcf+g\\/4VyPmQ\\/Z4bW+VVjmBe0uSMCJgxDbvXpxnOM9D2l6oZ1MmrW6Q\\/abm5aSFkzuGFeVADkn+4nJ9\\/QD5i3Gaaya9r9zfz2qshUJCijasYGApwOevOAc+lLLZveSvpks6tiTzLm6iJfz2PKIvqPc9T2+UZ6PStM87T02KuzIPGdqkA8Z6sRyM9ugO4MaSVinZGHrWjS2IW6GGtJnIjOckfX1B5IPcdhWYIty4r1WW0i1PSntJV25XaQP4SOhGPoDXnU1q9ncvBKuGRsEVz1FZ3N6MrqzM5YipwaesBParmUYkcHFP2gVkzdFZbbjmmSWwzn0q2WROTURlDrx09qAGWVrvud8jMsUQ8x2UAkAHsD1OcDvyeeM101toIu7GddQhb\\/SEw27OUHVNmeSR1Izzk56AGl4c03+07l3mGLWBwWBBw7DnHpwD+vvXS3hk1KKbG+OCMkGUYDAjjCdgQcgk9OR6kdNNcqOOpK8tDm7DU7ZLaW0voLR7y2Xysi33tKpGBJncCOoB6nntnFRWCLNrF5tintVd4otjQLGjNkE\\/Lk5+4c4bpk8Vj6tfwwX5msLh3vrYl0liZ3U7Tzkv1z97jI575zW1pWpSaxeHUZ5Y4YkkjeGHcDyz7XY9+m76frWqM5WN6LS2W88yXyWLLtbyotgcf7WScn8ax9f0mKBGu7V3glilR5fLRUwjfKQCoBPQdTXTvOomwrFtpAIUbiCfUDpVPW0iurY27hxJKrImVITONwJOMfw1KbAw9O0+4aPYRJGxVZXklVQx3EkElcFvmV8g+taE\\/h+1kiMqRIJNpyqrhGJ77f\\/AK9RadcLcRxToikSuyMyuTukZRJ+SgEfjWs91CkQQTJvzt27hnPpVN6gYelXsct5JdPv8trlnZGXK+WAQTx6GUH8K0W1KG3trKGUSxYiUsgXDg454Pv+f8uUsrG5t9LhEb3cSPbFW2sCD5rNjoR\\/dUdK6+0tLqOFpEimZpDlmLgluwO4MpPHqKpoCS\\/1WOXTZ\\/Lsr0g2snSLkDHXHftXKRXMM+kpFLFfSMtvct5bwp8p3DBxjI65zXVXtpdHSrvzVI3W8pI+1SKRx9WH9PasawtJv7CTZGQDZ3Ryb2Q8ZXPbHXtSENm0RJUkFo0WmMScNPKdzLyCCCelLouvXGk3X9maxNDLagqkV9E4ZIyeAr46A46np345XqrG2nikkzO0TseRGQ35lgcn34\\/GsLxJpizx37SzGRoooiokjVgCzsCcACk7bDOiLNE7yZ27R82emB61zHimJPPju49u+YHeM9APunp14\\/p2pthqc2k2VvYXcfnsYYhaSKPkO7ICsP7wxx68dOpdc2UmZUuJGa6kQLsRuFPBAPvx27DripcbocXZ3OWkzjIB9hUKzE5yT16ippkYj5csSQBg5\\/Kq5iHmj\\/aHT\\/P+etc1jsUiwRuUHOfeoY23ShAVHIHJx\\/nr1prSmNGULu559varmkQb52uChMcJDMBjqTxnIPHueMCnGOopysjr7ea2g0FYkmVMKvmnIV16EnnAHQnJ4BJ5wCKy1Fz4rzbRpcJpEAX5Iysbz4xt+8RhRjjr789Mxx\\/wkN3NFE7IkUTmeSM4WdhgbVA92x1Iwe+SW7+z0+y8hCkQeJkAVZCXAXHQbs4roascZx02lixzbQ3LQNOHgWMqrsAysRkKxJzgDOPeqFlLqcumQxrdxtiGaILJCy5dmUD+Drhs\\/nXc3lnbQEMkGz50AERKAZYAn5SOxrmbLSrZYLq3hiLNDesq7zuGWDIvX\\/ax1zVJ3Qi5ave6hHE0moSszDzDFCqxtj1DHbkfnU19bSNYyss2uIY\\/m3PIpAA5PUjPA9avaZp1utoIniWQRM8SiT5wArFeAc46dquHS7AjH2G2\\/wC\\/S\\/4Urq4WPPLaeeyF5bC1WZrUsynztg2owblQcEtuA78L6its3N7PYPJ9rjEfBEccJaPHH8YBA\\/Oq+p6UltrFoF8kLcIqHaPkMiHaxI44AJPGK19PsIzpz2\\/mSuVygOSgOANpIHByu05PrVO24EdvaWiva20toiyyJAgdVGQ8YMh5\\/ED8a6wYUADt2oookCM7WWIWVRnmwuTgf8ArK01g2gxq33hZXXH\\/AANf8KKKOgHRxj\\/ST2+YVna7Zmaz1FlOD5KE\\/RWLf40UVK3GZVylpf6MYZEEiNZRHnuY1lY\\/quKbLDPaXAs7icEjLWsrLgzc5ZXP94cc985OTRRQwMHUsLfyMOjHeD9ef5\\/496oIpbLg7mIOGHQfhmiisZLU6YO6GSwmMkhRyvOD19\\/5Vc0+3kljg0+EMst2\\/wAr\\/wAIUKct+Azgep68YJRThuRUehseFLCKC0gJfZGtyyHI6AIsmT+MQ\\/Out0oj+y7MAjBgjYf98iiitWjEfqMnkwM67TKilkRjjcQOB+eK5lJRBf6qsaq2Cl2ST12MHI\\/HJoooitANWwnt7WS4tZbuHekuMFwCSVUk9e7Fq0JJ4osM0qKPUsBRRSA5XxLcWT6UVhkhZre73Elx0YFj36EsBWhps6XVyzeasgmiVwUGF3D5Wx+Hl\\/nRRT6Af\\/\\/Z\",\"has_image\":true,\"email_hash\":\"\",\"mobile_hash\":\"de3a5558a8b816e67887052aa5dfb883193b340f5222cd71810095f60c19637c\",\"raw_xml\":\"https:\\/\\/aadhaar-kyc-docs.s3.amazonaws.com\\/nerasoft\\/aadhaar_xml\\/943520241114161254745\\/943520241114161254745-2024-11-14-104254950715.xml?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAY5K3QRM5FYWPQJEB%2F20241114%2Fap-south-1%2Fs3%2Faws4_request&X-Amz-Date=20241114T104255Z&X-Amz-Expires=432000&X-Amz-SignedHeaders=host&X-Amz-Signature=a7910666e2761ce5400b27a51b4556740ad2de763c940f227df20e25a5bd7ea5\",\"zip_data\":\"https:\\/\\/aadhaar-kyc-docs.s3.amazonaws.com\\/nerasoft\\/aadhaar_xml\\/943520241114161254745\\/943520241114161254745-2024-11-14-104254822560.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAY5K3QRM5FYWPQJEB%2F20241114%2Fap-south-1%2Fs3%2Faws4_request&X-Amz-Date=20241114T104255Z&X-Amz-Expires=432000&X-Amz-SignedHeaders=host&X-Amz-Signature=d28082b4faffe88c5c2bc742873911f781d985adc0f78519942b0a6c4bad3d60\",\"care_of\":\"S\\/O: Ajit Singh\",\"share_code\":\"0882\",\"mobile_verified\":false,\"reference_id\":\"943520241114161254745\",\"aadhaar_pdf\":null,\"status\":\"success_aadhaar\",\"uniqueness_id\":\"ee58f364088d59d449330c7d622e51faf1ea83f3a7f98083de87d19613295f5c\"},\"timestamp\":\"2024-11-14T10:42:58.101090Z\",\"environment\":\"production\"}', NULL, '2024-11-14 10:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `kycs`
--

CREATE TABLE `kycs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'users.id',
  `loan_request_id` int(11) NOT NULL COMMENT 'loan_request.id',
  `aadhar_no` varchar(255) NOT NULL,
  `pan_no` varchar(255) NOT NULL,
  `kyc_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Pending,2-InProgress,3-Completed,4-Approved,5-Rejected',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Deactive,3-delete,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_leads`
--

CREATE TABLE `kyc_leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_request_id` int(11) NOT NULL COMMENT 'loan_requests.id',
  `user_id` int(11) DEFAULT NULL COMMENT 'user.id',
  `route_id` int(11) DEFAULT NULL COMMENT 'routes.id',
  `agent_id` int(11) DEFAULT NULL COMMENT 'users.id',
  `file_no` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `son_of` varchar(255) DEFAULT NULL,
  `type_of_work` varchar(255) DEFAULT NULL,
  `shop_address` text DEFAULT NULL,
  `shop_type` varchar(255) DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `home_type` varchar(255) DEFAULT NULL,
  `material_status` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `sms_no` varchar(255) DEFAULT NULL,
  `reference_1_name` varchar(255) DEFAULT NULL,
  `reference_1_mobile` varchar(255) DEFAULT NULL,
  `reference_1_relation` varchar(255) DEFAULT NULL,
  `reference_2_name` varchar(255) DEFAULT NULL,
  `reference_2_mobile` varchar(255) DEFAULT NULL,
  `reference_2_relation` varchar(255) DEFAULT NULL,
  `loan_amount` varchar(255) DEFAULT NULL,
  `processing_fees` varchar(255) DEFAULT NULL,
  `emi` varchar(255) DEFAULT NULL,
  `cheque` varchar(255) DEFAULT NULL,
  `aadhar_docs` varchar(255) DEFAULT NULL,
  `pan_docs` varchar(255) DEFAULT NULL,
  `aadhar_no` varchar(255) DEFAULT NULL,
  `pan_no` varchar(255) DEFAULT NULL,
  `elec_bill` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `business_pic` varchar(255) DEFAULT NULL,
  `gurn_docs` varchar(255) DEFAULT NULL,
  `side_verify` varchar(255) DEFAULT NULL,
  `rc_vehicle` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `kyc_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-pending,2-submitd,3-approved,4-rejected',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-InActive,3-Deleted,4-Permanent deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_leads`
--

INSERT INTO `kyc_leads` (`id`, `loan_request_id`, `user_id`, `route_id`, `agent_id`, `file_no`, `customer_name`, `son_of`, `type_of_work`, `shop_address`, `shop_type`, `home_address`, `home_type`, `material_status`, `mobile_no`, `sms_no`, `reference_1_name`, `reference_1_mobile`, `reference_1_relation`, `reference_2_name`, `reference_2_mobile`, `reference_2_relation`, `loan_amount`, `processing_fees`, `emi`, `cheque`, `aadhar_docs`, `pan_docs`, `aadhar_no`, `pan_no`, `elec_bill`, `photo`, `business_pic`, `gurn_docs`, `side_verify`, `rc_vehicle`, `remark`, `kyc_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2024-10-29 07:57:42', '2024-10-29 07:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_leads_guarantor`
--

CREATE TABLE `kyc_leads_guarantor` (
  `id` int(11) NOT NULL,
  `kyc_id` int(11) NOT NULL COMMENT 'kyc_leads.id',
  `name` varchar(255) NOT NULL,
  `son_of` varchar(255) NOT NULL,
  `type_of_work` varchar(255) NOT NULL,
  `shop_address` varchar(255) NOT NULL,
  `shop_type` varchar(255) NOT NULL,
  `mobile_no_1` varchar(255) NOT NULL,
  `mobile_no_2` varchar(255) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `land_load` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_processes`
--

CREATE TABLE `kyc_processes` (
  `id` int(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `aadhar_no` varchar(255) DEFAULT NULL,
  `aadhar_name` varchar(255) DEFAULT NULL,
  `aadhar_father_name` varchar(255) DEFAULT NULL,
  `aadhar_dob` varchar(255) DEFAULT NULL,
  `aadhar_zipcode` varchar(255) DEFAULT NULL,
  `aadhar_country` varchar(255) DEFAULT NULL,
  `aadhar_state` varchar(255) DEFAULT NULL,
  `aadhar_city` varchar(255) DEFAULT NULL,
  `aadhar_address` text DEFAULT NULL,
  `aadhar_profile_photo` text DEFAULT NULL,
  `aadhar_mobile_no` varchar(255) DEFAULT NULL,
  `is_aadhar_verified` tinyint(4) NOT NULL DEFAULT 2 COMMENT '	1-Verified,2-Non verified',
  `pan_no` varchar(255) DEFAULT NULL,
  `pan_name` varchar(255) DEFAULT NULL,
  `is_pan_verified` tinyint(4) NOT NULL DEFAULT 2 COMMENT 'is_pan_verified',
  `ifsc_code` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_holder_name` varchar(255) DEFAULT NULL,
  `is_bank_verified` tinyint(11) NOT NULL DEFAULT 2 COMMENT '1-Verified,2-Non verified	',
  `live_photo` varchar(555) DEFAULT NULL,
  `live_video` varchar(255) DEFAULT NULL,
  `kyc_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-submitted,2-pending,3-approved,4-rejected',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_processes`
--

INSERT INTO `kyc_processes` (`id`, `user_id`, `aadhar_no`, `aadhar_name`, `aadhar_father_name`, `aadhar_dob`, `aadhar_zipcode`, `aadhar_country`, `aadhar_state`, `aadhar_city`, `aadhar_address`, `aadhar_profile_photo`, `aadhar_mobile_no`, `is_aadhar_verified`, `pan_no`, `pan_name`, `is_pan_verified`, `ifsc_code`, `account_no`, `bank_name`, `account_holder_name`, `is_bank_verified`, `live_photo`, `live_video`, `kyc_status`, `created_at`, `updated_at`) VALUES
(6, 19, '123456789012', 'John Does', 'Father Name', '1990-01-01', '110001', 'India', 'Delhi', 'New Delhi', '123, Street Name, Locality', NULL, '9876543210', 1, 'ABCDE1234F', 'John Doe', 1, 'SBIN0000001', '1234567890', 'State Bank of India', 'John Doe', 1, NULL, NULL, 1, '2024-11-14 12:01:02', '2024-11-14 12:01:02'),
(7, 20, '123456789012', 'John Does', 'Father Name', '1990-01-01', '110001', 'India', 'Delhi', 'New Delhi', '123, Street Name, Locality', NULL, '9876543210', 1, 'ABCDE1234F', 'John Doe', 1, 'SBIN0000001', '1234567890', 'State Bank of India', 'John Doe', 1, 'kyc/2wiejTJAqDCjVgS330WRUMc2rtH0LXlHyk1ayElw.png', NULL, 1, '2024-11-14 12:07:37', '2024-11-14 12:18:49'),
(8, 1, '123456789012', 'John Does', 'Father Name', '1990-01-01', '110001', 'India', 'Delhi', 'New Delhi', '123, Street Name, Locality', NULL, '9876543210', 1, 'ABCDE1234F', 'John Doe', 1, 'SBIN0000001', '1234567890', 'State Bank of India', 'John Doe', 1, NULL, NULL, 1, '2024-11-20 13:06:09', '2024-11-20 13:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `kyc_reject_reasons`
--

CREATE TABLE `kyc_reject_reasons` (
  `id` int(11) NOT NULL,
  `kyc_id` int(11) NOT NULL COMMENT 'kyc_leads.id',
  `reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kyc_id` int(11) NOT NULL COMMENT 'kyc_leads.id',
  `user_id` int(11) DEFAULT NULL COMMENT 'users.id',
  `route_id` int(11) DEFAULT NULL COMMENT 'route.id',
  `loan_number` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `rate_of_interest` varchar(255) NOT NULL,
  `frequency` tinyint(4) NOT NULL DEFAULT 3 COMMENT '1-Day,2-Weekly,3-Monthly,4-Yearly',
  `tenure` varchar(255) NOT NULL,
  `process_charge` varchar(255) NOT NULL,
  `file_charge` varchar(255) NOT NULL,
  `other_charges_1` varchar(255) NOT NULL,
  `other_charges_2` varchar(255) NOT NULL,
  `other_charges_3` varchar(255) NOT NULL,
  `other_charges_4` varchar(255) NOT NULL,
  `other_charges_5` varchar(255) NOT NULL,
  `disbrused_amount` varchar(255) DEFAULT NULL,
  `emi_amount` varchar(255) DEFAULT NULL,
  `loan_start_date` varchar(255) DEFAULT NULL,
  `pending_amount` varchar(255) DEFAULT NULL,
  `loan_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Pending,2-Approvad but not disbursed,3-Disbursed,4-Reject,5-Closed',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-InActive,3-Deleted,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `kyc_id`, `user_id`, `route_id`, `loan_number`, `amount`, `rate_of_interest`, `frequency`, `tenure`, `process_charge`, `file_charge`, `other_charges_1`, `other_charges_2`, `other_charges_3`, `other_charges_4`, `other_charges_5`, `disbrused_amount`, `emi_amount`, `loan_start_date`, `pending_amount`, `loan_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '264784850942', '50000', '10', 1, '10', '10', '10', '10', '10', '10', '10', '10', '49940', '5,007.54', '2024-10-14', '50,075.40', 3, 1, '2024-10-14 05:17:35', '2024-10-14 05:17:35'),
(2, 1, 4, 1, '26771052699', '150000', '10', 2, '15', '5000', '1500', '2500', '3500', '1000', '500', '1500', '139500', '10,154.54', '2024-10-18', '152,318.10', 3, 1, '2024-10-15 12:12:07', '2024-10-15 12:12:07'),
(3, 7, 4, 7, '834722863097', '150000', '12', 3, '12', '1000', '100', '100', '100', '100', '100', '100', '149400', '13,327.32', '2024-09-01', '159,927.84', 3, 1, '2024-10-21 10:24:05', '2024-10-21 10:24:05'),
(4, 11, 4, 7, '7139577873', '150000', '12', 3, '12', '200', '200', '200', '200', '200', '200', '200', '148800', '13,327.32', '2024-11-01', '159,927.84', 3, 1, '2024-10-22 06:22:01', '2024-10-22 06:22:01'),
(5, 12, 4, 7, '290078504746', '150000', '12', 3, '12', '200', '200', '200', '200', '200', '200', '200', '148800', '13,327.32', '2024-10-22', '159,927.84', 2, 1, '2024-10-22 06:44:24', '2024-10-22 06:44:24'),
(6, 17, 2, 7, '552379870866', '100000', '12', 3, '12', '100', '100', '100', '100', '100', '100', '100', '99400', '8,884.88', '2024-11-01', '106,618.56', 2, 1, '2024-10-23 11:29:50', '2024-10-23 11:29:50'),
(7, 13, 4, 7, '899065274580', '150000', '12', 3, '12', '100', '100', '100', '100', '100', '100', '100', '149400', '13,327.32', '2024-11-01', '159,927.84', 2, 1, '2024-10-23 13:21:46', '2024-10-23 13:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `loan_disbursements`
--

CREATE TABLE `loan_disbursements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` int(11) NOT NULL,
  `disbursement_amount` varchar(255) NOT NULL,
  `disbursement_mode` int(11) NOT NULL COMMENT 'payment_modes.id',
  `image` varchar(255) DEFAULT NULL,
  `disbursement_date` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `loan_number` varchar(255) NOT NULL,
  `reference_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disbrused_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Pending,2-Success'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_disbursements`
--

INSERT INTO `loan_disbursements` (`id`, `loan_id`, `disbursement_amount`, `disbursement_mode`, `image`, `disbursement_date`, `remark`, `loan_number`, `reference_no`, `created_at`, `updated_at`, `disbrused_status`) VALUES
(2, 1, '139500', 1, '1728999785_1727348006_offline.jpg', '2024-10-15', 'business loan', '26771052699', NULL, '2024-10-15 13:11:46', '2024-10-15 14:00:01', 2),
(3, 2, '139500', 1, '1729056413_1727348006_offline.jpg', '2024-10-15', 'business loan', '26771052699', NULL, '2024-10-16 05:17:00', '2024-10-16 05:26:53', 2),
(4, 3, '149400', 1, '1729507105_12lDIFbQTiiEFj_KlUvRNg.jpeg', '2024-10-21', 'business loan', '834722863097', NULL, '2024-10-21 10:33:24', '2024-10-21 10:38:29', 2),
(5, 4, '149400', 1, '1729578346_app.jpg', '2024-10-22', 'business loan', '834722863097', NULL, '2024-10-22 06:24:47', '2024-10-22 06:31:54', 2);

-- --------------------------------------------------------

--
-- Table structure for table `loan_requests`
--

CREATE TABLE `loan_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'user.id',
  `service_no` int(11) DEFAULT NULL COMMENT 'providers.route	',
  `lead_create_date` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `work` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `work_address` text DEFAULT NULL,
  `cheque` varchar(255) DEFAULT NULL,
  `shop_thiya` varchar(255) DEFAULT NULL,
  `home_type` varchar(255) DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `file_hai` varchar(255) DEFAULT NULL,
  `loan_amount` varchar(255) NOT NULL,
  `tut` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `plus_day` varchar(255) DEFAULT NULL,
  `old_loan` varchar(255) DEFAULT NULL,
  `loan_type` varchar(255) DEFAULT NULL,
  `file_no` varchar(255) DEFAULT NULL,
  `ser_no` varchar(255) DEFAULT NULL,
  `rn_no` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `accountant_sign` varchar(255) DEFAULT NULL,
  `guarantor` varchar(255) DEFAULT NULL,
  `guarantor_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `reason_of_loan` varchar(255) DEFAULT NULL,
  `referal_name` varchar(255) DEFAULT NULL,
  `referal_mobile` varchar(255) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `loan_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-pending,2-viewed,3-Under Discussion,4-pending for kyc,5-qualified,6-rejected',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-InActive,3-Deleted,4-Permanent deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_requests`
--

INSERT INTO `loan_requests` (`id`, `user_id`, `service_no`, `lead_create_date`, `name`, `work`, `mobile`, `work_address`, `cheque`, `shop_thiya`, `home_type`, `home_address`, `file_hai`, `loan_amount`, `tut`, `balance`, `plus_day`, `old_loan`, `loan_type`, `file_no`, `ser_no`, `rn_no`, `amount`, `accountant_sign`, `guarantor`, `guarantor_name`, `address`, `zip_code`, `reason_of_loan`, `referal_name`, `referal_mobile`, `token`, `remark`, `loan_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '2024-10-29', 'Ayush Gupta', 'test', '7428059960', '9/10 Shyam Nagar  Ambala Cantt', 'Y', 'RENTED', 'OWN', 'Mohali Punjab', 'Y', '50000', '1200', '1400', '120', '500', 'New', '120', '121', '122', '5410', '123456789', 'N', 'Amit', NULL, NULL, NULL, NULL, NULL, NULL, 'first lead', 3, 1, '2024-10-28 06:06:21', '2024-10-28 06:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `is_read`, `created_at`, `updated_at`, `status`) VALUES
(3, 4, 5, 'Hi', 1, '2024-11-25 06:05:59', '2024-11-25 06:10:54', 1),
(4, 5, 4, 'Hello', 1, '2024-11-25 06:06:13', '2024-11-25 06:09:40', 1),
(5, 4, 5, 'Hello Hy', 1, '2024-11-25 06:06:23', '2024-11-25 06:10:54', 1),
(6, 5, 4, 'Hello By', 1, '2024-11-25 06:06:30', '2024-11-25 06:09:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_10_01_093153_create_role_models_table', 1),
(7, '2024_10_01_093231_create_roles_table', 1),
(8, '2024_10_03_174248_create_loan_requests_table', 2),
(9, '2024_10_07_170956_create_loans_table', 3),
(10, '2024_10_15_133013_create_payment_modes_table', 4),
(11, '2024_10_15_145619_create_banks_table', 5),
(12, '2024_11_13_134153_create_refers_table', 6),
(13, '2024_11_25_110246_create_messages_table', 7),
(14, '2024_11_27_124436_create_categories_modals_table', 8),
(15, '2024_11_27_131734_create_testimonals_table', 9),
(16, '2024_11_27_132653_create_blogs_table', 10),
(17, '2024_11_27_155622_create_banners_table', 11),
(18, '2024_11_27_160527_create_enquiries_table', 12),
(19, '2024_11_29_152408_create_properties_table', 13),
(20, '2024_11_29_165249_create_facilities_table', 14),
(21, '2024_11_29_165929_create_property_reviews_table', 15),
(22, '2024_12_02_115637_create_seos_table', 16),
(23, '2024_12_02_131916_create_gallaries_table', 17),
(24, '2024_12_02_133920_create_pages_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `loan_request_id` int(11) NOT NULL COMMENT 'loan_requests.id',
  `user_id` int(11) NOT NULL COMMENT 'users.id\r\n',
  `loan_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '	1-pending,2-viewed,3-Under Discussion,4-pending for kyc,5-qualified,6-rejected',
  `title` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `loan_request_id`, `user_id`, `loan_status`, `title`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 1, 1, 'Create Lead', '2024-10-14 05:14:48', '2024-10-14 05:14:48', 1),
(2, 1, 1, 2, 'View Lead', '2024-10-14 05:15:03', '2024-10-14 05:15:03', 1),
(3, 1, 1, 3, 'Under Disscussion', '2024-10-14 05:15:14', '2024-10-14 05:15:14', 1),
(4, 1, 1, 5, 'this lead qualified', '2024-10-14 05:15:30', '2024-10-14 05:15:30', 1),
(5, 2, 1, 1, 'Create Lead', '2024-10-15 07:05:40', '2024-10-15 07:05:40', 1),
(6, 2, 1, 2, 'View Lead', '2024-10-15 07:05:43', '2024-10-15 07:05:43', 1),
(7, 3, 2, 1, 'Create Lead', '2024-10-15 10:41:02', '2024-10-15 10:41:02', 1),
(8, 3, 1, 2, 'View Lead', '2024-10-15 10:41:11', '2024-10-15 10:41:11', 1),
(9, 3, 1, 3, 'Under Disscussion', '2024-10-15 10:41:17', '2024-10-15 10:41:17', 1),
(10, 3, 1, 5, 'Lead Qualfied', '2024-10-15 10:41:50', '2024-10-15 10:41:50', 1),
(11, 1, 2, 1, 'Create Lead', '2024-10-15 10:47:09', '2024-10-15 10:47:09', 1),
(12, 1, 1, 5, 'Lead Qualified', '2024-10-15 11:02:45', '2024-10-15 11:02:45', 1),
(13, 2, 2, 1, 'Create Lead', '2024-10-15 11:04:47', '2024-10-15 11:04:47', 1),
(14, 23, 1, 2, 'View Lead', '2024-10-18 07:42:00', '2024-10-18 07:42:00', 1),
(15, 23, 1, 3, 'Under Disscussion', '2024-10-18 07:42:03', '2024-10-18 07:42:03', 1),
(16, 35, 1, 2, 'View Lead', '2024-10-21 07:14:11', '2024-10-21 07:14:11', 1),
(17, 35, 1, 3, 'Under Disscussion', '2024-10-21 07:14:16', '2024-10-21 07:14:16', 1),
(18, 35, 1, 5, 'Done', '2024-10-21 07:14:25', '2024-10-21 07:14:25', 1),
(19, 34, 1, 2, 'View Lead', '2024-10-21 07:14:41', '2024-10-21 07:14:41', 1),
(20, 34, 1, 3, 'Under Disscussion', '2024-10-21 07:26:49', '2024-10-21 07:26:49', 1),
(21, 34, 1, 6, 'Wrong details', '2024-10-21 07:27:09', '2024-10-21 07:27:09', 1),
(22, 36, 1, 2, 'View Lead', '2024-10-21 07:51:48', '2024-10-21 07:51:48', 1),
(23, 36, 1, 3, 'Under Disscussion', '2024-10-21 07:52:16', '2024-10-21 07:52:16', 1),
(24, 36, 1, 5, 'Done', '2024-10-21 07:52:29', '2024-10-21 07:52:29', 1),
(25, 34, 1, 5, 'Check', '2024-10-21 09:42:51', '2024-10-21 09:42:51', 1),
(26, 37, 1, 2, 'View Lead', '2024-10-21 10:05:13', '2024-10-21 10:05:13', 1),
(27, 37, 1, 3, 'Under Disscussion', '2024-10-21 10:05:15', '2024-10-21 10:05:15', 1),
(28, 37, 1, 5, 'Done', '2024-10-21 10:05:23', '2024-10-21 10:05:23', 1),
(29, 38, 1, 2, 'View Lead', '2024-10-21 11:09:40', '2024-10-21 11:09:40', 1),
(30, 38, 1, 3, 'Under Disscussion', '2024-10-21 11:10:11', '2024-10-21 11:10:11', 1),
(31, 38, 1, 5, 'jjj', '2024-10-21 11:10:38', '2024-10-21 11:10:38', 1),
(32, 33, 1, 2, 'View Lead', '2024-10-21 12:00:36', '2024-10-21 12:00:36', 1),
(33, 33, 1, 3, 'Under Disscussion', '2024-10-21 12:00:45', '2024-10-21 12:00:45', 1),
(34, 33, 1, 3, 'Document Pending', '2024-10-21 12:01:06', '2024-10-21 12:01:06', 1),
(35, 33, 1, 5, 'Loan approved', '2024-10-21 12:01:53', '2024-10-21 12:01:53', 1),
(36, 39, 1, 2, 'View Lead', '2024-10-21 12:26:57', '2024-10-21 12:26:57', 1),
(37, 39, 1, 3, 'Under Disscussion', '2024-10-21 12:26:59', '2024-10-21 12:26:59', 1),
(38, 39, 1, 5, 'Done', '2024-10-21 12:27:05', '2024-10-21 12:27:05', 1),
(39, 41, 1, 2, 'View Lead', '2024-10-22 06:16:06', '2024-10-22 06:16:06', 1),
(40, 41, 1, 3, 'Under Disscussion', '2024-10-22 06:16:09', '2024-10-22 06:16:09', 1),
(41, 41, 1, 5, 'Done', '2024-10-22 06:16:16', '2024-10-22 06:16:16', 1),
(42, 42, 1, 2, 'View Lead', '2024-10-22 06:34:49', '2024-10-22 06:34:49', 1),
(43, 42, 1, 3, 'Under Disscussion', '2024-10-22 06:34:50', '2024-10-22 06:34:50', 1),
(44, 42, 1, 5, 'Done', '2024-10-22 06:34:56', '2024-10-22 06:34:56', 1),
(45, 44, 1, 2, 'View Lead', '2024-10-22 06:52:11', '2024-10-22 06:52:11', 1),
(46, 44, 1, 3, 'Under Disscussion', '2024-10-22 06:52:13', '2024-10-22 06:52:13', 1),
(47, 44, 1, 5, 'Done', '2024-10-22 06:52:18', '2024-10-22 06:52:18', 1),
(48, 45, 1, 2, 'View Lead', '2024-10-22 10:28:37', '2024-10-22 10:28:37', 1),
(49, 45, 1, 3, 'Under Disscussion', '2024-10-22 10:28:38', '2024-10-22 10:28:38', 1),
(50, 45, 1, 5, 'Done', '2024-10-22 10:28:44', '2024-10-22 10:28:44', 1),
(51, 46, 1, 2, 'View Lead', '2024-10-22 10:50:10', '2024-10-22 10:50:10', 1),
(52, 46, 1, 3, 'Under Disscussion', '2024-10-22 10:50:12', '2024-10-22 10:50:12', 1),
(53, 46, 1, 5, 'Done', '2024-10-22 10:50:17', '2024-10-22 10:50:17', 1),
(54, 47, 1, 2, 'View Lead', '2024-10-22 11:01:55', '2024-10-22 11:01:55', 1),
(55, 47, 1, 3, 'Under Disscussion', '2024-10-22 11:01:57', '2024-10-22 11:01:57', 1),
(56, 47, 1, 5, 'Done', '2024-10-22 11:02:03', '2024-10-22 11:02:03', 1),
(57, 48, 1, 2, 'View Lead', '2024-10-23 11:26:31', '2024-10-23 11:26:31', 1),
(58, 48, 1, 3, 'Under Disscussion', '2024-10-23 11:26:33', '2024-10-23 11:26:33', 1),
(59, 48, 1, 5, 'Done', '2024-10-23 11:26:38', '2024-10-23 11:26:38', 1),
(60, 49, 1, 2, 'View Lead', '2024-10-23 12:08:10', '2024-10-23 12:08:10', 1),
(61, 49, 1, 3, 'Under Disscussion', '2024-10-23 12:08:12', '2024-10-23 12:08:12', 1),
(62, 49, 1, 5, 'Done', '2024-10-23 12:08:20', '2024-10-23 12:08:20', 1),
(63, 1, 1, 1, 'Create Lead', '2024-10-28 06:06:21', '2024-10-28 06:06:21', 1),
(64, 1, 1, 5, '1', '2024-10-28 06:56:55', '2024-10-28 06:56:55', 1),
(65, 1, 1, 5, 'lead qualified', '2024-10-28 12:17:09', '2024-10-28 12:17:09', 1),
(66, 1, 1, 5, 'qualified', '2024-10-29 07:57:42', '2024-10-29 07:57:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `small_charge` int(11) NOT NULL,
  `large_charge` int(255) NOT NULL,
  `gaint_charge` int(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `small_charge`, `large_charge`, `gaint_charge`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Package 1', 100, 200, 200, 1, '2024-11-11 07:37:20', '2024-11-13 06:51:22'),
(4, 'Package 2', 50000, 0, 0, 1, '2024-11-11 07:44:22', '2024-11-11 07:46:01'),
(5, 'test', 11111111, 0, 0, 3, '2024-11-11 12:31:09', '2024-11-11 12:31:30'),
(6, 'Package 3', 1000, 20000, 30000, 1, '2024-11-13 06:51:33', '2024-11-13 06:51:33'),
(7, 'xxx', 100, 200, 300, 1, '2024-11-29 05:59:28', '2024-11-29 05:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `paragraph` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `title`, `paragraph`, `image`, `created_at`, `updated_at`) VALUES
(1, 'about_us', 'About Us', 'asdfasdfsadf', 'pages/CwZKrooe0Syw9vzqZESbeYv7urPqBm5BTQCb16Vn.png', '2024-12-02 08:24:31', '2024-12-02 09:44:28'),
(2, 'our_vision', 'Our Vision', 'sadfsdf', 'pages/jrskcCth1ZUZfWZWD0WG0Db1uoxlOGfbFV1UJbMT.png', '2024-12-02 08:24:41', '2024-12-02 12:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_modes`
--

CREATE TABLE `payment_modes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Deactive,3-delete,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_modes`
--

INSERT INTO `payment_modes` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 1, '2024-10-15 08:17:17', '2024-10-15 08:17:17'),
(2, 'UPI', 1, '2024-10-15 08:17:56', '2024-10-15 08:17:56'),
(3, 'Bank Transfer', 1, '2024-10-15 08:18:22', '2024-10-15 08:18:22'),
(4, 'Cheque', 1, '2024-10-15 08:18:31', '2024-10-15 12:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Create User', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(2, 'Edit User', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(3, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(4, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(5, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(6, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(7, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(8, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(9, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(10, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(11, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(12, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(13, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(14, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(15, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(16, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(17, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(18, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(19, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(20, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(21, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(22, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(23, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pet_category`
--

CREATE TABLE `pet_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'users.id',
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pet_size` varchar(255) DEFAULT NULL,
  `pet_bred` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pet_category`
--

INSERT INTO `pet_category` (`id`, `user_id`, `title`, `image`, `pet_size`, `pet_bred`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Dogs', 'pet_category/z0mWcpbhoCMacGbHUN9G5v5gCxh6ZrZFSUe9mvss.jpg', NULL, NULL, 1, '2024-11-11 06:35:24', '2024-11-11 06:41:14'),
(2, NULL, 'Birds', 'pet_category/dOKkP6VYB81HUk5Dgl1xzwG8ORMsFLZzMXXEbZ5s.jpg', NULL, NULL, 1, '2024-11-11 06:41:31', '2024-11-11 06:41:31'),
(3, NULL, 'Rabbit', 'pet_category/S9bYjljKopPPHyokmGD4kxuTWOFEbeuXOTaFafTT.jpg', NULL, NULL, 2, '2024-11-11 06:42:08', '2024-11-30 07:34:15'),
(4, NULL, 'Cats', 'pet_category/XZwJH4VVef6tUNk9CQd7I80h0NOqKYWgd7f6JmVa.jpg', NULL, NULL, 3, '2024-11-11 06:43:49', '2024-11-21 06:28:35'),
(5, 1, 'lsdfsf\nsssssssss', 'pet_category/s3lUip3FMegai8EDebLi4HJV6nbaZDHO46L62lOn.jpg', 'asdfasdf', 'asfdasfsdf', 3, '2024-11-20 11:16:33', '2024-11-21 06:28:23'),
(6, 1, 'Dogs', 'pet_category/wPjc2iMPzxo9G84DERbfyF7HmBGr35yqdsQhECec.jpg', 'XD', 'SMALL', 1, '2024-11-20 11:18:03', '2024-11-20 12:07:32'),
(7, 1, 'Dogs', 'pet_category/ItbmkF0ha1o1JaZEewMeKb9dRZ0Y7eaHjGnalGg8.jpg', 'XD', 'SMALL', 1, '2024-11-21 06:15:58', '2024-11-21 06:15:58'),
(8, 1, 'Dogss', 'pet_category/7MrSFpM8QJauabEIBncPVU4gv4SxJs8BE0sjl8lW.jpg', 'XD', 'SMALL', 1, '2024-11-21 06:16:31', '2024-11-25 05:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL COMMENT 'categories.id',
  `hotel_name` varchar(255) NOT NULL,
  `hotel_rate` int(11) NOT NULL,
  `hotel_address` text DEFAULT NULL,
  `hotel_description` text DEFAULT NULL,
  `hotel_map_link` text DEFAULT NULL,
  `state` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL COMMENT 'price in on day',
  `booking_days` varchar(255) DEFAULT NULL,
  `distance` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `room_type` varchar(255) DEFAULT NULL,
  `room_size` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `category_id`, `hotel_name`, `hotel_rate`, `hotel_address`, `hotel_description`, `hotel_map_link`, `state`, `place`, `price`, `booking_days`, `distance`, `location`, `room_type`, `room_size`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mount sina hotel', 3, 'Purna Anand, Thakur Block, Gokhale Road, Naupada 110033', 'Stay at the luxurious Mount Sina Hotel in Deira, Dubai. Enjoy easy access to the Gold Souk, Dubai Creek, and a vibrant\r\nneighborhood with authentic Emirati cuisine. Indulge in well appointed air conditioned rooms with complimentary Wi-Fi, a\r\nrefrigerator, and indulgent toiletries. Take in stunning views of the city or tranquil courtyards. With 24 hour room service\r\nand an on site restaurant, enjoy delicious meals at your convenience. Explore nearby landmarks such as the Dubai Spice\r\nSouk and Meena Bazaar. Perfect for solo and business travelers with the convenient location near shopping districts and\r\ntransportation hubs. Experience comfort and convenience at Mount Sina Hotel. [Some content may be Generative AI\r\nassisted. Inaccuracies may occur.', 'N/A', 'Delhi', 'Delhi Gate', '10000', '10-20Nov', '20km', '4', '4', '6220.32', 1, '2024-11-29 11:53:24', '2024-11-29 11:53:24'),
(2, 1, 'Mount sina hotel', 3, 'Purna Anand, Thakur Block, Gokhale Road, Naupada 110033', 'Stay at the luxurious Mount Sina Hotel in Deira, Dubai. Enjoy easy access to the Gold Souk, Dubai Creek, and a vibrant\r\nneighborhood with authentic Emirati cuisine. Indulge in well appointed air conditioned rooms with complimentary Wi-Fi, a\r\nrefrigerator, and indulgent toiletries. Take in stunning views of the city or tranquil courtyards. With 24 hour room service\r\nand an on site restaurant, enjoy delicious meals at your convenience. Explore nearby landmarks such as the Dubai Spice\r\nSouk and Meena Bazaar. Perfect for solo and business travelers with the convenient location near shopping districts and\r\ntransportation hubs. Experience comfort and convenience at Mount Sina Hotel. [Some content may be Generative AI\r\nassisted. Inaccuracies may occur.', 'N/A', 'India', 'Delhi', '2000', '10-20Nov', '10km', '3', '3', '520.3', 1, '2024-11-29 11:53:37', '2024-11-29 11:53:37'),
(3, 2, 'Mount sina hotel', 3, 'Purna Anand, Thakur Block, Gokhale Road, Naupada 110033', 'Stay at the luxurious Mount Sina Hotel in Deira, Dubai. Enjoy easy access to the Gold Souk, Dubai Creek, and a vibrant\r\nneighborhood with authentic Emirati cuisine. Indulge in well appointed air conditioned rooms with complimentary Wi-Fi, a\r\nrefrigerator, and indulgent toiletries. Take in stunning views of the city or tranquil courtyards. With 24 hour room service\r\nand an on site restaurant, enjoy delicious meals at your convenience. Explore nearby landmarks such as the Dubai Spice\r\nSouk and Meena Bazaar. Perfect for solo and business travelers with the convenient location near shopping districts and\r\ntransportation hubs. Experience comfort and convenience at Mount Sina Hotel. [Some content may be Generative AI\r\nassisted. Inaccuracies may occur.', 'N/A', 'Delhi', 'Delhi Gate', '10000', '10-20Nov', '20km', '4', '4', '6220.32', 1, '2024-11-29 11:53:24', '2024-11-29 11:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `properties_images`
--

CREATE TABLE `properties_images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL COMMENT 'properties.id',
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties_images`
--

INSERT INTO `properties_images` (`id`, `property_id`, `image`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'first.png\r\n', '2024-11-29 11:55:42', '2024-11-29 11:55:42', 1),
(2, 1, 'second.png', '2024-11-29 11:55:42', '2024-11-29 11:55:42', 1),
(3, 1, 'third.png', '2024-11-29 11:55:42', '2024-11-29 11:55:42', 1),
(4, 1, 'forth.png', '2024-11-29 11:55:42', '2024-11-29 11:55:42', 1),
(5, 2, 'first.png\r\n', '2024-11-29 11:55:42', '2024-11-29 11:55:42', 1),
(6, 2, 'second.png', '2024-11-29 11:55:42', '2024-11-29 11:55:42', 1),
(7, 2, 'third.png', '2024-11-29 11:55:42', '2024-11-29 11:55:42', 1),
(8, 2, 'forth.png', '2024-11-29 11:55:42', '2024-11-29 11:55:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_reviews`
--

CREATE TABLE `property_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Reference to users.id',
  `review` text NOT NULL,
  `rating` decimal(3,1) NOT NULL COMMENT 'Rating out of 5, e.g., 4.5',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1-Active, 2-Inactive, 3-Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_code`
--

CREATE TABLE `referral_code` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'users.id',
  `user_type` tinyint(4) NOT NULL COMMENT '1-Groomer,2-Customer',
  `code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referral_code`
--

INSERT INTO `referral_code` (`id`, `user_id`, `user_type`, `code`, `status`, `created_at`) VALUES
(1, 16, 2, '166734A27A163EE', 1, '2024-11-13 12:58:34'),
(2, 16, 2, '1667358F9C817F2', 1, '2024-11-14 05:50:20'),
(3, 19, 2, '196735E63A7D0BE', 1, '2024-11-14 11:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `refers`
--

CREATE TABLE `refers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `code_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Flat,2-Percent',
  `value` varchar(255) NOT NULL,
  `is_coupon_reused` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Yes,3-No',
  `expiry_date` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-InActive,3-Deleted',
  `is_used_coupon` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Used,2-Unused',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refers`
--

INSERT INTO `refers` (`id`, `coupon_code`, `code_type`, `value`, `is_coupon_reused`, `expiry_date`, `status`, `is_used_coupon`, `created_at`, `updated_at`) VALUES
(1, '881662', 1, '100', 2, NULL, 1, 2, '2024-11-13 09:51:27', '2024-11-13 10:00:27'),
(2, '9106212746069058', 1, '100', 1, '2024-11-23', 1, 2, '2024-11-13 10:05:42', '2024-11-13 10:05:42'),
(3, '8888038184290259', 1, '100', 2, NULL, 1, 2, '2024-11-13 10:07:34', '2024-11-13 10:07:34'),
(4, '4454917451421989', 1, '100', 2, NULL, 1, 2, '2024-11-21 10:21:09', '2024-11-21 10:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `refer_and_earn`
--

CREATE TABLE `refer_and_earn` (
  `id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '1-Gromer Helper,2-Customer',
  `is_on` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Active,2-Inactive',
  `is_profit` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-Active,2-Inactive',
  `billing_no` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refer_and_earn`
--

INSERT INTO `refer_and_earn` (`id`, `user_type`, `is_on`, `is_profit`, `billing_no`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 10, '2024-11-13 10:28:54', NULL),
(2, 2, 1, 1, 50, '2024-11-13 10:28:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, '2024-12-01 07:08:25', '2024-12-01 07:08:25'),
(2, 'User', 1, '2024-12-01 07:09:00', '2024-12-01 07:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_models`
--

CREATE TABLE `role_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT 'roles.id',
  `permission_id` int(11) DEFAULT NULL COMMENT 'permission.id',
  `permission_status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-True,2-False',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`, `permission_status`, `created_at`, `status`) VALUES
(1, 4, 1, 1, '2024-10-03 12:43:37', 1),
(2, 4, 2, 1, '2024-10-03 12:43:37', 1),
(3, 4, 3, 1, '2024-10-03 12:43:37', 1),
(4, 4, 4, 1, '2024-10-03 12:43:37', 1),
(5, 4, 5, 1, '2024-10-03 12:43:37', 1),
(6, 4, 6, 1, '2024-10-03 12:43:37', 1),
(7, 4, 7, 1, '2024-10-03 12:43:37', 1),
(8, 4, 8, 1, '2024-10-03 12:43:37', 1),
(9, 4, 9, 1, '2024-10-03 12:43:37', 1),
(10, 4, 10, 1, '2024-10-03 12:43:37', 1),
(11, 4, 11, 1, '2024-10-03 12:43:37', 1),
(12, 4, 12, 1, '2024-10-03 12:43:37', 1),
(13, 4, 13, 1, '2024-10-03 12:43:37', 1),
(14, 4, 14, 1, '2024-10-03 12:43:37', 1),
(15, 4, 15, 1, '2024-10-03 12:43:37', 1),
(16, 4, 16, 1, '2024-10-03 12:43:37', 1),
(17, 4, 17, 1, '2024-10-03 12:43:37', 1),
(18, 4, 18, 1, '2024-10-03 12:43:37', 1),
(19, 4, 19, 1, '2024-10-03 12:43:37', 1),
(20, 4, 20, 2, '2024-10-03 12:43:37', 1),
(21, 4, 21, 1, '2024-10-03 12:43:37', 1),
(22, 4, 22, 1, '2024-10-03 12:43:37', 1),
(23, 4, 23, 1, '2024-10-03 12:43:37', 1),
(24, 3, 1, 1, '2024-11-25 05:11:39', 1),
(25, 3, 2, 1, '2024-11-25 05:11:39', 1),
(26, 3, 3, 1, '2024-11-25 05:11:39', 1),
(27, 3, 4, 1, '2024-11-25 05:11:39', 1),
(28, 3, 5, 1, '2024-11-25 05:11:39', 1),
(29, 3, 6, 1, '2024-11-25 05:11:39', 1),
(30, 3, 7, 1, '2024-11-25 05:11:39', 1),
(31, 3, 8, 1, '2024-11-25 05:11:39', 1),
(32, 3, 9, 1, '2024-11-25 05:11:39', 1),
(33, 3, 10, 1, '2024-11-25 05:11:39', 1),
(34, 3, 11, 1, '2024-11-25 05:11:39', 1),
(35, 3, 12, 1, '2024-11-25 05:11:39', 1),
(36, 3, 13, 1, '2024-11-25 05:11:39', 1),
(37, 3, 14, 1, '2024-11-25 05:11:39', 1),
(38, 3, 15, 1, '2024-11-25 05:11:39', 1),
(39, 3, 16, 1, '2024-11-25 05:11:39', 1),
(40, 3, 17, 1, '2024-11-25 05:11:39', 1),
(41, 3, 18, 1, '2024-11-25 05:11:39', 1),
(42, 3, 19, 1, '2024-11-25 05:11:39', 1),
(43, 3, 20, 1, '2024-11-25 05:11:39', 1),
(44, 3, 21, 1, '2024-11-25 05:11:39', 1),
(45, 3, 22, 1, '2024-11-25 05:11:39', 1),
(46, 3, 23, 1, '2024-11-25 05:11:39', 1),
(47, 5, 1, 1, '2024-11-25 05:11:53', 1),
(48, 5, 2, 1, '2024-11-25 05:11:53', 1),
(49, 5, 3, 1, '2024-11-25 05:11:53', 1),
(50, 5, 4, 1, '2024-11-25 05:11:53', 1),
(51, 5, 5, 1, '2024-11-25 05:11:53', 1),
(52, 5, 6, 1, '2024-11-25 05:11:53', 1),
(53, 5, 7, 1, '2024-11-25 05:11:53', 1),
(54, 5, 8, 1, '2024-11-25 05:11:53', 1),
(55, 5, 9, 1, '2024-11-25 05:11:53', 1),
(56, 5, 10, 1, '2024-11-25 05:11:53', 1),
(57, 5, 11, 1, '2024-11-25 05:11:53', 1),
(58, 5, 12, 1, '2024-11-25 05:11:53', 1),
(59, 5, 13, 1, '2024-11-25 05:11:53', 1),
(60, 5, 14, 1, '2024-11-25 05:11:53', 1),
(61, 5, 15, 1, '2024-11-25 05:11:53', 1),
(62, 5, 16, 2, '2024-11-25 05:11:53', 1),
(63, 5, 17, 1, '2024-11-25 05:11:53', 1),
(64, 5, 18, 1, '2024-11-25 05:11:53', 1),
(65, 5, 19, 1, '2024-11-25 05:11:53', 1),
(66, 5, 20, 2, '2024-11-25 05:11:53', 1),
(67, 5, 21, 1, '2024-11-25 05:11:53', 1),
(68, 5, 22, 1, '2024-11-25 05:11:53', 1),
(69, 5, 23, 1, '2024-11-25 05:11:53', 1),
(70, 2, 1, 2, '2024-12-02 12:34:08', 1),
(71, 2, 2, 2, '2024-12-02 12:34:08', 1),
(72, 2, 3, 1, '2024-12-02 12:34:08', 1),
(73, 2, 4, 2, '2024-12-02 12:34:08', 1),
(74, 2, 5, 2, '2024-12-02 12:34:08', 1),
(75, 2, 6, 2, '2024-12-02 12:34:08', 1),
(76, 2, 7, 2, '2024-12-02 12:34:08', 1),
(77, 2, 8, 2, '2024-12-02 12:34:08', 1),
(78, 2, 9, 2, '2024-12-02 12:34:08', 1),
(79, 2, 10, 2, '2024-12-02 12:34:08', 1),
(80, 2, 11, 2, '2024-12-02 12:34:08', 1),
(81, 2, 12, 2, '2024-12-02 12:34:08', 1),
(82, 2, 13, 2, '2024-12-02 12:34:08', 1),
(83, 2, 14, 2, '2024-12-02 12:34:08', 1),
(84, 2, 15, 2, '2024-12-02 12:34:08', 1),
(85, 2, 16, 2, '2024-12-02 12:34:08', 1),
(86, 2, 17, 2, '2024-12-02 12:34:08', 1),
(87, 2, 18, 2, '2024-12-02 12:34:08', 1),
(88, 2, 19, 2, '2024-12-02 12:34:08', 1),
(89, 2, 20, 2, '2024-12-02 12:34:08', 1),
(90, 2, 21, 2, '2024-12-02 12:34:08', 1),
(91, 2, 22, 2, '2024-12-02 12:34:08', 1),
(92, 2, 23, 2, '2024-12-02 12:34:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `route_logs`
--

CREATE TABLE `route_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_assign_id` int(11) NOT NULL COMMENT 'assignroutes.id',
  `user_id` int(11) NOT NULL COMMENT 'users.id',
  `route_id` int(11) NOT NULL COMMENT 'routes.id',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Delete,4-Permanent Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `route_logs`
--

INSERT INTO `route_logs` (`id`, `route_assign_id`, `user_id`, `route_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 2, 1, '2024-10-29 07:07:20', '2024-10-29 12:40:14', 1),
(2, 2, 6, 1, '2024-10-29 07:07:24', '2024-10-29 12:40:10', 1),
(3, 3, 9, 1, '2024-10-29 07:07:27', '2024-10-29 12:38:02', 1),
(4, 4, 9, 1, '2024-10-29 07:08:15', '2024-10-29 12:38:29', 1),
(5, 5, 2, 1, '2024-10-29 07:11:11', '2024-10-29 13:09:23', 1),
(6, 6, 2, 1, '2024-10-29 09:35:02', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` int(20) UNSIGNED NOT NULL,
  `url` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_robot` text DEFAULT NULL,
  `header_script` text DEFAULT NULL,
  `footer_script` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `url`, `meta_title`, `meta_description`, `meta_keyword`, `meta_robot`, `header_script`, `footer_script`, `created_at`, `updated_at`, `status`) VALUES
(1, 'http://127.0.0.1:8000/seo/create', 'Seo title asdf', 'seo description', 'seo keyword', 'no index seo', 'seo header script', 'seo footer script', '2024-12-02 06:47:06', '2024-12-02 12:37:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `service_charge` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `service_charge`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(2, 'Dogs Service', 300, 1, '2024-11-11 07:26:12', '2024-11-13 06:59:04'),
(4, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(5, 'Dogs Service', 300, 1, '2024-11-11 07:26:12', '2024-11-13 06:59:04'),
(6, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(7, 'Dogs Service', 300, 1, '2024-11-11 07:26:12', '2024-11-13 06:59:04'),
(8, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(9, 'Dogs Service', 300, 1, '2024-11-11 07:26:12', '2024-11-13 06:59:04'),
(10, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(11, 'Dogs Service', 300, 1, '2024-11-11 07:26:12', '2024-11-13 06:59:04'),
(12, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(13, 'Dogs Service', 300, 1, '2024-11-11 07:26:12', '2024-11-13 06:59:04'),
(14, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(15, 'Dogs Service', 300, 1, '2024-11-11 07:26:12', '2024-11-13 06:59:04'),
(16, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(17, 'Dogs Service', 300, 1, '2024-11-11 07:26:12', '2024-11-13 06:59:04'),
(18, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(19, 'Dosgs Service', 5555, 1, '2024-11-11 07:26:12', '2024-11-19 08:16:42'),
(20, 'Pat Service', 300, 1, '2024-11-11 07:26:12', '2024-11-11 07:26:12'),
(21, 'Dogs Service', 300, 1, '2024-11-11 07:26:12', '2024-11-13 06:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'users.id',
  `subject` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1-Active,2-DeActive,3-Deleted,4-Permanent Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otp`
--

CREATE TABLE `tbl_otp` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user.id',
  `otp` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Expired',
  `module_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Login,2-UpdateEmail or mobile of users,3-user location',
  `otp_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Mobile, 2-Email',
  `field_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_otp`
--

INSERT INTO `tbl_otp` (`id`, `user_id`, `otp`, `status`, `module_type`, `otp_type`, `field_value`, `created_at`, `updated_at`) VALUES
(1, 1, '5598', 2, 1, 1, NULL, '2024-10-02 06:27:06', '2024-10-02 06:27:06'),
(2, 1, '3695', 2, 1, 1, NULL, '2024-10-02 12:12:35', '2024-10-02 12:12:35'),
(3, 1, '1507', 2, 1, 1, NULL, '2024-10-02 12:31:55', '2024-10-02 12:31:55'),
(4, 1, '2733', 2, 1, 1, NULL, '2024-10-03 10:41:14', '2024-10-03 10:41:14'),
(5, 1, '3283', 2, 1, 1, NULL, '2024-10-03 10:41:30', '2024-10-03 10:41:30'),
(6, 1, '7678', 2, 1, 1, NULL, '2024-10-03 10:42:18', '2024-10-03 10:42:18'),
(7, 1, '1976', 2, 1, 1, NULL, '2024-10-03 10:51:20', '2024-10-03 10:51:20'),
(8, 1, '7065', 2, 1, 1, NULL, '2024-10-03 10:52:24', '2024-10-03 10:52:24'),
(9, 1, '8735', 2, 1, 1, NULL, '2024-10-03 11:02:57', '2024-10-03 11:02:57'),
(10, 1, '1422', 2, 1, 1, NULL, '2024-10-03 11:39:15', '2024-10-03 11:39:15'),
(11, 1, '6068', 2, 1, 1, NULL, '2024-10-03 11:49:32', '2024-10-03 11:49:32'),
(12, 1, '3548', 2, 1, 1, NULL, '2024-10-03 11:50:14', '2024-10-03 11:50:14'),
(13, 1, '8926', 2, 1, 1, NULL, '2024-10-03 13:04:30', '2024-10-03 13:04:30'),
(14, 1, '1447', 2, 1, 1, NULL, '2024-10-04 10:07:57', '2024-10-04 10:07:57'),
(15, 1, '3354', 2, 1, 1, NULL, '2024-10-04 11:43:11', '2024-10-04 11:43:11'),
(16, 1, '2719', 2, 2, 2, NULL, '2024-10-04 11:58:01', '2024-10-04 11:58:01'),
(17, 1, '3447', 2, 2, 2, NULL, '2024-10-04 11:58:30', '2024-10-04 11:58:30'),
(18, 1, '4933', 2, 2, 2, NULL, '2024-10-04 12:03:55', '2024-10-04 12:03:55'),
(19, 1, '5371', 2, 2, 2, NULL, '2024-10-04 12:29:50', '2024-10-04 12:29:50'),
(20, 1, '5278', 2, 2, 2, NULL, '2024-10-04 12:36:55', '2024-10-04 12:36:55'),
(21, 1, '1588', 2, 2, 2, NULL, '2024-10-04 12:38:15', '2024-10-04 12:38:15'),
(22, 1, '9324', 2, 2, 1, NULL, '2024-10-04 12:39:02', '2024-10-04 12:39:02'),
(23, 1, '4487', 2, 1, 1, NULL, '2024-10-04 13:36:34', '2024-10-04 13:36:34'),
(24, 1, '9073', 2, 1, 1, NULL, '2024-10-07 05:26:21', '2024-10-07 05:26:21'),
(25, 1, '6062', 2, 2, 1, NULL, '2024-10-07 05:30:48', '2024-10-07 05:30:48'),
(26, 1, '5092', 2, 2, 1, NULL, '2024-10-07 05:39:15', '2024-10-07 05:39:15'),
(27, 1, '2064', 2, 1, 1, NULL, '2024-10-07 06:34:50', '2024-10-07 06:34:50'),
(28, 1, '3161', 2, 2, 1, NULL, '2024-10-07 06:47:08', '2024-10-07 06:47:08'),
(29, 1, '4297', 2, 2, 1, NULL, '2024-10-07 07:19:18', '2024-10-07 07:19:18'),
(30, 1, '4590', 2, 2, 1, NULL, '2024-10-07 07:19:40', '2024-10-07 07:19:40'),
(31, 1, '6713', 2, 1, 1, NULL, '2024-10-07 07:45:23', '2024-10-07 07:45:23'),
(32, 1, '7371', 2, 2, 1, NULL, '2024-10-07 07:46:26', '2024-10-07 07:46:26'),
(33, 1, '7621', 2, 2, 1, NULL, '2024-10-07 07:47:04', '2024-10-07 07:47:04'),
(34, 1, '8130', 2, 2, 1, NULL, '2024-10-07 07:49:27', '2024-10-07 07:49:27'),
(35, 1, '2000', 2, 2, 1, NULL, '2024-10-07 07:50:23', '2024-10-07 07:50:23'),
(36, 1, '5027', 2, 2, 1, NULL, '2024-10-07 07:54:13', '2024-10-07 07:54:13'),
(37, 1, '1375', 2, 2, 1, NULL, '2024-10-07 07:56:35', '2024-10-07 07:56:35'),
(38, 1, '1263', 2, 2, 1, NULL, '2024-10-07 07:56:56', '2024-10-07 07:56:56'),
(39, 1, '3053', 2, 1, 1, NULL, '2024-10-07 09:05:48', '2024-10-07 09:05:48'),
(40, 1, '8380', 2, 2, 1, NULL, '2024-10-07 09:06:22', '2024-10-07 09:06:22'),
(41, 1, '9504', 2, 2, 1, NULL, '2024-10-07 09:06:48', '2024-10-07 09:06:48'),
(42, 1, '2805', 2, 2, 1, NULL, '2024-10-07 09:08:19', '2024-10-07 09:08:19'),
(43, 1, '6153', 2, 2, 1, NULL, '2024-10-07 09:11:36', '2024-10-07 09:11:36'),
(44, 1, '7155', 2, 2, 1, NULL, '2024-10-07 09:11:48', '2024-10-07 09:11:48'),
(45, 1, '3709', 2, 2, 1, NULL, '2024-10-07 10:03:17', '2024-10-07 10:03:17'),
(46, 1, '8517', 2, 2, 1, NULL, '2024-10-07 10:04:19', '2024-10-07 10:04:19'),
(47, 1, '8772', 2, 1, 1, NULL, '2024-10-07 10:11:57', '2024-10-07 10:11:57'),
(48, 1, '1602', 2, 2, 1, NULL, '2024-10-07 10:12:26', '2024-10-07 10:12:26'),
(49, 1, '8590', 2, 2, 1, '9756188580', '2024-10-07 10:13:00', '2024-10-07 10:13:00'),
(50, 1, '5728', 2, 2, 1, NULL, '2024-10-07 10:32:31', '2024-10-07 10:32:31'),
(51, 1, '8331', 2, 2, 1, '9756188580', '2024-10-07 10:32:43', '2024-10-07 10:32:43'),
(52, 1, '9876', 2, 2, 2, NULL, '2024-10-07 10:52:21', '2024-10-07 10:52:21'),
(53, 1, '9022', 2, 2, 2, NULL, '2024-10-07 10:55:43', '2024-10-07 10:55:43'),
(54, 1, '4848', 2, 2, 2, NULL, '2024-10-07 10:58:58', '2024-10-07 10:58:58'),
(55, 1, '2096', 2, 2, 2, NULL, '2024-10-07 10:59:06', '2024-10-07 10:59:06'),
(56, 1, '4963', 2, 2, 2, 'shadab.nerasoft@gmail.com', '2024-10-07 10:59:32', '2024-10-07 10:59:32'),
(57, 1, '4763', 2, 2, 2, NULL, '2024-10-07 11:01:22', '2024-10-07 11:01:22'),
(58, 1, '6366', 2, 2, 2, 'shadab.nerasoft@gmail.com', '2024-10-07 11:02:24', '2024-10-07 11:02:24'),
(59, 1, '2538', 2, 2, 2, NULL, '2024-10-07 11:02:41', '2024-10-07 11:02:41'),
(60, 1, '7994', 2, 2, 2, 'shadab.nerasoft@gmail.com', '2024-10-07 11:02:58', '2024-10-07 11:02:58'),
(61, 1, '8986', 2, 2, 2, NULL, '2024-10-07 11:04:32', '2024-10-07 11:04:32'),
(62, 1, '2679', 2, 2, 2, 'shadab.nerasoft@gmail.com', '2024-10-07 11:04:47', '2024-10-07 11:04:47'),
(63, 1, '9040', 2, 1, 1, NULL, '2024-10-07 11:16:54', '2024-10-07 11:16:54'),
(64, 1, '7305', 2, 1, 1, NULL, '2024-10-07 11:18:29', '2024-10-07 11:18:29'),
(65, 1, '5533', 2, 1, 1, NULL, '2024-10-07 11:20:18', '2024-10-07 11:20:18'),
(66, 1, '5016', 2, 1, 1, NULL, '2024-10-07 11:20:35', '2024-10-07 11:20:35'),
(67, 1, '9094', 2, 1, 1, NULL, '2024-10-07 11:22:23', '2024-10-07 11:22:23'),
(68, 1, '9052', 2, 1, 1, NULL, '2024-10-07 12:23:52', '2024-10-07 12:23:52'),
(69, 3, '2349', 2, 1, 1, NULL, '2024-10-08 06:45:10', '2024-10-08 06:45:10'),
(70, 3, '7363', 2, 1, 1, NULL, '2024-10-08 06:48:00', '2024-10-08 06:48:00'),
(71, 3, '9013', 2, 1, 1, NULL, '2024-10-08 06:51:38', '2024-10-08 06:51:38'),
(72, 3, '6158', 2, 1, 1, NULL, '2024-10-08 06:59:13', '2024-10-08 06:59:13'),
(73, 3, '4687', 2, 1, 1, NULL, '2024-10-08 07:01:29', '2024-10-08 07:01:29'),
(74, 3, '1120', 2, 1, 1, NULL, '2024-10-08 07:06:49', '2024-10-08 07:06:49'),
(75, 3, '6614', 2, 1, 1, NULL, '2024-10-08 07:10:31', '2024-10-08 07:10:31'),
(76, 3, '9663', 2, 1, 1, NULL, '2024-10-08 07:11:45', '2024-10-08 07:11:45'),
(77, 3, '1944', 2, 1, 1, NULL, '2024-10-08 07:23:51', '2024-10-08 07:23:51'),
(78, 3, '1531', 2, 1, 1, NULL, '2024-10-08 07:33:29', '2024-10-08 07:33:29'),
(79, 3, '1297', 2, 1, 1, NULL, '2024-10-08 07:36:37', '2024-10-08 07:36:37'),
(80, 3, '3720', 2, 1, 1, NULL, '2024-10-08 07:38:25', '2024-10-08 07:38:25'),
(81, 3, '7489', 2, 1, 1, NULL, '2024-10-08 07:38:48', '2024-10-08 07:38:48'),
(82, 3, '5141', 2, 1, 1, NULL, '2024-10-08 07:45:51', '2024-10-08 07:45:51'),
(83, 3, '1234', 2, 1, 1, NULL, '2024-10-08 07:46:42', '2024-10-08 07:46:42'),
(84, 3, '1234', 2, 1, 1, NULL, '2024-10-08 07:47:13', '2024-10-08 07:47:13'),
(85, 3, '1234', 2, 1, 1, NULL, '2024-10-08 07:50:11', '2024-10-08 07:50:11'),
(86, 3, '1234', 2, 1, 1, NULL, '2024-10-08 07:51:27', '2024-10-08 07:51:27'),
(87, 3, '1234', 2, 1, 1, NULL, '2024-10-08 07:56:35', '2024-10-08 07:56:35'),
(88, 3, '1234', 2, 1, 1, NULL, '2024-10-08 07:57:21', '2024-10-08 07:57:21'),
(89, 3, '1234', 2, 1, 1, NULL, '2024-10-08 07:58:25', '2024-10-08 07:58:25'),
(90, 3, '1234', 2, 1, 1, NULL, '2024-10-08 07:59:05', '2024-10-08 07:59:05'),
(91, 3, '1234', 2, 1, 1, NULL, '2024-10-08 07:59:52', '2024-10-08 07:59:52'),
(92, 3, '1234', 2, 1, 1, NULL, '2024-10-08 08:47:05', '2024-10-08 08:47:05'),
(93, 3, '1234', 2, 1, 1, NULL, '2024-10-08 08:49:25', '2024-10-08 08:49:25'),
(94, 3, '1234', 2, 1, 1, NULL, '2024-10-08 08:50:12', '2024-10-08 08:50:12'),
(95, 3, '1234', 2, 1, 1, NULL, '2024-10-08 08:51:32', '2024-10-08 08:51:32'),
(96, 3, '1234', 2, 1, 1, NULL, '2024-10-08 08:51:35', '2024-10-08 08:51:35'),
(97, 3, '1234', 2, 1, 1, NULL, '2024-10-08 08:52:28', '2024-10-08 08:52:28'),
(98, 3, '1234', 2, 1, 1, NULL, '2024-10-08 08:58:02', '2024-10-08 08:58:02'),
(99, 3, '1234', 2, 1, 1, NULL, '2024-10-08 08:59:26', '2024-10-08 08:59:26'),
(100, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:19:35', '2024-10-08 09:19:35'),
(101, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:19:37', '2024-10-08 09:19:37'),
(102, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:20:05', '2024-10-08 09:20:05'),
(103, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:21:56', '2024-10-08 09:21:56'),
(104, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:22:17', '2024-10-08 09:22:17'),
(105, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:23:53', '2024-10-08 09:23:53'),
(106, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:25:00', '2024-10-08 09:25:00'),
(107, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:27:58', '2024-10-08 09:27:58'),
(108, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:30:30', '2024-10-08 09:30:30'),
(109, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:31:47', '2024-10-08 09:31:47'),
(110, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:32:25', '2024-10-08 09:32:25'),
(111, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:32:38', '2024-10-08 09:32:38'),
(112, 3, '1234', 2, 1, 1, NULL, '2024-10-08 09:47:25', '2024-10-08 09:47:25'),
(113, 3, '1234', 2, 1, 1, NULL, '2024-10-08 10:04:45', '2024-10-08 10:04:45'),
(114, 3, '1234', 2, 1, 1, NULL, '2024-10-08 11:05:18', '2024-10-08 11:05:18'),
(115, 3, '1234', 2, 1, 1, NULL, '2024-10-08 11:51:45', '2024-10-08 11:51:45'),
(116, 3, '1234', 2, 1, 1, NULL, '2024-10-08 11:56:57', '2024-10-08 11:56:57'),
(117, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:04:44', '2024-10-08 12:04:44'),
(118, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:05:47', '2024-10-08 12:05:47'),
(119, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:06:10', '2024-10-08 12:06:10'),
(120, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:26:55', '2024-10-08 12:26:55'),
(121, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:28:15', '2024-10-08 12:28:15'),
(122, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:28:23', '2024-10-08 12:28:23'),
(123, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:29:40', '2024-10-08 12:29:40'),
(124, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:36:57', '2024-10-08 12:36:57'),
(125, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:37:03', '2024-10-08 12:37:03'),
(126, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:38:01', '2024-10-08 12:38:01'),
(127, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:39:26', '2024-10-08 12:39:26'),
(128, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:40:51', '2024-10-08 12:40:51'),
(129, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:46:18', '2024-10-08 12:46:18'),
(130, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:47:12', '2024-10-08 12:47:12'),
(131, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:48:08', '2024-10-08 12:48:08'),
(132, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:49:15', '2024-10-08 12:49:15'),
(133, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:49:59', '2024-10-08 12:49:59'),
(134, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:50:51', '2024-10-08 12:50:51'),
(135, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:53:50', '2024-10-08 12:53:50'),
(136, 3, '1234', 2, 1, 1, NULL, '2024-10-08 12:58:40', '2024-10-08 12:58:40'),
(137, 3, '1234', 2, 1, 1, NULL, '2024-10-08 13:25:12', '2024-10-08 13:25:12'),
(138, 1, '1234', 2, 1, 1, NULL, '2024-10-08 15:15:37', '2024-10-08 15:15:37'),
(139, 4, '1234', 2, 1, 1, NULL, '2024-10-08 15:18:21', '2024-10-08 15:18:21'),
(140, 4, '1234', 2, 1, 1, NULL, '2024-10-08 15:26:51', '2024-10-08 15:26:51'),
(141, 4, '1234', 2, 1, 1, NULL, '2024-10-08 15:36:51', '2024-10-08 15:36:51'),
(142, 1, '1234', 2, 1, 1, NULL, '2024-10-08 15:40:55', '2024-10-08 15:40:55'),
(143, 4, '1234', 2, 1, 1, NULL, '2024-10-08 15:41:31', '2024-10-08 15:41:31'),
(144, 4, '1234', 2, 1, 1, NULL, '2024-10-08 15:42:54', '2024-10-08 15:42:54'),
(145, 4, '1234', 2, 1, 1, NULL, '2024-10-08 15:47:18', '2024-10-08 15:47:18'),
(146, 4, '1234', 2, 1, 1, NULL, '2024-10-08 15:56:01', '2024-10-08 15:56:01'),
(147, 4, '1234', 2, 1, 1, NULL, '2024-10-08 16:07:31', '2024-10-08 16:07:31'),
(148, 4, '1234', 2, 1, 1, NULL, '2024-10-08 17:49:52', '2024-10-08 17:49:52'),
(149, 4, '1234', 2, 1, 1, NULL, '2024-10-08 17:51:10', '2024-10-08 17:51:10'),
(150, 4, '1234', 2, 1, 1, NULL, '2024-10-08 17:59:22', '2024-10-08 17:59:22'),
(151, 4, '1234', 2, 1, 1, NULL, '2024-10-08 17:59:39', '2024-10-08 17:59:39'),
(152, 4, '1234', 2, 1, 1, NULL, '2024-10-08 18:11:41', '2024-10-08 18:11:41'),
(153, 4, '1234', 2, 1, 1, NULL, '2024-10-08 18:11:58', '2024-10-08 18:11:58'),
(154, 4, '1234', 2, 1, 1, NULL, '2024-10-08 18:37:39', '2024-10-08 18:37:39'),
(155, 4, '1234', 2, 1, 1, NULL, '2024-10-08 18:37:54', '2024-10-08 18:37:54'),
(156, 3, '1234', 2, 1, 1, NULL, '2024-10-09 04:45:32', '2024-10-09 04:45:32'),
(157, 3, '1234', 2, 1, 1, NULL, '2024-10-09 04:45:57', '2024-10-09 04:45:57'),
(158, 3, '1234', 2, 1, 1, NULL, '2024-10-09 05:18:18', '2024-10-09 05:18:18'),
(159, 4, '1234', 2, 1, 1, NULL, '2024-10-09 06:03:35', '2024-10-09 06:03:35'),
(160, 4, '1234', 2, 1, 1, NULL, '2024-10-09 06:04:09', '2024-10-09 06:04:09'),
(161, 4, '1234', 2, 1, 1, NULL, '2024-10-09 06:05:38', '2024-10-09 06:05:38'),
(162, 4, '1234', 2, 1, 1, NULL, '2024-10-09 06:08:41', '2024-10-09 06:08:41'),
(163, 4, '1234', 2, 1, 1, NULL, '2024-10-09 06:11:24', '2024-10-09 06:11:24'),
(164, 4, '1234', 2, 1, 1, NULL, '2024-10-09 06:13:35', '2024-10-09 06:13:35'),
(165, 4, '1234', 2, 1, 1, NULL, '2024-10-09 06:13:48', '2024-10-09 06:13:48'),
(166, 4, '1234', 2, 1, 1, NULL, '2024-10-09 06:14:24', '2024-10-09 06:14:24'),
(167, 4, '1234', 2, 1, 1, NULL, '2024-10-09 06:29:35', '2024-10-09 06:29:35'),
(168, 4, '1234', 2, 1, 1, NULL, '2024-10-09 07:45:31', '2024-10-09 07:45:31'),
(169, 4, '1234', 2, 1, 1, NULL, '2024-10-09 07:47:05', '2024-10-09 07:47:05'),
(170, 4, '1234', 2, 1, 1, NULL, '2024-10-09 09:56:31', '2024-10-09 09:56:31'),
(171, 4, '1234', 2, 1, 1, NULL, '2024-10-09 09:57:28', '2024-10-09 09:57:28'),
(172, 4, '1234', 2, 1, 1, NULL, '2024-10-09 10:02:28', '2024-10-09 10:02:28'),
(173, 4, '1234', 2, 1, 1, NULL, '2024-10-09 10:06:46', '2024-10-09 10:06:46'),
(174, 4, '1234', 2, 1, 1, NULL, '2024-10-09 10:11:17', '2024-10-09 10:11:17'),
(175, 3, '1234', 2, 1, 1, NULL, '2024-10-09 10:13:15', '2024-10-09 10:13:15'),
(176, 1, '1234', 2, 1, 1, NULL, '2024-10-09 10:33:03', '2024-10-09 10:33:03'),
(177, 3, '1234', 2, 1, 1, NULL, '2024-10-09 10:39:56', '2024-10-09 10:39:56'),
(178, 4, '1234', 2, 1, 1, NULL, '2024-10-09 10:50:04', '2024-10-09 10:50:04'),
(179, 4, '1234', 2, 1, 1, NULL, '2024-10-09 10:50:25', '2024-10-09 10:50:25'),
(180, 6, '1234', 2, 1, 1, NULL, '2024-10-09 11:18:11', '2024-10-09 11:18:11'),
(181, 4, '1234', 2, 1, 1, NULL, '2024-10-09 12:30:12', '2024-10-09 12:30:12'),
(182, 4, '1234', 2, 1, 1, NULL, '2024-10-09 13:11:09', '2024-10-09 13:11:09'),
(183, 4, '1234', 2, 1, 1, NULL, '2024-10-09 13:23:38', '2024-10-09 13:23:38'),
(184, 4, '1234', 2, 1, 1, NULL, '2024-10-09 13:23:42', '2024-10-09 13:23:42'),
(185, 4, '1234', 2, 1, 1, NULL, '2024-10-09 13:49:09', '2024-10-09 13:49:09'),
(186, 4, '1234', 2, 1, 1, NULL, '2024-10-09 13:49:26', '2024-10-09 13:49:26'),
(187, 4, '1234', 2, 1, 1, NULL, '2024-10-09 13:49:41', '2024-10-09 13:49:41'),
(188, 4, '1234', 2, 1, 1, NULL, '2024-10-09 14:57:41', '2024-10-09 14:57:41'),
(189, 4, '1234', 2, 1, 1, NULL, '2024-10-09 15:01:56', '2024-10-09 15:01:56'),
(190, 4, '1234', 2, 1, 1, NULL, '2024-10-09 15:36:23', '2024-10-09 15:36:23'),
(191, 2, '1234', 2, 1, 1, NULL, '2024-10-14 07:04:24', '2024-10-14 07:04:24'),
(192, 2, '1234', 2, 1, 1, NULL, '2024-10-14 07:31:07', '2024-10-14 07:31:07'),
(193, 2, '1234', 2, 1, 1, NULL, '2024-10-14 09:18:16', '2024-10-14 09:18:16'),
(194, 2, '1234', 2, 1, 1, NULL, '2024-10-15 06:38:24', '2024-10-15 06:38:24'),
(195, 2, '1234', 2, 1, 1, NULL, '2024-10-15 10:18:34', '2024-10-15 10:18:34'),
(196, 2, '1234', 2, 1, 1, NULL, '2024-10-15 11:22:24', '2024-10-15 11:22:24'),
(197, 2, '1234', 2, 1, 1, NULL, '2024-10-15 11:22:39', '2024-10-15 11:22:39'),
(198, 1, '901707', 1, 3, 2, 'access user location', '2024-10-15 12:46:16', '2024-10-15 12:46:16'),
(199, 1, '660323', 1, 3, 2, 'access user location', '2024-10-15 12:46:40', '2024-10-15 12:46:40'),
(200, 1, '511797', 1, 3, 2, 'access user location', '2024-10-15 12:47:24', '2024-10-15 12:47:24'),
(201, 1, '941236', 1, 3, 2, 'access user location', '2024-10-15 12:49:14', '2024-10-15 12:49:14'),
(202, 2, '1234', 2, 1, 1, NULL, '2024-10-17 04:49:17', '2024-10-17 04:49:17'),
(203, 2, '1234', 2, 1, 1, NULL, '2024-10-17 04:51:50', '2024-10-17 04:51:50'),
(204, 2, '1234', 2, 1, 1, NULL, '2024-10-17 04:53:25', '2024-10-17 04:53:25'),
(205, 2, '1234', 2, 1, 1, NULL, '2024-10-17 04:55:45', '2024-10-17 04:55:45'),
(206, 2, '1234', 2, 1, 1, NULL, '2024-10-17 05:03:29', '2024-10-17 05:03:29'),
(207, 2, '1234', 2, 1, 1, NULL, '2024-10-17 05:40:02', '2024-10-17 05:40:02'),
(208, 2, '1234', 2, 1, 1, NULL, '2024-10-17 05:56:42', '2024-10-17 05:56:42'),
(209, 2, '1234', 2, 1, 1, NULL, '2024-10-17 06:49:37', '2024-10-17 06:49:37'),
(210, 2, '1234', 2, 1, 1, NULL, '2024-10-17 06:54:45', '2024-10-17 06:54:45'),
(211, 1, '252145', 1, 3, 2, 'access user location', '2024-10-17 07:48:33', '2024-10-17 07:48:33'),
(212, 4, '1234', 2, 1, 1, NULL, '2024-10-17 07:50:06', '2024-10-17 07:50:06'),
(213, 4, '1234', 2, 1, 1, NULL, '2024-10-17 07:54:15', '2024-10-17 07:54:15'),
(214, 4, '1234', 2, 1, 1, NULL, '2024-10-17 07:57:50', '2024-10-17 07:57:50'),
(215, 4, '1234', 2, 1, 1, NULL, '2024-10-17 08:07:07', '2024-10-17 08:07:07'),
(216, 4, '1234', 2, 1, 1, NULL, '2024-10-17 08:07:33', '2024-10-17 08:07:33'),
(217, 4, '1234', 2, 1, 1, NULL, '2024-10-17 09:24:18', '2024-10-17 09:24:18'),
(218, 4, '1234', 2, 1, 1, NULL, '2024-10-17 09:25:55', '2024-10-17 09:25:55'),
(219, 4, '1234', 2, 1, 1, NULL, '2024-10-17 09:26:33', '2024-10-17 09:26:33'),
(220, 4, '1234', 2, 1, 1, NULL, '2024-10-17 10:50:59', '2024-10-17 10:50:59'),
(221, 4, '1234', 2, 1, 1, NULL, '2024-10-17 11:55:17', '2024-10-17 11:55:17'),
(222, 4, '1234', 2, 1, 1, NULL, '2024-10-17 12:55:39', '2024-10-17 12:55:39'),
(223, 4, '1234', 2, 1, 1, NULL, '2024-10-18 06:06:23', '2024-10-18 06:06:23'),
(224, 4, '1234', 2, 1, 1, NULL, '2024-10-18 07:07:17', '2024-10-18 07:07:17'),
(225, 2, '1234', 2, 1, 1, NULL, '2024-10-18 07:38:36', '2024-10-18 07:38:36'),
(226, 4, '1234', 2, 1, 1, NULL, '2024-10-18 08:08:59', '2024-10-18 08:08:59'),
(227, 4, '1234', 2, 1, 1, NULL, '2024-10-18 09:50:04', '2024-10-18 09:50:04'),
(228, 2, '1234', 2, 1, 1, NULL, '2024-10-18 10:20:11', '2024-10-18 10:20:11'),
(229, 2, '1234', 2, 1, 1, NULL, '2024-10-18 10:21:16', '2024-10-18 10:21:16'),
(230, 8, '1234', 2, 1, 1, NULL, '2024-10-18 10:24:38', '2024-10-18 10:24:38'),
(231, 2, '1234', 2, 1, 1, NULL, '2024-10-18 10:36:45', '2024-10-18 10:36:45'),
(232, 2, '1234', 2, 1, 1, NULL, '2024-10-18 10:59:46', '2024-10-18 10:59:46'),
(233, 2, '1234', 2, 1, 1, NULL, '2024-10-18 11:01:04', '2024-10-18 11:01:04'),
(234, 2, '1234', 2, 1, 1, NULL, '2024-10-18 11:02:26', '2024-10-18 11:02:26'),
(235, 8, '1234', 2, 1, 1, NULL, '2024-10-18 11:03:30', '2024-10-18 11:03:30'),
(236, 8, '1234', 2, 1, 1, NULL, '2024-10-18 11:04:22', '2024-10-18 11:04:22'),
(237, 8, '1234', 2, 1, 1, NULL, '2024-10-18 11:05:59', '2024-10-18 11:05:59'),
(238, 4, '1234', 2, 1, 1, NULL, '2024-10-18 11:07:41', '2024-10-18 11:07:41'),
(239, 2, '1234', 2, 1, 1, NULL, '2024-10-18 11:07:57', '2024-10-18 11:07:57'),
(240, 2, '1234', 2, 1, 1, NULL, '2024-10-18 11:09:58', '2024-10-18 11:09:58'),
(241, 2, '1234', 2, 1, 1, NULL, '2024-10-18 11:10:23', '2024-10-18 11:10:23'),
(242, 2, '1234', 2, 1, 1, NULL, '2024-10-18 11:28:52', '2024-10-18 11:28:52'),
(243, 4, '1234', 2, 1, 1, NULL, '2024-10-18 12:20:18', '2024-10-18 12:20:18'),
(244, 2, '1234', 2, 1, 1, NULL, '2024-10-18 12:20:56', '2024-10-18 12:20:56'),
(245, 4, '1234', 2, 1, 1, NULL, '2024-10-18 12:28:43', '2024-10-18 12:28:43'),
(246, 4, '1234', 2, 1, 1, NULL, '2024-10-18 12:35:05', '2024-10-18 12:35:05'),
(247, 1, '269709', 1, 3, 2, 'access user location', '2024-10-18 12:39:27', '2024-10-18 12:39:27'),
(248, 1, '317448', 1, 3, 2, 'access user location', '2024-10-18 12:39:29', '2024-10-18 12:39:29'),
(249, 1, '245674', 1, 3, 2, 'access user location', '2024-10-18 12:39:30', '2024-10-18 12:39:30'),
(250, 1, '999867', 1, 3, 2, 'access user location', '2024-10-18 12:39:31', '2024-10-18 12:39:31'),
(251, 1, '278602', 1, 3, 2, 'access user location', '2024-10-18 12:39:31', '2024-10-18 12:39:31'),
(252, 2, '1234', 2, 1, 1, NULL, '2024-10-18 12:48:48', '2024-10-18 12:48:48'),
(253, 2, '1234', 2, 1, 1, NULL, '2024-10-18 13:04:33', '2024-10-18 13:04:33'),
(254, 2, '1234', 2, 1, 1, NULL, '2024-10-18 13:30:49', '2024-10-18 13:30:49'),
(255, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:30:24', '2024-10-21 05:30:24'),
(256, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:32:52', '2024-10-21 05:32:52'),
(257, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:35:47', '2024-10-21 05:35:47'),
(258, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:36:07', '2024-10-21 05:36:07'),
(259, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:36:15', '2024-10-21 05:36:15'),
(260, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:37:33', '2024-10-21 05:37:33'),
(261, 4, '1234', 2, 1, 1, NULL, '2024-10-21 05:41:29', '2024-10-21 05:41:29'),
(262, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:41:46', '2024-10-21 05:41:46'),
(263, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:43:22', '2024-10-21 05:43:22'),
(264, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:43:47', '2024-10-21 05:43:47'),
(265, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:43:48', '2024-10-21 05:43:48'),
(266, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:43:49', '2024-10-21 05:43:49'),
(267, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:43:50', '2024-10-21 05:43:50'),
(268, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:43:56', '2024-10-21 05:43:56'),
(269, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:43:56', '2024-10-21 05:43:56'),
(270, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:44:17', '2024-10-21 05:44:17'),
(271, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:44:34', '2024-10-21 05:44:34'),
(272, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:44:44', '2024-10-21 05:44:44'),
(273, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:44:44', '2024-10-21 05:44:44'),
(274, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:44:59', '2024-10-21 05:44:59'),
(275, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:45:04', '2024-10-21 05:45:04'),
(276, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:45:27', '2024-10-21 05:45:27'),
(277, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:45:33', '2024-10-21 05:45:33'),
(278, 8, '1234', 1, 1, 1, NULL, '2024-10-21 05:45:39', '2024-10-21 05:45:39'),
(279, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:45:50', '2024-10-21 05:45:50'),
(280, 2, '1234', 2, 1, 1, NULL, '2024-10-21 05:46:06', '2024-10-21 05:46:06'),
(281, 2, '1234', 2, 1, 1, NULL, '2024-10-21 06:50:58', '2024-10-21 06:50:58'),
(282, 2, '1234', 2, 1, 1, NULL, '2024-10-21 06:59:14', '2024-10-21 06:59:14'),
(283, 2, '1234', 2, 1, 1, NULL, '2024-10-21 07:00:45', '2024-10-21 07:00:45'),
(284, 4, '1234', 2, 1, 1, NULL, '2024-10-21 07:00:55', '2024-10-21 07:00:55'),
(285, 4, '1234', 2, 1, 1, NULL, '2024-10-21 07:08:44', '2024-10-21 07:08:44'),
(286, 2, '1234', 2, 1, 1, NULL, '2024-10-21 07:10:45', '2024-10-21 07:10:45'),
(287, 2, '1234', 2, 1, 1, NULL, '2024-10-21 07:23:07', '2024-10-21 07:23:07'),
(288, 2, '1234', 2, 1, 1, NULL, '2024-10-21 07:48:39', '2024-10-21 07:48:39'),
(289, 2, '1234', 2, 1, 1, NULL, '2024-10-21 07:49:27', '2024-10-21 07:49:27'),
(290, 2, '1234', 2, 1, 1, NULL, '2024-10-21 07:49:51', '2024-10-21 07:49:51'),
(291, 2, '1234', 2, 1, 1, NULL, '2024-10-21 08:03:57', '2024-10-21 08:03:57'),
(292, 2, '1234', 2, 1, 1, NULL, '2024-10-21 08:04:06', '2024-10-21 08:04:06'),
(293, 2, '1234', 2, 1, 1, NULL, '2024-10-21 09:31:54', '2024-10-21 09:31:54'),
(294, 2, '1234', 2, 1, 1, NULL, '2024-10-21 10:32:39', '2024-10-21 10:32:39'),
(295, 4, '7651', 2, 3, 1, NULL, '2024-10-21 10:33:24', '2024-10-21 10:33:24'),
(296, 4, '1234', 2, 1, 1, NULL, '2024-10-21 10:42:01', '2024-10-21 10:42:01'),
(297, 2, '1234', 2, 1, 1, NULL, '2024-10-21 10:43:01', '2024-10-21 10:43:01'),
(298, 2, '1234', 2, 1, 1, NULL, '2024-10-21 10:44:28', '2024-10-21 10:44:28'),
(299, 4, '1234', 2, 1, 1, NULL, '2024-10-21 10:56:15', '2024-10-21 10:56:15'),
(300, 1, '629728', 1, 3, 2, 'access user location', '2024-10-21 10:59:18', '2024-10-21 10:59:18'),
(301, 1, '038362', 1, 3, 2, 'access user location', '2024-10-21 10:59:40', '2024-10-21 10:59:40'),
(302, 1, '613553', 1, 3, 2, 'access user location', '2024-10-21 10:59:41', '2024-10-21 10:59:41'),
(303, 1, '337064', 1, 3, 2, 'access user location', '2024-10-21 11:01:32', '2024-10-21 11:01:32'),
(304, 1, '354424', 1, 3, 2, 'access user location', '2024-10-21 11:05:17', '2024-10-21 11:05:17'),
(305, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:06:29', '2024-10-21 11:06:29'),
(306, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:10:43', '2024-10-21 11:10:43'),
(307, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:14:05', '2024-10-21 11:14:05'),
(308, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:14:21', '2024-10-21 11:14:21'),
(309, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:14:30', '2024-10-21 11:14:30'),
(310, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:14:44', '2024-10-21 11:14:44'),
(311, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:15:12', '2024-10-21 11:15:12'),
(312, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:16:03', '2024-10-21 11:16:03'),
(313, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:18:38', '2024-10-21 11:18:38'),
(314, 2, '1234', 2, 1, 1, NULL, '2024-10-21 11:22:46', '2024-10-21 11:22:46'),
(315, 1, '341019', 1, 3, 2, 'access user location', '2024-10-21 11:32:52', '2024-10-21 11:32:52'),
(316, 1, '611956', 2, 3, 2, 'access user location', '2024-10-21 11:32:55', '2024-10-21 11:32:55'),
(317, 2, '1234', 2, 1, 1, NULL, '2024-10-21 12:23:52', '2024-10-21 12:23:52'),
(318, 2, '1234', 2, 1, 1, NULL, '2024-10-21 12:26:12', '2024-10-21 12:26:12'),
(319, 2, '1234', 2, 1, 1, NULL, '2024-10-21 12:32:09', '2024-10-21 12:32:09'),
(320, 2, '1234', 2, 1, 1, NULL, '2024-10-21 12:33:29', '2024-10-21 12:33:29'),
(321, 2, '1234', 2, 1, 1, NULL, '2024-10-21 12:34:52', '2024-10-21 12:34:52'),
(322, 2, '1234', 2, 1, 1, NULL, '2024-10-21 12:44:35', '2024-10-21 12:44:35'),
(323, 2, '1234', 2, 1, 1, NULL, '2024-10-21 12:50:44', '2024-10-21 12:50:44'),
(324, 2, '1234', 2, 1, 1, NULL, '2024-10-21 12:52:37', '2024-10-21 12:52:37'),
(325, 2, '1234', 2, 1, 1, NULL, '2024-10-22 04:25:50', '2024-10-22 04:25:50'),
(326, 2, '1234', 2, 1, 1, NULL, '2024-10-22 05:44:27', '2024-10-22 05:44:27'),
(327, 4, '1234', 1, 3, 1, NULL, '2024-10-22 06:24:47', '2024-10-22 06:24:47'),
(328, 2, '1234', 2, 1, 1, NULL, '2024-10-22 06:36:53', '2024-10-22 06:36:53'),
(329, 2, '1234', 2, 1, 1, NULL, '2024-10-22 06:41:56', '2024-10-22 06:41:56'),
(330, 2, '1234', 2, 1, 1, NULL, '2024-10-22 06:49:23', '2024-10-22 06:49:23'),
(331, 2, '1234', 2, 1, 1, NULL, '2024-10-22 06:49:53', '2024-10-22 06:49:53'),
(332, 2, '1234', 2, 1, 1, NULL, '2024-10-22 06:51:27', '2024-10-22 06:51:27'),
(333, 2, '1234', 2, 1, 1, NULL, '2024-10-22 06:51:46', '2024-10-22 06:51:46'),
(334, 2, '1234', 2, 1, 1, NULL, '2024-10-22 08:06:12', '2024-10-22 08:06:12'),
(335, 2, '1234', 2, 1, 1, NULL, '2024-10-22 09:14:08', '2024-10-22 09:14:08'),
(336, 2, '1234', 2, 1, 1, NULL, '2024-10-22 10:21:41', '2024-10-22 10:21:41'),
(337, 2, '1234', 2, 1, 1, NULL, '2024-10-22 10:56:27', '2024-10-22 10:56:27'),
(338, 2, '1234', 2, 1, 1, NULL, '2024-10-22 10:58:39', '2024-10-22 10:58:39'),
(339, 2, '1234', 2, 1, 1, NULL, '2024-10-22 11:32:14', '2024-10-22 11:32:14'),
(340, 2, '1234', 2, 1, 1, NULL, '2024-10-22 11:42:36', '2024-10-22 11:42:36'),
(341, 2, '1234', 2, 1, 1, NULL, '2024-10-22 11:45:06', '2024-10-22 11:45:06'),
(342, 2, '1234', 2, 1, 1, NULL, '2024-10-22 12:47:52', '2024-10-22 12:47:52'),
(343, 2, '1234', 2, 1, 1, NULL, '2024-10-23 05:33:03', '2024-10-23 05:33:03'),
(344, 2, '1234', 2, 1, 1, NULL, '2024-10-23 06:00:03', '2024-10-23 06:00:03'),
(345, 2, '1234', 2, 1, 1, NULL, '2024-10-23 06:02:02', '2024-10-23 06:02:02'),
(346, 2, '1234', 2, 1, 1, NULL, '2024-10-23 06:02:59', '2024-10-23 06:02:59'),
(347, 2, '1234', 2, 1, 1, NULL, '2024-10-23 06:03:46', '2024-10-23 06:03:46'),
(348, 2, '1234', 2, 1, 1, NULL, '2024-10-23 06:04:27', '2024-10-23 06:04:27'),
(349, 2, '1234', 2, 1, 1, NULL, '2024-10-23 07:05:16', '2024-10-23 07:05:16'),
(350, 2, '1234', 2, 1, 1, NULL, '2024-10-23 09:17:15', '2024-10-23 09:17:15'),
(351, 2, '1234', 2, 1, 1, NULL, '2024-10-23 10:25:21', '2024-10-23 10:25:21'),
(352, 2, '1234', 2, 1, 1, NULL, '2024-10-23 11:22:58', '2024-10-23 11:22:58'),
(353, 2, '1234', 2, 1, 1, NULL, '2024-10-23 12:07:10', '2024-10-23 12:07:10'),
(354, 4, '1234', 2, 1, 1, NULL, '2024-10-23 12:14:11', '2024-10-23 12:14:11'),
(355, 2, '1234', 2, 1, 1, NULL, '2024-10-23 12:34:19', '2024-10-23 12:34:19'),
(356, 2, '1234', 2, 1, 1, NULL, '2024-10-23 15:38:49', '2024-10-23 15:38:49'),
(357, 2, '1234', 2, 1, 1, NULL, '2024-10-23 15:39:23', '2024-10-23 15:39:23'),
(358, 2, '1234', 2, 1, 1, NULL, '2024-10-24 04:08:07', '2024-10-24 04:08:07'),
(359, 2, '1234', 2, 1, 1, NULL, '2024-10-24 04:32:07', '2024-10-24 04:32:07'),
(360, 2, '1234', 2, 1, 1, NULL, '2024-10-24 05:40:36', '2024-10-24 05:40:36'),
(361, 2, '1234', 2, 1, 1, NULL, '2024-10-24 06:40:54', '2024-10-24 06:40:54'),
(362, 2, '1234', 2, 1, 1, NULL, '2024-10-24 07:45:35', '2024-10-24 07:45:35'),
(363, 2, '1234', 2, 1, 1, NULL, '2024-10-24 09:14:34', '2024-10-24 09:14:34'),
(364, 2, '1234', 2, 1, 1, NULL, '2024-10-24 11:27:36', '2024-10-24 11:27:36'),
(365, 2, '1234', 2, 1, 1, NULL, '2024-10-24 12:28:53', '2024-10-24 12:28:53'),
(366, 2, '1234', 2, 1, 1, NULL, '2024-10-24 13:16:01', '2024-10-24 13:16:01'),
(367, 2, '1234', 2, 1, 1, NULL, '2024-10-24 13:16:35', '2024-10-24 13:16:35'),
(368, 2, '1234', 2, 1, 1, NULL, '2024-10-24 13:21:09', '2024-10-24 13:21:09'),
(369, 1, '542224', 1, 3, 2, 'access user location', '2024-10-25 11:27:17', '2024-10-25 11:27:17'),
(370, 1, '788802', 2, 3, 2, 'access user location', '2024-10-28 06:12:02', '2024-10-28 06:12:02'),
(371, 1, '457516', 1, 3, 2, 'access user location', '2024-10-28 06:12:32', '2024-10-28 06:12:32'),
(372, 1, '616851', 1, 3, 2, 'access user location', '2024-10-28 06:12:42', '2024-10-28 06:12:42'),
(373, 1, '002478', 1, 3, 2, 'access user location', '2024-11-08 13:11:11', '2024-11-08 13:11:11'),
(374, 1, '502096', 1, 3, 2, 'access user location', '2024-11-11 05:42:59', '2024-11-11 05:42:59'),
(375, 15, '1234', 2, 1, 1, NULL, '2024-11-13 11:18:03', '2024-11-13 11:18:03'),
(376, 15, '3974', 2, 1, 1, NULL, '2024-11-13 11:28:59', '2024-11-13 11:28:59'),
(377, 16, '2661', 2, 1, 1, NULL, '2024-11-13 12:24:19', '2024-11-13 12:24:19'),
(378, 16, '1234', 2, 1, 1, NULL, '2024-11-14 05:49:22', '2024-11-14 05:49:22'),
(379, 16, '1234', 2, 1, 1, NULL, '2024-11-14 07:16:22', '2024-11-14 07:16:22'),
(380, 16, '1234', 2, 1, 1, NULL, '2024-11-14 08:19:30', '2024-11-14 08:19:30'),
(381, 16, '1234', 2, 1, 1, NULL, '2024-11-14 09:19:42', '2024-11-14 09:19:42'),
(382, 16, '1234', 2, 1, 1, NULL, '2024-11-14 10:23:13', '2024-11-14 10:23:13'),
(383, 1, '1234', 2, 1, 1, NULL, '2024-11-14 11:52:45', '2024-11-14 11:52:45'),
(384, 19, '1234', 2, 1, 1, NULL, '2024-11-14 11:59:06', '2024-11-14 11:59:06'),
(385, 20, '1234', 2, 1, 1, NULL, '2024-11-14 12:05:13', '2024-11-14 12:05:13'),
(386, 1, '1234', 2, 1, 1, NULL, '2024-11-19 09:38:19', '2024-11-19 09:38:19'),
(387, 1, '1234', 2, 1, 1, NULL, '2024-11-20 10:50:10', '2024-11-20 10:50:10'),
(388, 1, '1234', 2, 1, 1, NULL, '2024-11-20 12:04:37', '2024-11-20 12:04:37'),
(389, 1, '1234', 2, 1, 1, NULL, '2024-11-20 13:05:58', '2024-11-20 13:05:58'),
(390, 1, '1234', 2, 1, 1, NULL, '2024-11-21 06:09:44', '2024-11-21 06:09:44'),
(391, 1, '1234', 2, 1, 1, NULL, '2024-11-25 05:49:19', '2024-11-25 05:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pet_bookings`
--

CREATE TABLE `tbl_pet_bookings` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `booking_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `booking_time` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Delted',
  `booking_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Pending,2-Confirmed,3-Cancelled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pet_bookings`
--

INSERT INTO `tbl_pet_bookings` (`id`, `customer_id`, `pet_id`, `booking_date`, `booking_time`, `description`, `status`, `booking_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '20-11-2024', '10:20 PM', 'Test', 1, 3, '2024-11-20 12:44:56', '2024-11-20 12:44:56'),
(2, 1, 6, '20-11-2024', '10:20 PM', NULL, 1, 1, '2024-11-20 12:45:01', '2024-11-20 12:45:01'),
(3, 1, 5, '20-11-2024', '10:20 PM', NULL, 1, 1, '2024-11-20 13:06:36', '2024-11-20 13:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_token`
--

CREATE TABLE `tbl_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'users.id',
  `token` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Expire',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_token`
--

INSERT INTO `tbl_token` (`id`, `user_id`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NTI3NTQsImV4cCI6MTcyNzk1NjM1NH0.GBcIca3ONLCsKR2O1zgVtouOKyXH5PG9NTh432fqeEc', 2, '2024-10-03 10:52:34', '2024-10-03 10:52:34'),
(2, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NTM0MjIsImV4cCI6MTcyNzk1NzAyMn0.OmImpidh3vYKwORRSuHlg0qBXwc5shjdeG2UyXo-ld4', 2, '2024-10-03 11:03:42', '2024-10-03 11:03:42'),
(3, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NTU1OTAsImV4cCI6MTcyNzk1OTE5MH0.kTkpGkQypRvPTjV4y6GpjEzkle1eJ37XIWbfIChZa2A', 2, '2024-10-03 11:39:50', '2024-10-03 11:40:09'),
(4, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NTYyNTMsImV4cCI6MTcyNzk1OTg1M30.r4UK9s6AO4ieP4zyUyvw83rFUn1Q76VQKn0TGN-S_aw', 2, '2024-10-03 11:50:53', '2024-10-03 13:04:49'),
(5, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NjA2ODksImV4cCI6MTcyNzk2NDI4OX0.wX3tTJm2ihuooaDRH75THI1wZoXqcUa5aUCIfKSKQzc', 2, '2024-10-03 13:04:49', '2024-10-04 10:09:37'),
(6, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgwMzY1NzcsImV4cCI6MTcyODA0MDE3N30.FABgodaEJXMIeV000-5WQtkMDOSzp9tvc-8HY9oj_iI', 2, '2024-10-04 10:09:37', '2024-10-04 11:43:49'),
(7, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgwNDIyMjksImV4cCI6MTcyODA0NTgyOX0.Y7PFuv3kTudcAyyxSSfvnQHPZGrGyI-nJSscyvC_vLw', 2, '2024-10-04 11:43:49', '2024-10-04 13:36:55'),
(8, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgwNDkwMTUsImV4cCI6MTcyODA1MjYxNX0.0tk4FKpYWjOaRt5y6qlF5knDADZRW3-KH4YNMNRnqrc', 2, '2024-10-04 13:36:55', '2024-10-07 05:26:43'),
(9, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyNzg4MDMsImV4cCI6MTcyODI4MjQwM30.9gYq4taDnn2kFCsKTsGr8YOLkAbmBySlU76LLCHQLDI', 2, '2024-10-07 05:26:43', '2024-10-07 06:35:18'),
(10, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyODI5MTgsImV4cCI6MTcyODI4NjUxOH0.gHg4FINvNkZNvgWXFZ7E8V4hdnELJ416aFKO4R7Utsk', 2, '2024-10-07 06:35:18', '2024-10-07 07:45:39'),
(11, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyODcxMzksImV4cCI6MTcyODI5MDczOX0.cVfXOH4rF1wHWO8o4A9PaVUTYmRBPT2jwuAjhNDcCz4', 2, '2024-10-07 07:45:39', '2024-10-07 09:06:07'),
(12, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyOTE5NjcsImV4cCI6MTcyODI5NTU2N30.Yyx7T5APDnlg2DnrBJwdrWx2pFmuXj1P_WJy0xut4qU', 2, '2024-10-07 09:06:07', '2024-10-07 10:12:08'),
(13, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyOTU5MjgsImV4cCI6MTcyODI5OTUyOH0.dXmmIiIDlMw1-EKjKufbAkPGZx-Ny0V5LN8LvOzfNoQ', 2, '2024-10-07 10:12:08', '2024-10-07 11:22:46'),
(14, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgzMDAxNjYsImV4cCI6MTcyODMwMzc2Nn0.NAAcm9OMQPJ2jcha34VbeJhYKhYoNp6Kt7iaF0FUybc', 2, '2024-10-07 11:22:46', '2024-10-07 12:24:09'),
(15, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgzMDM4NDksImV4cCI6MTcyODMwNzQ0OX0.fbzx6CdLV8Vm9s4qvOf-iuEGSOGBpF0qTjDUpS3ESlg', 2, '2024-10-07 12:24:09', '2024-10-09 10:34:02'),
(16, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjozLCJpYXQiOjE3MjgzNzIyNzgsImV4cCI6MTcyODM3NTg3OH0.I-_xiFH-GtEf8u-CFU7nCpocWS0-z1Fo8Wp2zYKki-Q', 2, '2024-10-08 07:24:38', '2024-10-08 07:36:56'),
(17, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3MzAxNiwiZXhwIjoxNzI4Mzc2NjE2fQ.lnp5qVM_KyOz0rqPgU3INExmcB580Tg32_6-pXXFCE0', 2, '2024-10-08 07:36:56', '2024-10-08 07:39:11'),
(18, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3MzE1MSwiZXhwIjoxNzI4Mzc2NzUxfQ.iMAJxSESjyTYjsfVOlRgG_JgtCvalKWFE-SrPITw75M', 2, '2024-10-08 07:39:11', '2024-10-08 07:46:55'),
(19, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3MzYxNSwiZXhwIjoxNzI4Mzc3MjE1fQ.wI5nO2elMcttMhiOEkjzAbOfBBA7tvLv5nAVM7DDmhk', 2, '2024-10-08 07:46:55', '2024-10-08 07:51:51'),
(20, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3MzkxMSwiZXhwIjoxNzI4Mzc3NTExfQ.nIcxr03wujbXGtoqlHyN45M8iq3q225BmGTCf5JNTNw', 2, '2024-10-08 07:51:51', '2024-10-08 07:59:56'),
(21, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3NDM5NiwiZXhwIjoxNzI4Mzc3OTk2fQ.Wnm6g1jamdFkhk3tVSmV6WMwr39lCORctq0ZXwN9hF4', 2, '2024-10-08 07:59:56', '2024-10-08 08:50:24'),
(22, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3NzQyNCwiZXhwIjoxNzI4MzgxMDI0fQ.mBrTvLiIQnGq5M1nErcBbnLhP6_x4suvDf5LXk8zYoE', 2, '2024-10-08 08:50:24', '2024-10-08 08:52:36'),
(23, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3NzU1NiwiZXhwIjoxNzI4MzgxMTU2fQ.-LOGAPHk77mFo-Il-aVUD84H5nacRQ_SaSkSL74Fn_k', 2, '2024-10-08 08:52:36', '2024-10-08 08:58:07'),
(24, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3Nzg4NywiZXhwIjoxNzI4MzgxNDg3fQ.jbhjEkqWrDG5QVBGuhBSoSBP-A6eQoO92QNUACZ-wYg', 2, '2024-10-08 08:58:07', '2024-10-08 08:59:30'),
(25, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3Nzk3MCwiZXhwIjoxNzI4MzgxNTcwfQ.LtlmcedO61-VdfrITwGQAxN-ybBqTTSBIWrXse5Uh3c', 2, '2024-10-08 08:59:30', '2024-10-08 09:19:43'),
(26, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTE4MywiZXhwIjoxNzI4MzgyNzgzfQ.tF_2K2cd8jO_ad3V1KaoACfPzogT37mVvwsqc8MY1OE', 2, '2024-10-08 09:19:43', '2024-10-08 09:20:13'),
(27, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTIxMywiZXhwIjoxNzI4MzgyODEzfQ.A4qCEHEu2FguhhDXwu2FLzQMohvwjWRJr7J8sMBA5HE', 2, '2024-10-08 09:20:13', '2024-10-08 09:22:02'),
(28, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTMyMiwiZXhwIjoxNzI4MzgyOTIyfQ.SOEA4t6_hAqpvT8IeMx-ilf4uXOGOMYUUr5vs2TEzpQ', 2, '2024-10-08 09:22:02', '2024-10-08 09:22:21'),
(29, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTM0MSwiZXhwIjoxNzI4MzgyOTQxfQ.yamV7X9EeMKWQh9mjrQbONqjbVOpXc425butegq90GM', 2, '2024-10-08 09:22:21', '2024-10-08 09:23:57'),
(30, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTQzNywiZXhwIjoxNzI4MzgzMDM3fQ.fH5Nk0Ry6LetXpQ6IsqZbIadhnrXicI0tR1CQrkuaKs', 2, '2024-10-08 09:23:57', '2024-10-08 09:25:05'),
(31, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTUwNSwiZXhwIjoxNzI4MzgzMTA1fQ.snUApfRdLeWXHWX8e3PljCKlRwgz4OetUx-pERl5Hqc', 2, '2024-10-08 09:25:05', '2024-10-08 09:28:11'),
(32, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTY5MSwiZXhwIjoxNzI4MzgzMjkxfQ.KNdrL3FT4vYDGtZtZqiN_3MHv4CpoLETNqB85fnuYYs', 2, '2024-10-08 09:28:11', '2024-10-08 09:30:34'),
(33, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTgzNCwiZXhwIjoxNzI4MzgzNDM0fQ.HZin7Zglup4sFa_lfRTGukrNFhp5oVr_Sxh8AcGlLQI', 2, '2024-10-08 09:30:34', '2024-10-08 09:31:50'),
(34, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTkxMCwiZXhwIjoxNzI4MzgzNTEwfQ.b6qZIY_pR59kzRiqdvcdlXmhqH7WnEGeoxS0HsLorik', 2, '2024-10-08 09:31:50', '2024-10-08 09:32:30'),
(35, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTk1MCwiZXhwIjoxNzI4MzgzNTUwfQ.OPYzv7_FAm24dWr6Vs4J9E3fSXG0ooo690GudEAzoIc', 2, '2024-10-08 09:32:30', '2024-10-08 09:32:42'),
(36, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTk2MiwiZXhwIjoxNzI4MzgzNTYyfQ.RsKIVgqSo0reK9Qx3yvAaGrS38EcD0ZEO0XE6EArwpU', 2, '2024-10-08 09:32:42', '2024-10-08 09:47:28'),
(37, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4MDg0OCwiZXhwIjoxNzI4Mzg0NDQ4fQ.ZbpGgYBDPM5xxqWS9GPQItf5SI-oPQceEALAEx4oIpE', 2, '2024-10-08 09:47:28', '2024-10-08 10:04:48'),
(38, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4MTg4OCwiZXhwIjoxNzI4Mzg1NDg4fQ.RRSthqfRCTAx1ufAk3gjbhm1tbuoEnN52YDH84g8KvU', 2, '2024-10-08 10:04:48', '2024-10-08 11:05:20'),
(39, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4NTUyMCwiZXhwIjoxNzI4Mzg5MTIwfQ.vwB8a34KgC7ynvANOdk37ZjhnRQ4SKisa2nZgrsh1sc', 2, '2024-10-08 11:05:20', '2024-10-08 11:50:08'),
(40, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4ODMwOCwiZXhwIjoxNzI4MzkxOTA4fQ.snB6JGWEmlJXVgx1oPNF7YAXDuYVHkeaYX5kRAphzf4', 2, '2024-10-08 11:51:48', '2024-10-08 12:04:10'),
(41, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4OTA1MCwiZXhwIjoxNzI4MzkyNjUwfQ.lbi0O5Yb073U-hNiGWZNegp9nr6qq9DM6no0AOVkPEs', 2, '2024-10-08 12:04:10', '2024-10-08 12:04:52'),
(42, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4OTA5MiwiZXhwIjoxNzI4MzkyNjkyfQ.0CyppAxpTGpVmnvznVie3ngkdctpi2jfYUpK1mNKfbE', 2, '2024-10-08 12:04:52', '2024-10-08 12:06:13'),
(43, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4OTE3MywiZXhwIjoxNzI4MzkyNzczfQ.zfe0TuoaUjdM3zsYWf1nBKSwRzLM8T7RJcWjR2Ihnc8', 2, '2024-10-08 12:06:13', '2024-10-08 12:20:32'),
(44, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MDQxOCwiZXhwIjoxNzI4Mzk0MDE4fQ.A1nhzbLRSw6XY_WFl4anv22aOEVnG4fkH7zykCY4-l8', 2, '2024-10-08 12:26:58', '2024-10-08 12:28:26'),
(45, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MDUwNiwiZXhwIjoxNzI4Mzk0MTA2fQ.v-XCzE4l12XCpdNp7-VMyT37rYuMsKMmZWUTRKlnLSg', 2, '2024-10-08 12:28:26', '2024-10-08 12:29:43'),
(46, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MDU4MywiZXhwIjoxNzI4Mzk0MTgzfQ.ChXsZUn6ILug8IM6impCdBu1yVjAp7HNz9pvT0ZRcEA', 2, '2024-10-08 12:29:43', '2024-10-08 12:37:07'),
(47, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTAyNywiZXhwIjoxNzI4Mzk0NjI3fQ.xaoymZOnVYQCELVN7YVNUSzSoTu2VzGgYVEXaR62NRg', 2, '2024-10-08 12:37:07', '2024-10-08 12:37:38'),
(48, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTA4NCwiZXhwIjoxNzI4Mzk0Njg0fQ.HuOlv_83OMPFuQJjpCXpBPXZk8jMSXSUrX-MyyxAFf8', 2, '2024-10-08 12:38:04', '2024-10-08 12:39:12'),
(49, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTE3MSwiZXhwIjoxNzI4Mzk0NzcxfQ.bDqDF8Bc_vUDOe-1SKgvmhq-pxT0jZgeZRqwfGwPkJk', 2, '2024-10-08 12:39:31', '2024-10-08 12:40:45'),
(50, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTI1OSwiZXhwIjoxNzI4Mzk0ODU5fQ.SlQVKo25LwYenZrdpMW4HMpQj0q0oy0cSUFGZD9y9ng', 2, '2024-10-08 12:40:59', '2024-10-08 12:45:23'),
(51, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTU4NywiZXhwIjoxNzI4Mzk1MTg3fQ.4WNjudCstDXBxfAydJKkjjV6VLI1kZl3hBOClNx5DPs', 2, '2024-10-08 12:46:27', '2024-10-08 12:47:06'),
(52, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTYzNiwiZXhwIjoxNzI4Mzk1MjM2fQ.h_77J0TXdhvCPEp1rJhI6W_sg3usoqW5eehGpaDl9cE', 2, '2024-10-08 12:47:16', '2024-10-08 12:48:03'),
(53, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTY5MywiZXhwIjoxNzI4Mzk1MjkzfQ.9dWebJJZ1zIB2_SdExJErqstcT0Ub4Xkmn7JBw9WU4c', 2, '2024-10-08 12:48:13', '2024-10-08 12:48:33'),
(54, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTc1OCwiZXhwIjoxNzI4Mzk1MzU4fQ.1yDRUeLs-_j7c_ZCvmlRXiuQrV6ZuZkx9uzsHwRZzYE', 2, '2024-10-08 12:49:18', '2024-10-08 12:50:03'),
(55, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTgwMywiZXhwIjoxNzI4Mzk1NDAzfQ.ESxivPgms584HO3CA1IffCw08FQiDQMb_pL6CmmRHlM', 2, '2024-10-08 12:50:03', '2024-10-08 12:50:53'),
(56, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTg1MywiZXhwIjoxNzI4Mzk1NDUzfQ.e8m8lOZCmyZM_avFOa5cfgL6ncbUOQSj3p9c5X7ZzXI', 2, '2024-10-08 12:50:53', '2024-10-08 12:53:54'),
(57, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MjAzNCwiZXhwIjoxNzI4Mzk1NjM0fQ.4suYMqo_IH0ftVgSX3X9F1bARknK-5if9dgQ8phUaHA', 2, '2024-10-08 12:53:54', '2024-10-08 12:58:34'),
(58, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MjMyOCwiZXhwIjoxNzI4Mzk1OTI4fQ.BcV1J7y_A644UXTEAB5lggJPYTSkCDuHZNE2mv_pBDw', 2, '2024-10-08 12:58:48', '2024-10-08 13:25:02'),
(59, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MzkxNywiZXhwIjoxNzI4Mzk3NTE3fQ.XPJiT4o3O_OhhqaUXFIo5fVXpvAUng4gS4muO89mYl4', 2, '2024-10-08 13:25:17', '2024-10-09 04:45:44'),
(60, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQwMDg1NSwiZXhwIjoxNzI4NDA0NDU1fQ.eW6SnnklD3iU0BAgg2uHp2zeWm_-GJgYIS1SGnZ4n0E', 2, '2024-10-08 15:20:55', '2024-10-08 18:04:24'),
(61, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQxMDY2NCwiZXhwIjoxNzI4NDE0MjY0fQ.z-HsgOLrw_BwoWDH9jk1Ir10SQ72Hru2JRwr2Obrvjk', 2, '2024-10-08 18:04:24', '2024-10-09 06:13:27'),
(62, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ0OTE0NCwiZXhwIjoxNzI4NDUyNzQ0fQ.47UdQq2UhguWftJsJQt1n0wnSXuni9D0HSsQwuQbbeA', 2, '2024-10-09 04:45:44', '2024-10-09 04:46:02'),
(63, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ0OTE2MiwiZXhwIjoxNzI4NDUyNzYyfQ.pIx3Jau56qRjqjWZKkDoT2wZEYprYfV7cvayJFO6p44', 2, '2024-10-09 04:46:02', '2024-10-09 05:17:58'),
(64, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ1MTEwMywiZXhwIjoxNzI4NDU0NzAzfQ.z3dC8iSZzs5O6brKXuIfZkWffzS1SpadvdZxjjFvvrQ', 2, '2024-10-09 05:18:23', '2024-10-09 06:03:29'),
(65, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NDQwNywiZXhwIjoxNzI4NDU4MDA3fQ.OT84rs8f9jARDEWW8kQWitO4yyF0CIgoRjRHEgwjG7A', 2, '2024-10-09 06:13:27', '2024-10-09 06:13:38'),
(66, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NDQxOCwiZXhwIjoxNzI4NDU4MDE4fQ.EoXBao_SLFsg48JPuwlpe2LDBAOJ25YqaTqRaVRuWSI', 2, '2024-10-09 06:13:38', '2024-10-09 06:13:51'),
(67, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NDQzMSwiZXhwIjoxNzI4NDU4MDMxfQ.Wq0jc1A0AyJRU8vluNk-aNaBNJKpXb3GAMGekUAh0vk', 2, '2024-10-09 06:13:51', '2024-10-09 06:14:12'),
(68, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NDQ4MywiZXhwIjoxNzI4NDU4MDgzfQ.0HsBWAiVOhijSdKQ5LBwxeCy9I5GQ2ieula26CqC_4s', 2, '2024-10-09 06:14:43', '2024-10-09 06:29:30'),
(69, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NTM3OSwiZXhwIjoxNzI4NDU4OTc5fQ.JvoAk648IElgMm9jlPJe58KPko9xtkiWlzZgsH9R7us', 2, '2024-10-09 06:29:39', '2024-10-09 07:45:34'),
(70, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1OTkzNCwiZXhwIjoxNzI4NDYzNTM0fQ.BhwQAvt_MocQc2VInJNb4crjwo7wqeY7AG5Zte7RmqM', 2, '2024-10-09 07:45:34', '2024-10-09 07:46:43'),
(71, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2MDAyOSwiZXhwIjoxNzI4NDYzNjI5fQ.mU-kmgr3-jHyMIWYPGlO7JxvN3QCZ1AebuCq2sipcSI', 2, '2024-10-09 07:47:09', '2024-10-09 09:56:41'),
(72, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2NzgwMSwiZXhwIjoxNzI4NDcxNDAxfQ.fb-pn08Bj-76tyR2In8blZg2fN_ks1t-FQPw6wXCKKM', 2, '2024-10-09 09:56:41', '2024-10-09 09:57:36'),
(73, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2Nzg1NiwiZXhwIjoxNzI4NDcxNDU2fQ.MytQ8Uh5Rfs7B2AErQYrZHwC7SRS7A8oo2I5Wq2YDFc', 2, '2024-10-09 09:57:36', '2024-10-09 10:00:09'),
(74, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2ODE1MywiZXhwIjoxNzI4NDcxNzUzfQ.O39tK7WKMMhHwBCyT2XvoysRbQ2yioky0oUHoc816e0', 2, '2024-10-09 10:02:33', '2024-10-09 10:06:49'),
(75, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2ODQwOSwiZXhwIjoxNzI4NDcyMDA5fQ.MAH_GzExQ58k_Gd6IqY5_J2whLnX6QHfE6fg9NkSXSY', 2, '2024-10-09 10:06:49', '2024-10-09 10:11:21'),
(76, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2ODY4MSwiZXhwIjoxNzI4NDcyMjgxfQ.b9cqlw8uHVp9NOKNL76n0XF9YwnK68-KwafSkKSoQ1w', 2, '2024-10-09 10:11:21', '2024-10-09 10:50:11'),
(77, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ2ODgxOCwiZXhwIjoxNzI4NDcyNDE4fQ.FS72nWO9wBRLuKwxF10OIJcIApd1UoQOz4k8AA5rIhI', 2, '2024-10-09 10:13:38', '2024-10-09 10:40:12'),
(78, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjEsImlhdCI6MTcyODQ3MDA0MiwiZXhwIjoxNzI4NDczNjQyfQ.lPQtaqWWIkUz_Cx5dbm2yEH6d2ULf8ocLSkdOmq5_8c', 2, '2024-10-09 10:34:02', '2024-11-14 11:53:14'),
(79, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ3MDQxMiwiZXhwIjoxNzI4NDc0MDEyfQ.hni4tSXMZZUSUe0Dj4Q6Sg0VcV45L50csExj2sVMKb4', 1, '2024-10-09 10:40:12', '2024-10-09 10:40:12'),
(80, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ3MTAxMSwiZXhwIjoxNzI4NDc0NjExfQ.SIl46zhpxwshdZi_OrPguWH2nKYsU1UJrdQ9v6W53ZQ', 2, '2024-10-09 10:50:11', '2024-10-09 10:50:29'),
(81, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ3MTAyOSwiZXhwIjoxNzI4NDc0NjI5fQ.z9m_PMVBW3waQ2OzVYIQV8kcoEt3-eekqRGCc7xdYKk', 2, '2024-10-09 10:50:29', '2024-10-09 12:29:06'),
(82, 6, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjYsImlhdCI6MTcyODQ3MjcwNiwiZXhwIjoxNzI4NDc2MzA2fQ.6n-hF2CPseApTaEIgYjXf9c7co2w3mt7yuSNgkGnAcc', 1, '2024-10-09 11:18:26', '2024-10-09 11:18:26'),
(83, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ3NzAxNywiZXhwIjoxNzI4NDgwNjE3fQ.cbt51weNgddF9JNRET0FUIUNGL2TXPKpXD7qsalTU6Q', 2, '2024-10-09 12:30:17', '2024-10-09 13:11:15'),
(84, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ3OTQ3NSwiZXhwIjoxNzI4NDgzMDc1fQ.vUcgIhcB63U0YGxeKUeQVKaElC2d8bJxHtnVYn3UuTs', 2, '2024-10-09 13:11:15', '2024-10-09 13:50:04'),
(85, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ4MTgwNCwiZXhwIjoxNzI4NDg1NDA0fQ.A8KWPVR0mpL5IbekwnPQn3HC51COAT8SBG8KGzeqTWY', 2, '2024-10-09 13:50:04', '2024-10-09 15:39:42'),
(86, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ4ODM4MiwiZXhwIjoxNzI4NDkxOTgyfQ.047c211I7yhKHoCbSQkIsCZboeVaQxaNGm6xyqy3TIs', 2, '2024-10-09 15:39:42', '2024-10-17 07:50:18'),
(87, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyODg4OTQ3MCwiZXhwIjoxNzI4ODkzMDcwfQ.JJ8jjYBoNJ7xiuKHL6XlakrqPJdR3I5eomMkxMPUIRY', 2, '2024-10-14 07:04:30', '2024-10-14 07:31:11'),
(88, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyODg5MTA3MSwiZXhwIjoxNzI4ODk0NjcxfQ.3MxoRvnT_xpI9znZKLs9iyQzRZD17ERMvX6rqLsdLH8', 2, '2024-10-14 07:31:11', '2024-10-14 09:18:08'),
(89, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyODg5NzQ5OSwiZXhwIjoxNzI4OTAxMDk5fQ.CCuSTsBzGij9awLXCl1lhIj7pQPnPSlMwNLNoLIa_JA', 2, '2024-10-14 09:18:19', '2024-10-15 06:38:26'),
(90, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyODk3NDMwNiwiZXhwIjoxNzI4OTc3OTA2fQ.14wkX2M9zK1wdwRRFGTIVG2AfUTrsgVtP6q4zPS1U5I', 2, '2024-10-15 06:38:26', '2024-10-15 10:18:02'),
(91, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyODk4NzUxOSwiZXhwIjoxNzI4OTkxMTE5fQ.p-HPD1GzwlWRhMYDeuhen1mahg7_4iQlOURKIZrKnsk', 2, '2024-10-15 10:18:39', '2024-10-15 11:22:42'),
(92, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyODk5MTM2MiwiZXhwIjoxNzI4OTk0OTYyfQ.Cq-bHXn21eCCm62YW2QX_Hwa5XoImKOS14yRQ2Rij6U', 2, '2024-10-15 11:22:42', '2024-10-17 04:49:24'),
(93, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTE0MDU2NCwiZXhwIjoxNzI5MTQ0MTY0fQ.IlS__J2FoF3rFNBwPpbwMGc5_CX8z42t_Fcnxx_Rwnw', 2, '2024-10-17 04:49:24', '2024-10-17 04:51:54'),
(94, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTE0MDcxNCwiZXhwIjoxNzI5MTQ0MzE0fQ.zSnSAjmqD2jGBIz2xa5nO6WwePTeoZTyK02gYHQ9mmY', 2, '2024-10-17 04:51:54', '2024-10-17 04:53:29'),
(95, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTE0MDgwOSwiZXhwIjoxNzI5MTQ0NDA5fQ.tTWjs_z_wTB3WuE2KzjZWF_tRGqFwR9Hp6p6VEyyoQk', 2, '2024-10-17 04:53:29', '2024-10-17 04:55:51'),
(96, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTE0MDk1MSwiZXhwIjoxNzI5MTQ0NTUxfQ.954dGIK-I1utqHGkM_lUA-N0V3EzU9PLXSVgW7CsXJU', 2, '2024-10-17 04:55:51', '2024-10-17 05:03:34'),
(97, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTE0MTQxNCwiZXhwIjoxNzI5MTQ1MDE0fQ.CrVirKcvndc3hVB-H_xuwmhaE-pcyFjTWcRoJLqtZis', 2, '2024-10-17 05:03:34', '2024-10-17 05:40:08'),
(98, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTE0MzYwOCwiZXhwIjoxNzI5MTQ3MjA4fQ.rR9jU3KOWrqb9zmUy9jw8t77P00C_SJt0JgSbmwnZIA', 2, '2024-10-17 05:40:08', '2024-10-17 05:57:00'),
(99, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTE0NDYyMCwiZXhwIjoxNzI5MTQ4MjIwfQ.GZBGylQk-YmRBiqmRN1ateCNy-B7Y_ylHwXiPHWK5_w', 2, '2024-10-17 05:57:00', '2024-10-17 06:49:43'),
(100, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTE0Nzc4MywiZXhwIjoxNzI5MTUxMzgzfQ.0ExSvPycRVsYGBXTimAqsOkFdbg8RVV8n3ZAZznEsJc', 2, '2024-10-17 06:49:43', '2024-10-17 06:54:49'),
(101, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTE0ODA4OSwiZXhwIjoxNzI5MTUxNjg5fQ.63L3gaaz6d_NPk8NcjjDj4CJ9d_lJBDmowk_pDD_dbw', 2, '2024-10-17 06:54:49', '2024-10-17 07:51:34'),
(102, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE1MTQxOCwiZXhwIjoxNzI5MTU1MDE4fQ.tBYhj6WdYj65th2YuiwDsQWi_lYd-9DzOdQyiAoYjFE', 2, '2024-10-17 07:50:18', '2024-10-17 07:54:20'),
(103, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE1MTY2MCwiZXhwIjoxNzI5MTU1MjYwfQ.AuH1SktzpAYECIOo7MRZzzy8D9vMnsgqJELSMnr0IX4', 2, '2024-10-17 07:54:20', '2024-10-17 07:57:38'),
(104, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE1MTg3NywiZXhwIjoxNzI5MTU1NDc3fQ.fR1mhNElwShn5Rjil_cfb6xiNPf9ytL4vkRsZy8BfEo', 2, '2024-10-17 07:57:57', '2024-10-17 08:07:10'),
(105, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE1MjQzMCwiZXhwIjoxNzI5MTU2MDMwfQ.4ogUVAA1yMKiQByddfwg_y2JTfwPkuvLFCt3fNRaOA8', 2, '2024-10-17 08:07:10', '2024-10-17 08:07:46'),
(106, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE1MjQ2NiwiZXhwIjoxNzI5MTU2MDY2fQ._Rh_J78sK2t4SaNgXsq6Hn3SkjZ30qjjjm-xgFvE8No', 2, '2024-10-17 08:07:46', '2024-10-17 09:24:23'),
(107, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE1NzA2MywiZXhwIjoxNzI5MTYwNjYzfQ.z0UGRKKZU1HkOkInD0meW2TFGe8T--dC15TNQFtC7B8', 2, '2024-10-17 09:24:23', '2024-10-17 09:25:58'),
(108, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE1NzE1OCwiZXhwIjoxNzI5MTYwNzU4fQ.Hp4JKQCgR5uCEnbzG2Byshc2xpcuR_6tEDB6IvH-vIk', 2, '2024-10-17 09:25:58', '2024-10-17 09:26:38'),
(109, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE1NzE5OCwiZXhwIjoxNzI5MTYwNzk4fQ.LZZXBfs_Jli6P-Q2bxdXAMfxa2rUBVpwCPQZd0YtLKQ', 2, '2024-10-17 09:26:38', '2024-10-17 10:50:53'),
(110, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE2MjI2NCwiZXhwIjoxNzI5MTY1ODY0fQ.9WMjxnAXO7XOpHWqdGCGfF3Dcir4zgsfsklP7IMTCEo', 2, '2024-10-17 10:51:04', '2024-10-17 11:55:10'),
(111, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE2NjEyMSwiZXhwIjoxNzI5MTY5NzIxfQ.e6ampMt3eyaxLK-PXdwibbb05axBQeWoDQY3bBhx8Gk', 2, '2024-10-17 11:55:21', '2024-10-17 12:55:27'),
(112, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTE2OTc0NiwiZXhwIjoxNzI5MTczMzQ2fQ.lJlimElEOhdJ4SzQCnuXQcrKf7XttwSoKUxmHPnPSBg', 2, '2024-10-17 12:55:46', '2024-10-18 06:06:34'),
(113, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTIzMTU5NCwiZXhwIjoxNzI5MjM1MTk0fQ.WfoQpKhT56YAGBGEHbiYI4pkA_qFoCt7cQJwvrVlrKE', 2, '2024-10-18 06:06:34', '2024-10-18 07:07:05'),
(114, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTIzNTI0MiwiZXhwIjoxNzI5MjM4ODQyfQ.rOK2fWZHgRubKb8wjYwTtneFYrxZZCBpzinjumzzhRU', 2, '2024-10-18 07:07:22', '2024-10-18 08:08:46'),
(115, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTIzODk0MywiZXhwIjoxNzI5MjQyNTQzfQ.JC3OQhN57duYgncOdxUvMCueCs3Zf7SzHzV2VnULryo', 2, '2024-10-18 08:09:03', '2024-10-18 09:49:57'),
(116, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTI0NTAwOCwiZXhwIjoxNzI5MjQ4NjA4fQ.1Q3oSYfvC8InknfxSB4MLVxzuqTACVlw1Wbqj2MP7bE', 2, '2024-10-18 09:50:08', '2024-10-18 10:18:46'),
(117, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI0NjgxNSwiZXhwIjoxNzI5MjUwNDE1fQ.vgR6H5TbYUxwTHhs2tF3e-RHdWBFY51K_Z9Eqj3EHhQ', 2, '2024-10-18 10:20:15', '2024-10-18 10:21:10'),
(118, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI0Njg3OSwiZXhwIjoxNzI5MjUwNDc5fQ.LYSvXBOqO6MgMyuJhz_2G7bR8gO-uSKCzlnxeeC1PYU', 2, '2024-10-18 10:21:19', '2024-10-18 10:24:29'),
(119, 8, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiU3ViIEFkbWluIiwic3ViIjo4LCJpYXQiOjE3MjkyNDcwODQsImV4cCI6MTcyOTI1MDY4NH0.7u5o01LHr-GCf1Xjn9D3knKF1QhldoKEMbd5xQblHFo', 2, '2024-10-18 10:24:44', '2024-10-18 10:25:25'),
(120, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI0NzgxMywiZXhwIjoxNzI5MjUxNDEzfQ.eTaBK60mDEoKlGxJazRfiiTnZD2gLZyQ5nNMaCHvXrw', 2, '2024-10-18 10:36:53', '2024-10-18 10:59:50'),
(121, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI0OTE5MCwiZXhwIjoxNzI5MjUyNzkwfQ.PR-oabe_zCJrQXfRWbutuxCAr1wNSRVRQpQSZLJJZSQ', 2, '2024-10-18 10:59:50', '2024-10-18 11:01:07'),
(122, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI0OTI2NywiZXhwIjoxNzI5MjUyODY3fQ.EvcAYserSzzhI3HxBAFPMh8Pmgf5uRBWRnOxNxQ_qcw', 2, '2024-10-18 11:01:07', '2024-10-18 11:02:30'),
(123, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI0OTM1MCwiZXhwIjoxNzI5MjUyOTUwfQ.-A0eoO86k6-lrC4713jDBjZaNq4j6ZlrzL-sIxi6sf4', 2, '2024-10-18 11:02:30', '2024-10-18 11:08:00'),
(124, 8, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiU3ViIEFkbWluIiwic3ViIjo4LCJpYXQiOjE3MjkyNDk0MTUsImV4cCI6MTcyOTI1MzAxNX0.akh7g2zd7LCg0Z5RRAbsvuxpQd30RcdxE-cPq-tRghA', 2, '2024-10-18 11:03:35', '2024-10-18 11:06:05'),
(125, 8, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiU3ViIEFkbWluIiwic3ViIjo4LCJpYXQiOjE3MjkyNDk1NjUsImV4cCI6MTcyOTI1MzE2NX0.H-K228x8IvRBGWvMnC-IPu091HAxTGxproFFsXbAmp0', 1, '2024-10-18 11:06:05', '2024-10-18 11:06:05'),
(126, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTI0OTY2NiwiZXhwIjoxNzI5MjUzMjY2fQ.XrzSrTaEABwSz1P8WlgrdLl3zQaqHuMNE7-jWYtF77M', 2, '2024-10-18 11:07:46', '2024-10-18 12:20:22'),
(127, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI0OTY4MCwiZXhwIjoxNzI5MjUzMjgwfQ.ObwwUC6gZXhrM6qDo3s86dvnAwuEtwFTOw4yWA3m7Zc', 2, '2024-10-18 11:08:00', '2024-10-18 11:10:03'),
(128, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI0OTgwMywiZXhwIjoxNzI5MjUzNDAzfQ.XdhFKHiqrSITIQyIaASvMjYJrEVrgdShw83C8xMEhUg', 2, '2024-10-18 11:10:03', '2024-10-18 11:10:33'),
(129, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI0OTgzMywiZXhwIjoxNzI5MjUzNDMzfQ.DksNNqB5QGs2dSSmjnXeQDsj99V1I8CH9P6WElFwqxY', 2, '2024-10-18 11:10:33', '2024-10-18 11:28:39'),
(130, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI1MDk0OSwiZXhwIjoxNzI5MjU0NTQ5fQ.aZv89A7jAY_ejcb0KMve_kcGHT2MBDXQCDDfPQSLRc8', 2, '2024-10-18 11:29:09', '2024-10-18 12:20:12'),
(131, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTI1NDAyMiwiZXhwIjoxNzI5MjU3NjIyfQ.hfNXwDlWniqWJD8W2M_nZHh6RCQNUjAB6nNkLFs_JGY', 2, '2024-10-18 12:20:22', '2024-10-18 12:20:51'),
(132, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI1NDA2MCwiZXhwIjoxNzI5MjU3NjYwfQ.YQfVdkbsIP3j8Wx3nXUcyRmVdjCc6SXucBOgMd8f2l0', 2, '2024-10-18 12:21:00', '2024-10-18 12:27:47'),
(133, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTI1NDUyNiwiZXhwIjoxNzI5MjU4MTI2fQ.QTt613mPfxNcunxHL09COkIBqzqMh-t3a2ND-6UdYFo', 2, '2024-10-18 12:28:46', '2024-10-18 12:34:57'),
(134, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTI1NDkxMCwiZXhwIjoxNzI5MjU4NTEwfQ.3eVZaXgf9ruALyPCvhraWuWNJ91yzqLS66_0DPqpIB4', 2, '2024-10-18 12:35:10', '2024-10-18 12:48:33'),
(135, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI1NTczMiwiZXhwIjoxNzI5MjU5MzMyfQ.S_eX3FRHrBOLmYQK8WMsFt6JJ8sV9pStmYPQkPHY9_0', 2, '2024-10-18 12:48:52', '2024-10-18 13:03:49'),
(136, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI1NjY3OSwiZXhwIjoxNzI5MjYwMjc5fQ.G_-KbiUkX_24QTghac3TX9BG769tjorB5H4c2jPKnf8', 2, '2024-10-18 13:04:39', '2024-10-18 13:31:06'),
(137, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTI1ODI2NiwiZXhwIjoxNzI5MjYxODY2fQ.Tse3b5MkGeQUeh2rJ_Mud4JBnyeYw3HD5IT1pbjkK0c', 2, '2024-10-18 13:31:06', '2024-10-21 05:30:36'),
(138, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ4ODYzNiwiZXhwIjoxNzI5NDkyMjM2fQ.oKtPgAB7ftC3_Bxb31oPAQ_wWBa-eD2FHqDxM0sA_tI', 2, '2024-10-21 05:30:36', '2024-10-21 05:46:13'),
(139, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ4OTU3MywiZXhwIjoxNzI5NDkzMTczfQ.jjw6bNH_0tw7IBFLS_mYAoQXI9nAHDHH7NuZJzChLhA', 2, '2024-10-21 05:46:13', '2024-10-21 06:50:51'),
(140, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ5MzQ2OCwiZXhwIjoxNzI5NDk3MDY4fQ.m0tfY_TsrIoScQTWKdGrMQ6bH7n6r2Ft2qoN0OFC1gU', 2, '2024-10-21 06:51:08', '2024-10-21 06:59:18'),
(141, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ5Mzk1OCwiZXhwIjoxNzI5NDk3NTU4fQ.hV5t2B2X6yePSHKB0dmtxNI3Stwbwj5fbRIgk23Ex9E', 2, '2024-10-21 06:59:18', '2024-10-21 07:10:54'),
(142, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTQ5NDUyNywiZXhwIjoxNzI5NDk4MTI3fQ.dUg9e2uwrD9zim5fAk5vKXOGYS9o5NGAOfh0ftks0A8', 2, '2024-10-21 07:08:47', '2024-10-21 10:42:06'),
(143, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ5NDY1NCwiZXhwIjoxNzI5NDk4MjU0fQ.rfVZkxd12cK8yEOY4t-iGeJbnsyroRomE_f7OrBMAT0', 2, '2024-10-21 07:10:54', '2024-10-21 07:23:10'),
(144, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ5NTM5MCwiZXhwIjoxNzI5NDk4OTkwfQ.dEldqeSSri9_8eZP1KFhSy-_8IfBxuYvJMSCDF4cG5o', 2, '2024-10-21 07:23:10', '2024-10-21 07:48:47'),
(145, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ5NjkyNywiZXhwIjoxNzI5NTAwNTI3fQ.lee6dZGi3x56xLLNd9rVhCNeyVdebuuu8BhFPj7IU68', 2, '2024-10-21 07:48:47', '2024-10-21 07:49:31'),
(146, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ5Njk3MSwiZXhwIjoxNzI5NTAwNTcxfQ.6itFgrx-C3ZM8EUT9NQbLmG2Sn-AlXGLQubB7thmuoE', 2, '2024-10-21 07:49:31', '2024-10-21 07:49:58'),
(147, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ5Njk5OCwiZXhwIjoxNzI5NTAwNTk4fQ.AE9lkByzhTSwQodD6rH94aoZj5GWrPEH37jC-DsBZWc', 2, '2024-10-21 07:49:58', '2024-10-21 08:03:42'),
(148, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ5Nzg0MiwiZXhwIjoxNzI5NTAxNDQyfQ.shzz88HBAg5dGVPUovta22xn4JG0M8cPspGnOoI4BIM', 2, '2024-10-21 08:04:02', '2024-10-21 08:04:08'),
(149, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTQ5Nzg0OCwiZXhwIjoxNzI5NTAxNDQ4fQ.3UJhwh-S5-3CRA8Ro8YhCLZrlUbBtsQWCFndnwFo5FQ', 2, '2024-10-21 08:04:08', '2024-10-21 09:31:58'),
(150, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwMzExOCwiZXhwIjoxNzI5NTA2NzE4fQ.a-W4NcXLsawaO01chZ7uJ3Jqz_hmibanM5TJS33LKd4', 2, '2024-10-21 09:31:58', '2024-10-21 10:32:27'),
(151, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwNjc2NSwiZXhwIjoxNzI5NTEwMzY1fQ.nvYMjv1r76M0S5XFws5qpZy9PkctOBLNGlOC4V5i_Kw', 2, '2024-10-21 10:32:45', '2024-10-21 10:41:55'),
(152, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTUwNzMyNiwiZXhwIjoxNzI5NTEwOTI2fQ.DviUPEpAbhgoYeo77qEuZgja6sdJGZRR-BO5VXKjFt8', 2, '2024-10-21 10:42:06', '2024-10-21 10:56:25'),
(153, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwNzM5NCwiZXhwIjoxNzI5NTEwOTk0fQ.ahRtSTJiHHDTLKmVQEp7w3F0ybmuSjeOHITVICD9RcY', 2, '2024-10-21 10:43:14', '2024-10-21 10:44:31'),
(154, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwNzQ3MSwiZXhwIjoxNzI5NTExMDcxfQ._UA1rWKSJQ0CtDnDFQI2APiKOwdHAJW99Ci_-uO0H8k', 2, '2024-10-21 10:44:31', '2024-10-21 11:06:33'),
(155, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTUwODE4NSwiZXhwIjoxNzI5NTExNzg1fQ.jKPa_JW5xaAQXTpz2SdESM5Cl9hwh4Idjek_FBOGI04', 2, '2024-10-21 10:56:25', '2024-10-21 11:05:32'),
(156, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwODc5MywiZXhwIjoxNzI5NTEyMzkzfQ.oceWt_mrrU3NS5I8qE1VtWKB7CiGSRXQkRYzdF2I9X0', 2, '2024-10-21 11:06:33', '2024-10-21 11:10:46'),
(157, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwOTA0NiwiZXhwIjoxNzI5NTEyNjQ2fQ.A8JLwHj53WWlveXD3EWSkJqBn42diOzn1qZPspBdrEI', 2, '2024-10-21 11:10:46', '2024-10-21 11:14:08'),
(158, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwOTI0OCwiZXhwIjoxNzI5NTEyODQ4fQ.sGLdC0VjCqS6a6tyZylUYSeC4D3W_lcbk1YUufS81do', 2, '2024-10-21 11:14:08', '2024-10-21 11:14:23'),
(159, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwOTI2MywiZXhwIjoxNzI5NTEyODYzfQ.fLAIdmDiBdMW-lp8UadJXJTGcyTiEyN_vFPPwQV-IOg', 2, '2024-10-21 11:14:23', '2024-10-21 11:14:34'),
(160, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwOTI3NCwiZXhwIjoxNzI5NTEyODc0fQ.LJKlsGBrp68GqqffiGenkbytDg26J2Uesnb013x6Boc', 2, '2024-10-21 11:14:34', '2024-10-21 11:14:46'),
(161, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwOTI4NiwiZXhwIjoxNzI5NTEyODg2fQ.Zvh5nPN_DPW8pugraEVZJTEGB6ROIPDfabiPnWWH7tg', 2, '2024-10-21 11:14:46', '2024-10-21 11:15:25'),
(162, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwOTMyNSwiZXhwIjoxNzI5NTEyOTI1fQ.9f-jdVD70e1-ICjUnUycxXr7poKFfqvUGcfnbutMiBI', 2, '2024-10-21 11:15:25', '2024-10-21 11:16:06'),
(163, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwOTM2NiwiZXhwIjoxNzI5NTEyOTY2fQ.iR5fikLIaShdMcf7qXWNWC6l5OR2_jehFn_G3XxNy-U', 2, '2024-10-21 11:16:06', '2024-10-21 11:18:40'),
(164, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwOTUyMCwiZXhwIjoxNzI5NTEzMTIwfQ.2sjgWePRzXXPQYQoATEow_vvPfg5wdLWaAzUgDf7PKs', 2, '2024-10-21 11:18:40', '2024-10-21 11:22:49'),
(165, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUwOTc2OSwiZXhwIjoxNzI5NTEzMzY5fQ.0c5x9xPbQshk5vRq6lkCyekW7srPIWBFV9_kJ6PPYEE', 2, '2024-10-21 11:22:49', '2024-10-21 12:23:46'),
(166, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUxMzQzNiwiZXhwIjoxNzI5NTE3MDM2fQ.sSkWCde6GSKJ_t5f374nnUrmKBzxNywh2186cr7qWHY', 2, '2024-10-21 12:23:56', '2024-10-21 12:28:48'),
(167, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUxMzcyOCwiZXhwIjoxNzI5NTE3MzI4fQ.k4pbzbyfI9a-DXx35_KsMUNyfvtMVCgTSbMvtESbcB4', 2, '2024-10-21 12:28:48', '2024-10-21 12:32:14'),
(168, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUxMzkzNCwiZXhwIjoxNzI5NTE3NTM0fQ.9EK6NGq4H0bQHCLBNG9QMv61foTP184cmrJiwziCGNI', 2, '2024-10-21 12:32:14', '2024-10-21 12:33:32'),
(169, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUxNDAxMiwiZXhwIjoxNzI5NTE3NjEyfQ.Gk52GbgKp77mNgqyIfwhzYGBX0yUaAxBL8cI9X6fo9E', 2, '2024-10-21 12:33:32', '2024-10-21 12:44:40'),
(170, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUxNDY4MCwiZXhwIjoxNzI5NTE4MjgwfQ.a3ziTPWD7_gKBF1ymS4jBGnM-TXkuvTmoPHAavgNTRk', 2, '2024-10-21 12:44:40', '2024-10-21 12:50:46'),
(171, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUxNTA0NiwiZXhwIjoxNzI5NTE4NjQ2fQ.7H01Kg9O292rFz1Hzj_NbMCIdiRxPaTScVfHFd-aEKk', 2, '2024-10-21 12:50:46', '2024-10-21 12:52:42'),
(172, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTUxNTE2MiwiZXhwIjoxNzI5NTE4NzYyfQ.4XGWtgduqvGoUm2wBBMt7WB2Km4NW_gBCqc_XA7IcUw', 2, '2024-10-21 12:52:42', '2024-10-22 04:24:17'),
(173, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU3MTE1OCwiZXhwIjoxNzI5NTc0NzU4fQ.zKWAYLP5LbLw28bAAltPzWJx7jXXx57Bc8rGyGmnmOg', 2, '2024-10-22 04:25:58', '2024-10-22 05:44:21'),
(174, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU3NTg3MywiZXhwIjoxNzI5NTc5NDczfQ.VvY-l-piZHe7cDVfr9bgZKyexgoW1nZfqPLU6qkgEHE', 2, '2024-10-22 05:44:33', '2024-10-22 06:36:55'),
(175, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU3OTAxNSwiZXhwIjoxNzI5NTgyNjE1fQ.vXip9nCYUS_aOwplwhuEzt0fZ-4BdD9ExOftpEyhGJo', 2, '2024-10-22 06:36:55', '2024-10-22 06:42:02'),
(176, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU3OTMyMiwiZXhwIjoxNzI5NTgyOTIyfQ.DIvrqCxNhaf5_ZkKOjTr5NgIyxSDWlFSLtnTS5eRUSc', 2, '2024-10-22 06:42:02', '2024-10-22 06:49:25'),
(177, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU3OTc2NSwiZXhwIjoxNzI5NTgzMzY1fQ.mHAo5dT0ynihvB1oyVBn7bOiimJw0wI-n_5VBMqU-BM', 2, '2024-10-22 06:49:25', '2024-10-22 06:50:04'),
(178, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU3OTgwNCwiZXhwIjoxNzI5NTgzNDA0fQ.Uotmx9TyEvxWHoSSd2qKGwaUl6u1X-6JM4dGgB0dUuc', 2, '2024-10-22 06:50:04', '2024-10-22 06:51:30'),
(179, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU3OTg5MCwiZXhwIjoxNzI5NTgzNDkwfQ.zvc8okQUvgVdEOOD3Z8QS_UndQPblZ9ed_AxrwQZwQY', 2, '2024-10-22 06:51:30', '2024-10-22 06:51:50'),
(180, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU3OTkxMCwiZXhwIjoxNzI5NTgzNTEwfQ.dCSVG5pJdb1Ix12T1xCVagAUiHBUZyLfIPB8EOWDZco', 2, '2024-10-22 06:51:50', '2024-10-22 08:06:04'),
(181, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU4NDM4MSwiZXhwIjoxNzI5NTg3OTgxfQ.XWbdmSE1f4st_w0w7cQ9ITzPk0zf_g99OGr4V-DRsBI', 2, '2024-10-22 08:06:21', '2024-10-22 09:14:01'),
(182, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU4ODQ1MiwiZXhwIjoxNzI5NTkyMDUyfQ.f7pbyb5rFHAgl-7XIhhUXBPyqN-e1xFKVxp3yiaMnVk', 2, '2024-10-22 09:14:12', '2024-10-22 10:21:33'),
(183, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU5MjUwNSwiZXhwIjoxNzI5NTk2MTA1fQ.LW_9WCdcrXVB1bHa4JS00520tGZq-_un8lxOllIeBp8', 2, '2024-10-22 10:21:45', '2024-10-22 10:56:31'),
(184, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU5NDU5MSwiZXhwIjoxNzI5NTk4MTkxfQ.-xMB14ZoC4mBEzg679gOcleuIrcm6nZD22CxXBLftEU', 2, '2024-10-22 10:56:31', '2024-10-22 10:59:03'),
(185, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU5NDc0MywiZXhwIjoxNzI5NTk4MzQzfQ.vlkV5Q7oqcnXunvCy3rMwsin_6vPzVGW85xZKq_hBbo', 2, '2024-10-22 10:59:03', '2024-10-22 11:32:22'),
(186, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU5Njc0MiwiZXhwIjoxNzI5NjAwMzQyfQ.R7gIVe-OrkNoIP1mq7XGaznL5wDngWhwF1_Idjyo1UU', 2, '2024-10-22 11:32:22', '2024-10-22 11:42:43'),
(187, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU5NzM2MywiZXhwIjoxNzI5NjAwOTYzfQ.WMdrygGZnJ93LwHpT10jkkAcKtQf770CNQh--8JKMhY', 2, '2024-10-22 11:42:43', '2024-10-22 11:45:11'),
(188, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTU5NzUxMSwiZXhwIjoxNzI5NjAxMTExfQ.DxoIl44JxoC2VDKZoHIX4Z6BXx6V85tMt9jP4it3kcI', 2, '2024-10-22 11:45:11', '2024-10-22 12:47:46'),
(189, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTYwMTI3NiwiZXhwIjoxNzI5NjA0ODc2fQ.qOKwrEMXHiQhYKSKBVGa5Bo_CCQN7sTMuRkjsKn4Rn0', 2, '2024-10-22 12:47:56', '2024-10-23 05:33:19'),
(190, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY2MTU5OSwiZXhwIjoxNzI5NjY1MTk5fQ.wLTjfuvvet8FkVfxdEEqU9v4mulxLFSG3douhxJh4vw', 2, '2024-10-23 05:33:19', '2024-10-23 06:00:07'),
(191, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY2MzIwNywiZXhwIjoxNzI5NjY2ODA3fQ.DQ8TDy5aI7vwdxgf14e8jdXNNdxVw4GLoHHTbQZvXsY', 2, '2024-10-23 06:00:07', '2024-10-23 06:02:06'),
(192, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY2MzMyNiwiZXhwIjoxNzI5NjY2OTI2fQ.CqzIeXNhLXxWFoK8C6omKa6RLyGKGIUhuVE7djpQRD4', 2, '2024-10-23 06:02:06', '2024-10-23 06:03:01'),
(193, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY2MzM4MSwiZXhwIjoxNzI5NjY2OTgxfQ.D6UsCBhv00HUiXhcilkHSF0xxtCVzXeG0HHn5a4tduc', 2, '2024-10-23 06:03:01', '2024-10-23 06:03:49'),
(194, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY2MzQyOSwiZXhwIjoxNzI5NjY3MDI5fQ.DyNZaIWgtBdLPEpyK8DJJRj6axaEVeednRxuIX-SV8Q', 2, '2024-10-23 06:03:49', '2024-10-23 06:04:40'),
(195, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY2MzQ4MCwiZXhwIjoxNzI5NjY3MDgwfQ.zwJ8qs-NJdzZLPmtoSc1DGvnslyIgsF0pNUcVWFD-P4', 2, '2024-10-23 06:04:40', '2024-10-23 07:05:07'),
(196, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY2NzEyMCwiZXhwIjoxNzI5NjcwNzIwfQ.020Fr_vg3Zkz_X5l9aLS7-P-u_OMGyUOuWfmxEeuOLI', 2, '2024-10-23 07:05:20', '2024-10-23 09:17:09'),
(197, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY3NTA0MCwiZXhwIjoxNzI5Njc4NjQwfQ.1zCkm_Kc_2tEb16vEMmti8GOyj6rbjbgE5lb-yNMCUo', 2, '2024-10-23 09:17:20', '2024-10-23 10:25:15'),
(198, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY3OTEyNSwiZXhwIjoxNzI5NjgyNzI1fQ.06iwP8cig3O_AtzSOMv174Bx_HIFMyo1bw4z8h6i7JY', 2, '2024-10-23 10:25:25', '2024-10-23 10:33:01'),
(199, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY4MjU4MywiZXhwIjoxNzI5Njg2MTgzfQ.ZLp37VwlsZKTKvW2Ba5tpnqRya96Eq1IXqTidoQ5Jv0', 2, '2024-10-23 11:23:03', '2024-10-23 12:07:30'),
(200, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY4NTI1MCwiZXhwIjoxNzI5Njg4ODUwfQ.yJtdQJifW6i34c22mprTcxHCSEbxGJUMd-yQ_g0IGIU', 2, '2024-10-23 12:07:30', '2024-10-23 12:34:26'),
(201, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjQsImlhdCI6MTcyOTY4NTY1NCwiZXhwIjoxNzI5Njg5MjU0fQ.Nfu7nGN9I2IkbtvYQSAwfK9tgX_KdZfYWZ-FXjC_cNE', 1, '2024-10-23 12:14:14', '2024-10-23 12:14:14'),
(202, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTY4Njg2NiwiZXhwIjoxNzI5NjkwNDY2fQ.dSJ2yomebd6wOeCMPvr9qPZB_eKchGQvzyfX3aPUYq0', 2, '2024-10-23 12:34:26', '2024-10-24 04:32:15'),
(203, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTc0NDMzNSwiZXhwIjoxNzI5NzQ3OTM1fQ.b69TQhgm2DRsFWO-eK8bmYdo2XrvpIimmzDo2JgHOss', 2, '2024-10-24 04:32:15', '2024-10-24 05:40:22'),
(204, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTc0ODQ0MiwiZXhwIjoxNzI5NzUyMDQyfQ.B3Ot1mTfAQLBnWGeGhsF0LRTdztt0IGNEdX95vZiHiE', 2, '2024-10-24 05:40:42', '2024-10-24 06:40:43'),
(205, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTc1MjA1OCwiZXhwIjoxNzI5NzU1NjU4fQ.7_V5u5Ym9L13OcRaJToArVA197mvjVZjjGTnhNDnMLU', 2, '2024-10-24 06:40:58', '2024-10-24 07:45:29'),
(206, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTc1NTkzOSwiZXhwIjoxNzI5NzU5NTM5fQ.oEZviUDy88jkN06cDOHH8ack802H6Sqi5B7VuYu5Ys4', 2, '2024-10-24 07:45:39', '2024-10-24 09:14:20'),
(207, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTc2MTI3OCwiZXhwIjoxNzI5NzY0ODc4fQ.n9GVvRCK5Hn8J2yC4fjnOf_IjgKYPsH2OQe2tLuY8aE', 2, '2024-10-24 09:14:38', '2024-10-24 11:27:30'),
(208, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTc2OTI2MCwiZXhwIjoxNzI5NzcyODYwfQ.qc2b9X0duBMMjuuGpeETQgMkkHGM3dUDgmIRNUXRFfs', 2, '2024-10-24 11:27:40', '2024-10-24 12:28:44'),
(209, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTc3MjkzOCwiZXhwIjoxNzI5Nzc2NTM4fQ.7JwFVIf9QNJsMXxy1ok9rpjEMfPaHVnKN5GP4ddAhVQ', 2, '2024-10-24 12:28:58', '2024-10-24 13:16:39'),
(210, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTc3NTc5OSwiZXhwIjoxNzI5Nzc5Mzk5fQ.cK5LFUv2f6jI6bkNOY8IoSRSXDCWHSAtc4MtjfSJBrg', 2, '2024-10-24 13:16:39', '2024-10-24 13:21:15'),
(211, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjIsImlhdCI6MTcyOTc3NjA3NSwiZXhwIjoxNzI5Nzc5Njc1fQ.cCAXtXHMV--DBPdzH0kdiUuhpCNmSRuoKcyUKJUAAQw', 1, '2024-10-24 13:21:15', '2024-10-24 13:21:15'),
(212, 15, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ3VzdG9tZXIiLCJzdWIiOjE1LCJpYXQiOjE3MzE0OTcxMTEsImV4cCI6MTczMTUwMDcxMX0.aNopdMR2SuSP18cG2tZrrzLOjBf9xa5AH75YDknb7GM', 2, '2024-11-13 11:25:11', '2024-11-13 11:29:35'),
(213, 15, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ3VzdG9tZXIiLCJzdWIiOjE1LCJpYXQiOjE3MzE0OTczNzUsImV4cCI6MTczMTUwMDk3NX0.hANPvUYLRREkAp9j4I4yyCTSJqzdiQbpuszzAdAJrHQ', 2, '2024-11-13 11:29:35', '2024-11-13 11:32:04'),
(214, 16, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ3VzdG9tZXIiLCJzdWIiOjE2LCJpYXQiOjE3MzE1MDA3MDAsImV4cCI6MTczMTUwNDMwMH0.CkW_VRct4VIyQxRF1bdblqRM4vo7Y5atA8UkkgxABLQ', 2, '2024-11-13 12:25:00', '2024-11-14 05:48:57'),
(215, 16, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ3VzdG9tZXIiLCJzdWIiOjE2LCJpYXQiOjE3MzE1NjM0MDMsImV4cCI6MTczMTU2NzAwM30.zTj9wjredaT2ToWYkzGQIweNKlc5V8UDxAnFQebBK6k', 2, '2024-11-14 05:50:03', '2024-11-14 07:13:31'),
(216, 16, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ3VzdG9tZXIiLCJzdWIiOjE2LCJpYXQiOjE3MzE1Njg1ODksImV4cCI6MTczMTU3MjE4OX0.fODtdcVgOaaP0O_eNaoV21K9GSc8QHstcWQYCBcQM8k', 2, '2024-11-14 07:16:29', '2024-11-14 08:19:14'),
(217, 16, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ3VzdG9tZXIiLCJzdWIiOjE2LCJpYXQiOjE3MzE1NzIzNzQsImV4cCI6MTczMTU3NTk3NH0.L59_c5UzmONdaQcL1qyhAomK0VEVM49mBp_ldNMoYOM', 2, '2024-11-14 08:19:34', '2024-11-14 09:19:37'),
(218, 16, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ3VzdG9tZXIiLCJzdWIiOjE2LCJpYXQiOjE3MzE1NzU5ODgsImV4cCI6MTczMTU3OTU4OH0.SsMiyFlg7xPD1UXUgpWSgqvk86dyH9NS1lDvqFWhQKo', 2, '2024-11-14 09:19:48', '2024-11-14 10:23:07'),
(219, 16, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ3VzdG9tZXIiLCJzdWIiOjE2LCJpYXQiOjE3MzE1Nzk3OTUsImV4cCI6MTczMTU4MzM5NX0.Muo5dk_-IswByluNqQ99x-Wop2U3uNFpC2DxTHkxrn8', 1, '2024-11-14 10:23:15', '2024-11-14 10:23:15'),
(220, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjEsImlhdCI6MTczMTU4NTE5NCwiZXhwIjoxNzMxNTg4Nzk0fQ.rf30W7cd5snp3nkTNiNI0doK0wytf_WSaYfYcuF2TYA', 2, '2024-11-14 11:53:14', '2024-11-14 11:57:33'),
(221, 19, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQ3VzdG9tZXIiLCJzdWIiOjE5LCJpYXQiOjE3MzE1ODU1NjEsImV4cCI6MTczMTU4OTE2MX0.VGuYZi_aJ3tGyWDYUXlAnT0Q2iAG8hHbn7bYUghDIaw', 2, '2024-11-14 11:59:21', '2024-11-14 12:04:56'),
(222, 20, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiR3Jvb21lci1IZWxwZXIiLCJzdWIiOjIwLCJpYXQiOjE3MzE1ODU5MTksImV4cCI6MTczMTU4OTUxOX0.k1kuVnp_yhUpELODpw_bAckgc0Des9yb1BgwNUe1jPM', 2, '2024-11-14 12:05:19', '2024-11-19 09:38:13'),
(223, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjEsImlhdCI6MTczMjAwOTEwNSwiZXhwIjoxNzMyMDEyNzA1fQ.7UmyVoJVP_RCkwiBQpXR5QOwoZOFkUnIjjudLgUg1Y4', 2, '2024-11-19 09:38:25', '2024-11-20 10:49:56'),
(224, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjEsImlhdCI6MTczMjA5OTgxNCwiZXhwIjoxNzMyMTAzNDE0fQ.LWk9S6xQIKQB-kTXWl4qJqN0Sw4UfBMWcLsoY1K9yVU', 2, '2024-11-20 10:50:14', '2024-11-20 12:03:24'),
(225, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjEsImlhdCI6MTczMjEwNDI4MCwiZXhwIjoxNzMyMTA3ODgwfQ.uX8PR0wcRxElakMiH3ZSqvDXp7PYDp9lNnr6ki4wFIk', 2, '2024-11-20 12:04:40', '2024-11-20 13:05:53');
INSERT INTO `tbl_token` (`id`, `user_id`, `token`, `status`, `created_at`, `updated_at`) VALUES
(226, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjEsImlhdCI6MTczMjEwNzk1OSwiZXhwIjoxNzMyMTExNTU5fQ.NEIYp3Wc9X0UuZI6sGTfR3ekobFul0pE2lyE3Qepxsg', 2, '2024-11-20 13:05:59', '2024-11-21 06:09:39'),
(227, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjEsImlhdCI6MTczMjE2OTQwMiwiZXhwIjoxNzMyMTczMDAyfQ.b1HOe1spYIpO29_pElaSDZuZkFfaRfuai0l9bZtX9pA', 2, '2024-11-21 06:10:02', '2024-11-25 05:48:22'),
(228, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjEsImlhdCI6MTczMjUxMzc2MywiZXhwIjoxNzMyNTE3MzYzfQ.1-Ug6EE_MuWpF7Qn31SsjNq9TvS-Vid956CMcIbg1wQ', 1, '2024-11-25 05:49:23', '2024-11-25 05:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_update_profile_request`
--

CREATE TABLE `tbl_update_profile_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'users.id',
  `field_value` varchar(255) NOT NULL,
  `field_type` int(11) NOT NULL COMMENT '1-Mobile,2-Email',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Pending, 2-Approval,3-Reject',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_update_profile_request`
--

INSERT INTO `tbl_update_profile_request` (`id`, `user_id`, `field_value`, `field_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '9756188580', 1, 2, '2024-10-07 10:50:49', NULL),
(2, 1, 'shadab.nerasoft@gmail.com', 2, 2, '2024-10-07 11:24:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonals`
--

CREATE TABLE `testimonals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rate_count` int(11) NOT NULL DEFAULT 3,
  `designation` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonals`
--

INSERT INTO `testimonals` (`id`, `name`, `image`, `rate_count`, `designation`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lead', 'testimonial/XRPMCOfhvnuJPWpfVlOqkhNkozRapqUuAFKfHgpS.png', 4, 'Lead Designer', 'It Was Very Good Experince', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cursus nibh mauris, nec turpis orci lectus maecenas. Suspendisse sed magna eget nibh in turpis. Consequat duis diam lacus arcu. Faucibus venenatis felis id augue sit cursus pellentesque enim arcu. Elementum felis magna pretium in tincidunt. Suspendisse sed magna eget nibh in turpis. Consequat duis diam lacus arcu.', 1, '2024-12-01 08:33:37', '2024-12-01 08:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `aadhar_no` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `security_pin` varchar(55) DEFAULT NULL,
  `role_id` int(11) NOT NULL COMMENT 'roles.id',
  `employe_type` varchar(255) DEFAULT NULL,
  `is_loggedin` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Active,2-InActive,3-Deleted, 4- Permanent Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `name`, `email`, `aadhar_no`, `mobile_no`, `email_verified_at`, `password`, `remember_token`, `security_pin`, `role_id`, `employe_type`, `is_loggedin`, `created_at`, `updated_at`, `status`) VALUES
(1, NULL, 'fazlu', 'fazlu.developer@gmail.com', NULL, '7428059960', NULL, '$2y$10$u0mJRa6qw3YGBFSW/Fdb0uKK/E08u5fiThDyQfk69Kl.L4MowfeYa', NULL, NULL, 1, NULL, '0', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_facilities_propery`
--
ALTER TABLE `add_facilities_propery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_package_service`
--
ALTER TABLE `add_package_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignroutes`
--
ALTER TABLE `assignroutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_settings`
--
ALTER TABLE `cms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynamic_url`
--
ALTER TABLE `dynamic_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emi_collections`
--
ALTER TABLE `emi_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallaries`
--
ALTER TABLE `gallaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kycdatas`
--
ALTER TABLE `kycdatas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kycs`
--
ALTER TABLE `kycs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_leads`
--
ALTER TABLE `kyc_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_leads_guarantor`
--
ALTER TABLE `kyc_leads_guarantor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_processes`
--
ALTER TABLE `kyc_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_reject_reasons`
--
ALTER TABLE `kyc_reject_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_disbursements`
--
ALTER TABLE `loan_disbursements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_requests`
--
ALTER TABLE `loan_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_modes`
--
ALTER TABLE `payment_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pet_category`
--
ALTER TABLE `pet_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties_images`
--
ALTER TABLE `properties_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_reviews`
--
ALTER TABLE `property_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `referral_code`
--
ALTER TABLE `referral_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refers`
--
ALTER TABLE `refers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refer_and_earn`
--
ALTER TABLE `refer_and_earn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_models`
--
ALTER TABLE `role_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_logs`
--
ALTER TABLE `route_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pet_bookings`
--
ALTER TABLE `tbl_pet_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_token`
--
ALTER TABLE `tbl_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_update_profile_request`
--
ALTER TABLE `tbl_update_profile_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonals`
--
ALTER TABLE `testimonals`
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
-- AUTO_INCREMENT for table `add_facilities_propery`
--
ALTER TABLE `add_facilities_propery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `add_package_service`
--
ALTER TABLE `add_package_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assignroutes`
--
ALTER TABLE `assignroutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cms_settings`
--
ALTER TABLE `cms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dynamic_url`
--
ALTER TABLE `dynamic_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emi_collections`
--
ALTER TABLE `emi_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallaries`
--
ALTER TABLE `gallaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kycdatas`
--
ALTER TABLE `kycdatas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kycs`
--
ALTER TABLE `kycs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kyc_leads`
--
ALTER TABLE `kyc_leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kyc_leads_guarantor`
--
ALTER TABLE `kyc_leads_guarantor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kyc_processes`
--
ALTER TABLE `kyc_processes`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kyc_reject_reasons`
--
ALTER TABLE `kyc_reject_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loan_disbursements`
--
ALTER TABLE `loan_disbursements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loan_requests`
--
ALTER TABLE `loan_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_modes`
--
ALTER TABLE `payment_modes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pet_category`
--
ALTER TABLE `pet_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `properties_images`
--
ALTER TABLE `properties_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `property_reviews`
--
ALTER TABLE `property_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral_code`
--
ALTER TABLE `referral_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `refers`
--
ALTER TABLE `refers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `refer_and_earn`
--
ALTER TABLE `refer_and_earn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_models`
--
ALTER TABLE `role_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `route_logs`
--
ALTER TABLE `route_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;

--
-- AUTO_INCREMENT for table `tbl_pet_bookings`
--
ALTER TABLE `tbl_pet_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_token`
--
ALTER TABLE `tbl_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `tbl_update_profile_request`
--
ALTER TABLE `tbl_update_profile_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonals`
--
ALTER TABLE `testimonals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property_reviews`
--
ALTER TABLE `property_reviews`
  ADD CONSTRAINT `property_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
