<?php require_once  'config.php'; ?>

<?php require_once DBAPI; ?> 

<?php
  
    $db = open_database();
    if($db){
        echo '<h1> Banco de Dados Conectato </h1>';
    } else {
        echo '<h1>ERRO: não foi possivel conectar :(</h1>';
    }


?>