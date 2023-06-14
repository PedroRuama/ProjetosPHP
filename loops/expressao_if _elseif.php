<?php
    $hora = 15;
    if($hora <= 12){
        echo 'Bom dia';
    }
    elseif($hora > 6 and $hora <= 12){
        echo "Boa tarde";
    }
    elseif($hora > 18 and $hora <= 24){
        echo "Boa Noite";
    }
    else{
        echo 'Bom sonhos...';
    }
?>