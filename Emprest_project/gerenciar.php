
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
<html lang="en">
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
            <a href="#" ><button class="btn">Adicionar Cadastro</button></a>
            
        </div>
    </nav>
    
    <div class="container">
        <div class="con-title">
            <h1>Gerenciar</h1>
            <h3>Painel de Controle</h3>
            
        </div>
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
        
        
    </div>

    <?php
        //finaliza a conexao
        mysqli_close($conexao);
    ?>
    

       
</body>
</html>