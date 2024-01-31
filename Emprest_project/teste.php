<?php 
    include_once('controllers/conexao.php');
        
        
    //executa a query com base na conexão
    $query = mysqli_query($conexao, "select * from pessoas");

    $dados= mysqli_fetch_array($query);

    // Define o fuso horário para o desejado (opcional)
    date_default_timezone_set('America/Sao_Paulo');

    // Obtém a data atual
    echo  $dataAtual = date('Y-m-d');
    echo '<br>';
    echo $dados['data_dev'];
    echo '<br>';


    // Converte a data para o formato desejado
    $dataFormatada = date('d/m/Y', strtotime($dados['data_dev']));

    // Exibe a data formatada
   echo "Data formatada: $dataFormatada";
   echo '<br>';
   echo '<br>';
   echo '<br>';





   
    $data1 = new DateTime($dataAtual);
    $data2 = new DateTime($dados['data_dev']);

    // Calcula a diferença em dias
    $diferenca = $data1->diff($data2);

    // Obtém a diferença em dias
    $dias = $diferenca->days;

    echo "Diferença em dias: $dias dias";


?>