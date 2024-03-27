<?php
    
    include_once('controllers/conexao.php');
    $user=0;


    if (isset($_GET['user'])) {
        $user = $_GET['user'];
        $select_user = mysqli_query($conexao, "SELECT * from users where user_name='$user'");
        $dadosU = mysqli_fetch_array($select_user);
    }


    $ultimosCad = mysqli_query($conexao, "SELECT * FROM produtos ORDER BY id DESC LIMIT 6;");

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
    <div class="box_nav">
        <div class="alingV">
            <div class="alingH">
                <div class="icon">
                    <img src="iconsJD/menu.png" alt="menu" class="img" id="open-btn">
                </div>
                <nav class="sidenav" id="sidenav">
                    <div class="alingH">
                        <div class="logo_nav">
                        </div>
                        <div id="close-btn" class="close-btn">
                            <img src="iconsJD/close.png" alt="fechar" class="img">
                        </div>
                    </div>


                    <ul>
                        <li><a href="#">
                                <div class="user_div" id="open-btn2">
                                    <img src="iconsJD/user.png" alt="user" class="img" id="img_user">
                                    <p> Minha Conta</p>
                                </div>
                            </a></li>
                        <li><a href="index.php">Home Page</a></li>
                        <li><a href="routes/produtos.php">Camisetas</a></li>
                        <li><a href="#">Moletons</a></li>
                        <li><a href="#">acessórios</a></li>
                    </ul>
                </nav>

                <nav class="sidenav" id="sidenav2">
                    <button id="close-btn2">Voltar</button>
                    <br>
                    <ul>
                        <li>
                            <div class="user_div">
                                <img src="iconsJD/userRed.png" alt="user" class="img" id="img_user">
                                <p> Minha Conta</p>
                            </div>
                        </li>

                        <?php
                        if ($user!=0) {
                            
                        ?>
                            <div class="optionsConta" id="logado">
                                <br>
                                <p><?= $dadosU['user_name']?></p>
                                <br>
                                <li><a href="">Favoritos</a></li>
                                <li><a href="">Pedidos</a></li>
                                <li><a href="">Meu Cadastro</a></li>
                                <li><a href="index.php">Sair</a></li>
                                <br>
                                <br>
                                <br>

                                <?php
                                if ($user=='JdAdm') {
                                ?>
                                     <li><a href="routes/gerenciar.php">Gerenciar Loja</a></li>
                                <?php
                                }
                                ?>
                            </div>
                        <?php

                        } else {
                        ?>

                            <div class="optionsConta" id="login">
                                <li><a href="routes/criarconta.php">Criar Conta</a></li>
                                <li><a href="routes/login.php">Entrar</a></li>
                            </div>

                        <?php
                        }


                        ?>
                    </ul>
                </nav>

                <div class="logo_div">
                    <img src="imgs/logofake2.png" alt="logo" class="img">
                </div>
                <div class="icon">
                    <img src="iconsJD/sacola.png" alt="carrinho" class="img">
                </div>
            </div>

        </div>
    </div>
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
                        <a href="routes/viewproduto.php?user=<?= $user?>&codP=<?= $codP ?>">
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
            <button id="verMaisBtn" onclick="hrefGo()">Mais produtos</button>

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
    </div>

</body>

</php>