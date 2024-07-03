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

        $id = $_POST['id']; 
        $nome =$_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $ende = $_POST['ende'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $social = $_POST['social'];
        $val_emp = $_POST['val_emp'];
        $data_emp = $_POST['data_emp'];
        $juros = $_POST['juros'];
        $data_dev = $_POST['data_dev'];
        $val_dev = $_POST['val_dev'];
        $sobrenome = $_POST['sobrenome'];
        $detalhes = $_POST['detalhes'];
        $pagamento = $_POST['pagamento'];
        $situacao = $_POST['situacao'];
        $parcelas = $_POST['parcelas'];
        $parcelas_pagas = $_POST['parcelas_pagas'];
        $diapag = $_POST['diapag'];
        $val_parcela = $_POST['val_parcela'];

        // echo $id = $_POST['id']; 
        // echo '<br>';
        // echo $nome =$_POST['nome'];
        // echo '<br>';
        // echo $cpf = $_POST['cpf'];
        // echo '<br>';
        // echo $rg = $_POST['rg'];
        // echo '<br>';
        // echo $ende = $_POST['ende'];
        // echo '<br>';
        // echo $tel = $_POST['tel'];
        // echo '<br>';
        // echo $email = $_POST['email'];
        // echo '<br>';
        // echo $social = $_POST['social'];
        // echo '<br>';
        // echo $val_emp = $_POST['val_emp'];
        // echo '<br>';
        // echo $data_emp = $_POST['data_emp'];
        // echo '<br>';
        // echo $juros = $_POST['juros'];
        // echo '<br>';
        // echo $data_dev = $_POST['data_dev'];
        // echo '<br>';
        // echo $val_dev = $_POST['val_dev'];
        // echo '<br>';
        // echo $sobrenome = $_POST['sobrenome'];
        // echo '<br>';
        // echo $detalhes = $_POST['detalhes'];
        // echo '<br>';
        // echo $pagamento = $_POST['pagamento'];
        // echo '<br>';
        // echo $situacao = $_POST['situacao'];
        // echo '<br>';
        // echo $parcelas = $_POST['parcelas'];
        // echo '<br>';
        // echo $parcelas_pagas = $_POST['parcelas_pagas'];
        // echo '<br>';
        // echo $diapag = $_POST['diapag'];
        // echo '<br>';
        // echo $val_parcela = $_POST['val_parcela'];

        //criando insert
        $insert = "insert into pessoas( id, nome, cpf, rg, ende, tel, email, social, val_emp, data_emp, juros, data_dev, val_dev, sobrenome, detalhes, pagamento, situacao, parcelas, parcelas_pagas, diapag, val_parcela) 
        values($id, '$nome', '$cpf', '$rg', '$ende', '$tel', '$email', '$social', $val_emp, '$data_emp', $juros, '$data_dev', $val_dev, '$sobrenome', '$detalhes', '$pagamento', '$situacao', '$parcelas', '$parcelas_pagas', $diapag, $val_parcela)";
            

        $select = $_POST['select'];
        $valmin = $_POST['rangeMin'];
        $valmax = $_POST['rangeMax'];

        //executando instrução SQL
        $resultado = @mysqli_query($conexao, $insert);
        
        if(!$resultado){
            echo "erro, relate ao responsavel de TI";
            die('Query Inválida:'.@mysqli_error($conexao));
         } else {?>
             <script>window.location.href = "../gerenciar.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>"</script>

         <?php
        }
        mysqli_close($conexao);


        
    ?>

    
</body>
</html>

















