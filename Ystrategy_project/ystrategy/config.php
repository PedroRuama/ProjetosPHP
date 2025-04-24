<?php include("./menu.php");
include './controllers/chamadas_sql.php';
?>
<html>

<head>
    <title>Formulários de Adição</title>
    <link rel="stylesheet" href="./style/config.css">
    <script src="./script/format.js"></script>
    <style>

    </style>
</head>
<script>



</script>

<body>
    <div class="container">
        <h1>Formulários de Adição</h1>

        <div class="forms">
            <?php
            $simg = mysqli_query($conexao, "SELECT path FROM imgs_users where userID = '" . $_SESSION['userID'] . "'");
            $img = mysqli_fetch_array($simg);
            $row_img = mysqli_num_rows($simg);
            if ($row_img >= 1) {
                $path = $img['path'];
            } else {
                $path = './icons/user.png';
            }
            ?>
            <div class="campo">
                <form action="./controllers/addImg.php" method="post" enctype="multipart/form-data">
                    <label for="imagem-perfil">Adicionar Imagem Perfil</label>
                    <input type="file" id="imagem-perfil" name="img_perfil_" accept="image/*">
                    <br> <br>
                    <div class="img_select" style="width: 80%">
                        <button type="submit">Adicionar Img</button>
                        <img alt="Profile Picture" id="img_user" src="<?= $path ?>" />
                    </div>
                </form>

                <script>
                    const inputImagem = document.getElementById('imagem-perfil');
                    const imgUser = document.getElementById('img_user');

                    inputImagem.addEventListener('change', function(event) {
                        // Verifica se um arquivo foi selecionado
                        if (event.target.files && event.target.files[0]) {
                            const arquivo = event.target.files[0];

                            // Cria uma URL temporária para a imagem selecionada
                            const imagemURL = URL.createObjectURL(arquivo);

                            // Define a imagem no elemento <img id="img_user">
                            imgUser.src = imagemURL;

                            // Adiciona uma classe para estilização (opcional)
                            imgUser.classList.add('img3');
                        }
                    });
                </script>
            </div>
            <hr>
            <div class="campo">
                <br>
                <form action="./controllers/addInitialA.php" method="post">
                    <label for="saldo-inicial">Adicionar Saldo Inicial</label>
                    <input type="number" id="saldo-inici al" name="saldo-inicial" step="0.01" placeholder="Digite o saldo inicial">
                    <br> <br>
                    <button type="submit">Adicionar Saldo</button>

                </form>
            </div>
            <hr>
            <div class="campo">
                <br>
                <form action="./controllers/addCat.php" method="post" id="addCat">

                    <label for="nova-categoria">Criar Nova Categoria</label>
                    <input type="text" require name="name" placeholder="Digite o nome da nova categoria">
                    <br>
                    <br>
                    <label for="nova-categoria">Adicionar</label>
                    <select name="tipo" id="" require>
                        <option value="gasto">Em Gastos</option>
                        <option value="recebimento">Em Recebimentos</option>
                        <option value="ambos">Em Ambos</option>

                    </select>
                    <br> <br>
                    <button type="submit">Criar Categoria</button>

                </form>
            </div>
            <hr>
            <div class="campo">
                <br>
                <form action="./controllers/add_fixos.php" method="post">

                    <label for="novo-gasto-fixo">Adicionar Novo Gasto Fixo</label>
                    <div class="row">
                        <div class="form-group">
                            <!-- <label for="valor">R$ Valor</label> -->
                            <input class="input_cad" type="text" id="novo-gasto-fixo" name="titulo" placeholder="Titulo">
                        </div>

                        <div class="form-group">
                            <input class="input_cad" type="number" id="valor-gasto-fixo" oninput="mascaraMoeda(this, event)" name="valor" step="0.01" placeholder="Valor Aproximado">
                        </div>

                        <div class="form-group">
                            <input class="input_cad" type="number" id="start" name="start_date" step="0.01" placeholder="Dia Pagamento">
                        </div>
                        <div class="form-group">
                            <input class="input_cad" type="number" name="end_date" step="0.01" placeholder="Dia max final">
                        </div>
                        <div class="form-group">
                            <?php $scat = mysqli_query($conexao, "SELECT * from categorias where padrao_ys = 1  and (tipo = 'gasto' OR tipo='ambos')");
                            ?>
                            <select class="select_cad" id="categoria" name="categoria_id" required>
                                <option value="" disabled selected>Categoria</option>
                                <?php while ($cat = $scat->fetch_assoc()) {

                                ?>
                                    <option value="<?= $cat['categoria_id'] ?>"><?= $cat['name'] ?></option>
                                <?php }; ?>
                            </select>

                        </div>
                    </div>

                    <br>
                    <button type="submit">Adicionar Gasto</button>
                </form>
                <br>
                <form action="./controllers/add_fixos.php?editar" method="post">
                    <label for="novo-gasto-fixo">Editar Gasto Fixo</label>
                    <div class="row">
                        <div class="form-group">
                            <?php $sGast = mysqli_query($conexao, "SELECT * from gastos_fixos where userID = $userID");
                            ?>
                            <select class="select_gast" id="Gasto" name="Gasto_id" required>
                                <option value="" disabled selected>Selecionar gasto</option>
                                <?php while ($Gast = $sGast->fetch_assoc()) {

                                ?>
                                    <option value="<?= $Gast['gasto_fixo_id'] ?>"><?= $Gast['name'] ?></option>
                                <?php }; ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <input class="input_cad" type="number" id="valor-gasto-fixo" oninput="mascaraMoeda(this, event)" name="valor" step="0.01" placeholder="Novo Valor Aproximado">
                        </div>

                        <div class="form-group">
                            <input class="input_cad" type="number" id="start" name="start_date" step="0.01" placeholder="Novo Dia Pagamento">
                        </div>
                        <div class="form-group">
                            <input class="input_cad" type="number" name="end_date" step="0.01" placeholder="Novo Dia max final">
                        </div>
                        <div class="form-group">
                            <?php $scat = mysqli_query($conexao, "SELECT * from categorias where padrao_ys = 1  and (tipo = 'gasto' OR tipo='ambos')");
                            ?>
                            <select class="select_cad" id="categoria" name="categoria_id" required>
                                <option value="" disabled selected> Nova Categoria</option>
                                <?php while ($cat = $scat->fetch_assoc()) {

                                ?>
                                    <option value="<?= $cat['categoria_id'] ?>"><?= $cat['name'] ?></option>
                                <?php }; ?>
                            </select>

                        </div>
                    </div>
                    <br>


                    <button type="submit">Editar Gasto</button>
                </form>
            </div>
            <hr>
            <div class="campo">
                <br>
                <form action="./controllers/metas_controller.php?criar_meta" method="post">

                    <label for="novo-gasto-fixo">Criar Nova Meta</label>
                    <div class="row">
                       
                        <div class="form-group">
                            <input class="input_cad" type="number" oninput="mascaraMoeda(this, event)" name="valor" step="0.01" placeholder="Objetivo Meta">
                        </div>
                        <div class="form-group">
                            <input class="input_cad" type="number" oninput="mascaraMoeda(this, event)" name="valor_atual" step="0.01" placeholder="Valor Atual">
                        </div>
                        <div class="form-group">
                            <!-- <label for="valor">R$ Valor</label> -->
                            <input class="input_cad" type="text" id="novo-gasto-fixo" name="titulo" placeholder="Titulo">
                        </div>


                    </div>
            </div>

            <br>
            <button type="submit">Adicionar Meta</button>
            </form>

            </form>
        </div>



    </div>
</body>

</html>