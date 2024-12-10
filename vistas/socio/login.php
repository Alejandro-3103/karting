<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Css/login.css">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
			<form action="../../controladores/SocioController.php" method="POST">
					<label for="chk" aria-hidden="true">Registrarse</label>
					<input type="hidden" name="action" value="insert">
					<input type="text" name="nombre" placeholder="nombre de usuario" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="contraseña" placeholder="contraseña" required="">
					<button>Registrarse</button>
				</form>
			</div>

			<div class="login">
				<form action="../../controladores/SocioController.php" method="POST">
					<label for="chk" aria-hidden="true">Ingresar</label>
					<input type="hidden" name="action" value="login">
					<input type="text" name="nombre" placeholder="nombre de usuario" required="">
					<input type="password" name="contraseña" placeholder="contraseña" required="">
					<button>Ingresar</button>
				</form>
			</div>
	</div>
</body>
</html>