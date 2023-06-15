<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atv-Final</title>
</head>
<body>
    <div>
        <form name='login' method="post" >
            login:
            <input type="text" name="login"> <br><br>
            Senha:
            <input type="password" name="senha"> <br><br>
            <input type="submit" value="Enviar" >
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($_POST['login'] == 'phpds' &  $_POST['senha'] == '123456'){
                    header("Location: adm.php");
                    die();
                }
                else{
                    echo 'login incorreto';   
                }
            }
            ?>
       
    </div>
</body>
</html>