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
</head>
<body>
<div class="container">
    <div class="row">

            <?php $i=1; foreach ($app->getAllJutsus() as $jutsu) { ?>
        <div class="col-12 col-md-6">
                <div class="card">
                    <img src="<?=$jutsu->getImage() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title"><?=$jutsu->getName() ?></h4>
                        <p class="card-text"><?= $jutsu->getText() ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><h5>Type: </h5>
                            <p><?= $jutsu->getType() ?></p></li>
                        <li class="list-group-item"><h5>Element: </h5>
                            <p><?= $jutsu->getElement()?></p></li>
                        <li class="list-group-item"><h5>Users: </h5>
                            <p>Bla bla bla bla bla bla bla bla</p></li>
                    </ul>
                </div>
        </div>
            <?php } ?>

    </div>
</div>
</body>
