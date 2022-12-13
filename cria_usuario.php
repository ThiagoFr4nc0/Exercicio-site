<?php
session_start();
if( (isset($_SESSION['logado'])) && ($_SESSION['logado']==TRUE) ){
    header("Location: tarefas.php");
}
$titulo_pagina = "Login - Minhas Tarefas";
require "cabecalho.php";
?>
<div class="container">
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <center>
        <h3>Minhas Tarefas</h3><br/>
        <h5>Nova Conta</h5>
<form action="cria_usuario2.php" method="POST">
Nome Completo:<br/>
<input type="text" name="nome"><br/><br/>
E-mail:<br/>
<input type="email" name="email"><br/><br/>
Usuário:<br/>
<input type="text" name="usuario"><br/><br/>
Senha:<br/>
<input type="password" name="senha"><br/><br/>

<input type="submit" class="btn btn-success" value="Avançar"><br/><br/>
</form>

</center>
      </div>
    </div>
    </div></div>
  <div class="col-sm-4"></div>
</div>