<?php

require_once __DIR__ . '/Dotenv.php';
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Class to send mail.
 */
class Mail {

  public $mail;

  /**
   * Constructor function to create objects.
   */
  function __construct() {
    $this->mail = new PHPMailer(true);
    $dotEnv = new Dotenv();
    $this->mailConfig();
  }

  /**
   * Function to configure the mail parameters.
   */
  private function mailConfig() {
    // Server settings.
    $this->mail->Host = $_ENV['MAIL_HOST'];
    $this->mail->SMTPAuth = true;
    $this->mail->isSMTP();
    $this->mail->Username = $_ENV['SENDER_EMAIL'];
    $this->mail->Password = $_ENV['SMTP_PASSWORD'];
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $this->mail->Port = 465;

    // Sender information.
    $this->mail->setFrom($_ENV['SENDER_EMAIL'], 'Sender Name');
  }

  /**
   * Set receiver's email.
   *
   * @param string $receiver_email
   *   recever's email.
   */
  public function setReceiver(string $receiver_email) {
    // Set Receiver's email.
    $this->mail->addAddress($receiver_email, 'Receiver Name');
  }

  /**
   * Set mail content for sending customer details and total amount.
   */
  public function setMailForCartDetails($name, $email, $phone, $amount) {
    $this->mail->isHTML(true);
    $this->mail->Subject = 'Cart details';
    $this->mail->Body = <<<END
      <h2>Cart details</h2>
      <p>Name: $name</p>
      <p>Email: $email</p>
      <p>Phone: $phone</p>
      <p>Total Amount: $amount</p>
    END;
  }

  /**
   * Function to set mail parameters and send mail.
   */
  public function sendMail() {
    try {
      $this->mail->send();
      // Respond ok.
      return TRUE;
    }
    catch (Exception) {
      return FALSE;
    }
  }
}
