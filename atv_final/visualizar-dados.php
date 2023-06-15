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
        
        
        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_POST["btnCadPessoa"])){
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
        if(empty($_POST["btnCadPessoa"])){
            header("Location: cad-pessoa.php");
        }
        if(isset($_POST["btnCadProduto"])){
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
        // if(empty($_POST["btnCadProduto"])){
        //     header("Location: cad-produto.php");
        // }
       
    ?>
   
   <br><br><br>
   <div>
    <form method="post">
        <input type="submit"  name="btnCadPessoa" value="Infos Cadastro Pessoa"> <br>
        <input type="submit"  name="btnCadProduto" value="Infos Cadastro Produto"> <br>
        
    </form>
    </div>
   <br><br><br>
  

   
   <?php
      
      if(isset($_POST['button1'])) {
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
      if(isset($_POST['button2'])) {
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
    
  <form method="post">
      <input type="submit" name="button1"
              value="Button1"/>
        
      <input type="submit" name="button2"
              value="Button2"/>
  </form>
</body>
</html>


