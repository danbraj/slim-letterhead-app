<?php

use App\Application\Service\DatabaseAdapter\DatabaseAdapter;
use App\Application\Service\Logger\LoggerService;
use App\Application\Service\MailSender\MailSender;
use App\Application\Service\MailSender\MailSenderInterface;
use App\Application\Service\PdfBuilder\PdfBuilder;
use App\Application\Service\PdfBuilder\PdfBuilderInterface;
use App\Application\Service\Twig\TwigService;
use DI\ContainerBuilder;
use PHPMailer\PHPMailer\PHPMailer;
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
    PDO::class => function () {
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
    MailSenderInterface::class => function ($c) {
      $mailService = new MailSender(new PHPMailer(), $c->get('settings')['mailer']['creds']);
      return $mailService->provide();
    },

    // Pdf service dependency
    PdfBuilderInterface::class => function () {
      $pdfService = new PdfBuilder([]);
      return $pdfService->provide();
    },

  ]);
};