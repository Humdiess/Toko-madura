document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener('load', function() {
        const splashScreen = document.getElementById('splash-screen');
        if (splashScreen) {
            splashScreen.style.opacity = '0';
            splashScreen.style.transition = 'opacity 0.5s ease-out';
            setTimeout(function() {
                splashScreen.style.display = 'none';
            }, 500);
        }
    });
});
