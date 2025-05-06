<?php
include('conexao.php');
$codigo_cliente = mysqli_real_escape_string($conexao, $_POST['codigo_cliente']);
$nome_cliente = mysqli_real_escape_string($conexao, $_POST['nome_cliente']);
$nome_cliente1 = mysqli_real_escape_string($conexao, $_POST['nome_cliente1']);
$email_cliente = mysqli_real_escape_string($conexao, $_POST['email_cliente']);
$senha_cliente = mysqli_real_escape_string($conexao, $_POST['senha_cliente']);
$telefone_cliente = mysqli_real_escape_string($conexao, $_POST['telefone_cliente']);
$rg_cliente = mysqli_real_escape_string($conexao, $_POST['rg_cliente']);
$cpf_cliente = mysqli_real_escape_string($conexao, $_POST['cpf_cliente']);
$credito_cliente = mysqli_real_escape_string($conexao, $_POST['for_pag']);
$tipo_valor = mysqli_real_escape_string($conexao, $_POST['tipo_val']);
$prazo_cred = mysqli_real_escape_string($conexao, $_POST['Prazo_cred']);
$desconto = mysqli_real_escape_string($conexao, $_POST['desconto']);
$prazo_nota = mysqli_real_escape_string($conexao, $_POST['Prazo_Nota']);
$status_cliente = mysqli_real_escape_string($conexao, $_POST['status_cliente']);
$cadastro_cliente = mysqli_real_escape_string($conexao, $_POST['cadastro_cliente']);
$administrador = mysqli_real_escape_string($conexao, $_POST['adminis']);
$obs = mysqli_real_escape_string($conexao, $_POST['com']);
$tipo_nota = mysqli_real_escape_string($conexao, $_POST['tipo_nota']);


$hoje = date('Y,m,d');
$query = "select * from base_clientes where nome_cliente =( '{$nome_cliente}' or CPF = '{$cpf_cliente}' or rg = '{$rg_cliente}' or email = '{$email_cliente}') and codigo_cliente = '' ";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

$query1 = "select * from base_clientes where codigo_cliente = '{$codigo_cliente}' or CPF = '{$cpf_cliente}' ";
$result1 = mysqli_query($conexao, $query1);
$row1 = mysqli_num_rows($result1);

$user_sistema = "select * from cadastro where USUARIO = '{$session}' and CPF = '{$cpf_cliente}' ";
$result1 = mysqli_query($conexao, $query1);
$row1 = mysqli_num_rows($result1);

$query2 = "select * from base_clientes where codigo_cliente = '{$codigo_cliente}'";
$result2 = mysqli_query($conexao, $query2);
$row2 = mysqli_num_rows($result2);

$ultimo_contrato = "SELECT max(codigo_cliente) as codigo_cliente FROM base_clientes ";
$result = mysqli_query($conexao, $ultimo_contrato);
while ($novo_contrato = $result->fetch_assoc()) { 
   $n_c =  $novo_contrato['codigo_cliente'] + 1;
  
 } 

try {
    
    if($row >0){
        echo "<script>alert('Já Existe cadastro com estes Dados');</script>";
        echo "<script>history.go(-1)</script>";


    }elseif($nome_cliente == ""){
        echo "<script>alert('O campo nome nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";
        
        
    }elseif($row2 >0){
      
       
          if($row1>0){
            $incluircadastro = $conexao ->prepare(" UPDATE base_clientes SET  senha = md5('{$senha_cliente}'),email='$email_cliente',rg='$rg_cliente',CPF='$cpf_cliente',telefone_contato='$telefone_cliente',credito_cliente='$credito_cliente',tipo_valor='$tipo_valor',prazo_cliente='$prazo_cred',desconto='$desconto',prazo_nota='$prazo_nota',obs='$obs',tipo_nota='$tipo_nota',administrador='$administrador' where codigo_cliente = '{$codigo_cliente}'");
            $incluircadastro->execute();
            header('location: form_cadastro_cliente.php');
         
        }else {
            

            echo "<script>alert('usuario sem permissão para realizar esta ação');</script>";
                 echo "<script>history.go(-1)</script>";


          }
    }else{
       $incluircadastro = $conexao ->prepare("INSERT INTO base_clientes(id,email,codigo_cliente,nome_cliente,credito_cliente,prazo_cliente,CPF,prazo_nota,desconto,tipo_valor,senha,telefone_contato,rg,administrador,tipo_nota,obs) VALUES ('$n_c','$email_cliente','$n_c','$nome_cliente','$credito_cliente','$prazo_cred','$cpf_cliente','$prazo_nota','$desconto','$tipo_valor',md5('{$senha_cliente}'),'$telefone_cliente','$rg_cliente','$administrador','$tipo_nota','$obs')");
       $incluircadastro->execute();
      header('location: form_cadastro_cliente.php');
    }
    
} catch (PDOException $e) {
    echo "erro: " . $e->getMessage();
}