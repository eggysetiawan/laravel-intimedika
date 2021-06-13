var loader = document.querySelector(".loader");

window.addEventListener("load", vanish);

function vanish() {
    loader.classList.add("disppear");
    // setTimeout(function() {
    //     loader.classList.add("disppear");
    // }, 2665);
}
