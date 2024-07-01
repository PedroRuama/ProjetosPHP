<?php
include_once('controllers/conexao.php');
include('menu.php');
do {
    $numero_aleatorio = rand(1000, 9999);
    $AutoCodP = str_pad($numero_aleatorio, 4, '0', STR_PAD_LEFT); // Formata o número com zeros à esquerda

    $Verificacao = mysqli_query($conexao, "SELECT codP from produtos where codP = '$AutoCodP'");
    $Verificacao2 = mysqli_query($conexao, "SELECT codP from beats where codP = '$AutoCodP'");
    $num_rows = mysqli_num_rows($Verificacao);
    $num_rowss = mysqli_num_rows($Verificacao2);
} while ($num_rows > 0 || $num_rowss > 0);

$produtos = mysqli_query($conexao, "SELECT * from beats");
$produtoss = mysqli_query($conexao, "SELECT * from beats ORDER BY id DESC");
$selectPedidos = mysqli_query($conexao, "SELECT * from pedidos ORDER BY id_p DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Loja</title>
    <link rel="stylesheet" href="../styles/gerenciar.css">
    <script src="../scripts/gerenciar.js"></script>
</head>

<body>

    <div class="labelselct_div">
        <p>área </p>
        <h2>administrativa</h2>
    </div>
    <div class="operacoes">

        <div class="alingV">
            <div class="acaoADM" onclick="focusAcao(this)">
                <div class="alingH" id="desc_peca" onclick="divAcao()">
                    Adicionar Novo Beat
                    <div class="icon" id="setaDesc">
                        <img src="../iconsJD/seta.png" alt="seta" class="img">
                    </div>
                </div>
                <div class="txt" id="desc_peca_txt">
                    <form action="controllers/addProduto.php" method="post" enctype="multipart/form-data" id="form_produto">
                        <div class="form__group">
                            <input type="text" required class="form__field" placeholder="Cod" name="codP" value="<?= $AutoCodP ?>" disabled>
                            <label for="codP" class="form__label">Código do Beat</label>
                        </div>
                        <div class="form__group">
                            <input type="text" required class="form__field" placeholder="titulo" name="titulo">
                            <label for="name" class="form__label">Titulo do Beat</label>
                        </div>
                        <div class="form__group">
                            <input type="text" required class="form__field" placeholder="preço" name="preco" oninput="mascaraMoeda(this, event)">
                            <label for="name" class="form__label">Preço R$</label>
                        </div>
                        <div class="form__group">
                            <input type="text" required class="form__field" placeholder="preço riscado" name="preco_risc" oninput="mascaraMoeda(this, event)">
                            <label for="name" class="form__label">Preço R$ <del>riscado</del></label>
                        </div>


                        <div class="form__group">
                            <select name="cat" id="selectForm" class="form__field">
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

                            <input type="text" class="form__field" placeholder="preço riscado" name="desc">
                            <label for="name" class="form__label">Descrição</label>
                        </div>

                        <div class="form__group" style="width: 80%">

                            <input type="text" required class="form__field" placeholder="preço riscado" name="link">
                            <label for="name" class="form__label">Link Beat DropBox JD</label>
                        </div>


                        <br>

                        <div class="form__group UpImgs_div">
                            <label for="name" class="form__label">Carregar Imagem da CAPA BEAT </label>
                            <br>
                            <input type="file" id="inputImagens" accept="image/*" multiple name="imagem[]" required>
                        </div>
                        <div id="img_select" style="width: 80%">

                        </div>
                        <div class=" UpImgs_div">
                            <button id="limparImagens" type="button">Limpar Imagens</button>
                        </div>

                        <script>
                            const inputImagens = document.getElementById('inputImagens');
                            const img_select = document.getElementById('img_select');
                            const limparImagensBtn = document.getElementById('limparImagens');

                            inputImagens.addEventListener('change', function(event) {

                                img_select.innerHTML = '';

                                for (const arquivo of event.target.files) {

                                    const imagem = document.createElement('img');


                                    imagem.src = URL.createObjectURL(arquivo);
                                    imagem.classList.add('img3')


                                    imagem.style.width = '4.5rem';
                                    imagem.style.margin = '0 0.5rem';


                                    img_select.appendChild(imagem);
                                }
                            });
                            limparImagensBtn.addEventListener('click', function() {

                                img_select.innerHTML = '';
                                inputImagens.value = '';
                            });
                        </script>

                        <button type="button" onclick="submitAdd(this)">Adicionar à loja</button>
                        <button type="reset"> Cancelar</button>

                    </form>
                </div>
            </div>

            <div class="acaoADM" onclick="focusAcao(this)">

                <div class="alingH" id="desc_peca" onclick="divAcao()">
                    Pesquisar Produto Existente
                    <div class="icon" id="setaDesc">
                        <img src="../iconsJD/seta.png" alt="seta" class="img">
                    </div>
                </div>
                <div class="txt" id="desc_peca_txt">
                    <form action="">
                        <br>
                        <br>
                        <div id="input-container2">
                            <input type="text" autocomplete="off" name="text" id="inputBusc" placeholder="Pesquisar no site...">
                        </div>


                        <div class="div_produto" id="tr">
                            <div class="div_info">
                                <div class="info">imagem -</div>
                            </div>
                            <div class="div_info">
                                <div class="info">--</div>
                            </div>
                            <div class="div_info">
                                <div class="info">titulo -</div>
                            </div>
                            <div class="div_info">
                                <div class="info">--</div>
                            </div>
                            <div class="div_info">
                                <div class="info">Categoria </div>
                            </div>
                            <div class="div_info">
                                <div class="info">--</div>
                            </div>
                            <div class="div_info">
                                <div class="info">Estoque</div>
                            </div>
                            <div class="div_info">
                                <div class="info"></div>
                            </div>
                        </div>

                        <?php
                        while ($dProduto = mysqli_fetch_array($produtos)) {
                            $imagem = mysqli_query($conexao, 'SELECT * FROM imagens WHERE codP =' . $dProduto['codP']);
                            $dImg = mysqli_fetch_array($imagem);
                        ?>
                            <div class="div_produto div_produtoEdit">
                                <div class="div_img">
                                    <img src="../<?= $dImg['path'] ?>" alt="img" class="img3">
                                </div>
                                <div class="div_info">
                                    <div class="info"><?= $dProduto['titulo'] ?></div>

                                </div>
                                <div class="div_info">
                                    <!-- Categoria: -->
                                    <div class="info"><?= $dProduto['categoria'] ?></div>

                                </div>
                                <div class="div_info">
                                    <!-- Estoque: -->
                                    <div class="info"><a href="<?= $dProduto['link'] ?>"> Ouvir </a> </div>

                                </div>

                                <div class="div_info">
                                    <button> <a href="editproduto.php?codP=<?= $dProduto['codP']?>">Editar </a> </button> 
                                </div>


                            </div>
                        <?php
                        }
                        ?>



                    </form>
                </div>

            </div>
            <div class="acaoADM" onclick="focusAcao(this)">

                <div class="alingH" id="desc_peca" onclick="divAcao()">
                    Editar produto em destaque na home
                    <div class="icon" id="setaDesc">
                        <img src="../iconsJD/seta.png" alt="seta" class="img">
                    </div>
                </div>
                <div class="txt" id="desc_peca_txt">
                    <form action="">

                        <div id="input-container2">
                            <input type="text" autocomplete="off" name="text" id="inputBusc" placeholder="Pesquisar Produto...">
                        </div>


                        <div class="div_produto" id="tr">
                            <div class="div_info">
                                <div class="info">imagem</div>
                            </div>
                            <div class="div_info">
                                <div class="info">-</div>
                            </div>
                            <div class="div_info">
                                <div class="info">titulo</div>
                            </div>
                            <div class="div_info">
                                <div class="info">-</div>
                            </div>
                            <div class="div_info">
                                <div class="info">Categoria</div>
                            </div>
                            <div class="div_info">
                                <div class="info">-</div>
                            </div>
                            <div class="div_info">
                                <div class="info">Selecionar <br> em destaque</div>
                            </div>
                            <div class="div_info">
                                <div class="info"></div>
                            </div>
                        </div>

                        <div class="div_produto div_produtoDestaque">
                            <div class="div_img">
                                <img src="../imgs/cabides.jpg" alt="img" class="img3">
                            </div>
                            <div class="div_info">
                                <div class="info">fEsfjsl</div>

                            </div>
                            <div class="div_info">
                                <!-- Categoria: -->
                                <div class="info">Camiseta</div>

                            </div>


                            <div class="div_info">
                                <input type="radio" name="EmDestaque" class="radio">
                            </div>

                        </div>

                        <div class="div_produto div_produtoDestaque">
                            <div class="div_img">
                                <img src="../imgs/cabides.jpg" alt="img" class="img3">
                            </div>
                            <div class="div_info">
                                <div class="info">fEsfjsl</div>

                            </div>
                            <div class="div_info">
                                <!-- Categoria: -->
                                <div class="info">Camiseta</div>

                            </div>


                            <div class="div_info">
                                <input type="radio" name="EmDestaque" class="radio">
                            </div>

                        </div>



                    </form>
                </div>



            </div>

            <div class="acaoADM" onclick="focusAcao(this)">

                <div class="alingH" id="desc_peca" onclick="divAcao()">
                    Pedidos Clientes
                    <div class="icon" id="setaDesc">
                        <img src="../iconsJD/seta.png" alt="seta" class="img">
                    </div>
                </div>
                <div class="txt" id="desc_peca_txt">
                    <form action="">

                        <div class="div_produto" id="tr">
                            <div class="div_info">
                                <div class="info">Imagem</div>
                            </div>
                            <div class="div_info">
                                <div class="info">-</div>
                            </div>
                            <div class="div_info">
                                <div class="info">Código Compra</div>
                            </div>
                            <div class="div_info">
                                <div class="info">-</div>
                            </div>
                            <div class="div_info">
                                <div class="info">Data Pedido -</div>
                            </div>
                            <div class="div_info">
                                <div class="info">-</div>
                            </div>
                            <div class="div_info">
                                <div class="info">Codigo produto </div>
                            </div>
                            <div class="div_info">
                                <div class="info">-</div>
                            </div>
                            <div class="div_info">
                                <div class="info">Ver Detalhes</div>
                            </div>
                            <div class="div_info">
                                <div class="info"></div>
                            </div>
                        </div>
                        <?php
                        while ($pedido = mysqli_fetch_array($selectPedidos)) {
                            $imagem = mysqli_query($conexao, 'SELECT * FROM imagens WHERE codP =' . $pedido['codP']);
                            $dImg = mysqli_fetch_array($imagem);
                        ?>
                            <div class="div_produto div_produtoEdit">
                                <div class="div_img">
                                    <img src="../<?= $dImg['path'] ?>" alt="img" class="img3">
                                </div>

                                <div class="div_info">
                                    <div class="info"><?= $pedido['n_pedido'] ?></div>

                                </div>
                                <div class="div_info">
                                    <!-- Categoria: -->
                                    <div class="info"><?= $pedido['data_p'] ?></div>

                                </div>
                                <div class="div_info">
                                    <!-- Estoque: -->
                                    <div class="info"><?= $pedido['codP'] ?></div>

                                </div>

                                <div class="div_info">
                                    <button><a href="detalhespedido.php?n_pedido=<?= $pedido['n_pedido'] ?>&&codP=<?= $pedido['codP'] ?>">Detalhes Pedido</a></button>
                                </div>


                            </div>
                        <?php } ?>
                    </form>

                </div>



            </div>
        </div>

        <div id="viewPs_box">
            <form action="">

                <div class="div_produto" id="tr">
                    <div class="div_info">
                        <div class="info">imagem -</div>
                    </div>
                    <div class="div_info">
                        <div class="info">--</div>
                    </div>
                    <div class="div_info">
                        <div class="info">titulo -</div>
                    </div>
                    <div class="div_info">
                        <div class="info">--</div>
                    </div>
                    <div class="div_info">
                        <div class="info">Categoria </div>
                    </div>
                    <div class="div_info">
                        <div class="info">--</div>
                    </div>
                    <div class="div_info">
                        <div class="info"></div>
                    </div>
                    <div class="div_info">
                        <div class="info"></div>
                    </div>
                </div>

                <?php
                while ($dPrdts = mysqli_fetch_array($produtoss)) {
                    $imagem = mysqli_query($conexao, 'SELECT * FROM imagens WHERE codP =' . $dPrdts['codP']);
                    $dImg = mysqli_fetch_array($imagem);
                ?>
                    <div class="div_produto div_produtoEdit">
                        <div class="div_img">
                            <img src="../<?= $dImg['path'] ?>" alt="img" class="img3">
                        </div>
                        <div class="div_info">
                            <div class="info"><?= $dPrdts['titulo'] ?></div>

                        </div>
                        <div class="div_info">
                            <!-- Categoria: -->
                            <div class="info"><?= $dPrdts['categoria'] ?></div>

                        </div>
                        <div class="div_info">
                            <!-- Estoque: -->
                            <div class="info"><a href="<?= $dPrdts['link'] ?>"> Ouvir </a> </div>

                        </div>

                        <div class="div_info">
                            <button><a href="editproduto.php?codP=<?=$dPrdts['codP']?>">Editar </a></button>
                        </div>
                    </div>
                <?php
                }
                ?>



            </form>
        </div>
    </div>


</body>

</html>