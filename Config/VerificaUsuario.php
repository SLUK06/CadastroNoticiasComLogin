<?php
require_once "Config.php";

if(isset($_POST['usuario'])){
    $usuario = $_POST['usuario'];

    $stmt = $Conn->prepare("SELECT `usuario` FROM `usuarios` WHERE `usuario` = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows){
        echo "<font color='red'>Este usuário já está sendo usado!</font>";
    } else {
        echo "<font color='green'>Usuário disponível</font>";
    }
}