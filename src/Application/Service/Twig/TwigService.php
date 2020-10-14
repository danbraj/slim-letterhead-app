<?php

namespace App\Application\Service\Twig;

use App\Application\Service\Twig\Extension\FormDataExtension;
use Slim\Views\Twig;

class TwigService
{
  private $twig;

  private function addExtenstions()
  {
    $this->twig->addExtension(new FormDataExtension($this->twig));
  }

  private function addEnvironments()
  {
    $this->twig->getEnvironment()->addGlobal('base_url', BASE_URL);
  }
 
  public function __construct($settings)
  {
    $this->twig = Twig::create($settings['path'], $settings['settings']);
    $this->addEnvironments();
    $this->addExtenstions();
  }

  public function provide()
  {
    return $this->twig;
  }
};