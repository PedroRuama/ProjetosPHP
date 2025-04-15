<?php
include("./controllers/conexao.php");
// include("./controllers/chamadas_sql.php");
if (!isset($_SESSION['user'])) {

    header("Location: ./index.php");

    exit;
} else {
    $user = $_SESSION['user'];
}



$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <link rel="stylesheet" href="./style/menu.css">
</head>
<style>

</style>


<body>
    <div class="header2">

        <img alt="Company Logo" class="i_menu" id="open-btn" src="./icons/menu.png" />
        <img alt="Company Logo" class="i_close" id="close-btn" src="./icons/close.png" />

        <img alt="Company Logo" src="./logos/ys_horizontal_branco.png" />
    </div>

    <div class="header">
        <img alt="Company Logo" class="logo_desktop" src="./logos/ys_horizontal_branco.png" />
        <nav class="nav_div">
            <a href="lancamentos.php" class="<?php if ($current_page === 'lancamentos.php') {
                                                    echo 'active';
                                                } ?>">
                Lançamentos
            </a>
            <a href="#" class="<?php if ($current_page === '#.php') {
                                    echo 'active';
                                } ?>">
                Metas
            </a>
            <a href="#" class="<?php if ($current_page === '#.php') {
                                    echo 'active';
                                } ?>">
                Resumo do Mês
            </a>
            <a href="#" class="<?php if ($current_page === '#.php') {
                                    echo 'active';
                                } ?>">
                Orçamento
            </a>
            <a href="config.php" class="<?php if ($current_page === 'config.php') {
                                            echo 'active';
                                        } ?>">
                Configurações
            </a>
            <a href="logout.php" class="<?php if ($current_page === '#.php') {
                                            echo 'active';
                                        } ?>">
                Logout
            </a>
        </nav>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var openBtn = document.getElementById('open-btn');
        var closeBtn = document.getElementById('close-btn');
        var sidenav = document.getElementsByClassName('header')[0];
        // var openBtn2 = document.getElementById('open-btn2');
        // var closeBtn2 = document.getElementById('close-btn2');
        // var sidenav2 = document.getElementById('sidenav2');



        openBtn.addEventListener('click', function() {
            sidenav.style = "width: 45vw; padding: 10px 20px;";
            openBtn.style.display = "none";
            closeBtn.style.display = "flex";
            closeBtn.style.transition = "transform 0.3s ease";
            setTimeout(() => {
                closeBtn.style.transform = "rotate(90deg)";
            }, 10);


        });

        closeBtn.addEventListener('click', function() {
            closeBtn.style.transition = "transform 0.3s ease";
            closeBtn.style.transform = "rotate(-90deg)";
            setTimeout(() => {
                closeBtn.style.display = "none";
                openBtn.style.display = "flex";
                sidenav.style = "width: 0; padding: 0";
            }, 200);
        });



    })
</script>

</html>