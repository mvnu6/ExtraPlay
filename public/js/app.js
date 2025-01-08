let timeline = gsap.timeline({ repeat: -1 });

gsap.utils.toArray(".slide-txt div").forEach((text, index) => {
  timeline.to(text, {
    top: 0,
    duration: 1,
    delay: -1, // Délai négatif pour superposer les animations
  });
  if (index !== 3) {
    timeline.to(text, { top: "-9rem", duration: 1 });
  }
});

// Ajout de l'animation des images avec un délai ajusté pour être simultanée avec celle des textes
gsap.utils.toArray(".slide-img img").forEach((image, index) => {
  timeline.to(image, {
    x: 0, // Déplacer l'image à sa position d'origine
    duration: 0.1,
    delay: -1, // Ajuster pour que l'animation de l'image commence en même temps que celle du texte
  });
  if (index !== 3) {
    timeline.to(image, { left: "0rem", duration: 1 });
  }
});


let svg= document.querySelector(".svg-bg");
let path= svg.querySelector("path");
const pathLength = path.getTotalLength();
console.log(pathLength);

gsap.set(path, {strokeDasharray : pathLength});

gsap.fromTo(
  path,
  {
    strokeDashoffset: pathLength,
  },
  {
    strokeDashoffset: 1,
    duration: 10,
    ease: "none",
    scrollTrigger: {
      trigger: ".svg-bg",
      start: "top top",
      end: "bottom bottom",
      scrub: 8,
    },
  }
);


const app = {
  init: function() {
    console.log('app init - si besoin de JS ;)');
  },
};

document.addEventListener('DOMContentLoaded', app.init);

const btns= document.querySelectorAll('.q-a-container');
btns.forEach((btn, index) => {
  // console.log(btn);
  btn.addEventListener("click", () =>{
    btn.classList.toggle("active");
  })
});