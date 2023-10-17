<?php
    include("../Config/Config.php");
    include "../Config/BuscaPublicacoes.php";
    if(!isset($_SESSION)) session_start();

    $msgErro = "";
    $msgSucessoErro = "";
    $msgSemPublicacao = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!isset($_SESSION['UsuarioID'])){
            $msgErro = "Para Publicar uma Notícia Você Prescisa estar logado! <a href='Login.php'>Fazer Login</a>";
        }else{
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
    <title>Notícias</title>
</head>
<body>
    <?php include "../Includes/Header.php" ?> 
    <form action="Noticias.php" method="POST">
        <input type="text" name="Titulo" placeholder="Titulo">
        <input type="text" name="Conteudo" placeholder="Conteudo">
        <button type="submit">PUBLICAR</button>
        <?php echo $msgErro ?>
    </form>
    <?php for($i = 0; $i < count($nome); $i ++){ ?>
        <div class="Publicacoes">
            <div class="nome">
                <b><?php echo $nome[$i] ?></b> publicou:
            </div>
            <div class="titulo">
                <?php echo $titulo[$i] ?>
            </div>
            <div class="conteudo">
                <?php echo $conteudo[$i] ?>
            </div>
        </div>
    <?php } ?>
</body>
</html>