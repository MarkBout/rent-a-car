<?php include 'navbar.php'; ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Contact</title>
    </head>
    <body class="bg-soft-white">
        <div class="container-fluid">
            <div class="position-absolute top-50 start-50 translate-middle w-75 h-75">
                <div class="container w-100">
                    <div class="row mt-4 mb-5 h-75 w-100">
                          <div class="col-6 mt-2">
                              <iframe class="rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2452.9532069115153!2d4.540967615997738!3d52.06237567779397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5cf02887bc127%3A0xfe3f04516e881de!2sMaasstroom%2C%202721%20BA%20Zoetermeer!5e0!3m2!1snl!2snl!4v1617265588290!5m2!1snl!2snl" style="position: relative; height: 100%; width: 100%; border: none; padding: 0" allowfullscreen="" loading="lazy"></iframe>
                          </div>

                          <div class="col-6">
                              <div class="primary-colour mt-2 h-100 w-100" style="opacity: 0.9">
                                  <h1 class="text-center pt-2 text-white">Kom in contact met Rent a Car</h1>
                                  <div class="row h-50">
                                      <ul class="col-6 h-75 ms-5 mt-3" style="font-size: 38px; list-style: none">
                                          <li class="text-white m-0">Rent a Car</li>
                                          <li class="text-white m-0">Maasstroom 198</li>
                                          <li class="text-white m-0">Zoetermeer</li>
                                          <li class="text-white m-0" style="font-size: 22pt">2721 BA Zuid-Holland</li>
                                      </ul>
                                      <ul class="col-5 h-75 mt-3" style="font-size: 38px; list-style: none">
                                          <li class="text-white m-0">Telefoon</li>
                                          <li class="text-white m-0">06-89621674</li>
                                          <li class="text-white m-0">Email</li>
                                          <li class="text-white m-0" style="font-size: 20px">klantenservice@rent-a-car.nl</li>
                                      </ul>
                                  </div>
                                  <div class="row mt-5 ms-5">
                                      <a class="btn btn-lg btn-primary rounded-pill ms-5 w-75 text-white" data-bs-toggle="modal" data-bs-target="#contactModal">Contactformulier</a>
                                  </div>
                              </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<!-- Modal -->


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
