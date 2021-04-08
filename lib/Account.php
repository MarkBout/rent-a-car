<?php
session_start();
include 'GebruikDB.php';
$database = new GebruikDB();
//Setup DB connection
$connection = $database->setConn('localhost', 'root',null,'rent-a-car');

//recieve register form input and process it
if (isset($_POST['register']) && !empty($_POST['register'])){
    $register = $_POST['register'];
    unset($_POST['register']);
    $register['rol'] = 0;
    if (empty($register['tussenvoegsel']) || $register['tussenvoegsel'] == ''){unset($register['tussenvoegsel']);}

    if ($stmt = $connection->prepare('SELECT idgebruikers, wachtwoord FROM gebruiker WHERE gebruikersnaam = ?')){
        $stmt->bind_param('s', $register['gebruikersnaam']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0){
            $_SESSION['register']['message']['class'] = 'alert alert-warning';
            $_SESSION['register']['message']['content'] = 'gebruikersnaam '. $register['gebruikersnaam'] . ' is al in gebruik';
            $stmt->close();
            header("Location: ../index.php");
        }else{
            //insert new account
            $register['wachtwoord'] = password_hash($register['wachtwoord'],PASSWORD_DEFAULT);
            $database->makeObject($connection,$register,'gebruiker');
        }

    }else{
        $_SESSION['register']['message']['class'] = 'alert alert-danger';
        $_SESSION['register']['message']['content'] = 'kon geen account aanmaken';
        header("Location: ../index.php");
    }
}