 <?php

    error_reporting(0);

    include('conexao.php');
    include('chamadas_sql.php');
    include('funcoes.php');

    if (!isset($_SESSION['usuario']) && !isset($_SESSION['motorista'])) {

        header("Location: index.php");

        exit;
    } else {
        $user1 = $_SESSION['motorista'];
        $user2 = $_SESSION['usuario'];
        $n = explode(' ', $user1);
        $pN = $n[0]; // 'Carlos'
        if (isset($user2)) {

            $user = $user2;
        } else {

            $user = $pN;
        }
    }

    
    $current_page = basename($_SERVER['PHP_SELF']);
    
    ?>

 <!DOCTYPE html>

 <html lang="pt-br">



 <head>
     <link rel="stylesheet" href="./reset.css">
     <link rel="stylesheet" href="./index.css">
     <link rel="stylesheet" href="css/navbar.css">
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=0.9">
     <link rel="shortcut icon" href="./logos/ystrategylogolaranja.png" type="image/x-icon">
     <title>Ystrategy caçambas</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
 </head>



 <body>
     <div class="desktop_bar">
         <div class="sidebar">
             <div class="alingH">
                 <div class="logo_nav">
                 </div>
                 <div id="close-btn" class="close-btn">
                     <img src="icons/close.png" alt="fechar" class="img">
                 </div>
             </div>
             <br>
             <br>
             <br>
             <div class="head_logo">
                 <h1 class="icon">
                     <div class="logo_div">
                         <img src="logos/ys_horizontal_branco.png" alt="logo" class="img">
                     </div>
                     <!-- MUNDIAL ENTULHOS -->
                 </h1>

             </div>
             <a class="block_">
                 <!-- <i class="fas fa-home"></i> -->
                 <i class="fas fa-user"></i>
                 <?= $user ?>
             </a>
             <br>
             <a href="form_rt.php" class="no_motorista <?= $current_page === 'form_rt.php' ? 'active' : '' ?>">
                 <!-- <i class="fas fa-home"></i> -->
                 <i class="fas fa-paper-plane"></i>
                 Base de Pedidos
             </a>
             <a href="
             <?php
                if ($_SESSION['ACESSO'] == 'FORMIGA') {
                    echo 'form_m_servicos_NEW.php?se_FORMIGA';
                } else{  echo 'form_m_servicos_NEW.php';
                } ?>"

                 class="<?php
                        if ($current_page === 'form_m_servicos_NEW.php') {
                            echo 'active';
                        } elseif ($_SESSION['acao'] == 'Observador') {
                            '';
                        } else {
                            echo 'no_motorista';
                        } ?>">

                 <!-- <i class="fas fa-tree"> -->
                 <i class="fas fa-truck"></i>
                 </i>
                 Serviços Motoristas
             </a>
             <a href="form_pedido.php" class="no_motorista <?= $current_page === 'form_pedido.php' ? 'active' : '' ?>">
                 <!-- <i class="fas fa-recycle"></i> -->
                 <i class="fas fa-plus-circle"></i>
                 Incluir Novo Pedido
             </a>
             <a href="visao_geral.php" class="<?php
                                                if ($current_page === 'visao_geral.php') {
                                                    echo 'active';
                                                } else if ($_SESSION['acao'] === 'Observador') {
                                                    ' ';
                                                } else {
                                                    echo 'no_motorista';
                                                } ?>"><title>Mundial Entulhos / Cadastros</title>
                 <i class="fas fa-file-signature"></i>
                 Resumos
                 <a href="formulario_relatorio.php" class="block no_motorista<?= $current_page === 'formulario_relatorio.php' ? 'active' : '' ?>">
                     <i class="fas fa-chart-line"></i>
                     Relatórios
                 </a>

                 <?php
                    // print_r($_SESSION);

                    ?>
                 <a href="form_c_receber.php" class="no_motorista <?php
                                                                    if ($current_page === 'form_c_receber.php') {
                                                                        echo 'active';
                                                                    } elseif ($_SESSION['ACESSO'] != 'ADMIN') {
                                                                        echo 'block';
                                                                    } ?> ">
                     <i class="fas fa-dollar-sign"></i>
                     Contas a Receber
                 </a>


                 <a href="form_cadastro_valores.php" class="block no_motorista<?= $current_page === 'form_cadastro_valores.php' ? 'active' : '' ?>">
                     <i class="fas fa-tags"></i>
                     Preços
                 </a>

                 <br>
                 <br>
                 <a href="#" class="no_motorista" id="open-btn2">
                     <i class="fas fa-folder-open"></i>
                     Acessar Cadastros
                 </a>
                 <a href="logout.php">
                     <i class="fas fa-sign-out-alt"></i>
                     Sair
                 </a>
         </div>
     </div>




     <div class="box_nav">
         <div class="alingV">
             <div class="alingH" id="background_nav">
                 <div class="icon" id="icon_menu">
                     <img src="icons/menu.png" alt="menu" class="img no-print" id="open-btn">
                     <div class="logo_div" id="logo_mobile">
                         <img src="logos/ys_horizontal_branco.png" alt="logo" class="img">
                     </div>
                 </div>

                 <nav class="sidenav" id="sidenav">
                     <div class="alingH">
                         <div class="logo_nav">
                         </div>
                         <div id="close-btn" class="close-btn">
                             <img src="icons/close.png" alt="fechar" class="img">
                         </div>
                     </div>



                 </nav>

                 <nav class="sidenav" id="sidenav2">
                     <button id="close-btn2">Voltar</button>

                     <ul>

                         <a href="form_cadastro_usuario.php">
                             <li>
                                 <i class="fas fa-users"></i>Cad. Usuarios
                                 <!-- &nbsp; <img src="icons/setaBranca.png" class="img" alt=""> -->
                             </li>
                         </a>
                         <a href="form_cadastro_cliente.php">
                             <li>
                                 <i class="fas fa-user-tie"></i>
                                 Cad. Clientes
                                 <!-- &nbsp; <img src="icons/setaBranca.png" class="img" alt=""> -->
                             </li>
                         </a>
                         <a href="form_cadastro_veiculos.php">
                             <li>
                                 <i class="fas fa-car"></i>
                                 Cad. Veiculos
                                 <!-- &nbsp; <img src="icons/setaBranca.png" class="img" alt=""> -->
                             </li>
                         </a>
                         <a href="form_cadastro_motorista.php">
                             <li>
                                 <i class="fas fa-id-card"></i>
                                 Cad. Motoristas
                                 <!-- &nbsp; <img src="icons/setaBranca.png" class="img" alt=""> -->
                             </li>
                         </a>
                         <a href="form_cadastro_cacamba.php">
                             <li>
                                 <i class="fas fa-dumpster"></i>
                                 Cad. Caçambas
                                 <!-- &nbsp; <img src="icons/setaBranca.png" class="img" alt=""> -->
                             </li>
                         </a>
                         <a href="form_cadastro_aterro.php">
                             <li>
                                 <i class="fas fa-mountain"></i>
                                 Cad. Aterros
                                 <!-- &nbsp; <img src="icons/setaBranca.png" class="img" alt=""> -->
                             </li>
                         </a>


                     </ul>
                 </nav>
             </div>
         </div>
     </div>


 </body>

 </html>

 <script>
     document.body.style.zoom = "0.9";

     document.addEventListener('DOMContentLoaded', function() {
         var openBtn = document.getElementById('open-btn');
         var closeBtn = document.getElementById('close-btn');
         var sidebar = document.getElementsByClassName('sidebar')[0];

         var openBtn2 = document.getElementById('open-btn2');
         var closeBtn2 = document.getElementById('close-btn2');
         var sidenav2 = document.getElementById('sidenav2');

         openBtn.addEventListener('click', function() {
             sidebar.style = "width: 60vw; padding: 20px;";

         });

         closeBtn.addEventListener('click', function() {
             sidebar.style = "width: 0; padding: 0;";
         });

         openBtn2.addEventListener('click', function() {
             if (window.innerWidth >= 800) {
                 sidenav2.style.width = '22.6vw';
             } else {
                 sidenav2.style.width = '60vw';
             }
         });

         closeBtn2.addEventListener('click', function() {
             sidenav2.style.width = '0';
         });

        


     })

     function noAcessMenu() {
         var no_menu = document.getElementsByClassName("no_motorista");
         for (let i = 0; i < no_menu.length; i++) {
             const element = no_menu[i];
             element.style.display = 'none'

         }
     }


     function delay(ms) {
         return new Promise(resolve => setTimeout(resolve, ms));
     }

     async function forceReload() {
         //   console.log("Reload em andamento")
         // Recarrega a página sem cache
         // location.reload(true); // true força o cache a ser ignorado
         if ('caches' in window) {
             caches.keys().then(function(names) {
                 for (let name of names) {
                     caches.delete(name);
                 }
             }).then(() => {
                 location.reload();
             });
         }

         document.getElementById("atualizar").style = "display:none";
         document.getElementById("msg_ok").style = "display:flex";

         while (true) {
             document.getElementById("msg_ok").innerHTML = 'Recarregando'
             for (let i = 0; i < 4; i++) {
                 await delay(200);
                 document.getElementById("msg_ok").innerHTML += " . ";
             }
         }


     }
 </script>

 <?php

    if (isset($_SESSION['motorista']) ||  $_SESSION['acao'] != 'Geral') {
        echo '<script> noAcessMenu() </script>';
    }


    ?>