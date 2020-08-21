<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

  $app->get('/',            \App\Application\Action\Guest\HomeAction::class)->setName('home');
  $app->get('/dokumenty',   \App\Application\Action\Document\DocumentListViewAction::class)->setName('document');

};