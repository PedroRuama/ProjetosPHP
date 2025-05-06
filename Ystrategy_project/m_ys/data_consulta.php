<?php
include('conexao.php');
$d_inicio = mysqli_real_escape_string($conexao, $_POST['d_inicio']);
$d_final = mysqli_real_escape_string($conexao, $_POST['d_final']);
            $incluircadastro1 = $conexao ->prepare("DELETE FROM CONSULTA where tabela = 'aterro'");
            $incluircadastro1->execute();

       $incluircadastro = $conexao ->prepare("INSERT INTO consulta(tabela,entrega) VALUES ('aterro','$d_inicio')");
       $incluircadastro->execute();
       echo "<script>location.href='form_cadastro_aterro.php';</script>";

   
