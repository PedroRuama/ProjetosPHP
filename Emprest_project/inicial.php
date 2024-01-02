

<?php
    
    //executa a query com base na conexão
    include_once('controllers/conexao.php');
    

    //executa a query com base na conexão
    $query = mysqli_query($conexao, "select * from teste");
    $aviso = mysqli_query($conexao, "select * from teste");
    if (!$query){
        die('Query Invalida: ' . @mysqli_error($conexao)); //mostra o erro 
    }

?>


<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pagina Inicial</title>
        <link rel="stylesheet" href="styles/inicial.css">
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
                <h1>Inicial</h1>
                <h3>Notificações e avisos</h3>
                <div class="img_div">
                    <img src="imgs/avisos.svg" alt="avisos img" class="img">
                </div>
            </div>

            <div class="con-warning">
                <p id="aviso_label">O prazo de revisão esta chegando na data</p> 
                <?php while($dados = mysqli_fetch_array($query)){ ?>
                    <div class="avisos_div">
                        <div class="avisos">
                            <img src="icons/aviso.png" alt=""  class="iconAviso">
                            <div class="dados_aviso">
                                <?= $dados['id']?>
                                <?= $dados['nome']?>
                                <?= $dados['Nasc']?>
                                <!-- <img src="icons/seta-direita.png" alt="" class="iconAviso" id="seta"> -->
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                   
                    <div class="atencao_div">
                        <p id="atencao_label">Atenção ao prazo de revisão</p> 
                        <div class="avisos">
                            <img src="icons/ponto-de-exclamacao.png" alt=""  class="iconAviso">
                            <div class="dados_atencao">
                                <?php while( $teste= mysqli_fetch_array($aviso)){ 
                                       echo $teste['id'];
                                       echo $teste['nome'];
                                       echo $teste['Nasc'];
                                       echo '<br> <br>';
                                    }
                                ?>


                                
                            </div>

                        </div>
                    </div>
                


            </div>

        </div>




    </body>
</html>