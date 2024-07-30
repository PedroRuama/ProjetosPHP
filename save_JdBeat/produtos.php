<?php

include_once('controllers/conexao.php');

include('menu.php');



$ultimosCad = mysqli_query($conexao, "SELECT * FROM beats");
// ORDER BY id DESC LIMIT 6; 



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produtos</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/modal.css">
    <script src="scripts/produtos.js"></script>
    <script src="scripts/modal.js"></script>
</head>

<script> 
    function busc() {
        console.log("1");
        var busc = document.getElementById("inputBusc").value.toLowerCase();
        var card_beat =document.getElementsByClassName("card")
       

        for (let index = 0; index < card_beat.length; index++) {
            const beat_name = card_beat[index].getElementsByClassName("nomeP")[0].innerHTML.toLowerCase();

            if(beat_name.includes(busc)){
                card_beat[index].style.display = "flex";
                // card_beat[index].removeProperty("display");
            }else{
                card_beat[index].style.display = "none";
            }
            
        }
    }
    
</script>

<body>
    <div class="labelselct_div">
        <p>JDONTHATRACK®</p>
        <h2> &nbsp; beats</h2>
        
    </div>
    <div id="input-container2">
        <div class="lineBusc"></div>
        <input type="text" autocomplete="off" name="text" id="inputBusc" placeholder="Pesquisar no site..." onkeyup="busc()">
    </div>
    <div class="grid-container">
        <?php
        while ($novidades = mysqli_fetch_array($ultimosCad)) {
            $codP = $novidades['codP'];
            $imagens = mysqli_query($conexao, "SELECT * FROM imagens WHERE codP = $codP");
            $dadosImg = mysqli_fetch_array($imagens);
        ?>

            <div class="card" onclick="PopUpCard(this)">
                <span class="openPopupBtn">
                    <div class="imgCard">

                        <img src="<?= $dadosImg['path'] ?>" alt="produto_img" class="img2">
                    </div>
                    <a>
                        <!-- href="viewproduto.php?user=<?= $user ?>&codP=<?= $codP ?>" -->
                        <div class="acoesCard">
                            OUVIR
                        </div>
                    </a>
                </span>
                <br>
                <p class="nomeP"><?= $novidades['titulo'] ?> </p>

                <p class="precoP"><del>R$<?= $novidades['preco_risc'] ?></del> <b>R$<?= $novidades['preco'] ?></b> </p>
                <p class="nomeP"><?= $novidades['categoria'] ?> </p>


                <div id="audioModal" class="modal audioModal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="beat-content">
                            <div class="imgCardModal">
                                <img src="<?= $dadosImg['path'] ?>" alt="produto_img">
                            </div>
                            <div class="txtModal">
                                <h3><?= $novidades['titulo'] ?></h3>

                                <br>
                                <h4>Estilo do Beat: <?= $novidades['categoria'] ?></h4>
                                <br>
                                <br>
                                <del>R$<?= $novidades['preco_risc'] ?></del> <b>R$<?= $novidades['preco'] ?></b>
                                <br>
                                <?= $novidades['descricao'] ?>
                                <br>
                                <br>
                                <form action="" method="post"></form>
                                <button type="submit" class="btn_compra" id="comprar_btn">comprar</button>
                            </div>
                        </div>

                        <!-- <audio id="audioPlayer" controls>
                                    <source src="beats/100 Shooters [Prod. By JD On Tha Track & Chophouze] 159 Bpm.mp3" type="audio/mpeg">
                                    Seu navegador não suporta o elemento de áudio.
                                </audio> -->
                        <a href="<?= $novidades['link'] ?>" target="_blank"> <button type="button" class="ouvir_btn">Ouvir Prévia</button> </a>
                    </div>
                </div>
            </div>


        <?php
        }
        ?>


    </div>
</body>

</html>