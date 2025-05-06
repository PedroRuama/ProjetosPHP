<!DOCTYPE html>



<?php


include('conexao.php');
include('menu.php');


?>
<html lang="pt-br">



<head>

    <!-- <link rel="stylesheet" href="./css/reset.css"> -->

    <link rel="stylesheet" href="./css/indexm.css">
    <link rel="stylesheet" href="./css/servicos_m.css">

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width">
    

    

</head>






<?php
// error_reporting(E_ALL & ~E_WARNING);
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

<body>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const versaoAtual = "1.3"; // 🔄 ALTERE ESTE VALOR PARA FORÇAR NOVA MENSAGEM

            // Obtém a versão salva no navegador
            const versaoSalva = localStorage.getItem("popupVersion");

            // Se a versão mudou ou não existe, exibe o pop-up
            if (versaoSalva !== versaoAtual) {
                showPopup(versaoAtual);
            }
        });

        function showPopup(versao) {
            // Criando o overlay e o pop-up
            let overlay = document.createElement("div");
            overlay.id = "popup-overlay";
            overlay.innerHTML = `
            <div id="popup">
                
                <p><strong>O sistema recebeu atualizações!</strong></p>
                <br>
                <p>Recomendamos pressionar <strong>Ctrl + F5 (recarregar página)</strong> para garantir que todas as atualizações sejam carregadas corretamente.</p>
                <button onclick="closePopup('${versao}')">OK</button>
            </div>
        `;

            document.body.appendChild(overlay);

            // Evento para fechar ao clicar no X
            document.getElementById("close-popup").addEventListener("click", () => closePopup(versao));
        }

        function closePopup(versao) {
            document.getElementById("popup-overlay").remove();
            localStorage.setItem("popupVersion", versao);
        }
    </script>



    <div class="Box-Dashbord">
        <div class="Conteudo-Dashbord">
            <?php include('reload.php');

            ?>

            <h1 class="h1_title">Base Pedidos:</h1>
            <?php
            // echo '<pre>';
            // print_r($_SESSION);
            // echo '</pre>';

            ?>

            <div class="quadro-pedidos" id="pedidos_div">

                <br>
                <div class="div_forms">

                    <form action="cadastrar_pedido.php" method="post">
                        <h2>Pedidos Cadastrados</h2>
                        <div class="forms__">
                            <input size="5" minlength="1" maxlength="11" type="hidden" name="id_cliente" id="id_cliente" value="">

                            <input size="10" minlength="1" maxlength="11" type="hidden" type="text" name="status" id="status" value="">

                            <div class="inputGroup">
                                <input class="input" size="10" required minlength="1" maxlength="11" type="search" name="num_pedido" id="num_pedido">
                                <label for="">Pedido</label>
                            </div>
                            <div class="inputGroup">
                                <p class="label_select">Tipo serviço</p>
                                <select id="tipo_se" name="tipo_se" required>
                                    <option value=""></option>
                                    <option value="YSTRATEGY">YSTRATEGY</option>
                                    <option value="OUTROS">OUTROS</option>
                                    <option value="AMBOS">AMBOS</option>
                                </select>
                            </div>

                            <div class="inputGroup">
                                <input size="10" minlength="1" maxlength="11" type="numero" name="codigo_cliente_pedido"
                                    id="codigo_cliente_pedido" value="" required>
                                <label for="" class="">Codigo Cliente</label>
                            </div>
                            <div class="inputGroup">
                                <input size="25" minlength="2" onkeyup="maiuscula(this)" disabled="disabled" maxlength="45" type="name"

                                    name="nome_cliente_pedido2" value="" placeholder="Nome">

                                <label for="">Nome</label>
                            </div>

                            <input size="45" minlength="2" onkeyup="maiuscula(this)" maxlength="45" type="hidden" name="nome_cliente_pedido"

                                value="" required>

                            <input size="14" name="cep" id="cep" type="hidden" value='' />

                            <input size="45" minlength="16" maxlength="45" type="hidden" name="endereco" id="endereco" value=''>

                            <input minlength="0" maxlength="6" size="3" type="hidden" name="Numero" id="Numero" value="">

                            <input minlength="0" maxlength="14" type="hidden" name="complemento" id="complemento" value="">

                            <input minlength="0" maxlength="25" type="hidden" name="bairro" id="bairro" value=''>

                            <input minlength="0" maxlength="25" type="hidden" name="municipio" id="municipio" value=''>

                            <input minlength="1" maxlength="2" size="1" type="hidden" name="qc" id="qc" value="1">

                            <input size="15" minlength="0" maxlength="45" type="hidden" name="for_pag" id="for_pag" value="">

                            <input size="8" minlength="0" type="hidden" maxlength="45" name="valor" id="valor" value="">



                            <div class="inputGroup">
                                <input size="45" minlength="0" maxlength="45" type="date" name="d_entrega" id="d_entrega"
                                    value='<?php echo date("Y-m-d"); ?>'>
                                <label for="">Entrega</label>
                            </div>


                            <div class="inputGroup">
                                <input size="45" minlength="0" maxlength="45" type="date" name="d_retirada" id="d_retirada"
                                    value='<?php echo date("Y-m-d"); ?>'>
                                <label for="">Retirada</label>
                            </div>


                            <div class="inputGroup">
                                <p class="label_select">Motorista</p>
                                <select id="motorista" name="motorista" required>
                                    <option value=""></option>
                                    <?php

                                    while ($b_motorista = $sql_c_motorista->fetch_assoc()) { ?>

                                        <option value='<?php echo $b_motorista['nome_motorista']; ?>'>

                                            <?php echo $b_motorista['nome_motorista']; ?></option>

                                    <?php } ?>

                                </select>
                            </div>
                            <div class="inputGroup">
                                <p class="label_select">Período</p>
                                <select id="periodo" name="periodo" required>
                                    <option value=""></option>
                                    <option value="DIURNO">DIURNO</option>
                                    <option value="NOTURNO">NOTURNO</option>

                                </select>
                            </div>

                            <div class="inputGroup">
                                <input size="25" minlength="1" required maxlength="30" type="varchar" name="comentario" id="comentario" value="">

                                <label for="">Comentarios</label>
                            </div>

                            <div class="inputGroup big_inpGroup">
                                <input size="10" minlength="11" maxlength="11" disabled="disabled" type="numero" disabled="disabled"

                                    name="telefone_cliente_pedido" id="telefone_cliente_pedido" value="" placeholder="Telefone">

                                <label for="" class="big_label">Telefone</label>
                            </div>




                            <div class="inputGroup">
                                <p class="label_select">Ação</p>

                                <select id="edicao" name="edicao" required>

                                    <option value=""></option>

                                    <option value="Incluir">Novo Pedido</option>

                                    <option value="Troca">Troca</option>

                                    <option value="Retirar">Retirar</option>

                                    <option value="Editar Data Entrega">Editar Data Entrega</option>

                                    <option value="Editar Data Retirada">Editar Data Retirada</option>

                                    <option value="Editar Motorista">Editar Motorista</option>

                                    <option value="Editar tipo_se"> Editar Tipo Serviço</option>

                                    <option value="Editar periodo"> Editar Período </option>

                                    <option value="Exluir Pedido">Exluir Pedido</option>
                                </select>
                            </div>
                            <button input type="submit" name="acao" class="btn">Salvar</button>
                        </div>


                    </form>
                </div>
                <label class="checkbox-container">
                    Fixar Pedidos
                    <input type="checkbox" oninput="fix_ped(this)" id="fix_ped">
                    <span class="checkmark"></span>
                </label>
            </div>


            <div class="quadro-pedidos" id="contas_div">
                <div class="div_forms">

                    <form action="cadastrar_c_receber.php" method="post">
                        <h2>
                            <button class="btn_Maxmin" type="button" onclick="maxmize(this), divAcao()">➕</button>
                            Contas a Receber
                        </h2>



                        <div class="forms__ minimize">
                            <div class="inputGroup">
                                <input size="10" minlength="1" maxlength="8" type="numero" name="c_r_ped" value="" required>
                                <label for="">Pedido</label>
                            </div>



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
                                <input size="5" maxlength="7" type="int" name="nota" value="" required>
                                <label>Nº Nota</label>
                            </div>

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

                                    <oFORMIGAtion value="Edit_d_venc">Editar Data vencimento</option>

                                    <option value="Edit_d_pag"> Editar Data Pagamento</option>

                                    <option value="Edit_val_pag"> Editar Valor Pagamento</option>

                                </select>
                            </div>

                            <button input type="submit" name="acao" class="btn">Salvar</button>
                        </div>

                    </form>
                </div>


                <label class="checkbox-container">
                    Fixar Contas
                    <input type="checkbox" oninput="fix_con(this)" id="fix_ped">
                    <span class="checkmark"></span>
                </label>
            </div>

            <br>


            <div class="quadro-pedidos_">
                <div class="div_forms">
                    <?php
                    include('calendario_base_pedidos.php');
                    ?>
                </div>
                <!-- <div class="div_forms">
                    <form name="select-multiple" method="post" style="background: white;">
                        <h2 class="h2filtro_form">
                            <button class="btn_Maxmin" type="button" onclick="maxmize(this), divAcao()">➕</button>
                            Filtro Rápido
                        </h2>
                        <div class="forms__ minimize">
                            <div class="inputGroup">
                                <input size="7" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_pedido"
                                    value="">
                                <label>Nº Pedido</label>
                            </div>

                            <div class="inputGroup">
                                <input size="30" onkeyup="maiuscula(this); busc(this)" maxlength="45" type="name" name="filtro_nome_pedido"
                                    value="">
                                <label>Cliente</label>
                            </div>

                            <div class="inputGroup">

                                <input size="30" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_endereco_pedido"
                                    value="">
                                <label>Endereço</label>
                            </div>

                            <div class="inputGroup">

                                <input size="10" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_bairro"
                                    value="">
                                <label>Bairro</label>
                            </div>
                            <div class="inputGroup">

                                <input size="7" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_n_ende"
                                    value="">
                                <label>Nº Ende.</label>
                            </div>


                            <div class="inputGroup">
                                <p class="label_select">Motorista</p>
                                <select id="motorista" name="filtro_motorista" oninput="busc(this)" required>
                                    <option value=""></option>
                                    <?php
                                    $sql_c_motorista__ = mysqli_query($conexao, "select * from base_motorista") or die($mysqli_error);
                                    while ($b_motorista = $sql_c_motorista__->fetch_assoc()) { ?>

                                        <option value='<?php echo $b_motorista['nome_motorista']; ?>'>

                                            <?php echo $b_motorista['nome_motorista']; ?></option>

                                    <?php } ?>

                                </select>
                            </div>


                            <div class="inputGroup">

                                <p class="label_select">Aterro</p>


                                <select name="filtro_aterro_pedido" oninput="busc(this)">

                                    <option value=""></option>



                                    <?php
                                    $aterros_f__ = mysqli_query($conexao, "select * from base_aterro") or die($mysqli_error);


                                    while ($p_aterro_f = $aterros_f__->fetch_assoc()) { ?>

                                        <option value='<?php echo $p_aterro_f['Nome_aterro']; ?>'>

                                            <?php echo $p_aterro_f['Nome_aterro']; ?></option>

                                    <?php } ?>

                                </select>


                            </div>
                            <div class="inputGroup">

                                <p class="label_select">Colocação/Troca</p>

                                <select name="filtro_tipoOS" oninput="busc(this)">

                                    <option value=""></option>
                                    <option value='Colocacao'>Colocação</option>
                                    <option value='Troca'>Troca</option>
                                </select>
                            </div>

                            <div class="inputGroup">

                                <input size="15" maxlength="15" type="text" name="telefone" id="telefone" onkeyup="busc(this)" value="">
                                <label>Telefone</label>

                            </div>


                            <div class="inputGroup">

                                <p class="label_select">Status</p>

                                <select name="filtro_status" oninput="busc(this)">

                                    <option value=""></option>

                                    <?php

                                    $sql_status__ = mysqli_query($conexao, "select status from base_os GROUP BY status;") or die($mysqli_error);

                                    while ($status = $sql_status__->fetch_assoc()) { ?>

                                        <option value='<?php echo $status['status']; ?>'>

                                            <?php echo $status['status']; ?></option>

                                    <?php } ?>

                                </select>
                            </div>
                            <div class="inputGroup">
                                <input size="7" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_NF"
                                    value="">
                                <label>Nº NF </label>
                            </div>

                            <div class="inputGroup">
                                <input size="45" minlength="0" maxlength="45" type="date" name="d_entrega" id="d_entrega"
                                    value='' oninput="busc(this)">
                                <label for="">Entrega</label>
                            </div>


                            <div class="inputGroup">
                                <input size="45" minlength="0" maxlength="45" type="date" name="d_retirada" id="d_retirada"
                                    value='' oninput="busc(this)">
                                <label for="">Retirada</label>
                            </div>
                            <button input type="reset" onclick="busc(this)" name="limpar" class="btn_filtro">LIMPAR</button>
                        </div>





                    </form>
                </div> -->
            </div>

            <div class="acoes_tabela_">
                <div class="mydict no_motorista">
                    <div class="mydict_div_base_pedido">
                        <label id="">
                            <input type="radio" class="select_se" name="MUNDIAL"
                                onclick="window.location.href='tipo_se_select.php?YSTRATEGY '"
                                <?php if ($_SESSION['TIPO_SE'] == 'YSTRATEGY') echo "checked"; ?>>
                            <span>YSTRATEGY</span>
                        </label>

                        <label>
                            <input type="radio" class="select_se" name="FORMIGA"
                                onclick="window.location.href='tipo_se_select.php?FORMIGA'"
                                <?php if ($_SESSION['TIPO_SE'] == 'OUTROS') echo "checked"; ?>>
                            <span>OUTROS</span>
                        </label>
                    </div>
                </div>

                <button input type="reset" onclick="busc(this)" name="limpar" class="btn_filtro">LIMPAR FILTRO RÁPIDO TABELA</button>
            </div>


            <div class="tabela-base">
                <table class="table-wrapper">

                    <thead>

                        <tr>

                            <th style="text-align:center">

                                Nº</th>

                            <th style="text-align:center">Colocação<br>Troca</th>

                            <th style="text-align:center">Data Entrega</th>

                            <th style="text-align:center">Cliente</th>

                            <th style="text-align:center">Data Retirada</th>

                            <th style="text-align:center">Motorista</th>

                            <th style="text-align:center">Aterro</th>

                            <th style="text-align:center">Período</th>

                            <th style="text-align:center">Endereço</th>

                            <th style="text-align:center">Nº Ende</th>

                            <th style="text-align:center">Bairro</th>

                            <th style="text-align:center">Complemento</th>

                            <th style="text-align:center">Cep</th>

                            <th style="text-align:center">Telefone</th>

                            <th style="text-align:center">Comentário</th>

                            <th style="text-align:center">Troca</th>

                            <th style="text-align:center">Caçamba</th>

                            <th style="text-align:center">Tipo Caçamba</th>


                            <th style="text-align:center">Status</th>


                            <th style="text-align:center" class="th_financeiro">Valor esperado</th>

                            <th style="text-align:center" class="th_financeiro">Valor pago</th>

                            <th style="text-align:center" class="th_financeiro">Forma Pagamento </th>

                            <th style="text-align:center" class="th_financeiro">Nota Fiscal</th>

                            <th style="text-align:center" class="th_financeiro">Tipo Nota</th>

                            <th style="text-align:center" class="th_financeiro">Banco</th>

                            <th style="text-align:center" class="th_financeiro">Status Pagamento</th>

                            <th style="text-align:center" class="th_financeiro">Data Emissão</th>

                            <th style="text-align:center" class="th_financeiro">Data Vencimento</th>

                            <th style="text-align:center" class="th_financeiro">Data Pagamento</th>

                            <th style="text-align:center">Tipo Serviço</th>

                        </tr>

                    </thead>

                    <tbody>
                        <tr class="filtros_on_table">
                            <td>
                                <!-- n° -->
                                <div class="inputGroup table_f_in">
                                    <input size="" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_pedido"
                                        value="">
                                    <label>Nº</label>
                                </div>
                            </td>

                            <td>
                                <!-- colocaco/troca -->
                                <div class="inputGroup table_f_in">

                                    <!-- <p class="label_select">Colocação/Troca</p>; -->

                                    <select name="filtro_tipoOS" oninput="busc(this)">

                                        <option value=""></option>
                                        <option value='Colocacao'>Colocação</option>
                                        <option value='Troca'>Troca</option>
                                    </select>
                                </div>

                            </td>
                            <td>
                                <!-- data entrega -->
                                <div class="inputGroup table_f_in">
                                    <input size="3" minlength="0" maxlength="45" type="date" name="d_entrega" id="d_entrega"
                                        value='' oninput="busc(this)">

                                </div>
                            </td>
                            <td>
                                <!-- cliente -->
                                <div class="inputGroup table_f_in">
                                    <input size="15" onkeyup="maiuscula(this); busc(this)" maxlength="45" type="name" name="filtro_nome_pedido"
                                        value="">

                                </div>
                            </td>
                            <td>
                                <!-- d_retirada -->
                                <div class="inputGroup table_f_in">
                                    <input minlength="0" maxlength="45" type="date" name="d_retirada" id="d_retirada"
                                        value='' oninput="busc(this)">

                                </div>

                            </td>
                            <td>
                                <!-- motorista -->
                                <div class="inputGroup table_f_in">
                                    <select id="motorista" name="filtro_motorista" oninput="busc(this)" required>
                                        <option value=""></option>
                                        <?php
                                        $sql_c_motorista__ = mysqli_query($conexao, "select * from base_motorista") or die($mysqli_error);
                                        while ($b_motorista = $sql_c_motorista__->fetch_assoc()) {
                                            $i =  explode(' ', $b_motorista['nome_motorista']);
                                            $moto = $i[0];
                                        ?>

                                            <option value='<?php echo $b_motorista['nome_motorista']; ?>'>

                                                <?php echo $moto ?></option>

                                        <?php } ?>

                                    </select>

                                </div>

                            </td>

                            <td>
                                <!-- Aterro -->
                                <div class="inputGroup table_f_in">



                                    <select name="filtro_aterro_pedido" oninput="busc(this)">

                                        <option value=""></option>



                                        <?php
                                        $aterros_f__ = mysqli_query($conexao, "select * from base_aterro") or die($mysqli_error);


                                        while ($p_aterro_f = $aterros_f__->fetch_assoc()) { ?>
                                            <option value='<?php
                                                            if ($p_aterro_f['Nome_aterro'] == 'EM_OBRA') {
                                                                echo '---';
                                                            } else {
                                                                echo $p_aterro_f['Nome_aterro'];
                                                            } ?>'>

                                                <?php
                                                echo $p_aterro_f['Nome_aterro'];

                                                ?>
                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                            </td>
                            <td>
                                <!-- periodo -->
                                <div class="inputGroup table_f_in">
                                    <select id="periodo" name="f_periodo" oninput="busc(this)">
                                        <option value=""></option>
                                        <option value="DIURNO">DIURNO</option>
                                        <option value="NOTURNO">NOTURNO</option>

                                    </select>

                                </div>

                            </td>
                            <td>
                                <!-- endereco -->
                                <div class="inputGroup table_f_in">

                                    <input onkeyup="busc(this)" maxlength="45" type="name" name="filtro_endereco_pedido"
                                        value="">
                                </div>

                            </td>
                            <td>
                                <!-- nº ende -->
                                <div class="inputGroup table_f_in">

                                    <input size="7" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_n_ende"
                                        value="">

                                </div>

                            </td>
                            <td>
                                <!-- bairro -->
                                <div class="inputGroup table_f_in">

                                    <input size="10" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_bairro"
                                        value="">

                                </div>

                            </td>

                            <td>
                                <!-- complemento -->
                                <div class="inputGroup table_f_in">

                                    <input size="7" onkeyup="busc(this)" maxlength="45" type="name" name="f_complemento"
                                        value="">

                                </div>

                            </td>
                            <td>
                                <!-- cep -->
                                <div class="inputGroup table_f_in">

                                    <input onkeyup="busc(this)" type="name" name="f_cep"
                                        value="">

                                </div>

                            </td>
                            <td>
                                <!-- telefone -->
                                <div class="inputGroup table_f_in">

                                    <input maxlength="15" type="text" name="telefone" id="telefone" onkeyup="busc(this)" value="">

                                </div>

                            </td>
                            <td>
                                <!-- comentario -->
                                <div class="inputGroup table_f_in">

                                    <input maxlength="15" type="text" name="f_comentario" id="f_comentario" onkeyup="busc(this)" value="">

                                </div>

                            </td>
                            <td>
                                <!-- troca -->
                                <div class="inputGroup table_f_in">
                                    <input maxlength="15" type="text" name="f_troca" id="f_troca" onkeyup="busc(this)" value="">
                                </div>
                            </td>

                            <td>
                                <!-- cacamba  -->
                                <div class="inputGroup table_f_in">


                                    <div class="inputGroup table_f_in">
                                        <input minlength="0" maxlength="45" type="text" name="f_cacamba" id="cacamba"
                                            value='' oninput="busc(this)">

                                    </div>

                                </div>
                            </td>
                            <td>
                                <!-- tipo cacamba  -->
                                <div class="inputGroup table_f_in">

                                    <select name="f_tipo_c" class='tipo_c' oninput="busc(this)" required>
                                        <option value=""></option>
                                        <option value='---'>---</option>
                                        <option value='MUNDIAL'>MUNDIAL</option>
                                        <option value='FORMIGA'>FORMIGA</option>
                                    </select>
                                </div>

                            </td>
                            <td>
                                <!-- status-->
                                <div class="inputGroup table_f_in">
                                    <select name="filtro_status" oninput="busc(this)">

                                        <option value=""></option>

                                        <?php

                                        $sql_status__ = mysqli_query($conexao, "select status from base_os GROUP BY status;") or die($mysqli_error);

                                        while ($status = $sql_status__->fetch_assoc()) { ?>

                                            <option value='<?php echo $status['status']; ?>'>

                                                <?php echo $status['status']; ?></option>

                                        <?php } ?>

                                    </select>
                                </div>
                            </td>
                            <td>
                                <!-- val esperado  -->
                                <div class="inputGroup table_f_in">


                                    <div class="inputGroup table_f_in">
                                        <input minlength="0" maxlength="45" type="text" name="f_valor" id="f_valor"
                                            value='' oninput="busc(this)">

                                    </div>

                                </div>

                            </td>
                            <td>
                                <!-- val pago  -->
                                <div class="inputGroup table_f_in">

                                    <input minlength="0" maxlength="45" type="text" name="f_val_pago" id="f_val_pago"
                                        value='' oninput="busc(this)">

                                </div>

                            </td>
                            <td>
                                <!-- Aterro -->
                                <div class="inputGroup table_f_in">



                                    <select name="f_form_pag" oninput="busc(this)">

                                        <option value=""></option>

                                        <option value="avista">A vista</option>

                                        <option value="BOLETO">Boleto</option>

                                        <option value="Faturado">Faturado</option>

                                        <option value="Antecipado">Antecipado</option>

                                        <option value="Pix">Pix à vista</option>

                                        <option value="TRANSFERÊNCIA">Transferencia à vista</option>

                                    </select>

                                </div>

                            </td>
                            <td>
                                <!-- num nota  -->
                                <div class="inputGroup table_f_in">



                                    <input minlength="0" maxlength="45" type="text" name="f_num_nota" id="f_num_nota"
                                        value='' oninput="busc(this)">

                                </div>

                            </td>
                            <td>
                                <!-- tipo nota  -->
                                <div class="inputGroup table_f_in">

                                    <select name="f_tipo_nota" class='tipo_nota' oninput="busc(this)" required>
                                        <option value=""></option>

                                        <option value='NF'>NF</option>
                                        <option value='RECIBO'>RECIBO</option>
                                    </select>
                                </div>

                            </td>
                            <td>
                                <!-- tipo nota  -->
                                <div class="inputGroup table_f_in">


                                    <select id="banco" name="f_banco" oninput="busc(this)">

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

                            </td>

                            <td>
                                <!-- status pag  -->
                                <div class="inputGroup table_f_in">

                                    <select name="f_status_pag" class='status_pag' oninput="busc(this)" required>
                                        <option value=""></option>

                                        <option value='SIM'>SIM</option>
                                        <option value='NÃO'>NÃO</option>
                                    </select>
                                </div>

                            </td>
                            <td>
                                <!-- d_emissao -->
                                <div class="inputGroup table_f_in">
                                    <input minlength="0" maxlength="45" type="date" name="f_d_emissao" id="d_emissao"
                                        value='' oninput="busc(this)">

                                </div>

                            </td>
                            <td>
                                <!-- d_vencimento -->
                                <div class="inputGroup table_f_in">
                                    <input minlength="0" maxlength="45" type="date" name="f_d_vencimento" id="d_vencimento"
                                        value='' oninput="busc(this)">

                                </div>

                            </td>
                            <td>
                                <!-- d_pag-->
                                <div class="inputGroup table_f_in">
                                    <input minlength="0" maxlength="45" type="date" name="f_d_pag" id="d_pag"
                                        value='' oninput="busc(this)">

                                </div>

                            </td>
                            <td>
                                <!-- tipo_servico -->
                                <div class="inputGroup table_f_in">
                                    <!-- ------ -->
                                </div>

                            </td>


                        </tr>
                        <?php
                        $i = 0;
                        while ($ped = $base_os_g->fetch_assoc()) {

                            $n = explode(' ', $ped['motorista']);

                            $pN = $n[0]; // 'Carlos'
                            $i++;
                        ?>

                            <tr class="tr_tabela">



                                <td class="num_pedido" style="text-align:center">

                                    <?php echo $ped['num_pedido']; ?>

                                </td>

                                <td class="tipo_os"><?php echo $ped['tipo_os']; ?></td>


                                <td class="d_entrega"><?php echo date('d/m/Y', strtotime($ped['data_entrega'])) ?>

                                </td>

                                <td class="filtro_nome_pedido"><?php echo $ped['nome_cliente']; ?></td>

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
                                <td style="text-align:center" class="periodo">
                                    <?php

                                    echo $ped['periodo'];
                                    ?>
                                </td>



                                <td class="filtro_endereco_pedido"><?php echo $ped['Endereco']; ?></td>

                                <td class="numero"><?php echo $ped['numero']; ?></td>

                                <td class="bairro"><?php echo $ped['bairro']; ?></td>

                                <td class="complemento"><?php echo $ped['complemento']; ?></td>

                                <td class="cep"><?php echo $ped['cep']; ?></td>

                                <td class="telefone"><?php echo $ped['telefone']; ?></td>

                                <td class="comentario"><?php echo $ped['obs']; ?></td>

                                <td class="troca"><?php
                                                    if ($ped['troca'] == '') {
                                                        echo '-';
                                                    } else {
                                                        echo $ped['troca'];
                                                    }
                                                    ?></td>


                                <td class="cacamba"><?php
                                                    if ($ped['cacamba'] == '') {
                                                        echo '-';
                                                    } else {
                                                        echo $ped['cacamba'];
                                                    }
                                                    ?></td>

                                <td class="tipo_cacamba"><?php
                                                            if ($ped['tipo_cacamba'] == '') {
                                                                echo '---';
                                                            } else {
                                                                echo $ped['tipo_cacamba'];
                                                            } ?>
                                </td>


                                <td class="status_"><?php echo $ped['status']; ?></td>

                                <td class="valor"><?php echo $ped['valor']; ?></td>

                                <td class="val_pago"><?php if ($ped['valor_pago'] != null)
                                                            echo $ped['valor_pago'];
                                                        else echo 0;
                                                        ?></td>

                                <td class="forma_pag"><?php echo $ped['for_pag']; ?></td>

                                <td class="num_nota"><?php
                                                        if ($ped['num_nota'] != null) {
                                                            echo $ped['num_nota'];
                                                        } else {
                                                            echo '---';
                                                        } ?>
                                    </tdclass>

                                <td class="tipo_nota"><?php echo $ped['tipo_nota']; ?></td>

                                <td class="banco"><?php echo $ped['banco']; ?></td>

                                <td style="text-align:center" class="status_pag">

                                    <?php echo $ped['status_pagamento']; ?>

                                </td>


                                <td class="d_emissao"><?php
                                                        if ($ped['data_emissao'] != null) {
                                                            echo date('d/m/Y', strtotime($ped['data_emissao']));
                                                        } else {
                                                            echo ' ---- ';
                                                        }

                                                        ?> </tdclas>
                                <td class="d_vencimento"><?php
                                                            if ($ped['data_vencimento'] != null) {
                                                                echo date('d/m/Y', strtotime($ped['data_vencimento']));
                                                            } else {
                                                                echo ' ---- ';
                                                            }

                                                            ?> </td>
                                <td class="d_pag"><?php
                                                    if ($ped['data_pagamento'] != null) {
                                                        echo date('d/m/Y', strtotime($ped['data_pagamento']));
                                                    } else {
                                                        echo ' ---- ';
                                                    }

                                                    ?> </td>
                                <td><?php echo $ped['tipo_servico']; ?></td>



                            </tr>



                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>
        <?php include('rodape.php'); ?>
    </div>




    <script src="./js/mudar.js"></script>

    <script src="./js/jquery.min.js"></script>

    <script src="./js/jquery-ui.min.js"></script>

    <script src="./js/jquery-ui.multidatespicker.js"></script>


    <script type='text/javascript'>
        $(document).ready(function() {

            $("input[name='num_pedido']").blur(function() {

                var $endereco = $("input[name='endereco']");

                var $nome_cliente_pedido = $("input[name='nome_cliente_pedido']");

                var $nome_cliente_pedido2 = $("input[name='nome_cliente_pedido2']");

                var $codigo_cliente_pedido = $("input[name='codigo_cliente_pedido']");

                var $cep = $("input[name='cep']");

                var $Numero = $("input[name='Numero']");

                var $complemento = $("input[name='complemento']");

                var $bairro = $("input[name='bairro']");

                var $municipio = $("input[name='municipio']");

                var $valor = $("input[name='valor']");

                var $comentario = $("input[name='comentario']");

                var $status = $("input[name='status']");

                var $num_pedido = $("input[name='num_ped']");

                var $motorista = $("select[name='motorista']");

                var $telefone_cliente_pedido = $("input[name='telefone_cliente_pedido']");

                var $id_cliente = $("input[name='id_cliente']");

                var $credito_cliente = $("input[name='for_pag']");

                var $tipo_valor = $("input[name='tipo_valor']");

                var $tipo_se = $("select[name='tipo_se']");



                $.getJSON('func_copia.php', {

                    matricula: $(this).val()

                }, function(json) {

                    $endereco.val(json.endereco);

                    $nome_cliente_pedido.val(json.nome_cliente_pedido);

                    $nome_cliente_pedido2.val(json.nome_cliente_pedido);

                    $codigo_cliente_pedido.val(json.codigo_cliente_pedido);

                    $cep.val(json.cep);

                    $Numero.val(json.Numero);

                    $complemento.val(json.complemento);

                    $bairro.val(json.bairro);

                    $municipio.val(json.municipio);

                    $valor.val(json.valor);

                    $comentario.val(json.comentario);

                    $status.val(json.status);

                    $num_pedido.val(json.num_pedido);

                    $motorista.val(json.motorista);

                    $telefone_cliente_pedido.val(json.telefone_cliente_pedido);

                    $id_cliente.val(json.id_cliente);

                    $credito_cliente.val(json.for_pag);

                    $tipo_valor.val(json.tipo_valor);

                    $tipo_se.val(json.tipo_servico);



                });

            });

        });

        let obj_filtro = {
            pedido: "",
            nome_c: "",
            bairro: "",
            n_ende: "",
            ende: "",
            complemento: "",
            cep: "",
            tipoOS: "",
            moto: "",
            status: "",
            data_en: "",
            data_ret: "",
            aterro: "",
            telefone: "",
            cacamba: "",
            tipo_cacamba: "",
            valor: "",
            val_pago: "",
            forma_pag: "",
            num_nota: "",
            num_nota: "",
            tipo_nota: "",
            status_pag: "",
            d_vencimento: "",
            d_emissao: "",
            d_pag: "",
            comentario: "",
            troca: "",
            banco: "",
            periodo: "",
            nf: ""
        };



        function busc(input) {
            var tr_tabela = document.getElementsByClassName("tr_tabela");
            var td_nome = document.getElementsByClassName(input.name);
            // console.log(obj_filtro);

            // console.log(tr_tabela[0].getElementsByClassName("filtro_nome_pedido")[0]);


            switch (input.name) {

                case 'filtro_endereco_pedido':
                    obj_filtro.ende = input.value.toLowerCase();


                    break;
                case 'filtro_motorista':

                    var selectedOption = input.options[input.selectedIndex].value;
                    console.log(selectedOption);
                    var primeiroNome = selectedOption.split(' ')[0];

                    obj_filtro.moto = primeiroNome.toLowerCase();


                    break;

                case 'filtro_status':
                    var selectedOption = input.options[input.selectedIndex].value;

                    obj_filtro.status = selectedOption.toLowerCase();

                    break;
                case 'filtro_tipoOS':
                    var selectedOption = input.options[input.selectedIndex].value;

                    obj_filtro.tipoOS = selectedOption.toLowerCase();

                    break;
                case 'd_entrega':
                    var partesData = input.value.split('-');
                    var dataFormatada = partesData[2] + '/' + partesData[1] + '/' + partesData[0];
                    obj_filtro.data_en = dataFormatada;

                    break;

                case 'd_retirada':
                    var partesData = input.value.split('-');
                    var dataFormatada = partesData[2] + '/' + partesData[1] + '/' + partesData[0];
                    obj_filtro.data_ret = dataFormatada;


                    break;
                case 'filtro_pedido':
                    obj_filtro.pedido = input.value.toLowerCase();



                    break;
                case 'filtro_nome_pedido':
                    obj_filtro.nome_c = input.value.toLowerCase();

                    break;
                case 'filtro_bairro':
                    obj_filtro.bairro = input.value.toLowerCase();

                    break;
                case 'filtro_n_ende':
                    obj_filtro.n_ende = input.value.toLowerCase();

                    break;
                case 'filtro_aterro_pedido':
                    obj_filtro.aterro = input.value.toLowerCase();

                    break;
                case 'filtro_NF':
                    obj_filtro.nf = input.value.toLowerCase();

                    break;
                case 'f_complemento':
                    obj_filtro.complemento = input.value.toLowerCase();

                    break;
                case 'f_cep':
                    obj_filtro.cep = input.value.toLowerCase();

                    break;
                case 'telefone':
                    obj_filtro.telefone = input.value.toLowerCase();

                    break;
                case 'f_cacamba':
                    obj_filtro.cacamba = input.value.toLowerCase();
                case 'f_tipo_c':
                    obj_filtro.tipo_cacamba = input.value.toLowerCase();

                    break;
                case 'f_valor':
                    obj_filtro.valor = input.value.toLowerCase();

                    break;
                case 'f_val_pago':
                    obj_filtro.val_pago = input.value.toLowerCase();

                    break;
                case 'f_form_pag':
                    obj_filtro.forma_pag = input.value.toLowerCase();

                    break;
                case 'f_num_nota':
                    obj_filtro.forma_pag = input.value.toLowerCase();

                    break;
                case 'f_tipo_nota':
                    obj_filtro.tipo_nota = input.value.toLowerCase();

                    break;
                case 'f_status_pag':
                    obj_filtro.status_pag = input.value.toLowerCase();

                    break;
                case 'f_d_pag':
                    var partesData = input.value.split('-');
                    var dataFormatada = partesData[2] + '/' + partesData[1] + '/' + partesData[0];
                    obj_filtro.d_pag = dataFormatada;


                    break;
                case 'f_d_vencimento':

                    var partesData = input.value.split('-');
                    var dataFormatada = partesData[2] + '/' + partesData[1] + '/' + partesData[0];
                    obj_filtro.d_vencimento = dataFormatada;

                    break;
                case 'f_d_emissao':
                    var partesData = input.value.split('-');
                    var dataFormatada = partesData[2] + '/' + partesData[1] + '/' + partesData[0];

                    obj_filtro.d_emissao = dataFormatada;

                    break;
                case 'f_comentario':
                    obj_filtro.comentario = input.value.toLowerCase();
                    break;
                case 'f_troca':
                    obj_filtro.troca = input.value.toLowerCase();
                    break;

                case 'f_banco':
                    obj_filtro.banco = input.value.toLowerCase();
                    break;
                case 'f_periodo':
                    obj_filtro.periodo = input.value.toLowerCase();
                    break;

                case 'limpar':
                    obj_filtro.data_en = ""
                    obj_filtro.data_ret = ""
                    obj_filtro.moto = ""
                    obj_filtro.status = ""
                    obj_filtro.tipoOS = ""
                    obj_filtro.bairro = ""
                    obj_filtro.n_ende = ""
                    obj_filtro.nome_c = ""
                    obj_filtro.pedido = ""
                    obj_filtro.aterro = ""
                    obj_filtro.nf = ""
                    obj_filtro.ende = ""
                    obj_filtro.complemento = ""
                    obj_filtro.cep = ""
                    obj_filtro.telefone = ""
                    obj_filtro.cacamba = ""
                    obj_filtro.tipo_cacamba = ""
                    obj_filtro.valor = ""
                    obj_filtro.val_pago = ""
                    obj_filtro.forma_pag = ""
                    obj_filtro.num_nota = ""
                    obj_filtro.tipo_nota = ""
                    obj_filtro.status_pag = ""
                    obj_filtro.d_vencimento = ""
                    obj_filtro.d_emissao = ""
                    obj_filtro.d_pag = ""
                    obj_filtro.comentario = ""
                    obj_filtro.troca = ""
                    obj_filtro.banco = ""
                    obj_filtro.periodo = ""

                    document.querySelectorAll('.table_f_in').forEach(div => {
                        div.querySelectorAll('input, select, textarea').forEach(element => {
                            if (element.tagName === 'SELECT') {
                                element.selectedIndex = 0; // Reseta para a primeira opção
                            } else {
                                element.value = ''; // Limpa inputs e textareas
                            }
                        });
                    });


                    break;
                default:
                    break;
            }

            console.log(obj_filtro);

            for (let index = 0; index < tr_tabela.length; index++) {
                // const nome_c = td_nome[index].innerHTML
                const linha = tr_tabela[index]
                var status__ = linha.getElementsByClassName('status_')[0].innerHTML.toLowerCase()
                var entrega__ = linha.getElementsByClassName('d_entrega')[0].innerHTML.toLowerCase()
                var ende__ = linha.getElementsByClassName('filtro_endereco_pedido')[0].innerHTML.toLowerCase()
                var retirada__ = linha.getElementsByClassName('d_retirada')[0].innerHTML.toLowerCase()
                var motorista__ = linha.getElementsByClassName('filtro_motorista')[0].innerHTML.toLowerCase()
                var os__ = linha.getElementsByClassName('tipo_os')[0].innerHTML.toLowerCase()

                var n_ped = linha.getElementsByClassName('num_pedido')[0].innerHTML.toLowerCase()
                var nome__ = linha.getElementsByClassName('filtro_nome_pedido')[0].innerHTML.toLowerCase()
                var bairro__ = linha.getElementsByClassName('bairro')[0].innerHTML.toLowerCase()
                var n_ende__ = linha.getElementsByClassName('numero')[0].innerHTML.toLowerCase()
                var aterro__ = linha.getElementsByClassName('filtro_aterro_pedido')[0].innerHTML.toLowerCase()
                var complemento__ = linha.getElementsByClassName('complemento')[0].innerHTML.toLowerCase()
                var cep__ = linha.getElementsByClassName('cep')[0].innerHTML.toLowerCase()
                var telefone__ = linha.getElementsByClassName('telefone')[0].innerHTML.toLowerCase()
                var cacamba__ = linha.getElementsByClassName('cacamba')[0].innerHTML.toLowerCase()
                var tipo_cacamba__ = linha.getElementsByClassName('tipo_cacamba')[0].innerHTML.toLowerCase()
                var valor__ = linha.getElementsByClassName('valor')[0].innerHTML.toLowerCase()
                var val_pago__ = linha.getElementsByClassName('val_pago')[0].innerHTML.toLowerCase()
                var forma_pag__ = linha.getElementsByClassName('forma_pag')[0].innerHTML.toLowerCase()
                var num_nota___ = linha.getElementsByClassName('num_nota')[0].innerHTML.toLowerCase()
                var tipo_nota___ = linha.getElementsByClassName('tipo_nota')[0].innerHTML.toLowerCase()
                var status_pag___ = linha.getElementsByClassName('status_pag')[0].innerHTML.toLowerCase()
                var d_emissao___ = linha.getElementsByClassName('d_emissao')[0].innerHTML.toLowerCase()
                var d_vencimento___ = linha.getElementsByClassName('d_vencimento')[0].innerHTML.toLowerCase()
                var d_pag___ = linha.getElementsByClassName('d_pag')[0].innerHTML.toLowerCase()
                var comentario___ = linha.getElementsByClassName('comentario')[0].innerHTML.toLowerCase()
                var troca___ = linha.getElementsByClassName('troca')[0].innerHTML.toLowerCase()
                var banco___ = linha.getElementsByClassName('banco')[0].innerHTML.toLowerCase()
                var periodo___ = linha.getElementsByClassName('periodo')[0].innerHTML.toLowerCase()

                var nf__ = linha.getElementsByClassName('num_nota')[0].innerHTML.toLowerCase()

                if (ende__.includes(obj_filtro.ende) && status__.includes(obj_filtro.status) &&
                    entrega__.includes(obj_filtro.data_en) && retirada__.includes(obj_filtro.data_ret) && motorista__.includes(obj_filtro.moto) &&
                    os__.includes(obj_filtro.tipoOS) && n_ped.includes(obj_filtro.pedido) && nome__.includes(obj_filtro.nome_c) &&
                    bairro__.includes(obj_filtro.bairro) && n_ende__.includes(obj_filtro.n_ende) && aterro__.includes(obj_filtro.aterro) && nf__.includes(obj_filtro.nf) &&
                    complemento__.includes(obj_filtro.complemento) && cep__.includes(obj_filtro.cep) && telefone__.includes(obj_filtro.telefone) && cacamba__.includes(obj_filtro.cacamba) &&
                    tipo_cacamba__.includes(obj_filtro.tipo_cacamba) && valor__.includes(obj_filtro.valor) && val_pago__.includes(obj_filtro.val_pago) && forma_pag__.includes(obj_filtro.forma_pag) &&
                    num_nota___.includes(obj_filtro.num_nota) && status_pag___.includes(obj_filtro.status_pag) && tipo_nota___.includes(obj_filtro.tipo_nota) && d_emissao___.includes(obj_filtro.d_emissao) &&
                    d_vencimento___.includes(obj_filtro.d_vencimento) && d_pag___.includes(obj_filtro.d_pag) && comentario___.includes(obj_filtro.comentario) && troca___.includes(obj_filtro.troca) &&
                    banco___.includes(obj_filtro.banco) &&  periodo___.includes(obj_filtro.periodo)
                ) {
                    linha.style.display = "table-row";

                } else {
                    linha.style.display = "none";
                }

            }

        }

        $(document).ready(function() {

            $("input[name='c_r_ped']").blur(function() {

                var $c_r_cliente = $("input[name='c_r_cliente']");

                var $c_r_endereco = $("input[name='c_r_endereco']");

                var $total = $("input[name='total']");

                var $credito_cliente = $("input[name='for_pag']");

                var $tipo_valor = $("input[name='tipo_valor']");

                var $tipo_se = $("select[name='tipo_se']");





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

        function fix_ped(fix_ped) {
            var quadro_peds = document.getElementById("pedidos_div")
            if (fix_ped.checked) {
                quadro_peds.style.position = "sticky";
            } else {
                quadro_peds.style.position = "relative";
            }

        }

        function fix_con(fix_con) {
            var quadro_peds = document.getElementById("contas_div")
            if (fix_con.checked) {
                quadro_peds.style.position = "sticky";
            } else {
                quadro_peds.style.position = "relative";
            }

        }


        let i = 1

        function divAcao() {
            i = i * (-1)
        }

        function maxmize(btn) {
            var minimize = btn.parentElement.parentElement.getElementsByClassName('minimize')[0];
            console.log(i);

            if (i < 0) {
                btn.style = "scale: 1; font-size=100%; transition: 0.3s;"
                btn.innerHTML = "➕"
                minimize.style = "height: 0; overflow-y: hidden;"
            } else {
                btn.style = "scale: 0.5; font-size=3rem; transition: 0.3s;"
                btn.innerHTML = "➖"
                minimize.style = "height: auto; overflow-y: visible; "
            }




        };


        let acesso = "<?php echo $_SESSION['ACESSO']; ?>"; // Obtém o valor da sessão
        let select = document.getElementById("tipo_se");
        let radio_se = document.getElementsByClassName('select_se');

        if (acesso != "ADMIN" && acesso != "USER") {
            // Percorre todas as opções e remove as que não são iguais ao valor da sessão
            Array.from(select.options).forEach(option => {
                if (option.value !== "" && option.value !== acesso) {
                    option.remove(); // Remove a opção que não é permitida
                }
            });

            // Se apenas um valor estiver disponível, já o seleciona
            if (select.options.length === 2) {
                select.selectedIndex = 1;
            }

            document.getElementById('contas_div').style.display = 'none'

            for (let i = 0; i < radio_se.length; i++) {
                const servicos = radio_se[i];
                if (servicos.name != acesso) {
                    servicos.parentElement.remove()
                }
            }
        }
    </script>

</body>