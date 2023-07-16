<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
</head>
<body>
    <?php
    session_start();
    if($_SESSION["islogged"] === false){
        unset($_SESSION["islogged"]);
        echo 'Hai sbagliato la password';
    } 
    ?>
    <form method="post" action="./access.php">
        Digita la Password
        <input type="password" name="password">
    </form>
</body>
</html>