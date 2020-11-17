<?php

namespace App\Application\Action\Dashboard;

use App\Application\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

final class DashboardAction extends Action
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    return $this->render('dashboard.twig');
  }
}