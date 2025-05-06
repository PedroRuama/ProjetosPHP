<?php

include('conexao.php');



$nome = mysqli_real_escape_string($conexao, $_POST['nome_m']);

$senha = mysqli_real_escape_string($conexao, $_POST['mot_senha']);

$endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);

$Numero = mysqli_real_escape_string($conexao, $_POST['Numero']);

$complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);

$bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);

$municipio = mysqli_real_escape_string($conexao, $_POST['municipio']);

$uf = mysqli_real_escape_string($conexao, $_POST['uf']);

$cep = mysqli_real_escape_string($conexao, $_POST['cep']);

$rg = mysqli_real_escape_string($conexao, $_POST['rg']);

$cnh = mysqli_real_escape_string($conexao, $_POST['cnh']);

$vencimento = mysqli_real_escape_string($conexao, $_POST['vencimento']);

$cpf1 = mysqli_real_escape_string($conexao, $_POST['cpf']);

$telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);

$nascimento = mysqli_real_escape_string($conexao, $_POST['nascimento']);

$cadastro = mysqli_real_escape_string($conexao, $_POST['cadastro']);

$hoje = date('Y,m,d');

$query = "select * from base_motorista ";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);



$query1 = "select * from base_motorista";

$result1 = mysqli_query($conexao, $query1); 

$row1 = mysqli_num_rows($result1);



                           



try {

    if ($nome === ""){

        echo "<script>alert('O campo nome nao pode estar vazio');</script>";

        echo "<script>history.go(-1)</script>";

        

    

   

    }else{

        echo "<script>alert('Cadastro sendo realizado');</script>"; 

       $incluircadastro = $conexao ->prepare("INSERT INTO base_motorista(senha_motorista,id_motorista,nome_motorista,num_end_motorista,end_motorista,complemento,bairro_motorista,municipio_motorista,estado_motorista,cep,rg_motorista,cpf_motorista,telefone_motorista,cnh,vencimento_cnh,nascimento,cadastro) VALUES (md5('{$senha}'),'$row','$nome','$Numero','$endereco','$complemento','$bairro','$municipio','$uf','$cep','$rg','$cpf1','$telefone','$cnh','$vencimento','$nascimento','$cadastro')");

       $incluircadastro->execute();

       echo "<script>alert('Cadastro realizado com sucesso');</script>"; 

        "<script>history.go(-1)</script>";

   

     header('location: form_cadastro_motorista.php');

    

    }

    

} catch (PDOException $e) {

    echo "erro: " . $e->getMessage();

}