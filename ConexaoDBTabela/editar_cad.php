<?php
    include_once("controllers\conexao.php");

    $id = $_POST['IdEditar'];
    $query = mysqli_query($conexao, "select * from produtos where id = $id");
    $dados = mysqli_fetch_array($query);
    
?>





<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style/cad.css">
    <script src="scripts/editar.js"></script>
</head>

<body>
    <div id="center">
        <div id="opacity"> .</div>
       
        <div id="componentes">
            <div id="titlo">
               
            </div>
            
            <form action="controllers/editar.php" method="post" id="forms">
                <h1>Alterar produtoo</h1>
                <br><br>
                <div class="aling">

                    <div class="input-group" id="div_prod">
                        <input type="text" name="produto" id="produto" class="input-group_input" onfocus="InputProd(this)"
                            onfocusout="InputProd(this)" value="<?=$dados['produto']?>">
                        <label for="produto" id="prod_label" class="input-group_label">Produto</label>
                    </div>

                </div>
                <br>
                <br>
                <div class="aling">
                    <div class="input-group" id="div_id">
                        <input type="text" name="id" id="id" class="input-group_input" onfocus="InputId(this)" 
                            onfocusout="InputId(this)" value="<?=$dados['id']?>" maxlength="3">
                        <label for="id" id="id_label" class="input-group_label">ID</label>
    
                    </div>
                    
                    <div class="input-group" id="div_cod">
                        <input type="text" name="codigo" id="codigo" class="input-group_input"
                            onfocus="InputCod(this)" onfocusout="InputCod(this)" maxlength="5" value="<?=$dados['codigo']?>">
                        <label for="codigo" id="cod_label" class="input-group_label">Código</label>
    
                    </div>
                </div>
                <br>
                <br>
                <div class="input-group" id="div_desc">
                    <textarea name="descricao" cols="30" rows="3" class="input-group_input" id="descricao" onfocus="InputDesc(this)"
                        onfocusout="InputDesc(this)"><?=$dados['descricao']?></textarea>
                    <label for="descricao" id="desc_label" class="input-group_label">Descrição</label>

                </div>
                <br>
                <br>

                <div class="aling">

                    <div class="input-group" id="div_data">
                        <input type="date" name="data" class="input-group_input" onfocus="InputData(this)" id="data"
                            onfocusout="InputData(this)" value="<?=$dados['data']?>">
                        <label for="data" id="data_label" class="input-group_label" onclick="datalabelclick()">Data</label>
                    </div>
                    
                    <div class="input-group" id="div_prec">
                        <input  id="valor" name="valor" class="input-group_input" onfocus="InputPrec(this)" id="valor"
                            onfocusout="InputPrec(this)" oninput="mascaraMoeda(this, event)" value="<?=$dados['valor']?>">
                        <label for="valor" id="valor_label" class="input-group_label">Preço</label>
    
                    </div>

                </div>
                <br>
                <input type="submit" class="btn" id="ok" value="Ok">&nbsp;&nbsp;

                <div class="aling">
                    <a href="index.php" id="cancel"><button type="button"  class="btn">Cancelar</button></a>
                    
                    <form action="controllers/excluir.php" name="deleteProduto" method="post"> 
                        <input type="txt" name="IdsExcluir" value="<?=$dados['id']?>" id="inputIds_excluir" style="display: none">
                        <input class="btn" onclick="confirmExcluir(this)" id="excluir" type="button" value="Excluir">
                    </form>
                </div>
            </form>
        </div>
</body>
</div>

</html>