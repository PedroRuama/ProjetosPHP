<?php

include('conexao.php');



$six = mysqli_real_escape_string($conexao, $_POST['aterro']);

$endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);

$id = intval($_GET['update3']);



$hoje = date('Y,m,d');

$query = "select * from base_motorista ";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);


if (isset($_SESSION['motorista'])) {
      $user = $_SESSION['motorista'];
} else {

      $user = $_SESSION['usuario'];
}

$query1 = "select * from base_motorista";

$result1 = mysqli_query($conexao, $query1);

$row1 = mysqli_num_rows($result1);

// data_retirada = '$hoje',



 if($six == "" || $six == null){

       echo "<script>alert('informar o aterro ');</script>";

       echo "<script>history.go(-1)</script>";





 }else{

       $incluircadastro = $conexao ->prepare("UPDATE base_os SET  aterro = '$six', status = 'Retirado', last_alter_User='$user', acao='servico retirado' WHERE num_pedido = '$id'");
      //  and status = 'Retirar'
       $incluircadastro->execute();

      

       echo "<script>location.href='form_m_servicos_NEW.php';</script>";



 }



       



      



        

  

