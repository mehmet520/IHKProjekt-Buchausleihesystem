
-- TRUNCATE TABLE bibliotheken,
-- DROP TABLE bibliotheken,
-- SHOW DATABASES,
USE bibliothek;
-- SHOW TABLES,

DELETE FROM standorte;
ALTER TABLE standorte AUTO_INCREMENT=1;
-- ReWi standorte
INSERT INTO standorte (standortID, standortBezeichnung, bibliothekID ) VALUES
(1, '1_standortBezeichnung',1),
(2, '2_standortBezeichnung',1),
(3, '3_standortBezeichnung',2),
(4, '4_standortBezeichnung',2);
SELECT * FROM standorte;

DELETE FROM benutzerStatus;
ALTER TABLE benutzerStatus AUTO_INCREMENT=1;
-- ReWi benutzerStatus
INSERT INTO benutzerStatus (benutzerStatusID, benutzerStatus) VALUES
(1, 'admin'),
(2, 'bibliotheker'),
(3, 'interneBenutzer'),
(4, 'externeBenutzer');
SELECT * FROM benutzerStatus;


DELETE FROM buchStatus;
ALTER TABLE buchStatus AUTO_INCREMENT=1;
-- ReWi buchStatus
INSERT INTO buchStatus (buchStatusID, buchStatus) VALUES
(1, 'vorhanden'),
(2, 'ausgelieht'),
(3, 'vermisst'),
(4, 'gloescht');
SELECT * FROM buchStatus;

DELETE FROM buecher;
ALTER TABLE buecher AUTO_INCREMENT=1;
-- ReWi benutzerStatus
INSERT INTO buecher (`buchID`, `signatur`, `buchTitel`, `autorVorname`, 
`autorNachname`, `buchAusleiheZahl`, `buchStatusID`, `bibliothekID`) VALUES 
(1, '1_signatur', '1_buchTitel', '1_autorVorname', '1_autorNachname',11, 1, 1),
(2, '2_signatur', '2_buchTitel', '2_autorVorname', '2_autorNachname', 5, 2, 2),
(3, '3_signatur', '3_buchTitel', '3_autorVorname', '3_autorNachname',15, 2, 3),
(4, '4_signatur', '4_buchTitel', '4_autorVorname', '4_autorNachname',22, 3, 20),
(5, '5_signatur', '5_buchTitel', '5_autorVorname', '5_autorNachname', 5, 4, 11);
SELECT * FROM buecher;

DELETE FROM buchStatusAenderung;
ALTER TABLE buchStatusAenderung AUTO_INCREMENT=1;
-- ReWi benutzerStatus
INSERT INTO buchStatusAenderung (`buchStatusAenderungID`, `gemeldeterBuchStatus`, 
				`aenderungZeitpunkt`, `buchStatusAenderungBesitzerID`, `buchID`) VALUES 
(1, 'vorhanden', '2022-10-2', 2, 4),
(2, 'vorhanden', '2023-12-22', 1, 3),
(3, 'vermisst',  '2022-3-12', 4, 1),
(4, 'gloescht',  '2021-10-4', 2, 2),
(5, 'vorhanden',  '2023-2-7', 5, 1);
SELECT * FROM buchStatusAenderung;

INSERT INTO `ausleihe` (`ausleheID`, `ausleiherID`, `ausleiheDatum`, `fristDatum`, 
`rueckgabeDatum`, `ausleiheStatus`, `bemerkung`, `bearbeiterID`, `buchID`) VALUES 
(1, 1, '2022-10-2', '2022-10-14', '2022-10-16','in Ordnung', NULL, 3,1),
(2, 3, '2022-6-2', '2022-6-22', '2022-6-21','in Ordnung', NULL, 4,2),
(3, 4, '2023-2-2', '2023-2-23', 'Null','2.Mahnung', NULL, 3,4),
(4, 2, '2023-3-22', '2023-4-2', 'Null','verzögert', NULL, 3,3);
SELECT * FROM ausleihe;

DELETE FROM buecher;
ALTER TABLE buecher AUTO_INCREMENT=1;
-- ReWi benutzerStatus
INSERT INTO buecher (`buchID`, `signatur`, `buchTitel`, `autorVorname`, 
`autorNachname`, `buchAusleiheZahl`, `buchStatusID`, `bibliothekID`) VALUES 
(1, '1_signatur', '1_buchTitel', '1_autorVorname', '1_autorNachname',11, 1, 1),
(2, '2_signatur', '2_buchTitel', '2_autorVorname', '2_autorNachname', 5, 2, 2),
(3, '3_signatur', '3_buchTitel', '3_autorVorname', '3_autorNachname',15, 2, 3),
(4, '4_signatur', '4_buchTitel', '4_autorVorname', '4_autorNachname',22, 3, 20),
(5, '5_signatur', '5_buchTitel', '5_autorVorname', '5_autorNachname', 5, 4, 11);
SELECT * FROM buecher;

DELETE FROM benutzer;
ALTER TABLE benutzer AUTO_INCREMENT=1;
-- ReWi benutzerStatus
INSERT INTO benutzer (`benutzerID`, `benutzerName`, `benutzerVorname`, `benutzerNachName`, 
`kontoPasswort`, `benutzerEmail`, `benutzerStatusID`, `einrichtungID`) VALUES 
(1, '1_benutzerName', '1_benutzerVorname', '1_benutzerNachName', '1_kontoPasswort','1_email@e.com', 1, 1),
(2, '2_benutzerName', '2_benutzerVorname', '2_benutzerNachName', '2_kontoPasswort','2_email@e.com', 2, 2),
(3, '3_benutzerName', '3_benutzerVorname', '3_benutzerNachName', '3_kontoPasswort','3_email@e.com', 3, 3),
(4, '4_benutzerName', '4_benutzerVorname', '4_benutzerNachName', '4_kontoPasswort','4_email@e.com', 4, 4),
(5, '5_benutzerName', '5_benutzerVorname', '5_benutzerNachName', '5_kontoPasswort','5_email@e.com', 3, 1);
SELECT * FROM benutzer;
