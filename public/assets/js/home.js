//
//Script para aplicar un efecto de zoom a la imagen de fondo en la pagina informativa al hacer scroll
//
window.addEventListener("scroll", function () {
    const scrollPosition = window.scrollY;
    const heroImage = document.querySelector(".hero-image");
    const scale = 1 + scrollPosition * 0.0005;
    const limitedScale = Math.min(1.3, Math.max(1, scale));
    heroImage.style.transform = `scale(${limitedScale})`;
});

//
//Script para cambiar dinámicamente la apariencia de la barra de navegación según el desplazamiento
//
document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener("scroll", function () {
        var navbar = document.querySelector(".navbar");
        var section1Top = document.getElementById("section1").offsetTop;
        var section2Top = document.getElementById("section2").offsetTop;
        var scrollPos = window.scrollY;

        if (scrollPos < section1Top) {
            navbar.classList.remove("section1", "section2");
            navbar.classList.add("transparent");
        } else if (scrollPos >= section1Top && scrollPos < section2Top) {
            navbar.classList.remove("transparent", "section2");
            navbar.classList.add("section1");
        } else if (scrollPos >= section2Top && scrollPos < section3Top) {
            navbar.classList.remove("transparent", "section1");
            navbar.classList.add("section2");
        }
    });
});

//
//Script para mostrar/ocultar el botón "Volver arriba" según el desplazamiento en la página
//
document.addEventListener("DOMContentLoaded", function () {
    var backToTop = document.getElementById("backToTop");
    var inicioSection = document.getElementById("inicio");

    window.addEventListener("scroll", function () {
        var inicioOffset = inicioSection.offsetTop + inicioSection.offsetHeight;

        // Muestra el botón cuando el usuario ha pasado la sección "inicio", de lo contrario, lo oculta
        if (window.scrollY > inicioOffset) {
            backToTop.style.display = "block";
        } else {
            backToTop.style.display = "none";
        }
    });
});

//
//Script de la seccion DESAFIO, para inicializar AOS (Animate On Scroll) y configurar animaciones en desplazamiento
//
document.addEventListener("DOMContentLoaded", function () {
    AOS.init({
        duration: 1000, // Duración de la animación en milisegundos
        easing: "ease-out", // Tipo de animación para una transición suave
        once: true, // La animación solo ocurre una vez y no se repite al hacer scroll
    });
});

//
//Script de la seccion SEGUIMIENTO, para animar elementos de seguimiento cuando aparecen en la vista
//
document.addEventListener("DOMContentLoaded", function () {
  // Detecta si el usuario está en un dispositivo móvil
  const isMobile = window.matchMedia("(max-width: 576px)").matches;

  // Configuración del Intersection Observer para detectar cuando los elementos son visibles
  const observerOptions = {
      threshold: 0.1, // Se activa cuando el 10% del elemento es visible
      rootMargin: "0px 0px -30px 0px", // Ajuste para activar la animación antes de que el elemento esté completamente visible
  };

  // Crea el observador para detectar elementos en pantalla
  const observer = new IntersectionObserver(function (entries, observer) {
      entries.forEach((entry) => {
          if (entry.isIntersecting) {
              const items = entry.target.querySelectorAll(".tracking-item");
              items.forEach((item, index) => {
                  // Define el tiempo de retraso para la animación según el dispositivo
                  const delay = isMobile ? index * 100 : index * 150;
                  setTimeout(() => {
                      item.classList.add("animated"); // Agrega la clase de animación cuando el elemento es visible
                  }, delay);
              });
              observer.unobserve(entry.target); // Deja de observar el elemento una vez animado
          }
      });
  }, observerOptions);

  // Selecciona todas las secciones de seguimiento y las observa
  const sections = document.querySelectorAll(".seguimiento-section");
  sections.forEach((section) => {
      observer.observe(section);
  });

  // Mejora la respuesta táctil en dispositivos móviles
  if (isMobile) {
      document.addEventListener("touchstart", function () {}, {
          passive: true,
      });
  }
});
