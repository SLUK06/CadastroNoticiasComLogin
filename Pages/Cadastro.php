<?php
    include "../Config/Config.php";

    $msgSenhasDiferentes = "";
    $msgEmail = "";
    $msgUsuario = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $nome = $_POST["NomeCompleto"];
        $email = $_POST["Email"];
        $usuario = $_POST["Usuario"];
        $senha = $_POST["Senha"];
        $verificaSenha = $_POST["VerificaSenha"];

        //Verifica se o Usuário Inseriu um usuario
        if($usuario == ""){

            die("Por Favor Insira um Usuário");

        }else{
            $sql = "SELECT `email` FROM `usuarios` WHERE `usuario` = ? ";
            $stmt = $Conn->prepare($sql);
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $resultUsuario = $stmt->get_result();

            //Verifica se o Usuário já Está Sendo Usado
            if($resultUsuario->num_rows == 1){
                    
                $msgUsuario = "Este Usuário já Foi Cadastrado!";

            }
            //Verifica se o Usuário Inseriu um Email
            elseif($email == ""){

                die("Por Favor Insira um Email");

            } else {

                $sql = "SELECT `email` FROM `usuarios` WHERE `email` = ? ";
                $stmt = $Conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $resultEmail = $stmt->get_result();

                //Verifica se o Email já Está Sendo Usado
                if($resultEmail->num_rows == 1){
                        
                    $msgEmail = "Este Email já Foi Cadastrado!";

                }
                //Verifica se as Senhas são Iguais 
                elseif($senha == ""){
        
                    $msgSenhasDiferentes = "Por Favor Insira uma Senha";
        
                } elseif ($senha !== $verificaSenha){
                    
                    $msgSenhasDiferentes = "As Senhas não Coincidem!";
        
                }
                
                elseif($senha === $verificaSenha){
        
                    //Se as Senhas Forem Iguais Insere Dados no Banco de Dados
                    $sql = "INSERT INTO `usuarios` (`nome`, `usuario`, `email`, `senha`) VALUES (?, ?, ?, ?)";
        
                    $stmt = $Conn->prepare($sql);
                    $stmt->bind_param("ssss", $nome, $usuario, $email, $senha);
                    $stmt->execute();
                    $result = $stmt->get_result();
        
                    //Verifica se a Inserção de Dados foi bem Sucedida
                    if($result->num_rows == 1){
                        
                        echo "Erro ao Inserir Dados";
        
                    } else {
        
                        header("Location: Login.php");
        
                        exit;
                    }
                }      
            }
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
        <form class="form-login" action="Cadastro.php" method="post">
            <input type="text" name="NomeCompleto" class="input" placeholder="Nome Completo" required>
            <input type="email" name="Email"class="input" placeholder="Email" required>
            <input type="text" name="Usuario" class="input" placeholder="Usuario" required>
            <input type="password" name="Senha" class="input" placeholder="Senha" required>
            <input type="password" name="VerificaSenha" class="input" placeholder="Repita a Senha" required>
            <button type="submit" class="btn-send">CADASTRAR</button>
            <?php echo $msgSenhasDiferentes ?>
            <?php echo $msgEmail ?>
            <?php echo $msgUsuario ?>
        </form>
            <text>Já possui uma conta? <a href="Login.php">Faça o Login</a></text>
    </main>
</body>
</html>