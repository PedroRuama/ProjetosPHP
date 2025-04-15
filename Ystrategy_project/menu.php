<?php

include_once('controllers/conexao.php');


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
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <title>Ystrategy</title>
    <link rel="icon" href="imgs/logos/ystrategylogolaranja.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/menu.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <script src="scripts/index.js"></script>
</head>



<body>
    
    <div class="box_nav">
        <div class="alingV">
            <div class="alingH">
                <div class="logo_div" id="logo_desktop">
                    
                    <img src="imgs/logos/ys_horizontal_branco.png" alt="logo" class="img" id="img_logo">
                    <nav id="nav_desktop" class="sidenav">
                        <a href="index.php?user=<?= $user ?>">
                            <li class="li_desktop">Home</li>
                        </a>
                        <span id="li_servicos">
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
                            <li class="li_desktop">Sobre</li>
                        </a>
                        <a href="#">
                            <li class="li_desktop">Contato</li>
                        </a>
                    </nav>
                </div>

            </div>

        </div>
    </div>



</body>
