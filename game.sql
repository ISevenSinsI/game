-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2014 at 01:43 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `game`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_id` int(11) NOT NULL,
  `level_required` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `item_subtype_required_id` int(11) NOT NULL,
  `item_used_1_id` int(11) NOT NULL,
  `item_used_1_amount` int(11) NOT NULL,
  `item_used_2_id` int(11) NOT NULL,
  `item_used_2_amount` int(11) NOT NULL,
  `base_time` int(3) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `skill_id`, `level_required`, `name`, `description`, `item_subtype_required_id`, `item_used_1_id`, `item_used_1_amount`, `item_used_2_id`, `item_used_2_amount`, `base_time`, `img_path`, `created`, `updated`, `deleted`) VALUES
(1, 3, 0, 'Work at dock', 'You are currently loading and unloading the ships.', 0, 0, 0, 0, 0, 80, 'assets/img/actions/luck/veghel_docks.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 4, 0, 'Cut wood', 'You are currenctly cutting wood.', 2, 0, 0, 0, 0, 20, 'assets/img/actions/woodcutting/zeeland_woodcutting.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 5, 0, 'Net Fishing', 'You are currently fishing with your net.\r\n', 3, 0, 0, 0, 0, 20, 'assets/img/actions/fishing/veghel_small_net_fising.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 6, 1, 'Mine stone', 'You are currently mining stone bricks', 1, 0, 0, 0, 0, 20, 'assets/img/actions/mining/uden_mine_stone.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 7, 1, 'Cook minnow', 'You are currently cooking the minnow.', 4, 2, 1, 5, 1, 20, 'assets/img/actions/cooking/cook_minnow.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `actions_locations`
--

CREATE TABLE IF NOT EXISTS `actions_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `actions_locations`
--

INSERT INTO `actions_locations` (`id`, `action_id`, `location_id`, `created`, `updated`, `deleted`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `actions_rewards`
--

CREATE TABLE IF NOT EXISTS `actions_rewards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_id` int(11) NOT NULL,
  `exp` int(5) NOT NULL,
  `exp_chance` decimal(11,2) NOT NULL,
  `currency` int(11) NOT NULL,
  `currency_chance` decimal(11,2) NOT NULL,
  `item_1_id` int(11) NOT NULL,
  `item_1_amount` varchar(255) NOT NULL,
  `item_1_chance` decimal(11,2) NOT NULL,
  `item_2_id` int(11) NOT NULL,
  `item_2_amount` varchar(255) NOT NULL,
  `item_2_chance` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `actions_rewards`
--

INSERT INTO `actions_rewards` (`id`, `action_id`, `exp`, `exp_chance`, `currency`, `currency_chance`, `item_1_id`, `item_1_amount`, `item_1_chance`, `item_2_id`, `item_2_amount`, `item_2_chance`, `created`, `updated`, `deleted`) VALUES
(1, 1, 10, '50.00', 8, '100.00', 0, '0', '0.00', 0, '0', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 20, '100.00', 0, '0.00', 2, '1::1::2', '100.00', 0, '0', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 18, '100.00', 0, '0.00', 5, '1::1::1::2', '100.00', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 15, '100.00', 0, '0.00', 6, '1', '100.00', 7, '1', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 25, '100.00', 0, '0.00', 9, '1', '40.00', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `action_1_id` int(11) NOT NULL,
  `action_2_id` int(11) NOT NULL,
  `action_3_id` int(11) NOT NULL,
  `action_4_id` int(11) NOT NULL,
  `action_5_id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `description`, `action_1_id`, `action_2_id`, `action_3_id`, `action_4_id`, `action_5_id`, `img_path`, `created`, `updated`, `deleted`) VALUES
(1, 'Kitchen', 'this kitchen is free to use for everybody and is always open.<br /> Just don''t forget to clean up the mess you''ve made.', 5, 0, 0, 0, 0, 'assets/img/buildings/cooking/uden_kitchen.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `buildings_locations`
--

CREATE TABLE IF NOT EXISTS `buildings_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `building_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `buildings_locations`
--

INSERT INTO `buildings_locations` (`id`, `building_id`, `location_id`, `created`, `updated`, `deleted`) VALUES
(1, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `equip_locations`
--

CREATE TABLE IF NOT EXISTS `equip_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `equip_locations`
--

INSERT INTO `equip_locations` (`id`, `name`, `created`, `updated`, `deleted`) VALUES
(1, 'Right hand', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `exp_table`
--

CREATE TABLE IF NOT EXISTS `exp_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `exp_max` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `exp_table`
--

INSERT INTO `exp_table` (`id`, `level`, `exp`, `exp_max`, `created`, `updated`, `deleted`) VALUES
(1, 1, 0, 54, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 55, 219, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 220, 494, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 495, 879, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 880, 1374, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 6, 1375, 1979, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 7, 1980, 2694, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 8, 2695, 3519, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 9, 3520, 4454, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 10, 4455, 5499, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 11, 5500, 6654, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 12, 6655, 7919, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 13, 7920, 9294, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 14, 9295, 10779, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 15, 10780, 12374, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 16, 12375, 14079, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 17, 14080, 15894, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 18, 15895, 17819, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 19, 17820, 19854, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 20, 19855, 21999, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 21, 22000, 24254, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 22, 24255, 26619, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 23, 26620, 29094, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 24, 29095, 31679, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 25, 31680, 34374, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 26, 34375, 37179, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 27, 37180, 40094, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 28, 40095, 43119, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 29, 43120, 46254, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 30, 46255, 49499, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 31, 49500, 56924, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 32, 56925, 65463, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 33, 65464, 75283, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 34, 75284, 86576, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 35, 86577, 99563, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 36, 99564, 114498, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 37, 114499, 131673, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 38, 131674, 151424, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 39, 151425, 174138, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 40, 174139, 200259, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 41, 200260, 230298, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 42, 230299, 264843, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 43, 264844, 304570, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 44, 304571, 350256, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 45, 350257, 402795, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 46, 402796, 463214, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 47, 463215, 532696, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 48, 532697, 612601, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 49, 612602, 704491, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 50, 704492, 704491, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `item_1_id` int(11) NOT NULL,
  `item_2_id` int(11) NOT NULL,
  `item_3_id` int(11) NOT NULL,
  `item_4_id` int(11) NOT NULL,
  `item_5_id` int(11) NOT NULL,
  `item_6_id` int(11) NOT NULL,
  `item_7_id` int(11) NOT NULL,
  `item_8_id` int(11) NOT NULL,
  `item_9_id` int(11) NOT NULL,
  `item_10_id` int(11) NOT NULL,
  `item_11_id` int(11) NOT NULL,
  `item_12_id` int(11) NOT NULL,
  `item_13_id` int(11) NOT NULL,
  `item_14_id` int(11) NOT NULL,
  `item_15_id` int(11) NOT NULL,
  `item_16_id` int(11) NOT NULL,
  `item_17_id` int(11) NOT NULL,
  `item_18_id` int(11) NOT NULL,
  `item_19_id` int(11) NOT NULL,
  `item_20_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  `item_1_amount` int(11) NOT NULL,
  `item_2_amount` int(11) NOT NULL,
  `item_3_amount` int(11) NOT NULL,
  `item_4_amount` int(11) NOT NULL,
  `item_5_amount` int(11) NOT NULL,
  `item_6_amount` int(11) NOT NULL,
  `item_7_amount` int(11) NOT NULL,
  `item_8_amount` int(11) NOT NULL,
  `item_9_amount` int(11) NOT NULL,
  `item_10_amount` int(11) NOT NULL,
  `item_11_amount` int(11) NOT NULL,
  `item_12_amount` int(11) NOT NULL,
  `item_13_amount` int(11) NOT NULL,
  `item_14_amount` int(11) NOT NULL,
  `item_15_amount` int(11) NOT NULL,
  `item_16_amount` int(11) NOT NULL,
  `item_17_amount` int(11) NOT NULL,
  `item_18_amount` int(11) NOT NULL,
  `item_19_amount` int(11) NOT NULL,
  `item_20_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `player_id`, `item_1_id`, `item_2_id`, `item_3_id`, `item_4_id`, `item_5_id`, `item_6_id`, `item_7_id`, `item_8_id`, `item_9_id`, `item_10_id`, `item_11_id`, `item_12_id`, `item_13_id`, `item_14_id`, `item_15_id`, `item_16_id`, `item_17_id`, `item_18_id`, `item_19_id`, `item_20_id`, `created`, `updated`, `deleted`, `item_1_amount`, `item_2_amount`, `item_3_amount`, `item_4_amount`, `item_5_amount`, `item_6_amount`, `item_7_amount`, `item_8_amount`, `item_9_amount`, `item_10_amount`, `item_11_amount`, `item_12_amount`, `item_13_amount`, `item_14_amount`, `item_15_amount`, `item_16_amount`, `item_17_amount`, `item_18_amount`, `item_19_amount`, `item_20_amount`) VALUES
(1, 1, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 13, 175, 1, 1, 8, 61, 9, 1, 24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `subtype_id` int(11) NOT NULL,
  `skill_required` int(11) NOT NULL,
  `level_required` int(11) NOT NULL,
  `equip_location_id` int(11) NOT NULL,
  `bonus_1_id` int(11) NOT NULL,
  `bonus_2_id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=10 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `type_id`, `subtype_id`, `skill_required`, `level_required`, `equip_location_id`, `bonus_1_id`, `bonus_2_id`, `img_path`, `created`, `updated`, `deleted`) VALUES
(1, 'Stone axe', 'Used to gather wood.', 1, 2, 4, 1, 1, 0, 0, 'assets/img/items/woodcutting/stone-axe.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Logs', 'This could keep you warm<br/> or make you a house.', 3, 0, 0, 0, 0, 0, 0, 'assets/img/items/woodcutting/logs.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Stone pickaxe', 'Used to gather minerals and stone.', 1, 1, 6, 1, 1, 0, 0, 'assets/img/items/mining/stone-pickaxe.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Fishing net', 'You can try to catch small fish with this.', 1, 3, 5, 1, 1, 0, 0, 'assets/img/items/fishing/fishing-net.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Minnow', 'A very little fish.', 3, 0, 0, 0, 0, 0, 0, 'assets/img/items/fishing/minnow.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Stone brick', 'Heavy, used for building', 3, 0, 0, 0, 0, 0, 0, 'assets/img/items/mining/stone_brick.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Sapphire', 'Ooh! shiny.', 3, 0, 0, 0, 0, 0, 0, 'assets/img/items/mining/sapphire.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Tinderbox', 'Used to make fire.', 1, 4, 0, 0, 1, 0, 0, 'assets/img/items/cooking/tinderbox.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Cooked Minnow', 'This should taste lovely.', 2, 0, 0, 0, 0, 0, 0, 'assets/img/items/cooking/cooked_minnow.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `items_equiped`
--

CREATE TABLE IF NOT EXISTS `items_equiped` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `equip_location_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `items_equiped`
--

INSERT INTO `items_equiped` (`id`, `player_id`, `item_id`, `equip_location_id`, `created`, `updated`, `deleted`) VALUES
(6, 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_subtypes`
--

CREATE TABLE IF NOT EXISTS `item_subtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deelted` datetime NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `item_subtypes`
--

INSERT INTO `item_subtypes` (`id`, `type_id`, `name`, `created`, `updated`, `deelted`) VALUES
(1, 1, 'Pickaxe', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'Hatchet', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'fishing_net', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'Tinderbox', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_types`
--

CREATE TABLE IF NOT EXISTS `item_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item_types`
--

INSERT INTO `item_types` (`id`, `name`, `skill_id`, `created`, `updated`, `deleted`) VALUES
(1, 'equipment', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'consumable', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'material', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `description`, `img_path`, `created`, `updated`, `deleted`) VALUES
(1, 'Veghel', 'Veghel is a small town that grew quickly thanks to it''s blooming industries. <br/> There are a lot of jobs where you could earn some cash.', 'assets/img/locations/veghel.png', '2014-09-25 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Uden', 'A lively town where interesting things could be found. <br/> There are always enough shops open to provide people of their needs.', 'assets/img/locations/uden.png', '2014-09-15 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Zeeland', 'A quiet town near a forest where people are minding their own business in the peaceful silence.<br />\nThere is a road nearby that leads to the forest.', 'assets/img/locations/zeeland.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `currency` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `action_end` int(30) NOT NULL,
  `last_ip` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `location_id` int(11) NOT NULL,
  `rank_id` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `username`, `currency`, `action_id`, `action_end`, `last_ip`, `email`, `password`, `location_id`, `rank_id`, `created`, `updated`, `deleted`) VALUES
(1, 'ISevenSinsI', 469, 2, 9999900, '127.0.0.1', 'Rrreaper@hotmail.com', 'db20854698119ded8a81b70634f908', 1, 1, '2014-09-26 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'xfirenl', 0, 0, 0, '127.0.0.1', '', '275963ee13631dfd2ebc91589d2ade', 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `players_skills`
--

CREATE TABLE IF NOT EXISTS `players_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `players_skills`
--

INSERT INTO `players_skills` (`id`, `player_id`, `skill_id`, `exp`, `level`) VALUES
(1, 1, 1, 2536, 7),
(2, 1, 2, 14330, 17),
(3, 1, 3, 1031, 5),
(4, 1, 4, 3161, 8),
(5, 1, 5, 2647, 7),
(9, 1, 6, 916, 5),
(10, 1, 7, 438, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE IF NOT EXISTS `ranks` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `base_time` int(4) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE IF NOT EXISTS `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `img_path`, `created`, `updated`, `deleted`) VALUES
(1, 'General Store', 'assets/img/buildings/shops/veghel_general_store.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shops_items`
--

CREATE TABLE IF NOT EXISTS `shops_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `buy_price` int(11) NOT NULL,
  `sell_price` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `shops_items`
--

INSERT INTO `shops_items` (`id`, `shop_id`, `item_id`, `buy_price`, `sell_price`, `created`, `updated`, `deleted`) VALUES
(1, 1, 1, 0, 99, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 2, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 3, 0, 99, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 4, 0, 99, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 6, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 8, 0, 99, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 5, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shops_locations`
--

CREATE TABLE IF NOT EXISTS `shops_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shops_locations`
--

INSERT INTO `shops_locations` (`id`, `shop_id`, `location_id`, `created`, `updated`, `deleted`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `created`, `updated`, `deleted`) VALUES
(1, 'Character', '2014-09-25 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Travelling', '2014-09-25 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Luck', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Woodcutting', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Fishing', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Mining', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Cooking', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `travel_scheme`
--

CREATE TABLE IF NOT EXISTS `travel_scheme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_from_id` int(11) NOT NULL,
  `location_to_id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `exp` int(11) NOT NULL,
  `base_time` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `travel_scheme`
--

INSERT INTO `travel_scheme` (`id`, `location_from_id`, `location_to_id`, `img_path`, `exp`, `base_time`, `created`, `updated`, `deleted`) VALUES
(1, 1, 2, 'assets/img/travelling/travel_scheme_1.png', 50, 20, '2014-09-16 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 3, 'b', 70, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
