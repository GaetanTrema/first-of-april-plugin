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
                x: window.innerWidth / 2, 
                delay: 0.5,
                duration: 0.5
            });
        });
    });

});