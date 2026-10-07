<?php
    session_start();
    if(!isset($_SESSION['empresa'])){
        header('Location:autenticar.html');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Opaaaaaaaaaa!!   Bem vindo!!!</h1>
</body>
</html>