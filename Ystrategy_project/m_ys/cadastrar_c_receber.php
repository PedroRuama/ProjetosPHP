<?php

include('conexao.php');

$c_r_ped = mysqli_real_escape_string($conexao, $_POST['c_r_ped']);

$c_r_cliente = mysqli_real_escape_string($conexao, $_POST['c_r_cliente']);

$total = mysqli_real_escape_string($conexao, $_POST['total']);

$val_pago = mysqli_real_escape_string($conexao, $_POST['val_pago']);

$d_emiss = mysqli_real_escape_string($conexao, $_POST['d_emiss']);

$d_venc = mysqli_real_escape_string($conexao, $_POST['d_venc']);

$d_pag = mysqli_real_escape_string($conexao, $_POST['d_pag']);

$identificacao_pagamento = mysqli_real_escape_string($conexao, $_POST['identificacao_pagamento']);

$nota = mysqli_real_escape_string($conexao, $_POST['nota']);

$acao_n = mysqli_real_escape_string($conexao, $_POST['acao_nota']);

$banco = mysqli_real_escape_string($conexao, $_POST['banco']);




$hoje = date('Y,m,d');

$query = "select * from base_valores";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);



$query1 = "select * from base_valores ";

$result1 = mysqli_query($conexao, $query1);

$row1 = mysqli_num_rows($result1);



if ($c_r_ped === "") {

       echo "<script>alert('Campo Vazio necessario Informar o pedido');</script>";

       echo "<script>history.go(-1)</script>";
} else {



       switch ($acao_n) {
              case 'Emitir':

                     $incluircadastro = $conexao->prepare("update base_os set valor = '$total', data_emissao = '$d_emiss', data_vencimento = '$d_venc', num_nota = '$nota', identificacao_pagamento = '$identificacao_pagamento' where num_pedido = '$c_r_ped'");

                     $incluircadastro->execute();

                     echo "<script>alert('Cadastro realizado com sucesso');</script>"; 

                     echo "<script>history.go(-1)</script>";
                     break;


              case 'Baixa':


                     $baixacadastro = $conexao->prepare("update base_os set valor_pago = '$val_pago',status_pagamento = 'SIM', data_pagamento = '$d_pag', identificacao_pagamento = '$identificacao_pagamento', banco = '$banco' where num_pedido = '$c_r_ped'");

                     $baixacadastro->execute();

                     echo "<script>alert('Baixa realizada com sucesso');</script>"; 

                     echo "<script>history.go(-1)</script>";
                     break;
              case 'Edit_d_emiss':


                     $editcadastro = $conexao->prepare("update base_os set data_emissao = '$d_emiss' where num_pedido = '$c_r_ped'");

                     $editcadastro->execute();

                    echo "<script>alert('Data alterada com sucesso');</script>"; 

                     echo "<script>history.go(-1)</script>";
                     break;
              case 'Edit_d_venc':


                     $editcadastro = $conexao->prepare("update base_os set data_vencimento = '$d_venc' where num_pedido = '$c_r_ped'");

                     $editcadastro->execute();

                     echo "<script>alert('Data alterada com sucesso');</script>"; 

                     echo "<script>history.go(-1)</script>";
                     break;
              case 'Edit_d_pag':


                     $editcadastro = $conexao->prepare("update base_os set data_pagamento = '$d_pag' where num_pedido = '$c_r_ped'");

                     $editcadastro->execute();

                     echo "<script>alert('Data alterada com sucesso');</script>"; 

                     echo "<script>history.go(-1)</script>";
                     break;
 
              case 'Edit_val_pag':


                     $editcadastro = $conexao->prepare("update base_os set valor_pago = '$val_pago' where num_pedido = '$c_r_ped'");

                     $editcadastro->execute();

                     echo "<script>alert('valor alterado com sucesso');</script>"; 

                     echo "<script>history.go(-1)</script>";
                     break;
 
              default:
                     # code...
                     break;
       }
}
