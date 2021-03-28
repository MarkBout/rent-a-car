<?php
include_once 'lib/GebruikDB.php';
include 'navbar.php';
?>
<!doctype html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rent a car</title>
</head>
<body class="primary-colour">
    <div class="container-fluid h-100 position-absolute">
        <?/*@todo Make this dynamic and shorter*/ ?>
        <div class="h-100 w-100" style=" z-index: -99;">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row h-100">
                            <div class="col-xl-4">
                                <img src="https://picsum.photos/id/1071/300/300" class="d-block w-100 h-100" alt="...">
                            </div>
                            <div class="col-xl-4">
                                <img src="https://picsum.photos/id/183/300/300" class="d-block w-100 h-100" alt="...">
                            </div>
                            <div class="col-xl-4">
                                <img src="https://picsum.photos/300" class="d-block w-100 h-100" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row h-100">
                            <div class="col-xl-4">
                                <img src="https://picsum.photos/300" class="d-block w-100 h-100" alt="...">
                            </div>
                            <div class="col-xl-4">
                                <img src="https://picsum.photos/300" class="d-block w-100 h-100" alt="...">
                            </div>
                            <div class="col-xl-4">
                                <img src="https://picsum.photos/300" class="d-block w-100 h-100" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row h-100">
                            <div class="col-xl-4">
                                <img src="https://picsum.photos/300" class="d-block w-100 h-100" alt="...">
                            </div>
                            <div class="col-xl-4">
                                <img src="https://picsum.photos/300" class="d-block w-100 h-100" alt="...">
                            </div>
                            <div class="col-xl-4">
                                <img src="https://picsum.photos/300" class="d-block w-100 h-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>