-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2024 at 12:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `6cash_4.2`
--

-- --------------------------------------------------------

--
-- Table structure for table `addon_settings`
--

CREATE TABLE `addon_settings` (
  `id` char(36) NOT NULL,
  `key_name` varchar(191) DEFAULT NULL,
  `live_values` longtext DEFAULT NULL,
  `test_values` longtext DEFAULT NULL,
  `settings_type` varchar(255) DEFAULT NULL,
  `mode` varchar(20) NOT NULL DEFAULT 'live',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `additional_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addon_settings`
--

INSERT INTO `addon_settings` (`id`, `key_name`, `live_values`, `test_values`, `settings_type`, `mode`, `is_active`, `created_at`, `updated_at`, `additional_data`) VALUES
('070c6bbd-d777-11ed-96f4-0c7a158e4469', 'twilio', '{\"gateway\":\"twilio\",\"mode\":\"live\",\"status\":\"0\",\"sid\":\"data\",\"messaging_service_sid\":\"data\",\"token\":\"data\",\"from\":\"data\",\"otp_template\":\"data\"}', '{\"gateway\":\"twilio\",\"mode\":\"live\",\"status\":\"0\",\"sid\":\"data\",\"messaging_service_sid\":\"data\",\"token\":\"data\",\"from\":\"data\",\"otp_template\":\"data\"}', 'sms_config', 'live', 0, NULL, '2023-08-12 07:01:29', NULL),
('070c766c-d777-11ed-96f4-0c7a158e4469', '2factor', '{\"gateway\":\"2factor\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"data\"}', '{\"gateway\":\"2factor\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"data\"}', 'sms_config', 'live', 0, NULL, '2023-08-12 07:01:36', NULL),
('0d8a9308-d6a5-11ed-962c-0c7a158e4469', 'mercadopago', '{\"gateway\":\"mercadopago\",\"mode\":\"test\",\"status\":\"0\",\"access_token\":\"data\",\"public_key\":\"data\"}', '{\"gateway\":\"mercadopago\",\"mode\":\"test\",\"status\":\"0\",\"access_token\":\"data\",\"public_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-27 11:57:11', '{\"gateway_title\":null,\"gateway_image\":\"2023-04-12-64367be3b7b6a.png\"}'),
('0d8a9e49-d6a5-11ed-962c-0c7a158e4469', 'liqpay', '{\"gateway\":\"liqpay\",\"mode\":\"test\",\"status\":\"0\",\"private_key\":\"data\",\"public_key\":\"data\"}', '{\"gateway\":\"liqpay\",\"mode\":\"test\",\"status\":\"0\",\"private_key\":\"data\",\"public_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:32:31', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('101befdf-d44b-11ed-8564-0c7a158e4469', 'paypal', '{\"gateway\":\"paypal\",\"mode\":\"test\",\"status\":\"0\",\"client_id\":\"data\",\"client_secret\":\"data\"}', '{\"gateway\":\"paypal\",\"mode\":\"test\",\"status\":\"0\",\"client_id\":\"data\",\"client_secret\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 03:41:32', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('133d9647-cabb-11ed-8fec-0c7a158e4469', 'hyper_pay', '{\"gateway\":\"hyper_pay\",\"mode\":\"test\",\"status\":\"0\",\"entity_id\":\"data\",\"access_code\":\"data\"}', '{\"gateway\":\"hyper_pay\",\"mode\":\"test\",\"status\":\"0\",\"entity_id\":\"data\",\"access_code\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:32:42', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('1821029f-d776-11ed-96f4-0c7a158e4469', 'msg91', '{\"gateway\":\"msg91\",\"mode\":\"live\",\"status\":\"0\",\"template_id\":\"data\",\"auth_key\":\"data\"}', '{\"gateway\":\"msg91\",\"mode\":\"live\",\"status\":\"0\",\"template_id\":\"data\",\"auth_key\":\"data\"}', 'sms_config', 'live', 0, NULL, '2023-08-12 07:01:48', NULL),
('18210f2b-d776-11ed-96f4-0c7a158e4469', 'nexmo', '{\"gateway\":\"nexmo\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"\",\"api_secret\":\"\",\"token\":\"\",\"from\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"nexmo\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"\",\"api_secret\":\"\",\"token\":\"\",\"from\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, '2023-04-10 02:14:44', NULL),
('18fbb21f-d6ad-11ed-962c-0c7a158e4469', 'foloosi', '{\"gateway\":\"foloosi\",\"mode\":\"test\",\"status\":\"0\",\"merchant_key\":\"data\"}', '{\"gateway\":\"foloosi\",\"mode\":\"test\",\"status\":\"0\",\"merchant_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:34:33', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('2767d142-d6a1-11ed-962c-0c7a158e4469', 'paytm', '{\"gateway\":\"paytm\",\"mode\":\"test\",\"status\":\"0\",\"merchant_key\":\"data\",\"merchant_id\":\"data\",\"merchant_website_link\":\"data\"}', '{\"gateway\":\"paytm\",\"mode\":\"test\",\"status\":\"0\",\"merchant_key\":\"data\",\"merchant_id\":\"data\",\"merchant_website_link\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-22 06:30:55', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('3201d2e6-c937-11ed-a424-0c7a158e4469', 'amazon_pay', '{\"gateway\":\"amazon_pay\",\"mode\":\"test\",\"status\":\"0\",\"pass_phrase\":\"data\",\"access_code\":\"data\",\"merchant_identifier\":\"data\"}', '{\"gateway\":\"amazon_pay\",\"mode\":\"test\",\"status\":\"0\",\"pass_phrase\":\"data\",\"access_code\":\"data\",\"merchant_identifier\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:36:07', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('4593b25c-d6a1-11ed-962c-0c7a158e4469', 'paytabs', '{\"gateway\":\"paytabs\",\"mode\":\"test\",\"status\":\"0\",\"profile_id\":\"data\",\"server_key\":\"data\",\"base_url\":\"data\"}', '{\"gateway\":\"paytabs\",\"mode\":\"test\",\"status\":\"0\",\"profile_id\":\"data\",\"server_key\":\"data\",\"base_url\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:34:51', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('4e9b8dfb-e7d1-11ed-a559-0c7a158e4469', 'bkash', '{\"gateway\":\"bkash\",\"mode\":\"test\",\"status\":\"0\",\"app_key\":\"data\",\"app_secret\":\"data\",\"username\":\"data\",\"password\":\"data\"}', '{\"gateway\":\"bkash\",\"mode\":\"test\",\"status\":\"0\",\"app_key\":\"data\",\"app_secret\":\"data\",\"username\":\"data\",\"password\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:39:42', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('544a24a4-c872-11ed-ac7a-0c7a158e4469', 'fatoorah', '{\"gateway\":\"fatoorah\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\"}', '{\"gateway\":\"fatoorah\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:36:24', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('58c1bc8a-d6ac-11ed-962c-0c7a158e4469', 'ccavenue', '{\"gateway\":\"ccavenue\",\"mode\":\"test\",\"status\":\"0\",\"merchant_id\":\"data\",\"working_key\":\"data\",\"access_code\":\"data\"}', '{\"gateway\":\"ccavenue\",\"mode\":\"test\",\"status\":\"0\",\"merchant_id\":\"data\",\"working_key\":\"data\",\"access_code\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 03:42:38', '{\"gateway_title\":null,\"gateway_image\":\"2023-04-13-643783f01d386.png\"}'),
('5e2d2ef9-d6ab-11ed-962c-0c7a158e4469', 'thawani', '{\"gateway\":\"thawani\",\"mode\":\"test\",\"status\":\"0\",\"public_key\":\"data\",\"private_key\":\"data\"}', '{\"gateway\":\"thawani\",\"mode\":\"test\",\"status\":\"0\",\"public_key\":\"data\",\"private_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:50:40', '{\"gateway_title\":null,\"gateway_image\":\"2023-04-13-64378f9856f29.png\"}'),
('60cc83cc-d5b9-11ed-b56f-0c7a158e4469', 'sixcash', '{\"gateway\":\"sixcash\",\"mode\":\"test\",\"status\":\"0\",\"public_key\":\"data\",\"secret_key\":\"data\",\"merchant_number\":\"data\",\"base_url\":\"data\"}', '{\"gateway\":\"sixcash\",\"mode\":\"test\",\"status\":\"0\",\"public_key\":\"data\",\"secret_key\":\"data\",\"merchant_number\":\"data\",\"base_url\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:16:17', '{\"gateway_title\":null,\"gateway_image\":\"2023-04-12-6436774e77ff9.png\"}'),
('68579846-d8e8-11ed-8249-0c7a158e4469', 'alphanet_sms', '{\"gateway\":\"alphanet_sms\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"alphanet_sms\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, NULL),
('6857a2e8-d8e8-11ed-8249-0c7a158e4469', 'sms_to', '{\"gateway\":\"sms_to\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"sender_id\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"sms_to\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"sender_id\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, NULL),
('74c30c00-d6a6-11ed-962c-0c7a158e4469', 'hubtel', '{\"gateway\":\"hubtel\",\"mode\":\"test\",\"status\":\"0\",\"account_number\":\"data\",\"api_id\":\"data\",\"api_key\":\"data\"}', '{\"gateway\":\"hubtel\",\"mode\":\"test\",\"status\":\"0\",\"account_number\":\"data\",\"api_id\":\"data\",\"api_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:37:43', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('74e46b0a-d6aa-11ed-962c-0c7a158e4469', 'tap', '{\"gateway\":\"tap\",\"mode\":\"test\",\"status\":\"0\",\"secret_key\":\"data\"}', '{\"gateway\":\"tap\",\"mode\":\"test\",\"status\":\"0\",\"secret_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:50:09', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('761ca96c-d1eb-11ed-87ca-0c7a158e4469', 'swish', '{\"gateway\":\"swish\",\"mode\":\"test\",\"status\":\"0\",\"number\":\"data\"}', '{\"gateway\":\"swish\",\"mode\":\"test\",\"status\":\"0\",\"number\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:17:02', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('7b1c3c5f-d2bd-11ed-b485-0c7a158e4469', 'payfast', '{\"gateway\":\"payfast\",\"mode\":\"test\",\"status\":\"0\",\"merchant_id\":\"data\",\"secured_key\":\"data\"}', '{\"gateway\":\"payfast\",\"mode\":\"test\",\"status\":\"0\",\"merchant_id\":\"data\",\"secured_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:18:13', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('8592417b-d1d1-11ed-a984-0c7a158e4469', 'esewa', '{\"gateway\":\"esewa\",\"mode\":\"test\",\"status\":\"0\",\"merchantCode\":\"data\"}', '{\"gateway\":\"esewa\",\"mode\":\"test\",\"status\":\"0\",\"merchantCode\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:17:38', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('9162a1dc-cdf1-11ed-affe-0c7a158e4469', 'viva_wallet', '{\"gateway\":\"viva_wallet\",\"mode\":\"test\",\"status\":\"0\",\"client_id\": \"\",\"client_secret\": \"\", \"source_code\":\"\"}\n', '{\"gateway\":\"viva_wallet\",\"mode\":\"test\",\"status\":\"0\",\"client_id\": \"\",\"client_secret\": \"\", \"source_code\":\"\"}\n', 'payment_config', 'test', 0, NULL, NULL, NULL),
('998ccc62-d6a0-11ed-962c-0c7a158e4469', 'stripe', '{\"gateway\":\"stripe\",\"mode\":\"test\",\"status\":\"1\",\"api_key\":\"data\",\"published_key\":\"data\"}', '{\"gateway\":\"stripe\",\"mode\":\"test\",\"status\":\"1\",\"api_key\":\"data\",\"published_key\":\"data\"}', 'payment_config', 'test', 1, NULL, '2023-08-30 04:18:55', '{\"gateway_title\":null,\"gateway_image\":\"2023-08-10-64d4bc2bb983a.png\"}'),
('a3313755-c95d-11ed-b1db-0c7a158e4469', 'iyzi_pay', '{\"gateway\":\"iyzi_pay\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\",\"secret_key\":\"data\",\"base_url\":\"data\"}', '{\"gateway\":\"iyzi_pay\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\",\"secret_key\":\"data\",\"base_url\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:20:02', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('a76c8993-d299-11ed-b485-0c7a158e4469', 'momo', '{\"gateway\":\"momo\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"data\",\"api_user\":\"data\",\"subscription_key\":\"data\"}', '{\"gateway\":\"momo\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"data\",\"api_user\":\"data\",\"subscription_key\":\"data\"}', 'payment_config', 'live', 0, NULL, '2023-08-30 04:19:28', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('a8608119-cc76-11ed-9bca-0c7a158e4469', 'moncash', '{\"gateway\":\"moncash\",\"mode\":\"test\",\"status\":\"0\",\"client_id\":\"data\",\"secret_key\":\"data\"}', '{\"gateway\":\"moncash\",\"mode\":\"test\",\"status\":\"0\",\"client_id\":\"data\",\"secret_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:47:34', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('ad5af1c1-d6a2-11ed-962c-0c7a158e4469', 'razor_pay', '{\"gateway\":\"razor_pay\",\"mode\":\"test\",\"status\":\"1\",\"api_key\":\"data\",\"api_secret\":\"data\"}', '{\"gateway\":\"razor_pay\",\"mode\":\"test\",\"status\":\"1\",\"api_key\":\"data\",\"api_secret\":\"data\"}', 'payment_config', 'test', 1, NULL, '2023-08-30 04:47:00', '{\"gateway_title\":null,\"gateway_image\":\"2023-08-10-64d4bbeecee6c.png\"}'),
('ad5b02a0-d6a2-11ed-962c-0c7a158e4469', 'senang_pay', '{\"gateway\":\"senang_pay\",\"mode\":\"test\",\"status\":\"0\",\"callback_url\":\"data\",\"secret_key\":\"data\",\"merchant_id\":\"data\"}', '{\"gateway\":\"senang_pay\",\"mode\":\"test\",\"status\":\"0\",\"callback_url\":\"data\",\"secret_key\":\"data\",\"merchant_id\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-27 09:58:57', '{\"gateway_title\":\"data\",\"gateway_image\":\"\"}'),
('b6c333f6-d8e9-11ed-8249-0c7a158e4469', 'akandit_sms', '{\"gateway\":\"akandit_sms\",\"mode\":\"live\",\"status\":0,\"username\":\"\",\"password\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"akandit_sms\",\"mode\":\"live\",\"status\":0,\"username\":\"\",\"password\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, NULL),
('b6c33c87-d8e9-11ed-8249-0c7a158e4469', 'global_sms', '{\"gateway\":\"global_sms\",\"mode\":\"live\",\"status\":0,\"user_name\":\"\",\"password\":\"\",\"from\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"global_sms\",\"mode\":\"live\",\"status\":0,\"user_name\":\"\",\"password\":\"\",\"from\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, NULL),
('b8992bd4-d6a0-11ed-962c-0c7a158e4469', 'paymob_accept', '{\"gateway\":\"paymob_accept\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"\",\"iframe_id\":\"\",\"integration_id\":\"\", \"hmac\": \"\", \"callback_url\":\"\"}', '{\"gateway\":\"paymob_accept\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"\",\"iframe_id\":\"\",\"integration_id\":\"\", \"hmac\": \"\", \"callback_url\":\"\"}', 'payment_config', 'test', 0, NULL, NULL, NULL),
('c41c0dcd-d119-11ed-9f67-0c7a158e4469', 'maxicash', '{\"gateway\":\"maxicash\",\"mode\":\"test\",\"status\":\"0\",\"merchantId\":\"data\",\"merchantPassword\":\"data\"}', '{\"gateway\":\"maxicash\",\"mode\":\"test\",\"status\":\"0\",\"merchantId\":\"data\",\"merchantPassword\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:49:15', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('c9249d17-cd60-11ed-b879-0c7a158e4469', 'pvit', '{\"gateway\":\"pvit\",\"mode\":\"test\",\"status\":\"0\",\"mc_tel_merchant\": \"\",\"access_token\": \"\", \"mc_merchant_code\": \"\"}', '{\"gateway\":\"pvit\",\"mode\":\"test\",\"status\":\"0\",\"mc_tel_merchant\": \"\",\"access_token\": \"\", \"mc_merchant_code\": \"\"}', 'payment_config', 'test', 0, NULL, NULL, NULL),
('cb0081ce-d775-11ed-96f4-0c7a158e4469', 'releans', '{\"gateway\":\"releans\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"from\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"releans\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"from\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, '2023-04-10 02:14:44', NULL),
('d4f3f5f1-d6a0-11ed-962c-0c7a158e4469', 'flutterwave', '{\"gateway\":\"flutterwave\",\"mode\":\"test\",\"status\":\"1\",\"secret_key\":\"data\",\"public_key\":\"data\",\"hash\":\"data\"}', '{\"gateway\":\"flutterwave\",\"mode\":\"test\",\"status\":\"1\",\"secret_key\":\"data\",\"public_key\":\"data\",\"hash\":\"data\"}', 'payment_config', 'test', 1, NULL, '2023-08-30 04:41:03', '{\"gateway_title\":null,\"gateway_image\":\"2023-08-22-64e4439f95a8b.png\"}'),
('d822f1a5-c864-11ed-ac7a-0c7a158e4469', 'paystack', '{\"gateway\":\"paystack\",\"mode\":\"test\",\"status\":\"1\",\"public_key\":\"data\",\"secret_key\":\"data\",\"merchant_email\":\"data\"}', '{\"gateway\":\"paystack\",\"mode\":\"test\",\"status\":\"1\",\"public_key\":\"data\",\"secret_key\":\"data\",\"merchant_email\":\"data\"}', 'payment_config', 'test', 1, NULL, '2023-08-30 04:20:45', '{\"gateway_title\":null,\"gateway_image\":\"2023-08-10-64d4bb67d6345.png\"}'),
('daec8d59-c893-11ed-ac7a-0c7a158e4469', 'xendit', '{\"gateway\":\"xendit\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\"}', '{\"gateway\":\"xendit\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:35:46', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('dc0f5fc9-d6a5-11ed-962c-0c7a158e4469', 'worldpay', '{\"gateway\":\"worldpay\",\"mode\":\"test\",\"status\":\"0\",\"OrgUnitId\":\"data\",\"jwt_issuer\":\"data\",\"mac\":\"data\",\"merchantCode\":\"data\",\"xml_password\":\"data\"}', '{\"gateway\":\"worldpay\",\"mode\":\"test\",\"status\":\"0\",\"OrgUnitId\":\"data\",\"jwt_issuer\":\"data\",\"mac\":\"data\",\"merchantCode\":\"data\",\"xml_password\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:35:26', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('e0450278-d8eb-11ed-8249-0c7a158e4469', 'signal_wire', '{\"gateway\":\"signal_wire\",\"mode\":\"live\",\"status\":0,\"project_id\":\"\",\"token\":\"\",\"space_url\":\"\",\"from\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"signal_wire\",\"mode\":\"live\",\"status\":0,\"project_id\":\"\",\"token\":\"\",\"space_url\":\"\",\"from\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, NULL),
('e0450b40-d8eb-11ed-8249-0c7a158e4469', 'paradox', '{\"gateway\":\"paradox\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\"}', '{\"gateway\":\"paradox\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, NULL),
('ea346efe-cdda-11ed-affe-0c7a158e4469', 'ssl_commerz', '{\"gateway\":\"ssl_commerz\",\"mode\":\"test\",\"status\":\"0\",\"store_id\":\"data\",\"store_password\":\"data\"}', '{\"gateway\":\"ssl_commerz\",\"mode\":\"test\",\"status\":\"0\",\"store_id\":\"data\",\"store_password\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 03:43:49', '{\"gateway_title\":null,\"gateway_image\":\"2023-08-20-64e1ec1fb1730.png\"}'),
('eed88336-d8ec-11ed-8249-0c7a158e4469', 'hubtel', '{\"gateway\":\"hubtel\",\"mode\":\"live\",\"status\":0,\"sender_id\":\"\",\"client_id\":\"\",\"client_secret\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"hubtel\",\"mode\":\"live\",\"status\":0,\"sender_id\":\"\",\"client_id\":\"\",\"client_secret\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, NULL),
('f149c546-d8ea-11ed-8249-0c7a158e4469', 'viatech', '{\"gateway\":\"viatech\",\"mode\":\"live\",\"status\":0,\"api_url\":\"\",\"api_key\":\"\",\"sender_id\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"viatech\",\"mode\":\"live\",\"status\":0,\"api_url\":\"\",\"api_key\":\"\",\"sender_id\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, NULL),
('f149cd9c-d8ea-11ed-8249-0c7a158e4469', '019_sms', '{\"gateway\":\"019_sms\",\"mode\":\"live\",\"status\":0,\"password\":\"\",\"username\":\"\",\"username_for_token\":\"\",\"sender\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"019_sms\",\"mode\":\"live\",\"status\":0,\"password\":\"\",\"username\":\"\",\"username_for_token\":\"\",\"sender\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `receiver` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE `bonuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  `min_add_money_amount` double(14,2) NOT NULL DEFAULT 0.00,
  `limit_per_user` int(11) NOT NULL DEFAULT 0,
  `bonus_type` varchar(50) DEFAULT NULL,
  `bonus` double(14,2) NOT NULL DEFAULT 0.00,
  `max_bonus_amount` double(14,2) NOT NULL DEFAULT 0.00,
  `start_date_time` datetime DEFAULT NULL,
  `end_date_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'business_name', '6cash', NULL, NULL),
(2, 'currency', 'BDT', NULL, NULL),
(3, 'pagination_limit', '15', NULL, NULL),
(4, 'timezone', 'Asia/Dhaka', NULL, NULL),
(5, 'agent_commission_percent', '10', NULL, NULL),
(6, 'cashout_charge_percent', '5', NULL, NULL),
(7, 'addmoney_charge_percent', '12', NULL, NULL),
(8, 'sendmoney_charge_flat', '10', NULL, NULL),
(9, 'logo', '2022-04-17-625bc937c0958.png', NULL, NULL),
(10, 'phone', '000000000', NULL, NULL),
(11, 'email', 'demo@gmail.com', NULL, NULL),
(12, 'theme', 'theme_1', NULL, NULL),
(13, 'two_factor', '1', NULL, NULL),
(14, 'phone_verification', '1', NULL, NULL),
(15, 'email_verification', NULL, NULL, NULL),
(16, 'refer_commission', NULL, NULL, NULL),
(17, 'address', 'road 12, Dhaka', NULL, NULL),
(18, 'footer_text', 'This is footer test for 6cash', NULL, NULL),
(19, 'currency_symbol_position', 'right', NULL, NULL),
(20, 'admin_commission', NULL, NULL, NULL),
(21, 'country', 'BD', NULL, NULL),
(22, 'ssl_commerz_payment', '{\"status\":\"0\",\"store_id\":\"\",\"store_password\":\"@ssl\"}', '2022-04-07 08:27:08', '2022-04-07 08:27:16'),
(23, 'money_transfer_message', '{\"status\":1,\"message\":\"EMoney Transfer from admin\"}', NULL, NULL),
(24, 'cash_in', '{\"status\":1,\"message\":\"Cash In successfully completed.\"}', NULL, NULL),
(25, 'cash_out', '{\"status\":1,\"message\":\"Cash Out\"}', NULL, NULL),
(26, 'send_money', '{\"status\":1,\"message\":\"Send Money successfully completed.\"}', NULL, NULL),
(27, 'request_money', '{\"status\":1,\"message\":\"Money successfully requested.\"}', NULL, NULL),
(28, 'denied_money', '{\"status\":1,\"message\":\"Denied Money\"}', NULL, NULL),
(29, 'approved_money', '{\"status\":1,\"message\":\"Approved Money\"}', NULL, NULL),
(30, 'add_money', '{\"status\":1,\"message\":\"Added to your account.\"}', NULL, NULL),
(31, 'received_money', '{\"status\":1,\"message\":\"Received Money\"}', NULL, NULL),
(32, 'push_notification_key', 'add-token', NULL, NULL),
(33, 'language', '[{\"id\":\"1\",\"name\":\"english\",\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":false},{\"id\":2,\"name\":\"English\",\"direction\":\"ltr\",\"code\":\"en-US\",\"status\":0,\"default\":false},{\"id\":3,\"name\":\"Bangla\",\"direction\":\"ltr\",\"code\":\"bn\",\"status\":1,\"default\":true},{\"id\":4,\"name\":\"Arabic\",\"direction\":\"rtl\",\"code\":\"ar\",\"status\":0,\"default\":false}]', NULL, '2022-04-19 09:20:45'),
(34, 'paypal', '{\"status\":\"0\",\"paypal_client_id\":\"\",\"paypal_secret\":\"\"}', '2022-04-10 09:41:04', '2022-04-10 09:41:24'),
(35, 'privacy_policy', '<h2>This is a Demo Privacy Policy</h2>\r\n\r\n<p>This policy explains how StackFood&nbsp;website and related applications (the &ldquo;Site&rdquo;, &ldquo;we&rdquo; or &ldquo;us&rdquo;) collects, uses, shares and protects the personal information that we collect through this site or different channels. StackFood has established the site to link up the users who need foods or grocery items to be shipped or delivered by the riders from the affiliated restaurants or shops to the desired location. This policy also applies to any mobile applications that we develop for use with our services on the Site, and references to this &ldquo;Site&rdquo;, &ldquo;we&rdquo; or &ldquo;us&rdquo; is intended to also include these mobile applications. Please read below to learn more about our information policies. By using this Site, you agree to these policies.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>How the Information is collected</h2>\r\n\r\n<p>Information provided by web browser<br />\r\nYou have to provide us with personal information like your name, contact no, mailing address and email id, our app will also fetch your location information in order to give you the best service. Like many other websites, we may record information that your web browser routinely shares, such as your browser type, browser language, software and hardware attributes, the date and time of your visit, the web page from which you came, your Internet Protocol address and the geographic location associated with that address, the pages on this Site that you visit and the time you spent on those pages. This will generally be anonymous data that we collect on an aggregate basis.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Personal Information that you provide</h2>\r\n\r\n<p>If you want to use our service, you must create an account on our Site. To establish your account, we will ask for personally identifiable information that can be used to contact or identify you, which may include your name, phone number, and e-mail address. We may also collect demographic information about you, such as your zip code, and allow you to submit additional information that will be part of your profile. Other than basic information that we need to establish your account, it will be up to you to decide how much information to share as part of your profile. We encourage you to think carefully about the information that you share and we recommend that you guard your identity and your sensitive information. Of course, you can review and revise your profile at any time.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Payment Information</h2>\r\n\r\n<p>To make the payment online for availing our services, you have to provide the bank account, mobile financial service (MFS), debit card, credit card information to the StackFood platform.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Advertising Cookies</h2>\r\n\r\n<p><br />\r\nWe may use third parties, such as Google, to serve ads about our website over the internet. These third parties may use cookies to identify ads that may be relevant to your interest (for example, based on your recent visit to our website), to limit the number of times that you see an ad, and to measure the effectiveness of the ads.</p>\r\n\r\n<h2>Google Analytics</h2>\r\n\r\n<p><br />\r\nWe may also use Google Analytics or a similar service to gather statistical information about the visitors to this Site and how they use the Site. This, also, is done on an anonymous basis. We will not try to associate anonymous data with your personally identifiable data. If you would like to learn more about Google Analytics, please click here.</p>', NULL, '2023-09-26 08:20:40'),
(36, 'terms_and_conditions', '<h2>This is a test Teams &amp; Conditions</h2>\r\n\r\n<p>These terms of use (the &quot;Terms of Use&quot;) govern your use of our website www.evaly.com.bd (the &quot;Website&quot;) and our &quot;StackFood&quot; application for mobile and handheld devices (the &quot;App&quot;). The Website and the App are jointly referred to as the &quot;Platform&quot;. Please read these Terms of Use carefully before you use the services. If you do not agree to these Terms of Use, you may not use the services on the Platform, and we request you to uninstall the App. By installing, downloading and/or even merely using the Platform, you shall be contracting with StackFood and you provide your acceptance to the Terms of Use and other StackFood policies (including but not limited to the Cancellation &amp; Refund Policy, Privacy Policy etc.) as posted on the Platform from time to time, which takes effect on the date on which you download, install or use the Services, and create a legally binding arrangement to abide by the same. The Platforms will be used by (i) natural persons who have reached 18 years of age and (ii) corporate legal entities, e.g companies. Where applicable, these Terms shall be subject to country-specific provisions as set out herein.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>USE OF PLATFORM AND SERVICES</h2>\r\n\r\n<p>All commercial/contractual terms are offered by and agreed to between Buyers and Merchants alone. The commercial/contractual terms include without limitation to price, taxes, shipping costs, payment methods, payment terms, date, period and mode of delivery, warranties related to products and services and after sales services related to products and services. StackFood does not have any kind of control or does not determine or advise or in any way involve itself in the offering or acceptance of such commercial/contractual terms between the Buyers and Merchants. StackFood may, however, offer support services to Merchants in respect to order fulfilment, payment collection, call ce</p>\r\n\r\n<p>StackFood&nbsp;is operating an e-commerce platform and assumes and operates the role of facilitator, and does not at any point of time during any transaction between Buyer and Merchant on the Platform come into or take possession of any of the products or services offered by Merchant. At no time shall StackFood hold any right, title or interest over the products nor shall StackFood have any obligations or liabilities in respect of such contract entered into between Buyer and Merchant. You agree and acknowledge that we shall not be responsible for:</p>\r\n\r\n<p>The goods provided by the shops or restaurants including, but not limited, serving of food orders suiting your requirements and needs;<br />\r\nThe Merchant&quot;s goods not being up to your expectations or leading to any loss, harm or damage to you;<br />\r\nThe availability or unavailability of certain items on the menu;<br />\r\nThe Merchant serving the incorrect orders.<br />\r\nThe details of the menu and price list available on the Platform are based on the information provided by the Merchants and we shall not be responsible for any change or cancellation or unavailability. All Menu &amp; Food Images used on our platforms are only representative and shall/might not match with the actual Menu/Food Ordered, StackFood shall not be responsible or Liable for any discrepancies or variations on this aspect.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Personal Information that you provide</h2>\r\n\r\n<p>If you want to use our service, you must create an account on our Site. To establish your account, we will ask for personally identifiable information that can be used to contact or identify you, which may include your name, phone number, and e-mail address. We may also collect demographic information about you, such as your zip code, and allow you to submit additional information that will be part of your profile. Other than basic information that we need to establish your account, it will be up to you to decide how much information to share as part of your profile. We encourage you to think carefully about the information that you share and we recommend that you guard your identity and your sensitive information. Of course, you can review and revise your profile at any time.</p>', NULL, '2023-09-26 08:16:30'),
(37, 'inactive_auth_minute', '30', NULL, NULL),
(38, 'about_us', '<h2 style=\"font-style:italic\">&nbsp;</h2>\r\n\r\n<h2><strong>6cash is the&nbsp;best digital wallet</strong><br />\r\n&nbsp;</h2>\r\n\r\n<p>6cash is a digital wallet-supported system that offers secure and efficient transactions through a mobile application. It was created with the aim of providing a convenient and hassle-free way for people to manage their finances, whether it be sending or receiving money, making online purchases, or paying bills.</p>\r\n\r\n<p>As a digital wallet system, 6cash operates entirely online, allowing users to access their funds from anywhere with an internet connection. This means that users no longer need to carry cash or cards with them, reducing the risk of theft or loss. Moreover, it offers a fast and easy way to manage transactions without the need to go to a physical bank or financial institution.</p>\r\n\r\n<p>The 6cash platform is user-friendly and intuitive, making it accessible to people of all ages and backgrounds. It offers a range of features such as Add Money, Send Money, Cash Out, and Request Money, which can be accessed via the customer app and agent app. One of the key features of 6cash is its QR code scanner, which allows for quick and safe transactions.</p>\r\n\r\n<p>Overall, 6cash is a digital wallet-supported system that offers a range of features to make financial management more accessible, secure, and efficient. With its user-friendly platform, advanced security features, and comprehensive transaction reports, 6cash is a reliable and convenient tool for managing your finances.</p>', NULL, '2023-09-26 08:21:41'),
(39, 'stripe', '{\"status\":\"0\",\"api_key\":\"\",\"published_key\":\"\"}', '2022-04-16 07:43:45', '2022-04-19 06:30:02'),
(40, 'razor_pay', '{\"status\":\"0\",\"razor_key\":\"\",\"razor_secret\":\"\"}', '2022-04-16 08:04:01', '2022-04-19 06:31:39'),
(41, 'paystack', '{\"status\":\"0\",\"publicKey\":\"\",\"secretKey\":\"\",\"paymentUrl\":\"https:\\/\\/api.paystack.co\",\"merchantEmail\":\"demo@gmail.com\"}', '2022-04-16 08:04:29', '2022-04-19 06:29:56'),
(42, 'bkash', '{\"status\":\"0\",\"api_key\":null,\"api_secret\":null,\"username\":null,\"password\":null}', NULL, NULL),
(43, 'paymob', '{\"status\":\"0\",\"api_key\":\"==\",\"iframe_id\":\"\",\"integration_id\":\"\",\"hmac\":\"\"}', NULL, NULL),
(44, 'mercadopago', '{\"status\":\"0\",\"public_key\":\"\",\"access_token\":\"\"}', NULL, NULL),
(45, 'flutterwave', '{\"status\":\"0\",\"public_key\":\"\",\"secret_key\":\"\",\"hash\":\"\"}', NULL, NULL),
(46, 'senang_pay', '{\"status\":\"0\",\"secret_key\":\"\",\"merchant_id\":\"\"}', '2022-04-16 08:05:57', '2022-04-16 08:17:12'),
(47, 'app_theme', '1', NULL, NULL),
(48, 'payment_otp_verification', '1', NULL, NULL),
(49, 'hotline_number', '134679', NULL, NULL),
(50, 'merchant_commission_percent', '10', NULL, NULL),
(51, 'payment', '{\"status\":1,\"message\":\"payment done successfully.\"}', NULL, NULL),
(52, 'withdraw_charge_percent', '5', NULL, NULL),
(53, 'add_money_bonus', '{\"status\":1,\"message\":\"Added to your account with bonus.\"}', NULL, NULL),
(54, 'agent_self_registration', '1', NULL, NULL),
(55, 'maximum_otp_hit', '5', NULL, NULL),
(56, 'otp_resend_time', '60', NULL, NULL),
(57, 'temporary_block_time', '600', NULL, NULL),
(58, 'maximum_login_hit', '5', NULL, NULL),
(59, 'temporary_login_block_time', '600', NULL, NULL),
(60, 'add_money_status', '1', NULL, NULL),
(61, 'send_money_status', '1', NULL, NULL),
(62, 'cash_out_status', '1', NULL, NULL),
(63, 'send_money_request_status', '1', NULL, NULL),
(64, 'withdraw_request_status', '1', NULL, NULL),
(65, 'linked_website_status', '1', NULL, NULL),
(66, 'banner_status', '1', NULL, NULL),
(67, 'customer_add_money_limit', '{\"status\":0,\"transaction_limit_per_day\":3,\"max_amount_per_transaction\":10,\"total_transaction_amount_per_day\":20,\"transaction_limit_per_month\":5,\"total_transaction_amount_per_month\":50}', NULL, NULL),
(68, 'customer_send_money_limit', '{\"status\":0,\"transaction_limit_per_day\":3,\"max_amount_per_transaction\":10,\"total_transaction_amount_per_day\":20,\"transaction_limit_per_month\":5,\"total_transaction_amount_per_month\":50}', NULL, NULL),
(69, 'customer_send_money_request_limit', '{\"status\":0,\"transaction_limit_per_day\":3,\"max_amount_per_transaction\":10,\"total_transaction_amount_per_day\":20,\"transaction_limit_per_month\":5,\"total_transaction_amount_per_month\":50}', NULL, NULL),
(70, 'customer_cash_out_limit', '{\"status\":0,\"transaction_limit_per_day\":3,\"max_amount_per_transaction\":10,\"total_transaction_amount_per_day\":20,\"transaction_limit_per_month\":5,\"total_transaction_amount_per_month\":50}', NULL, NULL),
(71, 'customer_withdraw_request_limit', '{\"status\":0,\"transaction_limit_per_day\":3,\"max_amount_per_transaction\":10,\"total_transaction_amount_per_day\":20,\"transaction_limit_per_month\":5,\"total_transaction_amount_per_month\":50}', NULL, NULL),
(72, 'agent_add_money_limit', '{\"status\":0,\"transaction_limit_per_day\":3,\"max_amount_per_transaction\":10,\"total_transaction_amount_per_day\":20,\"transaction_limit_per_month\":5,\"total_transaction_amount_per_month\":50}', NULL, NULL),
(73, 'agent_send_money_limit', '{\"status\":0,\"transaction_limit_per_day\":3,\"max_amount_per_transaction\":10,\"total_transaction_amount_per_day\":20,\"transaction_limit_per_month\":5,\"total_transaction_amount_per_month\":50}', NULL, NULL),
(74, 'agent_send_money_request_limit', '{\"status\":0,\"transaction_limit_per_day\":3,\"max_amount_per_transaction\":10,\"total_transaction_amount_per_day\":20,\"transaction_limit_per_month\":5,\"total_transaction_amount_per_month\":50}', NULL, NULL),
(75, 'agent_withdraw_request_limit', '{\"status\":0,\"transaction_limit_per_day\":3,\"max_amount_per_transaction\":10,\"total_transaction_amount_per_day\":20,\"transaction_limit_per_month\":5,\"total_transaction_amount_per_month\":50}', NULL, NULL),
(76, 'agent_self_delete', '1', NULL, NULL),
(77, 'customer_self_delete', '1', NULL, NULL),
(78, 'landing_intro_section_status', '1', NULL, NULL),
(79, 'intro_section', '{\"title\":\"Your day-to-day %% **Online Wallet**\",\"description\":\"Welcome to 6Cash! Your personal digital wallet for daily life. With 6Cash, you can easily make payments, transfer money, add money, and cash out from your 6Cash wallet.\",\"download_link\":\"https:\\/\\/drive.google.com\\/drive\\/folders\\/1D-VMHj5LwsyKIchWcUC3Zh_B-lyocpgV?usp=sharing\",\"button_name\":\"Download\",\"intro_left_image\":\"2023-09-26-651287ef98c9f.png\",\"intro_middle_image\":\"2023-09-26-6512875800b78.png\",\"intro_right_image\":\"2023-09-26-6512875800be8.png\"}', NULL, NULL),
(80, 'user_rating_with_total_user_section', '{\"reviewer_name\":\"John Snow\",\"rating\":\"5\",\"total_user_count\":\"1900\",\"total_user_content\":\"Active Users\",\"review_user_icon\":\"2023-09-26-651286b17bb79.png\",\"user_image_one\":\"2023-09-26-651286b18050b.png\",\"user_image_two\":\"2023-09-26-651286b180639.png\",\"user_image_three\":\"2023-09-26-651286b180703.png\"}', NULL, NULL),
(81, 'landing_feature_title', 'Using Digital Wallet is Now ##Easier!##', NULL, NULL),
(82, 'landing_feature_status', '1', NULL, NULL),
(83, 'landing_screenshots_status', '1', NULL, NULL),
(84, 'landing_why_choose_us_status', '1', NULL, NULL),
(85, 'landing_why_choose_us_title', 'Choose ##6cash## for %% Secure and Convenient Digital Payments', NULL, NULL),
(86, 'landing_agent_registration_section_status', '1', NULL, NULL),
(87, 'agent_registration_section', '{\"title\":\"Join As Agent & %% @@Earn Money@@\",\"banner\":\"2023-09-26-65128d604df12.png\"}', NULL, NULL),
(88, 'landing_how_it_works_section_status', '1', NULL, NULL),
(89, 'landing_how_it_works_section_title', 'How it **works**', NULL, NULL),
(90, 'landing_download_section_status', '1', NULL, NULL),
(91, 'download_section', '{\"title\":\"Access 6Cash %% Anytime, Anywhere!\",\"sub_title\":\"All the power of niche in your pocket. Schedule, publish and monitir your accounts with ease.\",\"play_store_link\":\"https:\\/\\/drive.google.com\\/file\\/d\\/1LRgbJtNTDa20RMsfuDXbiCamJuqvzK2o\\/view?usp=sharing\",\"app_store_link\":null,\"image\":\"2023-09-26-65128f461e2c2.png\"}', NULL, NULL),
(92, 'landing_business_statistics_status', '1', NULL, NULL),
(93, 'business_statistics_download', '{\"download_count\":\"2500\",\"review_count\":\"4.5\",\"title\":\"##Real## Stories from 6cash Users\",\"sub_title\":\"6Cash is loved by millions of people & trusted by thousands of businesses nationwide.\",\"country_count\":\"15000\",\"download_sort_description\":\"Downloads from Android & iOS\",\"review_sort_description\":\"Based on 1258 reviews\",\"country_sort_description\":\"Users around the country.\",\"download_icon\":\"2023-09-26-65128dd9e29eb.png\",\"review_icon\":\"2023-09-26-65128dd9e2b93.png\",\"country_icon\":\"2023-09-26-65128dd9e2c23.png\"}', NULL, NULL),
(94, 'contact_us_section', '{\"title\":\"##Contact## Us\",\"sub_title\":\"Reach out to us easily and quickly. We\'re here to assist you with any concerns, or inquiries you may have\"}', NULL, NULL),
(95, 'about_us_title', 'About ##6cash##', NULL, '2023-09-26 08:21:41'),
(96, 'about_us_sub_title', 'Learn more about who we are, our mission, and our values. Discover the people behind our journey', NULL, '2023-09-26 08:21:41'),
(97, 'about_us_image', '2023-09-26-65129179a5b75.png', NULL, NULL),
(98, 'privacy_policy_title', '##Privacy## Policy', NULL, '2023-09-26 08:20:40'),
(99, 'privacy_policy_sub_title', 'Discover how we protect your personal information and respect your privacy. Explore our privacy policy to learn about data handling and security practices', NULL, '2023-09-26 08:20:40'),
(100, 'terms_and_conditions_title', '##Terms## & Condition', NULL, '2023-09-26 08:16:30'),
(101, 'terms_and_conditions_sub_title', 'Explore the legal terms and conditions that govern our services. Understand the rules, policies, and agreements that apply to your interactions with us', NULL, '2023-09-26 08:16:30'),
(102, 'business_short_description', '6Cash is your personal digital wallet solution for your daily life. Download the 6Cash app today!', NULL, NULL),
(103, 'landing_page_logo', '2023-09-26-651295177e230.png', NULL, NULL),
(104, 'mail_config', '{\"status\":\"0\",\"name\":\"\",\"host\":\"\",\"driver\":\"\",\"port\":\"\",\"username\":\"\",\"email_id\":\"\",\"encryption\":\"\",\"password\":\"\"}', NULL, NULL),
(105, 'feature', '[{\"id\":\"5567416407\",\"title\":\"Send Money\",\"sub_title\":\"Transfer your money to another 6Cash wallet.\",\"status\":\"1\",\"image\":\"2023-09-26-6512acff7821e.png\"},{\"id\":\"5841841733\",\"title\":\"Cashout\",\"sub_title\":\"Ask for cash out from a nearby 6Cash agent.\",\"status\":\"1\",\"image\":\"2023-09-26-6512ad1f52e0d.png\"},{\"id\":\"3016780574\",\"title\":\"Add Money\",\"sub_title\":\"Add money to your 6Cash wallet from other accounts.\",\"status\":\"1\",\"image\":\"2023-09-26-6512ad4131cfb.png\"},{\"id\":\"6329031938\",\"title\":\"Request Money\",\"sub_title\":\"Request money from other 6Cash wallet users to your wallet.\",\"status\":\"1\",\"image\":\"2023-09-26-6512ad5810b3b.png\"}]', NULL, NULL),
(106, 'screenshots', '[{\"id\":\"5966070515\",\"image\":\"2023-09-26-65128a508c43f.png\",\"status\":\"1\"},{\"id\":9478130614,\"image\":\"2023-09-26-65128a9103959.png\",\"status\":\"1\"},{\"id\":1111092826,\"image\":\"2023-09-26-65128abbdebc6.png\",\"status\":\"1\"},{\"id\":4658118857,\"image\":\"2023-09-26-65128ac94ea53.png\",\"status\":\"1\"},{\"id\":4946297612,\"image\":\"2023-09-26-65128ad688fee.png\",\"status\":\"1\"},{\"id\":2393337748,\"image\":\"2023-09-26-65128ae260b91.png\",\"status\":\"1\"},{\"id\":1095013034,\"image\":\"2023-09-26-65128afe1ad58.png\",\"status\":\"1\"},{\"id\":7262238049,\"image\":\"2023-09-26-65128b06b1afa.png\",\"status\":\"1\"},{\"id\":1138449967,\"image\":\"2023-09-26-65128b0eb0936.png\",\"status\":\"1\"},{\"id\":3832224460,\"image\":\"2023-09-26-65128b170d677.png\",\"status\":\"1\"}]', NULL, NULL),
(107, 'why_choose_us', '[{\"id\":\"5865925067\",\"title\":\"Authentic User Verification\",\"sub_title\":\"Verify phone and account with biometric face & OTP verification during login.\",\"status\":\"1\",\"image\":\"2023-09-26-65128c5e46925.png\"},{\"id\":\"3264571294\",\"title\":\"Scan & Share QR Code\",\"sub_title\":\"Get your authentic QR code for sharing & scan others\\u2019 QR for money transfers.\",\"status\":\"1\",\"image\":\"2023-09-26-65128cad941b0.png\"},{\"id\":\"1513795937\",\"title\":\"Add Purpose to Money Transfer\",\"sub_title\":\"Let your friends know why you\\u2019re transferring money to their 6Cash wallet.\",\"status\":\"1\",\"image\":\"2023-09-26-65128cc0b5a62.png\"},{\"id\":\"3649402573\",\"title\":\"Share Transaction History\",\"sub_title\":\"Share your transaction history after successfully completing it on other platforms.\",\"status\":\"1\",\"image\":\"2023-09-26-65128cdf5be00.png\"},{\"id\":\"2735635219\",\"title\":\"Multiple Languages\",\"sub_title\":\"Choose your favorite language & get a native feel from your 6Cash mobile app.\",\"status\":\"1\",\"image\":\"2023-09-26-65128cf55a26d.png\"},{\"id\":\"5743752310\",\"title\":\"24\\/7 Customer Support\",\"sub_title\":\"We\\u2019re here to help you with any wallet-related issues, so feel free to call us.\",\"status\":\"1\",\"image\":\"2023-09-26-65128d0a2d6f7.png\"}]', NULL, NULL),
(108, 'how_it_works_section', '[{\"id\":\"6385669496\",\"title\":\"Easy and Secure Login\",\"sub_title\":\"Login to your 6Cash account using a biometric or 4\\u2013digit PIN to access the wallet.\",\"status\":\"1\",\"image\":\"2023-09-26-65128e69ceb31.png\"},{\"id\":5068057319,\"title\":\"Send Money Anytime\",\"sub_title\":\"Send money to your loved ones easily by entering number or scanning QR code.\",\"status\":\"1\",\"image\":\"2023-09-26-6512b4ca6787f.png\"},{\"id\":6512150726,\"title\":\"Enter Amount, PIN & Proceed\",\"sub_title\":\"After entering a 6Cash wallet number, add amount, and PIN to confirm transaction.\",\"status\":\"1\",\"image\":\"2023-09-26-6512b566d5a46.png\"}]', NULL, NULL),
(109, 'testimonial', '[{\"id\":\"9515779530\",\"rating\":\"5\",\"name\":\"Kwame Osei\",\"opinion\":\"Simple payment with swipe option. I can even save agent numbers for future. Highly recommended!\",\"user_type\":\"Customer\",\"status\":\"1\",\"image\":\"2023-09-26-65128eceaf75f.png\"},{\"id\":\"8116331494\",\"rating\":\"5\",\"name\":\"Amina Ndiaye\",\"opinion\":\"Easy to collect payments from customers. My business is booming and becoming very much popular!\",\"user_type\":\"Merchant\",\"status\":\"1\",\"image\":\"2023-09-26-65128f3d1263f.png\"},{\"id\":\"9291787467\",\"rating\":\"5\",\"name\":\"Ousmane Camara\",\"opinion\":\"Quick support from team. The design is top-notch, simple and safe. An easy-to-use digital wallet!\",\"user_type\":\"Agent\",\"status\":\"1\",\"image\":\"2023-09-26-65128f91987bb.png\"}]', NULL, NULL),
(110, 'favicon', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `reply` text DEFAULT NULL,
  `feedback` varchar(255) DEFAULT '0',
  `seen` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `exchange_rate` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `country`, `currency_code`, `currency_symbol`, `exchange_rate`, `created_at`, `updated_at`) VALUES
(1, 'US Dollar', 'USD', '$', '1.00', NULL, NULL),
(2, 'Canadian Dollar', 'CAD', 'CA$', '1.00', NULL, NULL),
(3, 'Euro', 'EUR', '€', '1.00', NULL, NULL),
(4, 'United Arab Emirates Dirham', 'AED', 'د.إ.‏', '1.00', NULL, NULL),
(5, 'Afghan Afghani', 'AFN', '؋', '1.00', NULL, NULL),
(6, 'Albanian Lek', 'ALL', 'L', '1.00', NULL, NULL),
(7, 'Armenian Dram', 'AMD', '֏', '1.00', NULL, NULL),
(8, 'Argentine Peso', 'ARS', '$', '1.00', NULL, NULL),
(9, 'Australian Dollar', 'AUD', '$', '1.00', NULL, NULL),
(10, 'Azerbaijani Manat', 'AZN', '₼', '1.00', NULL, NULL),
(11, 'Bosnia-Herzegovina Convertible Mark', 'BAM', 'KM', '1.00', NULL, NULL),
(12, 'Bangladeshi Taka', 'BDT', '৳', '1.00', NULL, NULL),
(13, 'Bulgarian Lev', 'BGN', 'лв.', '1.00', NULL, NULL),
(14, 'Bahraini Dinar', 'BHD', 'د.ب.‏', '1.00', NULL, NULL),
(15, 'Burundian Franc', 'BIF', 'FBu', '1.00', NULL, NULL),
(16, 'Brunei Dollar', 'BND', 'B$', '1.00', NULL, NULL),
(17, 'Bolivian Boliviano', 'BOB', 'Bs', '1.00', NULL, NULL),
(18, 'Brazilian Real', 'BRL', 'R$', '1.00', NULL, NULL),
(19, 'Botswanan Pula', 'BWP', 'P', '1.00', NULL, NULL),
(20, 'Belarusian Ruble', 'BYN', 'Br', '1.00', NULL, NULL),
(21, 'Belize Dollar', 'BZD', '$', '1.00', NULL, NULL),
(22, 'Congolese Franc', 'CDF', 'FC', '1.00', NULL, NULL),
(23, 'Swiss Franc', 'CHF', 'CHf', '1.00', NULL, NULL),
(24, 'Chilean Peso', 'CLP', '$', '1.00', NULL, NULL),
(25, 'Chinese Yuan', 'CNY', '¥', '1.00', NULL, NULL),
(26, 'Colombian Peso', 'COP', '$', '1.00', NULL, NULL),
(27, 'Costa Rican Colón', 'CRC', '₡', '1.00', NULL, NULL),
(28, 'Cape Verdean Escudo', 'CVE', '$', '1.00', NULL, NULL),
(29, 'Czech Republic Koruna', 'CZK', 'Kč', '1.00', NULL, NULL),
(30, 'Djiboutian Franc', 'DJF', 'Fdj', '1.00', NULL, NULL),
(31, 'Danish Krone', 'DKK', 'Kr.', '1.00', NULL, NULL),
(32, 'Dominican Peso', 'DOP', 'RD$', '1.00', NULL, NULL),
(33, 'Algerian Dinar', 'DZD', 'د.ج.‏', '1.00', NULL, NULL),
(34, 'Estonian Kroon', 'EEK', 'kr', '1.00', NULL, NULL),
(35, 'Egyptian Pound', 'EGP', 'E£‏', '1.00', NULL, NULL),
(36, 'Eritrean Nakfa', 'ERN', 'Nfk', '1.00', NULL, NULL),
(37, 'Ethiopian Birr', 'ETB', 'Br', '1.00', NULL, NULL),
(38, 'British Pound Sterling', 'GBP', '£', '1.00', NULL, NULL),
(39, 'Georgian Lari', 'GEL', 'GEL', '1.00', NULL, NULL),
(40, 'Ghanaian Cedi', 'GHS', 'GH¢', '1.00', NULL, NULL),
(41, 'Guinean Franc', 'GNF', 'FG', '1.00', NULL, NULL),
(42, 'Guatemalan Quetzal', 'GTQ', 'Q', '1.00', NULL, NULL),
(43, 'Hong Kong Dollar', 'HKD', 'HK$', '1.00', NULL, NULL),
(44, 'Honduran Lempira', 'HNL', 'L', '1.00', NULL, NULL),
(45, 'Croatian Kuna', 'HRK', 'kn', '1.00', NULL, NULL),
(46, 'Hungarian Forint', 'HUF', 'Ft', '1.00', NULL, NULL),
(47, 'Indonesian Rupiah', 'IDR', 'Rp', '1.00', NULL, NULL),
(48, 'Israeli New Sheqel', 'ILS', '₪', '1.00', NULL, NULL),
(49, 'Indian Rupee', 'INR', '₹', '1.00', NULL, NULL),
(50, 'Iraqi Dinar', 'IQD', 'ع.د', '1.00', NULL, NULL),
(51, 'Iranian Rial', 'IRR', '﷼', '1.00', NULL, NULL),
(52, 'Icelandic Króna', 'ISK', 'kr', '1.00', NULL, NULL),
(53, 'Jamaican Dollar', 'JMD', '$', '1.00', NULL, NULL),
(54, 'Jordanian Dinar', 'JOD', 'د.ا‏', '1.00', NULL, NULL),
(55, 'Japanese Yen', 'JPY', '¥', '1.00', NULL, NULL),
(56, 'Kenyan Shilling', 'KES', 'Ksh', '1.00', NULL, NULL),
(57, 'Cambodian Riel', 'KHR', '៛', '1.00', NULL, NULL),
(58, 'Comorian Franc', 'KMF', 'FC', '1.00', NULL, NULL),
(59, 'South Korean Won', 'KRW', 'CF', '1.00', NULL, NULL),
(60, 'Kuwaiti Dinar', 'KWD', 'د.ك.‏', '1.00', NULL, NULL),
(61, 'Kazakhstani Tenge', 'KZT', '₸.', '1.00', NULL, NULL),
(62, 'Lebanese Pound', 'LBP', 'ل.ل.‏', '1.00', NULL, NULL),
(63, 'Sri Lankan Rupee', 'LKR', 'Rs', '1.00', NULL, NULL),
(64, 'Lithuanian Litas', 'LTL', 'Lt', '1.00', NULL, NULL),
(65, 'Latvian Lats', 'LVL', 'Ls', '1.00', NULL, NULL),
(66, 'Libyan Dinar', 'LYD', 'د.ل.‏', '1.00', NULL, NULL),
(67, 'Moroccan Dirham', 'MAD', 'د.م.‏', '1.00', NULL, NULL),
(68, 'Moldovan Leu', 'MDL', 'L', '1.00', NULL, NULL),
(69, 'Malagasy Ariary', 'MGA', 'Ar', '1.00', NULL, NULL),
(70, 'Macedonian Denar', 'MKD', 'Ден', '1.00', NULL, NULL),
(71, 'Myanma Kyat', 'MMK', 'K', '1.00', NULL, NULL),
(72, 'Macanese Pataca', 'MOP', 'MOP$', '1.00', NULL, NULL),
(73, 'Mauritian Rupee', 'MUR', 'Rs', '1.00', NULL, NULL),
(74, 'Mexican Peso', 'MXN', '$', '1.00', NULL, NULL),
(75, 'Malaysian Ringgit', 'MYR', 'RM', '1.00', NULL, NULL),
(76, 'Mozambican Metical', 'MZN', 'MT', '1.00', NULL, NULL),
(77, 'Namibian Dollar', 'NAD', 'N$', '1.00', NULL, NULL),
(78, 'Nigerian Naira', 'NGN', '₦', '1.00', NULL, NULL),
(79, 'Nicaraguan Córdoba', 'NIO', 'C$', '1.00', NULL, NULL),
(80, 'Norwegian Krone', 'NOK', 'kr', '1.00', NULL, NULL),
(81, 'Nepalese Rupee', 'NPR', 'Re.', '1.00', NULL, NULL),
(82, 'New Zealand Dollar', 'NZD', '$', '1.00', NULL, NULL),
(83, 'Omani Rial', 'OMR', 'ر.ع.‏', '1.00', NULL, NULL),
(84, 'Panamanian Balboa', 'PAB', 'B/.', '1.00', NULL, NULL),
(85, 'Peruvian Nuevo Sol', 'PEN', 'S/', '1.00', NULL, NULL),
(86, 'Philippine Peso', 'PHP', '₱', '1.00', NULL, NULL),
(87, 'Pakistani Rupee', 'PKR', 'Rs', '1.00', NULL, NULL),
(88, 'Polish Zloty', 'PLN', 'zł', '1.00', NULL, NULL),
(89, 'Paraguayan Guarani', 'PYG', '₲', '1.00', NULL, NULL),
(90, 'Qatari Rial', 'QAR', 'ر.ق.‏', '1.00', NULL, NULL),
(91, 'Romanian Leu', 'RON', 'lei', '1.00', NULL, NULL),
(92, 'Serbian Dinar', 'RSD', 'din.', '1.00', NULL, NULL),
(93, 'Russian Ruble', 'RUB', '₽.', '1.00', NULL, NULL),
(94, 'Rwandan Franc', 'RWF', 'FRw', '1.00', NULL, NULL),
(95, 'Saudi Riyal', 'SAR', 'ر.س.‏', '1.00', NULL, NULL),
(96, 'Sudanese Pound', 'SDG', 'ج.س.', '1.00', NULL, NULL),
(97, 'Swedish Krona', 'SEK', 'kr', '1.00', NULL, NULL),
(98, 'Singapore Dollar', 'SGD', '$', '1.00', NULL, NULL),
(99, 'Somali Shilling', 'SOS', 'Sh.so.', '1.00', NULL, NULL),
(100, 'Syrian Pound', 'SYP', 'LS‏', '1.00', NULL, NULL),
(101, 'Thai Baht', 'THB', '฿', '1.00', NULL, NULL),
(102, 'Tunisian Dinar', 'TND', 'د.ت‏', '1.00', NULL, NULL),
(103, 'Tongan Paʻanga', 'TOP', 'T$', '1.00', NULL, NULL),
(104, 'Turkish Lira', 'TRY', '₺', '1.00', NULL, NULL),
(105, 'Trinidad and Tobago Dollar', 'TTD', '$', '1.00', NULL, NULL),
(106, 'New Taiwan Dollar', 'TWD', 'NT$', '1.00', NULL, NULL),
(107, 'Tanzanian Shilling', 'TZS', 'TSh', '1.00', NULL, NULL),
(108, 'Ukrainian Hryvnia', 'UAH', '₴', '1.00', NULL, NULL),
(109, 'Ugandan Shilling', 'UGX', 'USh', '1.00', NULL, NULL),
(110, 'Uruguayan Peso', 'UYU', '$', '1.00', NULL, NULL),
(111, 'Uzbekistan Som', 'UZS', 'so\'m', '1.00', NULL, NULL),
(112, 'Venezuelan Bolívar', 'VEF', 'Bs.F.', '1.00', NULL, NULL),
(113, 'Vietnamese Dong', 'VND', '₫', '1.00', NULL, NULL),
(114, 'CFA Franc BEAC', 'XAF', 'FCFA', '1.00', NULL, NULL),
(115, 'CFA Franc BCEAO', 'XOF', 'CFA', '1.00', NULL, NULL),
(116, 'Yemeni Rial', 'YER', '﷼‏', '1.00', NULL, NULL),
(117, 'South African Rand', 'ZAR', 'R', '1.00', NULL, NULL),
(118, 'Zambian Kwacha', 'ZMK', 'ZK', '1.00', NULL, NULL),
(119, 'Zimbabwean Dollar', 'ZWL', 'Z$', '1.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_money`
--

CREATE TABLE `e_money` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `current_balance` double(14,2) NOT NULL DEFAULT 0.00,
  `charge_earned` double(14,2) NOT NULL DEFAULT 0.00,
  `pending_balance` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `e_money`
--

INSERT INTO `e_money` (`id`, `user_id`, `current_balance`, `charge_earned`, `pending_balance`, `created_at`, `updated_at`) VALUES
(1, 1, 0.00, 0.00, 0, '2023-09-26 07:05:38', '2023-09-26 07:05:38');

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
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `amount` double(14,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) NOT NULL,
  `tran_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `help_topics`
--

CREATE TABLE `help_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `ranking` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `linked_websites`
--

CREATE TABLE `linked_websites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `linked_websites`
--

INSERT INTO `linked_websites` (`id`, `name`, `image`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Daraz', '2022-04-18-625cfbf0275c8.png', 'https://daraz.com/', 1, '2022-04-07 08:23:08', '2022-04-18 09:49:36'),
(2, 'Amazon', '2022-04-18-625cf5e5dd9b3.png', 'http://www.amazon.com/', 1, '2022-04-07 08:27:25', '2022-04-18 09:23:49'),
(3, 'AS', '2022-04-18-625cfc0663881.png', 'https://www.facebook.com/', 1, '2022-04-18 09:49:58', '2022-04-18 09:49:58'),
(4, 'FF', '2022-04-18-625cfc1f1b14b.png', 'https://www.linkedin.com/signup', 1, '2022-04-18 09:50:23', '2022-04-18 09:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `callback` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bin` varchar(255) DEFAULT NULL,
  `public_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `merchant_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(241, '2014_10_12_000000_create_users_table', 1),
(242, '2014_10_12_100000_create_password_resets_table', 1),
(243, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(244, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(245, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(246, '2016_06_01_000004_create_oauth_clients_table', 1),
(247, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(248, '2019_08_19_000000_create_failed_jobs_table', 1),
(249, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(250, '2021_11_18_104105_create_business_settings_table', 1),
(251, '2021_11_20_090531_create_currencies_table', 1),
(252, '2021_11_22_065212_add_last_active_at_to_users_table', 1),
(253, '2021_11_23_090107_create_linked_websites_table', 1),
(254, '2021_11_23_104425_add_reference_columns_to_users_table', 1),
(255, '2021_11_23_123056_create_notifications_table', 1),
(256, '2021_11_27_041913_create_phone_verifications_table', 1),
(257, '2021_11_27_052236_add_columns_to_users_table', 1),
(258, '2021_11_29_100204_create_transfers_table', 1),
(259, '2021_12_01_053955_create_transactions_table', 1),
(260, '2021_12_01_063108_create_e_money_table', 1),
(261, '2021_12_04_113130_create_request_money_table', 1),
(262, '2021_12_05_051247_create_funds_table', 1),
(263, '2021_12_06_101224_create_purposes_table', 1),
(264, '2021_12_14_104755_add_note_column_to_transaction', 1),
(265, '2021_12_19_071059_add_twofactor_and_fcmtoken_to_users_table', 1),
(266, '2021_12_21_110529_create_banners_table', 1),
(267, '2021_12_22_121505_add_receiver_column_to_notifications', 1),
(268, '2021_12_26_061202_create_help_topics_table', 1),
(269, '2022_02_01_041254_add_transaction_i_d_to_transactions', 1),
(270, '2022_02_01_065231_type_change_of_ref_trans_id_to_transactions', 1),
(271, '2022_04_07_045435_add_receiver_to_banner_table', 2),
(272, '2022_04_07_060244_add_is_active_column_to_to_users_table', 3),
(273, '2021_06_17_054551_create_soft_credentials_table', 4),
(274, '2022_06_30_051435_add_column_to_user_table', 5),
(275, '2022_07_05_102531_change_data_type_of_transfer_table', 6),
(276, '2022_10_16_063545_create_withdrawal_methods_table', 7),
(277, '2022_10_18_040302_create_withdraw_requests_table', 7),
(278, '2022_10_18_141838_create_user_log_histories_table', 7),
(279, '2022_11_08_055006_change_default_kyc_status', 7),
(280, '2022_12_08_045549_create_merchants_table', 8),
(281, '2022_12_11_050638_create_payment_records_table', 8),
(282, '2022_12_21_041139_add_column_dail_country_code_to_users_table', 8),
(283, '2022_12_26_122524_add_expired_at_column_in_payment_records_table', 8),
(284, '2023_01_23_065548_add_pending_balance_in_e_money_table', 8),
(285, '2023_03_25_082756_create_bonuses_table', 9),
(286, '2023_03_29_085117_add_col_to_withdraw_requests_table', 9),
(287, '2023_04_03_030436_add_column_to_transactions_table', 9),
(288, '2023_05_11_084421_change_notifications_table_column_type', 10),
(289, '2023_05_15_153550_add_otp_hist_counts_column_in_phone_verification_tabel', 10),
(290, '2023_05_25_083248_add_multiple_column_to_password_resets', 10),
(291, '2023_05_25_083248_add_multiple_column_to_users', 10),
(292, '2023_05_28_085211_create_transaction_limits_table', 10),
(293, '2023_05_31_051107_add_soft_delete_in_users', 10),
(294, '2023_09_18_042428_create_news_letters_table', 11),
(295, '2023_09_18_054929_create_contact_messages_table', 11),
(296, '2023_09_19_045232_change_identification_image_to_users_table', 11),
(297, '2023_09_20_095151_create_social_media_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

CREATE TABLE `news_letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL COMMENT 'Subscribers email',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `receiver` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'bR3oc2ab81JlHVMcsIXdFcAhBuXQTipmcIcd7Fno', NULL, 'http://localhost', 1, 0, 0, '2022-04-07 08:03:44', '2022-04-07 08:03:44'),
(2, NULL, 'Laravel Password Grant Client', 'UhJDtulOAo0vdfuaHCtQ4KT4QOiYDdmImM9x48Ax', 'users', 'http://localhost', 0, 1, 0, '2022-04-07 08:03:44', '2022-04-07 08:03:44'),
(3, NULL, 'Laravel Personal Access Client', 'HpFYsWP7yU6grzZOwpsWP1oACFUuOwMHHMGuqYgl', NULL, 'http://localhost', 1, 0, 0, '2022-04-07 08:03:56', '2022-04-07 08:03:56'),
(4, NULL, 'Laravel Password Grant Client', 'P03bw333WuSbG3KcWW0VYBBOOTAhcCZaCB3rTt3V', 'users', 'http://localhost', 0, 1, 0, '2022-04-07 08:03:56', '2022-04-07 08:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-04-07 08:03:44', '2022-04-07 08:03:44'),
(2, 3, '2022-04-07 08:03:56', '2022-04-07 08:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `phone` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `otp_hit_count` tinyint(4) NOT NULL DEFAULT 0,
  `is_temp_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `temp_block_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_records`
--

CREATE TABLE `payment_records` (
  `id` char(36) NOT NULL,
  `merchant_user_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` double(14,2) NOT NULL DEFAULT 0.00,
  `callback` varchar(255) DEFAULT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=unpaid, 1=paid',
  `expired_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `id` char(36) NOT NULL,
  `payer_id` varchar(64) DEFAULT NULL,
  `receiver_id` varchar(64) DEFAULT NULL,
  `payment_amount` decimal(24,2) NOT NULL DEFAULT 0.00,
  `gateway_callback_url` varchar(191) DEFAULT NULL,
  `success_hook` varchar(100) DEFAULT NULL,
  `failure_hook` varchar(100) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `currency_code` varchar(20) NOT NULL DEFAULT 'USD',
  `payment_method` varchar(50) DEFAULT NULL,
  `additional_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`additional_data`)),
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payer_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payer_information`)),
  `external_redirect_link` varchar(255) DEFAULT NULL,
  `receiver_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`receiver_information`)),
  `attribute_id` varchar(64) DEFAULT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  `payment_platform` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_verifications`
--

CREATE TABLE `phone_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp_hit_count` tinyint(4) NOT NULL DEFAULT 0,
  `is_temp_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `temp_block_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purposes`
--

CREATE TABLE `purposes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_money`
--

CREATE TABLE `request_money` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) NOT NULL,
  `to_user_id` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` double(14,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `name`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'https://facebook.com/6amtech', 1, NULL, '2023-09-26 13:51:14'),
(2, 'twitter', 'https://twitter.com/6amtech', 1, NULL, NULL),
(3, 'linkedin', 'https://linkedin.com/company/6amtech', 1, NULL, '2023-09-26 13:54:51'),
(4, 'instagram', 'https://instagram.com/6amtech', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `soft_credentials`
--

CREATE TABLE `soft_credentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ref_trans_id` varchar(255) DEFAULT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `debit` double(14,2) NOT NULL DEFAULT 0.00,
  `credit` double(14,2) NOT NULL DEFAULT 0.00,
  `balance` double(14,2) NOT NULL DEFAULT 0.00,
  `from_user_id` bigint(20) DEFAULT NULL,
  `to_user_id` bigint(20) DEFAULT NULL,
  `bonus_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_limits`
--

CREATE TABLE `transaction_limits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `todays_count` int(11) NOT NULL DEFAULT 0,
  `todays_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `this_months_count` int(11) NOT NULL DEFAULT 0,
  `this_months_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `type` varchar(255) DEFAULT NULL COMMENT 'add_money, send_money, cash_out, send_money_request, withdraw_request',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `sender` bigint(20) NOT NULL,
  `receiver` bigint(20) NOT NULL,
  `receiver_type` varchar(255) NOT NULL,
  `amount` double(14,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `dial_country_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` tinyint(1) NOT NULL COMMENT '[''Admin''=>0, ''Agent''=>1, ''Customer''=>2]',
  `role` tinyint(1) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_phone_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_active_at` timestamp NULL DEFAULT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `referral_id` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `two_factor` tinyint(1) NOT NULL DEFAULT 0,
  `fcm_token` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `identification_type` varchar(255) DEFAULT NULL,
  `identification_number` varchar(255) DEFAULT NULL,
  `identification_image` varchar(255) DEFAULT '[]',
  `is_kyc_verified` tinyint(1) NOT NULL DEFAULT 3 COMMENT '[''Pending''=>0, ''Approved''=>1, ''denied''=>2, ''YetToApply''=>3]',
  `login_hit_count` tinyint(4) NOT NULL DEFAULT 0,
  `is_temp_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `temp_block_time` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_log_histories`
--

CREATE TABLE `user_log_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `device_model` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_methods`
--

CREATE TABLE `withdrawal_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_name` varchar(255) NOT NULL,
  `method_fields` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `amount` double(14,2) NOT NULL DEFAULT 0.00,
  `admin_charge` double(14,2) NOT NULL DEFAULT 0.00,
  `request_status` varchar(255) NOT NULL DEFAULT 'pending',
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `sender_note` varchar(255) DEFAULT NULL,
  `admin_note` varchar(255) DEFAULT NULL,
  `withdrawal_method_id` bigint(20) DEFAULT NULL,
  `withdrawal_method_fields` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addon_settings`
--
ALTER TABLE `addon_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_settings_id_index` (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e_money`
--
ALTER TABLE `e_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_topics`
--
ALTER TABLE `help_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `linked_websites`
--
ALTER TABLE `linked_websites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_letters_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_phone_index` (`phone`);

--
-- Indexes for table `payment_records`
--
ALTER TABLE `payment_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phone_verifications`
--
ALTER TABLE `phone_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purposes`
--
ALTER TABLE `purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_money`
--
ALTER TABLE `request_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soft_credentials`
--
ALTER TABLE `soft_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_limits`
--
ALTER TABLE `transaction_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log_histories`
--
ALTER TABLE `user_log_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_methods`
--
ALTER TABLE `withdrawal_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `e_money`
--
ALTER TABLE `e_money`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `help_topics`
--
ALTER TABLE `help_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `linked_websites`
--
ALTER TABLE `linked_websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_verifications`
--
ALTER TABLE `phone_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purposes`
--
ALTER TABLE `purposes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request_money`
--
ALTER TABLE `request_money`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `soft_credentials`
--
ALTER TABLE `soft_credentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_limits`
--
ALTER TABLE `transaction_limits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_log_histories`
--
ALTER TABLE `user_log_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawal_methods`
--
ALTER TABLE `withdrawal_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
