<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta JD</title>
    <link rel="stylesheet" href="../styles/login.css">
    <script src="../scripts/login.js"></script>
</head>

<body>
    <div class="alingLogin">
        <form class="form" action="../controllers/login_controller.php?log=1" method="post">

            <div class="divLogo">
                <a href="../index.php"><img src="../imgs/logofake.png" alt="logo" class="img"></a>
            </div>
            <p class="form-title">Crie sua conta JD</p>

            <div class="Allinputs_div">

                <div class="input-container">
                    <input type="email" autocomplete="on" placeholder="Email" required name="email">
                </div>

                <div class="input-container">
                    <input type="text" autocomplete="on" placeholder="Nome Completo" required name="nome">
                </div>

                <div class="input-container">
                    <input type="text" autocomplete="on" placeholder="Nome de Usuário" required name="user_name">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<p> Nome de usuario já existente</p>";
                    }
    
                    ?>
    
                </div>
    
                <br>
                <div class="input-container">
                    <input type="password" placeholder="Senha" required name="pass">
                </div>
                <div class="input-container">
                    <input type="password" placeholder="Confirmar senha" required>
                </div>
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