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

    if (empty($register['tussenvoegsel']) || $register['tussenvoegsel'] == '') unset($register['tussenvoegsel']);
    if ($stmt = $connection->prepare('SELECT idgebruikers, wachtwoord FROM gebruiker WHERE gebruikersnaam = ?')){
        $stmt->bind_param('s', $register['gebruikersnaam']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0){
            $_SESSION['message']['class'] = 'alert alert-warning';
            $_SESSION['message']['content'] = 'gebruikersnaam '. $register['gebruikersnaam'] . ' is al in gebruik';
            $stmt->close();
            header("Location: ../index.php");
        }else{
            //insert new account
            $register['wachtwoord'] = password_hash($register['wachtwoord'],PASSWORD_DEFAULT);
            $database->makeObject($connection,$register,'gebruiker');
            $_SESSION['message']['class'] = 'alert alert-success';
            $_SESSION['message']['content'] = 'Account aangemaakt. U kunt nu inloggen';
            header("Location: ../index.php");
        }

    }else{
        $_SESSION['register']['message']['class'] = 'alert alert-danger';
        $_SESSION['register']['message']['content'] = 'kon geen account aanmaken';
        header("Location: ../index.php");
    }
}

//recieve login form input and process it
if (isset($_POST['login']) && !empty($_POST['login'])){
    $login = $_POST['login'];
    unset($_POST['login']);
    
}
