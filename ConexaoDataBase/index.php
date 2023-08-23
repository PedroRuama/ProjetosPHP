<?php
    include_once('conexao.php');
    //executa a query com base na conexão
    

    //executa a query com base na conexão
    $query = mysqli_query($conexao, "select * from produtos ");

    if (!$query){
        die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
    }
    
    //retorna uma matriz que corresponde a linha - ponteiro
    $dados = mysqli_fetch_array($query);

    //recupera as informações do array $dados, usando o nome do campo como referencia
    echo "<b> Id: </b>".$dados['id']."<br>";
    echo "<b> Código: </b>".$dados['codigo']."<br>";
    echo "<b> Poduto: </b>".$dados['produto']."<br>";
    echo "<b> Descrição: </b>".$dados['descricao']."<br>";
    echo "<b> Data: </b>".$dados['data']."<br>";
    echo "<b> Valor: </b>".$dados['valor']."<br>";  

    //finaliza a conexao
    mysqli_close($conexao);






?>
