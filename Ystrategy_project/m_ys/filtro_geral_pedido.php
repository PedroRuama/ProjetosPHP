<?php

include('conexao.php');





$nome = mysqli_real_escape_string($conexao, $_POST['filtro_nome_pedido']);

$endereco = mysqli_real_escape_string($conexao, $_POST['filtro_endereco_pedido']);

$motorista = mysqli_real_escape_string($conexao, $_POST['filtro_motorista_pedido']);

$aterro = mysqli_real_escape_string($conexao, $_POST['filtro_aterro_pedido']);

$usuario = mysqli_real_escape_string($conexao, $_SESSION['usuario']);

$data_entrega = mysqli_real_escape_string($conexao, $_POST['data_entrega']);

$data_retirada = mysqli_real_escape_string($conexao, $_POST['data_retirada']);

$telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);

$statuss = mysqli_real_escape_string($conexao, $_POST['filtro_status']);





$incluircadastro1 = $conexao->prepare("DELETE FROM consulta where tabela = 'pedido' and usuario = '$usuario' ");

$incluircadastro1->execute();







$incluircadastro = $conexao->prepare("INSERT INTO consulta (status,telefone,tabela,nome,endereco,motorista,aterro,usuario,entrega,retirada) VALUES ('$statuss','$telefone','pedido','$nome','$endereco','$motorista','$aterro','$usuario','$data_entrega','$data_retirada')");


$incluircadastro->execute();

echo "<script>location.href='form_rt.php';</script>";
