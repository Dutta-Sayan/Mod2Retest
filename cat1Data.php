<?php
require_once('Connection.php');
// Object of Connection class.
$connection = new Connection();
// Fetching products of category 1 class.
$res = $connection->cat1Data();
if (!empty($res)) {
  header('Content-type: application/json');
  echo json_encode($res);
}
else {
  echo $return = "No record Found";
}
