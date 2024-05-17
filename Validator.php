<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Dotenv.php';

/**
 * Validate user's inputs.
 */
class Validator {

  /**
   * Validate user's name.
   *
   * @param string $name
   *   User's name.
   *
   * @return bool
   *   TRUE if name is valid, else FALSE.
   */
  public function nameValidate(string $name): bool {
    return preg_match("/\b([A-Z][a-z. ]+[ ]*)+/", $name);
  }

  /**
   * Validate user's email.
   *
   * @param string $email
   *   User's email.
   *
   * @return bool
   *   TRUE if email is valid, else FALSE.
   */
  public function emailValidate(string $email): bool {
    $dotenv = new Dotenv();
    $api_key = $_ENV['EMAIL_VALIDATE_API_KEY'];
    $api_url = "https://emailvalidation.abstractapi.com/v1/?api_key={$api_key}&email={$email}&auto_correct=false";

    // Check mail validation through Abstract Api.
    try {
      $client = new \GuzzleHttp\Client();
      $response = $client->request('GET', $api_url);
      $res = json_decode($response->getBody(), TRUE);

      if($res['deliverability'] === 'DELIVERABLE') {
        return TRUE;
      }
      return FALSE;
    }
    catch(Exception) {
      return FALSE;
    }
  }

  /**
   * Validate user's password.
   *
   * @param string $password
   *   User's password.
   *
   * @return bool
   *   TRUE if password is valid, else FALSE.
   */
  public function passwordValidate(string $password): bool {
    return preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/", $password);
  }
}

