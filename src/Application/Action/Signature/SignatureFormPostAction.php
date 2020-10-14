<?php

namespace App\Application\Action\Signature;

use App\Letterhead\Signature\Signature;
use Psr\Http\Message\ResponseInterface as Response;

final class SignatureFormPostAction extends SignatureAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $parsedBody = $this->request->getParsedBody();
    $signature = Signature::createFromArray($parsedBody);
    $result = $this->signatureRepository->create($signature);
    return $this->redirect('signature');
  }
}
