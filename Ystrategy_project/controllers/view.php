<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once('conexao.php');

        $idImagem = 1; // Defina o ID da imagem que deseja recuperar

        // Prepara a consulta SQL para obter os dados da imagem
        $sql = "SELECT nome, imagem FROM imagens WHERE id = 1";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "i", $idImagem);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nomeImagem, $conteudoImagem);
        
        // Verifica se a consulta foi bem-sucedida
        if (mysqli_stmt_fetch($stmt)) {
            // Envia os cabeçalhos apropriados para identificar o tipo de conteúdo da imagem
            header("Content-type: image/jpeg"); // Altere o tipo de conteúdo conforme necessário
        
            // Exibe o conteúdo da imagem
            echo $conteudoImagem;
        } else {
            // Se a imagem não for encontrada, exibe uma imagem padrão ou uma mensagem de erro
            echo "Imagem não encontrada.";
        }
        
        // Fecha a instrução
        mysqli_stmt_close($stmt);
    ?>
</body>
</html>

<?php
    //finaliza a conexao
    mysqli_close($conexao);
    ?>


