<?php
/** @var Array $data */
?>
<div class="row d-flex justify-content-center">
    <div class="row mt-2 mb-2">
        <strong>
            <a class="btn btn-primary d-flex justify-content-start position-absolute" data-bs-toggle="collapse"
               href="#multiCollapseExample1"
               role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Add character
            </a>
            <h3><i class="bi bi-file-person"></i> Characters <i class="bi bi-file-person"></i></h3>
        </strong>
    </div>
    <div class="row">
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <?php if (App\Auth::isLogged()) { ?>
                <div class="card card-body">
                    <div class="row">
                        <form method="post" enctype="multipart/form-data" action="?c=home&a=addCharacter">
                            <div class="form-group">
                                <label for="inputUrl">Image1</label>
                                <input type="file" class="form-control" name="img1" id="inputUrl" required>
                            </div>
                            <div class="form-group">
                                <label for="inputUrl">Image2</label>
                                <input type="file" class="form-control" name="img2" id="inputUrl" required>
                            </div>
                            <div class="form-group">
                                <label for="inputUrl">Image3</label>
                                <input type="file" class="form-control" name="img3" id="inputUrl" required>
                            </div>
                            <div class="col-4">
                                <label for="inputName">Character's name</label><br>
                                <input type="text" class="form-control" name="name" id="inputName"
                                       minlength="3" required>
                            </div>
                            <div class="form-group">
                                <label for="inputText">Text</label>
                                <textarea class="form-control" name="text" id="inputText" minlength="10" required>
                                </textarea><br>
                            </div>
                            <div class="pl-5">
                                <button type="submit" class="btn btn-primary" name="addCharacter">Add
                                    character
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        <div class="alert alert-danger">
                            You need to be login to add character.
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if (isset($_GET['error'])) { ?>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-2">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $_GET['error'] ?>
                </div>
            </div>
        </div>
    <?php }
    if (isset($_GET['succes'])) { ?>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-2">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $_GET['succes'] ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row p-4 pt-0">
        <?php
        $i = 1;
        foreach ($data as $character) { ?>
            <div class="card mb-3 d-flex justify-content-start">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4">
                        <div id="carouselExampleIndicators<?= $i ?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators<?= $i ?>"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators<?= $i ?>"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators<?= $i ?>"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $character->image1 ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $character->image2 ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $character->image3 ?>" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators<?= $i ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators<?= $i ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8 d-flex justify-content-start">
                        <div class="card-body p-0">
                            <?php if (App\Auth::isLogged()) { ?>
                            <div class=" d-flex justify-content-end">
                                <div class="position-absolute">
                                    <form method="post" enctype="multipart/form-data"
                                          action="?c=home&a=deleteCharacter">
                                        <input type="hidden" name="character_id" value="<?= $character->id ?>">
                                        <button type="submit" class="check-fill btn-outline-danger"
                                                name="deleteCharacter">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="p-3">
                                <h5 class="card-title"><?= $character->name ?></h5>
                                <p class="card-text"><?= $character->text ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++;
        } ?>
    </div>
</div>
