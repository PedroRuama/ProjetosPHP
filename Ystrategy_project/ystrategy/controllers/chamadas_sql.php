<?php
include("conexao.php");

if (!isset($_SESSION)) {
    session_start();
}

$userID = $_SESSION['userID'];

$ano = date('Y');
$mes = date('m');
$date = $hoje = date('Y-m-d');
$mes_anterior = $mes - 1;
$ano_anterior = $ano;

if ($mes_anterior == 0) {
    $mes_anterior = 12;
    $ano_anterior = $ano - 1;
}

$s_financas = mysqli_query($conexao, "SELECT * FROM financas_mes WHERE userID = $userID and mes = $mes and ano = $ano") or die("MySQL Error: " . $mysqli->Error);
$u_financas = $s_financas->fetch_assoc();
$rows = mysqli_num_rows($s_financas);

if ($rows == 0) {

    $s_financas_ = mysqli_query($conexao, "SELECT * FROM financas_mes WHERE userID = $userID and mes = $mes_anterior and ano = $ano_anterior ") or die("MySQL Error: " . $mysqli->Error);
    $u_financas_ = $s_financas_->fetch_assoc();
    $create_financas = $conexao->prepare("INSERT INTO financas_mes(userID, ano, mes, inicial_amount)
    VALUES($userID, $ano, $mes," . $u_financas_['saldoAtual_amount'] . ")");
    $create_financas->execute();

    $s_financas = mysqli_query($conexao, "SELECT * FROM financas_mes WHERE userID = $userID and mes = $mes and ano = $ano") or die("MySQL Error: " . $mysqli->Error);
    $u_financas = $s_financas->fetch_assoc();

    $incluirtransacao = $conexao->prepare("INSERT INTO transacoes(userID, mes_id, categoria_id, categoria, name, amount, data_transacao, tipo) 
    VALUES($userID, " . $u_financas['mes_id'] . ", 25, 'Outros', 'INICIO_NOVO_MES', 0, '$date', 'recebimento')")  or die("MySQL Error: " . $mysqli->error);
    $incluirtransacao->execute();

    echo "<script> location.href = './lancamentos.php' </script>";
}



$s_metas = mysqli_query($conexao, "SELECT * FROM metas WHERE userID = $userID") or die("MySQL Error: " . $mysqli->Error);
$u_metas = $s_financas->fetch_assoc();
// $metas_rows = mysqli_num_rows($s_metas);
$total_guardado = 0.00;
while ($u_metas = mysqli_fetch_array($s_metas)) {
    $total_guardado += $u_metas['atual_amount'];
}


// $saldo = $u_financas['inicial_amount'] + $u_financas['total_recebimentos'] - $u_financas['total_gastos'];


$s_g_hoje = mysqli_query($conexao, "SELECT  SUM(amount) AS gastos_hj FROM transacoes WHERE data_transacao = '$hoje' AND tipo = 'gasto' AND userID = $userID");
$g_hoje = $s_g_hoje->fetch_assoc();

$s_g_semana = mysqli_query($conexao, "SELECT SUM(amount) AS gastos_semana FROM transacoes WHERE 
YEARWEEK(data_transacao) = YEARWEEK(CURDATE()) AND tipo = 'gasto' AND userID = $userID");
$g_semana = $s_g_semana->fetch_assoc();
