<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="lib/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<nav class="navbar navbar-dark primary-colour navbar-expand-md bg-faded justify-content-center fixed-top">
    <div class="navbar-collapse collapse w-25 order-1 order-md-0 dual-collapse2">
        <a class="navbar-brand border-0 " href="#">
            <img src="images/logo.png" height="65" alt="">
        </a>
        <h3 class="h3 text-white"> Rent a car | Autoverhuur </h3>
    </div>
    <div class="navbar-collapse collapse w-50" id="collapsingNavbar3">
        <ul class="nav navbar-nav ml-auto w-75 justify-content-end">
            <li class="nav-item">
                <button type="button" class="w-100 btn btn-primary rounded-pill btn-lg">
                    <a class="text-white text-decoration-none" href="contact.php">Contact</a>
                </button>
            </li>
            <li class="ms-2 me-2 nav-item">
                <button type="button" class="w-100 btn btn-primary rounded-pill btn-lg">
                    <a class="text-white text-decoration-none" href="#">Onze auto's</a>
                </button>
            </li>
            <?php if(isset($_SESSION['gebruiker'])): ?>
                <li>
                    <div class="dropdown">
                        <a href="#" id="imageDropdown" data-toggle="dropdown">
                            <img src="https://picsum.photos/50">
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown">
                            <li role="presentation"><a class="text-decoration-none" role="menuitem" tabindex="-1" href="#">Menu
                                    item 1</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 2</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 3</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 4</a></li>
                        </ul>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <button type="button" class="btn btn-primary rounded-pill btn-lg"><a
                                class="text-white text-decoration-none" href="#">Registreren</a></button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-primary ms-2 rounded-pill btn-lg"><a
                                class="text-white text-decoration-none" href="#">inloggen</a></button>
                </li>
            <?php endif;?>
        </ul>
    </div>
</nav>
<script src="lib/bootstrap-5/js/bootstrap.min.js"></script>
