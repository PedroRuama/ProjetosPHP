<?php
include('conexao.php');
$codigo_cliente = mysqli_real_escape_string($conexao, $_POST['codigo_cliente']);
$nome_cliente = mysqli_real_escape_string($conexao, $_POST['nome_cliente']);
$email_cliente = mysqli_real_escape_string($conexao, $_POST['email_cliente']);
$senha_cliente = mysqli_real_escape_string($conexao, $_POST['senha_cliente']);
$telefone_cliente = mysqli_real_escape_string($conexao, $_POST['telefone_cliente']);
$admin = mysqli_real_escape_string($conexao, $_POST['admin']);
$acesso = mysqli_real_escape_string($conexao, $_POST['acesso']);
$permissao = mysqli_real_escape_string($conexao, $_POST['permissao']);
$hoje = date('Y,m,d');

$query = "select * from cadastro ";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result)+1;

$query1 = "select * from cadastro where USUARIO = '{$nome_cliente}'";
$result1 = mysqli_query($conexao, $query1);
$row1 = mysqli_num_rows($result1);

$query2 = "select * from cadastro where USUARIO = '{$nome_cliente}' or acao = 'Editar' or acao = 'Geral'";
$result2 = mysqli_query($conexao, $query2);
$row2 = mysqli_num_rows($result2);

$query3 = "select * from cadastro where USUARIO = '{$nome_cliente}' AND sessao = '$acesso'";
$result3 = mysqli_query($conexao, $query3);
$row3 = mysqli_num_rows($result3);

try {
    if ($nome_cliente === ""){
        echo "<script>alert('O campo USUARIO nao pode estar vazio');</script>";
        echo "<script>history.go(-1)</script>";
        
    }elseif($senha_cliente  === ""){
        echo "<script>alert('O campo senha nao pode estar vazio');</script>"; 
        echo "<script>history.go(-1)</script>";
    }elseif($row1 >0){
          echo "<script>alert('Cadastro sendo alterado');</script>";
          if($row3===0){
            echo "<script>alert('Cadastro alterado com sucesso');</script>";
            $incluircadastro = $conexao ->prepare("INSERT INTO cadastro (email,USUARIO,SENHA,telefone,sessao,acao,ACESSO) VALUES ('$email_cliente','$nome_cliente',md5('{$senha_cliente}'),'$telefone_cliente','$acesso','$permissao','$admin')");
            $incluircadastro->execute();
            header('location: form_cadastro_usuario.php');

          }else {
            echo "<script>alert('usuario sem permissão para realizar esta ação');</script>";
                 echo "<script>history.go(-1)</script>";


          }
    }else{
        echo "<script>alert('Cadastro sendo realizado');</script>"; 
       $incluircadastro = $conexao ->prepare("INSERT INTO cadastro (email,USUARIO,SENHA,telefone,sessao,acao,ACESSO) VALUES ('$email_cliente','$nome_cliente',md5('{$senha_cliente}'),'$telefone_cliente','$acesso','$permissao','$admin')");
       $incluircadastro->execute();
    //   echo "<script>alert('Cadastro realizado com sucesso');</script>"; 
      echo "<script>location.href='form_cadastro_usuario.php';</script>";
    }
   
} catch (PDOException $e) {
    echo "erro: " . $e->getMessage();
}