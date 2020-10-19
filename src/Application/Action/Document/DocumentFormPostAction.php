<?php

namespace App\Application\Action\Document;

use App\Letterhead\Document\Document;
use Psr\Http\Message\ResponseInterface as Response;

final class DocumentFormPostAction extends DocumentAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $parsedBody = $this->request->getParsedBody();
    $document = Document::createFromArray($parsedBody);
    $result = $this->documentRepository->set($document);
    $this->logger->info(this::class . ' :: result: ' . $result);
    return $this->redirect('document');
  }
}
