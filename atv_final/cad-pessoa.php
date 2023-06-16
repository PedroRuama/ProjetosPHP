<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script
>
    function mascaraCpf(i) {
        const v = i.value;
        
        if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length-1);
            return;
        }
        
        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";

    }
    function mascaraTelefone(i){
        const v = i.value;
        
        if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length-1);
            return;
        }
        
        i.setAttribute("maxlength", "15");
        if (v.length == 1 ) i.value = "(" + i.value;
        if (v.length == 3 ) i.value += ") ";
        if (v.length == 10) i.value += "-";
    }
</script>
<body>
    cadastro pessoa
    <form action="visualizar-dados.php" method="get" name="cadastro_pessoa">
        Nome:
        <input type="text" name="nome"> <br><br>
        cpf:
        <input oninput="mascaraCpf(this)" id="cpf" name="cpf"> <br><br>
        data de nascimento:
        <input type="date" name="DataNasc"> <br><br>
        Numero de Telefone:
        <input oninput="mascaraTelefone(this)" type="text" name="telefone"><br><br>
        e-mail:
        <input type="text" name="email"><br> <br>
        <input type="submit" value="Enviar" name="submitPessoa" />





    </form>
</body>
</html>