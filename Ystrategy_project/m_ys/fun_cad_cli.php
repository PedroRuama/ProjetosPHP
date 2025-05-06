<?php
include_once('conexao.php');

function retorna($matricula, $conexao){
	$result_aluno = "SELECT * FROM base_clientes where nome_cliente = '$matricula'  LIMIT 1";
	$resultado_aluno = mysqli_query($conexao, $result_aluno);
	if($resultado_aluno->num_rows){
		$row_aluno = mysqli_fetch_assoc($resultado_aluno);
		$valores['codigo_cliente'] = $row_aluno['codigo_cliente'];
		$valores['senha_cliente'] = $row_aluno['senha'];
		$valores['email_cliente'] = $row_aluno['email'];
		$valores['rg_cliente'] = $row_aluno['rg'];
		$valores['cpf_cliente'] = $row_aluno['CPF'];
		$valores['telefone_cliente'] = $row_aluno['telefone_contato'];
		$valores['credito_cliente'] = $row_aluno['credito_cliente'];
        $valores['tipo_val'] = $row_aluno['tipo_valor'];
		$valores['Prazo_cred'] = $row_aluno['prazo_cliente'];
		$valores['desconto'] = $row_aluno['desconto'];
		$valores['Prazo_Nota'] = $row_aluno['prazo_nota'];
		$valores['com'] = $row_aluno['obs'];
		$valores['tipo_nota'] = $row_aluno['tipo_nota'];
		$valores['adminis'] = $row_aluno['administrador'];
		$valores['id_cliente'] = $row_aluno['id_cliente'];

	}else{
		$valores['codigo_cliente'] = 'sem cadastro';
	}
	return json_encode($valores);
}

if(isset($_GET['matricula'])){
	echo retorna($_GET['matricula'], $conexao);
}
?>

