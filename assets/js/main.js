let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
    let arrowParent = e.target.parentElement.parentElement;
    arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
  adjustImageSize();
});


function adjustImageSize() {
  let miniPerfil = document.querySelector(".miniPerfil");
  if (sidebar.classList.contains("close")) {
    miniPerfil.style.width = "60px";
    miniPerfil.style.height = "50px";
    miniPerfil.style.marginTop = "90px";
    miniPerfil.style.marginRight = "auto";
    miniPerfil.style.marginBottom = "10px";
    miniPerfil.style.marginLeft = "auto";
  } else {
    miniPerfil.style.width = "130px";
    miniPerfil.style.height = "120px"; 
    miniPerfil.style.marginTop = "40px";
    miniPerfil.style.marginRight = "auto";
    miniPerfil.style.marginBottom = "10px";
    miniPerfil.style.marginLeft = "auto";
  }
  miniPerfil.style.transition = "width 0.3s ease, height 0.3s ease, margin-top 0.3s ease";
}