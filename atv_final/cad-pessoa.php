<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Pessoa</title>
    <link rel="stylesheet" href="cad.css"/>
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
    <div id="align">
        <div id="txtCad">
            Cadastro Pessoa 
        </div>
        <br> <br>
        <form action="visualizar-dados.php" method="get" name="cadastro_pessoa">
            
            <input type="text" name="nome" placeholder="Nome"> <br><br>
            
            <input oninput="mascaraCpf(this)" id="cpf" name="cpf" placeholder="CPF"> <br><br>
           
            <input type="date" name="DataNasc" id="Data de nascimento" > <br><br>
           
            <input oninput="mascaraTelefone(this)" type="text" name="telefone" placeholder="Número de telefone"><br><br>
           
            <input type="text" name="email" placeholder="E-mail"><br> <br>

            <input type="submit" value="Enviar" name="submitPessoa" id="enviar"/>

        </form>
    </div>
</body>
</html>