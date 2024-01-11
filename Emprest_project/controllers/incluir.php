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
        $nasc = $_POST['nasc'];

        //criando insert
        $insert = "insert into teste(id, nome, Nasc) values ($id, '$nome', '$nasc')";

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

















