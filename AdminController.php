<?php

require_once __DIR__ . '/QueryModel.php';

/**
 * Control admin page and add products to inventory.
 */
class AdminController {

  private $db;

  /**
   * Constructor function to create object of QueryModel.
   */
  function __construct() {
    $this->db = new QueryModel();
  }

  /**
   * Control basic operations.
   */
  public function invoke() {
    session_start();
    if (isset($_SESSION['email'])) {
      // View of home page.
      require_once __DIR__ . '/admin_view.php';
    }
    // No session available.
    else {
      header('location: /admin-login');
    }
  }
}
