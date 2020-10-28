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
    $newDocumentId = $this->documentRepository->create($document);
    // TODO: to implement updating document's signatures
    if ($newDocumentId) {
      $signatures = $parsedBody['signatures'];
      foreach ($signatures as $signature) {
        $this->documentSignatureRepository->set(
          new DocumentSignature($newDocumentId, $signature)
        );
      }
    }
    // $this->documentRepository->commitTransaction();
    $this->logger->info(this::class . ' :: check');
    return $this->redirect('document');
  }
}
