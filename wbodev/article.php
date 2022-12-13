<!Doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Article</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <?php
    
   session_start();
    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = $_SESSION["shoppingCart"];

        $total_count = $shoppingCart["summary"]["total_count"];
        $total_price = $shoppingCart["summary"]["total_price"];
        $shopping_products = $shoppingCart["products"];
    }else{
        $total_count = 0;
        $total_price = 0;
    }
   

    ?>
     
    


    <?php
    include("db.php");
    $products = $db->query("SELECT * from products", PDO::FETCH_OBJ)->fetchAll();
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <!-- Justify-content-end menüyü sağa yasladı. -->
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



    <br><br><br><br><br>

    <div class="container">
        <h2 class="text-center">Products</h2>
        <hr>
        <div class="row">
            <?php foreach ($products as $product) { ?>


                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="img/<?php echo $product->img_url; ?>" alt="1">
                        <div class="caption">
                            <h5><?php echo $product->name; ?></h5>
                            <p class="text-right price-container"><strong><?php echo $product->price; ?> Euro</strong></p>
                            <p>
                                <button product-id="<?php echo $product->id; ?>" class="btn btn-primary btn-block addToCartBtn" role="button">
                                    ADD TO BAG
                                    </a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>



        </div>
    </div>


    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>