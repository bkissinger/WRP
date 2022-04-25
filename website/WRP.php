<!doctype html>
<html lang="de-AT">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384 F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <link rel="icon" href="logoWrp.png" type="image/x-icon">
    <title>Weather Research Program</title>
</head>
<body>
    <main class="container">
        <!-- Erste Zeile (Home und Logo)-->
        <div class="row">
            <div class="col-lg-2">
                <div class="col mt-5">
                    <h3><a href="#" class="home" id="button">Home</a></h3>
                </div>
            </div>

            <div class="col-lg-8">

            </div>


            <div class="col-lg-2">
                <div class="col mt-5">
                    <div class="img">
                        <img src="logoWrp.png" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tabellen
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">LIVE</a>
                        <a class="dropdown-item" href="#">ALT</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Verfügbare Messgeräte
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Messgerät H923</a>
                        <a class="dropdown-item" href="#">Messgerät H930</a>
                    </div>
                </div>




            </div>
            <div class="col-lg-4">
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Graphentypen
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Kreisdiagramm</a>
                        <a class="dropdown-item" href="#">Balkendiagramm</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <button type="button" class="btn btn-outline-dark" id="button1">Graph anzeigen</button>
            </div>
            <div class="col-lg-4">
                <button type="button" class="btn btn-outline-dark" id="button2">Tabelle schicken</button>
            </div>
            <div class="col-lg-4">
                <button type="button" class="btn btn-outline-dark" id="button3">Werte filtern</button>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-2">
            <div class="col mt-5">
                <button type="button" class="btn btn-outline-dark" id="button3">Abmelden</button>
            </div>

        </div>
</div>


    </main>
</body>