-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 jun 2023 om 23:42
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training_factory`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230606130319', '2023-06-06 15:03:30', 51),
('DoctrineMigrations\\Version20230606130711', '2023-06-06 15:07:16', 139);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `max_persons` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lesson`
--

INSERT INTO `lesson` (`id`, `time`, `date`, `location`, `max_persons`, `user_id`, `training_id`) VALUES
(1, '09:33:47', '2023-06-08', 'checkOne', 2, 1, 2),
(2, '12:14:19', '2014-06-19', 'Super New', 2, 2, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `training`
--

INSERT INTO `training` (`id`, `name`, `description`, `duration`, `photo`) VALUES
(1, 'Boksen', 'Beschrijving van boksen', 'Duur van boksen', 'img/template.jpg'),
(2, 'Kickboksen', 'Beschrijving van kickboksen', 'Duur van kickboksen', 'img/template.jpg'),
(3, 'Mixed Martial Arts (MMA)', 'Beschrijving van MMA', 'Duur van MMA', 'img/template.jpg'),
(4, 'Stootzak Training', 'Beschrijving van stootzak training', 'Duur van stootzak training', 'img/template.jpg'),
(5, 'Bootcamp', 'Beschrijving van bootcamp', 'Duur van bootcamp', 'img/template.jpg'),
(6, 'Ftiness-uur', 'Beschrijving van fitness-uur', 'Duur van fitness-uur', 'img/template.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$E4u5HJLbj0nrw/ZAPWq6Ouj2PsDxdWRuE2mee1z6UzvqDDyLFwADS'),
(2, 'some@guy.com', '[\"ROLE_MEMBER\"]', '$2y$13$tCNxi4ny2ePNMs5Uo9AQ5eYGGDQzrU9hVGWBbPztFEpo6X4LKOM/a'),
(3, 'Bezoeker@trainingfactory.com', '[\"ROLE_MEMBER\"]', '$2y$13$c.XjhQEfkyV3HZVRIZxxde19c4IhAaV5daOLNkwaOmJZdhrJoTE9q'),
(4, 'new@member.com', '[\"ROLE_MEMBER\"]', '$2y$13$AHRMIxY9bkA875H/9xLuBeKV7SZC3p8Q1z5vsX4FEt9X/BUmXo02C'),
(5, 'eeverything@gucci.com', '[\"ROLE_MEMBER\"]', '$2y$13$JPGYLFqF5Oj8fryDihHlYeCd8wgnSINelBYviJIUUh/HmT7emnqcu'),
(6, 'check@check.com', '[\"ROLE_MEMBER\"]', '$2y$13$z761ynHFJ9xn/7ePr/Ieu.Rma/psd17zt78SLyF/1JkmrXpWKpVPW'),
(7, 'instructor@admin.com', '[\"ROLE_INSTRUCTOR\"]', '$2y$13$H0EGb7RT9cw.RGHCK/RFqe509liDQojngMyxkiNZ6QlizbSsldWTa'),
(8, 'member@trainingfactory.com', '[\"ROLE_MEMBER\"]', '$2y$13$sAj3Hd9SpqgZJ6rVP9jg8.21z8eUkHyaYCyP4Zj72la19qYyYkzaG'),
(9, 'head@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$Yl52XvVj7AzwFfLpDZMQJO6HFqfPe1Rx4SLZ5uq16l6iHUDcLA5JS'),
(10, 'instructor2@admin.com', '[\"ROLE_INSTRUCTOR\"]', '$2y$13$zKcvQ1j.us81Zx4FV5.f2O4cyyBWKWp39y/atNXeaIGvM08HTR/yO'),
(11, 'head2@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$Qm684Jxf6s2x6zGhY0p.bOe5LnKXKAx.vfWK8ZhpaeuVBbnyw0Z/6');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F87474F3A76ED395` (`user_id`),
  ADD KEY `IDX_F87474F3BEFD98D1` (`training_id`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62A8A7A7CDF80196` (`lesson_id`),
  ADD KEY `IDX_62A8A7A7A76ED395` (`user_id`);

--
-- Indexen voor tabel `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `FK_F87474F3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_F87474F3BEFD98D1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`);

--
-- Beperkingen voor tabel `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `FK_62A8A7A7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_62A8A7A7CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
