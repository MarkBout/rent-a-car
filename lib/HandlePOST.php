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
    $car['beschrijving'] = $connection->escape_string($car['beschrijving']);
    //update or make car
    if (isset($car['idauto'])){
        $database->updateObject($connection,$car,'auto','idauto');
    }else{
        $database->makeObject($connection,$car,'auto');
    }
    $utilities->redirect('../medewerkers.php');
}

//prijs toevoegen
if (isset($_POST['newprice']) && !empty($_POST['newprice'])){
    $newprice = $_POST['newprice'];
    unset($_POST['newprice']);
    $newprice['dagprijs'] = (int)$newprice['dagprijs'];
    $database->makeObject($connection,$newprice,'prijs');
    $utilities->redirect('../autoBeheer.php');
}

//een bestelling maken
if (isset($_POST['bestelling']) && !empty($_POST['bestelling'])){
    $bestelling = $_POST['bestelling'];
    unset($_POST['bestelling']);
    $bestelling['idauto'] = (int)$bestelling['idauto'];
    $bestelling['idgebruikers'] = (int)$bestelling['idgebruikers'];
    $bestelling['totaalprijs'] = (int)$bestelling['totaalprijs'];

    $bestelling['begindatum'] = date("Y-m-d",strtotime($bestelling['begindatum']));
    $bestelling['einddatum'] = date("Y-m-d",strtotime($bestelling['einddatum']));
    if (empty($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    array_push($_SESSION['cart'],$bestelling);
    $utilities->redirect('../winkelwagen');
}

//remove order from cart
if (isset($_POST['delete']) && !empty($_POST['delete'])){

    $sleutel = (int)$_POST['delete']['key'];
    unset($_POST['delete']);
    unset($_SESSION['cart'][$sleutel]);
    $utilities->redirect('../winkelwagen.php');
}

//bestelling afronden
if (isset($_POST['finishOrder']) && !empty($_POST['finishOrder'])){
    $orderKey = $_POST['finishOrder']['key'];
    unset($_POST['finishOrder']);
    //factuur aanmaken
    $factuur = array();
    $factuur['datum'] = date("Y-m-d");
    $factuur['betaald'] = 0;
    //bestelling ophalen
    $order = $_SESSION['cart'][$orderKey];
    unset($order['totaalprijs']);
    //bestelling & factuur opslaan
    $order['idfactuur'] = $database->makeObject($connection,$factuur,'factuur');
    $database->makeObject($connection,$order,'bestelling');
    //bestelling uit winkelmand halen & de auto op verhuurd zetten
    unset($_SESSION['cart'][$orderKey]);
    $auto = $database->getObject($connection,'auto',array('*'),'idauto='.$order['idauto'])[0];
    $auto['status'] = 'rented';
    $database->updateObject($connection,$auto,'auto', 'idauto');
    $utilities->redirect('../Profiel.php');
}

//een auto zoeken todo: Finish this
if (isset($_POST['search']) && !empty($_POST['search'])){
    $search = $_POST['search'];
    unset($_POST['search']);
    var_dump($search);die;
}

//medewerker verwijderen
if (isset($_POST['deleteEmployee']) && !empty($_POST['deleteEmployee'])){
    $empoyeeID = (int)$_POST['deleteEmployee'];
    unset($_POST['deleteEmployee']);

}
