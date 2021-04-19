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
        //als er een result terugkomt bestaad er al een account met die gebruikersnaam dus maken we een bericht en sturen de user terug
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
            return $_SESSION['message'];
        }

    }else{
        $_SESSION['message']['class'] = 'alert alert-danger';
        $_SESSION['message']['content'] = 'kon geen account aanmaken';
        header("Location: ../index.php");
        return $_SESSION['message'];
    }
}

//recieve login form input and process it
if (isset($_POST['login']) && !empty($_POST['login'])){
    $login = $_POST['login'];
    unset($_POST['login']);

    if ($stmt = $connection->prepare('SELECT idgebruikers, wachtwoord FROM gebruiker WHERE gebruikersnaam = ?')){
        $stmt->bind_param('s',$login['gebruikersnaam']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();
            //kijken of wachtwoord klopt en als dit zo is de accountgegevens ophalen
            if (password_verify($login['wachtwoord'], $password)){
                $query = "SELECT * FROM gebruiker WHERE idgebruikers = ".$id;
                $result = $connection->query($query);
                $_SESSION['gebruiker'] = [];
                while($row = $result->fetch_assoc()) {
                    $_SESSION['gebruiker'] = $row;
                }
                header('location: ../index.php');
                return $_SESSION['gebruiker'];
            }else{
                $_SESSION['message']['class'] = 'alert alert-warning';
                $_SESSION['message']['content'] = 'onjuist wachtwoord';
                header('location: ../index.php');
                return $_SESSION['message'];
            }
        }
        else{
            $stmt->close();
            $_SESSION['message']['class'] = 'alert alert-warning';
            $_SESSION['message']['content'] = 'onjuiste gebruikersnaam of wachtwoord';
            header('location: ../index.php');
            return $_SESSION['message'];
        }
    }
}

//handle profile changes
if (isset($_POST['profile']) && !empty($_POST['profile'])){
    $profile = $_POST['profile'];
    unset($_POST['profile']);
}