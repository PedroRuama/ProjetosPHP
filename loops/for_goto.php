<?php
    for($x=1; $x <=10; $x++){
        if($x==5){
            goto mensagem;
        } else{
            echo "$x <br>";
        }
    }
    mensagem:
    echo 'chegou no cinco';
?>