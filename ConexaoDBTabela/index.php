
<?php
        
    //executa a query com base na conexão
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

    <script>
        
        <?php 
            // $idPHP = array();      
            // php array_push($idPHP, $x, $y);                
       ?>
       


        //selecão da linha: 
        let i = 0 //linhas atiivas

        Selecionado = new Array();

        function trOn(tr) {
            var btnExcluir = document.getElementById('excluir');
            var trOn = tr.classList.toggle('colorir');  //colorir linha tr

            //id(td) da tr selecionada:
            var td = tr.getElementsByTagName("td")[2]; //[0]= id  [2]=nome
            var idSelec = td.innerHTML; 
            
            if(trOn){
                console.log('trOn');
                i = i + 1 //controle de qunatas linhas selecionadas/ligadas 
                console.log("linhas ativas: ", i)

                Selecionado.push(idSelec) //adiciona o item selecionada á array
                console.log(Selecionado)
                
            }
            else{
                tr.classList.remove('colorir');    
                i = i - 1
                
                console.log('trOff');
                console.log("linhas ativas: ", i)
                let index =Selecionado.indexOf(idSelec) //busca se existe e a posiçao do item na array
                Selecionado.splice(index, 1) //apaga o item

                console.log(Selecionado)
                
            } 

            if (i > 0) { //liga e desliga o btn excluir de acordo com o numero de linhas ligadas
                btnExcluir.style = "opacity: 100%; cursor: pointer;"; 
            }   else{btnExcluir.style = "opacity: 30%;  cursor: not-allowed;"}      
        }


        


    </script>

</head>
<body>
    <div class="center">
        <div id="opacity"> .</div>
        <div id="back_img">
            <img src="imgs/backgrund_image2.jpg" alt="fundo salgadinhos">
        </div>
        <h1>Produtos Cadastrados</h1>
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
                    <?php while($dados = mysqli_fetch_array($query)){ ?>
                        <tr onclick="trOn(this)">
                        <td id="select"><?= $dados['id']?></td>
                        <td><?= $dados['codigo'] ?></td>
                        <td><?= $dados['produto']?></td>
                        <!-- <td><?= $dados['descricao']?></td> -->
                        <td><?= $dados['data']?></td>
                        <td><?= $dados['valor']?></td>
                        <td><a href="detalhes.php?id=<?= $dados['id']?>">detalhes</a></td>
                                            <!-- ? envia a variavel para outra tela -->
                        </tr>
                        <?php } ?>
                    
                </table>  
            </div>
            <div id='box_acoes'>
                <a href="cad_produto.php"> <button class="acoes" id="cad"> CADASTRAR </button> </a>
                        
                <form action="" > 
                    <input type="number" name="Ids" style="display:none" value=''>
                    
                    <input class="acoes" id="excluir" type="submit" value="Excluir">
                </form>
               
                <!-- 
                <button class="acoes"></button>
                <button class="acoes"></button>
                <button class="acoes"></button> -->
            </div>
        </div>
    </div>

    <?php
        //finaliza a conexao
        mysqli_close($conexao);
    ?>
    

</body>
</html>
