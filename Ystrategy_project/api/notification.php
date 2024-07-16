<?php 

include_once('../controllers/conexao.php');
$config = require_once '../config.php';

$up = "UPDATE users SET verificacao=1 where user_name = 'ruama'";
$resultado = @mysqli_query($conexao, $up);

if (!$resultado) {
    mysqli_query($conexao, "UPDATE users SET verificacao=61 where user_name = 'ruama'");
    die('Query Inválida:' . @mysqli_error($conexao));
} 


$accesstoken = $config['accesstoken'];
$notification_url = $config['notification'];


$body = json_decode(file_get_contents('php://input'));

if(isset($body->data->id)){

    mysqli_query($conexao, "UPDATE users SET verificacao=2 where user_name = 'ruama'");

    $id = $body->data->id;

    $curl = curl_init();

   curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/'.$id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '. $accesstoken
    ),
));

    $response = curl_exec($curl);
    curl_close($curl);
    $payment = json_decode($response);
    
    $reference = $payment->external_reference;
    $status = $payment->status;

    $Verificacao = mysqli_query($conexao, "SELECT n_pedido from pedidos where n_pedido = '$reference'");
    $num_rows = mysqli_num_rows($Verificacao);

    if($num_rows > 0){
        mysqli_query($conexao, "UPDATE users SET verificacao=3 where user_name = 'ruama'");

        $setStatus = "UPDATE pedidos SET status='$status' where n_pedido = '$reference'";
        $resultado = @mysqli_query($conexao, $setStatus);

        if (!$resultado) {
            mysqli_query($conexao, "UPDATE users SET verificacao=64 where user_name = 'ruama'");
            die('Query Inválida: setStatus' . @mysqli_error($conexao));
        } 
        
    }else{mysqli_query($conexao, "UPDATE users SET verificacao=63 where user_name = 'ruama'");}



}else{mysqli_query($conexao, "UPDATE users SET verificacao=62 where user_name = 'ruama'");}
echo "acessivel Ok";

mysqli_close($conexao);
?>