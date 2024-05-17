<?php

if (isset($_POST['submit'])) {
  $productId = [];
  $productQuantity = [];
  // Storing the id of the produts selected.
  foreach ($_POST['select'] as $id) {
    array_push($productId, $id);
  }
  // Storing the quantities of product selected.
  foreach ($_POST['quantity'] as $quantity) {
    array_push($productQuantity, $quantity);
  }

  require_once('Connection.php');
  $connection = new Connection();
  // Calculating price of products selected.
  $total = $connection->evaluatePrice($productId, $productQuantity);
}

if (isset($_POST['checkout-submit'])) {
  // User name.
  $name = trim($_POST['name']);
  // User email.
  $email = trim($_POST['email']);
  // User phone number.
  $number = trim($_POST['phone']);
  // Total price.
  $price = trim($_POST['total']);

  // Checking for valid input format.
  if (preg_match("/^[a-zA-Z ]{3,25}$/", $name) && preg_match("/^[0-9]{10}$/", $number) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    require_once('User.php');
    // Object of User class.
    $user = new User($name, $email, $number, $price);
    // Sending mail.
    $user->sendEmail();
    $msg = "Mail sent.";
    // Creating a file to store required information.
    $user->createPdf();
  }
  else {
    $msg = "Invalid input present.";
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
  <style>
    <?php include 'style.css'; ?>
  </style>
</head>
<body>
  <div class="container">
    <div class="checkout-form">
      <h3>Checkout</h3>
      <form action="" method="post">
        <span><p><?= $msg ?></p></span>
        <input type="hidden" name="total" value="<?= $total ?>">
        <div class="row checkout-products-input">
          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <label for="name" class="form-label">User Name</label>
              <input type="text" name="name" class="form-control" pattern="^[a-zA-Z ]*$" min="3" max="25" required>
            </div>
          </div>
        </div>
        
        <div class="row add-products-input">
          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <label for="email" class="form-label">User Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
          </div>
        </div>
        
        <div class="row add-products-input">
          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <label for="phone" class="form-label">User Phone Number</label>
              <input type="text" name="phone" class="form-control" pattern="^[0-9]*$" min="10" max="10" required>
            </div>
          </div>
        </div>
        
        <div class="row add-products-input">
          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <label for="price" class="form-label">Total Price</label>
              <input type="text" name="price" class="form-control" value="<?= $total ?>" disabled>
            </div>
          </div>
        </div>
        
        <input type="submit" value="submit" name="checkout-submit" class="btn btn-primary">
      </form>
    </div>
    <span><a href="/" class="btn btn-primary float-end">Back to dashboard</a></span>
  </div>
</body>
</html>