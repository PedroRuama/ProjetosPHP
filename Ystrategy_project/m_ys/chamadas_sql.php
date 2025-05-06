

<?php

include('conexao.php');

// error_reporting(0);

if (!isset($_SESSION)) {

    session_start();
}



$user = $_SESSION['usuario'];

?>

<?php

$p_d = date('Y-m-01');

$u_d = date('Y-12-31');


// $D_User = mysqli_query($conexao, "SELECT * FROM cadastro where USUARIO='$user'") or die($mysqli_error);

// $DadosUser = $D_User->fetch_assoc();



// VISÃO LISTA CONTAS A RECEBER

$sql_lista_contas_a_receber =  mysqli_query($conexao, "select * from base_os order by status_pagamento,num_pedido DESC") or die($mysqli_error);



//  consulta_data_pesquisa

$C_D_I_F =  mysqli_query($conexao, "select * from consulta where tabela = 'aterro' and usuario = '$user'") or die($mysqli_error);

while ($arquivos = $C_D_I_F->fetch_assoc()) {

    $i = $arquivos['entrega'];

    $f = date("Y-m-d", strtotime($i . "+ 6 days"));
}

$C_D_I_F1 =  mysqli_query($conexao, "select * from consulta where tabela = 'motorista' and usuario = '$user'") or die($mysqli_error);

while ($arquivos1 = $C_D_I_F1->fetch_assoc()) {

    $im = $arquivos1['entrega'];

    $cm = date("Y-m-d", strtotime($im . "+ 6 days"));
}







$sql_serv_mot_resumo  =  mysqli_query($conexao, "select * from consulta where tabela = 'pedido' and usuario = '$user'") or die($mysqli_error);

while ($R_S_M = $sql_serv_mot_resumo->fetch_assoc()) {

    $D_R_S_M = $R_S_M['entrega'];

    $D_R_S_M3 = $R_S_M['retirada'];



    $Q = "SELECT * FROM `consulta` WHERE entrega = '' and tabela = 'pedido' and usuario = '$user' ";

    $R = mysqli_query($conexao, $Q);

    $row11 = mysqli_num_rows($R);



    // echo $row11;

    if ($D_R_S_M == null) {

        $D_R_S_M1 = $D_R_S_M;
    } else {

        $D_R_S_M1 = "'" . $D_R_S_M . "'";
    }
}



if ($D_R_S_M3 == null) {



    $D_R_S_M2 = $D_R_S_M3;
} else {



    $D_R_S_M2 = "'" . $D_R_S_M3 . "'";
}







$sql_serv_mot_resumom  =  mysqli_query($conexao, "select * from consulta where tabela = 'motorista' and usuario = '$user' ") or die($mysqli_error);

while ($R_S_Mm = $sql_serv_mot_resumom->fetch_assoc()) {

    $D_R_S_Mm = $R_S_Mm['retirada'];



    if ($D_R_S_Mm == null) {



        $DM = $D_R_S_Mm;
    } else {



        $DM = "'" . $D_R_S_Mm . "'";
    }
}



$sql_serv_at_resumo  =  mysqli_query($conexao, "select * from consulta where tabela = 'aterro' and usuario = '$user'") or die($mysqli_error);

while ($R_S_Ma = $sql_serv_at_resumo->fetch_assoc()) {

    $D_R_S_Ma = $R_S_Ma['retirada'];



    if ($D_R_S_Ma == null) {



        $Dat = $D_R_S_Ma;
    } else {



        $Dat = "'" . $D_R_S_Ma . "'";
    }
}



$sql_consulta_formulario_relatorio  =  mysqli_query($conexao, "select * from consulta where tabela = 'formulario_relatorio' and usuario = '$user'") or die($mysqli_error);

while ($resultado_consulta_formulario_relatorio = $sql_consulta_formulario_relatorio->fetch_assoc()) {

    $D_R_R_C_F_R = $resultado_consulta_formulario_relatorio['retirada'];



    if ($D_R_R_C_F_R == null) {

        $D_R_R_C_F_R1 = $D_R_R_C_F_R;
    } else {

        $D_R_R_C_F_R1 = "'" . $D_R_R_C_F_R . "'";
    }
}

if (isset($D_R_R_C_F_R1)) {

    $sql_consulta_formulario_relatorio_menor  =  mysqli_query($conexao, "select * from base_os where data_entrega in ($D_R_R_C_F_R1) order by data_entrega limit 1") or die($mysqli_error);

    while ($resultado_consulta_formulario_relatorio_menor = $sql_consulta_formulario_relatorio_menor->fetch_assoc()) {

        $D_R_R_C_F_R_M = $resultado_consulta_formulario_relatorio_menor['data_entrega'];



        if ($D_R_R_C_F_R_M == null) {

            $D_R_R_C_F_R_M1 = $D_R_R_C_F_R_M;
        } else {

            $D_R_R_C_F_R_M1 = "'" . $D_R_R_C_F_R_M . "'";
        }
    }
}









//  PEDIDO BUSCAR PLACA

$sql_c_placa =  mysqli_query($conexao, "select * from base_veiculo order by placa ") or die($mysqli_error);



//  PEDIDO BUSCAR CAÇAMBAr

$sql_c_cacamba =  mysqli_query($conexao, "select * from base_cacambra order by numero ") or die($mysqli_error);



// CONSULTA \ PAGAMENTO FILTRO VALORES ATERRO

$sql_query2 =  mysqli_query($conexao, "SELECT p.Nome_aterro as aterro, count(v.aterro) as qtde  FROM base_aterro p LEFT JOIN base_os v ON p.Nome_aterro = v.aterro where v.data_retirada BETWEEN '$i' and '$f' GROUP BY Nome_aterro;") or die($mysqli_error);



// VISÃO STATUS

$sql_status =  mysqli_query($conexao, "select status from base_os GROUP BY status; ") or die($mysqli_error);



// VISÃO CLIENTES RELATORIO

$sql_cadastro_cliente =  mysqli_query($conexao, "select * from base_clientes order by  codigo_cliente desc ") or die($mysqli_error);



//VISÃO BASE OREDEM DE SERVIÇO PEDIDOS EM ABERTO 

$pedidos_aberto =  mysqli_query($conexao, "select * from base_os where status = 'aberto' order by num_pedido desc ") or die($mysqli_error);



//Filtro_pedido  ( em teste)

$filtro_cliente1 =  mysqli_query($conexao, "select * from consulta where tabela = 'pedido' and usuario = '$user' ") or die($mysqli_error);



while ($resolt_filtro_cliente = $filtro_cliente1->fetch_assoc()) {

    $ncp = $resolt_filtro_cliente['nome'];

    $ecp = $resolt_filtro_cliente['endereco'];

    $mcp = $resolt_filtro_cliente['motorista'];

    $acp = $resolt_filtro_cliente['aterro'];

    $diecp = $resolt_filtro_cliente['entrega'];

    $dfecp = $resolt_filtro_cliente['retirada'];

    $tcp = $resolt_filtro_cliente['telefone'];

    $scp = $resolt_filtro_cliente['status'];
}

$filtro_motorista =  mysqli_query($conexao, "select * from consulta where tabela = 'motorista' and usuario = '$user' ") or die($mysqli_error);



while ($resolt_filtro_motorista = $filtro_motorista->fetch_assoc()) {



    $DFM = $resolt_filtro_motorista['retirada'];
}



$filtro_formulario_relatorio =  mysqli_query($conexao, "select * from consulta where tabela = 'formulario_relatorio' and usuario = '$user' ") or die($mysqli_error);



while ($resolt_filtro_formulario_relatorio = $filtro_formulario_relatorio->fetch_assoc()) {



    $DFFR = $resolt_filtro_formulario_relatorio['retirada'];
}







$filtro_aterro =  mysqli_query($conexao, "select * from consulta where tabela = 'aterro' and usuario = '$user' ") or die($mysqli_error);



while ($resolt_filtro_aterro = $filtro_aterro->fetch_assoc()) {



    $DFAT = $resolt_filtro_aterro['retirada'];
}





//modelo para filtrar o bando de dados

$filtro_banco_dados =  mysqli_query($conexao, "select (select telefone_contato from base_clientes a where a.codigo_cliente = x.codigo_cliente ) as telefone, x.* from base_os x where status = 'Entregar' order by num_pedido desc ") or die($mysqli_error);



if ($DM) {

    $consulta_motorista =  mysqli_query($conexao, "SELECT p.nome_motorista as motorista,
     count(v.Motorista_retirada) as qtde, COUNT(CASE WHEN v.periodo = 'DIURNO' THEN 1 END) AS diurno, COUNT(CASE WHEN v.periodo = 'NOTURNO' THEN 1 END) AS noturno, COUNT(CASE WHEN v.periodo = '' THEN 1 END) AS vazio,
      CONCAT('R$ ',ROUND((sum(v.pago_motorista)),2)) as valor FROM base_motorista p LEFT JOIN base_os v ON p.nome_motorista = v.Motorista_retirada where v.data_retirada in ($DM) and status = 'Retirado' GROUP BY p.nome_motorista;") or die($mysqli_error);
} else {
    $consulta_motorista =  mysqli_query($conexao, "SELECT p.nome_motorista as motorista, count(v.Motorista_retirada) as qtde,CONCAT('R$ ',ROUND((sum(v.pago_motorista)),2)) as valor FROM base_motorista p LEFT JOIN base_os v ON p.nome_motorista = v.Motorista_retirada where v.data_retirada ='2000-00-00' and status = 'Retirado' GROUP BY p.nome_motorista;") or die($mysqli_error);
}

//APRENDIZADO DE CONSULTA EM DIVERSAS BASE COM O MODO CONTEM

if ($Dat) {

    $consulta_aterro =  mysqli_query($conexao, "SELECT p.Nome_aterro as aterro, count(v.aterro) as qtde,CONCAT('R$ ',ROUND((sum(v.pago_aterro)),2)) as valor FROM base_aterro p LEFT JOIN base_os v ON p.Nome_aterro = v.aterro where v.data_retirada in ($Dat)  GROUP BY p.Nome_aterro;") or die($mysqli_error);
} else {

    $consulta_aterro =  mysqli_query($conexao, "SELECT p.Nome_aterro as aterro, count(v.aterro) as qtde,CONCAT('R$ ',ROUND((sum(v.pago_aterro)),2)) as valor FROM base_aterro p LEFT JOIN base_os v ON p.Nome_aterro = v.aterro where v.data_retirada ='2024-00-00'  GROUP BY p.Nome_aterro;") or die($mysqli_error);
}

if ($Dat) {

    $consulta_aterro__ =  mysqli_query($conexao, "SELECT aterro, valor, COUNT(aterro) as qntd, SUM(valor) as Valor_total from base_os WHERE data_retirada in($Dat) GROUP BY aterro") or die($mysqli_error);
} else {
    $consulta_aterro__ =  mysqli_query($conexao, "SELECT aterro, valor, COUNT(aterro) as qntd from base_os WHERE data_retirada = '2024-00-00'  GROUP BY aterro") or die($mysqli_error);
}







// VISÃO consulta pedido em aberto

$pedidos_aberto2 =  mysqli_query($conexao, "select * from base_os where status = 'aberto' order by data_entrega,status") or die($mysqli_error);





// VISÃO consulta pedido em aberto

$pedidos_aberto3 =  mysqli_query($conexao, "select * from base_os where status = 'Entregue' order by data_entrega,status") or die($mysqli_error);



//PEDIDO BUSCA MOTORISTA

$sql_c_motorista =  mysqli_query($conexao, "select * from base_motorista order by nome_motorista") or die($mysqli_error);

//

$sql_c_motorista_f =  mysqli_query($conexao, "select * from base_motorista order by nome_motorista") or die($mysqli_error);

$sql_c_motorista_g =  mysqli_query($conexao, "select * from base_motorista order by nome_motorista") or die($mysqli_error);



//base_valores



$sql_b_valor =  mysqli_query($conexao, "select * from base_valores order by Tipo_valor") or die($mysqli_error);

if (!isset($_SESSION['TIPO_SE'])) {
    $se = '';
} elseif ($_SESSION['TIPO_SE'] == 'MUNDIAL') {
    $se = "and (b.tipo_servico = 'MUNDIAL' OR b.tipo_servico = 'AMBOS' OR b.tipo_servico IS null)";
} elseif ($_SESSION['TIPO_SE'] == 'FORMIGA') {
    $se = "and (b.tipo_servico = 'FORMIGA' OR b.tipo_servico = 'AMBOS')";
}

// VISÃO consulta pedido em aberto

if ($acp == 'EM_ABERTO') {

    if ($_SESSION['ACESSO'] == 'USER') {
        if ($D_R_S_M1 == null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*,(select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and b.Usuario = '$user' $se order by  data_entrega desc,num_pedido desc") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and (data_entrega in ($D_R_S_M1) or data_retirada in ($D_R_S_M2)) and b.Usuario = '$user' $se order by data_entrega desc,num_pedido desc") or die($mysqli_error);
        } elseif ($D_R_S_M1 == null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and data_retirada in ($D_R_S_M2) and b.Usuario = '$user' $se order by data_entrega desc,num_pedido desc") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and data_entrega in ($D_R_S_M1) and b.Usuario = '$user'  $se order by data_entrega desc,num_pedido desc") or die($mysqli_error);
        }
    } elseif ($_SESSION['ACESSO'] != 'ADMIN') {
        if ($D_R_S_M1 == null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*,(select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and b.Usuario = '$user'  order by  data_entrega desc,num_pedido desc") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and (data_entrega in ($D_R_S_M1) or data_retirada in ($D_R_S_M2)) and b.Usuario = '$user' $se order by data_entrega desc,num_pedido desc") or die($mysqli_error);
        } elseif ($D_R_S_M1 == null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and data_retirada in ($D_R_S_M2) and b.Usuario = '$user' $se order by data_entrega desc,num_pedido desc") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and data_entrega in ($D_R_S_M1) and b.Usuario = '$user' $se order by data_entrega desc,num_pedido desc") or die($mysqli_error);
        }
    } else {
        if ($D_R_S_M1 == null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*,(select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and  b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null  $se order by  data_entrega desc,num_pedido desc") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and (data_entrega in ($D_R_S_M1) or data_retirada in ($D_R_S_M2) ) $se order by data_entrega desc,num_pedido desc") or die($mysqli_error);
        } elseif ($D_R_S_M1 == null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and data_retirada in ($D_R_S_M2) $se order by  data_entrega desc,num_pedido desc") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro is null and data_entrega in ($D_R_S_M1) $se order by  data_entrega desc,num_pedido desc") or die($mysqli_error);
        }
    }
} else {


    //aaaaaa
    if ($_SESSION['ACESSO'] == 'USER') {

        if ($D_R_S_M1 == null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*,(select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and  b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and b.Usuario = '$user' $se order by  data_entrega desc,num_pedido desc LIMIT 600") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and (data_entrega in ($D_R_S_M1) or data_retirada in ($D_R_S_M2) ) and b.Usuario = '$user' $se  order by  data_entrega desc,num_pedido desc LIMIT 600") or die($mysqli_error);
        } elseif ($D_R_S_M1 == null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and data_retirada in ($D_R_S_M2) and b.Usuario = '$user' $se  order by  data_entrega desc,num_pedido desc LIMIT 600 ") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and data_entrega in ($D_R_S_M1) and b.Usuario = '$user' $se order by  data_entrega desc,num_pedido desc LIMIT 600") or die($mysqli_error);
        }
    } else if ($_SESSION['ACESSO'] != 'ADMIN') {

        if ($D_R_S_M1 == null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*,(select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and  b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and b.Usuario = '$user' $se order by  data_entrega desc,num_pedido desc LIMIT 600") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and (data_entrega in ($D_R_S_M1) or data_retirada in ($D_R_S_M2) ) and b.Usuario = '$user' $se order by  data_entrega desc,num_pedido desc LIMIT 600") or die($mysqli_error);
        } elseif ($D_R_S_M1 == null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and data_retirada in ($D_R_S_M2) and b.Usuario = '$user' $se order by  data_entrega desc,num_pedido desc LIMIT 600 ") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and data_entrega in ($D_R_S_M1) and b.Usuario = '$user' $se order by  data_entrega desc,num_pedido desc LIMIT 600") or die($mysqli_error);
        }
    } else {
        if ($D_R_S_M1 == null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*,(select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and  b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' $se order by  data_entrega desc,num_pedido desc LIMIT 600") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and (data_entrega in ($D_R_S_M1) or data_retirada in ($D_R_S_M2) ) $se  order by  data_entrega desc,num_pedido desc LIMIT 600") or die($mysqli_error);
        } elseif ($D_R_S_M1 == null && $D_R_S_M2 != null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and data_retirada in ($D_R_S_M2) $se  order by  data_entrega desc,num_pedido desc LIMIT 600 ") or die($mysqli_error);
        } elseif ($D_R_S_M1 != null && $D_R_S_M2 == null) {

            $base_os_g =  mysqli_query($conexao, "select b.*, (select telefone_contato from base_clientes a where a.codigo_cliente = b.codigo_cliente ) as telefone  from base_os b INNER JOIN base_clientes c on b.codigo_cliente = c.codigo_cliente where b.status like '%$scp%' and c.telefone_contato like '%$tcp%' and b.nome_cliente like '%$ncp%' and b.endereco like '%$ecp%' and b.motorista like '%$mcp%' and b.aterro like '%$acp%' and data_entrega in ($D_R_S_M1) $se  order by  data_entrega desc,num_pedido desc LIMIT 600") or die($mysqli_error);
        }
    }
}

$aterros_f =  mysqli_query($conexao, "select * from base_aterro order by nome_aterro") or die($mysqli_error);





//*****************************UPDATES*****************************************





// DELETAR CADASTRO DA BASE CLIENTES



if (isset($_GET['apaga_cliente'])) {

    $id = intval($_GET['apaga_cliente']);

    $sql_query = mysqli_query($conexao, "DELETE FROM base_clientes where  codigo_cliente ='$id'") or die($mysqli_error);
}







//DELETAR PAGAMENTO ERRADO (AINDA EM TRATAMENTO)

if (isset($_GET['update99'])) {

    $id = intval($_GET['update99']);

    $sql_query = mysqli_query($conexao, "DELETE FROM contas_a_receber where  id ='$id'") or die($mysqli_error);
}



//DELETAR cadastro motorista

if (isset($_GET['update2'])) {

    $id = intval($_GET['update2']);

    $sql_query = mysqli_query($conexao, "DELETE FROM base_motorista where  id_motorista ='$id'") or die($mysqli_error);

    echo "<script>location.href='form_cadastro_motorista.php';</script>";
}

//DELETAR cadastro aterro

if (isset($_GET['update4'])) {

    $id = intval($_GET['update4']);

    $sql_query = mysqli_query($conexao, "DELETE FROM base_aterro where  id ='$id'") or die($mysqli_error);

    echo "<script>location.href='form_cadastro_aterro.php';</script>";
}





//DELETAR valores

if (isset($_GET['apaga_valores'])) {

    $id = intval($_GET['apaga_valores']);

    $sql_query = mysqli_query($conexao, "DELETE FROM base_valores where  id ='$id'") or die($mysqli_error);

    echo "<script>location.href='form_cadastro_valores.php';</script>";
}



//DELETAR usuario

if (isset($_GET['update_usuario'])) {

    $id = intval($_GET['update_usuario']);

    $sql_query = mysqli_query($conexao, "DELETE FROM cadastro where  Codigo_cliente ='$id'") or die($mysqli_error);

    echo "<script>location.href='form_cadastro_usuario.php';</script>";
}



?>

