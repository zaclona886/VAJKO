<?php
/** @var Array $data */
?>
<script src="public/jutsu.js"></script>
<div class="row d-flex justify-content-center">
    <div class="row mt-2 mb-2">
        <strong>
            <a class="btn btn-primary d-flex justify-content-start position-absolute" data-bs-toggle="collapse"
               href="#multiCollapseExample1"
               role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Add Jutsu
            </a>
            <h3>Jutsus</h3>
        </strong>
    </div>
    <div class="row">
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <?php if (App\Auth::isLogged()) { ?>
                <div class="card card-body">
                    <div class="row">
                        <form method="post" enctype="multipart/form-data" action="?c=home&a=addJutsu">
                            <div class="form-group">
                                <label for="inputUrl">Image</label>
                                <input type="file" class="form-control" name="img" id="inputUrl">
                            </div>
                            <div class="col-6">
                                <label for="inputName">Name of Jutsu</label><br>
                                <input type="text" class="form-control" name="name" id="inputName"
                                       minlength="3" required>
                            </div>
                            <div class="form-group">
                                <label for="inputDesc">Jutsu's Description</label>
                                <textarea type="text" class="form-control" name="text" id="inputDesc"
                                          minlength="10" required>
                                </textarea>
                                    <br>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="inputType">Jutsu's type</label>
                                    <select id="inputType" class="form-select" name="type">
                                        <option selected>N/A</option>
                                        <option>Ninjutsu</option>
                                        <option>Genjutsu</option>
                                        <option>TaiJutsu</option>
                                        <option>Dōjutsu</option>
                                        <option>Shurikenjutsu</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="inputElem">Jutsu's element</label>
                                    <select id="inputElem" class="form-select" name="element">
                                        <option selected>N/A</option>
                                        <option>Fire</option>
                                        <option>Wind</option>
                                        <option>Lightning</option>
                                        <option>Earth</option>
                                        <option>Water</option>
                                    </select>
                                </div>
                            </div>
                            <div class="p-2">
                                <button type="submit" class="btn btn-primary" name="addJutsu">Add
                                    Jutsu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        <div class="alert alert-danger">
                            You need to be login to add Jutsu.
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
    if (isset($_GET['succes'])){ ?>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-2">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $_GET['succes'] ?>
                </div>
            </div>
        </div>
    <?php }  ?>
    <div class="row">
        <?php
        $x = 1;
        foreach ($data[0] as $jutsu) {?>
            <div class="col-12 col-md-6 pt-2">
                <div class="card p-2">
                    <?php if (App\Auth::isLogged()) { ?>
                        <div class=" d-flex justify-content-end">
                            <div class="position-absolute">
                                <form method="post" enctype="multipart/form-data" action="?c=home&a=iconAction">
                                    <input type="hidden" name="jutsu_id" value="<?= $jutsu->id ?>">
                                    <button class="check-fill btn-outline-success" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button type="submit" class="check-fill btn-outline-danger"
                                            name="deleteJutsu">
                                        <i class="bi bi-trash-fill"></i></button>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <div class="card row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="inputUrl">Change image</label>
                                                    <input type="file" class="form-control" name="newImg"
                                                           id="inputUrl">
                                                </div>
                                                <div class="p-2">
                                                    <button type="submit" class="btn btn-primary"
                                                            name="rewriteImg">
                                                        Change Image
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    <?php } ?>

                    <img src="<?=  \App\Config\Configuration::UPLOAD_DIR . $jutsu->image ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title"><?= $jutsu->name ?></h4>
                        <p class="card-text"><?= $jutsu->text ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p>Type: <?= $jutsu->type ?></p>
                        </li>
                        <li class="list-group-item">
                            <p>Element: <?= $jutsu->element ?></p>
                        </li>
                        <li class="list-group-item">
                            <?php if (App\Auth::isLogged()) { ?>
                                <form method="post" enctype="multipart/form-data" action="?c=home&a=addUser">
                                    <div class="row">
                                        <div class="col-8 d-flex justify-content-center">
                                            <input type="hidden" name="jutsu_id" value="<?= $jutsu->id ?>">
                                            <select id="inputUser<?php echo $x?>" class="form-select" name="name">
                                                <?php foreach ($data[1] as $character) {?>
                                                <option><?= $character->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-4 d-flex justify-content-start">
                                            <button type="submit" class="check-fill btn-outline-warning"
                                                    name="user">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                            <p> Users:
                                <?php $i = 1;
                                foreach ($jutsu->users() as $user) {
                                    echo $user->name;
                                    if ($i != count($jutsu->users())) {
                                        echo ", ";
                                    } else {
                                        echo "";
                                    }
                                    $i++;
                                } ?>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        <?php
        $x +=1;} ?>
    </div>
</div>
