-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 16, 2023 at 08:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vez_guevi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(76, 63, 69, 'Rhinestone Knee High Boots', 175, 1, 'glittershoeJ2.png'),
(77, 63, 35, 'Sea of Dreams Tee', 47, 1, 'Sega_-_Front_Mockup_TShirt_200x.png'),
(111, 61, 38, 'Mystery Zip Up Hoodie', 15, 1, 'mystery_zipup_front_200x.png');

-- --------------------------------------------------------

--
-- Table structure for table `Cities`
--

CREATE TABLE `Cities` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `country_id` int DEFAULT NULL,
  `state_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Cities`
--

INSERT INTO `Cities` (`id`, `name`, `country_id`, `state_id`) VALUES
(1, 'Moscow', 1, 1),
(2, 'Irkutsk', 1, 2),
(3, 'Angarsk', 1, 2),
(4, 'Bratsk', 1, 2),
(5, 'Krasnoyarsk', 1, 3),
(6, 'Norilsk', 1, 3),
(7, 'Los Angeles', 2, 4),
(8, 'San Francisco', 2, 4),
(9, 'Boston', 2, 6),
(10, 'Springfield', 2, 6),
(11, 'Phoenix', 2, 5),
(12, 'Tucson', 2, 5),
(13, 'Anchorage', 2, 7),
(14, 'Fairbanks', 2, 7),
(15, 'Toronto', 3, 8),
(16, 'Hamilton', 3, 8),
(17, 'Montreal', 3, 10),
(18, 'Quebec City', 3, 10),
(19, 'Calgary', 3, 9),
(20, 'Edmonton', 3, 9),
(21, 'Hokkaido', 4, 11),
(22, 'Okinawa', 4, 12),
(23, 'Kagoshima', 4, 12),
(24, 'Tokyo', 4, 13),
(25, 'Gunma', 4, 13),
(26, 'Kyoto', 4, 14),
(27, 'Osaka', 4, 14);

-- --------------------------------------------------------

--
-- Table structure for table `Countries`
--

CREATE TABLE `Countries` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Countries`
--

INSERT INTO `Countries` (`id`, `name`) VALUES
(1, 'Russia'),
(2, 'USA'),
(3, 'Canada'),
(4, 'Japan');

-- --------------------------------------------------------

--
-- Table structure for table `Methods`
--

CREATE TABLE `Methods` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Methods`
--

INSERT INTO `Methods` (`id`, `name`) VALUES
(1, 'Debit card'),
(2, 'Paypal'),
(3, 'Bitcoin'),
(4, 'Ethereum'),
(5, 'Monero'),
(6, 'Wownero');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(14, 61, 'Daniil Markov', '213124', '2@g.com', '5', 'Address: Marata St. 2 2 1 - 554023', ', Bosozoku Bomber Jacket ( 2 ), Mystery Zip Up Hoodie ( 4 ), Challenger Tank Top ( 1 )', 327, '08-Jan-2023', 'completed'),
(15, 61, 'Daniil Markov', '123442', '2@g.com', '6', 'Address: Marata St. 4-4 22 12 4 - 556304', ', Sea of Dreams Tee ( 1 ), Challenger Tank Top ( 2 )', 133, '08-Jan-2023', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`) VALUES
(34, 'Static Jazz Hawaiian Shirt', 'tops', '\r\n\r\n    SUPER SOFT PREMIUM POLYESTER BLEND.\r\n    MADE BY HAND AND SHIPPED FROM OUR LOS ANGELES STORE.\r\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \r\n\r\n', 67, '2F_200x.png'),
(35, 'Sea of Dreams Tee', 'tops', 'Super soft premium polyester blend.\r\n    Made by hand and shipped from out Los Angeles store.\r\n    Unisex Fit.\r\n    Sublimated artwork never fades or washes out.', 47, 'Sega_-_Front_Mockup_TShirt_200x.png'),
(37, 'Welcome! Sweatshirt', 'tops', '\r\n\r\n    Super soft premium polyester micro-fleece blend. \r\n    Made by hand and shipped from our Los Angeles store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out. \r\n\r\n', 65, 'American_Online_-_Sweatshirt_Front_Mockup_200x.png'),
(38, 'Mystery Zip Up Hoodie', 'tops', '\r\n\r\n    Super soft premium polyester micro-fleece blend. \r\n    Made by hand and shipped from our Los Angeles store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out.\r\n    This is a Mystery Item and will be picked randomly from our inventory.\r\n    Ships immediately \r\n\r\n', 15, 'mystery_zipup_front_200x.png'),
(39, 'Challenger Tank Top', 'tops', '\r\n\r\n    Super soft premium polyester blend. \r\n    Slightly stretchy for a relaxed fit.\r\n    Made by hand and shipped from our Los Angeles store.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 43, 'NewChallengerTankFrontMockup_200x.png'),
(40, 'Bosozoku Bomber Jacket', 'tops', '\r\n\r\n    WATERPROOF SUPER SOFT PREMIUM POLY-FLEECE BLEND.\r\n    MADE BY HAND AND SHIPPED FROM OUR LOS ANGELES STORE.\r\n    UNISEX FIT.\r\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \r\n\r\n', 112, 'Bosozoku-BomberJacketFront_200x.png'),
(42, 'Cloak & Dagger Joggers', 'bottoms', '\r\n\r\n    Super soft premium polyester micro-fleece blend. \r\n    Made by hand and shipped from our Los Angeles store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 75, 'cloakanddagger_200x.png'),
(43, 'Scanset Shorts', 'bottoms', '\r\n\r\n    Super soft polyester microfiber blend. \r\n    Fabric is breathable and complete with pockets.\r\n    Unisex fit\r\n    Made by hand and shipped from our Los Angeles store.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 45, 'Scanset_-_Men_s_Short_Front_200x.png'),
(44, 'Dolphinz Swim Trunks', 'bottoms', '\r\n\r\n    Made of lustrous & durable polyester spandex blend.\r\n    Fabric is water repellent and complete with pockets & mesh stretch liner.\r\n    Made by hand and shipped from our Los Angeles store.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 57, 'dolphinz_trunk_200x.png'),
(45, 'Iridescent Combat Boot', 'bottoms', 'Introducing the Iridescent Combat Boot made by Sparkl Fairy Couture.\r\nThese combat boots are a fun way to upgrade your casual wear. Complete with durable, lightweight rubber sole, and ultra-comfortable cushioned soles. Fairy emblem accents on the laces up the front tie the look together.\r\nThese combat boots are super limited and will sell out!', 165, 'glittershoeF1_200x.png'),
(47, 'Ramen Village Crop Top', 'womens', '\r\n\r\n    SUPER SOFT PREMIUM POLYESTER BLEND.\r\n    MADE BY HAND AND SHIPPED FROM OUR LOS ANGELES STORE.\r\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \r\n\r\n', 45, 'RamenVillage-CropTee_200x.png'),
(48, 'No Control Crop Top', 'womens', '\r\n\r\n    Super soft premium polyester blend.\r\n    Handmade and shipped from our Los Angeles store.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 45, 'Hologram_SigInt_-_Crop_Tee_Mockup_Front_200x.png'),
(49, 'Friendly Neighbor Bucket Hat', 'accessories', '\r\n    OLD SCHOOL MEETS NEW SCHOOL WITH OUR ALL OVER PRINT BUCKET HAT, FEATURING A STITCHED WRAPAROUND BRIM AND FLAT CROWN.\r\n    100% POLYESTER CANVAS.\r\n    SOFT MESH FULL INTERIOR LINING.\r\n    ONE SIZE FITS MOST. \r\n', 50, 'FriendlyNeighbor_5_200x.png'),
(50, 'Oni Face Mask', 'accessories', '\r\n    CREATED WITH MOISTURE WICKING ANTIMICROBIAL MICROPOLY FABRIC AND PRINTED WITH NON TOXIC WATER BASED INK.\r\n    MADE BY HAND AND SHIPPED FROM OUR LOS ANGELES STORE.\r\n    REUSABLE AND MACHINE WASHABLE.\r\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \r\n', 15, 'facemask_samurai_new_front_200x.png'),
(51, 'Access Denied Hat', 'accessories', '\r\n    A custom embroidered 6 - panel dad hat. Made from cotton twill with a curved brim and stitched grommets at the crown. \r\n    Made by hand and shipped from our los angeles store, allow 4-6 weeks manufacturing and delivery time. \r\n    One size fits most. \r\n', 24, 'accessdenied_200x.png'),
(53, 'Trust Me I’m A Dolphin Enamel Pin', 'accessories', '\r\n\r\n    High quality nickel metal and enamel pin.\r\n    Multiple rubber clutch backings.\r\n    Allow 2-4 weeks for delivery.\r\n\r\n', 12, 'trustmeimadolphin_200x.png'),
(54, 'Tubular Beach Towel', 'accessories', '\n\n    MADE BY HAND AND SHIPPED FROM OUR IRKUTSK STORE.\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \n    COMPOSED OF SPUN POLY WITH ABSORBENT COTTON INTERIOR OUR TOWELS ARE 32” x 64”.\n\n', 40, 'Tubular_beach_towels_200x.png'),
(58, 'Strange Lands Tee', 'tops', 'Super soft premium polyester blend.\r\n    Made by hand and shipped from out Irkutsk store.\r\n    Unisex Fit.\r\n    Sublimated artwork never fades or washes out.', 47, 'Strange_Lands.png'),
(59, 'Dream Realm Sweatshirt', 'tops', 'Super soft premium polyester micro-fleece blend. \r\n    Made by hand and shipped from our IRKUTSK store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out.', 65, 'DreamRealm.png'),
(60, 'Kyoto Koi Tank Top', 'tops', 'Super soft premium polyester blend. \r\n    Slightly stretchy for a relaxed fit.\r\n    Made by hand and shipped from our Irkutsk store.\r\n    Sublimated artwork never fades or washes out.', 43, 'Kyoto_Koi_Red_Tank_Front_Mockup.png'),
(61, 'Sailor Saturn Tank Top', 'tops', 'Super soft premium polyester blend. \r\n    Slightly stretchy for a relaxed fit.\r\n    Made by hand and shipped from our IRKUTSK store.\r\n    Sublimated artwork never fades or washes out.', 43, 'Sailor_Saturn_Green.png'),
(62, 'Together At Twilight Tank Top', 'tops', 'Super soft premium polyester blend. \r\n    Slightly stretchy for a relaxed fit.\r\n    Made by hand and shipped from our Irkutsk store.\r\n    Sublimated artwork never fades or washes out.', 43, 'TogetheratTwilight.png'),
(63, 'Supervisual Tank Top', 'tops', 'Super soft premium polyester blend. \r\n    Slightly stretchy for a relaxed fit.\r\n    Made by hand and shipped from our Irkutsk store.\r\n    Sublimated artwork never fades or washes out.', 43, 'Warakami1TankFrontMockup.png'),
(64, 'Mystery Tank Top', 'tops', 'Super soft premium polyester blend.\r\n    Slightly stretchy for a relaxed fit.\r\n    Made by hand and shipped from our Irkutsk store.\r\n    Sublimated artwork never fades or washes out.\r\n    Ships immediately\r\n    This is a Mystery Item and will be chosen randomly from our inventory.', 15, 'mystery_tanktop.png'),
(65, 'Vice Hawaiian Shirt', 'tops', 'Super soft premium polyester blend.\r\n    Handmade and shipped from our Irkutsk store.\r\n    Sublimated artwork never fades or washes out.', 65, 'vice_hawaiianshirt_front.png'),
(66, 'Summer Cruise Bomber Jacket', 'tops', 'Waterproof super soft premium poly-fleece blend.\r\n    Made by hand and shipped from our Irkutsk store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out.', 112, 'MizucatSummer.png'),
(67, 'Purified Joggers', 'bottoms', 'Super soft premium polyester micro-fleece blend. \r\n    Made by hand and shipped from our IRKUTSK store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out.', 75, 'purified.png'),
(68, 'Life On Video Swim Trunks', 'bottoms', 'Made of lustrous &amp; durable polyester spandex blend.\r\n    Fabric is water-repellent and complete with pockets &amp; mesh stretch liner.\r\n    Made by hand and shipped from our IRKUTSK store.\r\n    Sublimated artwork never fades or washes out.', 57, 'vhs_trunk.png'),
(69, 'Rhinestone Knee High Boots', 'bottoms', 'Introducing the Rhinestone knee high boots made by Sparkl Fairy Couture.\r\nAvailable in Mint or Lilac color ways.\r\nThese knee high boots are a comfortable and fun way to add glam to your day. Style with oversized denim or a mini dress for a 90s inspired look. Made with genuine rhinestones, these boots feature a soft and supple faux suede upper making them easy to slip on and off. Complete with durable heel and stable, comfortable soles that offer extra ankle support.', 175, 'glittershoeJ2.png'),
(70, 'Kitsune Face Mask', 'accessories', 'CREATED WITH MOISTURE WICKING ANTIMICROBIAL MICROPOLY FABRIC AND PRINTED WITH NON TOXIC WATER BASED INK.\r\n    MADE BY HAND AND SHIPPED FROM OUR IRKUTSK STORE.\r\n    REUSABLE AND MACHINE WASHABLE.\r\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT.', 15, 'facemask_kitsune.png'),
(71, 'Dream Hat', 'accessories', 'A custom embroidered 6-panel dad hat. Made from cotton twill with a curved brim and stitched grommets at the crown.\r\n    Made by hand and shipped from our IRKUTSK store, allow 4-6 weeks manufacturing and delivery time.\r\n    One size fits most.', 24, 'dream.png'),
(72, 'Done Enamel Pin', 'accessories', 'High quality nickel metal and enamel pin.\r\n    Multiple rubber clutch backings.\r\n    Allow 2-4 weeks for delivery.', 12, 'done.png'),
(73, 'Moodring Crop Top', 'womens', 'Super soft premium polyester blend.\r\nHandmade and shipped from our IRKUTSK store.\r\nSublimated artwork never fades or washes out.', 45, 'Moodring.png'),
(74, 'New Challenger Crop Top', 'womens', 'Super soft premium polyester blend.\r\n    Handmade and shipped from our IRKUTSK store.\r\n    Sublimated artwork never fades or washes out.', 45, 'NewChallenger.png');

-- --------------------------------------------------------

--
-- Table structure for table `States`
--

CREATE TABLE `States` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `country_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `States`
--

INSERT INTO `States` (`id`, `name`, `country_id`) VALUES
(1, 'Moscow Oblast', 1),
(2, 'Irkutsk Oblast', 1),
(3, 'Krasnoyarsk Krai', 1),
(4, 'California', 2),
(5, 'Arizona', 2),
(6, 'Massachusetts', 2),
(7, 'Alaska', 2),
(8, 'Ontario', 3),
(9, 'Alberta', 3),
(10, 'Quebec', 3),
(11, 'Hokkaido', 4),
(12, 'Kyushu', 4),
(13, 'Kanto', 4),
(14, 'Kansai', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(32, 'Admin', 'admin@g.com', 'd47e671b8469246ed5b371c2def18fad', 'user', '8908.png'),
(33, 'Dan', '2@g.com', '339c2226e871cd240f7a03a3e84ba5c6', 'admin', 'Artur3.jpg'),
(34, 'Danik', 'g@g.com', '$2y$10$LcKPHDuUglP5.LPh37I72OzF5pgTI8M9DoUW6ZPx7.xRV78FRM7Vm', 'user', 'Artur10.jpg'),
(35, 'danik', 'f@g.com', '$2y$10$qLRqZ/VXMOAJjhHXgw5VnurgTYiOuyy7WPReN3zUSr70Q9HgSSakq', 'user', 'Artur7.jpg'),
(36, 'Daniik', 'g@c.com', '$2y$10$UdYglbXkjwV2/y4uTNa3.euo8qFC8EKwwqdYxn7sEMwOV9V13uwEK', 'admin', 'Artur.jpg'),
(37, 'daniiru', 'g@d.com', '$2y$10$Cs0ZRTnB8BSM5rzdbYzHquH418fxS.vvg5EwJ./1vHU7.3qRQLIXm', 'user', '8908.png'),
(38, 'danilu', 'f@d.com', '$2y$10$sFfeWv4WKz3f6UaSsJiHKukY91bFs2h1kntKnmIsie4Bx0Lro5lQi', 'user', 'Artur.jpg'),
(39, 'kool', 'R@g.com', '339c2226e871cd240f7a03a3e84ba5c6', 'user', '8908.png'),
(43, 'Dank', '3@g.com', '$2y$10$Z75rxZ4m.VcBV.1ITg7VsO8FcTiKkiZz5/96sn9I7N1qcn/WAn1YS', 'user', 'Artur.jpg'),
(44, 'koki', '4@e.com', '$2y$10$UTP6uFeNWgVo6Bgz7SgUUe/IcZEugvQw6Af5n8rKK/upOLu1J/tBa', 'user', 'Artur5.jpg'),
(45, 'koki1', 'G@h.rom', '339c2226e871cd240f7a03a3e84ba5c6', 'admin', 'Artur.jpg'),
(48, 'Kiloa', 'g@v.xon', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'Artur9.jpg'),
(49, 'Kolav', 'R@v.com', '339c2226e871cd240f7a03a3e84ba5c6', 'admin', 'Carl_Weezer.jpg'),
(50, 'lplc', 'v@r.com', '$2y$10$Y/.t/7G.MV0kAad/ACg8ren4r3JdGU4iSjEtcNKMXQlyxTMDHSmsy', 'user', 'Artur.jpg'),
(51, 'daffc', 'k@b.com', '$2y$10$8xaoy7lzGTKW13ZKrIYlJuD/HF2AR8iniHykLKMi2Oo5Lmdb124gm', 'admin', 'Artur4.jpg'),
(52, 'Koolfa', 'v@ac.com', '$2y$10$BtZH9y8OdWSqz7hExT0bYeGqFBKjPtn4Ws8Zpa3oFgFh7XVGLrL.a', 'user', 'Artur6.jpg'),
(54, 'pik', 'g@a.com', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'Artur9.jpg'),
(55, 'Koki', 'o@b.com', '339c2226e871cd240f7a03a3e84ba5c6', 'admin', 'Artur7.jpg'),
(56, 'kikol', 't@a.com', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'Know-It-All.png'),
(57, 'Danik', 'f#43@f', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'Know-It-All.png'),
(58, '4324', 'qwe@g', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'Artur2.jpg'),
(59, '213', '2@fg.com', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'astrov lvovich..jpg'),
(60, 'Kiki', 'opb@lv.com', 'd47e671b8469246ed5b371c2def18fad', 'user', 'Artur8.jpg'),
(61, 'DAni', '2@4', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'Artur9.jpg'),
(62, 'Kuka', '4@gc.com', '339c2226e871cd240f7a03a3e84ba5c6', 'admin', 'artur9.gif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Cities`
--
ALTER TABLE `Cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Countries`
--
ALTER TABLE `Countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Methods`
--
ALTER TABLE `Methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `States`
--
ALTER TABLE `States`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `Cities`
--
ALTER TABLE `Cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `Countries`
--
ALTER TABLE `Countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Methods`
--
ALTER TABLE `Methods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `States`
--
ALTER TABLE `States`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
