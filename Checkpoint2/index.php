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
    <div>
        <a class="btn btn-primary " data-bs-toggle="collapse" href="#multiCollapseExample1"
           role="button"
           aria-expanded="false" aria-controls="multiCollapseExample1">Add Jutsu</a>
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                <div class="row">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputUrl">Image's URL</label>
                            <input type="url" class="form-control" name="url" id="inputUrl" placeholder="www.example.com/exp.jpg">
                        </div>
                        <div class="col-4">
                            <label for="inputName">Name of Jutsu</label><br>
                            <input type="text" class="form-control" name="name" id="inputName">
                        </div>
                        <div class="form-group">
                            <label for="inputDesc">Description</label>
                            <input type="text" class="form-control" name="text" id="inputDesc" placeholder="Jutsu's description..."><br>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="inputType">Jutsu's type</label>
                                <select  id="inputType" class="form-control" name="type">
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
                                <select  id="inputElem" class="form-control" name="element">
                                    <option selected>N/A</option>
                                    <option>Fire</option>
                                    <option>Wind</option>
                                    <option>Lightning</option>
                                    <option>Earth</option>
                                    <option>Water</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary p-2" name="jutsu">Add Jutsu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
