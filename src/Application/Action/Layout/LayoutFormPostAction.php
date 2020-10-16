<?php

namespace App\Application\Action\Layout;

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
    $layout = Layout::createFromArray($parsedBody);
    $result = $this->layoutRepository->create($layout);
    return $this->redirect('layout');
  }
}
