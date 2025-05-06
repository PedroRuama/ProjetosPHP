<?php
include('conexao.php');
?>

<?php

$id = mysqli_real_escape_string($conexao, $_POST['num_ped_m']);


$hoje = date('Y,m,d');

try {
    if ($codigo === ""){
        echo "<script>alert('O campo codigo nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";

        
     }elseif($qc  === ""){
          echo "<script>alert('Necessario colocar a qtde de Caçamba');</script>"; 
          echo "<script>history.go(-1)</script>";


    }else{
      $cod = $_POST['cacambax'];
         $incluircadastro = $conexao ->prepare("UPDATE base_os SET status ='Entregue',cacamba = '{$cod}'  WHERE num_pedido = '$id'");
         $incluircadastro->execute();
        
       
       echo "<script>location.href='form_m_serviços.php';</script>";
    }

    
    
} catch (PDOException $e) {
    echo "erro: " . $e->getMessage();
}