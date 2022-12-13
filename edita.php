<?php
session_start();
if((isset($_SESSION['logado'])) && ($_SESSION['logado']==TRUE) &&
(isset($_SESSION['nome'])) && ($_SESSION['nome']!='') &&
(isset($_SESSION['codigo_usuario'])) && ($_SESSION['codigo_usuario']>0)){

    //Se receber o parâmetro "cod" na URL, significa que será uma edição
    if(isset($_REQUEST['cod'])){   
        $desc = "Editando tarefa - N°".$_REQUEST['cod'];
        $tipo="edicao"; //Tipo da ação é edição
        require "conecta.php"; //Importando o arquivo de conexão

        //Statement com a query de seleção da tarefa a ser editada
        $stmt=$conn->prepare("SELECT descricao FROM tarefas WHERE codigo=:CODIGO AND codusuario=:CODD");
        $stmt->bindValue(':CODIGO',$_REQUEST['cod']);
        $stmt->bindValue(':CODD',$_SESSION['codigo_usuario']);
        $stmt->execute();

        if($stmt->rowCount()==0){
            echo "Não foi encontrada a tarefa especificada. Tente novamente";
            exit();
        } else {
            while($line=$stmt->fetch(PDO::FETCH_ASSOC)){
                //Carrega a informação para a variável
                $descricao = $line['descricao'];
            }
        }        
    } else {
        $desc = "Nova tarefa";
        $tipo="novo";  //Tipo da ação é inserção
        $descricao = " ";
    }
} else {
    header("Location: logout.php");
    exit();
}

$titulo_pagina = "Minhas Tarefas";
require "cabecalho.php";
?>

<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <h4 class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          Minhas Tarefas
        </h4>

        <div class="text-end">
          <a class="btn btn-danger btn-sm me-2" href="logout.php">Sair</a>
        </div>
      </div>
    </div>
</header>
<div class="container-sm">
    <br />
    <h3><?php echo $desc; ?></h3>
    <br/>
    <form action="salvar.php" method="POST">
        <input type="hidden" id="tipo" name="tipo" value="<?php echo $tipo;?>">
        <input type="hidden" id="codigo" name="codigo" value="<?php if($tipo=="edicao") { echo $_REQUEST['cod'];} ?>">
        <textarea id="descricao" name="descricao" style="width: 100%;" rows="5"><?php echo $descricao; ?></textarea>
        <br/><br/>
        <input class="btn btn-success" type="submit" value="Salvar">
        &nbsp;&nbsp;
        <a href="tarefas.php" class="btn btn-warning">Voltar</a>
    </form>
</div>