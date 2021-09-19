let compteur = 0 ;
let timer, elements, slides, slideWidth;

window.onload = () => {
    const diapo = document.querySelector(".diapo");

    elements = document.querySelector(".elements");

    slides = Array.from(elements.children);

    slideWidth = diapo.getBoundingClientRect().width;
 
    let next = document.querySelector("#nav-droite");
    let prev = document.querySelector("#nav-gauche");
    let next2 = document.querySelector("#nav-droite2");
    let prev2 = document.querySelector("#nav-gauche2");
    let next3 = document.querySelector("#nav-droite3");
    let prev3 = document.querySelector("#nav-gauche3");
    let next4 = document.querySelector("#nav-droite4");
    let prev4 = document.querySelector("#nav-gauche4");
    let next5 = document.querySelector("#nav-droite5");
    let prev5 = document.querySelector("#nav-gauche5");
    let next6 = document.querySelector("#nav-droite6");
    let prev6 = document.querySelector("#nav-gauche6");
    let next7 = document.querySelector("#nav-droite7");
    let prev7 = document.querySelector("#nav-gauche7");
    let next8 = document.querySelector("#nav-droite8");
    let prev8 = document.querySelector("#nav-gauche8");
    let next9 = document.querySelector("#nav-droite9");
    let prev9 = document.querySelector("#nav-gauche9");
    let prev10 = document.querySelector("#nav-gauche10");

    next.addEventListener("click", slideNext);
    prev.addEventListener("click", slidePrev2);
    next2.addEventListener("click", slideNext);
    prev2.addEventListener("click", slidePrev);
    next3.addEventListener("click", slideNext);
    prev3.addEventListener("click", slidePrev);
    next4.addEventListener("click", slideNext);
    prev4.addEventListener("click", slidePrev);
    next5.addEventListener("click", slideNext);
    prev5.addEventListener("click", slidePrev);
    next6.addEventListener("click", slideNext);
    prev6.addEventListener("click", slidePrev);
    next7.addEventListener("click", slideNext);
    prev7.addEventListener("click", slidePrev);
    next8.addEventListener("click", slideNext);
    prev8.addEventListener("click", slidePrev);
    next9.addEventListener("click", slideNext);
    prev9.addEventListener("click", slidePrev);
    prev10.addEventListener("click", slidePrev);
};

function slideNext(){
 
    compteur++;
    
    let decal = -slideWidth * compteur;
    elements.style.transform = `translateX(${decal}px)`;
}

function slidePrev(){
  
    compteur--;

    let decal = -slideWidth * compteur;
    elements.style.transform = `translateX(${decal}px)`;
}

function slidePrev2(){
  
    compteur--;

    if(compteur < 0){
        compteur = 0;
    }

    let decal = -slideWidth * compteur;
    elements.style.transform = `translateX(${decal}px)`;
}

 var slideIndex = 0;
      showSlides();
      
    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none"; 
        }
        slideIndex++;
        
        if (slideIndex > slides.length) {
            slideIndex = 1;
        } 
        slides[slideIndex-1].style.display = "block"; 
        setTimeout(showSlides, 6000); 
}