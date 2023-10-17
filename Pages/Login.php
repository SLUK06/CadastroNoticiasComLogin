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
    <link rel="StyleSheet" type="text/css" href="../Styles/StylesForms.css">
    <title>Login</title>
</head>
<body>
    <main class="conteudo-login">
        <div class="container-form">
            <form class="form-login" method="post">
                <label>
                    Email ou Usuário:
                    <input type="text" name="Usuario" class="usuario" placeholder="Email ou Usuário" required>
                </label>
                <label>
                    Senha:
                    <input type="password" name="Senha" class="senha" placeholder="Senha" required>
                </label>
                    <button type="submit" class="btn-send">LOG IN</button>
                    <?php echo $loginInvalido ?>
            </form>
            <text>Não possui uma conta? <a href="Cadastro.php">Cadastre-se</a></text>
        </div>
    </main>
</body>
</html>