<header>
    <div class="titulo-site">
        <text>PUBLICA SLO CITY</text>
    </div>
    <nav class="links-header">
        <?php

            $paginaAtual = basename($_SERVER['SCRIPT_FILENAME']);

            $paginaNoticias = "Noticias.php";
            $paginaHome = "Home.php";
            $paginaConta = "Conta.php";

            if($paginaAtual !== $paginaHome){
                echo '<a class="link-pages" href="Home.php">Home</a>';
            }

            if($paginaAtual !== $paginaNoticias){
                echo '<a class="link-pages" href="Noticias.php">Notícias</a>';
            }
        ?>
        <?php 
        if(!isset($_SESSION['UsuarioID'])){ ?>
            <a class="link-pages" href="Cadastro.php">Cadastrar</a>
            <a class="link-pages" href="Login.php">Logar</a>

        <?php
        }else{ 
            if($paginaAtual !== $paginaConta){
                echo '<a class="link-pages" href="Conta.php">Minha Conta</a>';
            }?>
            
        <?php
        }?>
        
    </nav>
</header>