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
</head>
<body>
    
    <form action="controllers/incluir.php" method="post">
        <input type="number" placeholder="Id" name="id" value="<?= $id ?>"> 
        <input type="number" placeholder="Código" name="codigo"> 
        <input type="text" placeholder="Produto" name="produto"> 
        <textarea name="descricao" id="desc" cols="30" rows="3"></textarea>
        <input type="date"  placeholder="Data" name="data">
        <input type="number" id="valor" placeholder="Preço" name="valor" >
        <input type="submit" id="ok" value="Ok">&nbsp;&nbsp;
        <input type="reset" id="reset" value="Limpar" name="vlimpar">
    </form>
</body>
</html>