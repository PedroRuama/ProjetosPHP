<?php
include_once('controllers/conexao.php');
?>

<head>
    <link rel="stylesheet" href="styles/log_page.css">
</head>

<body>
    <div style="display:none;">
        <?php
        
        include('menu.php');
        ?>
    </div>


    <div class="alingLogin">
       
        <?php
        if (isset($_GET['singin'])) {
            include('login.php');
        } else if (isset($_GET['singup'])) {
            include('criarconta.php');
        }
        ?>
    </div>

</body>


</html>