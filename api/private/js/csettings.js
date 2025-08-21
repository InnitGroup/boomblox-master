function __viewModal(target) {
    document.getElementById("modalPopup").style.display = "block";
    document.getElementById(target).style.display = "inline";
}
function __closeModal() {
    var modal = document.getElementById("modalPopup");
    modal.style.display = "none";
    for (const child of modal.firstElementChild.children) {
        if (child.style.display == "inline") {
            child.style.display = "none";
        }
    }
}