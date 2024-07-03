<?php

    $host = "127.0.0.1:3306";
    $user = "u247855321_user_emp";
    $pass = "Pedro2426";
    $banco = "u247855321_emprest";

    //criando a linha de conexão
    $conexao = mysqli_connect($host, $user, $pass, $banco) or die ("problemas com a conexão do banco de Dados");


?>