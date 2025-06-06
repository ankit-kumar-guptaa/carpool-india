document.addEventListener('DOMContentLoaded', function() {
    // Animate hero section text
    anime({
        targets: '.hero-section h1',
        opacity: [0, 1],
        translateY: [50, 0],
        easing: 'easeOutExpo',
        duration: 1000
    });

    anime({
        targets: '.hero-section p',
        opacity: [0, 1],
        translateY: [50, 0],
        easing: 'easeOutExpo',
        duration: 1000,
        delay: 300
    });

    anime({
        targets: '.search-form',
        opacity: [0, 1],
        scale: [0.9, 1],
        easing: 'easeOutExpo',
        duration: 1000,
        delay: 600
    });
});