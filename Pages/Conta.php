<?php
include "../Config/Config.php";

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['UsuarioID'])){
    session_destroy();
    header("Location: Home.php");
    exit;
}
$nomeUsuario = $_SESSION['UsuarioNome'];
$userUsuario = $_SESSION['UsuarioUser'];
$emailUsuario = $_SESSION['UsuarioEmail'];
$nivelUsuario = "";

if($_SESSION['UsuarioNivel'] == 1){
    $nivelUsuario = "COMUM";
}elseif($_SESSION['UsuarioNivel'] == 2){
    $nivelUsuario = "ADMINISTRADOR";
}
$Conn->close();
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
    <link rel="StyleSheet" type="text/css" href="../Styles/StylesConta.css">
    <title>Minha Conta</title>
</head>
<body>
    <?php include "../Includes/Header.php" ?> 
    <main>
        <div class="titulo-conta">
            <text>MINHA CONTA</text>
        </div>

        <div class="sessao meu-nome">
            <label>
                Meu Nome:
                <text><b><?php echo $nomeUsuario ?></b></text>
            </label>
        </div>

        <div class="sessao meu-usuario">
            <label>
                Meu Usuario:
                <text><b><?php echo $userUsuario ?></b></text>
            </label>
        </div>

        <div class="sessao meu-email">
            <label>
                Meu Email:
                <text><b><?php echo $emailUsuario ?></b></text>
            </label>
        </div>

        <div class="sessao meu-nivel">
            <label>
                Meu Nível de Usuario:
                <text><b><?php echo $nivelUsuario ?></b></text>
            </label>
        </div>

        <div class="sessao alterar-senha">
            <label>
                teste
            </label>
        </div>
        <?php
        if($_SESSION['UsuarioNivel'] == 2){ ?>
            <div class="sessao alterar-senha">
            <label>
            <a class="link-logout" href="Administrador.php">PAINEL DE ADMINISTRADOR</a>  
            </label>
        </div>
        <?php } ?>
        <div class="sessao fezer-logout">
            <label>
                Fazer Log Out:
                <a class="link-logout" href="../Config/LogOut.php">Deslogar</a>    
            </label>
        </div>
        
    </main> 
</body>
</html>