<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "globalConexus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

//Consulto todo los campos de una tabla 
$consulta1= "SELECT id, nombre, apellido, correo FROM prueba";
$result1 = $conn->query($consulta1);

//Consulto todo los clientes y los pagos realizado en el año 2017
$consulta2 = "SELECT c.id,c.name,sum(p.monto) as total FROM cliente c, pago p WHERE c.id = p.cliente_id  GROUP BY cliente_id";
$result2 = $conn->query($consulta2);

//Cuento la cantidad de estudiantes que tenga el nombre juan
$consulta3 = "SELECT count(nombre) as total FROM estudiante WHERE nombre = 'Juan'";
$result3 = $conn->query($consulta3);

$conn->close();

?>