<?php /** @var Array $data [] */ ?>
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
        <?php foreach ($data[0] as $character) { ?>
            <div class="card m-3 p-3" style="width: 18rem;">
                <h5 class="card-title">Latest Character</h5>
                <img class="card-img-top" src="<?= \App\Config\Configuration::UPLOAD_DIR . $character->image1 ?>"
                     alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $character->name ?> </h5>
                    <a href="?c=home&a=characters" class="btn btn-primary">
                        Go To Characters
                    </a>
                </div>
            </div>
            <?php break;
        }
        foreach ($data[1] as $jutsu) {
            ?>
            <div class="card m-3 p-3" style="width: 18rem;">
                <h5 class="card-title">Latest Jutsu</h5>
                <img class="card-img-top" src="<?= \App\Config\Configuration::UPLOAD_DIR . $jutsu->image ?>"
                     alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $jutsu->name ?></h5>
                    <a href="?c=home&a=jutsu" class="btn btn-primary">
                        Go To Jutsus
                    </a>
                </div>
            </div>
            <?php break;
        }
        foreach ($data[2] as $tool) {
            ?>
            <div class="card m-3 p-3" style="width: 18rem;">
                <h5 class="card-title">Latest Tool</h5>
                <img class="card-img-top" src="<?= \App\Config\Configuration::UPLOAD_DIR . $tool->image ?>"
                     alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $tool->name ?></h5>
                    <a href="?c=home&a=tools" class="btn btn-primary">
                        Go To Tools
                    </a>
                </div>
            </div>
            <?php break;
        } ?>
    </div>
</div>


