<?php

namespace App\Application\Action\Layout;

use Psr\Http\Message\ResponseInterface as Response;

final class LayoutDeleteAction extends LayoutAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $id = intval($this->resolveArg('id'));
    if ($id && $this->layoutRepository->delete($id)) {
      return $this->asJson();
    } else {
      return $this->asJson(null, 403);
    }
    // return $this->redirect('layout');
  }
}
