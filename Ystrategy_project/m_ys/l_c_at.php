<?php
 include('conexao.php');
 
 $usuario = $_SESSION['usuario'];

 ?>

 <?php

 $incluircadastro1 = $conexao ->prepare("DELETE FROM consulta where tabela = 'aterro' and usuario = '$usuario' ");
 $incluircadastro1->execute();
echo "<script>history.go(-1)</script>"; 

