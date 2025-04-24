<?php
include 'conexao.php';
include 'chamadas_sql.php';

$name = mysqli_real_escape_string($conexao, $_POST['titulo']);
$valor = mysqli_real_escape_string($conexao, $_POST['valor']);
$start_date = mysqli_real_escape_string($conexao, $_POST['start_date']);
$end_date = mysqli_real_escape_string($conexao, $_POST['end_date']);
$categoria_id = mysqli_real_escape_string($conexao, $_POST['categoria_id']);

if (!isset($_GET['editar'])) {

    $incluircadastro = $conexao->prepare("INSERT INTO gastos_fixos(userID, categoria_id, name, amount, start_date, end_date, is_active, pago) 
    VALUES($userID, $categoria_id, '$name',$valor, $start_date, $end_date, 0, 0)");

    $incluircadastro->execute();
} else {
    $Gasto_id = mysqli_real_escape_string($conexao, $_POST['Gasto_id']);
    $incluircadastro = $conexao->prepare("UPDATE gastos_fixos SET userI = $userID, categoria_id = $categoria_id, amount = $valor, start_date = $start_date, end_date = $end_date WHERE gasto_fixo_id = $Gasto_id)");
    $incluircadastro->execute();
}




echo "<script> alert('Gasto fixo '".$name."' adicionado com Sucesso')</script>";

echo "<script> location.href = '../config.php' </script>";
