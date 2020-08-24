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
    $stmt = $this->db->query('SELECT * FROM document');
    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = Document::createFromArray($row);
    }
    return $results;
  }

  public function findOne(int $id): Document
  {
    $stmt = $this->db->prepare('SELECT * FROM document WHERE id = :id LIMIT 1');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    if ($result) {
      $record = $stmt->fetch();
      if ($record) {
        return Document::createFromArray($record);
      }
    }
  }

  public function create(Document $document): bool
  {
    $stmt = $this->db->prepare(
      'INSERT INTO document (name, content, type, preview)
      VALUES (:name, :content, :type, :preview)'
    );
    $result = $stmt->execute($document->jsonSerialize());
    return $result ? $this->db->lastInsertId() : false;
  }

  public function read(int $id): Document
  {
    return $this->findOne($id);
  }

  public function update(Document $document): bool
  {
    try {
      $stmt = $this->db->prepare(
        'UPDATE document SET name = :name, content = :content, type = :type, preview = :preview WHERE id = :id'
      );
      $result = $stmt->execute($document->jsonSerialize());
      return $result && $stmt->rowCount() > 0 ? true : false;

    } catch (\Exception $e) {
      var_dump($e);die;
      return false;
    }
  }

  public function delete(int $id): bool
  {
    $stmt = $this->db->prepare('DELETE FROM document WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result && $stmt->rowCount() > 0 ? true : false;
  }

  public function set(Document $doc): bool
  {
    return empty($doc->id) ? $this->create($doc) : $this->update($doc);
  }
}
