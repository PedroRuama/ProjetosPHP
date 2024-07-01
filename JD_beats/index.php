<?php

include_once('controllers/conexao.php');
include('menu.php');

$ultimosCad = mysqli_query($conexao, "SELECT * FROM beats ORDER BY id DESC LIMIT 10; ");




if (isset($_GET['deslog'])) {

    echo "<script>alert('Deslogado com sucesso!');</script>";
}
if (isset($_GET['logado'])) {

    echo "<script>alert('Logado com sucesso! Bem vindo(a), " . $user . "');</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDonThaTrack</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/modal.css">
    <script src="scripts/index.js"></script>
    <script src="scripts/modal.js"></script>

</head>
<script>

</script>



<body>

    <div class="img_capa">
        <span> Os melhores Beats para as melhores músicas</span>
        <img src="imgs/beat.gif" alt="foto_capa" class="img">
    </div>
    <!-- <div id="input-container">
        <div class="lineBusc"></div>
        <input type="text" autocomplete="off" name="text" id="inputBusc" placeholder="Pesquisar no site...">
    </div> -->
    <div class="img_capa2">
        <img src="imgs/pessoaCostas.jpg" alt="foto_capa" class="img">
    </div>

    <div class="destaques_div">
        <div class="labeldestq_div">
            <h2>Novos Sons</h2> se liga no beat JD ON that track!
        </div>
        <br>
        <br>
        <br>
        <div class="carousel">
            <div class="cards-container">
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
                                <div class="acoesCard">OUVIR</div>
                            </a>
                        </span>
                        <br>
                        <p class="nomeP"><?= $novidades['titulo'] ?></p>
                        <p class="precoP"><del>R$<?= $novidades['preco_risc'] ?></del> <b>R$<?= $novidades['preco'] ?></b></p>
                        <p class="nomeP"><?= $novidades['categoria'] ?></p>

                        <div id="audioModal" class="modal audioModal">
                            <div class="modal-content">
                                <span class="close closess">&times;</span>
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
                                        <form action="comprar.php" method="post">

                                            <input type="text" value="<?= $novidades['codP'] ?>" name="codP" style="display: none;">
                                            <button type="submit" class="btn_compra" id="comprar_btn">comprar</button>
                                        </form>
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
            <!-- <button class="prev-btn">
                <img src="iconsJD/seta.png" alt="setaPrev" class="img">
            </button>
            <button class="next-btn">
                <img src="iconsJD/seta.png" alt="setaPrev" class="img">
            </button> -->
        </div>


        <div class="tutorial">
            <h1>O que fazer?</h1>
            <div class="alingH">
                <img src="imgs/pesquisarComputador.png" class="img">
                <div class="alingV">

                    <h1>Explore e descubra seu beat</h1><br>
                    <p>Pesquise e ouça os mais diversos beats Jd On That Track e ache o estilo ideal para seu som!</p>
                </div>
            </div>
            <div class="alingH">
                <div class="alingV">

                    <h1>Crie uma conta JD facil e rápido</h1><br>
                    <p>Aproveite e crie uma Conta JD com seu Nome e Email, onde vc receberá seu beat completo e em ótima qualidade!</p>
                </div>
                <img src="imgs/criarconta.png" class="img">
            </div>
            <div class="alingH">
                <img src="imgs/payment.png" class="img">

                <div class="alingV">
                    <h1>Finalize o pagamento e pronto!</h1><br>
                    <p>Finalize sua compra via PIX, Cartão de Crédito (em até 12x) ou Boleto! Depois disso enviaremos o seu beat para seu novo hit!</p>
                </div>
            </div>



        </div>



        <!-- <div class="alingH FlashCadastro">
            <div class="loader">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <a href="produtos.php?user=<?= $user ?>"><button id="verMaisBtn">Criar conta jd agora</button></a>

        </div> -->
        <br>
        <br>

        <div class="Flashlogin">
            <div class="section">
                <h1>Faça sua conta Jd On That Track!</h1>
                <br>
                <br>
                <h2 class="scroll_animado">Confie na nossa coleção de beats de alta qualidade para seu hit!</h2>
                <br>
                <br>
                <p class="scroll_animado">Nosso compromisso é fornecer a você os melhores beats para elevar suas produções musicais.</p>
                <br>
                <br>
                <p class="scroll_animado">Oferecemos uma solução completa e automatizada para aquisição de beats, permitindo que você se concentre no que realmente importa: criar músicas incríveis.</p>
                <br>
                <br>
                <h2 class="scroll_animado">Nós fornecemos os beats, enquanto você foca na criação musical!</h2>
            </div>




            <?php
            include('criarconta.php');
            ?>

        </div>
        <br>
        <br>















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



        <?php
        include('rodape.php');
        ?>
    </div>
</body>

</php>