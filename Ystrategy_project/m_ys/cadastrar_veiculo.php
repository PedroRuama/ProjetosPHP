<?php
include('conexao.php');
$placa = mysqli_real_escape_string($conexao, $_POST['placa']);
$chassi = mysqli_real_escape_string($conexao, $_POST['chassi']);
$nome_veiculo = mysqli_real_escape_string($conexao, $_POST['nome_veiculo']);
$modelo = mysqli_real_escape_string($conexao, $_POST['modelo']);
$marca = mysqli_real_escape_string($conexao, $_POST['marca']);
$ano = mysqli_real_escape_string($conexao, $_POST['ano']);
$licenciamento = mysqli_real_escape_string($conexao, $_POST['licenciamento']);
$mes_licenciar = mysqli_real_escape_string($conexao, $_POST['mes_licenciar']);
$hoje = date('Y,m,d');
$query = "select * from base_veiculo ";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

$query1 = "select * from base_veiculo where placa = '{$placa}' or chassi = '{$chassi}' ";
$result1 = mysqli_query($conexao, $query1);
$row1 = mysqli_num_rows($result1);

try {
    if ($placa === ""){
        echo "<script>alert('O campo Placa nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";
        
    }elseif($chassi  === ""){
        echo "<script>alert('O campo Chassi nao pode estar vazio');</script>"; 
        echo "<script>history.go(-1)</script>";  
    }elseif($modelo  === ""){
        echo "<script>alert('O campo Modelo nao pode estar vazio');</script>"; 
        echo "<script>history.go(-1)</script>";
     }elseif($marca  === ""){
        echo "<script>alert('O campo Marca nao pode estar vazio');</script>"; 
        echo "<script>history.go(-1)</script>";
    }elseif($ano  === ""){
        echo "<script>alert('O campo ano nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";    
    }elseif($licenciamento  === ""){
        echo "<script>alert('O campo Licenciamento nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";
    }elseif($mes_licenciar  === ""){
        echo "<script>alert('O campo mes_licenciar nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";
    }elseif($row1  >0){
        echo "<script>alert('placa e ou chassi Já Cadastrado em nosso Sistema');</script>";
        echo "<script>history.go(-1)</script>";
    }else{
        // echo "<script>alert('Cadastro sendo realizado');</script>"; 
       $incluircadastro = $conexao ->prepare("INSERT INTO base_veiculo(placa,nome_veiculo,chassi,modelo,marca,ano,licenciado,mes_licenciamento) VALUES ('$placa','$nome_veiculo','$chassi','$modelo','$marca','$ano','$licenciamento','$mes_licenciar')");
       $incluircadastro->execute();
       echo "<script>location.href='form_cadastro_veiculos.php';</script>";
    }
   
} catch (PDOException $e) {
    echo "erro: " . $e->getMessage();
}
