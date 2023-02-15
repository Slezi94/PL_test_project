-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2023. Feb 10. 12:24
-- Kiszolgáló verziója: 8.0.27
-- PHP verzió: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `welove_test`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE IF NOT EXISTS `owners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `owner_email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `owners`
--

INSERT INTO `owners` (`id`, `name`, `email`) VALUES
(1, 'Test Owner', 'test@test.io'),
(2, 'dsafdsa', 'testowner1@test.com'),
(8, 'dsafdsaf', 'dsafdsaf'),
(25, 'Teszt Elek', 'elek@teszt.com'),
(26, 'Asd Asd', 'asd@asd.com'),
(27, 'Asd Dsa', 'asd2@asd.com'),
(28, 'Asd Asd', 'asd1@asd.com'),
(29, 'Teszt István', 'istvan@teszt.com'),
(30, 'Tesz Pista', 'pista@teszt.com'),
(31, 'Teszt Juli', 'juli@teszt.com'),
(32, 'Teszt Piroska', 'piroska@teszt.com'),
(33, 'Teszt Béla', 'bela@teszt.com');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Phasellus porttitor molestie erat. Mauris vulputate at arcu at elementum. Etiam faucibus varius porta. Donec in magna in lorem congue varius vel in elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed sit amet diam molestie, elementum mi dapibus, egestas libero. Duis sem lectus, laoreet quis semper nec, mattis eget ex. Integer ac lobortis tortor. Sed at varius ipsum. Cras eget lacus non turpis egestas faucibus. Morbi vel iaculis felis, sed lobortis nunc. Donec placerat magna id quam vestibulum accumsan.'),
(2, 'Pellentesque bibendum vehicula sapien, a molestie velit pharetra nec.', 'Donec eget neque nec eros interdum porta. Quisque quis tempor massa, et pellentesque dolor. Phasellus accumsan velit ut porttitor hendrerit. Donec sodales diam id vehicula aliquam. Praesent ut lorem quis neque aliquet tincidunt et a eros. Pellentesque non vulputate elit. Sed auctor neque id velit porttitor, vitae interdum turpis blandit. Nulla cursus eros accumsan justo aliquet, ut egestas diam mollis. Sed gravida orci nisl, quis tristique dui consectetur eget. Donec at nisl ac libero imperdiet tempor et ac diam. Phasellus vitae nibh sed tortor fringilla placerat id at lacus.'),
(31, 'Teszt 1', 'Teszt leírás'),
(32, 'Teszt 2', 'Teszt leírás'),
(33, 'Teszt 3', 'Teszt leírás'),
(34, 'Teszt 3', 'Teszt leírás'),
(35, 'Teszt 4', 'Teszt leírás'),
(36, 'Teszt 5', 'Teszt leírás'),
(37, 'Teszt 6', 'Teszt'),
(38, 'Teszt 7', 'Teszt'),
(39, 'Teszt 8', 'Teszt');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `project_owner_pivot`
--

DROP TABLE IF EXISTS `project_owner_pivot`;
CREATE TABLE IF NOT EXISTS `project_owner_pivot` (
  `project_id` int NOT NULL,
  `owner_id` int NOT NULL,
  KEY `fk_project_owner_pivot_projects1_idx` (`project_id`),
  KEY `fk_project_owner_pivot_owners1_idx` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `project_owner_pivot`
--

INSERT INTO `project_owner_pivot` (`project_id`, `owner_id`) VALUES
(1, 1),
(2, 1),
(31, 25),
(32, 26),
(33, 27),
(34, 28),
(35, 29),
(36, 30),
(37, 31),
(38, 32),
(39, 33);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `project_status_pivot`
--

DROP TABLE IF EXISTS `project_status_pivot`;
CREATE TABLE IF NOT EXISTS `project_status_pivot` (
  `project_id` int NOT NULL,
  `status_id` int NOT NULL,
  UNIQUE KEY `project_id_UNIQUE` (`project_id`),
  KEY `fk_project_status_pivot_statuses1_idx` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `project_status_pivot`
--

INSERT INTO `project_status_pivot` (`project_id`, `status_id`) VALUES
(1, 1),
(2, 2),
(39, 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_UNIQUE` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `statuses`
--

INSERT INTO `statuses` (`id`, `key`, `name`) VALUES
(1, 'todo', 'Fejlesztésre vár'),
(2, 'in_progress', 'Folyamatban'),
(3, 'done', 'Kész');

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `project_owner_pivot`
--
ALTER TABLE `project_owner_pivot`
  ADD CONSTRAINT `fk_project_owner_pivot_owners1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`),
  ADD CONSTRAINT `fk_project_owner_pivot_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Megkötések a táblához `project_status_pivot`
--
ALTER TABLE `project_status_pivot`
  ADD CONSTRAINT `fk_project_status_pivot_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `fk_project_status_pivot_statuses1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
