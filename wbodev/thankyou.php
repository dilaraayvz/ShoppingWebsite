<?php
session_start();
include("db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



    if (isset($_SESSION['user'])) {

        $shoppingCart = $_SESSION["shoppingCart"];
        $user_name = $_SESSION["user"];
        $total_amount = $shoppingCart["summary"]["total_count"];
        $shopping_products = $shoppingCart["products"];

        $query = $db->prepare('INSERT INTO orders SET user_name = ?, total_amount=?');
        $add = $query->execute([
            $user_name, $total_amount
        ]);

        $order_id = $db->lastInsertId();

        foreach ($shopping_products as $product) {
            $query2 = $db->prepare('INSERT INTO order_details SET order_id = ?,item_quantity=?, item_name=?, shipping=?');
            $add2 = $query2->execute([
                $order_id, $product->count, $product->name, $order_id
            ]);
        }

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPKeepAlive = true;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";

        $mail->Username = "webprj755@gmail.com";
        $mail->Password = "webProject1!";

        $mail->setFrom("webprj755@gmail.com", "Web Project");
        $mail->addAddress($user_name);

        $mail->isHTML(true);
        $mail->Subject = "Thanks for your shopping!";
        $mail->Body = "Shopping details: <br> 
            Order number : $order_id <br>
            Total product amount : $total_amount <br> ";

        foreach ($shopping_products as $product) {
            $mail->Body .= " Product : $product->name = Quantity : $product->count <br>";
        }

        $mail->send();
    } 


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">

    <title>ThankYou</title>
</head>

<body style="background-color:beige;">
    <div style="text-align: center">
        <p style="font-size: 100px; margin-top: 100px;">THANK YOU FOR SHOPPING </p>
        <p style="font-size: 80px; ">WE SENT YOUR SHOPPING DETAILS VIA EMAIL</p>
        <a href="main.php" style="font-size:50px ;">Click to return to homepage</a> <br>
        <a href="orders.php" style="font-size:50px ;">Click to see yours orders</a>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>