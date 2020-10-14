<?php

namespace App\Application\Action\Signature;

use App\Application\Action\Action;
use App\Letterhead\Signature\SignatureRepository;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

abstract class SignatureAction extends Action
{
  protected $signatureRepository;

  public function __construct(
    LoggerInterface $logger,
    Twig $view,
    SignatureRepository $signatureRepository
  ) {
    parent::__construct($logger, $view);
    $this->signatureRepository = $signatureRepository;
  }
}
