<?php
//Configurações da base de dados e parâmetros de conexão
//Este arquivo é importado via require nas páginas onde é usada a conexão com o banco de dados
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DBNAME','bancolocal');

try{
    $conn = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';',USER, PASS);
} catch(PDOException $e){
    echo $e->getMessage();
}
?>