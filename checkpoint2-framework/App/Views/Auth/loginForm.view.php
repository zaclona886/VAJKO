<?php /** @var Array $data */ ?>
<div class="row">
    <div class="col-0 col-md-6 justify-content-center">
        <img class="card-img-top"
             src="https://i.pinimg.com/736x/f1/fc/01/f1fc012b7cf7f1d13cdfdcb8b66741d9.jpg" alt="...">
    </div>
    <div class="col-12 col-md-6">
        <div class="row">
            <?php if ($data['error'] != "") { ?>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['error'] ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <form method="post" enctype="multipart/form-data" action="?c=auth&a=login">
                        <div>
                            <label for="username" class="form-label mb-0">Username</label>
                            <input type="text" class="form-control" name="login" id="username" required>
                        </div>
                        <div class="mt-2">
                            <label for="password" class="form-label mb-0">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-2">Login</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
