<?php

include_once('controllers/conexao.php');
$_SESSION['user_name'] = 'JdAdm';

if (isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];
    // $select_user = mysqli_query($conexao, "SELECT * from users where user_name='$user'");
    // $dadosU = mysqli_fetch_array($select_user);
} else {
    $user = 0;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultoria</title>
    <link rel="stylesheet" href="styles/menu.css">
    <script src="scripts/index.js"></script>
</head>



<body>
    <!-- <div class="MobileNot">
        <img src="imgs/logos/7-removebg-preview.png" alt="" class="img2">
        <h2>Atualmete a visualização do sistema esta disponivel apenas para computador.</h2>
        <p>Em breve lançamento para Celular</p>
    </div> -->
    <div class="box_nav">
        <div class="alingV">
            <div class="alingH">


                <div class="logo_div" id="logo_desktop">
                    <img src="imgs/logos/ys_horizontal_branco.png" alt="logo" class="img">
                    <nav id="nav_desktop" class="sidenav">
                        <a href="index.php?user=<?= $user ?>">
                            <li class="li_desktop">Home Page</li>
                        </a>
                        <span style=" width: 100%;" id="li_servicos">
                            <li class="li_desktop">Serviços</li>
                            <div class="dropdown_servicos" id="drop_service">
                                <a href="servicos.php?servicePf">Finanças Pessoais
                                    &nbsp; <img src="iconsJD/setaBranca.png" class="img" alt="">
                                </a>
                                <a href="servicos.php?serviceEm">Gestão Empresarial
                                    &nbsp; <img src="iconsJD/setaBranca.png" class="img" alt="">
                                </a>
                            </div>
                        </span>
                        <!-- <a href="planos.php">
                            <li class="li_desktop">Planos</li>
                        </a> -->
                        <a href="#">
                            <li class="li_desktop">Sobre Nós</li>
                        </a>
                        <a href="#">
                            <li class="li_desktop">Contato</li>
                        </a>
                    </nav>
                </div>

                <div class="icon" id="icon_menu">
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
                        <li><a href="index.php?user=<?= $user ?>">Home Page</a></li>
                        <li><a href="produtos.php?user=<?= $user ?>">Serviços</a></li>
                        <li><a href="#">Sobre Nós</a></li>
                        <li><a href="#contato">Contato</a></li>
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
                        if ($user != 0) {

                        ?>
                            <div class="optionsConta" id="logado">
                                <br>
                                <p><?= $dadosU['user_name'] ?></p>
                                <br>
                                <li><a href="">Status da minha Empresa</a></li>
                                <li><a href="">Meu Cadastro</a></li>
                                <li><a href="controllers/login_controller.php?log=3">Sair</a></li>
                                <br>
                                <br>
                                <br>

                                <?php
                                if ($user == 'YGAdm') {
                                ?>
                                    <li><a href="gerenciar.php?user=<?= $user ?>">Gerenciar Loja</a></li>
                                <?php
                                }
                                ?>
                            </div>
                        <?php

                        } else {
                        ?>

                            <div class="optionsConta" id="login">
                                <li><a href="criarconta.php">Criar Conta</a></li>
                                <li><a href="login.php">Entrar</a></li>
                            </div>

                        <?php
                        }


                        ?>
                    </ul>
                </nav>

                <div class="logo_div" id="logo_mobile">
                    <img src="imgs/logofake.png" alt="logo" class="img">
                </div>


                <!-- 

                <?php
                if ($user != 0) {

                ?>

                    <div class="icon menu_btn" id="icon_log">
                        <img src="iconsJD/user.png" alt="menu" class="img">
                        <span><?= $user; ?></span>
                    </div>

                    <div class="optionsConta_log" id="logado__">
                        <div class="close-btn__">
                            <span class="close" id="close-btn3">&times;</span>

                        </div>
                        <a href="">
                            <li>Status da minha Empresa</li>
                        </a>
                        <a href="">
                            <li>Missão, Visão e valores</li>
                        </a>
                        <a href="">
                            <li>Meu Cadastro</li>
                        </a>
                        <a href="controllers/login_controller.php?log=3">
                            <li>Sair</li>
                        </a>


                        <?php
                        if ($user == 'JdAdm') {
                        ?>
                            <a href="gerenciar.php?user=<?= $user ?>">
                                <li>Gerenciar Loja</li>
                            </a>
                        <?php
                        }
                        ?>
                    </div>


                <?php

                } else {
                ?>

                    <div class="login_div">
                        <a href="log_page.php?singin"> <button class="menu_btn2">
                                ENTRAR
                            </button> </a>
                        <a href="log_page.php?opcaosingUp">
                            <button class="singup">
                                CADASTRO
                                <div class="arrow-wrapper">
                                    <div class="arrow"></div>

                                </div>
                            </button>
                        </a>
                    </div>


                <?php
                }


                ?> -->





            </div>

        </div>
    </div>



</body>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var openBtn = document.getElementById('open-btn');
        var closeBtn = document.getElementById('close-btn');
        var sidenav = document.getElementById('sidenav');

        var openBtn2 = document.getElementById('open-btn2');
        var closeBtn2 = document.getElementById('close-btn2');
        var sidenav2 = document.getElementById('sidenav2');

        var openLog = document.getElementById('icon_log');
        var optns_conta = document.getElementById('logado__');
        var closeBtn__ = document.getElementById('close-btn3');

        openBtn.addEventListener('click', function() {
            sidenav.style.width = '250px';
        });

        closeBtn.addEventListener('click', function() {
            sidenav.style.width = '0';
        });

        openBtn2.addEventListener('click', function() {
            sidenav2.style.width = '250px';
        });

        closeBtn2.addEventListener('click', function() {
            sidenav2.style.width = '0';
        });

        openLog.addEventListener('click', function() {
            optns_conta.style.height = '240px';


        });

        closeBtn__.addEventListener('click', function() {
            optns_conta.style.height = '0';
        });



    })
</script>