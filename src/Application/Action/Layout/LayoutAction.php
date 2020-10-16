<?php

namespace App\Application\Action\Layout;

use App\Application\Action\Action;
use App\Letterhead\Layout\LayoutRepository;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

abstract class LayoutAction extends Action
{
  protected $layoutRepository;

  public function __construct(
    LoggerInterface $logger,
    Twig $view,
    LayoutRepository $layoutRepository
  ) {
    parent::__construct($logger, $view);
    $this->layoutRepository = $layoutRepository;
  }
}
