<?php
    include("../Config/Config.php");
    include("../Config/Functions.php");

    // Verifica se Existe uma Sessão, se não Existir Cria uma
    if(!isset($_SESSION)) session_start();

    // Verifica se Existe um Usuario, se não Existir Seta o UsuarioID como null
    if(!isset($_SESSION['UsuarioID'])){
        $_SESSION['UsuarioID'] = null;
    }

    $msgErro = "";
    $msgSucessoErro = "";
    $msgSemPublicacao = "";

    // Verifica se o Metodo de Request é POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Verifica se o Usuário Está Logado
        if(!isset($_SESSION['UsuarioID'])){

            $msgErro = "Para Fazer uma Publicação Você Prescisa Estar Logado! <a href='Login.php'>Fazer Login</a>";

        }
        // Verifica se os Inputs Foram Preenchidos
        elseif((empty($_POST['Titulo'])) || (empty($_POST['Conteudo']))){

            $msgErro = "Por Favor Insira um Título e um Conteudo!";

        } 
        // Faz o Insert no Banco de Dados
        else {

            $titulo = $_POST['Titulo'];
            $conteudo = $_POST['Conteudo'];
            $idUsuario = $_SESSION['UsuarioID'];
            $nomeUsuario = $_SESSION['UsuarioNome'];

            $sql = "INSERT INTO `postagens` (`idUsuario`,`nivelUsuario` `nome`, `titulo`, `conteudo`) VALUES (?, ?, ?, ?)";

            $stmt = $Conn->prepare($sql);
            $stmt->bind_param("isss", $idUsuario, $nomeUsuario, $titulo, $conteudo);
            $stmt->execute();
            $resultConn = $stmt->get_result();

            // Verifica se o Insert foi Realizado
            if ($resultConn !== TRUE) {
                header("Location: " . $_SERVER['PHP_SELF']);
                
                $msgSucessoErro = "Post publicado com SUCESSO!</br>";
        
                exit;
            } else {
                $msgSucessoErro = "ERRO ao publicar o Post" . $Conn->error . "</br>";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="StyleSheet" type="text/css" href="../Styles/Styles.css">
    <title>Publicações</title>
</head>
<body>
    <?php include "../Includes/Header.php" ?>
    <main>
        <?php
            if($_SESSION['UsuarioID'] !== null){ ?>
                <details>
                    <summary class="link-pages btn-post-open">
                        CRIAR POST
                    </summary>
                    <div class="form-post">
                        <form action="Publicacoes.php" method="POST">
                            <label>
                                <b>Título:</b>
                                <input type="text" name="Titulo" placeholder="Titulo" required>
                            </label>
                            <label>
                                <b>Conteúdo:</b>
                                    <textarea type="textarea" name="Conteudo" placeholder="Conteudo" style="resize: vertical; overflow: auto;" required></textarea>
                            </label>
                            <button type="submit">PUBLICAR</button>
                        </form>
                        <?php echo $msgErro ?>
                        <?php echo $msgSucessoErro ?>
                    </div>
                </details>
            <?php } else { ?>
                
            <?php } ?>
        <form class="form-busca-bublicacao">
            <div class="busca-publicacao">
                <input type="text" class="input-busca" placeholder="Pesquisar...">
                <svg aria-hidden="true" class="icone-busca" width="18" height="18" viewBox="0 0 18 18"><path d="m18 16.5-5.14-5.18h-.35a7 7 0 1 0-1.19 1.19v.35L16.5 18l1.5-1.5ZM12 7A5 5 0 1 1 2 7a5 5 0 0 1 10 0Z"></path></svg>
            </div>
        </form>        
        <div class="titulo-noticias">
            <text>TODAS AS PUBLICAÇÕES</text>
        </div>
        <section class="Conteudo">
            <?php 
                $_SESSION['sql'] = "SELECT * FROM `postagens` ORDER BY `id` DESC";
                include "../Config/BuscaPublicacoes.php";
            ?>
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
                        if($_SESSION['UsuarioID'] == $idUsrPublicBp[$i] || $_SESSION['UsuarioNivel'] == 2){ ?>
                            <div class="botoes-acao">
                                <button class="btn-excluir" onclick="window.location.href='../Config/ExcluirPublicacao.php?id=<?php echo $idPublicBp[$i]?>'">EXCLUIR</button>      
                            </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>