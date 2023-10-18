<?php
include "Config.php";

    $sql = "SELECT * FROM `postagens` ORDER BY `id` DESC";
    $resultPosts = $Conn->query($sql);

    $nomeBp = array();
    $tituloBp = array();
    $conteudoBp = array();
    $dataBp = array();

    if($resultPosts->num_rows > 0){
        while($row = $resultPosts->fetch_assoc()){
            $nomeBp[] = $row['nome'];
            $tituloBp[] = $row['titulo'];
            $conteudoBp[] = $row['conteudo'];
            $dataBp[] = $row['data'];
        }
    } else {
        $msgSemPublicacao = "Nehuma Publicação Foi Encontrada!";
    }