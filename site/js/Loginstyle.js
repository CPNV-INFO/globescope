document.addEventListener("DOMContentLoaded",Init);
function Init() {


// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    login.addEventListener('click',d_block);

}
//not used
function d_block() {

    login.classList.add("d-block");

    login.classList.remove("d-none");

}