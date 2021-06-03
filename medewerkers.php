<?php
include 'navbar.php';
include 'modals/deleteEmployee.php';
if (!isset($_SESSION['gebruiker']) || $_SESSION['gebruiker']['rol'] != 1){
    $utilities->redirect('index.php');
}
$carlist = $database->getObject($connection,'auto',array('*'));
$rentedCars = $database->getObject($connection, 'auto',array('*'),'status="rented"');
//costum query used to prevent the collection of deleted employees, stuff like the name needs to remain so that orders don't break
// but deleted employees (and users) won't have either a username or a password
$employeeQuery = 'SELECT idgebruikers,voornaam,tussenvoegsel,achternaam,gebruikersnaam FROM gebruiker WHERE gebruikersnaam IS NOT NULL AND rol = 1;';
$employees = $database->getObject($connection,null,array(null),null,$employeeQuery);
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
                <button class="nav-link btn-primary" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#beheer" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Beheer</button>
                <button class="nav-link btn-primary" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#verhuurd" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Verhuurd</button>
                <?php //if ($_SESSION['gebruiker']['gebruikersnaam'] === 'directie@rent-a-car.nl'): ?>
                <button class="nav-link active btn-primary" id="nav-directie-tab" data-bs-toggle="tab" data-bs-target="#directie" type="button" role="tab" aria-controls="nav-directie" aria-selected="false">Directie</button>
                <?php //endif;?>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade " id="beheer" role="tabpanel" aria-labelledby="nav-home-tab">
                <BUTTON class="btn btn-primary mt-1 mb-1" style="display: flex;left: 10%"><a style="color: white; text-decoration: none" href="autoBeheer.php">Auto toevoegen</a></BUTTON>
                <table class="table text-center text-white" id="management">
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
                <a class="btn btn-primary mt-1 mb-1 text-white" onclick="sendDownload('rentendCars')">Print lijst</a>
                <table class="table table-image text-white" id="rentendCars" border="1">
                    <thead>
                    <tr class="text-start">
                        <th scope="col">Naam</th>
                        <th scope="col">Kenteken</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Huurder</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rentedCars as $car):
                        $huurder = $database->getObject($connection,'bestelling',array('idgebruikers','begindatum','einddatum'),'idauto='.$car['idauto'])[0];
                        $huurderGegevens = $database->getObject($connection,'gebruiker', array('voornaam','tussenvoegsel','achternaam'), 'idgebruikers='.(int)$huurder['idgebruikers'])[0];
                        ?>
                        <tr>
                            <td><?php echo $car['naam'] ?></td>
                            <td><?php echo $car['kenteken']?></td>
                            <td><p class="text-start text-nowrap"><?php  echo date("d/m/Y", strtotime($huurder['begindatum'])).' - '.date("d/m/Y", strtotime($huurder['einddatum'])); ?></p></td>
                            <td colspan="2"><?php echo $huurderGegevens['voornaam'].' '.$huurderGegevens['tussenvoegsel'].' '.$huurderGegevens['achternaam'];?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade show active" id="directie" role="tabpanel" aria-labelledby="nav-directie-tab">
                <button class="btn btn-primary mt-1 mb-1">Medewerkers toevoegen</button>
                <div class="container">
                    <table class="table table-image text-white" id="employees" border="1">
                        <thead>
                        <tr class="text-start">
                            <th scope="col">Naam</th>
                            <th scope="col">Gebruikersnaam</th>
                            <th scope="col">Opties</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($employees as $employee):?>
                            <tr>
                                <td><?php echo $employee['voornaam'].' '.$employee['tussenvoegsel'].' '.$employee['achternaam']?></td>
                                <td><?php echo $employee['gebruikersnaam']?></td>
                                <td>
                                    <button data-id="<?php echo $employee['idgebruikers']?>" class="btn btn-danger" id="delemployee" data-bs-toggle="modal" data-bs-target="#deleteemployeeModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
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
        $(document).on("click", "#delemployee", function () {
            var myBookId = $(this).data('id');
            $(".modal-footer #employeeId").val( myBookId );

        });
    </script>
</body>
</html>
