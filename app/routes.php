<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {

  $app->get('/',                        \App\Application\Action\Guest\HomeAction::class)->setName('home');
  
  $app->group('/documents', function(Group $group) {
    $group->get('',                     \App\Application\Action\Document\DocumentListViewAction::class)->setName('document');
    $group->get('/[{id:[0-9]+}]',       \App\Application\Action\Document\DocumentFormViewAction::class)->setName('document.form');
    $group->post('/[{id:[0-9]+}]',      \App\Application\Action\Document\DocumentFormPostAction::class);
    $group->delete('/[{id:[0-9]+}]',    \App\Application\Action\Document\DocumentDeleteAction::class)->setName('document.delete');
    $group->get('/build/{id:[0-9]+}',   \App\Application\Action\Document\DocumentPdfBuildAction::class)->setName('document.build');
  });
  
  $app->group('/signatures', function(Group $group) {
    $group->get('',                     \App\Application\Action\Signature\SignatureListViewAction::class)->setName('signature');
    $group->get('/[{id:[0-9]+}]',       \App\Application\Action\Signature\SignatureFormViewAction::class)->setName('signature.form');
    $group->post('/[{id:[0-9]+}]',      \App\Application\Action\Signature\SignatureFormPostAction::class);
    $group->delete('/[{id:[0-9]+}]',    \App\Application\Action\Signature\SignatureDeleteAction::class)->setName('signature.delete');
  });

  $app->group('/layouts', function(Group $group) {
    $group->get('',                     \App\Application\Action\Layout\LayoutListViewAction::class)->setName('layout');
    $group->get('/[{id:[0-9]+}]',       \App\Application\Action\Layout\LayoutFormViewAction::class)->setName('layout.form');
    $group->post('/[{id:[0-9]+}]',      \App\Application\Action\Layout\LayoutFormPostAction::class);
    $group->delete('/[{id:[0-9]+}]',    \App\Application\Action\Layout\LayoutDeleteAction::class)->setName('layout.delete');
  });
};