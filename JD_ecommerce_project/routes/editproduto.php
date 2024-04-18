<?php
    
    include_once('../controllers/conexao.php');
    $user=0;


    if (isset($_GET['user'])) {
        $user = $_GET['user'];
        $select_user = mysqli_query($conexao, "SELECT * from users where user_name='$user'");
        $dadosU = mysqli_fetch_array($select_user);
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../styles/gerenciar.css">
</head>
<body>
    <div class="container">
        <button type="button"> 
            <a href="gerenciar.php?user=<?=$user?>"><div class="backDiv"> <img src="../iconsJD/setaBranca.png" alt="seta" class="img" id="backseta"> Voltar</div></a>
        
        </button>
        <form action="" id="EditProdutoForm">

            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Código do produto</label>
            </div>
            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="titulo" required="">
                <label for="name" class="form__label">Titulo do produto</label>
            </div>
            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Preço R$</label>
            </div>

            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Preço R$ <del>riscado</del></label>
            </div>

            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Quantidade em Estoque</label>
            </div>
            <div class="form__group">
                <select name="" id="selectForm" class="form__field">
                    <option value="">Camiseta</option>
                    <option value="">Moletom</option>
                    <option value="">Acessório</option>
                    <option value="">Shorts</option>
                    <option value="">Calça</option>
                </select>
                <label for="name" class="form__label">Categoria</label>
            </div>

            
            <div class="form__group">
                <select name="" id="selectForm" class="form__field">
                    <option value="">Camiseta</option>
                    <option value="">Moletom</option>
                    <option value="">Acessório</option>
                    <option value="">Shorts</option>
                    <option value="">Calça</option>
                </select>
                <label for="name" class="form__label">Descrição</label>
            </div>

            
            <div class="form__group" id="UpImgs_div">
                <input type="file" disabled id="inputImagens" accept="image/*" multiple>
                <label for="name" class="form__label">Carregar Imagens</label>
            </div>
            <div id="img_select">


            </div>

            <button type="submit">Editar dados</button>
            <button type="reset"> Limpar</button>
        </form>

            
    </div>
        
</body>
</html>