<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../assets/js/enviar_reclamo.js"></script>
	<title>Formulario de reclamos</title>
</head>
<body>
<a href="javascript:history.back()"><img src="../assets/img/boton-regresar.png" height="33" width="100"  alt="Botón"></a>
<form id="formulario_reclamo" method="post" action="reclamos.php">
	<!-- Aquí van los campos del formulario -->
		<label>Nombre:</label>
		<input type="text" name="nombre"><br>
		<label>Correo electrónico:</label>
		<input type="email" name="correo"><br>
		<label>Teléfono:</label>
		<input type="tel" name="telefono"><br>
		<label>Mensaje:</label>
		<textarea name="mensaje"></textarea><br>
		<input type="submit" value="Enviar reclamo">
	</form>

</body>
</html>

<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Obtener los datos del formulario
	$nombre = $_POST["nombre"];
	$correo = $_POST["correo"];
	$telefono = $_POST["telefono"];
	$mensaje = $_POST["mensaje"];

	// Validar los datos
	if (empty($nombre) || empty($correo) || empty($telefono) || empty($mensaje)) {
		echo "Por favor, complete todos los campos del formulario.";
	} else {
		// Enviar el correo electrónico de reclamo
		$destinatario = "destinatario@ejemplo.com";
		$asunto = "Nuevo reclamo de " . $nombre;
		$mensaje_correo = "Nombre: " . $nombre . "\r\n";
		$mensaje_correo .= "Correo electrónico: " . $correo . "\r\n";
		$mensaje_correo .= "Teléfono: " . $telefono . "\r\n";
		$mensaje_correo .= "Mensaje: " . $mensaje . "\r\n";
		$encabezados = "From: remitente@ejemplo.com\r\n";
		if (mail($destinatario, $asunto, $mensaje_correo, $encabezados)) {
			echo "Su reclamo ha sido enviado correctamente.";
		} else {
			echo "Ha ocurrido un error al enviar su reclamo.";
		}
	}
}
?>

<style>
	form {
		width: 50%;
		margin: 0 auto;
		background-color: #f2f2f2;
		padding: 20px;
		border-radius: 10px;
		box-shadow: 0 0 10px rgba(0,0,0,0.3);
	}
	label {
		display: block;
		margin-bottom: 10px;
	}
	input[type="text"],
	input[type="email"],
	input[type="tel"],
	textarea {
		width: 100%;
		padding: 10px;
		margin-bottom: 20px;
		border-radius: 5px;
		border: none;
		box-shadow: 0 0 5px rgba(0,0,0,0.1);
	}
	input[type="submit"] {
		background-color: #4CAF50;
		color: white;
		padding: 10px 20px;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}
	input[type="submit"]:hover {
		background-color: #3e8e41;
	}
</style>




