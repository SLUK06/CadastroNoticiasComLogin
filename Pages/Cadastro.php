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

                //Se as Senhas Forem Iguais Insere Dados no Banco de Dados
                elseif($senha === $verificaSenha){
                    //Encripta a Senha Antes de Armazenar no Banco de Dados 
                    $senhaCrypt = password_hash($senha, PASSWORD_DEFAULT);
        
                    $sql = "INSERT INTO `usuarios` (`nome`, `usuario`, `email`, `senha`) VALUES (?, ?, ?, ?)";
        
                    $stmt = $Conn->prepare($sql);
                    $stmt->bind_param("ssss", $nome, $usuario, $email, $senhaCrypt);
                    $stmt->execute();
                    $result = $stmt->get_result();
        
                    //Verifica se a Inserção de Dados foi bem Sucedida
                    if($stmt->affected_rows === 1){
                        header("Location: Login.php");
                        exit;
                    } else {
                        
                        echo "Erro ao Realizar o Cadastro";
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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="../Config/Ajax/Ajax.js"></script>
    <script src="../Config/jQuery/jquery.validate.min.js"></script>
    
    <title>Cadastro</title>
    <script>
        $(function(){
            $("#form-cadastro").validate({
                rules : {
                    NomeCompleto : {
                        required : true
                    },
                    Email : {
                        required :  true,
                    },
                    Usuario : {
                        required : true,
                        minlength : 8
                    },
                    Senha : {
                        required : true,
                        minlength : 8
                    },
                    VerificaSenha : {
                        required : true,
                        equalTo : "#Senha"
                    }
                },
                messages : {
                    NomeCompleto : {
                        required : "<font color='red'>Por favor insira seu nome.</font>"
                    },
                    Email : {
                        required : "<font color='red'>Por favor insira seu email.</font>",
                        email : "<font color='red'>Por favor insira um email válido.</font>"
                    },
                    Usuario : {
                        required : "<font color='red'>Por favor insira um usuário.</font>",
                        minlength : "<font color='red'>O Usuário deve conter no mínimo 8 caracteres.</font>"
                    },
                    Senha : {
                        required : "<font color='red'>Por favor insira uma senha.</font>",
                        minlength : "<font color='red'>A senha deve conter no mínimo 8 caracteres.</font>"
                    },
                    VerificaSenha : {
                        required : "<font color='red'>Por favor insira novamente a senha.</font>",
                        equalTo : "<font color='red'>As senhas não coincidem.</font>"
                    }
                }
            });
        });
        
    </script>
</head>
<body>
    <main class="conteudo-cadastro">
        <div class="container-form">
            <text class="titulo">CADASTRO</text>
            <form class="form-cadastro" id="form-cadastro" action="Cadastro.php" method="post">
                <label class="inputs">
                    Nome Completo:
                    <input type="text" name="NomeCompleto" id="NomeCompleto" class="input" placeholder="Nome Completo" required>
                </label>
                <label class="inputs">
                    Email:
                    <input type="email" name="Email" id="Email" class="input" placeholder="Email" required>
                </label>
                <label id="ResultadoEmail"></label>
                <label class="inputs">
                    Usuário:
                    <input type="text" name="Usuario" id="Usuario" class="input" placeholder="Usuario" required>
                </label>
                <span id="ResultadoUsuario"></span>
                <label class="inputs">
                    Senha:
                    <input type="password" name="Senha" id="Senha" class="input" placeholder="Senha" minlength="8" required>
                </label>    
                <label class="inputs">
                    Verifique sua Senha:
                    <input type="password" name="VerificaSenha" id="VerificaSenha" class="input" placeholder="Repita a Senha" >
                </label>
                <button type="submit" id="Submit" class="inputs btn-send">CADASTRAR</button>
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
<script src="../Config/js/Validacao.js"></script>
</html>