<?php include("./menu.php"); ?>
<html>

<head>
    <title>Formulários de Adição</title>
    <link rel="stylesheet" href="./style/config.css">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <h1>Formulários de Adição</h1>

        <div class="forms">
        <?php
                $simg = mysqli_query($conexao, "SELECT path FROM imgs_users where userID = '".$_SESSION['userID']."'");
                $img = mysqli_fetch_array($simg);
                $row_img = mysqli_num_rows($simg);
                if($row_img >= 1){
                    $path = $img['path'];
                }else{
                    $path = './icons/user.png';
                }
                ?>
            <div class="campo">
                <form action="./controllers/addImg.php" method="post" enctype="multipart/form-data">
                    <label for="imagem-perfil">Adicionar Imagem Perfil</label>
                    <input type="file" id="imagem-perfil" name="img_perfil_" accept="image/*">
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
                <form action="" method="post">
                    <label for="saldo-inicial">Adicionar Saldo Inicial</label>
                    <input type="number" id="saldo-inici al" name="saldo-inicial" step="0.01" placeholder="Digite o saldo inicial">
                    <button type="submit">Adicionar Saldo</button>

                </form>
            </div>
            <hr>
            <div class="campo">
                <br>
                <form action="" method="post">

                    <label for="nova-categoria">Criar Nova Categoria</label>
                    <input type="text" id="nova-categoria" name="nova-categoria" placeholder="Digite o nome da nova categoria">
                    <button type="submit">Criar Categoria</button>

                </form>
            </div>
            <hr>
            <div class="campo">
                <br>
                <form action="" method="post">
                    <label for="novo-gasto-fixo">Adicionar Novo Gasto Fixo</label>
                    <input type="text" id="novo-gasto-fixo" name="novo-gasto-fixo" placeholder="Digite o nome do gasto fixo">
                    <input type="number" id="valor-gasto-fixo" name="valor-gasto-fixo" step="0.01" placeholder="Digite o valor do gasto fixo">
                    <button type="submit">Adicionar Gasto</button>
                </form>
            </div>



        </div>
</body>

</html>