<?php
include 'navbar.php';
if (!isset($_SESSION['gebruiker']) || $_SESSION['gebruiker']['rol'] != 1){
    $utilities->redirect('index.php');
}
if (isset($_GET['id'])){
    $auto = $database->getObject($connection,'auto',array('*'),"idauto=".$_GET['id']);
    if (count($auto) == 1) $auto = $auto[0];
}
$statusEnums = ['available' => 'beschikbaar', 'unavailable' => 'Niet Beschikbaar', 'rented' => 'verhuurd'];
$foo = array(0 => 'string');

$prijzen = $database->getObject($connection,'prijs',array('*'));

?>
<!doctype html>
<html lang="en">
<head>
    <title>Auto Beheer | Rent a Car</title>
</head>
<body class="bg-soft-white">
    <div class="container-fluid">
        <div class="container position-absolute primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
            <div class="row">
                <?php if (isset($auto)):
                    var_dump($auto);
                echo "<h1 class='text-center text-white'>".$auto['naam']." ".$auto['kenteken']." aanpassen</h1>";
                else:
                echo '<h1 class="text-center text-white">Nieuwe auto toevoegen</h1>';
                endif;?>
                <hr class="text-white">
            </div>
                <form action="lib/HandlePOST.php" method="post" enctype="multipart/form-data" class="row">
                    <?php if (isset($auto['idauto'])): echo "<input type='hidden' value='".$auto['idauto']."' name='auto[idauto]'>"; endif;?>
                    <img class="col-4 ms-2" <?php if (isset($auto['afbeelding'])):?>src="<?php echo $auto['afbeelding']?>"<?php endif;?> src="#" id="output" alt=""/>
                    <div class="ms-5 col-3">
                        <label for="naam" class="form-label text-white">Naam van de auto</label>
                        <input type="text" class="form-control" id="naam" name="auto[naam]" <?php if (isset($auto['naam'])):?>value="<?php echo $auto['naam']?>"<?php endif;?> required>

                        <label for="kenteken" class="form-label text-white">Kenteken van de auto</label>
                        <input type="text" class="form-control" id="kenteken" name="auto[kenteken]" <?php if (isset($auto['kenteken'])):?>value="<?php echo $auto['kenteken']?>"<?php endif;?> required>

                        <label for="status" class="form-label text-white">Status van de auto</label>
                        <select class="form-select form-select-sm" id="status" name="auto[status]" required>
                            <?php
                            foreach ($statusEnums as $key => $value){
                                if (isset($auto['status']) && $auto['status'] == $key){
                                    unset($key);
                                    echo '<option value="'.$auto['status'].'">'.$value.'</option>';
                                    continue;
                                }
                                echo '<option value="'.$key.'">'.$value.'</option>';
                            }

                            ?>
                        </select>
                        <label for="afbeelding" class="form-label text-white">Afbeelding van de auto</label>
                        <?php
                        if(!isset($auto['afbeelding'])):
                            echo '<input type="file" name="afbeelding" required class="form-control" accept="image/*" onchange="loadFile(event)">';
                        else:
                            echo '<input type="file" name="afbeelding" class="form-control" accept="image/*" onchange="loadFile(event)">';
                        endif;
                        ?>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-10">
                                <label for="prijs" class="form-label text-white">Merk, type & dagprijs auto</label>
                                <select name="auto[idprijs]" id="prijs" class="form-select form-select-sm" required>
                                    <option selected value="" disabled>kies een prijs</option>
                                    <?php
                                    foreach($prijzen as $prijs):
                                        if (isset($auto['idprijs']) && $auto['idprijs'] == $prijs['idprijs']){
                                            echo '<option selected value="'.$auto['idprijs'].'">'.$prijs['merk'].' '.$prijs['type'].' €'.$prijs['dagprijs'].'</option>';
                                            continue;
                                        }
                                        echo '<option value="'.$prijs['idprijs'].'">'.$prijs['merk'].' '.$prijs['type'].' €'.$prijs['dagprijs'].'</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary rounded-pill" onclick="nieuwePrijs()">Nieuwe prijs</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <label for="beschrijving" class="form-label text-white">Beschrijving</label>
                                <textarea class="form-control" id="beschrijving" rows="6    " name="auto[beschrijving]" ><?php if (isset($auto['beschrijving'])) echo $auto['beschrijving']?> </textarea>
                            </div>
                        </div>
                        <?/**todo make this into modal**/?>
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
                    <button type="submit" class="btn ms-auto me-2 col-3 btn-primary rounded-pill">Opslaan</button>
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