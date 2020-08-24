<?php

declare(strict_types=1);

namespace App\Letterhead\DocumentSignature;

use JsonSerializable;

class DocumentSignature implements JsonSerializable
{
  public $documentId;
  public $signatureId;

  public function __construct($documentId, $signatureId)
  {
    $this->documentId = $documentId;
    $this->signatureId = $signatureId;
  }

  public static function createFromArray(array $data)
  {
    return new self(
      $data['documentId'] ?? null,
      $data['signatureId'] ?? null
    );
  }

  /**
   * @return array
   */
  public function jsonSerialize()
  {
    return [
      'documentId' => $this->documentId,
      'signatureId' => $this->signatureId
    ];
  }
}
