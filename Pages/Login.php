<?php
    include "../Config/Config.php";

    $loginInvalido = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = $_POST["Usuario"];
        $senha = $_POST["Senha"];

        $sql = "SELECT `id`, `nome`, `nivel` FROM  `usuarios` WHERE `usuario` = ? OR `email` = ? AND `senha` = ? AND `ativo` = 1 LIMIT 1";
        $stmt = $Conn->prepare($sql);
        $stmt->bind_param("sss", $usuario, $usuario, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows !== 1){
            $loginInvalido = "Usuário ou Senha Estão Incorretos!";
        }else{
            $resultado = $result->fetch_assoc();

            if(!isset($_SESSION)) session_start();

            $_SESSION['UsuarioID'] = $resultado['id'];
            $_SESSION['UsuarioNome'] = $resultado['nome'];
            $_SESSION['UsuarioNivel'] = $resultado['nivel'];

            header("Location: Conta.php");
            exit;
        }
    }
    $Conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <main class="conteudo-login">
        <form class="form-login" method="post">
            <input type="text" name="Usuario" class="usuario"required>
            <input type="password" name="Senha" class="senha" required>
            <button type="submit" class="btn-send">LOG IN</button>
            <?php echo $loginInvalido ?>
        </form>
            <text>Não possui uma conta? <a href="Cadastro.php">Cadastre-se</a></text>
    </main>
</body>
</html>