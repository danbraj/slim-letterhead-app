<?php

namespace App\Application\Middleware;

use App\Application\Service\Auth\Auth;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Flash\Messages;

class AuthMiddleware implements MiddlewareInterface
{
  private $auth;
  private $flash;

  public function __construct(Auth $auth, Messages $flash)
  {
    $this->auth = $auth;
    $this->flash = $flash;
  }

  public function process(Request $request, RequestHandler $handler): Response
  {
    $response = $handler->handle($request);

    if (!$this->auth->check()) {
      $this->flash->addMessage('error', 'Wymagane logowanie.');
      return $response->withHeader('Location', '/3dmin/logowanie');
    }

    return $response;
  }
}
