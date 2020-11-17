<?php

namespace App\Application\Action\Auth;

use Psr\Http\Message\ResponseInterface as Response;

final class AuthLogoutAction extends AuthAction
{
  protected function action(): Response
  {
    $this->auth->logout();
    return $this->redirect('admin');
  }
}
