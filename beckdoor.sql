-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 13 Oca 2019, 18:28:44
-- Sunucu sürümü: 5.7.19
-- PHP Sürümü: 5.6.31

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
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_daire_id` (`ref_daire_id`)
) ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `apartman`
--

DROP TABLE IF EXISTS `apartman`;
CREATE TABLE IF NOT EXISTS `apartman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_site_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_site_id` (`ref_site_id`)
) ;

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
) ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyuru`
--

DROP TABLE IF EXISTS `duyuru`;
CREATE TABLE IF NOT EXISTS `duyuru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_user_id` int(11) NOT NULL,
  `ref_apartman_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_user_id` (`ref_user_id`),
  KEY `fk_ref_apartman_id_1` (`ref_apartman_id`)
) ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `etkinlik`
--

DROP TABLE IF EXISTS `etkinlik`;
CREATE TABLE IF NOT EXISTS `etkinlik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_user_id` int(11) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_user_id_1` (`ref_user_id`)
) ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gelir_gider`
--

DROP TABLE IF EXISTS `gelir_gider`;
CREATE TABLE IF NOT EXISTS `gelir_gider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_apartman_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_apartman_id_2` (`ref_apartman_id`)
) ;

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
  `subject` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ;

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
) ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oylama`
--

DROP TABLE IF EXISTS `oylama`;
CREATE TABLE IF NOT EXISTS `oylama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_apartman_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `result` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oy_tipi`
--

DROP TABLE IF EXISTS `oy_tipi`;
CREATE TABLE IF NOT EXISTS `oy_tipi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_oylama_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ref_oylama_id_1` (`ref_oylama_id`)
) ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `postal_code` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ;

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
  UNIQUE KEY `unq_user_daire_ref_user_id` (`ref_user_id`),
  UNIQUE KEY `unq_user_daire_ref_daire_id` (`ref_daire_id`)
) ;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `aidat`
--
ALTER TABLE `aidat`
  ADD CONSTRAINT `fk_ref_daire_id` FOREIGN KEY (`ref_daire_id`) REFERENCES `daire` (`id`);

--
-- Tablo kısıtlamaları `apartman`
--
ALTER TABLE `apartman`
  ADD CONSTRAINT `fk_ref_site_id` FOREIGN KEY (`ref_site_id`) REFERENCES `site` (`id`);

--
-- Tablo kısıtlamaları `daire`
--
ALTER TABLE `daire`
  ADD CONSTRAINT `fk_ref_apartman_id` FOREIGN KEY (`ref_apartman_id`) REFERENCES `apartman` (`id`);

--
-- Tablo kısıtlamaları `duyuru`
--
ALTER TABLE `duyuru`
  ADD CONSTRAINT `fk_ref_apartman_id_1` FOREIGN KEY (`ref_apartman_id`) REFERENCES `apartman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ref_user_id` FOREIGN KEY (`ref_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `etkinlik`
--
ALTER TABLE `etkinlik`
  ADD CONSTRAINT `fk_ref_user_id_1` FOREIGN KEY (`ref_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `gelir_gider`
--
ALTER TABLE `gelir_gider`
  ADD CONSTRAINT `fk_ref_apartman_id_2` FOREIGN KEY (`ref_apartman_id`) REFERENCES `apartman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `oy`
--
ALTER TABLE `oy`
  ADD CONSTRAINT `fk_ref_oy_tipi_id` FOREIGN KEY (`ref_oy_tipi_id`) REFERENCES `oy_tipi` (`id`),
  ADD CONSTRAINT `fk_ref_oylama_id` FOREIGN KEY (`ref_oylama_id`) REFERENCES `oylama` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ref_user_id_2` FOREIGN KEY (`ref_user_id`) REFERENCES `user` (`id`);

--
-- Tablo kısıtlamaları `oy_tipi`
--
ALTER TABLE `oy_tipi`
  ADD CONSTRAINT `fk_ref_oylama_id_1` FOREIGN KEY (`ref_oylama_id`) REFERENCES `oylama` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `user_daire`
--
ALTER TABLE `user_daire`
  ADD CONSTRAINT `fk_ref_daire_id_1` FOREIGN KEY (`ref_daire_id`) REFERENCES `daire` (`id`),
  ADD CONSTRAINT `fk_ref_user_id_3` FOREIGN KEY (`ref_user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
