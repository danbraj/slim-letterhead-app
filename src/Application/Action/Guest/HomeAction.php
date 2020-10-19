<?php

namespace App\Application\Action\Guest;

use App\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

final class HomeAction extends Action
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    return $this->render('home.twig');
  }
}