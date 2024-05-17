<?php

require_once __DIR__ . '/LoginController.php';
require_once __DIR__ . '/HomeController.php';
require_once __DIR__ . '/AdminController.php';
require_once __DIR__ . '/AddProductController.php';
require_once __DIR__ . '/BuyProductsController.php';
require_once __DIR__ . '/LogoutController.php';
require_once __DIR__ . '/ErrorController.php';

/**
 * Manage paths and require pages.
 */
class UrlManager {

  /**
   * Require pages accourding to the path.
   *
   * @param string $page
   *   Path of the page.
   */
  public function load(string $page) {
    switch ($page) {
      case 'admin-login':
        $loginController = new LoginController();
        $loginController->invoke();
        break;

      case 'admin-page':
        $adminController = new AdminController();
        $adminController->invoke();
        break;

      case 'add-product':
        $addProductController = new AddProductController();
        $addProductController->invoke();
        break;

      case 'buy-products':
        $buyProductsController = new BuyProductsController();
        $buyProductsController->invoke();
        break;

      case '':
      case 'home':
        $homeController = new HomeController();
        $homeController->invoke();
        break;

      case 'logout':
        $logoutController = new LogoutController();
        $logoutController->invoke();
        break;

      default:
        $errorController = new ErrorController();
        $errorController->invoke();
        break;
    }
  }
}
