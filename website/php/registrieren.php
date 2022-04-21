<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <link href="style/bootstrap.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <form action="" method='post'>
        <div class='form-group'>
            <label for='benutzername'>Benutzername: </label>
            <input type='text' class='form-control' name='benutzername' aria-describedby='emailHelp' placeholder='Benutzername'>
        </div>
        <div class='form-group'>
            <label for='email'>E-Mail-Adresse: </label>
            <input type='email' class='form-control' name='email' placeholder='E-Mail-Adresse'>
        </div>
        <div class='form-group'>
            <label for='passwort'>Passwort: </label>
            <input type='password' class='form-control' name='passwort' placeholder='Passwort'>
        </div>
        <div class='form-group'>
            <label for='message'>Passwort wiederholen: </label>
            <input type='password' class='form-control' name='passwortWiederholen' placeholder='Passwort'>
        </div>
        <button type='submit' class='btn btn-primary' name='absenden'>Submit</button>
    </form>
</body>
</html>


<?php

$db = new mysqli('localhost', 'root', '', 'chat');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
} 

if(isset($_POST['absenden'])) {
    $benutzername = $_POST['benutzername'];
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwortWiederholen = $_POST['passwortWiederholen'];

    $search_user = $db->prepare("SELECT id FROM users WHERE benutzername = ?");         // Bereitet SQL-Abfrage vor, ? wird nachher eine Variable eingefügt
    $search_user->bind_param('s',$benutzername);            // "Bindet" die Parameter an die SQL query. Erster parameter gibt den Datentypen von $benutzername an (s ==> String)
    $search_user->execute();            // Wird jetzt executed
    $result = $search_user->get_result();            // Liefert die Anzahl zurück

    // Schauen, ob Benutzername einmalig ist + ob Passwörter übereinstimmen
    if ($result->num_rows == 0) {
        if ($passwort == $passwortWiederholen) {
            $passwort = md5($passwort);         // Passwort verschlüsseln
            $insert = $db->prepare("INSERT INTO users (benutzername, email, passwort) VALUES (?,?,?)");
            $insert->bind_param("sss", $benutzername, $email, $passwort);
            $insert->execute();
            if ($insert != false) {
                echo '<br>Account wurde erfolgreich erstellt!';
            }
        } else {
            echo 'Passwörter stimmen nicht überein!';
        }
    } else {
        echo 'Benutzername vergeben!';
    }
}



?>