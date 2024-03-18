<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <div class="alingLogin">
        <form class="form">
            
            <div class="divLogo">
                <a href="../index.php"><img src="../imgs/logofake.png" alt="logo" class="img"></a>
            </div>
            <p class="form-title">Crie sua conta JD</p>

            
            <div class="input-container">
                <input type="email" autocomplete="on" placeholder="Email" required>
                
            </div>
             
            <div class="input-container">
                <input type="text" autocomplete="on" placeholder="Nome de Usuário" required>
            </div>

            <br>
            <div class="input-container">
                <input type="password" placeholder="Senha" required>
            </div>
            <div class="input-container">
                <input type="password" placeholder="Confirmar senha" required>
            </div>
            <button type="submit" class="submit">
                Criar Conta
            </button>
            <br>
            <br> 
            <p class="signup-link">
            Já tem uma conta?
            <a href="login.php">Entrar</a>
            </p>
            
      </form>

    </div>
        
</body>
</html>