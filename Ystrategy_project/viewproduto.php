<?php

include_once('controllers/conexao.php');
include('menu.php');


if (isset($_GET['codP'])) {
    $codP = $_GET['codP'];
    $select_produto = mysqli_query($conexao, "SELECT * from produtos where codP = $codP");
    $dadosP = mysqli_fetch_array($select_produto);
    
    $imagens = mysqli_query($conexao, "SELECT * FROM imagens WHERE codP = $codP");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="stylesheet" href="styles/viewprodutos.css">
    <script src="scripts/produtos.js"></script>
</head>

<body>


    <div class="containerGeral">
        <div class="alingH" id="containerImgs">
            
            <div class="maxImg">
                <div class="lineFullImg"></div>
                <img src="<?= $dadosImg['path'] ?>"  alt="imgMax" class="img3" id="mainImg">
                <div class="like"> <img src="iconsJD/gostar.png" alt="like" class="img"></div>
            </div>
        </div>
        <div class="labelselct_div">
            <p><?= $dadosP['titulo'] ?></p>
            <h2> <del>R$<?= $dadosP['preco_risc'] ?></del> R$<?= $dadosP['preco'] ?></h2>
        </div>

        <div class="compra_div">
            <form action="comprar.php" method="post">
                <input type="number" name="quantidade" placeholder="Quantidade" id="quantidade">
               
                <input type="text" value="<?=$user?>" name="user" style="display: none">
                <input type="text" value="<?=$codP?>" name="codP" style="display: none">

                <select name="tamanho" id="">
                    <option value="p">P</option>
                    <option value="p" selected>M</option>
                    <option value="p">G</option>
                    <option value="p">GG</option>
                </select>

                <div class="alingH">
                     <button type="submit" class="btn_compra" id="comprar_btn">comprar</button>
                    
                    <button type="button" class="btn_compra" id="addsacola_btn">
                        <img src="iconsJD/sacola.png" alt="sacola" class="img">
                    </button>
                </div>
            </form>
        </div>

        <div class="descricao">
            <div class="alingV">
                <div class="alingH" id="desc_peca">
                    Descriçao da peça
                    <div class="icon" id="setaDesc">
                        <img src="iconsJD/seta.png" alt="seta" class="img">
                    </div>
                </div>
                <div class="txt" id="desc_peca_txt">
                    <p> CAMISETA BAW REGULAR HOUSE TOY<br><br>

                        Camiseta manga curta confeccionada em tecido de algodão. Possui estampa na parte frontal. <br><br>

                        P - Comprimento: 25cm/ Torax: 64cm/ Barra: 64cm/ Manga: 22cm/ Cava: 25cm.<br>
                        M - Comprimento: 26cm/ Torax: 67cm/ Barra: 67cm/ Manga: 23cm/ Cava: 26cm.<br>
                        G - Comprimento: 27cm/ Torax: 70cm/ Barra: 70cm/ Manga: 24cm/ Cava: 27cm.<br>
                        GG - Comprimento: 28cm/ Torax: 74cm/ Barra: 73cm/ Manga: 25cm/ Cava: 28cm.<br>
                        <br>
                        *MEDIDAS APROXIMADAS.
                        <br><br>

                        *Este anúncio se refere somente a camiseta. Os demais itens contidos na imagem, são vendidos separadamente.
                        <br><br>
                        Composição: 100% algodão.

                    </p>
                </div>
            </div>
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