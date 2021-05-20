<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
	<h2>Registro</h2>
</div>
<form method="post" action="register.php">
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirmar password</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Registrar</button>
	</div>
	<p>
		¿Ya eres miembro? <a href="login.php">Acceder</a>
	</p>
</form>
</body>
</html>