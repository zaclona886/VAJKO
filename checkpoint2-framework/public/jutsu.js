class User{
    showCharacters(id) {
        fetch('?a=getAllCharacters')
            .then(response => response.json())
            .then(data => {
                let html = "";
                for (let character of data) {
                    html += "<option>" + character.name + "</option>";
                }
                document.getElementById("inputUser"+id).innerHTML = html;
            });
    }
}

window.onload = function () {
    var user = new User();
    for (let i = 1; i <= 4;i++) {
        user.showCharacters(i)
    }
}