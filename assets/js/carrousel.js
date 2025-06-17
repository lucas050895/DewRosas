// CARRUSUEL DE MAS VENDIDOS EN EL INDEX
const prev = document.querySelector("#prev");
const next = document.querySelector("#next");
let carouselVp = document.querySelector("#carousel-vp");
let cCarouselInner = document.querySelector("#cCarousel-inner");
let carouselInnerWidth = cCarouselInner.getBoundingClientRect().width;
let leftValue = 0;
const totalMovementSize =
    parseFloat(
        document.querySelector(".cCarousel-item").getBoundingClientRect().width,
        10
    ) +
    parseFloat(
        window.getComputedStyle(cCarouselInner).getPropertyValue("gap"),
        10
    );

    prev.addEventListener("click", () => {
    if (!leftValue == 0) {
        leftValue -= -totalMovementSize;
        cCarouselInner.style.left = leftValue + "px";
    }
    });

    next.addEventListener("click", () => {
    const carouselVpWidth = carouselVp.getBoundingClientRect().width;
    if (carouselInnerWidth - Math.abs(leftValue) > carouselVpWidth) {
        leftValue -= totalMovementSize;
        cCarouselInner.style.left = leftValue + "px";
    }
});

const mediaQuery510 = window.matchMedia("(max-width: 510px)");
const mediaQuery770 = window.matchMedia("(max-width: 770px)");
mediaQuery510.addEventListener("change", mediaManagement);
mediaQuery770.addEventListener("change", mediaManagement);
let oldViewportWidth = window.innerWidth;

function mediaManagement() {
    const newViewportWidth = window.innerWidth;

    if (leftValue <= -totalMovementSize && oldViewportWidth < newViewportWidth) {
        leftValue += totalMovementSize;
        cCarouselInner.style.left = leftValue + "px";
        oldViewportWidth = newViewportWidth;
    } else if (
        leftValue <= -totalMovementSize &&
        oldViewportWidth > newViewportWidth
    ) {
        leftValue -= totalMovementSize;
        cCarouselInner.style.left = leftValue + "px";
        oldViewportWidth = newViewportWidth;
    }
}


//CARRUSUEL DE CADA PRODUCTO
const grande = document.querySelector('.grande');
const punto = document.querySelectorAll('.punto');

punto.forEach( (cadaPunto , i )=> {
    punto[i].addEventListener('click',()=>{
        let posicion = i;
        let operacion = posicion * -20;

        grande.style.transform = `translateX( ${ operacion }%)`

        punto.forEach( ( cadaPunto , i)=>{
            punto[i].classList.remove('activo');
        });
        punto[i].classList.add('activo');

    });   
})




//TABS PARA LOS CATALOGOS
const lista = document.querySelectorAll('.lista');
const contenido = document.querySelectorAll('.contenido');

lista.forEach( (CadaLista , i) =>{
    lista[i].addEventListener('click',()=>{
        lista.forEach((cadaLista , i)=>{
            lista[i].classList.remove('activo')
            contenido[i].classList.remove('activo')
        })

        lista[i].classList.add('activo')
        contenido[i].classList.add('activo')
    });
});