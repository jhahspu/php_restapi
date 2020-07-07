<?php

class Mvs {
  // DB
  private $conn;
  private $table = 'movies';

  // Mvs props
  public $id;
  public $title;
  public $tagline;
  public $release_date;
  public $backdrop;

  // Constructor with DB
  public function __construct($db) {
    $this->conn = $db;
  }

  // Get last nine movies
  public function recent() {
    // Create query
    $query = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 9";
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Execute query
    $stmt->execute();
    return $stmt;
  }

  // Get movie based on id
  public function getOne() {
    // Create query
    $query = "SELECT * FROM $this->table WHERE id=? LIMIT 0,1";
    // Prepare statemnt
    $stmt = $this->conn->prepare($query);
    // Bind params
    $stmt->bindParam(1, $this->id);
    // Execute query
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // Set props
    $this->title = $row['title'];
    $this->tagline = $row['tagline'];
    $this->release_date = $row['release_date'];
    $this->backdrop = $row['backdrop'];
  }

}