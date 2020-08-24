<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Pdo;

use App\Letterhead\Signature\Signature;
use App\Letterhead\Signature\SignatureRepository;
use \PDO;

class PdoSignatureRepository implements SignatureRepository
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

  public function findOne(int $id): Signature
  {
    die;
  }

  public function create(Signature $signature): bool
  {
    die;
  }

  public function read(int $id): Signature
  {
    die;
  }

  public function update(Signature $signature): bool
  {
    die;
  }

  public function delete(int $id): bool
  {
    die;
  }

  public function set(Signature $signature): bool
  {
    die;
  }
}
