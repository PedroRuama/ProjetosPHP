<?php

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
   
        <form class="form" action="controllers/login_controller.php?log=2" method="post" id="form_singin">
            
            <!-- <div class="divLogo">
                <a href="index.php"><img src="imgs/logofake.png" alt="logo" class="img"></a>
            </div> -->
            <p class="form-title">Entre na sua conta JD</p>

            <div class="Allinputs_div">

                <div class="input-container">
                    <input type="text" placeholder="Email ou usuário" name="email_user">
                </div>
                <div class="input-container">
                    <input type="password" placeholder="Senha" name="pass">
                </div>
                <?php
                    if (isset($_GET['logError'])) {
                        echo "<p> email/usuario ou senha incorretas</p>";
                    }

                ?>
            </div>
            

            <button type="submit" class="submit">
                 Entrar
            </button>
            <br>
            <br>
            <p class="signup-link">
            Não tem uma conta?
            <a href="log_page.php?opcaosingUp">Criar conta</a>
            </p>
            <p class="signup-link">
                
                <a href="comprar.php">Esqueci a senha</a>
                </p>
      </form>

  
        
    <?php
        if (isset($_GET['logcreated'])) { 
            
            echo "<script> alert('Conta criada com sucesso!'');</script>";
        
        }
    ?> 
</body>
</html>