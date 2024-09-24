<?php
require_once 'Config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class EmailSender {
    private $mail;

    public function __construct()
    {
        $config = Config::getInstance();

        $this->mail = new PHPMailer(true);
        
        // Server settings
        $this->mail->isSMTP();
        $this->mail->Host       = $config->get('MAIL_HOST');
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $config->get('MAIL_USERNAME');
        $this->mail->Password   = $config->get('MAIL_PASSWORD');
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = $config->get('MAIL_PORT');
    }

    public function sendEmail($from, $fromName, $to, $subject, $body)
    {
        try {
            // Set the sender and recipient
            $this->mail->setFrom($from, $fromName);
            $this->mail->addAddress($to);

            // Set email format to HTML
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->AltBody = strip_tags($body); // Plain text body for non-HTML mail clients

            $this->mail->send();
            return true; // Return true if email is sent
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}