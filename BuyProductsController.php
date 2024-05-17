<?php

require_once __DIR__ . '/QueryModel.php';
require_once __DIR__ . '/Mail.php';
require_once __DIR__ . '/Dotenv.php';

/**
 * Control product data and user's buying.
 */
class BuyProductsController {

  private $db;
  private $mail;
  private $dotEnv;

  /**
   * Constructor function to create object of QueryModel, Mail and DotEnv.
   */
  function __construct() {
    $this->db = new QueryModel();
    $this->mail = new Mail();
    $this->dotEnv = new Dotenv();
  }

  /**
   * Control basic operations.
   */
  public function invoke() {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $amount = $_POST['amount'];

      try {
        // Send mail.
        $this->mail = new Mail();
        $this->mail->setReceiver($_ENV['RECEIVER_MAIL']);
        $this->mail->setMailForCartDetails($name, $email, $phone, $amount);
        $this->mail->sendMail();
        // Respond ok.
        echo '1';
      }
      catch (Exception $e) {
        echo 'Something is wrong! Try again.';
      }
    }
  }
}
