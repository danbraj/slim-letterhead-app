<?php

namespace App\Application\Form;

class SignatureFormData extends FormData
{
  public function __construct()
  {
    $this->title = 'Sygnatura';
    $this->description = 'Formularz sygnatury';
    $this->submitText = 'Zapisz sygnaturę';
    $this->hasUpload = true;
    $this->fields = [
      [
        'name' => 'id',
        'type' => '\App\Application\Form\Property\Hidden',
      ],
      [
        'name' => 'person',
        'desc' => 'Imię i nazwisko',
        'type' => '\App\Application\Form\Property\Str',
        'required' => true,
      ],
      [
        'name' => 'title',
        'desc' => 'Tytuł osoby',
        'type' => '\App\Application\Form\Property\Str',
      ],
      [
        'name' => 'facsimile',
        'desc' => 'Faksymila',
        'type' => '\App\Application\Form\Property\Image',
      ],
      [
        'name' => 'weight',
        'desc' => 'Waga sygnatury',
        'type' => '\App\Application\Form\Property\Number',
      ],
    ];
  }
}