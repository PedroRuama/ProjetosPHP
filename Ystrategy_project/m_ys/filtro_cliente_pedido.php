<?php
include('conexao.php');
$filtro_cliente = mysqli_real_escape_string($conexao, $_POST['filtro_cliente']);
            $incluircadastro1 = $conexao ->prepare("DELETE FROM consulta_cliente");
            $incluircadastro1->execute();

       $incluircadastro = $conexao ->prepare("INSERT INTO consulta_cliente (filtro_cliente) VALUES ('$filtro_cliente')");
       $incluircadastro->execute();
       echo "<script>location.href='form_pedido.php';</script>";