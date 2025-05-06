<?php

include('conexao.php');





$usuario = mysqli_real_escape_string($conexao, $_SESSION['usuario']);

$data = mysqli_real_escape_string($conexao, $_POST['data']);







$incluircadastro1 = $conexao->prepare("DELETE FROM consulta where tabela = 'motorista' and usuario = '$usuario' ");

$incluircadastro1->execute() or die($mysqli_error);;



$incluircadastro = $conexao->prepare("INSERT INTO consulta (tabela,usuario,retirada) VALUES ('motorista','$usuario','$data')");

$incluircadastro->execute() or die($mysqli_error);;

echo "<script>location.href='form_cadastro_motorista.php';</script>";
