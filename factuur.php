<?php
include 'lib/HandlePOST.php';
if (!isset($_SESSION['gebruiker']) || !isset($_GET['idfactuur'])){
    $utilities->redirect($_SERVER['HTTP_REFERER']);
}else {
    //array opbowen voor de factuur
    $gebruiker = $_SESSION['gebruiker'];
    $factuur = $database->getObject($connection,'factuur',array('*'),'idfactuur='.$_GET['idfactuur'])[0];
    $factuur['bestelling'] = $database->getObject($connection,'bestelling',array('*'),'idfactuur='.$factuur['idfactuur'])[0];
    $factuur['bestelling']['auto'] = $database->getObject($connection,'auto',array('naam','kenteken','idprijs'),'idauto='.$factuur['bestelling']['idauto'])[0];
    $factuur['bestelling']['auto']['prijs'] = $database->getObject($connection,'prijs',array('merk','type','dagprijs'),'idprijs='.$factuur['bestelling']['auto']['idprijs'])[0];
    unset($factuur['bestelling']['idauto'],$factuur['bestelling']['auto']['idprijs']);
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="lib/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js" integrity="sha512-VKjwFVu/mmKGk0Z0BxgDzmn10e590qk3ou/jkmRugAkSTMSIRkd4nEnk+n7r5WBbJquusQEQjBidrBD3IQQISQ==" crossorigin="anonymous"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>>
    <title>Document</title>
</head>
<body>
<div id="content"  style="background-color: white; width: 100%">
    <div class="row">
        <div class="col-3">
            <img style="right: 100%" src="images/logo.png" alt="logo">
            <p><b>Rent-a-Car</b></p>
            <p>Autopad 12</p>
        </div>
        <div style="float: right">
            <p>1335 YY&nbsp;ALMERE</p>
            <p>Telefoon: (036) 123 45 67</p>
            <br>
            <p><b>Factuurinfo</b></p>
            <p>Datum: <?php echo date('d-m-Y',strtotime($factuur['datum'])) ?></p>
            <p>Factuurnummer <?php echo $factuur['idfactuur']?></p>
        </div>
        <div class="row">
            <div class="col-5">
                <p><b>Uw bestelling</b></p>
                <table>
                    <tr>
                        <th>kenteken</th>
                        <th>Merk</th>
                        <th>Type</th>
                        <th>Gereserveerde periode</th>
                        <th>prijs per dag</th>
                        <th>Totaal</th>
                    </tr>
                    <tr>
                        <td><?php echo $factuur['bestelling']['auto']['kenteken']?>&nbsp;</td>
                        <td><?php echo $factuur['bestelling']['auto']['prijs']['merk']?>&nbsp;</td>
                        <td><?php echo $factuur['bestelling']['auto']['prijs']['type']?>&nbsp;</td>
                        <td><?php echo date("d/m/Y", strtotime($factuur['bestelling']['begindatum'])).' - '.date("d/m/Y", strtotime($factuur['bestelling']['einddatum']));?></td>
                        <td>€<?php echo $factuur['bestelling']['auto']['prijs']['dagprijs']?></td>
                        <td>€<?php echo $totaalprijs = $factuur['bestelling']['auto']['prijs']['dagprijs'] * $utilities->dateDifference($factuur['bestelling']['begindatum'],$factuur['bestelling']['einddatum'],'days')?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><b>BTW:</b> </td>
                        <td>€<?php echo $tax = (21 / 100) * $totaalprijs;?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><b>Totaal te betaalen:</b> </td>
                        <td>€<?php echo $totaalprijs + $tax?></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row col-3">
            <p style="text-align: justify">Betalingen dienen plaats te vinden veertien dagen voor de aanvang van de gereserveerde periode
                op rekeningnummer 3210808 ten name van het Rent-a-Car te Almere. Indien er gereserveerd is
                binnen veertien dagen voor de aanvang van de gereserveerde periode, dient de betaling direct plaats
                te vinden.</p>
        </div>
    </div>

</div>

<script>
    $( window ).on( "load", PdfFromHTML());
    setTimeout(function() {
        window.location.href = '<?php echo $_SERVER['HTTP_REFERER']?>' ;
    }, 60);

    function PdfFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        source = $('#content')[0];

        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            right: 500,
            width: 600
        };
        pdf.addHTML(
            source, // HTML string or DOM elem ref.
            margins.left,
            margins.top, {
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                pdf.save('bestelling-'+'<?php echo $factuur['datum'];?>'+'.pdf');
            }, margins
        );
    }
</script>
</body>
</html>