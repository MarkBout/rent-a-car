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
<div class="row position-absolute" style="top: 15%; left: 10%; right: 10%;">
            <div class="me-2 col-5 primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
                <div class="row">
                    <div class="col-8">
                        <h2 class="text-center text-white">Overzicht verhuurde auto's</h2>
                    </div>
                    <div class="col-3 mt-2">
                        <button type="button" class="btn btn-primary btn-lg rounded-pill">Printen</button>
                    </div>
                </div>
                <hr class="bg-white">
                <?php/**Todo get rented cars from DB and display them**/?>

            </div>
            <div class="ms-2 col-5 primary-colour " style=" height: auto;top: 15%; left: 10%; right: 10%; opacity: 0.9;">
                <div class="row">
                    <div class="col-7">
                        <h1 class="text-center text-white">Autobeheer</h1>
                    </div>
                    <div class="col-3 mt-2">
                        <a type="button" href="autoBeheer.php" class="btn btn-primary  rounded-pill">Auto toevoegen</a>
                    </div>
                </div>
                <hr class="bg-white">
                <div class="box">
                    <?php
                    if (isset($carlist) && !empty($carlist)) {
                        foreach ($carlist as $car) {
                            $temp = $database->getObject($connection,'prijs',array('type','dagprijs'),'idprijs='.(int)$car['idprijs']);
                            $car['type'] = $temp[0]['type'];
                            $car['dagprijs'] = $temp[0]['dagprijs'];
//                            echo '<div class="col-12  d-flex align-items-stretch">';
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
                                                            <p class="card-text col-12">Dagprijs: &#8364;'.$car['dagprijs'].'</p><br>
                                                            <form method="post" class="col-5" action="autoDetail.php">';
                            echo '<button type="submit" name="id" value="'.$car['idauto'].'" class="btn btn-primary text-white rounded-pill">Bekijken</button></form>
                                                            <div class="col-5"><a class="btn btn-primary text-white rounded-pill" href="autoBeheer.php?id='.$car['idauto'].'">Bewerken</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                        }
                    }
                    ?>
                </div>
            </div>
         </div>
    <script>
        function sendDownload(table_id, separator = ',') {
            // Select rows from table_id
            var rows = document.querySelectorAll('#' + table_id + ' tr');
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
            var filename = 'export_' + table_id + '_' + '{{ event.name }}' + '.csv';
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
