<?php

namespace App\Application\Service\MailSender;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailSender implements MailSenderInterface
{
  private $mail;

  public function __construct(PHPMailer $mail, array $creds)
  {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->CharSet    = "UTF-8";
    $mail->Host       = $creds['host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $creds['login'];
    $mail->Password   = $creds['password'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $creds['port'];
    $mail->isHTML(true);
    $mail->setFrom($creds['login'], $creds['username']);

    $this->mail = $mail;
  }

  public function send(string $recipent, MailContent $mailContent)
  {
    try {
      $this->mail->Subject = $mailContent->getHeading();
      $this->mail->Body = $mailContent->getBody(); // html message
      $this->mail->AltBody = $mailContent->getAltBody(); // plain text message
      $this->mail->addAddress($recipent);
      // $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // TODO: implement
      $this->mail->send();
      echo 'Message has been sent';
      return true;
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
      return false;
    }
  }

  public function provide(): MailSenderInterface
  {
    return $this;
  }
}
