-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Apr 2023 um 18:45
-- Server-Version: 10.4.27-MariaDB
-- PHP-Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bibliothek`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ausleihe`
--

CREATE TABLE `ausleihe` (
  `ausleheID` int(8) UNSIGNED NOT NULL,
  `ausleiherID` int(6) UNSIGNED NOT NULL,
  `ausleiheDatum` date NOT NULL DEFAULT curdate(),
  `rueckgabeDatum` date NOT NULL,
  `ausleiheStatusID` int(2) UNSIGNED NOT NULL DEFAULT 1,
  `bemerkung` text DEFAULT NULL,
  `bearbeiterID` int(6) UNSIGNED NOT NULL,
  `buchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `ausleihe`
--
DELIMITER $$
CREATE TRIGGER `rueckgabeDatum_trigger` BEFORE INSERT ON `ausleihe` FOR EACH ROW SET
--    NEW.ausleiheDatum = IFNULL(NEW.ausleiheDatum, NOW()),
    NEW.rueckgabeDatum = IFNULL(NEW.rueckgabeDatum, TIMESTAMPADD(DAY, 14, NOW()))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ausleihestatus`
--

CREATE TABLE `ausleihestatus` (
  `ausleiheStatusID` int(2) UNSIGNED NOT NULL,
  `ausleiheStatus` varchar(30) NOT NULL DEFAULT 'in Ordnung' CHECK (`ausleiheStatus` in ('in Ordnung','1.Mahnung','2.Mahnung','gloescht','zurueckgegeben'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `ausleihestatus`
--

INSERT INTO `ausleihestatus` (`ausleiheStatusID`, `ausleiheStatus`) VALUES
(1, 'in Ordnung'),
(2, '1.Mahnung'),
(3, '2.Mahnung'),
(4, 'gloescht'),
(5, 'zurueckgegeben');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `benutzerID` int(6) UNSIGNED NOT NULL,
  `benutzerName` varchar(30) DEFAULT NULL,
  `benutzerVorname` varchar(30) NOT NULL,
  `benutzerNachName` varchar(30) NOT NULL,
  `kontoPasswort` varchar(255) DEFAULT (`benutzerNachName` + year(current_timestamp())),
  `benutzerEmail` varchar(50) NOT NULL,
  `benutzerStatusID` int(2) UNSIGNED DEFAULT NULL,
  `einrichtungID` int(4) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`benutzerID`, `benutzerName`, `benutzerVorname`, `benutzerNachName`, `kontoPasswort`, `benutzerEmail`, `benutzerStatusID`, `einrichtungID`) VALUES
(1, '1_benutzerName', '1_benutzerVorname', '1_benutzerNachName', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '1_email@e.com', 1, 14), -- kontoPasswort: 1
(2, '2_benutzerName', '2_benutzerVorname', '2_benutzerNachName', '14599a81b0f8047e7d2ac8798768028481650812383e0b8d97dbfbdfb30363fc', '2_email@e.com', 2, 14), -- kontoPasswort: 2_kontoPasswort
(3, '3_benutzerName', '3_benutzerVorname', '3_benutzerNachName', '4295aa956c75cfdf014783e54dc8dac0b3a46eca33fe4e96cbd66dabd24c6495', '3_email@e.com', 3, 14), -- kontoPasswort: 3_kontoPasswort
(4, '4_benutzerName', '4_benutzerVorname', '4_benutzerNachName', '4c4787320a09cf35b66e31bdf275294c4f209610f48c860452f9f008ab572f73', '4_email@e.com', 4, 15), -- kontoPasswort: 4_kontoPasswort
(5, '5_benutzerName', '5_benutzerVorname', '5_benutzerNachName', '73c60ab1b64bccd39458ac0cffb3366c312ddef398121eff76a41f4728a99399', '5_email@e.com', 3, 15); -- kontoPasswort: 5_kontoPasswort

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzerstatus`
--

CREATE TABLE `benutzerstatus` (
  `benutzerStatusID` int(2) UNSIGNED NOT NULL,
  `benutzerStatus` varchar(30) DEFAULT NULL CHECK (`benutzerStatus` in ('admin','bibliotheker','interneBenutzer','externeBenutzer'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `benutzerstatus`
--

INSERT INTO `benutzerstatus` (`benutzerStatusID`, `benutzerStatus`) VALUES
(1, 'admin'),
(2, 'bibliotheker'),
(3, 'interneBenutzer'),
(4, 'externeBenutzer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bibliotheken`
--

CREATE TABLE `bibliotheken` (
  `bibliothekID` int(4) UNSIGNED NOT NULL,
  `bibliothekName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `bibliotheken`
--

INSERT INTO `bibliotheken` (`bibliothekID`, `bibliothekName`) VALUES
(1, 'Rechtswissenschaftliches Seminar'),
(2, 'Gemeinschaftsbibliothek internationales Recht'),
(3, 'Institut für gewerblichen Rechtsschutz und Urheberrecht'),
(4, 'Institut für Deutsches und Europäisches Arbeits- und Sozialrecht'),
(5, 'Institut für Arbeits- und Wirtschaftsrecht'),
(6, 'Institut für Römisches Recht'),
(7, 'Institut für Neuere Privatrechtsgeschichte, Deutsche und Rheinische Rechtsgeschichte'),
(8, 'Institut für Versicherungsrecht'),
(9, 'Institut für Verfahrensrecht'),
(10, 'Institut für Medizinrecht'),
(11, 'Lehrstuhl für Bürgerliches Recht, Bilanz- und Steuerrecht'),
(12, 'Institut für Medienrecht und Kommunikationsrecht'),
(13, 'Institut für Anwaltsrecht'),
(14, 'Institut für Strafrecht und Strafprozessrecht'),
(15, 'Institut für Kriminologie'),
(16, 'Institut für Religionsrecht'),
(17, 'Institut für Steuerrecht'),
(18, 'Seminar für Staatsphilosophie und Rechtspolitik'),
(19, 'Institut für Luftrecht, Weltraumrecht und Cyberrecht'),
(20, 'Institut für Öffentliches Recht und Verwaltungslehre'),
(21, 'Institut für osteuropäisches Recht und Rechtsvergleichung'),
(22, 'Institut für Staatsrecht'),
(23, 'Lehrstuhl für Staats- und Verwaltungsrecht, Institut für Deutsches und Europäisches Wissenschaftsrecht');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buchstatus`
--

CREATE TABLE `buchstatus` (
  `buchStatusID` int(2) UNSIGNED NOT NULL,
  `buchStatus` varchar(30) NOT NULL DEFAULT 'Vorhanden' CHECK (`buchStatus` in ('vorhanden','ausgelieht','vermisst','gloescht'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `buchstatus`
--

INSERT INTO `buchstatus` (`buchStatusID`, `buchStatus`) VALUES
(1, 'vorhanden'),
(2, 'ausgelieht'),
(3, 'vermisst'),
(4, 'gloescht');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buchstatusaenderung`
--

CREATE TABLE `buchstatusaenderung` (
  `buchStatusAenderungID` int(11) NOT NULL,
  `gemeldeterBuchStatus` varchar(30) NOT NULL CHECK (`gemeldeterBuchStatus` in ('vorhanden','ausgelieht','vermisst','gloescht')),
  `aenderungZeitpunkt` date DEFAULT NULL,
  `buchStatusAenderungBesitzerID` int(6) UNSIGNED DEFAULT NULL,
  `buchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `buchstatusaenderung`
--

INSERT INTO `buchstatusaenderung` (`buchStatusAenderungID`, `gemeldeterBuchStatus`, `aenderungZeitpunkt`, `buchStatusAenderungBesitzerID`, `buchID`) VALUES
(1, 'vorhanden', '2022-10-02', 2, 4),
(2, 'vorhanden', '2023-12-22', 1, 3),
(3, 'vermisst', '2022-03-12', 4, 1),
(4, 'gloescht', '2021-10-04', 2, 2),
(5, 'vorhanden', '2023-02-07', 5, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buecher`
--

CREATE TABLE `buecher` (
  `buchID` int(11) NOT NULL,
  `signatur` varchar(15) NOT NULL,
  `buchTitel` varchar(100) DEFAULT NULL,
  `autorVorname` varchar(30) DEFAULT NULL,
  `autorNachname` varchar(30) DEFAULT NULL,
  `buchAusleiheZahl` int(11) DEFAULT NULL,
  `buchStatusID` int(2) UNSIGNED DEFAULT NULL,
  `standortID` int(4) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `buecher`
--

INSERT INTO `buecher` (`buchID`, `signatur`, `buchTitel`, `autorVorname`, `autorNachname`, `buchAusleiheZahl`, `buchStatusID`, `standortID`) VALUES
(1, '1_signatur', '1_buchTitel', '1_autorVorname', '1_autorNachname', 1, 1, 1),
(2, '2_signatur', '2_buchTitel', '2_autorVorname', '2_autorNachname', 1, 1, 1),
(3, '3_signatur', '3_buchTitel', '3_autorVorname', '3_autorNachname', 1, 1, 1),
(4, '4_signatur', '4_buchTitel', '4_autorVorname', '4_autorNachname', 1, 1, 2),
(5, '5_signatur', '5_buchTitel', '5_autorVorname', '5_autorNachname', 1, 1, 2),
(6, '6_signatur', '6_buchTitel', '6_autorVorname', '6_autorNachname', 1, 1, 2),
(7, '7_signatur', '7_buchTitel', '7_autorVorname', '7_autorNachname', 1, 1, 3),
(8, '8_signatur', '8_buchTitel', '8_autorVorname', '8_autorNachname', 1, 1, 3),
(9, '9_signatur', '9_buchTitel', '9_autorVorname', '9_autorNachname', 1, 1, 3),
(10, '10_signatur', '10_buchTitel', '10_autorVorname', '10_autorNachname', 1, 1, 4),
(11, '11_signatur', '11_buchTitel', '11_autorVorname', '11_autorNachname', 1, 1, 4),
(12, '12_signatur', '12_buchTitel', '12_autorVorname', '12_autorNachname', 1, 1, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `einrichtungen`
--

CREATE TABLE `einrichtungen` (
  `einrichtungID` int(4) UNSIGNED NOT NULL,
  `kostenstelleNummer` int(9) UNSIGNED NOT NULL CHECK (`kostenstelleNummer` between 1 and 1000000000),
  `einrichtungBeschreibung` varchar(255) DEFAULT NULL,
  `einrichtungBezeichnung` varchar(255) DEFAULT NULL,
  `bibliothekID` int(4) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `einrichtungen`
--

INSERT INTO `einrichtungen` (`einrichtungID`, `kostenstelleNummer`, `einrichtungBeschreibung`, `einrichtungBezeichnung`, `bibliothekID`) VALUES
(1, 120100000, 'ReWi-Dekanat', 'Rechtsw.-Dekanat', NULL),
(2, 120100001, 'Dekan der Rechtswiss. Fakultät', 'Rechtswiss. Dekan', NULL),
(3, 120100002, 'ReWi-Prodekan für Finanzen', 'ReWi Prodek Finanzen', NULL),
(4, 120100003, 'Re-wiss. Fak. Studiendekan', 'ReWi Prodek Studiena', NULL),
(5, 120200070, 'Deutsch Französicher Magisterstudiengang', 'DeutschFranz. Mag.', NULL),
(6, 120200071, 'Studiengang Wirtschaftsjurist', 'Stg. Wirtschaftsjur.', NULL),
(7, 120200072, 'Graduiertenschule ReWi Fakultät', 'Gradschule ReWi', NULL),
(8, 120200075, 'Prüfungsamt Rechtswissenschaften', 'Prüfungsamt ReWi', NULL),
(9, 120200078, 'Kompetenzzentr. für jur.Lernen u.Lehren', 'KJLL', NULL),
(10, 120200079, 'Evaluationszentrum ReWiFak.', 'Eval.ReWi', NULL),
(11, 120200081, 'Examens-Klausurenkurs', 'Examens-Klaus.-kurs', NULL),
(12, 120200082, 'Center Transnational Law', 'Center Transn. Law', NULL),
(13, 120200083, 'Studien- und Karriereberatungszentrum', 'Stud.-u.Karriereber.', NULL),
(14, 120200085, 'Rechtswissenschaftliches Seminar Bibl.', 'Rechtsw.-Sem.Bibl.', 1),
(15, 120200086, 'Gemeinschaftsbibliothek Rechtshaus', 'Gem-bib.Rechtshs', 2),
(16, 120200089, 'ZIB ReWi Fakultät', 'ZIB ReWi Fakultät', NULL),
(17, 121000000, 'FG Zivilrecht', 'Zivilrecht', NULL),
(18, 121001001, 'Inst.f.Gewerbl.Rechtssch.u.Urheberrecht', 'IGRU', 3),
(19, 121002001, 'Dt. u. Europ. Arbeits- u. Sozialrecht', 'DtEuropArbuSozR', 4),
(20, 121003001, 'Arbeits- und Wirtschaftsrecht', 'Arb.-,Wirtschrecht', 5),
(21, 121003002, 'Arbeits- und Wirtschaftsrecht II', 'BürgRGesR', 5),
(22, 121003085, 'Arbeits- und Wirtschaftsrecht-Bibliothek', 'Arb.-Wirtschre-Bibl', 5),
(23, 121003086, 'Arbeits- und Wirtschaftsrecht-Bibliot.II', 'BürgRGesR Bib.', 5),
(24, 121004001, 'PrivatR(Internationales+Ausländisches)', 'PrivatR(Int.+Ausl.)', 2),
(25, 121005001, 'Römisches Recht', 'Römisches Recht', 6),
(26, 121006001, 'Inst.f.europäisches Wirtschaftsrecht', 'Inst.f.europ.Wirt', 2),
(27, 121007001, 'Privatrechtsgeschichte', 'Privatrechtsgesch.', 7),
(28, 121008001, 'Versicherungsrecht', 'Versicherungsrecht', 8),
(29, 121008085, 'Versicherungsrecht-Bibl', 'Vers.-recht-Bibl', 8),
(30, 121009001, 'Inst. für Verfahrensrecht', 'Verfahrensrecht', 9),
(31, 121010001, 'Medizinrecht', 'Medizinrecht', 10),
(32, 121011001, 'Inst.f.int.u.europ.Insolvenzrecht', 'Insolvenzrecht', NULL),
(33, 121012001, 'Inst.f.Nachhaltigkeit,Unternehmensrech.', 'INUR', NULL),
(34, 121050001, 'Bürgerl. Recht, Bilanz- u. Steuerrecht', 'BürgR-BilR-SteuerR', 11),
(35, 121051001, 'Bürg.R.,Hand-u.Gesell,ArbeitsREuropPrivR', 'BürHandGesArbEuPrivR', NULL),
(36, 121052001, 'HandelsRechtpp.(D-Int)-Pr', 'HandRechtpp.-Pr', NULL),
(37, 121053001, 'Bürg.Recht/Rechtstheorie', 'Bürg.Recht/Rechtsth.', NULL),
(38, 121055001, 'US-amerikanisches Recht', 'US-amerik. Recht', NULL),
(39, 121056001, 'Bürgerliches Recht und Privatrechtsvergl', 'BürgerlR-PrivRVgl.', NULL),
(40, 121057001, 'Medienrecht/Pr2', 'Medienrecht/Pr2', 12),
(41, 121058001, 'Institut für Anwaltsrecht', 'AnwR', 13),
(42, 121058040, 'Forschungsstelle Anwaltsrecht (Soldan)', 'AnwR(Soldan)', 13),
(43, 121059001, 'Kartell-u.Regulierungsrecht, R digital', 'Kartellrecht', NULL),
(44, 122000000, 'FG Strafrecht', 'Strafrecht', NULL),
(45, 122001000, 'Institut für Straf-/Strafprozeßrecht', 'Straf-/-prozeßrecht', 14),
(46, 122001001, 'Straf/Strafprozeßr./LSt1', 'Straf/-prozeßr./Pr1', 14),
(47, 122001002, 'Professur für Strafrecht und Strafprozes', 'Straf/-prozeßr./Pr2', 14),
(48, 122001003, 'Straf/Strafprozeßr./Pr3', 'Straf/-prozeßr./Pr3', 14),
(49, 122001004, 'Straf/Strafprozeßr./Pr4', 'Straf/-prozeßr./Pr4', 14),
(50, 122001005, 'Straf/Strafprozeßr./Pr5', 'Straf/-prozeßr./Pr5', 14),
(51, 122001006, 'Junprof.f.Straf-und Strafprozessrecht', 'Straf/-prozeßrecht', 14),
(52, 122001085, 'Straf-/Strafprozeßrecht-Bibl', 'Straf/-prozeßr.-Bib', 14),
(53, 122002001, 'Ausländisches, InternationalesStrafR', 'Ausl.-IntStrafR', 2),
(54, 122003001, 'Kriminologie', 'Kriminologie', 15),
(55, 123000000, 'FG Öffentliches Recht', 'Öffentl. Recht', NULL),
(56, 123001001, 'Völkerrecht', 'Völkerrecht', 2),
(57, 123002001, 'Öffentliches Recht und Religionsrecht', 'Religionsrecht', 16),
(58, 123002085, 'Kirchenrecht-Bibl', 'Kirchenrecht-Bibl', 16),
(59, 123003001, 'Steuerrecht', 'Steuerrecht', 17),
(60, 123004001, 'Staatsphilosophie', 'Staatsphilosophie', 18),
(61, 123005001, 'Luft-Weltraumrecht', 'Luft-Weltraumrecht', 19),
(62, 123006040, 'International Investment Law (Jun)', 'Int.Investm. Law Jun', NULL),
(63, 123007001, 'Öffentl. Recht-Verwaltungslehre', 'Öffentl. Recht-VerwL', 20),
(64, 123008001, 'Inst.f.osteurop.Recht u.Rechtvergl.', 'IORR', 21),
(65, 123008002, 'Ostrecht, Öffentl. Recht', 'Ostrecht,Öff.Recht', 21),
(66, 123009001, 'Staatsrecht', 'Staatsrecht', 22),
(67, 123010001, 'Inst.f.Dt. u. Eur. Wissenschaftsrecht', 'Wissenschaftsrecht', 23),
(68, 123031001, 'Staats-Verwaltungs-Wissenschafts-MedienR', 'Staats-Verw-WissMedR', 23),
(69, 123032001, 'Öffentl. Recht, Völker-und Europarecht', 'Öff.R.Völker-EuropaR', 2),
(70, 123033001, 'Öffentliches Recht', 'Öffentliches Recht', NULL),
(71, 123034001, 'Öffentl.Recht,Medien-u. Kommunikat.Recht', 'Öff.R,Medien-KommR', 12),
(72, 129000000, 'ReWi Zentrale Forschungseinrichtungen', 'ReWiZent-Forsch-einr', NULL),
(73, 129000001, 'Medien- u. Kommunikationsrecht', 'Medien-KommR', 12),
(74, 129000002, 'Institut für Friedenssicherungsrecht', 'Friedenssicher.recht', 14),
(75, 129000003, 'Europäisches Zentrum für Freie Berufe', 'Zentrum Freie Berufe', NULL),
(76, 129000004, 'Academy for European Rights Protection', 'Acad.Europ.RightsP', 21),
(77, 129000005, 'FoSt Recht+Ethik digitale Transformation', 'Digit.Transformation', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `standorte`
--

CREATE TABLE `standorte` (
  `standortID` int(4) UNSIGNED NOT NULL,
  `standortBezeichnung` varchar(255) NOT NULL,
  `bibliothekID` int(4) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `standorte`
--

INSERT INTO `standorte` (`standortID`, `standortBezeichnung`, `bibliothekID`) VALUES
(1, '1_standortBezeichnung', 1),
(2, '2_standortBezeichnung', 1),
(3, '3_standortBezeichnung', 2),
(4, '4_standortBezeichnung', 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ausleihe`
--
ALTER TABLE `ausleihe`
  ADD PRIMARY KEY (`ausleheID`),
  ADD KEY `fk_ausleihe_buch` (`buchID`),
  ADD KEY `fk_ausleihe_benutzerAusleiher` (`ausleiherID`),
  ADD KEY `fk_ausleihe_benutzerBearbeiter` (`bearbeiterID`),
  ADD KEY `fk_ausleihe_ausleiheStatus` (`ausleiheStatusID`);

--
-- Indizes für die Tabelle `ausleihestatus`
--
ALTER TABLE `ausleihestatus`
  ADD PRIMARY KEY (`ausleiheStatusID`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`benutzerID`),
  ADD UNIQUE KEY `benutzerEmail` (`benutzerEmail`),
  ADD KEY `fk_benutzer_kostenstelle` (`einrichtungID`),
  ADD KEY `fk_benutzer_benutzerStatus` (`benutzerStatusID`);

--
-- Indizes für die Tabelle `benutzerstatus`
--
ALTER TABLE `benutzerstatus`
  ADD PRIMARY KEY (`benutzerStatusID`);

--
-- Indizes für die Tabelle `bibliotheken`
--
ALTER TABLE `bibliotheken`
  ADD PRIMARY KEY (`bibliothekID`);

--
-- Indizes für die Tabelle `buchstatus`
--
ALTER TABLE `buchstatus`
  ADD PRIMARY KEY (`buchStatusID`);

--
-- Indizes für die Tabelle `buchstatusaenderung`
--
ALTER TABLE `buchstatusaenderung`
  ADD PRIMARY KEY (`buchStatusAenderungID`),
  ADD KEY `fk_buchstatus_buch` (`buchID`),
  ADD KEY `fk_buchStatusAenderungBesitzer_benutzer` (`buchStatusAenderungBesitzerID`);

--
-- Indizes für die Tabelle `buecher`
--
ALTER TABLE `buecher`
  ADD PRIMARY KEY (`buchID`),
  ADD UNIQUE KEY `signatur` (`signatur`),
  ADD KEY `signatur_2` (`signatur`),
  ADD KEY `buchTitel` (`buchTitel`),
  ADD KEY `fk_buch_standort` (`standortID`),
  ADD KEY `fk_buch_buchStatus` (`buchStatusID`);

--
-- Indizes für die Tabelle `einrichtungen`
--
ALTER TABLE `einrichtungen`
  ADD PRIMARY KEY (`einrichtungID`),
  ADD UNIQUE KEY `kostenstelleNummer` (`kostenstelleNummer`),
  ADD KEY `fk_einrichtungen_bibliotheken` (`bibliothekID`);

--
-- Indizes für die Tabelle `standorte`
--
ALTER TABLE `standorte`
  ADD PRIMARY KEY (`standortID`),
  ADD UNIQUE KEY `standortBezeichnung` (`standortBezeichnung`),
  ADD KEY `fk_standort_bibliothek` (`bibliothekID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ausleihe`
--
ALTER TABLE `ausleihe`
  MODIFY `ausleheID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `benutzerID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `benutzerstatus`
--
ALTER TABLE `benutzerstatus`
  MODIFY `benutzerStatusID` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `bibliotheken`
--
ALTER TABLE `bibliotheken`
  MODIFY `bibliothekID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `buchstatus`
--
ALTER TABLE `buchstatus`
  MODIFY `buchStatusID` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `buchstatusaenderung`
--
ALTER TABLE `buchstatusaenderung`
  MODIFY `buchStatusAenderungID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `buecher`
--
ALTER TABLE `buecher`
  MODIFY `buchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `einrichtungen`
--
ALTER TABLE `einrichtungen`
  MODIFY `einrichtungID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT für Tabelle `standorte`
--
ALTER TABLE `standorte`
  MODIFY `standortID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `ausleihe`
--
ALTER TABLE `ausleihe`
  ADD CONSTRAINT `fk_ausleihe_ausleiheStatus` FOREIGN KEY (`ausleiheStatusID`) REFERENCES `ausleihestatus` (`ausleiheStatusID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ausleihe_benutzerAusleiher` FOREIGN KEY (`ausleiherID`) REFERENCES `benutzer` (`benutzerID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ausleihe_benutzerBearbeiter` FOREIGN KEY (`bearbeiterID`) REFERENCES `benutzer` (`benutzerID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ausleihe_buch` FOREIGN KEY (`buchID`) REFERENCES `buecher` (`buchID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints der Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD CONSTRAINT `fk_benutzer_benutzerStatus` FOREIGN KEY (`benutzerStatusID`) REFERENCES `benutzerstatus` (`benutzerStatusID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_benutzer_kostenstelle` FOREIGN KEY (`einrichtungID`) REFERENCES `einrichtungen` (`einrichtungID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `buchstatusaenderung`
--
ALTER TABLE `buchstatusaenderung`
  ADD CONSTRAINT `fk_buchStatusAenderungBesitzer_benutzer` FOREIGN KEY (`buchStatusAenderungBesitzerID`) REFERENCES `benutzer` (`benutzerID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_buchstatus_buch` FOREIGN KEY (`buchID`) REFERENCES `buecher` (`buchID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `buecher`
--
ALTER TABLE `buecher`
  ADD CONSTRAINT `fk_buch_buchStatus` FOREIGN KEY (`buchStatusID`) REFERENCES `buchstatus` (`buchStatusID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_buch_standort` FOREIGN KEY (`standortID`) REFERENCES `standorte` (`standortID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `einrichtungen`
--
ALTER TABLE `einrichtungen`
  ADD CONSTRAINT `fk_einrichtungen_bibliotheken` FOREIGN KEY (`bibliothekID`) REFERENCES `bibliotheken` (`bibliothekID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `standorte`
--
ALTER TABLE `standorte`
  ADD CONSTRAINT `fk_standort_bibliothek` FOREIGN KEY (`bibliothekID`) REFERENCES `bibliotheken` (`bibliothekID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
