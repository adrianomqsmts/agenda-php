<?php

namespace App\Model;

class Prioridade
{

  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function getPrioridades()  {
    $query = "SELECT * FROM prioridades";
    $result = $this->conn->query($query);
    if ($result->num_rows > 0) {
      $rows = [];
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
    } else {
      return Null;
    }
  }
}
