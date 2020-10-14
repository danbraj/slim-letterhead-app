<?php

namespace App\Application\Service\Twig\Extension;

use Slim\Views\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FormDataExtension extends AbstractExtension
{
  private $twig;

  public function __construct(Twig $twig)
  {
    $this->twig = $twig;
  }

  public function getFunctions()
  {
    return [
      new TwigFunction('formData', [$this, 'buildForm'], ['is_safe' => ['html']])
    ];
  }

  public function buildForm(array $data)
  {
    return $this->twig->fetch('includes/form.twig', ['formData' => $data]);
  }
}