<?php

require_once('Route.php');

// Contains the uri.
$uri = $_SERVER['REQUEST_URI'];

// Extracting the routed path.
$url = explode("/", $uri);

// Checking if the route contains query string values.
if (str_contains($url[1], '?')) {
  // Storing the get paramaters.
  $getVal = explode("?", $url[1]);
  // Storing the route path excluding the query string values.
  $routePath = $getVal[0];
}
else {
  $routePath = $url[1];
}

// Object of Route class.
$route = new Route();

switch ($routePath)
{
  // Route for home or dashboard page.
  case '':
  case '/':
    $route->dashboard();
    break;

  // Route for login page.
  case 'login':
    $route->login();
    break;

  // Route for logout page.
  case 'logout':
    $route->logout();
    break;
  
  // Route for add products page.
  case 'add-products':
    $route->addProducts();
    break;

  // Route for checkout page.
  case 'checkout':
    $route->checkout();
    break;
  
}