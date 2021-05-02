<?php
include 'navbar.php';

?>
<!doctype html>
<html lang="en">
<head>
    <title>Winkelwagen</title>
</head>
<body class="bg-soft-white">
    <div class="container-fluid">
        <div class="container position-absolute primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
            <h1 class="text-center text-white">Uw winkelwagen</h1>
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <table class="table text-center text-white" border="1">
                <thead>
                <tr>
                    <th scope="col">Auto</th>
                    <th scope="col">Klant</th>
                    <th scope="col">Ophaaldatum</th>
                    <th scope="col">Inleverdatum</th>
                    <th scope="col">Prijs</th>
                    <th scope="col">Opties</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $key => $bestelling):
                        $bestelling['auto'] = $database->getObject($connection,'auto', array('idauto','naam','kenteken','status'),'idauto='.$bestelling['idauto'])[0];
                        $bestelling['klant'] = $_SESSION['gebruiker'];
                        ?>
                    <tr>
                        <th><?php echo $bestelling['auto']['naam'].'<br>'.$bestelling['auto']['kenteken'] ?></th>
                        <td><?php echo $bestelling['klant']['voornaam'].' '.$bestelling['klant']['tussenvoegsel'].' '.$bestelling['klant']['achternaam']?></td>
                        <td><?php echo $bestelling['begindatum'] ?></td>
                        <td><?php echo $bestelling['einddatum']?></td>
                        <td>&euro;<?php echo $bestelling['totaalprijs']?></td>
                        <td>
                            <form method="post" action="lib/HandlePOST.php">
                            <button type="submit" name="delete[key]" value="<?php echo $key ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Verwijder uit mand">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                            <button type="submit" value="<?php echo $key ?>" name="finishOrder[key]" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Afronden en naar factuur">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                            </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p class="text-white text-center">U heeft nog niks in uw winkelwagen. Zoek <a href="autoOverzicht.php">hier</a> naar een mooie auto</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
<?php