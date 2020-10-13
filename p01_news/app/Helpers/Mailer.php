<?php
namespace App\Helpers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
class Mailer {
    public static function sendMail($params) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'pstaleal@gmail.com';                     // SMTP username
            $mail->Password   = 'hebvdkeyumpkhkhg';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('pstaleal@gmail.com', 'HaiDepTrai');
            $mail->addAddress($params['email']);
            // $mail->addCC('cc@example.com');
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $params['title'];
            $mail->Body    = $params['content'];
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
// Instantiation and passing `true` enables exceptions
