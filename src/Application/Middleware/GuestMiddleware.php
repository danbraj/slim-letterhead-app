<?php

namespace App\Application\Middleware;

use App\Application\Service\Auth\Auth;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class GuestMiddleware implements MiddlewareInterface
{
  private $auth;

  public function __construct(Auth $auth)
  {
    $this->auth = $auth;
  }

  public function process(Request $request, RequestHandler $handler): Response
  {
    $response = $handler->handle($request);

    if ($this->auth->check()) {
      return $response->withHeader('Location', '/3dmin');
    }

    return $response;
  }
}
