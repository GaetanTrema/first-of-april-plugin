document.addEventListener('DOMContentLoaded', function() {

    const links = document.querySelectorAll('a');
    links.forEach(link => {
        link.addEventListener('mouseenter', function(e) {
            gsap.to("#jamy",
            {
                opacity: 1, 
                y: e.clientY, 
                x: e.clientX, 
                duration: 0.5, 
                overwrite: true 
            });
        });

        link.addEventListener('mouseleave', function(e) {
            gsap.to("#jamy", { 
                y: window.innerHeight, 
                x: Math.random() * window.innerWidth, 
                delay: 0.5,
                duration: 0.5
            });
        });
    });

    const formInputs = document.querySelectorAll('input, textarea');
    formInputs.forEach(input => {
        input.addEventListener('focus', function(e) {
            gsap.to("#chuck",
            {
                opacity: 1, 
                y: input.getBoundingClientRect().top, 
                x: input.getBoundingClientRect().left, 
                duration: 0.5, 
                overwrite: true 
            });
        });

        input.addEventListener('blur', function(e) {
            gsap.to("#chuck", { 
                y: window.innerHeight, 
                x: Math.random() * window.innerWidth, 
                delay: 0.5,
                duration: 0.5
            });
        });
    });

});
