<?php

use App\Application\Service\Auth\Auth;
use Slim\App;
use Slim\Flash\Messages;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
  $c = $app->getContainer();

  $app->get('/',                        \App\Application\Action\Guest\HomeAction::class)->setName('home');
  
  $app->group('/3dmin', function($group) {

    $group->get('/logowanie',             \App\Application\Action\Auth\AuthSignInViewAction::class)->setName('admin.signin');
    $group->post('/logowanie',            \App\Application\Action\Auth\AuthSignInPostAction::class);

  })
  ->add(new \App\Application\Middleware\GuestMiddleware($c->get(Auth::class)));

  $app->group('/3dmin', function (Group $group) {

    $group->get('',                       \App\Application\Action\Dashboard\DashboardAction::class)->setName('admin');

    $group->group('/documents', function(Group $group) {
      $group->get('',                     \App\Application\Action\Document\DocumentListViewAction::class)->setName('document');
      $group->get('/[{id:[0-9]+}]',       \App\Application\Action\Document\DocumentFormViewAction::class)->setName('document.form');
      $group->post('/[{id:[0-9]+}]',      \App\Application\Action\Document\DocumentFormPostAction::class);
      $group->delete('/[{id:[0-9]+}]',    \App\Application\Action\Document\DocumentDeleteAction::class)->setName('document.delete');
      $group->get('/build/{id:[0-9]+}',   \App\Application\Action\Document\DocumentPdfBuildAction::class)->setName('document.build');
    });
    
    $group->group('/signatures', function(Group $group) {
      $group->get('',                     \App\Application\Action\Signature\SignatureListViewAction::class)->setName('signature');
      $group->get('/[{id:[0-9]+}]',       \App\Application\Action\Signature\SignatureFormViewAction::class)->setName('signature.form');
      $group->post('/[{id:[0-9]+}]',      \App\Application\Action\Signature\SignatureFormPostAction::class);
      $group->delete('/[{id:[0-9]+}]',    \App\Application\Action\Signature\SignatureDeleteAction::class)->setName('signature.delete');
    });

    $group->group('/layouts', function(Group $group) {
      $group->get('',                     \App\Application\Action\Layout\LayoutListViewAction::class)->setName('layout');
      $group->get('/[{id:[0-9]+}]',       \App\Application\Action\Layout\LayoutFormViewAction::class)->setName('layout.form');
      $group->post('/[{id:[0-9]+}]',      \App\Application\Action\Layout\LayoutFormPostAction::class);
      $group->delete('/[{id:[0-9]+}]',    \App\Application\Action\Layout\LayoutDeleteAction::class)->setName('layout.delete');
    });

    $group->get('/logout',                \App\Application\Action\Auth\AuthLogoutAction::class)->setName('admin.logout');

  })
  ->add(new \App\Application\Middleware\AuthMiddleware($c->get(Auth::class), $c->get(Messages::class)))
  ->add(new \App\Application\Middleware\OldInputValuesMiddleware());
};