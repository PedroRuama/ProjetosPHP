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
    <div class="header">
        <img alt="Company Logo" src="./logos/ys_horizontal_branco.png" />
        <nav class="nav_div">
            <a href="lancamentos.php" class="<?php if ($current_page === 'lancamentos.php'){echo 'active';}?>">
                Lançamentos
            </a>
            <a href="#" class="<?php if ($current_page === '#.php'){echo 'active';}?>">
                Metas
            </a>
            <a href="#" class="<?php if ($current_page === '#.php'){echo 'active';}?>">
                Resumo do Mês
            </a>
            <a href="#" class="<?php if ($current_page === '#.php'){echo 'active';}?>">
                Orçamento
            </a>
            <a href="config.php" class="<?php if ($current_page === 'config.php'){echo 'active';}?>">
                Configurações
            </a>
            <a href="logout.php" class="<?php if ($current_page === '#.php'){echo 'active';}?>">
                Logout
            </a>
        </nav>
    </div>
</body>

</html>