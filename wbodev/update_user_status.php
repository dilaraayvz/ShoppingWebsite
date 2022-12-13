<?php
session_start();
include('db.php');

$uid=$_SESSION['UID'];
$time=time()+10;
$res=mysqli_query($conn,"UPDATE user SET last_login=$time WHERE id=$uid");



?>