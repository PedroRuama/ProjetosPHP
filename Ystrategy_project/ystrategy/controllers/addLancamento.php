<?php
include 'conexao.php';
include 'chamadas_sql.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$valor = mysqli_real_escape_string($conexao, $_POST['valor']);

$data = mysqli_real_escape_string($conexao, $_POST['data']);

$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);

$categoria_id = mysqli_real_escape_string($conexao, $_POST['categoria_id']);

$scat = mysqli_query($conexao, "SELECT * from categorias where categoria_id = $categoria_id")  or die("MySQL Error: " . $mysqli->error);;
$cat = $scat->fetch_assoc();

$incluirtransacao = $conexao->prepare("INSERT INTO transacoes(userID, mes_id, categoria_id, categoria, name, amount, descricao, data_transacao, tipo) 
VALUES($userID, '" . $u_financas['mes_id'] . "', $categoria_id, '" . $cat['name'] . "', '$descricao', $valor, '', '$data', '" . $cat['tipo'] . "')")  or die("MySQL Error: " . $mysqli->error);;

$incluirtransacao->execute();

echo "<script> location.href = '../lancamentos.php' </script>";
