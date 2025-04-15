<?php
include 'conexao.php';
include 'chamadas_sql.php';

 $saldo = mysqli_real_escape_string($conexao, $_POST['saldo-inicial']);


$incluircadastro = $conexao->prepare("UPDATE financas_mes SET inicial_amount = $saldo, saldoAtual_amount = (inicial_amount + (total_recebimentos - total_gastos)) WHERE mes_id = ".$u_financas['mes_id']." AND userID = $userID") or die("MySQL Error: " . $mysqli->Error);

$incluircadastro->execute();
echo "<script> location.href = '../lancamentos.php' </script>";
?>