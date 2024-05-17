<?php

require_once __DIR__ . '/Session.php';

/**
 * Control Logout.
 */
class LogoutController {

  /**
   * Destroy sesssion and redirect to login page.
   */
  public function invoke() {
    // Destro session.
    $session = new Session();
    $session->destroySession();
    // Resirect to login page.
    header('location: /admin-login');
  }
}
