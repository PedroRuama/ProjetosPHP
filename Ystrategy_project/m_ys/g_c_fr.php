<?php
include('conexao.php');


$usuario = mysqli_real_escape_string($conexao, $_SESSION['usuario']);
$data = mysqli_real_escape_string($conexao, $_POST['data']);

if($data != '' && $data != null){

       $incluircadastro1 = $conexao ->prepare("DELETE FROM consulta where tabela = 'formulario_relatorio' and usuario = '$usuario' ");
       $incluircadastro1->execute();

       $incluircadastro = $conexao ->prepare("INSERT INTO consulta (tabela,usuario,retirada) VALUES ('formulario_relatorio','$usuario','$data')");
       $incluircadastro->execute();
}
       echo "<script>history.go(-1)</script>";

   
