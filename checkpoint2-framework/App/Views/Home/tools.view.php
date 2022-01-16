<?php
/** @var Array $data */
?>
<script src="public/scriptTools.js"></script>
<div class="row d-flex justify-content-center">
    <div class="row mt-2 mb-2">
        <strong>
            <a class="btn btn-primary d-flex justify-content-start position-absolute" data-bs-toggle="collapse"
               href="#multiCollapseAddTool"
               role="button" aria-expanded="false" aria-controls="multiCollapseAddTool">Add Tool
            </a>
            <h3>Tools</h3>
        </strong>
    </div>
    <div class="row">
        <div class="collapse multi-collapse" id="multiCollapseAddTool">
            <?php if (App\Auth::isLogged()) { ?>
                <div class="card card-body">
                    <div class="row">
                        <div>
                            <label for="img_T">Image</label>
                            <input type="file" class="form-control" name="img" id="img_T">
                            <div>
                                <label for="input_name">Tool's name</label><br>
                                <input type="text" name="name" id="input_name">
                            </div>
                            <div>
                                <label for="input_wielders">Tool's wielders</label><br>
                                <input class="form-control" type="text" name="wielders" id="input_wielders">
                            </div>
                            <label for="input_text">Tool's description</label>
                            <textarea type="text" class="form-control" name="text" id="input_text"></textarea><br>
                            <div class="pl-5">
                                <button onclick="addTool()" class="btn btn-primary">Add
                                    Tool
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-2">
                        <div class="alert alert-danger">
                            You need to be login to add Tool.
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div id="showTool" class="card" hidden >
            <div class="row g-0 mb-2 mt-2">
                <div class="col-md-9 card-body ">
                    <div>
                        <img id="tool_image"
                         class="img-fluid rounded-start" alt="..." style="float: left">
                    </div>
                    <h5 id="tool_name" class="text-center">Tool name</h5>
                    <p id="tool_text" style="text-align: justify;"></p>
                </div>
                <div id="tool_wielders" class="col-md-3 text-center align-items-center card-body border border-dark bord border-2">
                </div>
            </div>
        </div>
        <div id="newToolAdd" class="row d-flex justify-content-center mt-0">
            <?php foreach ($data as $tool) { ?>
                <div onclick="showTool(<?= $tool->id ?>)" id="cardTool<?= $tool->id ?>" class="m-2 p-0"
                     style="width: 14rem;">
                    <img class="card-img-top" src="<?= \App\Config\Configuration::UPLOAD_DIR . $tool->image ?>"
                         alt="Card image cap">
                    <div class="card-body text-center p-0">
                        <p><?= $tool->name ?> </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>