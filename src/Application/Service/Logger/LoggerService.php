<?php

namespace App\Application\Service\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;

class LoggerService
{
  private $logger;
 
  public function __construct($settings)
  {
    $this->logger = new Logger($settings['name']);
    $processor = new UidProcessor();
    $this->logger->pushProcessor($processor);
    $handler = new StreamHandler($settings['path'], $settings['level']);
    $this->logger->pushHandler($handler);
  }

  public function provide(): LoggerInterface
  {
    return $this->logger;
  }
};