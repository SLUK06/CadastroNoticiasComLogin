<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "noticias_com_login";

    $Conn = new mysqli($serverName, $userName, $password, $dbName);

    if($Conn->connect_error){
        die("Erro na conexão com o banco de dados" .$Conn->connect_error);
    }