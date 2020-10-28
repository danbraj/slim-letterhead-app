<?php

namespace App\Application\Action\Document;

use App\Application\Form\DocumentFormData;
use App\Letterhead\Document\DocumentRepository;
use App\Letterhead\DocumentSignature\DocumentSignatureRepository;
use App\Letterhead\Layout\LayoutRepository;
use App\Letterhead\Signature\SignatureRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

final class DocumentFormViewAction extends DocumentAction
{
  protected $signatureRepository;
  protected $documentSignatureRepository;
  protected $layoutRepository;

  public function __construct(
    LoggerInterface $logger,
    Twig $view,
    DocumentRepository $documentRepository,
    SignatureRepository $signatureRepository,
    DocumentSignatureRepository $documentSignatureRepository,
    LayoutRepository $layoutRepository
  ) {
    parent::__construct($logger, $view, $documentRepository);
    $this->signatureRepository = $signatureRepository;
    $this->documentSignatureRepository = $documentSignatureRepository;
    $this->layoutRepository = $layoutRepository;
  }
  
  protected function action(): Response
  {
    $documentFormData = new DocumentFormData();
    $documentFormData->attachElements([
      'signatures' => $this->signatureRepository->findAll(),
      'layoutId' => $this->layoutRepository->findAll()
    ]);
    $id = intval($this->resolveArg('id'));
    if ($id) {
      $document = $this->documentRepository->findOne($id);
      $docSignatures = $this->documentSignatureRepository->findAllByDocumentId($id);
      $docSignatures = array_map(function ($signature) {
        return intval($signature->signatureId);
      }, $docSignatures);
      // $docSignatures = array_fill_keys($docSignatures, true);
      $formDataValues = $document->jsonSerialize();
      $formDataValues['signatures'] = $docSignatures;
      if ($document) {
        $documentFormData->attachValues($formDataValues);
      }
    }
    return $this->render(
      'form/document.twig', [
        'documentFormData' => $documentFormData->build()
      ]
    );
  }
}
