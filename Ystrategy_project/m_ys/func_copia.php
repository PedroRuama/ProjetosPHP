<?php

include("conexao.php");





function retorna($matricula, $conexao){





	$result_os = "SELECT (select telefone_contato from base_clientes a where a.codigo_cliente = x.codigo_cliente) as telefone_contato,(select tipo_valor from base_clientes b where b.codigo_cliente = x.codigo_cliente) as tipo_valor,(select credito_cliente from base_clientes c where c.codigo_cliente = x.codigo_cliente) as credito_cliente,(select id from base_clientes d where d.codigo_cliente = x.codigo_cliente) as id_cliente,x.* FROM base_os x where num_pedido ='$matricula'  LIMIT 1";



	$resultado_os = mysqli_query($conexao, $result_os);

	if($resultado_os->num_rows){

		$row_os = mysqli_fetch_assoc($resultado_os);

		$valores['endereco'] = $row_os['Endereco'];

		$valores['nome_cliente_pedido'] = $row_os['nome_cliente'];

		$valores['codigo_cliente_pedido'] = $row_os['codigo_cliente'];

		$valores['cep'] = $row_os['cep'];

		$valores['Numero'] = $row_os['numero'];

		$valores['complemento'] = $row_os['complemento'];

		$valores['bairro'] = $row_os['bairro'];

		$valores['municipio'] = $row_os['cidade'];

		$valores['valor'] = $row_os['valor'];

		$valores['comentario'] = $row_os['obs'];

		$valores['status'] = $row_os['status'];

		$valores['num_pedido'] = $row_os['num_pedido'];

		$valores['motorista'] = $row_os['motorista'];

		$valores['telefone_cliente_pedido'] = $row_os['telefone_contato'];

		$valores['id_cliente'] = $row_os['id_cliente'];

		$valores['for_pag'] = $row_os['credito_cliente'];

		$valores['tipo_valor'] = $row_os['tipo_valor'];

		$valores['tipo_servico'] = $row_os['tipo_servico'];





	}else{

		$valores['nome_cliente_pedido'] = 'sem cadastro';

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