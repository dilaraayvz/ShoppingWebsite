<?php
include("db.php");
session_start();
if (!isset($_SESSION['UID'])) {
    header('location:login.php');
    die();
}
$time=time();
$res = mysqli_query($conn, "SELECT * FROM user");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      
</head>

<body>

    <div class="container" style="margin-top: 40px;">
        <h2 class="text-center text-info">User Status Dashboard</h2>
        <h5 class="text-center text-info"><a href="signout.php">Logout</a></h5>
        <h5 class="text-center text-info"><a href="main.php">Main Page</a></h5>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="80%">Name</th>
                    <th width="15%">Status</th>
                </tr>
            </thead>
            <tbody id="user_grid" >
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $status = 'Offline';
                    $class = "btn-danger";
                    if ($row['last_login'] > $time) {
                        $status = 'Online';
                        $class = "btn-success";
                    }
                ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $row['name'] ?></td>
                        <td><button type="button" class="btn <?php echo $class ?>"><?php echo $status ?></button></td>
                    </tr>
                <?php
                    $i++;
                } ?>
            </tbody>
        </table>
    </div>
    <script>
        function updateUserStatus() {
            jQuery.ajax({
                url: 'update_user_status.php',
                success: function() {

                }
            });
        }

        function getUserStatus() {
            jQuery.ajax({
                url: 'get_user_status.php',
                success: function(result) {
                    jQuery('#user_grid').html(result);
                }
            });
        }

        setInterval(function() {
            updateUserStatus();
        }, 1000);

        setInterval(function() {
            getUserStatus();
        }, 2000);
    </script>

</body>

</html>l