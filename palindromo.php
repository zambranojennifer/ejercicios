<?php

function palindromo($palabra){

  if ($palabra) {

    if (strlen($palabra)%2 == 0) {

      $tam = strlen($palabra)/2;

    }else{

      $tam = (strlen($palabra)-1)/2;

    }

    for ($i = 0; $i<$tam; $i = $i +1 ){

      if ($palabra[i] != $palabra[($tam*2)-i]){

        $palindromo = "False";
      } else {

        $palindromo = "True";
      }
    }

    echo "<h2>Es palindromo: ".$palindromo."</h2>";
    return 0;

  }else{
    echo "<h1>Debe enviar una palabra...!!</h1>";
  }

}

palindromo($_POST["palabra"]);
?>