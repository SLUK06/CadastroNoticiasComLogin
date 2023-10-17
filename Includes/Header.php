<header>
    <div class="titulo-site">
        <text>NOTÍCIAS SLO CITY</text>
    </div>
    <nav class="links-header">
        <?php

            $paginaAtual = basename($_SERVER['SCRIPT_FILENAME']);

            $paginaNoticias = "Noticias.php";
            $paginaHome = "Home.php";
            $paginaConta = "Conta.php";

            if($paginaAtual !== $paginaHome){
                echo '<a href="Home.php">Home</a>';
            }

            if($paginaAtual !== $paginaNoticias){
                echo '<a href="Noticias.php">Notícias</a>';
            }
        ?>
        <?php 
        if(!isset($_SESSION['UsuarioID'])){ ?>
            <a href="Cadastro.php">Cadastrar</a>
            <a href="Login.php">Logar</a>

        <?php
        }else{ 
            if($paginaAtual !== $paginaConta){
                echo '<a href="Conta.php">Minha Conta</a>';
            }?>
            <a href="../Config/LogOut.php">Sair</a>
        <?php
        }?>
        
    </nav>
</header>