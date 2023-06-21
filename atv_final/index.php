<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atv-Final</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div id="align">
        <div id="bemvindo">
            <div id="txt_bv"> <b> Bem-Vindo!</b> </div> 
            <br>
            
            Faça Login e entre na sua conta
        </div>
        <div id="div_form">
            <form name='login' method="post" >
                <div id="txt_adm"> <b>Entre como ADM</b></div> <br><br><br>
               
                <input type="text" name="login" placeholder="Login"> <br><br>
                
                <input type="password" name="senha" placeholder="Senha"> <br><br>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if($_POST['login'] == 'phpds' &  $_POST['senha'] == '123456'){
                            header("Location: adm.php");
                            die();
                        }
                        else{
                            echo '<div id="erro"> Login incorreto </div>';   
                        }
                    }
                    ?>
                <br><br><br><br><br>
                <div id="div_enviar">
                    <input type="submit" value="Enviar" id="enviar">
    
                </div>
            </form>
           
        </div>
    </div>
</body>
</html>