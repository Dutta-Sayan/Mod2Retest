<?php
session_start();
if (isset($_POST['submit'])) {
  // Name of product.
  $name = trim($_POST['name']);
  // Price of product.
  $price = trim($_POST['price']);
  // Category of product.
  $category = trim($_POST['category']);

  // Checking for valid input formats.
  if (preg_match("/^[a-zA-Z0-9 ]{3,25}$/", $name) && (preg_match("/^[0-9]{1,5}$/", $price) && ($category == '1' || $category == '2'))) {
    require_once('Connection.php');
    // Object fo Connection class.
    $connection = new Connection();
    $connection->insertProduct($name, $price, $category);
    // Message for successful product insertion.
    $msg = "Product inserted";
    $name = "";
    $price = "";
    $category = "";
  }
  else {
    // Message for invalid input format.
    $msg = "invalid input present";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    <?php include 'style.css'; ?>
  </style>
</head>
<body>
  <div class="container">
    <span class="float-end"><a href="/logout" class="btn btn-danger">Logout</a></span>
    <div class="add-products-div">
      <h3>ADD Products</h3>
      <form action="" method="post">
        <div class="row add-products-input">
          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <label for="name" class="form-label">Product Name</label>
              <input type="text" name="name" class="form-control" pattern="^[a-zA-Z0-9 ]*$" min="3" max="25" value="<?= $name ?>" placeholder="Maximum 25 alphabets" required>
            </div>
          </div>
        </div>

        <div class="row add-products-input">
          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <label for="price" class="form-label">Product Price</label>
              <input type="number" name="price" class="form-control" value="<?= $price ?>" min="1" max="10000" required>
            </div>
          </div>
        </div>

        <div class="row add-products-input">
          <div class="col">
          <select class="form-select" name="category" aria-label="Default select example" required>
            <option selected>Category</option>
            <option value="1">1: Healthy</option>
            <option value="2">2: Unhealthy</option>
          </select>
          </div>
        </div>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
      </form>
      <span><p><?= $msg ?></p></span>
    </div>
  </div>
</body>
</html>