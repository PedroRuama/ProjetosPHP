<?php 
include("conexao.php");

if (!isset($_SESSION)) {
    session_start();
}

$userID = $_SESSION['userID'];

$ano = date('Y');
$mes = date('m');

$s_financas = mysqli_query($conexao, "SELECT * FROM financas_mes WHERE userID = $userID and mes = $mes and ano = $ano") or die("MySQL Error: " . $mysqli->Error);
$u_financas = $s_financas->fetch_assoc();




?>