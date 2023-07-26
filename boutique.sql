-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 avr. 2023 à 13:22
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(1, 'Accessory'),
(2, 'Best Sellers'),
(3, 'Bottoms'),
(4, 'Coat'),
(5, 'Dress'),
(6, 'Loungewear'),
(7, 'New Collection'),
(8, 'Promotion'),
(9, 'Sportswear'),
(10, 'Suits'),
(11, 'Tops');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) DEFAULT NULL,
  `comment` text,
  `date` datetime(6) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_product` (`id_product`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `subject`, `comment`, `date`, `id_product`, `id_user`) VALUES
(5, 'Good mantra ', 'In code we trust!', '2023-04-24 14:53:13.000000', 0, 6);

-- --------------------------------------------------------

--
-- Structure de la table `detail`
--

DROP TABLE IF EXISTS `detail`;
CREATE TABLE IF NOT EXISTS `detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_order` (`id_order`),
  KEY `id_product` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `detail`
--

INSERT INTO `detail` (`id_detail`, `id_order`, `id_product`, `total`, `quantity`, `size`) VALUES
(8, 6, 1, 110, 1, 'L'),
(9, 6, 2, 135, 1, 'L'),
(10, 7, 12, 80, 1, 'L'),
(11, 8, 3, 90, 1, 'L');

-- --------------------------------------------------------

--
-- Structure de la table `link_categ`
--

DROP TABLE IF EXISTS `link_categ`;
CREATE TABLE IF NOT EXISTS `link_categ` (
  `id_linkCateg` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_categ` int(11) NOT NULL,
  PRIMARY KEY (`id_linkCateg`),
  KEY `id_categ` (`id_categ`),
  KEY `id_product` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `link_categ`
--

INSERT INTO `link_categ` (`id_linkCateg`, `id_product`, `id_categ`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 5),
(4, 4, 11),
(5, 5, 10),
(6, 6, 10),
(7, 7, 10),
(8, 8, 5),
(9, 9, 3),
(10, 10, 10),
(11, 11, 5),
(12, 12, 1),
(13, 13, 1),
(14, 14, 11),
(15, 15, 5),
(16, 16, 1),
(17, 17, 4),
(18, 18, 5),
(19, 19, 5),
(20, 20, 5),
(21, 21, 6),
(22, 22, 6),
(23, 23, 9),
(24, 24, 10),
(25, 25, 10),
(26, 26, 10),
(27, 27, 10),
(28, 28, 11),
(30, 30, 11),
(31, 31, 11),
(32, 32, 1),
(33, 33, 4),
(34, 34, 4),
(35, 35, 1),
(36, 36, 1),
(37, 37, 9),
(38, 1, 10),
(39, 3, 2),
(40, 14, 2),
(41, 18, 2),
(42, 19, 2),
(43, 33, 2),
(44, 35, 2),
(45, 3, 7),
(46, 6, 7),
(47, 8, 7),
(48, 10, 7),
(49, 12, 7),
(50, 15, 7),
(51, 19, 7),
(52, 20, 7),
(53, 21, 7),
(54, 22, 7),
(55, 25, 7),
(56, 29, 7),
(57, 33, 7),
(58, 38, 7),
(59, 2, 8),
(60, 4, 8),
(61, 10, 8),
(62, 17, 8),
(63, 28, 8),
(64, 34, 8);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_1` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `best_sellers` tinyint(1) NOT NULL DEFAULT '0',
  `new_collection` tinyint(1) NOT NULL DEFAULT '0',
  `promotion` tinyint(1) NOT NULL DEFAULT '0',
  `promotion_percentage` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id_product`, `title`, `description`, `image`, `image_1`, `image_2`, `price`, `best_sellers`, `new_collection`, `promotion`, `promotion_percentage`) VALUES
(1, 'Black suit', 'Black suit', 'suit_03.jpg', 'suit_03a.jpg', 'suit_03b.jpg', 11000, 1, 0, 0, NULL),
(2, 'Pants with pleats', 'Wide pants with pleats, navy blue\r\n2 front pockets and 2 fake back pockets', 'pant_01.jpeg', 'pant_01a.jpeg', 'pant_01b.jpeg', 13500, 0, 0, 1, 75),
(3, 'Powdery pink dress', 'Powdery pink dress.\r\nSoft and light for summer time\r\nv-neck, fitted waist, Silk fabric', 'dress_03.jpg', '', '', 9000, 1, 1, 0, NULL),
(4, 'Ivory sweater', 'Ivory cashmere sweater', 'sweater_03.jpg', 'sweater_03a.jpg', 'sweater_03b.jpg', 8600, 0, 0, 1, 50),
(5, 'Intense Red suit', 'Red suit, double-breasted, jacket slim pants', 'suit_01.jpg', 'suit_01a.jpg', '', 15000, 0, 0, 0, NULL),
(6, 'Pink spring suit', 'Light pink suit', 'suit_06.jpg', 'suit_06a.jpg', '', 15000, 0, 1, 0, NULL),
(7, 'Satin suit', 'Brown satin summer suit', 'suit_07.jpg', '', '', 8000, 0, 1, 0, NULL),
(8, 'White dress', 'White spring dress', 'dress_06.jpg', 'dress_06a.jpg', '', 11000, 0, 1, 0, NULL),
(9, 'White slim pants', 'White slim & strech pants', 'pants_04.jpg', 'pants_04a.jpg', 'pants_04b.jpg', 4500, 0, 0, 0, NULL),
(10, 'Suit camel', 'Suit camel', 'suit_04.jpg', 'suit_04a.jpg', '', 12000, 0, 1, 1, 20),
(11, 'Cocktail dress', 'Green cocktail dress', 'dress_08.jpg', 'dress_08a.jpg', 'dress_08b.jpg', 7500, 0, 0, 0, NULL),
(12, 'Sun glasses', 'Sun glasses', 'glasses_01.jpg', '', '', 8000, 0, 1, 0, NULL),
(13, 'I. kredenets Bag', 'Leather bag Irene Kredenets 30x42, made of crossed straps, chain handle\r\n', 'bag_01.jpg', '', '', 21000, 0, 0, 0, NULL),
(14, 'Sweater oversize', 'White oversize hooded sweater', 'sweater_02.jpg', 'sweater_02a.jpg', '', 7500, 1, 0, 0, NULL),
(15, 'Mustard dress mini', 'Mustard corded dress mini, 3 buttons front', 'dress_05.jpg', '', '', 6000, 0, 1, 0, NULL),
(16, 'Pink backpack ', 'faux leather pink backpack', 'bag_02.jpg', '', '', 16200, 0, 0, 0, NULL),
(17, 'White wool coat', 'White wool coat, 2 side pockets, trench cut with belt', 'coat_01.jpg', 'coat_01a.jpg', '', 12000, 0, 0, 1, 20),
(18, 'Straight dress', 'Red thin ribbed below knee length bodycon dress', 'dress_02.jpg', '', '', 6600, 1, 0, 0, NULL),
(19, 'Mini dress', 'Mini dress, light cotton triangle bustier', 'dress_01.jpg', '', '', 4500, 1, 1, 0, NULL),
(20, 'Satin dress', 'Satin dress, printed with small yellow flowers, bow bustier and side slit', 'dress_04.jpg', 'dress_04a.jpg', '', 11200, 0, 1, 0, NULL),
(21, 'Green relaxation set', 'strapless loungewear and cropped pants', 'loungewear_01.jpg', 'loungewear_01a.jpg', '', 6000, 0, 1, 0, NULL),
(22, 'satin sleepwear set', 'Pink satin sleepwear set. Top and short', 'loungewear_02.jpg', 'loungewear_02a.jpg', '', 5500, 0, 1, 0, NULL),
(23, 'Nike set', 'Nike pink sportswear set', 'sportswear_03.jpg', 'sportswear_03a.jpg', '', 9000, 0, 0, 0, NULL),
(24, 'Yellow suit ', 'Yellow suit', 'suit_02.jpg', 'suit_02a.jpg', 'suit_02b.jpg', 12000, 0, 0, 0, NULL),
(25, 'Sky blue suit', 'Sky blue suit without collar, 2 side pockets, a hook closure ', 'suit_05.jpg', 'suit_05a.jpg', 'suit_05b.jpg', 13500, 0, 1, 0, NULL),
(26, 'Grey loose suit', 'Grey loose boyfriend suit', 'suit_08.jpg', 'suit_08a.jpg', 'suit_08b.jpg', 13500, 0, 0, 0, NULL),
(27, 'Red shorts suit', 'Red shorts suit, smocking cut', 'suit_09.jpg', 'suit_09a.jpg', 'suit_09b.jpg', 13500, 0, 0, 0, NULL),
(28, 'Blue sweater', 'Blue cashmere turtleneck sweater', 'sweater_01.jpg', 'sweater_01a.jpg', '', 6200, 0, 0, 1, 30),
(29, 'Glossy brown top', 'glossy brown top. Backless', 'top_01.jpg', 'top_01a.jpg', 'top_01b.jpg', 7500, 0, 1, 0, NULL),
(30, 'T-shirt/shorts set', 'Oversized cotton shirt and shorts set', 'shirt_01.jpg', '', '', 5900, 0, 0, 0, NULL),
(31, 'Black cotton t-shirt', 'Black cotton t-shirt', 'tshirt_02.jpg', 'tshirt_02a.jpg', 'tshirt_02b.jpg', 2900, 0, 0, 0, NULL),
(32, 'M&M watch', 'M&M watch white strap and gold metal', 'watch_01.jpg', '', '', 22600, 0, 0, 0, NULL),
(33, 'Safari jacket', 'Belted safari jacket', 'coat_03.jpg', 'coat_03a.jpg', '', 8300, 1, 1, 0, NULL),
(34, 'Short jacket', 'Short pink/black/grey speckled jacket, 3 buttons', 'jacket_02.jpg', 'jacket_02a.jpg', '', 8000, 0, 0, 1, 50),
(35, 'Purse Sarel', 'Imitation crocodile red handbag from Sarel', 'purse_02.jpg', '', '', 8500, 1, 0, 0, NULL),
(36, 'Leather purse', 'Leather and gold metal purse', 'purse_01.jpg', '', '', 11900, 0, 0, 0, NULL),
(37, 'Orange tracksuit', 'Orange tracksuit. cropped hoodie', 'sportswear_05.jpg', '', '', 8900, 0, 0, 0, NULL),
(38, 'Crossed ties top', 'White knit top, crossed ties in front', 'top_02.jpg', 'top_02a.jpg', 'top_02b.jpg', 15900, 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `product_size`
--

DROP TABLE IF EXISTS `product_size`;
CREATE TABLE IF NOT EXISTS `product_size` (
  `id_product_size` int(11) NOT NULL AUTO_INCREMENT,
  `id_size` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id_product_size`),
  KEY `id_product` (`id_product`),
  KEY `id_color` (`id_size`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product_size`
--

INSERT INTO `product_size` (`id_product_size`, `id_size`, `id_product`, `stock`) VALUES
(1, 4, 12, 19),
(2, 3, 12, 20),
(3, 4, 13, 20),
(4, 3, 13, 20),
(5, 4, 16, 20),
(6, 3, 16, 20),
(7, 4, 32, 20),
(8, 3, 32, 20),
(9, 4, 35, 20),
(10, 3, 35, 20),
(11, 4, 36, 20),
(12, 3, 36, 20),
(13, 4, 1, 19),
(14, 3, 1, 20),
(15, 4, 3, 20),
(16, 3, 3, 20),
(17, 4, 14, 20),
(18, 3, 14, 20),
(19, 4, 18, 20),
(20, 3, 18, 20),
(21, 4, 19, 20),
(22, 3, 19, 20),
(23, 4, 33, 20),
(24, 3, 33, 20),
(25, 4, 2, 19),
(26, 3, 2, 20),
(27, 4, 9, 20),
(28, 3, 9, 20),
(29, 4, 17, 20),
(30, 3, 17, 20),
(31, 4, 34, 20),
(32, 3, 34, 20),
(33, 4, 8, 20),
(34, 3, 8, 20),
(35, 4, 11, 20),
(36, 3, 11, 20),
(37, 4, 15, 20),
(38, 3, 15, 20),
(39, 4, 20, 20),
(40, 3, 20, 20),
(41, 4, 21, 20),
(42, 3, 21, 20),
(43, 4, 22, 20),
(44, 3, 22, 20),
(45, 4, 6, 20),
(46, 3, 6, 20),
(47, 4, 10, 20),
(48, 3, 10, 20),
(49, 4, 25, 20),
(50, 3, 25, 20),
(51, 4, 29, 20),
(52, 3, 29, 20),
(53, 4, 38, 20),
(54, 3, 38, 20),
(55, 4, 4, 20),
(56, 3, 4, 20),
(57, 4, 28, 20),
(58, 3, 28, 20),
(59, 4, 23, 20),
(60, 3, 23, 20),
(61, 4, 37, 20),
(62, 3, 37, 20),
(63, 4, 5, 20),
(64, 3, 5, 20),
(65, 4, 7, 20),
(66, 3, 7, 20),
(67, 4, 24, 20),
(68, 3, 24, 20),
(69, 4, 26, 20),
(70, 3, 26, 20),
(71, 4, 27, 20),
(72, 3, 27, 20),
(73, 4, 30, 20),
(74, 3, 30, 20),
(75, 4, 31, 20),
(76, 3, 31, 20),
(77, 1, 14, 1);

-- --------------------------------------------------------

--
-- Structure de la table `shop_order`
--

DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE IF NOT EXISTS `shop_order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `state` enum('complete','pending','cart') NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `shop_order`
--

INSERT INTO `shop_order` (`id_order`, `total`, `date`, `id_user`, `state`) VALUES
(6, 245, '2023-04-24 23:04:11', 6, 'pending'),
(7, 80, '2023-04-25 08:22:38', 6, 'pending'),
(8, 90, '2023-04-25 08:42:19', 6, 'cart');

-- --------------------------------------------------------

--
-- Structure de la table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `id_size` int(11) NOT NULL AUTO_INCREMENT,
  `size` enum('XS','S','M','L','XL','XXL') NOT NULL,
  PRIMARY KEY (`id_size`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `size`
--

INSERT INTO `size` (`id_size`, `size`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `login`, `password`, `firstname`, `lastname`, `email`, `address`, `city`, `zip`, `country`, `role`) VALUES
(6, 'admin', '$2y$10$UxPLFRIE4bgPbY9NZAnCI.Rn/tNXZxWXvAAehwPEIKhWN8bb6Q6pq', 'admin', 'admin', 'admin@admin.fr', 'Bd de Paris', 'Mars', '13002', 'France', 'admin'),
(7, 'tom', '$2y$10$qawxyxmmoH1Ecj2emPMdZ.saFo4Q7a5JDMn/TmmGjb0TpZnwfD/CS', 'tom', 'tom', 'tom@tom.fr', 'Rue Hozier', 'Marseille', '13002', 'France', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`id`, `id_user`, `id_product`, `date`) VALUES
(19, 2, 1, '2023-04-20 13:59:27'),
(11, 2, 2, '2023-04-19 19:50:10'),
(38, 2, 8, '2023-04-21 20:30:28'),
(33, 2, 12, '2023-04-21 14:31:04'),
(34, 2, 32, '2023-04-21 14:31:06'),
(35, 2, 36, '2023-04-21 14:31:10'),
(36, 2, 19, '2023-04-21 16:09:27'),
(37, 2, 7, '2023-04-21 20:29:55'),
(41, 6, 2, '2023-04-24 23:54:34'),
(42, 6, 4, '2023-04-24 23:54:40'),
(43, 6, 10, '2023-04-24 23:54:43'),
(44, 6, 3, '2023-04-24 23:55:03'),
(45, 6, 6, '2023-04-24 23:55:09');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `shop_order` (`id_order`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE;

--
-- Contraintes pour la table `link_categ`
--
ALTER TABLE `link_categ`
  ADD CONSTRAINT `link_categ_ibfk_1` FOREIGN KEY (`id_categ`) REFERENCES `category` (`id_category`) ON DELETE CASCADE,
  ADD CONSTRAINT `link_categ_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`id_size`) REFERENCES `size` (`id_size`) ON DELETE CASCADE;

--
-- Contraintes pour la table `shop_order`
--
ALTER TABLE `shop_order`
  ADD CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
