<?php
try {
    $db = new PDO("mysql:hostname=localhost;dbname=shopping;charset=utf8","root", "");
} catch (PDOException $e){
    echo $e->getMessage();
}

$conn=mysqli_connect('localhost','root','','shopping');


?>