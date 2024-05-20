<?php

  

    session_start();
        
    

   

    $host = "localhost";
    $User = "root";
    $pass = "";
    $banco = "jd_banco";

    //criando a linha de conexão
    $conexao = mysqli_connect($host, $User, $pass, $banco) or die ("problemas com a conexão do banco de Dados");


?>