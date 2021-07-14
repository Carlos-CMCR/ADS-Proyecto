const dropdown = document.querySelector(".dropdown");
const dropdownMenuItem = document.querySelector(".wrapper-dropdown")

dropdown?.addEventListener("click", event=>{
    event.preventDefault();
    console.log("hola")
    console.log(dropdownMenuItem)
    dropdownMenuItem.classList.toggle("open-dropdown");
});