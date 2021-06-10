<?php include 'modal.html';?>
<div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-50 h-75">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Medewerker Aanmaken</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="lib/HandlePOST.php" method="post" autocomplete="off">
                    <label for="voornaam">Voornaam</label>
                    <input type="text" class="form-control" name="medewerker[voornaam]" id="voornaam" required>
                    <label for="tussenvoegsel">Tussenvoegsel</label>
                    <input type="text" class="form-control" name="medewerker[tussenvoegsel]" id="tussenvoegsel">
                    <label for="achternaam">Achternaam</label>
                    <input type="text" class="form-control" name="medewerker[achternaam]" id="achternaam">
                    <label for="password">Wachtwoord (<small style="color: red">bij eerste inlog aanpassen</small>) </label>
                    <input type="text" class="form-control" name="medewerker[wachtwoord]" placeholder="Password" id="password" required>
                    <button class="btn btn-success btn-lg mt-2 rounded-pill" type="submit" value="Registreer">Medewerker aanmaken</button>
                </form>
            </div>
        </div>
    </div>
</div>
