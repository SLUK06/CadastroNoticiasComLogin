<header>
    <div class="titulo-site">
        <text>NOTÍCIAS.COM</text>
    </div>
    <div class="menu-header">
        <a href="Noticias.php">Notícias</a>
        <?php 
        if(!isset($_SESSION['UsuarioID'])){ ?>
            <a href="Cadastro.php">Cadastrar</a>
            <a href="Login.php">Logar</a>
        <?php
        }else{ ?>
            <a href="Conta.php">Minha Conta</a>
            <a href="../Config/LogOut.php">Sair</a>
        <?php
        }?>
    </div>
</header>