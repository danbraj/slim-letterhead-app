<?php

namespace App\Application\Action\Signature;

use Psr\Http\Message\ResponseInterface as Response;

final class SignatureDeleteAction extends SignatureAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $id = intval($this->resolveArg('id'));
    if ($id && $this->signatureRepository->delete($id)) {
      return $this->asJson();
    } else {
      return $this->asJson(null, 403);
    }
    // return $this->redirect('signature');
  }
}
