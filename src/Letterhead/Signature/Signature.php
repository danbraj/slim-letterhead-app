<?php

declare(strict_types=1);

namespace App\Letterhead\Signature;

use JsonSerializable;

class Signature implements JsonSerializable
{
  public $id;
  public $person;
  public $title;
  public $facsimile;
  public $weight;

  public function __construct($id, $person, $title, $facsimile, $weight)
  {
    $this->id = $id;
    $this->person = $person;
    $this->title = $title;
    $this->facsimile = $facsimile;
    $this->weight = $weight;
  }

  public static function createFromArray(array $data)
  {
    return new self(
      $data['id'] ?? null,
      $data['person'] ?? null,
      $data['title'] ?? null,
      $data['facsimile'] ?? null,
      $data['weight'] ?? null
    );
  }

  /**
   * @return array
   */
  public function jsonSerialize()
  {
    return [
      'id' => $this->id,
      'person' => $this->person,
      'title' => $this->title,
      'facsimile' => $this->facsimile,
      'weight' => $this->weight
    ];
  }
}
