# IHKProjekt-Buchausleihesystem
Das Projekt bildet den Kern der Software, die das Managementsystem für 16 kleine Bibliotheken der Juristischen Fakultät darstellt.

user name: 1_benutzerName ;  password: 1
user name: 2_benutzerName;   password: 2_kontoPasswort

Die Datenbankinformationen sollten in der Datei core/init.php gespeichert werden.
Und die Datenbank sollte mit der Datei "bibliothek Veri Tabanı 230411 1900 Test Verileri dahil tamamı.sql" erstellt werden.

Das Programm beginnt mit der Ausführung der Datei signin.php.

Damit das Programm vollständig funktioniert, muss es in der Lage sein, E-Mails zu versenden.
Denn bei jedem Vorgang wird eine E-Mail an den Benutzer gesendet.
Dazu müssen die folgenden Informationen in die Datei Sendpost.php geschrieben werden:
// Hostname and port
  $mail->Host = "smtp.gmail.com";  // Specify main and backup server
  $mail->Username = "*****@gmail.com";  // SMTP username
  $mail->Password = "**********"; // SMTP password ; server app password
