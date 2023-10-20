<?php
    include "../Config/Config.php";

    if(!isset($_SESSION)) session_start();

    if(!isset($_SESSION['UsuarioID'])){
        session_destroy();
        header("Location: Home.php");
        exit;
    }
    $erroAlterarSenha = "";
    $senhaAlterada = "";

    $idUsuario = $_SESSION['UsuarioID'];
    $nomeUsuario = $_SESSION['UsuarioNome'];
    $userUsuario = $_SESSION['UsuarioUser'];
    $emailUsuario = $_SESSION['UsuarioEmail'];
    $nivelUsuario = "";

    if($_SESSION['UsuarioNivel'] == 1){
        $nivelUsuario = "COMUM";
    }elseif($_SESSION['UsuarioNivel'] == 2){
        $nivelUsuario = "ADMINISTRADOR";
    }

    if($_GET['mudarSenha'] == "on"){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $senhaAntiga = $_POST['SenhaAtual'];
            $senhaNova = $_POST['NovaSenha'];
            $verificaSenha = $_POST['VerificaNovaSenha'];

            if($senhaNova == $verificaSenha){

                $sql = "SELECT `id`, `usuario`, `senha` FROM `usuarios` WHERE `id` = ? AND `usuario`= ? AND `email` = ?";
                $stmt = $Conn->prepare($sql);
                $stmt->bind_param("iss", $idUsuario, $userUsuario, $emailUsuario);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows == 1){

                    $resultado = $result->fetch_assoc();

                    $senhaCrypt = password_hash($senhaNova, PASSWORD_DEFAULT);

                    if(password_verify($senhaAntiga, $resultado['senha'])){
                        $sql ="UPDATE `usuarios` SET `senha` = ? WHERE `id` = ? AND `usuario`= ? AND `email` = ?";
                        $stmt = $Conn->prepare($sql);
                        $stmt->bind_param("siss", $senhaCrypt, $idUsuario, $userUsuario, $emailUsuario);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if($stmt->affected_rows === 1){
                            header("Location: Conta.php?aba=dadosConta&mudarSenha=off");
                            $senhaAlterada = "Senha Alterada Com Sucesso!";
                        } else {
                            $erroAlterarSenha = "Erro ao Alterar Senhas!";
                        }
                    }else {
                        $erroAlterarSenha = "Não foi possivel alterar a senha!";
                    }
                } else {
                    $erroAlterarSenha = "Não foi possivel alterar a senha!";
                }
            } else {
                $erroAlterarSenha = "As senhas Não Coincidem!";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="StyleSheet" type="text/css" href="../Styles/Styles.css">
    <link rel="StyleSheet" type="text/css" href="../Styles/StylesConta.css">
    <title>Minha Conta</title>
</head>
<body>
    <?php include "../Includes/Header.php" ?> 
    <main>
        <div class="links-minha-conta">
            <a class="link-conta" href="Conta.php?aba=dadosConta&mudarSenha=off">MEUS DADOS</a>
            <a class="link-conta" href="Conta.php?aba=minhasPublicacoes">MINHAS PUBLICAÇÕES</a>
        </div>

        <?php if($_GET['aba'] == 'dadosConta'){ ?>
            <section class="info-conta">
                <div class="titulo-conta">
                    <text>MINHA CONTA</text>
                </div>
                <div class="sessao meu-nome">
                    <label>
                        Nome:
                        <text><b><?php echo $nomeUsuario ?></b></text>
                    </label>
                </div>

                <div class="sessao meu-usuario">
                    <label>
                        Usuario:
                        <text><b><?php echo $userUsuario ?></b></text>
                    </label>
                </div>

                <div class="sessao meu-id">
                    <label>
                        Id:
                        <text><b><?php echo "#".$idUsuario."#" ?></b></text>
                    </label>
                </div>

                <div class="sessao meu-email">
                    <label>
                        Email:
                        <text><b><?php echo $emailUsuario ?></b></text>
                    </label>
                </div>

                <div class="sessao meu-nivel">
                    <label>
                        Nível de Usuario:
                        <text><b><?php echo $nivelUsuario ?></b></text>
                    </label>
                </div>

                <div class="sessao alterar-senha">
                    <label class="mudar-senha">
                        <?php if($_GET['mudarSenha'] == "off"){ ?>
                            <a class="link-admin" href="?aba=dadosConta&mudarSenha=on" >MUDAR SENHA</a>
                            <?php echo $senhaAlterada ?>
                            <?php }elseif($_GET['mudarSenha'] == "on"){ ?>
                                <a class="link-admin" href="?aba=dadosConta&mudarSenha=off" >FECHAR</a>

                                <form class="form-mudar-senha" action="Conta.php?aba=dadosConta&mudarSenha=on" method="POST">
                                    <label class="inputs">
                                        Senha Atual:
                                        <input type="password" name="SenhaAtual" class="input-mudar-senha" placeholder="Senha Atual" required>
                                    </label>
                                    <label class="inputs">
                                        Nova Senha:
                                        <input type="password" name="NovaSenha" class="input-mudar-senha" placeholder="Nova Senha" required>
                                    </label>
                                    <label class="inputs">
                                        Repita a Nova Senha:
                                        <input type="password" name="VerificaNovaSenha" class="input-mudar-senha" placeholder="Repita a Nova Senha" required>
                                    </label>
                                    <button type="submit" class=" btn-send">MUDAR SENHA</button>
                                    <?php echo $erroAlterarSenha ?>
                                </form>
                            <?php } ?>
                    </label>
                </div>
                <?php
                if($_SESSION['UsuarioNivel'] == 2){ ?>
                    <div class="sessao painel-admin">
                    <label>
                        <a class="link-admin" href="Administrador.php">PAINEL DE ADMINISTRADOR</a>  
                    </label>
                </div>
                <?php } ?>
                <div class="sessao fezer-logout">
                    <label>
                        <a class="link-logout" href="../Config/LogOut.php">SAIR</a>    
                    </label>
                </div>
            </section>
        <?php } ?>

        <?php if($_GET['aba'] == 'minhasPublicacoes'){
            $_SESSION['sql'] = "SELECT * FROM `postagens` WHERE `idUsuario` = $idUsuario ORDER BY `id` DESC";
            include "../Config/BuscaPublicacoes.php";
            
        ?>

            <section class="Conteudo">
                <div class="titulo-conta">
                    <text>MINHAS PUBLICAÇÕES</text>
                </div>
                <div class="Todas-Publicacoes">
                    <?php for($i = 0; $i < count($nomeBp); $i ++){ ?>
                        <div class="publicacoes">
                        <div class="nome">
                            <b><?php echo $nomeBp[$i] ?></b> publicou:
                        </div>
                        <div class="titulo">
                            <?php echo $tituloBp[$i] ?>
                        </div>
                        <div class="conteudo">
                            <?php echo $conteudoBp[$i] ?>
                        </div>
                        <?php
                            if($_SESSION['UsuarioID'] == $idUsrPublicBp[$i]){ ?>
                                <div class="botoes-acao">
                                    <button class="btn-excluir" onclick="window.location.href='../Config/ExcluirPublicacao.php?id=<?php echo $idPublicBp[$i]?>'">EXCLUIR</button>      
                                </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </section>
        <?php } ?>
    </main> 
</body>
</html>