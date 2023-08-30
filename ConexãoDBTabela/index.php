
<?php
        
    //executa a query com base na conexão
    include_once('conexao.php');
    

    //executa a query com base na conexão
    $query = mysqli_query($conexao, "select * from produtos");

    if (!$query){
        die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
    }
    
    //retorna uma matriz que corresponde a linha - ponteiro
?>

<table>
    <tr>
        <th>Id</th>
        <th>Codigo</th>
        <th>produto</th>
        <th>Descrição</th>
        <th>Data</th>
        <th>Valor</th>
        <th>Operações</th>
    </tr>
    <tbody>
        <?php while($dados = mysqli_fetch_array($query)){ ?>
            <tr>
            <td><?= $dados['id']?></td>
            <td><?= $dados['codigo'] ?></td>
            <td><?= $dados['produto']?></td>
            <td><?= $dados['descricao']?></td>
            <td><?= $dados['data']?></td>
            <td><?= $dados['valor']?></td>
            <td><a href="detalhes.php?id=<?= $dados['id']?>">detalhes</a></td>
                                <!-- ? envia a variavel para outra tela -->
            </tr>
            <?php } ?>
    </tbody>
</table>  

   


    

<?php
    //finaliza a conexao
    mysqli_close($conexao);
?>
