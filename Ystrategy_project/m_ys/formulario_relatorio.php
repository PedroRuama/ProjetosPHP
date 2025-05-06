</head>

<?php

include('menu.php');

?>

<head>

    <link rel="stylesheet" href="./css/reset.css">

    <link rel="stylesheet" href="./css/indexm.css">
    <link rel="stylesheet" href="./css/servicos_m.css">

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=1370, user-scalable=yes, maximum-scale=10.0">




    <?php

    $hoje = date("Y-m-d");

    $user = $_SESSION['usuario'];

    if (!isset($_SESSION['usuario'])) {

        header("Location: index.php");

        exit;
    }

    ?>





    <?php

    if (isset($D_R_R_C_F_R1)) {

        $top10cliente =  mysqli_query($conexao, "SELECT `nome_cliente`,COUNT(`num_pedido`) as caçambas FROM `base_os` WHERE data_entrega in ($D_R_R_C_F_R1) and status <> 'entregar' GROUP BY nome_cliente order by caçambas DESC LIMIT 10") or die($mysqli_error);
    } else {

        $top10cliente =  mysqli_query($conexao, "SELECT `nome_cliente`,COUNT(`num_pedido`) as caçambas FROM `base_os` WHERE data_entrega = $hoje and status <> 'entregar' GROUP BY nome_cliente order by caçambas DESC LIMIT 10") or die($mysqli_error);
    }



    if (isset($D_R_R_C_F_R1)) {

        $top10valor =  mysqli_query($conexao, "SELECT `nome_cliente`,sum(`valor`) as valor FROM `base_os` WHERE data_entrega in ($D_R_R_C_F_R1) and status <> 'entregar' GROUP BY nome_cliente order by valor DESC LIMIT 10") or die($mysqli_error);
    } else {

        $top10valor =  mysqli_query($conexao, "SELECT `nome_cliente`,sum(`valor`) as valor FROM `base_os` WHERE data_entrega = $hoje and status <> 'entregar' GROUP BY nome_cliente order by valor DESC LIMIT 10") or die($mysqli_error);
    }



    if (isset($D_R_R_C_F_R1)) {

        $resumos_pedido =  mysqli_query($conexao, "SELECT count(`num_pedido`) as caçamba, sum(valor) as valor FROM `base_os` WHERE data_entrega in ($D_R_R_C_F_R1) and status <> 'entregar'") or die($mysqli_error);
    } else {

        $resumos_pedido =  mysqli_query($conexao, "SELECT count(`num_pedido`) as caçamba, sum(valor) as valor FROM `base_os` WHERE data_entrega = $hoje and status <> 'entregar'") or die($mysqli_error);
    }



    if (isset($D_R_R_C_F_R1)) {

        $relatorio_motorista =  mysqli_query($conexao, "SELECT `Motorista_retirada`,count(`num_pedido`) as qtde, sum(valor) as valor FROM `base_os` where data_entrega in ($D_R_R_C_F_R1) and status  = 'retirado' GROUP BY Motorista_retirada") or die($mysqli_error);
    } else {

        $relatorio_motorista =  mysqli_query($conexao, "SELECT `Motorista_retirada`,count(`num_pedido`) as qtde, sum(valor) as valor FROM `base_os` WHERE data_entrega = $hoje and status = 'retirado' GROUP BY Motorista_retirada") or die($mysqli_error);
    }



    if (isset($D_R_R_C_F_R1)) {

        $relatorio_Novos_clientes_periodo = mysqli_query($conexao, "SELECT COUNT(codigo_cliente) as cliente FROM `base_clientes` where codigo_cliente in (select codigo_cliente from base_os WHERE data_entrega in ($D_R_R_C_F_R1) and status <> 'entregar') and codigo_cliente not in (select codigo_cliente from base_os where data_entrega < $D_R_R_C_F_R_M1)") or die($mysqli_error);
    } else {

        $relatorio_Novos_clientes_periodo = mysqli_query($conexao, "SELECT COUNT(codigo_cliente) as cliente FROM `base_clientes` where codigo_cliente in (select codigo_cliente from base_os WHERE data_entrega = $hoje and status <> 'entregar') and codigo_cliente not in (select codigo_cliente from base_os where data_entrega < $hoje)") or die($mysqli_error);
    }



    if (isset($D_R_R_C_F_R1)) {

        $relatorio_clientes_periodo = mysqli_query($conexao, "SELECT COUNT(codigo_cliente) as cliente FROM `base_clientes` where codigo_cliente in (select codigo_cliente from base_os where data_entrega in ($D_R_R_C_F_R1) and status <> 'entregar') ") or die($mysqli_error);
    } else {

        $relatorio_clientes_periodo = mysqli_query($conexao, "SELECT COUNT(codigo_cliente) as cliente FROM `base_clientes` where codigo_cliente in (select codigo_cliente from base_os where data_entrega = $hoje and status <> 'entregar')") or die($mysqli_error);
    }



    if (isset($D_R_R_C_F_R1)) {

        $relatorio_valores_pagamento_periodo = mysqli_query($conexao, "SELECT sum(`valor_pago`) as pago,(select sum(`valor_pago`) from `base_os` where `data_pagamento`>`data_vencimento` and data_entrega in ($D_R_R_C_F_R1)) as inadimplente FROM `base_os` WHERE data_entrega in ($D_R_R_C_F_R1) ") or die($mysqli_error);
    } else {

        $relatorio_valores_pagamento_periodo = mysqli_query($conexao, "SELECT sum(`valor_pago`) as pago,(select sum(`valor_pago`) from `base_os` where `data_pagamento`>`data_vencimento` and data_entrega = $hoje ) as inadimplente FROM `base_os` WHERE data_entrega = $hoje ") or die($mysqli_error);
    }



    if (isset($D_R_R_C_F_R1)) {

        $relatorio_cliente_pagamento_periodo = mysqli_query($conexao, "SELECT count(codigo_cliente) as cliente, (select count(codigo_cliente) from base_os where valor_pago > 0 and data_pagamento > data_vencimento and data_entrega in ($D_R_R_C_F_R1)) as inadimplentes FROM `base_clientes` WHERE `codigo_cliente` in (select codigo_cliente from base_os where valor_pago > 0 and data_entrega in ($D_R_R_C_F_R1)) ") or die($mysqli_error);
    } else {

        $relatorio_cliente_pagamento_periodo = mysqli_query($conexao, "SELECT count(codigo_cliente) as cliente, (select count(codigo_cliente) from base_os where valor_pago > 0 and data_pagamento > data_vencimento  and data_entrega = $hoje) as inadimplentes FROM `base_clientes` WHERE `codigo_cliente` in (select codigo_cliente from base_os where valor_pago > 0 and data_entrega = $hoje) ") or die($mysqli_error);
    }



    ?>

    <div class="Box-Dashbord">
        <div class="Conteudo-Dashbord">
            <?php include('reload.php'); ?>
            <div class="resumo12" id="20">

                <?php include('calendario_formulario_resumo.php'); ?>



            </div>

            <br>

            <div class="Quadro_resumo_dados">



                <br>

                <div class="resumo11" id="21">



                    <?php while ($resultado_resumos_pedido = $resumos_pedido->fetch_assoc()) { ?>





                        <h2>Quantidade de Caçamba no

                            periodo&nbsp;-&nbsp;<?php echo $resultado_resumos_pedido['caçamba']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </h2>

                </div>



                <div class="resumo11" id="22">



                    <h2>Receita no periodo&nbsp;-

                        &nbsp;<?php echo 'R$' ?>&nbsp;<?php echo $resultado_resumos_pedido['valor']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    </h2>



                </div>



            <?php } ?>

            </div>

            <br>

            <div class="Quadro_resumo_dados_2">

                <div class="resumo11" id="01">



                    <?php while ($resultado_valores_pagamento_periodo = $relatorio_valores_pagamento_periodo->fetch_assoc()) { ?>





                        <h2>Valor pago no

                            periodo&nbsp;-

                            &nbsp;<?php echo 'R$' ?>&nbsp;<?php echo $resultado_valores_pagamento_periodo['pago']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </h2>

                </div>



                <div class="resumo11" id="02">



                    <h2>Valor pago apos vencimento&nbsp;-

                        &nbsp;<?php echo 'R$' ?>&nbsp;<?php echo $resultado_valores_pagamento_periodo['inadimplente']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    </h2>



                </div>



            <?php } ?>

            </div>

            <br>



            <div class="Quadro_resumo_dados_3">

                <div class="resumo11" id="01">



                    <?php while ($resultado_cliente_pagamento_periodo = $relatorio_cliente_pagamento_periodo->fetch_assoc()) { ?>





                        <h2>Clientes pago no

                            periodo&nbsp;-

                            &nbsp;&nbsp;<?php echo $resultado_cliente_pagamento_periodo['cliente']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </h2>

                </div>



                <div class="resumo11" id="02">



                    <h2>Clientes pago apos vencimento&nbsp;-

                        &nbsp;&nbsp;<?php echo $resultado_cliente_pagamento_periodo['inadimplentes']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    </h2>



                </div>



            <?php } ?>

            </div>

            <br>



            <div class="resumo11" id="03">

                <?php while ($resultado_clientes_periodo = $relatorio_clientes_periodo->fetch_assoc()) { ?>



                    <h2>Qtde de Clientes no

                        Periodo&nbsp;-&nbsp;<?php echo $resultado_clientes_periodo['cliente']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>

            </div>

        <?php } ?>



        <div class="resumo11" id="04">

            <?php while ($resultado_Novos_clientes_periodo = $relatorio_Novos_clientes_periodo->fetch_assoc()) { ?>



                <h2>Qtde de Novos Clientes no

                    Periodo&nbsp;-&nbsp;<?php echo $resultado_Novos_clientes_periodo['cliente']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                </h2>



        </div>

    <?php } ?>

    <br>





    <div class="quadro_resumo">



        <div class="texto_resumo">

            <h3>TOP 10 QUANTIDADE POR CLIENTE</h3>

        </div>

        <div class="texto_resumo">

            <h3>Por Motorista</h3>

        </div>

        <div class="texto_resumo">

            <h3>TOP 10 RECEITA POR CLIENTE</h3>

        </div>





        <div class="resumo" id="05">



            <table BORDER="1" cellpadding="15">



                <thead>





                    <tr>

                        <th style="text-align:center">&nbsp;&nbsp;Cliente&nbsp;&nbsp;</th>

                        <th style="text-align:center">&nbsp;&nbsp;Caçambas&nbsp;&nbsp;</th>



                    </tr>

                </thead>

                <tbody>

                    <?php

                    while ($resultado_top10cliente = $top10cliente->fetch_assoc()) {









                    ?>

                        <tr>





                            <td><a>&nbsp;&nbsp;<?php echo $resultado_top10cliente['nome_cliente']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </td>

                            <td><a>&nbsp;&nbsp;<?php echo $resultado_top10cliente['caçambas']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </td>



                        </tr>



                    <?php } ?>

                </tbody>

            </table>



        </div>





        <div class="resumo" id="06">



            <table BORDER="1" cellpadding="15">

                <thead>





                    <tr>

                        <th style="text-align:center">&nbsp;&nbsp;Motorista&nbsp;&nbsp;</th>

                        <th style="text-align:center">&nbsp;&nbsp;Caçamba&nbsp;&nbsp;</th>

                        <th style="text-align:center">&nbsp;&nbsp;Valor&nbsp;&nbsp;</th>



                    </tr>

                </thead>

                <tbody>

                    <?php

                    while ($resultado_motorista = $relatorio_motorista->fetch_assoc()) {









                    ?>

                        <tr>





                            <td><a>&nbsp;&nbsp;<?php echo $resultado_motorista['Motorista_retirada']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </td>

                            <td><a>&nbsp;&nbsp;<?php echo $resultado_motorista['qtde']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </td>

                            <td><a>&nbsp;&nbsp;<?php echo 'R$' ?>&nbsp;<?php echo $resultado_motorista['valor']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </td>



                        </tr>



                    <?php } ?>

                </tbody>

            </table>





        </div>

        <div class="resumo" id="07">



            <table BORDER="1" cellpadding="15">



                <thead>



                    <tr>

                        <th style="text-align:center">&nbsp;&nbsp;Cliente&nbsp;&nbsp;</th>

                        <th style="text-align:center">&nbsp;&nbsp;Valor&nbsp;&nbsp;</th>



                    </tr>

                </thead>

                <tbody>

                    <?php

                    while ($resultado_top10valor = $top10valor->fetch_assoc()) {









                    ?>

                        <tr>





                            <td><a>&nbsp;&nbsp;<?php echo $resultado_top10valor['nome_cliente']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </td>

                            <td><a>&nbsp;&nbsp;<?php echo 'R$' ?>&nbsp;<?php echo $resultado_top10valor['valor']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </td>



                        </tr>



                    <?php } ?>



                </tbody>

            </table>



        </div>

    </div>
        </div>
    </div>