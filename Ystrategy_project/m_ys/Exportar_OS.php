<?php
include('conexao.php');

include('chamadas_sql.php');

include('funcoes.php');

$hoje = date('d_m_y');



header("Content-type: application/vnd.ms-excel");

header("Content-type: application/force-download");

header("Content-Disposition: attachment; filename=pedidos$hoje.xls");

header("Pragma: no-cache");


$user = $_SESSION['usuario'];

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






<div class="tabela-base">

    <table BORDER="1" cellpadding="15">



        <thead>



            <tr>

                <th style="text-align:center">Pedido</th>

                <th style="text-align:center">Serviço</th>


                <th style="text-align:center">Data Entrega</th>

                <th style="text-align:center">Cliente</th>

                <th style="text-align:center">Endereço</th>

                <th style="text-align:center">Numero</th>

                <th style="text-align:center">Bairro</th>

                <th style="text-align:center">Complemento</th>


                <th style="text-align:center">Data Retirada</th>

                <th style="text-align:center">Motorista</th>

                <th style="text-align:center">Aterro</th>


                <th style="text-align:center">Telefone</th>

                <th style="text-align:center">Caçamba</th>

                <th style="text-align:center">Tipo Caçamba</th>


                <th style="text-align:center">Valor esperado</th>

                <th style="text-align:center">Valor pago</th>

                <th style="text-align:center">Forma Pagamento </th>

                <th style="text-align:center">Nota Fiscal</th>

                <th style="text-align:center">Tipo Nota</th>

                <th style="text-align:center">Status Pagamento</th>

                <th style="text-align:center">Data Emissão</th>

                <th style="text-align:center">Data Vencimento</th>

                <th style="text-align:center">Data Pagamento</th>

                <th style="text-align:center">Status</th>





            </tr>

        </thead>

        <tbody>

            <?php

            while ($ped = $base_os_g->fetch_assoc()) {

                $n = explode(' ', $ped['motorista']);

                $pN = $n[0]; // 'Carlos'

            ?>

                <tr class="tr_tabela">



                    <td style="text-align:center">

                        <?php echo $ped['num_pedido']; ?>

                    </td>

                    <td><?php echo $ped['tipo_os']; ?></td>


                    <td class="d_entrega"><?php echo date('d/m/Y', strtotime($ped['data_entrega'])) ?>

                    </td>

                    <td class="filtro_nome_pedido"><?php echo $ped['nome_cliente']; ?></td>

                    <td class="filtro_endereco_pedido"><?php echo $ped['Endereco']; ?></td>

                    <td><?php echo $ped['numero']; ?></td>

                    <td><?php echo $ped['bairro']; ?></td>

                    <td><?php echo $ped['complemento']; ?></td>


                    <td class="d_retirada"><?php echo date('d/m/Y', strtotime($ped['data_retirada'])) ?>

                    </td>

                    <td style="text-align:center" class="filtro_motorista"><?php echo $pN; ?></td>

                    <td style="text-align:center" class="filtro_aterro_pedido">
                        <?php
                        if ($ped['aterro'] == 'EM_OBRA') {
                            echo '---';
                        } else {
                            echo $ped['aterro'];
                        } ?>
                    </td>



                    <td class="telefone"><?php echo $ped['telefone']; ?></td>

                    <td><?php echo $ped['cacamba']; ?></td>

                    <td><?php echo $ped['tipo_cacamba']; ?></td>



                    <td><?php echo $ped['valor']; ?></td>

                    <td><?php if ($ped['valor_pago'] != null)
                            echo $ped['valor_pago'];
                        else echo 0;
                        ?></td>

                    <td><?php echo $ped['for_pag']; ?></td>

                    <td><?php
                        if ($ped['num_nota'] != null) {
                            echo $ped['num_nota'];
                        } else {
                            echo '---';
                        } ?>
                    </td>

                    <td class=""><?php echo $ped['tipo_nota']; ?></td>

                    <td style="text-align:center">

                        <?php echo $ped['status_pagamento']; ?>

                    </td>


                    <td><?php
                        if ($ped['data_emissao'] != null) {
                            echo date('d/m/Y', strtotime($ped['data_emissao']));
                        } else {
                            echo ' ---- ';
                        }

                        ?> </td>
                    <td><?php
                        if ($ped['data_vencimento'] != null) {
                            echo date('d/m/Y', strtotime($ped['data_vencimento']));
                        } else {
                            echo ' ---- ';
                        }

                        ?> </td>
                    <td><?php
                        if ($ped['data_pagamento'] != null) {
                            echo date('d/m/Y', strtotime($ped['data_pagamento']));
                        } else {
                            echo ' ---- ';
                        }

                        ?> </td>


                    <td class="filtro_status"><?php echo $ped['status']; ?></td>


                </tr>



            <?php } ?>

        </tbody>

    </table>

</div>