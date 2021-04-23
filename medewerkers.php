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
    <div class="container-fluid">
        <div class="row position-absolute" style="top: 15%; left: 10%; right: 10%;">
            <div class="me-2 col-5 primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
                <div class="row">
                    <div class="col-8">
                        <h1 class="text-center text-white">Overzicht verhuurde auto's</h1>
                    </div>
                    <div class="col-3 mt-2">
                        <button type="button" class="btn btn-primary btn-lg rounded-pill">Printen</button>
                    </div>
                </div>
                <hr class="bg-white">
                <?php/**Todo get rented cars from DB and display them**/?>

            </div>
            <div class="ms-2 col-5 primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9;">
                <div class="row">
                    <div class="col-7">
                        <h1 class="text-center text-white">Autobeheer</h1>
                    </div>
                    <div class="col-3 mt-2">
                        <a type="button" href="autoBeheer.php" class="btn btn-primary  rounded-pill">Auto toevoegen</a>
                    </div>
                </div>
                <hr class="bg-white">
                <div class=" overflow-scroll">
                    <?php
                    if (isset($carlist) && !empty($carlist)) {
                        foreach ($carlist as $car) {
                           $temp = $database->getObject($connection,'prijs',array('type','dagprijs'),'idprijs='.(int)$car['idprijs']);
                            $car['type'] = $temp[0]['type'];
                            $car['dagprijs'] = $temp[0]['dagprijs'];
                            echo $utilities->generateTemplate('cards/auto.php', $car);
                        }
                    }
                    ?>
                </div>
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
