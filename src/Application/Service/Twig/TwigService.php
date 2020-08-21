<?php

namespace App\Application\Service\Twig;

use Slim\Views\Twig;

class TwigService
{
  private $twig;

  private function addExtenstions()
  {
    
  }

  private function addEnvironments()
  {
    $this->twig->getEnvironment()->addGlobal('base_url', BASE_URL);
  }
 
  public function __construct($settings)
  {
    $this->twig = Twig::create($settings['path'], $settings['settings']);
    $this->addEnvironments();
  }

  public function provide()
  {
    return $this->twig;
  }
};