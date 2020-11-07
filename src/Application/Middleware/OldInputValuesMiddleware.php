<?php

namespace App\Application\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class OldInputValuesMiddleware implements MiddlewareInterface
{
  public function process(Request $request, RequestHandler $handler): Response
  {
    $response = $handler->handle($request);
    // $session = $request->getAttribute('session');
    // var_dump('OldInputValuesMiddleware');
    // var_dump($session);
    // var_dump($_SESSION);
    $_SESSION['old'] = $request->getParsedBody();
    return $response;
  }
}
