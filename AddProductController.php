<?php

require_once __DIR__ . '/QueryModel.php';

/**
 * Control admin page and add products to inventory.
 */
class AddProductController {

  private $db;

  /**
   * Constructor function to create object of QueryModel.
   */
  function __construct()
  {
    $this->db = new QueryModel();
  }

  /**
   * Control basic operations.
   */
  public function invoke()
  {
    session_start();
    if (isset($_SESSION['email'])) {
      if(isset($_POST['product-name']) && isset($_POST['product-price']) && isset($_POST['product-price'])) {
        $name = $_POST['product-name'];
        $price = $_POST['product-price'];
        $category = $_POST['product-category'];
        if($this->db->addProduct($name, $price, $category)) {
          echo '1';
        }
        else {
          echo '0';
        }
      }
    }
    // No session available.
    else {
      header('location: /admin-login');
    }
  }
}
