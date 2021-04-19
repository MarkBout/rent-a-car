<?php
include 'navbar.php';
if (!isset($_SESSION['gebruiker'])) $utilities->redirect('../index.php');
$gebruiker = $_SESSION['gebruiker'];
$user = $database->getObject($connection,'gebruiker',array('voornaam','tussenvoegsel', 'achternaam', 'gebruikersnaam','wachtwoord'),'idgebruikers='.$gebruiker['idgebruikers']);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Profiel</title>
</head>
<body class="bg-soft-white">
<div class="container-fluid">
    <div class="container position-absolute primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
        <?php echo '<h1 class="h1 text-white text-center">Welkom '.$gebruiker['voornaam'].' '.$gebruiker['achternaam'].' '. $rol = $utilities->getRole($gebruiker['rol']).' bij Rent a Car</h1>';?>

        <form method="post" action="lib/Account.php">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-head">
                        <ul class="nav nav-tabs" id="myTab" role="tablist"  style="display: flex; justify-content: center; align-items: center;">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active btn-primary" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Gegevens</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn-primary" id="profile-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false">Bestellingen</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="pt-4 tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-4">yee</div>
                                    <div class="col-md-4">
                                    <?php
                                    foreach ($user as $key => $value){
                                        if ($key == 'wachtwoord') continue;
                                        echo '<div class="row">
                                                <div class="col-md-4">
                                                    <label class="text-white">'.ucfirst($key).'</label>
                                                </div>
                                                <div class="col-md-8 mb-1">
                                                    <input type="text" class="form-control" name="profile['.$key.']" value="'.$value.'" disabled>
                                                </div>
                                              </div>';
                                    }
                                    ?>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">

                            </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
