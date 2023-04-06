USE bibliothek;

-- Kitap odünç alma ekranı SELF 
SELECT signatur, buchTitel AS Booktitle, autorVorname, autorNachname, bibliothekName, standortBezeichnung
FROM buecher bu
INNER JOIN bibliotheken bi USING(bibliothekID)
INNER JOIN standorte st USING(bibliothekID)
INNER JOIN ausleihe au USING (buchID)
INNER JOIN benutzer be ON be.benutzerID=au.ausleiherID
WHERE benutzerName='3_benutzerName';
-- $username i kullan
-- $signatur= signatur bir degiskene atanir.
-- Kitap Statusunu ausgelieht olarak degistirme
UPDATE buecher SET buchStatusID=2
WHERE signatur= "1_signatur"; 
-- $signatur kullanilir
SELECT * from buecher;
-- Odunc alinan kitabi Ausleihe'ya girme
SELECT benutzerID FROM benutzer WHERE benutzerName= '2_benutzerName'; 
-- normalde giris yapilan benutzername kullanilir.
-- $benutzerID = benutzerID
INSERT INTO ausleihe (ausleiherID,  bearbeiterID, buchID) 
VALUES(2, 2, 4);
-- ausleiherID=$benutzerID
-- $buchID= buchID 
SELECT * FROM ausleihe;
SELECT * from buecher;
-- ------------------------------------
-- Kitap odünç alma ekranı BIBLIOTHEK-Modus 
SELECT signatur, buchTitel AS Booktitle, autorVorname, autorNachname, bibliothekName, standortBezeichnung
FROM buecher bu
INNER JOIN bibliotheken bi USING(bibliothekID)
INNER JOIN standorte st USING(bibliothekID)
INNER JOIN ausleihe au USING (buchID)
INNER JOIN benutzer be ON be.benutzerID=au.ausleiherID
WHERE benutzerName='3_benutzerName';
-- Kullanicinin girecegi baskasi icin $username i kullan email i de iste.
-- $signatur= signatur bir degiskene atanir.
-- Kitap Statusunu ausgelieht olarak degistirme
UPDATE buecher SET buchStatusID=2
WHERE signatur= "1_signatur"; 
-- $signatur kullanilir
SELECT * from buecher;
-- Odunc alinan kitabi Ausleihe'ya girme
SELECT benutzerID FROM benutzer WHERE benutzerName= '2_benutzerName'; 
-- normalde giris yapilan benutzername kullanilir.
-- $benutzerID = benutzerID
-- ILAVETEN diger kisinin kullanici adi ile IDsi SELECT ILE databanktan oku
INSERT INTO ausleihe (ausleiherID,  bearbeiterID, buchID) 
VALUES(2, 2, 4);
-- ausleiherID=$benutzerID
-- $buchID= buchID 
SELECT * FROM ausleihe;
SELECT * from buecher;

-- ======================================

SELECT ADDDATE(CURRENT_DATE, 1);


22222
-- Self Liste Return Verlaengerung
SELECT signatur, buchTitel AS Booktitle, benutzerName AS Benutzername, einrichtungBezeichnung , fristDatum
FROM ausleihe au
INNER JOIN buecher bu USING(buchID)
INNER JOIN benutzer be ON be.benutzerID=au.ausleiherID
INNER JOIN einrichtungen ei USING(einrichtungID)
WHERE benutzerName='3_benutzerName';
-- $signatur= signatur bir degiskene atanir.
-- RETURN DURUMUNDA
-- Kitap Statusunu ausgelieht olarak degistirme
UPDATE buecher SET buchStatusID=1
WHERE signatur= "1_signatur"; 
-- $signatur kullanilir
-- UZATMA DURUMUNDA
UPDATE ausleihe SET fristDatum=ADDDATE(CURRENT_DATE, 28)
WHERE signatur= "1_signatur"; -- $signatur kullanilir

-- ======
-- Bibliothekar icin Liste Return Verlaengerung
SELECT benutzerName, signatur, buchTitel AS Booktitle, benutzerName AS Benutzername, einrichtungBezeichnung , fristDatum
FROM ausleihe au
INNER JOIN buecher bu USING(buchID)
INNER JOIN benutzer be ON be.benutzerID=au.ausleiherID
INNER JOIN einrichtungen ei USING(einrichtungID)

-- $signatur= signatur bir degiskene atanir.


