<?php

use App\Application\Service\DatabaseAdapter\DatabaseAdapter;
use App\Application\Service\Logger\LoggerService;
use App\Application\Service\Twig\TwigService;
use DI\ContainerBuilder;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

return function (ContainerBuilder $containerBuilder) {
  $containerBuilder->addDefinitions([

    // Logger dependency
    LoggerInterface::class => function ($c) {
      $logger = new LoggerService($c->get('settings')['logger']);
      return $logger->provide();
    },

    // Database (Pdo) dependency
    DatabaseAdapter::class => function () {
      $databaseAdapter = new DatabaseAdapter(DATABASE_PATH);
      return $databaseAdapter->provide();
    },

    // Twig dependency
    Twig::class => function ($c) {
      $twigService = new TwigService($c->get('settings')['view']);
      return $twigService->provide();
    },

    // Auth dependency

    // Flash messages dependency

    // Uploader service dependecy

    // Mail service dependency

    // Pdf service dependency

  ]);
};