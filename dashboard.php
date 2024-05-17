<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    <?php include 'script.js'; ?>
  </script>
  <style>
    <?php include 'style.css'; ?>
  </style>
</head>
<body>
  <div class="container">
    <span><a href="/login" class="btn btn-secondary admin-login">Admin Login</a></span>
    <h3>Products</h3>
    <div class="category-navigation d-flex justify-content-around">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Category 1</h5>
          <a href="#" class="btn btn-primary category-1">Click here</a>
        </div>
      </div>

      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Category 2</h5>
          <a href="#" class="btn btn-primary category-2">Click here</a>
        </div>
      </div>
    </div>

    <form action="/checkout" method="post" class="select-products">
      <div class="category-data d-flex justify-content-around">
        <div class="category-1-data">
          <table class="table table-bordered table-striped">
            <thead>
              <td>Product Name</td>
              <td>Price</td>
              <td>Choose</td>
            </thead>
            <tbody class="category-product-1">
            </tbody>
          </table>
        </div>

        <div class="category-2-data">
          <table class="table table-bordered table-striped">
            <thead>
              <td>Product Name</td>
              <td>Price</td>
              <td>Choose</td>
            </thead>
            <tbody class="category-product-2">
            </tbody>
          </table>
        </div>
      </div>
      <input type="submit" value="submit" name="submit" class="btn btn-primary product-submit">
    </form>
  </div>
</body>
</html>