<?php

namespace App\Application\Action\Document;

use App\Letterhead\Document\Document;
use App\Letterhead\Document\DocumentRepository;
use App\Letterhead\DocumentSignature\DocumentSignature;
use App\Letterhead\DocumentSignature\DocumentSignatureRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

final class DocumentFormPostAction extends DocumentAction
{
  private $documentSignatureRepository;

  public function __construct(
    LoggerInterface $logger,
    Twig $view,
    DocumentRepository $documentRepository,
    DocumentSignatureRepository $documentSignatureRepository
  ) {
    parent::__construct($logger, $view, $documentRepository);
    $this->documentSignatureRepository = $documentSignatureRepository;
  }

  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $parsedBody = $this->request->getParsedBody();
    // var_dump($parsedBody);
    $document = Document::createFromArray($parsedBody);
    // $this->documentRepository->beginTransaction();
    if ($document->id == null) {
      $newDocumentId = $this->documentRepository->create($document);
      if ($newDocumentId) {
        $signatures = $parsedBody['signatures'] ?? null;
        if ($signatures) {
          foreach ($signatures as $signature) {
            $this->documentSignatureRepository->create(
              new DocumentSignature($newDocumentId, $signature)
            );
          }
        }
      }
    } else {
      $updatedDocumentId = $document->id;
      $result = $this->documentRepository->update($document);
      if ($result) {
        $signatures = $parsedBody['signatures'] ?? null;
        $this->documentSignatureRepository->deleteSignatures($updatedDocumentId);
        if ($signatures) {
          foreach ($signatures as $signature) {
            $this->documentSignatureRepository->create(
              new DocumentSignature($updatedDocumentId, $signature)
            );
          }
        }
      }
    }
    
    // $this->documentRepository->commitTransaction();
    $this->logger->info(this::class . ' :: check');
    return $this->redirect('document');
  }
}
