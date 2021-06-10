<?php include 'navbar.php'; ?>
    <!doctype html>
    <html lang="en">
    <head>
        <title>Contact</title>
    </head>
    <body class="bg-soft-white">
    <div class="container-fluid">
        <div class="position-absolute top-50 start-50 translate-middle w-75 h-75">
            <div class="container w-100">
                <div class="row mt-4 mb-5 h-75 w-100">
                    <div class="col-6 mt-2">
                        <iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Jan%20Campertstraat%2099+(Rent%20a%20car)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" width="100%" height="600" frameborder="0" style="position: relative; height: 100%; width: 100%; border: none; padding: 0"></iframe>
                    </div>

                    <div class="col-6">
                        <div class="primary-colour mt-2 h-100 w-100" style="opacity: 0.9">
                            <h1 class="text-center pt-2 text-white">Kom in contact met Rent a Car</h1>
                            <div class="row h-50">
                                <!--?/*@todo change this to col-12 table to make responsive*/ ?-->
                                <div class="col-5 ms-5" style="font-size: 22px">
                                    <p class="text-white text-start">Rent a Car</p>
                                    <p class="text-white text-start">Autopad 12</p>
                                    <p class="text-white text-start">Almere
                                    </p><p class="text-white text-start">1321 RP Almere</p>
                                </div>
                                <div class="col-5 me-1" style="font-size: 22px">
                                    <p class="text-start text-white">Telefoon</p>
                                    <p class="text-start text-white">036-1234567</p>
                                    <p class="text-start text-white">Email</p>
                                    <p class="text-start text-white" style="white-space: nowrap">klantenservice@rent-a-car.nl</p>
                                </div>
                            </div>
                            <div class="row ms-5">
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
<?php include 'modals/contact.php';
