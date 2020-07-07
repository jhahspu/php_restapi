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
$mvs->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get movie
$mvs->getOne();

// Array
$mvs_arr = array(
  'id' => $mvs->id,
  'title' => $mvs->title,
  'tagline' => $mvs->tagline,
  'release_date' => $mvs->release_date,
  'backdrop' => $mvs->backdrop
);

// Print array in JSON format
print_r(json_encode($mvs_arr));