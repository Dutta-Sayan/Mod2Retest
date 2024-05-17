<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Connection
{
  /**
   * Stores the connection PDO.
   *
   * @var object
   */
  public $conn;

  /**
   * Creates the database connection.
   */
  public function __construct()
  {
    // Stores the servername from .env file.
    $servername = $_ENV['SERVERNAME'];
    // Stores the username from .env file.
    $username = $_ENV['USERNAME'];
    // Stores the password from .env file.
    $password = $_ENV['PASSWORD'];
    // Stores the dataabse name from .env file.
    $db = $_ENV['DATABASE'];

    try {
      // Making the database connection.
      $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  /**
   * Function to check if user is present in database.
   * 
   * @param string $email
   *  Email of user.
   * 
   * @param string $password
   *  Password of user.
   */
  public function checkUser(string $email, string $password)
  {
    $sql = "SELECT * from Users where email='$email' and password='$password';";
    // Preparing the query for execution.
    $stmt = $this->conn->prepare($sql);
    // Executing the query.
    $stmt->execute();
    // Converting and storing the result as array.
    $result = $stmt->fetchAll();
    return $result;
  }

  /**
   * Function to insert product in database.
   * 
   * @param string $name
   *  Name of product.
   * 
   * @param string $price
   *  Price of product.
   * 
   * @param string $category
   *  Category of product.
   */
  public function insertProduct(string $name, string $price, string $category)
  {
    $sql = "INSERT into Products(name, price, category) values('$name', '$price', '$category');";
    // Preparing the query for execution.
    $stmt = $this->conn->prepare($sql);
    // Executing the query.
    $stmt->execute();
  }

  /**
   * Function to fetch category 1 products.
   */
  public function cat1Data()
  {
    $sql = "SELECT * from Products where category = '1'";
    // Preparing the query for execution.
    $stmt = $this->conn->prepare($sql);
    // Executing the query.
    $stmt->execute();
    // Converting and storing the result as array.
    $result = $stmt->fetchAll();
    return $result;
  }

  /**
   * Function to fetch category 2 products.
   */
  public function cat2Data()
  {
    $sql = "SELECT * from Products where category = '2'";
    // Preparing the query for execution.
    $stmt = $this->conn->prepare($sql);
    // Executing the query.
    $stmt->execute();
    // Converting and storing the result as array.
    $result = $stmt->fetchAll();
    return $result;
  }

  public function evaluatePrice(array $productId, array $productQuantity)
  {
    $price = [];
    foreach ($productId as $id) {
      $sql = "SELECT price from Products where id = '$id'";
      // Preparing the query for execution.
      $stmt = $this->conn->prepare($sql);
      // Executing the query.
      $stmt->execute();
      // Converting and storing the result as array.
      $result = $stmt->fetchAll();
      array_push($price, $result[0][0]);
    }

    $total = 0;
    for ($i=0; $i<count($price); $i++) {
      $total += $productQuantity[$i] * $price[$i];
    }
    return $total;
  }
}