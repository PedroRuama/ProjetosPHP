
<?php
        
  
    include_once('controllers/conexao.php');
    

    //executa a query com base na conexão
    $query = mysqli_query($conexao, "select * from produtos");

    if (!$query){
        die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
    }
    
    //retorna uma matriz que corresponde a linha - ponteiro

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja dataBase</title>
    <link rel="stylesheet" href="style/index.css">

</head>
    <script src="scripts/index.js"></script>
<body>
    <div class="center">
        <div id="opacity"> .</div>
        <div id="back_img">
            <img src="imgs/backgrund_image2.jpg" alt="fundo salgadinhos">
        </div>
        <h1>Produtos Cadastrados</h1>
        <div class="input-group" id="div_busc">
            <input type="text" name="busc" id="busc" class="input-group_input" onkeyup="buscar()" onfocus="InputProd(this)" onfocusout="InputProd(this)">
            <label for="pesquisar" id="busc_label" class="input-group_label">Pesquisar na tabela</label>
            
        </div>
        

        <div id="componentes">

            <div id="table">
                
                <table class="tabela_dados">
                    <tr>
                        <th>ID</th>
                        <th>CODIGO</th>
                        <th>PRODUTO</th>
                        <th>DATA</th>
                        <th>VALOR</th>
                        <th>EXIBIR</th>
                        
    
                    </tr>                     
                    <tbody id="tbody">

                        <?php while($dados = mysqli_fetch_array($query)){ ?>
                            <tr class="trValue" onclick="trOn(this)">
                                <td class="tdValue" id="select"><?= $dados['id']?></td>
                                <td class="tdValue"><?= $dados['codigo'] ?></td>
                                <td class="tdValue"><?= $dados['produto']?></td>
                                <!-- <td class="tdValue"><?= $dados['descricao']?></td> -->
                                <td class="tdValue"><?= $dados['data']?></td>
                                <td class="tdValue">R$<?= $dados['valor']?></td>
                                <td class="tdValue"><a href="detalhes.php?id=<?= $dados['id']?>">detalhes</a></td>
                                                    <!-- ? envia a variavel para outra tela -->
                            </tr>
                            <?php } ?>
                        

                    </tbody>
                    

                    
                </table>  
            </div>
            <div id='box_acoes'>
                <a href="cad_produto.php"> <button class="acoes" id="cad"> CADASTRAR </button> </a>
                        
                <form action="controllers/excluir.php" name="deleteProduto" method="post"> 
                    <input type="txt" name="Ids" id="inputIds" style="display: none">
                    <input class="acoes" onclick="confirmExcluir(this)" id="excluir" type="button" value="Excluir" disabled>
                </form>
               
                <!-- 
                <button class="acoes"></button>
                <button class="acoes"></button>
                <button class="acoes"></button> 
                -->
            </div>
        </div>
    </div>

    <?php
        //finaliza a conexao
        mysqli_close($conexao);
    ?>
    

</body>
</html>
