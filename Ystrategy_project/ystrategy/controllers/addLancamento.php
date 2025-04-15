<?php
include 'conexao.php';
include 'chamadas_sql.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo $valor = mysqli_real_escape_string($conexao, $_POST['valor']);
echo "<br>";
echo $data = mysqli_real_escape_string($conexao, $_POST['data']);
echo "<br>";
echo $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
echo "<br>";
echo $categoria_id = mysqli_real_escape_string($conexao, $_POST['categoria_id']);

$scat = mysqli_query($conexao, "SELECT * from categorias where categoria_id = $categoria_id")  or die("MySQL Error: " . $mysqli->error);;
$cat = $scat->fetch_assoc();

$incluirtransacao = $conexao->prepare("INSERT INTO transacoes(userID, mes_id, categoria_id, categoria, name, amount, descricao, data_transacao, tipo) 
VALUES($userID, '".$u_financas['mes_id']."', $categoria_id, '".$cat['name']."', '$descricao', $valor, '', '$data', '".$cat['tipo']."')")  or die("MySQL Error: " . $mysqli->error);;

$incluirtransacao->execute();

echo "<script> location.href = '../lancamentos.php' </script>";



?>