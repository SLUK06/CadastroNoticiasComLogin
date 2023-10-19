<header>
    <div class="titulo-site">
        <h1>PUBLICA SLO</h1>
    </div>
    <nav class="links-header">
        <?php

            $paginaAtual = basename($_SERVER['SCRIPT_FILENAME']);

            $paginaPublicacoes = "Publicacoes.php";
            $paginaHome = "Home.php";
            $paginaConta = "Conta.php";

            if($paginaAtual !== $paginaHome){
                echo '<a class="link-pages" href="Home.php">Home</a>';
            }

            if($paginaAtual !== $paginaPublicacoes){
                echo '<a class="link-pages" href="Publicacoes.php">Publicações</a>';
            }
        ?>
        <?php 
        if(!isset($_SESSION['UsuarioID'])){ ?>
            <a class="link-pages" href="Cadastro.php">Cadastrar</a>
            <a class="link-pages" href="Login.php">Logar</a>

        <?php
        }else{ 
            if($paginaAtual !== $paginaConta){
                echo '<a class="link-pages" href="Conta.php?aba=minhasPublicacoes">Minha Conta</a>';
            }?>
            
        <?php
        }?>
        
    </nav>
</header>