<?php

include_once('conexao.php');



function retorna($matricula, $conexao){

	$result = "SELECT * FROM base_os where num_pedido = '$matricula'  LIMIT 1";

	$resultado = mysqli_query($conexao, $result);

	if($resultado->num_rows){

		$row = mysqli_fetch_assoc($resultado);

		$valores['c_r_cliente'] = $row['nome_cliente'];

		$valores['c_r_endereco'] = $row['Endereco'];

		$valores['total'] = $row['valor'];

		$valores['for_pag'] = $row['credito_cliente'];

		$valores['tipo_valor'] = $row['tipo_valor'];

		$valores['tipo_servico'] = $row['tipo_servico'];



	}else{

		$valores['c_r_cliente'] = 'sem cadastro';



	}

	return json_encode($valores);

	 $valores['c_r_cliente'] = 'sem cadastro';



}



if(isset($_GET['matricula'])){

	echo retorna($_GET['matricula'], $conexao);



}

?>