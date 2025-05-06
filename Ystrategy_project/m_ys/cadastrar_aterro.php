<?php
include('conexao.php');
$cod_aterro = mysqli_real_escape_string($conexao, $_POST['codigo_aterro']);
$nome_aterro = mysqli_real_escape_string($conexao, $_POST['nome_aterro']);
$endereco_aterro = mysqli_real_escape_string($conexao, $_POST['endereco_aterro']);
$bairro_aterro = mysqli_real_escape_string($conexao, $_POST['bairro_aterro']);
$cidade_aterro = mysqli_real_escape_string($conexao, $_POST['cidade_aterro']);
$cep_aterro = mysqli_real_escape_string($conexao, $_POST['cep_aterro']);





$hoje = date('Y,m,d');
$query = "select * from base_aterro ";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

$query1 = "select * from base_aterro ";
$result1 = mysqli_query($conexao, $query1);
$row1 = mysqli_num_rows($result1);
// include('form.php');

try {
    if ($nome_aterro === ""){
        echo "<script>alert('O campo Nome nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";
        
   
    }else{
       $incluircadastro = $conexao ->prepare("INSERT INTO base_aterro(Nome_aterro,Endereco_aterro,Bairro_aterro,Cidade_aterro,cep_aterro) VALUES ('$nome_aterro','$endereco_aterro','$bairro_aterro','$cidade_aterro','$cep_aterro')");
       $incluircadastro->execute();
      echo "<script>location.href='form_cadastro_aterro.php';</script>";
      
    }
    
} catch (PDOException $e) {
    echo "erro: " . $e->getMessage();
}
