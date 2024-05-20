<?php
include_once('conexao.php');

echo $codP = $_POST['codP'];
echo '<br>';
echo $titulo = $_POST['titulo'];
echo '<br>';
echo $preco = $_POST['preco'];
echo '<br>';
echo $preco_risc = $_POST['preco_risc'];
echo '<br>';
echo $qnt_estoque = $_POST['qnt'];
echo '<br>';
echo $cat = $_POST['cat'];
echo '<br>';
echo $desc = $_POST['desc'];
echo '<br>';

function enviarArquivo($error, $name, $tmp_name, $num_img)
{
  include('conexao.php');
  if ($error) {
    echo  'erro ao enviar arquivo';
  }
  $codP = $_POST['codP'];

  $pasta = 'imgs_banco/';
  $nomeDoArquivo = $name;
  $novoNomeDoArquivo = $codP;
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

  if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg") {
    die("tipo de arquivo não aceito, os arquivos devem ser png, jpg ou jpeg");
  }
  
  $path =  $pasta . $novoNomeDoArquivo . "_" . $num_img . "." . $extensao;

  $move = "../imgs_banco/" . $novoNomeDoArquivo . "_" . $num_img . "." . $extensao;
  $deu_certo = move_uploaded_file($tmp_name, $move);
  

  if ($deu_certo) {
    $conexao->query("INSERT INTO imagens(codP, path, extensao) value($codP, '$path', '$extensao')") or die($conexao->error);
    // echo "tudo certo, acesse o arquivo: <a href='imgs_banco/$novoNomeDoArquivo.$extensao'>clique aq</a></p>";
    echo '<br>';
    echo "adicionado no banco e na pasta";
    echo '<br>';
    return true;
  } else {
    return false;
  }
}


if (isset($_FILES['imagem']) && count($_FILES) > 0) {
  $arquivo = $_FILES['imagem'];
  $tudo_certo = true;

  foreach ($arquivo['name'] as $index => $arq)
    $deu_certo = enviarArquivo($arquivo['error'][$index], $arquivo['name'][$index], $arquivo["tmp_name"][$index], $index);
  if (!$deu_certo) {
    $tudo_certo = false;
  }
  if ($tudo_certo) {
    echo "<p>Todos os arquivos foram enviados com sucesso!";
  } else {
    echo "<p>Falha ao enviar arquivos";
  }
}



$insert = "insert into produtos(codP, titulo, preco, preco_risc, qnt_estoque, categoria, descricao, destaque)
values('$codP', '$titulo', '$preco', '$preco_risc', $qnt_estoque, '$cat', '$desc', 0)";


// //executando instrução SQL
$resultado = @mysqli_query($conexao, $insert);

if (!$resultado) {
    die('Query Inválida:' . @mysqli_error($conexao));
} else { header("Location: ../gerenciar.php");
}

mysqli_close($conexao);

?>