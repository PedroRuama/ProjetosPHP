

<?php
  include_once('controllers/conexao.php');
  
  // O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
  // O return-path deve ser ser o mesmo e-mail do remetente.
  // $headers = "MIME-Version: 1.1\r\n";
  // $headers .= "Content-type: text/plain; charset=UTF-8\r\n";
  // $headers .= "From: pedroruama246@gmail.com\r\n"; // remetente
  // $headers .= "Return-Path: eu@seudominio.com\r\n"; // return-path
  // $envio = mail("destinatario@algum-email.com", "Assunto", "Texto", $headers);
   
  // if($envio)
  //  echo "Mensagem enviada com sucesso";
  // else
  //  echo "A mensagem não pode ser enviada";
  








  // function enviarArquivo($error, $name, $tmp_name){
  //   include('controllers/conexao.php');
  //   if ($error) {
  //     echo  'erro ao enviar arquivo';
  //   }
  
  //   $pasta = 'imgs_banco/';
  //   $nomeDoArquivo = $name;
  //   $novoNomeDoArquivo = uniqid();
  //   $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

  //   if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg") {
  //     die("tipo de arquivo não aceito");
  //   }

  //   $path =  $pasta . $novoNomeDoArquivo . "." . $extensao;
  //   $deu_certo = move_uploaded_file($tmp_name, $path);
  //   if ($deu_certo) {
  //     $conexao->query("INSERT INTO imagens(path) value('$path')") or die($conexao->error);
  //     // echo "tudo certo, acesse o arquivo: <a href='imgs_banco/$novoNomeDoArquivo.$extensao'>clique aq</a></p>";
  //     return true;
  //   }else{ return false;}
  // }
  
  // if(isset($_FILES['imagem']) && count($_FILES) >0){
  //   $arquivo = $_FILES['imagem'];
  //   $tudo_certo= true;
  //   foreach($arquivo['name'] as $index => $arq)
  //   $deu_certo = enviarArquivo($arquivo['error'][$index], $arquivo['name'][$index],$arquivo["tmp_name"][$index]);
  //   if (!$deu_certo) {
  //       $tudo_certo = false;
  //   }
  //   if($tudo_certo){
  //     echo "<p>Todos os arquivos foram enviados com sucesso!";
  //   }else{echo "<p>Falha ao enviar arquivos";}
  // }
  
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selecionar e Exibir Imagens</title>
  <link rel="stylesheet" href="styles/teste.css">
</head>

<body>
 
</body>

</html>