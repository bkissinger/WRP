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
            <label for='passwort'>Passwort: </label>
            <input type='password' class='form-control' name='passwort' placeholder='Passwort'>
        </div>
        <button type='submit' class='btn btn-primary' name='absenden'>Submit</button>
    </form>
</body>
</html>

<?php

$db = new mysqli('localhost', 'myadmin', '', 'WRP');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
} 

if(isset($_POST['absenden'])) {
    $benutzername = strtolower($_POST['benutzername']);
    $passwort = $_POST['passwort'];
    $passwort = md5($passwort);

    $search_user = $db->prepare("SELECT id FROM users WHERE benutzername = ? AND passwort = ?");
    $search_user->bind_param('ss', $benutzername, $passwort);
    $search_user->execute();
    $result = $search_user->get_result();

    if ($result->num_rows == 1) {
        $search_object = $result->fetch_object();            // Um die ID zu kriegen
        $_SESSION['user'] = $search_object->id;         // Session wird an Hand der ID gespeichert
        header('Location: /php/WRP.php');
    } else {
        echo 'Angaben nicht korrekt!';
    }
}

?>