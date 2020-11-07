<?php

use App\Application\Handler\HttpNotFoundHandler;
use App\Application\Middleware\SessionMiddleware;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return function (App $app) {
  $c = $app->getContainer();
  $app->add(new SessionMiddleware());
  $app->addBodyParsingMiddleware();
  $app->addRoutingMiddleware();
  $app->add(TwigMiddleware::createFromContainer($app, Twig::class));
  $errorMiddleware = $app->addErrorMiddleware(true, true, true);
  // $errorMiddleware->setDefaultErrorHandler(new HttpNotFoundHandler($app));
};
