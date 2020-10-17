<?php

declare(strict_types=1);

namespace App\Application\Action;

use JsonSerializable;

class ActionPayload implements JsonSerializable
{
  private $statusCode;
  private $data;

  public function __construct(int $statusCode = 200, $data = null)
  {
    $this->statusCode = $statusCode;
    $this->data = $data;
  }

  public function getStatusCode(): int
  {
    return $this->statusCode;
  }

  public function getData()
  {
    return $this->data;
  }

  public function jsonSerialize()
  {
    $payload = [
      'statusCode' => $this->statusCode,
    ];
    if ($this->data !== null) {
      $payload['data'] = $this->data;
    }
    return $payload;
  }
}
