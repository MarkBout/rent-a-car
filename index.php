<?php

include 'navbar.php';
//check session related stuff
$afbeeldingen = $database->getObject($connection,'auto',array('afbeelding'));
?>
<!doctype html>
<html lang="en">
<head>
    <title>Home | Rent a car</title>
</head>
<body class="bg-soft-white">
    <div class="container-fluid position-relative">
        <div class="h-100 w-100" style=" background-color: #FDF1E7; z-index: -98;">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $active = true; ?>
                    <?php foreach($afbeeldingen as $image):?>
                        <div class="carousel-item <?php echo ($active == true)?"active":"" ?>">
                            <img src="<?php echo $image['afbeelding'] ?>" class="d-block h-100 w-100" alt="...">
                        </div>
                        <?php $active = false; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="container position-absolute primary-colour pb-3" style="top: 15%; left: 10%; right: 10%; background-color: rgba(84, 141, 212,0.9);">
            <?php
            if (isset($_SESSION['message'])){
                echo '<div id="registermessage" class="'.$_SESSION['message']['class'].'" role="alert"><button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="Close"></button>'.$_SESSION['message']['content'].'</div>';
            }

            ?>
            <h1 class="text-center text-white mb-3">Welkom bij Rent a Car</h1>
            <div class="row w-50 position-relative" style="left: 25%">
                <p class="text-white " style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sem lorem, pellentesque eu efficitur et, lobortis nec quam. Proin egestas, augue quis convallis tristique, elit massa ullamcorper ante, nec tincidunt magna felis vitae dolor. Suspendisse venenatis eros quis elit gravida dictum. Phasellus pellentesque viverra massa, non fermentum leo sagittis id. Sed id sodales nulla, id pulvinar ligula.</p>
                <div class="btn-group" role="group" aria-label="index buttons">
                    <a type="button" href="autoOverzicht.php" class="text-white btn btn-primary rounded-pill me-1">Huur een auto</a>
                    <a type="button" href="contact.php" class="text-white btn btn-primary rounded-pill ms-1">Kom in contact</a>
                </div>
            </div>
        </div>
    </div>
<script>
    function hideMessage() {
        document.getElementById("registermessage").style.display = "none";
    };
    setTimeout(hideMessage, 1000);
</script>
</body>
</html>