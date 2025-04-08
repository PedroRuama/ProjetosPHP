<?php 
include("conexao.php");

if (!isset($_SESSION)) {
    session_start();
}

$s_financas = mysqli_query($conexao, "SELECT * FROM financas_mes WHERE userID = {$_SESSION['userID']}") or die("MySQL Error: " . $mysqli->Error);
$u_financas = $s_financas->fetch_assoc();




?>