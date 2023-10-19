<header>
    <div class="titulo-site">
        <h1>PUBLICA SLO</h1>
    </div>
    <nav class="links-header">
        <?php

            // Verifica o Nome da Página Atual
            $paginaAtual = basename($_SERVER['SCRIPT_FILENAME']);

            // Nome das Páginas
            $paginaPublicacoes = "Publicacoes.php";
            $paginaHome = "Home.php";
            $paginaConta = "Conta.php";

            // Página Atual Diferente de Home Exibe o Link pra Home
            if($paginaAtual !== $paginaHome){
                echo '<a class="link-pages" href="Home.php">Home</a>';
            }

            // Página Atual Diferente de Publicações Exibe o Link pra Publicações
            if($paginaAtual !== $paginaPublicacoes){
                echo '<a class="link-pages" href="Publicacoes.php">Publicações</a>';
            }
         
            // Caso o UsuarioID não Esteja Setado Exibe os Links Para Login e Cadastro
            if(!isset($_SESSION['UsuarioID'])){ ?>
                <a class="link-pages" href="Cadastro.php">Cadastrar</a>
                <a class="link-pages" href="Login.php">Logar</a>

            <?php }
            // Caso o UsuarioID Esteja Setado 
            else{ 
                // Página Atual Diferente de Conta Exibe o Link pra Conta
                if($paginaAtual !== $paginaConta){
                    echo '<a class="link-pages" href="Conta.php?aba=minhasPublicacoes">Minha Conta</a>';
                }
            
        } ?>
        
    </nav>
</header>