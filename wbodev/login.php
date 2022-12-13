<?php
require 'db.php';
session_start();
if (isset($_SESSION['user'])) {
    header('Location:main.php');
}
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
</head>

<body>
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
    <form class="login text-center " action="process.php" method="POST" id="form">
        <div class="login-screen">
            <div class="app-title">
                <h1>LOGIN</h1>
            </div>
            <div class="login-form">
                <div class="control-group">
                    <input type="email" name="user_name" class="login-field" placeholder="Username" id="login-name" required>
                    <label class="login-field-icon fui-user" for="login-name"></label>
                </div>
                <br>
                <div class="control-group">
                    <input type="password" name="user_password" class="login-field" placeholder="Password" id="login-pass" required>
                    <label class="login-field-icon fui-user" for="login-pass"></label>
                </div>
            </div> <br>
            <button name="login" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <br><br>
            <button onclick="window.location='register.php';" class="btn btn-lg btn-primary btn-block" type="submit">Create a new account</button>
            <br><br><a href="password.php" style="color: red;">Forgot Password?</a>
        </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
