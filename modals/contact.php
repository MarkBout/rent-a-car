<?php include 'modal.html';?>
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Neem contact op met ons!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Naam</label>
                        <input type="text" class="form-control" id="name" name="contact[name]">
                    </div>
                    <div class="mb-3">
                        <label for="Email1" class="form-label">Email adres</label>
                        <input type="email" class="form-control" id="Email1" name="contact[email]" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We zullen uw gegevens nooit met iemand delen</div>
                    </div>
                    <div class="mb-3">
                        <label for="bericht" class="form-label">Uw bericht</label>
                        <textarea name="contact[message]" rows="3" cols="5" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                <button type="submit" class="btn btn-primary">Verstuur</button>
            </div>
        </div>
    </div>
</div>
