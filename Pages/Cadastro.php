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

            $msgUsuario = "Por Favor Insira um Usuário";

        }else{

            //Busca pelo Usuário no Banco de Dados
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

                $msgEmail = "Por Favor Insira um Email";

            } else {

                //Busca pelo Email no Banco de Dados
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
                        
                        echo "Erro ao Realizar o Cadastro";
        
                    } else {
        
                        header("Location: Login.php");
        
                        exit;
                    }
                }      
            }
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
    <title>Cadastro</title>
</head>
<body>
    <main class="conteudo-cadastro">
        <div class="container-form">
            <text class="titulo">CADASTRO</text>
            <form class="form-cadastro" action="Cadastro.php" method="post">
                <label class="inputs">
                    Nome Completo:
                    <input type="text" name="NomeCompleto" class="input" placeholder="Nome Completo" required>
                </label>
                <label class="inputs">
                    Email:
                    <input type="email" name="Email"class="input" placeholder="Email" required>
                </label>
                <label class="inputs">
                    Usuário:
                    <input type="text" name="Usuario" class="input" placeholder="Usuario" required>
                </label>    
                <label class="inputs">
                    Senha:
                    <input type="password" name="Senha" class="input" placeholder="Senha" required>
                </label>    
                <label class="inputs">
                    Verifique sua Senha:
                    <input type="password" name="VerificaSenha" class="input" placeholder="Repita a Senha" required>
                </label>
                <button type="submit" class="inputs btn-send">CADASTRAR</button>
                <text class="mgs-erros">
                    <b>
                        <?php echo $msgSenhasDiferentes ?>
                        <?php echo $msgEmail ?>
                        <?php echo $msgUsuario ?>
                    </b>
                </text>
            </form>
            <text class="text-possui">Já possui uma conta? <a href="Login.php">Fazer Login</a></text>
            <a href="Home.php">Navegar sem Cadastro</a>
        </div>
    </main>
</body>
</html>