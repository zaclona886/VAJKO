<?php /** @var Array $data [] */ ?>
<div class="row mt-2 mb-2">
    <h3>Story</h3>
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
        <?php if (!empty($data[0])) { ?>
            <div class="card m-2 p-3 text-center" style="width: 18rem;">
                <h5 class="card-title">Latest Character</h5>
                <img class="card-img-top" src="<?= \App\Config\Configuration::UPLOAD_DIR . $data[0]->image1 ?>"
                     alt="Card image cap">
                <div class="card-body" style="padding: 0.5rem">
                    <h5 class="card-title"><?= $data[0]->name ?> </h5>
                    <a href="?c=home&a=characters" class="btn btn-primary">
                        Go To Characters
                    </a>
                </div>
            </div>
        <?php } ?>
        <?php if (!empty($data[1])) { ?>
            <div class="card m-2 p-3 text-center" style="width: 18rem;">
                <h5 class="card-title">Latest Jutsu</h5>
                <img class="card-img-top" src="<?= \App\Config\Configuration::UPLOAD_DIR . $data[1]->image ?>"
                     alt="Card image cap">
                <div class="card-body" style="padding: 0.5rem">
                    <h5 class="card-title"><?= $data[1]->name ?></h5>
                    <a href="?c=home&a=jutsu" class="btn btn-primary">
                        Go To Jutsus
                    </a>
                </div>
            </div>
        <?php } ?>
        <?php if (!empty($data[2])) { ?>
            <div class="card m-2 p-3 text-center" style="width: 18rem;">
                <h5 class="card-title">Latest Tool</h5>
                <img class="card-img-top" src="<?= \App\Config\Configuration::UPLOAD_DIR . $data[2]->image ?>"
                     alt="Card image cap">
                <div class="card-body" style="padding: 0.5rem">
                    <h5 class="card-title"><?= $data[2]->name ?></h5>
                    <a href="?c=home&a=tools" class="btn btn-primary">
                        Go To Tools
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


