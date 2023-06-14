<?php
  function retangulo($h, $a){
    $P = 2*($h+$a);
    return $P;
  }
  function quadrado($a){
    $P = 4*$a;
    return $P;
  }
  function paralelogramo($b, $a){
    $P = 2*($a+$b);
    return $P;
  }
  function trapezio($a, $b, $c, $d){
    $P = $a + $b + $c + $d;
    return $P;
  }

  function retorno(){
    echo "Perimetro retangulo: ", retangulo(2, 5);
    echo "<br>";
    echo "Perimetro quadrado: ", quadrado(3);
    echo "<br>";
    echo "Perimetro paralelogramo: ", paralelogramo(6, 3);
    echo "<br>";
    echo "Perimetro trapezio: ", trapezio(3, 4, 3, 2);
  }


  function desafio(){
    for($i=4; $i>=0; $i--){
      
      switch ($i){
        case 4:
          $P = 2*(2+5);
          echo "Perimetro retangulo: ", $P;
          break;
        case 3:
          $P = 4*3;
          echo "Perimetro quadrado: ", $P;
          break;
        case 2:
          $P = 2*(6+3);
          echo "Perimetro parelogralo: ", $P;
          break;
        case 1: 
          $P = 3 + 4 + 4 + 2;
          echo "Perimetro trapezio: ", $P;
          break;
       

      }
      echo "<br>";


    }
  };
