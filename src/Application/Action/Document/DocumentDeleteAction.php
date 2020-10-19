<?php

namespace App\Application\Action\Document;

use Psr\Http\Message\ResponseInterface as Response;

final class DocumentDeleteAction extends DocumentAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $id = intval($this->resolveArg('id'));
    if ($id && $this->documentRepository->delete($id)) {
      return $this->asJson();
    } else {
      return $this->asJson(null, 403);
    }
    // return $this->redirect('document');
  }
}
