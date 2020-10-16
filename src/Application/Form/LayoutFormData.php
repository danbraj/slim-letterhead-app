<?php

namespace App\Application\Form;

class LayoutFormData extends FormData
{
  public function __construct($values = [])
  {
    parent::__construct($values);
    $this->title = 'Szablon';
    $this->description = 'Formularz szablonu';
    $this->submitText = 'Zapisz szablon';
    $this->fields = [
      [
        'name' => 'id',
        'type' => '\App\Application\Form\Property\Hidden',
      ],
      [
        'name' => 'theme',
        'desc' => 'Nazwa szablonu',
        'type' => '\App\Application\Form\Property\Str',
        'required' => true,
      ],
      [
        'name' => 'template',
        'desc' => 'Struktura HTML',
        'type' => '\App\Application\Form\Property\Html',
        'required' => true,
        'hint' => 'Możliwe użycie dynamicznych pól wpisując: [TITLE], [CONTENT], [STYLES], [SIGNATURES].'
      ],
      [
        'name' => 'styles',
        'desc' => 'Style',
        'type' => '\App\Application\Form\Property\Html',
        'required' => true,
      ],
      [
        'name' => 'preview',
        'desc' => 'Podgląd',
        'type' => '\App\Application\Form\Property\Image',
      ]
    ];
  }
}