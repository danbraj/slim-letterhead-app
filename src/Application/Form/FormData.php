<?php

namespace App\Application\Form;

abstract class FormData
{
  protected $title;
  protected $description;
  protected $fields;
  protected $submitText;
  protected $hasUpload = false;
  private $values;

  protected function __construct($values = [])
  {
    $this->values = $values;
  }

  private function includeProperties()
  {
    for ($i=0; $i < count($this->fields); $i++) { 
      $field = $this->fields[$i];
      $property = new $field['type'];
      $template = '';
      if (method_exists($property, 'template')) {
        $template = $property->template();
      }
      $this->fields[$i]['template'] = $template;
      $this->fields[$i]['old'] = $_SESSION['old'][$field['name']] ?? null;
      $this->fields[$i]['value'] = $this->values[$field['name']] ?? null;
    }
  }

  public function attachValues($values = [])
  {
    $this->values = $values;
  }

  public function build()
  {
    $this->includeProperties();
    return [
      'title' => $this->title,
      'description' => $this->description,
      'fields' => $this->fields,
      'submitText' => $this->submitText,
      'hasUpload' => $this->hasUpload
    ];
  }
}
