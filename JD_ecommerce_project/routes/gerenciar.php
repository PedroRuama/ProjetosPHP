<?php
    include_once('../controllers/conexao.php');

    do {
        $numero_aleatorio = rand(1000, 9999); 
        $AutoCodP = str_pad($numero_aleatorio, 4, '0', STR_PAD_LEFT); // Formata o número com zeros à esquerda
        
        $Verificacao = mysqli_query($conexao, "SELECT codP from produtos where codP = '$AutoCodP'");
        $num_rows = mysqli_num_rows($Verificacao);
    } while ($num_rows > 0);

    $user=0;

    if (isset($_GET['user'])) {
        $user = $_GET['user'];
        $select_user = mysqli_query($conexao, "SELECT * from users where user_name='$user'");
        $dadosU = mysqli_fetch_array($select_user);
    }

    $produtos = mysqli_query($conexao, "SELECT * from produtos");

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
    <div class="box_nav">
        <div class="alingV">
            <div class="alingH">
                <div class="icon">
                    <img src="../iconsJD/menu.png" alt="menu" class="img" id="open-btn">
                </div>
                <nav class="sidenav" id="sidenav">
                    <div class="alingH">
                        <div class="logo_nav">
                        </div>
                        <div id="close-btn" class="close-btn">
                            <img src="../iconsJD/close.png" alt="fechar" class="img">
                        </div>
                    </div>


                    <ul>
                        <li><a href="#">
                                <div class="user_div" id="open-btn2">
                                    <img src="../iconsJD/user.png" alt="user" class="img" id="img_user">
                                    <p> Minha Conta</p>
                                </div>
                            </a></li>
                        <li><a href="../index.php?user=<?=$user?>">Home Page</a></li>
                        <li><a href="produtos.php">Camisetas</a></li>
                        <li><a href="#">Moletons</a></li>
                        <li><a href="#">acessórios</a></li>
                    </ul>
                </nav>

                <nav class="sidenav" id="sidenav2">
                    <button id="close-btn2">Voltar</button>
                    <br>
                    <ul>
                        <li>
                            <div class="user_div">
                                <img src="../iconsJD/userRed.png" alt="user" class="img" id="img_user">
                                <p> Minha Conta</p>
                            </div>
                        </li>

                        <div class="optionsConta" id="login" style="display: none;">
                            <li><a href="criarconta.php">Criar Conta</a></li>
                            <li><a href="login.php">Entrar</a></li>
                        </div>

                        <div class="optionsConta" id="logado">
                            <br>
                            <p>Nome do fulano</p>
                            <br>
                            <li><a href="#">Favoritos</a></li>
                            <li><a href="">Pedidos</a></li>
                            <li><a href="">Meu Cadastro</a></li>
                            <br>
                            <br>
                            <br>
                            <li><a href="gerenciar.php">Gerenciar Loja</a></li>
                        </div>
                    </ul>
                </nav>

                <div class="logo_div">
                    <img src="../imgs/logofake2.png" alt="logo" class="img">
                </div>
                <div class="icon">
                    <img src="../iconsJD/sacola.png" alt="carrinho" class="img">
                </div>
            </div>

        </div>
    </div>
    <div class="labelselct_div">
        <p>área </p>
        <h2>administrativa</h2>
    </div>
    <div class="operacoes">
        <div class="alingV">
            <div class="acaoADM" onclick="focusAcao(this)">
                <div class="alingH" id="desc_peca" onclick="divAcao()">
                    Adicionar Novo Produto
                    <div class="icon" id="setaDesc">
                        <img src="../iconsJD/seta.png" alt="seta" class="img">
                    </div>
                </div>
                <div class="txt" id="desc_peca_txt">
                    <form action="../controllers/addProduto.php" method="post" enctype="multipart/form-data" id="form_produto">
                        <div class="form__group">
                            <input type="text" required class="form__field" placeholder="Cod" name="codP" value="<?= $AutoCodP ?>" disabled>
                            <label for="codP" class="form__label">Código do produto</label>
                        </div>
                        <div class="form__group">
                            <input type="text" required class="form__field" placeholder="titulo" name="titulo" >
                            <label for="name" class="form__label">Titulo do produto</label>
                        </div>
                        <div class="form__group">
                            <input type="text" required class="form__field" placeholder="preçõ" name="preco" oninput="mascaraMoeda(this, event)">
                            <label for="name" class="form__label">Preço R$</label>
                        </div>
                        <div class="form__group">
                            <input type="text" required class="form__field" placeholder="preço riscado" name="preco_risc" oninput="mascaraMoeda(this, event)">
                            <label for="name" class="form__label">Preço R$ <del>riscado</del></label>
                        </div>

                        <div class="form__group">
                            <input type="text" required class="form__field" placeholder="Quantidade" name="qnt">
                            <label for="name" class="form__label">Quantidade em Estoque</label>
                        </div>
                        <div class="form__group">
                            <select name="cat" id="selectForm" class="form__field">
                                <option value="Camiseta">Camiseta</option>
                                <option value="Moletom">Moletom</option>
                                <option value="Acessorio">Acessório</option>
                                <option value="Shorts">Shorts</option>
                                <option value="calça">Calça</option>
                            </select>
                            <label for="name" class="form__label">Categoria</label> 
                        </div>


                        <div class="form__group">
                            <select name="desc" id="selectForm" class="form__field">
                                <option value="CamisetaAlgodao">C Algodão</option>
                                <option value="Camiseta">C Poliester</option>
                                <option value="Moletom">Moletom</option>
                                <option value="Acessorio">Acessório</option>
                                <option value="Shorts">Shorts</option>
                                <option value="calça">Calça</option>
                            </select>
                            <label for="name" class="form__label">Descrição</label>
                        </div>

                        <br>
                        <div class="form__group UpImgs_div">
                            <p for="name" class="form__label">Carregar Imagens (selecione e carregue 3 imagnses do produto de uma vez)</p>
                        </div>
                        <div class="form__group UpImgs_div">
                            <input type="file" id="inputImagens" accept="image/*" multiple name="imagem[]" required>
                        </div>
                        <div id="img_select">
                            
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
                            while($dProduto = mysqli_fetch_array($produtos)){
                                $imagem = mysqli_query($conexao, 'SELECT * FROM imagens WHERE codP =' . $dProduto['codP']);
                                $dImg = mysqli_fetch_array($imagem);
                            ?>
                            <div class="div_produto div_produtoEdit">
                                <div class="div_img">
                                    <img src="../<?=$dImg['path'] ?>" alt="img" class="img3">
                                </div>
                                <div class="div_info">
                                    <div class="info"><?=$dProduto['titulo'] ?></div>

                                </div>
                                <div class="div_info">
                                    <!-- Categoria: -->
                                    <div class="info"><?=$dProduto['categoria']?></div>

                                </div>
                                <div class="div_info">
                                    <!-- Estoque: -->
                                    <div class="info"><?=$dProduto['qnt_estoque']?></div>

                                </div>

                                <div class="div_info">
                                    <button><a href="editproduto.php">Editar </a></button>
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
                                <div class="info">Titulo produto </div>
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
                        <div class="div_produto div_produtoEdit">

                            <div class="div_info">
                                <div class="info">Código</div>

                            </div>
                            <div class="div_info">
                                <!-- Categoria: -->
                                <div class="info">data</div>

                            </div>
                            <div class="div_info">
                                <!-- Estoque: -->
                                <div class="info">produto</div>

                            </div>

                            <div class="div_info">
                                <button><a href="detalhespedido.php">Detalhes Pedido</a></button>
                            </div>


                        </div>



                    </form>
                </div>



            </div>
        </div>
    </div>


</body>

</html>