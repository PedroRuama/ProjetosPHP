<?php
include_once('conexao.php');



if (isset($_POST['codP'])) {
  $codP =  mysqli_real_escape_string($conexao, $_POST['codP']);
}

if (isset($_POST['titulo'])) {
  $titulo =  mysqli_real_escape_string($conexao, $_POST['titulo']);
}

if (isset($_POST['preco'])) {
  $preco =  mysqli_real_escape_string($conexao, $_POST['preco']);
}
if (isset($_POST['preco_risc'])) {
  $preco_risc =  mysqli_real_escape_string($conexao, $_POST['preco_risc']);
}
if (isset($_POST['cat'])) {
  $cat =  mysqli_real_escape_string($conexao, $_POST['cat']);
}
if (isset($_POST['desc'])) {
  $desc =  mysqli_real_escape_string($conexao, $_POST['desc']);
}
if (isset($_POST['link'])) {
  $link =  mysqli_real_escape_string($conexao, $_POST['link']);
}
if (isset($_POST['destaque'])) {
  $destaque =  mysqli_real_escape_string($conexao, $_POST['destaque']);
}


if($destaque){
  $conexao->query("UPDATE beats set destaque=0 WHERE destaque=1");
}



function enviarArquivo($error, $name, $tmp_name, $num_img)
{
  include('conexao.php');
  if ($error) {
    echo  'erro ao enviar arquivo de imagem';
    echo "<script> alert('erro ao enviar arquivo de imagem)";
    echo "<script>history.go(-1)</script>";
  }
  $codP = $_POST['codP'];

  $pasta = 'imgs_beats/';
  $nomeDoArquivo = $name;
  $novoNomeDoArquivo = $codP;
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

  if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg") {
    die("tipo de arquivo imagem não aceito, os arquivos devem ser png, jpg ou jpeg");
    echo "<script> alert('tipo de arquivo imagem não aceito, os arquivos devem ser png, jpg ou jpeg')";
    echo "<script>history.go(-1)</script>";
  }
  
  $path =  $pasta . $novoNomeDoArquivo . "_" . $num_img . "." . $extensao;

  $move = "../imgs_beats/" . $novoNomeDoArquivo . "_" . $num_img . "." . $extensao;
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
    echo "<script>alert('Cadastrado com Sucesso ');</script>";
    echo "<script>location.href='../gerenciar.php';</script>";


  } else {
    echo "<p>Falha ao enviar arquivos";
    echo "<script> alert('Falha ao enviar arquivos')";
    echo "<script>history.go(-1)</script>";
  }
}



$update = "update beats set titulo='$titulo', preco='$preco', preco_risc='$preco_risc', categoria='$cat', descricao='$desc', destaque='$destaque', link='$link' where codP=$codP";

//  echo "<script>alert('Falha ao enviar arquivos')";
  
// //executando instrução SQL
$resultado = @mysqli_query($conexao, $update);

echo "<script>location.href='../editproduto.php?codP=$codP&edited';</script>";

if (!$resultado) {
    die('Query Inválida:' . @mysqli_error($conexao));
    echo "<script>alert('Falha ao enviar arquivos')";
    echo "<script>location.href='../gerenciar.php';</script>";
} 

mysqli_close($conexao);

?>