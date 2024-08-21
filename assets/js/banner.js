let index = 0;

function showSlide(slideIndex) {
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    if (slideIndex >= totalSlides) {
        index = 0;
    } else if (slideIndex < 0) {
        index = totalSlides - 1;
    } else {
        index = slideIndex;
    }

    const newTransformValue = `translateX(${-index * 100}%)`;
    document.querySelector('.slider').style.transform = newTransformValue;
}

function nextSlide() {
    showSlide(index + 1);
}

function prevSlide() {
    showSlide(index - 1);
}

setInterval(nextSlide, 5000);

document.querySelector('.scroll-btn-left').addEventListener('click', () => {
    document.querySelector('.promo-product-list').scrollBy({
        left: -200,
        behavior: 'smooth'
    });
});

document.querySelector('.scroll-btn-right').addEventListener('click', () => {
    document.querySelector('.promo-product-list').scrollBy({
        left: 200,
        behavior: 'smooth'
    });
});

const promoList = document.querySelector('.promo-list');
const promoNext = document.querySelector('.promo-next');
const promoPrev = document.querySelector('.promo-prev');

promoNext.addEventListener('click', () => {
    promoList.scrollBy({ left: promoList.offsetWidth, behavior: 'smooth' });
});

promoPrev.addEventListener('click', () => {
    promoList.scrollBy({ left: -promoList.offsetWidth, behavior: 'smooth' });
});

