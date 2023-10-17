<?php
include "Config.php";

    $sql = "SELECT * FROM `postagens` ORDER BY `id` DESC";
    $resultPosts = $Conn->query($sql);

    $nome = array();
    $titulo = array();
    $conteudo = array();
    $data = array();

    if($resultPosts->num_rows > 0){
        while($row = $resultPosts->fetch_assoc()){
            $nome[] = $row['nome'];
            $titulo[] = $row['titulo'];
            $conteudo[] = $row['conteudo'];
            $data[] = $row['data'];
        }
    } else {
        $msgSemPublicacao = "Nehuma Publicação Foi Encontrada!";
    }