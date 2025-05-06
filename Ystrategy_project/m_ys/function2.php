<?php
include_once('conexao.php');

function retorna($matricula, $conexao){
	$result_aluno = "SELECT a.codigo_cliente as codigo_cliente, a.telefone_contato as telefone_contato, a.credito_cliente as credito_cliente, b.valor as tipo_valor FROM base_clientes a LEFT JOIN base_valores b ON a.tipo_valor = b.Tipo_valor WHERE nome_cliente = '$matricula'  LIMIT 1";
	$resultado_aluno = mysqli_query($conexao, $result_aluno);
	if($resultado_aluno->num_rows){
		$row_aluno = mysqli_fetch_assoc($resultado_aluno);
		$valores['codigo_cliente_pedido'] = $row_aluno['codigo_cliente'];
		$valores['telefone_cliente_pedido'] = $row_aluno['telefone_contato'];
		$valores['id_cliente'] = $row_aluno['id_cliente'];
		$valores['for_pag'] = $row_aluno['credito_cliente'];
		$valores['tipo_valor'] = $row_aluno['tipo_valor'];


	}else{
		$valores['endereco_cliente_pedido'] = 'sem cadastro';
	}
	return json_encode($valores);
}

if(isset($_GET['matricula'])){
	echo retorna($_GET['matricula'], $conexao);
}
?>
<?php
if(!isset($_SESSION['usuario']))
{
    header("Location: index.php");
    exit;
}
?>
