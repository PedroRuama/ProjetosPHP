<?php

// include("buscar_endereco.php");

include('conexao.php');



$six = mysqli_real_escape_string($conexao, $_POST['ids_card']);
$ids = explode(",", $six);

$cac_atrr = mysqli_real_escape_string($conexao, $_POST['cacambas_aterros']);
$c_a = explode(",", $cac_atrr);

$inp_tipo_c = mysqli_real_escape_string($conexao, $_POST['inp_tipo_c']);
$tipo_c = explode(",", $inp_tipo_c);

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



if ($six === "" || $six === null) {

       echo "<script>alert('Não foi digitado a caçamba');</script>";

       echo "<script>location.href='form_m_servicos_NEW.php';</script>";
} else {

       while (sizeof($ids) != 0) {
              if (is_numeric($c_a[0])) {
                     $incluircadastro = $conexao->prepare("UPDATE base_os SET cacamba = '$c_a[0]', status = 'Entregue', tipo_cacamba='$tipo_c[0]', last_alter_User='$user', acao='servico entregue em all' WHERE num_pedido = '$ids[0]' ");
                     // and status = 'Entregar';
                     $incluircadastro->execute();    
                     array_shift($tipo_c);                 
              } elseif (is_string($c_a[0])) {
                     $incluircadastro = $conexao ->prepare("UPDATE base_os SET  aterro = '$c_a[0]', status = 'Retirado', last_alter_User='$user', acao = 'servico retirado em alll' WHERE num_pedido = '$ids[0]'");
                     //  and status = 'Retirar'
                      $incluircadastro->execute();  
              }
              array_shift($ids);
              array_shift($c_a);
       }

       echo "<script>history.go(-1)</script>";
}
