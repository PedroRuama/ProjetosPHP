<?php

$config = require_once '../config.php';
include_once('../controllers/conexao.php');

mysqli_query($conexao, "UPDATE users SET verificacao=77 where user_name = 'ruama'");

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

echo $nome_p = $_POST['nome_p'];
echo "<br>";
echo $n_pedido = $_POST['n_pedido'];
echo "<br>";
echo $email = $_POST['email'];
echo "<br>";
echo $nome_c = $_POST['nome_c'];
echo "<br>";
echo $tel = $_POST['tel'];
echo "<br>";
echo $cpf = preg_replace("/[^0-9]/", "", $_POST['cpf']);
echo "<br>";
echo $CEP = preg_replace("/[^0-9]/", "", $_POST['CEP']);
echo "<br>";
echo $ende = $_POST['ende'];
echo "<br>";


$accesstoken = $config['accesstoken'];
$notification_url = $config['notification'];
echo $amount = (float)trim(str_replace(',', '.', $dadosP['preco']));

echo "<br>";
echo "<br>";
echo $config['notification'];
echo "<br>";

$hj = date('Y-m-d');

$insert = "insert into pedidos(n_pedido, nome_c, tel_c, cpf_c, ende_c, codP, email, status, etapa, cep, valor_p, user_name, data_p)
values('$n_pedido', '$nome_c', '$tel', '$cpf', '$ende', '$codP', '$email', 'pendente', 'Esperando Pagamento', $CEP, $amount, '$user', '$hj')";
  
$resultado = @mysqli_query($conexao, $insert);

if (!$resultado) {
    die('Query Inválida:' . @mysqli_error($conexao));
} 

$curl = curl_init();

// "unit_price":  '.$amount.'

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{
  "back_urls": {
    "success": "https://www.google.com/search?client=opera-gx&q=sucesso&sourceid=opera&ie=UTF-8&oe=UTF-8",
    "pending": "https://www.google.com/search?client=opera-gx&q=pendente&sourceid=opera&ie=UTF-8&oe=UTF-8",
    "failure": "https://www.google.com/search?client=opera-gx&q=falhou&sourceid=opera&ie=UTF-8&oe=UTF-8"
  },
 "external_reference": "'.$_POST['n_pedido'].'",
 "notification_url": '.$notification_url.',
 "auto_return": "approved",
  "items": [
    {
      "title": "' . $dadosP['titulo'] . '",
      "description": "Dummy description",
      "picture_url": "e7ad9b1147feba.lhr.life/' . $dadosImg['path'] . '",
      "category_id": "car_electronics",
      "quantity": 1,
      "currency_id": "BRL",
      "unit_price":  1
    }
   
  ],
  "marketplace_fee": null,
  "metadata": null,
  "payer": {
    "phone": {
      "number": null
    },
    "identification": {},
    "address": {
      "street_number": null
    }
  },
  "payment_methods": {
    "excluded_payment_methods": [
    {}
    ],
    "excluded_payment_types": [
        {}
    ]
  }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $accesstoken
  ),
));
// {"id": "visa"}

// {"id": "ticket"}
$response = curl_exec($curl);
curl_close($curl);



$obj = json_decode($response);

if (isset($obj->id)) {
  if ($obj->id != NULL) {

    $link_externo = $obj->init_point;
    $id_pag = $obj->id;
    $reference = $obj->external_reference;
    $noticao = $obj->notification_url;
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


mysqli_close($conexao);


?>