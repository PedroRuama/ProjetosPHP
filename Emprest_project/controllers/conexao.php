<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $banco = "emprest";

    //criando a linha de conexão
    $conexao = mysqli_connect($host, $user, $pass, $banco) or die ("problemas com a conexão do banco de Dados");


?>