<?php
session_start();
include 'GebruikDB.php';
include 'Utilities.php';
$utilities = new Utilities();
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
            $utilities->redirect('../index.php');
        }else{
            //insert new account
            $register['wachtwoord'] = password_hash($register['wachtwoord'],PASSWORD_DEFAULT);
            $database->makeObject($connection,$register,'gebruiker');
            $_SESSION['message']['class'] = 'alert alert-success';
            $_SESSION['message']['content'] = 'Account aangemaakt. U kunt nu inloggen';
            $utilities->redirect('../index.php');
            return $_SESSION['message'];
        }

    }else{
        $_SESSION['message']['class'] = 'alert alert-danger';
        $_SESSION['message']['content'] = 'kon geen account aanmaken';
        $utilities->redirect('../index.php');
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
                $utilities->redirect('../index.php');
                return $_SESSION['gebruiker'];
            }else{
                $_SESSION['message']['class'] = 'alert alert-warning';
                $_SESSION['message']['content'] = 'onjuist wachtwoord';
                $utilities->redirect('../index.php');
                return $_SESSION['message'];
            }
        }
        else{
            $stmt->close();
            $_SESSION['message']['class'] = 'alert alert-warning';
            $_SESSION['message']['content'] = 'onjuiste gebruikersnaam of wachtwoord';
            $utilities->redirect('../index.php');
            return $_SESSION['message'];
        }
    }
}

//handle profile changes
if (isset($_POST['profile']) && !empty($_POST['profile'])){
    $profile = $_POST['profile'];
    unset($_POST['profile']);
    if (empty($profile['tussenvoegsel']) || $profile['tussenvoegsel'] == '') unset($profile['tussenvoegsel']);
    if (!empty($profile['newpass']) || !$profile['newpass'] == ''){
        $profile['wachtwoord'] = password_hash($profile['newpass'],PASSWORD_DEFAULT);
        unset($profile['newpass']);
    }else{
        unset($profile['newpass']);
    }
    $database->makeObject($connection,$profile,'gebruiker');
    $_SESSION['message']['class'] = 'alert alert-success';
    $_SESSION['message']['content'] = 'Gegevens gewijzigd';
    $utilities->redirect($_SERVER['HTTP_REFERER']);
}

//Nieuwe auto toevoegen
if (isset($_POST['auto']) && !empty($_POST['auto'])) {
    //todo fix
    $car = $_POST['auto'];
    unset($_POST['auto']);
    if (isset($car['idauto'])) $car['idauto'] = (int) $car['idauto'];
    $car['idprijs'] = (int)$car['idprijs'];
    //kijken of er een afbeelding is geupload enzo ja maak hem klaar voor de DB en opslag
    $afbeelding = $_FILES['afbeelding'];
    if (!empty($afbeelding['name']) && $afbeelding['name'] != ''){
        $target = '../images/carImages/' . time() . $afbeelding['name'];
        move_uploaded_file($afbeelding['tmp_name'], $target);
        $car['afbeelding'] = substr($target, 3);
    }else{
        unset($car['afbeelding'], $afbeelding);
    }
    //update or make car
    if (isset($car['idauto'])){
        $database->updateObject($connection,$car,'auto');
    }else{
        $database->makeObject($connection,$car,'auto');
    }
    $utilities->redirect('../medewerkers.php');

}