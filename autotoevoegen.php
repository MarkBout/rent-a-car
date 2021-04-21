<?php
include 'navbar.php';
if (!isset($_SESSION['gebruiker']) || $_SESSION['gebruiker']['rol'] != 1){
    $utilities->redirect('index.php');
}
if (isset($_GET['id'])){
    $auto = $database->getObject($connection,'auto',array('*'),"idauto=".$_GET['id']);
}
$prijzen = $database->getObject($connection,'prijs',array('*'));
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
                    <img class="col-4 ms-2" src="#" id="output" alt=""/>
                    <div class="ms-5 col-3">
                        <label for="naam" class="form-label text-white">Naam van de auto</label>
                        <input type="text" class="form-control" id="naam" name="auto[naam]" required>

                        <label for="kenteken" class="form-label text-white">Kenteken van de auto</label>
                        <input type="text" class="form-control" id="kenteken" name="auto[kenteken]" required>

                        <label for="status" class="form-label text-white">Status van de auto</label>
                        <select class="form-select form-select-sm" id="status" name="auto[status]" required>
                            <option value="available" selected>Beschikbaar</option>
                            <option value="unavailable">Niet Beschikbaar</option>
                            <option value="rented">Verhuurd</option>
                        </select>
                        <label for="afbeelding" class="form-label text-white">Afbeelding van de auto</label>
                        <input type="file" class="form-control" accept="image/*" onchange="loadFile(event)">
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-10">
                                <label for="prijs" class="form-label text-white">Prijs van de auto</label>
                                <select name="auto[prijs_idprijs]" id="prijs" class="form-select form-select-sm">
                                    <?php if (!empty($prijzen)){
                                        foreach ($prijzen as $prijs){
                                            echo "<option value='".$prijs['idprijs']."'>".$prijs['merk']." ".$prijs['type']." €".$prijs['dagprijs']."</option>";
                                        }
                                    }?>
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary rounded-pill" onclick="nieuwePrijs()">Nieuwe prijs</button>
                            </div>
                        </div>
                        <div id="newprice" class="row d-none">
                            <div class="col-4">
                                <label for="merk" class="form-label text-white">Merk auto</label>
                                <select class="form-select form-select-sm" id="merk" name="prijs[merk]" required>
                                    <?/**Todo haal merken en types uit db en zet erin**/ ?>
                                    <option selected value="toyota">Toyota</option>
                                </select>
                                <button type="button" class="btn btn-primary mt-2 rounded-pill">Prijs toevoegen</button>
                            </div>
                            <div class="col-4">
                                <label for="type" class="form-label text-white">Type auto</label>
                                <select class="form-select form-select-sm" id="type" name="prijs[type]" required>
                                    <?/**Todo haal merken en types uit db en zet erin**/ ?>
                                    <option selected value="toyota">Cabriolet</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="dagprijs" class="form-label text-white">Dagprijs</label>
                                <input type="text" class="form-control form-control-sm" id="dagprijs" name="prijs[dagprijs]">
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output');
                output.src = reader.result;
            };
           var test = reader.readAsDataURL(event.target.files[0]);
           console.log(test)
        };

        function nieuwePrijs() {
            var newprice = document.getElementById('newprice');
            newprice.classList.remove("d-none");
        }
    </script>
</body>
</html>
