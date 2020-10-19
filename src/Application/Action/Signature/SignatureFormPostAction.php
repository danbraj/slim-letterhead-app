<?php

namespace App\Application\Action\Signature;

use App\Application\Util\FileUploader;
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
    $uploadedFile = $this->request->getUploadedFiles()['facsimile'];
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
      $fileName = FileUploader::upload($uploadedFile);
      $parsedBody['facsimile'] = $fileName;
    }
    $signature = Signature::createFromArray($parsedBody);
    $result = $this->signatureRepository->set($signature);

    $this->logger->info(this::class . ' :: result: ' . $result);
    return $this->redirect('signature');
  }
}
