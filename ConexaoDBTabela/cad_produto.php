<?php
    include_once("controllers/conexao.php");
    
    $query = mysqli_query($conexao, "select id from produtos order by id desc limit 1");

    $ultimo_cad = mysqli_fetch_array($query);
    $id = $ultimo_cad['id'] + 1;
    
    
?>





<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style/cad.css">
    <script>
        console.log("iniciado");
        window.onload = function () {
            //carregar junto com apagina
            console.log("pre load");
            var labelPosition = document.getElementById('id_label');
            var input = document.getElementById('id');

            if (input.value != "") {
                console.log("preenchido")
                labelPosition.classList.toggle('inputNotNull')

            } else { console.log('não preenchido') }
        }
        //.
        //.
        //.
        //.
        //.
        //.
        //.       
        //.
        //.
        function InputId(input) {
            var labelPosition = document.getElementById('id_label')
            
            input.setAttribute("maxlength", "3");
            if (input.value != "") {
                console.log("preenchido")
                labelPosition.classList.toggle('inputNotNull')

            } else { console.log('não preenchido') }
        }
        function InputCod(input) {
            var labelPosition = document.getElementById('cod_label')
            
            if (input.value != "") {
                labelPosition.classList.toggle('inputNotNull')
            }
        }
        function InputProd(input) {
            var labelPosition = document.getElementById('prod_label')
            if (input.value != "") {
                labelPosition.classList.toggle('inputNotNull')
            }
        }
        function InputDesc(input) {
            var labelPosition = document.getElementById('desc_label')
            if (input.value != "") {
                labelPosition.classList.toggle('inputNotNull')
            }
        }
        function InputData(input) {
            var labelPosition = document.getElementById('data_label')
            if (input.value != "") {
                labelPosition.classList.toggle('inputNotNull')
            }
        }
        function datalabelclick() {
            var labelPosition = document.getElementById('data_label')
            labelPosition.classList.toggle('inputNotNull')
        }
        function InputPrec(input) {
            var labelPosition = document.getElementById('prec_label')
            if (input.value != "") {
                labelPosition.classList.toggle('inputNotNull')
            }
        }
        
        String.prototype.reverse = function () {
            return this.split('').reverse().join('');
        };
        
        function mascaraMoeda(campo, evento) {
            var tecla = (!evento) ? window.event.keyCode : evento.which;
            var valor = campo.value.replace(/[^\d]+/gi,'').reverse();
            var resultado = "";
            var mascara = "##.###.###,##".reverse();
            for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
                if (mascara.charAt(x) != '#') {
                    resultado += mascara.charAt(x);
                    x++;
                } else {
                    resultado += valor.charAt(y);
                    y++;
                    x++;
                }
            }
            campo.value = resultado.reverse();
        }


    </script>
</head>

<body>
    <div id="center">
        <div id="componentes">
            <div id="titlo">
               
            </div>
            
            <form action="controllers/incluir.php" method="post" id="forms">
                <h1>Cadastrar produto</h1>
                <br><br>
                <div class="aling">

                    <div class="input-group" id="div_prod">
                        <input type="text" name="produto" class="input-group_input" onfocus="InputProd(this)"
                            onfocusout="InputProd(this)">
                        <label for="produto" id="prod_label" class="input-group_label">Produto</label>
                    </div>

                </div>
                <br>
                <br>
                <div class="aling">
                    <div class="input-group" id="div_id">
                        <input type="text" name="id" id="id" class="input-group_input" onfocus="InputId(this)" 
                            onfocusout="InputId(this)" value="<?= $id ?>" maxlength="3">
                        <label for="id" id="id_label" class="input-group_label">ID</label>
    
                    </div>
                    
                    <div class="input-group" id="div_cod">
                        <input type="text" name="codigo" id="codigo" class="input-group_input" 
                            onfocus="InputCod(this)" onfocusout="InputCod(this)" maxlength="5">
                        <label for="codigo" id="cod_label" class="input-group_label">Código</label>
    
                    </div>
                </div>
                <br>
                <br>
                <div class="input-group" id="div_desc">
                    <textarea name="descricao" cols="30" rows="3" class="input-group_input" id="descricao"onfocus="InputDesc(this)"
                        onfocusout="InputDesc(this)"></textarea>
                    <label for="descricao" id="desc_label" class="input-group_label">Descrição</label>

                </div>
                <br>
                <br>

                <div class="aling">

                    <div class="input-group" id="div_data">
                        <input type="date" name="data" class="input-group_input" onfocus="InputData(this)"
                            onfocusout="InputData(this)">
                        <label for="data" id="data_label" class="input-group_label" onclick="datalabelclick()">Data</label>
                    </div>
                    
                    <div class="input-group" id="div_prec">
                        <input  id="valor" name="valor" class="input-group_input" onfocus="InputPrec(this)"
                            onfocusout="InputPrec(this)" oninput="mascaraMoeda(this, event)">
                        <label for="valor" id="prec_label" class="input-group_label">Preço</label>
    
                    </div>

                </div>
                <br>
                <input type="submit" class="btn" id="ok" value="Ok">&nbsp;&nbsp;

                <div class="aling">
                    <a href="index.php" id="cancel"><button type="button"  class="btn">Cancelar</button></a>
                    <input type="reset" id="reset" class="btn" value="Limpar" name="vlimpar">

                </div>
            </form>
        </div>
</body>
</div>

</html>