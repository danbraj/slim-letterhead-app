<?php

namespace App\Application\Action\Layout;

use App\Application\Service\Validator\Validator;
use App\Application\Util\FileUploader;
use App\Letterhead\Layout\Layout;
use App\Letterhead\Layout\LayoutRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use Respect\Validation\Validator as v;

final class LayoutFormPostAction extends LayoutAction
{
  private $validator;

  public function __construct(
    LoggerInterface $logger,
    Twig $view,
    LayoutRepository $layoutRepository,
    Validator $validator
  ) {
    parent::__construct($logger, $view, $layoutRepository);
    $this->validator = $validator;
  }

  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $validation = $this->validator->validate($this->request, [
      'theme' => v::notEmpty(),
      'template' => v::notEmpty(),
      'styles' => v::notEmpty()
    ]);
    if ($validation->failed()) {
      return $this->redirect('layout.form');
    }

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
