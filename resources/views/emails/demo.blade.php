<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Vista de Correo</title>
</head>
<body>
    <div class="content">
		Hello <i>{{ $demo->sfrom }}</i>,
		<p>Ejemplo de envio de Correo HTML version.</p>

		<p><u>Valores del objeto recibido (demo):</u></p>

		<div>
		<p><b>Demo smsg:</b>&nbsp;{{ $demo->smsg }}</p>
		<p><b>Demo dat1:</b>&nbsp;{{ $demo->dat1 }}</p>
		</div>

		<p><u>Valores que se pasaron con metodo With:</u></p>

		<div>
		<p><b>testVarOne:</b>&nbsp;{{ $testVarOne }}</p>
		<p><b>testVarTwo:</b>&nbsp;{{ $testVarTwo }}</p>
		</div>

		Thank You,
		<br/>
		<i>{{ $demo->sname }}</i>
		<i>{{ $demo->dat1 }}</i>
    </div>
</body>
</html>