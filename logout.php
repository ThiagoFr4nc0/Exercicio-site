<?php
session_start();
$_SESSION['logado']=false;
$_SESSION['nome']='';
$_SESSION['codigo_usuario']='';
$_SESSION['erro_verificacao']='';
$_SESSION['id']='';
session_destroy();

header("Location: index.php");
?>