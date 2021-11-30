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
<div class="row">
    <button class="check-fill btn-outline-success" id="dropdownMenuButton1" data-bs-toggle="dropdown"
            aria-expanded="false">
        <i class="bi bi-pencil-square"></i>
    </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <div class="card row">
                <div class="col-12">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputUrl">Image's URL</label>
                        <input type="url" class="form-control" name="url" id="inputUrl"
                               placeholder="www.example.com/exp.jpg">
                    </div>
                    <div class="p-2">
                        <button type="submit" class="btn btn-primary" name="xxxxxx">
                            Rewrite URL
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </ul>
</div>
</body>
