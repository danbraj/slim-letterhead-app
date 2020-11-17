<?php

namespace App\Application\Action\Auth;

use App\Application\Service\Auth\Auth;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Flash\Messages;
use Slim\Views\Twig;

final class AuthSignInPostAction extends AuthAction
{
  private $flash;

  public function __construct(
    LoggerInterface $logger,
    Twig $view, Auth $auth,
    Messages $flash)
  {
    parent::__construct($logger, $view, $auth);
    $this->flash = $flash;
  }

  protected function action(): Response
  {
    $auth = $this->auth->attempt(
      filter_var($this->request->getParsedBody()['login'], FILTER_SANITIZE_STRING),
      filter_var($this->request->getParsedBody()['password'], FILTER_SANITIZE_STRING)
    );

    if (!$auth) {
      $this->flash->addMessage('error', 'Podany login lub hasło jest niestety błędne.');
      $this->logger->error('Nieudana próba logowania!');
      return $this->redirect('admin.signin');
    }
    $this->logger->info('Zalogowano pomyślnie!');
    return $this->redirect('admin');
  }
}
