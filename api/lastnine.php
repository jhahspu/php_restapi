<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../cfg/db.php';
include_once '../mod/mvs.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Mvs obj
$mvs = new Mvs($db);

// Movies query last nine movies
$result = $mvs->lastNine();

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
      'tmdb_id' => $tmdb_id,
      'title' => $title,
      'tagline' => $tagline,
      'release_date' => $release_date,
      'runtime' => $runtime,
      'genres' => $genres,
      'overview' => $overview,
      'poster' => $poster,
      'backdrop' => $backdrop,
      'trailers' => $trailers
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

