window.onload = function () {
    let divs = document.querySelectorAll("div[data-tooltip]");
    for (let i = 0; i < divs.length; i++) {
        let div = divs[i];
        div.onmouseenter = function () {
            div.innerHTML = div.innerHTML + '<div class="tooltip">' + div.getAttribute("data-tooltip") + '</div>';
        }
        div.onmouseleave = function () {
            div.querySelector("div").remove();
        }
    }
}