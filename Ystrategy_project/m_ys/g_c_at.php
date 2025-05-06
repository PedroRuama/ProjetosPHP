<?php

include('conexao.php');





$usuario = mysqli_real_escape_string($conexao, $_SESSION['usuario']);

$data = mysqli_real_escape_string($conexao, $_POST['data']);







       $incluircadastro1 = $conexao ->prepare("DELETE FROM consulta where tabela = 'aterro' and usuario = '$usuario' ");

       $incluircadastro1->execute();



       $incluircadastro = $conexao ->prepare("INSERT INTO consulta (tabela,usuario,retirada) VALUES ('aterro','$usuario','$data')");

       $incluircadastro->execute();

       echo "<script>history.go(-1)</script>";



   

