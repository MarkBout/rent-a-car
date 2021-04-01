<?php include 'modal.html'?>
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-50 h-75">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registreren | Rent a Car</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../lib/Account.php" method="post" autocomplete="off">
                    <label for="username">E-mail adres</label>
                    <input type="text" class="form-control" name="register[gebruikersnaam]" placeholder="Email" id="username" required="">
                    <label for="password">Wachtwoord</label>
                    <input type="password" class="form-control" name="register[wachtwoord]" placeholder="Password" id="password" required="">
                    <button class="btn btn-primary btn-lg mt-2 rounded-pill" type="submit" value="Registreer">Registreer</button>
                </form>
                <p class="mt-5 mb-3 text-muted">&copy; 2021 Mark Bout</p>
            </div>
        </div>
    </div>
</div>
