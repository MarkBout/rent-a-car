<?php
session_start();
include_once 'lib/GebruikDB.php';
include_once 'lib/Utilities.php';
include 'modals/login.php';
include 'modals/register.php';
$utilities = new Utilities();
$database = new GebruikDB();
$connection = $database->setConn('localhost', 'root',null,'rent-a-car');
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="lib/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <style>
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Lobster', cursive;
        }
        .box{
            max-width: 50em;
            height: 25em;
            overflow: auto;
            direction: rtl;
            text-align: left;
        }

    </style>
</head>
<header>

    <nav class="navbar primary-colour" style="z-index: 1">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <div>
                    <a href="index.php">
                        <img class="img-fluid" src="images/logo.png" alt="Card image cap">
                    </a>
                </div>
                <h2 class="text-white col p-2 m-0">Rent a Car | Autoverhuur</h2>
            </div>
            <div class="d-flex">
                <ul class="list-group list-group-horizontal-lg" style="list-style: none">
                    <?php if(isset($_SESSION['gebruiker'])): ?>
                        <li class="nav-item dropdown rounded-pill mr-2" style="background-color: #1361C2;">
                            <a class="nav-link dropdown-toggle text-white text-center" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['gebruiker']['voornaam'].' '.$_SESSION['gebruiker']['tussenvoegsel'].' '.$_SESSION['gebruiker']['achternaam'].' '. $utilities->getRole($_SESSION['gebruiker']['rol']); ?>
                            </a>
                            <ul class="dropdown-menu" style="background-color: #1361C2;" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item text-white" href="Profiel.php">Mijn Profiel</a></li>
                                <?php if(isset($_SESSION['gebruiker']) && $_SESSION['gebruiker']['rol'] == 1): ?>
                                    <li><a class="dropdown-item text-white" href="medewerkers.php">Medewerkers pagina</a></li>
                                <?php endif;?>
                                <li><a class="dropdown-item text-white" href="winkelwagen.php">Winkelwagen</a></li>
                                <li><a class="dropdown-item text-white" href="logout.php">Uitloggen</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary rounded-pill btn-lg"><a
                                        class="text-white text-decoration-none" data-bs-toggle="modal" data-bs-target="#registerModal">Registreren</a></button>
                        </li>
                        <li class="nav-item mr-2">
                            <button type="button" class="btn btn-primary ms-2 rounded-pill btn-lg"><a
                                        class="text-white text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginModal">inloggen</a></button>
                        </li>
                    <?php endif;?>
                    <li class="nav-item mr-2">
                        <button type="button" class="w-100 btn btn-primary rounded-pill btn-lg">
                            <a class="text-white text-decoration-none" href="index.php">Home</a>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="w-100 btn btn-primary rounded-pill btn-lg">
                            <a class="text-white text-decoration-none" href="contact.php">Contact</a>
                        </button>
                    </li>
                    <li class="ms-2 me-2 nav-item">
                        <button type="button" class="w-100 btn btn-primary rounded-pill btn-lg">
                            <a class="text-white text-decoration-none" href="autoOverzicht.php">Onze auto's</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav></header>
<script src="lib/bootstrap-5/js/bootstrap.min.js"></script>