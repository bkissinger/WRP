<!-- Startet für den geraden angemeldeten Benutzer ein Session -->
<?php

/* Startet für den geraden angemeldeten Benutzer ein Session */
session_start();
if ( !isset( $_SESSION[ 'user' ] ) ) {
  header( 'location:anmelden.php' );
  exit();
}

/* Session wird beendet */
if ( isset( $_POST[ 'logout' ] ) ) {	
  session_unset();
  session_destroy();
	header( 'location:anmelden.php' );
}
?>

<!doctype html>
<html lang="de-AT">
<head>
<!-- CSS mittels Bootsrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<meta charset="utf-8">
<link rel="icon" href="ITP/3ter_Jahrgang/Sommersemester_Projekt/WRP/website/img/logoWrp.png" type="image/x-icon">
<title>Weather Research Program</title>
</head>
    
<body>
<!-- Erste Zeile (Home und Logo)-->
<div class="row">
  <div class="col-10"></div>
  <div class="col ms-3 mt-3 me-3"> <img src="../img/logoWrp.png" class="row img-fluid"></img> </div>
</div>
<div class="row mb-3">
  <div class="col">
    <h1 class="row justify-content-center">Home</h1>
  </div>
</div>

<!-- Erste Zeile mit Buttons-->
<form action="" method='post'>
  <div class="d-grid gap-4 mt-3 d-md-flex m-5"> 
    <!-- Erstes Dropdownmenü-->
    <div class="dropdown dropdown-center w-100">
      <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenu1" data-bs-toggle="dropdown" aria-expanded="false" on> Tabellen </button>
      <ul class="dropdown-menu w-100 text-center dropdown-menu-dark" aria-labelledby="dropdownMenu1">
        <li><a class="dropdown-item" href="#" onClick="liveTable()" id="Live">Live</a></li>
        <li><a class="dropdown-item" href="#" onClick="oldTable()" id="Alt">ALT</a></li>
      </ul>
    </div>
    <!-- Zweites Dropdownmenü-->
    <div class="dropdown dropdown-center w-100">
      <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"> Verfügbare Messgeräte </button>
      <ul class="dropdown-menu w-100 text-center dropdown-menu-dark" aria-labelledby="dropdownMenu2">
        <li><a class="dropdown-item" href="#">Messgerät H923</a></li>
        <li><a class="dropdown-item" href="#">Messgerät H930</a></li>
      </ul>
    </div>
    <!-- Drittes Dropdownmenü-->
    <div class="dropdown dropdown-center w-100">
      <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false"> Graphentypen </button>
      <ul class="dropdown-menu w-100 text-center dropdown-menu-dark" aria-labelledby="dropdownMenu3">
        <li><a class="dropdown-item" href="#">Kreisdiagramm</a></li>
        <li><a class="dropdown-item" href="#">Balkendiagramm</a></li>
      </ul>
    </div>
  </div>
	 <!-- Ausgabe der Datenbank-->
<div id="table">
</div>
  <!-- Zeile unter der Tabelle-->
  <div class="d-grid gap-4 mt-1 d-md-flex justify-content-md-center btn-group m-5 mb-3">
    <button type="button" class="btn btn-secondary" id="button1">Graph anzeigen</button>
    <button type="button" class="btn btn-secondary" id="button2">Tabelle schicken</button>
    <button type="button" class="btn btn-secondary" id="button3">Werte filtern</button>
  </div>
  <!-- Logout Button-->
  <div class="d-grid d-md-flex justify-content-md-end btn-group m-5 mt-2">
    <button type="submit" class="btn btn-secondary" id="logout" name="logout">Abmelden</button>
  </div>
</form>
</body>

<script>
    let live;
    
    function liveTable() {
    var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table").innerHTML = this.responseText;
        }
        };
        xhttp.open("GET", "GetTable/getTableNeu.php", false);
        xhttp.send();
        if (!live) {
        live = setInterval(function(){ 
        var xhttp;    
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("table").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "GetTable/getTableNeu.php", false);
          xhttp.send();
        },1000);
        }
    }

    function oldTable() {
        clearInterval(live);
        live = null;
        var xhttp;    
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("table").innerHTML = this.responseText;
            }
          };
          xhttp.open("GET", "GetTable/getTableAlt.php", false);
          xhttp.send();
    }
</script>