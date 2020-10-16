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
    return $this->render(
      'form/layout.twig', ['layoutFormData' => $layoutFormData->build()]
    );
  }
}
