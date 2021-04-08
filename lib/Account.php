<?php
include 'GebruikDB.php';
$database = new GebruikDB();
//Setup DB connection
$connection = $database->setConn('localhost', 'root',null,'sys');

//
if (isset($_POST['register']) && !empty($_POST['register'])){
    $register = $_POST['register'];
    unset($_POST['register']);
    $register['rol'] = 0;
    $database->saveObject($connection,$register,'gebruiker');
}