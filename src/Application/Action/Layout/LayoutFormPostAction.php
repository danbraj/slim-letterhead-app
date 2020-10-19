<?php

namespace App\Application\Action\Layout;

use App\Application\Util\FileUploader;
use App\Letterhead\Layout\Layout;
use Psr\Http\Message\ResponseInterface as Response;

final class LayoutFormPostAction extends LayoutAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $parsedBody = $this->request->getParsedBody();
    $uploadedFile = $this->request->getUploadedFiles()['preview'];
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
      $fileName = FileUploader::upload($uploadedFile);
      $parsedBody['preview'] = $fileName;
    }
    $layout = Layout::createFromArray($parsedBody);
    $result = $this->layoutRepository->set($layout);

    $this->logger->info(this::class . ' :: result: ' . $result);
    return $this->redirect('layout');
  }
}
