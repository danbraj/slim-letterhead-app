<?php

namespace App\Application\Action\Document;

use App\Application\Form\DocumentFormData;
use Psr\Http\Message\ResponseInterface as Response;

final class DocumentFormViewAction extends DocumentAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $documentFormData = new DocumentFormData();
    return $this->render(
      'form/document.twig', ['documentFormData' => $documentFormData->build()]
    );
  }
}
