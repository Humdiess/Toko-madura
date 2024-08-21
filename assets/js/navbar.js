document.addEventListener("scroll", function() {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});

document.querySelector('.btn-primary').addEventListener('click', function() {
    this.innerHTML = 'Terima Kasih!';
    this.style.backgroundColor = '#28a745';
});

document.querySelectorAll('.bottom-tab-bar .nav-link').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('.bottom-tab-bar .nav-link').forEach(item => item.classList.remove('active'));
        this.classList.add('active');
    });
});
