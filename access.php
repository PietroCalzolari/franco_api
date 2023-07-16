<?php 
$password = $_POST["password"];

if($password == 'Prova2023')
{
    session_start();
    $_SESSION["islogged"] = true;
    header("location: https://wpschool.it/prova190423/PietroCalzolari/index.php");
    
}
else {
    session_start();
    $_SESSION["islogged"] = false;
    header("location: https://wpschool.it/prova190423/PietroCalzolari/login.php");
}
?>