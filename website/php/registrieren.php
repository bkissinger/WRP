<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384 F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Registrierung</title>
</head>

<body>
	<div class="row">
		<div class="col-10"></div>
		<div class="col ms-3 mt-3 me-3">
			<img src="../img/logoWrp.png" class="row img-fluid"></img>
		</div>
	</div>
	<div class="row">
        <div class="col">
            <h1 class="row justify-content-center">Registrierung</h1>
        </div>
    </div>
	
    <form action="" method='post' class="m-5 mt-2">
        <div class='form-group'>
            <label for='benutzername'>Benutzername: </label>
            <input type='text' class='form-control' name='benutzername' aria-describedby='emailHelp' placeholder='Benutzername'>
        </div>
        <div class='form-group mt-3'>
            <label for='email'>E-Mail-Adresse: </label>
            <input type='email' class='form-control' name='email' placeholder='E-Mail-Adresse'>
        </div>
        <div class='form-group mt-3'>
            <label for='passwort'>Passwort: </label>
            <input type='password' class='form-control' name='passwort' placeholder='Passwort'>
        </div>
        <div class='form-group mt-3'>
            <label for='message'>Passwort wiederholen: </label>
            <input type='password' class='form-control' name='passwortWiederholen' placeholder='Passwort'>
        </div>
		
		<div class="d-grid gap-3 mt-3 d-md-flex justify-content-md-center btn-group">
			<a href="anmelden.php" class="btn btn-secondary me-md-2">Zur Login Seite</a>
  			<button type='submit' class='btn btn-secondary' name='absenden'>Registrierung</button>
		</div>
    </form>
</body>
</html>


<?php

$db = new mysqli('localhost', 'root', '', 'WRP');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
} 

if(isset($_POST['absenden'])) {
    $benutzername = $_POST['benutzername'];
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwortWiederholen = $_POST['passwortWiederholen'];

    $search_user = $db->prepare("SELECT username FROM users WHERE username = ?");         // Bereitet SQL-Abfrage vor, ? wird nachher eine Variable eingef??gt
    $search_user->bind_param('s',$benutzername);            // "Bindet" die Parameter an die SQL query. Erster parameter gibt den Datentypen von $benutzername an (s ==> String)
    $search_user->execute();            // Wird jetzt executed
    $result = $search_user->get_result();            // Liefert die Anzahl zur??ck

    // Schauen, ob Benutzername einmalig ist + ob Passw??rter ??bereinstimmen
    if ($result->num_rows == 0) {
        if ($passwort == $passwortWiederholen) {
            $passwort = md5($passwort);         // Passwort verschl??sseln
            $insert = $db->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
            $insert->bind_param('sss',$benutzername, $email, $passwort);
            $insert->execute();
            if ($insert) {
				header('Location: anmelden.php');
            }
        } 
		else {
			echo 'Passw??rter stimmen nicht ??berein!';
        }
    }
	else {
		echo 'This username is already taken';
	}
}



?>