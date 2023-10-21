<?php
require_once "Config.php";

if(isset($_POST['email'])){
    $email = $_POST['email'];

    $stmt = $Conn->prepare("SELECT `email` FROM `usuarios` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows){
        echo "<font color='red'>Este email já está sendo usado!</font>";
    } else {
        echo "<font color='green'>Email disponível</font>";
    }
}

