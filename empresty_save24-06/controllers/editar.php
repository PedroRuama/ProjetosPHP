
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

        //criando insert
        $update = "update pessoas set nome='$nome', cpf='$cpf', rg='$rg', ende='$ende', tel='$tel', email='$email', social='$social', 
        val_emp=$val_emp, data_emp='$data_emp', juros=$juros, data_dev='$data_dev', val_dev=$val_dev, sobrenome='$sobrenome', 
        detalhes='$detalhes', pagamento='$pagamento', situacao='$situacao', parcelas='$parcelas', parcelas_pagas='$parcelas_pagas', diapag=$diapag, val_parcela=$val_parcela where id=$id";

        $select = $_POST['select'];
        $valmin = $_POST['rangeMin'];
        $valmax = $_POST['rangeMax'];

        //executando instrução SQL
        $resultado = @mysqli_query($conexao, $update);
        if(!$resultado){
            die('Query Inválida:'.@mysqli_error($conexao));
            
        } else {?>
            <script>window.location.href = "../gerenciar.php?select=<?= $select?>&rangeMin=<?= $valmin?>&rangeMax=<?= $valmax?>"</script>
            <?php
        }
        mysqli_close($conexao);


        
    ?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
</head>
<body>


    
</body>
</html>

















