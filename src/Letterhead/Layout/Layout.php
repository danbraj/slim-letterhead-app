<?php

declare(strict_types=1);

namespace App\Letterhead\Layout;

use JsonSerializable;

class Layout implements JsonSerializable
{
  public $id;
  public $theme; // as name
  public $template;
  public $styles;
  public $preview;

  public function __construct($id, $theme, $template, $styles, $preview)
  {
    $this->id = $id;
    $this->theme = $theme;
    $this->template = $template;
    $this->styles = $styles;
    $this->preview = $preview;
  }

  public static function createFromArray(array $data)
  {
    return new self(
      $data['id'] ?? null,
      $data['theme'] ?? null,
      $data['template'] ?? null,
      $data['styles'] ?? null,
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
      'theme' => $this->theme,
      'template' => $this->template,
      'styles' => $this->styles,
      'preview' => $this->preview
    ];
  }
}
