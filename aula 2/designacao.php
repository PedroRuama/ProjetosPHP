<?php
 $texto1 = "Aula";
 $texto2 =& $texto1;
 echo "texto01 => ".$texto1;
 echo "<br>";
 $texto2 = "PHP";
 echo "texto01 =>".$texto1;


?> 