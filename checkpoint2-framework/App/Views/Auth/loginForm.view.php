<?php /** @var Array $data */ ?>
<script src="public/scriptRegister.js"></script>
<div class="row mt-2 mb-2">
    <h3>Login</h3>
</div>
<div class="row">
    <div class="col-0 col-md-6 justify-content-center">
        <img class="card-img-top"
             src="public/images/itachi_login.jpg" alt="...">
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
            <?php if ($data['succes'] != "") { ?>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <?= $data['succes'] ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="login/register col-12 d-flex justify-content-center mb-2">
                    <form id="register" method="post" enctype="multipart/form-data" action="?c=auth&a=register" hidden>
                        <div>
                            <label for="new_username">Username</label><br>
                            <input type="text" name="new_username" id="new_username" minlength="4" required>
                        </div>
                        <div>
                            <label for="new_password1">Password</label><br>
                            <input type="password" name="new_password1" id="new_password1" minlength="4" required>
                        </div>
                        <div>
                            <label for="new_password2">Password</label><br>
                            <input type="password" name="new_password2" id="new_password2">
                        </div>
                        <p style="color:blue;text-decoration:underline;" onclick="showLogin()">Already have
                            account? </p>
                        <button type="submit" class="btn btn-primary mt-2">Register</button>
                    </form>
                    <form id="login" method="post" enctype="multipart/form-data" action="?c=auth&a=login">
                        <div>
                            <label for="username" class="form-label mb-0">Username</label><br>
                            <input type="text" name="login" id="username" required>
                        </div>
                        <div>
                            <label for="password" class="form-label mb-0">Password</label><br>
                            <input type="password" name="password" id="password" required>
                        </div>
                        <p style="color:blue;text-decoration:underline;" onclick="showRegister()">Don't have account?</p>
                        <div>
                            <button type="submit" class="btn btn-primary mt-2">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php if ($data['error'] != "") { ?>

                <?php if ($data['error'] == "The username or password is incorrect!") {
                    echo '<script type="text/javascript">showLogin();</script>';
                } else {
                    echo '<script type="text/javascript">showRegister();</script>';
                }?>

            <?php } ?>
        </div>
    </div>
</div>
