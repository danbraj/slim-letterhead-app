<?php

namespace App\Application\Action\Auth;

use App\Application\Action\Action;
use App\Application\Service\Auth\Auth;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

abstract class AuthAction extends Action
{
  protected $layoutRepository;

  public function __construct(
    LoggerInterface $logger,
    Twig $view,
    Auth $auth
  ) {
    parent::__construct($logger, $view);
    $this->auth = $auth;
  }
}
