<?php
include 'modal.html';
$merken = $database->getObject($connection,'prijs',array('merk'));
$types = $database->getObject($connection,'prijs',array('type'));

?>
<div class="modal fade" id="prijsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered w-50 h-75">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">prijs toevoegen | Rent a Car</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal">
                <div class="row" id="test">
                    <div class="col-sm-12 text-center">
                        <h5>Wat voor prijs willen we toevoegen?</h5>
                        <button id="btnNew" class="btn btn-primary rounded-pill btn-md center-block" onclick="newPrice()">Nieuwe prijs</button>
                        <button id="btnExisting" class="btn btn-primary rounded-pill btn-md center-block" onclick="existingPrice()">Bestaand merk + type</button>
                    </div>
                </div>
                <form id="prijsform" class="d-none" method="post" action="lib/HandlePOST.php">
                        <label for="merk" class="form-label">Merk auto</label>
                        <select class="form-select form-select-sm" id="merk" name="newprice[merk]" required>
                            <option selected value="" disabled>kies een merk</option>
                            <?php foreach ($merken as $merk){
                                echo '<option value="'.$merk['merk'].'">'.$merk['merk'].'</option>';
                            } ?>
                        </select>
                        <label for="type" class="form-label">Type auto</label>
                        <select class="form-select form-select-sm" id="type" name="newprice[type]" required>
                            <option selected value="" disabled>kies een type</option>
                            <?php foreach ($types as $type){
                                echo '<option value="'.$type['type'].'">'.$type['type'].'</option>';
                            } ?>
                        </select>
                        <label for="dagprijs" class="form-label">Dagprijs</label>
                        <input type="text" class="form-control form-control-sm" id="dagprijs" name="newprice[dagprijs]">
                    <button type="submit" class="btn ms-auto me-2 col-6 mt-2 btn-primary rounded-pill">Opslaan</button>
                </form>

                <form id="newprice" class="d-none" method="post" action="lib/HandlePOST.php">
                    <label for="merk" class="form-label">Merk auto</label>
                    <input type="text" id="merk" class="form-control form-control-sm" name="newprice[merk]" >
                    <label for="type" class="form-label">Type auto</label>
                    <input type="text" id="type" class="form-control form-control-sm" name="newprice[type]" >
                    <label for="dagprijs" class="form-label">Dagprijs</label>
                    <input type="text" class="form-control form-control-sm" id="dagprijs" name="newprice[dagprijs]">
                    <button type="submit" class="btn ms-auto me-2 col-6 mt-2 btn-primary rounded-pill">Opslaan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function newPrice() {
    $('#newprice').removeClass("d-none");

}
function existingPrice() {
    $('#prijsform').removeClass("d-none");
}
</script>