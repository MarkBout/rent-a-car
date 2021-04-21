<?php
include 'navbar.php';
if (!isset($_SESSION['gebruiker'])) $utilities->redirect('../index.php');
$gebruiker = $_SESSION['gebruiker'];
?>
<!doctype html>
<html lang="en">
<head>
    <title>Profiel | Rent a Car</title>
</head>
<body class="bg-soft-white">
<div class="container-fluid">
    <div class="container position-absolute primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
        <?php echo '<h1 class="h1 text-white text-center">Welkom '.$gebruiker['voornaam'].' '.$gebruiker['achternaam'].' '. $rol = $utilities->getRole($gebruiker['rol']).' bij Rent a Car</h1>';
        if (isset($_SESSION['message'])) {
            echo '<div id="registermessage" class="' . $_SESSION['message']['class'] . '" role="alert"><button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="Close"></button>' . $_SESSION['message']['content'] . '</div>';
        }
        ?>

        <form method="post" action="lib/Account.php">
            <input type="hidden" name="profile[idgebruikers]" value="<?php echo $gebruiker['idgebruikers'] ?>">
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
                                    <div id="parent" class="col-sm-6 mx-auto">
                                    <?php
                                    foreach ($_SESSION['gebruiker'] as $key => $value){
                                        if ($key == 'wachtwoord' || $key == 'idgebruikers' || $key == 'rol') continue;
                                        print '<div class="row">
                                                <div class="col-md-3">
                                                    <label for="'.$key.'" class="text-white">'.ucfirst($key).'</label>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <input id="'.$key.'" type="text" class="form-control" name="profile['.$key.']" value="'.$value.'" disabled>
                                                </div>
                                              </div>';
                                    }
                                    ?>
                                        <div id="onEdit" class="d-none">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="newpass" class="text-white">Nieuw wachtwoord</label>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <input id="newpass" type="password" class="form-control" name="profile[newpass]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="newpass2" class="text-white">Herhaal wachtwoord</label>
                                                </div>
                                                <div class="col-md-6 mb-1">
                                                    <input id="newpass2" type="password" class="form-control">
                                                    <button type="button" class="btn btn-sm btn-success mt-1" onclick="checkPass()">Check wachtwoord</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill" style="">Opslaan</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-1">
                                            <div class="col-md-10 mx-auto">
                                                <button type="button" class="btn btn-primary rounded-pill" onclick="editprofile()">Edit profile</button>
                                                <?php if ($rol == 'Medewerker' || $gebruiker['rol'] == 1): ?>
                                                <a href="medewerkers.php" type="button" class="btn btn-primary rounded-pill">Medewerker pagina</a>
                                                <?php endif; ?>
                                                <button type="button" class="btn btn-primary rounded-pill" onclick="editprofile()">Verwijder account</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                <?/*@Todo Make orders tab at the end*/ ?>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script>
    function editprofile() {
        var inputs = document.getElementsByClassName('form-control');
        //enable inputs
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
        var edit = document.getElementById('onEdit');
        edit.classList.remove("d-none");
    }
    
    function checkPass() {
        pass1 = document.getElementById('newpass');
        pass2 = document.getElementById('newpass2');
        if (pass1.value !== pass2.value){
            pass1.style.border = '2px solid red';
            pass2.style.border = '2px solid red';
        }else {
            pass1.style.border = '2px solid green';
            pass2.style.border = '2px solid green';
        }
    }
</script>
</html>
