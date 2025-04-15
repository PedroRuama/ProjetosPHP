<?php
    $config = require_once '../config.php';
    include_once('../controllers/conexao.php');

        
    if (isset($_GET['codP'])) {
        $codP = $_GET['codP'];
        $select_produto = mysqli_query($conexao, "SELECT * from produtos where codP = $codP");
        $dadosP = mysqli_fetch_array($select_produto);

        $imagens = mysqli_query($conexao, "SELECT * FROM imagens WHERE codP = $codP");
    }



    $accesstoken = $config['accesstoken'];
    echo $amount = (float)trim(str_replace(',', '.', $dadosP['preco']));

        
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.mercadopago.com/v1/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
    "description": "Payment for product",
    "external_reference": "MP0001",
    "notification_url": "https://google.com",
    "payer": {
        "email": "test_user_123@testuser.com",
        "identification": {
        "type": "CPF",
        "number": "95749019047"
        }
    },
    "payment_method_id": "pix",
    "transaction_amount": 1
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        // 'X-Idempotency-Key: 0d5020ed-1af6-469c-ae06-c3bec19954bb',
        'Authorization: Bearer ' . $accesstoken
    ),
    ));
    // '.$amount.'
    $response = curl_exec($curl);

    curl_close($curl);
    

    $obj = json_decode($response);

    if (isset($obj->id)) {
        if($obj->id != NULL){
            $copia_cola = $obj->point_of_interaction->transaction_data->qr_code;
            $img_qrcode = $obj->point_of_interaction->transaction_data->qr_code_base64;
            $link_externo = $obj->point_of_interaction->transaction_data->ticket_url;
            $transaction_amount = $obj->transaction_amount;

            echo "<h3>val : {$transaction_amount}</h3> <br>";
            echo "<img src='data:image/png;base64, {$img_qrcode}' width='200'/>  <br />";
            echo "<textarea>{$copia_cola}</textarea> <br />";
            echo "<a href='{$link_externo}' target='_blank'> Link externo </a> " ;
        }
    }


?>