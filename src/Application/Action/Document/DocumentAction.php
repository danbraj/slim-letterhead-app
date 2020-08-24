<?php

namespace App\Application\Action\Document;

use App\Application\Action\Action;
use App\Letterhead\Document\DocumentRepository;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

abstract class DocumentAction extends Action
{
  protected $documentRepository;

  public function __construct(
    LoggerInterface $logger,
    Twig $view,
    DocumentRepository $documentRepository
  ) {
    parent::__construct($logger, $view);
    $this->documentRepository = $documentRepository;
  }
}
