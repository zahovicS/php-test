<?php

namespace Src\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    private $config;
    private $mailer;
    function __construct($mail = "default"){

        $this->config = config("email")[$mail];
        
        $this->mailer = new PHPMailer(true);

        // $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->mailer->isSMTP(); 
        //Send using SMTP
        $this->mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mailer->CharSet = "UTF-8";
        $this->mailer->Host       = $this->config["host"];                     //Set the SMTP server to send through
        $this->mailer->Username   = $this->config["username"];                     //SMTP username
        $this->mailer->Password   = $this->config["password"];                               //SMTP password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->mailer->Port       = $this->config["port"];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Set the sender's email and name
        $this->mailer->setFrom($this->config["from_email"], $this->config["from_name"]);

        // Optional: Reply-to, CC, and BCC
        // $this->mailer->addReplyTo('info@example.com', 'Information');
        // $this->mailer->addCC('cc@example.com');
        // $this->mailer->addBCC('bcc@example.com');
    }
    public function attachFile($pathFile,string $fileName = "")
    {
        $this->mailer->addAttachment($pathFile,$fileName);    
        return $this;
    }
    public function attachFiles(array $pathFiles)
    {
        foreach ($pathFiles as $pathFile) {
            $this->attachFile($pathFile["pathFile"], $pathFile["fileName"] ?? "");
        }
        return $this;
    }
    public function sendMail($subject, $body, string $recipientEmail, $recipientName = null, $altBody = null)
    {
        try {
            // Recipients
            $this->mailer->addAddress($recipientEmail, $recipientName);

            // Content
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->AltBody = $altBody;

            // $this->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
            die;
        }
    }
}
