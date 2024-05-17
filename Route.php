<?php

// Class to handle the routes.
class Route
{
  /**
   * Function to handle login route.
   */
  public function login()
  {
    require_once('login.php');
  }
  /**
   * Function to handle add-products page route.
   */
  public function addProducts()
  {
    require_once('addProducts.php');
  }
  /**
   * Function to handle dashboard page route.
   */
  public function dashboard()
  {
    require_once('dashboard.php');
  }
  /**
   * Function to handle checkout page route.
   */
  public function checkout()
  {
    require_once('checkout.php');
  }
  /**
   * Function for logout route.
   */
  public function logout()
  {
    session_start();
    // Destroys session and redirects to login page.
    session_destroy();
    header('location: /login');
  }
}
