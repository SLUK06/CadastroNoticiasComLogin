<?php
if(!isset($_SESSION)) session_start();
include "../Config/Config.php";
include "../Config/Functions.php";
include "../Config/BuscaPublicacoes.php";
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
    <title>Home</title>
</head>
<body>
    <?php include "../Includes/Header.php" ?> 
    <main>
        <div class="titulo-home">
            <text>ÚLTIMAS PUBLICAÇÕES</text>
        </div>
        <div class="ultimas-publicacoes">
            <?php for($i = 0; $i < count($nome); $i ++){ ?>
                <div class="Publicacoes">
                    <div class="nome">
                        <?php echo $nome[$i] ?>
                    </div>
                    <div class="titulo">
                        <?php echo $titulo[$i] ?>
                    </div>
                    <div class="conteudo">
                        <?php echo $conteudo[$i] ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
</body>
</html>