
<?php
    
    //executa a query com base na conexão
    include_once('controllers/conexao.php');

    $select = 0;
    
    switch ($select) {
        case 0:
            $query = mysqli_query($conexao, "select * from pessoas");
            break;
        case 1:
            echo "i equals 1";
            break;
        case 2:
            echo "i equals 2";
            break;
    }


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
            <div ><h3 id="nome_tabela">nome da tabela</h3></div>
            <div class="input-group" id="div_busc">
                <input type="text" name="busc" id="busc" class="input-group_input" 
                onkeyup="buscar()"   placeholder="       Pesquisar ">
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
                            <th>TELEFONE</th>
                            <th>EMPRESTIMO</th>
                            <th>DATA DO <br> EMPRESTIMO</th>
                            <th>DATA DA <br> DEVOLUÇÃO</th>
                            <th>SITUAÇÃO</th>
                            
                            
                        </tr>                     
                       

                        <?php while($dados = mysqli_fetch_array($query)){ ?>
                            <tr class="trValue" onclick="trOn(this)">
                                <td class="tdValue" id="select"><?= $dados['id']?></td>
                                <td class="tdValue"><?= $dados['nome'] ?></td>
                                <td class="tdValue"><?= $dados['tel'] ?></td>
                                <td class="tdValue">R$<?= $dados['val_emp'] ?></td>
                                <td class="tdValue"><?=  date('d/m/Y', strtotime($dados['data_emp'])) ?></td>
                                <td class="tdValue"><?= date('d/m/Y', strtotime($dados['data_dev']))?></td>
                                <td class="tdValue">
                                    <div class="situacao">
                                    <?php
                                       
                                        if( $dados['situacao'] == 'Em Divida'){
                                            echo '<div id="divida" class="situ"></div>';
                                        }
                                        if( $dados['situacao'] == 'Quitado'){
                                            echo '<div id="quitado" class="situ"></div>';
                                        }
                                   
                                    
                                    ?>
                                        

                                    </div>
                                </td>
                                
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
    
                    <form action="vermais.php" name="editarProduto" method="get"> 
                        <input type="txt" name="IdView" id="inputIds_editar" style="display: none">
                        <input class="acoes" id="editar" type="button" value="Ver Detalhes" disabled>
                    </form>

                </div>
               
                <form action="controllers/excluir.php" name="deleteProduto" method="post"> 
                    <input type="txt" name="IdsExcluir" id="inputIds_excluir" style="display: none">
                    <input class="acoes" onclick="confirmExcluir(this)" id="excluir" type="button" value="Excluir" disabled>
                </form>
            </div>
            <div style="color: #071A5F; cursor:default">
                Pré-View
                <div Id="preView">
                    <div id="title"><p id="p_title"> </p> </div>
                    <p id="p1"></p>
                    <p id="p2"></p>
                    <p id="p3"></p>
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