<?php
    include "../Config/Config.php";

    $msgSenhasDiferentes = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if($_POST["Senha"] !== $_POST["VerificaSenha"]){
            $msgSenhasDiferentes = "As Senhas não são Iguais!";
        }else{
            $senhasIguais = $_POST['Senha'];
        }

        $nome = $_POST["NomeCompleto"];
        $email = $_POST["Email"];
        $usuario = $_POST["Usuario"];
        $senha = $senhasIguais;


        $sql = "INSERT INTO `usuarios` (`nome`, `usuario`, `email`, `senha`) VALUES (?, ?, ?, ?)";

        $stmt = $Conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $usuario, $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            echo "Erro ao Inserir Dados";
        }else{
            header("Location: Login.php");
            exit;
        }
    }

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
            <input type="text" name="NomeCompleto" class="input" placeholder="Nome Completo" required>
            <input type="email" name="Email"class="input" placeholder="Email" required>
            <input type="text" name="Usuario" class="input" placeholder="Usuario" required>
            <input type="password" name="Senha" class="input" placeholder="Senha" required>
            <input type="password" name="VerificaSenha" class="input" placeholder="Repita a Senha" required>
            <button type="submit" class="btn-send">CADASTRAR</button>
        </form>
            <text>Já possui uma conta? <a href="Login.php">Faça o Login</a></text>
    </main>
</body>
</html>