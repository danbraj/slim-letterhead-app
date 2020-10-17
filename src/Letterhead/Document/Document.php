<?php

declare(strict_types=1);

namespace App\Letterhead\Document;

use JsonSerializable;

class Document implements JsonSerializable
{
  public $id;
  public $name;
  public $header;
  public $content;
  public $type;
  public $layoutId;

  public function __construct($id, $name, $header, $content, $type, $layoutId)
  {
    $this->id = $id;
    $this->name = $name;
    $this->header = $header;
    $this->content = $content;
    $this->type = $type;
    $this->layoutId = $layoutId;
  }

  public static function createFromArray(array $data)
  {
    return new self(
      $data['id'] ?? null,
      $data['name'] ?? null,
      $data['header'] ?? null,
      $data['content'] ?? null,
      $data['type'] ?? null,
      $data['layoutId'] ?? null
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
      'header' => $this->header,
      'content' => $this->content,
      'type' => $this->type,
      'layoutId' => $this->layoutId
    ];
  }
}
