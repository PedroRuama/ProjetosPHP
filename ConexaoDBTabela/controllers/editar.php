
<?php
        include_once('conexao.php');

        $id = $_POST['id'];
        $codigo = $_POST['codigo'];
        $produto = $_POST['produto'];
        $descricao= $_POST['descricao'];
        $data =$_POST['data'];
        $valor = $_POST['valor'];

        //criando insert
        $update = "update produtos set codigo=$codigo , produto='$produto', descricao='$descricao', data='$data', valor=$valor where id=$id";

        //executando instrução SQL
        $resultado = @mysqli_query($conexao, $update);
        if(!$resultado){
            die('Query Inválida:'.@mysqli_error($conexao));
        } else {?>
            <script>window.location.href = "../index.php";</script>
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

















