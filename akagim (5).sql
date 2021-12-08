-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 08 Ara 2021, 13:12:28
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `akagim`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `brands`
--

CREATE TABLE `brands` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(255) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `brands`
--

INSERT INTO `brands` (`id`, `title`, `img_url`, `rank`, `isActive`, `createdAt`) VALUES
(5, 'marka 1', 'dag-tekstil-markalar-409688.jpg', 1, 0, '2019-06-17 11:52:45'),
(6, 'marka 2', 'lovemarks-logo-2018.jpg', 2, 0, '2019-06-17 11:53:03'),
(7, 'marka 3', 'vw-binek.png', 0, 0, '2019-06-17 11:53:19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `isActive` enum('0','1','2','3','4') NOT NULL DEFAULT '0',
  `rezerv` enum('0','1') NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `toplantiTuru` varchar(4) NOT NULL DEFAULT 'zoom',
  `toplantiYeri` varchar(255) NOT NULL,
  `color` varchar(7) NOT NULL,
  `textColor` varchar(7) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `calendar`
--

INSERT INTO `calendar` (`id`, `teacher_id`, `student_id`, `status`, `isActive`, `rezerv`, `title`, `description`, `toplantiTuru`, `toplantiYeri`, `color`, `textColor`, `start_event`, `end_event`) VALUES
(33, 2, 0, '1', '0', '0', 'nergiz düzenleme yapıyoruz', 'ne olacak bakalım düzenle', '', '', '#69006b', '#4d896c', '2021-10-21 17:30:00', '2021-10-21 19:30:00'),
(35, 2, 0, '1', '0', '0', 'baslık 1', 'açıklamalar', '', '', '#3a87ad', '#000000', '2021-10-16 06:45:00', '2021-10-16 07:15:00'),
(37, 4, 2, '1', '0', '0', 'bu gün hastaneye gideceğiz', 'saat 11 de gideceğiz 12 de çıkacağız', 'ozel', '', '#74c4ec', '#000000', '2021-10-17 11:00:00', '2021-10-17 12:00:00'),
(38, 2, 0, '1', '0', '0', 'baslik', 'rdgfhuıojkıoukl', '', '', '#1695d4', '#ac2a2a', '2021-10-07 02:00:00', '2021-10-07 03:00:00'),
(39, 2, 0, '1', '0', '0', 'deneme başlık', 'deneme açıklama', '', '', '#40a9dd', '#e83b3b', '2021-11-28 02:57:52', '2021-11-28 03:57:52'),
(42, 4, 2, '4', '4', '0', 'sdfasdf', 'asdfasf', 'ozel', 'isbulta', '#3a87ad', '#000000', '2021-11-28 11:00:00', '2021-11-28 13:00:00'),
(43, 2, 0, '1', '0', '0', 'hamdi deneme', 'deneme 1 2 3 hamdi', '', '', '#3a87ad', '#000000', '2021-12-01 11:00:00', '2021-12-01 14:30:00'),
(44, 4, 2, '2', '1', '0', 'sefa', 'sefa deneme 4 5  6', '', '', '#3a87ad', '#000000', '2021-12-03 11:00:00', '2021-12-03 15:00:00'),
(45, 4, 3, '4', '4', '0', 'baslik', '<p>açıklama kısmı</p>', '', '', '#3a87ad', '#000000', '2021-11-10 11:00:00', '2021-11-10 12:00:00'),
(46, 4, 0, '1', '0', '0', 'Ekonomi Gündem', '<p>ayın 4 ü olacak</p>', 'ozel', 'ankara abur cubur kafede', '#3a87ad', '#ffffff', '2021-12-10 11:00:00', '2021-12-10 16:00:00'),
(47, 2, 0, '1', '0', '0', 'deneme başlık', 'Peş peşe gelen yenilgilerden sonra Sergen Yalçın\'ın koltuğu sallandı, ancak devam kararı çıktı. Brezilya basını ise Palmeiras\'la Libertadores\'i kazanan Felipe Melo\'nun hocası Abel Ferreira\'nın Beşiktaş\'la görüştüğünü iddia etti.\nKara Kartal\'da hoca değişimi beklenmiyordu ancak Brezilya\'dan gelen haber ortalığı salladı. Brezilya basınından Globo, Libertadores şampiyonu olan Abel Ferreira\'nın Beşiktaş\'la görüştüğünü yazdı.', '', '', '#0993d7', '#ffffff', '2021-11-11 05:00:00', '2021-11-11 06:00:00'),
(48, 2, 0, '1', '0', '0', 'haber başlık', 'Peş peşe gelen yenilgilerden sonra Sergen Yalçın\'ın koltuğu sallandı, ancak devam kararı çıktı. Brezilya basını ise Palmeiras\'la Libertadores\'i kazanan Felipe Melo\'nun hocası Abel Ferreira\'nın Beşiktaş\'la görüştüğünü iddia etti.\nKara Kartal\'da hoca değişimi beklenmiyordu ancak Brezilya\'dan gelen haber ortalığı salladı. Brezilya basınından Globo, Libertadores şampiyonu olan Abel Ferreira\'nın Beşiktaş\'la görüştüğünü yazdı.', '', '', '#007ebd', '#ffffff', '2021-11-19 11:00:00', '2021-11-19 12:00:00'),
(49, 4, 3, '3', '3', '0', 'cuma günü ', 'cuma günü ders açıklaması', '', '', '#3a87ad', '#000000', '2021-12-03 08:00:00', '2021-12-03 20:45:00'),
(50, 4, 0, '1', '0', '0', 'ayın 7 deneme düzenleniyor', 'zoom denemesi ayın 7 si düzenle', 'zoom', '', '#3a87ad', '#000000', '2021-12-08 10:30:00', '2021-12-08 11:30:00'),
(51, 2, 0, '1', '0', '0', 'ev gezisi', 'keçiörende ev gezisi yapılacak', 'ozel', 'keçiören', '#5a9dbf', '#f70808', '2021-12-14 07:00:00', '2021-12-14 08:00:00'),
(52, 4, 0, '1', '0', '0', 'matematik', 'matematik fonksiyonlar', 'ozel', 'keçiören', '#35ade9', '#ed0c0c', '2021-12-07 03:30:00', '2021-12-07 04:30:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courses`
--

CREATE TABLE `courses` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `courses`
--

INSERT INTO `courses` (`id`, `url`, `title`, `description`, `img_url`, `event_date`, `rank`, `isActive`, `createdAt`) VALUES
(5, 'php-egitimi-baslik', 'php eğitimi başlık', '<p>eğitim açıklama</p>', 'php-function.png', '2019-06-25 02:10:10', 1, 1, '2019-06-17 11:46:15'),
(6, 'css-egitimi', 'css eğitimi', '<p>css eğitim açıklama</p>', 'css-part-1.jpg', '2019-06-22 00:00:00', 2, 1, '2019-06-17 11:47:44'),
(7, 'jquery-egitimi', 'jquery eğitimi', '<p>jquery eğitimi açıklma&nbsp;<br></p>', 'jquery-logo.png', '2019-06-29 06:30:30', 0, 1, '2019-06-17 11:48:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `protocol` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `host` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `port` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `user` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `from` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `to` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `user_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `email_settings`
--

INSERT INTO `email_settings` (`id`, `protocol`, `host`, `port`, `user`, `password`, `from`, `to`, `user_name`, `isActive`, `createdAt`) VALUES
(2, 'smtp', 'ssl://smtp.gmail.com', '465', 'denizyemek06@gmail.com', 'deniz1987', 'denizyemek06@gmail.com', 'hamdiyildiz06@gmail.com', 'CMS', 1, '2019-02-23 13:43:55'),
(3, 'smtp', 'ssl://smtp.gmail.com1', '465', 'denizyemek06@gmail.com1', 'deniz19871', 'denizyemek06@gmail.com1', 'hamdiyildiz06@gmail.com', 'CMS1', 1, '2019-02-23 13:43:55'),
(4, 'smtp111122', 'ssl://smtp.gmail.com11122', '46522', 'denizyemek061111@gmail.com22', '22', 'hamdiyildiz0611111@gmail.com222', 'hamdiyildiz06111111@gmail.com222', 'hamdiyildiz111111222', 1, '2019-06-17 10:34:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `files`
--

CREATE TABLE `files` (
  `id` int(11) UNSIGNED NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(255) DEFAULT NULL,
  `isActive` tinyint(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `gallery_type` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `folder_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) NOT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `galleries`
--

INSERT INTO `galleries` (`id`, `url`, `title`, `gallery_type`, `folder_name`, `rank`, `isActive`, `createdAt`) VALUES
(12, 'galeri-resim', 'galeri resim', 'image', 'galeri-resim', 0, 1, '2019-06-17 10:21:46'),
(13, 'galeri-video', 'galeri video', 'video', '', 0, 1, '2019-06-17 10:35:37');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `images`
--

CREATE TABLE `images` (
  `id` int(11) UNSIGNED NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(255) DEFAULT NULL,
  `isActive` tinyint(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `images`
--

INSERT INTO `images` (`id`, `gallery_id`, `url`, `rank`, `isActive`, `createdAt`) VALUES
(43, 12, 'images.jpg', 0, 1, '2019-06-17 10:22:34'),
(44, 12, 'whatsapp-image-2019-01-19-at-13-51-18-1-.jpeg', 0, 1, '2019-06-17 10:22:35');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

CREATE TABLE `members` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `isActive` tinyint(50) DEFAULT NULL,
  `ip_address` int(25) NOT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `news`
--

CREATE TABLE `news` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `news_type` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `viewCount` int(11) NOT NULL,
  `rank` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `news`
--

INSERT INTO `news` (`id`, `url`, `title`, `description`, `news_type`, `img_url`, `video_url`, `viewCount`, `rank`, `isActive`, `createdAt`) VALUES
(12, 'pentagon-acikladi:-fuzeyle-dusurduler', 'Pentagon açıkladı: Füzeyle düşürdüler', '<h2 class=\"spot\"><font face=\"Arial\">ABD Merkez Kuvvetler Komutanlığı (CENTCOM), MQ-9 Reaper\r\n tipi insansız hava araçlarının (İHA) 6 Haziran\'da Yemen üzerinde \r\nHusiler tarafından düşürüldüğünü, diğer bir MQ-9\'a ise 13 Haziran\'da \r\nUmman Körfezi\'nde atış yapıldığını açıkladı. ABD, ikinci saldırının \r\ndoğudan İRan\'ın yaptığını iddia etti.</font></h2>', 'image', '880x495-cmsv2-d907d829-1e58-5c48-bd2e-c376ff60b684-3961230.jpg', '#', 11, 0, 1, '2019-06-17 11:24:39'),
(13, 'super-lig-den-besiktas-a-kaleci--anlasma-tamam', 'Süper Lig\'den Beşiktaş\'a kaleci! Anlaşma tamam', '<h2 class=\"spot\">Spor Toto Süper Lig ekiplerinden Evkur Yeni Malatyaspor\r\n ile sözleşmesi sona eren kaleci Ertaç Özbir, Beşiktaş ile anlaşma \r\nsağladı. 29 yaşındaki kaleci, siyah beyazlı kulüpten yıllık 750 bin Euro\r\n kazanacak.</h2>', 'image', 'super-ligden-besiktasa-kaleci-anlasma-tamam-1560758245-0116.jpg', '#', 5, 0, 1, '2019-06-17 11:26:27'),
(14, 'terim-den-cok-sert---icimizdeki-dusmanlar----', 'Terim\'den çok sert! \'İçimizdeki düşmanlar...\'', '<h2 class=\"spot\">a krizi bitmek bilmeyen ve mahkemenin kararını \r\nbeklemeye geçen Galatasaray\'da teknik direktör Fatih Terim, yeni bir \r\nbaşkan seçilmesiyle ilgili konuştu.<img src=\"data:image/jpeg;base64,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\" data-filename=\"fatih_terim_fenerbahce_macindan_sonra_1555784968_6702.jpg\" style=\"width: 620px;\"></h2><h2 class=\"spot\" style=\"font-family: Raleway, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\">İbra krizi bitmek bilmeyen ve mahkemenin kararını beklemeye geçen Galatasaray\'da teknik direktör Fatih Terim, yeni bir başkan seçilmesiyle ilgili konuştu.</h2><h2 class=\"spot\" style=\"font-family: Raleway, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\">İbra krizi bitmek bilmeyen ve mahkemenin kararını beklemeye geçen Galatasaray\'da teknik direktör Fatih Terim, yeni bir başkan seçilmesiyle ilgili konuştu.</h2><h2 class=\"spot\" style=\"font-family: Raleway, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\">İbra krizi bitmek bilmeyen ve mahkemenin kararını beklemeye geçen Galatasaray\'da teknik direktör Fatih Terim, yeni bir başkan seçilmesiyle ilgili konuştu.</h2><h2 class=\"spot\" style=\"font-family: Raleway, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\">İbra krizi bitmek bilmeyen ve mahkemenin kararını beklemeye geçen Galatasaray\'da teknik direktör Fatih Terim, yeni bir başkan seçilmesiyle ilgili konuştu.</h2><p><br></p><p>buraya bir lik verelim <a href=\"http://i2.haber7.net//haber/haber7/photos/2019/16/fatih_terim_fenerbahce_macindan_sonra_1555784968_6702.jpg\" style=\"box-sizing: border-box; background-color: rgb(255, 255, 255); color: rgb(24, 138, 226); text-decoration: none; outline: none; font-family: Raleway, \"Helvetica Neue\", Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 500; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px;\">buraya bir lik verelim<span> </span></a><a href=\"http://i2.haber7.net//haber/haber7/photos/2019/16/fatih_terim_fenerbahce_macindan_sonra_1555784968_6702.jpg\"></a><br></p><h2 class=\"spot\" style=\"font-family: Raleway, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\">İbra krizi bitmek bilmeyen ve mahkemenin kararını beklemeye geçen Galatasaray\'da teknik direktör Fatih Terim, yeni bir başkan seçilmesiyle ilgili konuştu. 1</h2><h2 class=\"spot\" style=\"font-family: Raleway, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\">İbra krizi bitmek bilmeyen ve mahkemenin kararını beklemeye geçen Galatasaray\'da teknik direktör Fatih Terim, yeni bir başkan seçilmesiyle ilgili konuştu. 2</h2><h2 class=\"spot\" style=\"font-family: Raleway, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\">İbra krizi bitmek bilmeyen ve mahkemenin kararını beklemeye geçen Galatasaray\'da teknik direktör Fatih Terim, yeni bir başkan seçilmesiyle ilgili konuştu.3</h2><h2 class=\"spot\" style=\"font-family: Raleway, \" helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\">İbra krizi bitmek bilmeyen ve mahkemenin kararını beklemeye geçen Galatasaray\'da teknik direktör Fatih Terim, yeni bir başkan seçilmesiyle ilgili konuştu.4</h2>', 'image', 'fatih-terim-fenerbahce-macindan-sonra-1555784968-6702.jpg', '#', 4, 0, 1, '2019-06-17 11:27:46');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `popups`
--

CREATE TABLE `popups` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_turkish_ci DEFAULT NULL,
  `page` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `popup_unique_id` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `finishedAt` datetime NOT NULL,
  `client` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `place` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `portfolio_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `portfolios`
--

INSERT INTO `portfolios` (`id`, `url`, `title`, `description`, `rank`, `finishedAt`, `client`, `category_id`, `place`, `portfolio_url`, `isActive`, `createdAt`) VALUES
(6, 'portfolio-php-e-baslik', 'portfolio php e baslik', '                                                                                    <p>burada php eğitimi ile alakalı birşeyler doldurduk bakalım ne olacak</p>                                                                        ', 0, '2019-06-19 02:10:10', 'php müsteri', 4, 'yer mekan', 'https://www.youtube.com/watch?v=INn8M6-vniA', 1, '2019-06-17 11:09:57'),
(7, 'css-egitimi', 'css eğitimi', '                            <p>burada csseğitimi ile alakalı birşeyler doldurduk bakalım ne olacak<br></p>                        ', 0, '2019-06-18 09:25:15', 'css müsteri', 5, 'yer mekan', 'https://www.soneksbilgisayar.com', 1, '2019-06-17 11:11:07'),
(8, 'jquery-egitimi', 'jquery eğitimi', '                            <p>burada jQuery eğitimi ile alakalı birşeyler doldurduk bakalım ne olacak<br></p>                        ', 0, '2019-06-19 13:15:15', 'jquery müsteri', 6, 'yer mekan jquery', 'https://www.canbilteknoloji.com/', 1, '2019-06-17 11:12:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `title`, `isActive`, `createdAt`) VALUES
(4, 'php eğitimi', 1, '2019-06-17 11:06:16'),
(5, 'css eğitimi', 1, '2019-06-17 11:06:22'),
(6, 'jQuery eğitimi', 1, '2019-06-17 11:06:29'),
(7, 'codeigniter 3 eğitimi', 1, '2019-06-17 11:06:39'),
(8, 'deneme saçma eğitimler 2', 1, '2019-06-17 11:06:51'),
(9, 'matematik 1 grubu', 1, '2021-11-30 14:44:30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `portfolio_images`
--

CREATE TABLE `portfolio_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `portfolio_id` int(11) DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `isActive` tinyint(11) DEFAULT 1,
  `isCover` tinyint(11) DEFAULT 0,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `portfolio_id`, `img_url`, `rank`, `isActive`, `isCover`, `createdAt`) VALUES
(15, 6, 'internet-java-js-php-html-cloud-docker-bitcoin-programming-language-logo-cool-stickers-for-laptop-car.jpg', 1, 1, 0, '2019-06-17 11:14:55'),
(16, 6, 'php’de-objeye-yonelik-programlama-object-oriented-programming-one-cikarilmis-gorsel-meden.jpg', 0, 1, 0, '2019-06-17 11:16:16'),
(17, 6, 'php-function.png', 0, 1, 1, '2019-06-17 11:17:15'),
(18, 7, 'css.jpg', 0, 1, 1, '2019-06-17 11:18:11'),
(19, 7, 'kisspng-css3-cascading-style-sheets-computer-icons-html-emblem-5ac245f0d27847-8044648115226813288621.jpg', 0, 1, 0, '2019-06-17 11:18:27'),
(20, 7, 'css-part-1.jpg', 0, 1, 0, '2019-06-17 11:18:47'),
(21, 8, 'jquery-logo.png', 0, 1, 1, '2019-06-17 11:19:42'),
(22, 8, 'ajax-destekli-site.jpg', 0, 1, 0, '2019-06-17 11:19:59');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `url`, `title`, `description`, `rank`, `isActive`, `createdAt`) VALUES
(20, 'urun-baslik-1', 'ürün baslik 1', '<p>ürün acıklama 1<br></p>', 0, 1, '2019-06-17 10:55:04'),
(21, 'urun-baslik-2', 'ürün baslik 2', '<p>ürün aciklma 2<br></p>', 0, 1, '2019-06-17 10:55:18'),
(22, 'urun-baslik-4', 'ürün baslik 4', '                                                                                    <p>ürün aciklama 4<br></p>                                                                        ', 0, 1, '2019-06-17 10:55:34');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `isActive` tinyint(11) DEFAULT 1,
  `isCover` tinyint(11) DEFAULT 0,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img_url`, `rank`, `isActive`, `isCover`, `createdAt`) VALUES
(89, 20, 'e-ticaret-gorsel.jpg', 0, 1, 0, '2019-06-17 10:57:23'),
(90, 20, 'snapchat-amazon-visual-search.png', 0, 1, 0, '2019-06-17 10:57:24'),
(91, 21, '736-736-12540917420.jpg', 0, 1, 0, '2019-06-17 10:58:24'),
(92, 21, 'urunler.png', 0, 1, 0, '2019-06-17 10:58:24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `program_infos`
--

CREATE TABLE `program_infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `program_infos`
--

INSERT INTO `program_infos` (`id`, `url`, `title`, `description`, `img_url`, `rank`, `isActive`, `createdAt`) VALUES
(19, 'deneme-baslik', 'deneme baslik', '<div class=\"\" style=\"font-family: Nunito, sans-serif; font-size: 16px; background-color: rgb(237, 237, 237);\"><div class=\"_2Q8y-\" style=\"margin: 1rem auto 0px;\"><div style=\"margin-top: -1rem;\"><div class=\"_3-KfZ aSd4H\" style=\"position: relative; padding-top: 1rem; padding-bottom: 20px;\"><div class=\"_1pk24\" style=\"margin: 2rem auto 0px; max-width: 1280px; width: 1280px;\"><div class=\"_2Q8y- _1R31X\" style=\"margin: 0px -0.75rem; display: flex;\"><div class=\"_3Ajqd _1Gv6T\" style=\"float: left; padding: 0px 0.75rem; min-height: 1px; width: 1104px; margin-left: auto; left: auto; right: auto;\"><h1 style=\"font-size: 2em; margin-top: 0px; margin-bottom: 0px; font-family: Poppins, sans-serif; font-weight: 700; letter-spacing: 0.5px;\">Structured Mentoring Program DEMO</h1><div class=\"markdown-content\"><p>Welcome to Our Mentoring Program</p><hr><p><span style=\"font-weight: 700;\">Model :</span> Structured Mentoring</p><p><span style=\"font-weight: 700;\">Pairing :</span> Admins Pairs Users</p><hr><h3 style=\"font-family: Poppins, sans-serif; font-weight: 700; letter-spacing: 0.5px;\">Template Settings You may edit your program settings on your admin portal.</h3><ul><li><span style=\"font-weight: 700;\">TIME SLOTS ARE ENABLE :</span> Mentors can add time slots to provide availabilities.</li><li><span style=\"font-weight: 700;\">SELECTION MODE IS OFF :</span> Only admins pairs mentees and mentors.</li><li><span style=\"font-weight: 700;\">PAGE VIEW PERMISSIONS :</span> Only paired mentors and mentees can see each other.</li></ul><hr><h3 style=\"font-family: Poppins, sans-serif; font-weight: 700; letter-spacing: 0.5px;\">What is structured mentoring ?</h3><ul><li>This is a mentoring model that have session topics.</li><li>Admins create session titles includes forms.</li><li>Users need to schedule their meetings based on program sessions (topics) .</li></ul></div></div><div class=\"_1JyAm _3Ajqd\" style=\"text-align: center; margin: 0px 0px 0px 3rem; position: relative; float: left; padding: 0px 0.75rem; min-height: 1px;\"><img size=\"40\" src=\"https://api.mentornity.com/files/619ca07f8b5af300089c1236\" style=\"color: rgb(250, 250, 250); background-color: rgb(158, 158, 158); user-select: none; display: inline-flex; align-items: center; justify-content: center; font-size: 2rem; border-radius: 9px; height: 128px; width: 128px; flex: 0 0 128px;\"><div><a href=\"https://au.linkedin.com/company/\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"color: rgb(85, 85, 85);\"><img src=\"https://mentornity.com/icons/linkedin.svg\" alt=\"linkedin\" style=\"height: 1.4rem; margin: 2rem 0.5rem 0.5rem 0px;\"></a><a href=\"http://mentornity.com/\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"color: rgb(85, 85, 85);\"><img src=\"https://mentornity.com/icons/twitter.svg\" alt=\"twitter\" style=\"height: 1.4rem; margin: 2rem 0.5rem 0.5rem 0px;\"></a><a href=\"http://mentornity.com/\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"color: rgb(85, 85, 85);\"><img src=\"https://mentornity.com/icons/facebook.svg\" alt=\"facebook\" style=\"height: 1.4rem; margin: 2rem 0.5rem 0.5rem 0px;\"></a><a href=\"https://www.your-domain.com/\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"color: rgb(85, 85, 85);\"><img src=\"https://mentornity.com/icons/web.svg\" alt=\"facebook\" style=\"height: 1.4rem; margin: 2rem 0.5rem 0.5rem 0px;\"></a><br></div></div></div></div></div></div></div></div><div class=\"_1pk24\" style=\"margin: 0px auto; max-width: 1280px; width: 1280px; font-family: Nunito, sans-serif; font-size: 16px; background-color: rgb(237, 237, 237); padding-bottom: 15px;\"><div class=\"_2Q8y-\" style=\"margin: 0px; display: flex; text-decoration-line: underline;\"><a href=\"https://mentornity.com/structured-paired-mentoring/welcome\" style=\"color: rgb(85, 85, 85); margin-right: 7px;\">Go to Onboarding steps again.</a><p style=\"cursor: pointer; color: rgb(85, 85, 85);\">Program Terms And Conditions</p></div></div>', '61955d89b3555a00075f7027.jpg', 0, 1, '2021-11-27 21:10:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `references`
--

CREATE TABLE `references` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `references`
--

INSERT INTO `references` (`id`, `url`, `title`, `description`, `img_url`, `rank`, `isActive`, `createdAt`) VALUES
(9, 'referans-baslik-1', 'referans başlık 1', '<p>referans 1 açıklama<br></p>', 'portfolio-2.jpg', 0, 1, '2019-06-17 11:49:33'),
(12, 'program-info-baslik', 'program info baslik', '<p>program info açıklama</p>', 'sddefault.jpg', 2, 1, '2021-11-27 18:56:16'),
(13, 'program-info-baslik', 'program info baslik', '<p>program info acıklama<br></p>', 'k-19121754-img-20201118-wa0021.jpg', 3, 1, '2021-11-27 19:04:12'),
(14, 'deneme', 'deneme', '<p>deneme acıklama</p>', '5618315a-c6ad-442c-b5db-baf9b2469dcf-1.jpg', 1, 1, '2021-11-27 19:47:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `services`
--

CREATE TABLE `services` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `services`
--

INSERT INTO `services` (`id`, `url`, `title`, `description`, `img_url`, `rank`, `isActive`, `createdAt`) VALUES
(7, 'hizmet-1', 'hizmet 1', '<p>hizmet acıklama 1</p>', 'whatsapp-image-2019-01-19-at-13-48-24.jpeg', 0, 1, '2019-06-17 10:41:27'),
(8, 'hizmet-2', 'hizmet 2', '<p>hizmet 2</p>', 'whatsapp-image-2019-01-19-at-13-51-18-1-.jpeg', 0, 1, '2019-06-17 10:42:10'),
(9, 'hizmet-3-454545', 'hizmet 3-454545', '<p>hizmet açıklama 3-454545</p>', 'whatsapp-image-2019-01-19-at-13-51-20.jpeg', 0, 1, '2019-06-17 10:45:52');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `slogan` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `address` text COLLATE utf8_turkish_ci NOT NULL,
  `about_us` longtext COLLATE utf8_turkish_ci DEFAULT NULL,
  `mission` longtext COLLATE utf8_turkish_ci DEFAULT NULL,
  `vision` longtext COLLATE utf8_turkish_ci DEFAULT NULL,
  `homepage_references_description` text COLLATE utf8_turkish_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `mobile_logo` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `phone_1` varchar(15) COLLATE utf8_turkish_ci DEFAULT NULL,
  `phone_2` varchar(15) COLLATE utf8_turkish_ci DEFAULT NULL,
  `fax_1` varchar(15) COLLATE utf8_turkish_ci DEFAULT NULL,
  `fax_2` varchar(15) COLLATE utf8_turkish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `lat` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `long` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `slogan`, `address`, `about_us`, `mission`, `vision`, `homepage_references_description`, `logo`, `mobile_logo`, `favicon`, `phone_1`, `phone_2`, `fax_1`, `fax_2`, `email`, `facebook`, `twitter`, `instagram`, `linkedin`, `lat`, `long`, `createdAt`, `updatedAt`) VALUES
(2, 'Akagim', 'Güzellik Seninle Başlar...', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            basınevleri mahallesi gülüm sok 3 / 2 Keçiören Ankara                                                                                                                                                                                                                                                                                                                                                                                    ', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif;\">Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz. Kökleri M.Ö. 45 tarihinden bu yana klasik Latin edebiyatına kadar uzanan 2000 yıllık bir geçmişi vardır. Virginia\'daki Hampden-Sydney College\'dan Latince profesörü Richard McClintock, bir Lorem Ipsum pasajında geçen ve anlaşılması en güç sözcüklerden biri olan \'consectetur\' sözcüğünün klasik edebiyattaki örneklerini incelediğinde kesin bir kaynağa ulaşmıştır. Lorm Ipsum, Çiçero tarafından M.Ö. 45 tarihinde kaleme alınan \"de Finibus Bonorum et Malorum\" (İyi ve Kötünün Uç Sınırları) eserinin 1.10.32 ve 1.10.33 sayılı bölümlerinden gelmektedir. Bu kitap, ahlak kuramı üzerine bir tezdir ve Rönesans döneminde çok popüler olmuştur. Lorem Ipsum pasajının ilk satırı olan \"Lorem ipsum dolor sit amet\" 1.10.32 sayılı bölümdeki bir satırdan gelmektedir.</p><p style=\"margin-bottom: 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif;\">1500\'lerden beri kullanılmakta olan standard Lorem Ipsum metinleri ilgilenenler için yeniden üretilmiştir. Çiçero tarafından yazılan 1.10.32 ve 1.10.33 bölümleri de 1914 H. Rackham çevirisinden alınan İngilizce sürümleri eşliğinde özgün biçiminden yeniden üretilmiştir.</p>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <strong style=\"margin: 0px; padding: 0px; font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500\'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır. Beşyüz yıl boyunca varlığını sürdürmekle kalmamış, aynı zamanda pek değişmeden elektronik dizgiye de sıçramıştır. 1960\'larda Lorem Ipsum pasajları da içeren Letraset yapraklarının yayınlanması ile ve yakın zamanda Aldus PageMaker gibi Lorem Ipsum sürümleri içeren masaüstü yayıncılık yazılımları ile popüler olmuştur.</span>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <span style=\"font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">Yinelenen bir sayfa içeriğinin okuyucunun dikkatini dağıttığı bilinen bir gerçektir. Lorem Ipsum kullanmanın amacı, sürekli \'buraya metin gelecek, buraya metin gelecek\' yazmaya kıyasla daha dengeli bir harf dağılımı sağlayarak okunurluğu artırmasıdır. Şu anda birçok masaüstü yayıncılık paketi ve web sayfa düzenleyicisi, varsayılan mıgır metinler olarak Lorem Ipsum kullanmaktadır. Ayrıca arama motorlarında \'lorem ipsum\' anahtar sözcükleri ile arama yapıldığında henüz tasarım aşamasında olan çok sayıda site listelenir. Yıllar içinde, bazen kazara, bazen bilinçli olarak (örneğin mizah katılarak), çeşitli sürümleri geliştirilmiştir.</span>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ', 'sitemizde bulunmanız bizim için bir onurdur bizi tercih ettiğiniz için teşekkür ederiz ...', 'akagim.jpg', 'akagim.jpg', 'akagim.png', '05557222050', '5557222052', '5557222051', '5557222053', 'hamdiyildiz06@gmail.com', 'https://www.facebook.com/hamdiyildiztr', 'https://www.twitter.com/hamdiyildiztr', 'https://www.instagram.com/hamdiyildiztr', 'https://www.linkedin.com/hamdiyildiztr', '39.971204', '32.852153', '2019-02-25 18:10:46', '2021-12-01 20:26:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slides`
--

CREATE TABLE `slides` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `allowButton` tinyint(4) DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `button_caption` varchar(25) COLLATE utf8_turkish_ci DEFAULT NULL,
  `animation_type` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `animation_time` int(11) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slides`
--

INSERT INTO `slides` (`id`, `title`, `description`, `img_url`, `allowButton`, `button_url`, `button_caption`, `animation_type`, `animation_time`, `rank`, `isActive`, `createdAt`) VALUES
(5, 'slider 1', '<p>acıklama 1</p>', 'portfolio-1.jpg', 1, 'http://localhost/codeigniter/son/site/hakkimizda', 'buton acık', NULL, NULL, 0, 1, '2019-06-17 10:38:33'),
(6, 'slider 2', '<p>aciklama 2</p>', 'portfolio-3.jpg', 0, '', '', NULL, NULL, 0, 1, '2019-06-17 10:39:35'),
(7, 'slider 3', '<p>acıklama 3</p>', 'portfolio-2.jpg', 1, 'http://localhost/codeigniter/son/site/urun-listesi', 'buton baslik - ürünlerimi', NULL, NULL, 0, 1, '2019-06-17 10:40:24');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `rank` tinyint(4) NOT NULL DEFAULT -99,
  `isActive` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `testimonials`
--

INSERT INTO `testimonials` (`id`, `title`, `description`, `full_name`, `company`, `img_url`, `rank`, `isActive`, `createdAt`) VALUES
(1, 'sitemiz hayırlı olsun', 'not not nottt', 'nargiza yıldız', 'yildizturk yazılım', 'nergiz.jpg', -99, 1, '2019-06-17 12:02:50'),
(2, 'test klasörü', 'Web TasarımıWeb TasarımıWeb TasarımıWeb TasarımıWeb Tasarımı', 'salla gitsin', 'yildizturk yazılım', '0-chameleon-256.png', -99, 1, '2019-06-17 12:06:46');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `full_name` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'noAvatar.png',
  `email` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_role_id` int(11) NOT NULL DEFAULT 2,
  `password` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `unvan` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `profession` text COLLATE utf8_turkish_ci NOT NULL,
  `topic` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `topic_name` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `description` text COLLATE utf8_turkish_ci NOT NULL,
  `linkedin` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `facebook` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `instagram` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `zoom` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `permissions` text COLLATE utf8_turkish_ci NOT NULL,
  `isActive` tinyint(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `user_name`, `full_name`, `img_url`, `email`, `user_role_id`, `password`, `unvan`, `profession`, `topic`, `topic_name`, `description`, `linkedin`, `facebook`, `instagram`, `zoom`, `permissions`, `isActive`, `createdAt`) VALUES
(1, 'hamdi', 'hamdi yıldız', '271411.jpg', 'hamdiyildiz@windowslive.com', 2, 'e10adc3949ba59abbe56e057f20f883e', 'Yönetim Danışmanı & Eğitmen', 'Otomotiv , Planlama , Yönetim Danışmanlığı', '', '', '', '', '', '', '', '', 1, NULL),
(2, 'hamdiyildiz', 'hamdi yıldız', '11392896 - 32945.jpg', 'hamdiyildiz06@gmail.com', 1, 'e10adc3949ba59abbe56e057f20f883e', 'Backend Developer @ Zingo!', 'Reklam , İş Modeli , Yönetim Danışmanlığı', 'Girişimin Konusu', 'Girişimin Adı', '<p>burada hakkımızda ait yazılar olacak&nbsp;</p>', 'Linkedin', 'Facebook', 'Instagram', 'Zoom Link', '', 1, '2019-02-17 09:31:23'),
(3, 'nargiza', 'sadıkova', '2144472.jpg', 'nargiza@gmail.com', 3, 'e10adc3949ba59abbe56e057f20f883e', 'Makine Mühendisi', 'Girişimcilik , İş Modeli , Sanat', 'Girişimin konusu', '', '<p>hakımda birşeyler yazılacak buraya</p>', '', '', '', '', '', 1, '2019-02-26 12:43:40'),
(4, 'sefayildiz', 'sefa yıldız', 'jens-schumacher-2018.jpg', 'safe@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', 'Elektrik Elektronik Mühendisi', 'Girişimcilik , İş Modeli , Yönetim Danışmanlığı', '', '', '          <h3 class=\"m-b-lg m-t-xl\">Hakımda yazısını bilgilerim bölümünden doldurabilirsiniz</h3>\r\n          <div class=\"m-l-lg\">\r\n            <p class=\"m-h-lg fz-md lh-lg\">Infinity is a responsive Bootstrap 3.3.6 Admin Template. It provides you with a vast collection of ready to use code snippets and utilities, many </p><p class=\"m-h-lg fz-md lh-lg\">custom pages and a collection of applications and widgets</p>\r\n            <h4 class=\"fw-600 title-color m-h-lg\">What you get when you get Infinity:</h4>\r\n            <div class=\"m-l-lg\">\r\n              <ul class=\"fz-md lh-lg p-l-lg\" style=\"list-style-type: square;\">\r\n                <li>8 built-in Color Skins And You Can Your Own</li>\r\n                <li>Light/Dark Sidebar Themes</li>\r\n                <li>Free Landing Pages For Your Website</li>\r\n                <li>Multiple Layout</li>\r\n                <li>Responsive layout</li>\r\n                <li>Live Skin Customizer</li>\r\n                <li>Loading progress bar</li>\r\n                <li>Hundreds of UI Components</li>\r\n                <li>Dozens of Widgets</li>\r\n                <li>Hundreds of Utility Classes</li>\r\n                <li>Font Icons(font-awesome, glyphicons, material design icons)</li>\r\n                <li>HTML5 &amp; CSS3</li>\r\n                <li>Bootstrap 3.3.6 Framework</li>\r\n                <li>Sass for CSS preprocessing (compiled CSS included)</li>\r\n                <li>Grunt Tasks Manager</li>\r\n                <li>Bower Dependency Management</li>\r\n                <li>Clean and Friendly Code</li>\r\n              </ul>\r\n            </div>\r\n          </div><!-- .m-l-lg -->', 'Linkedin', 'Facebook', 'Instagram', 'Zoom Link', '', 1, '2019-06-17 20:00:32'),
(5, 'safigul', 'safigül yıldız', 'noAvatar.png', 'safigul@gmail.com', 2, 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '', '', '', '', '', 1, '2021-12-07 20:58:43');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `permissions` text NOT NULL,
  `isActive` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `user_roles`
--

INSERT INTO `user_roles` (`id`, `title`, `permissions`, `isActive`, `createdAt`) VALUES
(1, 'Admin', '{\"brands\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"courses\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"dashboard\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"emailsettings\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"galleries\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"mentor\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"news\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"popups\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"portfolio\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"portfolio_categories\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"product\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"program_info\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"references\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"services\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"settings\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"slides\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"testimonials\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"userop\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"users\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"},\"user_roles\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\",\"special\":\"on\"}}', 1, '2019-06-17 18:40:43'),
(2, 'Mentor', '{\"brands\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"courses\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"dashboard\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"emailsettings\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"galleries\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"mentor\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"news\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"popups\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"portfolio\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"portfolio_categories\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"product\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"program_info\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"references\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"services\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"settings\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"slides\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"testimonials\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"userop\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"users\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"},\"user_roles\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"}}', 1, '2019-06-17 18:41:03'),
(3, 'Mentee', '{\"userop\":{\"read\":\"on\",\"write\":\"on\",\"update\":\"on\",\"delete\":\"on\"}}', 1, '2019-06-19 23:39:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `videos`
--

CREATE TABLE `videos` (
  `id` int(11) UNSIGNED NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `rank` int(255) DEFAULT NULL,
  `isActive` tinyint(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `videos`
--

INSERT INTO `videos` (`id`, `gallery_id`, `url`, `rank`, `isActive`, `createdAt`) VALUES
(5, 13, 'RX8zo8gPSSE', 0, 1, '2019-06-17 10:51:53'),
(6, 13, 'INn8M6-vniA', 0, 1, '2019-06-17 10:53:22'),
(7, 13, 'INn8M6-vniAaaa', 0, 1, '2019-06-17 10:54:11');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `program_infos`
--
ALTER TABLE `program_infos`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `references`
--
ALTER TABLE `references`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Tablo için AUTO_INCREMENT değeri `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Tablo için AUTO_INCREMENT değeri `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `popups`
--
ALTER TABLE `popups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Tablo için AUTO_INCREMENT değeri `program_infos`
--
ALTER TABLE `program_infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `references`
--
ALTER TABLE `references`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
