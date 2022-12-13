<?php
session_start();
if((isset($_SESSION['logado'])) && ($_SESSION['logado']==TRUE) &&
(isset($_SESSION['nome'])) && ($_SESSION['nome']!='') &&
(isset($_SESSION['codigo_usuario'])) && ($_SESSION['codigo_usuario']>0)){

    //Se recebeu os parâmetros "descrição" e "tipo" pelo formulário, executa as ações
    if((isset($_POST['descricao'])) && (isset($_POST['tipo']))){
        require "conecta.php";//Importando o arquivo de conexão

        if($_POST['tipo']=="edicao"){
            //Tipo da ação é inserção
            $stmt=$conn->prepare("UPDATE tarefas SET descricao=:DESCRICAO, data_hora=:DTHORA WHERE codigo=:CODIGO AND codusuario=:CODD;");
            $stmt->bindValue(':DESCRICAO',$_POST['descricao']);
            $stmt->bindValue(':DTHORA',date('Y-m-d H:i:s')); //Atualizamos data e hora
            $stmt->bindValue(':CODIGO',$_POST['codigo']);
        } else {
            //Tipo da ação é inserção
            $stmt=$conn->prepare("INSERT INTO tarefas (descricao,data_hora,codusuario) VALUES (:DESCRICAO, :DTHORA, :CODD);");
            $stmt->bindValue(':DESCRICAO',$_POST['descricao']);
            $stmt->bindValue(':DTHORA',date('Y-m-d H:i:s'));        
        }
        $stmt->bindValue(':CODD',$_SESSION['codigo_usuario']);
        $stmt->execute(); //Executa o statement
        header("Location: tarefas.php"); //Redireciona para tarefas.php
    }
} else {
    header("Location: logout.php");
    exit();
}
?>