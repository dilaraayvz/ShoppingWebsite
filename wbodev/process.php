<?php
ob_start();
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


include('db.php');

if (isset($_POST['register'])) {

    /**
     * A PHP function that will generate a secure random password.
     * 
     * @param int $length The length that you want your random password to be.
     * @return string The random password.
     */
    function random_code($length)
    {
        //A list of characters that can be used in our
        //random password.
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!-.[]?*()';
        //Create a blank string.
        $rndcode = '';
        //Get the index of the last character in our $characters string.
        $characterListLength = mb_strlen($characters, '8bit') - 1;
        //Loop from 1 to the $length that was specified.
        foreach (range(1, $length) as $i) {
            $rndcode .= $characters[random_int(0, $characterListLength)];
        }
        return $rndcode;
    }

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['user_name'];
    $password = "a1b2c3d4"; // auto password
    $code = random_code(5);


    $EmailSay = $db->prepare("SELECT * FROM user WHERE user_name = ?");
    $EmailSay->execute(array($username));
    $control = $EmailSay->fetch(PDO::FETCH_ASSOC);

    if ($control > 0) {
        echo " <script>alert('There is a registered user with this email! Try again')</script>";
        header('Refresh:2, register.php');
    } else {

        if (strlen(strtok($username, '@')) < 5) {

            echo "<script>alert('Your username must be at least 5 characters!')</script>";
            header("Refresh:2, register.php");
        } else {

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
            $mail->addAddress($username, $name);

            $mail->isHTML(true);
            $mail->Subject = "Registration";
            $mail->Body = "<p>Your registration was successful.</p> <p>Your password : $password</p> <p>You should use this code when you change your password.</p> <p>Code : $code</p>";
            //$mail->send();


            if ($mail->send()) {

                //kayit işlemleri
                $query = $db->prepare('INSERT INTO user SET name = ?, surname =?, user_name=?, user_password=?, code=?');
                $add = $query->execute([
                    $name, $surname, $username, $password, $code
                ]);

                if ($add) {
                    echo " <script>alert('Registration is successful " . $name . " Your password has been sent by e-mail')</script> ";
                    header('Refresh:2, login.php');
                } else {
                    echo "<script>alert('Something went wrong. Try again.')</script>";
                    header('Refresh:2, register.php');
                }
            } else {
                echo "<script>alert('Something went wrong. Try again.')</script>";
                header('Refresh:2, register.php');
            }
        }
    }
}


if (isset($_POST['login'])) {
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];

    $EmailSay = $db->prepare("SELECT * FROM user WHERE user_name = ?");
    $EmailSay->execute(array($username));
    $control = $EmailSay->fetch(PDO::FETCH_ASSOC);

    if (!($control > 0)) {

        echo " <script>alert('There is not a registered user with this email! Try again')</script>";
        header('Refresh:2, login.php');
    } else {
        $user_query = $db->prepare('SELECT*FROM user WHERE user_name=? && user_password=?');
        $user_query->execute([
            $username, $password
        ]);

        $num = $user_query->rowCount();
        $regex_lowercase = '/[a-z]/'; // küçük harf
        $regex_uppercase = '/[A-Z]/'; // büyük harf
        $regex_number = '/[0-9]/'; //sayı
        $npw = $_POST['user_password'];


        if (($num == 1) || !(!preg_match_all($regex_lowercase, $npw) || !preg_match_all($regex_uppercase, $npw) || !preg_match_all($regex_number, $npw) || strlen($npw) < 7)) {
            //  $_SESSION['username'] = $username;
            //$_SESSION['password'] = $password;
            if ($password == "a1b2c3d4") {
                echo "<script>alert('You have to change your password first.')</script>";
                header('Refresh:2, password.php');
            } else {

                $sql = "SELECT * FROM user WHERE user_name='$username' AND user_password='$password'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);
                $_SESSION['UID'] = $row['id'];



                $_SESSION['user'] = $username;
                $date = date("d M Y H:i");;
                $_SESSION['lastactivity'] = $date;

                $browser_id = $_SERVER["HTTP_USER_AGENT"];

                if (strpos($browser_id, "Windows")) {
                    $_SESSION['operatingsystem'] = "Windows";
                } else if (strpos($browser_id, "Macintosh")) {
                    $_SESSION['operatingsystem'] = "Macintosh";
                } else if (strpos($browser_id, "Linux")) {
                    $_SESSION['operatingsystem'] = "Linux";
                }

                $_SESSION['screenresolution'] = "<script>document.writeln(screenWidth);</script>";



                $query = $db->prepare("UPDATE user SET operatingsystem = ? WHERE user_name = ?");
                $query->execute([
                    $_SESSION['operatingsystem'],
                    $_SESSION["user"]
                ]);

                $query = $db->prepare("UPDATE user SET last_activity = NOW() WHERE user_name = ?");
                $query->execute([
                    $_SESSION["user"]
                ]);

                header('Refresh:2, dashboard.php');
            }
        } else {
            echo "<script>alert('Wrong email or password. Try again.')</script>";
            header('Refresh:2, login.php');
        };
    }
}


if (isset($_POST['change'])) {

    $npw = $_POST['new_password'];
    $username = $_POST['user_name'];

    $EmailSay = $db->prepare("SELECT * FROM user WHERE user_name = ?");
    $EmailSay->execute(array($username));
    $control = $EmailSay->fetch(PDO::FETCH_ASSOC);

    if (!($control > 0)) {
        echo " <script>alert('There is not a registered user with this email! Try again')</script>";
        header('Refresh:2, password.php ');
    } else {

        $regex_lowercase = '/[a-z]/'; // küçük harf
        $regex_uppercase = '/[A-Z]/'; // büyük harf
        $regex_number = '/[0-9]/'; //sayı
        if ((!preg_match_all($regex_lowercase, $npw) || !preg_match_all($regex_uppercase, $npw) || !preg_match_all($regex_number, $npw) || strlen($npw) < 7)) {
            echo "<script>alert('Password must contain at least one uppercase ,lowercase letter and number.')</script>";
            header('Refresh:2, password.php ');
        } else {
            $code = $_POST['code'];

            $c = $db->query("SELECT * FROM user WHERE code='" . $code . " 'AND user_name='" . $username . "'")->rowCount();

            if ($c != 0) {

                $query = $db->prepare("UPDATE user SET user_password = ? WHERE user_name = ?");
                $query->execute([
                    $npw, $username
                ]);

                echo "<script>alert('Password changed successfully.')</script>";
                header('Refresh:2, login.php ');
            } else {
                echo "<script>alert('Wrong code!!')</script>";
                header('Refresh:2,password.php');
            }
        }
    }
}
