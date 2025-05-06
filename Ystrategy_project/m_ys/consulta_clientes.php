<?php
include("conexao.php");

$nome_cliente_pedido = $_GET['nome_cliente_pedido'];

$c_c = $conexao->prepare("SELECT a.codigo_cliente as codigo_cliente, a.telefone_contato as telefone_contato, b.valor as tipo_valor,a.credito_cliente as credito_cliente 
FROM base_clientes a, base_valores b where nome_cliente =':n_cliente'");

$data = ['n_cliente' => '1'];
$c_c->execute($data);
$resultado_cliente = $c_c->fetchALL(PDO::FETCH_ASSOC);
foreach($resultado_cliente as $r_c_c){
   ?>

  <option value="<?php echo $r_c_c['codigo_cliente']?>"><?php echo $r_c_c['codigo_cliente']?></option>
   <?php

}