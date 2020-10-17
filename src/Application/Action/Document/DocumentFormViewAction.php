<?php

namespace App\Application\Action\Document;

use App\Application\Form\DocumentFormData;
use App\Letterhead\Document\DocumentRepository;
use App\Letterhead\Layout\LayoutRepository;
use App\Letterhead\Signature\SignatureRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

final class DocumentFormViewAction extends DocumentAction
{
  protected $signatureRepository;
  protected $layoutRepository;

  public function __construct(
    LoggerInterface $logger,
    Twig $view,
    DocumentRepository $documentRepository,
    SignatureRepository $signatureRepository,
    LayoutRepository $layoutRepository
  ) {
    parent::__construct($logger, $view, $documentRepository, $layoutRepository);
    $this->signatureRepository = $signatureRepository;
    $this->layoutRepository = $layoutRepository;
  }
  
  protected function action(): Response
  {
    $signatures = $this->signatureRepository->findAll();
    $layouts = $this->layoutRepository->findAll();
    $documentFormData = new DocumentFormData([
      'signatures' => $signatures,
      'layoutId' => $layouts
    ]);
    return $this->render(
      'form/document.twig', [
        'documentFormData' => $documentFormData->build()
      ]
    );
  }
}
