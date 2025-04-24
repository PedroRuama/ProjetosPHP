<?php
include 'conexao.php';
include 'chamadas_sql.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['criar_meta'])) {


    $valor = mysqli_real_escape_string($conexao, $_POST['valor']);

    $valor_atual = mysqli_real_escape_string($conexao, $_POST['valor_atual']);

    $name = mysqli_real_escape_string($conexao, $_POST['titulo']);

    $incluirmeta = $conexao->prepare("INSERT INTO metas(userID, name, meta_amount, atual_amount, is_achieved) 
    VALUES($userID, '$name', $valor, $valor_atual, 1)")  or die("MySQL Error: " . $mysqli->error);;

    $incluirmeta->execute();

    echo "<script> alert('Meta criada com sucesso)</script>";
} else {

    $Id_meta = mysqli_real_escape_string($conexao, $_POST['meta_id']);

    $valor = mysqli_real_escape_string($conexao, $_POST['valor']);

    $acao = mysqli_real_escape_string($conexao, $_POST['radio']);


    if ($acao == 'guardar_r') {
        $updateMeta = $conexao->prepare("UPDATE metas SET atual_amount = atual_amount+$valor WHERE meta_id = $Id_meta AND userID = $userID")  or die("MySQL Error: " . $mysqli->error);;


        $incluirtransacao = $conexao->prepare("INSERT INTO transacoes(userID, mes_id, categoria_id, categoria, name, amount, descricao, data_transacao, tipo_operacao) 
        VALUES($userID, ". $u_financas['mes_id'].", NULL, NULL, 'GUARDADO', $valor, '', '$date', 'guardado')")  or die("MySQL Error: " . $mysqli->error);;

      
    } else if ($acao == 'resgatar_r') {
        $updateMeta = $conexao->prepare("UPDATE metas SET atual_amount = atual_amount-$valor WHERE meta_id = $Id_meta AND userID = $userID")  or die("MySQL Error: " . $mysqli->error);;

        $incluirtransacao = $conexao->prepare("INSERT INTO transacoes(userID, mes_id, categoria_id, categoria, name, amount, descricao, data_transacao, tipo_operacao) 
        VALUES($userID, ". $u_financas['mes_id'].", NULL, NULL, 'RESGATADO', $valor, '', '$date', 'resgatado')")  or die("MySQL Error: " . $mysqli->error);;

    }


    $updateMeta->execute();
    $incluirtransacao->execute();
}


echo "<script> location.href = '../lancamentos.php' </script>";
