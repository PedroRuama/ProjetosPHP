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

    <form class="form" action="../controllers/login_controller.php?log=1" method="post" id="form_pf">

        <div class="divLogo">
            <a href="../index.php"><img src="../imgs/logos/7-removebg-preview.png" alt="logo" class="img"></a>
        </div>
        <p class="form-title">Preencha com seus dados Pessoa Fisíca </p>

        <div class="Allinputs_div">

            <div class="input-container">
                <input type="text" autocomplete="on" placeholder="Seu Nome Completo" required name="nome">
            </div>
            <div class="input-container">
                <input type="email" autocomplete="on" placeholder="Email" required name="email">
            </div>
            <div class="input-container">
                <input type="text" autocomplete="on" placeholder="CPF" required name="email">
            </div>

            <div class="input-container">
                <input type="text" autocomplete="on" placeholder="Nome de Usuário" required name="user_name">
                <?php
                if (isset($_GET['error'])) {
                    echo "<p> Nome de usuario já existente</p>";
                }

                ?>
            </div>

            <div class="input-container">
                <input type="text" autocomplete="on" placeholder="Telefone/WhatsApp" required name="telefone">
            </div>
            <!-- <div class="input-container">
                <input type="text" autocomplete="on" placeholder="Segmento da Empresa" required name="SegEmpresa"> 

                <select name="segmento" class="input-container" placeholder="Segmento da Empresa">
                    <option value="">Segmento da Empresa</option>
                    <option value="Comercio">Comércio</option>
                    <option value="Restaurante">Restaurante</option>
                    <option value="PrestacaoServicos">Prestação de Serviços</option>
                    <option value="Industria">Indústria</option>
                    <option value="E-commerce">E-commerce</option>


                </select>
            </div> -->
            <div class="input-container">

                <select name="renda" class="input-container" placeholder="Renda MEnsal">
                    <option value="">Renda Mensal Mensal</option>
                    <option value="0-1.4">Até R$ 1.400</option>
                    <option value="1.4-2.0">De R$ 1.400 a R$ 2.000</option>
                    <option value="2.0-2.8">De R$ 2.000 a R$ 2.800</option>
                    <option value="2.8-3.5">De R$ 2.800 a R$ 3.500</option>
                    <option value="200-450">De R$ 3.500 a R$ 5.000</option>
                    <option value="200-450">De R$ 5.000 a R$ 7.000</option>
                    <option value="200-450">De R$ 7.000 a R$ 9.000</option>
                    <option value="450-">Acima de R$ 9.000</option>


                </select>
            </div>

            <div class="input-container textarea_container">
                <textarea class="box" rows="12" cols="50" placeholder="Faça a primeira apresentação de sua Empresa/Negócio "></textarea>
            </div>


            <button type="submit" class="submit">
                Enviar Formulário
            </button>
        </div>

        <!-- 
        <br>
        <p class="signup-link">
            Já tem uma conta?
            <a href="log_page.php?singin">Entrar</a>
        </p> -->

    </form>



</body>

</html>