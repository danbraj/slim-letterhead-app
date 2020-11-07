<?php

namespace App\Application\Handler;

use Slim\Psr7\Response;
use Slim\Views\Twig;

class HttpNotFoundHandler 
{
  private $app;

  public function __construct($app)
  {
    $this->app = $app;
  }

  public function __invoke(): Response
  {
    $response = new Response();
    return $this->app->getContainer()->get(Twig::class)->render($response ,'not_found.twig')->withStatus(404);
  }
}
