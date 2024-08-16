document.addEventListener("scroll", function() {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) { // Ganti 50 dengan jumlah pixel yang diinginkan
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});