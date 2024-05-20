<?php
    
    include_once('controllers/conexao.php');    
    include('menu.php');
    $ultimosCad = mysqli_query($conexao, "SELECT * FROM produtos ORDER BY id DESC LIMIT 6;");    


    
    if (isset($_GET['deslog'])) { 
            
        echo "<script>alert('Deslogado com sucesso!');</script>";
    
    }
    if (isset($_GET['logado'])) { 
            
        echo "<script>alert('Logado com sucesso! Bem vindo(a), ".$user."');</script>";
    
    }

    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDonThaTrack</title>
    <link rel="stylesheet" href="styles/index.css">
    <script src="scripts/index.js"></script>
</head>

<body>

    <div class="img_capa">
        <img src="imgs/pessoaAndando.jpg" alt="foto_capa" class="img">
    </div>
    <div id="input-container">
        <div class="lineBusc"></div>
        <input type="text" autocomplete="off" name="text" id="inputBusc" placeholder="Pesquisar no site...">
    </div>
    <div class="destaques_div">
        <div class="labeldestq_div">
            <h2>novidades</h2> confira nossos lançamentos!
        </div>
        <div class="carousel">
            <div class="cards-container">
                <?php
                
                while($novidades = mysqli_fetch_array($ultimosCad)){
                    $codP = $novidades['codP'];
                    $imagens = mysqli_query($conexao, "SELECT * FROM imagens WHERE codP = $codP");
                    $dadosImg = mysqli_fetch_array($imagens);
                    ?>

                    <div class="card">
                        <div class="imgCard">
                           
                            <img src="<?= $dadosImg['path']?>" alt="produto_img" class="img2">
                        </div>
                        <a href="viewproduto.php?user=<?= $user?>&codP=<?= $codP ?>">
                            <div class="acoesCard">
                                comprar
                            </div>
                        </a>
                        <br>
                        <p class="nomeP"> <?= $novidades['titulo']?></p>
                        <p class="precoP"><del>R$<?= $novidades['preco_risc']?></del> <b>R$<?= $novidades['preco']?></b> </p>
                    </div>


                    <?php
                }
                ?>
                
            </div>
            <button class="prev-btn">
                <img src="iconsJD/seta.png" alt="setaPrev" class="img">
            </button>
            <button class="next-btn">
                <img src="iconsJD/seta.png" alt="setaPrev" class="img">
            </button>
        </div>
        <div id="alingFull">
            <div class="FullImg_div">
                <div class="FullImg_txt">
                    <h2>em Destaque!</h2>

                    <button class="FullBtn">Ver Destaque</button>
                </div>
                <img src="imgs/trapper.jpg" alt="img_promocional" class="img3">
                <div class="lineFullImg"></div>
                <div class="lineFullImg2"></div>
            </div>
        </div>

        <div class="alingV">
            <a href="produtos.php?user=<?=$user?>"><button id="verMaisBtn">Mais produtos</button></a>
            

        </div>

        <?php include('rodape.php');
        
        ?>
    </div>
</body>

</php>