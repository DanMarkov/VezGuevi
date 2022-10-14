-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 14, 2022 at 11:51 AM
-- Server version: 8.0.29
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
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
  `quantity` int NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(53, 39, 30, 'VaporTEK Top', 35, 1, 'Yogasetmockuptopfront_200x.png'),
(54, 39, 52, 'Shiba Quest Phone Case', 36, 1, 'shiba_200x.png');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(30, 'VaporTEK Top', 'tops', ' YOU DIDN\'T GET NOMINATED FOR \"FLEET CAPTAIN\" FOR NO REASON YOU KNOW!\r\nVaporTEK IS THE NEWEST TECHNOLOGY FOR AESTHETIC SPORTS WEAR.\r\nSUPER SOFT COTTON WITH PREMIUM EMBROIDERY, ADJUSTABLE STRAPS AND SILICON LABEL!', 35, 'Yogasetmockuptopfront_200x.png'),
(31, 'Pure Juice Tee', 'tops', '\r\n    Premium 100% Cotton tee printed with water based, eco-friendly ink.\r\n    Made by hand and shipped from our Los Angeles store.\r\n    Unisex fit.\r\n    Model is wearing a size medium.\r\n', 36, 'purejuice_wht_200x.png'),
(32, 'V64 Long Sleeve Tee', 'tops', ' Premium 100% cotton long sleeve tee printed with water-based, eco-friendly inks.\r\nMade by hand and shipped from our Los Angeles store.\r\nUnisex\r\nModel is wearing a size medium.', 52, 'V64_front_wht_200x.png'),
(33, 'Yokai Sweatshirt', 'tops', '\r\n    Premium 100% cotton printed with water based, eco-friendly inks.\r\n    Made by hand and shipped from our Los Angeles store.\r\n    Unisex fit.\r\n    Prewashed to minimize shrinkage.\r\n    Model is wearing size medium.\r\n', 47, 'YokaiblackSweatshirtMan-product-mockup_200x.png'),
(34, 'Static Jazz Hawaiian Shirt', 'tops', '\r\n\r\n    SUPER SOFT PREMIUM POLYESTER BLEND.\r\n    MADE BY HAND AND SHIPPED FROM OUR LOS ANGELES STORE.\r\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \r\n\r\n', 67, '2F_200x.png'),
(35, 'Sea of Dreams Tee', 'tops', '\r\n    Super soft premium polyester blend.\r\n    Made by hand and shipped from out Los Angeles store.\r\n    Unisex Fit.\r\n    Sublimated artwork never fades or washes out.\r\n', 47, 'Sega_-_Front_Mockup_TShirt_200x.png'),
(36, 'Full Bloom Hoodie', 'tops', '\r\n\r\n    Super soft premium polyester micro-fleece blend. \r\n    Made by hand and shipped from our Los Angeles store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 75, 'fullbloom_front_mockup_200x.png'),
(37, 'Welcome! Sweatshirt', 'tops', '\r\n\r\n    Super soft premium polyester micro-fleece blend. \r\n    Made by hand and shipped from our Los Angeles store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out. \r\n\r\n', 65, 'American_Online_-_Sweatshirt_Front_Mockup_200x.png'),
(38, 'Mystery Zip Up Hoodie', 'tops', '\r\n\r\n    Super soft premium polyester micro-fleece blend. \r\n    Made by hand and shipped from our Los Angeles store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out.\r\n    This is a Mystery Item and will be picked randomly from our inventory.\r\n    Ships immediately \r\n\r\n', 15, 'mystery_zipup_front_200x.png'),
(39, 'Challenger Tank Top', 'tops', '\r\n\r\n    Super soft premium polyester blend. \r\n    Slightly stretchy for a relaxed fit.\r\n    Made by hand and shipped from our Los Angeles store.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 43, 'NewChallengerTankFrontMockup_200x.png'),
(40, 'Bosozoku Bomber Jacket', 'tops', '\r\n\r\n    WATERPROOF SUPER SOFT PREMIUM POLY-FLEECE BLEND.\r\n    MADE BY HAND AND SHIPPED FROM OUR LOS ANGELES STORE.\r\n    UNISEX FIT.\r\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \r\n\r\n', 112, 'Bosozoku-BomberJacketFront_200x.png'),
(41, 'VaporTEK Shorts', 'bottoms', ' YOU DIDN\'T GET NOMINATED FOR \"FLEET CAPTAIN\" FOR NO REASON YOU KNOW!\r\nVaporTEK IS THE NEWEST TECHNOLOGY FOR AESTHETIC SPORTS WEAR.\r\nSUPER SOFT COTTON WITH PREMIUM EMBROIDERY AND SILICON LABEL!', 35, 'Yogasetmockupbottomfront_200x.png'),
(42, 'Cloak & Dagger Joggers', 'bottoms', '\r\n\r\n    Super soft premium polyester micro-fleece blend. \r\n    Made by hand and shipped from our Los Angeles store.\r\n    Unisex fit.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 75, 'cloakanddagger_200x.png'),
(43, 'Scanset Shorts', 'bottoms', '\r\n\r\n    Super soft polyester microfiber blend. \r\n    Fabric is breathable and complete with pockets.\r\n    Unisex fit\r\n    Made by hand and shipped from our Los Angeles store.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 45, 'Scanset_-_Men_s_Short_Front_200x.png'),
(44, 'Dolphinz Swim Trunks', 'bottoms', '\r\n\r\n    Made of lustrous & durable polyester spandex blend.\r\n    Fabric is water repellent and complete with pockets & mesh stretch liner.\r\n    Made by hand and shipped from our Los Angeles store.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 57, 'dolphinz_trunk_200x.png'),
(45, 'Iridescent Combat Boot', 'bottoms', 'Introducing the Iridescent Combat Boot made by Sparkl Fairy Couture.\r\nThese combat boots are a fun way to upgrade your casual wear. Complete with durable, lightweight rubber sole, and ultra-comfortable cushioned soles. Fairy emblem accents on the laces up the front tie the look together.\r\nThese combat boots are super limited and will sell out!', 165, 'glittershoeF1_200x.png'),
(46, 'VaporTEK Set', 'womens', '\r\n    YOU DIDN\'T GET NOMINATED FOR \"FLEET CAPTAIN\" FOR NO REASON YOU KNOW!\r\n    VaporTEK IS THE NEWEST TECHNOLOGY FOR AESTHETIC SPORTS WEAR.\r\n    SUPER SOFT COTTON WITH PREMIUM EMBROIDERY, ADJUSTABLE STRAPS AND SILICON LABEL!\r\n    GET THIS VAPORTEK SET AS A BUNDLE FOR A DISCOUNT ON THE TOP AND BOTTOM.\r\n', 60, 'VaporTek-mockup1_200x.png'),
(47, 'Ramen Village Crop Top', 'womens', '\r\n\r\n    SUPER SOFT PREMIUM POLYESTER BLEND.\r\n    MADE BY HAND AND SHIPPED FROM OUR LOS ANGELES STORE.\r\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \r\n\r\n', 45, 'RamenVillage-CropTee_200x.png'),
(48, 'No Control Crop Top', 'womens', '\r\n\r\n    Super soft premium polyester blend.\r\n    Handmade and shipped from our Los Angeles store.\r\n    Sublimated artwork never fades or washes out.\r\n\r\n', 45, 'Hologram_SigInt_-_Crop_Tee_Mockup_Front_200x.png'),
(49, 'Friendly Neighbor Bucket Hat', 'accessories', '\r\n    OLD SCHOOL MEETS NEW SCHOOL WITH OUR ALL OVER PRINT BUCKET HAT, FEATURING A STITCHED WRAPAROUND BRIM AND FLAT CROWN.\r\n    100% POLYESTER CANVAS.\r\n    SOFT MESH FULL INTERIOR LINING.\r\n    ONE SIZE FITS MOST. \r\n', 50, 'FriendlyNeighbor_5_200x.png'),
(50, 'Oni Face Mask', 'accessories', '\r\n    CREATED WITH MOISTURE WICKING ANTIMICROBIAL MICROPOLY FABRIC AND PRINTED WITH NON TOXIC WATER BASED INK.\r\n    MADE BY HAND AND SHIPPED FROM OUR LOS ANGELES STORE.\r\n    REUSABLE AND MACHINE WASHABLE.\r\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \r\n', 15, 'facemask_samurai_new_front_200x.png'),
(51, 'Access Denied Hat', 'accessories', '\r\n    A custom embroidered 6 - panel dad hat. Made from cotton twill with a curved brim and stitched grommets at the crown. \r\n    Made by hand and shipped from our los angeles store, allow 4-6 weeks manufacturing and delivery time. \r\n    One size fits most. \r\n', 24, 'accessdenied_200x.png'),
(52, 'Shiba Quest Phone Case', 'accessories', ' Full wrap 3D process, extending around the 3D surface of the case - including sides, edges and corners.\r\nOur sophisticated process embeds images into the plastic surface of the case, and protects them with a strong clear finish - the result is an image that is not on the case, but inside it, and protected from scratches, fading, wear and damage. The products are built to protect the device and the beauty of the images, and to last.', 36, 'shiba_200x.png'),
(53, 'Trust Me I’m A Dolphin Enamel Pin', 'accessories', '\r\n\r\n    High quality nickel metal and enamel pin.\r\n    Multiple rubber clutch backings.\r\n    Allow 2-4 weeks for delivery.\r\n\r\n', 12, 'trustmeimadolphin_200x.png'),
(54, 'Tubular Beach Towel', 'accessories', '\n\n    MADE BY HAND AND SHIPPED FROM OUR IRKUTSK STORE.\n    SUBLIMATED ARTWORK NEVER FADES OR WASHES OUT. \n    COMPOSED OF SPUN POLY WITH ABSORBENT COTTON INTERIOR OUR TOWELS ARE 32” x 64”.\n\n', 40, 'Tubular_beach_towels_200x.png');

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
(31, 'Danii', 'D@g.com', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'Artur2.jpg'),
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
(48, 'Kiloa', 'g@v.xon', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'Artur8.jpg'),
(49, 'Kolav', 'R@v.com', '339c2226e871cd240f7a03a3e84ba5c6', 'user', 'Artur.jpg'),
(50, 'lplc', 'v@r.com', '$2y$10$Y/.t/7G.MV0kAad/ACg8ren4r3JdGU4iSjEtcNKMXQlyxTMDHSmsy', 'user', 'Artur.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
