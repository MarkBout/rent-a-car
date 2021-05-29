<?php
include 'navbar.php';
if (!isset($_SESSION['gebruiker']) || $_SESSION['gebruiker']['rol'] != 1){
    $utilities->redirect('index.php');
}
$carlist = $database->getObject($connection,'auto',array('*'));

?>
<!doctype html>
<html lang="en">
<head>
    <title>Medewerkers | Rent a Car</title>
</head>
<body class="bg-soft-white">
    <div class="row position-absolute primary-colour" style="top: 15%; left: 10%; right: 10%;">
        <h1 class="text-center text-white">Medewerkerspagina</h1>
        <nav>
            <div class="nav nav-tabs mt-1" id="nav-tab" role="tablist" style="display: flex; justify-content: center; align-items: center;">
                <button class="nav-link active btn-primary" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#beheer" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Beheer</button>
                <button class="nav-link btn-primary" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#verhuurd" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Verhuurd</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="beheer" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table text-center text-white" id="management" border="1">
                    <thead>
                    <tr>
                        <th scope="col">Afbeelding</th>
                        <th scope="col">Naam</th>
                        <th scope="col">Kenteken</th>
                        <th scope="col">Beschrijving</th>
                        <th scope="col">Status</th>
                        <th scope="col">Dagprijs</th>
                        <th scope="col">Opties</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($carlist as $car):
                        $temp = $database->getObject($connection,'prijs',array('type','dagprijs'),'idprijs='.(int)$car['idprijs'])[0];
                        $car['dagprijs'] = $temp['dagprijs'];
                        ?>
                        <tr>
                            <td><img style="max-width:90%; max-height:90%;" src="<?php echo $car['afbeelding']?>" alt="foto van auto"> </td>
                            <td><?php echo $car['naam'] ?></td>
                            <td><?php echo $car['kenteken']?></td>
                            <td><p class="text-start"><?php echo $car['beschrijving']?></p></td>
                            <td><?php echo $car['status']?></td>
                            <td>&euro;<?php echo $car['dagprijs']?></td>
                            <td>
                                <button class="mb-1 btn btn-primary rounded-pill">
                                    <a class="text-white" style="text-decoration: none !important" href="autoBeheer.php?id=<?php echo $car['idauto']?>">Bewerken</a>
                                </button>
                                <a class="mt-1 btn btn-primary rounded-pill" href="autoDetail.php?id=<?php echo $car['idauto']?>">Bekijken</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


            <div class="tab-pane fade" id="verhuurd" role="tabpanel" aria-labelledby="nav-profile-tab">
                <?php
                $rentedCars = $database->getObject($connection, 'auto',array('*'),'status="rented"');
                ?>
                <table class="table text-center text-white" id="rentendCars" border="1">
                    <thead>
                    <tr>
                        <th scope="col">Afbeelding</th>
                        <th scope="col">Naam</th>
                        <th scope="col">Kenteken</th>
                        <th scope="col">Beschrijving</th>
                        <th scope="col">Huurder</th>
                        <th scope="col"><a class="btn btn-primary btn-md rounded-pill" onclick="sendDownload('rentendCars')">Print</a> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rentedCars as $car):
                        $huurder = $database->getObject($connection,'bestelling',array('idgebruikers'),'idauto='.$car['idauto'])[0];
                        $huurderGegevens = $database->getObject($connection,'gebruiker', array('voornaam','tussenvoegsel','achternaam'), 'idgebruikers='.(int)$huurder['idgebruikers'])[0];
                        ?>
                        <tr>
                            <td><img style="max-width:50%; max-height:50%;" src="<?php echo $car['afbeelding']?>" alt="foto van auto"> </td>
                            <td><?php echo $car['naam'] ?></td>
                            <td><?php echo $car['kenteken']?></td>
                            <td><p class="text-start"><?php echo $car['beschrijving']?></p></td>
                            <td><?php echo $huurderGegevens['voornaam'].' '.$huurderGegevens['tussenvoegsel'].' '.$huurderGegevens['achternaam'];?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function sendDownload(table_id, separator = ',') {
            // Select rows from table_id
            var rows = document.querySelectorAll('table#' + table_id + ' tr');
            // Construct csv
            var csv = [];
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll('td, th');
                for (var j = 0; j < cols.length; j++) {
                    // Clean innertext to remove multiple spaces and jumpline (break csv)
                    var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
                    // Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
                    data = data.replace(/"/g, '""');
                    // Push escaped string
                    row.push('"' + data + '"');
                }
                csv.push(row.join(separator));
            }
            var csv_string = csv.join('\n');
            // Download it
            var filename = 'export_' + table_id + '_' + new Date().toLocaleDateString() + '.csv';
            var link = document.createElement('a');
            link.style.display = 'none';
            link.setAttribute('target', '_blank');
            link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>
