<?php

require_once __DIR__ . '/Session.php';

/**
 * Control user login.
 */
class LoginController {

  private $message;
  private $googleAuth;

  /**
   * Constructor function to set default values.
   */
  function __construct() {
    $this->message = null;
  }

  /**
   * Function to control user login.
   */
  public function invoke() {
    // Check if a session is active.
    // $this->isActiveSession();

    if(isset($_POST['email'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      require_once __DIR__ . '/Validator.php';
      $validator = new Validator();
      if($validator->emailValidate($email) && $validator->passwordValidate($password)) {
        // Initialize object of QueryModel.
        require_once __DIR__ . '/QueryModel.php';
        $db = new QueryModel();
        // If valid user.
        if($db->isValidUser($email, $password) === TRUE) {
          session_start();
          $_SESSION['email'] = $email;
          // Redirect to Admin page.
          header('location: /admin-page');
          exit();
        }
        else {
          $this->message = 'Email id or password not matched';
        }
      }
    }

    // Require login view.
    require_once __DIR__ . '/login_view.php';
  }

  /**
   * If a session is active then direct redirect to main page.
   */
  // public function isActiveSession() {
  //   session_start();
  //   if (isset($_SESSION['email'])) {
  //     // Redirect to home page.
  //     header('location: /home');
  //     exit();
  //   }
  // }
}

