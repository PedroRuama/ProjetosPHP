<?php 
    include_once('controllers/conexao.php');
        
        
    //executa a query com base na conexão
    $query = mysqli_query($conexao, "select * from pessoas");

    $dados= mysqli_fetch_array($query);

    // Define o fuso horário para o desejado (opcional)
    date_default_timezone_set('America/Sao_Paulo');

    // Obtém a data atual
    $dataAtual = date('Y-m-d');
    echo $dados['data_dev'];
    echo '<br>';


    // Converte a data para o formato desejado
    $dataFormatada = date('d/m/Y', strtotime($dados['data_dev']));

    // Exibe a data formatada
    echo "Data formatada: $dataFormatada";

?>