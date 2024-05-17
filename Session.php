<?php

/**
 * Control session.
 */
class Session {

  /**
   * Constructor function to start session.
   */
  public function __construct() {
    session_start();
  }

  /**
   * Destroy session.
   */
  public function destroySession() {
    session_unset();
    session_destroy();
  }
}
