<?php

require_once __DIR__ . '/Database.php';

/**
 * Perform queries on post table.
 */
class QueryModel extends Database {

  /**
   * Constructor function to use the connection with database.
   */
  function __construct() {
    parent::__construct();
  }

  /**
   * Check user exist or not.
   *
   * @param string $email.
   *   User's email.
   *
   * @return boolean
   *   True if user exists.
   */
  public function isExistingUser(string $email): bool {
    try {
      $sql = $this->conn->prepare("select email from user where email = ?");
      $sql->execute([$email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    } catch (Exception) {
      echo 'Error in database.';
    }
  }

  /**
   * Change password.
   *
   * @param string $email.
   *   User's email.
   * @param string $password.
   *   User's password.
   *
   * @return bool.
   *   True if changing is successfull.
   */
  public function changePassword(string $email, string $new_password): bool {
    try {
      $sql = $this->conn->prepare("update user set password = ? where email = ?");
      // Generate hash value of the new password.
      $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
      $sql->execute([$new_password_hash, $email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
      echo 'Error in database.';
    }
  }

  /**
   * Check user is valid or not.
   *
   * @param string $email.
   *   User's email.
   * @param string $password.
   *   User's password.
   *
   * @return boolean.
   *   True if user email and password match.
   */
  public function isValidUser(string $email, string $password): bool {
    try {
      $sql = $this->conn->prepare("select password from user where email = ?");
      $sql->execute([$email]);

      if($sql->rowCount() == 0) {
        return FALSE;
      }
      else {
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $res['password'])) {
          return TRUE;
        }
        else {
          return FALSE;
        }
      }
    }
    catch (Exception $err) {
      return false;
    }
  }

  /**
   * Add new user's data.
   *
   * @param string $email.
   *   User's email.
   * @param string $password.
   *   User's password.
   * @param string $fname.
   *   User's First name.
   * @param string $lname.
   *   User's Last name.
   *
   * @return bool.
   *   True if addition is successfull.
   */
  public function addUser(string $email, string $password, string $fname, string $lname): bool {
    try {
      $sql = $this->conn->prepare("insert into user (email, password, fname, lname) values (?, ?, ?, ?)");
      // Generate hash value of the password.
      $password_hash = password_hash($password, PASSWORD_DEFAULT);
      $sql->execute([$email, $password_hash, $fname, $lname]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
      echo 'Error in database.';
      return FALSE;
    }
  }

  /**
   * Get user's data.
   *
   * @param string $email.
   *   User's email.
   *
   * @return array.
   *   User's data.
   */
  public function getUserData(string $email): array|null {
    try {
      $sql = $this->conn->prepare("Select fname, lname, is_admin from user user where email = ?");
      $sql->execute([$email]);
      $res = $sql->fetch(PDO::FETCH_ASSOC);
      return $res;
    }
    catch (Exception) {
      return null;
    }
  }

  /**
   * Get user's password.
   *
   * @param string $email.
   *   User's email.
   *
   * @return string.
   *   User's password.
   */
  public function getUserPassword(string $email): string|null {
    try {
      $sql = $this->conn->prepare("Select password from user user where email = ?");
      $sql->execute([$email]);
      $res = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $res;
    }
    catch (Exception) {
      return null;
    }
  }

  /**
   * Update user's data.
   *
   * @param string $email.
   *   User' email.
   * @param string $fname.
   *   User's first name.
   * @param string $lname.
   *   User's last name.
   *
   * @return bool.
   *   True if updation is successfull.
   */
  public function updateUserData(string $email, string $fname, string $lname): bool {
    try {
      $sql = $this->conn->prepare("update user set fname = ?, lname = ? where email = ?");
      $sql->execute([$fname, $lname, $email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
      return FALSE;
    }
  }

  /**
   * Update user's password.
   *
   * @param string $email.
   *   User' email.
   * @param string $password.
   *   User's password.
   *
   * @return bool.
   *   True if updation is successfull.
   */
  public function updateUserPassword(string $email, string $new_password): bool {
    try {
      $sql = $this->conn->prepare("update user set password = ? where email = ?");
      $sql->execute([$new_password, $email]);
      if ($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception) {
      return FALSE;
    }
  }

  /**
   * Check user is an admin or not.
   *
   * @param string $email
   *   USer's email.
   *
   * @return bool
   *   Return TRUE if user is an admin, else FALSE.
   */
  public function isAdmin(string $email): bool {
    $sql = $this->conn->prepare("select is_admin from user where email = ?");
    $sql->execute([$email]);
    $res = $sql->fetch(PDO::FETCH_ASSOC);
    if($res['is_admin'] == 1) {
      return TRUE;
    }
    return FALSE;
  }

  // Query on product table.

  /**
   * Add new product.
   *
   * @param string $name
   *   Name of the product.
   * @param integer $price
   *   Price of the product.
   *
   * @return bool
   *   Retur TRUE if successfully added, else FASLE.
   */
  public function addProduct(string $name, int $price, string $category): bool {
    try {
      $sql = $this->conn->prepare("insert into product (name, price, category) values (?, ?, ?)");
      $sql->execute([$name, $price, $category]);
      if($sql->rowCount() > 0) {
        return TRUE;
      }
      return FALSE;
    }
    catch (Exception $e) {
      return FALSE;
    }
  }

  /**
   * Get pruduct details.
   *
   * @return array|null
   *   Array of products if successfully fetched, else null.
   */
  public function getProducts(): array|null {
    try {
      $sql = $this->conn->prepare("select * from product");
      $sql->execute();
      $res = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $res;
    }
    catch (Exception $e) {
      return null;
    }
  }
}
