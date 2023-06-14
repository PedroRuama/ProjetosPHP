<?php
    function acesso(){
        static $contador = 0;
        $contador ++;
        echo $contador;
        echo "<br>";

    }
    echo acesso();
    echo acesso();
    echo acesso();

?>