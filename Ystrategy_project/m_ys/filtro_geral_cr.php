<?php
include('conexao.php');


$nome = mysqli_real_escape_string($conexao, $_POST['filtro_nome_pedido']);
$endereco = mysqli_real_escape_string($conexao, $_POST['filtro_endereco_pedido']);
$motorista = mysqli_real_escape_string($conexao, $_POST['filtro_motorista_pedido']);
$aterro = mysqli_real_escape_string($conexao, $_POST['filtro_aterro_pedido']);
$usuario = mysqli_real_escape_string($conexao, $_SESSION['usuario']);
$d_i_e = mysqli_real_escape_string($conexao, $_POST['d_i_entrega']);
$d_i_r = mysqli_real_escape_string($conexao, $_POST['d_i_retirada']);

            $incluircadastro1 = $conexao ->prepare("DELETE FROM consulta where tabela = 'cr' and usuario = '$usuario' ");
            $incluircadastro1->execute();

       $incluircadastro = $conexao ->prepare("INSERT INTO consulta (tabela,nome,endereco,motorista,aterro,usuario,entrega,retirada) VALUES ('cr','$nome','$endereco','$motorista','$aterro','$usuario','$d_i_e','$d_i_r')");
       $incluircadastro->execute();
       echo "<script>location.href='form_c_receber.php';</script>";

   
