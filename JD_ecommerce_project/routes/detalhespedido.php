<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes Pedido</title>
    <link rel="stylesheet" href="../styles/gerenciar.css">
</head>

<body>
    <div class="container">
        <button type="button">
            <a href="gerenciar.php">
                <div class="backDiv"> <img src="../iconsJD/setaBranca.png" alt="seta" class="img" id="backseta"> Voltar
                </div>
            </a>

        </button>
        <form action="" id="EditProdutoForm">
            <div class="tr_setor">
                Cliente
            </div>
            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Nome</label>
            </div>
            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="titulo" required="">
                <label for="name" class="form__label">Usuário</label>
            </div>
            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Email</label>
            </div>

            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Celular</label>
            </div>
            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">CPF</label>
            </div>

            <div class="tr_setor">
                Endereço de entrega
            </div>

            <div class="form__group" style="width: 100%;">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Endereço</label>
            </div>


            <div class="tr_setor">
                Pedido
            </div>

            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Código Pedido</label>
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
                    <div class="info">Qtn</div>
                </div>
                <div class="div_info">
                    <div class="info">-</div>
                </div>
                <div class="div_info">
                    <div class="info">Preço</div>
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
                    <div class="info">R$10,00</div>
                </div>
            </div>
            <div class="form__group">
                <input type="text" disabled class="form__field" placeholder="Name" required="">
                <label for="name" class="form__label">Forma de Pagamento</label>
            </div>

            <div class="tr_setor">
                Selecionar Etapa Pedido
            </div>
            <div class="div_radiosForm">
                <div class="div_radio">
                    <input type="radio" id="radio1" name="grupo" value="opcao1">
                    <label for="radio1">Pagamento Confirmado</label><br>
                </div>

                <div class="div_radio">
                    <input type="radio" id="radio2" name="grupo" value="opcao2">
                    <label for="radio2">Preparando Pedido</label><br>
                </div>
    
                <div class="div_radio">
                    <input type="radio" id="radio3" name="grupo" value="opcao3">
                    <label for="radio3">Pedido a Caminho</label><br>
                    <div class="form__group" style="display: none; width: 80%;" id="RastramentoCodigo">
                        <input type="text" class="form__field" placeholder="Name" required="">
                        <label for="name" class="form__label"> Código Rastreamento Correios</label>
                    </div>
                </div>
            </div>
            <br>
            
            <button type="submit">Salvar Etapa</button>
           
        </form>


    </div>
    <br>
    <br>
    <br>
</body>

</html>