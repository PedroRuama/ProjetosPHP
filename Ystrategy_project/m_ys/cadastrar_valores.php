<?php
include('conexao.php');
$tipo = mysqli_real_escape_string($conexao, $_POST['Desc']);
$valor = mysqli_real_escape_string($conexao, $_POST['valor']);
$hoje = date('Y,m,d');
$query = "select * from base_valores";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

$query1 = "select * from base_valores where Tipo_valor = '$tipo' or valor = '$valor' ";
$result1 = mysqli_query($conexao, $query1);
$row1 = mysqli_num_rows($result1);

try {
    if ($tipo === ""){
        echo "<script>alert('O campo tipo nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";
        
    }elseif($valor === ""){
        echo "<script>alert('O campo valor nao pode estar vazio');</script>"; 
        echo "<script>history.go(-1)</script>";  
    }elseif($row1 > 0){
        echo "<script>alert('Tipo ou valor ja Cadastrado');</script>"; 
        echo "<script>history.go(-1)</script>";  
       
    }else{
       $incluircadastro = $conexao ->prepare("INSERT INTO base_valores(Tipo_valor,valor) VALUES ('$tipo','$valor')");
       $incluircadastro->execute();
      echo "<script>location.href='form_cadastro_valores.php';</script>";
    }
   
} catch (PDOException $e) {
    echo "erro: " . $e->getMessage();
}
