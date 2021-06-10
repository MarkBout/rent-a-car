<?php
include 'navbar.php';
//id ophalen uit bekijken knop
if (isset($_POST['id']) && !empty($_POST['id'])){
    $id = (int)$_POST['id'];
}elseif (isset($_GET['id']) && !empty($_GET['id'])) $id = (int)$_GET['id'];
//check if car exists
if ($stmt = $connection->prepare('SELECT idauto FROM auto WHERE idauto = ?')){
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows != 1):
        echo '<script>alert("Er is iets mis gegaan met het laden van deze auto") </script>';
        $utilities->redirect('autoOverzicht.php');
    else:
        $auto = $database->getObject($connection,'auto',array('*'),'idauto='.$id)[0];
        $auto['prijs'] = $database->getObject($connection,'prijs',array('*'),'idprijs='.$auto['idprijs'])[0]
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <title><?php echo $auto['naam']?></title>
        </head>
        <body class="bg-soft-white">
        <div class="container-fluid">
            <div class="container position-absolute primary-colour pb-2 pt-2" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
                <div class="row">
                    <img class="col-4" style="max-height: 100%" <?php if (isset($auto['afbeelding'])):?>src="<?php echo $auto['afbeelding']?>"<?php endif;?> src="#" id="output" alt=""/>
                    <div class="col-4">
                        <h2 class="text-white"><?php echo $auto['naam'];?></h2>
                        <p class="text-white text-start"><?php echo $auto['beschrijving'];?></p>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Deze auto huren</h5>
                                <p class="m-0">Merk auto: <?php echo $auto['prijs']['merk']?></p>
                                <p class="m-0">Type auto: <?php echo $auto['prijs']['type']?></p>
                                <p id="dagprijs">Dagprijs auto: €<?php echo $auto['prijs']['dagprijs']?></p>
                                <?php if (isset($_SESSION['gebruiker'])): ?>
                                <form action="lib/HandlePOST.php" method="post">
                                    <input type="hidden" name="bestelling[idauto]" value="<?php echo $id?>">
                                    <input type="hidden" name="bestelling[idgebruikers]" value="<?php echo $_SESSION['gebruiker']['idgebruikers']?>">
                                    <input type="hidden" id="totaalprijs" name="bestelling[totaalprijs]" value="">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="begindatum">Datum ophalen</label>
                                            <input type="date" id="begindatum" name="bestelling[begindatum]" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                        <div class="col-6">
                                            <label for="einddatum">Datum terugbregen</label>
                                            <input type="date" id="einddatum" name="bestelling[einddatum]" class="form-control" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                    <button type="button" class="mt-1 mb-1 btn btn-success btn-sm" style="word-break: break-word" onclick="checkOut()" <?php if ($auto['status'] === 'rented'):?> disabled<?php endif;?>>Datum controleren en prijs berekenen</button>
                                    <div id="prijzen">

                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" id="huren" value="" class="btn btn-primary text-white rounded-pill" disabled>in winkelmand</button>
                                        <?php if ($auto['status'] === 'rented') echo '<br>U kunt geen verhuurde auto\'s huren'; ?>
                                    </div>
                                </form>
                                <?php else: ?>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary btn-sm text-white rounded-pill">U moet inloggen voordat u een bestelling kunt plaatsen</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>

            function checkOut() {
                var start_date = document.getElementById('begindatum').value;
                var end_date = document.getElementById('einddatum').value;
               const days =  Math.floor(( Date.parse(end_date) - Date.parse(start_date) ) / 86400000) + 1;
               const dagenp = document.createElement('p');
               dagenp.innerHTML = "Gekozen dagen "+ days;
               dagenp.setAttribute('class','m-0');
               document.getElementById('prijzen').appendChild(dagenp);
               dagprijs = <?php echo $auto['prijs']['dagprijs'];?>;
               totaalprijs = dagprijs * days;
               const totaalp = document.createElement('p');
               if (days < 2){
                   totaalprijs = dagprijs;
               }
               totaalp.innerHTML = "Totaalprijs €"+totaalprijs;
               totaalp.setAttribute('class','m-0');
               document.getElementById('prijzen').appendChild(totaalp);
               document.getElementById('totaalprijs').value = totaalprijs;
               document.getElementById('huren').disabled = false;
            }
        </script>
        </body>
        </html>
<?php
endif;
}
?>