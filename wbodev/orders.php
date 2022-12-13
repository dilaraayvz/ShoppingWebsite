<?php
session_start();
include("db.php");
if(isset($_SESSION["user"])){
    $shoppingCart = $_SESSION["shoppingCart"];

    $total_count = $shoppingCart["summary"] ["total_count"];
    $total_price = $shoppingCart["summary"] ["total_price"];
    $shopping_products = $shoppingCart["products"];
    $order_id=$orders;
}
else{
    $total_count = 0;
    $total_price = 0;

    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History of Orders</title>
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-3.6.0.min.js"></script>
</head>

<body>


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
        <?php if ($total_count > 0) { ?>

            <h2 class="text-center">You have <strong><?php echo $total_count; ?></strong> items in your cart.</h2>

            <hr>
            <div class="row">
                <div class="col-md-8 " style="margin-left: 200px;">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <th class="text-center">Picture</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Number</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Order Number</th>
                        </thead>
                        <tbody>
                            <?php foreach ($shopping_products as $product) { ?>

                                <tr>
                                    <td class="text-center" width="120">
                                        <img src="img/<?php echo $product->img_url; ?>" alt="" width="50">
                                    </td>
                                    <td class="text-center"><?php echo $product->name; ?></td>
                                    <td class="text-center"><strong><?php echo $product->price; ?></strong></td>
                                    <td class="text-center">


                                        <input type="text" class="item-count-input " value="<?php echo $product->count; ?>" DISABLED></input>

                                    <td class="text-center"> <?php echo $product->price;  ?> </td>
                                    <td class="text-center"><strong><?php echo $order_id; ?></strong></td>



                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th colspan="2" class="text-right">
                                Number Of Products : <span class="color-danger"><?php echo $total_count; ?> adet</span>
                            </th>
                            <th colspan="4" class="text-right">
                                Total Price : <span class="color-danger"><?php echo $total_price; ?></span>
                            </th>
                        </tfoot>


                    </table>
                    <a href="cart.php" style="font-size:30px ;">Click to buy again</a>
                    <!-- <button class="btn btn-primary" type="submit">  <a href="order.php ">Ödemeye git  </a></button> -->
                </div>


            </div>

        <?php }

        ?>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="custom.css"></script>
</body>

</html