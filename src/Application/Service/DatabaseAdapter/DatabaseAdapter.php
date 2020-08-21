<?php

namespace App\Application\Service\DatabaseAdapter;

use PDO;

class DatabaseAdapter
{
  private $db;

  private function addAttributes()
  {
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
 
  public function __construct(string $databasePath)
  {
    $this->db = new PDO("sqlite:" . $databasePath); // sqlite:../data.sqlite3
    $this->addAttributes();
  }

  public function provide()
  {
    return $this->db;
  }
};