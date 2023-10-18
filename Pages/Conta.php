<?php
include "../Config/Config.php";



if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['UsuarioID'])){
    session_destroy();
    header("Location: Home.php");
    exit;
}
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
        <div class="links-minha-conta">
            <a class="link-conta" href="Conta.php?aba=dadosConta">MEUS DADOS</a>
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
                        <text><b><?php echo "#".$idUsuario ?></b></text>
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
                    <label>
                        Em Desenvolvimento
                    </label>
                </div>
                <?php
                if($_SESSION['UsuarioNivel'] == 2){ ?>
                    <div class="sessao alterar-senha">
                    <label>
                    <a class="link-admin" href="Administrador.php">PAINEL DE ADMINISTRADOR</a>  
                    </label>
                </div>
                <?php } ?>
                <div class="sessao fezer-logout">
                    <label>
                        <a class="link-logout" href="../Config/LogOut.php">DESLOGAR</a>    
                    </label>
                </div>
            </section>
        <?php } ?>

        <?php if($_GET['aba'] == 'minhasPublicacoes'){
            $_SESSION['sql'] = "SELECT * FROM `postagens` WHERE `idUsuario` = $idUsuario ORDER BY `id` DESC";
            include "../Config/BuscaPublicacoes.php";
            
        ?>

            <section class="Conteudo">
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