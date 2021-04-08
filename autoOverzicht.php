<?php include 'navbar.php';
include_once 'lib/Utilities.php';
$utilities = new Utilities();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Auto overzicht</title>
</head>
<body class="bg-soft-white">
    <div class="container-fluid">
        <div class="container position-absolute primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
            <h1 class="h1 text-center mt-3 text-white">Auto Overzicht</h1>
             <div class="col-12" style="max-width: 100%">
                <div class="row">
                    <?php
                        if (isset($testData)) {
                            foreach ($testData as $car) {
                                echo '<div class="col-6">';
                                echo $utilities->generateTemplate('cards/auto.php', $car);
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
