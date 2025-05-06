<?php
include_once "./conexao.php";
?>
<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$d = $dados['nomecliente'];

if(empty($dados['nomecliente'])){
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
}else{
   $query_cliente =  "select * from base_clientes";
   $inc_cli = $conexao->prepare($query_cliente);
   // $inc_cli->bindParam(':nomecliente', $dados['nomecliente']);
   $inc_cli->execute();

   if ($inc_cli->num_rows()) {
      $retorna = ['status' => false, 'marca_id' => $conexao->lastInsertId(), 'nome_cliente' => $dados['nomecliente'], 'msg' => "<div class='alert alert-success' role='alert'>Marca cadastrada com sucesso!</div>"];
   } else {
      $retorna = ['status' => false,  'nome_cliente' => $dados['nomecliente'], 'msg' => "<div class='alert alert-success' role='alert'>Marca cadastrada com sucesso!</div>"];
  }

}

echo json_encode($retorna);
