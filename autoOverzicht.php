<?php include 'navbar.php';
include_once 'lib/Utilities.php';
$carlist = $database->getObject($connection,'auto',array('*'), "status='available'");
?>
<!doctype html>
<html lang="en">
<head>
    <title>Auto overzicht | Rent a Car</title>
</head>
<body class="bg-soft-white">
    <div class="container-fluid">
        <div class="container position-absolute primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
            <h1 class="text-center mt-3 text-white">Auto Overzicht</h1>
             <div class="col-12" style="max-width: 100%">
                <div class="row">
                    <?php
                        if (isset($carlist) && !empty($carlist)) {
                            foreach ($carlist as $car) {
                                $temp = $database->getObject($connection,'prijs',array('type','dagprijs'),'idprijs='.(int)$car['idprijs']);
                                $car['type'] = $temp[0]['type'];
                                $car['dagprijs'] = $temp[0]['dagprijs'];
                                echo '<div class="col-6  d-flex align-items-stretch">';
                                echo '<div class="card mb-3">
                                        <div class="row g-0">
                                                <div class="col-md-4 overflow-hidden">
                                                    <img width="" style="width: 100%;max-width: 100%" src="'.$car['afbeelding'].'" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <h5 class="card-title w-50">'.$car['naam'].'</h5>
                                                            <h5 class="text-end card-title w-50">Status: '.$car['status'].'</h5>
                                                        </div>
                                                        <p class="card-text p-1">'.$car['beschrijving'].'</p>
                                                        <p class="card-text"><small class="text-muted">Type '.$car['type'].'<br>Kenteken '.$car['kenteken'].'</small></p>
                                                        <div class="row">
                                                            <p class="card-text w-50">Dagprijs: &#8364;'.$car['dagprijs'].'</p><br>
                                                            <?//todo: Find a way to make this work or make seperate card for employees?>';
                                                            echo '<a class="btn btn-primary w-50 text-white rounded-pill" href="autoDetail.php?id='.$car['idauto'].'">Bekijken</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                 </div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>