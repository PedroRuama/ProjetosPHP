<?php
include('conexao.php');
$numero = mysqli_real_escape_string($conexao, $_POST['numero']);
$data_compra = mysqli_real_escape_string($conexao, $_POST['compra']);
$observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);
$ult_manutencao = mysqli_real_escape_string($conexao, $_POST['manu']);
$qtde_manutencao = mysqli_real_escape_string($conexao, $_POST['qtde_manu']);
$data_descarte = mysqli_real_escape_string($conexao, $_POST['data_descarte']);
$id_cliente = mysqli_real_escape_string($conexao, $_POST['id_cliente']);
$status = mysqli_real_escape_string($conexao, $_POST['status']);
$hoje = date('Y,m,d');
$query = "select max(qtde_manutencao) as q from base_cacambra where numero = '$numero' ";
$result = mysqli_query($conexao, $query);
while ($arquivos = $result->fetch_assoc()) {
    $qtd_manu = $arquivos['q'];
    $qtde = $qtd_manu+1;
}
$query1 = "select * from base_cacambra where numero = '$numero' ";
$result1 = mysqli_query($conexao, $query1);
$row1 = mysqli_num_rows($result1);

try {
    if ($numero === ""){
        echo "<script>alert('O campo numero nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";
        
    }elseif($data_compra === ""){
        echo "<script>alert('O campo data compra nao pode estar vazio');</script>"; 
        echo "<script>history.go(-1)</script>"; 
    }elseif($row1 >0){
        if($observacao ==""){
            echo "<script>alert('Ja existe com cadastro com este numero');</script>"; 
            echo "<script>location.href='form_cadastro_cacamba.php';</script>";

        }else{

            $incluircadastro = $conexao ->prepare ("UPDATE `base_cacambra` SET observacao ='$observacao',ult_manutencao='$ult_manutencao',qtde_manutencao='$qtde',data_descarte='$data_descarte' WHERE numero = '$numero' ");
            $incluircadastro->execute(); }
            echo "<script>location.href='form_cadastro_cacamba.php';</script>";


    }else{
        // echo "<script>alert('Cadastro sendo realizado');</script>"; 
       $incluircadastro = $conexao ->prepare("INSERT INTO base_cacambra(numero,observacao,data_compra,ult_manutencao,qtde_manutencao,id_cliente,status,data_descarte) VALUES ('$numero','$observacao','$data_compra','$ult_manutencao','$qtde_manutencao','$data_descarte','$id_cliente','$status')");
       $incluircadastro->execute();
    //   echo "<script>alert('Cadastro realizado com sucesso');</script>"; 
    //   echo "<script>location.href='form_cadastro_cacamba.php';</script>";

    }
    
   
} catch (PDOException $e) {
    echo "erro: " . $e->getMessage();
}