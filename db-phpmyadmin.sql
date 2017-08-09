-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Sie 2017, 14:08
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `selfie-cpw`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `actions`
--

CREATE TABLE `actions` (
  `id` int(8) NOT NULL,
  `action` varchar(2) NOT NULL COMMENT 'Dropdown list:\r\n\r\ntP - Take a photo\r\nsF - Share photo on facebook\r\nsI - Share photo on instagram\r\nsE - Share photo on email\r\nrT - Press RETAKE button\r\n',
  `path` varchar(255) NOT NULL COMMENT 'Path''s values:\r\n\r\ntP - Take a photo                     => link to photoUrl (name)\r\n\r\nsF - Share photo on facebook => link to facebook\r\n\r\nsI - Share photo on instagram => link to instagram\r\n\r\nsE - Share photo on email        => user''s email address\r\n\r\nrT ',
  `created_at` datetime NOT NULL COMMENT 'Format: 1970-01-01 00:00:01',
  `sessionsAppId` int(8) NOT NULL,
  `base64` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `clients`
--

CREATE TABLE `clients` (
  `id` int(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `offers` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `countries`
--

CREATE TABLE `countries` (
  `id` int(6) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `countries`
--

INSERT INTO `countries` (`id`, `name`, `short`) VALUES
(1, 'Carphone Warehouse', 'CPW');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `languages`
--

CREATE TABLE `languages` (
  `id` int(6) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `languages`
--

INSERT INTO `languages` (`id`, `name`, `short`) VALUES
(1, 'English', 'UK');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessionsapps`
--

CREATE TABLE `sessionsapps` (
  `id` int(8) NOT NULL,
  `sesId` varchar(32) DEFAULT NULL,
  `appId` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` varchar(1) DEFAULT '0',
  `emailStatus` varchar(1) DEFAULT '0',
  `shareEmail` varchar(255) DEFAULT NULL,
  `clientId` int(8) DEFAULT NULL,
  `storeId` int(8) DEFAULT NULL,
  `languageId` int(6) DEFAULT NULL,
  `countryId` int(6) DEFAULT NULL,
  `shareEmailStatus` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `settings`
--

CREATE TABLE `settings` (
  `id` int(6) NOT NULL,
  `param` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8 DEFAULT 'Email'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stores`
--

CREATE TABLE `stores` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `countryId` int(6) NOT NULL,
  `count` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `stores`
--

INSERT INTO `stores` (`id`, `name`, `countryId`, `count`) VALUES
(1, 'Bolton Middlebrook', 1, '0'),
(3, 'Basildon Great Oaks', 1, '0'),
(4, 'Telford Forge Pod', 1, '0'),
(5, 'Greenford', 1, '0'),
(7, 'Southampton Hedge End Retail Park', 1, '0'),
(8, 'Hull Kingston Park', 1, '0'),
(9, 'Birmingham New Street', 1, '0'),
(10, 'Reading Broad Street', 1, '0'),
(11, 'Southampton Above Bar', 1, '0'),
(12, 'Grantham High Street', 1, '0'),
(13, 'Tonbridge', 1, '0'),
(14, 'Doncaster Frenchgate', 1, '0'),
(15, 'St Helens Ravenhead Pod', 1, '0'),
(16, 'Edinburgh Fort Kinnaird', 1, '0'),
(17, 'Oldbury', 1, '0'),
(18, 'Southport Kew', 1, '0'),
(19, 'Sheffield Fargate', 1, '0'),
(20, 'Leeds Briggate', 1, '0'),
(21, 'Great Yarmouth', 1, '0'),
(22, 'Stockport Portwood', 1, '0'),
(23, 'Poole Falkland Square', 1, '0'),
(24, 'Bluewater Lower', 1, '0'),
(25, 'Merry Hill Centre Upper', 1, '0'),
(26, 'Brighton Churchill Square', 1, '0'),
(27, 'Gateshead Metro Centre Lower Yellow', 1, '0'),
(28, 'Haywards Heath', 1, '0'),
(29, 'Portsmouth Commercial Road', 1, '0'),
(30, 'Edinburgh Ocean Terminal', 1, '0'),
(31, 'Hornchurch', 1, '0'),
(32, 'Saffron Walden', 1, '0'),
(33, 'Manchester Arndale', 1, '0'),
(34, 'Wood Green Mall', 1, '0'),
(35, 'Bristol Broadmead', 1, '0'),
(37, 'Trafford Centre Lower', 1, '0'),
(38, 'Leeds White Rose', 1, '0'),
(39, 'White City', 1, '0'),
(40, 'St Neots', 1, '0'),
(41, 'Petersfield', 1, '0'),
(42, 'Belfast Castle Court', 1, '0'),
(43, 'Paignton', 1, '0'),
(44, 'Salisbury New Canal', 1, '0'),
(45, 'Blackpool Houndshill Centre', 1, '0'),
(46, 'Luton Arndale', 1, '0'),
(47, 'Taunton Fore Street', 1, '0'),
(48, 'Cardiff Capital', 1, '0'),
(49, 'Brent Cross', 1, '0'),
(50, 'Glasgow Braehead Centre', 1, '0'),
(51, 'Glasgow Forge Pod', 1, '0'),
(52, 'Aberdeen Union Square', 1, '0'),
(53, 'Neath', 1, '0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `login` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `pass` varchar(32) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session` (`sessionsAppId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessionsapps`
--
ALTER TABLE `sessionsapps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client` (`clientId`),
  ADD KEY `country` (`countryId`),
  ADD KEY `language` (`languageId`),
  ADD KEY `store` (`storeId`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopcountry` (`countryId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `sessionsapps`
--
ALTER TABLE `sessionsapps`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `session` FOREIGN KEY (`sessionsAppId`) REFERENCES `sessionsapps` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `sessionsapps`
--
ALTER TABLE `sessionsapps`
  ADD CONSTRAINT `client` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `country` FOREIGN KEY (`countryId`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `language` FOREIGN KEY (`languageId`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `store` FOREIGN KEY (`storeId`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `shopcountry` FOREIGN KEY (`countryId`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
