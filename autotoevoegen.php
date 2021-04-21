<?php
include 'navbar.php';
if (!isset($_SESSION['gebruiker']) || $_SESSION['gebruiker']['rol'] != 1){
    $utilities->redirect('index.php');
}
if (isset($_GET['id'])){
    $auto = $database->getObject($connection,'auto',array('*'),"idauto=".$_GET['id']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Auto toevoegen | Rent a Car</title>
</head>
<body class="bg-soft-white">
    <div class="container-fluid">
        <div class="container position-absolute primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
            <div class="row">
                <?php if (isset($auto)):
                echo "<h1 class='text-center text-white'>".$auto['naam']." ".$auto['kenteken']." aanpassen</h1>";
                else:
                echo '<h1 class="text-center text-white">Nieuwe auto toevoegen</h1>';
                endif;?>
                <hr class="text-white">
            </div>
                <form action="autotoevoegen.php" method="post" enctype="multipart/form-data" class="row">
                    <img class="col-4 ms-5" src="#" id="output"/>
                    <div class="ms-5 col-3">
                        <label for="naam" class="form-label text-white">Naam van de auto</label>
                        <input type="text" class="form-control" id="naam" name="auto[naam]" required>

                        <label for="kenteken" class="form-label text-white">Kenteken van de auto</label>
                        <input type="text" class="form-control" id="kenteken" name="auto[kenteken]" required>

                        <label for="status" class="form-label text-white">Status van de auto</label>
                        <select class="form-select form-select-sm" id="status" required>
                            <option value="available" selected>Beschikbaar</option>
                            <option value="unavailable">Niet Beschikbaar</option>
                            <option value="rented">Verhuurd</option>
                        </select>
                    </div>
                </form>
        </div>
    </div>
</body>
</html>
