<?php
    include("../Config/Config.php");
    if(!isset($_SESSION)) session_start();

    $msgErro = "";
    $msgSucessoErro = "";
    $msgSemPublicacao = "";


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!isset($_SESSION['UsuarioID'])){
            $msgErro = "Para Fazer uma Publicação Você Prescisa Estar Logado! <a href='Login.php'>Fazer Login</a>";
        }elseif((empty($_POST['Titulo'])) || (empty($_POST['Conteudo']))){
            $msgErro = "Por Favor Insira um Título e um Conteudo!";
        } else{
            $titulo = $_POST['Titulo'];
            $conteudo = $_POST['Conteudo'];
            $idUsuario = $_SESSION['UsuarioID'];
            $nomeUsuario = $_SESSION['UsuarioNome'];

            $sql = "INSERT INTO `postagens` (`idUsuario`, `nome`, `titulo`, `conteudo`) VALUES (?, ?, ?, ?)";

            $stmt = $Conn->prepare($sql);
            $stmt->bind_param("isss", $idUsuario, $nomeUsuario, $titulo, $conteudo);
            $stmt->execute();
            $resultConn = $stmt->get_result();

            if ($resultConn !== TRUE) {
                header("Location: " . $_SERVER['PHP_SELF']);
                $msgSucessoErro =  "Notícia publicada com SUCESSO!</br>";
        
                exit;
            } else {
                $msgSucessoErro = "ERRO ao publicar a notícia " . $Conn->error . "</br>";
            }
        }
    }
    include "../Config/BuscaPublicacoes.php";
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
    <title>Publicações</title>
</head>
<body>
    <?php include "../Includes/Header.php" ?>
    <main>
        <div class="form-post">
            <form action="Noticias.php" method="POST">
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
        <div class="titulo-noticias">
            <text>TODAS AS PUBLICAÇÕES</text>
        </div>
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
                </div>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>