document.addEventListener('DOMContentLoaded', function() {

    const links = document.querySelectorAll('a');
    links.forEach(link => {
        link.addEventListener('mouseenter', function(e) {
           jumpTo("#jamy", e.clientX, e.clientY);
        });

        link.addEventListener('mouseleave', function(e) {
            disappearRandom("#jamy");
        });
    });

    const formInputs = document.querySelectorAll('input, textarea');
    formInputs.forEach(input => {
        input.addEventListener('focus', function(e) {
            jumpTo(
                "#chuck",
                input.getBoundingClientRect().top,
                input.getBoundingClientRect().left
            );
        });

        input.addEventListener('blur', function(e) {
            disappearRandom("#chuck");
        });
    });

});

function jumpTo(selector, x, y) {
    gsap.to(selector,{
        opacity: 1, 
        y: y, 
        x: x, 
        duration: 0.5, 
        overwrite: true 
    });
}

function disappearRandom(selector) {
    gsap.to(selector, { 
        y: window.innerHeight, 
        x: Math.random() * window.innerWidth, 
        delay: 0.5,
        duration: 0.5
    });
}
