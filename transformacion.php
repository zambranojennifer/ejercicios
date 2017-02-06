<?php


function unidad($numero)
{
	if($numero == 9){

		$num = "Nueve";

	}elseif ($numero == 8) {

		$num = "Ocho";

	}elseif ($numero == 7) {

		$num = "Siete";

	}elseif ($numero == 6 ) {

		$num = "Seis";

	}elseif ($numero == 5) {

		$num = "Cinco";

	}elseif ($numero == 4) {

		$num = "Cuatro";

	}elseif ($numero == 3) {

		$num = "Tres";

	}elseif ($numero == 2) {

		$num = "Dos";

	}elseif ($numero == 1) {

		$num = "Uno";

	}

	return $num;
}

function decena($numero)
{
	if ($numero >= 90 && $numero <= 99)
	{
		$num_letra = "Noventa ";

		if ($numero > 90){
			$num_letra = $num_letra."y ".unidad($numero - 90);
		}
	}else if ($numero >= 80 && $numero <= 89)
	{
		$num_letra = "Ochenta ";

		if ($numero > 80){
			$num_letra = $num_letra."y ".unidad($numero - 80);
		}
	}else if ($numero >= 70 && $numero <= 79)
	{
		$num_letra = "Setenta ";

		if ($numero > 70){
			$num_letra = $num_letra."y ".unidad($numero - 70);
		}

	}else if ($numero >= 60 && $numero <= 69)
	{
		$num_letra = "Sesenta ";

		if ($numero > 60){
			$num_letra = $num_letra."y ".unidad($numero - 60);
		}
	}else if ($numero >= 50 && $numero <= 59)
	{
		$num_letra = "Cincuenta ";

		if ($numero > 50){
			$num_letra = $num_letra."y ".unidad($numero - 50);
		}
	}else if ($numero >= 40 && $numero <= 49)
	{
		$num_letra = "Cuarenta ";

		if ($numero > 40){
			$num_letra = $num_letra."y ".unidad($numero - 40);
		}
	}else if ($numero >= 30 && $numero <= 39)
	{
		$num_letra = "Treinta ";

		if ($numero > 30){
			$num_letra = $num_letra." y ".unidad($numero - 30);
		}
	}else if ($numero >= 20 && $numero <= 29)
	{
		if ($numero == 20){
			$num_letra = "Veinte ";
		}
		else{
			$num_letra = "Veinti ".unidad($numero - 20);
		}
	}else if ($numero >= 10 && $numero <= 19)
	{
		if($numero == 10 ){

			$num_letra = "Diez";
		}elseif ($numero == 11 ) {

			$num_letra = "Once";

		}elseif ($numero == 12 ) {

			$num_letra = "Doce";

		}elseif ($numero ==  13 ) {

			$num_letra = "Trece";

		}elseif ($numero == 14 ) {

			$num_letra = "Catorce";

		}elseif ($numero == 15 ) {

			$num_letra = "Quince";

		}elseif ($numero == 16 ) {

			$num_letra = "Dieciseis";

		}elseif ($numero == 17 ) {

			$num_letra = "Diecisiete";

		}elseif ($numero == 18 ) {

			$num_letra = "Dieciocho";

		}elseif ($numero == 19 ) {

			$num_letra = "Diecinueve ";
		}
	}else
	$num_letra = unidad($numero);

	return $num_letra;
}

function centena($numero)
{
	if ($numero >= 100)
	{
		if ($numero >= 900 & $numero <= 999)
		{
			$num_letra = "Novecientos ";

			if ($numero > 900){
				$num_letra = $num_letra.decena($numero - 900);
			}
		}
		else if ($numero >= 800 && $numero <= 899)
		{
			$num_letra = "Ochocientos ";

			if ($numero > 800){
				$num_letra = $num_letra.decena($numero - 800);
			}
		}
		else if ($numero >= 700 && $numero <= 799)
		{
			$num_letra = "Setecientos ";

			if ($numero > 700){
				$num_letra = $num_letra.decena($numero - 700);
			}
		}
		else if ($numero >= 600 && $numero <= 699)
		{
			$num_letra = "Seiscientos ";

			if ($numero > 600){
				$num_letra = $num_letra.decena($numero - 600);
			}
		}
		else if ($numero >= 500 && $numero <= 599)
		{
			$num_letra = "Quinientos ";

			if ($numero > 500){
				$num_letra = $num_letra.decena($numero - 500);
			}
		}
		else if ($numero >= 400 && $numero <= 499)
		{
			$num_letra = "Cuatrocientos ";

			if ($numero > 400){
				$num_letra = $num_letra.decena($numero - 400);
			}
		}
		else if ($numero >= 300 && $numero <= 399)
		{
			$num_letra = "Trescientos ";

			if ($numero > 300){
				$num_letra = $num_letra.decena($numero - 300);
			}
		}
		else if ($numero >= 200 && $numero <= 299)
		{
			$num_letra = "Doscientos ";

			if ($numero > 200){
				$num_letra = $num_letra.decena($numero - 200);
			}
		}
		else if ($numero >= 100 && $numero <= 199)
		{
			if ($numero == 100){
				$num_letra = "Cien ";
			}
			else{
				$num_letra = "Ciento ".decena($numero - 100);
			}
		}
	}
	else
		$num_letra = decena($numero);

	return $num_letra;
}

function cien()
{
	global $importe_parcial;

	$parcial = 0; $car = 0;

	while (substr($importe_parcial, 0, 1) == 0){

		$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	}
	if ($importe_parcial >= 1 && $importe_parcial <= 9.99){
		$car = 1;
	}
	else if ($importe_parcial >= 10 && $importe_parcial <= 99.99){
		$car = 2;
	}
	else if ($importe_parcial >= 100 && $importe_parcial <= 999.99){
		$car = 3;
	}

	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);

	$num_letra = centena($parcial);


	return $num_letra;
}


function convertir_a_letras($numero)
{
	global $importe_parcial;

	$importe_parcial = $numero;

	if ($numero < 999.99)
	{
		if ($numero >= 1 && $numero <= 999.99){

			$num_letras = cien();
		}
		else if ($numero >= 0.01 && $numero <= 0.99)
		{
			if ($numero == 0.01)
				$num_letras = "Un Céntimo";
			else
				$num_letras = convertir_a_letras(($numero * 100)."/100")." céntimos";
		}
		echo "<h2>Usted ingreso el numero : ".$num_letras."</h2>";
	}else{
		echo "<h2>Ingrese un numero del 0 hasta el 999 </h2>";
	}
}

convertir_a_letras($_POST["num"]);

?>