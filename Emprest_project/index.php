

<?php 
    $user = 0;
    if (isset($_GET['user'])) {
        $user = $_GET['user']; 
    } else {}

    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Emprest</title>
        <link rel="stylesheet" href="styles/login.css"/>
        <link rel="icon" href="iconsEmp/caixa.png" type="image/png">
    </head>
    <body>
        <div id="align">
            <div id="bemvindo">
                <div id="txt_bv"> <b> Bem-Vindo!</b> </div> 
                <br>
                
                Faça Login e entre na sua conta
            </div>
            <div id="div_form">
                <form name='login' method="post" action="controllers/login_controller.php">
                    <input type="text" name="login" placeholder="Login"> <br><br>
                    <input type="password" name="senha" placeholder="Senha"> <br><br>
                    <?php
                    if ($user == 1) {
                        echo '<div id="erro"> Login incorreto </div>'; 
                    }
                    ?>  

                    <br><br>
                    <div id="div_enviar">
                        <input type="submit" value="Enviar" id="enviar">
        
                    </div>
                    
                </form>
            
            </div>
        </div>
    </body>
</html>