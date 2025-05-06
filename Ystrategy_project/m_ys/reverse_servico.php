<?php

// include("buscar_endereco.php");

include('conexao.php');


 $id = $_POST['id'];

 $tipo_os = $_POST['tipo'];

 $C_or_R = $_POST['c_r'];

$infos = mysqli_query($conexao, "select * from base_os where num_pedido=$id") or die($mysqli_error);

$dados = $infos->fetch_assoc();

switch ($C_or_R) {
       case 'c':
              if ($tipo_os == 'Colocacao') {
                     $revert = $conexao->prepare("UPDATE base_os SET cacamba='', status='Entregar', tipo_cacamba='', acao='revert colocacao' WHERE num_pedido = $id");
                     $revert->execute();
              } elseif ($tipo_os == 'Troca') {
                     $revert = $conexao->prepare("UPDATE base_os SET cacamba='', confirm_troca=1, status='Entregar', tipo_cacamba='',  acao='revert troca colocacao' WHERE num_pedido = $id");
                     $revert->execute();
              }
              break;

       case 'r':
              if ($dados['troca']) {
                     $revert = $conexao->prepare("UPDATE base_os SET aterro='EM_OBRA', status='Retirar', confirm_troca=1, acao='revert troca retirada' WHERE num_pedido = $id");
                     $revert->execute();
              } else {
                     $revert = $conexao->prepare("UPDATE base_os SET aterro='EM_OBRA', status='Retirar', acao='revert retirada'  WHERE num_pedido = $id");
                     $revert->execute();
              }

              break;

       default:
              # code...
              break;
}

echo "<script>location.href='form_m_servicos_NEW.php';</script>";

?>
