<?php
session_start();
if((isset($_SESSION['logado'])) && ($_SESSION['logado']==TRUE) &&
(isset($_SESSION['nome'])) && ($_SESSION['nome']!='') &&
(isset($_SESSION['codigo_usuario'])) && ($_SESSION['codigo_usuario']>0)){

    //Se receber o parâmetro "cod" na URL, realiza a exclusão
    if(isset($_REQUEST['cod'])){
        require "conecta.php"; //Importando o arquivo de conexão

        //Statement com a query de exclusão da tarefa
        $stmt=$conn->prepare("DELETE FROM tarefas WHERE codigo=:CODIGO AND codusuario=:CODD");
        $stmt->bindValue(':CODIGO',$_REQUEST['cod']);
        $stmt->bindValue(':CODD',$_SESSION['codigo_usuario']);
        $stmt->execute();
    }

    header("Location: tarefas.php"); //Redireciona para tarefas.php
} else {
    header("Location: logout.php");
    exit();
}
?>