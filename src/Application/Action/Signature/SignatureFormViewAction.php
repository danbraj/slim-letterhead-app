<?php

namespace App\Application\Action\Signature;

use App\Application\Form\SignatureFormData;
use Psr\Http\Message\ResponseInterface as Response;

final class SignatureFormViewAction extends SignatureAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $signatureFormData = new SignatureFormData();
    $id = intval($this->resolveArg('id'));
    if ($id) {
      $signature = $this->signatureRepository->findOne($id);
      if ($signature) {
        $signatureFormData->attachValues($signature->jsonSerialize());
      }
    }
    return $this->render(
      'form/signature.twig', ['signatureFormData' => $signatureFormData->build()]
    );
  }
}
