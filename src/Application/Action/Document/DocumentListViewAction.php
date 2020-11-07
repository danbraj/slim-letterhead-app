<?php

namespace App\Application\Action\Document;

use Psr\Http\Message\ResponseInterface as Response;

final class DocumentListViewAction extends DocumentAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $documents = $this->documentRepository->findAll();
    return $this->render('list/documents.twig', compact('documents'));
  }
}