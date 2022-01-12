<?php /** @var Array $data */ ?>
<script src="public/latest.js"></script>
<div class="row mt-2 mb-2">
    <h3><i class="bi bi-filter-circle-fill"></i> Story <i class="bi bi-filter-circle-fill"></i></h3>
</div>
<div class="row">
    <div class="col-md-12">
        <p class="p-2">Twelve years before the start of the series, the Nine-Tails attacked Konohagakure destroying much
            of the village and taking many lives. The leader of the village, the Fourth Hokage, sacrificed his life to
            seal the Nine-Tails into a newborn, Naruto Uzumaki. Orphaned by the attack, Naruto was shunned by the
            villagers, who out of fear and anger, viewed him as the Nine-Tails itself. Though the Third Hokage outlawed
            speaking about anything related to the Nine-Tails, the children — taking their cues from their parents —
            inherited the same animosity towards Naruto. In his thirst to be acknowledged, Naruto vowed he would one day
            become the greatest Hokage the village had ever seen.
        </p>
    </div>
    <div class="row d-flex justify-content-center">
    </div>
    <div class="row d-flex justify-content-center">
        <div class="card m-3 p-3" style="width: 18rem;">
            <h5 class="card-title"></h5>
            <img class="card-img-top" src="
            <?php foreach ($data[0] as $unit) {
                \App\Config\Configuration::UPLOAD_DIR . $unit->image;
            }?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <a href="" class="btn btn-primary">
                </a>
            </div>
        </div>
        <div class="card m-3 p-3" style="width: 18rem;">
            <h5 class="card-title"></h5>
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <a href="" class="btn btn-primary">
                </a>
            </div>
        </div>
        <div class="card m-3 p-3" style="width: 18rem;">
            <h5 class="card-title"></h5>
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <a href="" class="btn btn-primary">
                </a>
            </div>
        </div>
    </div>
</div>


