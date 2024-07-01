<?php

include_once('controllers/conexao.php');
include('menu.php');


if (isset($_GET['n_pedido'])) {
    $n_pedido = $_GET['n_pedido'];
}
if (isset($_GET['codP'])) {
    $codP = $_GET['codP'];
}

$ProdutoSlc = mysqli_query($conexao, "SELECT * from beats where codP=$codP");
$produto = mysqli_fetch_array($ProdutoSlc);

$imagens = mysqli_query($conexao, "SELECT * FROM imagens WHERE codP = $codP");
$dadosImg = mysqli_fetch_array($imagens);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../styles/gerenciar.css">
    <link rel="stylesheet" href="../styles/modal.css">
    <script src="scripts/gerenciar.js"></script>
</head>
<script>
    function edit(btn_edit) {
        var inputs = document.getElementsByTagName('input')

        for (let index = 0; index < inputs.length; index++) {
            const element = inputs[index];

            if (element.disabled) {
                element.removeAttribute("disabled")
            }
        }
        document.getElementById('selectForm').disabled = false;
        btn_edit.style = "display: none";
        document.getElementById("submit").style = "display: flex"
        document.getElementById("cancelar").style = "display: flex"
        alert("Edição habilitada;\n Agora Você pode alterar os dados do Beat")

    }
</script>





<body>
    <div class="div_back">
        <button type="button">
            <a href="gerenciar.php?user=<?= $user ?>">
                <div class="backDiv"> <img src="../iconsJD/setaBranca.png" alt="seta" class="img" id="backseta"> Voltar</div>
            </a>

        </button>

    </div>

    <div class="modal__">
        <div class="modal-content">

            <div class="beat-content">
                <div class="imgCardModal">
                    <img src="<?= $dadosImg['path'] ?>" alt="produto_img">
                </div>
                <div class="txtModal">
                    <h3><?= $produto['titulo'] ?></h3>

                    <br>
                    <h4>Estilo do Beat: <?= $produto['categoria'] ?></h4>
                    <br>
                    <br>
                    <del>R$<?= $produto['preco_risc'] ?></del> <b>R$<?= $produto['preco'] ?></b>
                    <br>
                    <?= $produto['descricao'] ?>
                    <br>
                    <br>
                    <form action="comprar.php" method="post">

                        <input type="text" value="<?= $produto['codP'] ?>" name="codP" style="display: none;">
                        <button type="submit" class="btn_compra" id="comprar_btn">comprar</button>
                    </form>
                </div>
            </div>

            <!-- <audio id="audioPlayer" controls>
                    <source src="beats/100 Shooters [Prod. By JD On Tha Track & Chophouze] 159 Bpm.mp3" type="audio/mpeg">
                    Seu navegador não suporta o elemento de áudio.
                </audio> -->
            <a href="<?= $produto['link'] ?>" target="_blank"> <button type="button" class="ouvir_btn">Ouvir Prévia</button> </a>
        </div>


        <form action="controllers/updateProduto.php" id="EditProdutoForm" method="post">

            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="" name="codP" value="<?= $produto['codP'] ?>" style="pointer-events: none;">
                <label for="name" class="form__label">Código do Beat</label>
            </div>

            <div class="form__group_">
                <input type="text" disabled class="form__field" placeholder="titulo" name="titulo" required="" value="<?= $produto['titulo'] ?>">
                <label for="name" class="form__label">Titulo do produto</label>
            </div>
            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="" name="preco" value="<?= $produto['preco'] ?>" oninput="mascaraMoeda(this, event)">
                <label for="name" class="form__label">Preço R$</label>
            </div>

            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="" name="preco_risc" value="<?= $produto['preco_risc'] ?>" oninput="mascaraMoeda(this, event)">
                <label for="name" class="form__label">Preço R$ <del>riscado</del></label>
            </div>


            
            <input type="text" style="display: none;" id="categoria_beat" value="<?= $produto['categoria'] ?>">

            <div class="form__group">
                <select name="cat" id="selectForm" class="form__field" disabled>
                    <option value="JdBeat">JD Beat</option>
                    <option value="trap">Trap</option>
                    <option value="BoomBap">Boom Bap</option>
                    <option value="Moletom">Drill</option>
                    <option value="HipHop">HipHop</option>
                    <option value="Detroit">Detroit</option>
                    <option value="Funk">Funk</option>
                    <option value="calça">Eletronico</option>
                    <option value="GangstaRap">Gangsta rap</option>
                </select>
                <label for="name" class="form__label">Estilo do Beat</label>
            </div>


            <div class="form__group">
                <select name="desc" id="selectForm" class="form__field">
                    <option value="-">-</option>
                </select>
                <label for="name" class="form__label">Descrição</label>
            </div>
            <div class="form__group_">
                <input type="text" disabled class="form__field" placeholder="titulo" name="link" required="" value="<?= $produto['link'] ?>">
                <label for="name" class="form__label">Link Beat DropBox JD</label>
            </div>

            <div class="form__group" id="UpImgs_div">
                <input type="file" disabled id="inputImagens" accept="image/*" name="imagem[]">
                <label for="name" class="form__label">Carregar Imagens</label>
            </div>

            <div id="img_select">


            </div>

            <button type="button" onclick="edit(this)">Editar dados</button>
            <button type="submit" id="submit" style="display:none;">&nbsp;&nbsp; Salvar &nbsp;&nbsp;</button>

            <button type="button" id="cancelar" style="display:none;">
                <a href="editproduto.php?codP=<?= $codP ?>">
                    <div class="backDiv"> Cancelar</div>
                </a>
            </button>

            <button type="button">
                <a href="controllers/excluir.php?codP=<?= $codP ?>">
                    <div class="backDiv"> Excluir</div>
                </a>
            </button>
        </form>


    </div>

</body>



</html>
<?php
if (isset($_GET['edited'])) {
?>
    <script>
        alert("Editado com Sucesso!")
    </script>
<?php
}
?>