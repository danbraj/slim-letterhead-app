<?php

use App\Application\Service\Auth\Auth;
use App\Application\Service\DatabaseAdapter\DatabaseAdapter;
use App\Application\Service\Logger\LoggerService;
use App\Application\Service\MailSender\MailSender;
use App\Application\Service\MailSender\MailSenderInterface;
use App\Application\Service\PdfBuilder\PdfBuilderFacade;
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

    // Auth dependency
    Auth::class => function ($c) {
      return new Auth($c->get('settings')['auth']);
    },
    // Twig dependency
    Twig::class => function ($c) {
      $twigService = new TwigService($c->get('settings')['view']);
      $twigService->addGlobalVariable('auth_check', $c->get(Auth::class)->check());
      $twigService->addGlobalVariable('flash', $c->get(Messages::class));
      return $twigService->provide();
    },

    // Uploader service dependecy

    // Mail service dependency
    MailSenderInterface::class => function ($c) {
      $mailService = new MailSender(new PHPMailer(), $c->get('settings')['mailer']['creds']);
      return $mailService->provide();
    },

    // Pdf service dependency
    PdfBuilderInterface::class => function () {
      $pdfService = new PdfBuilderFacade();
      return $pdfService->provide();
    },

  ]);
};