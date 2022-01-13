function deleteCharacter(char_id) {
    fetch("?a=deleteCharacter", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "char_id=" + char_id,
    }).then(resposne => resposne.json())
        .then(resposne => {
            if (resposne == 'error') {
                alert("Character does not exist!");
            } else {
                document.getElementById("cardChar" + char_id).remove();
            }
        });
}

function addCharacter() {
    let fileField1 = document.querySelector('#img_1');
    if (fileField1.value == "") {
        alert("Fill Image 1!");
        return;
    }
    if (fileField1.files[0].type != "image/jpeg" && fileField1.files[0].type != "image/png") {
        alert("Image 1 is not an image!");
        return;
    }
    let fileField2 = document.querySelector('#img_2');
    if (fileField2.value == "") {
        alert("Fill Image 2!");
        return;
    }
    if (fileField2.files[0].type != "image/jpeg" && fileField2.files[0].type != "image/png") {
        alert("Image 2 is not an image!");
        return;
    }
    let fileField3 = document.querySelector('#img_3');
    if (fileField3.value == "") {
        alert("Fill Image 3!");
        return;
    }
    if (fileField3.files[0].type != "image/jpeg" && fileField3.files[0].type != "image/png") {
        alert("Image 3 is not an image!");
        return;
    }
    let name = document.getElementById("input_name").value;
    if (name.length < 3) {
        alert("Name is too short!");
        return;
    }
    let text = document.getElementById("input_text").value;
    if (text.length < 10) {
        alert("Description is too short!");
        return;
    }
    formData = new FormData();
    formData.append('name',name);
    formData.append('text',text);
    formData.append('img_1',fileField1.files[0]);
    formData.append('img_2',fileField2.files[0]);
    formData.append('img_3',fileField3.files[0]);

    fetch("?a=addCharacter",{
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then(data => {
            if (data == 'error') {
                alert("Some of the inputs were wrong!");
                return;
            }
            let html = `<div id="cardChar`+data.id+`" class=" card mb-3">
                <div class="row g-0 align-items-center">
                        <div class="d-flex justify-content-end">
                            <div class="trashButton position-relative position-absolute">
                                <button class="check-fill btn-outline-danger" onclick="deleteCharacter(`+data.id+`)">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                    <div class="col-md-4">
                        <div id="carouselExampleIndicators`+data.id+`" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators`+data.id+`"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators`+data.id+`"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators`+data.id+`"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="public/images/`+data.image1+`"
                                         class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="public/images/`+data.image2+`"
                                         class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="public/images/`+data.image3+`"
                                         class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators`+data.id+`" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators`+data.id+`" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8 d-flex justify-content-start">
                        <div class="card-body p-0">
                            <div class="p-3">
                                <h5 class="card-title">`+data.name+`</h5>
                                <p class="card-text">`+data.text+`</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
            document.getElementById("newCharAdd").insertAdjacentHTML("afterbegin",html);
        });
    document.getElementById("input_name").value = "";
    document.getElementById("input_text").value = "";
    document.getElementById("img_1").value ="";
    document.getElementById("img_2").value ="";
    document.getElementById("img_3").value ="";
    document.getElementById("multiCollapseAddCharacter").classList.remove("show");
}