<?php

include('menu.php');





$user = $_SESSION['usuario'];

$hoje = date('Y-m-d');

// VISÃO consulta pedido em aberto

$sessin_tabela =  mysqli_query($conexao, "select * from cadastro where USUARIO = '$user' and (sessao = 'PEDIDO' or sessao = 'ADMINISTRADOR')") or die($mysqli_error);

while ($pagina = $sessin_tabela->fetch_assoc()) {

    $row = mysqli_num_rows($sessin_tabela);

    $_SESSION['pagina'] =  $pagina['USUARIO'];
}





if ($D_R_S_M = null) {

    $D_R_S_M1 = $D_R_S_M;
} else {

    $D_R_S_M1 = "'" . $D_R_S_M . "'";
}





$sql_serv_mot_resumo  =  mysqli_query($conexao, "select * from consulta where tabela = 'pedido'") or die($mysqli_error);

while ($R_S_M = $sql_serv_mot_resumo->fetch_assoc()) {

    $D_R_S_M = $R_S_M['entrega'];

    $Q = "SELECT * FROM `consulta` WHERE entrega = '' and tabela = 'pedido' ";

    $R = mysqli_query($conexao, $Q);

    $row11 = mysqli_num_rows($R);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/indexm.css">
</head>

<body>
    <div class="Box-Dashbord">
        <div class="Conteudo-Dashbord">
            <?php include('reload.php'); ?>
            <h1 class="h1_title">Contas a Receber:</h1>
            <br>
            <div class="form">
                <div class="quadro-pedidos" id="contas_div">

                    <div class="div_forms">
                        <form action="cadastrar_c_receber.php" method="post">
                            <h2>
                                Contas a Receber
                            </h2>


                            &nbsp;&nbsp;&nbsp;
                            <div class="forms__">
                                <div class="inputGroup">
                                    <input size="10" minlength="1" maxlength="8" type="numero" name="c_r_ped" value="" required>
                                    <label for="">Pedido</label>
                                </div>

                                &nbsp;&nbsp;&nbsp;

                                <div class="inputGroup">
                                    <input size="35" name="c_r_cliente" value="" required disabled="disabled">
                                    <label for="">Cliente</label>
                                </div>

                                <div class="inputGroup">
                                    <input size="20" name="c_r_endereco" id="c_r_endereco" value="" required>
                                    <label>ENDEREÇO</label>
                                </div>



                                <div class="inputGroup">
                                    <input size="5" maxlength="7" type="int" name="total" value="" required>
                                    <label>Valor </label>
                                </div>

                                <div class="inputGroup">
                                    <input size="5" maxlength="7" type="int" name="val_pago" value="" required>
                                    <label>Pago</label>
                                </div>


                                <div class="inputGroup">
                                    <p class="label_select">Banco</p>

                                    <select id="banco" name="banco" required>

                                        <option value=""></option>
                                        <option value="Banco do Brasil">Banco do Brasil</option>
                                        <option value="Itau">Itau</option>
                                        <option value="Caixa">Caixa</option>
                                        <option value="Santander">Santander</option>
                                        <option value="Bradesco">Bradesco</option>
                                        <option value="CORA">CORA</option>
                                        <option value="PicPay">PicPay</option>
                                        <option value="Nubank">Nubank</option>
                                        <option value="PagBank">PagBank</option>
                                        <option value="PayPal">PayPal</option>

                                    </select>
                                </div>

                                <div class="inputGroup">
                                    <input size="10" maxlength="7" type="int" name="nota" value="" required>
                                    <label>Nº Nota</label>
                                </div>

                                &nbsp;&nbsp;

                                <div class="inputGroup">
                                    <input size="45" minlength="0" maxlength="45" type="date" name="d_emiss" value='<?php echo date("Y-m-d"); ?>'>
                                    <label>D.Emissão</label>
                                </div>
                                <div class="inputGroup">
                                    <input size="45" minlength="0" maxlength="45" type="date" name="d_venc" value='<?php echo date("Y-m-d"); ?>'>
                                    <label>D. Vencimento</label>
                                </div>
                                <div class="inputGroup">
                                    <input size="45" minlength="0" maxlength="45" type="date" name="d_pag" value='<?php echo date("Y-m-d"); ?>'>
                                    <label>D.Pagamento</label>
                                </div>



                                <div class="inputGroup">
                                    <input size="25" type="varchar" name="identificacao_pagamento" id="identificacao_pagamento" value="">
                                    <label>Identificação de Pagamento</label>
                                </div>



                                <div class="inputGroup">
                                    <p class="label_select">Ação Nota</p>

                                    <select id="edicao" name="acao_nota" required>

                                        <option value=""></option>

                                        <option value="Emitir">Emitir Nota</option>

                                        <option value="Baixa">Dar Baixa Nota</option>

                                        <option value="Edit_d_emiss">Editar Data Emissão</option>

                                        <option value="Edit_d_venc">Editar Data vencimento</option>

                                        <option value="Edit_d_pag"> Editar Data Pagamento</option>

                                        <option value="Edit_val_pag"> Editar Valor Pagamento</option>

                                    </select>
                                </div>

                                <button input type="submit" name="acao" class="btn"><img>&nbsp;&nbsp;Salvar&nbsp;&nbsp;</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>



            <div class="visao_clientes">

                <?php

                //    include('calendario_base_pedidos.php');

                ?>



            </div>



            <div class="tabela-base">





                <div class="table-wrapper">

                    <table BORDER="1" cellpadding="15">

                        <thead>

                            <tr>

                                <th class="th_financeiro">Pedido</th>

                                <th class="th_financeiro">Cliente</th>

                                <th class="th_financeiro">Endereço</th>

                                <th class="th_financeiro">Nota Fiscal</th>

                                <th class="th_financeiro">Pago</th>

                                <th class="th_financeiro">Valor</th>

                                <th class="th_financeiro">Valor Pago</th>

                                <th class="th_financeiro">Banco</th>

                                <th class="th_financeiro">Tipo</th>

                                <th class="th_financeiro">Retirada</th>

                                <th class="th_financeiro">Vencimento</th>

                                <th class="th_financeiro">Pagamento</th>

                                <th class="th_financeiro">Identificação</th>

                                <!-- <th>❌</th> -->

                                <!-- <th>Valor em Aberto</th> -->

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            while ($arquivos = $sql_lista_contas_a_receber->fetch_assoc()) {



                            ?>



                                <tr>



                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['num_pedido']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['nome_cliente']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['Endereco']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['num_nota']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['status_pagamento']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['valor']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['valor_pago']; ?>&nbsp;&nbsp;&nbsp;</a>
                                    
                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['banco']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['tipo_nota']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['data_retirada']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['data_vencimento']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['data_pagamento']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>

                                    <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['identificacao_pagamento']; ?>&nbsp;&nbsp;&nbsp;</a>

                                    </td>



                                    <!-- <th><a href="?update2=<?PHP echo $arquivos['id'] ?>">🚫</a></th> -->

                                    <!-- <th><a href="?update3=<?PHP echo $arquivos['id'] ?>">🤦🏻</a></th> -->

                                </tr>



                            <?php

                            }



                            ?>

                        </tbody>

                    </table>
            <?php include('rodape.php'); ?>

                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>

</body>

</html>

<script src="./js/jquery.min.js"></script>

<script src="./js/jquery-ui.min.js"></script>

<script src="./js/jquery-ui.multidatespicker.js"></script>

<script src="./js/mudar.js"></script>

<script type='text/javascript'>
    $(document).ready(function() {

        $("input[name='c_r_ped']").blur(function() {

            var $c_r_cliente = $("input[name='c_r_cliente']");

            var $c_r_endereco = $("input[name='c_r_endereco']");

            var $total = $("input[name='total']");

            var $credito_cliente = $("input[name='for_pag']");

            var $tipo_valor = $("input[name='tipo_valor']");





            $.getJSON('f_c_r.php', {

                matricula: $(this).val()

            }, function(json) {

                $c_r_cliente.val(json.c_r_cliente);

                $c_r_endereco.val(json.c_r_endereco);

                $total.val(json.total);

                $credito_cliente.val(json.for_pag);

                $tipo_valor.val(json.tipo_valor);







            });

        });

    });
</script>