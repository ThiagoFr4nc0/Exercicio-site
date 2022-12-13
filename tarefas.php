<?php
session_start();
if((isset($_SESSION['logado'])) && ($_SESSION['logado']==TRUE) &&
(isset($_SESSION['nome'])) && ($_SESSION['nome']!='') &&
(isset($_SESSION['codigo_usuario'])) && ($_SESSION['codigo_usuario']>0)){

    //Link para a página de cadastro de uma tarefa
    $texto = '<a class="btn btn-success" href="edita.php">Nova tarefa</a><br/><br/>';

    //Importando o arquivo de conexão
    require_once "conecta.php";

    //Statement com a query de seleção de tarefas no banco de dados
    $stmt=$conn->prepare("SELECT * from tarefas WHERE codusuario=:CODD");
    $stmt->bindValue(':CODD',$_SESSION['codigo_usuario']);
    $stmt->execute();

    //Se existirem resultados
    if($stmt->rowCount() > 0){
        //Cabeçalho da tabela
        $texto.='        
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <th>Código</th>
                <th>Descrição</th>
                <th>Data e Hora</th>
                <th></th>
            </thead>
            <tbody>   
        ';

        //Laço While para preencher a tabela com os dados retornados pela consulta
        while($line = $stmt->fetch(PDO::FETCH_ASSOC)){
            $texto.= '<tr><td>'.$line['codigo'].'</td>
            <td>'.$line['descricao'].'</td>
            <td>'.date("d/m/Y", strtotime($line['data_hora'])).' às '.date("H:i", strtotime($line['data_hora'])).'</td>
            <td><a href="edita.php?cod='.$line['codigo'].'">
            <span class="badge rounded-pill text-bg-warning">Editar</span></a><br/>
            <a href="apaga.php?cod='.$line['codigo'].'"><span class="badge rounded-pill text-bg-danger">Excluir</span></a>
            </td></tr>';
        }

        //Fechando a tabela
        $texto.= '</tbody></table><br/><br/>';
    } else {    
        $texto = 'Não foram encontradas tarefas...';
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
    <br/>
    <?php echo $texto; ?>
</div>


<?php
require "rodape.php";
?>