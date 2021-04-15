<?php
include 'modal.html';
?>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-50 h-75">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inloggen | Rent a Car</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-signin" method="post" action="../lib/Account.php">
                    <h1 class="h3 mb-3 font-weight-normal">Vul uw inloggegevens in</h1>
                    <label for="inputEmail" class="sr-only">Email adres</label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" name="login[gebruikersnaam]" autofocus="">
                    <label for="inputPassword" class="sr-only">Wachtwoord</label>
                    <input type="password" id="inputPassword" class="form-control" name="login[wachtwoord]" placeholder="Password" required="">
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary rounded-pill btn-block" type="submit">Inloggen</button>
                </form>
                <div class="signup-section">Nog geen account? <a href="" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#registerModal" class="text-info">registreer</a></div>
                <p class="mt-5 mb-3 text-muted">&copy; 2021 Mark Bout</p>
            </div>
        </div>
    </div>
</div>
