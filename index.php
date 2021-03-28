<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rent a car</title>
</head>
<body>
<?php
include_once '../lib/GebruikDB.php';
//include 'navbar.php';
$database = new GebruikDB();

$connection = $database->setConn('localhost:3306','root', null,'rent-a-car');

if ($connection->ping()){
    echo 'connection available'.'<br><br>';
    echo '<b>list of tables</b> <br>';
    $result = $connection->query('show tables');
    while ($table = mysqli_fetch_array($result)){
        echo $table[0]. '<br>';
    }
}else{
    echo 'no connection';
}
 echo 'ik werk :)';

?>
</body>
</html>