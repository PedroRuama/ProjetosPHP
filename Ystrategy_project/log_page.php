<?php

?>

<head>
    <link rel="stylesheet" href="styles/log_page.css">
</head>

<body>
    <div>
        <?php
        include('menu.php');
        ?>
    </div>


    <button class="voltar" onclick="window.history.go(-1);">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M5.854 8.354a.5.5 0 0 1 0-.708L9.526 3.975a.5.5 0 1 1 .708.708L6.207 8l4.027 3.318a.5.5 0 0 1-.708.708l-3.672-3.672z" />
        </svg>
        Voltar
    </button>

    <div class="alingLogin">
        <div class="blob">
            <!-- This SVG is from https://codepen.io/Ali_Farooq_/pen/gKOJqx -->
            <svg xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 310 350">
                <path d="M156.4,339.5c31.8-2.5,59.4-26.8,80.2-48.5c28.3-29.5,40.5-47,56.1-85.1c14-34.3,20.7-75.6,2.3-111  c-18.1-34.8-55.7-58-90.4-72.3c-11.7-4.8-24.1-8.8-36.8-11.5l-0.9-0.9l-0.6,0.6c-27.7-5.8-56.6-6-82.4,3c-38.8,13.6-64,48.8-66.8,90.3c-3,43.9,17.8,88.3,33.7,128.8c5.3,13.5,10.4,27.1,14.9,40.9C77.5,309.9,111,343,156.4,339.5z" />
            </svg>
        </div>

        <?php
        if (isset($_GET['opcaosingUp'])) {
        ?>
            <!-- <a href="log_page.php?singUpEm">
                <div class="opCadastro" id="opUpEm">
                    <h2>Cadastro Empresa</h2>
                    <img src="iconsJD/setaBranca.png" alt="seta" class="img">
                </div>
            </a>

            <a href="log_page.php?singUpPf">
                <div class="opCadastro" id="opUpPf">
                    <h2>Cadastro Pessoa Fisíca</h2>
                    <img src="iconsJD/setaBranca.png" alt="seta" class="img">
                </div>
             </a> -->
            <div class="container">
                <div class="title">Escolha como deseja se cadastrar</div>
                <div class="description">Selecione uma das opções abaixo para continuar com o seu cadastro.</div>
                <div class="buttons">
                    <a href="log_page.php?singUpEm">
                        <button class="button company">
                            Cadastro Empresa

                        </button>
                    </a>
                    <a href="log_page.php?singUpPf">
                        <button class="button person">
                            Cadastro Pessoa Física

                        </button>
                    </a>
                </div>
            </div>




        <?php
        } else {


            if (isset($_GET['singin'])) {
                include('login.php');
                
            } else if (isset($_GET['singUpEm'])) {

                include('criarcontaEM.php');
            } else if (isset($_GET['singUpPf'])) {

                include('criarcontaPF.php');
            }
        }
        ?>


    </div>

</body>


</html>