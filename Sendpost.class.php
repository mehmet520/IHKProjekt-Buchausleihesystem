<?php 
// include_once("email_form_creation");
/* Asset :
- Die PHPMailer-Codebibliothek wird für den sicheren Versand von E-Mails verwendet:
    https://en.wikipedia.org/wiki/PHPMailer
- PHP Mailer = https://github.com/PHPMailer/PHPMailer */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/src/Exception.php';
require 'phpMailer/src/PHPmailer.php';
require 'phpMailer/src/SMTP.php';

$bodyHtmlTemp='<html lang="en" >
<head>
  <meta charset="utf-8" />
  <title>Send Email</title>
</head>
<body>
htmkl mesaj
</body>
</html>';

// if(isset($_POST["send"])){
// baqzitnvxjyxczvr
    // require("phpmailer/class.phpmailer.php");

    $mail = new PHPMailer();    // $mailerObject
    $mail->CharSet = "utf-8";
    $mail->IsSMTP();                                      // Set mailer to use SMTP
    $mail->SMTPAuth = true;     // Turn on SMTP authentication
    $mail->SMTPSecure="tls"; //ssl
    // Hostname and port
    $mail->Host = "smtp.gmail.com";  // Specify main and backup server
    $mail->Username = "mysaturn890@gmail.com";  // SMTP username
    $mail->Password = "baqzitnvxjyxczvr"; // SMTP password ; server app password
    $mail->Port=587; // hem ssl hem de tls ile calisiyor.
    // $mail->Port = 465;  // ssl ile calisiyor. tls ile calismiyor.

    // $mail->setFrom = "mysaturn890@gmail.com";
    $mail->FromName = "Internal-Buchausleihsytem";  //System-Ad
    // $mail->addAddress($_POST["email"]); // , $recipient_name
    // $mail->AddCC($emailCC);
    // $mail->AddBCC($emailBCC);
    $mail->addAddress("mygold95@gmail.com");
    // $mail->addAddress("myoga573@gmail.com");
    // $mail->addAddress("mymail44@gmx.de");

    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    $mail->IsHTML(true);                                  // Set email format to HTML (true) or plain text (false)

    $mail->Subject = "Informationsmeldung zum Buchverleih ";
    // $mail->Subject    = $_POST["subject"];
    // $mail->Body    = $_POST["message"];

    
    $mail->MsgHTML($bodyHtmlTemp);  // MsgHTML oder Body. Die zuletzt eingegangene Nachricht überschreibt die andere.
    // $mail->Body="Icerik";
    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

    $mail->AddEmbeddedImage('images/uni-logo-login.png', 'logo', 'uni-logo-login.png'); // 1 tane, sadece ilki gidiyor.
    $mail->AddEmbeddedImage('images/2021-05-26 012908.png', 'logo', '2021-05-26 012908.png');
    $mail->addAttachment('files/images (5).jpg');
    $mail->addAttachment('files/Moon.jpg');

    if(!$mail->send())
    {
       echo "Message could not be sent. <p>";
       print_r(error_get_last());

       echo "<br><br>Mailer Error: " . $mail->ErrorInfo;
       exit;
    }
    echo "Message has been sent";
    echo "<br><br>";


// }

?>