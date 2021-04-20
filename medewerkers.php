<?php
include 'navbar.php';
if (!isset($_SESSION['gebruiker']) || $_SESSION['gebruiker']['rol'] != 1){
    $utilities->redirect('index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Medewerkers | Rent a Car</title>
</head>
<body>

</body>
</html>
