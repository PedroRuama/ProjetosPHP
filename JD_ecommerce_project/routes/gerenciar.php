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
                        <li><a href="../index.php">Home Page</a></li>
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
                    <form action="../controllers/receber.php" method="post" enctype="multipart/form-data">
                        <div class="form__group">
                            <input type="text" class="form__field" placeholder="Cod" name="codP">
                            <label for="name" class="form__label">Código do produto</label>
                        </div>
                        <div class="form__group">
                            <input type="text" class="form__field" placeholder="titulo" name="titulo">
                            <label for="name" class="form__label">Titulo do produto</label>
                        </div>
                        <div class="form__group">
                            <input type="text" class="form__field" placeholder="preçõ" name="preco">
                            <label for="name" class="form__label">Preço R$</label>
                        </div>
                        <div class="form__group">
                            <input type="text" class="form__field" placeholder="preço riscado" name="preco_risc">
                            <label for="name" class="form__label">Preço R$ <del>riscado</del></label>
                        </div>

                        <div class="form__group">
                            <input type="text" class="form__field" placeholder="Quantidade" name="qnt">
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
                                <option value="Camiseta">Camiseta</option>
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
                            <input type="file" id="inputImagens" accept="image/*" multiple name="imagem[]">
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

                            // Adiciona um ouvinte de eventos para quando as imagens forem selecionadas
                            inputImagens.addEventListener('change', function(event) {
                               
                                img_select.innerHTML = '';

                                // Itera sobre os arquivos selecionados
                                for (const arquivo of event.target.files) {
                                    // Cria um elemento de imagem para cada arquivo selecionado
                                    const imagem = document.createElement('img');

                                    // Define o atributo src da imagem com a URL do arquivo
                                    imagem.src = URL.createObjectURL(arquivo);
                                    imagem.classList.add('img3')
                                    // Define estilos para a imagem (tamanho, margem, etc.)

                                    imagem.style.width = '4.5rem';
                                    imagem.style.margin = '0 0.5rem';


                                    // Adiciona a imagem ao container
                                    img_select.appendChild(imagem);
                                }
                            });
                            limparImagensBtn.addEventListener('click', function() {
                                // Limpa o conteúdo do contêiner de imagens
                                img_select.innerHTML = '';

                                // Reseta o valor do input de imagens para limpar a seleção atual
                                inputImagens.value = '';
                            });
                        </script>
                        
                        <button type="submit">Adicionar à loja</button>
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
                        <div class="div_produto div_produtoEdit">
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
                                <!-- Estoque: -->
                                <div class="info">0</div>

                            </div>

                            <div class="div_info">
                                <button><a href="editproduto.php">Editar </a></button>
                            </div>


                        </div>



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