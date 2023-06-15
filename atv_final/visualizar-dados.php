<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM</title>
</head>

<body>
    <?php   
        // function DadosPessoa(){
        // }
        

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo "<br> <h3> Dados Cadastro pessoa  </h3>";
            echo  "Nome: ".$_GET['nome'];
            echo "<br>";
            echo  "CPF: ".$_GET['cpf'];
            echo "<br>";
            echo  "Data de Nascmento: ".$_GET['DataNasc'];
            echo "<br>";
            echo  "Telefone: ".$_GET['telefone'];
            echo "<br>";
            echo  "E-mail: ".$_GET['email'];
            echo "<br>";

        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            echo "<br> <h3> Dados Cadastro produto </h3>";
            echo  "Nome Produto: ".$_GET['produto'];
            echo "<br>";
            echo  "Empresa Responsavel: ".$_GET['empresa'];
            echo "<br>";
            echo  "Data de Cadastro: ".$_GET['DataCad'];
            echo "<br>";
            echo  "Data de validade: ".$_GET['DataVal'];
            echo "<br>";
            echo  "Codigo do produtp: ".$_GET['cod'];
            echo "<br>";
        }




    ?>
   
   <br><br><br>
   <div>
    <button type="button" onclik="DadosPessoa()"> Infos Cadastro Pessoa</button> <br>
    <button> Infos Cadastro Produto</button>
   </div>
   <br><br><br>
  
</body>
</html>


