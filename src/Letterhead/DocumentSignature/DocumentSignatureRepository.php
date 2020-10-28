<?php

declare(strict_types=1);

namespace App\Letterhead\DocumentSignature;

interface DocumentSignatureRepository
{
  /**
   * @return DocumentSignature[]
   */
  public function findAll(): array;
  public function findAllByDocumentId(int $documentId): array;
  public function findAllBySignatureId(int $signatureId): array;
  public function findSignatures(int $documentId): array;

  /**
   * @param int $id
   * @return DocumentSignature
   * @throws DocumentSignatureNotFoundException
   */
  public function findOne(int $documentId, int $signatureId): DocumentSignature;

  public function create(DocumentSignature $documentSignature): bool;
  public function read(int $documentId, int $signatureId): DocumentSignature;
  public function delete(int $documentId, int $signatureId): bool;
  
  public function set(DocumentSignature $documentSignature): bool;
}
