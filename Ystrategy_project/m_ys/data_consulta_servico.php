<?php

include("conexao.php");



$user1 = $_SESSION['motorista'];

$user2 = $_SESSION['usuario'];

$n = explode(' ', $user1);

$pN = $n[0]; // 'Carlos'



if (isset($user2)) {

     $user = $user2;
} else {

     $user = $pN;
}







if (!isset($_SESSION)) {

     session_start();
}

$querym = "SELECT * FROM `base_motorista` WHERE nome_motorista = '$user'" or die($mysqli_error);

$resultm = mysqli_query($conexao, $querym);

$rowm = mysqli_num_rows($resultm);



$d_inicio = mysqli_real_escape_string($conexao, $_POST['d_inicio']);



$incluircadastro1 = $conexao->prepare("DELETE FROM consulta where tabela = 'servico' and usuario = '$user' ");

$incluircadastro1->execute();



$incluircadastro = $conexao->prepare("INSERT INTO consulta(tabela,entrega,usuario) VALUES ('servico','$d_inicio','$user')");

$incluircadastro->execute();



if (isset($_GET['form_m_servicos'])) {


     echo "<script>location.href='form_m_servicos_NEW.php';</script>";
}elseif(isset($_GET['resumos'])) {

     echo "<script>location.href='visao_geral.php';</script>";
} else {

     echo "<script>location.href='form_m_servicos_NEW.php';</script>";
}
