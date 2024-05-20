<?php 

    include_once('controllers/conexao.php');
   
    
    if (isset($_SESSION['user_name'])) {
        $user = $_SESSION['user_name'];
        $select_user = mysqli_query($conexao, "SELECT * from users where user_name='$user'");
        $dadosU = mysqli_fetch_array($select_user);
    } else{
       $user = 0;
    }
    
   
    
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDonThaTrack</title>
    <link rel="stylesheet" href="styles/menu.css">
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
                        <li><a href="index.php?user=<?= $user ?>">Home Page</a></li>
                        <li><a href="produtos.php?user=<?= $user ?>">Camisetas</a></li>
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
                        if ($user != 0) {

                        ?>
                            <div class="optionsConta" id="logado">
                                <br>
                                <p><?= $dadosU['user_name'] ?></p>
                                <br>
                                <li><a href="">Favoritos</a></li>
                                <li><a href="">Pedidos</a></li>
                                <li><a href="">Meu Cadastro</a></li>
                                <li><a href="controllers/login_controller.php?log=3">Sair</a></li>
                                <br>
                                <br>
                                <br>

                                <?php
                                if ($user == 'JdAdm') {
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

                <div class="logo_div">
                    <img src="imgs/logofake2.png" alt="logo" class="img">
                </div>
                <div class="icon">
                    <img src="iconsJD/sacola.png" alt="carrinho" class="img">
                </div>
            </div>

        </div>
    </div>

</body>