<?php

namespace App\Application\Action\Layout;

use App\Application\Form\LayoutFormData;
use Psr\Http\Message\ResponseInterface as Response;

final class LayoutFormViewAction extends LayoutAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $layoutFormData = new LayoutFormData();
    $id = intval($this->resolveArg('id'));
    if ($id) {
      $layout = $this->layoutRepository->findOne($id);
      if ($layout) {
        $layoutFormData->attachValues($layout->jsonSerialize());
      }
    }
    return $this->render(
      'form/layout.twig', ['layoutFormData' => $layoutFormData->build()]
    );
  }
}
