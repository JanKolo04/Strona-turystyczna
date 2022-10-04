-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 04 Paź 2022, 19:49
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `turystyka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Architekci`
--

CREATE TABLE `Architekci` (
  `Id` int(255) NOT NULL,
  `Imie` varchar(255) DEFAULT NULL,
  `Nazwisko` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `Architekci`
--

INSERT INTO `Architekci` (`Id`, `Imie`, `Nazwisko`) VALUES
(1, 'Jan', 'Kołodziej'),
(2, 'Dominik', 'Szerniewicz'),
(3, 'Michał', 'Śmieszniak'),
(4, 'Wiktor', 'Kusztykiewicz'),
(5, 'Szymon', 'Zimecki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Move`
--

CREATE TABLE `Move` (
  `id_move` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `Count_visit` int(255) DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `Move`
--

INSERT INTO `Move` (`id_move`, `id_user`, `Count_visit`, `Date`) VALUES
(12, 2, 2, '2022-09-28'),
(13, 4, 3, '2022-10-01'),
(16, 1, 9, '2022-10-03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Obiekty`
--

CREATE TABLE `Obiekty` (
  `Id` int(255) NOT NULL,
  `Nazwa` varchar(255) DEFAULT NULL,
  `Kategoria` varchar(255) DEFAULT NULL,
  `Miejsce` varchar(255) DEFAULT NULL,
  `Rok_budowy` varchar(255) DEFAULT NULL,
  `Media` varchar(255) DEFAULT NULL,
  `Id_architekt` int(255) DEFAULT NULL,
  `Id_trasa` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `Obiekty`
--

INSERT INTO `Obiekty` (`Id`, `Nazwa`, `Kategoria`, `Miejsce`, `Rok_budowy`, `Media`, `Id_architekt`, `Id_trasa`) VALUES
(1, 'Młot Jana', 'Rzeźba', 'Plac Grunwaldzki', '1980', 'mlot_jana', 1, 2),
(2, 'Wielki Gąg', 'Rzeźba', 'Plac Lotników', '1920', 'wielki_gag', 3, 2),
(3, 'Pomink Janusza', 'Pomnik', 'św.Janusza', '1910', 'pomnik_janusza', 2, 1),
(4, 'Kościół Mariacki', 'Kościół', 'Plac Mariacki', '1750-1753', 'kosciol_mariacki', 4, 1),
(5, 'Pomnik Syrenki', 'Pomnik', 'Rynek Starego Miasta w Warszawie', '1940', 'pomnik_syrenki', 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Trasy`
--

CREATE TABLE `Trasy` (
  `Id` int(255) NOT NULL,
  `Nazwa` varchar(255) DEFAULT NULL,
  `Poczatek` varchar(255) DEFAULT NULL,
  `Koniec` varchar(255) DEFAULT NULL,
  `Trudnosc` varchar(255) DEFAULT NULL,
  `Opis` text DEFAULT NULL,
  `Informacje` text DEFAULT NULL,
  `Kategoria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `Trasy`
--

INSERT INTO `Trasy` (`Id`, `Nazwa`, `Poczatek`, `Koniec`, `Trudnosc`, `Opis`, `Informacje`, `Kategoria`) VALUES
(1, 'Śródmieście', 'Marka 2b', 'Oskara 53', 'Trudny', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id lorem risus. Vivamus in maximus libero, vel faucibus felis. Fusce ac purus urna. Curabitur non efficitur mauris, sed dapibus massa. Sed mauris quam, commodo quis cursus a, pulvinar ac elit. Vestibulum tristique mollis molestie. Etiam nec erat a turpis molestie lacinia non nec nibh.', 'Vivamus fermentum gravida quam, eu semper justo iaculis vitae. Vivamus dolor urna, imperdiet ut aliquet vel, egestas vel metus. Aliquam eu venenatis tellus. Vivamus non pretium odio, sed volutpat lectus. Nullam at risus a odio laoreet malesuada sed vitae lacus. Donec commodo, elit quis aliquam mattis, dui nisl hendrerit nibh, sed rhoncus arcu ipsum vel erat. Maecenas tempus facilisis vehicula. Vivamus non augue justo. Suspendisse fermentum arcu et elit dignissim, ac iaculis ligula molestie. Nunc vel leo in ligula rhoncus vestibulum. Nunc egestas dapibus orci. Ut nec velit at sapien congue egestas luctus id purus. Pellentesque massa lorem, rutrum vitae ornare et, euismod vitae mi. Cras mattis ac eros a maximus. Nulla arcu arcu, pretium et odio sed, pellentesque rhoncus augue.', 'Modernizm'),
(2, 'Półwiśle Zwierzynieckie', 'Kopernika 2b', 'Żołnierska 53', 'Średni', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id lorem risus. Vivamus in maximus libero, vel faucibus felis. Fusce ac purus urna. Curabitur non efficitur mauris, sed dapibus massa. Sed mauris quam, commodo quis cursus a, pulvinar ac elit. Vestibulum tristique mollis molestie. Etiam nec erat a turpis molestie lacinia non nec nibh.', 'Vivamus fermentum gravida quam, eu semper justo iaculis vitae. Vivamus dolor urna, imperdiet ut aliquet vel, egestas vel metus. Aliquam eu venenatis tellus. Vivamus non pretium odio, sed volutpat lectus. Nullam at risus a odio laoreet malesuada sed vitae lacus. Donec commodo, elit quis aliquam mattis, dui nisl hendrerit nibh, sed rhoncus arcu ipsum vel erat. Maecenas tempus facilisis vehicula. Vivamus non augue justo. Suspendisse fermentum arcu et elit dignissim, ac iaculis ligula molestie. Nunc vel leo in ligula rhoncus vestibulum. Nunc egestas dapibus orci. Ut nec velit at sapien congue egestas luctus id purus. Pellentesque massa lorem, rutrum vitae ornare et, euismod vitae mi. Cras mattis ac eros a maximus. Nulla arcu arcu, pretium et odio sed, pellentesque rhoncus augue.', 'Barok');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Uzytkownicy`
--

CREATE TABLE `Uzytkownicy` (
  `id_uzytkownik` int(255) NOT NULL,
  `Imie` varchar(255) DEFAULT NULL,
  `Nazwisko` varchar(255) DEFAULT NULL,
  `Email` text DEFAULT NULL,
  `Data_urodzenia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `Uzytkownicy`
--

INSERT INTO `Uzytkownicy` (`id_uzytkownik`, `Imie`, `Nazwisko`, `Email`, `Data_urodzenia`) VALUES
(1, 'Jan', 'Kołodziej', 'jankolodziej99@gmail.com', '2004-08-03'),
(2, 'Dominik', 'Szerniewicz', 'dszerniewicz24@gmail.com', '2003-03-24'),
(3, 'Szymon', 'Zimecki', 'szimecki20@gmail.com', '2003-02-20'),
(4, 'Wiktor', 'Kusztykiewicz', 'wkusztykiewicz20@gmail.com', '2003-04-20'),
(6, 'Ola', 'Kelner', 'ola2406@op.pl', '2003-06-24');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Architekci`
--
ALTER TABLE `Architekci`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `Move`
--
ALTER TABLE `Move`
  ADD PRIMARY KEY (`id_move`);

--
-- Indeksy dla tabeli `Obiekty`
--
ALTER TABLE `Obiekty`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_architekt` (`Id_architekt`),
  ADD KEY `Id_trasa` (`Id_trasa`);

--
-- Indeksy dla tabeli `Trasy`
--
ALTER TABLE `Trasy`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `Uzytkownicy`
--
ALTER TABLE `Uzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownik`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `Architekci`
--
ALTER TABLE `Architekci`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `Move`
--
ALTER TABLE `Move`
  MODIFY `id_move` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `Obiekty`
--
ALTER TABLE `Obiekty`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `Trasy`
--
ALTER TABLE `Trasy`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `Uzytkownicy`
--
ALTER TABLE `Uzytkownicy`
  MODIFY `id_uzytkownik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Obiekty`
--
ALTER TABLE `Obiekty`
  ADD CONSTRAINT `obiekty_ibfk_1` FOREIGN KEY (`Id_architekt`) REFERENCES `Architekci` (`Id`),
  ADD CONSTRAINT `obiekty_ibfk_2` FOREIGN KEY (`Id_trasa`) REFERENCES `Trasy` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
