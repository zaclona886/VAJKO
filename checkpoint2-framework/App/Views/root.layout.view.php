<!DOCTYPE html>
<html lang="sk">
<head>
    <title>NARUTO</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css.css">
</head>
<body>
<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="?c=home" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="?c=home&a=characters" class="nav-link">Characters</a></li>
            <li class="nav-item"><a href="?c=home&a=jutsu" class="nav-link">Jutsus</a></li>
            <?php if (App\Auth::isLogged()) { ?>
                <li class="nav-item"><a href="?c=auth&a=logout" class="nav-link">Logout</a></li>
            <?php } else { ?>
                <li class="nav-item"><a href="<?= \App\Config\Configuration::LOGIN_URL ?>" class="nav-link">Login</a></li>
            <?php } ?>
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
                <?= $contentHTML ?>
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

