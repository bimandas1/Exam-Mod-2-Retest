<?php

require_once __DIR__ . '/QueryModel.php';

/**
 * Control fetch products from database.
 */
class FetchProductsController {

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
    
  }
}
