
<?php
        
  
    include_once('controllers/conexao.php');
    

    //executa a query com base na conexão e o comando
    $query = mysqli_query($conexao, "select * from produtos");

    if (!$query){
        die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
    }
    



    // Validando a existencia de um registro:

    // $resultado= @mysqli_query($conexao, $sqlconsulta);
    // $num = @mysqli_num_rows($resultado);
    // if($num == 0){
    //     echo "Código não localizado!!";
    // }



?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja ElmaChips</title>
    <link rel="stylesheet" href="style/index.css">

    
</head>
    <script src="scripts/index.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<body>
    <div id="opacity"> .</div>
    <div class="center">
        <div id="logo-title-div">
            <img src="imgs/elma_logo.png" alt="logo" id="logo">
           
            <h1>Produtos Cadastrados</h1>
        </div>
        
        
        <div class="input-group" id="div_busc">
            
            <input type="text" name="busc" id="busc" class="input-group_input" onkeyup="buscar()" onfocus="InputProd(this)" onfocusout="InputProd(this)" placeholder="    Pesquisar">
            <img src="imgs/lupa.png" alt="lupa" id="lupa">
        </div>
        <br>
        <div id="componentes">

            <div id="table">
                
                <table class="tabela_dados">
                    <tbody id="tbody">
                        <tr>
                            <th>ID</th>
                            <th>CODIGO</th>
                            <th>PRODUTO</th>
                            <th>DATA</th>
                            <th>VALOR</th>
                            <th>EXIBIR</th>
                        </tr>                     

                        <?php while($dados = mysqli_fetch_array($query)){ ?>
                            <tr class="trValue" onclick="trOn(this)">
                                <td class="tdValue" id="select"><?= $dados['id']?></td>
                                <td class="tdValue"><?= $dados['codigo'] ?></td>
                                <td class="tdValue"><?= $dados['produto']?></td>
                                <td class="tdValue"><?= $dados['data']?></td>
                                <td class="tdValue">R$<?= $dados['valor']?></td>
                                <td class="tdValue"><a href="<?= $dados['descricao']?>"  target="_blank">Comprar</a></td>

                                <!-- <td class="tdValue"><a href="detalhes.php?id=<?= $dados['id']?>">detalhes</a></td> -->
                                                    <!-- ? envia a variavel para outra tela -->
                            </tr>
                            <?php } ?>
                        

                    </tbody>
                    

                    
                </table>  
            </div>
            <div id='box_acoes'>
                <a href="cad_produto.php"> <button class="acoes" id="cad"> CADASTRAR </button> </a>
                        
                <form action="controllers/excluir.php" name="deleteProduto" method="post"> 
                    <input type="txt" name="IdsExcluir" id="inputIds_excluir" style="display: none">
                    <input class="acoes" onclick="confirmExcluir(this)" id="excluir" type="button" value="Excluir" disabled>
                </form>

                <form action="editar_cad.php" name="editarProduto" method="post"> 
                    <input type="txt" name="IdEditar" id="inputIds_editar" style="display: none">
                    <input class="acoes" id="editar" type="button" value="Editar" disabled>
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
