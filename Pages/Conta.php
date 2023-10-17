<?php


if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['UsuarioID'])){
    session_destroy();
    header("Location: Home.php");
    exit;
}
$nomeUsuario = $_SESSION["UsuarioNome"];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500;600&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="StyleSheet" type="text/css" href="../Styles/Styles.css">
    <title>Minha Conta</title>
</head>
<body>
    <?php include "../Includes/Header.php" ?> 
     < 
</body>
</html>
<a href="Home.php">Voltar Home</a>