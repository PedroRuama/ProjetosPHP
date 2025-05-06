<?php

include('conexao.php');




session_start();



if (!isset($_POST['id_cliente']) || $_POST['id_cliente'] == "") {
  $Cliente = mysqli_query($conexao, "SELECT * FROM base_clientes WHERE nome_cliente = '" . $_POST['nome_cliente_pedido'] . "' OR nome_cliente = '" . $_POST['nome_cliente_pedido2'] . "'");
  $dadosCliente = mysqli_fetch_array($Cliente);

  $id = $dadosCliente['id'];
  $codigo = $dadosCliente['codigo_cliente'];
} else {
  $id = mysqli_real_escape_string($conexao, $_POST['id_cliente']);
  $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_cliente_pedido']);
}


// echo '<br>';
// echo 'usuario: '.$usuario = $_SESSION['usuario'];
// echo '<br>';
// echo 'codigo cliente: '.$codigo;
// echo '<br>';
// echo 'id_cliente: '.$id;
// echo '<br>';
// echo 'nome_c: '.$nome = mysqli_real_escape_string($conexao, $_POST['nome_cliente_pedido']);
// echo '<br>';
// echo 'nome cliente2: '.$nome2 = mysqli_real_escape_string($conexao, $_POST['nome_cliente_pedido2']);
// echo '<br>';
// echo 'numero pedido: '.$n_pedido = mysqli_real_escape_string($conexao, $_POST['num_pedido']);
// echo '<br>';
// echo 'data entrega: '.$d_entrega = mysqli_real_escape_string($conexao, $_POST['d_entrega']);
// echo '<br>';
// echo 'data retirada: '.$d_retirada = mysqli_real_escape_string($conexao, $_POST['d_retirada']);
// echo '<br>';
// echo 'status: '.$status = mysqli_real_escape_string($conexao, $_POST['status']);
// echo '<br>';
// echo 'endereço: '.$endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
// echo '<br>';
// echo 'numero endereco '.$Numero = mysqli_real_escape_string($conexao, $_POST['Numero']);
// echo '<br>';
// echo 'complemento: '.$complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
// echo '<br>';
// echo 'bairro'.$bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
// echo '<br>';
// echo 'municipio'. $municipio = mysqli_real_escape_string($conexao, $_POST['municipio']);
// echo '<br>';
// echo 'uf?: '.$uf = mysqli_real_escape_string($conexao, $_POST['uf']);
// echo '<br>';
// echo 'ceps: '.$ceps = mysqli_real_escape_string($conexao, $_POST['cep']);
// echo '<br>';
// echo 'quantidade: '.$qc = mysqli_real_escape_string($conexao, $_POST['qc']);
// echo '<br>';
// echo 'valor: '. $valor = mysqli_real_escape_string($conexao, $_POST['valor']);
// echo '<br>';
// echo 'p_retirada '.$p_ret = mysqli_real_escape_string($conexao, $_POST['p_ret']);
// echo '<br>';
// echo 'forma pagamento '.$for_pag = mysqli_real_escape_string($conexao, $_POST['for_pag']);
// echo '<br>';
// echo 'acao: '.$acao = mysqli_real_escape_string($conexao, $_POST['edicao']);
// echo '<br>';
// echo 'telefone: ' . $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
// echo '<br>';
// echo 'motorista: ' . $motorista = mysqli_real_escape_string($conexao, $_POST['motorista']);
// echo '<br>';
// echo 'placa: ' . $placa = mysqli_real_escape_string($conexao, $_POST['placa']);
// echo '<br>';
// echo 'comentario: ' . $comentario = mysqli_real_escape_string($conexao, $_POST['comentario']);
// echo '<br>';
// echo '<br>';


$usuario = $_SESSION['usuario'];
$nome = mysqli_real_escape_string($conexao, $_POST['nome_cliente_pedido']);
$nome2 = mysqli_real_escape_string($conexao, $_POST['nome_cliente_pedido2']);
$n_pedido = mysqli_real_escape_string($conexao, $_POST['num_pedido']);
$d_entrega = mysqli_real_escape_string($conexao, $_POST['d_entrega']);
$d_retirada = mysqli_real_escape_string($conexao, $_POST['d_retirada']);
$status = mysqli_real_escape_string($conexao, $_POST['status']);
$endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
$Numero = mysqli_real_escape_string($conexao, $_POST['Numero']);
$complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
$bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
$municipio = mysqli_real_escape_string($conexao, $_POST['municipio']);
$uf = mysqli_real_escape_string($conexao, $_POST['uf']);
$ceps = mysqli_real_escape_string($conexao, $_POST['cep']);
$qc = mysqli_real_escape_string($conexao, $_POST['qc']);
$valor = mysqli_real_escape_string($conexao, $_POST['valor']);
$p_ret = mysqli_real_escape_string($conexao, $_POST['p_ret']);
$for_pag = mysqli_real_escape_string($conexao, $_POST['for_pag']);
$acao = mysqli_real_escape_string($conexao, $_POST['edicao']);
$telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
$motorista = mysqli_real_escape_string($conexao, $_POST['motorista']);
$placa = mysqli_real_escape_string($conexao, $_POST['placa']);
$comentario = mysqli_real_escape_string($conexao, $_POST['comentario']);
$tipo_c = mysqli_real_escape_string($conexao, $_POST['tipo_c']);
$tipo_se = mysqli_real_escape_string($conexao, $_POST['tipo_se']);
$periodo = mysqli_real_escape_string($conexao, $_POST['periodo']);


date_default_timezone_set('America/Sao_Paulo'); // Define o fuso para São Paulo (GMT-3)

$hoje = date('Y-m-d');
$rpc = 1;
$de = date("Y-m-d", strtotime($hoje . "+$rpc days"));

$hora = date('H:i');



$base_os =  mysqli_query($conexao, "select * from base_os where codigo_cliente = '$codigo'") or die($mysqli_error);

while ($resultado_base_os = $base_os->fetch_assoc()) {

  $RCBOSTATUS = $resultado_base_os['status'];
}

// $pedido_no_os =  mysqli_query($conexao, "select * from base_os where num_pedido = '$n_pedido'") or die($mysqli_error);
// $pedido_os = $pedido_no_os ->fetch_assoc();



$Permissao =  mysqli_query($conexao, "select * from cadastro where usuario = '$usuario' and acao = 'Geral'") or die($mysqli_error);

while ($resultado_cadastro = $Permissao->fetch_assoc()) {

  $RCU = $resultado_cadastro['USUARIO'];
}


if($acao == 'Troca' ||  $acao == 'Incluir' || $acao == 'Editar Data Entrega'){
  $data_def = $d_entrega;
} else{
  $data_def = $d_retirada;
}




$cont_r_t =  mysqli_query($conexao, "
SELECT 
    motorista,

    (SELECT 
        COUNT(CASE 
            WHEN (status = 'Retirar' OR status = 'Retirado') 
            AND data_retirada = '$data_def'   
            THEN 1 END) 
        - COUNT(CASE 
            WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
            AND (tipo_os = 'Troca' OR troca != '')
            AND (data_entrega = '$data_def' OR data_retirada = '$data_def')
            AND (Motorista_retirada = b.motorista AND b.data_retirada = '$data_def') 
            THEN 1 END)
    FROM base_os b
    WHERE b.Motorista_retirada = a.motorista) AS Retirar,

    (SELECT 
        COUNT(CASE 
            WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
            AND (tipo_os = 'Troca' OR troca != '')
            AND (data_entrega = '$data_def' OR data_retirada = '$data_def')
            AND (Motorista_retirada = b.motorista AND b.data_retirada = '$data_def') 
            THEN 1 END)
    FROM base_os b
    WHERE b.Motorista_retirada = a.motorista) AS Trocar,
    (COUNT(CASE 
            WHEN (status = 'Retirar' OR status = 'Retirado') 
            AND data_retirada = '$data_def'   
            THEN 1 END) 
        - COUNT(CASE 
            WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
            AND (tipo_os = 'Troca' OR troca != '')
            AND (data_entrega = '$data_def' OR data_retirada = '$data_def')
            AND (Motorista_retirada = a.motorista AND a.data_retirada = '$data_def') 
            THEN 1 END)
        + COUNT(CASE 
            WHEN (status IN ('Entregar', 'Entregue', 'Retirar', 'Retirado')) 
            AND (tipo_os = 'Troca' OR troca != '')
            AND (data_entrega = '$data_def' OR data_retirada = '$data_def')
            AND (Motorista_retirada = a.motorista AND a.data_retirada = '$data_def') 
            THEN 1 END)
    ) AS Total

FROM base_os a 
WHERE a.Motorista_retirada = '$motorista';



") or die($mysqli_error);

$servico_motorista = $cont_r_t->fetch_assoc();



$val_tab =  mysqli_query($conexao, "select * from base_valores  ") or die($mysqli_error);



while ($val_tabs = $val_tab->fetch_assoc()) {

  echo $val_tabs['nome_motorista'];
}





if ($municipio === 'São Paulo') {





  function getListaDiasFeriado($ano = null)
  {



    if ($ano === null) {

      $ano = intval(date('Y'));
    }



    $pascoa = easter_date($ano); // retorna data da pascoa do ano especificado

    $diaPascoa = date('j', $pascoa);

    $mesPacoa = date('n', $pascoa);

    $anoPascoa = date('Y', $pascoa);



    $feriados = [

      // Feriados nacionais fixos

      mktime(0, 0, 0, 1, 1, $ano), // Confraternização Universal

      mktime(0, 0, 0, 4, 21, $ano), // Tiradentes

      mktime(0, 0, 0, 5, 1, $ano), // Dia do Trabalhador

      mktime(0, 0, 0, 9, 7, $ano), // Dia da Independência

      mktime(0, 0, 0, 10, 12, $ano), // N. S. Aparecida

      mktime(0, 0, 0, 11, 2, $ano), // Todos os santos

      mktime(0, 0, 0, 11, 15, $ano), // Proclamação da republica

      mktime(0, 0, 0, 12, 25, $ano), // Natal

      //

      // Feriados variaveis

      mktime(0, 0, 0, $mesPacoa, $diaPascoa - 48, $anoPascoa), // 2º feria Carnaval

      mktime(0, 0, 0, $mesPacoa, $diaPascoa - 47, $anoPascoa), // 3º feria Carnaval

      mktime(0, 0, 0, $mesPacoa, $diaPascoa - 2, $anoPascoa), // 6º feira Santa

      mktime(0, 0, 0, $mesPacoa, $diaPascoa, $anoPascoa), // Pascoa

      mktime(0, 0, 0, $mesPacoa, $diaPascoa + 60, $anoPascoa), // Corpus Christ

    ];



    sort($feriados);



    $listaDiasFeriado = [];

    foreach ($feriados as $feriado) {

      $data = date('Y-m-d', $feriado);

      $listaDiasFeriado[$data] = $data;
    }



    return $listaDiasFeriado;
  }



  function isFeriado($data)
  {

    $listaFeriado = getListaDiasFeriado(date('Y', strtotime($data)));

    if (isset($listaFeriado[$data])) {

      return true;
    }



    return false;
  }



  function getDiasUteis($aPartirDe, $quantidadeDeDias = 30)
  {

    $dateTime = new DateTime($aPartirDe);



    $listaDiasUteis = [];

    $contador = 0;

    while ($contador < $quantidadeDeDias) {
      $dateTime->modify('+1 weekday'); // adiciona um dia pulando finais de semana

      $data = $dateTime->format('Y-m-d');

      if (!isFeriado($data)) {

        $listaDiasUteis[] = $data;

        $contador++;
      }
    }



    return $listaDiasUteis;
  }



  $listaDiasUteis = getDiasUteis($d_entrega, 3);

  $ultimoDia = end($listaDiasUteis);
} else {



  function getListaDiasFeriado($ano = null)
  {



    if ($ano === null) {

      $ano = intval(date('Y'));
    }



    $pascoa = easter_date($ano); // retorna data da pascoa do ano especificado

    $diaPascoa = date('j', $pascoa);

    $mesPacoa = date('n', $pascoa);

    $anoPascoa = date('Y', $pascoa);



    $feriados = [

      // Feriados nacionais fixos

      mktime(0, 0, 0, 1, 1, $ano), // Confraternização Universal

      mktime(0, 0, 0, 4, 21, $ano), // Tiradentes

      mktime(0, 0, 0, 5, 1, $ano), // Dia do Trabalhador

      mktime(0, 0, 0, 9, 7, $ano), // Dia da Independência

      mktime(0, 0, 0, 10, 12, $ano), // N. S. Aparecida

      mktime(0, 0, 0, 11, 2, $ano), // Todos os santos

      mktime(0, 0, 0, 11, 15, $ano), // Proclamação da republica

      mktime(0, 0, 0, 12, 25, $ano), // Natal

      //

      // Feriados variaveis

      mktime(0, 0, 0, $mesPacoa, $diaPascoa - 48, $anoPascoa), // 2º feria Carnaval

      mktime(0, 0, 0, $mesPacoa, $diaPascoa - 47, $anoPascoa), // 3º feria Carnaval

      mktime(0, 0, 0, $mesPacoa, $diaPascoa - 2, $anoPascoa), // 6º feira Santa

      mktime(0, 0, 0, $mesPacoa, $diaPascoa, $anoPascoa), // Pascoa

      mktime(0, 0, 0, $mesPacoa, $diaPascoa + 60, $anoPascoa), // Corpus Christ

    ];



    sort($feriados);



    $listaDiasFeriado = [];

    foreach ($feriados as $feriado) {

      $data = date('Y-m-d', $feriado);

      $listaDiasFeriado[$data] = $data;
    }



    return $listaDiasFeriado;
  }



  function isFeriado($data)
  {

    $listaFeriado = getListaDiasFeriado(date('Y', strtotime($data)));

    if (isset($listaFeriado[$data])) {

      return true;
    }



    return false;
  }



  function getDiasUteis($aPartirDe, $quantidadeDeDias = 30)
  {

    $dateTime = new DateTime($aPartirDe);



    $listaDiasUteis = [];

    $contador = 0;

    while ($contador < $quantidadeDeDias) {
      $dateTime->modify('+1 weekday'); // adiciona um dia pulando finais de semana

      $data = $dateTime->format('Y-m-d');

      if (!isFeriado($data)) {

        $listaDiasUteis[] = $data;

        $contador++;
      }
    }



    return $listaDiasUteis;
  }



  $listaDiasUteis = getDiasUteis($d_entrega, 5);

  $ultimoDia = end($listaDiasUteis);
}





$query = "select * from base_os where status = 'aberto' ";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);



$query1 = "select * from base_motorista";

$result1 = mysqli_query($conexao, $query1);

$row1 = mysqli_num_rows($result1);

$consulta_qp = "select * from base_os";

$result = mysqli_query($conexao, $consulta_qp);

$rowsss = mysqli_num_rows($result) + 1;

$dias = '<?php echo date("Y-m-d"); ?>';

$maximo_numero_pedido =  mysqli_query($conexao, "select max(num_pedido) as tt from base_os order by num_pedido ") or die($mysqli_error);

$maximo_numero = $maximo_numero_pedido->fetch_assoc();

$rowss =  $maximo_numero['tt'];




$consulta_base_cliente_codigo_cliente =  mysqli_query($conexao, "select * from base_clientes where codigo_cliente = '{$codigo}'") or die($mysqli_error);

while ($result_cliente_codigo = $consulta_base_cliente_codigo_cliente->fetch_assoc()) {

  $rpc = $result_cliente_codigo['prazo_cliente'];

  $rtn = $result_cliente_codigo['tipo_nota'];

  $pc = date("Y-m-d", strtotime($d_entrega . "+$rpc days"));

  //  echo "<script>alert('$pc');</script>" ;

}


try {



  if ($nome === "") {

    echo "<script>

        alert('O campo Nome nao pode estar vazio');

        </script>";

    echo "<script>history.go(-1)</script>";
  } elseif ($_SESSION['ACESSO'] != "ADMIN" && $hora > '10:00' && $hoje == $data_def) {

    echo "<script>

        alert('Fora do horário de cadastro, cadastre o serviço para outro dia');

        </script>";

    echo "<script>history.go(-1)</script>";
  } elseif ($_SESSION['ACESSO'] != "ADMIN" && $servico_motorista['Total'] >= 6) {

    echo "<script>

        alert('O motorista atingiu seu máximo de serviços neste dia');

        </script>";

    echo "<script>history.go(-1)</script>";
  }elseif ($acao === 'Exluir Pedido') {

    if ($status != "Entregar") {

      if ($RCU) {

        $incluircadastro1 = $conexao->prepare("Delete from base_os WHERE num_pedido = '$n_pedido'");

        $incluircadastro1->execute();

        echo "<script>location.href = 'form_rt.php';</script>";
      } else {

        echo "<script>alert('$usuario, o pedido so pode ser Excluido antes da Entrega');</script>";

        // echo "<script>history.go(-1)</script>";

      }
    } else {

      $np = $rowss + '1';

      $incluircadastro1 = $conexao->prepare("Delete from base_os WHERE num_pedido = '$n_pedido'");

      $incluircadastro1->execute();

      echo "<script>location.href = 'form_rt.php';</script>";
    }
  } elseif ($status === "Retirado") {

    if ($acao === 'Incluir') {

      // echo "<script>alert('Cadastro sendo realizado');</script>"; 



      $np = $rowss + $qc;

      for ($i = $rowss + '1'; $i <= $np; $i++) {

        $incluircadastro = $conexao->prepare("INSERT INTO base_os(aterro,cacamba,periodo,Motorista_retirada,troca,identificacao_pagamento,tipo_nota,data_vencimento,nome_cliente,codigo_cliente,num_pedido,tipo_os,Endereco,numero,complemento,bairro,cidade,cep,data_entrega,valor,obs,motorista,Motorista_entrega,data_retirada,status,status_pagamento,for_pag,confirm_troca,tipo_cacamba,Usuario,tipo_servico,acao)

                VALUES

                ('EM_OBRA','$xx','$periodo','$xx','$xx','$xx','$rtn','$pc','$nome','$codigo','$i','Colocacao','$endereco','$Numero','$complemento','$bairro','$municipio','$ceps','$d_entrega','$valor','$comentario','$motorista','$motorista','$ultimoDia','Entregar','NÃO','$for_pag',0,'$tipo_c','$usuario','$tipo_se', 'colocacao criada (Novo ped)')");

        $incluircadastro->execute();
      }

      echo "<script>location.href = 'form_rt.php';</script>";
    } else {

      echo "<script>alert('pedido ja foi Retirado');</script>";

      echo "<script>location.href = 'form_rt.php';</script>";
    }
  } elseif ($acao === 'Editar Motorista') {



    if ($motorista === "" || $motorista == null) {

      echo "<script>alert('Informar o Motorista');</script>";

      echo "<script>history.go(-1)</script>";
    } else {



      if ($status === "Entregar") {

        $np = $rowss + '1';

        $incluircadastro1 = $conexao->prepare("UPDATE base_os SET Motorista_entrega = '$motorista', motorista = '$motorista', last_alter_User='$usuario', acao='edit motorista entrega' WHERE num_pedido = '$n_pedido'");

        $incluircadastro1->execute();

        echo "<script>location.href = 'form_rt.php';</script>";
      } elseif ($status === "Retirar") {

        $np = $rowss + '1';

        $incluircadastro1 = $conexao->prepare("UPDATE base_os SET Motorista_retirada = '$motorista',motorista = '$motorista', last_alter_User='$usuario', acao='edit motorista retirada'  WHERE num_pedido = '$n_pedido'");

        $incluircadastro1->execute();

        echo "<script>location.href = 'form_rt.php';</script>";
      } else {

        echo "<script>alert('Motorista nao pode ser alterado');</script>";

        echo "<script>history.go(-1)</script>";
      }
    }
  } elseif ($acao === 'Editar Data Entrega') {

    if ($status != "Entregar") {

      echo "<script>alert('Data so pode ser alterada antes da Entrega');</script>";

      echo "<script>history.go(-1)</script>";
    } else {

      $np = $rowss + '1';

      $incluircadastro1 = $conexao->prepare("UPDATE base_os SET data_entrega = '$d_entrega', last_alter_User='$usuario', acao='edit data entrega'  WHERE num_pedido = '$n_pedido'");

      $incluircadastro1->execute();

      echo "<script>location.href = 'form_rt.php';</script>";
    }
  } elseif ($acao === 'Editar Data Retirada') {

    if ($status === "Retirado") {

      echo "<script>alert('Produto ja Retirada');</script>";

      echo "<script>history.go(-1)</script>";
    } else {

      $np = $rowss + '1';

      $incluircadastro1 = $conexao->prepare("UPDATE base_os SET data_retirada =  '$d_retirada', last_alter_User='$usuario', acao='edit data retirada'  WHERE num_pedido = '$n_pedido'");

      $incluircadastro1->execute();

      echo "<script>location.href = 'form_rt.php';</script>";
    }

    // <= $hoje

  } elseif ($acao === 'Retirar') {

    if (!$d_retirada) {

      echo "<script>alert('Programar a Data de Retirada');</script>";

      echo "<script>history.go(-1)</script>";
    } elseif ($motorista == "" || $motorista == null) {

      echo "<script>alert('Informar o Motorista');</script>";

      echo "<script>history.go(-1)</script>";
    } elseif ($status != "Entregue" && $status != "Retirar") {

      echo "<script>alert('Produto Precisar estar entregue para ser Retirado');</script>";

      echo "<script>history.go(-1)</script>";
    } else {

      $np = $rowss + '1';

      $incluircadastro1 = $conexao->prepare("UPDATE base_os SET Motorista_retirada = '$motorista',motorista = '$motorista', status ='Retirar', data_retirada =  '$d_retirada', confirm_troca = 0, troca = '$xx', tipo_os = 'Colocacao', last_alter_User='$usuario', acao='retirada programada'  WHERE num_pedido = '$n_pedido'");

      $incluircadastro1->execute();



      echo "<script>location.href = 'form_rt.php';</script>";
    }
  } elseif ($acao === 'Trocass') {

    $np = $rowss + '1';

    $incluircadastro1 = $conexao->prepare("UPDATE base_os SET Motorista_retirada = '$motorista', status ='Retirar', confirm_troca=1, last_alter_User='$usuario' WHERE num_pedido = '$n_pedido'");

    $incluircadastro1->execute();

    echo "<script>alert('Retirada programada');</script>";

    echo "<script>location.href = 'form_rt.php';</script>";
  } elseif ($acao === 'Troca') {



    if ($status === 'Entregar') {

      echo "<script>alert('Ainda nao tem O.S entregue para este cliente');</script>";

      echo "<script>history.go(-1)</script>";
    } elseif ($nome == "" || $nome == null) {

      echo "<script>alert('informar o cliente');</script>";

      echo "<script>history.go(-1)</script>";
    } else {

      $np = $rowss + '1';

      $incluircadastro1 = $conexao->prepare("UPDATE base_os SET motorista = '$motorista',Motorista_retirada = '$motorista',troca = '$np',data_retirada = '$d_entrega', status ='Retirar', confirm_troca=1, last_alter_User='$usuario', acao='troca programada (r)'  WHERE num_pedido = '$n_pedido'");

      $incluircadastro1->execute();

      for ($i = $rowss + '1'; $i <= $np; $i++) {

        $incluircadastro = $conexao->prepare("INSERT INTO base_os(aterro,cacamba,periodo,Motorista_retirada,identificacao_pagamento,troca,tipo_nota,data_vencimento,nome_cliente,codigo_cliente,num_pedido,tipo_os,Endereco,numero,complemento,bairro,cidade,cep,data_entrega,valor,obs,Motorista_entrega,motorista,data_retirada,status,status_pagamento,for_pag,confirm_troca,tipo_cacamba,tipo_servico,Usuario,acao)

            VALUES

            ('EM_OBRA','$xx','$periodo','$xx','$xx','$n_pedido','$rtn','$pc','$nome','$codigo','$i','Troca','$endereco','$Numero','$complemento','$bairro','$municipio','$ceps','$d_entrega','$valor','$comentario','$motorista','$motorista','$ultimoDia','Entregar','NÃO','$for_pag', 1,'$tipo_c ','$tipo_se','$usuario', 'troca - nova colocacao criada ')");

        $incluircadastro->execute();

        echo "<script>

            location.href = 'form_rt.php';

            </script>";
      }
    }
  } elseif ($acao == 'Editar tipo_se') {


    if ($status != "Entregar") {

      echo "<script>alert('o tipo Serviço só pode ser alterada antes da Entrega');</script>";

      echo "<script>history.go(-1)</script>";
    } else {

      $np = $rowss + '1';

      $incluircadastro1 = $conexao->prepare("UPDATE base_os SET tipo_servico = '$tipo_se', last_alter_User='$usuario', acao='edit tipo_servico'  WHERE num_pedido = '$n_pedido'");

      $incluircadastro1->execute();

      echo "<script>location.href = 'form_rt.php';</script>";
    }
  } elseif ($acao == 'Editar periodo') {


    if ($status != "Entregar") {

      echo "<script>alert('o tipo Serviço só pode ser alterada antes da Entrega');</script>";

      echo "<script>history.go(-1)</script>";
    } else {

      $np = $rowss + '1';

      $incluircadastro1 = $conexao->prepare("UPDATE base_os SET periodo = '$periodo', last_alter_User='$usuario', acao='edit periodo'  WHERE num_pedido = '$n_pedido'");

      $incluircadastro1->execute();

      echo "<script>location.href = 'form_rt.php';</script>";
    }
  } else {

    //

    // echo "<script>alert('Cadastro sendo realizado');</script>"; 





    $np = $rowss + $qc;

    $i = $rowss + '1';

    $incluircadastro = "INSERT INTO base_os(aterro,cacamba,periodo,Motorista_retirada,troca,identificacao_pagamento,tipo_nota,data_vencimento,nome_cliente,codigo_cliente,num_pedido,tipo_os,Endereco,numero,complemento,bairro,cidade,cep,data_entrega,valor,obs,motorista,Motorista_entrega,data_retirada,status,status_pagamento,for_pag,confirm_troca,tipo_cacamba,Usuario,tipo_servico,acao)
              VALUES
              ('EM_OBRA','$xx','$periodo','$xx','$xx','$xx','$rtn','$pc','$nome','$codigo','$i','Colocacao','$endereco','$Numero','$complemento','$bairro','$municipio','$ceps','$d_entrega','$valor','$comentario','$motorista','$motorista','$ultimoDia','Entregar','NÃO','$for_pag',0,'$tipo_c','$usuario','$tipo_se','colocacao criada (Incluir ped)')";


    $resultado = @mysqli_query($conexao, $incluircadastro);
    if (!$resultado) {
      echo "<script>alert('Erro no cadastro');</script>";
      die('Query Inválida:' . @mysqli_error($conexao));
    } else {
      echo "<script> alert('Cadastro realizado com sucesso');</script>";
      echo "<script>history.go(-1)</script>";
    }
  }
} catch (PDOException $e) {

  echo "erro: " . $e->getMessage();
}
