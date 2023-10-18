<?php
include "../Config/Config.php";
if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['UsuarioID'])){
    header("Loaction: Home.php");
    exit;
}

if($_SESSION['UsuarioNivel'] !== 2){
    header("Loaction: Home.php");
    exit;
}