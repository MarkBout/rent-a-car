<?php include 'navbar.php';
include_once 'lib/Utilities.php';
$carlist = $database->getObject($connection,'auto',array('*'), "status='available'");
if (isset($_SESSION['searchresult'])) $carlist = $_SESSION['searchresult'];
$types = $database->getObject($connection,'prijs',array('type'));
$merken = $database->getObject($connection,'prijs',array('merk'));

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
            <? //zoekfilter ?>
            <form action="lib/HandlePOST.php" method="post">
                <div class="row">
                    <div class="col-3">
                        <label class="text-white" for="type">Type</label>
                        <select name="search[type]" id="type" class="form-control">
                            <option disabled selected>Kies een type</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?php echo $type['type']?>"><?php echo $type['type']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <label class="text-white form-label" for="merk">Merk</label>
                        <select name="search[merk]" id="merk" class="form-control">
                            <option disabled selected>Kies een merk</option>
                            <?php foreach ($merken as $merk): ?>
                                <option value="<?php echo $merk['merk']?>"><?php echo $merk['merk']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="naam" class="form-label text-white">Naam</label>
                        <input type="text" id="naam" name="search[naam]" class="form-control" required placeholder="zoek op naam">
                    </div>
                    <div class="col-3">
                        &nbsp;
                        <button class="col-12 rounded-pill btn btn-primary btn-lg" type="submit">Zoek</button>
                        <?php if (isset($_SESSION['searchresult'])):?>
                        <button class="col-12 mt-1 rounded-pill btn btn-danger btn-lg" name="search[reset]" value="true" type="submit">Reset</button>
                        <?php endif;?>
                    </div>
                </div>
            </form>


             <div class="col-12" style="max-width: 100%">
                 <?php foreach ($carlist as $car):
                     $temp = $database->getObject($connection,'prijs',array('*'),'idprijs='.(int)$car['idprijs'])[0];
                     $car['type'] = $temp['type'];
                     $car['dagprijs'] = $temp['dagprijs'];
                     $car['merk'] = $temp['merk']
                 ?>
                <div class="row">
                    <div class="card mb-3" style="max-width: 100%;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo $car['afbeelding']?>" style="height: auto;max-width: 100%" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="row">
                                        <h5 class="card-title col-6"><?php echo $car['naam']?></h5>
                                        <h5 class="text-end card-title col-6">Status: <?php echo $car['status']?></h5>
                                    </div>
                                    <p class="card-text"><?php echo $car['beschrijving']?></p>
                                    <p class="card-text"><small class="text-muted">Type <?php echo $car['type']?><br>Kenteken <?php echo $car['kenteken']?><br>Merk: <?php echo $car['merk']?></small></p>
                                    <div class="row">
                                        <p class="card-text w-50">Dagprijs: &#8364;<?php echo  $car['dagprijs']?></p><br>
                                        <form method="post" action="autoDetail.php">
                                        <button type="submit" name="id" value="<?php echo $car['idauto']?>" class="btn btn-primary w-50 text-white rounded-pill">Bekijken</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php endforeach;?>
            </div>
        </div>
    </div>

<script>

</script>

</body>
</html>