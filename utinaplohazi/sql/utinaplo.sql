-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Sze 08. 19:49
-- Kiszolgáló verziója: 10.4.6-MariaDB
-- PHP verzió: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `utinaplo`
--
CREATE DATABASE IF NOT EXISTS `utinaplo` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `utinaplo`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `ID_user` int(11) NOT NULL,
  `Nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Jelszo` varchar(40) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`ID_user`, `Nev`, `Jelszo`) VALUES
(1, 'admin', '123456'),
(2, 'Zsuzsi', '123456'),
(3, 'Orsi', '123456'),
(4, 'Dani', '123456'),
(5, 'Gergő', '123456'),
(6, 'Rita', '123456'),
(7, 'Judit', '123456'),
(8, 'Balázs', '123456'),
(9, 'Kevin', '123456');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `utak`
--

CREATE TABLE `utak` (
  `ID_ut` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `Datum` date NOT NULL,
  `Honnan` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Hova` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `km` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `utak`
--

INSERT INTO `utak` (`ID_ut`, `ID_user`, `Datum`, `Honnan`, `Hova`, `km`) VALUES
(121, 8, '2019-04-21', 'Pécs', 'Üröm', 271),
(122, 9, '2019-03-06', 'Üröm', 'Pécs', 115),
(123, 4, '2019-05-14', 'Bécs', 'Budapest', 111),
(124, 4, '2019-10-29', 'Bécs', 'Budapest', 181),
(125, 1, '2019-07-09', 'Debrecen', 'Kassa', 283),
(126, 6, '2019-10-10', 'Göd', 'Debrecen', 198),
(127, 6, '2019-04-26', 'Göd', 'Debrecen', 83),
(128, 3, '2019-02-21', 'Miskolc', 'Vác', 102),
(129, 2, '2019-03-23', 'Budapest', 'Miskolc', 277),
(130, 6, '2019-07-12', 'Göd', 'Debrecen', 135),
(131, 1, '2019-04-02', 'Debrecen', 'Kassa', 224),
(132, 9, '2019-07-26', 'Üröm', 'Pécs', 223),
(133, 9, '2019-03-30', 'Üröm', 'Pécs', 77),
(134, 8, '2019-11-05', 'Pécs', 'Üröm', 133),
(135, 6, '2019-03-05', 'Göd', 'Debrecen', 78),
(136, 8, '2019-09-05', 'Pécs', 'Üröm', 73),
(137, 8, '2019-11-07', 'Pécs', 'Üröm', 129),
(138, 6, '2019-03-17', 'Göd', 'Debrecen', 299),
(139, 6, '2019-08-02', 'Göd', 'Debrecen', 90),
(140, 9, '2019-06-03', 'Üröm', 'Pécs', 220),
(141, 1, '2019-06-04', 'Debrecen', 'Kassa', 198),
(142, 9, '2019-07-24', 'Üröm', 'Pécs', 171),
(143, 4, '2019-04-06', 'Bécs', 'Budapest', 250),
(144, 5, '2019-07-03', 'Vác', 'Göd', 282),
(145, 4, '2019-07-03', 'Bécs', 'Budapest', 147),
(146, 5, '2019-12-15', 'Vác', 'Göd', 265),
(147, 5, '2019-02-21', 'Vác', 'Göd', 157),
(148, 4, '2019-07-26', 'Bécs', 'Budapest', 82),
(149, 3, '2019-04-03', 'Miskolc', 'Vác', 66),
(150, 7, '2019-07-27', 'Kassa', 'Bécs', 146),
(151, 8, '2019-07-09', 'Pécs', 'Üröm', 221),
(152, 7, '2019-01-07', 'Kassa', 'Bécs', 94),
(153, 1, '2019-02-01', 'Debrecen', 'Kassa', 229),
(154, 5, '2019-01-19', 'Vác', 'Göd', 294),
(155, 2, '2019-02-20', 'Budapest', 'Miskolc', 54),
(156, 6, '2019-03-24', 'Göd', 'Debrecen', 286),
(157, 4, '2019-01-01', 'Bécs', 'Budapest', 95),
(158, 8, '2019-09-01', 'Pécs', 'Üröm', 212),
(159, 1, '2019-08-27', 'Debrecen', 'Kassa', 106),
(160, 4, '2019-04-28', 'Bécs', 'Budapest', 204),
(161, 8, '2019-06-08', 'Pécs', 'Üröm', 158),
(162, 6, '2019-05-01', 'Göd', 'Debrecen', 122),
(163, 1, '2019-02-13', 'Debrecen', 'Kassa', 225),
(164, 3, '2019-01-19', 'Miskolc', 'Vác', 243),
(165, 2, '2019-07-27', 'Budapest', 'Miskolc', 126),
(166, 1, '2019-04-22', 'Debrecen', 'Kassa', 295),
(167, 2, '2019-11-20', 'Budapest', 'Miskolc', 126),
(168, 4, '2019-08-17', 'Bécs', 'Budapest', 150),
(169, 3, '2019-11-18', 'Miskolc', 'Vác', 189),
(170, 1, '2019-10-16', 'Debrecen', 'Kassa', 242),
(171, 7, '2019-01-10', 'Kassa', 'Bécs', 78),
(172, 8, '2019-10-27', 'Pécs', 'Üröm', 168),
(173, 1, '2019-12-16', 'Debrecen', 'Kassa', 279),
(174, 6, '2019-07-22', 'Göd', 'Debrecen', 237),
(175, 4, '2019-11-14', 'Bécs', 'Budapest', 270),
(176, 3, '2019-09-28', 'Miskolc', 'Vác', 143),
(177, 2, '2019-10-27', 'Budapest', 'Miskolc', 142),
(178, 5, '2019-09-14', 'Vác', 'Göd', 284),
(179, 7, '2019-11-05', 'Kassa', 'Bécs', 58),
(180, 5, '2019-12-11', 'Vác', 'Göd', 138),
(181, 1, '2019-09-03', 'Debrecen', 'Budapest', 250),
(182, 1, '2019-09-03', 'Debrecen', 'Budapest', 250);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_user`),
  ADD UNIQUE KEY `name` (`Nev`);

--
-- A tábla indexei `utak`
--
ALTER TABLE `utak`
  ADD PRIMARY KEY (`ID_ut`),
  ADD KEY `datum` (`Datum`),
  ADD KEY `user` (`ID_user`) USING BTREE;

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `utak`
--
ALTER TABLE `utak`
  MODIFY `ID_ut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `utak`
--
ALTER TABLE `utak`
  ADD CONSTRAINT `utak_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
