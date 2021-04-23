<div class="card mb-3">
<div class="row g-0">
        <div class="col-md-4 overflow-hidden">
            <img width="" style="width: 100%;max-width: 100%" src="{{afbeelding}}" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title w-50">{{naam}}</h5>
                    <h5 class="text-end card-title w-50">Status: {{status}}</h5>
                </div>
                <p class="card-text">{{beschrijving}}</p>
                <p class="card-text"><small class="text-muted">Type {{type}}<br>Kenteken {{kenteken}}</small></p>
                <div class="row">
                    <p class="card-text w-50">Dagprijs: &#8364;{{dagprijs}}</p><br>
                    <?//todo: Find a way to make this work or make seperate card for employees?>
                    <a class="btn btn-primary w-50 text-white rounded-pill" href="autoBeheer.php?id={{idauto}}">Bewerken</a>
                    <a class="btn btn-primary w-50 text-white rounded-pill" href="autoDetail.php?id={{idauto}}">Bekijken</a>
                </div>
            </div>
        </div>
    </div>
</div>
