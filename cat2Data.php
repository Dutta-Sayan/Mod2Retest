<?php
require_once('Connection.php');
// Object of Connection class.
$connection = new Connection();
// Fetching products of category 2.
$res = $connection->cat2Data();
if (!empty($res)) {
  header('Content-type: application/json');
  echo json_encode($res);
}
else {
  echo $return = "No record Found";
}
