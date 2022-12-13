<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Main Page</title>
</head>

<body>


  <div>
    <?php

    require 'db.php';

    session_start();
    if (isset($_SESSION["user"])) {
      $user = strtok($_SESSION['user'], '@');
      $date = $_SESSION['lastactivity'];
      $os = $_SESSION['operatingsystem'];
      $screen = $_SESSION['screenresolution'];
      echo "<br><br><br>Welcome " . $user . " <br>
Last activity : " . $date . "<br>
Operating system: " . $os . "<br>
<a href='signout.php'>Logout</a>
<br>
";
      echo "<a href='dashboard.php'>See online users</a><br>";
      //echo "<a href='signout.php'>Sign out</a><br><br><br><br>";
    }

    if (isset($_SESSION["shoppingCart"])) {
      $shoppingCart = $_SESSION["shoppingCart"];

      $total_count = $shoppingCart["summary"]["total_count"];
      $total_price = $shoppingCart["summary"]["total_price"];
      $shopping_products = $shoppingCart["products"];
    } else {
      $total_count = 0;
      $total_price = 0;
    }
    ?>

  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link " href="main.php" aria-current="page">Mainpage</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="article.php" aria-current="page">Article</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a href="cart.php">
              <button type="button" class="btn btn-primary">
                Shopping Card <span class="badge cart-count"><?php echo $total_count; ?></span>
              </button>
            </a>

          </li>
        </ul>

      </div>
    </div>
  </nav>



  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/201801_BylFDwYErf.jpg" class="d-block w-100 resimSlider" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/Special-Sale-Pic.png" class="d-block w-100 resimSlider" alt="...">
      </div>
      <div class="carousel-item">
        <img src="img/unnamed.jpg" class="d-block w-100 resimSlider" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>

<script>
  var screenHeight = window.screen.availHeight;
  var screenWidth = window.screen.availWidth;
</script>