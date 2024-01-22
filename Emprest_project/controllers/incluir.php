<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
</head>
<body>

    <?php
        include_once('conexao.php');

        echo $id = $_POST['id']; 
        echo '<br>';
        echo $nome =$_POST['nome'];
        echo '<br>';
        echo $cpf = $_POST['cpf'];
        echo '<br>';
        echo $rg = $_POST['rg'];
        echo '<br>';
        echo $ende = $_POST['ende'];
        echo '<br>';
        echo $tel = $_POST['tel'];
        echo '<br>';
        echo $email = $_POST['email'];
        echo '<br>';
        echo $social = $_POST['social'];
        echo '<br>';
        echo $val_emp = $_POST['val_emp'];
        echo '<br>';
        echo $data_emp = $_POST['data_emp'];
        echo '<br>';
        echo $juros = $_POST['juros'];
        echo '<br>';
        echo $data_dev = $_POST['data_dev'];
        echo '<br>';
        echo $val_dev = $_POST['val_dev'];
        echo '<br>';
        echo $sobrenome = $_POST['sobrenome'];
        echo '<br>';
        echo $detalhes = $_POST['detalhes'];
        echo '<br>';
        echo $pagamento = $_POST['pagamento'];
        echo '<br>';
        echo $situacao = $_POST['situacao'];
        
        

        //criando insert
        $insert = "insert into pessoas( id, nome, cpf, rg, ende, tel, email, social, val_emp, data_emp, juros, data_dev, val_dev, sobrenome, detalhes, pagamento) 
        values($id, '$nome', '$cpf', '$rg', '$ende', '$tel', '$email', '$social', $val_emp, '$data_emp', $juros, '$data_dev', $val_dev, '$sobrenome', '$detalhes', '$pagamento', '$situacao')";

        //executando instrução SQL
        $resultado = @mysqli_query($conexao, $insert);
        if(!$resultado){
            die('Query Inválida:'.@mysqli_error($conexao));
         } else {?>
            <script>window.location.href = "../gerenciar.php";</script>

        <?php
        }
        mysqli_close($conexao);


        
    ?>

    
</body>
</html>

















