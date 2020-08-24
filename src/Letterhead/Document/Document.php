<?php

declare(strict_types=1);

namespace App\Letterhead\Document;

use JsonSerializable;

class Document implements JsonSerializable
{
  public $id;
  public $name;
  public $content;
  public $type;
  public $preview;

  public function __construct($id, $name, $content, $type, $preview)
  {
    $this->id = $id;
    $this->name = $name;
    $this->content = $content;
    $this->type = $type;
    $this->preview = $preview;
  }

  public static function createFromArray(array $data)
  {
    return new self(
      $data['id'] ?? null,
      $data['name'] ?? null,
      $data['content'] ?? null,
      $data['type'] ?? null,
      $data['preview'] ?? null
    );
  }

  /**
   * @return array
   */
  public function jsonSerialize()
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'content' => $this->content,
      'type' => $this->type,
      'preview' => $this->preview
    ];
  }
}
