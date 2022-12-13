<?php
session_start();
if( (isset($_SESSION['logado'])) && ($_SESSION['logado']==TRUE) ){
    header("Location: tarefas.php");
    exit();
} else {
    if(isset($_POST['verificador'])){
        if($_POST['verificador']==$_SESSION['verificador']){
            require "conecta.php";
            $stmt=$conn->prepare("UPDATE usuarios SET
            verificado=:VERIF WHERE codigo=:CODD;");
            $stmt->bindValue(':VERIF',1);
            $stmt->bindValue(':CODD',$_SESSION['id']);
            $stmt->execute();
            echo 'Usuário verificado. <a href="index.php">
            Fazer Login</a>';
        } else {
            $_SESSION['erro_verificacao']="1";
            header("Location: cria_usuario2.php");
        }
        
    }
}
?>