<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../database/database.php';
include_once '../modules/mvs.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Mvs obj
$mvs = new Mvs($db);

// Movies query last nine movies
$mvs->title = isset($_GET['title']) ? $_GET['title'] : die();

$temp = $_GET['title'];
// Get movie
$result = $mvs->getByTitle($temp);

// Get row count
$num = $result->rowCount();

// Check if any rows
if($num > 0) {
  // Initialize array for end results
  $mvs_arr = array();

  // Extract rows
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $mvs_item = array(
      'id' => $id,
      'title' => $title,
      'tagline' => $tagline,
      'release_date' => $release_date,
      'backdrop' => $backdrop
    );
    // Dump data into reults array
    array_push($mvs_arr, $mvs_item);
  }

  // Encode results into JSON
  echo json_encode($mvs_arr);
  
} else {
  // No Movies
  echo json_encode(
    array('message' => 'No Movies Found')
  );
}