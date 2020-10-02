<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// database connection
include_once 'database.php';
// mvs modules
include_once 'mvs.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Mvs obj
$mvs = new Mvs($db);

// Movies query last nine movies
$mvs->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get movie
$mvs->getOne();

// Array
$mvs_arr = array(
  'id' => $mvs->id,
  'tmdb_id' => $mvs->tmdb_id,
  'title' => $mvs->title,
  'tagline' => $mvs->tagline,
  'release_date' => $mvs->release_date,
  'runtime' => $mvs->runtime,
  'genres' => $mvs->genres,
  'overview' => $mvs->overview,
  'poster' => $mvs->poster,
  'backdrop' => $mvs->backdrop,
  'trailers' => $mvs->trailers
);

// Print array in JSON format
print_r(json_encode($mvs_arr));