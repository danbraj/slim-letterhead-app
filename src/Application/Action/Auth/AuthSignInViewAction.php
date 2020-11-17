<?php

namespace App\Application\Action\Auth;

use Psr\Http\Message\ResponseInterface as Response;

final class AuthSignInViewAction extends AuthAction
{
  protected function action(): Response
  {
    return $this->render('loginscreen.twig');
  }
}
