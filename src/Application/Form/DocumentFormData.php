<?php

namespace App\Application\Form;

class DocumentFormData extends FormData
{
  public function __construct($values = [])
  {
    parent::__construct($values);
    $this->title = 'Dokument';
    $this->description = 'Formularz dokumentu';
    $this->submitText = 'Zapisz dokument';
    $this->fields = [
      [
        'name' => 'id',
        'type' => '\App\Application\Form\Property\Hidden',
      ],
      [
        'name' => 'name',
        'desc' => 'Nazwa dokumentu',
        'type' => '\App\Application\Form\Property\Str', // +podmienienie danych w tekście
        'required' => true,
      ],
      [
        'name' => 'content',
        'desc' => 'Szablon dokumentu',
        'type' => '\App\Application\Form\Property\Html',
        'required' => true,
      ],
      [
        'name' => 'type',
        'desc' => 'Typ',
        'type' => '\App\Application\Form\Property\Radio',
        'required' => true,
        'values' => [
          0 => 'PDF',
          1 => 'E-mail'
        ]
      ],
      [
        'name' => 'preview',
        'desc' => 'Podgląd',
        'type' => '\App\Application\Form\Property\Image',
      ],
      [
        'name' => 'signatures',
        'desc' => 'Podpisy',
        'type' => '\App\Application\Form\Property\Signatures'
      ]
    ];
  }
}