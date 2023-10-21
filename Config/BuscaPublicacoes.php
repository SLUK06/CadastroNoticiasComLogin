<?php
if(!isset($_SESSION)) session_start();
include "Config.php";

    $nomeBp = array();
    $tituloBp = array();
    $conteudoBp = array();
    $dataBp = array();
    $idPublicBp = array();
    $idUsrPublicBp = array();

    $nenhumaPublicacao = "";

    $sql = $_SESSION['sql'];
    $resultPosts = $Conn->query($sql);

    if (!$resultPosts) {
        die( "Erro: " . $Conn->error);
    }

    if($resultPosts->num_rows > 0){
        while($row = $resultPosts->fetch_assoc()){
            $nomeBp[] = $row['nome'];
            $tituloBp[] = $row['titulo'];
            $conteudoBp[] = $row['conteudo'];
            $dataBp[] = $row['data'];
            $idPublicBp[] = $row['id'];
            $idUsrPublicBp[] = $row['idUsuario'];
        }
    } else {
        $nenhumaPublicacao = "Nehuma Publicação Foi Encontrada!";
    }
