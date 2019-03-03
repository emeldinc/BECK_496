-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 09 Şub 2019, 21:04:45
-- Sunucu sürümü: 5.7.23
-- PHP Sürümü: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `beckdoor`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `aidat`
--

DROP TABLE IF EXISTS `aidat`;
CREATE TABLE IF NOT EXISTS `aidat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_daire_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `date` date NOT NULL,
  `odendiMi` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_daire_id` (`ref_daire_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `aidat`
--

INSERT INTO `aidat` (`id`, `ref_daire_id`, `amount`, `date`, `odendiMi`) VALUES
(11, 17, '100.00', '2019-02-14', 0),
(12, 18, '100.00', '2019-02-13', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `apartman`
--

DROP TABLE IF EXISTS `apartman`;
CREATE TABLE IF NOT EXISTS `apartman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_site_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_site_id` (`ref_site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `apartman`
--

INSERT INTO `apartman` (`id`, `ref_site_id`, `name`, `number`) VALUES
(14, 26, 'BC', 12),
(13, 25, 'b', 3),
(11, 23, 'B apartmanı', 4),
(12, 24, 'Alp apt', 4),
(10, 22, 'A apartmanı', 2),
(15, 27, 'asd', 1213);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `daire`
--

DROP TABLE IF EXISTS `daire`;
CREATE TABLE IF NOT EXISTS `daire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_apartman_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_apartman_id` (`ref_apartman_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `daire`
--

INSERT INTO `daire` (`id`, `ref_apartman_id`, `number`) VALUES
(16, 13, 4),
(15, 12, 12),
(14, 11, 13),
(13, 10, 15),
(17, 14, 15),
(18, 15, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyuru`
--

DROP TABLE IF EXISTS `duyuru`;
CREATE TABLE IF NOT EXISTS `duyuru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_user_id` int(11) NOT NULL,
  `ref_apartman_id` int(11) NOT NULL,
  `ref_site_id` int(11) NOT NULL,
  `now_date` datetime NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_user_id` (`ref_user_id`),
  KEY `fk_ref_apartman_id_1` (`ref_apartman_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `duyuru`
--

INSERT INTO `duyuru` (`id`, `ref_user_id`, `ref_apartman_id`, `ref_site_id`, `now_date`, `title`, `description`) VALUES
(4, 10, 11, 0, '2019-01-31 22:44:06', 'asd', 'asdasdad'),
(5, 12, 14, 0, '2019-02-05 00:15:22', 'abc', 'asdasdasd');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `etkinlik`
--

DROP TABLE IF EXISTS `etkinlik`;
CREATE TABLE IF NOT EXISTS `etkinlik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ref_apartman_id` int(11) NOT NULL,
  `ref_site_id` int(11) NOT NULL,
  `silindiMi` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `etkinlik`
--

INSERT INTO `etkinlik` (`id`, `start_date`, `description`, `ref_apartman_id`, `ref_site_id`, `silindiMi`) VALUES
(1, NULL, 'Başlıksız Etkinlik', 14, 26, 0),
(2, NULL, 'sadasdasd', 14, 26, 1),
(3, NULL, 'asdasd', 14, 26, 0),
(4, NULL, 'yeni etkinlik', 14, 26, 0),
(5, NULL, 'asdasdasdddddd', 14, 26, 1),
(6, NULL, 'etkinlikkkk', 14, 26, 1),
(7, NULL, 'abc', 15, 27, 1),
(8, NULL, 'xyz', 15, 27, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gelir_gider`
--

DROP TABLE IF EXISTS `gelir_gider`;
CREATE TABLE IF NOT EXISTS `gelir_gider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_apartman_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `description` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `gelirMi` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_apartman_id_2` (`ref_apartman_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `gelir_gider`
--

INSERT INTO `gelir_gider` (`id`, `ref_apartman_id`, `date`, `amount`, `description`, `gelirMi`) VALUES
(17, 14, '2019-03-16', '100.00', 'abc', 0),
(18, 15, '2019-02-20', '100.00', 'asdasd', 0),
(16, 14, '2019-02-19', '10.00', 'aaa', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

DROP TABLE IF EXISTS `mesaj`;
CREATE TABLE IF NOT EXISTS `mesaj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `subject` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oy`
--

DROP TABLE IF EXISTS `oy`;
CREATE TABLE IF NOT EXISTS `oy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_user_id` int(11) NOT NULL,
  `ref_oylama_id` int(11) NOT NULL,
  `ref_oy_tipi_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_oylama_id` (`ref_oylama_id`),
  KEY `fk_ref_oy_tipi_id` (`ref_oy_tipi_id`),
  KEY `fk_ref_user_id_2` (`ref_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oylama`
--

DROP TABLE IF EXISTS `oylama`;
CREATE TABLE IF NOT EXISTS `oylama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_user_id` int(11) NOT NULL,
  `ref_apartman_id` int(11) NOT NULL,
  `ref_site_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `result` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oy_tipi`
--

DROP TABLE IF EXISTS `oy_tipi`;
CREATE TABLE IF NOT EXISTS `oy_tipi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_oylama_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `icon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_oylama_id_1` (`ref_oylama_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `state` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `postal_code` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `site`
--

INSERT INTO `site` (`id`, `name`, `city`, `state`, `postal_code`) VALUES
(27, 'abc', 'ankara', 'sada', '12'),
(26, 'ABC', 'Ankara', 'Cankaya', '06680'),
(25, 'a', 'b', 'c', '1'),
(24, 'B sitesi', 'Ankara', 'Yenimahalle', '06680'),
(23, 'B sitesi', 'Ankara', 'Çankaya', '06680'),
(22, 'A sitesi', 'Ankara', 'Çankaya', '06680');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(44) COLLATE utf8_turkish_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `role` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `image_path` varchar(44) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `role`, `image_path`) VALUES
(10, 'kemalulker', '81dc9bdb52d04dc20036dbd8313ed0', 'kemal', 'ulker', 'yonetici', ''),
(11, 'abc', 'c20ad4d76fe97759aa27a0c99bff67', 'def', 'abc', 'yasayan', ''),
(12, 'kulker', 'c20ad4d76fe97759aa27a0c99bff67', 'kemal', 'ulker', 'yonetici', 'assets/images/no-image.jpeg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_daire`
--

DROP TABLE IF EXISTS `user_daire`;
CREATE TABLE IF NOT EXISTS `user_daire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_user_id` int(11) NOT NULL,
  `ref_daire_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unq_user_daire_ref_user_id` (`ref_daire_id`) USING BTREE,
  KEY `unq_user_daire_ref_daire_id` (`ref_daire_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `user_daire`
--

INSERT INTO `user_daire` (`id`, `ref_user_id`, `ref_daire_id`) VALUES
(8, 10, 14),
(9, 10, 13),
(10, 10, 15),
(11, 11, 16),
(12, 12, 17),
(13, 12, 18);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
