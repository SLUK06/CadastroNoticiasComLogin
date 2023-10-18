<?php
    include "../Config/Config.php";

    $loginInvalido = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = $_POST["Usuario"];
        $senha = $_POST["Senha"];

        $sql = "SELECT `id`, `nome`, `nivel`, `usuario`, `email` FROM  `usuarios` WHERE (BINARY `usuario` = ? OR BINARY `email` = ?) AND BINARY `senha` = ? AND `ativo` = 1 LIMIT 1";
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
            $_SESSION['UsuarioUser'] = $resultado['usuario'];
            $_SESSION['UsuarioEmail'] = $resultado['email'];
            $_SESSION['UsuarioNivel'] = $resultado['nivel'];

            header("Location: Conta.php?aba=minhasPublicacoes");
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500;600&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="StyleSheet" type="text/css" href="../Styles/StylesForms.css">
    <title>Login</title>
</head>
<body>
    <main class="conteudo-login">
        <div class="container-form">
        <text class="titulo">LOGIN</text>
            <form class="form-login" action="Login.php" method="post">
                <label class="inputs">
                    Email ou Usuário:
                    <input type="text" name="Usuario" class="usuario" placeholder="Email ou Usuário" required>
                </label>
                <label class="inputs">
                    Senha:
                    <input type="password" name="Senha" class="senha" placeholder="Senha" required>
                </label>
                    <button type="submit" class="inputs btn-send">LOG IN</button>
                    <?php echo $loginInvalido ?>
            </form>
            <text class="text-possui">Não possui uma conta? <a href="Cadastro.php">Cadastre-se</a></text>
        </div>
    </main>
</body>
</html>