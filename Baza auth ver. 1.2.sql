-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 03, 2024 at 09:37 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auth`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `author` varchar(128) NOT NULL,
  `genre` varchar(128) NOT NULL,
  `datePublished` date NOT NULL,
  `pages` int(11) NOT NULL,
  `publishingHouse` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `author`, `genre`, `datePublished`, `pages`, `publishingHouse`) VALUES
(1, 'Adam Mickiewicz', 'classic', '1906-01-01', 352, 'Ossolineum'),
(2, 'Jarosław Grzędowicz', 'fantasy', '2005-01-01', 660, 'Fabryka Słów');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwordHash` varchar(128) NOT NULL,
  `firstName` varchar(128) DEFAULT NULL,
  `lastName` varchar(128) DEFAULT NULL,
  `nickname` varchar(128) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `sex` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `passwordHash`, `firstName`, `lastName`, `nickname`, `birthDate`, `sex`) VALUES
(1, 'michal2001@czytaj.pl', '$argon2i$v=19$m=65536,t=4,p=1$ZnVQbWNWblJPelN6WDE4Yw$f/e9uUjE8nrPKUKtz9A6Oletz0Pi0h5qeWMqvsORYXM', NULL, NULL, NULL, NULL, NULL),
(2, 'user1@czytaj.pl', '$argon2i$v=19$m=65536,t=4,p=1$U1dXTUQwZk1CMVR6eUZwTQ$q14Fjdgw5viL3UYCgXDfeoG5/88eqBacEmnRYR9Kc1c', NULL, NULL, NULL, NULL, NULL),
(3, 'user2@czytaj.pl', '$argon2i$v=19$m=65536,t=4,p=1$b0tXeXlObzNyUy93QTVYcg$8ptOnCROgo8o+tLd2f5sK5+7pDUaYtxTd7qOuaoER9U', NULL, NULL, NULL, NULL, NULL),
(4, 'user3@czytaj.pl', '$argon2i$v=19$m=65536,t=4,p=1$N01tNWlJbHVmSnlrQXdETA$rLkZVHYi8kMENLd4XjLHnnZDAw8oIGieDFxkuoKuh1I', NULL, NULL, NULL, NULL, NULL),
(5, 'user4@czytaj.pl', '$argon2i$v=19$m=65536,t=4,p=1$OVBIdVVSQWxhL2NvaHpjVg$DRvgjJMFdWsfxYkApZz2tr8BKyxb8yQrlGoPo06C80o', 'Jacek', 'Placek', 'Bober', '2001-12-02', '1'),
(6, 'user5@czytaj.pl', '$argon2i$v=19$m=65536,t=4,p=1$N3AxSXh4VXIvSTg3LmVMTQ$YAvu2dKSZgHS2HfqJQIyjKD+TKtZ8JR34Ks6idwJZkM', 'Karolina', 'Kowalska', 'Testerka', '1999-02-05', '1'),
(7, 'user6@czytaj.pl', '$argon2i$v=19$m=65536,t=4,p=1$MmJFZG9xaFMvaVh4cS5hcA$P68LnIt8YU2dpHc2chxG9IKF6d5Gveslt0I/2pUHdls', 'Agata', 'Nowacka', 'Testerka', '1999-06-22', '2'),
(8, 'user7@czytaj.pl', '$argon2i$v=19$m=65536,t=4,p=1$TFVpQ09ZVkVTdC9wYTl5NA$TDLFHXqi6WYHQocSoJFR2WyF2Oj7MWtmtAE91PDs93w', 'seferfq', 'egrg', 'wferf', '2024-10-29', '2'),
(9, 'rreg@e', '$argon2i$v=19$m=65536,t=4,p=1$R1BTemxocmVuZ2ppQUZMYw$XsmZeUXG3tXM4yt3mUHDcGVOj6Ligf4w03S7XNfyKxc', 'ww', 'ww', 'ww', '2024-11-18', '2');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
