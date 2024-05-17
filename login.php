<?php

if (isset($_POST['submit'])) {
  // Email of admin.
  $email = trim($_POST['email']);
  // Password of admin.
  $password = $_POST['password'];
  // Checking if email and password is of valid format.
  if (preg_match("/^[a-zA-Z0-9 ]{8,32}$/", $password) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    require_once('Connection.php');

    // Object of Connection class.
    $connection = new Connection();
    // Checking if email and password exists in database.
    $res = $connection->checkUser($email, $password);
    // For valid credentials.
    if (!empty($res)) {
      // Starting session.
      session_start();
      $_SESSION['username'] = $email;
      // Redirecting to add-products page.
      header('location: /add-products');
    }
    else {
      // Message for invalid credentials.
      $msg = "Invalid credentials";
    }
  }
  else {
    // Message for invalid input format.
    $msg = "Input format not valid";
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
    <section class="login-section">
      <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
          <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
              <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Login</h3>
                  <span><?php echo $msg ?></span>
                  <form action="" method ="post">

                    <div class="row">
                      <div class="col-md-6 mb-4 pb-2">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="email">Email</label>
                          <input type="email" id="email" name="email" class="form-control form-control-lg" required/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-4 pb-2">
                        <div data-mdb-input-init class="form-outline">
                          <label class="form-label" for="password">Password</label>
                          <input type="password" id="password" name="password" class="form-control form-control-lg" required/>
                        </div>
                      </div>
                    </div>

                    <div class="mt-4 pt-2">
                      <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg" name="submit" type="submit" value="Submit" />
                    </div>
                  </form>
                  <span><a href="/" class="btn btn-secondary">Dashboard</a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>
  </div>
</body>
</html>
