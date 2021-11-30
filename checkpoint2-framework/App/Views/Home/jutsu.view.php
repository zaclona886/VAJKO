<?php
/** @var App\Models\Jutsu[] $data */
?>
<div class="row d-flex justify-content-center">
    <div class="row">
        <div class="col-4 m-2">
            <div>

                <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1"
                   role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Add Jutsu
                </a>

            </div>
        </div>
        <div class="col-4 m-2">
            <h3>List of Jutsus</h3>
        </div>
        <div class="col-4">
        </div>
    </div>
    <div class="row">
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                <div class="row">
                    <form method="post" enctype="multipart/form-data" action="?c=home&a=addJutsu">
                        <div class="form-group">
                            <label for="inputUrl">Image's URL</label>
                            <input type="url" class="form-control" name="url" id="inputUrl"
                                   placeholder="www.example.com/exp.jpg">
                        </div>
                        <div class="col-4">
                            <label for="inputName">Name of Jutsu</label><br>
                            <input type="text" class="form-control" name="name" id="inputName"
                                   minlength="3" required>
                        </div>
                        <div class="form-group">
                            <label for="inputDesc">Description</label>
                            <input type="text" class="form-control" name="text" id="inputDesc"
                                   placeholder="Jutsu's description..." minlength="10" required><br>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="inputType">Jutsu's type</label>
                                <select id="inputType" class="form-control" name="type">
                                    <option selected>N/A</option>
                                    <option>Ninjutsu</option>
                                    <option>Genjutsu</option>
                                    <option>TaiJutsu</option>
                                    <option>Dōjutsu</option>
                                    <option>Shurikenjutsu</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="inputElem">Jutsu's element</label>
                                <select id="inputElem" class="form-control" name="element">
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
                            <button type="submit" class="btn btn-primary" name="jutsu">Add
                                Jutsu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($data as $jutsu) { ?>
            <div class="col-12 col-md-6">
                <div class="card p-1">
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
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <div class="card row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="inputUrl">Image's URL</label>
                                                <input type="url" class="form-control" name="newURL"
                                                       id="inputUrl"
                                                       placeholder="www.example.com/exp.jpg">
                                            </div>
                                            <div class="p-2">
                                                <button type="submit" class="btn btn-primary"
                                                        name="rewriteURL">
                                                    Rewrite URL
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </form>
                        </div>
                    </div>

                    <img src="<?= $jutsu->image ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title"><?= $jutsu->name ?></h4>
                        <p class="card-text"><?= $jutsu->text ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><h5>Type: </h5>
                            <p><?= $jutsu->type ?></p></li>
                        <li class="list-group-item"><h5>Element: </h5>
                            <p><?= $jutsu->element ?></p></li>
                        <li class="list-group-item">
                            <form method="post" enctype="multipart/form-data" action="?c=home&a=addUser">
                                <input type="hidden" name="jutsu_id"
                                       value="<?= $jutsu->id ?>">
                                <input type="text" name="name" placeholder="User's name..."
                                       minlength="3" required>
                                <button type="submit" class="check-fill btn-outline-warning"
                                        name="user">
                                    <i class="bi bi-check-circle-fill"></i>
                                </button>
                            </form>
                            <h5>Users:</h5>
                            <p>
                                <?php $i = 1;
                                foreach ($jutsu->users() as $user) {
                                    echo $user->name;
                                    if ($i != count($jutsu->users())) {
                                        echo ", ";
                                    } else {
                                        echo ",...";
                                    }
                                    $i++;
                                } ?>
                            </p>
                        </li>

                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
