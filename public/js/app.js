// Timeline pour les textes
let textTimeline = gsap.timeline({ repeat: -1 });
gsap.utils.toArray(".slide-txt div").forEach((text, index) => {
  textTimeline.to(text, {
    top: .25,
    duration: 1.25,
    delay: -1,
  });
  
  if (index !== 3) {
    textTimeline.to(text, {
      top: "-9rem",
      duration: .85,
    });
  }
});

// Timeline pour les images
// let imageTimeline = gsap.timeline({ repeat: -1 });
// gsap.utils.toArray(".slide-img img").forEach((image, index) => {
//   imageTimeline.to(image, {
//     x: 0,
//     duration: 1,
//   }, index * 1);
  
//   if (index !== 3) {
//     imageTimeline.to(image, {
//       left: "0rem",
//       duration: 1,
//     }, index * 1);
//   }
// });


// Timeline pour les images
let imageTimeline = gsap.timeline({ repeat: -1 });
gsap.utils.toArray(".slide-img img").forEach((image, index) => {
  imageTimeline.to(image, {
    x: 0,             // L'image entre à l'écran
    duration: 1,      // Temps de l'animation d'entrée
  }, index * 1);      // Ajoutez un espacement de 3 secondes pour chaque image
  
  if (index !== 3) {  // Si ce n'est pas la dernière image
    imageTimeline.to(image, {
      left: "0rem",     // L'image se déplace hors de l'écran
      duration: 1,    // Temps de l'animation de sortie
    }, index * 1.25); // Laissez l'image à l'écran pendant 2 secondes avant de la faire sortir
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