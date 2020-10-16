<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

  $app->get('/',                        \App\Application\Action\Guest\HomeAction::class)->setName('home');
  
  $app->group('/documents', function(Group $group) {
    $group->get('',                     \App\Application\Action\Document\DocumentListViewAction::class)->setName('document');
    $group->get('/add',                 \App\Application\Action\Document\DocumentFormViewAction::class)->setName('document.create');
    $group->post('/add',                \App\Application\Action\Document\DocumentFormPostAction::class);
  });
  
  $app->group('/signatures', function(Group $group) {
    $group->get('',                     \App\Application\Action\Signature\SignatureListViewAction::class)->setName('signature');
    $group->get('/add',                 \App\Application\Action\Signature\SignatureFormViewAction::class)->setName('signature.create');
    $group->post('/add',                \App\Application\Action\Signature\SignatureFormPostAction::class);
  });

  $app->group('/layouts', function(Group $group) {
    $group->get('',                     \App\Application\Action\Layout\LayoutListViewAction::class)->setName('layout');
    $group->get('/add',                 \App\Application\Action\Layout\LayoutFormViewAction::class)->setName('layout.create');
    $group->post('/add',                \App\Application\Action\Layout\LayoutFormPostAction::class);
  });
};