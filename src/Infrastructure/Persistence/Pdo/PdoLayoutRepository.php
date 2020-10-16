<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Pdo;

use App\Letterhead\Layout\Layout;
use App\Letterhead\Layout\LayoutRepository;
use \PDO;

class PdoLayoutRepository implements LayoutRepository
{
  private $db;
  
  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function findAll(): array
  {
    $stmt = $this->db->query('SELECT * FROM layout');
    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = Layout::createFromArray($row);
    }
    return $results;
  }

  public function findOne(int $id): Layout
  {
    $stmt = $this->db->prepare('SELECT * FROM layout WHERE id = :id LIMIT 1');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    if ($result) {
      $record = $stmt->fetch();
      if ($record) {
        return Layout::createFromArray($record);
      }
    }
  }

  public function create(Layout $layout): bool
  {
    $stmt = $this->db->prepare(
      'INSERT INTO layout (theme, template, styles, preview)
      VALUES (:theme, :template, :styles, :preview)'
    );
    $result = $stmt->execute([
      'theme' => $layout->theme,
      'template' => $layout->template,
      'styles' => $layout->styles,
      'preview' => $layout->preview
    ]);
    // return $result ? $this->db->lastInsertId() : false;
    return $result ? true : false;
  }

  public function read(int $id): Layout
  {
    return $this->findOne($id);
  }

  public function update(Layout $layout): bool
  {
    try {
      $stmt = $this->db->prepare(
        'UPDATE layout SET theme = :theme, template = :template, styles = :styles, preview = :preview WHERE id = :id'
      );
      $result = $stmt->execute($layout->jsonSerialize());
      return $result && $stmt->rowCount() > 0 ? true : false;

    } catch (\Exception $e) {
      var_dump($e);die;
      return false;
    }
  }

  public function delete(int $id): bool
  {
    $stmt = $this->db->prepare('DELETE FROM layout WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    return $result && $stmt->rowCount() > 0 ? true : false;
  }

  public function set(Layout $doc): bool
  {
    return empty($doc->id) ? $this->create($doc) : $this->update($doc);
  }
}
