<?php


function RedirLogin(){
    if(!isset($_SESSION["UsuarioID"])){
        header("Location: ../Pages/Login.php");
    }
}

function EstaLogado($link){
    if(!isset($_SESSION['UsuarioID'])){
        header("Location: ../Login.php");
        exit;
    }else{
        $link = "";
        echo $link;
    }
}

function ExcluirPublicacao($idPublicBp){
    include "Config.php";

    $sql = "DELETE FROM `postagens` WHERE `id` = ?";
    $stmt = $Conn->prepare($sql);
    $stmt->bind_param("i", $idPublicBp[$i]);
    $stmt->execute();
    $resultExc = $stmt->get_result();
}