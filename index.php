<?php
include 'config.php';
include 'funciones.php';
?>
<!DOCTYPE html>
<head>
	<title>Empleados</title>
	<!-- Meta -->
	<meta charset="utf-8">
	<!-- Global CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">   
</head> 
<body>
	<h1 align="center">Test de Programaci&oacute;n</h1>
	<center><span><span>GlobalConexus - Enero 2017</span></span></center>
	<hr size="2px" color="black" />
	<div class="tab-content">            
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-10 col-xs-offset-1">
				<table class="table"> 
					<thead> 
						<tr>
							<td colspan="4">
								Informaci&oacute;n del ejercicio n&uacute;mero 6
							</td>
						</tr>
						<tr> 
							<th>#</th>
							<th>Nombre</th> 
							<th>Apellido</th> 
							<th>Correo</th> 
						</tr>
					</thead>
					<tbody> 
						<?php
						if ($result1->num_rows > 0) {
							while($row = $result1->fetch_assoc()) {
								echo "<tr><td>".$row["id"]."</td>";
								echo "<td>".$row["nombre"]."</td>";
								echo "<td>".$row["apellido"]."</td>";
								echo "<td>".$row["correo"]."</td></tr>";
							}
						}
						?>
					</tbody> 
				</table>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-10 col-xs-offset-1">
				<table class="table"> 
					<thead> 
						<tr>
							<td colspan="4">
								Informaci&oacute;n del ejercicio n&uacute;mero 5 pagos realizados el a&ntilde;o 2017
							</td>
						</tr>
						<tr> 
							<th>#</th>
							<th>Name</th> 
							<th>Monto</th> 
						</tr>
					</thead>
					<tbody> 
						<?php
						if ($result2->num_rows > 0) {
							while($row = $result2->fetch_assoc()) {
								echo "<tr><td>".$row["id"]."</td>";
								echo "<td>".$row["name"]."</td>";
								echo "<td>".$row["total"]."</td>";
							}
						}
						?>
					</tbody> 
				</table>
			</div>
			<div class="tab-content">            
				<div class="row">
					<div class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1">
						<span>¿Qué comprobaci&oacute;n realiza el operador === ?: Dependiendo el lenguaje tiene un significado diferente por ejemplo: en PHP y Javascript el significado de este operador es Id&eacute;ntico o estrictamente igual </span>
					</div>
				</div>
				<hr size="2px" color="black" />
				<div class="tab-content">            
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-10 col-xs-offset-1">
							<span>Cantidad de estudiantes que tienen el nombre Juan: </span>
							<?php
							if ($result3->num_rows > 0) {
								while($row = $result3->fetch_assoc()) {
									echo "<tr><td>".$row["total"]."</td>";
								}
							}
							?>

						</div>
						<div class="col-md-3 col-sm-3 col-xs-10 col-xs-offset-1">
							<form mane"formulario" method="post" action="transformacion.php">
								<div class="form-group">
									<label for="personas">N&uacute;meros para convertir en letra</label>
									<span>Se estableci&oacute; como limite de conversion hasta el numero 999</span>
									<input type="number" class="form-control" id="num" name ="num" placeholder="N&uacute;meros de personas">
								</div>
								<button type="submit" class="btn btn-primary">Convertir</button>
							</form>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-10 col-xs-offset-1">
							<form mane"formulario" method="post" action="palindromo.php">
								<div class="form-group">
									<label for="palabra">Verifica si una palabra dada es un pal&iacute;ndromo</label>
									<input type="text" class="form-control" id="palabra" name ="palabra" placeholder="N&uacute;meros de personas">
								</div>
								<button type="submit" class="btn btn-primary">Verificar</button>
							</form>
						</div>
					</div>
				</div>

				<!-- Javascript --> 
				<script src="assets/js/jquery.min.js"></script>   
			</body>
			</html>