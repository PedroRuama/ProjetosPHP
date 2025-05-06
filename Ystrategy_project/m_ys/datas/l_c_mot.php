<?php

 include('conexao.php');

 

 $usuario = $_SESSION['usuario'];



 ?>



 <?php



 $incluircadastro1 = $conexao ->prepare("DELETE FROM consulta where tabela = 'motorista' and usuario = '$usuario' ");

 $incluircadastro1->execute();
 echo "<script>location.href='../form_cadastro_motorista.php';</script>";



