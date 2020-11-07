<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Pdo;

use App\Letterhead\DocumentSignature\DocumentSignature;
use App\Letterhead\DocumentSignature\DocumentSignatureRepository;
use App\Letterhead\Signature\Signature;
use \PDO;

class PdoDocumentSignatureRepository implements DocumentSignatureRepository
{
  private $db;
  
  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function findAll(): array
  {
    $stmt = $this->db->query('SELECT * FROM document_signature');
    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = DocumentSignature::createFromArray($row);
    }
    return $results;
  }

  public function findAllByDocumentId(int $id): array
  {
    $stmt = $this->db->prepare('SELECT * FROM document_signature WHERE documentId = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    if ($result) {
      $results = [];
      while ($row = $stmt->fetch()) {
        $results[] = DocumentSignature::createFromArray($row);
      }
    }
    return $results;
  }

  public function findAllBySignatureId(int $id): array
  {
    $stmt = $this->db->prepare('SELECT * FROM document_signature WHERE signatureId = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    if ($result) {
      $results = [];
      while ($row = $stmt->fetch()) {
        $results[] = DocumentSignature::createFromArray($row);
      }
    }
    return $results;
  }

  public function findSignatures(int $documentId): array
  {
    $stmt = $this->db->prepare('SELECT * FROM document_signature A INNER JOIN signature B ON A.signatureId = B.id WHERE A.documentId = :documentId');
    $stmt->bindValue(':documentId', $documentId, PDO::PARAM_INT);
    $result = $stmt->execute();
    if ($result) {
      $results = [];
      while ($row = $stmt->fetch()) {
        $results[] = Signature::createFromArray($row);
      }
    }
    return $results;
  }

  public function findOne(int $documentId, int $signatureId): DocumentSignature
  {
    $stmt = $this->db->prepare('SELECT * FROM document_signature WHERE documentId = :documentId AND signatureId = :signatureId LIMIT 1');
    $stmt->bindValue(':documentId', $documentId, PDO::PARAM_INT);
    $stmt->bindValue(':signatureId', $signatureId, PDO::PARAM_INT);
    $result = $stmt->execute();
    if ($result) {
      $record = $stmt->fetch();
      if ($record) {
        return DocumentSignature::createFromArray($record);
      }
    }
  }

  public function create(DocumentSignature $documentSignature): bool
  {
    $stmt = $this->db->prepare(
      'INSERT INTO document_signature (documentId, signatureId)
      VALUES (:documentId, :signatureId)'
    );
    $result = $stmt->execute([
      'documentId' => $documentSignature->documentId,
      'signatureId' => $documentSignature->signatureId
    ]);
    // return $result ? $this->db->lastInsertId() : false;
    return $result ? true : false;
  }

  public function read(int $documentId, int $signatureId): DocumentSignature
  {
    return $this->findOne($documentId, $signatureId);
  }

  public function delete(int $documentId, int $signatureId): bool
  {
    $stmt = $this->db->prepare('DELETE FROM document_signature WHERE documentId = :documentId AND signatureId = :signatureId');
    $stmt->bindValue(':documentId', $documentId, PDO::PARAM_INT);
    $stmt->bindValue(':signatureId', $signatureId, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result && $stmt->rowCount() > 0 ? true : false;
  }

  public function deleteSignatures(int $documentId): bool
  {
    $stmt = $this->db->prepare('DELETE FROM document_signature WHERE documentId = :documentId');
    $stmt->bindValue(':documentId', $documentId, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result && $stmt->rowCount() > 0 ? true : false;
  }

  public function set(DocumentSignature $docSig): bool
  {
    return $this->create($docSig);
  }
}
