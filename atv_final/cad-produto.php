<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    cadastro produto <br><br>

    <form name="cadastro_produto" method="get" action="visualizar-dados.php">
        nome produto:
        <input type="text" name="produto"> <br><br>
        empresa:
        <input type="text" name="empresa"> <br><br>
        data de cadastro:
        <input type="date" name="DataCad"> <br><br>
        data de validade:
        <input type="date" name="DataVal"> <br><br>
        codigo:
        <input oninput="mascaraCod(this)" type="text" name="cod"><br><br>
        <input type="submit" value="Enviar" name="submitProduto"/>
    </form>


</body>
</html>