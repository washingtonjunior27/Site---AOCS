// Menu Fixo com Scroll Suave
const menuItems = document.querySelectorAll('.navbar a[href^="#"]');

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        event.preventDefault();

        const element = event.target;
        const id = element.getAttribute('href');
        const section = document.querySelector(id).offsetTop;

        window.scroll({
            top: section - 100,
            behavior: "smooth",
        });
    });
})

// Fechar menu mobile ao clicar em um item
const toggler_menu = document.querySelector("button.navbar-toggler");

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        if (window.innerWidth < 992) {
            toggler_menu.click();
        }
    })
});

// Debounce do Lodash
const debounce = function(func, wait, immediate) {
    let timeout;
    return function(...args) {
        const context = this;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

// Animar ao scroll
const animate = document.querySelectorAll('[data-anime]');
const animationClass = 'animate';

function scrollAnimate() {
    const windowTop = window.pageYOffset + (window.innerHeight * 0.75);
    animate.forEach((e) => {
        if ((windowTop) > e.offsetTop) {
            e.classList.add(animationClass);
        } else {
            e.classList.remove(animationClass);
        }
    });
}

scrollAnimate();

if (animate.length) {
    window.addEventListener('scroll', debounce(() => {
        scrollAnimate();
    }, 75));
}