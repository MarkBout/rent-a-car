<?php
include 'navbar.php';
include_once 'lib/Utilities.php';
$utilities = new Utilities();
if (!isset($_SESSION['gebruiker'])) $utilities->redirect('../index.php');
$gebruiker = $_SESSION['gebruiker'];
?>
<!doctype html>
<html lang="en">
<head>
    <title>Profiel</title>
</head>
<body>

</body>
</html>
