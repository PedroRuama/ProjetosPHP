<?php
    
    include_once('controllers/conexao.php');

    include('menu.php');


    
    
    
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <script src="scripts/produtos.js"></script>
</head>
<body>
    <div class="labelselct_div">
        <p>JDONTHATRACK® </p> <h2>Beats</h2>
    </div>
    <div id="input-container2">
        <div class="lineBusc"></div>
        <input type="text" autocomplete="off" name="text" id="inputBusc" placeholder="Pesquisar no site...">
    </div>
    <div class="grid-container">
        <div class="card">
            <div class="imgCard">
                <img src="imgs/ExmpCamiseta.png" alt="produto_img" class="img2">
                <a href="viewproduto.php?user=<?=$user?>">
                    <div class="acoesCard">
                        comprar
                    </div>
                </a>
            </div>
            <br>
            <p class="nomeP"> Camiseta Preta</p>
            <p class="precoP"><del>$149,99</del> <b>R$69,99</b></p>
        </div>
        <div class="card">
            <div class="imgCard">
                <img src="imgs/ExmpCamiseta.png" alt="produto_img" class="img2">
                <a href="viewproduto.php?user=<?=$user?>">
                    <div class="acoesCard">
                        comprar
                    </div>
                </a>
            </div>
            <br>
            <p class="nomeP"> Camiseta Preta</p>
            <p class="precoP"><del>$149,99</del> <b>R$69,99</b></p>
        </div>
        <div class="card">
            <div class="imgCard">
                <img src="imgs/ExmpCamiseta.png" alt="produto_img" class="img2">
                <a href="viewproduto.php?user=<?=$user?>">
                    <div class="acoesCard">
                        comprar
                    </div>
                </a>
            </div>
            <br>
            <p class="nomeP"> Camiseta Preta</p>
            <p class="precoP"><del>$149,99</del> <b>R$69,99</b></p>
        </div>
        <div class="card">
            <div class="imgCard">
                <img src="imgs/ExmpCamiseta.png" alt="produto_img" class="img2">
                <a href="viewproduto.php">
                    <div class="acoesCard">
                        comprar
                    </div>
                </a>
            </div>
            <br>
            <p class="nomeP"> Camiseta Preta</p>
            <p class="precoP"><del>$149,99</del> <b>R$69,99</b></p>
        </div>
        
    </div>
    <div class="rodape">
        <div class="alingH">
            <div class="alingV">
                <div class="icon">
                    <img src="iconsJD/instagram.png" alt="insta" class="img">
                    <p>@JDonThaTrack</p>
                </div>
                <div class="icon">
                    <img src="iconsJD/twitter.png" alt="insta" class="img">
                    <p>@JDonThaTrack17</p>
                </div>
                <div class="icon">
                    <img src="iconsJD/telefone.png" alt="telefone" class="img">
                    <p>(19) 99999-3232</p>
                </div>
                <div class="icon">
                    <img src="iconsJD/o-email2.png" alt="email" class="img">
                    <p>jdnthatrack@gmail.com</p>
                </div>
            </div>
            <img src="imgs/logofake.png" alt="logo" class="img">
        </div>
        <div class="alingV">
            <h5>JDONTHATRACK® - Todos os direitos reservados | Rua Dos Perdidos - Nº 340 -Campinas
                - SP / São Paulo - CNPJ: 17.267.044/0001-85 </h5>
            <br>
            <ul>
                <li><a href="#">Sobre nós</a> <img src="iconsJD/setaBranca.png" alt="seta" class="img"> </li>
                <li><a href="#">História</a> <img src="iconsJD/setaBranca.png" alt="seta" class="img"></li>
                <li><a href="#">Fale Conosco</a> <img src="iconsJD/setaBranca.png" alt="seta" class="img"></li>
                <li><a href="#">Troca/Devolução</a> <img src="iconsJD/setaBranca.png" alt="seta" class="img"></li>
            </ul>
        </div>
    </div>
</body>
</html>