<?php

namespace App\Application\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class SessionMiddleware implements MiddlewareInterface
{
  public function process(Request $request, RequestHandler $handler): Response
  {
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
      // session_start();
      $request = $request->withAttribute('session', $_SESSION);
    }

    return $handler->handle($request);
  }
}
