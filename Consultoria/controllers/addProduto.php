<?php
include_once('conexao.php');

 $codP = $_POST['codP'];
//  '<br>';
 $titulo = $_POST['titulo'];
//  '<br>';
 $preco = $_POST['preco'];
//  '<br>';
 $preco_risc = $_POST['preco_risc'];
//  '<br>';
//  $qnt_estoque = $_POST['qnt'];
//  '<br>';
 $cat = $_POST['cat'];
//  '<br>';
 $desc = $_POST['desc'];
//  '<br>';
 $link = $_POST['link'];
//  '<br>';

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



$insert = "insert into beats(codP, titulo, preco, preco_risc, categoria, descricao, destaque, link)
values('$codP', '$titulo', '$preco', '$preco_risc', '$cat', '$desc', 0, '$link')";

 echo "<script>alert('Falha ao enviar arquivos')";
  
// //executando instrução SQL
$resultado = @mysqli_query($conexao, $insert);

if (!$resultado) {
    die('Query Inválida:' . @mysqli_error($conexao));
    echo "<script>alert('Falha ao enviar arquivos')";
    echo "<script>location.href='../gerenciar.php';</script>";
} 
echo "<script>alert('Cadastrado com sucesso')";
echo "<script>location.href='../gerenciar.php';</script>";

echo 'oii';

mysqli_close($conexao);

?>