<?php include 'modal.html'?>
<div class="modal fade" id="deleteemployeeModal" aria-hidden="true" aria-labelledby="employeeModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Verwijder Medewerker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                U staat op het punt deze medewerker te verwijderen.<br>
                Deze actie is <b>onomkeerbaar</b> weet u zeker dat u deze medewerker wilt verwijderen?
            </div>
            <div class="modal-footer">
                <form method="post" action="lib/HandlePOST.php">
                    <button type="submit" class="btn btn-danger" name="deleteEmployee" id="employeeId" value="">Verwijder</button>
                </form>
            </div>
        </div>
    </div>
</div>