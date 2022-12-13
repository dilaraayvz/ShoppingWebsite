<?php
require 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="login.js">
</head>

<body >
<?php
  
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

    <br><br><br>
    <form class="login text-center " action="process.php" method="POST">
        <div class="login-screen">
            <div class="app-title">
                <h1>CREATE A NEW ACCOUNT</h1>
            </div>
            <div class="login-form">
            <div class="control-group">
                    <input type="text" name="name" class="login-field" placeholder="Name" id="login-n" required>
                    <label class="login-field-icon fui-user" for="login-n"></label>
                  <!--  <div id="error"></div> -->

                </div>
                <div class="control-group">
                    <input type="text" name="surname" class="login-field" placeholder="Surname" id="login-s" required>
                    <label class="login-field-icon fui-user" for="login-s"></label>
                </div>
                <div class="control-group">
                    <input type="email" name="user_name" class="login-field" placeholder="E-mail" id="login-name" required>
                    <label class="login-field-icon fui-user" for="login-name"></label>
                </div>
                            <!--<div id="status"> -->
            </div> <br>
            <button name="register" class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>

        </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</body>
</html>