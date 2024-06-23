<?php

$config = require_once '../config.php';
include_once('../controllers/conexao.php');




if (isset($_SESSION['user_name'])) {
  $user = $_SESSION['user_name'];
  $select_user = mysqli_query($conexao, "SELECT * from users where user_name='$user'");
  $dadosU = mysqli_fetch_array($select_user);
} else{
 $user = 0;
}

if (isset($_POST['codP'])) {
  $codP = $_POST['codP'];
  $select_produto = mysqli_query($conexao, "SELECT * from produtos where codP = $codP");
  $dadosP = mysqli_fetch_array($select_produto);

  $imagens = mysqli_query($conexao, "SELECT * FROM imagens WHERE codP = $codP");
  $dadosImg = mysqli_fetch_array($imagens);
} else {
  echo "erro no cproduto";
  die;
}

echo $nome_p = trim($_POST['nome_p']);
echo "<br>";
echo $n_pedido = trim($_POST['n_pedido']);
echo "<br>";
echo $email = trim($_POST['email']);
echo "<br>";
echo $nome_c = trim($_POST['nome_c']);
echo "<br>";
echo $tel = trim($_POST['tel']);
echo "<br>";
echo $cpf = trim(preg_replace("/[^0-9]/", "", $_POST['cpf']));
echo "<br>";
echo $CEP = trim(preg_replace("/[^0-9]/", "", $_POST['CEP']));
echo "<br>";
echo $ende = trim($_POST['ende']);
echo "<br>";





$accesstoken = $config['accesstoken'];
$notification_url = $config['notification'];
echo $amount = (float)trim(str_replace(',', '.', $dadosP['preco']));

echo "<br>";
echo "<br>";
echo $config['notification'];
echo "<br>";

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;

require_once 'lib/vendor/autoload.php';

MercadoPagoConfig::setAccessToken($config['accesstoken']);
$client = new PreferenceClient();

$createRequest = [
  "external_reference" => "'".$_POST['n_pedido']."'",
  "notification_url" => "' ". $config['notification'] . "'",
  "items" => array(
      array(
        "id" => "4567",
        "title" => "roupa JD Teste",
        "description" => "desc roupa",
        "picture_url" => "https://WWW.minhaimagemcom/imagem.jpg",
        "category_id" => "camiseta algodao",
        "currency_id" => "BRL",
        "unit_price" => $amount
      )
  ),
  "default_payment_method_id" => "master",
  "excluded_payment_types" => array(
      array(
        "id" => "ticket"
      )
   ) ,

   
];

$preference = $client->create($createRequest);

// parcelas predefinidas:
// "installments" => 12,
// "default_instalments" => 1


if (isset($preference->id)) {
  if ($preference->id != NULL) {


    if(isset($card)){
      $preference_id = $preference->id;
    }else {      
      $link_externo = $preference->init_point;
      $id_pag = $preference->id;
      $reference = $preference->external_reference;
      $noticao = $preference->notification_url;
      echo "<a href='{$link_externo}' target='_blank'> Link externo </a> ";
      echo "<br>";
      echo "<br>";
      echo "id: " . $id_pag;
      echo "<br>";
      echo "noticação_url: " . $noticao;
      echo "<br>";
      echo "external-ref: " . $reference;
    }
  }
}


mysqli_close($conexao);





// $insert = "insert into pedidos(n_pedido, nome_c, tel_c, cpf_c, ende_c, codP, email, status, etapa, cep, valor_p, user_name)
// values('$n_pedido', '$nome_c', '$tel', '$cpf', '$ende', '$codP', '$email', 'pendente', 'Esperando Pagamento', $CEP, $amount, '$user')";
  
// $resultado = @mysqli_query($conexao, $insert);


// if (!$resultado) {
//     die('Query Inválida:' . @mysqli_error($conexao));
// } 


?>
