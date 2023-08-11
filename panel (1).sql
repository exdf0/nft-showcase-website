-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 27 Mar 2022, 16:25:37
-- Sunucu sürümü: 10.4.10-MariaDB
-- PHP Sürümü: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `panel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullaniciadi` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `sifre` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`kullaniciadi`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullaniciadi`, `sifre`) VALUES
(1, 'admin', '123'),
(12, 'muratozsular@gmail.com', '123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `puanlar`
--

DROP TABLE IF EXISTS `puanlar`;
CREATE TABLE IF NOT EXISTS `puanlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urun_id` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kullanici_id` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `puan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `puanlar`
--

INSERT INTO `puanlar` (`id`, `urun_id`, `kullanici_id`, `puan`) VALUES
(3, '7', '12', 5),
(6, '6', '12', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dosya` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `isim` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `fiyat` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `dosya`, `isim`, `fiyat`, `link`) VALUES
(1, '623fccef0fceb503.png', 'Deklod Software', '0.45 ETH', 'https://www.deklodsoftware.com/'),
(4, '623fccef0fceb503.png', 'Deklod Software', '0.45 ETH', 'https://www.deklodsoftware.com/'),
(5, '623fccef0fceb503.png', 'Deklod Software', '0.45 ETH', 'https://www.deklodsoftware.com/'),
(6, '623fccef0fceb503.png', 'Deklod Software', '0.45 ETH', 'https://www.deklodsoftware.com/'),
(7, '623fccef0fceb503.png', 'Deklod Software', '0.45 ETH', 'https://www.deklodsoftware.com/'),
(8, '623fccef0fceb503.png', 'Deklod Software', '0.45 ETH', 'https://www.deklodsoftware.com/');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
