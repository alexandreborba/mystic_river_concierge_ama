-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql01L:3306
-- Tempo de geração: 19/09/2025 às 14:28
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mystic-river-concierge-ama`
--
CREATE DATABASE IF NOT EXISTS `mystic-river-concierge-ama` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mystic-river-concierge-ama`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeDailyMenus`
--

DROP TABLE IF EXISTS `conciergeDailyMenus`;
CREATE TABLE `conciergeDailyMenus` (
  `dmID` int NOT NULL,
  `dmUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmDate` date DEFAULT NULL,
  `dmName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmTypeUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmFile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmFileOriginal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmFileSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmFileDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmOrder` int DEFAULT '1',
  `dmStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conciergeDailyMenus`
--

INSERT INTO `conciergeDailyMenus` (`dmID`, `dmUUID`, `shipCode`, `operCode`, `langCode`, `dmDate`, `dmName`, `dmTypeUUID`, `dmFile`, `dmFileOriginal`, `dmFileSize`, `dmFileDimensions`, `dmOrder`, `dmStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '010fade0-fa58-44d2-a224-8e4d2f5a59e6', 'QI', 'RDM', 'en', '2025-08-17', 'DM 0', 'd7a4f8f5-ce38-408c-af98-d7d21532c499', '010fade0-fa58-44d2-a224-8e4d2f5a59e6.png', 'QI_CONCIERGE_DAILYMENU.png', '61248', '1920 x 1050', 1, 1, '2025-08-17 18:13:01', 1, '2025-08-18 11:28:50', 1, NULL, NULL),
(2, '970d10e9-c43e-4f1f-8798-0dee66c8b56a', 'QI', 'RDM', 'en', '2025-08-17', 'DM P1', 'd7a4f8f5-ce38-408c-af98-d7d21532c499', '970d10e9-c43e-4f1f-8798-0dee66c8b56a.png', 'QI_CONCIERGE_DAILYMENU_P1.png', '76278', '1920 x 1050', 1, 1, '2025-08-17 20:43:00', 1, '2025-08-18 11:29:03', 1, NULL, NULL),
(3, '5e50e587-f0f2-4a58-b994-9633b5a1f96c', 'QI', 'RDM', 'en', '2025-08-17', 'DM 2', 'd7a4f8f5-ce38-408c-af98-d7d21532c499', '5e50e587-f0f2-4a58-b994-9633b5a1f96c.png', 'QI_CONCIERGE_DAILYPROGRAM_P2.png', '96910', '1920 x 1050', 1, 1, '2025-08-17 20:43:28', 1, '2025-08-18 11:31:16', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeDailyMenusTypes`
--

DROP TABLE IF EXISTS `conciergeDailyMenusTypes`;
CREATE TABLE `conciergeDailyMenusTypes` (
  `dmTypeID` int NOT NULL,
  `dmTypeUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmTypeName` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmTypeStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conciergeDailyMenusTypes`
--

INSERT INTO `conciergeDailyMenusTypes` (`dmTypeID`, `dmTypeUUID`, `shipCode`, `operCode`, `dmTypeName`, `dmTypeStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'd7a4f8f5-ce38-408c-af98-d7d21532c499', 'QI', 'RDM', 'Padrão / Default', 1, '2025-08-18 11:07:49', 0, '2025-08-18 11:07:58', 0, NULL, NULL),
(2, '70c85439-f3ed-43c3-ab48-b9d57eac8436', 'AMA', 'AMA', 'Default / Padrão', 1, '2025-09-19 14:21:12', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeDailyMenusVerticais`
--

DROP TABLE IF EXISTS `conciergeDailyMenusVerticais`;
CREATE TABLE `conciergeDailyMenusVerticais` (
  `dmvID` int NOT NULL,
  `dmvUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmvDate` date DEFAULT NULL,
  `dmvName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmTypeUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmvFile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmvFileOriginal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmvFileSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmvFileDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dmvOrder` int DEFAULT '1',
  `dmvStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conciergeDailyMenusVerticais`
--

INSERT INTO `conciergeDailyMenusVerticais` (`dmvID`, `dmvUUID`, `shipCode`, `operCode`, `langCode`, `dmvDate`, `dmvName`, `dmTypeUUID`, `dmvFile`, `dmvFileOriginal`, `dmvFileSize`, `dmvFileDimensions`, `dmvOrder`, `dmvStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '3b2c296b-0c15-468d-9dac-9a4085176dc2', 'QI', 'RDM', 'en', '2025-08-18', 'Restaurant Menu', 'd7a4f8f5-ce38-408c-af98-d7d21532c499', '3b2c296b-0c15-468d-9dac-9a4085176dc2_vertical.png', 'QI_REST_NO_CONTENT_2.png', '119696', '1089 x 1920', 1, 1, '2025-08-18 11:12:42', 1, '2025-08-18 11:19:10', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeDailyPrograms`
--

DROP TABLE IF EXISTS `conciergeDailyPrograms`;
CREATE TABLE `conciergeDailyPrograms` (
  `dpID` int NOT NULL,
  `dpUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpDate` date DEFAULT NULL,
  `dpName` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpFile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpFileSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpFileDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpFileOriginal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpOrder` int DEFAULT '1',
  `dpStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conciergeDailyPrograms`
--

INSERT INTO `conciergeDailyPrograms` (`dpID`, `dpUUID`, `shipCode`, `operCode`, `langCode`, `dpDate`, `dpName`, `dpFile`, `dpFileSize`, `dpFileDimensions`, `dpFileOriginal`, `dpOrder`, `dpStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'e484826b-b20b-4176-a580-8113cf99313f', 'QI', 'RDM', 'en', '2025-08-17', 'DP', 'e484826b-b20b-4176-a580-8113cf99313f.png', '70224', '1920 x 1050', 'QI_CONCIERGE_DAILYPROGRAM.png', 1, 1, '2025-08-17 19:17:30', 1, NULL, NULL, NULL, NULL),
(2, 'ad564bd0-2511-4943-a11f-c729c82d7810', 'QI', 'RDM', 'fr', '2025-08-17', 'DP FR', 'ad564bd0-2511-4943-a11f-c729c82d7810.png', '78760', '1920 x 1050', 'QI_CONCIERGE_DAILYPROGRAM_PT_FR.png', 1, 1, '2025-08-17 20:18:56', 1, '2025-08-18 11:31:06', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeFastInfos`
--

DROP TABLE IF EXISTS `conciergeFastInfos`;
CREATE TABLE `conciergeFastInfos` (
  `fastInfoID` int NOT NULL,
  `fastInfoUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fastInfoDate` date DEFAULT NULL,
  `fastInfoName` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fastInfoFile` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fastInfoFileSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fastInfoFileDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fastInfoFileOriginal` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fastInfoStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conciergeFastInfos`
--

INSERT INTO `conciergeFastInfos` (`fastInfoID`, `fastInfoUUID`, `shipCode`, `operCode`, `fastInfoDate`, `fastInfoName`, `langCode`, `fastInfoFile`, `fastInfoFileSize`, `fastInfoFileDimensions`, `fastInfoFileOriginal`, `fastInfoStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(2, '075adc22-9488-478b-932b-7b157487998c', 'QI', 'RDM', '2025-08-18', 'info', 'en', '075adc22-9488-478b-932b-7b157487998c.png', '84375', '1920 x 1050', 'QI_CONCIERGE_G_INFORMATION_P1.png', 1, '2025-08-18 09:12:15', 1, '2025-08-18 11:32:07', 1, NULL, NULL),
(3, '72cc46b0-dca8-4188-a7dc-72c5334ca9cd', 'QI', 'RDM', '2025-08-18', 'Info FR', 'en', '72cc46b0-dca8-4188-a7dc-72c5334ca9cd.png', '76624', '1920 x 1050', 'QI_CONCIERGE_G_INFORMATION_FR.png', 1, '2025-08-18 11:32:42', 1, '2025-08-18 11:37:28', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeInteractions`
--

DROP TABLE IF EXISTS `conciergeInteractions`;
CREATE TABLE `conciergeInteractions` (
  `interactionID` int NOT NULL,
  `interactionUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interactionDateTime` datetime DEFAULT NULL,
  `interactionOption` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conciergeInteractions`
--

INSERT INTO `conciergeInteractions` (`interactionID`, `interactionUUID`, `shipCode`, `operCode`, `langCode`, `interactionDateTime`, `interactionOption`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '42c2e9ce-a51a-41ed-84a8-c54464b79b58', 'QI', 'RDM', 'en', '2025-08-18 13:44:26', 'optDailyMenu', '2025-08-18 13:44:26', NULL, NULL, NULL, NULL, NULL),
(2, 'a36b4488-adbb-4453-b0e2-8c3c3d4610ad', 'QI', 'RDM', 'en', '2025-08-18 13:44:27', 'optDailyProgram', '2025-08-18 13:44:27', NULL, NULL, NULL, NULL, NULL),
(3, 'b6c76538-005b-45a4-b7a7-42dbc5a82ba1', 'QI', 'RDM', 'en', '2025-08-18 14:21:28', 'optDailyMenu', '2025-08-18 14:21:28', NULL, NULL, NULL, NULL, NULL),
(4, '60770d8f-74f4-4665-933d-3aaae9f31a8d', 'QI', 'RDM', 'en', '2025-08-18 14:21:29', 'optDailyProgram', '2025-08-18 14:21:29', NULL, NULL, NULL, NULL, NULL),
(5, '984c793f-79e2-4600-9a80-2ea45afad7b9', 'QI', 'RDM', 'en', '2025-08-18 14:21:29', 'optSpa', '2025-08-18 14:21:29', NULL, NULL, NULL, NULL, NULL),
(6, '0cc48e25-0ead-4af2-a715-b450c74029c7', 'QI', 'RDM', 'en', '2025-08-18 14:21:30', 'optShop', '2025-08-18 14:21:30', NULL, NULL, NULL, NULL, NULL),
(7, '384c49f4-d880-4916-b2fc-e90f7e91279d', 'QI', 'RDM', 'en', '2025-08-18 14:21:30', 'optInfo', '2025-08-18 14:21:30', NULL, NULL, NULL, NULL, NULL),
(8, 'f9394fe4-fc0a-4789-a5dc-b2660449deb0', 'QI', 'RDM', 'en', '2025-08-18 14:40:14', 'optSpa', '2025-08-18 14:40:14', NULL, NULL, NULL, NULL, NULL),
(9, 'fba7c634-f82b-42cd-af00-4e91eb175d13', 'QI', 'RDM', 'en', '2025-08-18 14:40:15', 'optShop', '2025-08-18 14:40:15', NULL, NULL, NULL, NULL, NULL),
(10, '8cecf6f8-030e-4a9a-ba54-0e415cca5865', 'QI', 'RDM', 'en', '2025-08-18 14:40:16', 'optInfo', '2025-08-18 14:40:16', NULL, NULL, NULL, NULL, NULL),
(11, '9f2cbb61-e464-4788-ab82-c9afd3a17c6b', 'QI', 'RDM', 'en', '2025-08-18 14:40:17', 'optDailyMenu', '2025-08-18 14:40:17', NULL, NULL, NULL, NULL, NULL),
(12, '62d05924-e2e2-4848-99f4-1fca8d8d59fe', 'QI', 'RDM', 'en', '2025-08-18 15:04:07', 'optDailyProgram', '2025-08-18 15:04:07', NULL, NULL, NULL, NULL, NULL),
(13, 'b99145e2-aa77-4674-b8b1-15cd5189508c', 'QI', 'RDM', 'en', '2025-08-18 15:04:08', 'optSpa', '2025-08-18 15:04:08', NULL, NULL, NULL, NULL, NULL),
(14, 'ad4e1332-56e8-4eb8-881f-3125b21b6662', 'QI', 'RDM', 'en', '2025-08-18 15:04:08', 'optShop', '2025-08-18 15:04:08', NULL, NULL, NULL, NULL, NULL),
(15, 'a598237f-cdfa-442d-9971-2b55dfb50729', 'QI', 'RDM', 'en', '2025-08-18 15:04:10', 'optInfo', '2025-08-18 15:04:10', NULL, NULL, NULL, NULL, NULL),
(16, '48cba10f-bfcd-4d57-9f96-09047fc1f466', 'QI', 'RDM', 'en', '2025-08-18 15:04:11', 'optDailyMenu', '2025-08-18 15:04:11', NULL, NULL, NULL, NULL, NULL),
(17, '2994729a-b30d-4cf6-83c7-6369899e1d70', 'QI', 'RDM', 'en', '2025-08-18 15:04:13', 'optInfo', '2025-08-18 15:04:13', NULL, NULL, NULL, NULL, NULL),
(18, 'db0b258e-c271-436a-bcc9-fc723d6792cb', 'QI', 'RDM', 'en', '2025-08-18 16:20:29', 'optInfo', '2025-08-18 16:20:29', NULL, NULL, NULL, NULL, NULL),
(19, '0fa66ece-b1e7-4f3d-935c-559b1ad704f5', 'QI', 'RDM', 'en', '2025-08-18 16:20:30', 'optShop', '2025-08-18 16:20:30', NULL, NULL, NULL, NULL, NULL),
(20, 'b3aa1041-6533-4907-80e9-530c69a94b5e', 'QI', 'RDM', 'en', '2025-08-18 16:20:31', 'optSpa', '2025-08-18 16:20:31', NULL, NULL, NULL, NULL, NULL),
(21, '0033b7d5-991a-4a0f-9379-4f716d5638e2', 'QI', 'RDM', 'en', '2025-08-18 16:20:31', 'optDailyProgram', '2025-08-18 16:20:31', NULL, NULL, NULL, NULL, NULL),
(22, '2b424431-eeb5-4ab6-a9e3-f474355b80b9', 'QI', 'RDM', 'en', '2025-08-18 16:20:32', 'optDailyMenu', '2025-08-18 16:20:32', NULL, NULL, NULL, NULL, NULL),
(23, '8270e078-38f0-4ca7-b8bc-25416685ae5d', 'QI', 'RDM', 'en', '2025-08-18 16:20:33', 'optShop', '2025-08-18 16:20:33', NULL, NULL, NULL, NULL, NULL),
(24, 'bd240786-d521-4e66-997b-1a6e7ecf7376', 'QI', 'RDM', 'en', '2025-08-18 16:20:33', 'optInfo', '2025-08-18 16:20:33', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeShips`
--

DROP TABLE IF EXISTS `conciergeShips`;
CREATE TABLE `conciergeShips` (
  `shipID` int NOT NULL,
  `shipUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipFileLogo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipFileLogoSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipFileLogoDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipFileImage` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipFileImageSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipFileImageDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipConciergeNoContentImage` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipConciergeNoContentImageSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipConciergeNoContentImageDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipRestaurantNoContentImage` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipRestaurantNoContentImageSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipRestaurantNoContentImageDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipMenuPosition` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'T',
  `shipStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conciergeShips`
--

INSERT INTO `conciergeShips` (`shipID`, `shipUUID`, `shipName`, `shipCode`, `operCode`, `shipFileLogo`, `shipFileLogoSize`, `shipFileLogoDimensions`, `shipFileImage`, `shipFileImageSize`, `shipFileImageDimensions`, `shipConciergeNoContentImage`, `shipConciergeNoContentImageSize`, `shipConciergeNoContentImageDimensions`, `shipRestaurantNoContentImage`, `shipRestaurantNoContentImageSize`, `shipRestaurantNoContentImageDimensions`, `shipMenuPosition`, `shipStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '360c0f68-471e-4209-acb2-4316d1ef6ff6', 'Queen Isabel', 'QI', 'RDM', '360c0f68-471e-4209-acb2-4316d1ef6ff6_logo.png', '22465', '430 x 80', '360c0f68-471e-4209-acb2-4316d1ef6ff6_image.png', '71410', '1920 x 1050', '360c0f68-471e-4209-acb2-4316d1ef6ff6_concierge_nocontent.png', '110282', '1920 x 1050', '360c0f68-471e-4209-acb2-4316d1ef6ff6_restaurant_nocontent.png', '132803', '1089 x 1920', 'T', 1, '2025-08-15 13:02:21', 1, '2025-08-15 13:04:06', 1, NULL, NULL),
(2, '8a4e970d-a4bc-4327-b871-2e2d63423ad7', 'Amavida', 'AMA', 'AMA', '', NULL, NULL, '', NULL, NULL, '', NULL, NULL, '8a4e970d-a4bc-4327-b871-2e2d63423ad7_restaurant_nocontent.png', '2867427', '1089 x 1920', 'T', 1, '2025-09-19 14:01:45', 1, '2025-09-19 14:58:09', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeShops`
--

DROP TABLE IF EXISTS `conciergeShops`;
CREATE TABLE `conciergeShops` (
  `shopID` int NOT NULL,
  `shopUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopDate` date DEFAULT NULL,
  `shopName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopFileTitle` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopFile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopFileSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopFileDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopFileOriginal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopOrder` int DEFAULT '1',
  `shopStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conciergeShops`
--

INSERT INTO `conciergeShops` (`shopID`, `shopUUID`, `shipCode`, `operCode`, `langCode`, `shopDate`, `shopName`, `shopFileTitle`, `shopFile`, `shopFileSize`, `shopFileDimensions`, `shopFileOriginal`, `shopOrder`, `shopStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '1cc248bb-f178-4ef0-8cfa-428d9df8f6c5', 'QI', 'RDM', 'en', '2025-08-17', 'SHOP', NULL, '1cc248bb-f178-4ef0-8cfa-428d9df8f6c5.png', '69677', '1920 x 1050', 'QI_CONCIERGE_SHOP.png', 1, 1, '2025-08-17 20:21:22', 1, '2025-08-18 10:42:14', 1, NULL, NULL),
(2, '79712b42-2547-454c-879d-f4e36621b10d', 'QI', 'RDM', 'fr', '2025-08-17', 'SHOP FR', NULL, '79712b42-2547-454c-879d-f4e36621b10d.png', '76952', '1920 x 1050', 'QI_CONCIERGE_SHOP (2).png', 1, 1, '2025-08-17 20:21:54', 1, '2025-08-18 10:43:33', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeSpas`
--

DROP TABLE IF EXISTS `conciergeSpas`;
CREATE TABLE `conciergeSpas` (
  `spaID` int NOT NULL,
  `spaUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spaDate` date DEFAULT NULL,
  `spaName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spaFileTitle` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spaFile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spaFileSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spaFileDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spaFileOriginal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spaOrder` int DEFAULT '1',
  `spaStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conciergeSpas`
--

INSERT INTO `conciergeSpas` (`spaID`, `spaUUID`, `shipCode`, `operCode`, `langCode`, `spaDate`, `spaName`, `spaFileTitle`, `spaFile`, `spaFileSize`, `spaFileDimensions`, `spaFileOriginal`, `spaOrder`, `spaStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'ce942f66-b9bb-4ca3-935d-f61cd157a4c2', 'QI', 'RDM', 'en', '2025-08-17', 'SPA', NULL, 'ce942f66-b9bb-4ca3-935d-f61cd157a4c2.png', '61460', '1920 x 1050', 'QI_CONCIERGE_SPA.png', 1, 1, '2025-08-17 20:20:47', 1, '2025-08-18 10:39:29', 1, NULL, NULL),
(2, '143ec39f-5736-4893-a897-91b76fd9844b', 'QI', 'RDM', 'fr', '2025-08-17', 'SPA FR', NULL, '143ec39f-5736-4893-a897-91b76fd9844b.png', '64840', '1920 x 1050', 'QI_CONCIERGE_SPA_FR.png', 1, 1, '2025-08-17 20:21:03', 1, '2025-08-18 11:31:32', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `conciergeVideos`
--

DROP TABLE IF EXISTS `conciergeVideos`;
CREATE TABLE `conciergeVideos` (
  `videoID` int NOT NULL,
  `videoUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videoFileTitle` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videoFile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videoFileSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videoFileDimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videoFileOriginal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videoOrder` int DEFAULT '1',
  `videoStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sysCruises`
--

DROP TABLE IF EXISTS `sysCruises`;
CREATE TABLE `sysCruises` (
  `cruiseID` int NOT NULL,
  `cruiseUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cruiseDepartureDate` date DEFAULT NULL,
  `cruiseReturnDate` date DEFAULT NULL,
  `cruiseStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sysCruises`
--

INSERT INTO `sysCruises` (`cruiseID`, `cruiseUUID`, `shipCode`, `cruiseDepartureDate`, `cruiseReturnDate`, `cruiseStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '4bc5d3ea-7026-49ae-a250-f5a9bf068acb', 'DSR', '2025-03-28', '2025-04-03', 1, '2025-02-24 15:44:18', 0, '2025-02-24 15:46:49', 0, '2025-02-24 15:46:49', 0),
(2, 'ce4aa37f-4042-4e7e-8514-5b51c93f431a', 'DQ', '2025-03-20', '2025-03-27', 1, '2025-02-24 16:15:05', 0, NULL, NULL, NULL, NULL),
(3, 'be45a90e-1af7-451a-abb5-a7f5886e8534', 'DQ', '2025-03-27', '2025-04-03', 1, '2025-02-24 16:15:29', 0, NULL, NULL, NULL, NULL),
(4, '78d86afe-e017-42d7-8f0f-a574b8cffdbe', 'DQ', '2025-04-03', '2025-04-10', 1, '2025-02-24 16:15:46', 0, NULL, NULL, NULL, NULL),
(5, '365b5a9e-3e8b-4691-8537-ea23e7812797', 'DQ', '2025-04-10', '2025-04-17', 1, '2025-02-24 16:15:59', 0, NULL, NULL, NULL, NULL),
(6, 'd5610eb9-222e-46a9-acea-195a8a51dd7c', 'DQ', '2025-04-17', '2025-04-24', 1, '2025-02-24 16:16:17', 0, NULL, NULL, NULL, NULL),
(7, 'a6d733a5-844d-45fe-8ff6-88c24fa6e536', 'DQ', '2025-04-24', '2025-05-01', 1, '2025-02-24 16:16:30', 0, NULL, NULL, NULL, NULL),
(8, '45fa177e-6b03-4db8-a06c-7b8091c87950', 'DQ', '2025-05-01', '2025-05-08', 1, '2025-02-24 16:16:41', 0, NULL, NULL, NULL, NULL),
(9, 'b599107a-499b-4ffb-9fd6-9bacbd5ed22f', 'DQ', '2025-05-08', '2025-05-15', 1, '2025-02-24 16:17:03', 0, NULL, NULL, NULL, NULL),
(10, '9d9f6211-583d-493d-ad67-889f1dc412be', 'DQ', '2025-05-15', '2025-05-22', 1, '2025-02-24 16:17:18', 0, NULL, NULL, NULL, NULL),
(11, 'a13ac53d-3b7f-4f43-a47b-1cd826e9c00d', 'DQ', '2025-05-22', '2025-05-29', 1, '2025-02-24 16:17:29', 0, NULL, NULL, NULL, NULL),
(12, 'd1984cc5-a4a5-43b9-bfb2-25f7b65c8b24', 'DQ', '2025-05-29', '2025-06-05', 1, '2025-02-24 16:17:41', 0, NULL, NULL, NULL, NULL),
(13, '5758d521-2068-421a-ac18-ab84443b0d03', 'DQ', '2025-06-05', '2025-06-12', 1, '2025-02-24 16:17:53', 0, NULL, NULL, NULL, NULL),
(14, '51159ac9-4810-4e18-bdd7-fa9aa396e370', 'DQ', '2025-06-12', '2025-06-19', 1, '2025-02-24 16:18:03', 0, NULL, NULL, NULL, NULL),
(15, '217467f9-9ca8-4464-9d3b-3647cf0881b5', 'DQ', '2025-06-19', '2025-06-26', 1, '2025-02-24 16:18:16', 0, NULL, NULL, NULL, NULL),
(16, 'b723b757-2e69-46eb-830b-8546ee7355e8', 'DQ', '2025-06-26', '2025-07-03', 1, '2025-02-24 16:18:26', 0, NULL, NULL, NULL, NULL),
(17, '7f36a7a9-939a-4fd7-9d3c-eb6397ba0d61', 'DQ', '2025-07-03', '2025-07-10', 1, '2025-02-24 16:18:36', 0, NULL, NULL, NULL, NULL),
(18, 'f45dd3f5-2a3a-431c-9d58-e301366dcf1b', 'DQ', '2025-07-10', '2025-07-17', 1, '2025-02-24 16:18:49', 0, NULL, NULL, NULL, NULL),
(19, '0125280f-715d-483b-b926-4e125ca4323c', 'DQ', '2025-07-17', '2025-07-24', 1, '2025-02-24 16:18:59', 0, NULL, NULL, NULL, NULL),
(20, '9d22f6c5-f7d2-4eea-816d-8b3826f378b2', 'DQ', '2025-07-24', '2025-07-31', 1, '2025-02-24 16:19:11', 0, NULL, NULL, NULL, NULL),
(21, '99c26ab7-78c4-42c4-9a01-d5bee1685ec0', 'DQ', '2025-07-31', '2025-08-07', 1, '2025-02-24 16:19:23', 0, NULL, NULL, NULL, NULL),
(22, '2e31aa5c-fdd1-4be5-af87-194e61464126', 'DQ', '2025-08-07', '2025-08-14', 1, '2025-02-24 16:19:34', 0, NULL, NULL, NULL, NULL),
(23, 'ba156f4e-320e-410e-a456-ea6155acbb6b', 'DQ', '2025-08-14', '2025-08-21', 1, '2025-02-24 16:19:48', 0, NULL, NULL, NULL, NULL),
(24, 'fea9d020-0b97-465a-a586-d9f2aacdb109', 'DQ', '2025-08-21', '2025-08-28', 1, '2025-02-24 16:19:59', 0, NULL, NULL, NULL, NULL),
(25, 'ae091b6d-1560-456d-abd6-bd277819ae8d', 'DQ', '2025-08-28', '2025-09-04', 1, '2025-02-24 16:20:11', 0, NULL, NULL, NULL, NULL),
(26, '1021d90b-7eb0-4fbc-9b44-3afbc586b91f', 'DQ', '2025-09-04', '2025-09-11', 1, '2025-02-24 16:20:21', 0, NULL, NULL, NULL, NULL),
(27, '967aaa7f-b46a-4da3-ab65-075535c66f31', 'DQ', '2025-09-11', '2025-09-18', 1, '2025-02-24 16:20:35', 0, NULL, NULL, NULL, NULL),
(28, 'f27b0966-8611-4ed0-8bac-8eff2b33bd1e', 'DQ', '2025-09-25', '2025-10-02', 1, '2025-02-24 16:20:55', 0, NULL, NULL, NULL, NULL),
(29, 'd98ad401-67cd-4475-aa08-fc7b82328fc4', 'DQ', '2025-10-02', '2025-10-09', 1, '2025-02-24 16:21:09', 0, NULL, NULL, NULL, NULL),
(30, 'ed8b1c2a-7b01-4a66-96fb-a3a0e2276408', 'DQ', '2025-10-09', '2025-10-16', 1, '2025-02-24 16:21:20', 0, NULL, NULL, NULL, NULL),
(31, '1a54d102-f78f-4e53-bc9f-5fd472fcad4a', 'DQ', '2025-10-16', '2025-10-23', 1, '2025-02-24 16:21:33', 0, NULL, NULL, NULL, NULL),
(32, '2602ae57-7de0-494e-a7e4-c99b3755129b', 'DQ', '2025-10-23', '2025-10-30', 1, '2025-02-24 16:21:43', 0, NULL, NULL, NULL, NULL),
(33, 'f40b4673-d140-46ac-9397-a9d40900f4b8', 'DQ', '2025-10-30', '2025-11-06', 1, '2025-02-24 16:21:57', 0, NULL, NULL, NULL, NULL),
(34, '6eec8f50-364e-4d30-81e5-86ef2e1070a1', 'DQ', '2025-11-06', '2025-11-13', 1, '2025-02-24 16:22:10', 0, NULL, NULL, NULL, NULL),
(35, 'd9f955f6-e87f-4726-9437-77db0dcf0684', 'DQ', '2025-09-18', '2025-09-25', 1, '2025-02-24 16:24:03', 0, NULL, NULL, NULL, NULL),
(36, '0e40a238-1dcf-44bf-bbfa-2a8591380a80', 'DS', '2025-03-24', '2025-03-31', 1, '2025-02-24 16:28:00', 0, NULL, NULL, NULL, NULL),
(37, 'b36f86a1-ca1f-438b-a770-901d57b0a6da', 'DS', '2025-03-31', '2025-04-07', 1, '2025-02-24 16:28:13', 0, NULL, NULL, NULL, NULL),
(38, '3c513344-4d8c-4db3-8dfc-97be140f7918', 'DS', '2025-04-07', '2025-04-14', 1, '2025-02-24 16:28:26', 0, NULL, NULL, NULL, NULL),
(39, 'db6a953d-ebbd-4082-9c60-6953f17b57b0', 'DS', '2025-04-14', '2025-04-21', 1, '2025-02-24 16:28:40', 0, NULL, NULL, NULL, NULL),
(40, '5b1e37cc-cf78-4e4f-b247-bcc1d7f557bb', 'DS', '2025-04-21', '2025-04-28', 1, '2025-02-24 16:28:50', 0, NULL, NULL, NULL, NULL),
(41, 'fec5dde8-1860-48f7-8cdc-2d15826d8193', 'DS', '2025-04-28', '2025-05-05', 1, '2025-02-24 16:29:04', 0, NULL, NULL, NULL, NULL),
(42, '62cd16d0-c819-461e-a52a-434dbdf15cb9', 'DS', '2025-05-05', '2025-05-12', 1, '2025-02-24 16:29:16', 0, NULL, NULL, NULL, NULL),
(43, '007cf7ad-b61d-484c-ab1c-763e9de67765', 'DS', '2025-05-12', '2025-05-19', 1, '2025-02-24 16:29:26', 0, NULL, NULL, NULL, NULL),
(44, '11c34c45-2433-44a3-aadf-5fe98d2d9151', 'DS', '2025-05-19', '2025-05-26', 1, '2025-02-24 16:29:40', 0, NULL, NULL, NULL, NULL),
(45, 'e29fba35-3dc3-423f-b88e-b12801ab8d5b', 'DS', '2025-05-26', '2025-06-02', 1, '2025-02-24 16:29:58', 0, NULL, NULL, NULL, NULL),
(46, '9b9ef3b6-8f2a-4236-a4df-3adc06d8e180', 'DS', '2025-06-02', '2025-06-09', 1, '2025-02-24 16:30:34', 0, NULL, NULL, NULL, NULL),
(47, '411de33d-d401-40a2-8baa-5e2003787abf', 'DS', '2025-06-09', '2025-06-16', 1, '2025-02-24 16:30:46', 0, NULL, NULL, NULL, NULL),
(48, '6833b6be-2634-4a62-ad29-e029eba10731', 'DS', '2025-06-16', '2025-06-23', 1, '2025-02-24 16:30:57', 0, NULL, NULL, NULL, NULL),
(49, 'dec55938-248a-4095-adb0-ed08509523d9', 'DS', '2025-06-23', '2025-06-30', 1, '2025-02-24 16:31:07', 0, NULL, NULL, NULL, NULL),
(50, 'a9fd7011-32a4-4492-9ab8-b604c6c722f7', 'DS', '2025-06-30', '2025-07-07', 1, '2025-02-24 16:31:18', 0, NULL, NULL, NULL, NULL),
(51, '34bca0ab-e2a2-4602-8614-3bd0baaf8e91', 'DS', '2025-07-07', '2025-07-14', 1, '2025-02-24 16:31:28', 0, NULL, NULL, NULL, NULL),
(52, '2c6ff774-df43-41d2-914e-6238e4989258', 'DS', '2025-07-14', '2025-07-21', 1, '2025-02-24 16:31:42', 0, NULL, NULL, NULL, NULL),
(53, '4f02c355-271b-4690-8a28-6d3aa7fabe46', 'DS', '2025-07-21', '2025-07-28', 1, '2025-02-24 16:31:54', 0, NULL, NULL, NULL, NULL),
(54, '47ce1e2d-45f4-4646-99f5-62ab2d57ec06', 'DS', '2025-07-28', '2025-08-04', 1, '2025-02-24 16:32:08', 0, NULL, NULL, NULL, NULL),
(55, '19e95ffc-7d18-4415-ae21-21a12fff2545', 'DS', '2025-08-04', '2025-08-11', 1, '2025-02-24 16:32:18', 0, NULL, NULL, NULL, NULL),
(56, '138d427d-5a95-4cc1-8456-59f267f4ff02', 'DS', '2025-08-11', '2025-08-18', 1, '2025-02-24 16:32:32', 0, NULL, NULL, NULL, NULL),
(57, 'a4e725dc-56fe-4cc4-8918-c4454a04b257', 'DS', '2025-08-18', '2025-08-25', 1, '2025-02-24 16:32:46', 0, NULL, NULL, NULL, NULL),
(58, '3f3d18c2-375b-4fe9-af94-a467e8ac560a', 'DS', '2025-08-25', '2025-09-01', 1, '2025-02-24 16:32:56', 0, NULL, NULL, NULL, NULL),
(59, 'b1b6919f-fd20-4516-a618-c034ed92de71', 'DS', '2025-09-01', '2025-09-08', 1, '2025-02-24 16:33:07', 0, NULL, NULL, NULL, NULL),
(60, '18eac022-8190-4b9c-b246-38883e1119b9', 'DQ', '2025-09-08', '2025-09-15', 1, '2025-02-24 16:33:18', 0, NULL, NULL, NULL, NULL),
(61, '42f890b1-7583-4d73-89cf-47a17c98512f', 'DS', '2025-09-15', '2025-09-22', 1, '2025-02-24 16:33:34', 0, NULL, NULL, NULL, NULL),
(62, '46c7efaa-3389-46eb-a1cc-77424a516a95', 'DS', '2025-09-22', '2025-09-29', 1, '2025-02-24 16:33:45', 0, NULL, NULL, NULL, NULL),
(63, '0b6ee3c5-78f3-4430-82c3-97679d445dab', 'DS', '2025-09-29', '2025-10-06', 1, '2025-02-24 16:33:56', 0, NULL, NULL, NULL, NULL),
(64, '1abe2b7e-3d45-44fd-b4a6-92bce6f77b14', 'DS', '2025-10-06', '2025-10-13', 1, '2025-02-24 16:34:06', 0, NULL, NULL, NULL, NULL),
(65, '6ac81144-6051-42e0-a749-5b42bf7d470b', 'DS', '2025-10-13', '2025-10-20', 1, '2025-02-24 16:34:20', 0, NULL, NULL, NULL, NULL),
(66, 'cfe842e1-4673-4d4e-b8a8-0874ba6749c2', 'DS', '2025-10-20', '2025-10-27', 1, '2025-02-24 16:34:33', 0, NULL, NULL, NULL, NULL),
(67, '0de5660d-87f4-4933-8db5-cbed764814d1', 'DS', '2025-10-27', '2025-11-03', 1, '2025-02-24 16:34:48', 0, NULL, NULL, NULL, NULL),
(68, '993fd02f-6872-42f3-8277-2abef41044e1', 'DS', '2025-11-03', '2025-11-10', 1, '2025-02-24 16:35:02', 0, NULL, NULL, NULL, NULL),
(69, 'ebe9d536-9009-4471-aab6-29d167824811', 'DS', '2025-11-10', '2025-11-17', 1, '2025-02-24 16:35:11', 0, NULL, NULL, NULL, NULL),
(70, 'a6f43b43-6f75-4b58-8a28-a1d727f2c575', 'DS', '2025-11-17', '2025-11-24', 1, '2025-02-24 16:35:24', 0, NULL, NULL, NULL, NULL),
(71, 'cd0930df-f165-4672-83fd-493eaf6268e9', 'DS', '2025-09-08', '2025-09-15', 1, '2025-02-24 16:38:04', 0, NULL, NULL, NULL, NULL),
(72, '2522710e-d17f-457f-a441-9fa94522f603', 'DEL', '2025-03-20', '2025-03-27', 1, '2025-02-24 16:41:13', 0, NULL, NULL, NULL, NULL),
(73, 'a95bb792-33db-4f31-9114-f53c008dd4b8', 'DEL', '2025-03-27', '2025-04-03', 1, '2025-02-24 16:41:24', 0, NULL, NULL, NULL, NULL),
(74, '3be27ac2-8271-4fe8-9bd2-c4b26f17d0d8', 'DSP', '2025-04-03', '2025-04-10', 1, '2025-02-24 16:41:40', 0, '2025-02-24 17:00:56', NULL, '2025-02-24 17:00:56', 0),
(75, '396230b1-1cad-43c2-bd32-7086e8a56776', 'DEL', '2025-04-10', '2025-04-17', 1, '2025-02-24 16:41:54', 0, NULL, NULL, NULL, NULL),
(76, 'c4afd175-63a5-4f47-9415-bfe003fe6276', 'DEL', '2025-04-17', '2025-04-24', 1, '2025-02-24 16:42:06', 0, NULL, NULL, NULL, NULL),
(77, '61e069ec-4490-4f06-8cbd-c18136689cc8', 'DEL', '2025-04-24', '2025-05-01', 1, '2025-02-24 16:42:17', 0, NULL, NULL, NULL, NULL),
(78, '000972cf-1ee4-41a1-a1eb-24a467bc269d', 'DEL', '2025-05-01', '2025-05-08', 1, '2025-02-24 16:42:28', 0, NULL, NULL, NULL, NULL),
(79, '682e9e97-ec5f-47e0-98db-cf9356a47d75', 'DEL', '2025-05-08', '2025-05-15', 1, '2025-02-24 16:42:41', 0, NULL, NULL, NULL, NULL),
(80, 'ddab1aab-19fe-4df5-af5e-8110253fc337', 'DEL', '2025-05-15', '2025-05-22', 1, '2025-02-24 16:42:56', 0, NULL, NULL, NULL, NULL),
(81, 'ded836b3-5ded-4662-8291-6f60fd7811ba', 'DEL', '2025-05-22', '2025-05-29', 1, '2025-02-24 16:43:06', 0, NULL, NULL, NULL, NULL),
(82, '7f178ae7-d760-41b2-ac49-c1c1b394ad44', 'DEL', '2025-05-29', '2025-06-05', 1, '2025-02-24 16:43:22', 0, NULL, NULL, NULL, NULL),
(83, '71b8bc54-d753-45b5-9cbb-072f4efa8786', 'DEL', '2025-06-05', '2025-06-12', 1, '2025-02-24 16:43:34', 0, NULL, NULL, NULL, NULL),
(84, '95008c19-613d-4ffc-9e61-ecdacdf7041f', 'DEL', '2025-06-12', '2025-06-19', 1, '2025-02-24 16:43:53', 0, NULL, NULL, NULL, NULL),
(85, 'cb8f0220-8f00-4631-9e8f-f0e1fdcb149b', 'DEL', '2025-06-19', '2025-06-26', 1, '2025-02-24 16:44:05', 0, NULL, NULL, NULL, NULL),
(86, 'b6ccaba8-bf7c-48f8-a3b6-9a0a7891ac39', 'DEL', '2025-06-26', '2025-07-03', 1, '2025-02-24 16:44:17', 0, NULL, NULL, NULL, NULL),
(87, '28341759-8ac1-42d8-bc80-37a8a48efe59', 'DEL', '2025-07-03', '2025-07-10', 1, '2025-02-24 16:44:26', 0, NULL, NULL, NULL, NULL),
(88, 'a36cc790-2440-4f8d-871c-baaf7f7c0897', 'DEL', '2025-07-10', '2025-07-17', 1, '2025-02-24 16:44:39', 0, NULL, NULL, NULL, NULL),
(89, 'c119591d-e8c6-4049-a541-1d9e4e130386', 'DEL', '2025-07-17', '2025-07-24', 1, '2025-02-24 16:44:49', 0, NULL, NULL, NULL, NULL),
(90, 'f815281c-1c2b-4525-acd2-c12d9e33cdf6', 'DS', '2025-07-24', '2025-07-31', 1, '2025-02-24 16:45:01', 0, NULL, NULL, NULL, NULL),
(91, '5c9192e6-1948-4d0c-8f68-a767dfdd27fe', 'DEL', '2025-07-31', '2025-08-07', 1, '2025-02-24 16:45:13', 0, NULL, NULL, NULL, NULL),
(92, 'db53889b-16f0-4216-9af4-6883f94a0360', 'DEL', '2025-08-07', '2025-08-14', 1, '2025-02-24 16:45:23', 0, NULL, NULL, NULL, NULL),
(93, 'abb195be-2e5c-481f-a5d2-f8d6ff7cab2a', 'DEL', '2025-08-14', '2025-08-21', 1, '2025-02-24 16:45:34', 0, NULL, NULL, NULL, NULL),
(94, '12941e24-1774-4c0a-8f86-5dae0f2a0bb0', 'DEL', '2025-08-21', '2025-08-28', 1, '2025-02-24 16:45:46', 0, NULL, NULL, NULL, NULL),
(95, '9393d33e-fba6-4768-99d4-11372b110624', 'DEL', '2025-08-28', '2025-09-04', 1, '2025-02-24 16:46:03', 0, NULL, NULL, NULL, NULL),
(96, '5d128d9d-0930-4826-9f54-c5d42a59b2e4', 'DEL', '2025-09-04', '2025-09-11', 1, '2025-02-24 16:46:16', 0, NULL, NULL, NULL, NULL),
(97, 'a89ff4be-c4ad-46f7-b608-987046ae5721', 'DEL', '2025-09-11', '2025-09-18', 1, '2025-02-24 16:46:34', 0, NULL, NULL, NULL, NULL),
(98, '6b42d44e-f9df-466b-a95d-9decacf5db20', 'DEL', '2025-09-18', '2025-09-25', 1, '2025-02-24 16:47:12', 0, NULL, NULL, NULL, NULL),
(99, '20c2fbdb-4974-478d-bf12-82d74f4eca9b', 'DEL', '2025-09-25', '2025-10-02', 1, '2025-02-24 16:47:22', 0, NULL, NULL, NULL, NULL),
(100, 'b968abaa-13bb-4bab-a137-9e3f2b9c4137', 'DEL', '2025-10-02', '2025-10-09', 1, '2025-02-24 16:47:33', 0, NULL, NULL, NULL, NULL),
(101, '6fb5fd14-661e-4544-adc2-86b464e1404c', 'DEL', '2025-10-09', '2025-10-16', 1, '2025-02-24 16:47:43', 0, NULL, NULL, NULL, NULL),
(102, '45829f09-e95d-423c-adfc-573bd30b60d1', 'DEL', '2025-10-16', '2025-10-23', 1, '2025-02-24 16:47:54', 0, NULL, NULL, NULL, NULL),
(103, 'b1a728cf-8f44-46d4-bdf6-c5443085567c', 'DEL', '2025-10-23', '2025-10-30', 1, '2025-02-24 16:48:04', 0, NULL, NULL, NULL, NULL),
(104, 'f05efae8-f2d0-41d7-8f43-5c8d8ddccd70', 'DEL', '2025-10-30', '2025-11-06', 1, '2025-02-24 16:48:15', 0, NULL, NULL, NULL, NULL),
(105, '882d7738-9ff0-4a8c-989e-1c503219a6fa', 'DEL', '2025-11-06', '2025-11-13', 1, '2025-02-24 16:48:28', 0, NULL, NULL, NULL, NULL),
(106, 'c5da4366-89c1-4408-8807-c7e5513ca2b2', 'DEL', '2025-04-03', '2025-04-10', 1, '2025-02-24 16:50:55', 0, NULL, NULL, NULL, NULL),
(107, '91b11482-f541-4f09-a1db-c1d4afec8c84', 'DSP', '2025-03-23', '2025-03-30', 1, '2025-02-24 16:53:04', 0, NULL, NULL, NULL, NULL),
(108, '3fd6ecc7-767e-4a0a-af13-ba3f1960ab51', 'DSP', '2025-03-30', '2025-04-06', 1, '2025-02-24 16:53:16', 0, NULL, NULL, NULL, NULL),
(109, '522bd22e-8a3b-4a62-8ec1-6e582505af4f', 'DSP', '2025-04-06', '2025-04-13', 1, '2025-02-24 16:53:26', 0, NULL, NULL, NULL, NULL),
(110, 'c7bd60c0-1ec4-41f9-8e6e-67d3cbbf3d10', 'DSP', '2025-04-13', '2025-04-20', 1, '2025-02-24 16:53:35', 0, NULL, NULL, NULL, NULL),
(111, 'f98555c4-d32c-4559-9234-d1afeff5e330', 'DSP', '2025-04-20', '2025-04-27', 1, '2025-02-24 16:53:48', 0, NULL, NULL, NULL, NULL),
(112, '78f38aae-8f25-4330-8cf2-df0959691de6', 'DSP', '2025-04-27', '2025-05-04', 1, '2025-02-24 16:53:59', 0, NULL, NULL, NULL, NULL),
(113, '1c8a3d83-e323-4b18-afe8-fb00a29f621c', 'DSP', '2025-05-04', '2025-05-11', 1, '2025-02-24 16:54:10', 0, NULL, NULL, NULL, NULL),
(114, '5ed28806-9a8a-4f92-bc24-19cb9a1fc464', 'DSP', '2025-05-11', '2025-05-18', 1, '2025-02-24 16:54:19', 0, NULL, NULL, NULL, NULL),
(115, 'a9b97c5f-09d8-4c13-84fd-fa23a698110a', 'DSP', '2025-05-18', '2025-05-25', 1, '2025-02-24 16:54:32', 0, NULL, NULL, NULL, NULL),
(116, '0973f42d-cec6-4c9f-94f2-9cf45745067d', 'DSP', '2025-05-25', '2025-06-01', 1, '2025-02-24 16:54:42', 0, NULL, NULL, NULL, NULL),
(117, 'f8923542-2118-44e5-8807-dfb89121e910', 'DSP', '2025-06-01', '2025-06-08', 1, '2025-02-24 16:54:51', 0, NULL, NULL, NULL, NULL),
(118, '36a325a1-2d54-4e11-bbc3-224a625ac58d', 'DSP', '2025-06-08', '2025-06-15', 1, '2025-02-24 16:55:02', 0, NULL, NULL, NULL, NULL),
(119, '5d99c2b2-a4d8-4d5a-bc55-85bc3de7c50f', 'DSP', '2025-06-15', '2025-06-22', 1, '2025-02-24 16:55:12', 0, NULL, NULL, NULL, NULL),
(120, '55565a5c-b514-4cfb-931d-0a1f07cddf1d', 'DSP', '2025-06-22', '2025-06-29', 1, '2025-02-24 16:55:21', 0, NULL, NULL, NULL, NULL),
(121, '1de408f5-d8d6-4695-a971-37ce676abe04', 'DSP', '2025-06-29', '2025-07-06', 1, '2025-02-24 16:55:47', 0, NULL, NULL, NULL, NULL),
(122, '1d03210d-84bd-4a2b-b05e-26c04fd47352', 'DSP', '2025-07-06', '2025-07-13', 1, '2025-02-24 16:55:57', 0, NULL, NULL, NULL, NULL),
(123, 'e6846c97-4b3d-46e9-bcbc-e773bfc6e511', 'DSP', '2025-07-13', '2025-07-20', 1, '2025-02-24 16:56:07', 0, NULL, NULL, NULL, NULL),
(124, '3d39f29e-3fad-4258-909a-5226ae57c420', 'DSP', '2025-07-20', '2025-07-27', 1, '2025-02-24 16:56:18', 0, NULL, NULL, NULL, NULL),
(125, 'a7c58350-b010-42cc-ad93-7148e6daea0a', 'DSP', '2025-07-27', '2025-08-03', 1, '2025-02-24 16:56:31', 0, NULL, NULL, NULL, NULL),
(126, '6334198c-41eb-4d03-a8b5-a9bd2e43bab3', 'DSP', '2025-08-03', '2025-08-10', 1, '2025-02-24 16:56:41', 0, NULL, NULL, NULL, NULL),
(127, '38d51fc3-f341-4305-b3f0-1096827ea360', 'DSP', '2025-08-10', '2025-08-17', 1, '2025-02-24 16:56:51', 0, NULL, NULL, NULL, NULL),
(128, 'ab70fb6a-48c4-4717-a1cb-a8785a059166', 'DSP', '2025-08-17', '2025-08-24', 1, '2025-02-24 16:57:02', 0, NULL, NULL, NULL, NULL),
(129, '403a355c-84b2-4f6d-ba07-61efd5d957fa', 'DSP', '2025-08-24', '2025-08-31', 1, '2025-02-24 16:57:14', 0, NULL, NULL, NULL, NULL),
(130, '4afde32f-c9be-4be9-abc6-86821c769459', 'DSP', '2025-08-31', '2025-09-07', 1, '2025-02-24 16:57:50', 0, NULL, NULL, NULL, NULL),
(131, '8e0a1fcd-8e3f-46af-ba55-dc31bf4b1aea', 'DSP', '2025-09-07', '2025-09-14', 1, '2025-02-24 16:58:00', 0, NULL, NULL, NULL, NULL),
(132, 'a30cf97d-e235-4e28-8c00-6d4e01231579', 'DSP', '2025-09-14', '2025-09-21', 1, '2025-02-24 16:58:11', 0, NULL, NULL, NULL, NULL),
(133, '85d3086b-fcd1-430f-b56e-40ade3898e9b', 'DSP', '2025-09-21', '2025-09-28', 1, '2025-02-24 16:58:21', 0, NULL, NULL, NULL, NULL),
(134, 'db097853-3523-4bbf-9da7-52259d883c63', 'DSP', '2025-09-28', '2025-10-05', 1, '2025-02-24 16:58:31', 0, NULL, NULL, NULL, NULL),
(135, '0a716a90-e6f1-4276-80ea-346a4809714b', 'DSP', '2025-10-05', '2025-10-12', 1, '2025-02-24 16:58:41', 0, NULL, NULL, NULL, NULL),
(136, '5ef48679-20fb-4139-8317-18f09d4ad74c', 'DSP', '2025-10-12', '2025-10-19', 1, '2025-02-24 16:58:51', 0, NULL, NULL, NULL, NULL),
(137, '6714b11c-64e4-460f-bb1b-59334c8962c3', 'DSP', '2025-10-19', '2025-10-26', 1, '2025-02-24 16:59:03', 0, NULL, NULL, NULL, NULL),
(138, '9e3f0e8f-4f6b-4516-b398-7090bce6ea89', 'DSP', '2025-10-26', '2025-11-02', 1, '2025-02-24 16:59:15', 0, NULL, NULL, NULL, NULL),
(139, 'cc7d4ba5-0bb0-480f-b705-e3fa17d50cea', 'DSP', '2025-11-02', '2025-11-09', 1, '2025-02-24 16:59:30', 0, NULL, NULL, NULL, NULL),
(140, '8324906c-3041-4b38-b2bf-75248ca8c35c', 'DSP', '2025-11-09', '2025-11-16', 1, '2025-02-24 16:59:45', 0, NULL, NULL, NULL, NULL),
(141, '256f7cde-0b1e-423c-a4f6-951f70cca1c4', 'QI', '2025-03-23', '2025-03-30', 1, '2025-02-24 17:04:48', 0, NULL, NULL, NULL, NULL),
(142, '2517ad29-20f2-43c6-bee7-4fbb9f445185', 'QI', '2025-03-30', '2025-04-06', 1, '2025-02-24 17:05:06', 0, NULL, NULL, NULL, NULL),
(143, 'aa775a30-b668-4319-a4d6-55526c0775b4', 'QI', '2025-04-06', '2025-04-13', 1, '2025-02-24 17:05:18', 0, NULL, NULL, NULL, NULL),
(144, '7ebd1da7-d4c1-4e0d-a623-d48ae650bfaf', 'QI', '2025-04-13', '2025-04-20', 1, '2025-02-24 17:05:35', 0, NULL, NULL, NULL, NULL),
(145, 'b961d7db-5c48-4769-b8c6-68b6b826ff02', 'QI', '2025-04-20', '2025-04-27', 1, '2025-02-24 17:05:53', 0, NULL, NULL, NULL, NULL),
(146, 'ba0a1f48-b288-41dd-b504-b73e04eb5c0c', 'QI', '2025-04-27', '2025-05-04', 1, '2025-02-24 17:06:04', 0, NULL, NULL, NULL, NULL),
(147, '16188b4a-b7f1-443f-859c-f9e07b57df6f', 'QI', '2025-05-04', '2025-05-11', 1, '2025-02-24 17:06:15', 0, NULL, NULL, NULL, NULL),
(148, '2883f56b-3066-40ee-b1a9-863c984e5b3d', 'QI', '2025-05-11', '2025-05-18', 1, '2025-02-24 17:06:33', 0, NULL, NULL, NULL, NULL),
(149, '1ba5e4e3-94ca-41a3-96f0-5bb6ab8e6dcf', 'QI', '2025-05-18', '2025-05-25', 1, '2025-02-24 17:06:50', 0, NULL, NULL, NULL, NULL),
(150, '14ac6c2e-24cc-42a8-9501-ad4d36b7eb78', 'QI', '2025-05-25', '2025-06-01', 1, '2025-02-24 17:07:11', 0, NULL, NULL, NULL, NULL),
(151, 'ff1f9bbd-de91-4dd6-bc5e-cab8302fdea1', 'QI', '2025-06-01', '2025-06-08', 1, '2025-02-24 17:07:22', 0, NULL, NULL, NULL, NULL),
(152, 'e1620cc2-9e6a-4f1e-8690-58b6a4725692', 'QI', '2025-06-08', '2025-06-15', 1, '2025-02-24 17:07:33', 0, NULL, NULL, NULL, NULL),
(153, '27ef950a-ef4a-4676-a512-05306afecbf1', 'QI', '2025-06-15', '2025-06-22', 1, '2025-02-24 17:07:43', 0, NULL, NULL, NULL, NULL),
(154, '611515e5-699d-4eaa-b9e7-68a4d8b3563c', 'QI', '2025-06-22', '2025-06-29', 1, '2025-02-24 17:07:56', 0, NULL, NULL, NULL, NULL),
(155, 'a48396b0-01c6-4505-8f05-0c8b854dbcee', 'QI', '2025-06-29', '2025-07-06', 1, '2025-02-24 17:08:07', 0, NULL, NULL, NULL, NULL),
(156, '7f6793d3-2d7d-4b27-81ff-7855407b76a1', 'QI', '2025-07-06', '2025-07-13', 1, '2025-02-24 17:08:17', 0, NULL, NULL, NULL, NULL),
(157, '4615e02f-796b-48ce-9587-6ace0cd6bd79', 'QI', '2025-07-13', '2025-07-20', 1, '2025-02-24 17:08:29', 0, NULL, NULL, NULL, NULL),
(158, 'f5d620c2-58d9-4510-808b-b71d09a52d66', 'QI', '2025-07-20', '2025-07-27', 1, '2025-02-24 17:08:43', 0, NULL, NULL, NULL, NULL),
(159, 'a1737208-0b5d-4f90-a4ff-dbc2f848783e', 'QI', '2025-07-27', '2025-08-03', 1, '2025-02-24 17:08:54', 0, NULL, NULL, NULL, NULL),
(160, '47c6aa90-b68f-4dfd-96d6-6aa3bb21b8d3', 'QI', '2025-08-03', '2025-08-10', 1, '2025-02-24 17:09:04', 0, NULL, NULL, NULL, NULL),
(161, '4c5104d9-8c0b-4139-98fb-feca68bd4841', 'QI', '2025-08-10', '2025-08-17', 1, '2025-02-24 17:09:15', 0, NULL, NULL, NULL, NULL),
(162, '43be1bd9-2f51-4ad2-af30-444ed7e3b991', 'QI', '2025-08-17', '2025-08-24', 1, '2025-02-24 17:09:23', 0, NULL, NULL, NULL, NULL),
(163, '6639b6f1-f272-43cc-84dd-08932d7a6fc3', 'QI', '2025-08-24', '2025-08-31', 1, '2025-02-24 17:09:33', 0, NULL, NULL, NULL, NULL),
(164, '64cab2a8-9e54-4635-825c-80e4693ef379', 'QI', '2025-08-31', '2025-09-07', 1, '2025-02-24 17:09:47', 0, NULL, NULL, NULL, NULL),
(165, '7970911c-dbe4-47b1-9fff-ca900000369f', 'QI', '2025-09-07', '2025-09-14', 1, '2025-02-24 17:09:57', 0, NULL, NULL, NULL, NULL),
(166, '559dea19-3745-4907-9254-4d1d59a6afe1', 'QI', '2025-09-14', '2025-09-21', 1, '2025-02-24 17:10:07', 0, NULL, NULL, NULL, NULL),
(167, 'fc234367-0811-4883-a7a8-772a8b4c4e2f', 'QI', '2025-09-21', '2025-09-28', 1, '2025-02-24 17:10:20', 0, NULL, NULL, NULL, NULL),
(168, '679f8d1b-f0d5-4d8b-9f0f-f18e94864c9d', 'QI', '2025-09-28', '2025-10-05', 1, '2025-02-24 17:10:29', 0, NULL, NULL, NULL, NULL),
(169, '91ff65d6-2f2f-46b7-abdd-ab92e6ed25e8', 'QI', '2025-10-05', '2025-10-12', 1, '2025-02-24 17:10:38', 0, NULL, NULL, NULL, NULL),
(170, '89151a26-f677-4d48-8d26-fa33959b6d9a', 'QI', '2025-10-12', '2025-10-19', 1, '2025-02-24 17:10:48', 0, NULL, NULL, NULL, NULL),
(171, 'faf69193-33f4-461d-913d-13b26e30e9f0', 'QI', '2025-10-19', '2025-10-26', 1, '2025-02-24 17:10:58', 0, NULL, NULL, NULL, NULL),
(172, '448ba192-17a4-440c-9490-c1515220244c', 'QI', '2025-10-26', '2025-11-02', 1, '2025-02-24 17:11:14', 0, NULL, NULL, NULL, NULL),
(173, '5a78b42a-433f-4f0e-81f6-52d43fe27cbb', 'QI', '2025-11-02', '2025-11-09', 1, '2025-02-24 17:11:25', 0, NULL, NULL, NULL, NULL),
(174, 'c63f6beb-f703-4b07-90e9-315d277ec81b', 'QI', '2025-11-09', '2025-11-16', 1, '2025-02-24 17:11:35', 0, NULL, NULL, NULL, NULL),
(175, 'ccd25010-627b-4953-973a-10974379effb', 'QI', '2025-11-16', '2025-11-23', 1, '2025-02-24 17:11:45', 0, NULL, NULL, NULL, NULL),
(176, 'f12b719e-b7b3-4f33-ab7e-98bc906e49ae', 'ARA', '2025-03-19', '2025-03-26', 1, '2025-02-24 17:14:21', 0, NULL, NULL, NULL, NULL),
(177, '1bfa7007-478b-4470-a2e9-f8249c6fb5a8', 'ARA', '2025-03-26', '2025-04-02', 1, '2025-02-24 17:14:39', 0, NULL, NULL, NULL, NULL),
(178, '8103edb8-76c2-4daa-9e82-2ca594526aac', 'ARA', '2025-04-02', '2025-04-09', 1, '2025-02-24 17:14:50', 0, NULL, NULL, NULL, NULL),
(179, '5540254a-9237-42fb-9e26-aaad0e196d47', 'ARA', '2025-04-09', '2025-04-16', 1, '2025-02-24 17:15:01', 0, NULL, NULL, NULL, NULL),
(180, 'bafe0e44-5946-4462-aa67-1dc3edffd5f3', 'ARA', '2025-04-16', '2025-04-23', 1, '2025-02-24 17:15:13', 0, NULL, NULL, NULL, NULL),
(181, '5f97ad76-3c6e-498f-8bb9-1443123c405c', 'ARA', '2025-04-23', '2025-04-30', 1, '2025-02-24 17:15:24', 0, NULL, NULL, NULL, NULL),
(182, '0faaa748-7a16-470a-b203-dbe3da47a375', 'ARA', '2025-04-30', '2025-05-07', 1, '2025-02-24 17:15:35', 0, NULL, NULL, NULL, NULL),
(183, '0c0e7826-78d0-48b8-b6c4-c0aa00237442', 'ARA', '2025-05-07', '2025-05-14', 1, '2025-02-24 17:15:48', 0, NULL, NULL, NULL, NULL),
(184, 'f4d32f19-a08c-4397-b0e9-a69a56539525', 'ARA', '2025-05-14', '2025-05-21', 1, '2025-02-24 17:15:59', 0, NULL, NULL, NULL, NULL),
(185, '835acd3a-ba7a-461d-84a9-fc50c5a9c371', 'ARA', '2025-05-21', '2025-05-28', 1, '2025-02-24 17:16:16', 0, NULL, NULL, NULL, NULL),
(186, '87ab9d5b-0a11-469d-a185-8adf462c2a52', 'ARA', '2025-05-28', '2025-06-04', 1, '2025-02-24 17:16:29', 0, NULL, NULL, NULL, NULL),
(187, 'edf29d64-e63d-48c5-b398-91e8178a1ce8', 'ARA', '2025-06-04', '2025-06-11', 1, '2025-02-24 17:16:39', 0, NULL, NULL, NULL, NULL),
(188, '290cb67e-c595-48da-81db-b8936302a81f', 'ARA', '2025-06-11', '2025-06-18', 1, '2025-02-24 17:16:48', 0, NULL, NULL, NULL, NULL),
(189, 'b4c7b597-3b7e-40b6-b1fb-74c92439241b', 'ARA', '2025-06-18', '2025-06-25', 1, '2025-02-24 17:16:59', 0, NULL, NULL, NULL, NULL),
(190, '36cc90dc-8e8e-4d96-8528-fdc8810d3b9f', 'ARA', '2025-06-25', '2025-07-02', 1, '2025-02-24 17:17:09', 0, NULL, NULL, NULL, NULL),
(191, 'f219eef6-8ea8-42da-99ec-5db908a066be', 'ARA', '2025-07-02', '2025-07-09', 1, '2025-02-24 17:17:19', 0, NULL, NULL, NULL, NULL),
(192, 'fe433b21-69ac-41b2-9a04-1206339e723d', 'ARA', '2025-07-09', '2025-07-16', 1, '2025-02-24 17:17:31', 0, NULL, NULL, NULL, NULL),
(193, 'a65fd1b6-263f-4acf-8283-c0499a7772fd', 'ARA', '2025-07-16', '2025-07-23', 1, '2025-02-24 17:17:42', 0, NULL, NULL, NULL, NULL),
(194, '45a984cd-1134-4128-9e67-96004d0bdba9', 'ARA', '2025-07-23', '2025-07-30', 1, '2025-02-24 17:17:52', 0, NULL, NULL, NULL, NULL),
(195, '1c883a86-65f3-4075-81dd-fbcaf0b9ce5b', 'ARA', '2025-07-30', '2025-08-06', 1, '2025-02-24 17:18:03', 0, NULL, NULL, NULL, NULL),
(196, '03f67a31-06ec-4aa9-acbb-aaff64ab8e51', 'ARA', '2025-08-06', '2025-08-13', 1, '2025-02-24 17:18:18', 0, NULL, NULL, NULL, NULL),
(197, 'ab119ca2-ca83-43df-bcfb-faa5eb7ef3fa', 'ARA', '2025-08-13', '2025-08-20', 1, '2025-02-24 17:18:28', 0, NULL, NULL, NULL, NULL),
(198, '9368bba3-be57-4963-bb75-5a45133a1eed', 'ARA', '2025-08-20', '2025-08-27', 1, '2025-02-24 17:18:37', 0, NULL, NULL, NULL, NULL),
(199, '991dec96-6d56-4ff1-8e38-66687fbb0cde', 'ARA', '2025-08-27', '2025-09-03', 1, '2025-02-24 17:18:54', 0, NULL, NULL, NULL, NULL),
(200, '9e38a949-c4d3-465a-a4fd-13f0d88994ba', 'ARA', '2025-09-03', '2025-09-10', 1, '2025-02-24 17:19:06', 0, NULL, NULL, NULL, NULL),
(201, 'be6adfce-1ee2-4399-82e1-102c86ca51a5', 'ARA', '2025-09-10', '2025-09-17', 1, '2025-02-24 17:19:17', 0, NULL, NULL, NULL, NULL),
(202, 'd254c056-92b6-4284-883e-d7acc4ef40d4', 'ARA', '2025-09-17', '2025-09-24', 1, '2025-02-24 17:19:27', 0, NULL, NULL, NULL, NULL),
(203, 'b2e13f59-45e0-43ca-9cc7-a35cd40aa530', 'ARA', '2025-09-24', '2025-10-01', 1, '2025-02-24 17:19:44', 0, NULL, NULL, NULL, NULL),
(204, '6fccb8f1-ab74-458c-ae64-f3f282126ae7', 'ARA', '2025-10-01', '2025-10-08', 1, '2025-02-24 17:19:55', 0, NULL, NULL, NULL, NULL),
(205, '4235269e-3fb1-4c74-8b18-d25675925fa0', 'ARA', '2025-10-08', '2025-10-15', 1, '2025-02-24 17:20:06', 0, NULL, NULL, NULL, NULL),
(206, '05aa3ac8-aa1f-4d01-a002-3a127d1db9a9', 'ARA', '2025-10-15', '2025-10-22', 1, '2025-02-24 17:20:18', 0, NULL, NULL, NULL, NULL),
(207, 'e9824375-2d4b-4652-8a85-d381aafd82b8', 'ARA', '2025-10-22', '2025-10-29', 1, '2025-02-24 17:20:28', 0, NULL, NULL, NULL, NULL),
(208, '23d0ee46-7978-448a-ae18-b8cfdcd62ea4', 'ARA', '2025-10-29', '2025-11-05', 1, '2025-02-24 17:20:41', 0, NULL, NULL, NULL, NULL),
(209, '1edf580c-cbcd-4934-8be8-8c15a2dfd1aa', 'ARA', '2025-11-05', '2025-11-12', 1, '2025-02-24 17:20:55', 0, NULL, NULL, NULL, NULL),
(210, '0c18906a-c7b8-49df-a413-b53baa60323c', 'ARA', '2025-11-12', '2025-11-19', 1, '2025-02-24 17:21:05', 0, NULL, NULL, NULL, NULL),
(211, 'e598886d-7015-40c2-8679-18ac7d1c465d', 'AMA', '2025-03-22', '2025-03-29', 1, '2025-02-24 17:24:34', 0, NULL, NULL, NULL, NULL),
(212, 'bfa708e7-d2a7-47a7-a48a-cf36743b7c37', 'AMA', '2025-03-29', '2025-04-05', 1, '2025-02-24 17:24:45', 0, NULL, NULL, NULL, NULL),
(213, '0a42db51-c0b4-4a92-892f-42ade919ac8a', 'AMA', '2025-04-05', '2025-04-12', 1, '2025-02-24 17:24:55', 0, NULL, NULL, NULL, NULL),
(214, '6591368b-f234-4d83-a8c0-916d7a4c2f03', 'AMA', '2025-04-12', '2025-04-19', 1, '2025-02-24 17:25:04', 0, NULL, NULL, NULL, NULL),
(215, '296e4223-ea1f-49f5-b22b-62882f0877aa', 'AMA', '2025-04-19', '2025-04-26', 1, '2025-02-24 17:25:44', 0, NULL, NULL, NULL, NULL),
(216, '05595c30-7d7d-4f6f-b2fb-1daf66ef987b', 'AMA', '2025-04-26', '2025-05-03', 1, '2025-02-24 17:25:55', 0, NULL, NULL, NULL, NULL),
(217, 'e272e947-da53-4c68-a286-52d029119eec', 'AMA', '2025-05-03', '2025-05-10', 1, '2025-02-24 17:26:04', 0, NULL, NULL, NULL, NULL),
(218, '5d1db8bf-069d-496c-831f-bad282fb06e6', 'AMA', '2025-05-10', '2025-05-17', 1, '2025-02-24 17:26:14', 0, NULL, NULL, NULL, NULL),
(219, 'badd322a-9cac-492a-ae64-18d21159399b', 'AMA', '2025-05-17', '2025-05-24', 1, '2025-02-24 17:26:23', 0, NULL, NULL, NULL, NULL),
(220, '7fff389b-acb8-4ff2-aa23-1da864639459', 'AMA', '2025-05-24', '2025-05-31', 1, '2025-02-24 17:26:34', 0, NULL, NULL, NULL, NULL),
(221, 'f376b176-4784-4588-8d7a-5d171c447b5a', 'AMA', '2025-05-31', '2025-06-07', 1, '2025-02-24 17:26:46', 0, NULL, NULL, NULL, NULL),
(222, '9b774fd6-da6c-43cf-9905-52fa24b4b17c', 'AMA', '2025-06-07', '2025-06-14', 1, '2025-02-24 17:26:57', 0, NULL, NULL, NULL, NULL),
(223, '5b51b7e0-2b5e-4348-a322-b12f44d98f24', 'AMA', '2025-06-14', '2025-06-21', 1, '2025-02-24 17:28:00', 0, NULL, NULL, NULL, NULL),
(224, '42c9ebb8-c5e1-418b-81c9-9f882e9b7765', 'AMA', '2025-06-21', '2025-06-28', 1, '2025-02-24 17:28:10', 0, NULL, NULL, NULL, NULL),
(225, '36ecb298-56e6-4c39-aa30-45f283657f7f', 'AMA', '2025-06-28', '2025-07-05', 1, '2025-02-24 17:28:21', 0, NULL, NULL, NULL, NULL),
(226, '8687e27b-0bba-4fe5-860b-7cafd0e31037', 'AMA', '2025-07-05', '2025-07-12', 1, '2025-02-24 17:28:42', 0, NULL, NULL, NULL, NULL),
(227, 'aee3b0b3-4f50-4a1d-8e38-cab9d8cccfa8', 'AMA', '2025-07-12', '2025-07-19', 1, '2025-02-24 17:28:52', 0, NULL, NULL, NULL, NULL),
(228, 'b4987994-ba96-4a6f-9507-d0a1b5dbf0ba', 'AMA', '2025-07-19', '2025-07-26', 1, '2025-02-24 17:29:03', 0, NULL, NULL, NULL, NULL),
(229, 'cdc1870a-2050-4f72-8b76-9b95deca5da5', 'AMA', '2025-07-26', '2025-08-02', 1, '2025-02-24 17:29:14', 0, NULL, NULL, NULL, NULL),
(230, '80c23a06-3b93-4a6b-9d48-8bb8e9c9b8b4', 'AMA', '2025-08-02', '2025-08-09', 1, '2025-02-24 17:29:23', 0, NULL, NULL, NULL, NULL),
(231, 'df9c33ce-c1ae-4686-ba6a-2c3de83294c3', 'AMA', '2025-08-09', '2025-08-16', 1, '2025-02-24 17:29:34', 0, NULL, NULL, NULL, NULL),
(232, '444d85fc-ffe6-40e7-8424-1cfb94870288', 'AMA', '2025-08-16', '2025-08-23', 1, '2025-02-24 17:29:44', 0, NULL, NULL, NULL, NULL),
(233, '78b29ca8-4a19-46da-9c58-98752cac9b5e', 'AMA', '2025-08-23', '2025-08-30', 1, '2025-02-24 17:29:55', 0, NULL, NULL, NULL, NULL),
(234, 'a3752015-0ef2-47f9-bd0f-6ac266926072', 'AMA', '2025-08-30', '2025-09-06', 1, '2025-02-24 17:30:08', 0, NULL, NULL, NULL, NULL),
(235, 'e6d07174-ef6d-4d24-938b-f531713d2b1b', 'AMA', '2025-09-06', '2025-09-13', 1, '2025-02-24 17:30:19', 0, NULL, NULL, NULL, NULL),
(236, '61d5f075-9b55-413e-b1f2-dfb2f578c595', 'AMA', '2025-09-13', '2025-09-20', 1, '2025-02-24 17:30:29', 0, NULL, NULL, NULL, NULL),
(237, 'd7515db7-d314-4e57-8b16-f4cc0da00ee2', 'AMA', '2025-09-20', '2025-09-27', 1, '2025-02-24 17:30:39', 0, NULL, NULL, NULL, NULL),
(238, '2a2fe340-9d1c-43f6-a8ce-88ced6deec50', 'AMA', '2025-09-27', '2025-10-04', 1, '2025-02-24 17:30:56', 0, NULL, NULL, NULL, NULL),
(239, '0fa37e0b-ad60-4a9a-9a2b-e474034c2ca5', 'AMA', '2025-10-04', '2025-10-11', 1, '2025-02-24 17:31:09', 0, NULL, NULL, NULL, NULL),
(240, 'db326be4-f9ec-46e8-9750-386ca69330c1', 'AMA', '2025-10-11', '2025-10-18', 1, '2025-02-24 17:31:20', 0, NULL, NULL, NULL, NULL),
(241, '825ad720-b295-4930-858d-00dd3178dd4d', 'AMA', '2025-10-18', '2025-10-25', 1, '2025-02-24 17:31:33', 0, NULL, NULL, NULL, NULL),
(242, '394d47bb-6938-467d-a2ba-9c01d49c498e', 'AMA', '2025-10-25', '2025-11-01', 1, '2025-02-24 17:31:48', 0, NULL, NULL, NULL, NULL),
(243, 'bffbe029-5aed-4f83-8730-741f93da690d', 'AMA', '2025-11-01', '2025-11-08', 1, '2025-02-24 17:32:01', 0, NULL, NULL, NULL, NULL),
(244, '0a7a7507-0bce-477f-aa7a-f018f1586364', 'AMA', '2025-11-08', '2025-11-15', 1, '2025-02-24 17:32:13', 0, NULL, NULL, NULL, NULL),
(245, '1b3a7d40-6ca1-448b-9caf-96c869a1e0a2', 'AMA', '2025-11-15', '2025-11-22', 1, '2025-02-24 17:32:22', 0, NULL, NULL, NULL, NULL),
(246, '52b1bfd1-e6f8-4732-9ce6-5832f214ac96', 'AMA', '2025-11-22', '2025-11-29', 1, '2025-02-24 17:32:32', 0, NULL, NULL, NULL, NULL),
(247, 'e02e981c-bf87-4064-b60b-dcff80d3a4c1', 'AMA', '2025-11-29', '2025-12-06', 1, '2025-02-24 17:32:48', 0, NULL, NULL, NULL, NULL),
(248, '865b70c5-2269-4086-92a3-4644d986b63c', 'AMA', '2025-12-06', '2025-12-13', 1, '2025-02-24 17:33:02', 0, NULL, NULL, NULL, NULL),
(249, '3ca19b6e-bb28-446c-808e-0e3091fb9ce5', 'AMA', '2025-12-13', '2025-12-20', 1, '2025-02-24 17:33:15', 0, NULL, NULL, NULL, NULL),
(250, 'a1ee2f5f-83e2-4e0c-b7e2-479e4de375c6', 'AMA', '2025-12-20', '2025-12-27', 1, '2025-02-24 17:33:27', 0, NULL, NULL, NULL, NULL),
(251, '91a3c1cf-9064-4cf7-b89a-cd217e46fba4', 'AMA', '2025-12-27', '2026-01-03', 1, '2025-02-24 17:33:50', 0, NULL, NULL, NULL, NULL),
(252, '15af6c90-512a-408c-868d-574d449c75a7', 'AMD', '2025-03-25', '2025-04-01', 1, '2025-02-25 08:59:35', 0, NULL, NULL, NULL, NULL),
(253, 'a5938983-9c94-44b3-813e-44cbc52137e0', 'AMD', '2025-04-01', '2025-04-08', 1, '2025-02-25 08:59:48', 0, NULL, NULL, NULL, NULL),
(254, 'f0133755-d4a8-483d-9dce-14547200dc7a', 'AMD', '2025-04-08', '2025-04-15', 1, '2025-02-25 09:00:05', 0, NULL, NULL, NULL, NULL),
(255, '925bde43-d38a-4c16-8ee6-f4faa6a8585d', 'AMD', '2025-04-15', '2025-04-22', 1, '2025-02-25 09:00:20', 0, NULL, NULL, NULL, NULL),
(256, 'f1102279-ab74-48ee-af71-4ba4835bae96', 'AMD', '2025-04-22', '2025-04-29', 1, '2025-02-25 09:00:31', 0, NULL, NULL, NULL, NULL),
(257, '1e838a6e-fc44-4edb-9bcb-7a5bc1d28530', 'AMD', '2025-04-29', '2025-05-06', 1, '2025-02-25 09:00:46', 0, NULL, NULL, NULL, NULL),
(258, '88978ef4-1761-411d-9cbd-d6b264c73798', 'AMD', '2025-05-06', '2025-05-13', 1, '2025-02-25 09:00:58', 0, NULL, NULL, NULL, NULL),
(259, 'dae330ee-6e8d-4f7c-b23b-8a04a24b7ba2', 'AMD', '2025-05-13', '2025-05-20', 1, '2025-02-25 09:01:19', 0, NULL, NULL, NULL, NULL),
(260, '14796b6d-13e0-47c8-abcd-2384b3163df1', 'AMD', '2025-05-20', '2025-05-27', 1, '2025-02-25 09:01:32', 0, NULL, NULL, NULL, NULL),
(261, '979bf8b3-045d-424d-a353-bfb9d1881cc8', 'AMD', '2025-05-27', '2025-06-03', 1, '2025-02-25 09:01:45', 0, NULL, NULL, NULL, NULL),
(262, 'b8b4e7e2-6d97-4435-99bb-2b3094c217a6', 'AMD', '2025-06-03', '2025-06-10', 1, '2025-02-25 09:01:55', 0, NULL, NULL, NULL, NULL),
(263, '4bfbee45-9550-4988-800b-e9dcc6a15dc9', 'GAB', '2025-06-10', '2025-06-17', 1, '2025-02-25 09:02:09', 0, '2025-02-25 09:22:06', NULL, '2025-02-25 09:22:06', 0),
(264, 'b7e0ccb3-86da-4f00-b8bc-49d47e24de82', 'AMD', '2025-06-17', '2025-06-24', 1, '2025-02-25 09:02:19', 0, NULL, NULL, NULL, NULL),
(265, '1708215d-13b3-4c97-9ffd-789f5f50d62a', 'AMD', '2025-06-24', '2025-07-01', 1, '2025-02-25 09:02:37', 0, NULL, NULL, NULL, NULL),
(266, '50a7b9cc-b95b-4248-90e3-17b6cbaa6046', 'AMD', '2025-07-01', '2025-07-08', 1, '2025-02-25 09:02:59', 0, NULL, NULL, NULL, NULL),
(267, 'f809b565-fa23-41d1-bb9b-93f80d9cde56', 'AMD', '2025-07-08', '2025-07-15', 1, '2025-02-25 09:03:12', 0, NULL, NULL, NULL, NULL),
(268, '1faf5d0b-cd79-426d-a261-43680ab30f1e', 'AMD', '2025-07-15', '2025-07-22', 1, '2025-02-25 09:03:23', 0, NULL, NULL, NULL, NULL),
(269, '6250c667-1645-4921-a0ad-dd830d58653d', 'AMD', '2025-07-22', '2025-07-29', 1, '2025-02-25 09:03:33', 0, NULL, NULL, NULL, NULL),
(270, '45e02138-6c30-4dfc-be73-a98d66e4cf98', 'AMD', '2025-07-29', '2025-08-05', 1, '2025-02-25 09:03:57', 0, NULL, NULL, NULL, NULL),
(271, 'e94827d7-5943-4121-a2a7-e58774804694', 'AMD', '2025-08-05', '2025-08-12', 1, '2025-02-25 09:04:10', 0, NULL, NULL, NULL, NULL),
(272, 'a315c795-6565-4f99-a6d9-d081de70d42d', 'AMD', '2025-08-12', '2025-08-19', 1, '2025-02-25 09:04:26', 0, NULL, NULL, NULL, NULL),
(273, '8844a70d-d32e-44d8-9696-961b9b19848d', 'AMD', '2025-08-19', '2025-08-26', 1, '2025-02-25 09:04:42', 0, NULL, NULL, NULL, NULL),
(274, 'ccc006ef-3f59-412e-93d7-2f861cbd8882', 'AMD', '2025-08-26', '2025-09-02', 1, '2025-02-25 09:04:53', 0, NULL, NULL, NULL, NULL),
(275, '6d41b019-3a2a-4a15-a1bf-53c13fb416b0', 'AMD', '2025-09-02', '2025-09-09', 1, '2025-02-25 09:05:03', 0, NULL, NULL, NULL, NULL),
(276, 'a13311a4-9650-44dc-b2cd-aece9144490f', 'AMD', '2025-09-09', '2025-09-16', 1, '2025-02-25 09:05:19', 0, NULL, NULL, NULL, NULL),
(277, '25e64edc-b4ce-4fe5-b5f8-4fffdd9fea8d', 'AMD', '2025-09-16', '2025-09-23', 1, '2025-02-25 09:05:32', 0, NULL, NULL, NULL, NULL),
(278, 'b47b3f2a-c5d7-4e8c-8335-7cba2f3d8292', 'AMD', '2025-09-23', '2025-09-30', 1, '2025-02-25 09:05:44', 0, NULL, NULL, NULL, NULL),
(279, '043ebed2-2879-4769-a2b4-7e622eb2b54e', 'AMD', '2025-09-30', '2025-10-07', 1, '2025-02-25 09:06:14', 0, NULL, NULL, NULL, NULL),
(280, '748b72fd-7732-49e2-8a6e-9260853d251f', 'AMD', '2025-10-07', '2025-10-14', 1, '2025-02-25 09:06:31', 0, NULL, NULL, NULL, NULL),
(281, 'ac9f07a0-b1ae-4722-b135-5350338979b6', 'AMD', '2025-10-14', '2025-10-21', 1, '2025-02-25 09:06:45', 0, NULL, NULL, NULL, NULL),
(282, 'a2c5530c-c36b-48d1-aa8c-455b376f4fc8', 'AMD', '2025-10-21', '2025-10-28', 1, '2025-02-25 09:06:58', 0, NULL, NULL, NULL, NULL),
(283, '5fa71c5a-099a-48c0-97c9-38cbab00ef0b', 'AMD', '2025-10-28', '2025-11-04', 1, '2025-02-25 09:08:02', 0, NULL, NULL, NULL, NULL),
(284, 'f016b5ef-2e0f-4775-94c2-e7496ab8bca1', 'AMD', '2025-11-04', '2025-11-11', 1, '2025-02-25 09:08:14', 0, NULL, NULL, NULL, NULL),
(285, 'c73b02d7-9d6c-4e09-a886-0b21ce5e685b', 'AMD', '2025-11-11', '2025-11-18', 1, '2025-02-25 09:08:28', 0, NULL, NULL, NULL, NULL),
(286, 'e4c3e760-2ba0-4a4f-98dc-903e27ee343b', 'AMD', '2025-11-18', '2025-11-25', 1, '2025-02-25 09:09:15', 0, NULL, NULL, NULL, NULL),
(287, '47159861-9f84-4caf-aaad-df989f49a716', 'AMD', '2025-11-25', '2025-12-02', 1, '2025-02-25 09:09:28', 0, NULL, NULL, NULL, NULL),
(288, '7124b08b-0368-4957-9374-1620106f414f', 'AMD', '2025-12-02', '2025-12-09', 1, '2025-02-25 09:09:41', 0, NULL, NULL, NULL, NULL),
(289, 'dd6fcdf8-b80e-4b68-be25-5b76991f64d7', 'AMD', '2025-12-09', '2025-12-16', 1, '2025-02-25 09:09:53', 0, NULL, NULL, NULL, NULL),
(290, 'e31f812d-8e96-4699-a2b2-fc9f1578d0f5', 'AMD', '2025-12-16', '2025-12-23', 1, '2025-02-25 09:10:10', 0, NULL, NULL, NULL, NULL),
(291, '3ac00b83-7afa-4bf0-bc50-7e9eee8679fd', 'AMD', '2025-12-23', '2025-12-30', 1, '2025-02-25 09:10:31', 0, NULL, NULL, NULL, NULL),
(292, 'd5915d3f-404b-48c8-ad1d-5d3fbf62a44f', 'AMD', '2025-12-30', '2025-01-06', 1, '2025-02-25 09:11:50', 0, NULL, NULL, NULL, NULL),
(293, '80f102b4-b967-4156-bd42-2d1e0c3255ca', 'AMD', '2025-06-10', '2025-06-17', 1, '2025-02-25 09:18:47', 0, NULL, NULL, NULL, NULL),
(294, '2f5d8689-8542-4c84-a0e9-aa98fdf9db47', 'GAB', '2025-03-30', '2025-04-06', 1, '2025-02-25 09:20:24', 0, NULL, NULL, NULL, NULL),
(295, '9e1f3739-181c-4fde-b81a-fffb62e3cab8', 'GAB', '2025-04-06', '2025-04-13', 1, '2025-02-25 09:20:38', 0, NULL, NULL, NULL, NULL),
(296, '89fbad5c-4013-4c12-8051-4ec1742a88e5', 'GAB', '2025-04-13', '2025-04-20', 1, '2025-02-25 09:20:53', 0, NULL, NULL, NULL, NULL),
(297, 'a9d5da66-b6d7-45e1-a225-ae31b2e91a42', 'GAB', '2025-04-20', '2025-04-27', 1, '2025-02-25 09:21:04', 0, NULL, NULL, NULL, NULL),
(298, '121b8742-9da4-4ae3-a3b2-def5b868ebcd', 'GAB', '2025-04-27', '2025-05-04', 1, '2025-02-25 09:22:26', 0, NULL, NULL, NULL, NULL),
(299, '85c9af18-2c4c-49e8-a326-9154ea9ae67d', 'GAB', '2025-05-04', '2025-05-11', 1, '2025-02-25 09:22:36', 0, NULL, NULL, NULL, NULL),
(300, 'b82129f2-30ac-4523-a131-5969a5c99d25', 'GAB', '2025-05-11', '2025-05-18', 1, '2025-02-25 09:22:47', 0, NULL, NULL, NULL, NULL),
(301, '100f5073-0c29-426f-9722-3bf926fe1945', 'GAB', '2025-05-18', '2025-05-25', 1, '2025-02-25 09:22:58', 0, NULL, NULL, NULL, NULL),
(302, 'd180bfb3-8d4b-4d31-ad51-2d924f092259', 'GAB', '2025-05-25', '2025-06-01', 1, '2025-02-25 09:23:12', 0, NULL, NULL, NULL, NULL),
(303, '97ef420c-a7ad-400f-9fb9-4c5f8290af1e', 'GAB', '2025-06-01', '2025-06-08', 1, '2025-02-25 09:23:24', 0, NULL, NULL, NULL, NULL),
(304, '56fcf734-e1a8-49c9-88ea-21815df00db2', 'GAB', '2025-06-08', '2025-06-15', 1, '2025-02-25 09:23:37', 0, NULL, NULL, NULL, NULL),
(305, '82181ea1-95dd-4af0-a650-b89d56e45989', 'GAB', '2025-06-15', '2025-06-22', 1, '2025-02-25 09:23:49', 0, NULL, NULL, NULL, NULL),
(306, 'f44c5922-41b3-4c5f-b664-b57cca462bea', 'GAB', '2025-06-22', '2025-06-29', 1, '2025-02-25 09:23:59', 0, NULL, NULL, NULL, NULL),
(307, '98b94747-89da-4024-92c6-bb344ea9294e', 'GAB', '2025-06-29', '2025-07-06', 1, '2025-02-25 09:24:10', 0, NULL, NULL, NULL, NULL),
(308, 'ddef8556-7390-4677-b949-81d28c15f491', 'GAB', '2025-07-06', '2025-07-13', 1, '2025-02-25 09:24:24', 0, NULL, NULL, NULL, NULL),
(309, 'ca6423a8-0b4b-4b61-b999-ce851aae796e', 'GAB', '2025-07-13', '2025-07-20', 1, '2025-02-25 09:24:36', 0, NULL, NULL, NULL, NULL),
(310, '18c5c225-896c-4152-8540-f6aa99855be7', 'GAB', '2025-07-20', '2025-07-27', 1, '2025-02-25 09:24:48', 0, NULL, NULL, NULL, NULL),
(311, 'afc225e3-837c-4c5b-ac3b-169416820947', 'GAB', '2025-07-27', '2025-08-03', 1, '2025-02-25 09:24:59', 0, NULL, NULL, NULL, NULL),
(312, 'e92d0ce8-63cd-43e4-b1db-838897729a96', 'GAB', '2025-08-03', '2025-08-10', 1, '2025-02-25 09:25:11', 0, NULL, NULL, NULL, NULL),
(313, 'cf21ac2b-e0ec-48d7-81a4-ea40a5a0f8e8', 'GAB', '2025-08-10', '2025-08-17', 1, '2025-02-25 09:25:21', 0, NULL, NULL, NULL, NULL),
(314, 'a3caee9f-f7c1-4a6c-a031-55fe2ecf72d6', 'GAB', '2025-08-17', '2025-08-24', 1, '2025-02-25 09:25:47', 0, NULL, NULL, NULL, NULL),
(315, 'f069a6bb-1e96-4b6a-9e56-2065e7a93027', 'GAB', '2025-08-24', '2025-08-31', 1, '2025-02-25 09:25:57', 0, NULL, NULL, NULL, NULL),
(316, '6bf21b58-9ceb-488b-80f7-41f8e4f8d950', 'GAB', '2025-08-31', '2025-09-07', 1, '2025-02-25 09:26:12', 0, NULL, NULL, NULL, NULL),
(317, '46e5c294-c2ff-4d7c-8e35-7e4358dbd166', 'GAB', '2025-09-07', '2025-09-14', 1, '2025-02-25 09:26:22', 0, NULL, NULL, NULL, NULL),
(318, 'd92cc337-cbe3-494a-8bc8-ce6dba232d00', 'GAB', '2025-09-14', '2025-09-21', 1, '2025-02-25 09:26:31', 0, NULL, NULL, NULL, NULL),
(319, '124397dc-942e-4236-9ccc-8d4382f653d0', 'GAB', '2025-09-21', '2025-09-28', 1, '2025-02-25 09:26:46', 0, NULL, NULL, NULL, NULL),
(320, 'a8ca8da0-615b-4ab3-897a-95b46f769315', 'GAB', '2025-09-28', '2025-10-05', 1, '2025-02-25 09:26:55', 0, NULL, NULL, NULL, NULL),
(321, 'e7cb9fb6-54b7-4705-92ea-f2257dbdcf2e', 'GAB', '2025-10-05', '2025-10-12', 1, '2025-02-25 09:27:10', 0, NULL, NULL, NULL, NULL),
(322, 'ff6acc8e-d616-4191-aa09-398f35feb14c', 'GAB', '2025-10-12', '2025-10-19', 1, '2025-02-25 09:27:19', 0, NULL, NULL, NULL, NULL),
(323, '69df82a0-1bc1-4308-a876-cd60a8d325e6', 'GAB', '2025-10-19', '2025-10-26', 1, '2025-02-25 09:28:00', 0, NULL, NULL, NULL, NULL),
(324, '831a410c-2b4b-49c7-8165-b611013b3f79', 'GAB', '2025-10-26', '2025-11-02', 1, '2025-02-25 09:28:14', 0, NULL, NULL, NULL, NULL),
(325, '6e56dfea-2956-4c45-8b7f-f5d63e5ab119', 'GAB', '2025-11-02', '2025-11-09', 1, '2025-02-25 09:28:23', 0, NULL, NULL, NULL, NULL),
(326, '2a23b606-c54b-415b-b406-8c05ec3ba224', 'GAB', '2025-11-09', '2025-11-16', 1, '2025-02-25 09:28:50', 0, NULL, NULL, NULL, NULL),
(327, 'a4e5fa1c-50bd-4b0a-bc6f-1468dc69e365', 'GAB', '2025-11-16', '2025-11-23', 1, '2025-02-25 09:29:02', 0, NULL, NULL, NULL, NULL),
(328, 'a6a2d624-92eb-4f10-b053-b24bf01d6d46', 'GAB', '2025-11-23', '2025-11-30', 1, '2025-02-25 09:29:13', 0, NULL, NULL, NULL, NULL),
(329, '79b3e3b2-f54a-4e08-919d-9924938de008', 'AMS', '2025-03-28', '2025-04-04', 1, '2025-02-25 09:37:16', 0, NULL, NULL, NULL, NULL),
(330, 'f5a5c5db-40a5-4e62-a929-b0cd64ea8070', 'AMS', '2025-04-04', '2025-04-11', 1, '2025-02-25 09:37:33', 0, NULL, NULL, NULL, NULL),
(331, 'e00ac972-8476-4da4-8d7d-f29599a14d83', 'AMS', '2025-04-11', '2025-04-18', 1, '2025-02-25 09:37:46', 0, NULL, NULL, NULL, NULL),
(332, '6a1cc4b7-a9df-4b06-8626-0c02750e6889', 'AMS', '2025-04-18', '2025-04-25', 1, '2025-02-25 09:38:05', 0, NULL, NULL, NULL, NULL),
(333, 'd81d580c-d091-4f78-8a49-b0a7959f1dbf', 'AMS', '2025-04-25', '2025-05-02', 1, '2025-02-25 09:38:29', 0, NULL, NULL, NULL, NULL),
(334, '9213060e-2c9f-434d-95cd-d9b345263a39', 'AMS', '2025-05-02', '2025-05-09', 1, '2025-02-25 09:38:41', 0, NULL, NULL, NULL, NULL),
(335, '58946b6e-d257-483b-bef0-3c399909b67a', 'AMS', '2025-05-09', '2025-05-16', 1, '2025-02-25 09:38:52', 0, NULL, NULL, NULL, NULL),
(336, '9f6363c7-d50f-4954-9a0a-107ff6884509', 'AMS', '2025-05-16', '2025-05-23', 1, '2025-02-25 09:39:05', 0, NULL, NULL, NULL, NULL),
(337, '25fe5c88-70a0-44f5-aee2-b54c01231e95', 'AMS', '2025-05-23', '2025-05-30', 1, '2025-02-25 09:39:15', 0, NULL, NULL, NULL, NULL),
(338, '92b9504d-c574-4f9b-9938-c073fdebc326', 'AMS', '2025-05-30', '2025-06-06', 1, '2025-02-25 09:39:28', 0, NULL, NULL, NULL, NULL),
(339, '19aad9e4-98f8-4dc6-9d74-c3ec1ec762d3', 'AMS', '2025-06-06', '2025-06-13', 1, '2025-02-25 09:39:42', 0, NULL, NULL, NULL, NULL),
(340, 'abfab206-1024-42d4-86d5-801eb678ed32', 'AMS', '2025-06-13', '2025-06-20', 1, '2025-02-25 09:39:58', 0, NULL, NULL, NULL, NULL),
(341, '20c53dfd-6292-471f-a3f4-a3407f7078c3', 'AMS', '2025-06-20', '2025-06-27', 1, '2025-02-25 09:40:08', 0, NULL, NULL, NULL, NULL),
(342, '8c9d4a09-7504-47ab-8e23-887d7de373d3', 'AMS', '2025-06-27', '2025-07-04', 1, '2025-02-25 09:40:21', 0, NULL, NULL, NULL, NULL),
(343, '52371db9-9b8b-40a2-bc91-ddc9d63ec12a', 'AMS', '2025-07-04', '2025-07-11', 1, '2025-02-25 09:40:35', 0, NULL, NULL, NULL, NULL),
(344, 'de3c6f56-d08f-4977-9d0a-b495d68534ab', 'AMS', '2025-07-11', '2025-07-18', 1, '2025-02-25 09:40:48', 0, NULL, NULL, NULL, NULL),
(345, 'd8ea30e5-56c4-4f8f-9267-58ecc8c92010', 'AMS', '2025-07-18', '2025-07-25', 1, '2025-02-25 09:41:01', 0, NULL, NULL, NULL, NULL),
(346, '37b14c39-8f9c-4f4d-a7ec-866db690e5a0', 'AMS', '2025-07-25', '2025-08-01', 1, '2025-02-25 09:41:15', 0, NULL, NULL, NULL, NULL),
(347, '4fe691d8-3530-45c4-a9c0-3acd3a8c18c4', 'AMS', '2025-08-01', '2025-08-08', 1, '2025-02-25 09:42:05', 0, NULL, NULL, NULL, NULL),
(348, '580c1aef-c7bf-49bf-8007-acab236c6492', 'AMS', '2025-08-08', '2025-08-15', 1, '2025-02-25 09:42:19', 0, NULL, NULL, NULL, NULL),
(349, '97898472-f91f-4ed5-a2a9-da6958c8077b', 'AMS', '2025-08-15', '2025-08-22', 1, '2025-02-25 09:42:44', 0, NULL, NULL, NULL, NULL),
(350, '0e7b26c6-7fd5-4b58-8d16-ce02e96f3fb0', 'AMS', '2025-08-22', '2025-08-29', 1, '2025-02-25 09:43:00', 0, NULL, NULL, NULL, NULL),
(351, '70a7680e-c712-47f7-9ab0-247817d91901', 'AMS', '2025-08-29', '2025-09-05', 1, '2025-02-25 09:43:16', 0, NULL, NULL, NULL, NULL),
(352, 'e8e8693e-e424-47a8-8bda-0b656a51205a', 'AMS', '2025-09-05', '2025-09-12', 1, '2025-02-25 09:43:31', 0, NULL, NULL, NULL, NULL),
(353, 'd8e213e9-7cee-4189-a039-27f6782b3c25', 'AMS', '2025-09-12', '2025-09-19', 1, '2025-02-25 09:43:42', 0, NULL, NULL, NULL, NULL),
(354, 'e06ebc75-88e5-4259-b41e-971169f7dfdd', 'AMS', '2025-09-19', '2025-09-26', 1, '2025-02-25 09:43:56', 0, NULL, NULL, NULL, NULL),
(355, 'a02e11c0-688b-4685-8166-b698faaf53eb', 'AMS', '2025-09-26', '2025-10-03', 1, '2025-02-25 09:44:06', 0, NULL, NULL, NULL, NULL),
(356, '27cd2a01-da84-4451-b9ae-baec71a4c7e7', 'AMS', '2025-10-03', '2025-10-10', 1, '2025-02-25 09:44:17', 0, NULL, NULL, NULL, NULL),
(357, '61c5c931-1d66-4835-9c62-4fbd83edcfea', 'AMS', '2025-10-10', '2025-10-17', 1, '2025-02-25 09:44:28', 0, NULL, NULL, NULL, NULL),
(358, '69a240cb-3179-4ba3-94c7-f8e88cb34e8b', 'AMS', '2025-10-17', '2025-10-24', 1, '2025-02-25 09:44:41', 0, NULL, NULL, NULL, NULL),
(359, '7ca36174-cafa-49f9-86f5-7a259965b32f', 'AMS', '2025-10-24', '2025-10-31', 1, '2025-02-25 09:45:00', 0, NULL, NULL, NULL, NULL),
(360, 'b2bc17cf-2ecb-4bea-a572-07afa148e841', 'AMS', '2025-10-31', '2025-11-07', 1, '2025-02-25 09:45:12', 0, NULL, NULL, NULL, NULL),
(361, '112adddc-24e8-45b5-938c-c78bc410a2b3', 'AMS', '2025-11-07', '2025-11-14', 1, '2025-02-25 09:45:27', 0, NULL, NULL, NULL, NULL),
(362, '396d2d2c-db76-42c3-a529-3ba9c9c8cbf3', 'AMS', '2025-11-14', '2025-11-21', 1, '2025-02-25 09:45:41', 0, NULL, NULL, NULL, NULL),
(363, '527782ca-a64b-4f91-a270-48a651c41a71', 'AMS', '2025-11-21', '2025-11-28', 1, '2025-02-25 09:45:52', 0, NULL, NULL, NULL, NULL),
(364, '754564a0-61ab-48c1-9424-195bd893908b', 'AMS', '2025-11-28', '2025-12-05', 1, '2025-02-25 09:46:04', 0, NULL, NULL, NULL, NULL),
(365, '8c8811a5-5086-4693-bd87-281c75990eb1', 'AMS', '2025-12-05', '2025-12-12', 1, '2025-02-25 09:46:18', 0, NULL, NULL, NULL, NULL),
(366, '5f800efd-a7f9-40d8-a4b2-fcd35e9a354f', 'AMS', '2025-12-12', '2025-12-19', 1, '2025-02-25 09:46:31', 0, NULL, NULL, NULL, NULL),
(367, '8e17ac61-9aac-4cf1-97cc-f5bb6f91a710', 'AMS', '2025-12-19', '2025-12-26', 1, '2025-02-25 09:46:42', 0, NULL, NULL, NULL, NULL),
(368, '8230b0e3-45d0-43f0-bb66-70e92908b109', 'AMS', '2025-12-26', '2025-01-02', 1, '2025-02-25 09:46:53', 0, NULL, NULL, NULL, NULL),
(369, '2f5d1332-a40c-4df7-a0ab-71d09a950895', 'DSR', '2025-03-27', '2025-04-03', 1, '2025-02-25 09:50:13', 0, NULL, NULL, NULL, NULL),
(370, 'e0f1cb83-7412-439a-bc4e-af03d59ec7cc', 'DSR', '2025-04-03', '2025-04-10', 1, '2025-02-25 09:50:24', 0, NULL, NULL, NULL, NULL),
(371, '32debefe-f252-4899-92db-8a54b8bb99a6', 'DSR', '2025-04-10', '2025-04-17', 1, '2025-02-25 09:50:36', 0, NULL, NULL, NULL, NULL),
(372, 'cd804935-8312-4aaf-a900-ad94356d91ca', 'DSR', '2025-04-17', '2025-04-24', 1, '2025-02-25 09:50:51', 0, NULL, NULL, NULL, NULL),
(373, '5478f065-0fdd-4078-b007-416bdf90d30c', 'DSR', '2025-04-24', '2025-05-01', 1, '2025-02-25 09:51:07', 0, NULL, NULL, NULL, NULL),
(374, '46bdbec0-2acf-48e6-a7b4-e1d186bfea6c', 'DSR', '2025-05-01', '2025-05-08', 1, '2025-02-25 09:51:20', 0, NULL, NULL, NULL, NULL),
(375, 'b594eb58-322d-4b21-8550-40ffb99906be', 'DSR', '2025-05-08', '2025-05-15', 1, '2025-02-25 09:51:35', 0, NULL, NULL, NULL, NULL);
INSERT INTO `sysCruises` (`cruiseID`, `cruiseUUID`, `shipCode`, `cruiseDepartureDate`, `cruiseReturnDate`, `cruiseStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(376, 'cc92e40f-6412-4530-8ac1-7d448391a813', 'DSR', '2025-05-15', '2025-05-22', 1, '2025-02-25 09:51:46', 0, NULL, NULL, NULL, NULL),
(377, '2fb144dd-ef15-4da1-8142-cf6e686824c8', 'DSR', '2025-05-22', '2025-05-29', 1, '2025-02-25 09:51:59', 0, NULL, NULL, NULL, NULL),
(378, 'feda46b6-3155-4f89-8a9a-069c47db3ab6', 'DSR', '2025-05-29', '2025-06-05', 1, '2025-02-25 09:52:12', 0, NULL, NULL, NULL, NULL),
(379, '02bce11c-6d8b-4bf4-bccc-4708f547c823', 'DSR', '2025-06-05', '2025-06-12', 1, '2025-02-25 09:52:24', 0, NULL, NULL, NULL, NULL),
(380, '7cfce690-de8e-4f3c-99a5-adbe5ec3014c', 'DSR', '2025-06-12', '2025-06-19', 1, '2025-02-25 09:52:36', 0, NULL, NULL, NULL, NULL),
(381, '05903343-291d-4804-b076-9a04f8d6e84a', 'DSR', '2025-06-19', '2025-06-26', 1, '2025-02-25 09:52:47', 0, NULL, NULL, NULL, NULL),
(382, '2efa7e01-8cb2-4ccc-a9ef-435bf9aff860', 'DSR', '2025-06-26', '2025-07-03', 1, '2025-02-25 09:52:59', 0, NULL, NULL, NULL, NULL),
(383, '28e3847f-dffc-444d-b6af-f4156a1eb8a4', 'DSR', '2025-07-03', '2025-07-10', 1, '2025-02-25 09:53:18', 0, NULL, NULL, NULL, NULL),
(384, '9ecce253-0302-4e10-a9f8-207b60c9bad4', 'DSR', '2025-07-10', '2025-07-17', 1, '2025-02-25 09:53:28', 0, NULL, NULL, NULL, NULL),
(385, '72c63612-6e99-4b93-8fb6-56fb170b8a97', 'DSR', '2025-07-17', '2025-07-24', 1, '2025-02-25 09:53:38', 0, NULL, NULL, NULL, NULL),
(386, 'd270c621-8c3a-4793-b907-f3515a3ad3f9', 'DSR', '2025-07-24', '2025-07-31', 1, '2025-02-25 09:53:50', 0, NULL, NULL, NULL, NULL),
(387, '1a2ba301-bfc3-494c-ae82-0e9c38b4f944', 'DSR', '2025-07-31', '2025-08-07', 1, '2025-02-25 09:54:02', 0, NULL, NULL, NULL, NULL),
(388, '77a5cdd0-a9c3-4283-9a49-498563d9d37f', 'DSR', '2025-08-07', '2025-08-14', 1, '2025-02-25 09:54:14', 0, NULL, NULL, NULL, NULL),
(389, 'e2c3c85c-2720-433c-a71e-abf2482b76e0', 'DSR', '2025-08-14', '2025-08-21', 1, '2025-02-25 09:54:23', 0, NULL, NULL, NULL, NULL),
(390, 'c87347d2-72c4-442c-8bda-c5c99cd64572', 'DSR', '2025-08-21', '2025-08-28', 1, '2025-02-25 09:54:37', 0, NULL, NULL, NULL, NULL),
(391, '442922ff-be47-4f55-b994-0bf7b36846ae', 'DSR', '2025-08-28', '2025-09-04', 1, '2025-02-25 09:54:48', 0, NULL, NULL, NULL, NULL),
(392, '01d7481c-1bcb-40cb-b734-c5eb1efe4a24', 'DSR', '2025-09-04', '2025-09-11', 1, '2025-02-25 09:54:59', 0, NULL, NULL, NULL, NULL),
(393, '58cda8a7-14d3-4777-8864-ca2e1e2bf9bd', 'DSR', '2025-09-11', '2025-09-18', 1, '2025-02-25 09:55:08', 0, NULL, NULL, NULL, NULL),
(394, 'eed6e62f-4acd-4c48-8608-dfab545eb093', 'DSR', '2025-09-18', '2025-09-25', 1, '2025-02-25 09:55:17', 0, NULL, NULL, NULL, NULL),
(395, 'c4753556-0dc8-404d-b9ce-67c0168d2ab2', 'DSR', '2025-09-25', '2025-10-02', 1, '2025-02-25 09:55:30', 0, NULL, NULL, NULL, NULL),
(396, '32464457-a772-433c-94ee-17f5fb672947', 'DSR', '2025-10-02', '2025-10-09', 1, '2025-02-25 09:55:40', 0, NULL, NULL, NULL, NULL),
(397, '9691a984-31c3-4326-8d1e-58007e1f2927', 'DSR', '2025-10-09', '2025-10-16', 1, '2025-02-25 09:55:50', 0, NULL, NULL, NULL, NULL),
(398, 'b13bf701-9565-4715-bfbc-c521d5e63967', 'DSR', '2025-10-16', '2025-10-23', 1, '2025-02-25 09:56:02', 0, NULL, NULL, NULL, NULL),
(399, '7f2162a1-64ae-4cea-918b-33cd25fd3f1b', 'DSR', '2025-10-23', '2025-10-30', 1, '2025-02-25 09:56:15', 0, NULL, NULL, NULL, NULL),
(400, '2bf70c6b-394d-4743-b2aa-6d11caeede56', 'DSR', '2025-10-30', '2025-11-06', 1, '2025-02-25 09:56:27', 0, NULL, NULL, NULL, NULL),
(401, '589f4a8f-49d6-4e8e-9f8d-2d2f3f231880', 'DSR', '2025-11-06', '2025-11-13', 1, '2025-02-25 09:56:49', 0, NULL, NULL, NULL, NULL),
(402, 'eeeed285-0091-4757-9604-727607a4427b', 'DSR', '2025-11-13', '2025-11-20', 1, '2025-02-25 09:56:58', 0, NULL, NULL, NULL, NULL),
(403, '4ed88fcb-732d-4358-a33d-fbcaad036b02', 'DSR', '2025-11-20', '2025-11-27', 1, '2025-02-25 09:57:08', 0, NULL, NULL, NULL, NULL),
(404, 'b997ff4c-d2b5-494b-8675-12f4c42eb13c', 'DSR', '2025-11-27', '2025-12-04', 1, '2025-02-25 09:57:19', 0, NULL, NULL, NULL, NULL),
(405, 'fe471d25-0466-4714-9a3b-6eca10bada91', 'SOC', '2025-04-04', '2025-04-07', 1, '2025-02-25 09:59:55', 0, NULL, NULL, NULL, NULL),
(406, '3b23cb8b-ca14-4759-8051-cb33f86c513e', 'SOC', '2025-04-07', '2025-04-11', 1, '2025-02-25 10:00:07', 0, NULL, NULL, NULL, NULL),
(407, 'f2a51776-6a37-4178-aa53-49971151fc2f', 'SOC', '2025-04-11', '2025-04-18', 1, '2025-02-25 10:00:21', 0, NULL, NULL, NULL, NULL),
(408, 'd5aec8ac-592f-4487-ab6c-e28ec89bba02', 'SOC', '2025-04-25', '2025-05-02', 1, '2025-02-25 10:00:35', 0, NULL, NULL, NULL, NULL),
(409, 'd5222f63-cd8a-4819-96e1-593b30c9017f', 'SOC', '2025-05-02', '2025-05-09', 1, '2025-02-25 10:00:45', 0, NULL, NULL, NULL, NULL),
(410, '1524d6de-034f-4dba-a7de-525dd0fc98e8', 'SOC', '2025-05-09', '2025-05-16', 1, '2025-02-25 10:01:00', 0, NULL, NULL, NULL, NULL),
(411, '6ac18c55-1768-48f4-bbc9-79a52b63647f', 'SOC', '2025-05-16', '2025-05-23', 1, '2025-02-25 10:01:40', 0, NULL, NULL, NULL, NULL),
(412, '2603087d-c44a-4082-bf1b-13e116b4cffe', 'SOC', '2025-05-23', '2025-05-30', 1, '2025-02-25 10:01:54', 0, NULL, NULL, NULL, NULL),
(413, '52901e2c-ccbc-4428-8977-a557537928cb', 'SOC', '2025-05-30', '2025-06-06', 1, '2025-02-25 10:02:05', 0, NULL, NULL, NULL, NULL),
(414, 'b4d03302-3026-4814-858c-7e75e190deb9', 'SOC', '2025-06-06', '2025-06-13', 1, '2025-02-25 10:02:16', 0, NULL, NULL, NULL, NULL),
(415, '2bd642c7-24e5-425d-a235-0b8f37ae85f4', 'SOC', '2025-06-13', '2025-06-20', 1, '2025-02-25 10:02:27', 0, NULL, NULL, NULL, NULL),
(416, '116a2f27-c116-4c99-9396-b9fbc45d3771', 'SOC', '2025-06-20', '2025-06-27', 1, '2025-02-25 10:02:40', 0, NULL, NULL, NULL, NULL),
(417, '67c424db-8c14-4469-a1a0-da2be5aa4206', 'SOC', '2025-06-27', '2025-06-30', 1, '2025-02-25 10:02:54', 0, NULL, NULL, NULL, NULL),
(418, '9c8fc440-8efa-4655-ae1a-e2c39a6db66f', 'SOC', '2025-06-30', '2025-07-04', 1, '2025-02-25 10:03:07', 0, NULL, NULL, NULL, NULL),
(419, '610d4ac0-08dc-4791-b539-578aa899d732', 'SOC', '2025-07-04', '2025-07-07', 1, '2025-02-25 10:03:17', 0, NULL, NULL, NULL, NULL),
(420, 'cf259a69-6b25-4f12-bdba-ce1bf9d61663', 'SOC', '2025-07-07', '2025-07-11', 1, '2025-02-25 10:03:26', 0, NULL, NULL, NULL, NULL),
(421, '30dfe690-3c8b-4a1a-9a7d-292f58e3905a', 'SOC', '2025-07-11', '2025-07-18', 1, '2025-02-25 10:03:37', 0, NULL, NULL, NULL, NULL),
(422, 'b938d9c4-cce0-482d-b2bb-e31dbf363c57', 'SOC', '2025-07-18', '2025-07-21', 1, '2025-02-25 10:04:03', 0, NULL, NULL, NULL, NULL),
(423, '2ce26e0c-5c9b-48f2-8dcb-a02a4ea334c1', 'SOC', '2025-07-21', '2025-07-25', 1, '2025-02-25 10:04:18', 0, NULL, NULL, NULL, NULL),
(424, '49c65e83-148c-4a64-986d-90d2beee71b1', 'SOC', '2025-07-25', '2025-08-01', 1, '2025-02-25 10:04:36', 0, NULL, NULL, NULL, NULL),
(425, 'e12709d8-6295-4962-beec-dbb80e78db86', 'SOC', '2025-08-01', '2025-08-04', 1, '2025-02-25 10:04:52', 0, NULL, NULL, NULL, NULL),
(426, 'afb6ebd0-51d8-4b76-8931-03e50db2c25d', 'SOC', '2025-08-04', '2025-08-08', 1, '2025-02-25 10:05:05', 0, NULL, NULL, NULL, NULL),
(427, '900bde5b-268c-44b9-9923-cdd155f79022', 'SOC', '2025-08-08', '2025-08-11', 1, '2025-02-25 10:05:15', 0, NULL, NULL, NULL, NULL),
(428, '1a97e85d-7c62-472b-a06e-63fdd162a76f', 'SOC', '2025-08-11', '2025-08-15', 1, '2025-02-25 10:05:27', 0, NULL, NULL, NULL, NULL),
(429, '1284aa7a-0e61-43a3-ba34-f5a3c42b6548', 'SOC', '2025-08-15', '2025-08-18', 1, '2025-02-25 10:05:38', 0, NULL, NULL, NULL, NULL),
(430, 'a991b1aa-71d7-492a-b60d-d85a59ea2c67', 'SOC', '2025-08-18', '2025-08-22', 1, '2025-02-25 10:05:48', 0, NULL, NULL, NULL, NULL),
(431, '43b6a2ae-f137-4817-91c0-8e58198de755', 'SOC', '2025-08-22', '2025-08-29', 1, '2025-02-25 10:06:01', 0, NULL, NULL, NULL, NULL),
(432, 'bb104ba6-2784-468e-9aa6-b9c2efad7c8c', 'SOC', '2025-08-29', '2025-09-01', 1, '2025-02-25 10:06:15', 0, NULL, NULL, NULL, NULL),
(433, '96a9a1f2-44bd-4d74-8a67-69ff0fc937d2', 'SOC', '2025-09-01', '2025-09-05', 1, '2025-02-25 10:06:26', 0, NULL, NULL, NULL, NULL),
(434, '3056eeb1-012a-42a1-864d-c3720224712f', 'SOC', '2025-09-05', '2025-09-12', 1, '2025-02-25 10:06:40', 0, NULL, NULL, NULL, NULL),
(435, '8b237220-716d-4827-b837-9f777a01c094', 'SOC', '2025-09-12', '2025-09-19', 1, '2025-02-25 10:06:51', 0, NULL, NULL, NULL, NULL),
(436, 'f0d248b2-235a-42e6-905f-11d188dcf137', 'SOC', '2025-09-19', '2025-09-26', 1, '2025-02-25 10:07:04', 0, NULL, NULL, NULL, NULL),
(437, '56b96929-c7f6-4cf2-838a-d9e20e94c0a1', 'SOC', '2025-09-26', '2025-10-03', 1, '2025-02-25 10:07:18', 0, NULL, NULL, NULL, NULL),
(438, '529a0eaf-fd89-4302-b22e-a8daf8f1461d', 'SOC', '2025-10-03', '2025-10-10', 1, '2025-02-25 10:07:28', 0, NULL, NULL, NULL, NULL),
(439, 'a9e00a29-4b58-47d1-bcff-abf58fd36905', 'SOC', '2025-10-10', '2025-10-17', 1, '2025-02-25 10:07:39', 0, NULL, NULL, NULL, NULL),
(440, 'ffeaf885-00e7-4834-89b5-a7bd41c8c380', 'SOC', '2025-10-17', '2025-10-24', 1, '2025-02-25 10:07:50', 0, NULL, NULL, NULL, NULL),
(441, '85c64558-5b0d-4295-b7fe-e1fba681d62b', 'SOC', '2025-10-24', '2025-10-31', 1, '2025-02-25 10:08:05', 0, NULL, NULL, NULL, NULL),
(442, 'c21502c4-4996-43f9-81a9-aa9a72011e5d', 'DEL', '2025-07-24', '2025-07-31', 1, '2025-06-30 15:22:10', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sysDictionaries`
--

DROP TABLE IF EXISTS `sysDictionaries`;
CREATE TABLE `sysDictionaries` (
  `dictID` int NOT NULL,
  `dictUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dictContentEN` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dictContentTranslated` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dictInfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dictStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sysDictionaries`
--

INSERT INTO `sysDictionaries` (`dictID`, `dictUUID`, `dictContentEN`, `langCode`, `dictContentTranslated`, `dictInfo`, `dictStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'c47ecec2-e295-405c-9988-7a8edf333f92', 'Is Visible', 'pt', 'É Visível', '', 1, '2025-07-24 08:54:39', 1, NULL, NULL, NULL, NULL),
(2, '45c47caf-f6c9-42b3-b009-fa6dd4501656', 'Code', 'pt', 'Código', '', 1, '2025-07-24 08:54:57', 1, NULL, NULL, NULL, NULL),
(3, 'ef2a5388-249e-4cb8-980a-78e7d186926a', 'Name', 'pt', 'Nome', '', 1, '2025-07-24 08:55:11', 1, NULL, NULL, NULL, NULL),
(4, '434f7540-caa4-41db-a008-d7c0761391fa', 'Status', 'pt', 'estado', '', 1, '2025-07-24 08:55:30', 1, '2025-07-24 10:52:14', 1, NULL, NULL),
(5, '450ed834-8e2d-4576-9e23-885dda476a6f', 'Last', 'pt', 'Último', '', 1, '2025-07-24 08:56:21', 1, NULL, NULL, NULL, NULL),
(6, '78347327-7ed7-4ac0-987c-f5e033cd221c', 'First', 'pt', 'Primeiro', '', 1, '2025-07-24 08:56:42', 1, NULL, NULL, NULL, NULL),
(7, '4380da2f-8a0c-40bb-bf49-71cc0fbe24d7', 'Next', 'pt', 'Próximo', '', 1, '2025-07-24 08:57:06', 1, NULL, NULL, NULL, NULL),
(8, '99b4aaa8-fcda-4c92-bd07-d361bd138552', 'Previous', 'pt', 'Anterior', '', 1, '2025-07-24 08:57:29', 1, NULL, NULL, NULL, NULL),
(9, 'c5209984-e295-486e-8fb5-877bed7103c8', 'Showing _START_ to _END_ of _TOTAL_ entries', 'pt', 'A exibir _START_ a _END_ de _TOTAL_ registos', '', 1, '2025-07-24 08:58:09', 1, NULL, NULL, NULL, NULL),
(10, '246d054e-7964-459b-86c3-f1f435c8caea', 'Showing 0 to 0 of 0 entries', 'pt', 'A exibir 0 a 0 de 0 registos', '', 1, '2025-07-24 09:00:27', 1, NULL, NULL, NULL, NULL),
(11, '64c16b26-cf75-40b1-bc8a-a600a69ddb1d', '(Filtered from _MAX_ total entries)', 'pt', '( Filtrado do total de _MAX_ registos )', '', 1, '2025-07-24 09:01:17', 1, '2025-07-24 10:53:37', 1, NULL, NULL),
(12, '9cd672e1-a74f-49df-9fc4-8062969f5e1a', 'Search in listing By :', 'pt', 'Pesquisar na listagem Por :', '', 1, '2025-07-24 09:03:30', 1, '2025-07-24 10:52:59', 1, NULL, NULL),
(13, 'a959111a-87f6-4fbb-81a7-d0ba1da33e33', 'No records found', 'pt', 'Não foram encontrados registos para a pesquisa !', '', 1, '2025-07-24 09:04:05', 1, '2025-07-24 10:52:38', 1, NULL, NULL),
(14, '286b0950-102b-41d5-ac78-a4e971eed8d7', 'Show  _MENU_  records per page', 'pt', 'A exibir _MENU_ registos por página', '', 1, '2025-07-24 09:04:38', 1, NULL, NULL, NULL, NULL),
(15, '82521c88-b415-42af-acf1-c403f45d033c', 'Loading...', 'pt', 'A Carregar...', '', 1, '2025-07-24 09:05:13', 1, NULL, NULL, NULL, NULL),
(16, 'd72b3798-24c3-47e0-859c-4d58959cad21', 'Processing...', 'pt', 'A Processar...', '', 1, '2025-07-24 09:05:28', 1, NULL, NULL, NULL, NULL),
(17, 'cd0f50de-6dab-416d-b1e3-1d2565fc2b41', 'No records found', 'pt', 'Sem registos', '', 1, '2025-07-24 09:06:03', 1, NULL, NULL, NULL, NULL),
(18, 'aa2d99d8-8110-4a5c-948e-f1417ebb5c7c', 'Add', 'pt', 'Incluir', '', 1, '2025-07-24 09:19:58', 1, NULL, NULL, NULL, NULL),
(19, '4954f5ba-9a26-4fd6-8ed9-fc93b4950bab', 'Active / Visible', 'pt', 'Ativo / Visível', '', 1, '2025-07-24 10:38:46', 1, NULL, NULL, NULL, NULL),
(20, 'fd7a6d81-c529-482b-bae2-36a6728d5297', 'English content', 'pt', 'Conteúdo em Inglês - EN', '', 1, '2025-07-24 10:39:32', 1, NULL, NULL, NULL, NULL),
(21, '1140783d-571c-49b7-863a-21f92524e4af', 'Content Translated into Language', 'pt', 'Conteúdo Traduzido para o Idioma', '', 1, '2025-07-24 10:42:06', 1, NULL, NULL, NULL, NULL),
(22, '2ac09297-3a95-405b-a06d-cec0e92a9b52', 'Dictionaries', 'pt', 'Dicionários', '', 1, '2025-07-24 10:43:16', 1, NULL, NULL, NULL, NULL),
(23, 'd7cd75c4-4a91-4f09-9577-49c9183b6cfa', 'Change', 'pt', 'Alterar', '', 1, '2025-07-24 10:45:20', 1, NULL, NULL, NULL, NULL),
(24, 'f98b8ac9-2db9-4226-b450-a2aba24d17ac', 'Are you sure you want to change this status?', 'pt', 'Tem a certeza de que pretende alterar este estado?', '', 1, '2025-07-24 10:51:14', 1, NULL, NULL, NULL, NULL),
(25, '9409ea36-9bec-4ef1-96bb-9a4f12aad3a0', 'SHOP', 'pt', 'LOJA', '', 1, '2025-07-24 11:00:03', 1, NULL, NULL, NULL, NULL),
(26, '2d194bda-a626-458f-955e-361b58985e35', 'Size', 'pt', 'Tamanho', '', 1, '2025-07-24 11:01:48', 1, NULL, NULL, NULL, NULL),
(27, '97fa9bf5-9c12-4e36-87ee-5011657e1be8', 'Dimensions', 'pt', 'Dimensões', '', 1, '2025-07-24 11:02:20', 1, NULL, NULL, NULL, NULL),
(28, '09bb5365-6b70-4710-8adb-405c33a34b80', 'Click here to Change Status!', 'pt', 'Carregue aqui para alterar o estado!', '', 1, '2025-07-24 11:12:21', 1, NULL, NULL, NULL, NULL),
(29, '11febbc9-25ea-425e-a2de-d371ccd9f219', 'DAILY MENUS TYPES', 'pt', 'TIPOS DE DAILY MENUS', '', 1, '2025-07-24 11:22:45', 1, NULL, NULL, NULL, NULL),
(30, '5ef6b9fa-24a4-49dd-8a02-6315ca3822b3', 'RESTAURANT MENUS', 'pt', 'MENUS DO RESTAURANTE', '', 1, '2025-07-24 11:23:55', 1, NULL, NULL, NULL, NULL),
(31, '0493a1f2-4b23-461a-8363-af2f13246cc3', 'Type', 'pt', 'Tipo', '', 1, '2025-07-24 11:26:17', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sysLanguages`
--

DROP TABLE IF EXISTS `sysLanguages`;
CREATE TABLE `sysLanguages` (
  `langID` int NOT NULL,
  `langUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langCode` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langName` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langAppIsVisible` int DEFAULT '0',
  `langStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sysLanguages`
--

INSERT INTO `sysLanguages` (`langID`, `langUUID`, `langCode`, `langName`, `langAppIsVisible`, `langStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'f19d3a21-a228-45ee-a840-a4c192449eb7', 'en', 'English', 0, 1, '2025-06-11 09:41:57', NULL, '2025-08-18 10:53:04', 1, NULL, NULL),
(2, '86dc192d-5394-409c-92e4-6afb3e6459d4', 'pt', 'Português', 0, 0, '2025-06-17 15:09:11', 1, '2025-08-18 10:51:06', 1, NULL, NULL),
(3, '9515eab3-170b-4d19-9adb-2fafc2058e3d', 'es', 'Espanhol', 0, 0, '2025-07-14 10:16:49', 1, '2025-08-18 11:10:25', 1, NULL, NULL),
(4, '04147bfe-69cc-468b-b961-f6348475597a', 'pt', 'Português', 1, 1, '2025-08-15 13:19:15', 1, '2025-08-15 13:19:22', NULL, '2025-08-15 13:19:22', 1),
(5, '2df69156-f4bb-4ecc-a60c-c77f7506b322', 'fr', 'Français', 0, 1, '2025-08-17 20:00:38', 1, '2025-08-18 10:52:55', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sysLogs`
--

DROP TABLE IF EXISTS `sysLogs`;
CREATE TABLE `sysLogs` (
  `logID` int NOT NULL,
  `logUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logDateTime` datetime DEFAULT NULL,
  `managerUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userID` int DEFAULT NULL,
  `logIP` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logPlataform` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logPage` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logAction` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logActionResult` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logActionResultData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `logData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `logDataFile` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `logDataError` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sysLogs`
--

INSERT INTO `sysLogs` (`logID`, `logUUID`, `shipCode`, `operCode`, `logDateTime`, `managerUUID`, `userID`, `logIP`, `logPlataform`, `logPage`, `logAction`, `logActionResult`, `logActionResultData`, `logData`, `logDataFile`, `logDataError`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '68e93a7d-50e9-4d51-b284-97406c4f2bd3', NULL, NULL, '2025-09-19 12:27:04', '2acb1eb7-d41f-4333-9111-0afa5035a5e6', NULL, '192.168.65.1', 'Managers', '_index.sbm', 'login (manager)', 'Success!', NULL, '{\"action\":\"login\",\"loginEmail\":\"alexandre.borba@mysticinvest.com\",\"loginPassword\":\"71b2acebe0d5559efde4a59d07df56d3\",\"remember\":\"on\",\"btnSubmit\":\"\"}', NULL, NULL, '2025-09-19 12:27:04', NULL, NULL, NULL, NULL, NULL),
(2, '76ba6352-7a4f-4f61-898b-5c9964976418', NULL, NULL, '2025-09-19 14:20:52', '2acb1eb7-d41f-4333-9111-0afa5035a5e6', NULL, '192.168.65.1', 'Managers', '_index.sbm', 'login (manager)', 'Success!', NULL, '{\"action\":\"login\",\"loginEmail\":\"alexandre.borba@mysticinvest.com\",\"loginPassword\":\"71b2acebe0d5559efde4a59d07df56d3\",\"remember\":\"on\",\"btnSubmit\":\"\"}', NULL, NULL, '2025-09-19 14:20:52', NULL, NULL, NULL, NULL, NULL),
(3, '4e0e1b3c-748c-449c-8f69-21f934484cfa', NULL, NULL, '2025-09-19 14:21:12', '2acb1eb7-d41f-4333-9111-0afa5035a5e6', NULL, '192.168.65.1', NULL, 'dailyMenusTypes.sbm', 'ins', 'Success!', NULL, '{\"shipCode\":\"AMA\",\"operCode\":\"AMA\",\"dmTypeUUID\":\"70c85439-f3ed-43c3-ab48-b9d57eac8436\",\"dmTypeName\":\"Default \\/ Padr\\u00e3o\",\"dmTypeStatus\":\"1\"}', NULL, NULL, '2025-09-19 14:21:12', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sysManagers`
--

DROP TABLE IF EXISTS `sysManagers`;
CREATE TABLE `sysManagers` (
  `managerID` int NOT NULL,
  `managerUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managerName` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managerUsername` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managerEmail` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managerFunction` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managerTlm` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managerPSWHash` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `managerPerm` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `managerPSWReset` int DEFAULT NULL,
  `managerAdm` int DEFAULT '0',
  `langCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managerStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sysManagers`
--

INSERT INTO `sysManagers` (`managerID`, `managerUUID`, `managerName`, `managerUsername`, `managerEmail`, `managerFunction`, `managerTlm`, `managerPSWHash`, `managerPerm`, `managerPSWReset`, `managerAdm`, `langCode`, `managerStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '2acb1eb7-d41f-4333-9111-0afa5035a5e6', 'ALEXANDRE BORBA', 'alexandre', 'alexandre.borba@mysticinvest.com', 'Gestor Aplicacional', '', '71b2acebe0d5559efde4a59d07df56d3', NULL, NULL, 1, NULL, 1, '2023-08-12 01:08:23', 0, '2025-04-23 22:14:20', 0, NULL, NULL),
(3, '6d515fa8-d8fc-4559-89d2-faeff5f26820', 'RECEPTION', 'qi.reception', 'queenIsabel@douroazul.pt', 'Reception', '', '823c41da6215d910f7c8ad5d2819f31f', NULL, NULL, 0, '', 1, '2025-08-15 13:18:00', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sysNavGroups`
--

DROP TABLE IF EXISTS `sysNavGroups`;
CREATE TABLE `sysNavGroups` (
  `navGroupID` int NOT NULL,
  `navGroupUUID` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `navGroupIcon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `navGroupTitle` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `navGroupSeq` int DEFAULT NULL,
  `navGroupStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sysNavGroups`
--

INSERT INTO `sysNavGroups` (`navGroupID`, `navGroupUUID`, `navGroupIcon`, `navGroupTitle`, `navGroupSeq`, `navGroupStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'a3154a0b-341a-4270-9737-b0d5f46307c7', NULL, 'System', 1, 1, '2025-03-17 15:30:00', NULL, NULL, NULL, NULL, NULL),
(2, '6d23231a-fbe7-4dfd-8613-e44d40860048', NULL, 'Concierge', 2, 1, '2025-03-17 15:30:00', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sysNavs`
--

DROP TABLE IF EXISTS `sysNavs`;
CREATE TABLE `sysNavs` (
  `navID` int NOT NULL,
  `navUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `navGroupUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `navTitle` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `navUrl` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `navSeq` int NOT NULL,
  `navStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sysNavs`
--

INSERT INTO `sysNavs` (`navID`, `navUUID`, `navGroupUUID`, `navTitle`, `navUrl`, `navSeq`, `navStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '57c5e590-27be-40af-a6a3-1f89e27b4905', 'a3154a0b-341a-4270-9737-b0d5f46307c7', 'Managers', '_managers.lst', 1, 1, '2025-03-17 19:31:48', NULL, '2025-03-17 19:41:00', NULL, NULL, NULL),
(2, '9e2fc627-f0c3-4a74-8430-51de35cb7d92', 'a3154a0b-341a-4270-9737-b0d5f46307c7', 'Logs', '_logs.lst', 2, 1, '2025-03-17 19:31:48', NULL, '2025-03-17 19:41:03', NULL, NULL, NULL),
(3, '3ab8ed4c-1388-46b7-9ad8-cac0a901628a', '6d23231a-fbe7-4dfd-8613-e44d40860048', 'Daily Menu Types', '_dailyMenusTypes.lst', 1, 1, '2025-03-17 19:38:43', NULL, '2025-03-17 19:41:16', NULL, NULL, NULL),
(4, 'ac756363-4254-4a33-8254-90444a28c214', '6d23231a-fbe7-4dfd-8613-e44d40860048', 'Daily Menus', '_dailyMenus.lst', 2, 1, '2025-03-17 19:38:43', NULL, '2025-03-17 19:41:23', NULL, NULL, NULL),
(5, '4c58743a-01f5-4c8d-b77d-a8c45dc82b93', '6d23231a-fbe7-4dfd-8613-e44d40860048', 'Daily Programs', '_dailyPrograms.lst', 3, 1, '2025-03-17 19:38:43', NULL, '2025-03-17 19:41:22', NULL, NULL, NULL),
(6, '9a564c33-a639-480b-9245-74560fa305df', '6d23231a-fbe7-4dfd-8613-e44d40860048', 'Slide Shows', '_slidesShows.lst', 4, 1, '2025-03-17 19:38:43', NULL, '2025-03-18 15:00:52', NULL, NULL, NULL),
(7, '1643562c-36d2-4827-ab1c-6baacaf6d2cb', '6d23231a-fbe7-4dfd-8613-e44d40860048', 'Spas', '_spas.lst', 5, 1, '2025-03-17 19:40:21', NULL, '2025-03-17 19:41:20', NULL, NULL, NULL),
(8, '51799ed9-bff7-4721-b070-f951fe44f8fe', '6d23231a-fbe7-4dfd-8613-e44d40860048', 'Videos', '_videos.lst', 6, 1, '2025-03-17 19:40:21', NULL, '2025-03-17 19:41:18', NULL, NULL, NULL),
(9, '6c8870b3-6bd5-4737-9b7f-9a6c2daad175', '6d23231a-fbe7-4dfd-8613-e44d40860048', 'Fast Infos', '_fastInfos.lst', 7, 1, '2025-03-18 08:57:44', NULL, '2025-03-18 08:58:08', NULL, NULL, NULL),
(10, '70836f52-1423-46f4-9d8f-65f5fea53adc', 'a3154a0b-341a-4270-9737-b0d5f46307c7', 'Interactions', '_interactions.lst', 3, 1, '2025-03-18 08:59:27', NULL, '2025-03-18 09:00:02', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sysShips`
--

DROP TABLE IF EXISTS `sysShips`;
CREATE TABLE `sysShips` (
  `shipID` int NOT NULL,
  `shipUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipName` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipStatus` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sysTokens`
--

DROP TABLE IF EXISTS `sysTokens`;
CREATE TABLE `sysTokens` (
  `tokenID` int NOT NULL,
  `tokenUUID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tokenDateTime` datetime DEFAULT NULL,
  `tokenStartDateTime` datetime DEFAULT NULL,
  `tokenEndDateTime` datetime DEFAULT NULL,
  `tokenName` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tokenJWT` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tokenStatus` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sysTokens`
--

INSERT INTO `sysTokens` (`tokenID`, `tokenUUID`, `shipCode`, `operCode`, `tokenDateTime`, `tokenStartDateTime`, `tokenEndDateTime`, `tokenName`, `tokenJWT`, `tokenStatus`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '60100e1e-26ed-4275-8525-3186720cf9fa', 'AMS', 'AMA', '2025-03-23 14:50:10', '2025-04-23 22:22:00', '2027-04-23 21:22:00', 'Acesso API ao Menu Vertical Restaurante AmaSintra', 'eyJhbGciOiAiSFMyNTYiLCAidHlwIiA6ICJKV1QifQ.eyJzdWIiOiAiMGViMGFkYzUyOGI3YzZjYTM5ZjE1NzZkNWUzYmQyMGIiLCAibmFtZSI6ICJNeXN0aWNJbnZlc3QiLCAiaWF0IiA6IDE3NDI3NDE0MTB9.lkf4BseEi7SbrdNMtg_sMHWxMuAKU3xMxcEhwATXzyU', 1, '2025-03-23 14:50:13', 0, '2025-04-23 22:34:29', 0, NULL, NULL),
(2, '882046d2-e0b7-4445-ad8c-bb07cf33e5d3', 'AMS', 'AMA', '2025-04-23 22:30:43', '2025-04-23 22:30:43', '2027-04-23 22:30:43', 'Acesso API ao Concierge AmaSintra', 'eyJhbGciOiAiSFMyNTYiLCAidHlwIiA6ICJKV1QifQ.eyJzdWIiOiAiNzVmODY1YTFkN2Y2MDZmYTkyOWE2M2Q1NjY0YmE3MmMiLCAibmFtZSI6ICJNeXN0aWNJbnZlc3QiLCAiaWF0IiA6IDE3NDU0NDM4NDN9.rU0X1MrLwhP5wsbGVgy8eQyrZsIRzp_2quM5ezIWBXE', 1, '2025-04-23 22:30:51', 0, '2025-04-23 22:33:33', 0, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `conciergeDailyMenus`
--
ALTER TABLE `conciergeDailyMenus`
  ADD PRIMARY KEY (`dmID`);

--
-- Índices de tabela `conciergeDailyMenusTypes`
--
ALTER TABLE `conciergeDailyMenusTypes`
  ADD PRIMARY KEY (`dmTypeID`);

--
-- Índices de tabela `conciergeDailyMenusVerticais`
--
ALTER TABLE `conciergeDailyMenusVerticais`
  ADD PRIMARY KEY (`dmvID`);

--
-- Índices de tabela `conciergeDailyPrograms`
--
ALTER TABLE `conciergeDailyPrograms`
  ADD PRIMARY KEY (`dpID`);

--
-- Índices de tabela `conciergeFastInfos`
--
ALTER TABLE `conciergeFastInfos`
  ADD PRIMARY KEY (`fastInfoID`);

--
-- Índices de tabela `conciergeInteractions`
--
ALTER TABLE `conciergeInteractions`
  ADD PRIMARY KEY (`interactionID`),
  ADD KEY `idx_conciergeInteractions_datetime` (`interactionDateTime`),
  ADD KEY `idx_conciergeInteractions_option` (`interactionOption`),
  ADD KEY `idx_conciergeInteractions_deleted` (`deleted_at`);

--
-- Índices de tabela `conciergeShips`
--
ALTER TABLE `conciergeShips`
  ADD PRIMARY KEY (`shipID`);

--
-- Índices de tabela `conciergeShops`
--
ALTER TABLE `conciergeShops`
  ADD PRIMARY KEY (`shopID`);

--
-- Índices de tabela `conciergeSpas`
--
ALTER TABLE `conciergeSpas`
  ADD PRIMARY KEY (`spaID`);

--
-- Índices de tabela `conciergeVideos`
--
ALTER TABLE `conciergeVideos`
  ADD PRIMARY KEY (`videoID`);

--
-- Índices de tabela `sysCruises`
--
ALTER TABLE `sysCruises`
  ADD PRIMARY KEY (`cruiseID`);

--
-- Índices de tabela `sysDictionaries`
--
ALTER TABLE `sysDictionaries`
  ADD PRIMARY KEY (`dictID`);

--
-- Índices de tabela `sysLanguages`
--
ALTER TABLE `sysLanguages`
  ADD PRIMARY KEY (`langID`);

--
-- Índices de tabela `sysLogs`
--
ALTER TABLE `sysLogs`
  ADD PRIMARY KEY (`logID`);

--
-- Índices de tabela `sysManagers`
--
ALTER TABLE `sysManagers`
  ADD PRIMARY KEY (`managerID`);

--
-- Índices de tabela `sysNavGroups`
--
ALTER TABLE `sysNavGroups`
  ADD PRIMARY KEY (`navGroupID`);

--
-- Índices de tabela `sysNavs`
--
ALTER TABLE `sysNavs`
  ADD PRIMARY KEY (`navID`);

--
-- Índices de tabela `sysShips`
--
ALTER TABLE `sysShips`
  ADD PRIMARY KEY (`shipID`);

--
-- Índices de tabela `sysTokens`
--
ALTER TABLE `sysTokens`
  ADD PRIMARY KEY (`tokenID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `conciergeDailyMenus`
--
ALTER TABLE `conciergeDailyMenus`
  MODIFY `dmID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `conciergeDailyMenusTypes`
--
ALTER TABLE `conciergeDailyMenusTypes`
  MODIFY `dmTypeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `conciergeDailyMenusVerticais`
--
ALTER TABLE `conciergeDailyMenusVerticais`
  MODIFY `dmvID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `conciergeDailyPrograms`
--
ALTER TABLE `conciergeDailyPrograms`
  MODIFY `dpID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `conciergeFastInfos`
--
ALTER TABLE `conciergeFastInfos`
  MODIFY `fastInfoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `conciergeInteractions`
--
ALTER TABLE `conciergeInteractions`
  MODIFY `interactionID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `conciergeShips`
--
ALTER TABLE `conciergeShips`
  MODIFY `shipID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `conciergeShops`
--
ALTER TABLE `conciergeShops`
  MODIFY `shopID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `conciergeSpas`
--
ALTER TABLE `conciergeSpas`
  MODIFY `spaID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `conciergeVideos`
--
ALTER TABLE `conciergeVideos`
  MODIFY `videoID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sysCruises`
--
ALTER TABLE `sysCruises`
  MODIFY `cruiseID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT de tabela `sysDictionaries`
--
ALTER TABLE `sysDictionaries`
  MODIFY `dictID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `sysLanguages`
--
ALTER TABLE `sysLanguages`
  MODIFY `langID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `sysLogs`
--
ALTER TABLE `sysLogs`
  MODIFY `logID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sysManagers`
--
ALTER TABLE `sysManagers`
  MODIFY `managerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sysNavGroups`
--
ALTER TABLE `sysNavGroups`
  MODIFY `navGroupID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `sysNavs`
--
ALTER TABLE `sysNavs`
  MODIFY `navID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `sysShips`
--
ALTER TABLE `sysShips`
  MODIFY `shipID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sysTokens`
--
ALTER TABLE `sysTokens`
  MODIFY `tokenID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
