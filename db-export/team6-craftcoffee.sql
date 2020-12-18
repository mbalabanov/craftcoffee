-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2020 at 01:40 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team6-craftcoffee`
--
CREATE DATABASE IF NOT EXISTS `team6-craftcoffee` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `team6-craftcoffee`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `type`, `product_id`, `user_id`, `comment_text`) VALUES
(4, 'Comment', 2, 1, 'And another Comment!'),
(5, 'Comment', 2, 1, 'This is my final comment about this product'),
(6, 'Comment', 1, 1, 'Excelsa was named after Microsoft Excel.'),
(11, 'Comment', 1, 1, 'Test comment'),
(13, 'Comment', 1, 1, 'Hopefully the last test'),
(14, 'Comment', 6, 1, 'I am writing a comment for the Coffee Cup!'),
(15, 'Comment', 5, 1, 'This is a really great coffee mug!'),
(17, 'Comment', 1, 25, 'This is my awesome comment!'),
(18, 'Comment', 2, 25, 'I think I also want to write a comment!'),
(19, 'Comment', 10, 11, 'I like this espresso maker.'),
(20, 'Comment', 13, 11, 'Very tasty chocolate chips.'),
(21, 'Comment', 12, 5, 'This is too sweet for my taste.'),
(22, 'Comment', 12, 4, 'Love this product!'),
(23, 'Comment', 14, 4, 'This tastes great!'),
(24, 'Comment', 6, 4, 'A bit too expensive for me.'),
(26, 'Comment', 9, 4, 'I don\'t think this is worth the money.'),
(27, 'Comment', 5, 26, 'Is the mug half full or half empty?');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_product`
--

CREATE TABLE `ordered_product` (
  `ordered_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shopping_cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordered_product`
--

INSERT INTO `ordered_product` (`ordered_product_id`, `product_id`, `shopping_cart_id`) VALUES
(1, 1, 1),
(2, 12, 1),
(3, 2, 1),
(4, 2, 4),
(5, 12, 4),
(6, 13, 4),
(7, 6, 4),
(8, 9, 4),
(9, 10, 4),
(10, 8, 4),
(11, 13, 4),
(12, 5, 4),
(13, 12, 5),
(14, 13, 5),
(15, 2, 5),
(16, 3, 5),
(17, 5, 5),
(18, 2, 3),
(19, 5, 3),
(20, 12, 3),
(21, 13, 3),
(22, 14, 3),
(23, 2, 6),
(24, 12, 6),
(25, 8, 3),
(26, 12, 3),
(27, 2, 2),
(28, 13, 2),
(29, 12, 3),
(30, 2, 3),
(31, 1, 7),
(32, 10, 3),
(33, 2, 8),
(34, 12, 9),
(35, 2, 10),
(36, 12, 11),
(37, 2, 12),
(38, 12, 12),
(39, 2, 13),
(40, 12, 13),
(41, 2, 14),
(42, 12, 14),
(43, 2, 15),
(44, 13, 15),
(45, 2, 16),
(46, 5, 16),
(47, 5, 17),
(48, 14, 17),
(50, 2, 18),
(51, 13, 13),
(52, 2, 19),
(53, 6, 20),
(54, 12, 20),
(55, 1, 21),
(56, 13, 21),
(57, 2, 22),
(58, 13, 22),
(59, 2, 3),
(60, 11, 23),
(61, 13, 23),
(62, 1, 23),
(63, 4, 24),
(64, 12, 25),
(65, 3, 25),
(66, 9, 25),
(67, 2, 26),
(68, 12, 27),
(69, 13, 27);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `discounted_price` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `quantity_on_stock` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `image`, `description`, `price`, `discounted_price`, `category`, `quantity_on_stock`, `enabled`) VALUES
(1, 'Excelsa 500g', '/assets/img/coffee/coffee-blend1.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 14, 11, 'Coffee', 121, 1),
(2, 'Arabica 500g', '/assets/img/coffee/coffee-blend2.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 15, 12, 'Coffee', 220, 1),
(3, 'Liberica 500g', '/assets/img/coffee/coffee-blend3.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 16, 13, 'Coffee', 102, 1),
(4, 'Maragogype 500g', '/assets/img/coffee/coffee-blend4.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 17, 0, 'Coffee', 88, 1),
(5, 'Coffee Mug', '/assets/img/coffee/coffee-mug.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 3, 2, 'Accessories', 23, 1),
(6, 'Coffee Cup', '/assets/img/coffee/coffee-cup.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 6, 5, 'Accessories', 5, 1),
(7, 'Spoon, Classic Stainless Steel', '/assets/img/coffee/spoon-classic.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 2, 1, 'Accessories', 45, 1),
(8, 'Spoon, Modern Stainless Steel', '/assets/img/coffee/spoon.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 2, 1, 'Accessories', 27, 1),
(9, 'Coffee Pot', '/assets/img/coffee/coffee-pot.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 16, 0, 'Accessories', 7, 1),
(10, 'Espresso Maker', '/assets/img/coffee/espresso-maker.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 23, 0, 'Accessories', 4, 1),
(11, 'Himalaya Sugar 200g', '/assets/img/coffee/sugar.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 2, 0, 'Toppings', 33, 1),
(12, 'Awesome Caramel 200g', '/assets/img/coffee/caramel.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 3, 0, 'Toppings', 6, 1),
(13, 'Chocolate Chips 150g', '/assets/img/coffee/chocolate-chips.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 4, 0, 'Toppings', 17, 1),
(14, 'Cinnamon 150g', '/assets/img/coffee/cinnamon.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 3, 0, 'Toppings', 7, 1),
(15, 'Whipped Cream Concentrate 100ml', '/assets/img/coffee/whipped-cream.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.', 4, 0, 'Toppings', 19, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `shopping_cart_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`shopping_cart_id`, `total_price`, `date`, `status`, `user_id`) VALUES
(1, 14, '2020-12-10 16:16:47', 'pending', 9),
(2, 31, '2020-12-12 19:35:54', 'payment_complete', 3),
(3, 98, '2020-12-02 20:41:40', 'pending', 1),
(4, 18, '2020-12-12 20:01:59', 'pending', 16),
(5, 34, '2020-12-12 20:13:39', 'pending', 21),
(6, 18, '2020-12-13 15:11:39', 'pending', 22),
(7, 14, '2020-12-14 13:24:24', 'pending', 4),
(8, 15, '2020-12-14 15:38:18', 'pending', 11),
(9, 3, '2020-12-14 17:48:00', 'payment_complete', 3),
(10, 15, '2020-12-15 09:37:06', 'payment_complete', 3),
(11, 3, '2020-12-15 09:50:57', 'payment_complete', 3),
(12, 15, '2020-12-15 10:36:24', 'payment_complete', 3),
(13, 19, '2020-12-15 11:06:34', 'payment_complete', 3),
(14, 15, '2020-12-15 11:09:22', 'payment_complete', 25),
(15, 16, '2020-12-15 11:10:59', 'payment_complete', 25),
(16, 14, '2020-12-15 11:12:26', 'payment_complete', 25),
(17, 5, '2020-12-15 11:14:45', 'payment_complete', 25),
(18, 24, '2020-12-15 11:29:36', 'payment_complete', 25),
(19, 12, '2020-12-15 15:46:57', 'payment_complete', 3),
(20, 8, '2020-12-15 15:47:14', 'payment_complete', 3),
(21, 15, '2020-12-15 16:52:29', 'payment_complete', 25),
(22, 16, '2020-12-15 20:56:52', 'payment_complete', 3),
(23, 17, '2020-12-16 13:54:15', 'payment_complete', 25),
(24, 17, '2020-12-16 13:59:53', 'payment_complete', 25),
(25, 32, '2020-12-16 14:40:08', 'pending', 25),
(26, 12, '2020-12-17 00:44:59', 'pending', 3),
(27, 7, '2020-12-17 00:57:39', 'payment_complete', 26);

-- --------------------------------------------------------

--
-- Table structure for table `special_offers`
--

CREATE TABLE `special_offers` (
  `special_offer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `special_offers`
--

INSERT INTO `special_offers` (`special_offer_id`, `name`, `image`, `product_id`) VALUES
(2, 'Donec pede justo, fringilla vel', 'assets/img/coffee/promo1.jpg', 2),
(3, 'In enim justo, rhoncus ut', 'assets/img/coffee/promo2.jpg', 11),
(4, 'Nullam dictum felis eu pede', 'assets/img/coffee/promo3.jpg', 1),
(5, 'Aenean vulputate eleifend tellus', 'assets/img/coffee/promo4.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `streetaddress` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `image`, `email`, `password`, `roles`, `enabled`, `payment_type`, `streetaddress`, `postalcode`, `city`, `country`) VALUES
(1, 'Max', 'Mustermann', '/assets/img/users/user1.png', 'user@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$UFBBRERsUlRaVENteWJETg$rgXvVVmtQ9oPZigGNUfAdqLUiOtepn0sYkiqntfSOQE', '[\"ROLE_ADMIN\"]', 1, 'Paypal', 'Test Str. 123', '1234', 'Vienna', 'Austria'),
(2, 'Jane', 'Doe', '/assets/img/users/user2.png', 'jane@doe.com', '$argon2id$v=19$m=65536,t=4,p=1$WUFMUnpYdmpGVU5aSjNtVg$+PmQzqyrJBHZqUIV7kBgnpBbJT6wYPnGo9dFrRNbym0', '[\"ROLE_ADMIN\"]', 1, 'VISA', 'Test Str. 123', '1234', 'Berlin', 'Germany'),
(3, 'Jennifer', 'Lopez', '/assets/img/users/user3.png', 'jennifer.lopez@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$U3QzWkZnTkcvZk1pa1JvNw$KipydiY4k6mcA11rr7YUmlyNmuo85JR7rgI989SB6Lg', '[\"ROLE_ADMIN\"]', 1, 'Paypal', 'Test Str. 123/1', '1234', 'Düsseldorf', 'Germany'),
(4, 'John', 'Turturo', '/assets/img/users/user4.png', 'john@turturo.com', '$argon2id$v=19$m=65536,t=4,p=1$MUZ3ZUJEM2haajlkMEJDLw$XbyXK3e4+FDRGMtrENG8IAhsFFPxxxQkJQZogKLv0Ro', '[]', 1, 'VISA', 'Test Str. 123', '1234', 'Graz', 'Austria'),
(5, 'Ben', 'Affleck', '/assets/img/users/user5.png', 'ben@affleck.com', '$argon2id$v=19$m=65536,t=4,p=1$WXV5YXRzMnpTT3VDY1FBNQ$77HQT/y09HIwL9s3zyGq8RVgpBMtuU6rE5/eN87jy5Q', '[]', 1, 'Paypal', 'Test Str. 12', '1234', 'Düsseldorf', 'Germany'),
(6, 'Sylvia', 'Gitubodomeiner', '/assets/img/users/user5.png', 'sylvia.gitubodomeiner76@outloock.de', '$argon2id$v=19$m=65536,t=4,p=1$OXRCcmV3b3dVazJrN0ZvZA$3yhmXBu/Zazxhz3tcRiFXVc1rfdUWU7MdCd91v1rNLM', '[]', 1, 'Paypal', 'Blumenstrasse 136', '94032', 'Passau', 'Germany'),
(7, 'Sophia', 'Braun', '/assets/img/users/user3.png', 'sophia.braun73@gmx.de', '$argon2id$v=19$m=65536,t=4,p=1$eFNtUVB1M2J0ZlJyYXdGbA$Suakon/WiP1icA4Uu29zNtVhPtQg0hfEKnpAETMlUFU', '[]', 1, 'VISA', 'Jägerstrasse 115', '55435', 'Gau-Algesheim', 'Germany'),
(8, 'Nicolas', 'Zosahede', '/assets/img/users/user1.png', 'udepo81@gmail.de', '$argon2id$v=19$m=65536,t=4,p=1$ZEhKYmFqMlQvQi9xbU1UVA$XPLOrIh7juLa++Pkjh1v15LioxhPNyE4m9BYFy1yjdE', '[]', 1, 'Paypal', 'Siedlung 162', '38723', 'Seesen', 'Germany'),
(9, 'Krystyna', 'Hevelaumeiner', '/assets/img/users/user2.png', 'etizu69@surfnet.de', '$argon2id$v=19$m=65536,t=4,p=1$ZGZKbGtOUGdneUZlMGRJQQ$aMXwQh1WzCD8V8nzARuphkp4AJQNwwktl/89sfaYFz8', '[]', 1, 'Paypal', 'Fasanenweg 101', '88239', 'Wangen im Allgäu', 'Germany'),
(10, 'Hans-Ludwig', 'Ralofoweiner', '/assets/img/users/user3.png', 'hans-ludwig.ralofoweiner67@email.com', '$argon2id$v=19$m=65536,t=4,p=1$eTF2UHV6eFlZQWtXa0EvaQ$BEO/QJqssnSRFmZt9mc1l8Dp1Efv9Iv8tlanQjHZ6xU', '[]', 1, 'VISA', 'Siedlung 134', '91413', 'Neustadt a.d.Aisch', 'Germany'),
(11, 'Zbigniew', 'Wavusegestein', '/assets/img/users/user2.png', 'oroli92@t-online.de', '$argon2id$v=19$m=65536,t=4,p=1$alhCdllVUEUxbmRtTUIzdw$tuW2EBi6Yz33zWNgVT2L26LgR/QkUCs2knQpD+U4dAE', '[]', 1, 'VISA', 'Schulweg 267', '04720', 'Döbeln', 'Germany'),
(12, 'Birthe', 'Viwalodemeiner', '/assets/img/users/user3.png', 'birthe.viwalodemeiner82@test.de', '$argon2id$v=19$m=65536,t=4,p=1$UlBpWkQ5L1VXUk9YRnJvRA$Inj9mVdBkuS6dYauJfrxae6/4nn8kRElyMKPIugdNQo', '[]', 0, 'VISA', 'Kastanienweg 35', '54338', 'Schweich', 'Germany'),
(13, 'Olivia', 'Lehmann', '/assets/img/users/user2.png', 'otaze68@email.com', '$argon2id$v=19$m=65536,t=4,p=1$ejJhbTBhUUpwMTJSV1Z2NQ$YvrQbrxZoVY+bQeHDcSEhYz/p3IjXQDofJXzBFXbCOA', '[]', 0, 'Paypal', 'Markt 245', '52499', 'Baesweiler', 'Germany'),
(14, 'Miguel', 'Zälivodemüller', '/assets/img/users/user2.png', 'miguel.zaelivodemueller74@test.de', '$argon2id$v=19$m=65536,t=4,p=1$UHhsQndveVdOQW96dWRUZQ$JvHgy8pUv/rfU0opJpPadk9BWbFy1DDnTOglh+O3/zY', '[]', 0, 'VISA', 'Hohe Strasse 233', '23812', 'Wahlstedt', 'Germany'),
(15, 'Markus', 'Cidaflodeson', '/assets/img/users/user4.png', 'etome63@outloock.de', '$argon2id$v=19$m=65536,t=4,p=1$aS9Sem1RRTJTMDNqMzJZSg$k47Aon554KrwtwB/WNe90TnbI2t9qryMU5KgXXGnxOQ', '[]', 0, 'Paypal', 'Blumenstrasse 39', '48143', 'Münster', 'Germany'),
(16, 'Ante', 'Javuduweiner', '/assets/img/users/user2.png', 'ante.javuduweiner94@gmail.de', '$argon2id$v=19$m=65536,t=4,p=1$RzJKcU15bmxlRWc1eXl0Mw$NRindAch8TRuwnAS1haHNsq/soT8N6FcTNurWzRemGc', '[]', 0, 'VISA', 'Daimlerstrasse 252', '04916', 'Schönewalde', 'Germany'),
(17, 'Flora', 'Güvumattweiner', '/assets/img/users/user2.png', 'flora.guevumattweiner62@email.com', '$argon2id$v=19$m=65536,t=4,p=1$QmExLlZ4Mk5mY0pPRUJRSg$uylII93OWTN42JbSo3riUFaKT4eKi6EpzIj6P/74QJw', '[]', 0, 'VISA', 'Teichstrasse 142', '79215', 'Elzach', 'Germany'),
(18, 'Hüseyin', 'Disufuweiner', '/assets/img/users/user2.png', 'hueseyin.disufuweiner90@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$WTBWdy50cUtucXFKcUJWTw$/RtpLRw9XTqNHwOf8C2NALNCWu8/kapZqIPCH40hVcU', '[]', 0, 'Paypal', 'Teichstrasse 63', '49610', 'Quakenbrück', 'Germany'),
(19, 'Gotthold', 'Vovolateson', '/assets/img/users/user2.png', 'arula82@email.com', '$argon2id$v=19$m=65536,t=4,p=1$U04xQ1hIdk8ucmtyTVFoMw$gv9dgfN1kqpndJQ2+rVgNL2ZGtjfmJIX/O5vSNZG1yw', '[]', 0, 'Paypal', 'Wiesenweg 149', '78120', 'Furtwangen im Schwarzwald', 'Germany'),
(20, 'Heinz-Georg', 'Sotebistein', '/assets/img/users/user4.png', '/assets/img/users/user2.png', '$argon2id$v=19$m=65536,t=4,p=1$SS9WeHo4TGdMemNvcC9LWQ$HlDONxcWxyLubtJzsKAFNZXPtIvpHuz+TZMjYllqVws', '[]', 0, 'VISA', 'Mühlstrasse 193c', '52511', 'Geilenkirchen', 'Germany'),
(21, 'Geraldine', 'Cedowadeweiner', '/assets/img/users/user2.png', 'utami55@outloock.de', '$argon2id$v=19$m=65536,t=4,p=1$T1hmVkc0TjNlYW0vbEVzTg$9oX1YuGKaywKeM+CffZDxnKHLk/pwDpDbOPrkTiHhoQ', '[]', 1, 'Paypal', 'Neuer Weg 23', '88416', 'Ochsenhausen', 'Germany'),
(22, 'Test', 'User', '/assets/img/users/user3.png', 'testuser123@domain.com', '$argon2id$v=19$m=65536,t=4,p=1$WWthY1VteHFpRDZTQ0JSOA$qQZN5+1U6NuxnFHVuKvaaR5yaI5p4JvUjkCjuuxHNLE', '[]', 1, NULL, 'Mariahilfer Straße 1', '1234', 'Vienna', 'Austria'),
(23, 'TestUSer', 'TestUser', '/assets/img/users/user3.png', 'testuser@testuser123.com', '$argon2id$v=19$m=65536,t=4,p=1$VGVJanpRWUkvdHFVWEwxbQ$JQ9srw5hSDzWGgXYzzs11ahdI5MWakNBmWD3MDoty0k', '[]', 1, NULL, 'Test Str. 23', '1234', 'Wien', 'Austria'),
(24, 'New User', 'User 123', '/assets/img/users/user3.png', 'newuser@user123.com', '$argon2id$v=19$m=65536,t=4,p=1$aUVlNXROSHBLaWRWTVhtMA$EjkR/Nhq/OYZDNoelzWRdleOMIMkuDYf6bBY7p5AGV4', '[\"ROLE_ADMIN\"]', 1, NULL, 'Test Str. 23', '1234', 'Wien', 'Austria'),
(25, 'Test', 'User', '/assets/img/users/user4.png', 'marincomics@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$aUVlNXROSHBLaWRWTVhtMA$EjkR/Nhq/OYZDNoelzWRdleOMIMkuDYf6bBY7p5AGV4', '[]', 1, 'Visa', 'Dresdnerstr. 78/16', '1200', 'Vienna', 'Austria'),
(26, 'Code', 'Factory', '/assets/img/users/user3.png', 'code@ptstest.com', '$argon2id$v=19$m=65536,t=4,p=1$OGo3UFBYVnpKRFFuaGQwMQ$xDmkyFVPnAlQs4qoV5FACOCTLYNRjP2lHEVwhuybYro', '[\"ROLE_USER\"]', 1, 'VISA', 'Factory Street 1', '1234', 'Code City', 'Austria');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `User Relationship` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `ordered_product`
--
ALTER TABLE `ordered_product`
  ADD PRIMARY KEY (`ordered_product_id`),
  ADD KEY `Product Relationship` (`product_id`),
  ADD KEY `Shopping Cart Relationship` (`shopping_cart_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`shopping_cart_id`),
  ADD KEY `User-Cart Relationship` (`user_id`);

--
-- Indexes for table `special_offers`
--
ALTER TABLE `special_offers`
  ADD PRIMARY KEY (`special_offer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ordered_product`
--
ALTER TABLE `ordered_product`
  MODIFY `ordered_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `shopping_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `special_offers`
--
ALTER TABLE `special_offers`
  MODIFY `special_offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `User Relationship` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `ordered_product`
--
ALTER TABLE `ordered_product`
  ADD CONSTRAINT `Product Relationship` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `Shopping Cart Relationship` FOREIGN KEY (`shopping_cart_id`) REFERENCES `shopping_cart` (`shopping_cart_id`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `User-Cart Relationship` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `special_offers`
--
ALTER TABLE `special_offers`
  ADD CONSTRAINT `special_offers_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
