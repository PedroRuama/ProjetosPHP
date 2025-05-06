<?php

// include("buscar_endereco.php");

include('conexao.php');



$six = mysqli_real_escape_string($conexao, $_POST['six']);

$endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);

$tipo_c = mysqli_real_escape_string($conexao, $_POST['tipo_c']);

$id = intval($_GET['update3']);





if (isset($_SESSION['motorista'])) {
       $user = $_SESSION['motorista'];
} else {

       $user = $_SESSION['usuario'];
}







$hoje = date('Y,m,d');

$query = "select * from base_motorista ";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);



$query1 = "select * from base_motorista";

$result1 = mysqli_query($conexao, $query1);

$row1 = mysqli_num_rows($result1);



if ($six === "" || $six === null) {

       echo "<script>alert('Não foi digitado a caçamba');</script>";

       echo "<script>location.href='form_m_servicos_NEW.php';</script>";
} else {



       $incluircadastro = $conexao->prepare("UPDATE base_os SET  cacamba = '$six', status = 'Entregue', tipo_cacamba = '$tipo_c', last_alter_User='$user', acao='servico entregue' WHERE num_pedido = '$id' ");
       // and status = 'Entregar';
       $incluircadastro->execute();

       echo "<script>alert('Caçambra $six Entregue com Sucesso ');</script>";

       echo "<script>location.href='form_m_servicos_NEW.php';</script>";
}
