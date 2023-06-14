<?php 
    $var = 0;
    function somar(){
        global $var;
        $var++;
        echo somar()."<br";
        echo somar()."<br";
        echo somar()."<br";
    }

?>