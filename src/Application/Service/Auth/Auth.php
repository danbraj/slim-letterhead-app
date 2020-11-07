<?php

namespace App\Application\Service\Auth;

class Auth
{
  private $sessionKey;
  private $login;
  private $password;

  public function __construct($settings = [])
  {
    $this->sessionKey = $settings['sessionKey'] ?? null;
    $this->login = $settings['login'] ?? null;
    $this->password = $settings['password'] ?? null;
  }

  public function attempt($login, $password)
  {
    if ($this->login && $this->password && $this->sessionKey && $this->login == $login && $this->password == $password) {
      $_SESSION[$this->sessionKey] = true;
      return true;
    } else {
      return false;
    }
  }

  public function check()
  {
    return isset($_SESSION[$this->sessionKey]);
  }

  public function logout()
  {
    unset($_SESSION[$this->sessionKey]);
  }
}
