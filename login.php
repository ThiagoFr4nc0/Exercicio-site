<?php
session_start();
if((isset($_POST['usuario'])) && (isset($_POST['senha']))){
    require "conecta.php";
    $stmt=$conn->prepare("SELECT * from usuarios WHERE usuario=:USER 
    AND senha=:PASS AND verificado=1;");
    $stmt->bindValue(':USER',$_POST['usuario']);
    $stmt->bindValue(':PASS',sha1($_POST['senha']));
    $stmt->execute();
    if($stmt->rowCount()>0){
        while($line = $stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['logado']=true;
            $_SESSION['nome']=$line['nome'];
            $_SESSION['codigo_usuario']=$line['codigo'];
            header("Location: tarefas.php");
        }
    } else {
       echo 'Usuário ou senha inválido.'; 
    }

} else {
    header("Location: logout.php");
}
?>