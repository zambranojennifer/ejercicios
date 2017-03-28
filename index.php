<?php

$conn = new mysqli("localhost", "root", "root", "pruebas");

/* verificar la conexión */
if ($conn->connect_errno) {
    printf("Conexión fallida: %s\n", $conn->connect_error);
    exit();
}


$xml=simplexml_load_file("Gate-In-Export-Full_I.XML");

//print_r($xml);

echo "<table>";

foreach ($xml as $datos) {

	/**** Bloque del Header ****/

	    $MessageType = $datos[0]->MessageType;
	    $DocumentIdentifier = $datos[0]->DocumentIdentifier;
    	$DateTime = $datos[0]->DateTime;
    	$PartnerIdentifier1 = $datos[0]->Parties->PartnerInformation[0]->PartnerIdentifier;
		$PartnerIdentifier2 = $datos[0]->Parties->PartnerInformation[1]->PartnerIdentifier;
	/**** Fin del Header ****/

	foreach ($xml as $datos) {



    /**** Bloque de MessageBody ****/
    	$EventCode = $datos[1]->MessageProperties->EventCode;
	    $LocationCode = $datos[1]->MessageProperties->EventLocation->Location->LocationCode;
	    $LocationCountry = $datos[1]->MessageProperties->EventLocation->Location->LocationCountry;

	    $DateTime = $datos[1]->MessageProperties->EventLocation->Location->DateTime;
	    $ReferenceInformation1 = $datos[1]->MessageProperties->ReferenceInformation[0];
	    $ReferenceInformation2 = $datos[1]->MessageProperties->ReferenceInformation[0];
	    $ShipmentComments = $datos[1]->MessageProperties->Instructions->ShipmentComments;


	    $ConveyanceName = $datos[1]->MessageProperties->TransportationDetails->ConveyanceInformation->ConveyanceName;
	    $VoyageTripNumber = $datos[1]->MessageProperties->TransportationDetails->ConveyanceInformation->VoyageTripNumber;
	    $CarrierSCAC = $datos[1]->MessageProperties->TransportationDetails->ConveyanceInformation->CarrierSCAC;
	    $TransportIdentification = $datos[1]->MessageProperties->TransportationDetails->ConveyanceInformation->TransportIdentification;
    

	    /***** Bloque de TransportationDetails->Location  ****/
		    $LocationCode = $datos[1]->MessageProperties->TransportationDetails->Location->LocationCode;
			$LocationName = $datos[1]->MessageProperties->TransportationDetails->Location->LocationName;
			$LocationCountry = $datos[1]->MessageProperties->TransportationDetails->Location->LocationCountry;
			$DateTime = $datos[1]->MessageProperties->TransportationDetails->Location->DateTime;

			$LocationCode1 = $datos[1]->MessageProperties->TransportationDetails->Location[1]->LocationCode;
			$LocationName1 = $datos[1]->MessageProperties->TransportationDetails->Location[1]->LocationName;
			$LocationCountry1 = $datos[1]->MessageProperties->TransportationDetails->Location[1]->LocationCountry;
			$DateTime1 = $datos[1]->MessageProperties->TransportationDetails->Location[1]->DateTime;

			$LocationCode2 = $datos[1]->MessageProperties->TransportationDetails->Location[2]->LocationCode;
			$LocationName2 = $datos[1]->MessageProperties->TransportationDetails->Location[2]->LocationName;
			$LocationCountry2 = $datos[1]->MessageProperties->TransportationDetails->Location[2]->LocationCountry;
			$DateTime2 = $datos[1]->MessageProperties->TransportationDetails->Location[2]->DateTime;

			$LocationCode3 = $datos[1]->MessageProperties->TransportationDetails->Location[3]->LocationCode;
			$LocationName3 = $datos[1]->MessageProperties->TransportationDetails->Location[3]->LocationName;
			$LocationCountry3 = $datos[1]->MessageProperties->TransportationDetails->Location[3]->LocationCountry;
			$DateTime3 = $datos[1]->MessageProperties->TransportationDetails->Location[3]->DateTime;

			$LocationCode4 = $datos[1]->MessageProperties->TransportationDetails->Location[4]->LocationCode;
			$LocationName4 = $datos[1]->MessageProperties->TransportationDetails->Location[4]->LocationName;
			$LocationCountry4 = $datos[1]->MessageProperties->TransportationDetails->Location[4]->LocationCountry;
			$DateTime4 = $datos[1]->MessageProperties->TransportationDetails->Location[4]->DateTime;

		/**** Fin del Bloque TransportationDetails->Location ****/

		$PartnerIdentifier = $datos[1]->MessageProperties->Parties->PartnerInformation->PartnerIdentifier;
		$LineNumber = $datos[1]->MessageDetails->EquipmentDetails->LineNumber;
		$EquipmentIdentifier = $datos[1]->MessageDetails->EquipmentDetails->EquipmentIdentifier;
		$EquipmentTypeCode = $datos[1]->MessageDetails->EquipmentDetails->EquipmentType->EquipmentTypeCode;
	/**** fin del MessageBody ****/
	     

	}
   
   /**** Consulto para ver si ya el container fue guardado antes de repetirlo ****/
$consult = "SELECT e.DocumentIdentifier,c.Identifier FROM evento as e , container as c where e.DocumentIdentifier = '$DocumentIdentifier'";
$consulta = $conn->query($consult);


	if ($consulta->num_rows == 0) {

		/**** Datos a insertar en la tabla event ****/
		$insertEvent = "INSERT INTO `evento`(`EventCode`, `locationCode`, `locationName`, `locationCounty`, `dateTime`, `booking`, `idBL`, `instructions`,`DocumentIdentifier`) VALUES('$EventCode','$LocationCode','$LocationName','$LocationCountry','$DateTime', '$ReferenceInformation1','$ReferenceInformation2','$ShipmentComments','$DocumentIdentifier')";
		$result = $conn->query($insertEvent);


		/**** datos a insertar en la tabla container ****/
		$insertContainer = "INSERT INTO `container`(`idBL`, `typeMessage`, `Identifier`, `datetime`, `entidadEmisora`, `entidadReceptora`, `contactName`, `telephone`, `ConveyanceName`, `VoyageTripNumber`, `CarrierSCAC`, `TransportIdentification`, `CodeCityPort`, `nameCityPort`, `codeCountryPort`, `salidaEfectivaPort`, `codeCityReceipt`, `nameCityReceipt`, `codeCountyReceipt`, `salidaEstimadaReceipt`, `codeCityLoading`, `nameCityLoading`, `codeCountryLoading`, `salidaEfectivaLoading`, `codeCityDischarge`, `nameCityDischarge`, `codeCountyDischarge`, `llegadaEfectivaDischarge`, `codeCityDelivery`, `nameCityDelivery`, `codeCountyDelivery`, `llegadaEstimadaDelivery`, `partnerIdentifier`, `partnerName`, `equipmentIdentifier`, `equipmentTypeCode`) VALUES ('$ReferenceInformation2','$MessageType','$DocumentIdentifier','$DateTime','$PartnerIdentifier1','$PartnerIdentifier2','value-8','value-9','$ConveyanceName','$VoyageTripNumber','$CarrierSCAC','$TransportIdentification','$LocationCode','$LocationName','$LocationCountry','$DateTime','$LocationCode1','$LocationName1','$LocationCountry1','$DateTime1','$LocationCode2','$LocationName2','$LocationCountry2','$DateTime2','$LocationCode3','$LocationName3','$LocationCountry3','$DateTime3','$LocationCode4','$LocationName4','$LocationCountry4','$DateTime4','$PartnerIdentifier','$LineNumber','$EquipmentIdentifier','$EquipmentTypeCode')";
		$result = $conn->query($insertContainer);


		$resultado = "Se agrego este Xml en la base de dato";

	}else{

		$resultado = "Ya este Xml Fue insertado en la Base de dato";
	}



	echo "<!DOCTYPE html>
				<html>
				<head>
				<title>INFORMACION XML</title>
				</head>
					<body>
						<table border='1'>
						    <th colspan= 4>Event Number Identifier: ".$DocumentIdentifier."</th>
						    <tr>
							<th>EventCode</th>
					    	<th>LocationCode</th> 
					    	<th>LocationName</th>
					    	<th>LocationCountry</th>
					    	</tr>
					    	<tr>
					    		<td>".$EventCode."</td>
					    		<td>".$LocationCode."</td> 
					    		<td>".$LocationName."</td> 
					    		<td>".$LocationCountry."</td>
					    	</tr>
					    	<th>DateTime</th>
					    	<th>booking</th>
					    	<th>IdBl</th>
					    	<th>Instructions</th>
					    	<tr>
					    		<td>".$DateTime."</td>
					    		<td>".$ReferenceInformation1."</td>
					    		<td>" .$ReferenceInformation2."</td>
					    		<td>".$ShipmentComments."</td>
					    	</tr>
						</table>
						</br>
						<table border='1'>
							<tr><th colspan=4>Table Container</th></tr>
							<th>IdBl</th>
							<th>MessageType</th>
					    	<th>DocumentIdentifier</th> 
					    	<th>DateTime</th>
							<tr>
								<td>".$EventCode."</td>
								<td>".$MessageType."</td>
					    		<td>".$DocumentIdentifier."</td> 
					    		<td>".$DateTime."</td>
					    	</tr>
					    	<th>Entidadd Emisora</th>
					    	<th>Entidad Receptora</th>
					    	<th>ContactName</th>
					    	<th>telephone</th>
					    	<tr>
					    		<td>".$PartnerIdentifier1."</td>
					    		<td>".$PartnerIdentifier2."</td>
					    		<td>no tengo nombre de contacto</td>
					    		<td>No tengo en telephone</td>
					    	</tr>
					    	<th>ConveyanceName</th>
					    	<th>VoyageTripNumber</th>
					    	<th>CarrierSCAC</th>
					    	<th>TransportIdentification</th>
					    	<tr>
					    		<td>".$ConveyanceName."</td>
					    		<td>".$VoyageTripNumber."</td>
					    		<td>".$CarrierSCAC."</td>
					    		<td>".$TransportIdentification."</td>
					    	</tr>
					    	<th>CodePort</th>
					    	<th>NamePort</th>
					    	<th>CountryPort</th>
					    	<th>DateTimePort</th>
					    	<tr>
					    		<td>".$LocationCode."</td>
					    		<td>".$LocationName."</td>
					    		<td>".$LocationCountry."</td>
					    		<td>".$DateTime."</td>
					    	</tr>
					    	<th>CodeReceipt</th>
					    	<th>NameReceipt</th>
					    	<th>CountryReceipt</th>
					    	<th>DateTimeReceipt</th>
					    	<tr>
					    		<td>".$LocationCode1."</td>
					    		<td>".$LocationName1."</td>
					    		<td>".$LocationCountry1."</td>
					    		<td>".$DateTime1."</td>
					    	</tr>
					    	<th>CodeLoading</th>
					    	<th>NameLoading</th>
					    	<th>CountryLoading</th>
					    	<th>DateTimeLoading</th>
					    	<tr>
					    		<td>".$LocationCode2."</td>
					    		<td>".$LocationName2."</td>
					    		<td>".$LocationCountry2."</td>
					    		<td>".$DateTime2."</td>
					    	</tr>
					    	<th>CodeDischarge</th>
					    	<th>NameDischarge</th>
					    	<th>CountryDischarge</th>
					    	<th>DateTimeDischarge</th>
					    	<tr>
					    		<td>".$LocationCode3."</td>
					    		<td>".$LocationName3."</td>
					    		<td>".$LocationCountry3."</td>
					    		<td>".$DateTime3."</td>
					    	</tr>
					    	<th>CodeDelivery</th>
					    	<th>NameDelivery</th>
					    	<th>CountryDelivery</th>
					    	<th>DateTimeDelivery</th>
					    	<tr>
					    		<td>".$LocationCode4."</td>
					    		<td>".$LocationName4."</td>
					    		<td>".$LocationCountry4."</td>
					    		<td>".$DateTime4."</td>
					    	</tr>
					    	<th>Codigo Armador</th>
					    	<th>Nombre Armador</th>
					    	<th>Estado del Contenedor y la Serie</th>
					    	<th>Tipo de Contenedor </th>
					    	<tr>
					    		<td>".$PartnerIdentifier."</td>
					    		<td>".$LineNumber."</td>
					    		<td>".$EquipmentIdentifier."</td>
					    		<td>".$EquipmentTypeCode."</td>
					    	</tr>
						</table>
						</br>
						<h4>".$resultado."</h4>
					</body>
				</html>";
	
}

echo "</table>";

/* cerrar la conexión */
$conn->close();

?>