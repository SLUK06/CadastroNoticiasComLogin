<?php
if(!isset($_SESSION)) session_start();
include "../Config/Config.php";
include "../Config/Functions.php";
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
    <title>Home</title>
</head>
<body>
    <?php include "../Includes/Header.php" ?> 

    <main>
        <div class="titulo-noticias">
            <text>ÚLTIMAS PUBLICAÇÕES</text>
        </div>
    
        <section class="Conteudo">
            <div class="Ultimas-Publicacoes">
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