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
    $stmt = $this->db->query('SELECT * FROM signature');
    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = Signature::createFromArray($row);
    }
    return $results;
  }

  public function findOne(int $id): Signature
  {
    $stmt = $this->db->prepare('SELECT * FROM signature WHERE id = :id LIMIT 1');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    if ($result) {
      $record = $stmt->fetch();
      if ($record) {
        return Signature::createFromArray($record);
      }
    }
  }

  public function create(Signature $signature): bool
  {
    $stmt = $this->db->prepare(
      'INSERT INTO signature (person, title, facsimile, weight)
      VALUES (:person, :title, :facsimile, :weight)'
    );
    $result = $stmt->execute($signature->jsonSerialize());
    return $result ? $this->db->lastInsertId() : false;
  }

  public function read(int $id): Signature
  {
    return $this->findOne($id);
  }

  public function update(Signature $signature): bool
  {
    try {
      $stmt = $this->db->prepare(
        'UPDATE signature SET person = :person, title = :title, facsimile = :facsimile, weight = :weight WHERE id = :id'
      );
      $result = $stmt->execute($signature->jsonSerialize());
      return $result && $stmt->rowCount() > 0 ? true : false;

    } catch (\Exception $e) {
      var_dump($e);die;
      return false;
    }
  }

  public function delete(int $id): bool
  {
    $stmt = $this->db->prepare('DELETE FROM signature WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result && $stmt->rowCount() > 0 ? true : false;
  }

  public function set(Signature $sig): bool
  {
    return empty($sig->id) ? $this->create($sig) : $this->update($sig);
  }
}
