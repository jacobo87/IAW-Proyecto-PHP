<?php 
session_start();

// conectarse a la base de datos
$db = mysqli_connect('localhost', 'user', '', 'multi_login');

// declaracion de variables
$username = "";
$email    = "";
$errors   = array(); 

// llamar a la función register() si se hace clic en register_btn
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTRAR USUARIO
function register(){
	// llamar a estas variables con la palabra clave global para que estén disponibles en la función
	global $db, $errors, $username, $email;

	// recibir todos los valores de entrada del formulario. Llama a la función e()
    // definida a continuación para escapar de los valores del formulario
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// validación de formularios: garantizar que el formulario se rellena correctamente
	if (empty($username)) { 
		array_push($errors, "Username requerido"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email requerido"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password requerido"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "Las dos passwords no coninciden");
	}

	// registrar al usuario si no hay errores en el formulario
	if (count($errors) == 0) {
		$password = md5($password_1);//encriptar la contraseña antes de guardarla en la base de datos

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "Usuario creado satisfactoriamente";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// obtener el id del usuario creado
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // poner al usuario conectado en la sesión
			$_SESSION['success']  = "Usted está ahora logueado";
			header('location: index.php');				
		}
	}
}

// devuelve el array de usuarios a partir de su id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// cadena de escape
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	