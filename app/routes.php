<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

  $app->get('/',                \App\Application\Action\Guest\HomeAction::class)->setName('home');
  
  $app->get('/documents',       \App\Application\Action\Document\DocumentListViewAction::class)->setName('document');
  $app->get('/documents/add',   \App\Application\Action\Document\DocumentFormViewAction::class)->setName('document.create');
  $app->post('/documents/add',   \App\Application\Action\Document\DocumentFormPostAction::class);

  $app->get('/signatures',      \App\Application\Action\Signature\SignatureListViewAction::class)->setName('signature');
  $app->get('/signatures/add',  \App\Application\Action\Signature\SignatureFormViewAction::class)->setName('signature.create');
  $app->post('/signatures/add',  \App\Application\Action\Signature\SignatureFormPostAction::class);

};