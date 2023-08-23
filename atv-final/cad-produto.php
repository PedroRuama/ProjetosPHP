<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Produto</title>
    <link rel="stylesheet" href="cad.css"/>
</head>
<script>
    function mascaraCod(i) {
        const v = i.value;
        
        if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length-1);
            return;
        }
        
        i.setAttribute("maxlength", "5");
        

    }
    
</script>
<body>
   
    <div id="txtCad">
        Cadastro Produto 

    </div> <br><br>
    <form name="cadastro_produto" method="post" action="visualizar-dados.php">
        
        <input type="text" name="produto" placeholder="Nome Produto"> <br><br>
        
        <input type="text" name="empresa" placeholder="Empresa Responsável"> <br><br>
        data de cadastro:
        <input type="date" name="DataCad" placeholder="Data de Cadastro"> <br><br>
        data de validade:
        <input type="date" name="DataVal"> <br><br>
        <input oninput="mascaraCod(this)" type="text" name="cod" placeholder="Código">
        <br><br><br>
        <input type="submit" value="Enviar" name="submitProduto" id="enviar"/>
    </form>


</body>
</html>