<!DOCTYPE html>

<html lang="pt-br">



<head>

    <!-- <link rel="stylesheet" href="./css/reset.css"> -->

    <link rel="stylesheet" href="./css/indexm.css">
    <link rel="stylesheet" href="./css/servicos_m.css">
    <!-- <link rel="stylesheet" href="./css/servicos_m.css"> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./logo/logo (1).ico" type="image/x-icon">
    <title>Mundial Entulhos / Cadastros</title>

</head>



<?php


include('menu.php');
include('conexao.php');

?>





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
<script>
    function filtro_m_servicos(motorista) {
        document.getElementById("div_menu").style.display = 'none'
        document.getElementById("tr_totais").style.display = 'none'
        document.getElementById("sair_m").style.display = 'block'
        var motorista_tr = document.getElementsByClassName("motorista_tr")
        var coluna_motorista = document.getElementsByClassName("tabela-resumo1")



        for (let index = 0; index < motorista_tr.length; index++) {
            // console.log("for");
            const LINHA = motorista_tr[index];
            let td = 0;
            while (td < LINHA.getElementsByTagName('td').length) {
                if (LINHA.getElementsByTagName('td')[td].innerHTML.includes(motorista)) {
                    LINHA.style.removeProperty("display");
                    td = LINHA.getElementsByTagName('td').length
                    // td = motorista_tr.getElementsByTagName('td').length

                } else {
                    LINHA.style.display = 'none'
                }
                td++
            }
        }
        for (let index = 0; index < coluna_motorista.length; index++) {
            console.log("for");
            const COLUNA_M = coluna_motorista[index];

            if (COLUNA_M.getElementsByTagName('th')[0].innerHTML.includes(motorista)) {
                COLUNA_M.style.removeProperty("display");
                //  = COLUNA_M.getElementsByTagName('td').length
                // td = motorista_tr.getElementsByTagName('td').length

            } else {
                COLUNA_M.style.display = 'none'
            }



        }

    }


    function totais_Tresumo() {
        var td_entregas = document.getElementsByClassName("td_entregas");
        var td_trocas = document.getElementsByClassName("td_trocas");
        var td_retiradas = document.getElementsByClassName("td_retiradas");
        var td_totais = document.getElementsByClassName("td_totais");
        var val_entregas = 0;
        var val_trocas = 0;
        var val_retiradas = 0;
        var val_totais = 0;

        // Preencher a coluna "Total" em cada linha
        for (let index = 0; index < td_totais.length; index++) {
            const entregas = parseInt(td_entregas[index].innerHTML) || 0;
            const trocas = parseInt(td_trocas[index].innerHTML) || 0;
            const retiradas = parseInt(td_retiradas[index].innerHTML) || 0;
            const total = entregas + trocas + retiradas;

            td_totais[index].innerHTML = total; // Preenche o total na coluna
        }

        // Calcular os totais gerais para a última linha
        for (let index = 0; index < td_entregas.length; index++) {
            val_entregas += parseInt(td_entregas[index].innerHTML) || 0;
        }
        for (let index = 0; index < td_trocas.length; index++) {
            val_trocas += parseInt(td_trocas[index].innerHTML) || 0;
        }
        for (let index = 0; index < td_retiradas.length; index++) {
            val_retiradas += parseInt(td_retiradas[index].innerHTML) || 0;
        }
        for (let index = 0; index < td_totais.length; index++) {
            val_totais += parseInt(td_totais[index].innerHTML) || 0;
        }
        // Atualizar a última linha com os totais
        document.getElementById("td_Tentregas").innerHTML = val_entregas;
        document.getElementById("td_Ttrocas").innerHTML = val_trocas;
        document.getElementById("td_Tretiradas").innerHTML = val_retiradas;
        document.getElementById("td_TTotais").innerHTML = val_totais;
    }
</script>




<?php




$C_D_I_F1 =  mysqli_query($conexao, "select * from consulta where entrega <> '' and tabela = 'servico'") or die($mysqli_error);

while ($arquivos1 = $C_D_I_F1->fetch_assoc()) {

    $im = $arquivos1['entrega'];

    $Q = "SELECT * FROM `consulta` WHERE entrega <> '' and tabela = 'servico' ";

    $R = mysqli_query($conexao, $Q);

    $row11 = mysqli_num_rows($R);

    $hoje = date('Y,m,d');
}





// $pedidos_aberto2 =  mysqli_query($conexao, "select * from base_os where data_entrega = '$im' and  (data_retirada = '$im' and status <> 'Entregue')    GROUP BY motorista    order by motorista") or die($mysqli_error);







// $pedidos_aberto = mysqli_query($conexao, "select  motorista,aterro,status,tipo_os,data_entrega,data_retirada,Endereco,numero,complemento,(select num_pedido from base_os a where  data_retirada = '$im' and a.num_pedido = x.num_pedido and a.motorista = x.motorista and a.codigo_cliente = x.codigo_cliente)as Ped_ret,(select obs from base_os b where b.num_pedido = x.num_pedido and b.motorista = x.motorista and (data_entrega = '$im' or data_retirada = '$im') and b.codigo_cliente = x.codigo_cliente) as comentario,(select num_pedido from base_os c where  c.num_pedido = x.num_pedido and c.motorista = x.motorista and data_entrega = '$im'  and c.codigo_cliente = x.codigo_cliente and (status = 'Entregar' or status = 'entregue') ) as Ped_ENT from base_os x where  (data_entrega = '$im' or  (data_retirada = '$im' and status <> 'Entregue') )  GROUP BY motorista order by Endereco,troca") or die($mysqli_error);
$pedidos_aberto = mysqli_query($conexao, "select * from base_os where data_entrega = '$im' OR data_retirada = '$im' group by motorista;") or die($mysqli_error);







$aterross =  mysqli_query($conexao, "select * from base_aterro order by nome_aterro") or die($mysqli_error);





?>
<div class="Box-Dashbord">
    <div class="Conteudo-Dashbord">
        <?php include('reload.php'); ?>

        <h1 class="h1_title">Resumos:</h1>

        <div class="calendario-servico no-print">

            <form action="data_consulta_servico.php?resumos" method="post">

                <h2>Ecolher data:</h2>
                <div class="inputGroup">
                    <input size="45" minlength="0" maxlength="45" type="date" name="d_inicio" id="d_inicio" value='<?php echo $im ?>' placeholder="">
                    <button input type="submit" name="acao">&nbsp;&nbsp;&nbsp;Confirmar data&nbsp;&nbsp;&nbsp;</button>
                </div>

            </form>
        </div>
        <br>
        <br>
        <div class="container_">
            <div class="">



                <table id="tabela-resumo">



                    <thead>



                        <tr>

                            <th>Motorista</th>

                            <th>&nbsp;ENTREGAS&nbsp;</th>

                            <th>&nbsp;TROCAS&nbsp;</th>

                            <th>&nbsp;RETIRADAS&nbsp;</th>

                            <th>&nbsp;Total&nbsp;</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php


                        $e_a_p_m =  mysqli_query($conexao, "
                  SELECT 
                        motorista,
                   
                        COUNT(CASE 
                                WHEN (status = 'Entregar' OR status = 'Entregue') 
                                AND tipo_os <> 'Troca' 
                                AND data_entrega = '$im' 
                                THEN 1 END) AS Entregar,

    
                                (SELECT 

                        COUNT(CASE 
                                WHEN (status = 'Retirar' OR status = 'Retirado') 
                                AND data_retirada = '$im'   
                                THEN 1 END) 
                        - COUNT(CASE 
                               WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
                                AND (tipo_os = 'Troca' OR troca != '')
                                AND (data_entrega = '$im' OR data_retirada ='$im')
                                AND (Motorista_retirada = b.motorista AND b.data_retirada = '$im') 
                                THEN 1 END)

                    FROM base_os b
                    WHERE b.Motorista_retirada = a.motorista) AS Retirar,

                        (SELECT 
                           COUNT(CASE 
                                WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
                                AND (tipo_os = 'Troca' OR troca != '')
                                AND (data_entrega = '$im' OR data_retirada ='$im')
                                AND (Motorista_retirada = b.motorista AND b.data_retirada = '$im') 
                                THEN 1 END)
                        FROM base_os b
                        WHERE b.Motorista_retirada = a.motorista) AS Trocar,

                        
                        (COUNT(CASE 
                                WHEN (status = 'Entregar' OR status = 'Entregue') 
                                AND tipo_os <> 'Troca' 
                                AND data_entrega = '$im' 
                                THEN 1 END) +
                        COUNT(CASE 
                                WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
                                AND tipo_os = 'Troca' 
                                AND data_entrega = '$im'
                                THEN 1 END) +
                        COUNT(CASE 
                                WHEN (status = 'Retirar' OR status = 'Retirado') 
                                AND tipo_os <> 'Troca'
                                AND data_retirada = '$im' 
                                THEN 1 END) 
                        - COUNT(CASE 
                                WHEN (status = 'Retirar' OR status = 'Retirado') 
                                AND (confirm_troca = '1' OR tipo_os = 'Troca')
                                AND data_entrega = '$im'
                                THEN 1 END)) AS Total
                    FROM base_os a
                    GROUP BY motorista LIMIT 50;



            ") or die($mysqli_error);


                        while ($peds = $e_a_p_m->fetch_assoc()) {

                            $n = explode(' ', $peds['motorista']);
                            $pN = $n[0]; // 'Carlos'

                        ?>

                            <tr class="motorista_tr">
                                <td><?php echo $pN; ?></td>

                                <td class="td_entregas"><?php echo $peds['Entregar']; ?></td>

                                <td class="td_trocas"><?php echo $peds['Trocar']; ?></td>

                                <td class="td_retiradas"><?php echo $peds['Retirar']; ?></td>

                                <td class="td_totais"><?php echo $peds['Total']; ?></td>
                            </tr>

                        <?php } ?>

                        <tr id="tr_totais" style="font-weight: bold;">
                            <td>TOTAIS:</td>
                            <td id="td_Tentregas"></td>
                            <td id="td_Ttrocas"></td>
                            <td id="td_Tretiradas"></td>
                            <td id="td_TTotais"></td>

                        </tr>



                    </tbody>

                </table>


            </div>


            &nbsp;&nbsp;&nbsp;
            <!-- <div class="formulario_pesquisa_aterro_" id="div-01_">

        <?php

        // include('./datas/cal_at.php');

        ?>

        <br> -->

            <!-- <table BORDER="1" cellpadding="15">


            <thead>

                <tr>

                    <th>Aterro</th>

                    <th>Qntd</th>

                    <th>Valor Total</th>

                </tr>

            </thead>
            <tbody>

                <?php while ($arquivos = $consulta_aterro__->fetch_assoc()) { ?>



                    <tr>



                        <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['aterro']; ?>&nbsp;&nbsp;&nbsp;</a></td>          
          
                        <td><a>&nbsp;&nbsp;&nbsp;<?php echo $arquivos['qntd']; ?>&nbsp;&nbsp;&nbsp;</a></td>

                        <td><a>R$&nbsp;&nbsp;<?php echo $arquivos['Valor_total']; ?>&nbsp;&nbsp;&nbsp;</a></td>
                       
                    </tr>
                    

                <?php } ?>

            </tbody>
        </table>
        
    </div> -->
            &nbsp; &nbsp; &nbsp;
            <div class="div_forms">

                <form name="select-multiple" method="post" style="background: white;">
                    <h2 class="h2filtro_form">
                        <button class="btn_Maxmin" type="button" onclick="maxmize(this), divAcao()">➕</button>
                        Filtro
                    </h2>
                    <br>
                    <div class="forms__ minimize">
                        <!-- <div class="inputGroup">
                    <input size="30" onkeyup="maiuscula(this); busc(this)" maxlength="45" type="name" name="filtro_nome_pedido"
                        value="">
                    <label>Nome</label>
                </div> -->

                        <div class="inputGroup">

                            <input size="7" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_pedido"
                                value="">
                            <label>Nº Pedido</label>
                        </div>
                        <div class="inputGroup">

                            <input size="25" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_nome_c"
                                value="">
                            <label>Cliente</label>
                        </div>

                        <div class="inputGroup">

                            <input size="25" onkeyup="busc(this)" maxlength="45" type="name" name="filtro_endereco_pedido"
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


                        <!-- <div class="inputGroup">

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


                </div> -->

                        <!-- <div class="inputGroup">

                    <input size="15" maxlength="15" type="text" name="telefone" id="telefone" onkeyup="busc(this)" value="">
                    <label>Telefone</label>

                </div> -->


                        <div class="inputGroup">

                            <p class="label_select">Colocação/Troca</p>

                            <select name="filtro_tipoOS" oninput="busc(this)">

                                <option value=""></option>
                                <option value='Colocacao'>Colocação</option>
                                <option value='Troca'>Troca</option>



                            </select>
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
                        <button input type="button" onclick="filtrar()" class="btn_filtro">FILTRAR</button>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="tabela-base">

            <table class="table-wrapper">



                <thead>



                    <tr>

                        <th style="text-align:center">N°</th>

                        <th style="text-align:center">Cliente</th>

                        <th style="text-align:center">Tipo <br> Serviço</th>

                        <th style="text-align:center">Endereço</th>

                        <th style="text-align:center">Nº Ende.</th>

                        <th style="text-align:center">Bairro</th>

                        <th style="text-align:center">Motorista</th>

                        <th style="text-align:center">Data <br> Entrega</th>

                        <th style="text-align:center">Data <br>Retirada</th>

                        <th style="text-align:center">Status<br> Caçamba</th>





                    </tr>

                </thead>


                <?php
                $select_Bydata = mysqli_query($conexao, "SELECT * FROM `base_os` WHERE (data_entrega = '$im' or data_retirada = '$im')") or die($mysqli_error);;

                ?>
                <tbody>

                    <?php

                    while ($ped = $select_Bydata->fetch_assoc()) {

                        $n = explode(' ', $ped['motorista']);

                        $pN = $n[0]; // 'Carlos'

                    ?>

                        <tr class="tr_tabela">



                            <td class="num_pedido">

                                <?php echo $ped['num_pedido']; ?>

                            </td>

                            <td class="nome_c"><?php echo $ped['nome_cliente']; ?></td>

                            <td class="tipo_os"><?php echo $ped['tipo_os']; ?></td>

                            <td class="filtro_endereco_pedido"><?php echo $ped['Endereco']; ?></td>

                            <td class="numero"><?php echo $ped['numero']; ?></td>

                            <td class="bairro"><?php echo $ped['bairro']; ?></td>


                            <td style="text-align:center" class="filtro_motorista"><?php echo $pN; ?></td>

                            <td class="d_entrega"><?php echo date('d/m/Y', strtotime($ped['data_entrega'])); ?></td>

                            <td class="d_retirada"><?php echo date('d/m/Y', strtotime($ped['data_retirada'])); ?></td>

                            <td class="status_"><?php echo $ped['status']; ?></td>
                        </tr>



                    <?php } ?>

                </tbody>

            </table>
            <?php include('rodape.php'); ?>

        </div>

        <br>
        <br>
        <br>
    </div>
</div>
<script src="./js/mudar.js"></script>

<script src="./js/jquery.min.js"></script>

<script src="./js/jquery-ui.min.js"></script>

<script src="./js/jquery-ui.multidatespicker.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<!-- script Filtro tabela aterros -->
<script>
    let obj_filtro = {
        pedido: "",
        nome_c: "",
        bairro: "",
        n_ende: "",
        ende: "",
        tipoOS: "",
        moto: "",
        status: "",
        data_en: "",
        data_ret: "",
        aterro: "",
        nf: ""
    };



    function busc(input) {


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
            case 'filtro_nome_c':
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
                filtrar()
                break;
            default:
                break;
        }

        console.log(obj_filtro);

    }
    
    function filtrar() {
        
                    var tr_tabela = document.getElementsByClassName("tr_tabela");
                    // var td_nome = document.getElementsByClassName(input.name);
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
                        var nome__ = linha.getElementsByClassName('nome_c')[0].innerHTML.toLowerCase()
                        var bairro__ = linha.getElementsByClassName('bairro')[0].innerHTML.toLowerCase()
                        var n_ende__ = linha.getElementsByClassName('numero')[0].innerHTML.toLowerCase()
                        // var aterro__ = linha.getElementsByClassName('filtro_aterro_pedido')[0].innerHTML.toLowerCase()
                
                        // var nf__ = linha.getElementsByClassName('num_nota')[0].innerHTML.toLowerCase()
                
                        if (ende__.includes(obj_filtro.ende) && status__.includes(obj_filtro.status) &&
                            entrega__.includes(obj_filtro.data_en) && retirada__.includes(obj_filtro.data_ret) && motorista__.includes(obj_filtro.moto) &&
                            os__.includes(obj_filtro.tipoOS) && n_ped.includes(obj_filtro.pedido) && nome__.includes(obj_filtro.nome_c) &&
                            bairro__.includes(obj_filtro.bairro) && n_ende__.includes(obj_filtro.n_ende)) {
                            linha.style.display = "table-row";
                            linha.style = "width: 100%";
                
                        } else {
                            linha.style.display = "none";
                        }
                
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
</script>

<?php

echo "<script>";
echo "totais_Tresumo();";
echo "</script>";

if (isset($_SESSION['motorista'])) {
    echo "<script>";
    echo "filtro_m_servicos('" . $_SESSION['motorista'] . "');";
    echo "</script>";
}


?>