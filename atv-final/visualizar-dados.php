<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Dados</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <?php
        // function DadosPessoa(){
        // }


        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_POST["submitPessoa"])) {
            echo "<br> <h3> Dados Cadastro pessoa  </h3>";
            echo  "Nome: " . $_POST['nome'];
            echo "<br> <br>";
            echo  "CPF: " . $_POST['cpf'];
            echo "<br> <br>";
            echo  "Data de Nascmento: " . $_POST['DataNasc'];
            echo "<br> <br>";
            echo  "Telefone: " . $_POST['telefone'];
            echo "<br> <br>";
            echo  "E-mail: " . $_POST['email'];
            echo "<br> <br>";
        }

        if (isset($_POST["submitProduto"])) {
            echo "<br> <h3> Dados Cadastro produto </h3>";
            echo  "Nome Produto: " . $_POST['produto'];
            echo "<br> <br>";
            echo  "Empresa Responsavel: " . $_POST['empresa'];
            echo "<br> <br>";
            echo  "Data de Cadastro: " . $_POST['DataCad'];
            echo "<br> <br>";
            echo  "Data de validade: " . $_POST['DataVal'];
            echo "<br> <br>";
            echo  "Codigo do produtp: " . $_POST['cod'];
            echo "<br> <br>";
        }


        ?>
 









        </form>
        <button id="btnBack"> <a href="adm.php">Voltar a tela ADM</a></button>
    </div>
    <br><br><br>

</body>

</html>