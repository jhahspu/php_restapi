<?php

class Mvs {
  // DB
  private $conn;
  private $table = 'movies';

  // Mvs props
  public $id;
  public $title;
  public $tagline;

  // Constructor with DB
  public function __construct($db) {
    $this->conn = $db;
  }

  // Get last nine movies
  public function lastNine() {
    // Create query
    $query = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 9";
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }

}