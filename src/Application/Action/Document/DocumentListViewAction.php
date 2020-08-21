<?php

namespace App\Application\Action\Document;

use App\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

final class DocumentListViewAction extends Action
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $this->logger->info('Żądanie podstrony: /dokumenty.');
    return $this->render('list/documents.twig');
  }
}