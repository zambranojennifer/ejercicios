<?php
/*
function meclar($arreglo1,$n1,$arreglo2,n2,$arreglo3)
{
  $x1 = 1; $x2 = 1; $x3 = 1;

  while ( $x1 <= $n1 && $x2 <= $n2) {

    if ($arreglo1[$x1] = $arreglo2[$x2]) {

      $arreglo3[$x3] = $arreglo1[$x1];
      $x1 = $x1 +1;

    }else{

      $arreglo3[$x3] = $arreglo2[$x2];
      $x2 = $x2 + 1;
    }
     $x3 = $x3 + 1;
   }
    
    while ($x1 <= $n1) {
      
      $arreglo3[$x3] = $arreglo1[$x1];
      $x1 = $x1 + 1;
      $x3 = $x3 + 1;
    }

    while ($x2 <= $n2) {
      $arreglo3[$x3] = $arreglo1[$x2];
      $x2 = $x2 + 1;
      $x3 = $x3 + 1;
    }
  
}*/

function mezcla($Vector,$n)
{
  $n1 = 0; $n2 = 0; $x = 1; $t = 1;

  if ($n > 1) {
    if (($n % 2) == 0) {
      $n1 = round($n / 2);
    }else{
      $n1 = round($n / 2);
      $n2 = $n1+1;
    }
    $vector1[$n1];
    $vector2[$n2];

    for ($x = 1; $x < $n1 ; $x++) { 
      //$vector1[$x] = $vector3[$x];
      var_dump("vector1 :".$vector3[$x]);
    }
    
    for ($t = 0; $t < $n2; $t++) { 
      
      $vector2[$t] = $vector3[$x];
      $x = $x+1;
    }

   // mezcla($vector1,$n1);
   // mezcla($vector2,$n2);
    //mezclar($vector1,$n1,$vector2,$n2,$vector3);
  }
  
}



function main()
{
  
    $datos=array(1,0,5);

    $Vector=mezcla($datos,sizeof($datos));

    //for($i=0;$i<sizeof($Vector);$i++)

    //    echo $Vector[$i]."<br/>";
}

main();

?>