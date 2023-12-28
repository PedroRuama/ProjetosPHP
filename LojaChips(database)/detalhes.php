<?php 
    //executa a query com base na conexão
    include_once('controllers/conexao.php');
    

    //recupera a informação da URL
    $id = $_GET['id'];

    //realiza a pesquisa com o id recebido
    $query = mysqli_query($conexao, "select * from produtos where id = $id");

    if (!$query){
        die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
    }
    $dados = mysqli_fetch_array($query);
?>

<body>
    <h1> <?= $dados['produto']?>  </h1>    
 
</body>