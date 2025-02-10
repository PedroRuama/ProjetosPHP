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

    <form class="form" action="../controllers/login_controller.php?log=1" method="post">


        <div class="divLogo">
            <a href="../index.php"><img src="./imgs/logos/ystrategylogolaranja.png" alt="logo" class="img"></a>
        </div>

        <p class="form-title">Preencha os dados da sua empresa</p>

        <div class="Allinputs_div">

            <div class="input-container">
                <input type="text" autocomplete="on" placeholder="Seu Nome Completo" required name="nome">
            </div>
            <div class="input-container">
                <input type="email" autocomplete="on" placeholder="Email" required name="email">
            </div>

            <div class="input-container">
                <input type="email" autocomplete="on" placeholder="Nome da Empresa/Negócio" required name="nomeEmpresa">
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
            <div class="input-container">
                <!-- <input type="text" autocomplete="on" placeholder="Segmento da Empresa" required name="SegEmpresa"> -->

                <select name="segmento" class="input-container" placeholder="Segmento da Empresa">
                    <option value="">Segmento da Empresa</option>
                    <option value="Comercio">Comércio</option>
                    <option value="Restaurante">Restaurante</option>
                    <option value="PrestacaoServicos">Prestação de Serviços</option>
                    <option value="Industria">Indústria</option>
                    <option value="E-commerce">E-commerce</option>


                </select>
            </div>
            <div class="input-container">

                <select name="faturamento" class="input-container" placeholder="Faturamento">
                    <option value="">Faturamento Mensal</option>
                    <option value="0-30">Até R$ 30mil</option>
                    <option value="30-50">De R$ 30mil a R$ 50mil</option>
                    <option value="50-100">De R$ 50mil a R$ 100mil</option>
                    <option value="100-200">De R$ 100mil a R$ 200mil</option>
                    <option value="200-450">De R$ 200mil a R$ 450mil</option>
                    <option value="450-">Acima de R$ 450mil</option>


                </select>
            </div>
            <div class="input-container">

                <select name="sabendo" class="input-container" placeholder="Segmento da Empresa">
                    <option value="">Como ficou sabendo de nós?</option>
                    <option value="Comercio">Comércio</option>
                    <option value="Restaurante">Restaurante</option>
                    <option value="PrestacaoServicos">Prestação de Serviços</option>
                    <option value="Industria">Indústria</option>
                    <option value="E-commerce">E-commerce</option>


                </select>
            </div>

            <div class="input-container textarea_container">
                <textarea class="box" rows="4" cols="50" placeholder="Faça a primeira apresentação de sua Empresa/Negócio "></textarea>
            </div>
            <!-- <div class="input-container">
                <input type="password" placeholder="Senha" required name="pass">
            </div>

            <div class="input-container">
                <input type="password" placeholder="Confirmar senha" required>
            </div> -->

        </div>
        <button type="submit" class="submit">
            Enviar Formulário
        </button>


        <!-- <br>
        <p class="signup-link">
            Já tem uma conta?
            <a href="log_page.php?singin">Entrar</a>
        </p> -->

    </form>



</body>

</html>