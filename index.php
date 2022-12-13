<?php
$titulo_pagina = "Login - Minhas Tarefas";
require "cabecalho-login.php";
?>
<div class="container">
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <center>
        <h3>Minhas Tarefas</h3><br/>
        <h5>Login</h5>
        <form action="login.php" method="POST">
          Usuário:<br/>
          <input type="text" name="usuario"><br/><br/>
          Senha:<br/>
          <input type="password" name="senha"><br/><br/>

          <input type="submit" class="btn btn-success" value="Entrar"><br/><br/>
          <a href="cria_usuario.php" class="btn btn-sm btn-primary">Não sou cadastrado. Criar conta.</a>
        </form>
        </center>
      </div>
    </div>
    </div></div>
  <div class="col-sm-4"></div>
</div>