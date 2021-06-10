<?php include 'modal.html'?>
<div class="modal fade" id="deletecarModal" aria-hidden="true" aria-labelledby="carModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Verwijder Auto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                U staat op het punt deze auto te verwijderen.<br>
                Deze actie is <b>onomkeerbaar</b> weet u zeker dat u deze auto wilt verwijderen?
            </div>
            <div class="modal-footer">
                <form method="post" action="lib/HandlePOST.php">
                    <button type="submit" class="btn btn-danger" name="deletecar" id="carId" value="">Verwijder</button>
                </form>
            </div>
        </div>
    </div>
</div>