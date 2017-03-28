<?php

$conn = new mysqli("localhost", "root", "root", "pruebas");

/* verificar la conexión */
if ($conn->connect_errno) {
    printf("Conexión fallida: %s\n", $conn->connect_error);
    exit();
}




//$sql = "INSERT INTO xml (titulo,nombre,actor,argumento,frase) VALUES ('Glenn','Quagmire','33','prueba de insertar','hello')";
//$result = $conn->query($sql);

/*consult = "SELECT  e.id,e.EventCode,e.locationCode,e.locationName,e.locationCounty,e.dateTime,e.booking,e.idBL,e.instructions,e.DocumentIdentifier,c.typeMessage,c.Identifier,c.datetime,c.entidadEmisora,c.entidadReceptora,c.contactName,c.telephone,c.ConveyanceName,c.VoyageTripNumber, c.CarrierSCAC, c.TransportIdentification,c.CodeCityPort, c.nameCityPort, c.codeCountryPort, c.salidaEfectivaPort, c.codeCityReceipt,c.nameCityReceipt,c.codeCountyReceipt,c.salidaEstimadaReceipt,c.codeCityLoading,c.nameCityLoading,c.codeCountryLoading,c.salidaEfectivaLoading,c.codeCityDischarge,c.nameCityDischarge, c.codeCountyDischarge, c.llegadaEfectivaDischarge,c.codeCityDelivery,c.nameCityDelivery,c.codeCountyDelivery,c.llegadaEstimadaDelivery,c.partnerIdentifier,c.partnerName,c.equipmentIdentifier,c.equipmentTypeCode  FROM evento as e , container as c where e.DocumentIdentifier =  c.Identifier";*/
/*
echo "EventCode => ".$EventCode." / ";
echo "LocationCode => ".$LocationCode." / ";
echo "LocationName => ".$LocationName." / ";
echo "LocationCountry => ".$LocationCountry." / ";
echo "DateTime => ".$DateTime." / ";
echo "booking => ".$ReferenceInformation1." / ";
echo "idBL => ".$ReferenceInformation2." / ";
echo "instructions => ".$ShipmentComments." / ";

echo " 1=> ".$ReferenceInformation2." / ";
echo " 2=> ".$MessageType." / ";
echo " 3=> ".$DocumentIdentifier." / ";
echo " 4=> ".$DateTime." / ";
echo " 5=> ".$PartnerIdentifier1." / ";
echo " 6=>   no tengo nombre de contacto";
echo " 7=>   No tengo en telephone`";
echo " 8=> ".$PartnerIdentifier2." / ";
echo " 9=> ".$ConveyanceName." / ";
echo " 10=> ".$VoyageTripNumber." / ";
echo " 11=> ".$CarrierSCAC." / ";
echo " 12=> ".$TransportIdentification." / ";
echo " 13=> ".$LocationCode." / ";
echo " 14=> ".$LocationName." / ";
echo " 15=> ".$LocationCountry." / ";
echo " 16=> ".$DateTime." / ";
echo " 17=> ".$LocationCode1." / ";
echo " 18=> ".$LocationName1." / ";
echo " 19=> ".$LocationCountry1." / ";
echo " 20=> ".$DateTime1." / ";
echo " 21=> ".$LocationCode2." / ";
echo " 22=> ".$LocationName2." / ";
echo " 23=> ".$LocationCountry2." / ";
echo " 24=> ".$DateTime2." / ";
echo " 25=> ".$LocationCode3." / ";
echo " 26=> ".$LocationName3." / ";
echo " 27=> ".$LocationCountry3." / ";
echo " 28=> ".$DateTime3." / ";
echo " 29=> ".$LocationCode4." / ";
echo " 30=> ".$LocationName4." / ";
echo " 31=> ".$LocationCountry4." / ";
echo " 32=> ".$DateTime4." / ";
echo " 33=> ".$PartnerIdentifier." / ";
echo " 34=> ".$LineNumber." / ";
echo " 35=> ".$EquipmentIdentifier." / ";
echo " 36=> ".$EquipmentTypeCode." / ";
*/

/* cerrar la conexión */
$conn->close();
?>