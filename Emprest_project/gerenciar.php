
<?php
    
    //executa a query com base na conexão
    include_once('controllers/conexao.php');
    
    
    //executa a query com base na conexão
    $query = mysqli_query($conexao, "select * from teste");
    if (!$query){
        die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
    }

   
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Cadastros</title>
    <link rel="stylesheet" href="styles/gerenciar.css">
    <script src="scripts/gerenciar.js"></script>
</head>
<body>

    
    <nav>
        <div class="navbar">
        
            <ul class="itens">
                <a href="inicial.php" ><li class="btn">Página inicial </li></a>
                <a href="#" ><li class="btn">Estatísticas</li></a>
                <a href="gerenciar.php" ><li class="btn">Gerenciar Cadastros</li></a>                    
            </ul>
            <a href="cad.php"><button class="btn">Adicionar Cadastro</button></a>
            
        </div>
    </nav>

    <div class="aling">
        
        <div class="container-top">
            <div class="con-title">
                <h1>Gerenciar</h1>
                <h3>Painel de Controle</h3>
            </div>
        </div>
        
        <div class="div_pesquisa">
            <div class="input-group" id="div_busc">
                <input type="text" name="busc" id="busc" class="input-group_input" 
                onkeyup="buscar()"   placeholder="       Pesquisar">
                <img src="icons/lupa.png" alt="lupa" id="lupa">
            </div>
            <img src="icons/filtro2.png" alt="filtro" class="icon">
        </div>
        <div id="componentes">
            
            <div id="table">
                
                <table class="tabela_dados">
                    <tbody id="tbody">
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>NASC</th>
                            <th>-------</th>
                            <th>-------</th>
                            <th>-------</th>
                            <th>-------</th>
                            <th>-------</th>
                            <th>-------</th>
                            <th>-------</th>
                            
                        </tr>                     

                        <?php while($dados = mysqli_fetch_array($query)){ ?>
                            <tr class="trValue" onclick="trOn(this)">
                                <td class="tdValue" id="select"><?= $dados['id']?></td>
                                <td class="tdValue"><?= $dados['nome'] ?></td>
                                <td class="tdValue"><?= $dados['Nasc']?></td>
                                
                                <!-- <td class="tdValue"><a href="<?= $dados['descricao']?>"  target="_blank">Comprar</a></td> -->
                                <!-- <td class="tdValue"><a href="detalhes.php?id=<?= $dados['id']?>">detalhes</a></td> -->
                                                    <!-- ? envia a variavel para outra tela -->
                            </tr>
                            <?php } ?>
                        

                    </tbody>  
                </table>  
            </div>
            
            <div id='box_acoes'>
                <div>
                    <a href="cad.php"> <button class="acoes" id="cad"> Adicionar Cadastro </button> </a>
    
                    <form action="editar_cad.php" name="editarProduto" method="post"> 
                        <input type="txt" name="IdEditar" id="inputIds_editar" style="display: none">
                        <input class="acoes" id="editar" type="button" value="Ver Detalhes" disabled>
                    </form>

                </div>
                
                <!-- <form  name="form_preView" id="form_preView" method="post"> 
                    <input type="txt" name="IdPreView" id="inputIds_preView" value="select" style="display: block">
                    <input class="acoes" id="preView_sub" type="submit" style="display: block">
                </form> -->
               
                    
                
                <form action="controllers/excluir.php" name="deleteProduto" method="post"> 
                    <input type="txt" name="IdsExcluir" id="inputIds_excluir" style="display: none">
                    <input class="acoes" onclick="confirmExcluir(this)" id="excluir" type="button" value="Excluir" disabled>
                </form>
               
                <!-- 
                <button class="acoes"></button>
                <button class="acoes"></button>
                <button class="acoes"></button> 
                -->
            </div>
            <div style="color: #071A5F; cursor:default">
                Pré-View
                <div Id="preView">
                    <div id="title"><p id="p_title"> </p> </div>
                    <p id="p1"></p>
                    <p id="p2"></p>
                </div>
            </div>
        </div>

        <?php        
            //finaliza a conexao
            mysqli_close($conexao);
        ?>
    </div>
    

       
</body>
</html>