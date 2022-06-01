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
                <div class="col-10"></div>
                <div class="col ms-3 mt-3 me-3">
                        <img src="../img/logoWrp.png" class="row img-fluid"></img>
                </div>
        </div>

    <h1 class="row justify-content-center">Anmeldung</h1>

    <form action="" method='post' class="m-5 mt-2">
        <div class='form-group'>
            <label for='benutzername'>E-Mail-Adresse: </label>
            <input type='text' class='form-control' name='benutzername' aria-describedby='emailHelp' placeholder='Benutzername'>
        </div>
        <div class='form-group mt-3'>
            <label for='passwort'>Passwort: </label>
            <input type='password' class='form-control' name='passwort' placeholder='Passwort'>
        </div>

                <div class="d-grid gap-3 mt-4 d-md-flex justify-content-md-center btn-group">
                        <a href="registrieren.php" class="btn btn-secondary ">Registrierung</a>
                        <button type='submit' class='btn btn-secondary' name='absenden'>Login</button>
                </div>
    </form>

</body>
</html>

<?php
$servername = "localhost";
$username = "myadmin";
$password = "";

try {
  $db = new PDO("mysql:host=$servername;dbname=WRP", $username, $password);
  // set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

// Anmelden...
if(isset($_POST['absenden'])) {
    // Eingaben in Variablen speichern
    $email = strtolower($_POST['benutzername']);
    $passwort = $_POST['passwort'];
    $passwort = md5($passwort);

    // Die Daten aus der Datenbank holen
    $sql = "SELECT * FROM Benutzer WHERE Email = '".$email."' AND Passwort = '".$passwort."'";
    foreach($db->query($sql) as $row) {
        $id = $row['ID'];
    }

    // Schauen ob schon angemeldet
    $sql = "SELECT COUNT(ID) FROM Benutzer WHERE ID = '".$id."'";
    $res = $db->query($sql);
    $idcount = $res->fetchColumn();

    // Wenn 1
    if ($idcount == 1) {
        $_SESSION['user'] = $id;            // Session starten
        header('Location: WRP.php');
    } else {
        echo 'Angaben nicht korrekt!';          // Sonst die Ausgabe
    }
}

?>
