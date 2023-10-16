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