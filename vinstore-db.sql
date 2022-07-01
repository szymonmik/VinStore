-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Sty 2022, 11:06
-- Wersja serwera: 10.4.19-MariaDB
-- Wersja PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `vinstore-db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logged_in_users`
--

CREATE TABLE `logged_in_users` (
  `sessionId` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productsId` varchar(255) NOT NULL,
  `quantities` varchar(100) NOT NULL,
  `price` float DEFAULT NULL,
  `status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `year` int(10) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `duration` varchar(10) DEFAULT NULL,
  `cover` varchar(1000) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `stock` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `title`, `artist`, `genre`, `year`, `description`, `duration`, `cover`, `price`, `stock`) VALUES
(1, 'Suffer', 'Bad Religion', 'Punk', 1988, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '26:13', 'BadReligionSuffer.jpg', 119.99, 20),
(2, 'No Control', 'Bad Religion', 'Punk', 1989, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '26:25', 'BadReligionNoControl.jpg', 139.99, 15),
(3, 'Against The Grain', 'Bad Religion', 'Punk', 1990, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '34:27', 'BadReligionAgainstTheGrain.jpg', 180, 20),
(4, 'The Dark Side of the Moon', 'Pink Floyd', 'Rock progresywny', 1973, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '43:00', 'PinkFloydTheDarkSideOfTheMoon.jpg', 120, 40),
(5, 'Lucky/Shattered Milo', 'Descendents', 'Punk', 1996, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '5:00', 'DescendentsLuckyShatteredMilo.jpg', 60, 6),
(6, '9th & Walnut', 'Descendents', 'Punk', 2021, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '34:27', 'Descendents9thWalnut.jpg', 129, 9),
(7, 'Scream Bloody Gore', 'Death', 'Death Metal', 1987, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '37:51', 'DeathScreamBloodyGore.jpg', 150, 14),
(8, 'Leprosy', 'Death', 'Death Metal', 1988, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '38:24', 'DeathLeprosy.jpg', 160, 12),
(9, 'The Sound of Perseverance', 'Death', 'Death Metal', 1998, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '56:21', 'DeathTheSoundOfPerseverance.jpg', 170, 8),
(10, 'Atom Heart Mother', 'Pink Floyd', 'Rock progresywny', 1970, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis eleifend leo. Suspendisse diam dui, maximus a sagittis sollicitudin, ultrices quis est. Praesent in risus nibh. Nunc ullamcorper mi justo. Proin porttitor nisl ac nulla mattis rhoncus. Nunc vitae nisl maximus, accumsan lorem et, efficitur nulla. Cras quis venenatis leo. Nulla felis urna, convallis at pellentesque eget, porttitor eget mauris. Mauris volutpat dolor at nisi consequat, non sollicitudin lectus congue. Integer maximus dictum purus, quis auctor nisl facilisis sit amet.', '52:44', 'PinkFloydAtomHeartMother.jpg', 90, 25);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `userName`, `fullName`, `email`, `passwd`, `status`, `date`) VALUES
(1, 'szyymiik', 'Szymon Mikołajczuk', 'szyymiik@gmail.com', '$2y$10$jwLmUNRBG1p611DOFCp.B.baGkSbg2zGUHyr8lAcixmIa1wvA.DOu', 1, '2022-01-23 00:00:00'),
(2, 'jk', 'Jan Kowalski', 'jan@kowalski.pl', '$2y$10$uC4d8nTkxuzX6hqrWgsvjeTTKQqMdCnl/RCKG.RH6sqsgGk1iNEEi', 1, '2022-01-24 00:00:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `logged_in_users`
--
ALTER TABLE `logged_in_users`
  ADD PRIMARY KEY (`sessionId`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`,`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
