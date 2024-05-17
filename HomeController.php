<?php

require_once __DIR__ . '/QueryModel.php';

/**
 * Control home page.
 */
class HomeController {

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
    // Get Products.
    $products = $this->db->getProducts();
    // View of home page.
    require_once __DIR__ . '/home_view.php';
  }
}
