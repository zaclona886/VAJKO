<?php

require "App.php";

$app = new App();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jutsus</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

    <link href="Basic.css" rel="stylesheet" type="text/css">
    <script src="script.js"></script>
</head>
<body>
<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="Home.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="Characters.php" class="nav-link">Characters</a></li>
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Jutsus</a></li>
        </ul>
    </header>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <img class="obrazok border border-5 border-dark rounded img-fluid"
                 src="https://1.bp.blogspot.com/-eDNN1EY6S1M/YPW6x4MylAI/AAAAAAAAs_k/c4DpMq9LMtgiNGQcXb_gOHQ8AzV83gMsgCLcBGAsYHQ/s1280/sasuke-wallpapers%2B%252812%2529.jpg"
                 alt="...">
        </div>
        <div class="col-12 col-md-8">
            <div class="row">
                <img class="napisNaruto"
                     src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Naruto_logo.svg/1920px-Naruto_logo.svg.png"
                     alt="...">
            </div>
            <div class="mytext border border-3 border-dark rounded">
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
                                    <form method="post" enctype="multipart/form-data">
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
                        <?php foreach ($app->getAllJutsus() as $jutsu) { ?>
                            <div class="col-12 col-md-6">
                                <div class="card p-1">
                                    <div class=" d-flex justify-content-end">
                                        <div class="position-absolute">
                                            <form method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="jutsu_id" value="<?= $jutsu->getId() ?>">
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

                                    <img src="<?= $jutsu->getImage() ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $jutsu->getName() ?></h4>
                                        <p class="card-text"><?= $jutsu->getText() ?></p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><h5>Type: </h5>
                                            <p><?= $jutsu->getType() ?></p></li>
                                        <li class="list-group-item"><h5>Element: </h5>
                                            <p><?= $jutsu->getElement() ?></p></li>
                                        <li class="list-group-item">
                                            <form method="post" >
                                                <input type="hidden" name="jutsu_id"
                                                       value="<?= $jutsu->getId() ?>">
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
                                                foreach ($jutsu->getUsers() as $user) {
                                                    echo $user->getName();
                                                    if ($i != count($jutsu->getUsers())) {
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
            </div>
        </div>
        <div class="col-md-2">
            <img class="obrazok border border-5 border-dark rounded img-fluid"
                 src="https://i.pinimg.com/originals/98/4d/76/984d76e1c7467d61f87e5d495b67af74.jpg" alt="...">
        </div>
    </div>
</div>

</body>
</html>