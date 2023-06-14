<?php 
$var = 10;
function somar(){
    $var = 5;
    echo "valor de dentro".$var;

}
somar();
echo "<br>";
echo "valor de fora".$var;
?>