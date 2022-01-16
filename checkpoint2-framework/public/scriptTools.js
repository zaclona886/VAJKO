var showed_tool_id;

function addTool() {
    let fileField1 = document.querySelector('#img_T');
    if (fileField1.value == "") {
        alert("Fill Image!");
        return;
    }
    if (fileField1.files[0].type != "image/jpeg" && fileField1.files[0].type != "image/png") {
        alert("Image is not an image!");
        return;
    }
    let name = document.getElementById("input_name").value;
    if (name.length < 3) {
        alert("Name is too short!");
        return;
    }
    let wielders = document.getElementById("input_wielders").value;
    if (wielders.length < 3) {
        alert("Wielder is too short!");
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
    formData.append('wielders',wielders);
    formData.append('img_T',fileField1.files[0]);

    fetch("?a=addTool",{
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then(data => {
            if (data == 'error') {
                alert("Some of the inputs were wrong!");
                return;
            }
            let html = `<div onclick="showTool(`+data.id+`)" id="cardTool`+data.id+`" class="m-2 p-0" style="width: 14rem;">
                <img class="card-img-top" src="public/images/`+data.image+`"
                     alt="Card image cap">
                    <div class="card-body text-center p-0">
                        <h5 class="card-title">`+data.name+`</h5>
                    </div>
            </div>`
            document.getElementById("newToolAdd").insertAdjacentHTML("afterbegin",html);
        })


    document.getElementById("img_T").value = "";
    document.getElementById("input_name").value = "";
    document.getElementById("input_wielders").value = "";
    document.getElementById("input_text").value = "";
    document.getElementById("multiCollapseAddTool").classList.remove("show");
}

function showTool(tool_id){
    if (document.getElementById("showTool").hidden == true || showed_tool_id != tool_id) {
        document.getElementById("showTool").hidden = false;
        document.getElementById("editTool").hidden = true;
        showed_tool_id = tool_id;
        fetch("?a=getTool", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: "tool_id="+tool_id
        }).then(response => response.json())
            .then(data => {
                if (data == 'error') {
                    alert("Something went wrong!");
                    return;
                }

                document.getElementById("tool_image").src = "public/images/"+data.image;
                document.getElementById("tool_name").innerHTML = data.name;
                document.getElementById("tool_text").innerHTML =data.description;
                let wielders = data.wielders.split(',');
                let html = `<div class="card-header"><h5>Wielders</h5></div>`;
                for (let i = 0; i < wielders.length; i++) {
                    html += `<div class="card-header"><p>`+wielders[i]+`</p></div>`;
                }
                document.getElementById("tool_wielders").innerHTML = html;
            })
    } else {
        document.getElementById("showTool").hidden = true;
        document.getElementById("editTool").hidden = true;
    }
}

function showToolEdit() {
    if (document.getElementById("editTool").hidden == true) {
        document.getElementById("editTool").hidden = false;
        fetch("?a=getTool", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: "tool_id=" + showed_tool_id
        }).then(response => response.json())
            .then(data => {
                if (data == 'error') {
                    alert("Something went wrong!");
                    return;
                }

                document.getElementById("edit_img_T").value = "";
                document.getElementById("edit_name").value = data.name;
                document.getElementById("edit_text").value = data.description;
                document.getElementById("edit_wielders").value = data.wielders;
            })
    } else {
        document.getElementById("editTool").hidden = true;
    }
}

function editTool() {
    // KONTROLY
    formData = new FormData();
    let fileField = document.querySelector('#edit_img_T');
    if (fileField.value != "") {
        if (fileField.files[0].type != "image/jpeg" && fileField.files[0].type != "image/png") {
            alert("Image is not an image!");
            return;
        }
        formData.append("img_T",fileField.files[0])
    }

    let name = document.getElementById("edit_name").value;
    if (name.length < 3) {
        alert("Name is too short!");
        return;
    }
    let wielders = document.getElementById("edit_wielders").value;
    if (wielders.length < 3) {
        alert("Wielder is too short!");
        return;
    }
    let text = document.getElementById("edit_text").value;
    if (text.length < 10) {
        alert("Description is too short!");
        return;
    }

    formData.append("tool_id",showed_tool_id)
    formData.append('name',name);
    formData.append('text',text);
    formData.append('wielders',wielders);
    fetch("?a=editTool", {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then(data => {
            if (data == 'error') {
                alert("Something went wrong!");
                return;
            }

            document.getElementById("tool_image").src = "public/images/"+data.image;
            document.getElementById("tool_name").innerHTML = data.name;
            document.getElementById("tool_text").innerHTML =data.description;
            document.getElementById("cardTool"+showed_tool_id).innerHTML =
                `<img class="card-img-top" src="public/images/`+data.image+`"
                         alt="Card image cap">
                    <div class="card-body text-center p-0">
                        <p>`+data.name+`</p>
                    </div>`
            let wielders = data.wielders.split(',');
            let html = `<div class="card-header"><h5>Wielders</h5></div>`;
            for (let i = 0; i < wielders.length; i++) {
                html += `<div class="card-header"><p>`+wielders[i]+`</p></div>`;
            }
            document.getElementById("tool_wielders").innerHTML = html;
            document.getElementById("editTool").hidden = true;
        })

}

function deleteTool() {
    fetch("?a=deleteTool", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "tool_id=" + showed_tool_id,
    }).then(resposne => resposne.json())
        .then(resposne => {
            if (resposne == 'error') {
                alert("Something went wrong!");
                return;
            }
            document.getElementById("cardTool" + showed_tool_id).remove();
            document.getElementById("showTool").hidden = true;
            document.getElementById("editTool").hidden = true;
            showed_tool_id = 0;
        });
}
