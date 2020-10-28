<?php

declare(strict_types=1);

namespace App\Letterhead\Document;

interface DocumentRepository
{
  /**
   * @return Document[]
   */
  public function findAll(): array;

  /**
   * @param int $id
   * @return Document
   * @throws DocumentNotFoundException
   */
  public function findOne(int $id): Document;

  public function create(Document $document): string;
  public function read(int $id): Document;
  public function update(Document $document): bool;
  public function delete(int $id): bool;
  
  public function set(Document $document): string;
}
