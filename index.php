<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('Net/SFTP.php');

$sftp = new Net_SFTP('nombre del servidor');

$sftp_url = "ruta del servidor";

$url_local = "ruta del local donde se guardara";
 listar_archivo_local($url_local);
if (!$sftp->login('usuario del servidor', 'password del servidor')) {
	exit('Login Failed');
}

//listo todo los archivos que esta en la carpeta xml en el servidor 
$archivoXml =$sftp->nlist($sftp_url);

foreach ($archivoXml as $xml) {

	/*Me descargo el archivo del servidor y lo guardo en una carpeta en el servidor local*/
	$sftp->get($sftp_url."/".$xml, $url_local."/".$xml);
}

function listar_archivo_local($carpeta){
    if(is_dir($carpeta)){
        if($dir = opendir($carpeta)){
            while(($archivo = readdir($dir)) !== false){
                if($archivo != '.DS_Store' && $archivo != 'vgm' && $archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){

                	$conn = new mysqli("servidor local", "usuario", "password", "bd");

					/* verificar la conexión */
					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();
					}

					$readXml=simplexml_load_file('xml/'.$archivo);

					foreach ($readXml as $datos) {
					    echo "MessageType => ".$MessageType = $datos->MessageType;
						echo "DocumentIdentifier => ".$DocumentIdentifier = $datos->DocumentIdentifier;
						echo "DateTime => ".$DateTime = $datos->DateTime;
						echo "EventCode => ".$EventCode = $datos->MessageProperties->EventCode;
						
						echo "ReferenceInformation1 => ".$ReferenceInformation1 = $datos->MessageProperties->ReferenceInformation[0];
						echo "ReferenceInformation2 => ".$ReferenceInformation2 = $datos->MessageProperties->ReferenceInformation[0];		

						if ($datos->MessageProperties->Instructions) {

						 	echo "ShipmentComments => ".$ShipmentComments = $datos->MessageProperties->Instructions->ShipmentComments;
						 }else{
						 	echo "ShipmentComments => ".$ShipmentComments = "";
						 }

						 foreach ($readXml->MessageBody->MessageProperties->TransportationDetails->Location as $datosTransportation) {

							    switch((string) $datosTransportation['LocationType']) { // Obtener los atributos como índices del elemento
							    
								    case 'IntermediatePort':
								        echo "LocationCode => ".$LocationCode = $datosTransportation->LocationCode;
								        echo "LocationName => ".$LocationName = $datosTransportation->LocationName;
								        echo "LocationCountry => ".$LocationCountry = $datosTransportation->LocationCountry;
								        echo "DateTime => ".$DateTime = $datosTransportation->DateTime;
								        break;

								    case 'PlaceOfReceipt':
								        echo "LocationCode1 => ".$LocationCode1 = $datosTransportation->LocationCode;
								        echo "LocationName1 => ".$LocationName1 = $datosTransportation->LocationName;
								        echo "LocationCountry1 => ".$LocationCountry1 = $datosTransportation->LocationCountry;
								        echo "DateTime1 => ".$DateTime1 = $datosTransportation->DateTime;
								        break;
								    case 'PortOfLoading':
								        echo "LocationCode2 => ".$LocationCode2 = $datosTransportation->LocationCode;
								        echo "LocationName2 => ".$LocationName2 = $datosTransportation->LocationName;
								        echo "LocationCountry2 => ".$LocationCountry2 = $datosTransportation->LocationCountry;
								        echo "DateTime2 => ".$DateTime2 = $datosTransportation->DateTime;
								        break;
								    case 'PortOfDischarge':
							        echo "LocationCode3 => ".$LocationCode3 = $datosTransportation->LocationCode;
							        echo "LocationName3 => ".$LocationName3 = $datosTransportation->LocationName;
							        echo "LocationCountry3 => ".$LocationCountry3 = $datosTransportation->LocationCountry;
							        echo "DateTime3 => ".$DateTime3 = $datosTransportation->DateTime;
							        break;

							     case 'PlaceOfDelivery':
							        echo "LocationCode4 => ".$LocationCode4 = $datosTransportation->LocationCode;
							        echo "LocationName4 => ".$LocationName4 = $datosTransportation->LocationName;
							        echo "LocationCountry4 => ".$LocationCountry4 = $datosTransportation->LocationCountry;
							        echo "DateTime4 => ".$DateTime4 = $datosTransportation->DateTime;
							        break;

							    }
						}


						foreach ($readXml->Header->Parties as $datosPartner) {
							echo "PartnerIdentifier1 => ".$PartnerIdentifier1 = $datosPartner->PartnerInformation[0]->PartnerIdentifier;
							echo "PartnerIdentifier2 => ".$PartnerIdentifier2 = $datosPartner->PartnerInformation[1]->PartnerIdentifier;
						}
							
						foreach ($readXml->MessageBody as $datosMessageBody) {

							echo "PartnerIdentifier => ".$PartnerIdentifier = $datosMessageBody->MessageProperties->Parties->PartnerInformation->PartnerIdentifier;
							echo "LineNumber => ".$LineNumber = $datosMessageBody->MessageDetails->EquipmentDetails->LineNumber;
							echo "EquipmentIdentifier => ".$EquipmentIdentifier = $datosMessageBody->MessageDetails->EquipmentDetails->EquipmentIdentifier;
							echo "EquipmentTypeCode => ".$EquipmentTypeCode = $datosMessageBody->MessageDetails->EquipmentDetails->EquipmentType->EquipmentTypeCode;
							echo "LocationCode => ".$LocationCode = $datosMessageBody->MessageProperties->EventLocation->Location->LocationCode;
							echo "LocationCountry => ".$LocationCountry = $datosMessageBody->MessageProperties->EventLocation->Location->LocationCountry;
							echo "DateTime => ".$DateTime = $datosMessageBody->MessageProperties->EventLocation->Location->DateTime;
							echo "ConveyanceName => ".$ConveyanceName = $datosMessageBody->MessageProperties->TransportationDetails->ConveyanceInformation->ConveyanceName;
							echo "VoyageTripNumber => ".$VoyageTripNumber = $datosMessageBody->MessageProperties->TransportationDetails->ConveyanceInformation->VoyageTripNumber;
							echo "CarrierSCAC => ".$CarrierSCAC = $datosMessageBody->MessageProperties->TransportationDetails->ConveyanceInformation->CarrierSCAC;
							echo "TransportIdentification => ".$TransportIdentification = $datosMessageBody->MessageProperties->TransportationDetails->ConveyanceInformation->TransportIdentification;	
						}

						/**** Consulto para ver si ya el container fue guardado antes de repetirlo ****/
						if ($DocumentIdentifier) {

							$consult = "SELECT e.DocumentIdentifier,c.Identifier FROM evento as e , container as c where e.DocumentIdentifier = c.Identifier and e.DocumentIdentifier = '$DocumentIdentifier'";
						 	$consulta = $conn->query($consult);
						 	if ($consulta->num_rows == 0) {

								/**** Datos a insertar en la tabla event ****/
								$insertEvent = "INSERT INTO `evento`(`EventCode`, `locationCode`, `locationName`, `locationCounty`, `dateTime`, `booking`, `idBL`, `instructions`,`DocumentIdentifier`) VALUES('$EventCode','$LocationCode','$LocationName','$LocationCountry','$DateTime', '$ReferenceInformation1','$ReferenceInformation2','$ShipmentComments','$DocumentIdentifier')";
								$result = $conn->query($insertEvent);


								/**** datos a insertar en la tabla container ****/
								$insertContainer = "INSERT INTO `container`(`idBL`, `typeMessage`, `Identifier`, `datetime`, `entidadEmisora`, `entidadReceptora`, `contactName`, `telephone`, `ConveyanceName`, `VoyageTripNumber`, `CarrierSCAC`, `TransportIdentification`, `CodeCityPort`, `nameCityPort`, `codeCountryPort`, `salidaEfectivaPort`, `codeCityReceipt`, `nameCityReceipt`, `codeCountyReceipt`, `salidaEstimadaReceipt`, `codeCityLoading`, `nameCityLoading`, `codeCountryLoading`, `salidaEfectivaLoading`, `codeCityDischarge`, `nameCityDischarge`, `codeCountyDischarge`, `llegadaEfectivaDischarge`, `codeCityDelivery`, `nameCityDelivery`, `codeCountyDelivery`, `llegadaEstimadaDelivery`, `partnerIdentifier`, `partnerName`, `equipmentIdentifier`, `equipmentTypeCode`) VALUES ('$ReferenceInformation2','$MessageType','$DocumentIdentifier','$DateTime','$PartnerIdentifier1','$PartnerIdentifier2','value-8','value-9','$ConveyanceName','$VoyageTripNumber','$CarrierSCAC','$TransportIdentification','$LocationCode','$LocationName','$LocationCountry','$DateTime','$LocationCode1','$LocationName1','$LocationCountry1','$DateTime1','$LocationCode2','$LocationName2','$LocationCountry2','$DateTime2','$LocationCode3','$LocationName3','$LocationCountry3','$DateTime3','$LocationCode4','$LocationName4','$LocationCountry4','$DateTime4','$PartnerIdentifier','$LineNumber','$EquipmentIdentifier','$EquipmentTypeCode')";
								$result = $conn->query($insertContainer);

							}
							
						}
						

					}
					// /* cerrar la conexión */
					$conn->close(); 	 
				}
            }
            closedir($dir);
        }
    }
}


?>
