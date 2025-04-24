<?php
include("conexao.php");

if (!isset($_SESSION)) {
    session_start();
}

$userID = $_SESSION['userID'];

$ano = date('Y');
$mes = date('m');
$date = date('Y-m-d');

$s_financas = mysqli_query($conexao, "SELECT * FROM financas_mes WHERE userID = $userID and mes = $mes and ano = $ano") or die("MySQL Error: " . $mysqli->Error);
$u_financas = $s_financas->fetch_assoc();

$s_metas = mysqli_query($conexao, "SELECT * FROM metas WHERE userID = $userID") or die("MySQL Error: " . $mysqli->Error);
$u_metas = $s_financas->fetch_assoc();
// $metas_rows = mysqli_num_rows($s_metas);
$total_guardado = 0.00; 
while ($u_metas = mysqli_fetch_array($s_metas)) { 
   $total_guardado += $u_metas['atual_amount'];
}


$saldo = $u_financas['inicial_amount'] + $u_financas['total_recebimentos'] - $u_financas['total_gastos'] 





?>