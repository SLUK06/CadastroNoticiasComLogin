<?php
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['UsuarioID'])){
    session_destroy();
    header("Location: Home.php");
    exit;
}

echo $_SESSION["UsuarioNome"];

?>
<a href="Home.php">Voltar Home</a>