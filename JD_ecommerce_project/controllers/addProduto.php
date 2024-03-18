<?php
    include_once('conexao.php'); 
    
    $codP = $_POST['codP'];
    echo '<br>';
    $titulo = $_POST['titulo'];
    echo '<br>';
    $preco = $_POST['preco'];
    echo '<br>';
    $preco_risc = $_POST['preco_risc'];
    echo '<br>';
    $qnt_estoque = $_POST['qnt'];
    echo '<br>';
    $cat = $_POST['cat'];
    echo '<br>';
    $desc = $_POST['desc'];
    echo '<br>';

    if(isset($_FILES['imagem']) && count($_FILES) > 0){
      $arquivo = $_FILES['imagem'];
      $tudo_certo= true;
      foreach($arquivo['name'] as $index => $arq)
      $deu_certo = enviarArquivo($arquivo['error'][$index], $arquivo['name'][$index],$arquivo["tmp_name"][$index]);
      if (!$deu_certo) {
          $tudo_certo = false;
      }
      if($tudo_certo){
        echo "<p>Todos os arquivos foram enviados com sucesso!";
      }else{echo "<p>Falha ao enviar arquivos";}
    }

    function enviarArquivo($error, $name, $tmp_name){
      include('/conexao.php');  
      if ($error) {
        echo  'erro ao enviar arquivo';  
      }  
    
      $pasta = 'imgs_banco/';
      $nomeDoArquivo = $name;
      $novoNomeDoArquivo = uniqid();
      $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
  
      if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg") {
        die("tipo de arquivo não aceito");  
      }  
  
      $path =  $pasta . $novoNomeDoArquivo . "." . $extensao;
      $deu_certo = move_uploaded_file($tmp_name, $path);
      if ($deu_certo) {
        $conexao->query("INSERT INTO arquivos(path) value('$path')") or die($conexao->error);  
        // echo "tudo certo, acesse o arquivo: <a href='imgs_banco/$novoNomeDoArquivo.$extensao'>clique aq</a></p>";
        return true;
      }else{ return false;}  
    }  
    















    

    // $conteudo = file_get_contents($caminhoTemporario);

    // $insert = "insert into produtos( codP, titulo, preco, preco_risc, qnt_estoque, categoria, descricao, img1, vb_img1) 
    //             values('$codP', '$titulo', $preco, $preco_risc, $qnt_estoque, '$cat', '$desc', 'img', $conteudo)";







    // //executando instrução SQL
    // $resultado = @mysqli_query($conexao, $insert);

    // if (!$resultado) {
    //     die('Query Inválida:' . @mysqli_error($conexao));
    // } else { echo 'Sucesso!';
    // }
    // mysqli_close($conexao);



?>