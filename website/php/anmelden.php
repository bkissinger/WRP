<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384 F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Anmeldung</title>
</head>

<body>
	<div class="row">
		
		<div class="col ms-3 mt-2">
			<img src="file:///D|/Programme/XAMPP/htdocs/img/logoWrp.png" class="row img-fluid"></img>
		</div>
		<div class="col-10"></div>
	</div>
	
    <h1 class="row justify-content-center">Anmeldung</h1>
   
    <form action="" method='post' class="m-5 mt-2">
        <div class='form-group'>
            <label for='benutzername'>Benutzername: </label>
            <input type='text' class='form-control' name='benutzername' aria-describedby='emailHelp' placeholder='Benutzername'>
        </div>
        <div class='form-group'>
            <label for='passwort'>Passwort: </label>
            <input type='password' class='form-control' name='passwort' placeholder='Passwort'>
        </div>
		
		<div class="row mt-4">
			<div class="col-5"></div>
			<div class="col-1">
				<button type='submit' class='btn btn-secondary' name='absenden'>Login</button>
			</div>
			<div class="col-2">
				<a href="file:///D|/Programme/XAMPP/htdocs/Chat/registrierung.php" class="btn btn-secondary me-md-2">Zur Registrierung</a>
			</div>
		</div>
        
    </form>
</body>
</html>

<?php

//database connection
$db = mysqli_connect('localhost', 'root','','Chat');

// Check connection
if (mysqli_connect_error()) {
    echo "Connection establishing failed!";
} else {
    echo "Connection established successfully.";
}


if(isset($_POST['absenden'])) {
    $benutzername = strtolower($_POST['benutzername']);
    $passwort = $_POST['passwort'];
    $passwort = md5($passwort);

    $search_user = $db->prepare("SELECT username FROM user WHERE username = ? AND password = ?");
    $search_user->bind_param('ss',$benutzername, $passwort);
    $search_user->execute();
    $result = $search_user->get_result();

    if ($result->num_rows == 1) {
        $search_object = $result->fetch_object();  		      
        $_SESSION['user'] = $search_object->username;         
        header('Location: chat.php');
    } else {
        echo 'Angaben nicht korrekt!';
    }
}

?>