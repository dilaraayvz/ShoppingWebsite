<?php
include "db.php";
session_start();
function addToCart($product_item){
    if(isset($_SESSION["shoppingCart"])){
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
    }
    else {
        $products = array();
    }
    if(array_key_exists($product_item->id, $products)){
        $products[$product_item->id]->count++;
    }
    else {
        $products[$product_item->id] = $product_item;
    }
    
    $total_price = 0.0;
    $total_count = 0;
    foreach ($products as $product){
        
        if($product->count <=5){
            $product->total_price = $product->count * $product->price;
            $total_price = $total_price + $product->total_price ;
            $total_count += $product->count;

        }
        else if($product->count >= 6 && $product->count <= 14 ){
            $product->total_price = $product->count * $product->price * (87 / 100);
            $total_price = $total_price + $product->total_price ;
            $total_count += $product->count;

        }
        else if($product->count >= 15 ){
            $product->total_price = $product->count * $product->price * (76 / 100);
            $total_price = $total_price + $product->total_price ;
            $total_count += $product->count;

        }
    }
    

    $summary["total_price"] = $total_price;
    $summary["total_count"] = $total_count;


    $_SESSION["shoppingCart"] ["products"] = $products;
    $_SESSION["shoppingCart"] ["summary"] = $summary;

    return $total_count;
    

}
function removeFromCart($product_id)
{ 
    if(isset($_SESSION["shoppingCart"])){
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
        if(array_key_exists($product_id, $products)){
            unset($products[$product_id]);
        }
        $total_price = 0.0;
        $total_count = 0;
        foreach ($products as $product){
            if($product->count <=5){
                $product->total_price = $product->count * $product->price;
                $total_price = $total_price + $product->total_price ;
                $total_count += $product->count;

            }
            else if($product->count >= 6 && $product->count <= 14 ){
                $product->total_price = $product->count * $product->price * (87 / 100);
                $total_price = $total_price + $product->total_price ;
                $total_count += $product->count;

            }
            else if($product->count >= 15 ){
                $product->total_price = $product->count * $product->price * (76 / 100);
                $total_price = $total_price + $product->total_price ;
                $total_count += $product->count;

            }
        }
        
    
        $summary["total_price"] = $total_price;
        $summary["total_count"] = $total_count;
    
    
        $_SESSION["shoppingCart"] ["products"] = $products;
        $_SESSION["shoppingCart"] ["summary"] = $summary;
    return true;
    }
}
    

function incCount($product_id){
    if(isset($_SESSION["shoppingCart"])){
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
        if(array_key_exists($product_id, $products)){
            $products[$product_id]->count++;
        }


        $total_price = 0.0;
        $total_count = 0;
        foreach ($products as $product){
            if($product->count <=5){
                $product->total_price = $product->count * $product->price;
                $total_price = $total_price + $product->total_price ;
                $total_count += $product->count;

            }
            else if($product->count >= 6 && $product->count <= 14 ){
                $product->total_price = $product->count * $product->price * (87 / 100);
                $total_price = $total_price + $product->total_price ;
                $total_count += $product->count;

            }
            else if($product->count >= 15 ){
                $product->total_price = $product->count * $product->price * (76 / 100);
                $total_price = $total_price + $product->total_price ;
                $total_count += $product->count;

            }
        }


        $summary["total_price"] = $total_price;
        $summary["total_count"] = $total_count;


        $_SESSION["shoppingCart"] ["products"] = $products;
        $_SESSION["shoppingCart"] ["summary"] = $summary;

        return true ;
    }



}
function decCount($product_id){
    if(isset($_SESSION["shoppingCart"])){
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
        if(array_key_exists($product_id, $products)) {
            $products[$product_id]->count--;
         
            if(!$products[$product_id]->count > '0'){
            unset($products[$product_id]);
            }
           }
       
        
        $total_price = 0.0;
        $total_count = 0;
        foreach ($products as $product){
            if($product->count <=5){
                $product->total_price = $product->count * $product->price;
                $total_price = $total_price + $product->total_price ;
                $total_count += $product->count;

            }
            else if($product->count >= 6 && $product->count <= 14 ){
                $product->total_price = $product->count * $product->price * (87 / 100);
                $total_price = $total_price + $product->total_price ;
                $total_count += $product->count;

            }
            else if($product->count >= 15 ){
                $product->total_price = $product->count * $product->price * (76 / 100);
                $total_price = $total_price + $product->total_price ;
                $total_count += $product->count;

            }
        }
        
    
        $summary["total_price"] = $total_price;
        $summary["total_count"] = $total_count;
    
    
        $_SESSION["shoppingCart"] ["products"] = $products;
        $_SESSION["shoppingCart"] ["summary"] = $summary;
    
        return true ;
        
           
    }

}
if(isset($_POST["p"])){

    $islem = $_POST["p"];
    if($islem == "addToCart"){

        $id = $_POST["product_id"];
        $product = $db->query("SELECT * FROM products WHERE id={$id}", PDO::FETCH_OBJ)->fetch();
        $product->count = 1;
        echo addToCart($product);

    }
    
}
if(isset($_GET["p"])){

    $islem = $_GET["p"];
    if($islem == "incCount"){

        $id = $_GET["product_id"];
        if(incCount($id)){
            header("Location:cart.php");

        }
    }
    else if($islem == "decCount"){
        $id = $_GET["product_id"];
        if(decCount($id)){
            header("Location:cart.php");

        }
    }
    else if($islem == "removeFromCart"){
        $id = $_GET["product_id"];
        if(removeFromCart($id)){
            header("Location:cart.php");

        }
    }
}