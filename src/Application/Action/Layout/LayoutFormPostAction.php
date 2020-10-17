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
    $uploadedFile = $this->request->getUploadedFiles()['preview'];
    if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
      $this->logger->error('Layout :: UPLOAD_ERR');
      return $this->redirect('layout');
    }

    $fileName = FileUploader::upload($uploadedFile);
    $parsedBody = $this->request->getParsedBody();
    $parsedBody['preview'] = $fileName;
    $layout = Layout::createFromArray($parsedBody);
    $result = $this->layoutRepository->create($layout);
    
    return $this->redirect('layout');
  }
}
