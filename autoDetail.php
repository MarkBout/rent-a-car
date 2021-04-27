<?php
include 'navbar.php';
//id ophalen uit bekijken knop
if (isset($_POST['id']) && !empty($_POST['id']))
    $id = (int)$_POST['id'];
//check if car exists
if ($stmt = $connection->prepare('SELECT idauto FROM auto WHERE idauto = ?')){
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows != 1):
        echo '<script>alert("Er is iets mis gegaan met het laden van deze auto") </script>';
        $utilities->redirect('autoOverzicht.php');
    else:
        $auto = $database->getObject($connection,'auto',array('*'),'idauto='.$id)[0];
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <title><?php echo $auto['naam']?></title>
        </head>
        <body class="bg-soft-white">
        <div class="container-fluid">
            <div class="container position-absolute primary-colour" style="top: 15%; left: 10%; right: 10%; opacity: 0.9">
                <div class="row">
                    <img class="col-4 m-3 img-thumbnail" <?php if (isset($auto['afbeelding'])):?>src="<?php echo $auto['afbeelding']?>"<?php endif;?> src="#" id="output" alt=""/>
                    <div class="col-4">
                        <h2 class="text-white"><?php echo $auto['naam']; echo count($auto);?></h2>
                        <p class="text-white text-start"><?php echo $auto['beschrijving']?></p>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>
<?php
endif;
}
?>