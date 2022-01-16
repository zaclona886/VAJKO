<?php
/** @var Array $data */
?>
<script src="public/scriptCharacters.js"></script>
<div class="row d-flex justify-content-center">
    <div class="row mt-2 mb-2">
        <strong>
            <a class="btn btn-primary d-flex justify-content-start position-absolute" data-bs-toggle="collapse"
               href="#multiCollapseAddCharacter"
               role="button" aria-expanded="false" aria-controls="multiCollapseAddCharacter">Add Character
            </a>
            <h3>Characters</h3>
        </strong>
    </div>
    <div class="row">
        <div class="collapse multi-collapse" id="multiCollapseAddCharacter">
            <?php if (App\Auth::isLogged()) { ?>
                <div class="card card-body mb-2">
                    <div class="row">
                        <div>
                            <label for="img_1">Image 1</label>
                            <input type="file" class="form-control" name="img1" id="img_1">
                            <label for="img_2">Image 2</label>
                            <input type="file" class="form-control" name="img2" id="img_2">
                            <label for="img_3">Image 3</label>
                            <input type="file" class="form-control" name="img3" id="img_3">
                            <div>
                                <label for="input_name">Character's name</label><br>
                                <input type="text" name="name" id="input_name">
                            </div>
                                <label for="input_text">Character's description</label>
                                <textarea type="text" class="form-control" name="text" id="input_text"></textarea><br>
                            <div class="pl-5">
                                <button onclick="addCharacter()" class="btn btn-primary">Add
                                    Character
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        <div class="alert alert-danger">
                            You need to be login to add Character.
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div id="newCharAdd" class="row p-4 pt-0">

        <?php
        foreach ($data as $character) { ?>
            <div id="cardChar<?= $character->id ?>" class="card mb-3">
                <div class="row g-0 align-items-center">
                    <?php if (App\Auth::isLogged()) { ?>
                        <div class="d-flex justify-content-end">
                            <div class="trashButton position-relative position-absolute">
                                <button class="check-fill btn-outline-danger" onclick="deleteCharacter(<?= $character->id ?>)">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-4">
                        <div id="carouselExampleIndicators<?= $character->id ?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators<?= $character->id ?>"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators<?= $character->id ?>"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators<?= $character->id ?>"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $character->image1 ?>"
                                         class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $character->image2 ?>"
                                         class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $character->image3 ?>"
                                         class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators<?= $character->id ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators<?= $character->id ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8 d-flex justify-content-start">
                        <div class="card-body p-0">
                            <div class="p-3">
                                <h5 class="card-title"><?= $character->name ?></h5>
                                <p class="card-text"><?= $character->text ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
    </div>
</div>
