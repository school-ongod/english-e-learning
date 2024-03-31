-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 31 mrt 2024 om 14:34
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `english e-learning`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1055) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lists`
--

INSERT INTO `lists` (`id`, `users_id`, `name`, `description`, `date_created`) VALUES
(1, 1, 'Lekker oefenen gap jaa', 'Lijstje van papier hoii', '2024-02-28 09:57:47'),
(2, 2, 'test', 'test1234', '2024-03-04 11:29:38');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lists_questions`
--

CREATE TABLE `lists_questions` (
  `id` int(11) NOT NULL,
  `lists_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `good_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lists_questions`
--

INSERT INTO `lists_questions` (`id`, `lists_id`, `question`, `good_answer`) VALUES
(21, 1, '12366', '12366'),
(22, 1, '1234', '1234'),
(23, 1, '12345', '12345'),
(34, 2, 'jaman', 'jaman'),
(35, 2, 'neeman', 'neeman'),
(36, 3, '1', '1'),
(37, 3, '1', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `date_created`) VALUES
(1, '573674@edu.rocmn.nl', 'nickhoving', '$2y$10$88lzahO03RncqsgQApMFvOrFCWydqq5QvOEzcpFfPomCDe6zHCkBu', '2024-02-27 09:56:27'),
(2, 'admin@admin.nl', 'admin', '$2y$10$vrGEAOGx4CaaNndepIgoE.Im0.rjakVKU.x7iD/rg5lFRl6SmkVwC', '2024-03-01 10:02:07');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `lists_questions`
--
ALTER TABLE `lists_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `lists_questions`
--
ALTER TABLE `lists_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
