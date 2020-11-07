<?php

namespace App\Application\Action\Layout;

use Psr\Http\Message\ResponseInterface as Response;

final class LayoutListViewAction extends LayoutAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $layouts = $this->layoutRepository->findAll();
    return $this->render('list/layouts.twig', compact('layouts'));
  }
}