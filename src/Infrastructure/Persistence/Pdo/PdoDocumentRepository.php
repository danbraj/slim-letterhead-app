<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Pdo;

use App\Letterhead\Document\Document;
use App\Letterhead\Document\DocumentRepository;
use \PDO;

class PdoDocumentRepository implements DocumentRepository
{
  private $db;
  
  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function findAll(): array
  {
    die;
  }

  public function findOne(int $id): Document
  {
    die;
  }

  public function create(Document $document): bool
  {
    die;
  }

  public function read(int $id): Document
  {
    die;
  }

  public function update(Document $document): bool
  {
    die;
  }

  public function delete(int $id): bool
  {
    die;
  }

  public function set(Document $doc): bool
  {
    die;
  }
}
